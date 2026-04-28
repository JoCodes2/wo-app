@extends('layouts-ui.base')

@section('content')
<div class="min-h-screen bg-[#fdf8f5]">

    {{-- Header Section --}}
    <div class="bg-gradient-to-r from-[#fce8e8] via-[#fdf5f5] to-[#fce4d6]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
            <h1 class="font-display text-3xl font-bold text-gray-900 mb-2">Daftar Wedding Organizer</h1>
            <p class="text-gray-500">Temukan WO terbaik di Kota Palu — terverifikasi, transparan, dan siap melayani hari spesial Anda.</p>
            <div class="bg-white rounded-xl flex items-center gap-3 px-4 py-2 max-w-md mt-4 border border-[#f0ddd8]">
                <i class="fa-solid fa-magnifying-glass text-[#a03d32]"></i>
                <input type="text" id="searchWo" placeholder="Cari nama WO..." class="w-full outline-none bg-transparent text-sm">
            </div>
        </div>
    </div>

    {{-- Filter dan Grid --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
        <div class="flex flex-col lg:flex-row gap-6">
            {{-- Sidebar Filter --}}
            <aside class="lg:w-72 flex-shrink-0">
                <div class="bg-white border border-[#f0ddd8] rounded-2xl p-5 sticky top-24">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-gray-900">Filter</h3>
                        <button id="resetFilter" class="text-xs text-[#a03d32] hover:underline">Reset semua</button>
                    </div>

                    {{-- Filter Kategori Layanan --}}
                    <div class="mb-6">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori Layanan</label>
                        <div class="grid grid-cols-2 gap-2 mt-3">
                            <button data-category="outdoor" class="filter-cat flex items-center justify-center gap-2 px-3 py-2 rounded-xl border border-[#f0ddd8] text-xs font-medium text-gray-600 hover:border-[#a03d32] hover:text-[#a03d32] hover:bg-[#fce8e8] transition-all">
                                <i class="fa-solid fa-leaf text-[10px]"></i> Outdoor
                            </button>
                            <button data-category="indoor" class="filter-cat flex items-center justify-center gap-2 px-3 py-2 rounded-xl border border-[#f0ddd8] text-xs font-medium text-gray-600 hover:border-[#a03d32] hover:text-[#a03d32] hover:bg-[#fce8e8] transition-all">
                                <i class="fa-solid fa-building text-[10px]"></i> Indoor
                            </button>
                            <button data-category="modern" class="filter-cat flex items-center justify-center gap-2 px-3 py-2 rounded-xl border border-[#f0ddd8] text-xs font-medium text-gray-600 hover:border-[#a03d32] hover:text-[#a03d32] hover:bg-[#fce8e8] transition-all">
                                <i class="fa-solid fa-microchip text-[10px]"></i> Modern
                            </button>
                            <button data-category="traditional" class="filter-cat flex items-center justify-center gap-2 px-3 py-2 rounded-xl border border-[#f0ddd8] text-xs font-medium text-gray-600 hover:border-[#a03d32] hover:text-[#a03d32] hover:bg-[#fce8e8] transition-all">
                                <i class="fa-solid fa-landmark text-[10px]"></i> Tradisional
                            </button>
                        </div>
                    </div>

                    <div class="h-px bg-gradient-to-r from-transparent via-[#f0ddd8] to-transparent my-5"></div>

                    {{-- Filter Rentang Harga --}}
                    <div class="mb-5">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Rentang Harga (Rp)</label>
                        <div class="flex gap-2 mt-3">
                            <input type="number" id="minPrice" placeholder="Min" class="w-full border border-[#f0ddd8] rounded-xl px-3 py-2 text-sm focus:border-[#a03d32] focus:outline-none">
                            <input type="number" id="maxPrice" placeholder="Max" class="w-full border border-[#f0ddd8] rounded-xl px-3 py-2 text-sm focus:border-[#a03d32] focus:outline-none">
                        </div>
                        <div class="flex justify-between text-[10px] text-gray-400 mt-2">
                            <span>Rp 0</span>
                            <span>Rp 10 jt</span>
                            <span>Rp 20 jt</span>
                            <span>Rp 30 jt+</span>
                        </div>
                    </div>

                    <button id="applyFilter" class="w-full mt-4 py-2.5 bg-[#a03d32] text-white rounded-xl text-sm font-semibold hover:opacity-90 transition">
                        Terapkan Filter
                    </button>
                </div>
            </aside>

            {{-- Daftar WO --}}
            <div class="flex-1">
                {{-- Header dengan jumlah dan sorting --}}
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-5">
                    <p class="text-sm text-gray-500">
                        Menampilkan <span id="woCount" class="font-semibold text-[#a03d32]">0</span> Wedding Organizer
                    </p>
                    <select id="sortSelect" class="border border-[#f0ddd8] rounded-xl px-4 py-2 text-sm text-gray-600 focus:border-[#a03d32] focus:outline-none">
                        <option value="rating">⭐ Rating Tertinggi</option>
                        <option value="price_asc">💰 Harga Terendah</option>
                        <option value="price_desc">💰 Harga Tertinggi</option>
                    </select>
                </div>

                {{-- Grid WO Cards --}}
                <div id="woGrid" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- JS akan mengisi di sini --}}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Data WO (dummy statis)
const woData = [
    { id:1, name:"Elegan Bridal Palu", district:"Palu Barat", category:"outdoor", price:15000000, rating:4.9, verified:true, desc:"Spesialis pernikahan adat Kaili dengan dekorasi elegan dan tim profesional berpengalaman.", image:"https://images.unsplash.com/photo-1519741497674-611481863552?w=500", capacity:"200-500 Tamu" },
    { id:2, name:"Mantikulore Wedding", district:"Mantikulore", category:"indoor", price:25000000, rating:4.8, verified:true, desc:"Gedung mewah dengan AC, catering bintang 5, dekorasi modern, dan tim profesional.", image:"https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=500", capacity:"300-700 Tamu" },
    { id:3, name:"Palu Harmoni", district:"Palu Timur", category:"modern", price:18000000, rating:4.7, verified:false, desc:"Konsep pernikahan modern dengan lighting artistik, dokumentasi profesional, dan dekorasi minimalis.", image:"https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=500", capacity:"150-400 Tamu" },
    { id:4, name:"Adat Kaili Asri", district:"Palu Selatan", category:"traditional", price:12000000, rating:4.6, verified:true, desc:"Mengutamakan adat Kaili yang sakral dengan peralatan adat lengkap dan prosesi tradisional.", image:"https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=500", capacity:"100-300 Tamu" },
    { id:5, name:"Gardenia Palu", district:"Palu Barat", category:"outdoor", price:22000000, rating:4.9, verified:true, desc:"Taman outdoor asri untuk garden party, cocok untuk konsep rustic dan natural.", image:"https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=500", capacity:"250-600 Tamu" },
    { id:6, name:"Modern Wedding Palu", district:"Palu Timur", category:"modern", price:28000000, rating:4.8, verified:false, desc:"Pernikahan minimalis modern dengan sentuhan artistik dan lighting instagramable.", image:"https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=500", capacity:"200-500 Tamu" },
];

let filters = { search:"", categories:[], minPrice:null, maxPrice:null };
let sortBy = "rating";

// Fungsi untuk render WO cards
function renderWO() {
    let filtered = woData.filter(wo => {
        // Filter search nama
        if(filters.search && !wo.name.toLowerCase().includes(filters.search)) return false;
        // Filter kategori
        if(filters.categories.length > 0 && !filters.categories.includes(wo.category)) return false;
        // Filter min price
        if(filters.minPrice !== null && wo.price < filters.minPrice) return false;
        // Filter max price
        if(filters.maxPrice !== null && wo.price > filters.maxPrice) return false;
        return true;
    });

    // Sorting
    if(sortBy === "rating") filtered.sort((a,b) => b.rating - a.rating);
    if(sortBy === "price_asc") filtered.sort((a,b) => a.price - b.price);
    if(sortBy === "price_desc") filtered.sort((a,b) => b.price - a.price);

    // Update jumlah WO
    document.getElementById("woCount").innerText = filtered.length;

    const grid = document.getElementById("woGrid");
    if(!filtered.length) {
        grid.innerHTML = `<div class="col-span-2 text-center py-12">
                            <i class="fa-regular fa-face-frown text-4xl text-gray-300 mb-3"></i>
                            <p class="text-gray-400">Tidak ada Wedding Organizer yang ditemukan</p>
                          </div>`;
        return;
    }

    grid.innerHTML = filtered.map(wo => `
        <div class="group bg-white rounded-2xl overflow-hidden border border-[#f0ddd8] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="relative h-44 overflow-hidden">
                <img src="${wo.image}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute top-3 left-3">
                    <span class="bg-[#fce8e8] text-[#a03d32] text-[0.65rem] font-bold px-2.5 py-1 rounded-full uppercase flex items-center gap-1">
                        ${wo.category === 'outdoor' ? '<i class="fa-solid fa-leaf text-[9px]"></i>' :
                          wo.category === 'indoor' ? '<i class="fa-solid fa-building text-[9px]"></i>' :
                          wo.category === 'modern' ? '<i class="fa-solid fa-microchip text-[9px]"></i>' :
                          '<i class="fa-solid fa-landmark text-[9px]"></i>'} ${wo.category}
                    </span>
                </div>
                ${wo.verified ? `<div class="absolute top-3 right-3 bg-green-100 text-green-700 text-[0.6rem] font-bold px-2 py-1 rounded-full flex items-center gap-1">
                    <i class="fa-solid fa-circle-check text-[9px]"></i> Verified
                </div>` : ''}
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-1">
                    <h3 class="font-display font-bold text-gray-900 group-hover:text-[#a03d32] transition">${wo.name}</h3>
                    <div class="flex items-center gap-1 text-amber-500 text-sm font-semibold">
                        <i class="fa-solid fa-star text-[10px]"></i> ${wo.rating}
                    </div>
                </div>
                <p class="text-xs text-gray-400 mb-2">
                    <i class="fa-solid fa-location-dot"></i> ${wo.district} | <i class="fa-solid fa-users"></i> ${wo.capacity}
                </p>
                <p class="text-xs text-gray-500 leading-relaxed line-clamp-2 mb-3">${wo.desc}</p>
                <div class="flex items-center justify-between pt-3 border-t border-[#f0ddd8]">
                    <div>
                        <p class="text-[9px] text-gray-400">Mulai dari</p>
                        <p class="font-bold text-[#a03d32]">Rp ${(wo.price/1e6).toFixed(0)} jt</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="/profile-wo/${wo.id}" class="px-3 py-1.5 border border-[#a03d32] text-[#a03d32] rounded-xl text-[0.7rem] font-semibold hover:bg-[#a03d32] hover:text-white transition whitespace-nowrap">
                            Detail Profil
                        </a>
                        <a href="https://wa.me/6281234567890?text=Halo%20saya%20tertarik%20dengan%20layanan%20${encodeURIComponent(wo.name)}" target="_blank" class="px-3 py-1.5 bg-[#25D366] text-white rounded-xl text-[0.7rem] font-semibold flex items-center gap-1 hover:opacity-90 transition">
                            <i class="fa-brands fa-whatsapp text-xs"></i> Chat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    `).join("");
}

// Event listener search
document.getElementById("searchWo")?.addEventListener("input", e=>{
    filters.search = e.target.value.toLowerCase();
    renderWO();
});

// Event listener kategori filter
document.querySelectorAll(".filter-cat").forEach(btn => {
    btn.addEventListener("click", () => {
        let cat = btn.getAttribute("data-category");
        if(filters.categories.includes(cat)) {
            filters.categories = filters.categories.filter(c => c !== cat);
            btn.classList.remove("bg-[#a03d32]", "text-white", "border-[#a03d32]");
            btn.classList.add("border-[#f0ddd8]", "text-gray-600");
        } else {
            filters.categories.push(cat);
            btn.classList.add("bg-[#a03d32]", "text-white", "border-[#a03d32]");
            btn.classList.remove("border-[#f0ddd8]", "text-gray-600");
        }
        renderWO();
    });
});

// Event listener apply filter harga
document.getElementById("applyFilter")?.addEventListener("click", () => {
    filters.minPrice = parseInt(document.getElementById("minPrice")?.value) || null;
    filters.maxPrice = parseInt(document.getElementById("maxPrice")?.value) || null;
    renderWO();
});

// Event listener reset filter
document.getElementById("resetFilter")?.addEventListener("click", () => {
    filters = { search:"", categories:[], minPrice:null, maxPrice:null };
    document.getElementById("searchWo").value = "";
    document.getElementById("minPrice").value = "";
    document.getElementById("maxPrice").value = "";
    document.querySelectorAll(".filter-cat").forEach(btn => {
        btn.classList.remove("bg-[#a03d32]", "text-white", "border-[#a03d32]");
        btn.classList.add("border-[#f0ddd8]", "text-gray-600");
    });
    renderWO();
});

// Event listener sorting
document.getElementById("sortSelect")?.addEventListener("change", e => {
    sortBy = e.target.value;
    renderWO();
});

// Initial render
renderWO();
</script>
@endsection
