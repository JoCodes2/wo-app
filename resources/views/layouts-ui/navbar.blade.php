  <!-- NAVBAR -->
  <nav class="sticky top-0 z-30 bg-white/90 backdrop-blur-md border-b border-rose-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 flex items-center justify-between h-16">
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
        <a href="/" class="nav-link active text-sm font-medium text-[#a03d32]">Beranda</a>
        <a href="/daftar-wo" class="nav-link text-sm font-medium text-gray-600 hover:text-[#a03d32]">Daftar WO</a>
      </div>

      <!-- Desktop Auth -->
      <div class="hidden md:flex items-center gap-3">
        <a href="/login" class="text-sm font-medium text-gray-600 hover:text-[#a03d32] transition-colors px-3 py-2">Masuk</a>
        <a href="/register" class="btn-primary px-5 py-2 rounded-xl text-sm font-semibold shadow-sm">Daftar</a>
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
      <a href="/" class="py-3 px-4 rounded-xl text-sm font-medium text-[#a03d32] bg-rose-50">Beranda</a>
      <a href="/daftar-wo" class="py-3 px-4 rounded-xl text-sm font-medium text-gray-600 hover:bg-rose-50 transition-colors">Daftar WO</a>
    </div>
    <div class="mt-6 flex flex-col gap-3">
      <a href="/login" class="py-3 px-4 rounded-xl text-sm font-medium text-gray-700 border border-gray-200 text-center hover:border-[#a03d32] transition-colors">Masuk</a>
      <a href="/register" class="btn-primary py-3 px-4 rounded-xl text-sm font-semibold text-center shadow-sm">Daftar</a>
    </div>
  </div>
