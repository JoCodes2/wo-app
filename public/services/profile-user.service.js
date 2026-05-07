class profileUserService {
    constructor() {
        this.appUrl = window.appUrl || window.location.origin;
    }

    ajaxRequest(url, method, data = null) {
        return new Promise((resolve, reject) => {
            const isFormData = data instanceof FormData;
            $.ajax({
                url: url,
                method: method,
                data: data,
                processData: !isFormData,
                contentType: isFormData ? false : 'application/x-www-form-urlencoded',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: (response) => resolve(response),
                error: (error) => reject(error),
            });
        });
    }

    formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
    }

    async getProfileData(userId) {
        try {
            const response = await this.ajaxRequest(`${this.appUrl}/wo/user/get/${userId}`, 'GET');
            const user = response.data;
            $('#display_nama_lengkap, #side_nama_lengkap').text(user.nama_lengkap);
            $('#display_role').text(user.role === 'user' ? 'Mempelai' : user.role.toUpperCase());
            $('#side_email, #email').val(user.email).text(user.email);
            $('#side_no_hp, #no_hp').val(user.no_hp).text(user.no_hp);
            $('#nama_lengkap').val(user.nama_lengkap);
            const date = new Date(user.created_at);
            $('#display_joined').text(date.toLocaleDateString('id-ID', { year: 'numeric', month: 'long' }));
            const statusBadge = $('#display_status');
            statusBadge.removeClass('bg-green-100 text-green-700 bg-yellow-100 text-yellow-700');
            if (user.status_akun === 'aktif') {
                statusBadge.addClass('bg-green-100 text-green-700').text('Akun Aktif');
            } else {
                statusBadge.addClass('bg-yellow-100 text-yellow-700').text('Pending');
            }
        } catch (error) { console.error(error); }
    }

    async getUserOrders() {
        const container = $('#orderListContainer');
        try {
            const response = await this.ajaxRequest(`${this.appUrl}/wo/pemesanan`, 'GET');
            const orders = response.data;

            if (!orders || orders.length === 0) {
                container.html(`
                <div class="py-16 text-center">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-receipt text-4xl text-gray-200"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 uppercase">Belum Ada Pesanan</h3>
                    <p class="text-gray-500 text-sm mt-1">Silakan pilih paket pernikahan Anda.</p>
                </div>`);
                return;
            }

            let html = '';
            orders.forEach(order => {
                const isSelesai = order.status_pesanan.toLowerCase() === 'selesai';
                const ulasan = order.ulasan; // Data ulasan dari relasi backend

                // Logika tampilan ulasan vs tombol
                let ulasanContent = '';
                if (ulasan) {
                    // Jika sudah ada ulasan, tampilkan bintang yang terisi
                    ulasanContent = `<div class="flex gap-1 text-yellow-400 text-[10px]">`;
                    for (let i = 1; i <= 5; i++) {
                        ulasanContent += `<i class="${i <= ulasan.rating ? 'fa-solid' : 'fa-regular'} fa-star"></i>`;
                    }
                    ulasanContent += `</div>`;
                } else if (isSelesai) {
                    // Jika belum ada ulasan dan sudah selesai, tampilkan tombol
                    ulasanContent = `<button onclick="openReviewModal('${order.id}', '${order.layanan.nama_layanan}')" class="px-4 py-1.5 bg-[#a03d32] text-white text-[10px] font-bold uppercase rounded-lg hover:bg-black transition-colors">Beri Ulasan</button>`;
                }

                html += `
            <div class="p-5 border border-[#f0ddd8] rounded-2xl bg-white hover:border-[#a03d32] transition-all">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex gap-4">
                        <div class="w-12 h-12 bg-[#fce8e8] rounded-xl flex items-center justify-center text-[#a03d32]">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 uppercase text-xs">${order.layanan.nama_layanan}</h4>
                            <p class="text-[10px] text-gray-400 mt-1 uppercase">${order.tgl_acara} • <span class="font-bold text-gray-600">${order.status_pesanan}</span></p>
                        </div>
                    </div>
                    <div class="flex flex-col md:items-end gap-2 w-full md:w-auto">
                        <p class="font-black text-[#a03d32] text-sm">${this.formatRupiah(order.total_bayar)}</p>
                        <div class="flex items-center gap-2">
                            <button onclick="openInvoice('${order.id}')" class="px-4 py-1.5 bg-gray-100 text-[10px] font-bold uppercase rounded-lg hover:bg-gray-200">Invoice</button>
                            ${ulasanContent}
                        </div>
                    </div>
                </div>
            </div>`;
            });
            container.html(html);
        } catch (error) { console.error(error); }
    }

    async updateProfile(formElement, userId) {
        const formData = new FormData(formElement);
        try {
            loadingAllert('Memproses...', 'Mohon tunggu');
            await this.ajaxRequest(`${this.appUrl}/wo/user/update/${userId}`, 'POST', formData);
            Swal.close();
            successAlert("Profil diperbarui");
            this.getProfileData(userId);
        } catch (error) {
            Swal.close();
            errorAlert("Gagal update profil");
        }
    }
}
export default profileUserService;
