import TiketService from '../services/tiket.service.js';

class TiketTugasController {
    constructor() {
        this.tiketService = new TiketService();
        this.init();
    }

    init() {
        $(document).ready(() => {
            this.loadTickets();
            this.setupEventListeners();
        });
    }

    async loadTickets() {
        try {
            const response = await this.tiketService.getMyTickets();
            const tickets = response.data || [];
            this.renderTickets(tickets);
        } catch (error) {
            console.error('Render error:', error);
            Swal.fire('Error', 'Gagal memuat data tiket tugas', 'error');
            $('#tiketTugasBody').html('<tr><td colspan="8" class="text-center text-danger py-4">Terjadi kesalahan saat memuat data.</td></tr>');
        }
    }

    renderTickets(tickets) {
        const body = $('#tiketTugasBody');
        body.empty();

        if (!Array.isArray(tickets) || tickets.length === 0) {
            body.append('<tr><td colspan="9" class="text-center py-5 text-muted"><i class="fa-solid fa-folder-open fa-3x mb-3 d-block"></i>Belum ada tiket tugas yang tersedia.</td></tr>');
            return;
        }

        tickets.forEach((ticket, index) => {
            const statusBadge = this.getStatusBadge(ticket.status_tiket);
            const categories = ticket.kategori_media.map(cat => `<span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1 small me-1">${cat.nama_kategori}</span>`).join('');
            const partnerName = ticket.proposal_pengajuan?.media_partner ? ticket.proposal_pengajuan.media_partner.nama_media : '-';
            
            const row = `
                <tr>
                    <td class="text-center">${index + 1}</td>
                    <td><span class="fw-bold text-primary">${ticket.kode_tiket}</span></td>
                    <td>${ticket.judul_tugas}</td>
                    <td class="fw-semibold text-dark">${partnerName}</td>
                    <td>${ticket.proposal_pengajuan?.kegiatan?.judul_kegiatan || '-'}</td>
                    <td class="text-danger fw-bold">${this.formatDate(ticket.batas_waktu)}</td>
                    <td>${categories}</td>
                    <td>${statusBadge}</td>
                    <td>
                        <div class="d-flex gap-1 justify-content-center">
                            <button class="btn btn-sm btn-info btn-detail-tiket" data-id="${ticket.id}" title="Detail Tugas">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-primary btn-input-laporan" data-id="${ticket.id}" title="Input Laporan">
                                <i class="fa fa-upload"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
            body.append(row);
        });

        this.tickets = tickets;
    }

    getStatusBadge(status) {
        switch (status) {
            case 'dibuat':
                return '<span class="badge bg-primary-subtle text-primary border border-primary px-3 rounded-pill">Baru</span>';
            case 'proses':
                return '<span class="badge bg-warning-subtle text-warning border border-warning px-3 rounded-pill">Dalam Proses</span>';
            case 'dikirim':
                return '<span class="badge bg-info-subtle text-info border border-info px-3 rounded-pill">Menunggu Verifikasi Laporan</span>';
            case 'selesai':
                return '<span class="badge bg-success-subtle text-success border border-success px-3 rounded-pill">Selesai</span>';
            case 'ditolak':
                return '<span class="badge bg-danger-subtle text-danger border border-danger px-3 rounded-pill">Ditolak</span>';
            default:
                return `<span class="badge bg-secondary-subtle text-secondary border border-secondary px-3 rounded-pill">${status}</span>`;
        }
    }

    formatDate(dateString) {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }

    setupEventListeners() {
        $(document).on('click', '.btn-detail-tiket', (e) => {
            const id = $(e.currentTarget).data('id');
            this.showDetail(id);
        });

        $(document).on('click', '.btn-input-laporan', (e) => {
            const id = $(e.currentTarget).data('id');
            Swal.fire('Info', 'Fitur input laporan akan segera tersedia.', 'info');
        });

        $('#btnMulaiKerjakan').on('click', () => {
            Swal.fire('Info', 'Status tugas akan diubah menjadi "Dalam Proses".', 'info');
        });
    }

    showDetail(id) {
        const ticket = this.tickets.find(t => t.id === id);
        if (!ticket) return;

        $('#detailJudul').text(ticket.judul_tugas);
        $('#detailDeskripsi').text(ticket.deskripsi_tugas || 'Tidak ada deskripsi.');
        $('#detailKegiatan').text(ticket.proposal_pengajuan?.kegiatan?.judul_kegiatan || '-');
        $('#detailDeadline').text(this.formatDate(ticket.batas_waktu));
        $('#detailStatus').html(this.getStatusBadge(ticket.status_tiket));

        const kategoriHtml = ticket.kategori_media.map(cat => 
            `<span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill me-2 mb-2"><i class="fa-solid fa-tag me-1"></i> ${cat.nama_kategori}</span>`
        ).join('');
        $('#detailKategori').html(kategoriHtml);

        $('#modalDetailTiket').modal('show');
    }
}

new TiketTugasController();
