class LandingService {
    constructor() {
        this.woGrid = $('#woGrid');
        this.woSkeleton = $('#woSkeleton');
        this.emptyState = $('#emptyState');
        this.paginationContainer = $('#paginationContainer');
    }

    async applyFilter(params) {
        try {
            this.toggleLoading(true);
            const cleanParams = Object.fromEntries(
                Object.entries(params).filter(([_, v]) => v !== "" && v !== null)
            );

            const response = await $.ajax({
                url: `${appUrl}/landing/wo`,
                method: 'GET',
                data: cleanParams
            });

            const { list, meta } = response.data;
            $('#woCount').text(meta.total);
            this.renderGrid(list);
            this.renderPagination(meta);
        } catch (error) {
            this.renderGrid([]);
        } finally {
            this.toggleLoading(false);
        }
    }

    renderGrid(data) {
        this.woGrid.empty();
        if (!data || data.length === 0) {
            this.woGrid.addClass('hidden');
            this.emptyState.removeClass('hidden');
            this.paginationContainer.addClass('hidden');
            return;
        }

        this.emptyState.addClass('hidden');
        this.woGrid.removeClass('hidden');
        this.paginationContainer.removeClass('hidden');

        data.forEach(item => {
            const minPrice = new Intl.NumberFormat('id-ID').format(item.range_harga.min);
            const logo = item.foto_logo ? `${appUrl}/uploads/logo/${item.foto_logo}` : `${appUrl}/assets/img/default-logo.png`;

            const card = `
                <div class="group bg-white rounded-2xl border border-[#f0ddd8] overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="relative h-52 bg-gray-50 flex items-center justify-center">
                        <img src="${logo}" class="max-h-full max-w-full object-contain p-4 transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full shadow-sm flex items-center gap-1">
                            <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                            <span class="text-xs font-bold text-gray-900">${item.rating}</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 group-hover:text-[#a03d32] transition-colors line-clamp-1">${item.nama_wo}</h3>
                        <p class="text-xs text-gray-500 mt-1 mb-4"><i class="fa-solid fa-location-dot me-1 text-[#a03d32]"></i> ${item.alamat_wo}</p>
                        <div class="flex items-center justify-between border-t border-[#f0ddd8] pt-4">
                            <div>
                                <p class="text-[10px] text-gray-400 uppercase font-semibold">Mulai dari</p>
                                <p class="text-sm font-bold text-[#a03d32]">Rp ${minPrice}</p>
                            </div>
                            <a href="${appUrl}/profile-wo/${item.id}" class="px-4 py-2 bg-gray-900 text-white text-xs font-semibold rounded-xl hover:bg-[#a03d32] transition-colors">Detail</a>
                        </div>
                    </div>
                </div>`;
            this.woGrid.append(card);
        });
    }

    renderPagination(meta) {
        const pageNumbers = $('#pageNumbers');
        pageNumbers.empty();

        $('#prevPage').prop('disabled', meta.current_page === 1).data('page', meta.current_page - 1);
        $('#nextPage').prop('disabled', meta.current_page === meta.last_page).data('page', meta.current_page + 1);

        for (let i = 1; i <= meta.last_page; i++) {
            const activeClass = i === meta.current_page ? 'bg-[#a03d32] text-white border-[#a03d32]' : 'border-[#f0ddd8] text-gray-500 hover:bg-rose-50 hover:text-[#a03d32]';
            pageNumbers.append(`<button class="page-btn w-10 h-10 flex items-center justify-center rounded-xl border text-sm font-bold transition-all ${activeClass}" data-page="${i}">${i}</button>`);
        }
    }

    toggleLoading(isLoading) {
        if (isLoading) {
            this.woSkeleton.removeClass('hidden');
            this.woGrid.addClass('hidden');
            this.paginationContainer.addClass('hidden');
        } else {
            this.woSkeleton.addClass('hidden');
        }
    }
}
export default LandingService;
