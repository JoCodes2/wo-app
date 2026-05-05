import profileUserService from "../services/profile-user.service.js";

$(document).ready(function () {
    const service = new profileUserService();
    const userId = $('#auth-user-id').val() || $('meta[name="user-id"]').attr('content');

    async function initProfile() {
        if (userId) {
            await service.getProfileData(userId);
        }
    }

    initProfile();

    $('.tab-btn').on('click', function () {
        const target = $(this).data('tab');

        $('.tab-btn').removeClass('text-[#a03d32] border-[#a03d32] border-b-2').addClass('text-gray-500');
        $(this).addClass('text-[#a03d32] border-[#a03d32] border-b-2').removeClass('text-gray-500');

        $('.tab-content').hide();
        $(`#tab${target.charAt(0).toUpperCase() + target.slice(1)}`).show();
    });

    $('#formUpdateProfile').validate({
        rules: {
            nama_lengkap: { required: true },
            no_hp: { required: true, minlength: 10 },
            password: { minlength: 6 }
        },
        messages: {
            nama_lengkap: "Nama lengkap wajib diisi",
            no_hp: "Nomor HP tidak valid",
            password: "Password minimal 6 karakter"
        },
        errorElement: 'span',
        errorClass: 'text-xs text-red-500 mt-1',
        highlight: function (element) {
            $(element).addClass('border-red-500').removeClass('focus:border-[#a03d32]');
        },
        unhighlight: function (element) {
            $(element).removeClass('border-red-500').addClass('focus:border-[#a03d32]');
        },
        submitHandler: function (form) {
            service.updateProfile(form, userId);
        }
    });
});
