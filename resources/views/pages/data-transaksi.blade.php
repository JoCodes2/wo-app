@extends('Layouts.Base')

@section('content')
    <div class="card">
        <x-base-header title="Daftar Transaksi Pesanan" icon="fa-solid fa-receipt">
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-primary btn-sm" id="btnRefresh">
                    <i class="fa fa-sync"></i> Refresh Data
                </button>
            </div>
        </x-base-header>

        <x-base-body>
            <div class="alert alert-info border-0 small mb-4">
                <i class="fa-solid fa-circle-info me-1"></i>
                Kelola pesanan masuk, konfirmasi status pengerjaan, dan lihat rincian invoice pelanggan.
            </div>

            @php
                $headers = ['No', 'Pelanggan', 'Layanan', 'Tgl Acara', 'Total Bayar', 'Status', 'Aksi'];
            @endphp

            <x-base-table :headers="$headers" id="PemesananTable">
                <tbody id="pemesananBody"></tbody>
            </x-base-table>
        </x-base-body>
    </div>

    <x-base-modal id="modalInvoice" title="Detail Invoice Pesanan" size="lg">
        <div id="invoiceContent" class="p-3">
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-2">Memuat detail invoice...</p>
            </div>
        </div>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary" id="btnPrintInvoice">
                <i class="fa fa-print me-1"></i> Cetak
            </button>
        </x-slot>
    </x-base-modal>
@endsection

@section('scripts')
    <script type="module" src="{{ asset('controllers/data-transaksi.controller.js') }}"></script>
@endsection
