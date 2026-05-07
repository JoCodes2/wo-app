@extends('layouts-ui.base')

@section('content')
<section class="py-8 md:py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4">
        <div id="section-checkout" class="block">
            <div class="mb-8 flex items-center gap-4">
                <button onclick="history.back()" class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm border border-gray-100 text-[#a03d32] hover:bg-[#a03d32] hover:text-white transition-all">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
                <div>
                    <h1 class="text-2xl font-black text-gray-900 tracking-tight uppercase">Konfirmasi Pemesanan</h1>
                    <p class="text-sm text-gray-500">Lengkapi detail acara untuk memproses pesanan Anda</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-6">
                    <form id="form-checkout" class="space-y-6">
                        <input type="hidden" id="checkout-layanan-id" name="layanan_id">
                        <input type="hidden" id="checkout-total-bayar-input" name="total_bayar">

                        <div class="bg-white p-6 md:p-10 rounded-[2.5rem] shadow-sm border border-[#f0ddd8]">
                            <h2 class="text-lg font-bold text-gray-900 mb-8 flex items-center gap-3">
                                <i class="fa-solid fa-calendar-heart text-[#a03d32]"></i>
                                Detail Rencana Acara
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1 ml-1">Tanggal Acara</label>
                                    <div class="relative">
                                        <input type="date" name="tgl_acara" id="checkout-tgl-acara" required class="w-full px-5 py-4 rounded-2xl border border-[#f0ddd8] focus:border-[#a03d32] focus:ring-1 focus:ring-[#a03d32] outline-none transition-all text-sm bg-gray-50/30">
                                    </div>
                                </div>
                                <div class="space-y-2 md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1 ml-1">Lokasi Lengkap Acara</label>
                                    <div class="relative">
                                        <textarea name="lokasi_acara" id="checkout-lokasi-acara" rows="3" required placeholder="Alamat lengkap atau nama gedung..." class="w-full px-5 py-4 rounded-2xl border border-[#f0ddd8] focus:border-[#a03d32] focus:ring-1 focus:ring-[#a03d32] outline-none transition-all text-sm bg-gray-50/30"></textarea>
                                    </div>
                                </div>
                                <div class="space-y-2 md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1 ml-1">Catatan Tambahan (Opsional)</label>
                                    <div class="relative">
                                        <textarea name="catatan" id="checkout-catatan" rows="2" placeholder="Tuliskan permintaan khusus jika ada..." class="w-full px-5 py-4 rounded-2xl border border-[#f0ddd8] focus:border-[#a03d32] focus:ring-1 focus:ring-[#a03d32] outline-none transition-all text-sm bg-gray-50/30"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white rounded-[2.5rem] shadow-xl border border-[#f0ddd8] overflow-hidden sticky top-8">
                        <div class="p-6 bg-[#a03d32] text-white">
                            <h3 class="font-bold text-lg uppercase tracking-widest">Ringkasan Paket</h3>
                        </div>
                        <div class="p-8 space-y-6">
                            <div class="pb-6 border-b border-gray-100 text-center md:text-left">
                                <span id="checkout-kategori" class="px-3 py-1 bg-rose-50 text-[#a03d32] text-[10px] font-black rounded-lg uppercase">Memuat...</span>
                                <h4 id="checkout-nama-layanan" class="mt-3 font-black text-gray-900 text-xl uppercase leading-tight">Menunggu Data...</h4>
                                <p id="checkout-wo-name" class="text-xs text-gray-400 mt-2 font-bold italic uppercase tracking-wider">-</p>
                            </div>
                            <div class="space-y-4">
                                <div class="flex justify-between text-sm font-medium">
                                    <span class="text-gray-400 uppercase tracking-tighter">Harga Paket</span>
                                    <span id="checkout-harga-paket" class="text-gray-900 font-bold">Rp 0</span>
                                </div>
                                <div class="flex justify-between items-center pt-4 border-t-2 border-dashed border-gray-100">
                                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Total</span>
                                    <span id="checkout-total-bayar" class="text-2xl font-black text-[#a03d32]">Rp 0</span>
                                </div>
                            </div>
                            <button type="submit" form="form-checkout" id="btn-submit-checkout" class="w-full mt-4 py-5 bg-gray-900 hover:bg-[#a03d32] text-white rounded-2xl font-black uppercase tracking-widest transition-all shadow-xl shadow-gray-200 flex items-center justify-center gap-3 group active:scale-95">
                                <span>Konfirmasi</span>
                                <i class="fa-solid fa-paper-plane text-xs group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      {{-- SECTION INVOICE --}}
        <div id="section-invoice" class="hidden animate-fade-in">
            <div class="mb-10 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-green-50 text-green-500 rounded-full mb-4 shadow-inner">
                    <i class="fa-solid fa-circle-check text-4xl"></i>
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tighter uppercase">Pemesanan Selesai</h1>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                {{-- AREA YANG AKAN DI-DOWNLOAD (ID: invoice-card) --}}
                <div class="lg:col-span-2" id="invoice-card">
                    <div class="bg-white rounded-[2rem] md:rounded-[3rem] shadow-sm border border-[#f0ddd8] overflow-hidden">
                        <div class="bg-gradient-to-br from-[#a03d32] to-[#7a2d25] p-8 md:p-10 text-white flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div>
                                <p class="text-rose-200 text-[10px] font-black uppercase tracking-[0.3em] mb-2">Transaction ID</p>
                                <h2 id="inv-id" class="text-xl md:text-2xl font-mono font-bold tracking-widest">INV/LOADING...</h2>
                            </div>
                            <span id="inv-status" class="px-6 py-2 bg-white/10 backdrop-blur-xl rounded-full text-[10px] font-black uppercase border border-white/20 tracking-widest">Menunggu</span>
                        </div>

                        <div class="p-6 md:p-14">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                                <div>
                                    <h3 class="text-gray-400 text-[10px] font-black uppercase tracking-widest mb-4 border-b pb-2">Customer</h3>
                                    <p id="inv-customer-name" class="font-black text-gray-900 text-lg uppercase">-</p>
                                    <p id="inv-customer-phone" class="text-gray-500 text-sm mt-1"></p>
                                </div>
                                <div>
                                    <h3 class="text-gray-400 text-[10px] font-black uppercase tracking-widest mb-4 border-b pb-2">Wedding Organizer</h3>
                                    <p id="inv-wo-name" class="font-black text-[#a03d32] text-lg uppercase">-</p>
                                    <p id="inv-wo-address" class="text-gray-500 text-xs leading-relaxed mt-1"></p>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-[2rem] p-6 mb-12 border border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="flex gap-4">
                                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm text-[#a03d32]"><i class="fa-solid fa-calendar-day text-sm"></i></div>
                                    <div>
                                        <p class="text-[9px] text-gray-400 font-black uppercase">Tanggal Acara</p>
                                        <p id="inv-tgl-acara" class="font-bold text-gray-900 text-sm">-</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm text-[#a03d32]"><i class="fa-solid fa-map-location-dot text-sm"></i></div>
                                    <div>
                                        <p class="text-[9px] text-gray-400 font-black uppercase">Lokasi Acara</p>
                                        <p id="inv-lokasi-acara" class="font-medium text-gray-600 text-xs italic break-words">-</p>
                                    </div>
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="text-gray-400 text-[10px] font-black uppercase tracking-widest border-b border-gray-100">
                                            <th class="py-4 text-left">Paket</th>
                                            <th class="py-4 text-right">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="py-6">
                                                <p id="inv-layanan-nama" class="font-black text-gray-900 text-base md:text-lg uppercase">-</p>
                                                <p id="inv-layanan-kategori" class="text-[9px] text-[#a03d32] font-black mt-1 uppercase italic"></p>
                                            </td>
                                            <td id="inv-layanan-harga" class="py-6 text-right font-black text-gray-900 text-base md:text-lg">Rp 0</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="border-t-2 border-dashed border-gray-200">
                                            <td class="py-6 text-right font-black text-gray-400 uppercase text-[10px]">Total</td>
                                            <td id="inv-total" class="py-6 text-right text-2xl md:text-3xl font-black text-[#a03d32]">Rp 0</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SIDEBAR AKSI --}}
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-[#f0ddd8] sticky top-8 text-center">
                        <h3 class="font-black text-gray-900 mb-6 uppercase tracking-widest border-b pb-4">Aksi</h3>
                        <div class="space-y-4">
                            <a id="btn-chat-wa" href="#" target="_blank" class="flex items-center justify-center gap-3 w-full py-4 bg-[#25D366] hover:bg-[#1da851] text-white rounded-2xl font-black uppercase text-sm tracking-widest transition-all group">
                                <i class="fa-brands fa-whatsapp text-xl"></i>
                                <span>WhatsApp WO</span>
                            </a>
                            <button id="btn-download-image" class="flex items-center justify-center gap-3 w-full py-4 bg-gray-900 hover:bg-black text-white rounded-2xl font-black uppercase text-sm tracking-widest transition-all">
                                <i class="fa-solid fa-image text-lg"></i>
                                <span>Simpan Gambar</span>
                            </button>
                        </div>
                        <a href="/" class="block mt-8 text-[10px] font-black text-gray-400 hover:text-[#a03d32] uppercase tracking-[0.3em]">Kembali Ke Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
{{-- Library untuk Gambar --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script type="module" src="{{ asset('controllers/pemesanan.controller.js') }}"></script>
@endsection
