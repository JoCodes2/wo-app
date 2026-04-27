class ProposalpengajuanService {
    constructor() {
        this.table = $('#ProposalpengajuanTable');
        this.allData = [];
    }

    ajaxRequest(url, method, data = null) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url,
                method,
                data,
                processData: method === 'GET' ? true : false,
                contentType: method === 'GET' ? 'application/x-www-form-urlencoded' : false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => resolve(response),
                error: (xhr) => reject(xhr)
            });
        });
    }

    formatTanggal(dateString) {
        if (!dateString) return '-';
        return new Date(dateString).toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        });
    }

    async getAllData() {
        if (!$.fn.dataTable.isDataTable(this.table)) {
            this.table.DataTable({
                pageLength: 10,
                responsive: true,
                ordering: false,
                language: {
                    // Menggunakan template custom sesuai permintaan Anda
                    emptyTable: `
                        <div class="py-5 text-center">
                            <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle"
                                 style="width: 100px; height: 100px; background-color: #e8ebff;">
                                <i class="fa-solid fa-file-circle-exclamation fa-3x" style="color: #696cff;"></i>
                            </div>

                            <h5 class="fw-bold" style="color: #566a7f;">Belum Ada Data Proposal</h5>

                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="alert shadow-none mb-0"
                                         style="background-color: #e8ebff; border: none; border-left: 5px solid #0026ff; border-radius: 8px;">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-circle-info fs-4 me-3" style="color: #0026ff;"></i>
                                            <div class="text-start" style="color: #697a8d; font-size: 0.9rem;">
                                                Sistem tidak menemukan pengajuan proposal yang aktif atau sesuai dengan filter Anda.
                                                Pastikan status kegiatan sudah <strong>Dipublikasikan</strong>.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`
                }
            });
        }

        try {
            const response = await this.ajaxRequest(`${appUrl}/ikp/proposal_pengajuan/`, 'GET');
            this.allData = response.data || [];
            this.renderTable(this.allData);
        } catch (error) {
            console.error('Gagal memuat data:', error);
            this.renderTable([]); // Tetap panggil render agar emptyTable muncul jika error
        }
    }

    renderTable(data) {
        let datatable = this.table.DataTable();
        datatable.clear();

        if (data && data.length > 0) {
            const isAdmin = window.userRole === 'admin';

            const grouped = data.reduce((acc, item) => {
                const key = item.kegiatan?.judul_kegiatan || 'Tanpa Judul Kegiatan';
                if (!acc[key]) acc[key] = [];
                acc[key].push(item);
                return acc;
            }, {});

            let globalIndex = 1;

            Object.keys(grouped).forEach((judulKegiatan) => {
                const proposals = grouped[judulKegiatan];

                const headerRow = datatable.row.add([
                    `<div class="fw-bold text-primary"><i class="fa-solid fa-layer-group me-2"></i>KEGIATAN: ${judulKegiatan.toUpperCase()}</div>`,
                    '', '', '', ''
                ]).node();
                $(headerRow).addClass('table-light').find('td:first').attr('colspan', 5).nextAll().remove();

                proposals.forEach((item) => {
                    const statusConfig = {
                        diajukan: { class: 'bg-label-info', icon: 'fa-solid fa-clock', text: 'Diajukan' },
                        ditinjau: { class: 'bg-label-warning', icon: 'fa-solid fa-eye', text: 'Ditinjau' },
                        disetujui: { class: 'bg-label-success', icon: 'fa-solid fa-check', text: 'Disetujui' },
                        ditolak: { class: 'bg-label-danger', icon: 'fa-solid fa-xmark', text: 'Ditolak' }
                    };

                    const config = statusConfig[item.status_proposal] || { class: 'bg-label-secondary', icon: 'fa-solid fa-question', text: item.status_proposal };

                    const infoProposal = `
                        <div class="fw-bold text-dark">${item.judul_proposal}</div>
                        <small class="text-muted"><i class="fa-solid fa-newspaper me-1 small"></i>${item.media_partner?.nama_media || '-'}</small>
                    `;

                    const actions = `
                        <div class="d-flex justify-content-center gap-1">
                            <button class="btn btn-outline-primary btn-sm btnDetailProposal" data-id="${item.id}" title="Detail">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            ${isAdmin && ['diajukan', 'ditinjau'].includes(item.status_proposal) ? `
                                <button class="btn btn-outline-success btn-sm btnUpdateStatus" data-id="${item.id}" data-status="disetujui">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm btnUpdateStatus" data-id="${item.id}" data-status="ditolak">
                                    <i class="fa-solid fa-times"></i>
                                </button>
                            ` : ''}
                        </div>`;

                    datatable.row.add([
                        globalIndex++,
                        this.formatTanggal(item.tanggal_pengajuan),
                        infoProposal,
                        `<span class="badge ${config.class} border-0 text-uppercase"><i class="${config.icon} me-1 small"></i>${config.text}</span>`,
                        actions
                    ]);
                });
            });
        }

        // WAJIB: draw() harus di luar blok IF agar saat data kosong, pesan emptyTable tetap muncul
        datatable.draw();
    }

    applyFilters() {
        const filterStatus = $('#filterStatus').val();
        const mulai = $('#filterTanggalMulai').val();
        const selesai = $('#filterTanggalSelesai').val();

        let filtered = [...this.allData];

        if (filterStatus) {
            filtered = filtered.filter(item => item.status_proposal === filterStatus);
        }

        if (mulai && selesai) {
            const start = new Date(mulai).setHours(0, 0, 0, 0);
            const end = new Date(selesai).setHours(23, 59, 59, 999);
            filtered = filtered.filter(item => {
                const itemDate = new Date(item.tanggal_pengajuan).getTime();
                return itemDate >= start && itemDate <= end;
            });
        }

        this.renderTable(filtered);
    }
    async getDataById(id) {
        try {
            loadingAllert('Mengambil data...');
            const response = await this.ajaxRequest(`${appUrl}/ikp/proposal_pengajuan/get/${id}`, 'GET');
            const data = response.data;
            Swal.close();

            // Isi Modal Detail
            $('#detailTitle').text(data.judul_proposal || '-');
            $('#detailIdShort').text(data.id ? data.id.substring(0, 8).toUpperCase() : '-');
            $('#detailCreatedAt').text(this.formatTanggal(data.tanggal_pengajuan));
            $('#detailKegiatan').text(data.kegiatan?.judul_kegiatan || '-');
            $('#detailInstansi').text(data.kegiatan?.asal_instansi || '-');
            $('#detailDescription').text(data.deskripsi_proposal || '-');
            $('#detailCatatanMedia').text(data.catatan_media || '-');

            // Verifikator
            $('#detailDiverifikasiOleh').text(data.diverifikasi_oleh?.nama_lengkap || '-');
            $('#detailTanggalVerifikasi').text(this.formatTanggal(data.tanggal_verifikasi));

            const statusConfig = { diajukan: 'bg-label-info', ditinjau: 'bg-label-warning', disetujui: 'bg-label-success', ditolak: 'bg-label-danger' };
            $('#detailStatusBadge').html(`<span class="badge ${statusConfig[data.status_proposal] || 'bg-label-secondary'} px-3 py-2 text-uppercase">${data.status_proposal}</span>`);

            if (data.file_proposal) {
                const fileLink = `${appUrl}/uploads/proposal-pengajuan/${data.file_proposal}`;
                $('#detailFileProposal').html(`
                    <div class="d-flex align-items-center justify-content-between p-2 border rounded bg-white shadow-sm">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-file-pdf text-danger fa-2x me-3"></i>
                            <span class="small fw-bold text-truncate" style="max-width: 150px;">Berkas Proposal</span>
                        </div>
                        <a href="${fileLink}" target="_blank" class="btn btn-sm btn-primary px-3">Buka</a>
                    </div>`);
            } else {
                $('#detailFileProposal').html('<span class="text-muted small">Tidak ada lampiran berkas</span>');
            }

            $('#modalDetailProposal').modal('show');

        } catch (error) {
            Swal.close();
            errorAlert("Gagal mengambil detail proposal.");
        }
    }

    async updateStatus(id, status) {
        confirmAlert(
            `Apakah Anda yakin ingin mengubah status proposal ini menjadi ${status.toUpperCase()}?`,
            async () => {
                try {
                    loadingAllert('Memproses...');
                    await $.ajax({
                        url: `${appUrl}/ikp/proposal_pengajuan/update-status/${id}`,
                        method: 'POST',
                        data: { status_proposal: status },
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                    });
                    Swal.close();
                    await successAlert('Status berhasil diperbarui');
                    this.getAllData(); // Refresh table
                } catch (error) {
                    Swal.close();
                    errorAlert("Gagal memperbarui status.");
                }
            }
        );
    }
}

export default ProposalpengajuanService;
