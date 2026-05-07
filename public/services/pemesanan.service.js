class CheckoutService {
    constructor() {
        this.appUrl = window.appUrl || window.location.origin;
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

    formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(angka);
    }

    async createPemesanan(formData) {
        try {
            loadingAllert('Sedang memproses pesanan...', 'Mohon tunggu sebentar');
            const response = await this.ajaxRequest(`${this.appUrl}/wo/pemesanan/create`, 'POST', formData);
            console.log(response);

            Swal.close();
            await this.renderInvoice(response.data.id);

            $('#section-checkout').addClass('hidden');
            $('#section-invoice').removeClass('hidden');
            window.scrollTo(0, 0);

        } catch (error) {
            Swal.close();
            errorAlert('Terjadi kesalahan saat memproses pesanan');
        }
    }

    async renderInvoice(pemesananId) {
        try {
            const response = await this.ajaxRequest(`${this.appUrl}/wo/pemesanan/get/${pemesananId}`, 'GET');
            const data = response.data;

            $('#inv-id').text(`INV/${data.id.substring(0, 8).toUpperCase()}`);
            $('#inv-status').text(data.status_pesanan);
            $('#inv-customer-name').text(data.user.nama_lengkap);
            $('#inv-customer-phone').text(data.user.no_hp);
            $('#inv-customer-email').text(data.user.email);
            $('#inv-wo-name').text(data.layanan.wo.nama_wo);
            $('#inv-wo-address').text(data.layanan.wo.alamat_wo);
            $('#inv-tgl-acara').text(data.tgl_acara);
            $('#inv-lokasi-acara').text(data.lokasi_acara);
            $('#inv-layanan-nama').text(data.layanan.nama_layanan);
            $('#inv-layanan-kategori').text(data.layanan.kategori.nama_kategori);

            const total = this.formatRupiah(data.total_bayar);
            $('#inv-layanan-harga').text(total);
            $('#inv-total').text(total);

            let rawPhone = data.layanan.wo.kontak.replace(/[^0-9]/g, '');
            if (rawPhone.startsWith('0')) {
                rawPhone = '62' + rawPhone.substring(1);
            } else if (rawPhone.startsWith('8')) {
                rawPhone = '62' + rawPhone;
            }

            const waMessage = encodeURIComponent(`Halo ${data.layanan.wo.nama_wo}, saya ingin mengonfirmasi pesanan saya dengan kode INV/${data.id.substring(0, 8).toUpperCase()}`);
            $('#btn-chat-wa').attr('href', `https://wa.me/${rawPhone}?text=${waMessage}`);

        } catch (error) {
            console.error('Invoice Render Error:', error);
        }
    }
}

export default CheckoutService;
