@extends('Layouts.Base')

@section('content')
    <div class="row">
        {{-- Sidebar Info Ringkas --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center py-5">
                    <div class="mb-3 text-center">
                       <img id="display_logo" src="{{ asset('assets/img/default-wo.png') }}"
                        class="rounded-circle img-thumbnail shadow-sm d-block mx-auto"
                        style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <h4 class="fw-bold mb-1" id="display_nama_wo">Nama WO</h4>
                    <p class="text-muted small mb-3" id="display_email">email@wo.com</p>
                    <span class="badge bg-success shadow-sm px-3 py-2" id="display_status">Akun Aktif</span>
                </div>
                <div class="card-footer bg-white border-top-0 pb-4 px-4">
                    <div class="d-flex justify-content-between text-sm mb-2">
                        <span class="text-muted">Tahun Bergabung:</span>
                        <span class="fw-bold" id="display_tahun">-</span>
                    </div>
                    <div class="d-flex justify-content-between text-sm">
                        <span class="text-muted">Kontak Utama:</span>
                        <span class="fw-bold text-primary" id="display_kontak">-</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form Edit Profil --}}
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <x-base-header title="Pengaturan Profil WO" icon="fa-solid fa-store-user" />

                <x-base-body>
                    <form id="formUpdateProfilWo" enctype="multipart/form-data">
                        <input type="hidden" id="user_id" name="user_id">

                        <h6 class="text-primary fw-bold mb-3 mt-2"><i class="fa-solid fa-user-lock me-2"></i>Informasi Akun Utama</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Lengkap Pengelola</label>
                                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email Login</label>
                                <input type="email" class="form-control bg-light" id="email" name="email" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nomor WhatsApp</label>
                                <input type="text" class="form-control" name="no_hp" id="no_hp" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Password Baru (Opsional)</label>
                                <input type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak diubah">
                            </div>
                        </div>

                        <hr class="text-muted opacity-25">

                        <h6 class="text-primary fw-bold mb-3 mt-4"><i class="fa-solid fa-briefcase me-2"></i>Detail Bisnis Wedding Organizer</h6>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Nama Brand / WO</label>
                                <input type="text" class="form-control" name="nama_wo" id="nama_wo" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Update Logo WO</label>
                                <input type="file" class="form-control" name="foto_logo" id="input_logo" accept="image/*">
                                <div class="form-text">Format: JPG, PNG. Maksimal 2MB.</div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Biodata Pengelola</label>
                                <textarea class="form-control" name="biodata_pengelola" id="biodata_pengelola" rows="2" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Alamat Kantor WO</label>
                                <textarea class="form-control" name="alamat_wo" id="alamat_wo" rows="2" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Deskripsi Layanan & Visi</label>
                                <textarea class="form-control" name="deskripsi_wo" id="deskripsi_wo" rows="4" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Kontak Bisnis</label>
                                <input type="text" class="form-control" name="kontak" id="kontak" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Sosial Media (Link)</label>
                                <input type="text" class="form-control" name="sosial_media" id="sosial_media" placeholder="Contoh: @username">
                            </div>
                        </div>

                        <div class="mt-5 pt-3 border-top d-flex justify-content-end">
                            <button type="submit" id="btnSimpanProfil" class="btn btn-primary px-5 py-2 shadow-sm">
                                <i class="fa-solid fa-save me-2"></i>Simpan Perubahan Profil
                            </button>
                        </div>
                    </form>
                </x-base-body>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        window.userId = '{{ auth()->id() }}';
    </script>
    <script type="module" src="{{ asset('controllers/profile-wo.controller.js') }}"></script>
@endsection
