<!-- NAVBAR -->
<nav class="sticky top-0 z-30 bg-white/90 backdrop-blur-md border-b border-rose-100 shadow-sm">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 flex items-center justify-between h-16">
    <!-- Logo -->
    <a href="/" class="flex items-center gap-2">
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
      <a href="/" class="nav-link text-sm font-medium {{ Request::is('/') ? 'text-[#a03d32] active' : 'text-gray-600 hover:text-[#a03d32]' }}">Beranda</a>
      <a href="/daftar-wo" class="nav-link text-sm font-medium {{ Request::is('daftar-wo*') ? 'text-[#a03d32] active' : 'text-gray-600 hover:text-[#a03d32]' }}">Daftar WO</a>
    </div>

    <!-- Desktop Auth Section -->
    <div class="hidden md:flex items-center gap-3">
      @guest
        {{-- Tampilan jika BELUM Login --}}
        <a href="/login" class="text-sm font-medium text-gray-600 hover:text-[#a03d32] px-3 py-2">Masuk</a>
        <a href="/register" class="btn-primary px-5 py-2 rounded-xl text-sm font-semibold shadow-sm text-white bg-[#a03d32]">Daftar</a>
      @else
        {{-- Tampilan jika SUDAH Login --}}
        @if(Auth::user()->role === 'user')
          <a href="/profile-saya" class="flex items-center gap-2 text-sm font-medium {{ Request::is('profile-saya') ? 'text-[#a03d32]' : 'text-gray-600 hover:text-[#a03d32]' }} transition-colors px-3 py-2">
            <i class="fa-regular fa-user"></i> Profil Saya
          </a>
        @endif

        <a href="javascript:void(0)" onclick="handleLogout()" class="text-sm font-medium text-gray-500 hover:text-red-600 transition-colors px-3 py-2">
          <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
        </a>
      @endguest
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
    <a href="/" class="py-3 px-4 rounded-xl text-sm font-medium {{ Request::is('/') ? 'text-[#a03d32] bg-rose-50' : 'text-gray-600' }}">Beranda</a>
    <a href="/daftar-wo" class="py-3 px-4 rounded-xl text-sm font-medium {{ Request::is('daftar-wo*') ? 'text-[#a03d32] bg-rose-50' : 'text-gray-600' }}">Daftar WO</a>

    @auth
      @if(Auth::user()->role === 'user')
        <a href="/profile-saya" class="py-3 px-4 rounded-xl text-sm font-medium {{ Request::is('profile-saya') ? 'text-[#a03d32] bg-rose-50' : 'text-gray-600' }}">Profil Saya</a>
      @endif
    @endauth
  </div>

  <div class="mt-6 flex flex-col gap-3 border-t border-gray-100 pt-6">
    @guest
      <a href="/login" class="py-3 px-4 rounded-xl text-sm font-medium text-gray-700 border border-gray-200 text-center">Masuk</a>
      <a href="/register" class="btn-primary py-3 px-4 rounded-xl text-sm font-semibold text-center shadow-sm text-white bg-[#a03d32]">Daftar</a>
    @else
      <button onclick="handleLogout()" class="py-3 px-4 rounded-xl text-sm font-medium text-white bg-red-500 text-center">Keluar</button>
    @endguest
  </div>
</div>
