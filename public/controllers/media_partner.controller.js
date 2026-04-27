import MediapartnerService from "../services/media_partner.service.js";

$(document).ready(function () {
    const mediaPartner = new MediapartnerService();

    mediaPartner.getAllData();
    mediaPartner.renderKategoriMedia();

    $('#btnTambahMediapartner').on('click', function () {
        $('#formSimpanMediapartner')[0].reset();
        $('#id').val('');
        $('#pengguna_id').val('');

        $('#formSimpanMediapartner .form-control, #formSimpanMediapartner .form-select').removeClass('is-valid is-invalid');
        $('.error-msg').text('');
        $('.nav-link').removeClass('text-danger');

        const firstTab = new bootstrap.Tab($('#akun-tab'));
        firstTab.show();

        $('#passRequired').show();
        $('#modalInputMediapartner').modal('show');
    });

    function validation() {
        $('#formSimpanMediapartner').validate({
            rules: {
                nama_lengkap: { required: true },
                email: { required: true, email: true },
                password: {
                    required: function () { return !$('#id').val(); },
                    minlength: 8
                },
                password_confirmation: {
                    equalTo: "#password"
                },
                nama_media: { required: true },
                nama_pimpinan: { required: true },
                email_media: { required: true, email: true },
                no_telepon: { required: true },
                status_kerja_sama: { required: true },
                "kategori_media_id[]": {
                    required: true,
                    minlength: 1
                }
            },
            messages: {
                nama_lengkap: "Nama lengkap akun wajib diisi",
                email: {
                    required: "Email login wajib diisi",
                    email: "Format email tidak valid"
                },
                password: {
                    required: "Password wajib diisi untuk akun baru",
                    minlength: "Password minimal 8 karakter"
                },
                password_confirmation: "Konfirmasi password tidak cocok",
                nama_media: "Nama media wajib diisi",
                nama_pimpinan: "Nama pimpinan wajib diisi",
                email_media: "Email korespondensi media wajib diisi",
                no_telepon: "Nomor telepon wajib diisi",
                status_kerja_sama: "Pilih status kerjasama",
                "kategori_media_id[]": "Pilih minimal satu kategori peliputan"
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback pb-2');

                if (element.attr("name") === "kategori_media_id[]") {
                    error.appendTo('#kategoriCheckboxContainer');
                } else if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element) {
                $(element).addClass('is-invalid').removeClass('is-valid');
                const tabId = $(element).closest('.tab-pane').attr('id');
                $(`#${tabId.replace('tab-', '')}-tab`).addClass('text-danger');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid').addClass('is-valid');
                const tabPane = $(element).closest('.tab-pane');
                if (tabPane.find('.is-invalid').length === 0) {
                    const tabId = tabPane.attr('id');
                    $(`#${tabId.replace('tab-', '')}-tab`).removeClass('text-danger');
                }
            }
        });
    }

    validation();

    function checkingEdit() {
        return $('#id').val() ? true : false;
    }

    $('#btnProsesMediapartner').on('click', function (e) {
        e.preventDefault();

        if ($('#formSimpanMediapartner').valid()) {
            mediaPartner.upsertData($('#formSimpanMediapartner')[0], checkingEdit);
        } else {
            const errorInTab = $('.tab-pane:has(.is-invalid)').first().attr('id');
            if (errorInTab) {
                const tabButtonId = errorInTab.replace('tab-', '') + '-tab';
                const errorTab = new bootstrap.Tab($(`#${tabButtonId}`));
                errorTab.show();
            }
        }
    });

    $(document).on('click', '.btnEditMediapartner', function () {
        const id = $(this).data('id');
        const firstTab = new bootstrap.Tab($('#akun-tab'));
        firstTab.show();
        $('#passRequired').hide();
        mediaPartner.getDataById(id);
    });

    $(document).on('click', '.btnHapusMediapartner', function () {
        const id = $(this).data('id');
        mediaPartner.deleteData(id);
    });

    $('#modalInputMediapartner').on('hidden.bs.modal', function () {
        $('#formSimpanMediapartner')[0].reset();
        $('#formSimpanMediapartner .form-control, #formSimpanMediapartner .form-select').removeClass('is-invalid is-valid');
        $('.error-msg').text('');
        $('.nav-link').removeClass('text-danger');
        $('.check-kategori').prop('checked', false);
    });
});
