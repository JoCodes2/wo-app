class GaleriService {
    constructor() {
        this.table = $('#GaleriTable');
    }

    /**
     * Template tabel kosong
     */
    emptyTableTemplate() {
        return `
            <div class="py-5 text-center">
                <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle"
                     style="width: 100px; height: 100px; background-color: #fce4ec;">
                    <i class="fa-solid fa-images fa-3x" style="color: #e91e8c;"></i>
                </div>
                <h5 class="fw-bold" style="color: #566a7f;">Belum Ada Data Galeri</h5>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert shadow-none mb-0"
                             style="background-color: #fce4ec; border: none; border-left: 5px solid #e91e8c; border-radius: 8px;">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-circle-info fs-4 me-3" style="color: #e91e8c;"></i>
                                <div class="text-start" style="color: #697a8d; font-size: 0.9rem;">
                                    Belum ada foto portofolio yang diunggah.
                                    Silakan tekan tombol <strong>Tambah Foto</strong>
                                    untuk mulai menambahkan galeri.
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

    /**
     * Buat URL lengkap dari path yang disimpan di DB
     */
    fotoUrl(path) {
        if (!path) return null;
        // Jika sudah berupa URL penuh (http/https), kembalikan apa adanya
        if (path.startsWith('http://') || path.startsWith('https://')) {
            return path;
        }
        // Gabungkan dengan base asset URL
        const base = (window.appAssetUrl || '/').replace(/\/$/, '');
        return `${base}/${path}`;
    }

    async getAllData() {
        if (!$.fn.dataTable.isDataTable(this.table)) {
            this.table.DataTable({
                pageLength: 10,
                responsive: true,
                language: { emptyTable: this.emptyTableTemplate() },
                columnDefs: [
                    { targets: [3], orderable: false },
                    { targets: [0, 3], className: 'text-center align-middle' },
                    { targets: [1, 2], className: 'align-middle' }
                ]
            });
        }

        const datatable = this.table.DataTable();
        datatable.clear();

        try {
            const response = await this.ajaxRequest(`${appUrl}/wo/galeri/`, 'GET');
            const data = response.data || [];

            data.forEach((item, index) => {
                const url = this.fotoUrl(item.foto_portofolio);
                const fotoDisplay = url
                    ? `<a href="${url}" target="_blank" rel="noopener">
                           <img src="${url}" alt="Foto Portofolio"
                                class="rounded shadow-sm"
                                style="width: 72px; height: 72px; object-fit: cover; cursor: pointer; border: 2px solid #e9ecef;"
                                onerror="this.outerHTML='<span class=\'text-muted small\'><i class=\'fa-solid fa-triangle-exclamation\'></i> Gagal dimuat</span>'">
                       </a>`
                    : `<span class="text-muted small"><i class="fa-solid fa-image-slash"></i> Tidak ada foto</span>`;

                const keterangan = `<span class="text-dark">${item.keterangan ?? '-'}</span>`;

                const actionButtons = `
                    <button class="btn btn-outline-danger btn-sm btnHapusGaleri" data-id="${item.id}" title="Hapus">
                        <i class="fa fa-trash"></i>
                    </button>`;

                datatable.row.add([
                    index + 1,
                    fotoDisplay,
                    keterangan,
                    `<div class="d-flex justify-content-center gap-2">${actionButtons}</div>`
                ]);
            });

            datatable.draw();
        } catch (error) {
            console.error('Gagal memuat data galeri:', error);
        }
    }

    async createData(formElement) {
        const submitButton = $('#btnProsesGaleri');
        const originalText = submitButton.html();

        confirmAlert('Apakah data yang Anda masukkan sudah benar?', async () => {
            try {
                submitButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memproses...');
                loadingAllert('Sedang menyimpan data...', 'Harap tunggu sebentar');

                const formData = new FormData(formElement);

                await this.ajaxRequest(`${appUrl}/wo/galeri/create`, 'POST', formData);

                Swal.close();
                await successAlert('Foto berhasil diunggah');
                $('#modalInputGaleri').modal('hide');
                await this.getAllData();
            } catch (error) {
                Swal.close();
                submitButton.attr('disabled', false).html(originalText);

                const status = error.status || error.responseJSON?.code;
                if (status === 422) {
                    warningAlert('Periksa kembali inputan Anda');
                    const errors = error.responseJSON?.errors || {};
                    const validator = $('#formSimpanGaleri').validate();
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
        }, 'Unggah Foto?');
    }

    async deleteData(id) {
        confirmAlert('Foto yang dihapus tidak dapat dikembalikan!', async () => {
            try {
                loadingAllert('Menghapus foto...');
                await this.ajaxRequest(`${appUrl}/wo/galeri/delete/${id}`, 'DELETE');
                Swal.close();
                await successAlert();
                await this.getAllData();
            } catch (error) {
                Swal.close();
                errorAlert('Gagal menghapus foto galeri');
            }
        });
    }

    prepareCreateForm() {
        $('#formSimpanGaleri')[0].reset();
        $('#fotoPreview').attr('src', '');
        $('#fotoPreviewContainer').addClass('d-none');
        $('#wo_id_galeri_input').val(window.woId || '');
        if ($('#formSimpanGaleri').data('validator')) {
            $('#formSimpanGaleri').validate().resetForm();
        }
        $('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
        $('#modalInputGaleri').modal('show');
    }
}

export default GaleriService;
