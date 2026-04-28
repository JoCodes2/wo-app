@extends('layouts-ui.base')

@section('content')
<div class="min-h-screen bg-[#fdf8f5]">

    {{-- Hero Section (dengan background penuh, konten max-w-7xl) --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-[#fce8e8] via-[#fdf5f5] to-[#fce4d6]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 md:py-16 lg:py-20">
            <div class="grid md:grid-cols-2 gap-8 lg:gap-12 items-center">
                {{-- Kiri: Teks --}}
                <div>
                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-white/60 backdrop-blur rounded-full text-[#a03d32] text-xs font-semibold mb-4">
                        <i class="fa-solid fa-ring text-[10px]"></i> Selamat Datang di PaluWedding
                    </span>
                    <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
                        Wujudkan <span class="text-[#a03d32]">Pernikahan</span><br>
                        Impian Anda di Kota Palu
                    </h1>
                    <p class="text-gray-500 text-sm sm:text-base mt-4 leading-relaxed">
                        Temukan Wedding Organizer terbaik, terverifikasi, dan berpengalaman.
                        Dari konsep tradisional hingga modern, semua tersedia untuk hari spesial Anda.
                    </p>
                    <div class="flex flex-wrap gap-3 mt-6 sm:mt-8">
                        <a href="{{ url('/daftar-wo') }}" class="px-5 py-2.5 sm:px-6 sm:py-3 bg-[#a03d32] text-white rounded-xl font-semibold text-sm hover:opacity-90 transition shadow-lg shadow-[#a03d32]/20">
                            <i class="fa-solid fa-magnifying-glass mr-2"></i> Cari WO Sekarang
                        </a>
                        <a href="#" class="px-5 py-2.5 sm:px-6 sm:py-3 border-2 border-[#a03d32] text-[#a03d32] rounded-xl font-semibold text-sm hover:bg-[#a03d32] hover:text-white transition">
                            <i class="fa-regular fa-circle-play mr-2"></i> Lihat Video
                        </a>
                    </div>
                </div>

                {{-- Kanan: Gambar --}}
                <div class="relative mt-8 md:mt-0">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?w=600"
                             alt="Wedding Decoration"
                             class="w-full h-64 sm:h-80 md:h-96 object-cover">
                    </div>
                    {{-- Floating badge --}}
                    <div class="absolute -bottom-4 -left-4 bg-white rounded-xl p-3 shadow-lg">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-star text-yellow-400"></i>
                            <span class="font-bold text-gray-900">4.9/5</span>
                            <span class="text-gray-400 text-xs">• 500+ Ulasan</span>
                        </div>
                    </div>
                    <div class="absolute -top-4 -right-4 bg-[#a03d32] text-white rounded-xl p-3 shadow-lg">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-check-circle"></i>
                            <span class="text-sm font-semibold">10+ WO Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Section: Kenapa Memilih Kami --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-16 lg:py-20">
        <div class="text-center mb-10 lg:mb-14">
            <span class="text-[#a03d32] text-sm font-semibold tracking-wider">✦ KEUNGGULAN KAMI ✦</span>
            <h2 class="font-display text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mt-2">
                Kenapa Memilih <span class="text-[#a03d32]">PaluWedding</span>?
            </h2>
            <p class="text-gray-500 mt-3 max-w-2xl mx-auto">
                Kami hadir untuk memudahkan Anda menemukan WO terpercaya di Kota Palu
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Card 1 --}}
            <div class="bg-white rounded-2xl p-6 border border-[#f0ddd8] hover:shadow-xl transition group flex gap-5 items-start">
                <div class="w-20 h-20 bg-[#fce8e8] rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-[#a03d32] transition">
                    <i class="fa-solid fa-circle-check text-3xl text-[#a03d32] group-hover:text-white transition"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-xl">WO Terverifikasi</h3>
                    <p class="text-gray-500 text-sm mt-2 leading-relaxed">
                        Semua Wedding Organizer yang bergabung di PaluWedding telah melalui proses verifikasi identitas, legalitas usaha, dan portofolio asli.
                        Anda tidak perlu khawatir dengan WO abal-abal karena kami memastikan setiap mitra terpercaya dan profesional.
                    </p>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="bg-white rounded-2xl p-6 border border-[#f0ddd8] hover:shadow-xl transition group flex gap-5 items-start">
                <div class="w-20 h-20 bg-[#fce8e8] rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-[#a03d32] transition">
                    <i class="fa-solid fa-chart-line text-3xl text-[#a03d32] group-hover:text-white transition"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-xl">Harga Transparan</h3>
                    <p class="text-gray-500 text-sm mt-2 leading-relaxed">
                        Setiap WO mencantumkan harga paket layanan secara jelas dan terbuka. Tidak ada biaya tersembunyi atau mark-up harga.
                        Anda bisa membandingkan harga antar WO dengan mudah untuk mendapatkan penawaran terbaik sesuai budget.
                    </p>
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="bg-white rounded-2xl p-6 border border-[#f0ddd8] hover:shadow-xl transition group flex gap-5 items-start">
                <div class="w-20 h-20 bg-[#fce8e8] rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-[#a03d32] transition">
                    <i class="fa-regular fa-message text-3xl text-[#a03d32] group-hover:text-white transition"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-xl">Komunikasi Mudah</h3>
                    <p class="text-gray-500 text-sm mt-2 leading-relaxed">
                        Langsung terhubung dengan WO pilihan Anda melalui tombol Chat WhatsApp yang tersedia di setiap profil.
                        Diskusikan konsep, tanyakan detail paket, atau konsultasikan kebutuhan pernikahan Anda secara real-time.
                    </p>
                </div>
            </div>

            {{-- Card 4 --}}
            <div class="bg-white rounded-2xl p-6 border border-[#f0ddd8] hover:shadow-xl transition group flex gap-5 items-start">
                <div class="w-20 h-20 bg-[#fce8e8] rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-[#a03d32] transition">
                    <i class="fa-solid fa-star text-3xl text-[#a03d32] group-hover:text-white transition"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-xl">Ulasan & Rating Asli</h3>
                    <p class="text-gray-500 text-sm mt-2 leading-relaxed">
                        Semua ulasan dan rating berasal dari customer yang benar-benar telah menggunakan jasa WO.
                        Anda bisa melihat pengalaman nyata pasangan lain sebelum menentukan pilihan, sehingga lebih percaya diri dengan keputusan Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Section: Rekomendasi Wedding Organizer --}}
    <div class="bg-gradient-to-b from-white to-[#fdf8f5] py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-10">
                <div>
                    <span class="text-[#a03d32] text-sm font-semibold tracking-wider">✦ REKOMENDASI ✦</span>
                    <h2 class="font-display text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mt-1">
                        Wedding Organizer <span class="text-[#a03d32]">Terbaik</span>
                    </h2>
                    <p class="text-gray-500 mt-2">Rekomendasi WO dengan rating tertinggi di Kota Palu</p>
                </div>
                <a href="{{ url('/daftar-wo') }}" class="mt-4 sm:mt-0 text-[#a03d32] font-semibold hover:underline flex items-center gap-1">
                    Lihat semua <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Card WO 1 --}}
                <div class="group bg-white rounded-[20px] overflow-hidden border border-[#f0ddd8] transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?w=500"
                             alt="Elegan Bridal Palu"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute top-3 left-3 flex gap-1">
                            <span class="bg-[#fce8e8] text-[#a03d32] text-[0.68rem] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                <i class="fa-solid fa-leaf text-[10px] mr-1"></i> Outdoor
                            </span>
                        </div>
                        <div class="absolute top-3 right-3 bg-green-100 text-green-700 text-[0.68rem] font-bold px-2 py-1 rounded-full flex items-center gap-1">
                            <i class="fa-solid fa-circle-check"></i> Verified
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-display font-bold text-gray-900 text-lg group-hover:text-[#a03d32] transition-colors">
                                Elegan Bridal Palu
                            </h3>
                            <div class="flex items-center gap-1 text-amber-500 font-bold text-sm">
                                <i class="fa-solid fa-star text-[10px]"></i> 4.9
                            </div>
                        </div>
                        <div class="flex items-center gap-3 text-[11px] text-gray-400 mb-3">
                            <span><i class="fa-solid fa-location-dot"></i> Palu Barat</span>
                            <span><i class="fa-solid fa-users"></i> 200-500 Tamu</span>
                        </div>
                        <p class="text-gray-500 text-xs leading-relaxed line-clamp-2 mb-4">
                            Spesialis pernikahan adat Kaili dengan dekorasi elegan dan tim profesional berpengalaman.
                        </p>
                        <div class="flex items-center justify-between pt-4 border-t border-[#f0ddd8]">
                            <div>
                                <p class="text-[10px] text-gray-400 leading-none mb-1">Mulai dari</p>
                                <p class="font-display font-bold text-lg text-[#a03d32]">Rp 15 jt</p>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ url('/profile-wo/1') }}" class="px-3 py-2 border-[1.5px] border-[#a03d32] text-[#a03d32] rounded-xl text-[0.8rem] font-bold hover:bg-[#a03d32] hover:text-white transition">
                                    Detail Profil
                                </a>
                                <a href="https://wa.me/6281234567890?text=Halo%20saya%20tertarik%20dengan%20layanan%20Elegan%20Bridal%20Palu" target="_blank" class="px-3 py-2 bg-[#25D366] text-white rounded-xl text-[0.8rem] font-bold flex items-center gap-1.5 hover:opacity-90">
                                    <i class="fa-brands fa-whatsapp text-sm"></i> Chat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card WO 2 --}}
                <div class="group bg-white rounded-[20px] overflow-hidden border border-[#f0ddd8] transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=500"
                             alt="Mantikulore Wedding"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute top-3 left-3">
                            <span class="bg-[#fce8e8] text-[#a03d32] text-[0.68rem] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                <i class="fa-solid fa-building text-[10px] mr-1"></i> Indoor
                            </span>
                        </div>
                        <div class="absolute top-3 right-3 bg-green-100 text-green-700 text-[0.68rem] font-bold px-2 py-1 rounded-full flex items-center gap-1">
                            <i class="fa-solid fa-circle-check"></i> Verified
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-display font-bold text-gray-900 text-lg group-hover:text-[#a03d32] transition-colors">
                                Mantikulore Wedding
                            </h3>
                            <div class="flex items-center gap-1 text-amber-500 font-bold text-sm">
                                <i class="fa-solid fa-star text-[10px]"></i> 4.8
                            </div>
                        </div>
                        <div class="flex items-center gap-3 text-[11px] text-gray-400 mb-3">
                            <span><i class="fa-solid fa-location-dot"></i> Mantikulore</span>
                            <span><i class="fa-solid fa-users"></i> 300-700 Tamu</span>
                        </div>
                        <p class="text-gray-500 text-xs leading-relaxed line-clamp-2 mb-4">
                            Gedung mewah dengan AC, catering bintang 5, dekorasi modern, dan tim profesional.
                        </p>
                        <div class="flex items-center justify-between pt-4 border-t border-[#f0ddd8]">
                            <div>
                                <p class="text-[10px] text-gray-400 leading-none mb-1">Mulai dari</p>
                                <p class="font-display font-bold text-lg text-[#a03d32]">Rp 25 jt</p>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ url('/profile-wo/2') }}" class="px-3 py-2 border-[1.5px] border-[#a03d32] text-[#a03d32] rounded-xl text-[0.8rem] font-bold hover:bg-[#a03d32] hover:text-white transition">
                                    Detail Profil
                                </a>
                                <a href="https://wa.me/6281234567891?text=Halo%20saya%20tertarik%20dengan%20layanan%20Mantikulore%20Wedding" target="_blank" class="px-3 py-2 bg-[#25D366] text-white rounded-xl text-[0.8rem] font-bold flex items-center gap-1.5 hover:opacity-90">
                                    <i class="fa-brands fa-whatsapp text-sm"></i> Chat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card WO 3 --}}
                <div class="group bg-white rounded-[20px] overflow-hidden border border-[#f0ddd8] transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=500"
                             alt="Palu Harmoni"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute top-3 left-3">
                            <span class="bg-[#fce8e8] text-[#a03d32] text-[0.68rem] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                <i class="fa-solid fa-microchip text-[10px] mr-1"></i> Modern
                            </span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-display font-bold text-gray-900 text-lg group-hover:text-[#a03d32] transition-colors">
                                Palu Harmoni
                            </h3>
                            <div class="flex items-center gap-1 text-amber-500 font-bold text-sm">
                                <i class="fa-solid fa-star text-[10px]"></i> 4.7
                            </div>
                        </div>
                        <div class="flex items-center gap-3 text-[11px] text-gray-400 mb-3">
                            <span><i class="fa-solid fa-location-dot"></i> Palu Timur</span>
                            <span><i class="fa-solid fa-users"></i> 150-400 Tamu</span>
                        </div>
                        <p class="text-gray-500 text-xs leading-relaxed line-clamp-2 mb-4">
                            Konsep pernikahan modern dengan lighting artistik, dokumentasi profesional, dan dekorasi minimalis.
                        </p>
                        <div class="flex items-center justify-between pt-4 border-t border-[#f0ddd8]">
                            <div>
                                <p class="text-[10px] text-gray-400 leading-none mb-1">Mulai dari</p>
                                <p class="font-display font-bold text-lg text-[#a03d32]">Rp 18 jt</p>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ url('/profile-wo/3') }}" class="px-3 py-2 border-[1.5px] border-[#a03d32] text-[#a03d32] rounded-xl text-[0.8rem] font-bold hover:bg-[#a03d32] hover:text-white transition">
                                    Detail Profil
                                </a>
                                <a href="https://wa.me/6281234567892?text=Halo%20saya%20tertarik%20dengan%20layanan%20Palu%20Harmoni" target="_blank" class="px-3 py-2 bg-[#25D366] text-white rounded-xl text-[0.8rem] font-bold flex items-center gap-1.5 hover:opacity-90">
                                    <i class="fa-brands fa-whatsapp text-sm"></i> Chat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tombol Lihat Lainnya (mobile friendly) --}}
            <div class="text-center mt-8 lg:hidden">
                <a href="{{ url('/daftar-wo') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#a03d32] text-white rounded-xl font-semibold text-sm">
                    Lihat Semua WO <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Section CTA (Call to Action) --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-16 lg:py-20">
        <div class="bg-gradient-to-r from-[#8B2A1E] to-[#a03d32] rounded-2xl p-8 md:p-12 text-center text-white">
            <h2 class="font-display text-2xl md:text-3xl font-bold mb-3">
                Siap Menikah di Kota Palu?
            </h2>
            <p class="text-white/80 max-w-xl mx-auto mb-6">
                Dapatkan penawaran terbaik dari WO terpercaya dan wujudkan pernikahan impian Anda.
            </p>
            <a href="{{ url('/daftar-wo') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-[#a03d32] rounded-xl font-semibold hover:bg-gray-100 transition">
                <i class="fa-solid fa-magnifying-glass mr-2"></i> Cari WO Sekarang
            </a>
        </div>
    </div>

</div>

<style>
    /* Animasi Halus */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    .animate-float { animation: float 6s ease-in-out infinite; }

    @keyframes fadeUp {
        0% { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-up { animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

    .font-display { font-family: 'Playfair Display', serif; }
    .font-body { font-family: 'DM Sans', sans-serif; }
</style>
@endsection
