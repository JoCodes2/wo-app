import Kategori_mediaService from "../services/kategori_media.service.js";

$(document).ready(function () {
    const kategoriMedia = new Kategori_mediaService();

    kategoriMedia.getAllData();

    $('#btnTambahKategorimedia').on('click', function () {
        $('#formSimpanKategorimedia')[0].reset();
        $('#kategori_id').val('');

        $('#formSimpanKategorimedia .form-control').removeClass('is-valid is-invalid');
        $('.error-msg').text('');

        $('#modalInputKategorimedia').modal('show');
    });

    function validation() {
        $('#formSimpanKategorimedia').validate({
            rules: {
                nama_kategori: {
                    required: true
                },
                deskripsi: {
                    required: true
                },
            },
            messages: {
                nama_kategori: {
                    required: "Nama kategori wajib diisi"
                },
                deskripsi: {
                    required: "Deskripsi wajib diisi"
                },
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
        return $('#kategori_id').val() ? true : false;
    }

    $('#btnProsesKategorimedia').on('click', function (e) {
        e.preventDefault();
        if ($('#formSimpanKategorimedia').valid()) {
            kategoriMedia.upsertData($('#formSimpanKategorimedia')[0], checkingEdit);
        }
    });

    $(document).on('click', '.btnEditKategorimedia', function () {
        const id = $(this).data('id');
        kategoriMedia.getDataById(id);
    });

    $(document).on('click', '.btnHapusKategorimedia', function () {
        const id = $(this).data('id');
        kategoriMedia.deleteData(id);
    });

    $('#modalInputKategorimedia').on('hidden.bs.modal', function () {
        $('#formSimpanKategorimedia')[0].reset();
        $('#formSimpanKategorimedia .form-control').removeClass('is-invalid is-valid');
        $('.error-msg').text('');
    });
});
