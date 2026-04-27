import KegiatanService from "../services/kegiatan.service.js";

$(document).ready(function () {
    const kegiatan = new KegiatanService();

    kegiatan.getAllData();

    function validation() {
        $('#formSimpanKegiatan').validate({
            ignore: [],
            rules: {
                judul_kegiatan: {
                    required: true,
                    maxlength: 255
                },
                tanggal_kegiatan: {
                    required: true,
                    date: true
                },
                asal_instansi: {
                    maxlength: 255
                },
                nomor_surat: {
                    maxlength: 255
                },
                lokasi: {
                    maxlength: 255
                },
                'kategori_media_id[]': {
                    required: true
                }
            },
            messages: {
                judul_kegiatan: {
                    required: "Judul kegiatan wajib diisi",
                    maxlength: "Judul kegiatan maksimal 255 karakter"
                },
                tanggal_kegiatan: {
                    required: "Tanggal kegiatan wajib diisi",
                    date: "Format tanggal tidak valid"
                },
                'kategori_media_id[]': {
                    required: "Minimal satu kategori media wajib dipilih"
                }
            },
            errorElement: 'small',
            errorPlacement: function (error, element) {
                error.addClass('text-danger');

                if (element.attr('name') === 'kategori_media_id[]') {
                    error.insertAfter($('#kategoriContainer'));
                    return;
                }

                const errorId = '#error-' + element.attr('name');
                if ($(errorId).length) {
                    $(errorId).html(error);
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            }
        });
    }

    validation();

    function checkingEdit() {
        return $('#kegiatan_id').val() !== '';
    }

    $('#btnTambahKegiatan').on('click', async function () {
        await kegiatan.prepareCreateForm();
    });

    $(document).on('click', '.btnTambahKategori', async function () {
        await kegiatan.addKategoriRow();
    });

    $(document).on('click', '.btnHapusKategori', function () {
        kegiatan.removeKategoriRow(this);

        const form = $('#formSimpanKegiatan');
        if (form.data('validator')) {
            form.validate().element('select[name="kategori_media_id[]"]');
        }
    });

    $(document).on('change', 'select[name="kategori_media_id[]"]', function () {
        const form = $('#formSimpanKegiatan');
        if (form.data('validator')) {
            form.validate().element(this);
        }
    });

    $('#btnProsesKegiatan').on('click', async function (e) {
        e.preventDefault();

        const form = $('#formSimpanKegiatan');

        if (form.valid()) {
            await kegiatan.upsertData(form[0], checkingEdit);
        }
    });

    $(document).on('click', '.btnEditKegiatan', async function () {
        const id = $(this).data('id');
        await kegiatan.getDataById(id);
    });

    $(document).on('click', '.btnHapusKegiatan', function () {
        const id = $(this).data('id');
        kegiatan.deleteData(id);
    });

    $('#modalInputKegiatan').on('hidden.bs.modal', async function () {
        $('#formSimpanKegiatan')[0].reset();
        $('#kegiatan_id').val('');
        $('#status_kegiatan').val('draft').trigger('change');

        $('#formSimpanKegiatan .form-control').removeClass('is-invalid is-valid');
        $('#formSimpanKegiatan .form-select').removeClass('is-invalid is-valid');
        $('.error-msg').text('');
        $('small.text-danger').remove();

        if ($('#formSimpanKegiatan').data('validator')) {
            $('#formSimpanKegiatan').validate().resetForm();
        }

        await kegiatan.renderKategoriRows([]);
    });

    $(document).on('click', '.btnUbahStatus', function () {
        const id = $(this).data('id');
        const status = $(this).data('status');

        kegiatan.updateStatus(id, status);
    });
});
