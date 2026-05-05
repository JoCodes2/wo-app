@extends('layouts-ui.base')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-0 py-6">

    {{-- Header Profil --}}
    <div class="relative mb-8">
        <div class="h-32 bg-gradient-to-r from-[#a03d32] to-[#c95a4a] rounded-2xl"></div>
        <div class="absolute -bottom-12 left-6 flex items-end gap-4">
            <div class="w-24 h-24 bg-white rounded-2xl border-4 border-white shadow-lg flex items-center justify-center">
                <div class="w-20 h-20 bg-[#fce8e8] rounded-xl flex items-center justify-center text-4xl text-[#a03d32]">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
            <div class="mb-2">
                {{-- ID untuk Nama Lengkap dari tabel users --}}
                <h1 class="font-display text-2xl font-bold text-gray-900" id="display_nama_lengkap">Memuat...</h1>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <span id="display_role" class="capitalize"></span>
                    <span>•</span>
                    <span class="flex items-center gap-1">
                        <i class="fa-regular fa-calendar"></i>
                        <span id="display_joined"></span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Navigasi Tab --}}
    <div class="mt-16 mb-6 border-b border-[#f0ddd8]">
        <div class="flex gap-6">
            <button class="tab-btn py-3 px-1 font-semibold text-[#a03d32] border-b-2 border-[#a03d32]" data-tab="profile">
                <i class="fa-regular fa-address-card mr-2"></i> Biodata Profil
            </button>
            <button class="tab-btn py-3 px-1 font-semibold text-gray-500 hover:text-gray-700 transition" data-tab="orders">
                <i class="fa-regular fa-receipt mr-2"></i> Pesanan Saya
            </button>
        </div>
    </div>

    {{-- Konten Tab: Biodata --}}
    <div id="tabProfile" class="tab-content">
        <div class="grid md:grid-cols-3 gap-6">

            {{-- Informasi Ringkas (Sidebar) --}}
            <div class="md:col-span-1">
                <div class="bg-white rounded-2xl border border-[#f0ddd8] p-5">
                    <div class="text-center mb-5">
                        <div class="w-20 h-20 bg-[#fce8e8] rounded-full flex items-center justify-center mx-auto text-3xl text-[#a03d32] mb-3">
                            <i class="fa-solid fa-id-badge"></i>
                        </div>
                        <h3 class="font-bold text-gray-900" id="side_nama_lengkap">-</h3>
                        <p class="text-xs text-gray-400" id="side_email">-</p>
                    </div>

                    <div class="space-y-3 pt-4 border-t border-[#f0ddd8]">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">Status Akun</span>
                            <span id="display_status" class="px-2 py-1 rounded-lg text-xs font-bold"></span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">No. WhatsApp</span>
                            <span class="text-gray-900 font-medium" id="side_no_hp">-</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form Update Biodata --}}
            <div class="md:col-span-2">
                <div class="bg-white rounded-2xl border border-[#f0ddd8] p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-display text-xl font-bold flex items-center gap-2">
                            <i class="fa-solid fa-user-pen text-[#a03d32]"></i> Edit Biodata
                        </h3>
                    </div>

                    <form id="formUpdateProfile">
                        <input type="hidden" id="auth-user-id" value="{{ $user->id }}">
                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap"
                                    class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-[#a03d32]/20 focus:border-[#a03d32] outline-none transition"
                                    placeholder="Masukkan nama lengkap">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email (Aktif)</label>
                                <input type="email" id="email" name="email"
                                    class="w-full border border-[#f0ddd8] bg-gray-50 rounded-xl px-4 py-2.5 outline-none"
                                    readonly>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Handphone</label>
                                <input type="text" id="no_hp" name="no_hp"
                                    class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-[#a03d32]/20 focus:border-[#a03d32] outline-none transition"
                                    placeholder="Contoh: 08123456789">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                                <input type="password" id="password" name="password"
                                    class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-[#a03d32]/20 focus:border-[#a03d32] outline-none transition"
                                    placeholder="Kosongkan jika tidak diubah">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" id="btnSimpanProfile"
                                class="px-8 py-2.5 bg-[#a03d32] text-white rounded-xl font-semibold hover:bg-[#8b352b] transition shadow-lg shadow-[#a03d32]/20">
                                <i class="fa-regular fa-floppy-disk mr-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Konten Tab: Riwayat Pesanan --}}
    <div id="tabOrders" class="tab-content" style="display: none;">
        <div class="bg-white rounded-2xl border border-[#f0ddd8] p-6">
            <div id="orderListContainer" class="space-y-4">
                {{-- Data Pesanan akan dirender oleh JavaScript --}}
                <div class="text-center py-12">
                    <i class="fa-solid fa-spinner fa-spin text-3xl text-[#a03d32]"></i>
                    <p class="mt-2 text-gray-500">Memuat riwayat pesanan...</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
    <script type="module" src="{{ asset('controllers/profile-user.controller.js') }}"></script>
@endsection
