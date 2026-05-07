import profileUserService from "../services/profile-user.service.js";

$(document).ready(function () {
    const service = new profileUserService();
    const userId = $('#auth-user-id').val();

    async function init() {
        if (userId) await service.getProfileData(userId);
    }
    init();

    $('.tab-btn').on('click', function () {
        const target = $(this).data('tab');
        $('.tab-btn').removeClass('text-[#a03d32] border-[#a03d32] border-b-2').addClass('text-gray-500');
        $(this).addClass('text-[#a03d32] border-[#a03d32] border-b-2').removeClass('text-gray-500');
        $('.tab-content').hide();
        $(`#tab${target.charAt(0).toUpperCase() + target.slice(1)}`).show();
        if (target === 'orders') service.getUserOrders();
    });

    window.openInvoice = async function (id) {
        $('#modalInvoice').removeClass('hidden');
        $('body').addClass('overflow-hidden');
        $('#invoice-modal-content').html('<div class="p-20 text-center"><i class="fa-solid fa-spinner fa-spin text-3xl text-[#a03d32]"></i></div>');
        try {
            const response = await service.ajaxRequest(`${appUrl}/wo/pemesanan/get/${id}`, 'GET');
            const data = response.data;
            const html = `
                <div class="p-10 bg-white" id="invoice-capture">
                    <div class="flex justify-between border-b pb-6 mb-6">
                        <div><h2 class="text-2xl font-black text-[#a03d32] uppercase">Invoice</h2><p class="text-xs text-gray-400">#${data.id.substring(0, 8)}</p></div>
                        <div class="text-right"><p class="font-bold uppercase">${data.layanan.wo.nama_wo}</p><p class="text-[10px] text-gray-400">${data.layanan.wo.alamat_wo}</p></div>
                    </div>
                    <div class="grid grid-cols-2 gap-8 mb-8 text-sm">
                        <div><p class="text-[10px] font-bold text-gray-400 uppercase">Customer</p><p class="font-bold uppercase">${data.user.nama_lengkap}</p></div>
                        <div class="text-right"><p class="text-[10px] font-bold text-gray-400 uppercase">Detail Acara</p><p class="font-bold">${data.tgl_acara}</p><p class="text-[10px] italic text-gray-500">${data.lokasi_acara}</p></div>
                    </div>
                    <table class="w-full text-sm">
                        <tr class="bg-gray-50 uppercase text-[10px] font-bold">
                            <th class="py-2 px-4 text-left">Paket</th><th class="py-2 px-4 text-right">Harga</th>
                        </tr>
                        <tr>
                            <td class="py-4 px-4 font-bold uppercase">${data.layanan.nama_layanan}</td>
                            <td class="py-4 px-4 text-right font-black text-[#a03d32]">${service.formatRupiah(data.total_bayar)}</td>
                        </tr>
                    </table>
                </div>`;
            $('#invoice-modal-content').html(html);
            let phone = data.layanan.wo.kontak.replace(/[^0-9]/g, '');
            if (phone.startsWith('0')) phone = '62' + phone.substring(1);
            $('#btn-wa-modal').attr('href', `https://wa.me/${phone}?text=Halo, saya ingin bertanya tentang pesanan #${data.id.substring(0, 8)}`);
        } catch (e) { $('#invoice-modal-content').html('Gagal load data'); }
    };

    window.closeInvoiceModal = () => {
        $('#modalInvoice').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    };

    $('#btn-download-invoice-img').on('click', function () {
        html2canvas(document.getElementById('invoice-capture')).then(canvas => {
            const link = document.createElement('a');
            link.download = 'Invoice.png';
            link.href = canvas.toDataURL();
            link.click();
        });
    });

    window.openReviewModal = function (id, title) {
        Swal.fire({
            title: `<span class="text-sm font-black uppercase">Ulas ${title}</span>`,
            html: `
            <div class="py-4">
                <div class="flex justify-center gap-2 mb-6" id="star-row">
                    ${[1, 2, 3, 4, 5].map(i => `<i class="fa-solid fa-star text-3xl text-gray-200 cursor-pointer s-btn" data-v="${i}"></i>`).join('')}
                </div>
                <input type="hidden" id="r-val" value="0">
                <textarea id="k-val" class="w-full p-4 border border-[#f0ddd8] rounded-2xl text-sm outline-none focus:border-[#a03d32]" placeholder="Tulis pengalaman Anda..." rows="3"></textarea>
            </div>`,
            showCancelButton: true,
            confirmButtonText: 'Kirim Ulasan',
            confirmButtonColor: '#a03d32',
            cancelButtonText: 'Batal',
            preConfirm: () => {
                const r = $('#r-val').val();
                const k = $('#k-val').val();
                if (r == 0) return Swal.showValidationMessage('Silakan pilih rating bintang!');
                return { rating: r, komentar: k };
            }
        }).then(res => {
            if (res.isConfirmed) {
                service.ajaxRequest(`${appUrl}/wo/pemesanan/ulasan/create`, 'POST', {
                    pemesanan_id: id,
                    user_id: userId,
                    rating: res.value.rating,
                    komentar: res.value.komentar
                })
                    .then((response) => {
                        successAlert("Terima kasih! Ulasan Anda telah disimpan.");
                        service.getUserOrders();
                    })
                    .catch(err => {
                        const msg = err.responseJSON?.message || "Gagal menyimpan ulasan";
                        errorAlert(msg);
                    });
            }
        });
    };

    $(document).on('click', '.s-btn', function () {
        const v = $(this).data('v');
        $('#r-val').val(v);
        $('.s-btn').each(function (i) { $(this).toggleClass('text-yellow-400', i < v).toggleClass('text-gray-200', i >= v); });
    });

    $('#formUpdateProfile').on('submit', function (e) {
        e.preventDefault();
        service.updateProfile(this, userId);
    });
});
