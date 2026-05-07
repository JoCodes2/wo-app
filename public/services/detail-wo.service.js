class ProfileService {
    constructor() {
        this.dom = {
            loading: $('#loading-state'),
            content: $('#main-content'),
            name: $('#wo-name'),
            logo: $('#wo-logo'),
            desc: $('#wo-description'),
            ratingAvg: $('#wo-rating-avg'),
            ratingVal: $('#wo-rating-val'),
            totalUlasanHead: $('#wo-total-ulasan-head'),
            totalUlasanBody: $('#wo-total-ulasan-body'),
            alamat: $('#wo-alamat'),
            waLink: $('#wo-wa-link'),
            igLink: $('#wo-ig-link'),
            btnWa: $('#btn-wa-action'),
            statUlasan: $('#stat-ulasan'),
            statLayanan: $('#stat-layanan'),
            gallery: $('#wo-gallery-container'),
            layanan: $('#wo-layanan-container'),
            ulasan: $('#wo-ulasan-container'),
            starsHead: $('#stars-container-head'),
            filterContainer: $('#kategori-filter-container')
        };
        this.allLayanans = [];
    }

    ajaxRequest(url, method, data = null) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url,
                method,
                data,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: (res) => resolve(res),
                error: (err) => reject(err)
            });
        });
    }

    formatWhatsApp(phone) {
        if (!phone) return '#';
        let cleaned = phone.replace(/[^0-9]/g, '');
        if (cleaned.startsWith('0')) cleaned = '62' + cleaned.substring(1);
        else if (!cleaned.startsWith('62')) cleaned = '62' + cleaned;
        return `https://wa.me/${cleaned}`;
    }

    async getProfileData(id) {
        try {
            const cleanAppUrl = appUrl.endsWith('/') ? appUrl.slice(0, -1) : appUrl;
            const response = await this.ajaxRequest(`${cleanAppUrl}/landing/wo/${id}`, 'GET');

            if (response.data) {
                const data = response.data;
                this.allLayanans = data.layanans || [];

                this.renderProfile(data);

                const uniqueCategories = [];
                const map = new Map();
                for (const item of this.allLayanans) {
                    if (item.kategori && !map.has(item.kategori.id)) {
                        map.set(item.kategori.id, true);
                        uniqueCategories.push(item.kategori);
                    }
                }
                this.renderFilterKategori(uniqueCategories);
            }
        } catch (error) {
            console.error(error);
        } finally {
            this.dom.loading.addClass('hidden');
            this.dom.content.removeClass('hidden');
        }
    }

    renderFilterKategori(categories) {
        this.dom.filterContainer.empty();
        if (categories.length === 0) return;

        this.dom.filterContainer.addClass('flex overflow-x-auto pb-2 gap-2 no-scrollbar -mx-4 px-4 md:mx-0 md:px-0 md:flex-wrap');

        const btnAll = $(`<button class="whitespace-nowrap px-4 py-1.5 rounded-full text-xs md:text-sm border border-[#a03d32] bg-[#a03d32] text-white transition-all shadow-sm" data-id="all">Semua</button>`);
        this.dom.filterContainer.append(btnAll);

        categories.forEach(cat => {
            const btn = $(`<button class="whitespace-nowrap px-4 py-1.5 rounded-full text-xs md:text-sm border border-[#f0ddd8] text-gray-600 hover:border-[#a03d32] hover:text-[#a03d32] transition-all" data-id="${cat.id}">${cat.nama_kategori}</button>`);
            this.dom.filterContainer.append(btn);
        });

        const self = this;
        this.dom.filterContainer.off('click').on('click', 'button', function () {
            const catId = $(this).data('id');
            self.dom.filterContainer.find('button').removeClass('bg-[#a03d32] text-white').addClass('text-gray-600 border-[#f0ddd8]');
            $(this).addClass('bg-[#a03d32] text-white').removeClass('text-gray-600 border-[#f0ddd8]');

            const filtered = catId === 'all' ? self.allLayanans : self.allLayanans.filter(l => l.kategori_id == catId);
            self.renderLayananItems(filtered);
        });
    }

    renderLayananItems(layanans) {
        const cleanAppUrl = appUrl.endsWith('/') ? appUrl.slice(0, -1) : appUrl;
        this.dom.layanan.empty();

        if (layanans && layanans.length > 0) {
            this.dom.layanan.addClass('grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4 md:gap-6 items-stretch');
            layanans.forEach(l => {
                const harga = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(l.harga);
                this.dom.layanan.append(`
                    <div class="flex flex-col h-full p-4 md:p-6 border border-[#f0ddd8] rounded-2xl hover:shadow-xl transition-all duration-300 bg-white group">
                        <div class="flex justify-between items-start mb-3 md:mb-4">
                            <span class="px-2 py-1 bg-rose-50 text-[#a03d32] text-[9px] md:text-[10px] font-bold rounded-lg uppercase tracking-wider">
                                ${l.kategori?.nama_kategori || 'Umum'}
                            </span>
                        </div>
                        <div class="mb-3 md:mb-4">
                            <h4 class="font-bold text-gray-900 text-base md:text-lg group-hover:text-[#a03d32] transition-colors mb-1 uppercase">${l.nama_layanan}</h4>
                            <p class="text-[#a03d32] font-black text-xl md:text-2xl">${harga}</p>
                        </div>
                        <div class="flex-grow mb-4 md:mb-6 whitespace-pre-line text-[12px] md:text-[13px] text-gray-600 leading-relaxed bg-gray-50/50 p-3 md:p-4 rounded-xl border border-gray-100/50">
                            ${l.detail_layanan || 'Detail layanan tidak tersedia.'}
                        </div>
                        <a href="${cleanAppUrl}/checkout/${l.id}" class="w-full py-3 md:py-4 bg-gray-900 hover:bg-[#a03d32] text-white text-center rounded-xl text-sm font-bold transition-all shadow-md flex items-center justify-center gap-2">
                            <span>Pesan Sekarang</span>
                            <i class="fa-solid fa-arrow-right-long text-[10px]"></i>
                        </a>
                    </div>
                `);
            });
        } else {
            this.dom.layanan.removeClass('grid').html(`
                <div class="py-16 md:py-24 flex flex-col items-center justify-center border-2 border-dashed border-rose-100 rounded-[2rem] md:rounded-[2.5rem] bg-gradient-to-b from-rose-50/40 to-transparent mx-auto w-full">
                    <div class="relative mb-6">
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-white rounded-2xl md:rounded-3xl rotate-12 shadow-lg flex items-center justify-center border border-rose-50">
                            <i class="fa-solid fa-box-open text-rose-200 text-2xl md:text-3xl -rotate-12"></i>
                        </div>
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 md:w-10 md:h-10 bg-rose-100 rounded-full flex items-center justify-center shadow-md animate-bounce">
                            <i class="fa-solid fa-sparkles text-[#a03d32] text-[10px]"></i>
                        </div>
                    </div>
                    <h3 class="text-gray-900 font-black text-lg md:text-xl mb-2 tracking-tight">Katalog Sedang Diperbarui</h3>
                    <p class="text-gray-500 text-xs md:text-sm text-center max-w-[280px] md:max-w-[340px] leading-relaxed px-4">Kami sedang merancang paket spesial untuk Anda. Silakan eksplorasi kategori lainnya untuk menemukan penawaran terbaik.</p>
                </div>
            `);
        }
    }

    renderProfile(data) {
        const cleanAppUrl = appUrl.endsWith('/') ? appUrl.slice(0, -1) : appUrl;

        this.dom.name.text(data.nama_wo);
        this.dom.desc.text(data.deskripsi_wo);
        this.dom.alamat.text(data.alamat_wo);

        const logoPath = data.foto_logo ? `${cleanAppUrl}/${data.foto_logo}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(data.nama_wo)}&background=a03d32&color=fff`;
        this.dom.logo.attr('src', logoPath);

        const rating = parseFloat(data.rating_rata_rata || 0).toFixed(1);
        this.dom.ratingAvg.text(rating);
        this.dom.ratingVal.text(rating);
        this.dom.totalUlasanHead.text(`(${data.total_vote || 0} ulasan)`);
        this.dom.totalUlasanBody.text(`(${data.total_vote || 0} ulasan)`);
        this.dom.statUlasan.text(`${data.total_vote || 0}+`);
        this.dom.statLayanan.text(data.layanans?.length || 0);

        let starsHtml = '';
        for (let i = 1; i <= 5; i++) {
            starsHtml += `<i class="fa-solid fa-star ${i <= Math.round(rating) ? 'text-yellow-400' : 'text-gray-300'} text-[10px] md:text-xs"></i>`;
        }
        this.dom.starsHead.html(starsHtml);

        const waUrl = this.formatWhatsApp(data.kontak);
        this.dom.waLink.attr('href', waUrl).text(data.kontak || '-');
        this.dom.btnWa.attr('href', waUrl);
        this.dom.igLink.attr('href', `https://instagram.com/${data.sosial_media?.replace('@', '')}`).text(data.sosial_media || '-');

        this.renderLayananItems(data.layanans);

        this.dom.gallery.empty();
        this.dom.gallery.addClass('grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4');
        if (data.galeris && data.galeris.length > 0) {
            data.galeris.forEach(g => {
                const keterangan = g.keterangan || 'Momen Spesial';
                this.dom.gallery.append(`
                    <div class="group relative rounded-xl md:rounded-2xl overflow-hidden border border-[#f0ddd8] aspect-square bg-gray-100 shadow-sm">
                        <img src="${cleanAppUrl}/${g.foto_portofolio}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-3 md:p-4">
                            <p class="text-white text-[7px] md:text-[9px] font-bold uppercase tracking-widest mb-1 opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-500 delay-100 italic">
                                Dokumentasi
                            </p>
                            <h5 class="text-white font-bold text-[10px] md:text-sm opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-500 delay-200 uppercase leading-tight line-clamp-2 md:line-clamp-2 whitespace-normal">
                                ${keterangan}
                            </h5>
                        </div>
                    </div>
                `);
            });
        } else {
            this.dom.gallery.removeClass('grid').html(`
                <div class="w-full py-12 md:py-16 flex flex-col items-center justify-center bg-gray-50/50 rounded-2xl md:rounded-3xl border border-dashed border-gray-200">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white rounded-full flex items-center justify-center shadow-sm mb-4 border border-gray-100">
                        <i class="fa-solid fa-camera-retro text-gray-200 text-xl md:text-2xl"></i>
                    </div>
                    <p class="text-gray-400 text-[10px] md:text-xs font-medium uppercase tracking-widest italic text-center px-4">Belum Ada Portofolio Tersedia</p>
                </div>
            `);
        }

        this.dom.ulasan.empty();
        if (data.ulasans && data.ulasans.length > 0) {
            data.ulasans.forEach(u => {
                const relasiLayanan = data.layanans.find(l =>
                    l.pemesanans && l.pemesanans.some(p => p.id === u.pemesanan_id)
                );
                const namaPaket = relasiLayanan ? relasiLayanan.nama_layanan : 'Paket Menarik';

                let uStars = '';
                for (let i = 1; i <= 5; i++) {
                    uStars += `<i class="fa-solid fa-star ${i <= u.rating ? 'text-yellow-400' : 'text-gray-200'} text-[9px] md:text-[10px]"></i>`;
                }

                this.dom.ulasan.append(`
                    <div class="p-4 md:p-5 bg-white rounded-2xl border border-[#f0ddd8] mb-4 shadow-sm hover:border-[#a03d32]/30 transition-all duration-300">
                        <div class="flex flex-wrap justify-between items-start gap-2 mb-3">
                            <div class="flex items-center gap-2 md:gap-3">
                                <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-gradient-to-br from-[#a03d32] to-[#802d25] flex items-center justify-center text-white font-bold text-xs md:text-sm uppercase shadow-md shrink-0">
                                    ${(u.user?.nama_lengkap || 'U').charAt(0)}
                                </div>
                                <div class="min-w-0">
                                    <p class="font-black text-xs md:text-sm text-gray-900 truncate">${u.user?.nama_lengkap || 'Pelanggan Setia'}</p>
                                    <div class="flex flex-wrap items-center gap-1.5 md:gap-2 mt-0.5">
                                        <div class="flex gap-0.5 shrink-0">${uStars}</div>
                                        <span class="text-[8px] md:text-[9px] px-2 py-0.5 bg-rose-50 text-[#a03d32] rounded-full font-extrabold uppercase tracking-tight truncate">
                                            ${namaPaket}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <span class="text-[9px] md:text-[10px] text-gray-400 font-semibold whitespace-nowrap">${new Date(u.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'short' })}</span>
                        </div>
                        <p class="text-[12px] md:text-[13px] text-gray-600 italic leading-relaxed border-l-2 border-rose-100 pl-3 md:pl-4 ml-4 md:ml-10">"${u.komentar}"</p>
                    </div>
                `);
            });
        } else {
            this.dom.ulasan.html(`
                <div class="py-16 md:py-20 flex flex-col items-center justify-center text-center bg-white rounded-[2rem] md:rounded-[2.5rem] border border-[#f0ddd8] shadow-sm px-6">
                    <div class="w-20 h-20 md:w-24 md:h-24 bg-rose-50/50 rounded-full flex items-center justify-center mb-4 md:mb-6 relative">
                        <i class="fa-solid fa-heart text-[#a03d32] text-3xl md:text-4xl opacity-10"></i>
                        <i class="fa-solid fa-quote-left absolute top-2 right-2 text-[#a03d32] text-xs opacity-40 animate-pulse"></i>
                    </div>
                    <h4 class="text-gray-900 font-black text-lg md:text-xl tracking-tight">Nantikan Cerita Bahagia</h4>
                    <p class="text-gray-500 text-xs md:text-sm mt-2 max-w-[280px] leading-relaxed">Ulasan pelanggan akan muncul di sini sebagai bukti cinta mereka pada layanan kami.</p>
                </div>
            `);
        }
    }
}

export default ProfileService;
