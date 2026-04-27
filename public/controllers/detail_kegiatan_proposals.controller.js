import KegiatanService from "../services/kegiatan.service.js";
import TiketService from "../services/tiket.service.js";

$(document).ready(function () {
    const kegiatanService = new KegiatanService();
    const tiketService = new TiketService();
    const kegiatanId = $('#kegiatan_id_param').val();
    const proposalTable = $('#ProposalAccTable');

    async function loadEventDetail() {
        try {
            const response = await kegiatanService.ajaxRequest(`${appUrl}/ikp/kegiatan/detail-proposals/${kegiatanId}`, 'GET');
            const data = response.data;

            if (data) {
                // Render Event Info
                $('#eventTitle').text(data.judul_kegiatan);
                $('#eventLocation').text(data.lokasi || 'Lokasi tidak ditentukan');
                $('#eventDate').text(data.tanggal_kegiatan ? new Date(data.tanggal_kegiatan).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' }) : '-');
                $('#eventInstansi').text(data.asal_instansi || '-');

                const statusConfig = {
                    dipublikasikan: { class: 'bg-label-success', text: 'Dipublikasikan' },
                    draft: { class: 'bg-label-secondary', text: 'Draft' },
                    diarsipkan: { class: 'bg-label-warning', text: 'Diarsipkan' }
                };
                const status = statusConfig[data.status_kegiatan] || statusConfig.draft;
                $('#eventStatus').html(`<span class="badge ${status.class}">${status.text}</span>`);

                // Render Proposals Table
                renderProposalsTable(data.proposal_pengajuan || []);

                // Prepare Category Checkboxes for Modal
                renderCategoryCheckboxes(data.kategori_media || []);
            }
        } catch (error) {
            console.error('Gagal memuat detail kegiatan:', error);
            errorAlert('Gagal memuat data kegiatan');
        }
    }

    function renderProposalsTable(proposals) {
        if (!$.fn.dataTable.isDataTable(proposalTable)) {
            proposalTable.DataTable({
                pageLength: 10,
                responsive: true,
                columnDefs: [
                    { targets: [4, 5], orderable: false },
                    { targets: [0, 4, 5], className: 'text-center align-middle' },
                    { targets: [1, 2, 3], className: 'align-middle' }
                ]
            });
        }

        const datatable = proposalTable.DataTable();
        datatable.clear();

        proposals.forEach((prop, index) => {
            const mediaName = prop.media_partner?.nama_media || '-';
            const proposalTitle = prop.judul_proposal || '-';
            const approvedDate = prop.tanggal_verifikasi ? new Date(prop.tanggal_verifikasi).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' }) : '-';

            let statusTiket = '';
            let actionBtn = '';

            if (prop.tiket_tugas) {
                statusTiket = `<span class="badge bg-label-info"><i class="fa-solid fa-ticket me-1"></i>Tiket Terbit</span>`;
                actionBtn = `<button class="btn btn-info btn-sm"onclick="window.location.href='/tiket'"><i class="fa-solid fa-eye"></i> Lihat Tiket</button>`;            } else {
                statusTiket = `<span class="badge bg-label-secondary">Belum Ada Tiket</span>`;
                actionBtn = `<button class="btn btn-success btn-sm btnBuatTiket"
                                data-id="${prop.id}"
                                data-title="${prop.judul_proposal}">
                                <i class="fa-solid fa-plus-circle me-1"></i> Buat Tiket Tugas
                            </button>`;
            }

            datatable.row.add([
                index + 1,
                mediaName,
                proposalTitle,
                approvedDate,
                statusTiket,
                actionBtn
            ]);
        });

        datatable.draw();
    }

    function renderCategoryCheckboxes(categories) {
        const container = $('#kategoriTugasContainer');
        container.empty();

        if (categories.length === 0) {
            container.append('<div class="text-muted small">Tidak ada kategori media yang terkait dengan kegiatan ini.</div>');
            return;
        }

        categories.forEach(cat => {
            container.append(`
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="kategori_media_id[]" value="${cat.id}" id="cat_${cat.id}">
                    <label class="form-check-label" for="cat_${cat.id}">
                        ${cat.nama_kategori}
                    </label>
                </div>
            `);
        });
    }

    // Event Handlers
    $(document).on('click', '.btnBuatTiket', function() {
        const proposalId = $(this).data('id');
        const proposalTitle = $(this).data('title');

        $('#proposal_id').val(proposalId);
        $('#judul_tugas').val(`Penugasan: ${proposalTitle}`);
        $('#modalBuatTiket').modal('show');
    });

    $('#btnSimpanTiket').on('click', async function() {
        const form = $('#formBuatTiket');
        if (!form[0].checkValidity()) {
            form[0].reportValidity();
            return;
        }

        // Check if at least one checkbox is checked
        if ($('input[name="kategori_media_id[]"]:checked').length === 0) {
            warningAlert('Pilih minimal satu kategori tugas!');
            return;
        }

        confirmAlert('Apakah Anda yakin ingin menerbitkan tiket tugas ini?', async () => {
            try {
                loadingAllert('Menyimpan data tiket...', 'Mohon tunggu');
                const formData = new FormData(form[0]);
                await tiketService.createTicket(formData);

                Swal.close();
                await successAlert('Tiket tugas berhasil diterbitkan!');
                $('#modalBuatTiket').modal('hide');
                loadEventDetail(); // Reload table
            } catch (error) {
                Swal.close();
                errorAlert('Gagal menyimpan tiket tugas');
            }
        }, 'Konfirmasi Terbitkan Tiket');
    });

    loadEventDetail();
});
