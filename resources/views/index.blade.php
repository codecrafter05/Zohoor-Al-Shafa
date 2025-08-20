<!DOCTYPE html>
<html lang="en" dir="ltr">
  
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Primary SEO -->
  <title>FOOD MENU — Zohoor Al Shafa | Bahrain</title>
  <meta name="description" content="Discover refined Middle Eastern & Jordanian dishes at Zohoor Al Shafa in Bahrain. All-day dining menu: mezze, salads, buns & toasts, big eats and sides — crafted with premium ingredients.">
  <meta name="keywords" content="Zohoor Al Shafa, Jordanian cuisine, Arabic restaurant Bahrain, Middle Eastern food, mezze, mansaf, salads, fries, club salads, small eats, big eats">
  <link rel="canonical" href="{{ url()->current() }}">
  <meta name="robots" content="index, follow, max-image-preview:large">
  <meta name="theme-color" content="#472257">

  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="FOOD MENU — Zohoor Al Shafa">
  <meta property="og:description" content="Refined Middle Eastern & Jordanian dishes — all day from 11:30 AM to 11:30 PM.">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:image" content="{{ asset('images/og-cover.jpg') }}">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:site_name" content="Zohoor Al Shafa">
  <meta property="og:locale" content="en">

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="FOOD MENU — Zohoor Al Shafa">
  <meta name="twitter:description" content="Refined Middle Eastern & Jordanian dishes — all day from 11:30 AM to 11:30 PM.">
  <meta name="twitter:image" content="{{ asset('images/og-cover.jpg') }}">

  <!-- Icons (local) -->
  <link rel="icon" href="{{ asset('1.pdf.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icons/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icons/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('icons/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('site.webmanifest') }}">

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
        <!-- language toggle -->
        <button class="icon-btn language-toggle" id="language-toggle" aria-label="Toggle Language" title="تغيير اللغة / Change Language">
  <svg viewBox="0 0 24 24" width="26" height="26" aria-hidden="true">
    <path d="M12.87 15.07l-2.54-2.51.03-.03c1.74-1.94 2.01-4.65.83-6.99l2.53 2.53c.39.39.39 1.02 0 1.41z"/>
    <path fill="currentColor" d="M10 2a8 8 0 100 16 8 8 0 000-16zm6.32 5h-2.54a11.4 11.4 0 00-1.12-3.07A6.02 6.02 0 0116.32 7zM10 4c.63.9 1.15 2 1.46 3H8.54C8.85 6 9.37 4.9 10 4zM4.55 12a6.04 6.04 0 010-4h2.33a13 13 0 000 4H4.55zm1.13 2h2.54c.31 1.07.83 2.17 1.46 3a6.02 6.02 0 01-4-3zm0-8a6.02 6.02 0 014-3c-.63.83-1.15 1.93-1.46 3H5.68zm5 11c-.63-.9-1.15-2-1.46-3h2.92c-.31 1-0.83 2.1-1.46 3zm1.92-5a13 13 0 000-4h2.33a6.04 6.04 0 010 4h-2.33zm-4.38 0a11.4 11.4 0 01-1.12-3h4.58a11.4 11.4 0 01-1.12 3H8.54zm1.46 5a8 8 0 110-16 8 8 0 010 16z"/>
  </svg>
          <span class="lang-indicator">EN</span>
        </button>
      </div>
    </header>

    <!-- Category Tabs -->
    <nav class="tabs-wrap">
      <div class="tabs-scroll">
        <button class="tab active" data-target="#most-liked"><span class="heart">❤</span> Most Liked</button>
        <!-- Dynamic content will be loaded here -->
      </div>
    </nav>

    <!-- Section -->
    <section id="most-liked" class="section">
      <h2 class="section-title"><span class="heart">❤</span> Most Liked <span class="heart">❤</span></h2>
      <p class="section-sub">According to real guest likes</p>

      <!-- Cards Grid -->
      <div class="cards-grid">
        <!-- Dynamic content will be loaded here -->
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
