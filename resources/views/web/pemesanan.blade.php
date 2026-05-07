@extends('layouts-ui.base')


@section('content')
<section class="py-8 md:py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4">

        {{-- SECTION 1: FORM CHECKOUT (Default Visible) --}}
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
                        <input type="hidden" id="checkout-layanan-id">
                        <div class="bg-white p-6 md:p-10 rounded-[2.5rem] shadow-sm border border-[#f0ddd8]">
                            <h2 class="text-lg font-bold text-gray-900 mb-8 flex items-center gap-3">
                                <i class="fa-solid fa-calendar-heart text-[#a03d32]"></i>
                                Detail Rencana Acara
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Tanggal Acara</label>
                                    <input type="date" id="checkout-tgl-acara" required class="w-full px-5 py-4 rounded-2xl border border-gray-200 focus:border-[#a03d32] focus:ring-4 focus:ring-[#a03d32]/5 transition-all outline-none text-sm bg-gray-50/30">
                                </div>
                                <div class="space-y-2 md:col-span-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Lokasi Lengkap Acara</label>
                                    <textarea id="checkout-lokasi-acara" rows="3" required placeholder="Alamat lengkap atau nama gedung..." class="w-full px-5 py-4 rounded-2xl border border-gray-200 focus:border-[#a03d32] focus:ring-4 focus:ring-[#a03d32]/5 transition-all outline-none text-sm bg-gray-50/30"></textarea>
                                </div>
                                <div class="space-y-2 md:col-span-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Catatan Tambahan (Opsional)</label>
                                    <textarea id="checkout-catatan" rows="2" placeholder="Tuliskan permintaan khusus jika ada..." class="w-full px-5 py-4 rounded-2xl border border-gray-200 focus:border-[#a03d32] focus:ring-4 focus:ring-[#a03d32]/5 transition-all outline-none text-sm bg-gray-50/30"></textarea>
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

        {{-- SECTION 2: INVOICE DETAIL (Default Hidden) --}}
        <div id="section-invoice" class="hidden animate-fade-in">
            <div class="mb-10 text-center">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-green-50 text-green-500 rounded-full mb-4 shadow-inner">
                    <i class="fa-solid fa-circle-check text-5xl"></i>
                </div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tighter uppercase">Pemesanan Selesai</h1>
                <p class="text-gray-500 mt-2 text-lg">Invoice Anda telah diterbitkan secara otomatis.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-[3rem] shadow-sm border border-[#f0ddd8] overflow-hidden">
                        <div class="bg-gradient-to-br from-[#a03d32] to-[#7a2d25] p-10 text-white flex justify-between items-center">
                            <div>
                                <p class="text-rose-200 text-[10px] font-black uppercase tracking-[0.3em] mb-2">Transaction ID</p>
                                <h2 id="inv-id" class="text-2xl font-mono font-bold tracking-widest">INV/LOADING...</h2>
                            </div>
                            <span id="inv-status" class="px-6 py-2 bg-white/10 backdrop-blur-xl rounded-full text-[10px] font-black uppercase border border-white/20 tracking-widest">Menunggu</span>
                        </div>
                        <div class="p-10 md:p-14">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-16">
                                <div>
                                    <h3 class="text-gray-400 text-[10px] font-black uppercase tracking-widest mb-6 border-b pb-2">Customer Detail</h3>
                                    <p id="inv-customer-name" class="font-black text-gray-900 text-xl uppercase">-</p>
                                    <p id="inv-customer-phone" class="text-gray-500 mt-2"></p>
                                    <p id="inv-customer-email" class="text-gray-500"></p>
                                </div>
                                <div>
                                    <h3 class="text-gray-400 text-[10px] font-black uppercase tracking-widest mb-6 border-b pb-2">Wedding Organizer</h3>
                                    <p id="inv-wo-name" class="font-black text-[#a03d32] text-xl uppercase">-</p>
                                    <p id="inv-wo-address" class="text-gray-500 mt-2 text-sm leading-relaxed"></p>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-[2rem] p-8 mb-16 border border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="flex gap-4">
                                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm text-[#a03d32]"><i class="fa-solid fa-calendar-day"></i></div>
                                    <div>
                                        <p class="text-[10px] text-gray-400 font-black uppercase mb-1">Tanggal Acara</p>
                                        <p id="inv-tgl-acara" class="font-bold text-gray-900">-</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm text-[#a03d32]"><i class="fa-solid fa-map-location-dot"></i></div>
                                    <div>
                                        <p class="text-[10px] text-gray-400 font-black uppercase mb-1">Lokasi Acara</p>
                                        <p id="inv-lokasi-acara" class="font-medium text-gray-600 text-sm italic">-</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-8">
                                <table class="w-full">
                                    <thead>
                                        <tr class="text-gray-400 text-[11px] font-black uppercase tracking-widest border-b border-gray-100">
                                            <th class="py-5 text-left">Paket Yang Dipesan</th>
                                            <th class="py-5 text-right">Harga Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="py-8">
                                                <p id="inv-layanan-nama" class="font-black text-gray-900 text-lg uppercase leading-none">-</p>
                                                <p id="inv-layanan-kategori" class="text-[10px] text-[#a03d32] font-black mt-2 uppercase tracking-tighter italic"></p>
                                            </td>
                                            <td id="inv-layanan-harga" class="py-8 text-right font-black text-gray-900 text-lg">Rp 0</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="border-t-4 border-double border-gray-100">
                                            <td class="py-8 text-right font-black text-gray-400 uppercase tracking-widest text-xs">Total Pembayaran</td>
                                            <td id="inv-total" class="py-8 text-right text-3xl font-black text-[#a03d32]">Rp 0</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white p-10 rounded-[3rem] shadow-xl border border-[#f0ddd8] sticky top-8 text-center">
                        <h3 class="font-black text-gray-900 mb-8 uppercase tracking-widest border-b pb-4">Aksi Cepat</h3>
                        <div class="space-y-4">
                            <a id="btn-chat-wa" href="#" target="_blank" class="flex items-center justify-center gap-3 w-full py-5 bg-[#25D366] hover:bg-[#1da851] text-white rounded-2xl font-black uppercase tracking-widest transition-all shadow-lg shadow-green-100 group">
                                <i class="fa-brands fa-whatsapp text-2xl"></i>
                                <span>WhatsApp WO</span>
                            </a>
                            <button id="btn-download-pdf" class="flex items-center justify-center gap-3 w-full py-5 bg-gray-900 hover:bg-black text-white rounded-2xl font-black uppercase tracking-widest transition-all shadow-lg shadow-gray-200">
                                <i class="fa-solid fa-download text-lg"></i>
                                <span>Unduh PDF</span>
                            </button>
                        </div>
                        <div class="mt-10 p-6 bg-rose-50 rounded-3xl border border-rose-100">
                            <p class="text-[10px] text-[#a03d32] font-bold leading-relaxed uppercase italic">Simpan bukti ini sebagai referensi saat melakukan koordinasi dengan vendor terkait.</p>
                        </div>
                        <a href="/" class="block mt-8 text-xs font-black text-gray-400 hover:text-[#a03d32] uppercase tracking-[0.3em] transition-all">Kembali Ke Home</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<style>
    .animate-fade-in { animation: fadeIn 0.6s ease-out forwards; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection
@section('scripts')

@endsection
