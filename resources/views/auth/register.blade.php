@extends('layouts-ui.base')

@section('content')
<div class="min-h-screen bg-[#fdf8f5] py-10">
    <div class="max-w-3xl mx-auto px-4">
        <div class="bg-white rounded-2xl border border-[#f0ddd8] p-6 md:p-8 shadow-sm">

            {{-- Header --}}
            <div class="text-center mb-8">
                <div class="text-4xl mb-2">❤️</div>
                <h2 class="font-display text-2xl md:text-3xl font-bold text-gray-900">Daftar Akun</h2>
                <p class="text-gray-500 text-sm mt-1">Gabung dan mulai rencanakan hari spesial Anda</p>
            </div>

            <form id="registerForm" enctype="multipart/form-data">
                @csrf

                {{-- Bagian 1: Informasi Dasar --}}
                <div class="space-y-4 mb-8">
                    <h3 class="font-semibold text-gray-900 flex items-center gap-2 border-b border-[#f0ddd8] pb-2">
                        <i class="fa-solid fa-user text-[#a03d32]"></i> Informasi Dasar
                    </h3>

                    <div class="relative">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:border-[#a03d32] focus:ring-1 focus:ring-[#a03d32] outline-none transition" placeholder="Contoh: Ahmad Santoso">
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="email" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:border-[#a03d32] focus:ring-1 focus:ring-[#a03d32] outline-none transition" placeholder="contoh@email.com">
                        </div>
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">No. HP</label>
                            <input type="tel" name="no_hp" id="no_hp" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:border-[#a03d32] focus:ring-1 focus:ring-[#a03d32] outline-none transition" placeholder="081234567890">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                            <input type="password" name="password" id="password" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:border-[#a03d32] focus:ring-1 focus:ring-[#a03d32] outline-none transition" placeholder="Minimal 8 karakter">
                        </div>
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:border-[#a03d32] focus:ring-1 focus:ring-[#a03d32] outline-none transition" placeholder="Ulangi password">
                        </div>
                    </div>
                </div>

                {{-- Bagian 2: Pilih Role --}}
                <div class="mb-8">
                    <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2 border-b border-[#f0ddd8] pb-2">
                        <i class="fa-solid fa-users text-[#a03d32]"></i> Pilih Tipe Akun
                    </h3>

                    <div class="grid md:grid-cols-2 gap-4" id="roleContainer">
                        <label class="role-card relative border-2 border-[#f0ddd8] rounded-xl p-4 cursor-pointer transition-all hover:bg-[#fdf8f5]">
                            <input type="radio" name="role" value="user" class="hidden peer">
                            <div class="peer-checked:border-[#a03d32] absolute inset-0 border-2 border-transparent rounded-xl pointer-events-none transition-all"></div>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-[#fce8e8] rounded-full flex items-center justify-center text-[#a03d32]">
                                    <i class="fa-regular fa-heart"></i>
                                </div>
                                <div>
                                    <span class="block font-bold text-gray-900">Customer</span>
                                    <p class="text-xs text-gray-500">Cari Wedding Organizer</p>
                                </div>
                            </div>
                        </label>

                        <label class="role-card relative border-2 border-[#f0ddd8] rounded-xl p-4 cursor-pointer transition-all hover:bg-[#fdf8f5]">
                            <input type="radio" name="role" value="wo" class="hidden peer">
                            <div class="peer-checked:border-[#a03d32] absolute inset-0 border-2 border-transparent rounded-xl pointer-events-none transition-all"></div>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-[#fce8e8] rounded-full flex items-center justify-center text-[#a03d32]">
                                    <i class="fa-solid fa-briefcase"></i>
                                </div>
                                <div>
                                    <span class="block font-bold text-gray-900">Wedding Organizer</span>
                                    <p class="text-xs text-gray-500">Daftarkan Usaha Anda</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Bagian 3: Form Tambahan WO (Hidden by default) --}}
                <div id="woFormSection" class="hidden space-y-4 bg-gray-50 p-5 rounded-2xl border border-dashed border-[#f0ddd8] mb-8">
                    <h4 class="font-semibold text-gray-900 flex items-center gap-2">
                        <i class="fa-solid fa-store text-[#a03d32]"></i> Detail Wedding Organizer
                    </h4>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama WO</label>
                            <input type="text" name="nama_wo" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 bg-white focus:border-[#a03d32] outline-none">
                        </div>
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Kontak WA WO</label>
                            <input type="text" name="kontak" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 bg-white focus:border-[#a03d32] outline-none" placeholder="08xxxx">
                        </div>
                    </div>

                    <div class="relative">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Kantor WO</label>
                        <textarea name="alamat_wo" rows="2" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 bg-white focus:border-[#a03d32] outline-none"></textarea>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Biodata Pengelola</label>
                            <textarea name="biodata_pengelola" rows="2" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 bg-white focus:border-[#a03d32] outline-none"></textarea>
                        </div>
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Usaha</label>
                            <textarea name="deskripsi_wo" rows="2" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 bg-white focus:border-[#a03d32] outline-none"></textarea>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Foto Logo</label>
                            <input type="file" name="foto_logo" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#fce8e8] file:text-[#a03d32] hover:file:bg-[#fbd5d5]">
                        </div>
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Instagram (Opsional)</label>
                            <input type="text" name="sosial_media" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 bg-white focus:border-[#a03d32] outline-none" placeholder="@username">
                        </div>
                    </div>
                </div>

                {{-- Action Button --}}
                <button type="button" id="btnRegister" class="w-full py-3.5 bg-[#a03d32] text-white rounded-xl font-bold text-lg hover:bg-[#8a332a] shadow-lg shadow-[#a03d32]/20 transition-all active:scale-[0.98]">
                    Daftar Sekarang
                </button>
            </form>

            <p class="text-center text-sm mt-8 text-gray-500">
                Sudah punya akun? <a href="/login" class="text-[#a03d32] font-bold hover:underline">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>

<style>
    .peer:checked + div { border-color: #a03d32; }
    label.error { position: relative; }
</style>
@endsection
@section('scripts')
<script type="module" src="{{ asset('controllers/user.controller.js') }}"></script>
@endsection
