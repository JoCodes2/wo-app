import PemesananService from "../services/data-transaksi.service.js";

$(document).ready(function () {
    const pemesanan = new PemesananService();

    // Initial Load
    pemesanan.getAllData();

    // Refresh Button
    $('#btnRefresh').on('click', function () {
        pemesanan.getAllData();
    });

    // Handle Detail Invoice
    $(document).on('click', '.btnDetailInvoice', function () {
        const id = $(this).data('id');
        pemesanan.getInvoice(id);
    });

    // Handle Konfirmasi Status
    $(document).on('click', '.btnKonfirmasi', function () {
        const id = $(this).data('id');
        const status = $(this).data('status');
        pemesanan.updateStatus(id, status);
    });

    // Print Invoice (Simulasi)
    $('#btnPrintInvoice').on('click', function () {
        const printContents = document.getElementById('invoiceContent').innerHTML;
        const originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload(); // Reload to restore event listeners
    });
});
