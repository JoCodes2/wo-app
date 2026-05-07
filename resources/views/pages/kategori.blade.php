@extends('Layouts.Base')

@section('content')
    <div class="card">
        <x-base-header title="Manajemen Kategori Layanan" icon="fa-solid fa-tags">
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary btn-sm" id="btnTambahKategori">
                    <i class="fa fa-plus"></i> Tambah
                </button>
            </div>
        </x-base-header>

        <x-base-body>
            <div class="alert alert-info border-0 small mb-4">
                <i class="fa-solid fa-circle-info me-1"></i>
                Halaman ini digunakan untuk mengelola data kategori layanan Wedding Organizer.
            </div>

            @php
                $headers = [
                    'No',
                    'Nama Kategori',
                    'Aksi',
                ];
            @endphp

            <x-base-table :headers="$headers" id="KategoriTable">
                <tbody id="kategoriBody"></tbody>
            </x-base-table>
        </x-base-body>
    </div>

    <x-base-modal id="modalInputKategori" title="Form Data Kategori" size="md">
        <x-base-form id="formSimpanKategori">
            <input type="hidden" name="id" id="kategori_id">

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="nama_kategori" class="form-label">
                        Nama Kategori <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                        placeholder="Contoh: Dekorasi, Catering, Foto & Video" required>
                </div>
            </div>
        </x-base-form>

        <x-slot name="footer">
            <x-base-button variant="secondary" data-bs-dismiss="modal" text="Batal" />
            <x-base-button id="btnProsesKategori" variant="primary" text="Simpan Kategori" icon="fa-solid fa-save" />
        </x-slot>
    </x-base-modal>
@endsection

@section('scripts')
    <script type="module" src="{{ asset('controllers/kategori.controller.js') }}"></script>
@endsection
