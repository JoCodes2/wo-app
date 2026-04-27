@extends('Layouts.Base')

@section('content')
    <div class="card">
        <x-base-header title="Manajemen Kegiatan" icon="fa-solid fa-calendar-check">
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary btn-sm" id="btnTambahKegiatan">
                    <i class="fa fa-plus"></i> Tambah
                </button>
            </div>
        </x-base-header>

        <x-base-body>
            <div class="alert alert-info border-0 small mb-4">
                <i class="fa-solid fa-circle-info me-1"></i>
                Halaman ini digunakan untuk mengelola data kegiatan/event beserta kategori kebutuhan media partner.
            </div>

            @php
                $headers = [
                    'No',
                    'Judul Kegiatan',
                    'Kategori Media Yang Dibutuhkan',
                    'Tanggal',
                    'Lokasi',
                    'Status',
                    'Aksi',
                ];
            @endphp

            <x-base-table :headers="$headers" id="KegiatanTable">
                <tbody id="kegiatanBody"></tbody>
            </x-base-table>
        </x-base-body>
    </div>

    <x-base-modal id="modalInputKegiatan" title="Form Data Kegiatan" size="lg">
        <x-base-form id="formSimpanKegiatan">
            <input type="hidden" name="id" id="id">
            <input type="hidden" name="kegiatan_id" id="kegiatan_id">

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="judul_kegiatan" class="form-label">
                        Judul Kegiatan <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="judul_kegiatan" name="judul_kegiatan"
                        placeholder="Contoh: Workshop Digital Marketing" required>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="deskripsi_kegiatan" class="form-label">Deskripsi Kegiatan</label>
                    <textarea class="form-control" id="deskripsi_kegiatan" name="deskripsi_kegiatan" rows="3"
                        placeholder="Tambahkan deskripsi detail kegiatan..."></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="asal_instansi" class="form-label">Asal Instansi</label>
                    <input type="text" class="form-control" id="asal_instansi" name="asal_instansi"
                        placeholder="Nama Instansi Penyelenggara">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nomor_surat" class="form-label">Nomor Surat</label>
                    <input type="text" class="form-control" id="nomor_surat" name="nomor_surat"
                        placeholder="Contoh: 001/UPT-IKP/III/2026">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">
                        Kategori Media yang Dibutuhkan <span class="text-danger">*</span>
                    </label>

                    <div id="kategoriContainer"></div>

                    <small class="text-muted">
                        Tambahkan kategori media yang dibutuhkan untuk kegiatan ini.
                    </small>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="tanggal_kegiatan" class="form-label">
                        Tanggal Kegiatan <span class="text-danger">*</span>
                    </label>
                    <input type="date" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="tanggal_akhir_kegiatan" class="form-label">
                        Tanggal Akhir Kegiatan
                    </label>
                    <input type="date" class="form-control" id="tanggal_akhir_kegiatan" name="tanggal_akhir_kegiatan">
                    <small class="text-muted">
                        Kosongkan jika kegiatan hanya 1 hari.
                    </small>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                    <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                    <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" class="form-control" id="lokasi" name="lokasi"
                        placeholder="Contoh: Aula Serbaguna Lantai 2">
                </div>
            </div>
        </x-base-form>

        <x-slot name="footer">
            <x-base-button variant="secondary" data-bs-dismiss="modal" text="Batal" />
            <x-base-button id="btnProsesKegiatan" variant="primary" text="Simpan Kegiatan" icon="fa-solid fa-save" />
        </x-slot>
    </x-base-modal>
@endsection

@section('scripts')
    <script type="module" src="{{ asset('controllers/kegiatan.controller.js') }}"></script>
@endsection
