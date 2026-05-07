import GaleriService from "../services/galeri.service.js";

$(document).ready(function () {
    const galeri = new GaleriService();

    galeri.getAllData();

    function validation() {

    // Custom validator ukuran file
    $.validator.addMethod(
        "filesize",
        function (value, element, param) {

            if (element.files.length === 0) {
                return true;
            }

            return element.files[0].size <= param * 1024;

        },
        "Ukuran file terlalu besar"
    );

    $('#formSimpanGaleri').validate({

        ignore: [],

        rules: {
            foto_portofolio: {
                required: true,
                filesize: 2048
            },

            keterangan: {
                required: true,
                maxlength: 500
            }
        },

        messages: {

            foto_portofolio: {
                required: "Foto portofolio wajib diunggah",
                filesize: "Ukuran gambar maksimal 2 MB"
            },

            keterangan: {
                required: "Keterangan wajib diisi",
                maxlength: "Keterangan maksimal 500 karakter"
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

            $(element)
                .addClass('is-invalid')
                .removeClass('is-valid');
        },

        unhighlight: function (element) {

            $(element)
                .removeClass('is-invalid')
                .addClass('is-valid');
        }
    });
}

    validation();

    // Preview foto real-time saat file dipilih
    $(document).on('change', '#foto_portofolio', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#fotoPreview').attr('src', e.target.result);
                $('#fotoPreviewContainer').removeClass('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            $('#fotoPreview').attr('src', '');
            $('#fotoPreviewContainer').addClass('d-none');
        }
    });

    $('#btnTambahGaleri').on('click', function () {
        galeri.prepareCreateForm();
    });

    $('#btnProsesGaleri').on('click', async function (e) {
        e.preventDefault();
        const form = $('#formSimpanGaleri');
        if (form.valid()) {
            await galeri.createData(form[0]);
        }
    });

    $(document).on('click', '.btnHapusGaleri', function () {
        const id = $(this).data('id');
        galeri.deleteData(id);
    });

    $('#modalInputGaleri').on('hidden.bs.modal', function () {
        $('#formSimpanGaleri')[0].reset();
        $('#fotoPreview').attr('src', '');
        $('#fotoPreviewContainer').addClass('d-none');

        $('#formSimpanGaleri .form-control').removeClass('is-invalid is-valid');
        $('.error-msg').text('');
        $('small.text-danger').remove();

        if ($('#formSimpanGaleri').data('validator')) {
            $('#formSimpanGaleri').validate().resetForm();
        }
    });
});
