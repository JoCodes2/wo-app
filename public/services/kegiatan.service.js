class KegiatanService {
    constructor() {
        this.table = $('#KegiatanTable');
        this.kategoriContainer = $('#kategoriContainer');
    }

    /**
     * Template untuk tampilan tabel kosong
     */
    emptyTableTemplate() {
        return `
            <div class="py-5 text-center">
                <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle"
                     style="width: 100px; height: 100px; background-color: #e8ebff;">
                    <i class="fa-solid fa-calendar-alt fa-3x" style="color: #696cff;"></i>
                </div>
                <h5 class="fw-bold" style="color: #566a7f;">Belum Ada Data Kegiatan</h5>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert shadow-none mb-0"
                             style="background-color: #e8ebff; border: none; border-left: 5px solid #0026ff; border-radius: 8px;">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-circle-info fs-4 me-3" style="color: #0026ff;"></i>
                                <div class="text-start" style="color: #697a8d; font-size: 0.9rem;">
                                    Sistem belum menemukan data kegiatan terdaftar.
                                    Silakan tekan tombol <strong>Tambah Kegiatan</strong>
                                    untuk mulai mengisi data.
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

    async getAllKategoriMedia() {
        try {
            const response = await this.ajaxRequest(`${appUrl}/ikp/kategori_media/`, 'GET');
            return response.data || [];
        } catch (error) {
            console.error('Gagal memuat kategori media:', error);
            return [];
        }
    }

    async loadKategori(selectElement, selected = null) {
        try {
            const data = await this.getAllKategoriMedia();
            selectElement.empty();
            selectElement.append(`<option value="">-- Pilih Kategori Media --</option>`);

            data.forEach((item) => {
                const isSelected = selected === item.id ? 'selected' : '';
                selectElement.append(`<option value="${item.id}" ${isSelected}>${item.nama_kategori}</option>`);
            });
        } catch (error) {
            console.error("Gagal memuat kategori media", error);
        }
    }

    createKategoriRow(selected = null, isFirst = false) {
        const buttonHtml = isFirst
            ? `<button type="button" class="btn btn-success btnTambahKategori"><i class="fa fa-plus"></i></button>`
            : `<button type="button" class="btn btn-danger btnHapusKategori"><i class="fa fa-trash"></i></button>`;

        const row = $(`
            <div class="kategori-item d-flex gap-2 mb-2">
                <select class="form-select kategori-select" name="kategori_media_id[]" required></select>
                ${buttonHtml}
            </div>
        `);
        this.loadKategori(row.find('.kategori-select'), selected);
        return row;
    }

    async renderKategoriRows(selectedValues = []) {
        this.kategoriContainer.empty();
        if (!selectedValues || selectedValues.length === 0) {
            this.kategoriContainer.append(this.createKategoriRow(null, true));
            return;
        }
        selectedValues.forEach((value, index) => {
            this.kategoriContainer.append(this.createKategoriRow(value, index === 0));
        });
    }

    async addKategoriRow() {
        this.kategoriContainer.append(this.createKategoriRow(null, false));
    }

    removeKategoriRow(buttonElement) {
        if (this.kategoriContainer.find('.kategori-item').length <= 1) {
            warningAlert('Minimal harus ada satu kategori media.');
            return;
        }
        $(buttonElement).closest('.kategori-item').remove();
    }

    async getAllData() {
        if (!$.fn.dataTable.isDataTable(this.table)) {
            this.table.DataTable({
                pageLength: 10,
                responsive: true,
                language: { emptyTable: this.emptyTableTemplate() },
                columnDefs: [
                    { targets: [2, 5, 6], orderable: false },
                    { targets: [0, 5, 6], className: 'text-center align-middle' },
                    { targets: [1, 2, 3, 4], className: 'align-middle' }
                ]
            });
        }

        const datatable = this.table.DataTable();
        datatable.clear();

        try {
            const response = await this.ajaxRequest(`${appUrl}/ikp/kegiatan/`, 'GET');
            const kegiatanData = response.data || [];

            kegiatanData.forEach((item, index) => {
                const status = (item.status_kegiatan || 'draft').toLowerCase();
                const statusConfig = {
                    draft: { class: 'bg-label-secondary', icon: 'fa-regular fa-pen-to-square', text: 'Draft' },
                    dipublikasikan: { class: 'bg-label-success', icon: 'fa-solid fa-circle-check', text: 'Dipublikasikan' },
                    diarsipkan: { class: 'bg-label-warning', icon: 'fa-solid fa-box-archive', text: 'Diarsipkan' }
                };

                const currentStatus = statusConfig[status] || statusConfig.draft;
                const statusBadge = `<span class="badge ${currentStatus.class} text-capitalize px-3 py-2"><i class="${currentStatus.icon} me-1"></i>${currentStatus.text}</span>`;

                let actionButtons = ``;

                if (status === 'draft') {
                    actionButtons += `<button class="btn btn-outline-success btn-sm btnUbahStatus" data-id="${item.id}" data-status="dipublikasikan" title="Publikasikan"><i class="fa-solid fa-paper-plane"></i></button>`;
                } else if (status === 'dipublikasikan') {
                    actionButtons += `<button class="btn btn-outline-warning btn-sm btnUbahStatus" data-id="${item.id}" data-status="diarsipkan" title="Arsipkan"><i class="fa-solid fa-box-archive"></i></button>`;
                }

                const isDeleteDisabled = status !== 'draft' ? 'disabled' : '';
                actionButtons += `<button class="btn btn-outline-danger btn-sm btnHapusKegiatan" data-id="${item.id}" ${isDeleteDisabled} title="${status === 'draft' ? 'Hapus' : 'Data terbit/arsip tidak bisa dihapus'}"><i class="fa fa-trash"></i></button>`;

                const kategori = item.kategori_media?.length ? `<div class="d-flex flex-wrap gap-1">${item.kategori_media.map(k => `<span class="badge rounded-pill bg-label-info text-dark px-3 py-2"><i class="fa-solid fa-photo-film me-1"></i>${k.nama_kategori}</span>`).join('')}</div>` : '-';
                const tanggal = item.tanggal_kegiatan ? new Date(item.tanggal_kegiatan).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' }) : '-';
                const judulKegiatan = `<div><div class="fw-semibold text-dark">${item.judul_kegiatan ?? '-'}</div><small class="text-muted">${item.deskripsi_kegiatan ?? ''}</small></div>`;
                const lokasi = item.lokasi ? `<div class="d-flex align-items-center"><i class="fa-solid fa-location-dot text-danger me-2"></i><span>${item.lokasi}</span></div>` : '-';

                datatable.row.add([index + 1, judulKegiatan, kategori, tanggal, lokasi, statusBadge, `<div class="d-flex justify-content-center gap-2">${actionButtons}</div>`]);
            });

            datatable.draw();
        } catch (error) {
            console.error('Gagal memuat data kegiatan:', error);
        }
    }

    async updateStatus(id, newStatus) {
        const title = newStatus === 'dipublikasikan' ? 'Publikasikan Kegiatan?' : 'Arsipkan Kegiatan?';
        const text = newStatus === 'dipublikasikan'
            ? 'Kegiatan ini akan dipublikasikan dan tidak dapat dihapus.'
            : 'Kegiatan ini akan diarsipkan.';

        confirmAlert(text, async () => {
            try {
                loadingAllert('Memproses perubahan status...', 'Harap tunggu');

                const formData = new FormData();
                formData.append('status_kegiatan', newStatus);

                await this.ajaxRequest(`${appUrl}/ikp/kegiatan/update/${id}`, 'POST', formData);

                Swal.close();
                await successAlert('Status berhasil diperbarui');
                realoadBrowser();
            } catch (error) {
                Swal.close();
                console.error('Gagal ubah status:', error);
                errorAlert('Gagal memperbarui status');
            }
        }, title);
    }

    async upsertData(formElement) {
        const submitButton = $('#btnProsesKegiatan');
        const originalText = submitButton.html();

        confirmAlert('Apakah data yang Anda masukkan sudah benar?', async () => {
            try {
                submitButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memproses...');
                loadingAllert('Sedang menyimpan data...', 'Harap tunggu sebentar');

                const formData = new FormData(formElement);
                const url = `${appUrl}/ikp/kegiatan/create`;

                await this.ajaxRequest(url, 'POST', formData);

                Swal.close();
                await successAlert('Data berhasil disimpan');
                $('#modalInputKegiatan').modal('hide');

                realoadBrowser();
            } catch (error) {
                Swal.close();
                submitButton.attr('disabled', false).html(originalText);

                const status = error.status || error.responseJSON?.code;
                if (status === 422) {
                    warningAlert('Periksa kembali inputan Anda');
                    const errors = error.responseJSON?.errors || {};
                    const validator = $('#formSimpanKegiatan').validate();
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
        }, 'Simpan Data?');
    }

    async deleteData(id) {
        confirmAlert('Data Kegiatan yang dihapus tidak dapat dikembalikan!', async () => {
            try {
                loadingAllert('Menghapus data...');
                await this.ajaxRequest(`${appUrl}/ikp/kegiatan/delete/${id}`, 'DELETE');
                Swal.close();
                await successAlert();
                this.getAllData();
            } catch (error) {
                Swal.close();
                errorAlert('Gagal menghapus data');
            }
        });
    }

    async prepareCreateForm() {
        $('#formSimpanKegiatan')[0].reset();
        $('#kegiatan_id').val('');
        if ($('#formSimpanKegiatan').data('validator')) $('#formSimpanKegiatan').validate().resetForm();
        $('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
        await this.renderKategoriRows([]);
        $('#modalInputKegiatan').modal('show');
    }
}

export default KegiatanService;
