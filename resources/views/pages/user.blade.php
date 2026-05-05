@extends('Layouts.Base')

@section('content')
    <div class="card">
        <x-base-header title="Manajemen User" icon="fa-solid fa-users-gear">
            <div class="d-flex gap-2">
                <select class="form-select form-select-sm" id="filterRole" style="width: 180px;">
                    <option value="all" selected>Semua Akun</option>
                    <option value="user">User / Mempelai</option>
                    <option value="wo">Wedding Organizer</option>
                </select>
            </div>
        </x-base-header>

        <x-base-body>
            <div class="alert alert-info border-0 small mb-4">
                <i class="fa-solid fa-circle-info me-1"></i>
                Kelola data pengguna sistem <strong>PaluWedding</strong>. Anda dapat melihat detail profil WO, menyetujui aktivasi akun, atau menghapus data.
            </div>

            @php
                $headers = [
                    'No',
                    'Nama Lengkap',
                    'Email',
                    'No. HP',
                    'Status',
                    'Aksi',
                ];
            @endphp

            <x-base-table :headers="$headers" id="UserTable">
                <tbody id="userBody">
                    {{-- Data akan dirender via controller.js --}}
                </tbody>
            </x-base-table>
        </x-base-body>
    </div>

  {{-- Modal Detail Profil WO --}}
<x-base-modal id="modalDetailWO" title="Detail Profil Wedding Organizer" size="lg">
    <div id="detailContent" class="p-2">
        {{-- Header Profil: Logo & Nama --}}
        <div class="text-center mb-4">
            <div class="position-relative d-inline-block">
                <img id="detail_foto_logo" src="{{ asset('assets/img/default-logo.png') }}"
                     class="rounded-circle shadow-sm border border-4 border-white"
                     style="width: 120px; height: 120px; object-fit: cover;" alt="Logo WO">
                <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white"
                     style="width: 20px; height: 20px;" title="Akun Terverifikasi"></div>
            </div>
            <h4 id="detail_nama_wo" class="fw-bold mt-3 mb-0 text-dark">Nama Wedding Organizer</h4>
            <p class="text-muted small">
                <i class="fa-solid fa-calendar-check me-1"></i> Mitra PaluWedding sejak <span id="detail_tahun">-</span>
            </p>
        </div>

        <div class="row g-4">
            {{-- Kolom Kiri: Informasi Kontak & Sosmed --}}
            <div class="col-md-5">
                <div class="card h-100 border-0 bg-light">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3 text-[#a03d32] border-bottom pb-2">
                            <i class="fa-solid fa-address-card me-2"></i>Informasi Kontak
                        </h6>
                        <div class="mb-3">
                            <label class="text-muted small d-block">Pengelola</label>
                            <span id="detail_pengelola" class="fw-semibold text-dark">-</span>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted small d-block">WhatsApp / Kontak</label>
                            <span id="detail_kontak" class="fw-semibold text-dark">-</span>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted small d-block">Media Sosial</label>
                            <span id="detail_sosmed" class="fw-semibold text-dark">-</span>
                        </div>
                        <div class="mb-0">
                            <label class="text-muted small d-block">Alamat Kantor</label>
                            <span id="detail_alamat" class="fw-semibold text-dark small">-</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Deskripsi & Biodata --}}
            <div class="col-md-7">
                <div class="mb-4">
                    <h6 class="fw-bold text-[#a03d32] border-bottom pb-2">
                        <i class="fa-solid fa-id-badge me-2"></i>Biodata Pengelola
                    </h6>
                    <p id="detail_biodata" class="text-muted small leading-relaxed">-</p>
                </div>
                <div>
                    <h6 class="fw-bold text-[#a03d32] border-bottom pb-2">
                        <i class="fa-solid fa-quote-left me-2"></i>Tentang WO
                    </h6>
                    <p id="detail_deskripsi" class="text-muted small leading-relaxed">-</p>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="footer">
        <div id="footerAction" class="me-auto">
            {{-- Tombol Aktivasi akan muncul di sini via JS --}}
        </div>
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
    </x-slot>
</x-base-modal>
@endsection

@section('scripts')
    <script type="module" src="{{ asset('controllers/user-management.controller.js') }}"></script>
@endsection
