@extends('Layouts.Base')

@section('content')
    <div class="card">
        <x-base-header title="Manajemen Galeri" icon="fa-solid fa-images">
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary btn-sm" id="btnTambahGaleri">
                    <i class="fa fa-plus"></i> Tambah Foto
                </button>
            </div>
        </x-base-header>

        <x-base-body>
            <div class="alert alert-info border-0 small mb-4">
                <i class="fa-solid fa-circle-info me-1"></i>
                Halaman ini digunakan untuk mengelola foto portofolio galeri Wedding Organizer.
            </div>

            @php
                $headers = [
                    'No',
                    'Foto',
                    'Keterangan',
                    'Aksi',
                ];
            @endphp

            <x-base-table :headers="$headers" id="GaleriTable">
                <tbody id="galeriBody"></tbody>
            </x-base-table>
        </x-base-body>
    </div>

    <x-base-modal id="modalInputGaleri" title="Tambah Foto Galeri" size="md">
        <x-base-form id="formSimpanGaleri">
            <input type="hidden" name="wo_id" id="wo_id_galeri_input">

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="foto_portofolio" class="form-label">
                        Foto Portofolio <span class="text-danger">*</span>
                    </label>
                    <input type="file" class="form-control" id="foto_portofolio" name="foto_portofolio"
                        accept="image/jpeg,image/png,image/jpg,image/webp">
                    <div id="error-foto_portofolio" class="error-msg mt-1"></div>
                    <small class="text-muted">Format: JPG, PNG, WEBP. Maks. 2 MB.</small>
                </div>

                {{-- Preview foto --}}
                <div class="col-md-12 mb-3 d-none" id="fotoPreviewContainer">
                    <label class="form-label">Preview</label>
                    <div class="text-center border rounded p-2" style="background:#f8f9fa;">
                        <img id="fotoPreview" src="" alt="Preview Foto"
                             class="img-fluid rounded"
                             style="max-height: 220px; object-fit: contain;">
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="keterangan" class="form-label">
                        Keterangan <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3"
                        placeholder="Deskripsi singkat tentang foto ini..."></textarea>
                    <div id="error-keterangan" class="error-msg mt-1"></div>
                </div>
            </div>
        </x-base-form>

        <x-slot name="footer">
            <x-base-button variant="secondary" data-bs-dismiss="modal" text="Batal" />
            <x-base-button id="btnProsesGaleri" variant="primary" text="Simpan Foto" icon="fa-solid fa-save" />
        </x-slot>
    </x-base-modal>
@endsection

@section('scripts')
    <script>
        window.woId = '{{ auth()->check() && auth()->user()->profilWo ? auth()->user()->profilWo->id : '' }}';
        window.appAssetUrl = '{{ asset('') }}';
    </script>
    <script type="module" src="{{ asset('controllers/galeri.controller.js') }}"></script>
@endsection
