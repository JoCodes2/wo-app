import DashboardService from "../services/dashboard.service.js";

$(document).ready(function () {
    const dashboard = new DashboardService();

    /**
     * Inisialisasi Data Awal
     * Memanggil data kegiatan yang sudah dipublikasikan saat halaman dimuat
     */
    dashboard.getPublishedKegiatan();

    /**
     * Event Listener: Terapkan Filter
     * Mengambil nilai dari input tanggal dan mengirimkannya ke service
     */
    $('#btnTerapkanFilter').on('click', function (e) {
        e.preventDefault();

        const filters = {
            tanggal_mulai: $('#filter_tanggal_mulai').val(),
            tanggal_akhir: $('#filter_tanggal_akhir').val()
        };

        // Validasi sederhana: Jika tanggal akhir diisi, pastikan tidak lebih kecil dari tanggal mulai
        if (filters.tanggal_mulai && filters.tanggal_akhir) {
            if (new Date(filters.tanggal_akhir) < new Date(filters.tanggal_mulai)) {
                warningAlert('Tanggal akhir tidak boleh lebih kecil dari tanggal mulai');
                return;
            }
        }

        dashboard.getPublishedKegiatan(filters);
    });

    /**
     * Event Listener: Reset Filter
     * Mengembalikan form ke kondisi awal dan memuat ulang semua data
     */
    $('#btnResetFilter').on('click', function () {
        $('#formFilterDashboard')[0].reset();
        dashboard.getPublishedKegiatan();
    });

    /**
     * Event Listener: Tombol Detail di dalam Card
     * Menggunakan event delegation karena card di-render secara dinamis
     */
    $(document).on('click', '.btnDetailDashboard', function () {
        const id = $(this).data('id');
        if (id) {
            dashboard.getDetailKegiatan(id);
        }
    });

    /**
     * Optional: Pencarian Real-time (Jika Anda ingin menambahkan input search)
     * Contoh penggunaan jika ada input #searchKegiatan
     */
    let searchTimer;
    $('#searchKegiatan').on('keyup', function () {
        clearTimeout(searchTimer);
        const query = $(this).val();

        searchTimer = setTimeout(() => {
            dashboard.getPublishedKegiatan({ search: query });
        }, 500); // Tunggu 500ms setelah user berhenti mengetik
    });
});
