@extends('Layouts.Base')

@section('content')
<div class="mb-4">
    <a href="{{ url('kelola_kegiatan') }}" class="btn btn-secondary btn-sm">
        <i class="fa fa-arrow-left"></i> Kembali ke Daftar Kegiatan
    </a>
</div>

<div class="row">
    <!-- Info Ringkas Kegiatan -->
    <div class="col-md-12 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0 bg-primary-subtle text-primary p-3 rounded-3 me-3">
                        <i class="fa-solid fa-calendar-day fa-2x"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1" id="eventTitle">Memuat data...</h4>
                        <p class="text-muted mb-0" id="eventLocation">-</p>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="p-2 border rounded bg-light">
                            <small class="text-muted d-block">Tanggal Kegiatan</small>
                            <span class="fw-semibold" id="eventDate">-</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-2 border rounded bg-light">
                            <small class="text-muted d-block">Asal Instansi</small>
                            <span class="fw-semibold" id="eventInstansi">-</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-2 border rounded bg-light">
                            <small class="text-muted d-block">Status</small>
                            <span id="eventStatus">-</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Proposal Disetujui -->
    <div class="col-md-12">
        <div class="card">
            <x-base-header title="Daftar Proposal Media Partner (Disetujui)" icon="fa-solid fa-handshake">
            </x-base-header>
            <x-base-body>
                @php
                    $headers = ['No', 'Media Partner', 'Judul Proposal', 'Tanggal Disetujui', 'Status Tiket', 'Aksi'];
                @endphp
                <x-base-table :headers="$headers" id="ProposalAccTable">
                    <tbody id="proposalAccBody"></tbody>
                </x-base-table>
            </x-base-body>
        </div>
    </div>
</div>

<!-- Modal Buat Tiket -->
<x-base-modal id="modalBuatTiket" title="Buat Tiket Tugas" size="lg">
    <x-base-form id="formBuatTiket">
        <input type="hidden" name="proposal_pengajuan_id" id="proposal_id">
        
        <div class="mb-3">
            <label for="judul_tugas" class="form-label">Judul Tugas <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="judul_tugas" name="judul_tugas" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi_tugas" class="form-label">Deskripsi Tugas</label>
            <textarea class="form-control" id="deskripsi_tugas" name="deskripsi_tugas" rows="3"></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="batas_waktu" class="form-label">Deadline Lapor <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="batas_waktu" name="batas_waktu" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori Tugas <span class="text-danger">*</span></label>
            <div id="kategoriTugasContainer" class="d-flex flex-wrap gap-3 p-3 border rounded">
                <!-- Checkboxes will be rendered here -->
            </div>
            <small class="text-muted">Pilih kategori tugas yang harus dikerjakan media partner.</small>
        </div>
    </x-base-form>

    <x-slot name="footer">
        <x-base-button variant="secondary" data-bs-dismiss="modal" text="Batal" />
        <x-base-button id="btnSimpanTiket" variant="primary" text="Terbitkan Tiket" icon="fa-solid fa-paper-plane" />
    </x-slot>
</x-base-modal>

<input type="hidden" id="kegiatan_id_param" value="{{ $id }}">
@endsection

@section('scripts')
<script type="module" src="{{ asset('controllers/detail_kegiatan_proposals.controller.js') }}"></script>
@endsection
