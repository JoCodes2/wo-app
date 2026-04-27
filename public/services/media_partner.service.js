class MediapartnerService {
    constructor() {
        this.table = $('#MediapartnerTable');
    }

    ajaxRequest(url, method, data = null) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url,
                method,
                data,
                processData: method === 'GET',
                contentType: method === 'GET' ? 'application/x-www-form-urlencoded' : false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    if (response.code === 409) {
                        reject({ status: 409, responseJSON: response });
                    } else {
                        resolve(response);
                    }
                },
                error: (xhr) => {
                    reject(xhr);
                }
            });
        });
    }

    getEmptyTableMessage(title, description, buttonName) {
        return `
            <div class="py-5 text-center">
                <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle"
                     style="width: 100px; height: 100px; background-color: #e8ebff;">
                    <i class="fa-solid fa-layer-group fa-3x" style="color: #696cff;"></i>
                </div>
                <h5 class="fw-bold" style="color: #566a7f;">${title}</h5>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert shadow-none mb-0"
                             style="background-color: #e8ebff; border: none; border-left: 5px solid #0026ff; border-radius: 8px;">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-circle-info fs-4 me-3" style="color: #0026ff;"></i>
                                <div class="text-start" style="color: #697a8d; font-size: 0.9rem;">
                                    ${description} Silakan tekan tombol <strong>${buttonName}</strong>
                                    untuk mulai mengisi data master.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
    }

    async renderKategoriMedia() {
        try {
            const response = await this.ajaxRequest(`${appUrl}/ikp/kategori_media`, 'GET');
            const container = $('#kategoriCheckboxContainer');
            container.empty();

            if (response.data && response.data.length > 0) {
                response.data.forEach(kat => {
                    container.append(`
                        <div class="form-check form-check-inline">
                            <input class="form-check-input check-kategori" type="checkbox"
                                name="kategori_media_id[]" id="kat_${kat.id}" value="${kat.id}">
                            <label class="form-check-label" for="kat_${kat.id}">${kat.nama_kategori}</label>
                        </div>
                    `);
                });
            } else {
                container.html('<span class="text-muted small">Tidak ada kategori tersedia.</span>');
            }
        } catch (error) {
            console.error(error);
            $('#kategoriCheckboxContainer').html('<span class="text-danger small">Gagal memuat kategori.</span>');
        }
    }

    async getAllData() {
        if (!$.fn.dataTable.isDataTable(this.table)) {
            this.table.DataTable({
                pageLength: 10,
                responsive: true,
                language: {
                    emptyTable: this.getEmptyTableMessage(
                        "Belum Ada Data Media Partner",
                        "Sistem belum menemukan data media partner terdaftar.",
                        "Tambah Media Partner"
                    )
                }
            });
        }

        let datatable = this.table.DataTable();
        datatable.clear();

        try {
            const response = await this.ajaxRequest(`${appUrl}/ikp/media_partner/`, 'GET');
            const mediaPartnerData = response.data;

            if (mediaPartnerData && mediaPartnerData.length > 0) {
                mediaPartnerData.forEach((item, index) => {
                    const statusBadge = item.status_kerja_sama === 'aktif'
                        ? '<span class="badge bg-success">Aktif</span>'
                        : '<span class="badge bg-danger">Nonaktif</span>';

                    const kategoriBadges = item.kategori_media.map(k =>
                        `<span class="badge bg-label-primary me-1 text-uppercase" style="font-size: 0.7rem;">${k.nama_kategori}</span>`
                    ).join(' ');

                    const actions = `
                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-outline-info btn-sm btnEditMediapartner" data-id="${item.id}" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-outline-danger btn-sm btnHapusMediapartner" data-id="${item.id}" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>`;

                    datatable.row.add([
                        index + 1,
                        `<strong>${item.nama_media}</strong><br><small class="text-muted">${item.nama_pimpinan || '-'}</small>`,
                        item.email_media || '-',
                        item.pengguna?.email || '-',
                        kategoriBadges || '-',
                        statusBadge,
                        actions
                    ]);
                });
                datatable.draw();
            }
        } catch (error) {
            console.error(error);
        }
    }

    async upsertData(formElement, checkingEdit) {
        const submitButton = $('#btnProsesMediapartner');
        const originalText = submitButton.html();

        try {
            submitButton.attr('disabled', true).html('<span class="spinner-border spinner-border-sm"></span>');
            const formData = new FormData(formElement);
            loadingAllert('Sedang memproses...', 'Harap tunggu sebentar');

            if (checkingEdit()) {
                const id = $('#id').val();
                await this.ajaxRequest(`${appUrl}/ikp/media_partner/update/${id}`, 'POST', formData);
            } else {
                await this.ajaxRequest(`${appUrl}/ikp/media_partner/create`, 'POST', formData);
            }

            Swal.close();
            await successAlert();
            $('#modalInputMediapartner').modal('hide');
            realoadBrowser();

        } catch (error) {
            Swal.close();
            submitButton.attr('disabled', false).html(originalText);

            const status = error.status || error.responseJSON?.code || error.responseJSON?.status;

            if (status === 422) {
                warningAlert('Periksa Inputan anda');
                const errors = error.responseJSON?.data ?? error.responseJSON?.errors;
                const validator = $('#formSimpanMediapartner').validate();
                const errorList = {};
                $.each(errors, function (field, messages) {
                    errorList[field] = messages[0];
                });
                validator.showErrors(errorList);
            } else {
                errorAlert(error.responseJSON?.message || "Terjadi kesalahan sistem");
            }
        }
    }

    async getDataById(id) {
        try {
            loadingAllert('Mengambil data...');
            const responseData = await this.ajaxRequest(`${appUrl}/ikp/media_partner/get/${id}`, 'GET');
            const item = responseData.data;
            Swal.close();

            $('#formSimpanMediapartner')[0].reset();
            $('.check-kategori').prop('checked', false);

            $('#id').val(item.id);
            $('#pengguna_id').val(item.pengguna_id);
            $('#nama_lengkap').val(item.pengguna?.nama_lengkap);
            $('#email').val(item.pengguna?.email);

            $('#nama_media').val(item.nama_media);
            $('#nama_pimpinan').val(item.nama_pimpinan);
            $('#alamat').val(item.alamat);
            $('#no_telepon').val(item.no_telepon);
            $('#email_media').val(item.email_media);
            $('#status_kerja_sama').val(item.status_kerja_sama);

            if (item.kategori_media && item.kategori_media.length > 0) {
                item.kategori_media.forEach(kat => {
                    $(`#kat_${kat.id}`).prop('checked', true);
                });
            }

            $('#modalInputMediapartner').modal('show');

            if ($('#formSimpanMediapartner').data('validator')) {
                $('#formSimpanMediapartner').validate().resetForm();
            }
            $('#formSimpanMediapartner .form-control').removeClass('is-invalid');

        } catch (error) {
            Swal.close();
            errorAlert("Gagal mengambil detail media partner.");
        }
    }

    async deleteData(id) {
        confirmAlert(
            "Data Media Partner dan Akun terkait akan dihapus permanen!",
            async () => {
                try {
                    loadingAllert('Menghapus data...');
                    await this.ajaxRequest(`${appUrl}/ikp/media_partner/delete/${id}`, 'DELETE');
                    Swal.close();
                    await successAlert();
                    realoadBrowser();
                } catch (error) {
                    Swal.close();
                    errorAlert("Gagal menghapus data ");
                }
            }
        );
    }
}

export default MediapartnerService;
