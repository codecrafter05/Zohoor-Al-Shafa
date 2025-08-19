document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.food-card');
    const modal = document.getElementById('food-modal');
    const modalImg = document.getElementById('modal-img');
    const modalTitle = document.getElementById('modal-title');
    const modalDesc = document.getElementById('modal-desc');
    const modalPrice = document.getElementById('modal-price');
  
    // افتح المودال
    function openModal(fromCard){
      // استخرج البيانات من الكارد
      const nameEl = fromCard.querySelector('.food-name');
      const descEl = fromCard.querySelector('.food-desc');
      const priceEl = fromCard.querySelector('.price');
      const imgEl = fromCard.querySelector('.thumb img');
  
      const name = nameEl ? nameEl.textContent.trim() : '';
      // استخدم data-full إذا وُجد، وإلا النص نفسه، واحذف "…" إن كانت مكتوبة يدوياً
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
  
    // اجعل كل كارد قابل للضغط والكيبورد
    let lastFocused = null;
    cards.forEach(card => {
      card.setAttribute('tabindex', '0');   // للكيبورد
      card.addEventListener('click', () => openModal(card));
      card.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          openModal(card);
        }
      });
    });
  
    // إغلاقات
    modal.addEventListener('click', (e) => {
      if (e.target.dataset.close === 'true') closeModal();
    });
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && modal.classList.contains('open')) closeModal();
    });
  });

  
    // === Tabs -> scroll to target section ===
    const tabs = document.querySelectorAll('.tab[data-target]');

    tabs.forEach(tab => {
      tab.addEventListener('click', (e) => {
        e.preventDefault();
        const target = document.querySelector(tab.dataset.target);
        if (!target) return;
  
        // فعل التاب المختار
        document.querySelectorAll('.tab.active').forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
  
        // انزل للسكشن (الـ offset متكفل به scroll-margin-top بالـ CSS)
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
    });
  
    // === Highlight active tab while scrolling (اختياري لكنه حلو) ===
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
  