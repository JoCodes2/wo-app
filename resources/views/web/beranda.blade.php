@extends('layouts-ui.base')

@section('content')
<div class="min-h-screen bg-[#fdf8f5]">

    {{-- Hero Section --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-[#fce8e8] via-[#fdf5f5] to-[#fce4d6]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 md:py-16 lg:py-20">
            <div class="grid md:grid-cols-2 gap-8 lg:gap-12 items-center">
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
                    </div>
                </div>

                <div class="relative mt-8 md:mt-0">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?w=600"
                             alt="Wedding Decoration"
                             class="w-full h-64 sm:h-80 md:h-96 object-cover">
                    </div>
                    <div class="absolute -bottom-4 -left-4 bg-white rounded-xl p-3 shadow-lg">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-star text-yellow-400"></i>
                            <span class="font-bold text-gray-900">4.9/5</span>
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
                    <p class="text-gray-500 mt-2 text-sm">Rekomendasi WO dengan rating tertinggi di Kota Palu</p>
                </div>
                <a href="{{ url('/daftar-wo') }}" class="mt-4 sm:mt-0 text-[#a03d32] font-semibold hover:underline flex items-center gap-1 text-sm">
                    Lihat semua <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div id="recommendationWrapper">
                {{-- Skeleton Loading --}}
                <div id="recommendationSkeleton" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @for ($i = 0; $i < 4; $i++)
                    <div class="bg-white rounded-[20px] p-4 border border-[#f0ddd8] animate-pulse">
                        <div class="w-full h-40 bg-gray-200 rounded-xl mb-4"></div>
                        <div class="h-4 bg-gray-200 rounded w-3/4 mb-2"></div>
                        <div class="h-3 bg-gray-200 rounded w-1/2 mb-4"></div>
                        <div class="h-10 bg-gray-200 rounded-xl w-full"></div>
                    </div>
                    @endfor
                </div>

                {{-- Data Container --}}
                <div id="recommendationContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 hidden"></div>

                {{-- Empty State --}}
                <div id="recommendationEmpty" class="hidden text-center py-12">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-store-slash text-2xl text-gray-400"></i>
                    </div>
                    <p class="text-gray-500 font-medium">Belum ada rekomendasi WO saat ini.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Section CTA --}}
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
    .font-display { font-family: 'Playfair Display', serif; }
    .font-body { font-family: 'DM Sans', sans-serif; }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        const loadTopRecommendations = async () => {
            const $skeleton = $('#recommendationSkeleton');
            const $container = $('#recommendationContainer');
            const $empty = $('#recommendationEmpty');

            try {
                const response = await $.ajax({
                    url: `${appUrl}/landing/top-wo`,
                    method: 'GET'
                });

                $skeleton.addClass('hidden');

                if (!response.data || response.data.length === 0) {
                    $empty.removeClass('hidden');
                    return;
                }

                $container.empty().removeClass('hidden');

                response.data.forEach(item => {
                    const rating = item.rating_rata_rata ? parseFloat(item.rating_rata_rata).toFixed(1) : '0.0';
                    const price = new Intl.NumberFormat('id-ID').format(item.harga_min);
                    const logo = item.foto_logo ? `${appUrl}/uploads/logo/${item.foto_logo}` : `${appUrl}/assets/img/default-logo.png`;

                    const card = `
                        <div class="group bg-white rounded-[20px] overflow-hidden border border-[#f0ddd8] transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col">
                            <div class="relative h-48 overflow-hidden bg-gray-50 flex items-center justify-center">
                                <img src="${logo}" class="max-h-32 max-w-full object-contain p-4 transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur px-2 py-1 rounded-full shadow-sm flex items-center gap-1 text-amber-500 font-bold text-xs">
                                    <i class="fa-solid fa-star text-yellow-400"></i> ${rating}
                                </div>
                            </div>
                            <div class="p-5 flex flex-col flex-1">
                                <h3 class="font-display font-bold text-gray-900 text-base group-hover:text-[#a03d32] transition-colors line-clamp-1">
                                    ${item.nama_wo}
                                </h3>
                                <div class="flex items-center gap-2 text-[10px] text-gray-400 mt-1 mb-3">
                                    <i class="fa-solid fa-location-dot text-[#a03d32]"></i>
                                    <span class="line-clamp-1">${item.alamat_wo}</span>
                                </div>
                                <div class="mt-auto pt-4 border-t border-[#f0ddd8] flex items-center justify-between">
                                    <div>
                                        <p class="text-[9px] text-gray-400 uppercase font-bold">Mulai dari</p>
                                        <p class="font-display font-bold text-base text-[#a03d32]">Rp ${price}</p>
                                    </div>
                                    <a href="${appUrl}/detail-wo/${item.id}" class="w-10 h-10 bg-gray-900 text-white rounded-xl flex items-center justify-center hover:bg-[#a03d32] transition-colors">
                                        <i class="fa-solid fa-arrow-right text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>`;
                    $container.append(card);
                });
            } catch (error) {
                console.error("Gagal memuat rekomendasi:", error);
                $skeleton.addClass('hidden');
                $empty.removeClass('hidden').find('p').text('Gagal memuat data. Silakan coba lagi nanti.');
            }
        };

        loadTopRecommendations();
    });
</script>
@endsection
