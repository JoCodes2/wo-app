<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar WO — PaluWedding</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,500&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            display: ['"Playfair Display"', 'serif'],
            body: ['"DM Sans"', 'sans-serif'],
          },
        }
      }
    }
  </script>
  <style>
    :root {
      --rose: #a03d32;
      --rose-light: #c45e50;
      --rose-50: #fce8e8;
      --cream: #fdf8f5;
      --parchment: #f5ede6;
      --border: #f0ddd8;
    }

    * { box-sizing: border-box; }
    body { font-family: 'DM Sans', sans-serif; background: var(--cream); color: #1a1a1a; }

    /* NAV */
    .nav-link { position: relative; transition: color .2s; }
    .nav-link::after { content: ''; position: absolute; bottom: -2px; left: 0; width: 0; height: 1.5px; background: var(--rose); transition: width .25s; }
    .nav-link:hover::after, .nav-link.active::after { width: 100%; }

    /* SEARCH BAR */
    .search-wrap {
      background: white;
      border-radius: 16px;
      border: 1.5px solid var(--border);
      box-shadow: 0 4px 20px rgba(160,61,50,.08);
      transition: box-shadow .2s, border-color .2s;
    }
    .search-wrap:focus-within {
      border-color: var(--rose);
      box-shadow: 0 4px 24px rgba(160,61,50,.16);
    }
    .search-input { outline: none; background: transparent; width: 100%; font-family: 'DM Sans', sans-serif; }

    /* FILTER SIDEBAR */
    .sidebar { background: white; border-radius: 20px; border: 1px solid var(--border); }

    /* PRICE RANGE SLIDER */
    .slider-thumb { -webkit-appearance: none; appearance: none; height: 6px; border-radius: 99px; background: linear-gradient(to right, var(--rose) 0%, var(--rose) var(--val, 50%), #e8d5d0 var(--val, 50%), #e8d5d0 100%); outline: none; cursor: pointer; }
    .slider-thumb::-webkit-slider-thumb { -webkit-appearance: none; width: 20px; height: 20px; border-radius: 50%; background: var(--rose); border: 3px solid white; box-shadow: 0 2px 8px rgba(160,61,50,.3); cursor: pointer; }
    .slider-thumb::-moz-range-thumb { width: 20px; height: 20px; border-radius: 50%; background: var(--rose); border: 3px solid white; box-shadow: 0 2px 8px rgba(160,61,50,.3); cursor: pointer; }

    /* CATEGORY CHIPS */
    .cat-chip { cursor: pointer; border-radius: 12px; padding: 8px 16px; font-size: .82rem; font-weight: 500; border: 1.5px solid var(--border); background: white; color: #555; transition: all .2s; display: flex; align-items: center; gap: 6px; }
    .cat-chip:hover { border-color: var(--rose); color: var(--rose); background: var(--rose-50); }
    .cat-chip.active { border-color: var(--rose); background: var(--rose); color: white; }
    .cat-chip.active .chip-icon { filter: brightness(0) invert(1); }

    /* KECAMATAN CHECKBOX */
    .kec-label { display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: .84rem; color: #555; padding: 4px 0; }
    .kec-label input[type=checkbox] { width: 16px; height: 16px; accent-color: var(--rose); cursor: pointer; }
    .kec-label:hover { color: var(--rose); }

    /* WO CARD */
    .wo-card { background: white; border-radius: 20px; overflow: hidden; border: 1px solid var(--border); transition: transform .3s, box-shadow .3s; }
    .wo-card:hover { transform: translateY(-6px); box-shadow: 0 20px 48px rgba(160,61,50,.12); }
    .wo-card img { transition: transform .4s ease; }
    .wo-card:hover img { transform: scale(1.04); }

    .tag-pill { background: var(--rose-50); color: var(--rose); font-size: .68rem; font-weight: 600; padding: 3px 10px; border-radius: 999px; text-transform: uppercase; letter-spacing: .04em; }
    .tag-pill.outdoor { background: #e8f5e9; color: #2e7d32; }
    .tag-pill.indoor { background: #e3f2fd; color: #1565c0; }
    .tag-pill.modern { background: #f3e5f5; color: #6a1b9a; }
    .tag-pill.tradisional { background: #fff3e0; color: #e65100; }

    .btn-wa { background: #25D366; color: white; border-radius: 12px; padding: 8px 16px; font-size: .8rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; transition: background .2s, transform .15s; white-space: nowrap; }
    .btn-wa:hover { background: #1fba58; transform: translateY(-1px); }

    .btn-detail { background: white; color: var(--rose); border: 1.5px solid var(--rose); border-radius: 12px; padding: 8px 16px; font-size: .8rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; transition: all .2s; white-space: nowrap; }
    .btn-detail:hover { background: var(--rose); color: white; }

    /* SORT DROPDOWN */
    .sort-select { background: white; border: 1.5px solid var(--border); border-radius: 12px; padding: 8px 14px; font-size: .83rem; font-family: 'DM Sans', sans-serif; color: #444; outline: none; cursor: pointer; }
    .sort-select:focus { border-color: var(--rose); }

    /* BADGE */
    .verified-badge { background: #e8f5e9; color: #2e7d32; font-size: .68rem; font-weight: 700; padding: 2px 8px; border-radius: 999px; display: inline-flex; align-items: center; gap: 3px; }

    /* NO RESULT */
    .no-result { display: none; text-align: center; padding: 60px 20px; }
    .no-result.show { display: block; }

    /* MOBILE FILTER DRAWER */
    .filter-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.45); z-index: 40; }
    .filter-drawer { position: fixed; bottom: 0; left: 0; right: 0; background: white; border-radius: 24px 24px 0 0; z-index: 50; max-height: 85vh; overflow-y: auto; padding: 24px 20px; transform: translateY(100%); transition: transform .35s cubic-bezier(.4,0,.2,1); }
    .filter-drawer.open { transform: translateY(0); }
    .drawer-handle { width: 40px; height: 4px; background: #ddd; border-radius: 99px; margin: 0 auto 20px; }

    /* MOBILE NAV MENU */
    .mobile-menu { position: fixed; top: 0; right: -100%; width: 280px; height: 100%; background: white; z-index: 50; transition: right .35s ease; padding: 2rem 1.5rem; box-shadow: -4px 0 30px rgba(0,0,0,.1); }
    .mobile-menu.open { right: 0; }
    .mobile-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.4); z-index: 40; }

    /* RATING STARS */
    .stars { color: #d97706; letter-spacing: 1px; }

    /* PAGINATION */
    .page-btn { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: .84rem; font-weight: 500; border: 1.5px solid var(--border); background: white; cursor: pointer; transition: all .2s; }
    .page-btn:hover, .page-btn.active { background: var(--rose); color: white; border-color: var(--rose); }

    /* SCROLL TOP */
    .scroll-top { position: fixed; bottom: 24px; right: 24px; width: 44px; height: 44px; background: var(--rose); border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 4px 14px rgba(160,61,50,.4); opacity: 0; transform: translateY(10px); transition: opacity .3s, transform .3s; z-index: 99; }
    .scroll-top.show { opacity: 1; transform: translateY(0); }

    /* SECTION FADE */
    .fade-in { opacity: 0; transform: translateY(20px); transition: opacity .5s ease, transform .5s ease; }
    .fade-in.visible { opacity: 1; transform: translateY(0); }

    /* ACTIVE FILTERS */
    .active-filter-tag { background: var(--rose-50); color: var(--rose); border: 1px solid #f2aaaa; border-radius: 999px; font-size: .75rem; font-weight: 500; padding: 4px 12px; display: inline-flex; align-items: center; gap: 6px; }
    .active-filter-tag button { background: none; border: none; cursor: pointer; color: var(--rose); font-size: 1rem; line-height: 1; padding: 0; }
  </style>
</head>
<body>

  <!-- ===== NAVBAR ===== -->
  <nav style="background: rgba(255,255,255,.92); border-bottom: 1px solid var(--border);" class="sticky top-0 z-30 backdrop-blur-md shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 flex items-center justify-between h-16">
      <a href="paluwedding.html" class="flex items-center gap-2">
        <span class="text-2xl">💗</span>
        <div>
          <span class="font-display text-lg font-semibold"><span class="text-gray-900">Palu</span><span style="color:var(--rose)">Wedding</span></span>
          <p class="text-[10px] text-gray-400 tracking-widest uppercase leading-none">Wedding Organizer Hub</p>
        </div>
      </a>
      <div class="hidden md:flex items-center gap-8">
        <a href="paluwedding.html" class="nav-link text-sm font-medium text-gray-600 hover:text-rose-700">Beranda</a>
        <a href="#" class="nav-link active text-sm font-medium" style="color:var(--rose)">Daftar WO</a>
      </div>
      <div class="hidden md:flex items-center gap-3">
        <a href="#" class="text-sm font-medium text-gray-600 hover:text-rose-700 transition-colors px-3 py-2">Masuk</a>
        <a href="#" class="text-sm font-semibold text-white px-5 py-2 rounded-xl shadow-sm" style="background:var(--rose)">Daftar</a>
      </div>
      <button id="hamburger" class="md:hidden p-2 rounded-lg hover:bg-rose-50 transition-colors">
        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
      </button>
    </div>
  </nav>

  <!-- Mobile Menu -->
  <div class="mobile-overlay" id="mobileOverlay"></div>
  <div class="mobile-menu" id="mobileMenu">
    <div class="flex items-center justify-between mb-8">
      <span class="font-display text-lg font-semibold"><span class="text-gray-900">Palu</span><span style="color:var(--rose)">Wedding</span></span>
      <button id="closeMenu" class="p-2 rounded-lg hover:bg-rose-50">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <div class="flex flex-col gap-1">
      <a href="paluwedding.html" class="py-3 px-4 rounded-xl text-sm font-medium text-gray-600 hover:bg-rose-50 transition-colors">Beranda</a>
      <a href="#" class="py-3 px-4 rounded-xl text-sm font-medium" style="background:var(--rose-50);color:var(--rose)">Daftar WO</a>
    </div>
    <div class="mt-6 flex flex-col gap-3">
      <a href="#" class="py-3 px-4 rounded-xl text-sm font-medium text-gray-700 border border-gray-200 text-center hover:border-rose-400 transition-colors">Masuk</a>
      <a href="#" class="py-3 px-4 rounded-xl text-sm font-semibold text-white text-center shadow-sm" style="background:var(--rose)">Daftar</a>
    </div>
  </div>

  <!-- ===== PAGE HEADER ===== -->
  <div style="background: linear-gradient(135deg, #fce8e8 0%, #fdf5f5 60%, #fce4d6 100%); border-bottom: 1px solid var(--border);" class="py-10 sm:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
      <div class="mb-2">
        <span class="text-xs text-gray-400 font-medium">Beranda / <span style="color:var(--rose)">Daftar WO</span></span>
      </div>
      <h1 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mb-2">Daftar Wedding Organizer</h1>
      <p class="text-gray-500 text-sm sm:text-base mb-7">Temukan WO terbaik di Kota Palu — terverifikasi, transparan, dan siap melayani hari spesial Anda.</p>

      <!-- SEARCH BAR -->
      <div class="search-wrap flex items-center gap-3 px-4 py-3 max-w-2xl">
        <svg class="w-5 h-5 flex-shrink-0" style="color:var(--rose)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
        <input id="searchInput" class="search-input text-sm text-gray-700 placeholder-gray-400" placeholder="Cari nama WO, lokasi kecamatan..."/>
        <button id="clearSearch" class="hidden p-1 rounded-full hover:bg-rose-50 transition-colors flex-shrink-0">
          <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>
    </div>
  </div>

  <!-- ===== MAIN CONTENT ===== -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
    <div class="flex gap-7">

      <!-- ===== SIDEBAR FILTER (Desktop) ===== -->
      <aside class="hidden lg:block w-72 flex-shrink-0">
        <div class="sidebar p-6 sticky top-24">
          <div class="flex items-center justify-between mb-6">
            <h2 class="font-display font-semibold text-gray-900 text-lg">Filter</h2>
            <button id="resetFilter" class="text-xs font-medium hover:underline" style="color:var(--rose)">Reset semua</button>
          </div>

          <!-- KATEGORI FASILITAS -->
          <div class="mb-7">
            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-3">Kategori Fasilitas</h3>
            <div class="grid grid-cols-2 gap-2">
              <button class="cat-chip" data-cat="outdoor">
                <span class="chip-icon">🌿</span> Outdoor
              </button>
              <button class="cat-chip" data-cat="indoor">
                <span class="chip-icon">🏛️</span> Indoor
              </button>
              <button class="cat-chip" data-cat="modern">
                <span class="chip-icon">✨</span> Modern
              </button>
              <button class="cat-chip" data-cat="tradisional">
                <span class="chip-icon">🪆</span> Tradisional
              </button>
            </div>
          </div>

          <div style="height:1px; background: linear-gradient(to right, transparent, var(--border), transparent);" class="mb-7"></div>

          <!-- HARGA RANGE -->
          <div class="mb-7">
            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-4">Rentang Harga</h3>
            <div class="flex justify-between text-xs text-gray-500 mb-2">
              <span>Rp <span id="minPriceLabel">0</span> jt</span>
              <span>Rp <span id="maxPriceLabel">100</span> jt</span>
            </div>
            <input type="range" id="priceMin" class="slider-thumb w-full mb-3" min="0" max="100" value="0" step="5"/>
            <input type="range" id="priceMax" class="slider-thumb w-full" min="0" max="100" value="100" step="5"/>
            <div class="flex justify-between mt-3">
              <div class="bg-rose-50 rounded-xl px-3 py-2 text-xs font-semibold" style="color:var(--rose)">Min: Rp <span id="minPriceVal">0</span> jt</div>
              <div class="bg-rose-50 rounded-xl px-3 py-2 text-xs font-semibold" style="color:var(--rose)">Maks: Rp <span id="maxPriceVal">100</span> jt</div>
            </div>
          </div>

          <div style="height:1px; background: linear-gradient(to right, transparent, var(--border), transparent);" class="mb-7"></div>

          <!-- KECAMATAN -->
          <div class="mb-6">
            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-3">Kecamatan</h3>
            <div class="flex flex-col gap-1">
              <label class="kec-label"><input type="checkbox" class="kec-cb" value="Palu Barat"> Palu Barat</label>
              <label class="kec-label"><input type="checkbox" class="kec-cb" value="Palu Timur"> Palu Timur</label>
              <label class="kec-label"><input type="checkbox" class="kec-cb" value="Palu Selatan"> Palu Selatan</label>
              <label class="kec-label"><input type="checkbox" class="kec-cb" value="Palu Utara"> Palu Utara</label>
              <label class="kec-label"><input type="checkbox" class="kec-cb" value="Mantikulore"> Mantikulore</label>
              <label class="kec-label"><input type="checkbox" class="kec-cb" value="Tatanga"> Tatanga</label>
              <label class="kec-label"><input type="checkbox" class="kec-cb" value="Ulujadi"> Ulujadi</label>
              <label class="kec-label"><input type="checkbox" class="kec-cb" value="Tawaeli"> Tawaeli</label>
            </div>
          </div>

          <div style="height:1px; background: linear-gradient(to right, transparent, var(--border), transparent);" class="mb-7"></div>

          <!-- RATING -->
          <div>
            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-3">Rating Minimum</h3>
            <div class="flex gap-2 flex-wrap">
              <button class="rating-btn page-btn text-xs" data-rating="0">Semua</button>
              <button class="rating-btn page-btn text-xs" data-rating="4">4+★</button>
              <button class="rating-btn page-btn text-xs" data-rating="4.5">4.5+★</button>
              <button class="rating-btn page-btn text-xs" data-rating="4.8">4.8+★</button>
            </div>
          </div>

          <button id="applyFilter" class="mt-6 w-full py-3 rounded-2xl text-sm font-semibold text-white shadow-sm transition-all hover:opacity-90" style="background:var(--rose)">
            Terapkan Filter
          </button>
        </div>
      </aside>

      <!-- ===== RIGHT CONTENT ===== -->
      <div class="flex-1 min-w-0">

        <!-- TOP BAR: result count + sort + mobile filter btn -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
          <div>
            <p class="text-sm text-gray-500">Menampilkan <span id="resultCount" class="font-semibold" style="color:var(--rose)">9</span> Wedding Organizer</p>
            <!-- Active filter tags -->
            <div id="activeFilters" class="flex flex-wrap gap-2 mt-2"></div>
          </div>
          <div class="flex items-center gap-3">
            <select id="sortSelect" class="sort-select">
              <option value="rating">Urutkan: Rating Tertinggi</option>
              <option value="price-asc">Harga: Terendah</option>
              <option value="price-desc">Harga: Tertinggi</option>
              <option value="name">Nama A–Z</option>
            </select>
            <!-- Mobile filter button -->
            <button id="openFilterDrawer" class="lg:hidden flex items-center gap-2 px-4 py-2 rounded-xl border text-sm font-medium" style="border-color:var(--border);background:white;color:var(--rose)">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/></svg>
              Filter
            </button>
          </div>
        </div>

        <!-- CATEGORY CHIPS (Mobile + Desktop quick filter) -->
        <div class="flex gap-2 flex-wrap mb-6">
          <button class="cat-chip active" data-cat="all">🎊 Semua</button>
          <button class="cat-chip" data-cat="outdoor">🌿 Outdoor</button>
          <button class="cat-chip" data-cat="indoor">🏛️ Indoor</button>
          <button class="cat-chip" data-cat="modern">✨ Modern</button>
          <button class="cat-chip" data-cat="tradisional">🪆 Tradisional</button>
        </div>

        <!-- WO CARDS GRID -->
        <div id="woGrid" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

          <!-- Card data injected by JS -->

        </div>

        <!-- NO RESULT -->
        <div id="noResult" class="no-result">
          <div class="text-5xl mb-4">💔</div>
          <h3 class="font-display text-xl font-semibold text-gray-800 mb-2">WO Tidak Ditemukan</h3>
          <p class="text-gray-500 text-sm">Coba ubah kata kunci, filter harga, atau kategori pencarian.</p>
          <button id="resetAll" class="mt-5 px-6 py-2.5 rounded-xl text-sm font-semibold text-white" style="background:var(--rose)">Reset Semua Filter</button>
        </div>

        <!-- PAGINATION -->
        <div id="pagination" class="flex items-center justify-center gap-2 mt-10">
          <button class="page-btn">←</button>
          <button class="page-btn active">1</button>
          <button class="page-btn">2</button>
          <button class="page-btn">3</button>
          <button class="page-btn">→</button>
        </div>

      </div>
    </div>
  </div>

  <!-- ===== MOBILE FILTER DRAWER ===== -->
  <div class="filter-overlay" id="filterOverlay"></div>
  <div class="filter-drawer" id="filterDrawer">
    <div class="drawer-handle"></div>
    <div class="flex items-center justify-between mb-6">
      <h2 class="font-display font-semibold text-gray-900 text-lg">Filter</h2>
      <button id="closeDrawer" class="p-2 rounded-lg hover:bg-rose-50">
        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>

    <!-- Category -->
    <div class="mb-6">
      <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-3">Kategori Fasilitas</h3>
      <div class="grid grid-cols-2 gap-2">
        <button class="cat-chip" data-cat="outdoor">🌿 Outdoor</button>
        <button class="cat-chip" data-cat="indoor">🏛️ Indoor</button>
        <button class="cat-chip" data-cat="modern">✨ Modern</button>
        <button class="cat-chip" data-cat="tradisional">🪆 Tradisional</button>
      </div>
    </div>

    <!-- Price -->
    <div class="mb-6">
      <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-3">Rentang Harga</h3>
      <div class="flex justify-between text-xs text-gray-500 mb-2">
        <span>Rp <span id="mMinLbl">0</span> jt</span>
        <span>Rp <span id="mMaxLbl">100</span> jt</span>
      </div>
      <input type="range" id="mPriceMin" class="slider-thumb w-full mb-3" min="0" max="100" value="0" step="5"/>
      <input type="range" id="mPriceMax" class="slider-thumb w-full" min="0" max="100" value="100" step="5"/>
    </div>

    <!-- Kecamatan -->
    <div class="mb-6">
      <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-3">Kecamatan</h3>
      <div class="grid grid-cols-2 gap-1">
        <label class="kec-label"><input type="checkbox" class="kec-cb-m" value="Palu Barat"> Palu Barat</label>
        <label class="kec-label"><input type="checkbox" class="kec-cb-m" value="Palu Timur"> Palu Timur</label>
        <label class="kec-label"><input type="checkbox" class="kec-cb-m" value="Palu Selatan"> Palu Selatan</label>
        <label class="kec-label"><input type="checkbox" class="kec-cb-m" value="Palu Utara"> Palu Utara</label>
        <label class="kec-label"><input type="checkbox" class="kec-cb-m" value="Mantikulore"> Mantikulore</label>
        <label class="kec-label"><input type="checkbox" class="kec-cb-m" value="Tatanga"> Tatanga</label>
        <label class="kec-label"><input type="checkbox" class="kec-cb-m" value="Ulujadi"> Ulujadi</label>
        <label class="kec-label"><input type="checkbox" class="kec-cb-m" value="Tawaeli"> Tawaeli</label>
      </div>
    </div>

    <div class="flex gap-3">
      <button id="resetDrawer" class="flex-1 py-3 rounded-2xl text-sm font-semibold border" style="border-color:var(--rose);color:var(--rose)">Reset</button>
      <button id="applyDrawer" class="flex-1 py-3 rounded-2xl text-sm font-semibold text-white" style="background:var(--rose)">Terapkan</button>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="bg-white border-t py-8 mt-10" style="border-color:var(--border)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 flex flex-col sm:flex-row items-center justify-between gap-3">
      <div class="flex items-center gap-2 text-sm text-gray-600">
        <span style="color:var(--rose)">♥</span>
        <span class="font-semibold font-display"><span class="text-gray-900">Palu</span><span style="color:var(--rose)">Wedding</span></span>
        <span class="text-gray-400">— Temukan Wedding Organizer terbaik di Kota Palu.</span>
      </div>
      <p class="text-xs text-gray-400">© 2026 PaluWedding. Semua hak dilindungi.</p>
    </div>
  </footer>

  <!-- Scroll to top -->
  <div class="scroll-top" id="scrollTop" onclick="window.scrollTo({top:0,behavior:'smooth'})">
    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
  </div>

<script>
// ===== DATA =====
const woData = [
  {
    id: 1,
    name: "Elegan Bridal Palu",
    kecamatan: "Palu Barat",
    categories: ["outdoor", "tradisional"],
    price: 15,
    rating: 4.9,
    reviews: 47,
    description: "Spesialis pernikahan adat Kaili dengan dekorasi elegan. Tim profesional berpengalaman 10+ tahun.",
    img: "https://images.unsplash.com/photo-1519741497674-611481863552?w=500&q=80",
    wa: "628112345001",
    verified: true,
    capacity: "200–500 tamu"
  },
  {
    id: 2,
    name: "Mutiara Wedding",
    kecamatan: "Palu Timur",
    categories: ["indoor", "modern"],
    price: 22,
    rating: 4.8,
    reviews: 39,
    description: "Paket lengkap gedung mewah, dekorasi modern minimalis, catering & dokumentasi premium.",
    img: "https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=500&q=80",
    wa: "628112345002",
    verified: true,
    capacity: "300–1000 tamu"
  },
  {
    id: 3,
    name: "Sakura Organizer",
    kecamatan: "Mantikulore",
    categories: ["outdoor", "modern"],
    price: 12,
    rating: 4.7,
    reviews: 28,
    description: "Pernikahan taman bergaya rustic & bohemian dengan dekorasi bunga segar lokal pilihan.",
    img: "https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=500&q=80",
    wa: "628112345003",
    verified: true,
    capacity: "100–300 tamu"
  },
  {
    id: 4,
    name: "Harmoni Wedding",
    kecamatan: "Palu Selatan",
    categories: ["indoor", "tradisional"],
    price: 18,
    rating: 4.6,
    reviews: 22,
    description: "Menghadirkan nuansa tradisional Sulawesi Tengah dalam balutan dekorasi hangat dan autentik.",
    img: "https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=500&q=80",
    wa: "628112345004",
    verified: true,
    capacity: "150–400 tamu"
  },
  {
    id: 5,
    name: "Blossom Event Organizer",
    kecamatan: "Tatanga",
    categories: ["outdoor", "modern"],
    price: 9,
    rating: 4.5,
    reviews: 19,
    description: "Paket hemat untuk pernikahan outdoor dengan konsep minimalis dan dekorasi fresh flowers.",
    img: "https://images.unsplash.com/photo-1429586054347-c7a0c3f2e014?w=500&q=80",
    wa: "628112345005",
    verified: false,
    capacity: "50–200 tamu"
  },
  {
    id: 6,
    name: "Grand Palu Wedding",
    kecamatan: "Palu Utara",
    categories: ["indoor", "modern"],
    price: 45,
    rating: 4.9,
    reviews: 61,
    description: "Venue premium dengan ballroom mewah, tim berpengalaman, dan layanan wedding planner eksklusif.",
    img: "https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=500&q=80",
    wa: "628112345006",
    verified: true,
    capacity: "500–2000 tamu"
  },
  {
    id: 7,
    name: "Kaili Cultural Wedding",
    kecamatan: "Ulujadi",
    categories: ["outdoor", "tradisional"],
    price: 20,
    rating: 4.7,
    reviews: 33,
    description: "Spesialis upacara adat Kaili lengkap dengan prosesi Nosarara, kostum adat, dan gamelan tradisional.",
    img: "https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=500&q=80",
    wa: "628112345007",
    verified: true,
    capacity: "100–350 tamu"
  },
  {
    id: 8,
    name: "Cinta Abadi Organizer",
    kecamatan: "Tawaeli",
    categories: ["indoor", "tradisional"],
    price: 14,
    rating: 4.4,
    reviews: 16,
    description: "Mewujudkan pernikahan impian dengan sentuhan tradisional yang hangat dan paket all-in terjangkau.",
    img: "https://images.unsplash.com/photo-1474552226712-ac0f0961a954?w=500&q=80",
    wa: "628112345008",
    verified: false,
    capacity: "100–300 tamu"
  },
  {
    id: 9,
    name: "Palu Prestige Events",
    kecamatan: "Palu Barat",
    categories: ["indoor", "modern", "outdoor"],
    price: 55,
    rating: 4.9,
    reviews: 74,
    description: "One-stop wedding solution: venue indoor & outdoor, catering bintang lima, dokumentasi sinematik.",
    img: "https://images.unsplash.com/photo-1520854221256-17451cc331bf?w=500&q=80",
    wa: "628112345009",
    verified: true,
    capacity: "200–1500 tamu"
  },
];

// ===== STATE =====
let state = {
  search: '',
  categories: [],
  minPrice: 0,
  maxPrice: 100,
  kecamatan: [],
  minRating: 0,
  sort: 'rating',
};

// ===== RENDER =====
function renderCards(data) {
  const grid = document.getElementById('woGrid');
  const noResult = document.getElementById('noResult');
  const pagination = document.getElementById('pagination');
  const countEl = document.getElementById('resultCount');
  countEl.textContent = data.length;

  if (data.length === 0) {
    grid.innerHTML = '';
    noResult.classList.add('show');
    pagination.style.display = 'none';
    return;
  }
  noResult.classList.remove('show');
  pagination.style.display = 'flex';

  grid.innerHTML = data.map((wo, i) => `
    <div class="wo-card fade-in" style="animation-delay:${i * 0.07}s">
      <div class="relative overflow-hidden" style="height:200px">
        <img src="${wo.img}" alt="${wo.name}" class="w-full h-full object-cover"/>
        <div class="absolute top-3 left-3 flex flex-wrap gap-1">
          ${wo.categories.map(c => `<span class="tag-pill ${c}">${catLabel(c)}</span>`).join('')}
        </div>
        ${wo.verified ? `<div class="absolute top-3 right-3 verified-badge">✓ Verified</div>` : ''}
      </div>
      <div class="p-5">
        <div class="flex items-start justify-between gap-2 mb-1">
          <h3 class="font-display font-semibold text-gray-900 text-lg leading-snug">${wo.name}</h3>
          <div class="flex items-center gap-1 flex-shrink-0">
            <span class="stars text-sm">★</span>
            <span class="text-sm font-semibold text-gray-800">${wo.rating}</span>
            <span class="text-xs text-gray-400">(${wo.reviews})</span>
          </div>
        </div>
        <p class="text-xs text-gray-400 mb-3 flex items-center gap-1">
          <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9z"/></svg>
          ${wo.kecamatan}
          <span class="mx-1 text-gray-300">·</span>
          <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          ${wo.capacity}
        </p>
        <p class="text-gray-500 text-sm leading-relaxed mb-4">${wo.description}</p>
        <div class="flex items-center justify-between pt-4" style="border-top:1px solid #f0ddd8">
          <div>
            <p class="text-xs text-gray-400">Mulai dari</p>
            <p class="font-display font-bold text-lg" style="color:var(--rose)">Rp ${wo.price} jt</p>
          </div>
          <div class="flex gap-2">
            <a href="#" class="btn-detail">Detail</a>
            <a href="https://wa.me/${wo.wa}" target="_blank" class="btn-wa">
              <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M11.999 1C5.93 1 1 5.93 1 12c0 1.957.505 3.793 1.39 5.394L1 23l5.742-1.375A10.944 10.944 0 0012 23c6.07 0 11-4.93 11-11S18.069 1 11.999 1z"/></svg>
              WA
            </a>
          </div>
        </div>
      </div>
    </div>
  `).join('');

  // Re-observe new cards
  document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));
}

function catLabel(cat) {
  const map = { outdoor:'🌿 Outdoor', indoor:'🏛️ Indoor', modern:'✨ Modern', tradisional:'🪆 Tradisional' };
  return map[cat] || cat;
}

function applyFilters() {
  let filtered = [...woData];

  // Search
  if (state.search) {
    const q = state.search.toLowerCase();
    filtered = filtered.filter(w => w.name.toLowerCase().includes(q) || w.kecamatan.toLowerCase().includes(q));
  }

  // Categories
  if (state.categories.length > 0) {
    filtered = filtered.filter(w => state.categories.every(c => w.categories.includes(c)));
  }

  // Price
  filtered = filtered.filter(w => w.price >= state.minPrice && w.price <= state.maxPrice);

  // Kecamatan
  if (state.kecamatan.length > 0) {
    filtered = filtered.filter(w => state.kecamatan.includes(w.kecamatan));
  }

  // Rating
  if (state.minRating > 0) {
    filtered = filtered.filter(w => w.rating >= state.minRating);
  }

  // Sort
  if (state.sort === 'rating') filtered.sort((a, b) => b.rating - a.rating);
  else if (state.sort === 'price-asc') filtered.sort((a, b) => a.price - b.price);
  else if (state.sort === 'price-desc') filtered.sort((a, b) => b.price - a.price);
  else if (state.sort === 'name') filtered.sort((a, b) => a.name.localeCompare(b.name));

  renderCards(filtered);
  renderActiveFilters();
}

function renderActiveFilters() {
  const container = document.getElementById('activeFilters');
  const tags = [];

  if (state.categories.length > 0) {
    state.categories.forEach(c => {
      tags.push(`<span class="active-filter-tag">${catLabel(c)} <button onclick="removeCategory('${c}')">×</button></span>`);
    });
  }
  if (state.minPrice > 0 || state.maxPrice < 100) {
    tags.push(`<span class="active-filter-tag">Harga: Rp ${state.minPrice}–${state.maxPrice} jt <button onclick="resetPrice()">×</button></span>`);
  }
  state.kecamatan.forEach(k => {
    tags.push(`<span class="active-filter-tag">${k} <button onclick="removeKec('${k}')">×</button></span>`);
  });

  container.innerHTML = tags.join('');
}

window.removeCategory = function(cat) {
  state.categories = state.categories.filter(c => c !== cat);
  document.querySelectorAll(`.cat-chip[data-cat="${cat}"]`).forEach(b => b.classList.remove('active'));
  applyFilters();
};
window.removeKec = function(kec) {
  state.kecamatan = state.kecamatan.filter(k => k !== kec);
  document.querySelectorAll('.kec-cb, .kec-cb-m').forEach(cb => {
    if (cb.value === kec) cb.checked = false;
  });
  applyFilters();
};
window.resetPrice = function() {
  state.minPrice = 0; state.maxPrice = 100;
  document.getElementById('priceMin').value = 0;
  document.getElementById('priceMax').value = 100;
  updatePriceUI();
  applyFilters();
};

// ===== PRICE SLIDERS =====
function updatePriceUI() {
  const min = parseInt(document.getElementById('priceMin').value);
  const max = parseInt(document.getElementById('priceMax').value);
  document.getElementById('minPriceLabel').textContent = min;
  document.getElementById('maxPriceLabel').textContent = max;
  document.getElementById('minPriceVal').textContent = min;
  document.getElementById('maxPriceVal').textContent = max;
  // Update slider gradient
  const minPct = (min / 100) * 100;
  const maxPct = (max / 100) * 100;
  document.getElementById('priceMin').style.setProperty('--val', minPct + '%');
  document.getElementById('priceMax').style.setProperty('--val', maxPct + '%');
}

document.getElementById('priceMin').addEventListener('input', function() {
  if (parseInt(this.value) > parseInt(document.getElementById('priceMax').value)) this.value = document.getElementById('priceMax').value;
  state.minPrice = parseInt(this.value);
  updatePriceUI();
});
document.getElementById('priceMax').addEventListener('input', function() {
  if (parseInt(this.value) < parseInt(document.getElementById('priceMin').value)) this.value = document.getElementById('priceMin').value;
  state.maxPrice = parseInt(this.value);
  updatePriceUI();
});

// Mobile sliders
document.getElementById('mPriceMin').addEventListener('input', function() {
  state.minPrice = parseInt(this.value);
  document.getElementById('mMinLbl').textContent = this.value;
});
document.getElementById('mPriceMax').addEventListener('input', function() {
  state.maxPrice = parseInt(this.value);
  document.getElementById('mMaxLbl').textContent = this.value;
});

// ===== CATEGORY CHIPS =====
document.querySelectorAll('.cat-chip').forEach(btn => {
  btn.addEventListener('click', function() {
    const cat = this.dataset.cat;

    if (cat === 'all') {
      // Quick filter bar: deselect all, select all
      document.querySelectorAll('.cat-chip').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      state.categories = [];
      // Also deselect sidebar chips
      document.querySelectorAll('#filterDrawer .cat-chip, aside .cat-chip').forEach(b => b.classList.remove('active'));
      applyFilters();
      return;
    }

    // Toggle
    this.classList.toggle('active');

    // Sync same-cat chips across all areas
    const allSameCat = document.querySelectorAll(`.cat-chip[data-cat="${cat}"]`);
    const isActive = this.classList.contains('active');
    allSameCat.forEach(b => {
      if (isActive) b.classList.add('active');
      else b.classList.remove('active');
    });

    // Remove 'all' active if any specific is chosen
    document.querySelectorAll('.cat-chip[data-cat="all"]').forEach(b => b.classList.remove('active'));

    // Update state
    if (isActive) {
      if (!state.categories.includes(cat)) state.categories.push(cat);
    } else {
      state.categories = state.categories.filter(c => c !== cat);
    }

    applyFilters();
  });
});

// ===== KECAMATAN CHECKBOXES =====
document.querySelectorAll('.kec-cb, .kec-cb-m').forEach(cb => {
  cb.addEventListener('change', function() {
    const val = this.value;
    // Sync across desktop + mobile
    document.querySelectorAll('.kec-cb, .kec-cb-m').forEach(c => {
      if (c.value === val) c.checked = this.checked;
    });
    if (this.checked) {
      if (!state.kecamatan.includes(val)) state.kecamatan.push(val);
    } else {
      state.kecamatan = state.kecamatan.filter(k => k !== val);
    }
    applyFilters();
  });
});

// ===== RATING BUTTONS =====
document.querySelectorAll('.rating-btn').forEach(btn => {
  btn.addEventListener('click', function() {
    document.querySelectorAll('.rating-btn').forEach(b => b.classList.remove('active'));
    this.classList.add('active');
    state.minRating = parseFloat(this.dataset.rating);
    applyFilters();
  });
});

// ===== SEARCH =====
const searchInput = document.getElementById('searchInput');
const clearSearch = document.getElementById('clearSearch');

searchInput.addEventListener('input', function() {
  state.search = this.value.trim();
  clearSearch.classList.toggle('hidden', !state.search);
  applyFilters();
});
clearSearch.addEventListener('click', function() {
  searchInput.value = '';
  state.search = '';
  this.classList.add('hidden');
  applyFilters();
});

// ===== SORT =====
document.getElementById('sortSelect').addEventListener('change', function() {
  state.sort = this.value;
  applyFilters();
});

// ===== RESET =====
function resetAll() {
  state = { search:'', categories:[], minPrice:0, maxPrice:100, kecamatan:[], minRating:0, sort:'rating' };
  searchInput.value = '';
  clearSearch.classList.add('hidden');
  document.getElementById('sortSelect').value = 'rating';
  document.querySelectorAll('.cat-chip').forEach(b => b.classList.remove('active'));
  document.querySelector('.cat-chip[data-cat="all"]').classList.add('active');
  document.querySelectorAll('.kec-cb, .kec-cb-m').forEach(cb => cb.checked = false);
  document.getElementById('priceMin').value = 0;
  document.getElementById('priceMax').value = 100;
  document.getElementById('mPriceMin').value = 0;
  document.getElementById('mPriceMax').value = 100;
  document.getElementById('mMinLbl').textContent = 0;
  document.getElementById('mMaxLbl').textContent = 100;
  document.querySelectorAll('.rating-btn').forEach(b => b.classList.remove('active'));
  document.querySelector('.rating-btn[data-rating="0"]').classList.add('active');
  updatePriceUI();
  applyFilters();
}

document.getElementById('resetFilter').addEventListener('click', resetAll);
document.getElementById('resetDrawer').addEventListener('click', resetAll);
document.getElementById('resetAll').addEventListener('click', resetAll);
document.getElementById('applyFilter').addEventListener('click', applyFilters);
document.getElementById('applyDrawer').addEventListener('click', () => { closeDrawer(); applyFilters(); });

// ===== MOBILE MENU =====
const hamburger = document.getElementById('hamburger');
const mobileMenu = document.getElementById('mobileMenu');
const mobileOverlay = document.getElementById('mobileOverlay');
const closeMenu = document.getElementById('closeMenu');

hamburger.addEventListener('click', () => { mobileMenu.classList.add('open'); mobileOverlay.style.display='block'; document.body.style.overflow='hidden'; });
function closeMobileMenu() { mobileMenu.classList.remove('open'); mobileOverlay.style.display='none'; document.body.style.overflow=''; }
closeMenu.addEventListener('click', closeMobileMenu);
mobileOverlay.addEventListener('click', closeMobileMenu);

// ===== FILTER DRAWER =====
const openFilterBtn = document.getElementById('openFilterDrawer');
const filterDrawer = document.getElementById('filterDrawer');
const filterOverlay = document.getElementById('filterOverlay');
const closeDrawerBtn = document.getElementById('closeDrawer');

openFilterBtn.addEventListener('click', () => { filterDrawer.classList.add('open'); filterOverlay.style.display='block'; document.body.style.overflow='hidden'; });
function closeDrawer() { filterDrawer.classList.remove('open'); filterOverlay.style.display='none'; document.body.style.overflow=''; }
closeDrawerBtn.addEventListener('click', closeDrawer);
filterOverlay.addEventListener('click', closeDrawer);

// ===== SCROLL TOP =====
const scrollTopBtn = document.getElementById('scrollTop');
window.addEventListener('scroll', () => {
  scrollTopBtn.classList.toggle('show', window.scrollY > 300);
});

// ===== INTERSECTION OBSERVER =====
const observer = new IntersectionObserver(entries => {
  entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.1 });

// ===== INIT =====
updatePriceUI();
document.querySelector('.rating-btn[data-rating="0"]').classList.add('active');
applyFilters();
</script>
</body>
</html>
