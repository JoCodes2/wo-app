class PemesananService {
    constructor() {
        this.table = $('#PemesananTable');
        this.appUrl = window.appUrl;
    }

    emptyTableTemplate() {
        return `
            <div class="py-5 text-center">
                <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle"
                     style="width: 100px; height: 100px; background-color: #fce8e8;">
                    <i class="fa-solid fa-receipt fa-3x" style="color: #a03d32;"></i>
                </div>
                <h5 class="fw-bold" style="color: #566a7f;">Belum Ada Transaksi</h5>
                <p class="text-muted">Sistem belum menemukan data pemesanan yang masuk.</p>
            </div>`;
    }

    ajaxRequest(url, method, data = null) {
        return new Promise((resolve, reject) => {
            const isFormData = data instanceof FormData;
            $.ajax({
                url,
                method,
                data,
                processData: isFormData ? false : true,
                contentType: isFormData ? false : 'application/x-www-form-urlencoded',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: (res) => resolve(res),
                error: (xhr) => reject(xhr)
            });
        });
    }

    formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
    }

    async getAllData() {
        if (!$.fn.dataTable.isDataTable(this.table)) {
            this.table.DataTable({
                responsive: true,
                language: { emptyTable: this.emptyTableTemplate() },
                columnDefs: [
                    { targets: [0, 5, 6], className: 'text-center align-middle' },
                    { targets: [1, 2, 3, 4], className: 'align-middle' }
                ]
            });
        }

        const datatable = this.table.DataTable();
        datatable.clear();

        try {
            const response = await this.ajaxRequest(`${this.appUrl}/wo/pemesanan`, 'GET');
            const data = response.data || [];
            console.log(data);

            data.forEach((item, index) => {
                const status = (item.status_pesanan || 'menunggu').toLowerCase();
                const statusConfig = {
                    menunggu: { class: 'bg-label-warning', icon: 'fa-solid fa-clock', text: 'Menunggu' },
                    proses: { class: 'bg-label-info', icon: 'fa-solid fa-spinner fa-spin', text: 'Proses' },
                    selesai: { class: 'bg-label-success', icon: 'fa-solid fa-circle-check', text: 'Selesai' }
                };

                const current = statusConfig[status];
                const statusBadge = `<span class="badge ${current.class} px-3 py-2"><i class="${current.icon} me-1"></i>${current.text}</span>`;

                // Tombol Aksi Konfirmasi
                let actionButtons = `
                    <button class="btn btn-sm btn-outline-primary btnDetailInvoice" data-id="${item.id}" title="Detail Invoice">
                        <i class="fa-solid fa-file-invoice"></i>
                    </button>
                `;

                if (status === 'menunggu') {
                    actionButtons += `<button class="btn btn-sm btn-success btnKonfirmasi" data-id="${item.id}" data-status="proses" title="Konfirmasi Pesanan"><i class="fa fa-check"></i></button>`;
                } else if (status === 'proses') {
                    actionButtons += `<button class="btn btn-sm btn-info btnKonfirmasi" data-id="${item.id}" data-status="selesai" title="Selesaikan Pesanan"><i class="fa fa-flag-checkered"></i></button>`;
                }

                const pelanggan = `<div><div class="fw-bold">${item.user?.nama_lengkap ?? '-'}</div><small class="text-muted">${item.user?.no_hp ?? ''}</small></div>`;
                const layanan = `<div class="fw-semibold">${item.layanan?.nama_layanan ?? '-'}</div>`;
                const tgl = item.tgl_acara ? new Date(item.tgl_acara).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' }) : '-';

                datatable.row.add([
                    index + 1,
                    pelanggan,
                    layanan,
                    tgl,
                    `<span class="fw-bold text-primary">${this.formatRupiah(item.total_bayar)}</span>`,
                    statusBadge,
                    `<div class="d-flex justify-content-center gap-1">${actionButtons}</div>`
                ]);
            });

            datatable.draw();
        } catch (error) {
            console.error('Gagal memuat data pemesanan:', error);
        }
    }

    async getInvoice(id) {
        try {
            const response = await this.ajaxRequest(`${this.appUrl}/wo/pemesanan/get/${id}`, 'GET');
            const data = response.data;
            const html = `
                <div class="border p-4 bg-light rounded">
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <h4 class="mb-0 fw-black text-primary uppercase">INVOICE</h4>
                            <small class="text-muted">ID Transaksi: #${data.id.substring(0, 8)}</small>
                        </div>
                        <div class="text-end text-uppercase">
                            <h5 class="mb-0 fw-bold">${data.layanan?.wo?.nama_wo ?? 'Wedding Organizer'}</h5>
                            <small class="text-muted">${data.layanan?.wo?.alamat_wo ?? ''}</small>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-4">
                        <div class="col-6">
                            <small class="text-uppercase text-muted d-block">Pelanggan:</small>
                            <span class="fw-bold">${data.user?.nama_lengkap}</span><br>
                            <small>${data.user?.no_hp}</small>
                        </div>
                        <div class="col-6 text-end">
                            <small class="text-uppercase text-muted d-block">Detail Acara:</small>
                            <span class="fw-bold">${new Date(data.tgl_acara).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}</span><br>
                            <small>${data.lokasi_acara}</small>
                        </div>
                    </div>
                    <table class="table table-sm table-bordered bg-white">
                        <thead class="table-dark text-uppercase">
                            <tr><th>Layanan / Paket</th><th class="text-end">Total</th></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-3 px-2"><strong>${data.layanan?.nama_layanan}</strong></td>
                                <td class="text-end py-3 px-2 fw-bold text-primary">${this.formatRupiah(data.total_bayar)}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="alert alert-secondary mb-0 mt-3 small">
                        <strong>Catatan:</strong> ${data.catatan || 'Tidak ada catatan tambahan.'}
                    </div>
                </div>
            `;
            $('#invoiceContent').html(html);
            $('#modalInvoice').modal('show');
        } catch (error) {
            errorAlert('Gagal memuat data invoice');
        }
    }

    async updateStatus(id, newStatus) {
        confirmAlert(`Ubah status pesanan menjadi ${newStatus}?`, async () => {
            try {
                loadingAllert('Memproses...', 'Harap tunggu');
                const formData = new FormData();
                formData.append('status', newStatus); // Disesuaikan dengan parameter di controller (id, status)

                await this.ajaxRequest(`${this.appUrl}/wo/pemesanan/konfirmasi/${id}`, 'POST', formData);

                Swal.close();
                await successAlert('Status berhasil diperbarui');
                this.getAllData();
            } catch (error) {
                Swal.close();
                errorAlert('Gagal memperbarui status');
            }
        });
    }
}

export default PemesananService;
