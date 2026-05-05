import profilWoService from "../services/profile-wo.service.js";

$(document).ready(function () {
    const service = new profilWoService();
    const currentUserId = window.userId;

    if (currentUserId) {
        service.getProfilData(currentUserId);
    }

    $('#formUpdateProfilWo').on('submit', function (e) {
        e.preventDefault();
        service.updateProfil(this, currentUserId);
    });

    $('#input_logo').on('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#display_logo').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
    });
});
