import CheckoutService from "../services/pemesanan.service.js";

$(document).ready(function () {
    const checkout = new CheckoutService();
    const appUrl = window.appUrl || window.location.origin;

    const urlSegments = window.location.pathname.split('/');
    const layananId = urlSegments.pop() || urlSegments.pop();

    if (layananId && layananId !== 'checkout') {
        $.ajax({
            url: `${appUrl}/wo/layanan/get/${layananId}`,
            method: 'GET',
            success: (response) => {
                const data = response.data;
                $('#checkout-layanan-id').val(data.id);
                $('#checkout-total-bayar-input').val(data.harga);
                $('#checkout-kategori').text(data.kategori?.nama_kategori ?? 'Wedding Package');
                $('#checkout-nama-layanan').text(data.nama_layanan);
                $('#checkout-wo-name').text(data.wo?.nama_wo ?? '-');

                const hargaFormatted = checkout.formatRupiah(data.harga);
                $('#checkout-harga-paket').text(hargaFormatted);
                $('#checkout-total-bayar').text(hargaFormatted);
            },
            error: () => {
                errorAlert('Data layanan tidak ditemukan');
            }
        });
    }
    $.validator.addMethod("notPastDate", function (value, element) {
        if (!value) return true;
        const now = new Date();
        now.setHours(0, 0, 0, 0);
        const inputDate = new Date(value);
        return inputDate >= now;
    }, "Tanggal acara tidak boleh di masa lalu.");

    function validation() {
        $('#form-checkout').validate({
            rules: {
                tgl_acara: {
                    required: true,
                    notPastDate: true
                },
                lokasi_acara: { required: true, minlength: 10 }
            },
            messages: {
                tgl_acara: { required: "Tanggal acara tidak boleh kosong." },
                lokasi_acara: {
                    required: "Lokasi lengkap acara wajib diisi.",
                    minlength: "Masukkan lokasi yang lebih detail (min. 10 karakter)."
                }
            },
            highlight: function (element) {
                $(element).addClass('border-red-500 focus:ring-red-500').removeClass('border-[#f0ddd8] border-green-500');

            },
            unhighlight: function (element) {
                $(element).addClass('border-green-500 focus:ring-green-500').removeClass('border-red-500 border-[#f0ddd8]');

            },
            errorElement: 'p',
            errorClass: 'text-red-500 text-xs mt-1 block w-full font-medium',
            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.relative'));
            }
        });
    }

    validation();

    $('#btn-submit-checkout').on('click', function (e) {
        e.preventDefault();
        if ($("#form-checkout").valid()) {
            confirmAlert('Konfirmasi pesanan sekarang?', async () => {
                const formData = {
                    layanan_id: $('#checkout-layanan-id').val(),
                    tgl_acara: $('#checkout-tgl-acara').val(),
                    lokasi_acara: $('#checkout-lokasi-acara').val(),
                    catatan: $('#checkout-catatan').val(),
                    total_bayar: $('#checkout-total-bayar-input').val()
                };
                await checkout.createPemesanan(formData);
            }, 'Pesan Sekarang');
        }
    });

    $('#btn-download-image').on('click', function () {
        const target = document.getElementById('invoice-card');
        loadingAllert('Menyiapkan gambar...', 'Mohon tunggu');

        html2canvas(target, {
            scale: 2,
            useCORS: true,
            backgroundColor: '#f9fafb',
            logging: false
        }).then(canvas => {
            const link = document.createElement('a');
            link.download = `Invoice-${$('#inv-id').text()}.png`;
            link.href = canvas.toDataURL('image/png');
            link.click();
            Swal.close();
        }).catch(() => {
            Swal.close();
            errorAlert('Gagal mengunduh gambar');
        });
    });
});
