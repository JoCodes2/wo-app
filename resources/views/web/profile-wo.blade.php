@extends('layouts-ui.base')

@section('content')
@php
    // Dummy data berdasarkan ID (simulasi)
    $woId = request()->segment(2) ?? 1;

    $wo = [
        1 => [
            'name'=>'Elegan Bridal Palu',
            'desc'=>'Spesialis pernikahan adat Kaili dengan dekorasi elegan dan tim profesional. Berpengalaman lebih dari 10 tahun melayani ratusan pasangan bahagia di Kota Palu dan sekitarnya.',
            'logo'=>'https://images.unsplash.com/photo-1519741497674-611481863552?w=500',
            'alamat'=>'Jl. D.I. Panjaitan No.12, Palu Barat',
            'kontak'=>'6281234567890',
            'sosmed'=>'@eleganbridal',
            'rating_avg'=>4.9,
            'total_ulasan'=>128
        ],
        2 => [
            'name'=>'Mantikulore Wedding',
            'desc'=>'Gedung mewah dengan kapasitas besar, cocok untuk pernikahan skala besar hingga 1500 tamu. Dilengkapi AC, sound system profesional, dan tim katering berpengalaman.',
            'logo'=>'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=500',
            'alamat'=>'Jl. Trans Sulawesi Km.5, Mantikulore',
            'kontak'=>'6281234567891',
            'sosmed'=>'@mantikulorewedding',
            'rating_avg'=>4.8,
            'total_ulasan'=>94
        ],
        3 => [
            'name'=>'Palu Harmoni',
            'desc'=>'Konsep pernikahan modern dengan lighting artistik, dokumentasi profesional, dan dekorasi minimalis. Tim kreatif siap mewujudkan konsep impian Anda.',
            'logo'=>'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=500',
            'alamat'=>'Jl. Sultan Hasanuddin No.45, Palu Timur',
            'kontak'=>'6281234567892',
            'sosmed'=>'@paluharmoni',
            'rating_avg'=>4.7,
            'total_ulasan'=>76
        ],
    ][$woId] ?? [
        'name'=>'Wedding Organizer',
        'desc'=>'Layanan pernikahan profesional siap membantu hari spesial Anda.',
        'logo'=>'https://images.unsplash.com/photo-1519741497674-611481863552?w=500',
        'alamat'=>'Palu',
        'kontak'=>'6281234567890',
        'sosmed'=>'@wo',
        'rating_avg'=>4.5,
        'total_ulasan'=>50
    ];

    // Galeri foto
    $galeri = [
        'https://images.unsplash.com/photo-1519741497674-611481863552?w=500',
        'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=500',
        'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=500',
        'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=500',
        'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=500',
        'https://images.unsplash.com/photo-1519741497674-611481863552?w=500',
    ];

    // Paket Layanan
    $layanan = [
        ['id'=>1,'nama'=>'Paket Silver','harga'=>15000000,'detail'=>'Dekorasi sederhana, dokumentasi foto, katering 500 porsi, MC, dan perlengkapan adat dasar'],
        ['id'=>2,'nama'=>'Paket Gold','harga'=>25000000,'detail'=>'Dekorasi premium, foto + video, katering 1000 porsi, organizer, live music akustik'],
        ['id'=>3,'nama'=>'Paket Platinum','harga'=>35000000,'detail'=>'Semua paket Gold + dekorasi eksklusif, souvenir untuk 100 tamu, lighting artistik, dokumentasi drone'],
    ];

    // Data Ulasan (dummy)
    $ulasan = [
        ['id'=>1,'user'=>'Intan & Rizky','rating'=>5,'komentar'=>'Pelayanan sangat memuaskan! Tim WO profesional dan dekorasinya sesuai ekspektasi. Terima kasih Elegan Bridal!','tanggal'=>'2025-12-15','foto'=>null],
        ['id'=>2,'user'=>'Dewi & Andi','rating'=>5,'komentar'=>'Makasih banyak untuk tim yang sudah membantu pernikahan kami berjalan lancar. Semua tamu terkesan dengan dekorasinya 😍','tanggal'=>'2025-11-20','foto'=>null],
        ['id'=>3,'user'=>'Sinta & Budi','rating'=>4,'komentar'=>'Secara keseluruhan bagus, hanya sedikit kendala teknis tapi cepat diatasi. Recommended!','tanggal'=>'2025-10-10','foto'=>null],
    ];
@endphp

<div class="max-w-6xl mx-auto px-4 sm:px-0">

    {{-- Header Profile Hero --}}
    <div class="relative mb-8">
        <div class="h-48 rounded-2xl overflow-hidden">
            <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=1200" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
        </div>
        <div class="absolute -bottom-16 left-6 flex items-end gap-4">
            <img src="{{ $wo['logo'] }}" class="w-28 h-28 rounded-2xl border-4 border-white shadow-lg object-cover">
            <div class="mb-2">
                <h1 class="font-display text-2xl md:text-3xl font-bold text-[#a03d32] drop-shadow-lg">{{ $wo['name'] }}</h1>
                <div class="flex items-center gap-2 text-[#a03d32] text-sm">
                    <div class="flex items-center gap-1">
                        <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                        <span class="font-semibold">{{ $wo['rating_avg'] }}</span>
                        <span class="text-[#a03d32]">({{ $wo['total_ulasan'] }} ulasan)</span>
                    </div>
                    <span>•</span>
                    <span><i class="fa-regular fa-circle-check"></i> Terverifikasi</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Konten Utama --}}
    <div class="grid lg:grid-cols-3 gap-6 mt-20">

        {{-- Sidebar Kiri: Info WO --}}
        <div class="lg:col-span-1 space-y-5">
            {{-- Info Kontak --}}
            <div class="bg-white rounded-2xl border border-[#f0ddd8] p-5">
                <h3 class="font-display font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-[#a03d32]"></i> Informasi Kontak
                </h3>
                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-location-dot text-[#a03d32] mt-0.5"></i>
                        <span class="text-sm text-gray-600">{{ $wo['alamat'] }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-brands fa-whatsapp text-green-500"></i>
                        <a href="https://wa.me/{{ $wo['kontak'] }}?text=Halo%20saya%20tertarik%20dengan%20layanan%20Anda" target="_blank" class="text-sm text-gray-600 hover:text-[#a03d32]">{{ $wo['kontak'] }}</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-brands fa-instagram text-pink-500"></i>
                        <a href="#" class="text-sm text-gray-600 hover:text-[#a03d32]">{{ $wo['sosmed'] }}</a>
                    </div>
                </div>
                <div class="mt-5 pt-4 border-t border-[#f0ddd8]">
                    <a href="https://wa.me/{{ $wo['kontak'] }}?text=Halo%20saya%20tertarik%20dengan%20layanan%20Anda" target="_blank" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-[#25D366] text-white rounded-xl text-sm font-semibold hover:opacity-90 transition">
                        <i class="fa-brands fa-whatsapp"></i> Chat via WhatsApp
                    </a>
                </div>
            </div>

            {{-- Statistik --}}
            <div class="bg-white rounded-2xl border border-[#f0ddd8] p-5">
                <h3 class="font-display font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-chart-simple text-[#a03d32]"></i> Statistik
                </h3>
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div>
                        <p class="text-2xl font-bold text-[#a03d32]">{{ $wo['total_ulasan'] }}+</p>
                        <p class="text-xs text-gray-500">Ulasan</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-[#a03d32]">{{ count($layanan) }}</p>
                        <p class="text-xs text-gray-500">Paket Layanan</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Kanan: Deskripsi, Galeri, Layanan, Ulasan --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Deskripsi WO --}}
            <div class="bg-white rounded-2xl border border-[#f0ddd8] p-6">
                <h2 class="font-display text-xl font-bold text-gray-900 mb-3">Tentang Kami</h2>
                <p class="text-gray-600 leading-relaxed">{{ $wo['desc'] }}</p>
            </div>

            {{-- Galeri Portofolio --}}
            <div class="bg-white rounded-2xl border border-[#f0ddd8] p-6">
                <h2 class="font-display text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fa-regular fa-images text-[#a03d32]"></i> Galeri Portofolio
                </h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach(array_slice($galeri, 0, 6) as $g)
                    <div class="relative group cursor-pointer overflow-hidden rounded-xl aspect-square">
                        <img src="{{ $g }}" class="w-full h-full object-cover transition group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <i class="fa-regular fa-eye text-white text-xl"></i>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Paket Layanan --}}
            <div class="bg-white rounded-2xl border border-[#f0ddd8] p-6">
                <h2 class="font-display text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-tag text-[#a03d32]"></i> Paket Layanan
                </h2>
                <div class="grid md:grid-cols-3 gap-4">
                    @foreach($layanan as $l)
                    <div class="border rounded-xl p-4 hover:shadow-md transition group">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-bold text-gray-900">{{ $l['nama'] }}</h3>
                            <span class="bg-[#fce8e8] text-[#a03d32] text-[10px] font-bold px-2 py-1 rounded-full">POPULER</span>
                        </div>
                        <p class="text-[#a03d32] font-bold text-2xl mt-1">Rp {{ number_format($l['harga']/1000000,0) }}<span class="text-sm font-normal text-gray-400"> jt</span></p>
                        <p class="text-xs text-gray-500 mt-2 leading-relaxed">{{ $l['detail'] }}</p>
                        <button onclick="openOrderModal({{ $l['id'] }}, '{{ $l['nama'] }}', {{ $l['harga'] }})" class="w-full mt-4 py-2 bg-[#a03d32] text-white rounded-xl text-sm font-semibold hover:opacity-90 transition">
                            Pesan Paket
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Ulasan & Rating --}}
            <div class="bg-white rounded-2xl border border-[#f0ddd8] p-6">
                <div class="flex flex-wrap justify-between items-center mb-5">
                    <div>
                        <h2 class="font-display text-xl font-bold text-gray-900 flex items-center gap-2">
                            <i class="fa-regular fa-star text-[#a03d32]"></i> Ulasan Pelanggan
                        </h2>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="flex items-center gap-0.5">
                                @for($i=1; $i<=5; $i++)
                                    <i class="fa-solid fa-star text-xs {{ $i <= floor($wo['rating_avg']) ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                @endfor
                            </div>
                            <span class="font-semibold text-gray-900">{{ $wo['rating_avg'] }}</span>
                            <span class="text-gray-400 text-sm">• {{ $wo['total_ulasan'] }} ulasan</span>
                        </div>
                    </div>
                    <button id="btnTulisUlasan" class="px-4 py-2 border border-[#a03d32] text-[#a03d32] rounded-xl text-sm font-semibold hover:bg-[#a03d32] hover:text-white transition">
                        <i class="fa-regular fa-pen-to-square"></i> Tulis Ulasan
                    </button>
                </div>

                {{-- List Ulasan --}}
                <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                    @foreach($ulasan as $u)
                    <div class="border-b border-[#f0ddd8] pb-4 last:border-0">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-[#fce8e8] rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-user text-[#a03d32] text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900 text-sm">{{ $u['user'] }}</p>
                                        <div class="flex items-center gap-1">
                                            @for($i=1; $i<=5; $i++)
                                                <i class="fa-solid fa-star text-[10px] {{ $i <= $u['rating'] ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mt-2 ml-10">{{ $u['komentar'] }}</p>
                                <p class="text-xs text-gray-400 mt-1 ml-10">{{ date('d M Y', strtotime($u['tanggal'])) }}</p>
                            </div>
                            <span class="text-xs text-green-600 bg-green-50 px-2 py-0.5 rounded-full">Verified</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Order --}}
<div id="orderModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-display text-xl font-bold">Form Pemesanan</h3>
            <button onclick="closeOrderModal()" class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark text-xl"></i></button>
        </div>
        <form id="orderForm">
            <input type="hidden" id="layananId">
            <input type="hidden" id="layananNama">
            <input type="hidden" id="harga">
            <div class="mb-3"><label class="block text-sm font-semibold">Nama Lengkap</label><input type="text" id="namaUser" class="w-full border rounded-xl px-3 py-2 focus:border-[#a03d32] outline-none" required></div>
            <div class="mb-3"><label class="block text-sm font-semibold">Email</label><input type="email" id="emailUser" class="w-full border rounded-xl px-3 py-2 focus:border-[#a03d32] outline-none" required></div>
            <div class="mb-3"><label class="block text-sm font-semibold">No. HP</label><input type="text" id="hpUser" class="w-full border rounded-xl px-3 py-2 focus:border-[#a03d32] outline-none" required></div>
            <div class="mb-3"><label class="block text-sm font-semibold">Tanggal Acara</label><input type="date" id="tglAcara" class="w-full border rounded-xl px-3 py-2 focus:border-[#a03d32] outline-none" required></div>
            <div class="mb-3"><label class="block text-sm font-semibold">Lokasi Acara</label><input type="text" id="lokasiAcara" class="w-full border rounded-xl px-3 py-2 focus:border-[#a03d32] outline-none" required></div>
            <div class="mb-3"><label class="block text-sm font-semibold">Catatan</label><textarea id="catatan" class="w-full border rounded-xl px-3 py-2 focus:border-[#a03d32] outline-none" rows="2"></textarea></div>
            <button type="submit" class="w-full py-2 bg-[#a03d32] text-white rounded-xl font-semibold hover:opacity-90">Kirim Pemesanan</button>
        </form>
    </div>
</div>

{{-- Modal Tulis Ulasan (hanya muncul jika user sudah login dan sudah selesai pesan) --}}
<div id="ulasanModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-display text-xl font-bold">Tulis Ulasan</h3>
            <button onclick="closeUlasanModal()" class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark text-xl"></i></button>
        </div>
        <p class="text-sm text-gray-500 mb-4">Bagikan pengalaman Anda menggunakan jasa {{ $wo['name'] }}</p>
        <form id="ulasanForm">
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2">Rating Anda</label>
                <div class="flex gap-2 text-3xl" id="ratingStars">
                    <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400 transition" data-rating="1"></i>
                    <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400 transition" data-rating="2"></i>
                    <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400 transition" data-rating="3"></i>
                    <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400 transition" data-rating="4"></i>
                    <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400 transition" data-rating="5"></i>
                </div>
                <input type="hidden" id="ratingValue" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2">Komentar</label>
                <textarea id="komentarUlasan" rows="3" class="w-full border rounded-xl px-3 py-2 focus:border-[#a03d32] outline-none" placeholder="Ceritakan pengalaman Anda..."></textarea>
            </div>
            <button type="submit" class="w-full py-2 bg-[#a03d32] text-white rounded-xl font-semibold hover:opacity-90">Kirim Ulasan</button>
        </form>
    </div>
</div>

<script>
function openOrderModal(id, nama, harga) {
    document.getElementById('layananId').value = id;
    document.getElementById('layananNama').value = nama;
    document.getElementById('harga').value = harga;
    document.getElementById('orderModal').classList.add('flex');
    document.getElementById('orderModal').classList.remove('hidden');
}
function closeOrderModal() {
    document.getElementById('orderModal').classList.add('hidden');
    document.getElementById('orderModal').classList.remove('flex');
}
function closeUlasanModal() {
    document.getElementById('ulasanModal').classList.add('hidden');
    document.getElementById('ulasanModal').classList.remove('flex');
}

// Order Form Submit
document.getElementById('orderForm').addEventListener('submit', function(e) {
    e.preventDefault();
    let order = {
        id: Date.now(),
        wo: '{{ $wo["name"] }}',
        wo_id: {{ $woId }},
        layanan: document.getElementById('layananNama').value,
        harga: document.getElementById('harga').value,
        nama: document.getElementById('namaUser').value,
        email: document.getElementById('emailUser').value,
        hp: document.getElementById('hpUser').value,
        tglAcara: document.getElementById('tglAcara').value,
        lokasi: document.getElementById('lokasiAcara').value,
        catatan: document.getElementById('catatan').value,
        status: 'menunggu',
        tanggalOrder: new Date().toISOString().split('T')[0]
    };
    let orders = JSON.parse(localStorage.getItem('userOrders') || '[]');
    orders.push(order);
    localStorage.setItem('userOrders', JSON.stringify(orders));
    alert('✅ Pesanan berhasil! Lihat status di halaman Profil Saya.');
    closeOrderModal();
    window.location.href = '/profil-saya';
});

// Rating Stars untuk Ulasan
let selectedRating = 0;
document.querySelectorAll('#ratingStars i').forEach(star => {
    star.addEventListener('mouseover', function() {
        let rating = parseInt(this.dataset.rating);
        document.querySelectorAll('#ratingStars i').forEach((s, idx) => {
            if(idx < rating) {
                s.className = 'fa-solid fa-star cursor-pointer hover:text-yellow-400 transition text-yellow-400';
            } else {
                s.className = 'fa-regular fa-star cursor-pointer hover:text-yellow-400 transition';
            }
        });
    });
    star.addEventListener('mouseout', function() {
        document.querySelectorAll('#ratingStars i').forEach((s, idx) => {
            if(idx < selectedRating) {
                s.className = 'fa-solid fa-star cursor-pointer hover:text-yellow-400 transition text-yellow-400';
            } else {
                s.className = 'fa-regular fa-star cursor-pointer hover:text-yellow-400 transition';
            }
        });
    });
    star.addEventListener('click', function() {
        selectedRating = parseInt(this.dataset.rating);
        document.getElementById('ratingValue').value = selectedRating;
    });
});

// Ulasan Form Submit
document.getElementById('btnTulisUlasan')?.addEventListener('click', () => {
    // Cek apakah user sudah login dan sudah pernah pesan
    let orders = JSON.parse(localStorage.getItem('userOrders') || '[]');
    let hasCompletedOrder = orders.some(o => o.wo_id == {{ $woId }} && o.status === 'selesai');
    if(!hasCompletedOrder) {
        alert('⚠️ Anda hanya bisa memberi ulasan setelah pesanan selesai. Silakan order terlebih dahulu!');
        return;
    }
    document.getElementById('ulasanModal').classList.add('flex');
    document.getElementById('ulasanModal').classList.remove('hidden');
});

document.getElementById('ulasanForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    if(selectedRating === 0) {
        alert('Silakan pilih rating terlebih dahulu!');
        return;
    }
    let komentar = document.getElementById('komentarUlasan').value;
    if(!komentar) {
        alert('Silakan isi komentar!');
        return;
    }
    alert('✅ Terima kasih atas ulasannya! Ulasan Anda akan membantu calon pengantin lainnya.');
    closeUlasanModal();
    location.reload();
});
</script>
@endsection
