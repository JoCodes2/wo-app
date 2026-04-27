import KegiatanService from "../services/kegiatan.service.js";

$(document).ready(function () {
    const kegiatan = new KegiatanService();

    // Override table ID for this page
    kegiatan.table = $('#KelolaKegiatanTable');

    async function loadPublishedKegiatan() {
        if (!$.fn.dataTable.isDataTable(kegiatan.table)) {
            kegiatan.table.DataTable({
                pageLength: 10,
                responsive: true,
                language: { emptyTable: kegiatan.emptyTableTemplate() },
                columnDefs: [
                    { targets: [5], orderable: false },
                    { targets: [0, 4, 5], className: 'text-center align-middle' },
                    { targets: [1, 2, 3], className: 'align-middle' }
                ]
            });
        }

        const datatable = kegiatan.table.DataTable();
        datatable.clear();

        try {
            const response = await kegiatan.ajaxRequest(`${appUrl}/ikp/kegiatan/publish-kegiatan`, 'GET');
            const kegiatanData = response.data || [];

            kegiatanData.forEach((item, index) => {
                const statusBadge = `<span class="badge bg-label-success text-capitalize px-3 py-2"><i class="fa-solid fa-circle-check me-1"></i>Dipublikasikan</span>`;

                const actionButtons = `
                    <a href="${appUrl}/kelola_kegiatan/${item.id}" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-tasks me-1"></i> Kelola Proposal & Tiket
                    </a>
                `;

                const tanggal = item.tanggal_kegiatan ? new Date(item.tanggal_kegiatan).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' }) : '-';
                const judulKegiatan = `<div><div class="fw-semibold text-dark">${item.judul_kegiatan ?? '-'}</div><small class="text-muted">${item.deskripsi_kegiatan ?? ''}</small></div>`;
                const lokasi = item.lokasi ? `<div class="d-flex align-items-center"><i class="fa-solid fa-location-dot text-danger me-2"></i><span>${item.lokasi}</span></div>` : '-';

                datatable.row.add([
                    index + 1,
                    judulKegiatan,
                    tanggal,
                    lokasi,
                    statusBadge,
                    actionButtons
                ]);
            });

            datatable.draw();
        } catch (error) {
            console.error('Gagal memuat data kegiatan:', error);
        }
    }

    loadPublishedKegiatan();
});
