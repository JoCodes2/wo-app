class DashboardService {
    constructor() {
        this.container = $('#dashboardKegiatanContainer');
    }

    emptyStateTemplate() {
        return `
            <div class="col-12 text-center py-5">
                <div class="mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-label-secondary" style="width: 120px; height: 120px;">
                        <i class="fa-solid fa-calendar-day fa-4x text-secondary opacity-50"></i>
                    </div>
                </div>
                <h4 class="fw-bold text-dark">Belum Ada Jadwal Peliputan</h4>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <p class="text-muted fs-6">
                            Saat ini sistem tidak menemukan kegiatan yang membutuhkan peliputan media.
                        </p>
                        <button type="button" class="btn btn-primary btn-sm mt-2" onclick="location.reload()">
                            <i class="fa-solid fa-sync me-1"></i> Perbarui Halaman
                        </button>
                    </div>
                </div>
            </div>`;
    }

    ajaxRequest(url, method, data = null) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url,
                method,
                data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => resolve(response),
                error: (xhr) => reject(xhr)
            });
        });
    }

    formatTanggalIndo(dateString) {
        if (!dateString) return '-';
        return new Date(dateString).toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
    }

    formatWita(timeString) {
        if (!timeString) return '00:00';
        const [hours, minutes] = timeString.split(':');
        return `${hours}:${minutes} WITA`;
    }

    async getPublishedKegiatan(filters = {}) {
        try {
            this.container.html(`
                <div class="col-12 text-center py-5">
                    <div class="spinner-border text-primary mb-3" role="status" style="width: 3rem; height: 3rem;"></div>
                    <h6 class="text-muted fw-light">Menyinkronkan jadwal peliputan terbaru...</h6>
                </div>
            `);

            const response = await this.ajaxRequest(`${appUrl}/ikp/kegiatan/publish-kegiatan`, 'GET', filters);
            const data = response.data || [];
            this.renderCards(data);
        } catch (error) {
            this.container.html(this.emptyStateTemplate());
        }
    }

    renderCards(data) {
        this.container.empty();

        if (data.length === 0) {
            this.container.html(this.emptyStateTemplate());
            return;
        }

        data.forEach((item) => {
            const tglMulai = this.formatTanggalIndo(item.tanggal_kegiatan);
            const waktuMulai = this.formatWita(item.waktu_mulai);
            const isSubmitted = item.is_submitted === true || item.is_submitted === 1;

            const kategoriBadges = item.kategori_media?.length
                ? item.kategori_media.map(k => `
                <span class="badge bg-label-primary text-primary me-1 mb-1 border-0 shadow-none" style="font-size: 0.75rem;">
                    <i class="fa-solid fa-tag me-1 small"></i>${k.nama_kategori}
                </span>`).join('')
                : '<span class="text-muted small italic">Kebutuhan umum</span>';

            const btnAjukanHtml = isSubmitted
                ? `<button class="btn btn-secondary btn-sm w-100 fw-bold border-0" disabled style="background-color: #e9ecef !important; color: #6c757d !important;">
                    <i class="fa-solid fa-check-double me-2"></i>Sudah Diajukan
                   </button>`
                : `<button class="btn btn-primary btn-sm w-100 fw-bold btnBukaPengajuan" data-id="${item.id}">
                    <i class="fa-solid fa-paper-plane me-2"></i>Ajukan Proposal
                   </button>`;

            const cardHtml = `
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 border-0 shadow-sm card-hover-shadow" style="border-radius: 15px; overflow: hidden;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-label-success text-success fw-bold px-3 py-2 rounded-pill">
                                <i class="fa-solid fa-check-circle me-1"></i> Terbit
                            </span>
                            <span class="text-dark fw-bold small"><i class="fa-regular fa-clock me-1 text-primary"></i>${waktuMulai}</span>
                        </div>
                        <h5 class="card-title fw-bold text-dark mb-2">${item.judul_kegiatan}</h5>
                        <p class="card-text text-muted small mb-4" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 3em;">
                            ${item.deskripsi_kegiatan ?? 'Ketuk tombol detail untuk melihat deskripsi lengkap.'}
                        </p>
                        <div class="p-3 mb-4" style="background-color: #f8f9fa; border-radius: 12px; border: 1px dashed #dee2e6;">
                            <div class="d-flex align-items-center mb-2 small">
                                <i class="fa-solid fa-calendar-day text-primary me-3" style="width: 15px;"></i>
                                <span class="text-dark fw-semibold">${tglMulai}</span>
                            </div>
                            <div class="d-flex align-items-center mb-2 small">
                                <i class="fa-solid fa-location-dot text-danger me-3" style="width: 15px;"></i>
                                <span class="text-dark text-truncate fw-semibold">${item.lokasi ?? '-'}</span>
                            </div>
                        </div>
                        <div class="mb-0">
                            <label class="small fw-bold text-uppercase text-muted mb-2" style="font-size: 0.65rem; letter-spacing: 1px;">Kategori Media:</label>
                            <div class="d-flex flex-wrap">${kategoriBadges}</div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 p-4 pt-0">
                        <div class="d-flex gap-2">
                            <button class="btn btn-label-primary btn-sm px-3 btnDetailDashboard" data-id="${item.id}">
                                <i class="fa-solid fa-info-circle"></i>
                            </button>
                            ${btnAjukanHtml}
                        </div>
                    </div>
                </div>
            </div>`;
            this.container.append(cardHtml);
        });

        const self = this;
        $('.btnBukaPengajuan').on('click', function () {
            window.location.href = `${appUrl}/pengajuan-proposal/${$(this).data('id')}`;
        });

        $('.btnDetailDashboard').on('click', function () {
            self.getDetailKegiatan($(this).data('id'));
        });
    }

    async getDetailKegiatan(id) {
        try {
            loadingAllert('Memuat rincian...');
            const response = await this.ajaxRequest(`${appUrl}/ikp/kegiatan/get/${id}`, 'GET');
            Swal.close();
            this.fillDetailModal(response.data);
            $('#modalDetailKegiatan').modal('show');
        } catch (error) {
            Swal.close();
            errorAlert('Gagal memuat rincian data.');
        }
    }

    fillDetailModal(data) {
        const tglMulai = this.formatTanggalIndo(data.tanggal_kegiatan);
        const tglSelesai = data.tanggal_akhir_kegiatan ? ` s/d ${this.formatTanggalIndo(data.tanggal_akhir_kegiatan)}` : '';
        const waktu = `${this.formatWita(data.waktu_mulai)} - ${this.formatWita(data.waktu_selesai)}`;

        const kategoriBadges = data.kategori_media?.length
            ? data.kategori_media.map(k => `<span class="badge bg-label-primary me-1">${k.nama_kategori}</span>`).join('')
            : '-';

        const content = `
            <div class="row g-3 p-2">
                <div class="col-12 border-bottom pb-3 mb-2">
                    <h5 class="fw-bold text-primary mb-1">${data.judul_kegiatan}</h5>
                    <div class="d-flex flex-wrap gap-2 align-items-center mt-2">
                         <span class="badge bg-label-secondary small"><i class="fa-solid fa-hashtag me-1"></i>${data.nomor_surat ?? '-'}</span>
                         <span class="badge bg-label-info small"><i class="fa-solid fa-building me-1"></i>${data.asal_instansi ?? '-'}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="small text-muted d-block">Waktu Pelaksanaan</label>
                    <p class="fw-bold text-dark mb-0"><i class="fa-solid fa-clock me-2 text-primary"></i>${waktu}</p>
                </div>
                <div class="col-md-6">
                    <label class="small text-muted d-block">Tanggal Kegiatan</label>
                    <p class="fw-bold text-dark mb-0"><i class="fa-solid fa-calendar-days me-2 text-primary"></i>${tglMulai}${tglSelesai}</p>
                </div>
                <div class="col-12">
                    <label class="small text-muted d-block">Lokasi Detail</label>
                    <p class="fw-bold text-dark mb-0"><i class="fa-solid fa-map-location-dot me-2 text-danger"></i>${data.lokasi ?? '-'}</p>
                </div>
                <div class="col-12">
                    <label class="small text-muted d-block mb-1">Kategori Media yang Dibutuhkan</label>
                    <div>${kategoriBadges}</div>
                </div>
                <div class="col-12 mt-3">
                    <div class="p-3 bg-light rounded-3 shadow-none border">
                        <label class="small text-muted d-block fw-bold text-uppercase mb-2" style="font-size: 0.7rem;">Deskripsi & Ketentuan</label>
                        <div style="text-align: justify; line-height: 1.6; font-size: 0.9rem;">
                            ${data.deskripsi_kegiatan ?? 'Tidak ada deskripsi detail.'}
                        </div>
                    </div>
                </div>
            </div>`;
        $('#detailContent').html(content);
    }
}

export default DashboardService;
