<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PaluWedding — Wedding Organizer Hub</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            display: ['"Playfair Display"', 'serif'],
            body: ['"DM Sans"', 'sans-serif'],
          },
          colors: {
            blush: {
              50:  '#fdf5f5',
              100: '#fce8e8',
              200: '#f8d0d0',
              300: '#f2aaaa',
              400: '#e87b7b',
              500: '#d95555',
              600: '#c23d3d',
              700: '#a32f2f',
              800: '#7c2323',
            },
            rose: {
              warm: '#b56b5e',
              deep: '#8b4a3e',
            },
            cream: '#fdf8f5',
            parchment: '#f5ede6',
          },
          backgroundImage: {
            'hero-gradient': 'linear-gradient(135deg, #fce8e8 0%, #fdf5f5 50%, #fce4d6 100%)',
            'card-gradient': 'linear-gradient(145deg, #ffffff 0%, #fdf5f5 100%)',
          },
          animation: {
            'fade-up': 'fadeUp 0.7s ease-out forwards',
            'fade-in': 'fadeIn 0.5s ease-out forwards',
            'float': 'float 6s ease-in-out infinite',
          },
          keyframes: {
            fadeUp: {
              '0%': { opacity: '0', transform: 'translateY(30px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' },
            },
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' },
            },
            float: {
              '0%, 100%': { transform: 'translateY(0px)' },
              '50%': { transform: 'translateY(-10px)' },
            },
          },
        }
      }
    }
  </script>
  <style>
    body { font-family: 'DM Sans', sans-serif; background-color: #fdf8f5; }
    .font-display { font-family: 'Playfair Display', serif; }
    .hero-bg {
      background: linear-gradient(135deg, #fce8e8 0%, #fdf5f5 55%, #fce4d6 100%);
    }
    .petal-dot {
      width: 6px; height: 6px;
      border-radius: 50%;
      background: #d95555;
      display: inline-block;
    }
    .card-hover {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-hover:hover {
      transform: translateY(-6px);
      box-shadow: 0 20px 40px rgba(185, 90, 80, 0.12);
    }
    .btn-primary {
      background: #a03d32;
      color: white;
      transition: background 0.2s, transform 0.15s;
    }
    .btn-primary:hover {
      background: #7c2e24;
      transform: translateY(-1px);
    }
    .section-fade {
      opacity: 0;
      transform: translateY(24px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
    .section-fade.visible {
      opacity: 1;
      transform: translateY(0);
    }
    .nav-link { position: relative; }
    .nav-link::after {
      content: '';
      position: absolute;
      bottom: -2px; left: 0;
      width: 0; height: 1.5px;
      background: #a03d32;
      transition: width 0.25s ease;
    }
    .nav-link:hover::after, .nav-link.active::after { width: 100%; }
    .hero-img-frame {
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 24px 60px rgba(160, 61, 50, 0.18);
    }
    .badge-pill {
      background: rgba(160, 61, 50, 0.1);
      border: 1px solid rgba(160, 61, 50, 0.2);
      color: #a03d32;
      font-size: 0.78rem;
      font-weight: 500;
      padding: 4px 14px;
      border-radius: 999px;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    .stat-card {
      text-align: center;
    }
    .stat-num {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      font-weight: 700;
      color: #a03d32;
      line-height: 1.1;
    }
    .wo-card {
      background: white;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.06);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .wo-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 48px rgba(160, 61, 50, 0.14);
    }
    .rating-stars { color: #d97706; }
    .tag {
      background: #fce8e8;
      color: #a03d32;
      font-size: 0.7rem;
      font-weight: 600;
      padding: 2px 10px;
      border-radius: 999px;
      text-transform: uppercase;
      letter-spacing: 0.04em;
    }
    .mobile-menu-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.4);
      z-index: 40;
    }
    .mobile-menu {
      position: fixed;
      top: 0; right: -100%;
      width: 280px; height: 100%;
      background: white;
      z-index: 50;
      transition: right 0.35s ease;
      padding: 2rem 1.5rem;
      box-shadow: -4px 0 30px rgba(0,0,0,0.1);
    }
    .mobile-menu.open { right: 0; }
    .divider-rose {
      height: 1px;
      background: linear-gradient(to right, transparent, #e8c4bc, transparent);
    }
    .testimonial-card {
      background: white;
      border-radius: 20px;
      padding: 2rem;
      box-shadow: 0 4px 20px rgba(0,0,0,0.06);
      position: relative;
    }
    .testimonial-card::before {
      content: '"';
      font-family: 'Playfair Display', serif;
      font-size: 5rem;
      color: #f2aaaa;
      position: absolute;
      top: -10px; left: 20px;
      line-height: 1;
    }
    .scroll-top {
      position: fixed;
      bottom: 24px; right: 24px;
      width: 44px; height: 44px;
      background: #a03d32;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      cursor: pointer;
      box-shadow: 0 4px 14px rgba(160,61,50,0.4);
      opacity: 0;
      transform: translateY(10px);
      transition: opacity 0.3s, transform 0.3s;
      z-index: 99;
    }
    .scroll-top.show { opacity: 1; transform: translateY(0); }
  </style>
</head>
<body class="antialiased text-gray-800">

  <!-- NAVBAR -->
  <nav class="sticky top-0 z-30 bg-white/90 backdrop-blur-md border-b border-rose-100 shadow-sm">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 flex items-center justify-between h-16">
      <!-- Logo -->
      <a href="#" class="flex items-center gap-2">
        <span class="text-2xl">💗</span>
        <div>
          <span class="font-display text-lg font-semibold">
            <span class="text-gray-900">Palu</span><span class="text-[#a03d32]">Wedding</span>
          </span>
          <p class="text-[10px] text-gray-400 tracking-widest uppercase leading-none">Wedding Organizer Hub</p>
        </div>
      </a>

      <!-- Desktop Nav -->
      <div class="hidden md:flex items-center gap-8">
        <a href="#beranda" class="nav-link active text-sm font-medium text-[#a03d32]">Beranda</a>
        <a href="#daftar-wo" class="nav-link text-sm font-medium text-gray-600 hover:text-[#a03d32]">Daftar WO</a>
      </div>

      <!-- Desktop Auth -->
      <div class="hidden md:flex items-center gap-3">
        <a href="#" class="text-sm font-medium text-gray-600 hover:text-[#a03d32] transition-colors px-3 py-2">Masuk</a>
        <a href="#" class="btn-primary px-5 py-2 rounded-xl text-sm font-semibold shadow-sm">Daftar</a>
      </div>

      <!-- Mobile Hamburger -->
      <button id="hamburger" class="md:hidden p-2 rounded-lg hover:bg-rose-50 transition-colors">
        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>
  </nav>

  <!-- Mobile Menu Overlay -->
  <div class="mobile-menu-overlay" id="menuOverlay"></div>
  <div class="mobile-menu" id="mobileMenu">
    <div class="flex items-center justify-between mb-8">
      <span class="font-display text-lg font-semibold">
        <span class="text-gray-900">Palu</span><span class="text-[#a03d32]">Wedding</span>
      </span>
      <button id="closeMenu" class="p-2 rounded-lg hover:bg-rose-50">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
    <div class="flex flex-col gap-1">
      <a href="#beranda" class="py-3 px-4 rounded-xl text-sm font-medium text-[#a03d32] bg-rose-50">Beranda</a>
      <a href="#daftar-wo" class="py-3 px-4 rounded-xl text-sm font-medium text-gray-600 hover:bg-rose-50 transition-colors">Daftar WO</a>
    </div>
    <div class="mt-6 flex flex-col gap-3">
      <a href="#" class="py-3 px-4 rounded-xl text-sm font-medium text-gray-700 border border-gray-200 text-center hover:border-[#a03d32] transition-colors">Masuk</a>
      <a href="#" class="btn-primary py-3 px-4 rounded-xl text-sm font-semibold text-center shadow-sm">Daftar</a>
    </div>
  </div>

  <!-- HERO -->
  <section id="beranda" class="hero-bg pt-14 pb-20 md:pt-20 md:pb-28 overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">
        <!-- Text -->
        <div class="flex-1 text-center lg:text-left section-fade">
          <div class="badge-pill mb-5 inline-flex">
            <span>✨</span> Khusus Kota Palu
          </div>
          <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-5">
            Wujudkan hari<br>
            bahagia <em class="text-[#a03d32] font-semibold not-italic">tak terlupakan</em>
          </h1>
          <p class="text-gray-500 text-base sm:text-lg leading-relaxed mb-8 max-w-lg mx-auto lg:mx-0">
            Temukan, bandingkan, dan pesan Wedding Organizer terverifikasi di Kota Palu. Lihat paket lengkap, galeri portofolio, dan hubungi langsung via WhatsApp.
          </p>
          <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
            <a href="#daftar-wo" class="btn-primary flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl text-sm font-semibold shadow-md">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35" stroke-linecap="round"/></svg>
              Cari Wedding Organizer
            </a>
            <a href="#" class="flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl text-sm font-semibold border border-gray-300 text-gray-700 bg-white hover:border-[#a03d32] hover:text-[#a03d32] transition-colors shadow-sm">
              Daftar Akun <span>→</span>
            </a>
          </div>
          <!-- Stats -->
          <div class="mt-10 flex justify-center lg:justify-start gap-8 sm:gap-12">
            <div class="stat-card">
              <div class="stat-num">100%</div>
              <div class="text-xs text-gray-500 font-medium tracking-widest uppercase mt-1">WO Terverifikasi</div>
            </div>
            <div class="w-px bg-rose-200 self-stretch"></div>
            <div class="stat-card">
              <div class="stat-num">8</div>
              <div class="text-xs text-gray-500 font-medium tracking-widest uppercase mt-1">Kecamatan di Palu</div>
            </div>
            <div class="w-px bg-rose-200 self-stretch"></div>
            <div class="stat-card">
              <div class="rating-stars text-xl">★★★★★</div>
              <div class="text-xs text-gray-500 font-medium tracking-widest uppercase mt-1">Rating Berbintang</div>
            </div>
          </div>
        </div>

        <!-- Image -->
        <div class="flex-1 w-full max-w-md lg:max-w-none section-fade">
          <div class="hero-img-frame animate-float relative">
            <!-- Decorative ring -->
            <div class="absolute -top-4 -right-4 w-24 h-24 rounded-full border-2 border-rose-200 opacity-60 z-10"></div>
            <div class="absolute -bottom-4 -left-4 w-16 h-16 rounded-full border-2 border-rose-300 opacity-40 z-10"></div>
            <img
              src="https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=700&q=80"
              alt="Wedding Ceremony"
              class="w-full h-[320px] sm:h-[400px] object-cover"
            />
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- DIVIDER -->
  <div class="divider-rose my-0"></div>

  <!-- WHY PALUWEDDING -->
  <section class="py-20 bg-cream">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <div class="text-center mb-14 section-fade">
        <h2 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mb-3">Kenapa PaluWedding?</h2>
        <p class="text-gray-500 text-base sm:text-lg max-w-xl mx-auto">
          Kami menghubungkan calon pengantin dengan WO terbaik di Palu — transparan, terverifikasi, dan mudah.
        </p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="card-hover bg-white rounded-2xl p-7 border border-rose-100 section-fade">
          <div class="w-12 h-12 rounded-2xl bg-rose-50 flex items-center justify-center mb-5">
            <svg class="w-6 h-6 text-[#a03d32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
            </svg>
          </div>
          <h3 class="font-display text-lg font-semibold text-gray-900 mb-2">Terverifikasi Admin</h3>
          <p class="text-gray-500 text-sm leading-relaxed">Setiap WO yang tampil sudah melalui proses verifikasi data oleh tim kami.</p>
        </div>

        <!-- Card 2 -->
        <div class="card-hover bg-white rounded-2xl p-7 border border-rose-100 section-fade">
          <div class="w-12 h-12 rounded-2xl bg-rose-50 flex items-center justify-center mb-5">
            <svg class="w-6 h-6 text-[#a03d32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
          </div>
          <h3 class="font-display text-lg font-semibold text-gray-900 mb-2">Lokal Kota Palu</h3>
          <p class="text-gray-500 text-sm leading-relaxed">Filter berdasarkan kecamatan dan kategori fasilitas — Indoor, Outdoor, hingga Adat.</p>
        </div>

        <!-- Card 3 -->
        <div class="card-hover bg-white rounded-2xl p-7 border border-rose-100 section-fade sm:col-span-2 lg:col-span-1">
          <div class="w-12 h-12 rounded-2xl bg-rose-50 flex items-center justify-center mb-5">
            <svg class="w-6 h-6 text-[#a03d32]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
          </div>
          <h3 class="font-display text-lg font-semibold text-gray-900 mb-2">Negosiasi via WhatsApp</h3>
          <p class="text-gray-500 text-sm leading-relaxed">Tanpa biaya tambahan. Setelah memesan, Anda terhubung langsung dengan WO untuk DP & detail.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- REKOMENDASI TERATAS -->
  <section id="daftar-wo" class="py-20 bg-parchment">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4 section-fade">
        <div>
          <h2 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mb-1">Rekomendasi Teratas</h2>
          <p class="text-gray-500">WO dengan rating terbaik dari pengguna kami.</p>
        </div>
        <a href="#" class="text-[#a03d32] text-sm font-semibold flex items-center gap-1 hover:gap-2 transition-all">Lihat semua <span>→</span></a>
      </div>

      <!-- WO Cards Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- WO Card 1 -->
        <div class="wo-card section-fade">
          <div class="relative">
            <img src="https://images.unsplash.com/photo-1519741497674-611481863552?w=500&q=80" alt="WO" class="w-full h-48 object-cover"/>
            <div class="absolute top-3 left-3 flex gap-2">
              <span class="tag">Outdoor</span>
              <span class="tag">Adat</span>
            </div>
          </div>
          <div class="p-5">
            <div class="flex items-start justify-between mb-1">
              <h3 class="font-display font-semibold text-gray-900 text-lg">Elegan Bridal Palu</h3>
              <div class="flex items-center gap-1 text-amber-500 text-sm font-semibold">
                <span>★</span><span>4.9</span>
              </div>
            </div>
            <p class="text-xs text-gray-400 mb-3 flex items-center gap-1">
              <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9z"/></svg>
              Palu Barat
            </p>
            <p class="text-gray-500 text-sm leading-relaxed mb-4">Spesialis pernikahan adat Kaili dengan dekorasi elegan dan tim profesional berpengalaman 10+ tahun.</p>
            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
              <div>
                <p class="text-xs text-gray-400">Mulai dari</p>
                <p class="font-display font-bold text-[#a03d32] text-lg">Rp 15 jt</p>
              </div>
              <a href="#" class="btn-primary px-4 py-2 rounded-xl text-xs font-semibold flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M11.999 1C5.93 1 1 5.93 1 12c0 1.957.505 3.793 1.39 5.394L1 23l5.742-1.375A10.944 10.944 0 0012 23c6.07 0 11-4.93 11-11S18.069 1 11.999 1z"/></svg>
                WhatsApp
              </a>
            </div>
          </div>
        </div>

        <!-- WO Card 2 -->
        <div class="wo-card section-fade">
          <div class="relative">
            <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=500&q=80" alt="WO" class="w-full h-48 object-cover"/>
            <div class="absolute top-3 left-3 flex gap-2">
              <span class="tag">Indoor</span>
            </div>
          </div>
          <div class="p-5">
            <div class="flex items-start justify-between mb-1">
              <h3 class="font-display font-semibold text-gray-900 text-lg">Mutiara Wedding</h3>
              <div class="flex items-center gap-1 text-amber-500 text-sm font-semibold">
                <span>★</span><span>4.8</span>
              </div>
            </div>
            <p class="text-xs text-gray-400 mb-3 flex items-center gap-1">
              <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9z"/></svg>
              Palu Timur
            </p>
            <p class="text-gray-500 text-sm leading-relaxed mb-4">Paket lengkap gedung, dekorasi modern, catering & dokumentasi. Melayani 300–1000 tamu.</p>
            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
              <div>
                <p class="text-xs text-gray-400">Mulai dari</p>
                <p class="font-display font-bold text-[#a03d32] text-lg">Rp 22 jt</p>
              </div>
              <a href="#" class="btn-primary px-4 py-2 rounded-xl text-xs font-semibold flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M11.999 1C5.93 1 1 5.93 1 12c0 1.957.505 3.793 1.39 5.394L1 23l5.742-1.375A10.944 10.944 0 0012 23c6.07 0 11-4.93 11-11S18.069 1 11.999 1z"/></svg>
                WhatsApp
              </a>
            </div>
          </div>
        </div>

        <!-- WO Card 3 -->
        <div class="wo-card section-fade">
          <div class="relative">
            <img src="https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=500&q=80" alt="WO" class="w-full h-48 object-cover"/>
            <div class="absolute top-3 left-3 flex gap-2">
              <span class="tag">Outdoor</span>
              <span class="tag">Garden</span>
            </div>
          </div>
          <div class="p-5">
            <div class="flex items-start justify-between mb-1">
              <h3 class="font-display font-semibold text-gray-900 text-lg">Sakura Organizer</h3>
              <div class="flex items-center gap-1 text-amber-500 text-sm font-semibold">
                <span>★</span><span>4.7</span>
              </div>
            </div>
            <p class="text-xs text-gray-400 mb-3 flex items-center gap-1">
              <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9z"/></svg>
              Mantikulore
            </p>
            <p class="text-gray-500 text-sm leading-relaxed mb-4">Pernikahan taman bergaya rustic & bohemian dengan dekorasi bunga segar lokal pilihan.</p>
            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
              <div>
                <p class="text-xs text-gray-400">Mulai dari</p>
                <p class="font-display font-bold text-[#a03d32] text-lg">Rp 12 jt</p>
              </div>
              <a href="#" class="btn-primary px-4 py-2 rounded-xl text-xs font-semibold flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M11.999 1C5.93 1 1 5.93 1 12c0 1.957.505 3.793 1.39 5.394L1 23l5.742-1.375A10.944 10.944 0 0012 23c6.07 0 11-4.93 11-11S18.069 1 11.999 1z"/></svg>
                WhatsApp
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- TESTIMONIALS -->
  <section class="py-20 bg-cream">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <div class="text-center mb-14 section-fade">
        <h2 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mb-3">Kata Mereka</h2>
        <p class="text-gray-500">Cerita bahagia dari pengantin yang sudah menggunakan PaluWedding.</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="testimonial-card section-fade">
          <div class="pt-6">
            <p class="text-gray-600 text-sm leading-relaxed mb-5">Sangat membantu! Kami menemukan WO impian dalam 1 hari. Prosesnya mudah dan transparansi harganya jelas sekali.</p>
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full bg-rose-100 flex items-center justify-center font-display font-bold text-[#a03d32]">A</div>
              <div>
                <p class="font-semibold text-sm text-gray-900">Aisyah & Rizal</p>
                <p class="text-xs text-gray-400">Menikah Maret 2025</p>
              </div>
              <div class="ml-auto rating-stars text-sm">★★★★★</div>
            </div>
          </div>
        </div>

        <div class="testimonial-card section-fade">
          <div class="pt-6">
            <p class="text-gray-600 text-sm leading-relaxed mb-5">WO yang kami pilih via PaluWedding luar biasa. Dekorasi adat Kaili-nya sangat autentik dan tim sangat responsif.</p>
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full bg-rose-100 flex items-center justify-center font-display font-bold text-[#a03d32]">F</div>
              <div>
                <p class="font-semibold text-sm text-gray-900">Fitri & Dimas</p>
                <p class="text-xs text-gray-400">Menikah Januari 2025</p>
              </div>
              <div class="ml-auto rating-stars text-sm">★★★★★</div>
            </div>
          </div>
        </div>

        <div class="testimonial-card section-fade md:col-span-2 lg:col-span-1">
          <div class="pt-6">
            <p class="text-gray-600 text-sm leading-relaxed mb-5">Recommend banget! Bisa bandingkan harga dan paket dari beberapa WO langsung. Hemat waktu dan tenaga.</p>
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full bg-rose-100 flex items-center justify-center font-display font-bold text-[#a03d32]">N</div>
              <div>
                <p class="font-semibold text-sm text-gray-900">Nurul & Hendra</p>
                <p class="text-xs text-gray-400">Menikah April 2025</p>
              </div>
              <div class="ml-auto rating-stars text-sm">★★★★★</div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- CTA SECTION -->
  <section class="py-20 bg-parchment">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center section-fade">
      <div class="bg-white rounded-3xl p-10 sm:p-14 shadow-lg border border-rose-100">
        <span class="text-4xl mb-4 block">💍</span>
        <h2 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mb-3">Punya Wedding Organizer di Palu?</h2>
        <p class="text-gray-500 mb-8 leading-relaxed">Daftarkan bisnis Anda di PaluWedding dan jangkau ribuan calon pengantin di Kota Palu secara gratis.</p>
        <a href="#" class="btn-primary inline-flex items-center gap-2 px-8 py-4 rounded-2xl text-sm font-semibold shadow-md">
          Daftar sebagai WO <span>→</span>
        </a>
        <p class="text-xs text-gray-400 mt-4">Gratis selamanya · Verifikasi admin · Langsung tampil</p>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="bg-white border-t border-rose-100 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 flex flex-col sm:flex-row items-center justify-between gap-3">
      <div class="flex items-center gap-2 text-sm text-gray-600">
        <span class="text-[#a03d32]">♥</span>
        <span class="font-semibold font-display">
          <span class="text-gray-900">Palu</span><span class="text-[#a03d32]">Wedding</span>
        </span>
        <span class="text-gray-400">— Temukan Wedding Organizer terbaik di Kota Palu.</span>
      </div>
      <p class="text-xs text-gray-400">© 2026 PaluWedding. Semua hak dilindungi.</p>
    </div>
  </footer>

  <!-- Scroll to top -->
  <div class="scroll-top" id="scrollTop" onclick="window.scrollTo({top:0,behavior:'smooth'})">
    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
    </svg>
  </div>

  <script>
    // Mobile menu
    const hamburger = document.getElementById('hamburger');
    const closeMenu = document.getElementById('closeMenu');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuOverlay = document.getElementById('menuOverlay');

    function openMenu() {
      mobileMenu.classList.add('open');
      menuOverlay.style.display = 'block';
      document.body.style.overflow = 'hidden';
    }
    function closeMobileMenu() {
      mobileMenu.classList.remove('open');
      menuOverlay.style.display = 'none';
      document.body.style.overflow = '';
    }

    hamburger.addEventListener('click', openMenu);
    closeMenu.addEventListener('click', closeMobileMenu);
    menuOverlay.addEventListener('click', closeMobileMenu);

    // Close menu on nav link click
    mobileMenu.querySelectorAll('a').forEach(link => link.addEventListener('click', closeMobileMenu));

    // Scroll reveal
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('visible');
        }
      });
    }, { threshold: 0.12 });

    document.querySelectorAll('.section-fade').forEach(el => observer.observe(el));

    // Scroll to top
    const scrollTopBtn = document.getElementById('scrollTop');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 400) scrollTopBtn.classList.add('show');
      else scrollTopBtn.classList.remove('show');
    });
  </script>
</body>
</html>
