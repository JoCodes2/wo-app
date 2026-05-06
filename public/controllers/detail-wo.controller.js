import ProfileService from "../services/detail-wo.service.js";

$(document).ready(function () {
    const profile = new ProfileService();

    let woId = $('#wo-id-input').val();

    if (!woId) {
        const segments = window.location.pathname.split('/');
        woId = segments.pop() || segments.pop();
    }

    if (woId && woId !== 'profile-wo') {
        profile.getProfileData(woId);
    } else {
        $('#loading-state').html(`
            <div class="text-center">
                <i class="fa-solid fa-circle-exclamation text-red-500 text-3xl"></i>
                <p class="mt-2 text-gray-800">Wedding Organizer tidak ditemukan</p>
            </div>
        `);
    }
});
