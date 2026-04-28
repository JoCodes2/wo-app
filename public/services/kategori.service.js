class KategoriService {
    constructor() {
        this.table = $('#KategoriTable');
    }

    /**
     * Template tabel kosong
     */
    emptyTableTemplate() {
        return `
            <div class="py-5 text-center">
                <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle"
                     style="width: 100px; height: 100px; background-color: #e8f9f0;">
                    <i class="fa-solid fa-tags fa-3x" style="color: #71dd37;"></i>
                </div>
                <h5 class="fw-bold" style="color: #566a7f;">Belum Ada Data Kategori</h5>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert shadow-none mb-0"
                             style="background-color: #e8f9f0; border: none; border-left: 5px solid #71dd37; border-radius: 8px;">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-circle-info fs-4 me-3" style="color: #71dd37;"></i>
                                <div class="text-start" style="color: #697a8d; font-size: 0.9rem;">
                                    Belum ada kategori layanan yang terdaftar.
                                    Silakan tekan tombol <strong>Tambah Kategori</strong>
                                    untuk mulai menambahkan data.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                language: { emptyTable: this.emptyTableTemplate() },
                columnDefs: [
                    { targets: [2], orderable: false },
                    { targets: [0, 2], className: 'text-center align-middle' },
                    { targets: [1], className: 'align-middle' }
                ]
            });
        }

        const datatable = this.table.DataTable();
        datatable.clear();

        try {
            const response = await this.ajaxRequest(`${appUrl}/wo/kategori/`, 'GET');
            const data = response.data || [];

            data.forEach((item, index) => {
                const layananCount = item.layanans ? item.layanans.length : 0;
                const layananBadge = `<span class="badge bg-label-primary rounded-pill px-3 py-2">
                    <i class="fa-solid fa-layer-group me-1"></i>${layananCount} Layanan
                </span>`;

                const actionButtons = `
                    <button class="btn btn-outline-warning btn-sm btnEditKategori" data-id="${item.id}" title="Edit">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm btnHapusKategori" data-id="${item.id}" title="Hapus">
                        <i class="fa fa-trash"></i>
                    </button>`;

                datatable.row.add([
                    index + 1,
                    `<div class="fw-semibold text-dark">${item.nama_kategori ?? '-'}</div>`,
                    layananBadge,
                    `<div class="d-flex justify-content-center gap-2">${actionButtons}</div>`
                ]);
            });

            datatable.draw();
        } catch (error) {
            console.error('Gagal memuat data kategori:', error);
        }
    }

    async getDataById(id) {
        try {
            loadingAllert('Memuat data...', 'Harap tunggu');
            const response = await this.ajaxRequest(`${appUrl}/wo/kategori/get/${id}`, 'GET');
            Swal.close();

            const item = response.data;
            $('#kategori_id').val(item.id);
            $('#nama_kategori').val(item.nama_kategori);

            $('#modalInputKategori').modal('show');
        } catch (error) {
            Swal.close();
            errorAlert('Gagal memuat data kategori');
        }
    }

    async upsertData(formElement, checkingEdit) {
        const submitButton = $('#btnProsesKategori');
        const originalText = submitButton.html();
        const isEdit = checkingEdit();

        confirmAlert('Apakah data yang Anda masukkan sudah benar?', async () => {
            try {
                submitButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memproses...');
                loadingAllert('Sedang menyimpan data...', 'Harap tunggu sebentar');

                const formData = new FormData(formElement);
                const id = $('#kategori_id').val();
                const url = isEdit
                    ? `${appUrl}/wo/kategori/update/${id}`
                    : `${appUrl}/wo/kategori/create`;

                await this.ajaxRequest(url, 'POST', formData);

                Swal.close();
                await successAlert('Data berhasil disimpan');
                $('#modalInputKategori').modal('hide');
                await this.getAllData();
            } catch (error) {
                Swal.close();
                submitButton.attr('disabled', false).html(originalText);

                const status = error.status || error.responseJSON?.code;
                if (status === 422) {
                    warningAlert('Periksa kembali inputan Anda');
                    const errors = error.responseJSON?.errors || {};
                    const validator = $('#formSimpanKategori').validate();
                    const errorList = {};
                    $.each(errors, function (field, messages) {
                        errorList[field] = Array.isArray(messages) ? messages[0] : messages;
                    });
                    validator.showErrors(errorList);
                } else {
                    errorAlert('Terjadi kesalahan sistem saat menyimpan data');
                }
            } finally {
                submitButton.attr('disabled', false).html(originalText);
            }
        }, isEdit ? 'Simpan Perubahan?' : 'Simpan Data?');
    }

    async deleteData(id) {
        confirmAlert('Data Kategori yang dihapus tidak dapat dikembalikan!', async () => {
            try {
                loadingAllert('Menghapus data...');
                await this.ajaxRequest(`${appUrl}/wo/kategori/delete/${id}`, 'DELETE');
                Swal.close();
                await successAlert();
                await this.getAllData();
            } catch (error) {
                Swal.close();
                errorAlert('Gagal menghapus data. Mungkin kategori ini masih digunakan oleh layanan.');
            }
        });
    }

    prepareCreateForm() {
        $('#formSimpanKategori')[0].reset();
        $('#kategori_id').val('');
        if ($('#formSimpanKategori').data('validator')) $('#formSimpanKategori').validate().resetForm();
        $('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
        $('#modalInputKategori').modal('show');
    }
}

export default KategoriService;
