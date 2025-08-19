document.addEventListener('DOMContentLoaded', () => {
    // Load menu data from backend
    loadMenuData();
    
    const cards = document.querySelectorAll('.food-card');
    const modal = document.getElementById('food-modal');
    const modalImg = document.getElementById('modal-img');
    const modalTitle = document.getElementById('modal-title');
    const modalDesc = document.getElementById('modal-desc');
    const modalPrice = document.getElementById('modal-price');
  
    // Load menu data from API
    async function loadMenuData() {
        try {
            const response = await fetch('/api/menu');
            const data = await response.json();
            
            // Populate categories in tabs
            populateCategories(data.categories);
            
            // Populate products in sections
            populateProducts(data.products, data.categories);
            
        } catch (error) {
            console.error('Error loading menu data:', error);
        }
    }
    
    // Populate categories in tabs
    function populateCategories(categories) {
        const tabsContainer = document.querySelector('.tabs-scroll');
        if (!tabsContainer) return;
        
        // Clear existing tabs except the first one (Most Liked)
        const existingTabs = tabsContainer.querySelectorAll('.tab:not([data-target="#most-liked"])');
        existingTabs.forEach(tab => tab.remove());
        
        // Add category tabs
        categories.forEach(category => {
            const tab = document.createElement('button');
            tab.className = 'tab';
            tab.setAttribute('data-target', `#${category.slug}`);
            tab.textContent = category.label.en;
            tabsContainer.appendChild(tab);
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
            
            if (existingSection) {
                // Update existing section
                const cardsGrid = existingSection.querySelector('.cards-grid');
                if (cardsGrid) {
                    cardsGrid.innerHTML = '';
                    const categoryProducts = productsByCategory[category.slug] || [];
                    categoryProducts.forEach(product => {
                        const card = createProductCard(product);
                        cardsGrid.appendChild(card);
                    });
                }
            } else {
                // Create new section
                const newSection = createCategorySection(category, productsByCategory[category.slug] || []);
                const container = document.querySelector('.container');
                const lastSection = container.querySelector('.section:last-of-type');
                if (lastSection) {
                    lastSection.after(newSection);
                } else {
                    container.appendChild(newSection);
                }
            }
        });
        
        // Reinitialize card functionality
        initializeCards();
    }
    
    // Create product card
    function createProductCard(product) {
        const card = document.createElement('article');
        card.className = 'food-card';
        
        card.innerHTML = `
            <div class="info">
                <h3 class="food-name">${product.name.en}</h3>
                <p class="food-desc">${product.description.en || ''}</p>
                <div class="price">BD ${product.price.toFixed(3)}</div>
            </div>
            <div class="thumb">
                <img src="${product.image || '/images/zz.png'}" alt="${product.name.en}">
                <span class="like-badge">
                    <svg viewBox="0 0 24 24" width="14" height="14" aria-hidden="true">
                        <path d="M12 21s-6.716-4.507-9.193-7.02C.78 11.947.5 9.167 2.21 7.457a4.5 4.5 0 0 1 6.364 0L12 10.88l3.426-3.423a4.5 4.5 0 0 1 6.364 6.364C18.716 16.493 12 21 12 21z"/>
                    </svg>
                    <b>1</b>
                </span>
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
            return `
                <article class="food-card">
                    <div class="info">
                        <h3 class="food-name">${product.name.en}</h3>
                        <p class="food-desc">${product.description.en || ''}</p>
                        <div class="price">BD ${product.price.toFixed(3)}</div>
                    </div>
                    <div class="thumb">
                        <img src="${product.image || '/images/zz.png'}" alt="${product.name.en}">
                        <span class="like-badge">
                            <svg viewBox="0 0 24 24" width="14" height="14" aria-hidden="true">
                                <path d="M12 21s-6.716-4.507-9.193-7.02C.78 11.947.5 9.167 2.21 7.457a4.5 4.5 0 0 1 6.364 0L12 10.88l3.426-3.423a4.5 4.5 0 0 1 6.364 6.364C18.716 16.493 12 21 12 21z"/>
                            </svg>
                            <b>1</b>
                        </span>
                    </div>
                </article>
            `;
        }).join('');
        
        section.innerHTML = `
            <h2 class="section-title">${category.label.en}</h2>
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
});
  