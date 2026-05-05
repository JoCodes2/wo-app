import userService from "../services/user.service.js";

$(document).ready(function () {
    const registrasi = new userService();

    // Toggle Form WO
    $('input[name="role"]').on('change', function () {
        if ($(this).val() === 'wo') {
            $('#woFormSection').slideDown().removeClass('hidden');
        } else {
            $('#woFormSection').slideUp();
        }
    });

    // Validasi Input Angka No HP
    $('#no_hp').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    function setupValidation() {
        // Metode kustom untuk ukuran file
        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0] && element.files[0].size <= param);
        }, 'Ukuran file maksimal 2MB');

        $('#registerForm').validate({
            rules: {
                nama_lengkap: { required: true, maxlength: 255 },
                email: { required: true, email: true },
                no_hp: { required: true, minlength: 10 },
                role: { required: true },
                password: { required: true, minlength: 8 },
                password_confirmation: { required: true, equalTo: "#password" },
                nama_wo: {
                    required: function () { return $('input[name="role"]:checked').val() === 'wo'; }
                },
                kontak: {
                    required: function () { return $('input[name="role"]:checked').val() === 'wo'; }
                },
                alamat_wo: {
                    required: function () { return $('input[name="role"]:checked').val() === 'wo'; }
                },
                biodata_pengelola: {
                    required: function () { return $('input[name="role"]:checked').val() === 'wo'; }
                },
                deskripsi_wo: {
                    required: function () { return $('input[name="role"]:checked').val() === 'wo'; }
                },
                foto_logo: {
                    extension: "jpg|jpeg|png",
                    filesize: 2048000
                }
            },
            messages: {
                nama_lengkap: "Nama lengkap wajib diisi",
                email: { required: "Email wajib diisi", email: "Format email tidak valid" },
                no_hp: "Nomor HP minimal 10 digit",
                role: "Pilih salah satu tipe akun",
                password: "Password minimal 8 karakter",
                password_confirmation: "Konfirmasi password tidak cocok",
                nama_wo: "Nama WO wajib diisi",
                kontak: "Kontak WO wajib diisi",
                alamat_wo: "Alamat WO wajib diisi",
                biodata_pengelola: "Biodata pengelola wajib diisi",
                deskripsi_wo: "Deskripsi WO wajib diisi",
                foto_logo: {
                    required: "Logo WO wajib diunggah",
                    extension: "Format harus jpg, jpeg, atau png",
                    filesize: "Ukuran maksimal 2MB"
                }
            },
            errorElement: 'p',
            errorClass: 'text-red-500 text-xs mt-1 font-medium',

            // Perbaikan error classList: Cek eksistensi element sebelum manipulasi
            highlight: function (element) {
                if (!element) return;
                const $el = $(element);
                if ($el.attr('type') === 'radio') {
                    $el.closest('.role-card').addClass('border-red-500').removeClass('border-[#f0ddd8]');
                } else {
                    $el.addClass('border-red-500').removeClass('border-[#f0ddd8] border-green-500');
                }
            },
            unhighlight: function (element) {
                if (!element) return;
                const $el = $(element);
                if ($el.attr('type') === 'radio') {
                    $el.closest('.role-card').removeClass('border-red-500');
                } else {
                    $el.addClass('border-green-500').removeClass('border-red-500');
                }
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") === "role") {
                    error.insertAfter("#roleContainer");
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }

    setupValidation();

    $('#btnRegister').on('click', function (e) {
        e.preventDefault();
        if ($('#registerForm').valid()) {
            registrasi.registrasi($('#registerForm')[0]);
        }
    });
});
