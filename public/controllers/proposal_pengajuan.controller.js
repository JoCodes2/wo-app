import ProposalpengajuanService from "../services/proposal_pengajuan.service.js";

$(document).ready(function () {
    const service = new ProposalpengajuanService();

    service.getAllData();

    $('#btnFilter').off('click').on('click', function () {
        service.applyFilters();
    });

    $('#btnRefreshTable').off('click').on('click', function () {
        $('#filterStatus').val('');
        $('#filterTanggalMulai').val('');
        $('#filterTanggalSelesai').val('');
        service.getAllData();
    });

    $(document).off('click', '.btnDetailProposal').on('click', '.btnDetailProposal', function () {
        const id = $(this).data('id');
        service.getDataById(id);
    });

    $(document).off('click', '.btnUpdateStatus').on('click', '.btnUpdateStatus', function () {
        const id = $(this).data('id');
        const status = $(this).data('status');

        service.updateStatus(id, status);
    });
});
