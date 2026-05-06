@extends('layouts-ui.base')

@section('content')
<div class="min-h-screen bg-[#fdf8f5]">

    {{-- Header Section --}}
    <div class="bg-gradient-to-r from-[#fce8e8] via-[#fdf5f5] to-[#fce4d6]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12">
            <h1 class="font-display text-4xl font-bold text-gray-900 mb-3 text-center lg:text-left">Daftar Wedding Organizer</h1>
            <p class="text-gray-500 text-center lg:text-left mb-8">Temukan WO terbaik di Kota Palu — terverifikasi, transparan, dan siap melayani hari spesial Anda.</p>

            {{-- Search Bar --}}
            <div class="bg-white rounded-2xl flex items-center gap-3 px-6 py-3 max-w-2xl mx-auto lg:mx-0 shadow-sm border border-[#f0ddd8] focus-within:ring-2 focus-within:ring-[#a03d32]/20 transition-all">
                <i class="fa-solid fa-magnifying-glass text-[#a03d32]"></i>
                <input type="text" id="searchWo" placeholder="Cari nama Wedding Organizer atau layanan..." class="w-full outline-none bg-transparent text-base">
            </div>
        </div>
    </div>

    {{-- Main Content Section --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10">
        <div class="flex flex-col lg:flex-row gap-8">

            {{-- Sidebar Filter --}}
            <aside class="lg:w-80 flex-shrink-0">
                <div class="bg-white border border-[#f0ddd8] rounded-2xl p-6 sticky top-24 shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-gray-900 flex items-center gap-2">
                            <i class="fa-solid fa-filter text-[#a03d32]"></i> Filter
                        </h3>
                        <button id="resetFilter" class="text-xs font-semibold text-[#a03d32] hover:text-[#7a2e26] transition-colors">
                            Reset Semua
                        </button>
                    </div>

                    {{-- Range Harga --}}
                    <div class="mb-8">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-4 block">Rentang Harga (Rp)</label>
                        <div class="space-y-3">
                            <div>
                                <input type="number" id="minPrice" placeholder="Harga Minimum" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 text-sm focus:border-[#a03d32] focus:ring-1 focus:ring-[#a03d32] outline-none transition-all">
                            </div>
                            <div>
                                <input type="number" id="maxPrice" placeholder="Harga Maksimum" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 text-sm focus:border-[#a03d32] focus:ring-1 focus:ring-[#a03d32] outline-none transition-all">
                            </div>
                        </div>
                    </div>

                    <button id="applyFilter" class="w-full py-3 bg-[#a03d32] text-white rounded-xl text-sm font-bold shadow-lg shadow-rose-900/10 hover:bg-[#7a2e26] transform active:scale-95 transition-all">
                        Terapkan Filter
                    </button>
                </div>
            </aside>

            {{-- Grid Section --}}
            <div class="flex-1">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                    <div>
                        <p class="text-sm text-gray-500">
                            Menampilkan <span id="woCount" class="font-bold text-[#a03d32]">0</span> Wedding Organizer pilihan
                        </p>
                    </div>
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <label class="text-xs font-bold text-gray-400 whitespace-nowrap">URUTKAN:</label>
                        <select id="sortSelect" class="w-full sm:w-auto border border-[#f0ddd8] rounded-xl px-4 py-2 text-sm text-gray-700 bg-white focus:border-[#a03d32] outline-none cursor-pointer">
                            <option value="rating">⭐ Rating Tertinggi</option>
                            <option value="price_asc">💰 Harga Terendah</option>
                            <option value="price_desc">💰 Harga Tertinggi</option>
                        </select>
                    </div>
                </div>

                {{-- Skeleton Loader --}}
                <div id="woSkeleton" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="bg-white rounded-2xl border border-[#f0ddd8] overflow-hidden animate-pulse">
                            <div class="h-52 bg-gray-200"></div>
                            <div class="p-6">
                                <div class="h-5 bg-gray-200 rounded-md w-3/4 mb-4"></div>
                                <div class="h-3 bg-gray-200 rounded-md w-1/2 mb-6"></div>
                                <div class="flex gap-2 mb-6">
                                    <div class="h-6 bg-gray-100 rounded-md w-16"></div>
                                    <div class="h-6 bg-gray-100 rounded-md w-16"></div>
                                </div>
                                <div class="flex justify-between items-center border-t border-gray-50 pt-4">
                                    <div class="h-8 bg-gray-200 rounded-md w-24"></div>
                                    <div class="h-8 bg-gray-200 rounded-md w-20"></div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                {{-- Main Grid (Diisi oleh JavaScript) --}}
                <div id="woGrid" class="hidden grid grid-cols-1 md:grid-cols-2 gap-8">
                </div>

                {{-- Empty State --}}
                <div id="emptyState" class="hidden flex flex-col items-center justify-center py-24 bg-white rounded-3xl border border-dashed border-[#f0ddd8]">
                    <div class="w-24 h-24 bg-[#fdf5f5] rounded-full flex items-center justify-center mb-6">
                        <i class="fa-solid fa-store-slash text-4xl text-[#a03d32]"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Pencarian Tidak Ditemukan</h3>
                    <p class="text-gray-500 text-center max-w-xs px-4">Kami tidak menemukan WO yang sesuai dengan filter atau kata kunci Anda.</p>
                    <button id="btnResetEmpty" class="mt-6 text-[#a03d32] font-bold text-sm underline">Reset Pencarian</button>
                </div>

                {{-- Pagination --}}
                <div id="paginationContainer" class="mt-16 flex flex-col items-center gap-4 hidden">
                    <div class="h-px bg-gradient-to-r from-transparent via-[#f0ddd8] to-transparent w-full mb-8"></div>
                    <nav id="pagination" class="flex items-center gap-3">
                        <button id="prevPage" class="w-10 h-10 flex items-center justify-center rounded-xl border border-[#f0ddd8] text-gray-400 hover:bg-rose-50 hover:text-[#a03d32] disabled:opacity-30 disabled:cursor-not-allowed transition-all">
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                        </button>

                        <div id="pageNumbers" class="flex items-center gap-2">
                        </div>

                        <button id="nextPage" class="w-10 h-10 flex items-center justify-center rounded-xl border border-[#f0ddd8] text-gray-400 hover:bg-rose-50 hover:text-[#a03d32] disabled:opacity-30 disabled:cursor-not-allowed transition-all">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="module" src="{{ asset('controllers/landing.controller.js') }}"></script>
@endsection
