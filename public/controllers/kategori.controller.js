import KategoriService from "../services/kategori.service.js";

$(document).ready(function () {
    const kategori = new KategoriService();

    kategori.getAllData();

    function validation() {
        $('#formSimpanKategori').validate({
            ignore: [],
            rules: {
                nama_kategori: {
                    required: true,
                    maxlength: 255
                }
            },
            messages: {
                nama_kategori: {
                    required: "Nama kategori wajib diisi",
                    maxlength: "Nama kategori maksimal 255 karakter"
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
        return $('#kategori_id').val() !== '';
    }

    $('#btnTambahKategori').on('click', function () {
        kategori.prepareCreateForm();
    });

    $('#btnProsesKategori').on('click', async function (e) {
        e.preventDefault();
        const form = $('#formSimpanKategori');
        if (form.valid()) {
            await kategori.upsertData(form[0], checkingEdit);
        }
    });

    $(document).on('click', '.btnEditKategori', async function () {
        const id = $(this).data('id');
        await kategori.getDataById(id);
    });

    $(document).on('click', '.btnHapusKategori', function () {
        const id = $(this).data('id');
        kategori.deleteData(id);
    });

    $('#modalInputKategori').on('hidden.bs.modal', function () {
        $('#formSimpanKategori')[0].reset();
        $('#kategori_id').val('');

        $('#formSimpanKategori .form-control').removeClass('is-invalid is-valid');
        $('.error-msg').text('');
        $('small.text-danger').remove();

        if ($('#formSimpanKategori').data('validator')) {
            $('#formSimpanKategori').validate().resetForm();
        }
    });
});
