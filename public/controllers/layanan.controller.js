import LayananService from "../services/layanan.service.js";

$(document).ready(function () {
    const layanan = new LayananService();

    layanan.getAllData();

    function validation() {
        $('#formSimpanLayanan').validate({
            ignore: [],
            rules: {
                nama_layanan: {
                    required: true,
                    maxlength: 255
                },
                kategori_id: {
                    required: true
                },
                harga: {
                    required: true,
                    number: true,
                    min: 0
                },
                detail_layanan: {
                    maxlength: 1000
                }
            },
            messages: {
                nama_layanan: {
                    required: "Nama layanan wajib diisi",
                    maxlength: "Nama layanan maksimal 255 karakter"
                },
                kategori_id: {
                    required: "Kategori wajib dipilih"
                },
                harga: {
                    required: "Harga wajib diisi",
                    number: "Harga harus berupa angka",
                    min: "Harga tidak boleh negatif"
                }
            },
            errorElement: 'small',
            errorPlacement: function (error, element) {
                error.addClass('text-danger');
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
        return $('#layanan_id').val() !== '';
    }

    $('#btnTambahLayanan').on('click', async function () {
        await layanan.prepareCreateForm();
    });

    $('#btnProsesLayanan').on('click', async function (e) {
        e.preventDefault();
        const form = $('#formSimpanLayanan');
        if (form.valid()) {
            await layanan.upsertData(form[0], checkingEdit);
        }
    });

    $(document).on('click', '.btnEditLayanan', async function () {
        const id = $(this).data('id');
        await layanan.getDataById(id);
    });

    $(document).on('click', '.btnHapusLayanan', function () {
        const id = $(this).data('id');
        layanan.deleteData(id);
    });

    $('#modalInputLayanan').on('hidden.bs.modal', function () {
        $('#formSimpanLayanan')[0].reset();
        $('#layanan_id').val('');

        $('#formSimpanLayanan .form-control').removeClass('is-invalid is-valid');
        $('#formSimpanLayanan .form-select').removeClass('is-invalid is-valid');
        $('.error-msg').text('');
        $('small.text-danger').remove();

        if ($('#formSimpanLayanan').data('validator')) {
            $('#formSimpanLayanan').validate().resetForm();
        }
    });
});
