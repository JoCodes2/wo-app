@extends('layouts-ui.base')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-0 py-6">

<div class="relative mb-6 md:mb-10">
        <div class="h-40 md:h-48 bg-gradient-to-br from-[#a03d32] via-[#c95a4a] to-[#a03d32] rounded-[2rem] relative overflow-hidden shadow-inner">
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 24px 24px;"></div>
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
        </div>

        <div class="absolute -bottom-16 md:-bottom-12 left-0 right-0 px-6 flex flex-col md:flex-row items-center md:items-end gap-4 md:gap-6">
            <div class="relative group">
                <div class="w-28 h-28 md:w-32 md:h-32 bg-white rounded-[2rem] p-2 shadow-2xl transform transition group-hover:scale-105">
                    <div class="w-full h-full bg-[#fce8e8] rounded-[1.5rem] flex items-center justify-center text-5xl text-[#a03d32]">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                </div>
                <div class="absolute bottom-1 right-1 w-8 h-8 bg-green-500 border-4 border-white rounded-full shadow-lg"></div>
            </div>

            <div class="text-center md:text-left mb-2 flex-grow">
                <h1 class="font-display text-2xl md:text-3xl font-black text-gray-900 tracking-tight mb-1" id="display_nama_lengkap">
                    Memuat...
                </h1>
                <div class="flex flex-wrap justify-center md:justify-start items-center gap-3 text-sm">
                    <span id="display_role" class="px-3 py-1 bg-[#a03d32]/10 text-[#a03d32] rounded-full font-bold uppercase text-[10px] tracking-wider">
                        Memuat...
                    </span>
                    <span class="text-gray-300 hidden md:block">|</span>
                    <span class="flex items-center gap-1.5 text-gray-500 font-medium">
                        <i class="fa-regular fa-calendar-check text-[#a03d32]"></i>
                        Bergabung <span id="display_joined">...</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-20 md:mt-16 mb-8">
        <div class="bg-white p-1.5 rounded-2xl border border-[#f0ddd8] flex gap-1 md:inline-flex shadow-sm">
            <button class="tab-btn flex-1 md:flex-none flex items-center justify-center gap-2 py-3 px-6 rounded-xl font-bold text-sm transition-all duration-300 text-[#a03d32] bg-[#fce8e8] shadow-sm border border-[#a03d32]/10" data-tab="profile">
                <i class="fa-regular fa-address-card text-lg"></i>
                <span>Biodata Profil</span>
            </button>

            <button class="tab-btn flex-1 md:flex-none flex items-center justify-center gap-2 py-3 px-6 rounded-xl font-bold text-sm transition-all duration-300 text-gray-500 hover:bg-gray-50 hover:text-gray-700" data-tab="orders">
                <i class="fa-solid fa-clock-rotate-left text-lg"></i>
                <span>Histori Layanan</span>
            </button>
        </div>
    </div>

    <div id="tabProfile" class="tab-content">
        <div class="grid md:grid-cols-3 gap-6">
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
                                <input type="text" id="nama_lengkap" name="nama_lengkap" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 outline-none transition" placeholder="Masukkan nama lengkap">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email (Aktif)</label>
                                <input type="email" id="email" name="email" class="w-full border border-[#f0ddd8] bg-gray-50 rounded-xl px-4 py-2.5 outline-none" readonly>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Handphone</label>
                                <input type="text" id="no_hp" name="no_hp" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 outline-none transition" placeholder="0812...">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                                <input type="password" id="password" name="password" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 outline-none transition" placeholder="Kosongkan jika tidak diubah">
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" id="btnSimpanProfile" class="px-8 py-2.5 bg-[#a03d32] text-white rounded-xl font-semibold hover:bg-[#8b352b] transition shadow-lg shadow-[#a03d32]/20">
                                <i class="fa-regular fa-floppy-disk mr-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="tabOrders" class="tab-content" style="display: none;">
        <div class="bg-white rounded-2xl border border-[#f0ddd8] p-6">
            <div id="orderListContainer" class="space-y-4">
                <div class="text-center py-12">
                    <i class="fa-solid fa-spinner fa-spin text-3xl text-[#a03d32]"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalInvoice" class="fixed inset-0 z-[99] hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" onclick="closeInvoiceModal()"></div>
        <div class="relative w-full max-w-4xl bg-white shadow-2xl rounded-[2.5rem] overflow-hidden transition-all transform">
            <div class="absolute right-6 top-6 z-10">
                <button onclick="closeInvoiceModal()" class="w-10 h-10 flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-full">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div id="invoice-modal-content"></div>
            <div class="p-6 bg-gray-50 border-t border-gray-100 flex flex-wrap gap-4 justify-center">
                <a id="btn-wa-modal" href="#" target="_blank" class="flex items-center gap-2 px-6 py-3 bg-[#25D366] text-white rounded-xl font-black uppercase text-[10px] tracking-widest shadow-lg">
                    <i class="fa-brands fa-whatsapp text-lg"></i> Chat WO
                </a>
                <button id="btn-download-invoice-img" class="flex items-center gap-2 px-6 py-3 bg-gray-900 text-white rounded-xl font-black uppercase text-[10px] tracking-widest shadow-lg">
                    <i class="fa-solid fa-image text-lg"></i> Download Gambar
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script type="module" src="{{ asset('controllers/profile-user.controller.js') }}"></script>
@endsection
