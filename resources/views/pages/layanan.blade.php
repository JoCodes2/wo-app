@extends('Layouts.Base')

@section('content')
    <div class="card">
        <x-base-header title="Manajemen Layanan" icon="fa-solid fa-concierge-bell">
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary btn-sm" id="btnTambahLayanan">
                    <i class="fa fa-plus"></i> Tambah
                </button>
            </div>
        </x-base-header>

        <x-base-body>
            <div class="alert alert-info border-0 small mb-4">
                <i class="fa-solid fa-circle-info me-1"></i>
                Halaman ini digunakan untuk mengelola data layanan yang tersedia di Wedding Organizer.
            </div>

            @php
                $headers = [
                    'No',
                    'Nama Layanan',
                    'Kategori',
                    'Harga',
                    'Aksi',
                ];
            @endphp

            <x-base-table :headers="$headers" id="LayananTable">
                <tbody id="layananBody"></tbody>
            </x-base-table>
        </x-base-body>
    </div>

    <x-base-modal id="modalInputLayanan" title="Form Data Layanan" size="lg">
        <x-base-form id="formSimpanLayanan">
            <input type="hidden" name="id" id="layanan_id">
            <input type="hidden" name="wo_id" id="wo_id_input">

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="nama_layanan" class="form-label">
                        Nama Layanan <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="nama_layanan" name="nama_layanan"
                        placeholder="Contoh: Paket Dekorasi Premium" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="kategori_id_layanan" class="form-label">
                        Kategori <span class="text-danger">*</span>
                    </label>
                    <select class="form-select" id="kategori_id_layanan" name="kategori_id" required>
                        <option value="">-- Pilih Kategori --</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="harga" class="form-label">
                        Harga (Rp) <span class="text-danger">*</span>
                    </label>
                    <input type="number" class="form-control" id="harga" name="harga"
                        placeholder="Contoh: 5000000" min="0" step="1000" required>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="detail_layanan" class="form-label">Detail Layanan</label>
                    <textarea class="form-control" id="detail_layanan" name="detail_layanan" rows="4"
                        placeholder="Deskripsi lengkap mengenai layanan ini..."></textarea>
                </div>
            </div>
        </x-base-form>

        <x-slot name="footer">
            <x-base-button variant="secondary" data-bs-dismiss="modal" text="Batal" />
            <x-base-button id="btnProsesLayanan" variant="primary" text="Simpan Layanan" icon="fa-solid fa-save" />
        </x-slot>
    </x-base-modal>
@endsection

@section('scripts')
    <script>
        window.woId = '{{ auth()->check() && auth()->user()->profilWo ? auth()->user()->profilWo->id : '' }}';
    </script>
    <script type="module" src="{{ asset('controllers/layanan.controller.js') }}"></script>
@endsection
