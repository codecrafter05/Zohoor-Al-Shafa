<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FOOD MENU — Zohoor Al Shafa</title>

  <!-- Local CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="zs-body">

  <div class="container">

    <!-- centered logo (outside the .topbar) -->
    <div class="brand-header">
      <img src="{{ asset('images/logo.png') }}" alt="Zohoor Al Shafa" class="brand-logo">
    </div>

    <!-- thin full-width separator -->
    <div class="full-bleed-sep"></div>

    <!-- Top Header -->
    <header class="topbar">
      <div class="topbar-left">
        <h1 class="page-title">FOOD MENU <span class="chev">▾</span></h1>
        <p class="subtext">All Day from 11:30 AM to 11:30 PM</p>
      </div>

      <div class="topbar-right">
        <!-- search -->
        <button class="icon-btn" aria-label="Search">
          <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true">
            <path d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 1 0-.71.71l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0A4.5 4.5 0 1 1 14 9.5 4.5 4.5 0 0 1 9.5 14z"/>
          </svg>
        </button>
        <!-- filter -->
        <button class="icon-btn" aria-label="Filters">
          <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true">
            <path d="M3 5h18v2H3zm4 6h10v2H7zm3 6h4v2h-4z"/>
          </svg>
        </button>
      </div>
    </header>

    <!-- Category Tabs -->
    <nav class="tabs-wrap">
      <div class="tabs-scroll">
        <button class="tab active" data-target="#most-liked"><span class="heart">❤</span> Most Liked</button>
        <button class="tab" data-target="#small-eats">SMALL EATS</button>
        <button class="tab" data-target="#mezze-bar">MEZZE BAR</button>
        <button class="tab" data-target="#club-salads">CLUB SALADS</button>
        <button class="tab" data-target="#buns-toasts">BUNS &amp; TOASTS</button>
        <button class="tab" data-target="#big-eats">BIG EATS</button>
        <button class="tab" data-target="#sides">SIDES</button>
      </div>
    </nav>


    <!-- Section -->
    <section id="most-liked" class="section">
      <h2 class="section-title"><span class="heart">❤</span> Most Liked <span class="heart">❤</span></h2>
      <p class="section-sub">According to real guest likes</p>

      <!-- Cards Grid -->
      <div class="cards-grid">
        <!-- Card 1 -->
        <article class="food-card">
          <div class="info">
            <h3 class="food-name">Watermelon Fresca</h3>
            <p class="food-desc">Rocca, mint, sun-dried tomato, feta, watermelon, pumpkin seeds…</p>
            <div class="price">BD 4.800</div>
          </div>
          <div class="thumb">
            <img src="{{ asset('images/zz.png') }}" alt="Watermelon Fresca">
            <span class="like-badge">
              <svg viewBox="0 0 24 24" width="14" height="14" aria-hidden="true"><path d="M12 21s-6.716-4.507-9.193-7.02C.78 11.947.5 9.167 2.21 7.457a4.5 4.5 0 0 1 6.364 0L12 10.88l3.426-3.423a4.5 4.5 0 0 1 6.364 6.364C18.716 16.493 12 21 12 21z"/></svg>
              <b>2</b>
            </span>
          </div>
        </article>

        <!-- Card 2 -->
        <article class="food-card">
          <div class="info">
            <h3 class="food-name">Tah-Chin Crispy Rice</h3>
            <p class="food-desc">Crispy rice bites, saffron shredded chicken, zereshk…</p>
            <div class="price">BD 3.500</div>
          </div>
          <div class="thumb">
            <img src="{{ asset('images/zz.png') }}" alt="Tah-Chin Crispy Rice">
            <span class="like-badge">
              <svg viewBox="0 0 24 24" width="14" height="14"><path d="M12 21s-6.716-4.507-9.193-7.02C.78 11.947.5 9.167 2.21 7.457a4.5 4.5 0 0 1 6.364 0L12 10.88l3.426-3.423a4.5 4.5 0 0 1 6.364 6.364C18.716 16.493 12 21 12 21z"/></svg>
              <b>1</b>
            </span>
          </div>
        </article>

        <!-- Card 3 -->
        <article class="food-card">
          <div class="info">
            <h3 class="food-name">H.L.F.</h3>
            <p class="food-desc">Halloumi Loaded Fries. Sun-dried tomato marinara, skin-on fries…</p>
            <div class="price">BD 5.200</div>
          </div>
          <div class="thumb">
            <img src="{{ asset('images/zz.png') }}" alt="H.L.F.">
            <span class="like-badge">
              <svg viewBox="0 0 24 24" width="14" height="14"><path d="M12 21s-6.716-4.507-9.193-7.02C.78 11.947.5 9.167 2.21 7.457a4.5 4.5 0 0 1 6.364 0L12 10.88l3.426-3.423a4.5 4.5 0 0 1 6.364 6.364C18.716 16.493 12 21 12 21z"/></svg>
              <b>1</b>
            </span>
          </div>
        </article>

        <!-- Card 4 -->
        <article class="food-card">
          <div class="info">
            <h3 class="food-name">Samboosa Bites</h3>
            <p class="food-desc">Mini samboosa with classic cheese, sumac, chives…</p>
            <div class="price">BD 3.200</div>
          </div>
          <div class="thumb">
            <img src="{{ asset('images/zz.png') }}" alt="Samboosa Bites">
            <span class="like-badge">
              <svg viewBox="0 0 24 24" width="14" height="14"><path d="M12 21s-6.716-4.507-9.193-7.02C.78 11.947.5 9.167 2.21 7.457a4.5 4.5 0 0 1 6.364 0L12 10.88l3.426-3.423a4.5 4.5 0 0 1 6.364 6.364C18.716 16.493 12 21 12 21z"/></svg>
              <b>1</b>
            </span>
          </div>
        </article>

        <!-- Card 5 -->
        <article class="food-card">
          <div class="info">
            <h3 class="food-name">Avo Hallo</h3>
            <p class="food-desc">Mixed garden lettuce, avocado, cherry tomatoes, crispy rice…</p>
            <div class="price">BD 5.400</div>
          </div>
          <div class="thumb">
            <img src="{{ asset('images/zz.png') }}" alt="Avo Hallo">
            <span class="like-badge">
              <svg viewBox="0 0 24 24" width="14" height="14"><path d="M12 21s-6.716-4.507-9.193-7.02C.78 11.947.5 9.167 2.21 7.457a4.5 4.5 0 0 1 6.364 0L12 10.88l3.426-3.423a4.5 4.5 0 0 1 6.364 6.364C18.716 16.493 12 21 12 21z"/></svg>
              <b>1</b>
            </span>
          </div>
        </article>
      </div>
    </section>

    <section id="small-eats" class="section">
      <h2 class="section-title"> SMALL EATS </h2>

      <!-- Cards Grid -->
      <div class="cards-grid">
        <!-- Card 1 -->
        <article class="food-card">
          <div class="info">
            <h3 class="food-name">Watermelon Fresca</h3>
            <p class="food-desc">Rocca, mint, sun-dried tomato, feta, watermelon, pumpkin seeds…</p>
            <div class="price">BD 4.800</div>
          </div>
          <div class="thumb">
            <img src="{{ asset('images/zz.png') }}" alt="Watermelon Fresca">
            <span class="like-badge">
              <svg viewBox="0 0 24 24" width="14" height="14" aria-hidden="true"><path d="M12 21s-6.716-4.507-9.193-7.02C.78 11.947.5 9.167 2.21 7.457a4.5 4.5 0 0 1 6.364 0L12 10.88l3.426-3.423a4.5 4.5 0 0 1 6.364 6.364C18.716 16.493 12 21 12 21z"/></svg>
              <b>2</b>
            </span>
          </div>
        </article>

        <!-- Card 2 -->
        <article class="food-card">
          <div class="info">
            <h3 class="food-name">Tah-Chin Crispy Rice</h3>
            <p class="food-desc">Crispy rice bites, saffron shredded chicken, zereshk…</p>
            <div class="price">BD 3.500</div>
          </div>
          <div class="thumb">
            <img src="{{ asset('images/zz.png') }}" alt="Tah-Chin Crispy Rice">
            <span class="like-badge">
              <svg viewBox="0 0 24 24" width="14" height="14"><path d="M12 21s-6.716-4.507-9.193-7.02C.78 11.947.5 9.167 2.21 7.457a4.5 4.5 0 0 1 6.364 0L12 10.88l3.426-3.423a4.5 4.5 0 0 1 6.364 6.364C18.716 16.493 12 21 12 21z"/></svg>
              <b>1</b>
            </span>
          </div>
        </article>

        <!-- Card 3 -->
        <article class="food-card">
          <div class="info">
            <h3 class="food-name">H.L.F.</h3>
            <p class="food-desc">Halloumi Loaded Fries. Sun-dried tomato marinara, skin-on fries…</p>
            <div class="price">BD 5.200</div>
          </div>
          <div class="thumb">
            <img src="{{ asset('images/zz.png') }}" alt="H.L.F.">
            <span class="like-badge">
              <svg viewBox="0 0 24 24" width="14" height="14"><path d="M12 21s-6.716-4.507-9.193-7.02C.78 11.947.5 9.167 2.21 7.457a4.5 4.5 0 0 1 6.364 0L12 10.88l3.426-3.423a4.5 4.5 0 0 1 6.364 6.364C18.716 16.493 12 21 12 21z"/></svg>
              <b>1</b>
            </span>
          </div>
        </article>

        <!-- Card 4 -->
        <article class="food-card">
          <div class="info">
            <h3 class="food-name">Samboosa Bites</h3>
            <p class="food-desc">Mini samboosa with classic cheese, sumac, chives…</p>
            <div class="price">BD 3.200</div>
          </div>
          <div class="thumb">
            <img src="{{ asset('images/zz.png') }}" alt="Samboosa Bites">
            <span class="like-badge">
              <svg viewBox="0 0 24 24" width="14" height="14"><path d="M12 21s-6.716-4.507-9.193-7.02C.78 11.947.5 9.167 2.21 7.457a4.5 4.5 0 0 1 6.364 0L12 10.88l3.426-3.423a4.5 4.5 0 0 1 6.364 6.364C18.716 16.493 12 21 12 21z"/></svg>
              <b>1</b>
            </span>
          </div>
        </article>

        <!-- Card 5 -->
        <article class="food-card">
          <div class="info">
            <h3 class="food-name">Avo Hallo</h3>
            <p class="food-desc">Mixed garden lettuce, avocado, cherry tomatoes, crispy rice…</p>
            <div class="price">BD 5.400</div>
          </div>
          <div class="thumb">
            <img src="{{ asset('images/zz.png') }}" alt="Avo Hallo">
            <span class="like-badge">
              <svg viewBox="0 0 24 24" width="14" height="14"><path d="M12 21s-6.716-4.507-9.193-7.02C.78 11.947.5 9.167 2.21 7.457a4.5 4.5 0 0 1 6.364 0L12 10.88l3.426-3.423a4.5 4.5 0 0 1 6.364 6.364C18.716 16.493 12 21 12 21z"/></svg>
              <b>1</b>
            </span>
          </div>
        </article>
      </div>
    </section>

    <section id="mezze-bar" class="section">
      <h2 class="section-title"> MEZZE BAR </h2>

      <!-- Cards Grid -->
      <div class="cards-grid">
        <!-- Card 1 -->
        <article class="food-card">
          <div class="info">
            <h3 class="food-name">Watermelon Fresca</h3>
            <p class="food-desc">Rocca, mint, sun-dried tomato, feta, watermelon, pumpkin seeds…</p>
            <div class="price">BD 4.800</div>
          </div>
          <div class="thumb">
            <img src="{{ asset('images/zz.png') }}" alt="Watermelon Fresca">
            <span class="like-badge">
              <svg viewBox="0 0 24 24" width="14" height="14" aria-hidden="true"><path d="M12 21s-6.716-4.507-9.193-7.02C.78 11.947.5 9.167 2.21 7.457a4.5 4.5 0 0 1 6.364 0L12 10.88l3.426-3.423a4.5 4.5 0 0 1 6.364 6.364C18.716 16.493 12 21 12 21z"/></svg>
              <b>2</b>
            </span>
          </div>
        </article>

        <!-- Card 2 -->
        <article class="food-card">
          <div class="info">
            <h3 class="food-name">Tah-Chin Crispy Rice</h3>
            <p class="food-desc">Crispy rice bites, saffron shredded chicken, zereshk…</p>
            <div class="price">BD 3.500</div>
          </div>
          <div class="thumb">
            <img src="{{ asset('images/zz.png') }}" alt="Tah-Chin Crispy Rice">
            <span class="like-badge">
              <svg viewBox="0 0 24 24" width="14" height="14"><path d="M12 21s-6.716-4.507-9.193-7.02C.78 11.947.5 9.167 2.21 7.457a4.5 4.5 0 0 1 6.364 0L12 10.88l3.426-3.423a4.5 4.5 0 0 1 6.364 6.364C18.716 16.493 12 21 12 21z"/></svg>
              <b>1</b>
            </span>
          </div>
        </article>

        <!-- Card 3 -->
        <article class="food-card">
          <div class="info">
            <h3 class="food-name">H.L.F.</h3>
            <p class="food-desc">Halloumi Loaded Fries. Sun-dried tomato marinara, skin-on fries…</p>
            <div class="price">BD 5.200</div>
          </div>
          <div class="thumb">
            <img src="{{ asset('images/zz.png') }}" alt="H.L.F.">
            <span class="like-badge">
              <svg viewBox="0 0 24 24" width="14" height="14"><path d="M12 21s-6.716-4.507-9.193-7.02C.78 11.947.5 9.167 2.21 7.457a4.5 4.5 0 0 1 6.364 0L12 10.88l3.426-3.423a4.5 4.5 0 0 1 6.364 6.364C18.716 16.493 12 21 12 21z"/></svg>
              <b>1</b>
            </span>
          </div>
        </article>

        <!-- Card 4 -->
        <article class="food-card">
          <div class="info">
            <h3 class="food-name">Samboosa Bites</h3>
            <p class="food-desc">Mini samboosa with classic cheese, sumac, chives…</p>
            <div class="price">BD 3.200</div>
          </div>
          <div class="thumb">
            <img src="{{ asset('images/zz.png') }}" alt="Samboosa Bites">
            <span class="like-badge">
              <svg viewBox="0 0 24 24" width="14" height="14"><path d="M12 21s-6.716-4.507-9.193-7.02C.78 11.947.5 9.167 2.21 7.457a4.5 4.5 0 0 1 6.364 0L12 10.88l3.426-3.423a4.5 4.5 0 0 1 6.364 6.364C18.716 16.493 12 21 12 21z"/></svg>
              <b>1</b>
            </span>
          </div>
        </article>

        <article class="food-card">
          <div class="info">
            <h3 class="food-name">Tah-Chin Crispy Rice</h3>
            <p class="food-desc">Crispy rice bites, saffron shredded chicken, zereshk…</p>
            <div class="price">BD 3.500</div>
          </div>
          <div class="thumb">
            <img src="{{ asset('images/zz.png') }}" alt="Tah-Chin Crispy Rice">
            <span class="like-badge">
              <svg viewBox="0 0 24 24" width="14" height="14"><path d="M12 21s-6.716-4.507-9.193-7.02C.78 11.947.5 9.167 2.21 7.457a4.5 4.5 0 0 1 6.364 0L12 10.88l3.426-3.423a4.5 4.5 0 0 1 6.364 6.364C18.716 16.493 12 21 12 21z"/></svg>
              <b>1</b>
            </span>
          </div>
        </article>

        <article class="food-card">
          <div class="info">
            <h3 class="food-name">Tah-Chin Crispy Rice</h3>
            <p class="food-desc">Crispy rice bites, saffron shredded chicken, zereshk…</p>
            <div class="price">BD 3.500</div>
          </div>
          <div class="thumb">
            <img src="{{ asset('images/zz.png') }}" alt="Tah-Chin Crispy Rice">
            <span class="like-badge">
              <svg viewBox="0 0 24 24" width="14" height="14"><path d="M12 21s-6.716-4.507-9.193-7.02C.78 11.947.5 9.167 2.21 7.457a4.5 4.5 0 0 1 6.364 0L12 10.88l3.426-3.423a4.5 4.5 0 0 1 6.364 6.364C18.716 16.493 12 21 12 21z"/></svg>
              <b>1</b>
            </span>
          </div>
        </article>

        <!-- Card 5 -->
        <article class="food-card">
          <div class="info">
            <h3 class="food-name">Avo Hallo</h3>
            <p class="food-desc">Mixed garden lettuce, avocado, cherry tomatoes, crispy rice…</p>
            <div class="price">BD 5.400</div>
          </div>
          <div class="thumb">
            <img src="{{ asset('images/zz.png') }}" alt="Avo Hallo">
            <span class="like-badge">
              <svg viewBox="0 0 24 24" width="14" height="14"><path d="M12 21s-6.716-4.507-9.193-7.02C.78 11.947.5 9.167 2.21 7.457a4.5 4.5 0 0 1 6.364 0L12 10.88l3.426-3.423a4.5 4.5 0 0 1 6.364 6.364C18.716 16.493 12 21 12 21z"/></svg>
              <b>1</b>
            </span>
          </div>
        </article>
      </div>
    </section>

    <!-- Food Details Modal -->
    <div id="food-modal" class="modal" aria-hidden="true">
      <div class="modal-backdrop" data-close="true"></div>

      <div class="modal-dialog" role="dialog" aria-modal="true" aria-labelledby="modal-title">
        <button class="modal-close" aria-label="Close" data-close="true">×</button>

        <div class="modal-content">
          <div class="modal-thumb">
            <img id="modal-img" src="{{ asset('images/zz.png') }}" alt="">
          </div>
          <div class="modal-info">
            <h3 id="modal-title" class="modal-name">Dish name</h3>
            <p id="modal-desc" class="modal-desc">Full description</p>
            <div id="modal-price" class="modal-price">BD 0.000</div>
          </div>
        </div>
      </div>
    </div>

  </div>

</body>

<script src="{{ asset('js/menu.js') }}" defer></script>

</html>
