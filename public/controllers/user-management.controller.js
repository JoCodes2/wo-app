import UserManagementService from "../services/user-management.service.js";

$(document).ready(function () {
    const service = new UserManagementService();

    async function init() {
        loadingAllert('Memuat Data...', 'Harap tunggu');
        await service.fetchAllData();
        Swal.close();
        service.renderTable('all');
    }

    init();

    $('#filterRole').on('change', function () {
        const selectedRole = $(this).val();
        service.renderTable(selectedRole);
    });

    $(document).on('click', '.btnDetailWO', function () {
        service.getDetailWO($(this).data('id'));
    });

    $(document).on('click', '.btnApproveWO', function () {
        service.aktivasiAkun($(this).data('id'));
    });

    $(document).on('click', '.btnHapusUser', function () {
        service.deleteUser($(this).data('id'));
    });
});
