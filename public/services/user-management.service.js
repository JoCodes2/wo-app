class UserManagementService {
    constructor() {
        this.table = $('#UserTable');
        this.allData = [];
    }

    emptyTableTemplate() {
        return `
            <div class="py-5 text-center">
                <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle"
                     style="width: 100px; height: 100px; background-color: #fdf8f5;">
                    <i class="fa-solid fa-users-slash fa-3x" style="color: #a03d32;"></i>
                </div>
                <h5 class="fw-bold" style="color: #566a7f;">Data Tidak Ditemukan</h5>
                <p class="text-muted">Tidak ada pengguna yang terdaftar dalam kategori ini.</p>
            </div>`;
    }

    ajaxRequest(url, method, data = null) {
        return new Promise((resolve, reject) => {
            const isFormData = data instanceof FormData;
            $.ajax({
                url,
                method,
                data,
                processData: isFormData ? false : (method === 'GET' ? true : false),
                contentType: isFormData ? false : (method === 'GET' ? 'application/x-www-form-urlencoded' : false),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: (response) => resolve(response),
                error: (xhr) => reject(xhr)
            });
        });
    }

    async fetchAllData() {
        try {
            const response = await this.ajaxRequest(`${appUrl}/wo/user`, 'GET');
            this.allData = response.data || [];
            return this.allData;
        } catch (error) {
            console.error(error);
            return [];
        }
    }

    renderTable(roleFilter = 'all') {
        if (!$.fn.dataTable.isDataTable(this.table)) {
            this.table.DataTable({
                pageLength: 10,
                responsive: true,
                language: { emptyTable: this.emptyTableTemplate() },
                columnDefs: [
                    { targets: [5], orderable: false },
                    { targets: [0, 4, 5], className: 'text-center align-middle' },
                    { targets: [1, 2, 3], className: 'align-middle' }
                ]
            });
        }

        const datatable = this.table.DataTable();
        datatable.clear();

        const filteredData = roleFilter === 'all'
            ? this.allData
            : this.allData.filter(item => item.role === roleFilter);

        filteredData.forEach((item, index) => {
            const statusBadge = item.status_akun === 'aktif'
                ? '<span class="badge bg-success"><i class="fa fa-check-circle me-1"></i> Aktif</span>'
                : '<span class="badge bg-warning text-dark"><i class="fa fa-clock me-1"></i> Pending</span>';

            let actionButtons = '';

            if (item.role === 'wo') {
                actionButtons += `
                    <button class="btn btn-outline-info btn-sm btnDetailWO" data-id="${item.id}">
                        <i class="fa fa-eye"></i> Detail
                    </button>`;
            }

            actionButtons += `
                <button class="btn btn-outline-danger btn-sm btnHapusUser" data-id="${item.id}">
                    <i class="fa fa-trash"></i>
                </button>`;

            const nameDisplay = `
                <div>
                    <div class="fw-bold text-dark">${item.nama_lengkap}</div>
                    <small class="badge bg-light text-muted border" style="font-size: 0.65rem;">
                        ${item.role.toUpperCase()}
                    </small>
                </div>
            `;

            datatable.row.add([
                index + 1,
                nameDisplay,
                item.email,
                item.no_hp || '-',
                statusBadge,
                `<div class="d-flex justify-content-center gap-2">${actionButtons}</div>`
            ]);
        });

        datatable.draw();
    }
    async getDetailWO(id) {
        try {
            loadingAllert('Memuat Profil...', 'Harap tunggu');
            const response = await this.ajaxRequest(`${appUrl}/wo/user/get/${id}`, 'GET');
            Swal.close();

            const user = response.data;
            const profil = user.profil_wo;

            if (!profil) {
                warningAlert("Data profil WO tidak ditemukan.");
                return;
            }

            $('#detail_nama_wo').text(profil.nama_wo);
            $('#detail_pengelola').text(user.nama_lengkap);
            $('#detail_biodata').text(profil.biodata_pengelola || '-');
            $('#detail_alamat').text(profil.alamat_wo);
            $('#detail_deskripsi').text(profil.deskripsi_wo);
            $('#detail_kontak').text(profil.kontak);
            $('#detail_sosmed').text(profil.sosial_media || '-');
            $('#detail_tahun').text(profil.tahun_bergabung || '-');

            const logoPath = profil.foto_logo
                ? `${appUrl}/uploads/logo/${profil.foto_logo}`
                : `${appUrl}/assets/img/default-logo.png`;
            $('#detail_foto_logo').attr('src', logoPath);

            let footerHtml = '';
            if (user.status_akun === 'pending') {
                footerHtml = `
                    <button type="button" class="btn btn-success btnApproveWO" data-id="${user.id}">
                        <i class="fa fa-check-circle me-1"></i> Aktivasi Akun
                    </button>`;
            }
            $('#footerAction').html(footerHtml);

            $('#modalDetailWO').modal('show');
        } catch (error) {
            Swal.close();
            errorAlert('Gagal mengambil data profil');
        }
    }

    async aktivasiAkun(id) {
        confirmAlert('Setujui aktivasi akun WO ini?', async () => {
            try {
                loadingAllert('Memproses...');
                await this.ajaxRequest(`${appUrl}/wo/user/aktivasi/${id}`, 'PATCH');
                Swal.close();
                await successAlert('Akun berhasil diaktifkan');
                $('#modalDetailWO').modal('hide');
                realoadBrowser()
            } catch (error) {
                Swal.close();
                errorAlert('Gagal aktivasi');
            }
        });
    }

    async deleteUser(id) {
        confirmAlert('Hapus data pengguna ini?', async () => {
            try {
                loadingAllert('Menghapus...');
                await this.ajaxRequest(`${appUrl}/wo/user/delete/${id}`, 'DELETE');
                Swal.close();
                await successAlert();
                realoadBrowser()
            } catch (error) {
                Swal.close();
                errorAlert('Gagal menghapus');
            }
        });
    }
}

export default UserManagementService;
