import authService from "../services/auth.service.js";

$(document).ready(function () {
    const auth = new authService();

    // Toggle Password
    $('#togglePassword').on('click', function () {
        const passwordInput = $('#password');
        const icon = $(this).find('i');

        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordInput.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    function validation() {
        $('#loginForm').validate({
            rules: {
                email: { required: true, email: true },
                password: { required: true, minlength: 8 }
            },
            messages: {
                email: {
                    required: "Email tidak boleh kosong.",
                    email: "Masukkan format email yang benar."
                },
                password: {
                    required: "Password wajib diisi.",
                    minlength: "Password minimal 8 karakter."
                }
            },
            highlight: function (element) {
                $(element).addClass('border-red-500 focus:ring-red-500').removeClass('border-[#f0ddd8] border-green-500 focus:ring-green-700');
                const parent = $(element).parent();
                parent.find('.valid-icon, .error-icon').remove();

                const rightPos = ($(element).attr('id') === 'password') ? 'right-10' : 'right-3';
                $(element).after(`
                    <span class="error-icon absolute ${rightPos} top-1/2 -translate-y-1/2 text-red-500 pointer-events-none">
                        <i class="fas fa-circle-xmark"></i>
                    </span>
                `);
            },
            unhighlight: function (element) {
                $(element).addClass('border-green-500 focus:ring-green-500').removeClass('border-red-500 border-[#f0ddd8] focus:ring-red-500');
                const parent = $(element).parent();
                parent.find('.valid-icon, .error-icon').remove();

                const rightPos = ($(element).attr('id') === 'password') ? 'right-10' : 'right-3';
                $(element).after(`
                    <span class="valid-icon absolute ${rightPos} top-1/2 -translate-y-1/2 text-green-600 pointer-events-none">
                        <i class="fas fa-circle-check"></i>
                    </span>
                `);
            },
            errorElement: 'p',
            errorClass: 'text-red-500 text-xs mt-1 block w-full font-medium',
            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.relative'));
            },
        });
    }

    validation();

    $('#loginForm').on('submit', function (e) {
        e.preventDefault();
        if ($(this).valid()) {
            auth.login(this);
        }
    });
});
