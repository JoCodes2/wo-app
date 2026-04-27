class Kategori_mediaService {
    constructor() {
        this.table = $('#KategorimediaTable');
    }

    ajaxRequest(url, method, data = null) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url,
                method,
                data,
                processData: method === 'GET' ? true : false,
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

    async getAllData() {
        if (!$.fn.dataTable.isDataTable(this.table)) {
            this.table.DataTable({
                pageLength: 10,
                responsive: true,
                language: {
                    emptyTable: `
                        <div class="py-5 text-center">
                            <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle"
                                 style="width: 100px; height: 100px; background-color: #e8ebff;">
                                <i class="fa-solid fa-layer-group fa-3x" style="color: #696cff;"></i>
                            </div>

                            <h5 class="fw-bold" style="color: #566a7f;">Belum Ada Data Rute</h5>

                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="alert shadow-none mb-0"
                                         style="background-color: #e8ebff; border: none; border-left: 5px solid #0026ff; border-radius: 8px;">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-circle-info fs-4 me-3" style="color: #0026ff;"></i>
                                            <div class="text-start" style="color: #697a8d; font-size: 0.9rem;">
                                                Sistem belum menemukan data kategori terdaftar.
                                                Silakan tekan tombol <strong>Tambah Kategori</strong>
                                                untuk mulai mengisi data master.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`
                }
            });
        }

        let datatable = this.table.DataTable();
        datatable.clear();

        try {
            const response = await this.ajaxRequest(`${appUrl}/ikp/kategori_media/`, 'GET');
            const ruteData = response.data;

            if (ruteData && ruteData.length > 0) {
                ruteData.forEach((item, index) => {

                    const actions = `
                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-outline-info btn-sm btnEditKategorimedia" data-id="${item.id}" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-outline-danger btn-sm btnHapusKategorimedia" data-id="${item.id}" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>`;

                    datatable.row.add([
                        index + 1,
                        item.nama_kategori,
                        item.deskripsi,
                        actions
                    ]);
                });
                datatable.draw();
            }
        } catch (error) {
            console.error('Gagal memuat data:', error);
        }
    }

    async upsertData(formElement, checkingEdit) {
        const submitButton = $('#btnProsesKategorimedia');
        const originalText = submitButton.html();

        try {
            const formData = new FormData(formElement);
            loadingAllert('Sedang memproses...', 'Harap tunggu sebentar');

            let responseData;
            if (checkingEdit()) {
                const id = $('#kategori_id').val();
                responseData = await this.ajaxRequest(`${appUrl}/ikp/kategori_media/update/${id}`, 'POST', formData);
            } else {
                responseData = await this.ajaxRequest(`${appUrl}/ikp/kategori_media/create`, 'POST', formData);
            }

            Swal.close();

            await successAlert();
            $('#modalInputKategorimedia').modal('hide');
            realoadBrowser();

        } catch (error) {
            Swal.close();
            submitButton.attr('disabled', false).html(originalText);

            const status = error.status || error.responseJSON?.code || error.responseJSON?.status;

            if (status === 422) {
                warningAlert('Periksa Inputan anda');
                const errors = error.responseJSON?.data ?? error.responseJSON?.errors;
                const validator = $('#formSimpanKategorimedia').validate();
                const errorList = {};
                $.each(errors, function (field, messages) {
                    errorList[field] = messages[0];
                });
                validator.showErrors(errorList);
            } else if (status === 409) {
                warningAlert('Data sudah ada dalam sistem!');
            } else {
                errorAlert("Terjadi kesalahan sistem");
            }
        }
    }

    async getDataById(id) {
        try {
            loadingAllert('Mengambil data...');
            const responseData = await this.ajaxRequest(`${appUrl}/ikp/kategori_media/get/${id}`, 'GET');
            const item = responseData.data;
            Swal.close();
            $('#kategori_id').val(item.id);
            $('#nama_kategori').val(item.nama_kategori);
            $('#deskripsi').val(item.deskripsi);

            $('#modalInputKategorimedia').modal('show');

            if ($('#formSimpanKategorimedia').data('validator')) {
                $('#formSimpanKategorimedia').validate().resetForm();
            }
            $('#formSimpanKategorimedia .form-control').removeClass('is-invalid');

        } catch (error) {
            Swal.close();
            errorAlert("Gagal mengambil detail kategori media.");
        }
    }

    async deleteData(id) {
        confirmAlert(
            "Data Kategori Media yang dihapus tidak dapat dikembalikan!",
            async () => {
                try {
                    loadingAllert('Menghapus data...');
                    const responseData = await this.ajaxRequest(`${appUrl}/ikp/kategori_media/delete/${id}`, 'DELETE');

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

export default Kategori_mediaService;
