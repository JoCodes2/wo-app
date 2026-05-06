@extends('layouts-ui.base')

@section('content')
<input type="hidden" id="wo-id-input" value="{{ request()->route('id') }}">
<div id="loading-state" class="flex flex-col items-center justify-center min-h-[70vh] px-6 text-center">
    <div class="relative mb-8">

        <div class="absolute inset-0 rounded-full border-4 border-[#a03d32]/10 scale-150 animate-ping"></div>

        <div class="relative w-20 h-20 bg-white rounded-3xl shadow-xl border border-rose-50 flex items-center justify-center rotate-12 animate-bounce">
            <i class="fa-solid fa-heart text-[#a03d32] text-3xl -rotate-12"></i>
        </div>

        <div class="absolute -top-2 -right-2 animate-pulse delay-75">
            <i class="fa-solid fa-sparkles text-yellow-400 text-sm"></i>
        </div>
        <div class="absolute -bottom-2 -left-2 animate-pulse delay-150">
            <i class="fa-solid fa-sparkles text-yellow-400 text-xs"></i>
        </div>
    </div>

    <div class="space-y-2">
        <h3 class="text-[#a03d32] font-black text-xl tracking-tight animate-pulse">
            Menyiapkan Momen Bahagia
        </h3>
        <p class="text-gray-400 text-sm max-w-[250px] leading-relaxed mx-auto italic">
            Sedang memuat katalog Wedding Organizer favorit Anda...
        </p>
    </div>
    <div class="mt-8 w-48 h-1 bg-rose-50 rounded-full overflow-hidden">
        <div class="h-full bg-gradient-to-r from-[#a03d32] to-[#802d25] w-1/2 rounded-full animate-[loading_1.5s_infinite_ease-in-out]"></div>
    </div>
</div>

<style>
@keyframes loading {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(200%); }
}
</style>

<div id="main-content" class="max-w-6xl mx-auto px-4 sm:px-0 hidden">
   {{-- Header Profile Hero --}}
        <div class="relative mb-20 md:mb-8">
            {{-- Cover Image --}}
            <div class="h-40 md:h-48 rounded-2xl overflow-hidden">
                <img id="wo-cover" src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=1200" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            </div>

            {{-- Profile Info Container --}}
            <div class="absolute -bottom-16 md:-bottom-16 left-0 right-0 px-4 md:px-0 md:left-6 flex flex-col md:flex-row items-center md:items-end gap-3 md:gap-4">
                {{-- Logo --}}
                <div class="relative">
                    <img id="wo-logo" src="" class="w-24 h-24 md:w-28 md:h-28 rounded-2xl border-4 border-white shadow-lg object-cover bg-gray-100">
                </div>

                {{-- Text Info --}}
                <div class="mb-0 md:mb-2 text-center md:text-left">
                    <h1 id="wo-name" class="font-display text-xl md:text-3xl font-bold text-[#a03d32] drop-shadow-lg leading-tight">-</h1>
                    <div class="flex flex-wrap justify-center md:justify-start items-center gap-2 text-[#a03d32] text-xs md:text-sm mt-1">
                        <div class="flex items-center gap-1 bg-white/80 md:bg-transparent px-2 py-0.5 rounded-full md:p-0 shadow-sm md:shadow-none">
                            <i class="fa-solid fa-star text-yellow-400 text-[10px] md:text-xs"></i>
                            <span id="wo-rating-avg" class="font-semibold">0.0</span>
                            <span id="wo-total-ulasan-head" class="text-[#a03d32] opacity-80">(0 ulasan)</span>
                        </div>
                        <span class="hidden md:inline">•</span>
                        <span class="bg-rose-50 md:bg-transparent px-2 py-0.5 rounded-full md:p-0 text-[10px] md:text-sm font-medium border border-rose-100 md:border-none">
                            <i class="fa-regular fa-circle-check text-[#a03d32]"></i> Terverifikasi
                        </span>
                    </div>
                </div>
            </div>
        </div>
    {{-- Konten Utama --}}
    <div class="grid lg:grid-cols-3 gap-6 mt-20">
        {{-- Sidebar Kiri --}}
        <div class="lg:col-span-1 space-y-5">
            <div class="bg-white rounded-2xl border border-[#f0ddd8] p-5">
                <h3 class="font-display font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-[#a03d32]"></i> Informasi Kontak
                </h3>
                <div class="space-y-3" id="wo-contact-list">
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-location-dot text-[#a03d32] mt-0.5"></i>
                        <span id="wo-alamat" class="text-sm text-gray-600">-</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-brands fa-whatsapp text-green-500"></i>
                        <a id="wo-wa-link" href="#" target="_blank" class="text-sm text-gray-600 hover:text-[#a03d32]">-</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-brands fa-instagram text-pink-500"></i>
                        <a id="wo-ig-link" href="#" class="text-sm text-gray-600 hover:text-[#a03d32]">-</a>
                    </div>
                </div>
                <div class="mt-5 pt-4 border-t border-[#f0ddd8]">
                    <a id="btn-wa-action" href="#" target="_blank" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-[#25D366] text-white rounded-xl text-sm font-semibold hover:opacity-90 transition">
                        <i class="fa-brands fa-whatsapp"></i> Chat via WhatsApp
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-[#f0ddd8] p-5">
                <h3 class="font-display font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-chart-simple text-[#a03d32]"></i> Statistik
                </h3>
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div>
                        <p id="stat-ulasan" class="text-2xl font-bold text-[#a03d32]">0+</p>
                        <p class="text-xs text-gray-500">Ulasan</p>
                    </div>
                    <div>
                        <p id="stat-layanan" class="text-2xl font-bold text-[#a03d32]">0</p>
                        <p class="text-xs text-gray-500">Paket Layanan</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Kanan --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-[#f0ddd8] p-6">
                <h2 class="font-display text-xl font-bold text-gray-900 mb-3">Tentang Kami</h2>
                <p id="wo-description" class="text-gray-600 leading-relaxed">-</p>
            </div>

            <div class="bg-white rounded-2xl border border-[#f0ddd8] p-6">
                <h2 class="font-display text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fa-regular fa-images text-[#a03d32]"></i> Galeri Portofolio
                </h2>
                <div id="wo-gallery-container" class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    <!-- Gallery Items injected by JS -->
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-[#f0ddd8] p-6">
                 <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <h2 class="font-display text-xl font-bold text-gray-900 flex items-center gap-2">
                        <i class="fa-solid fa-tag text-[#a03d32]"></i> Paket Layanan
                    </h2>

                    {{-- Filter Kategori --}}
                    <div id="kategori-filter-container" class="flex flex-wrap gap-2">
                        <button class="filter-btn active px-4 py-1.5 rounded-full text-sm border border-[#a03d32] bg-[#a03d32] text-white transition" data-category="all">
                            Semua
                        </button>
                    </div>
                </div>

                <div id="wo-layanan-container" class="grid md:grid-cols-3 gap-4">
                    <!-- Layanan Items injected by JS -->
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-[#f0ddd8] p-6">
                <div class="flex flex-wrap justify-between items-center mb-5">
                    <div>
                        <h2 class="font-display text-xl font-bold text-gray-900 flex items-center gap-2">
                            <i class="fa-regular fa-star text-[#a03d32]"></i> Ulasan Pelanggan
                        </h2>
                        <div class="flex items-center gap-2 mt-1">
                            <div id="stars-container-head" class="flex items-center gap-0.5">
                                <!-- Stars injected by JS -->
                            </div>
                            <span id="wo-rating-val" class="font-semibold text-gray-900">0.0</span>
                            <span id="wo-total-ulasan-body" class="text-gray-400 text-sm">• 0 ulasan</span>
                        </div>
                    </div>
                </div>

                <div id="wo-ulasan-container" class="space-y-4 max-h-96 overflow-y-auto pr-2">
                    <!-- Reviews injected by JS -->
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes loading {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(200%); }
}
</style>
@endsection
@section('scripts')
    <script type="module" src="{{ asset('controllers/detail-wo.controller.js') }}"></script>
@endsection
