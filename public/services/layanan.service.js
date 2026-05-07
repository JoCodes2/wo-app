class LayananService {
    constructor() {
        this.table = $('#LayananTable');
    }

    /**
     * Template tabel kosong
     */
    emptyTableTemplate() {
        return `
            <div class="py-5 text-center">
                <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle"
                     style="width: 100px; height: 100px; background-color: #fff3e0;">
                    <i class="fa-solid fa-concierge-bell fa-3x" style="color: #fd7e14;"></i>
                </div>
                <h5 class="fw-bold" style="color: #566a7f;">Belum Ada Data Layanan</h5>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert shadow-none mb-0"
                             style="background-color: #fff3e0; border: none; border-left: 5px solid #fd7e14; border-radius: 8px;">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-circle-info fs-4 me-3" style="color: #fd7e14;"></i>
                                <div class="text-start" style="color: #697a8d; font-size: 0.9rem;">
                                    Belum ada layanan yang terdaftar.
                                    Silakan tekan tombol <strong>Tambah Layanan</strong>
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

    async getAllKategori() {
        try {
            const response = await this.ajaxRequest(`${appUrl}/wo/kategori/`, 'GET');
            return response.data || [];
        } catch (error) {
            console.error('Gagal memuat kategori:', error);
            return [];
        }
    }

    async loadKategoriOptions(selected = null) {
        const selectEl = $('#kategori_id_layanan');
        selectEl.empty().append(`<option value="">-- Pilih Kategori --</option>`);

        const data = await this.getAllKategori();
        data.forEach(item => {
            const isSelected = selected && selected == item.id ? 'selected' : '';
            selectEl.append(`<option value="${item.id}" ${isSelected}>${item.nama_kategori}</option>`);
        });
    }

    formatRupiah(angka) {
        if (!angka && angka !== 0) return '-';
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(angka);
    }

    async getAllData() {
        if (!$.fn.dataTable.isDataTable(this.table)) {
            this.table.DataTable({
                pageLength: 10,
                responsive: true,
                language: { emptyTable: this.emptyTableTemplate() },
                columnDefs: [
                    { targets: [4], orderable: false },
                    { targets: [0, 3, 4], className: 'text-center align-middle' },
                    { targets: [1, 2], className: 'align-middle' }
                ]
            });
        }

        const datatable = this.table.DataTable();
        datatable.clear();

        try {
            const response = await this.ajaxRequest(`${appUrl}/wo/layanan/`, 'GET');
            const data = response.data || [];

            data.forEach((item, index) => {
                // Backend kadang mengirim kategori dalam bentuk berbeda (relasi atau field kategori_*)
                const kategoriName = item.kategori?.nama_kategori ?? item.kategori_nama_kategori ?? item.kategori_name ?? item.kategori_name_layanan ?? '-';
                const kategoriBadge = `<span class="badge bg-label-info rounded-pill px-3 py-2">
                    <i class="fa-solid fa-tag me-1"></i>${kategoriName}
                </span>`;

                const harga = this.formatRupiah(item.harga);
                const hargaDisplay = `<span class="fw-semibold text-success">${harga}</span>`;

                const namaLayanan = `
                    <div>
                        <div class="fw-semibold text-dark">${item.nama_layanan ?? '-'}</div>
                        <small class="text-muted">${item.detail_layanan ? item.detail_layanan.substring(0, 60) + (item.detail_layanan.length > 60 ? '...' : '') : ''}</small>
                    </div>`;

                const actionButtons = `
                    <button class="btn btn-outline-warning btn-sm btnEditLayanan" data-id="${item.id}" title="Edit">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm btnHapusLayanan" data-id="${item.id}" title="Hapus">
                        <i class="fa fa-trash"></i>
                    </button>`;

                datatable.row.add([
                    index + 1,
                    namaLayanan,
                    kategoriBadge,
                    hargaDisplay,
                    `<div class="d-flex justify-content-center gap-2">${actionButtons}</div>`
                ]);
            });

            datatable.draw();
        } catch (error) {
            console.error('Gagal memuat data layanan:', error);
        }
    }

    async getDataById(id) {
        try {
            loadingAllert('Memuat data...', 'Harap tunggu');
            const response = await this.ajaxRequest(`${appUrl}/wo/layanan/get/${id}`, 'GET');
            Swal.close();

            const item = response.data;
            $('#layanan_id').val(item.id);
            $('#wo_id_input').val(item.wo_id || window.woId || '');
            $('#nama_layanan').val(item.nama_layanan);
            // Pastikan harga selalu raw number (bukan format Rupiah)
            $('#harga').val(parseFloat(item.harga) || 0);
            $('#detail_layanan').val(item.detail_layanan);

            await this.loadKategoriOptions(item.kategori_id);

            $('#modalInputLayanan').modal('show');
        } catch (error) {
            Swal.close();
            errorAlert('Gagal memuat data layanan');
        }
    }

    async upsertData(formElement, checkingEdit) {
        const submitButton = $('#btnProsesLayanan');
        const originalText = submitButton.html();
        const isEdit = checkingEdit();

        confirmAlert('Apakah data yang Anda masukkan sudah benar?', async () => {
            try {
                submitButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memproses...');
                loadingAllert('Sedang menyimpan data...', 'Harap tunggu sebentar');

                const formData = new FormData(formElement);
                const id = $('#layanan_id').val();
                const url = isEdit
                    ? `${appUrl}/wo/layanan/update/${id}`
                    : `${appUrl}/wo/layanan/create`;

                await this.ajaxRequest(url, 'POST', formData);

                Swal.close();
                await successAlert('Data berhasil disimpan');
                $('#modalInputLayanan').modal('hide');
                await this.getAllData();
            } catch (error) {
                Swal.close();
                submitButton.attr('disabled', false).html(originalText);

                const status = error.status || error.responseJSON?.code;
                if (status === 422) {
                    warningAlert('Periksa kembali inputan Anda');
                    const errors = error.responseJSON?.errors || {};
                    const validator = $('#formSimpanLayanan').validate();
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
        confirmAlert('Data Layanan yang dihapus tidak dapat dikembalikan!', async () => {
            try {
                loadingAllert('Menghapus data...');
                await this.ajaxRequest(`${appUrl}/wo/layanan/delete/${id}`, 'DELETE');
                Swal.close();
                await successAlert();
                await this.getAllData();
            } catch (error) {
                Swal.close();
                errorAlert('Gagal menghapus data layanan');
            }
        });
    }

    async prepareCreateForm() {
        $('#formSimpanLayanan')[0].reset();
        $('#layanan_id').val('');
        // Inject wo_id dari session
        $('#wo_id_input').val(window.woId || '');
        if ($('#formSimpanLayanan').data('validator')) $('#formSimpanLayanan').validate().resetForm();
        $('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
        await this.loadKategoriOptions();
        $('#modalInputLayanan').modal('show');
    }
}

export default LayananService;
