document.addEventListener('DOMContentLoaded', () => {
    // Language state
    let currentLanguage = localStorage.getItem('language') || 'en'; // Get saved language or default to 'en'
    let menuData = null; // Store menu data for language switching
    
    // Load menu data from backend
    loadMenuData();
    
    // Apply saved language on page load
    if (currentLanguage === 'ar') {
        // Set initial language state
        document.documentElement.lang = currentLanguage;
        document.documentElement.dir = 'rtl';
        updateLanguageIndicator();
    }
    
    const cards = document.querySelectorAll('.food-card');
    const modal = document.getElementById('food-modal');
    const modalImg = document.getElementById('modal-img');
    const modalTitle = document.getElementById('modal-title');
    const modalDesc = document.getElementById('modal-desc');
    const modalPrice = document.getElementById('modal-price');
    const languageToggle = document.getElementById('language-toggle');
    
    // Language toggle functionality
    if (languageToggle) {
        languageToggle.addEventListener('click', () => {
            currentLanguage = currentLanguage === 'en' ? 'ar' : 'en';
            localStorage.setItem('language', currentLanguage); // Save language preference
            updateLanguage();
        });
    }
    
    // Update language indicator
    function updateLanguageIndicator() {
        const langIndicator = document.querySelector('.lang-indicator');
        if (langIndicator) {
            // Show the language that will be switched TO, not the current language
            langIndicator.textContent = currentLanguage === 'en' ? 'AR' : 'EN';
        }
    }
    
    // Update language across the entire page
    function updateLanguage() {
        // Update HTML lang and dir attributes
        document.documentElement.lang = currentLanguage;
        document.documentElement.dir = currentLanguage === 'ar' ? 'rtl' : 'ltr';
        
        // Update page title
        const pageTitle = document.querySelector('.page-title');
        if (pageTitle) {
            pageTitle.textContent = currentLanguage === 'en' ? 'FOOD MENU' : 'قائمة الطعام';
        }
        
        // Update subtext
        const subtext = document.querySelector('.subtext');
        if (subtext) {
            subtext.textContent = currentLanguage === 'en' ? 'All Day from 11:30 AM to 11:30 PM' : 'طوال اليوم من 11:30 صباحاً إلى 11:30 مساءً';
        }
        
        // Update most liked section
        const mostLikedTitle = document.querySelector('#most-liked .section-title');
        if (mostLikedTitle) {
            mostLikedTitle.innerHTML = currentLanguage === 'en' 
                ? '<span class="heart">❤</span> Most Liked <span class="heart">❤</span>'
                : '<span class="heart">❤</span> الأكثر إعجاباً <span class="heart">❤</span>';
        }
        
        const mostLikedSub = document.querySelector('#most-liked .section-sub');
        if (mostLikedSub) {
            mostLikedSub.textContent = currentLanguage === 'en' 
                ? 'According to real guest likes'
                : 'حسب إعجابات الضيوف الحقيقية';
        }
        
        // Update most liked tab
        const mostLikedTab = document.querySelector('.tab[data-target="#most-liked"]');
        if (mostLikedTab) {
            mostLikedTab.innerHTML = currentLanguage === 'en' 
                ? '<span class="heart">❤</span> Most Liked'
                : '<span class="heart">❤</span> الأكثر إعجاباً';
        }
        
        // Re-populate content with new language
        if (menuData) {
            updateCategoryTabs();
            updateSectionTitles();
            populateProducts(menuData.products, menuData.categories);
            populateFavorites(menuData.favorites);
        }
        
        // Update modal if it's open
        if (modal.classList.contains('open')) {
            updateModalLanguage();
        }
        
        // Update language indicator
        updateLanguageIndicator();
    }
    
    // Update category tabs when language changes
    function updateCategoryTabs() {
        const tabs = document.querySelectorAll('.tab[data-category-slug]');
        tabs.forEach(tab => {
            const categorySlug = tab.getAttribute('data-category-slug');
            const category = menuData.categories.find(c => c.slug === categorySlug);
            if (category) {
                tab.textContent = currentLanguage === 'en' ? category.label.en : (category.label.ar || category.label.en);
            }
        });
    }
    
    // Update section titles when language changes
    function updateSectionTitles() {
        const sections = document.querySelectorAll('.section[id]');
        sections.forEach(section => {
            const sectionId = section.id;
            const sectionTitle = section.querySelector('.section-title');
            if (sectionTitle && menuData) {
                const category = menuData.categories.find(c => c.slug === sectionId);
                if (category) {
                    sectionTitle.textContent = currentLanguage === 'en' ? category.label.en : (category.label.ar || category.label.en);
                }
            }
        });
    }
    
    // Update modal content when language changes
    function updateModalLanguage() {
        const productId = modalTitle.getAttribute('data-product-id');
        if (productId && menuData) {
            const product = menuData.products.find(p => p.id == productId);
            if (product) {
                const productName = currentLanguage === 'en' ? product.name.en : (product.name.ar || product.name.en);
                const productDesc = currentLanguage === 'en' ? (product.description.en || '') : (product.description.ar || product.description.en || '');
                
                modalTitle.textContent = productName;
                modalDesc.textContent = productDesc;
                modalImg.setAttribute('alt', productName);
            }
        }
    }
  
    // Load menu data from API
    async function loadMenuData() {
        try {
            const response = await fetch('/api/menu');
            const data = await response.json();
            
            // Store menu data for language switching
            menuData = data;
            
            // Populate categories in tabs (only those with products)
            populateCategories(data.categories, data.products);
            
            // Populate products in sections
            populateProducts(data.products, data.categories);
            
            // Populate favorites in most-liked section
            populateFavorites(data.favorites);
            
            // Apply saved language after data is loaded
            if (currentLanguage === 'ar') {
                updateLanguage();
            }
            
        } catch (error) {
            console.error('Error loading menu data:', error);
        }
    }
    
    // Populate favorites in most-liked section
    function populateFavorites(favorites) {
        const mostLikedSection = document.getElementById('most-liked');
        if (!mostLikedSection) return;
        
        const cardsGrid = mostLikedSection.querySelector('.cards-grid');
        if (cardsGrid) {
            cardsGrid.innerHTML = '';
            favorites.forEach(product => {
                const card = createProductCard(product, true);
                cardsGrid.appendChild(card);
            });
        }
        
        // Reinitialize card functionality
        initializeCards();
    }
    
    // Populate categories in tabs (only those with products)
    function populateCategories(categories, products) {
        const tabsContainer = document.querySelector('.tabs-scroll');
        if (!tabsContainer) return;
        
        // Clear existing tabs except the first one (Most Liked)
        const existingTabs = tabsContainer.querySelectorAll('.tab:not([data-target="#most-liked"])');
        existingTabs.forEach(tab => tab.remove());
        
        // Group products by category to count them
        const productsByCategory = {};
        products.forEach(product => {
            if (!productsByCategory[product.category]) {
                productsByCategory[product.category] = [];
            }
            productsByCategory[product.category].push(product);
        });
        
        // Add category tabs only for categories with products
        categories.forEach(category => {
            const categoryProducts = productsByCategory[category.slug] || [];
            if (categoryProducts.length > 0) {
                const tab = document.createElement('button');
                tab.className = 'tab';
                tab.setAttribute('data-target', `#${category.slug}`);
                tab.setAttribute('data-category-slug', category.slug);
                tab.textContent = currentLanguage === 'en' ? category.label.en : (category.label.ar || category.label.en);
                tabsContainer.appendChild(tab);
            }
        });
        
        // Reinitialize tab functionality
        initializeTabs();
    }
    
    // Populate products in sections
    function populateProducts(products, categories) {
        // Group products by category
        const productsByCategory = {};
        products.forEach(product => {
            if (!productsByCategory[product.category]) {
                productsByCategory[product.category] = [];
            }
            productsByCategory[product.category].push(product);
        });
        
        // Create sections for each category
        categories.forEach(category => {
            const sectionId = category.slug;
            const existingSection = document.getElementById(sectionId);
            const categoryProducts = productsByCategory[category.slug] || [];
            
            // Only create/update section if there are products
            if (categoryProducts.length > 0) {
                if (existingSection) {
                    // Update existing section
                    const cardsGrid = existingSection.querySelector('.cards-grid');
                    if (cardsGrid) {
                        cardsGrid.innerHTML = '';
                        categoryProducts.forEach(product => {
                            const card = createProductCard(product, false);
                            cardsGrid.appendChild(card);
                        });
                    }
                } else {
                    // Create new section
                    const newSection = createCategorySection(category, categoryProducts);
                    const container = document.querySelector('.container');
                    const lastSection = container.querySelector('.section:last-of-type');
                    if (lastSection) {
                        lastSection.after(newSection);
                    } else {
                        container.appendChild(newSection);
                    }
                }
            } else {
                // Remove section if it exists but has no products
                if (existingSection) {
                    existingSection.remove();
                }
            }
        });
        
        // Reinitialize card functionality
        initializeCards();
    }
    
    // Create product card
    function createProductCard(product, isFavorite = false) {
        const card = document.createElement('article');
        card.className = 'food-card';
        card.setAttribute('data-product-id', product.id);
        
        const favoriteClass = isFavorite ? 'favorite' : '';
        const favoriteIcon = isFavorite ? '❤' : '🤍';
        
        const productName = currentLanguage === 'en' ? product.name.en : (product.name.ar || product.name.en);
        const productDesc = currentLanguage === 'en' ? (product.description.en || '') : (product.description.ar || product.description.en || '');
        
        card.innerHTML = `
            <div class="info">
                <h3 class="food-name">${productName}</h3>
                <p class="food-desc">${productDesc}</p>
                <div class="price">BD ${product.price.toFixed(3)}</div>
            </div>
            <div class="thumb">
                <img src="${product.image || '/images/zz.png'}" alt="${productName}">
            </div>
        `;
        
        return card;
    }
    
    // Create category section
    function createCategorySection(category, products) {
        const section = document.createElement('section');
        section.id = category.slug;
        section.className = 'section';
        
        const productsHtml = products.map(product => {
            const favoriteClass = product.is_favorite ? 'favorite' : '';
            const favoriteIcon = product.is_favorite ? '❤' : '🤍';
            const productName = currentLanguage === 'en' ? product.name.en : (product.name.ar || product.name.en);
            const productDesc = currentLanguage === 'en' ? (product.description.en || '') : (product.description.ar || product.description.en || '');
            
            return `
                <article class="food-card" data-product-id="${product.id}">
                    <div class="info">
                        <h3 class="food-name">${productName}</h3>
                        <p class="food-desc">${productDesc}</p>
                        <div class="price">BD ${product.price.toFixed(3)}</div>
                    </div>
                    <div class="thumb">
                        <img src="${product.image || '/images/zz.png'}" alt="${productName}">
                    </div>
                </article>
            `;
        }).join('');
        
        const categoryTitle = currentLanguage === 'en' ? category.label.en : (category.label.ar || category.label.en);
        
        section.innerHTML = `
            <h2 class="section-title">${categoryTitle}</h2>
            <div class="cards-grid">
                ${productsHtml}
            </div>
        `;
        
        return section;
    }
    
    // Initialize tabs functionality
    function initializeTabs() {
        const tabs = document.querySelectorAll('.tab[data-target]');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector(tab.dataset.target);
                if (!target) return;
        
                // فعل التاب المختار
                document.querySelectorAll('.tab.active').forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
        
                // انزل للسكشن
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });
        
        // Highlight active tab while scrolling
        const sections = Array.from(document.querySelectorAll('.section[id]'));
        const spy = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = `#${entry.target.id}`;
                    tabs.forEach(t => t.classList.toggle('active', t.dataset.target === id));
                }
            });
        }, { rootMargin: '-45% 0px -45% 0px', threshold: 0.01 });
        
        sections.forEach(sec => spy.observe(sec));
    }
    
    // Initialize cards functionality
    function initializeCards() {
        const cards = document.querySelectorAll('.food-card');
        let lastFocused = null;
        
        cards.forEach(card => {
            card.setAttribute('tabindex', '0');
            card.addEventListener('click', () => openModal(card));
            card.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    openModal(card);
                }
            });
        });
    }
  
    // افتح المودال
    function openModal(fromCard){
      // استخرج البيانات من الكارد
      const nameEl = fromCard.querySelector('.food-name');
      const descEl = fromCard.querySelector('.food-desc');
      const priceEl = fromCard.querySelector('.price');
      const imgEl = fromCard.querySelector('.thumb img');
  
      const name = nameEl ? nameEl.textContent.trim() : '';
      const fullDesc = (descEl?.dataset.full || descEl?.textContent || '')
                        .replace(/…+$/,'')
                        .trim();
      const price = priceEl ? priceEl.textContent.trim() : '';
      const imgSrc = imgEl ? imgEl.getAttribute('src') : '';
      const imgAlt = imgEl ? (imgEl.getAttribute('alt') || name) : name;
  
      modalTitle.textContent = name;
      modalTitle.setAttribute('data-product-id', fromCard.getAttribute('data-product-id'));
      modalDesc.textContent = fullDesc;
      modalPrice.textContent = price;
      if (imgSrc) modalImg.setAttribute('src', imgSrc);
      modalImg.setAttribute('alt', imgAlt);
  
      modal.classList.add('open');
      modal.setAttribute('aria-hidden', 'false');
  
      // حفظ آخر عنصر مركّز للرجوع له
      lastFocused = document.activeElement;
      // فوكس على زر الإغلاق
      const closeBtn = modal.querySelector('.modal-close');
      closeBtn && closeBtn.focus();
    }
  
    // اغلق المودال
    function closeModal(){
      modal.classList.remove('open');
      modal.setAttribute('aria-hidden', 'true');
      // رجّع الفوكس للكارد
      if (lastFocused && typeof lastFocused.focus === 'function') lastFocused.focus();
    }
  
    // إغلاقات
    modal.addEventListener('click', (e) => {
      if (e.target.dataset.close === 'true') closeModal();
    });
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && modal.classList.contains('open')) closeModal();
    });
    
    // Initialize existing functionality
    initializeTabs();
    initializeCards();
    
    // Initialize language indicator
    updateLanguageIndicator();
});
  