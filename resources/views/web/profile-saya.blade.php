@extends('layouts-ui.base')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-0 py-6">

    {{-- Header Profil dengan Cover --}}
    <div class="relative mb-8">
        <div class="h-32 bg-gradient-to-r from-[#a03d32] to-[#c95a4a] rounded-2xl"></div>
        <div class="absolute -bottom-12 left-6 flex items-end gap-4">
            <div class="w-24 h-24 bg-white rounded-2xl border-4 border-white shadow-lg flex items-center justify-center">
                <div class="w-20 h-20 bg-[#fce8e8] rounded-xl flex items-center justify-center text-4xl text-[#a03d32]">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
            <div class="mb-2">
                <h1 class="font-display text-2xl font-bold text-gray-900" id="userName">Loading...</h1>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <span id="userRole"></span>
                    <span>•</span>
                    <span class="flex items-center gap-1"><i class="fa-regular fa-calendar"></i> Bergabung sejak <span id="userJoined"></span></span>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabs Navigasi --}}
    <div class="mt-16 mb-6 border-b border-[#f0ddd8]">
        <div class="flex gap-6">
            <button class="tab-btn py-3 px-1 font-semibold text-[#a03d32] border-b-2 border-[#a03d32]" data-tab="profile">
                <i class="fa-regular fa-user mr-2"></i> Profil Saya
            </button>
            <button class="tab-btn py-3 px-1 font-semibold text-gray-500 hover:text-gray-700 transition" data-tab="orders">
                <i class="fa-regular fa-receipt mr-2"></i> Riwayat Pesanan
            </button>
        </div>
    </div>

    {{-- Tab Profil Saya --}}
    <div id="tabProfile" class="tab-content">
        <div class="grid md:grid-cols-3 gap-6">
            {{-- Sidebar Info --}}
            <div class="md:col-span-1">
                <div class="bg-white rounded-2xl border border-[#f0ddd8] p-5 sticky top-24">
                    <div class="text-center">
                        <div class="w-28 h-28 bg-[#fce8e8] rounded-full flex items-center justify-center mx-auto text-5xl text-[#a03d32]">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <h3 class="font-bold text-gray-900 mt-3" id="profileName">-</h3>
                        <p class="text-xs text-gray-400" id="profileUsername">@username</p>
                        <div class="mt-3">
                            <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                <i class="fa-solid fa-circle-check text-[10px] mr-1"></i> Akun Aktif
                            </span>
                        </div>
                    </div>
                    <div class="mt-5 pt-4 border-t border-[#f0ddd8]">
                        <div class="flex items-center gap-3 text-sm mb-3">
                            <i class="fa-regular fa-envelope text-[#a03d32] w-5"></i>
                            <span class="text-gray-600" id="profileEmail">-</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm mb-3">
                            <i class="fa-solid fa-phone text-[#a03d32] w-5"></i>
                            <span class="text-gray-600" id="profilePhone">-</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm">
                            <i class="fa-regular fa-circle-user text-[#a03d32] w-5"></i>
                            <span class="text-gray-600" id="profileRole">-</span>
                        </div>
                    </div>
                    <button id="editProfileBtn" class="w-full mt-5 py-2 border border-[#a03d32] text-[#a03d32] rounded-xl text-sm font-semibold hover:bg-[#a03d32] hover:text-white transition">
                        <i class="fa-regular fa-pen-to-square mr-1"></i> Edit Profil
                    </button>
                </div>
            </div>

            {{-- Form Edit Profil --}}
            <div class="md:col-span-2">
                <div class="bg-white rounded-2xl border border-[#f0ddd8] p-6">
                    <h3 class="font-display text-xl font-bold mb-4 flex items-center gap-2">
                        <i class="fa-regular fa-address-card text-[#a03d32]"></i> Informasi Pribadi
                    </h3>
                    <form id="profileForm">
                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" id="editNamaLengkap" class="w-full border border-[#f0ddd8] rounded-xl px-3 py-2 focus:border-[#a03d32] outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
                                <input type="text" id="editUsername" class="w-full border border-[#f0ddd8] rounded-xl px-3 py-2 focus:border-[#a03d32] outline-none">
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                                <input type="email" id="editEmail" class="w-full border border-[#f0ddd8] rounded-xl px-3 py-2 focus:border-[#a03d32] outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">No. HP</label>
                                <input type="text" id="editNoHp" class="w-full border border-[#f0ddd8] rounded-xl px-3 py-2 focus:border-[#a03d32] outline-none">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Password Baru (kosongkan jika tidak diubah)</label>
                            <input type="password" id="editPassword" class="w-full border border-[#f0ddd8] rounded-xl px-3 py-2 focus:border-[#a03d32] outline-none" placeholder="Minimal 6 karakter">
                        </div>
                        <button type="submit" class="px-5 py-2 bg-[#a03d32] text-white rounded-xl text-sm font-semibold hover:opacity-90">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Tab Riwayat Pesanan --}}
    <div id="tabOrders" class="tab-content" style="display: none;">
        <div class="bg-white rounded-2xl border border-[#f0ddd8] p-6">
            <h3 class="font-display text-xl font-bold mb-4 flex items-center gap-2">
                <i class="fa-regular fa-receipt text-[#a03d32]"></i> Riwayat Pemesanan
            </h3>
            <div id="orderHistory" class="space-y-4">
                {{-- JS akan render di sini --}}
            </div>
        </div>
    </div>
</div>

{{-- Modal Rating --}}
<div id="ratingModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-display text-xl font-bold">Beri Rating & Ulasan</h3>
            <button onclick="closeRatingModal()" class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark text-xl"></i></button>
        </div>
        <p class="text-sm text-gray-500 mb-4" id="ratingWoName"></p>
        <form id="ratingForm">
            <input type="hidden" id="ratingOrderId">
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2">Rating Anda</label>
                <div class="flex gap-2 text-3xl" id="ratingStars">
                    <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400 transition" data-rating="1"></i>
                    <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400 transition" data-rating="2"></i>
                    <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400 transition" data-rating="3"></i>
                    <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400 transition" data-rating="4"></i>
                    <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400 transition" data-rating="5"></i>
                </div>
                <input type="hidden" id="ratingValue" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2">Komentar</label>
                <textarea id="komentarUlasan" rows="3" class="w-full border border-[#f0ddd8] rounded-xl px-3 py-2 focus:border-[#a03d32] outline-none" placeholder="Ceritakan pengalaman Anda menggunakan jasa WO ini..."></textarea>
            </div>
            <button type="submit" class="w-full py-2.5 bg-[#a03d32] text-white rounded-xl font-semibold hover:opacity-90">Kirim Ulasan</button>
        </form>
    </div>
</div>

<script>
    // Current user session
    let currentUser = null;
    let selectedRating = 0;

    // Load user session
    function loadUserSession() {
        let session = localStorage.getItem('userSession') || sessionStorage.getItem('userSession');
        if(session) {
            currentUser = JSON.parse(session);
            updateProfileUI();
        } else {
            // Redirect ke login jika belum login
            window.location.href = '/login';
        }
    }

    // Update UI dengan data user
    function updateProfileUI() {
        if(!currentUser) return;

        document.getElementById('userName').innerText = currentUser.nama_lengkap || currentUser.name || 'User';
        document.getElementById('userRole').innerHTML = currentUser.role === 'wo' ? '<i class="fa-solid fa-briefcase"></i> Wedding Organizer' : '<i class="fa-regular fa-heart"></i> Mempelai';
        document.getElementById('userJoined').innerText = new Date().getFullYear();

        document.getElementById('profileName').innerText = currentUser.nama_lengkap || currentUser.name;
        document.getElementById('profileUsername').innerText = '@' + (currentUser.username || 'user');
        document.getElementById('profileEmail').innerText = currentUser.email;
        document.getElementById('profilePhone').innerText = currentUser.no_hp || '-';
        document.getElementById('profileRole').innerHTML = currentUser.role === 'wo' ? 'Wedding Organizer' : 'Customer (Mempelai)';

        // Set form edit
        document.getElementById('editNamaLengkap').value = currentUser.nama_lengkap || '';
        document.getElementById('editUsername').value = currentUser.username || '';
        document.getElementById('editEmail').value = currentUser.email || '';
        document.getElementById('editNoHp').value = currentUser.no_hp || '';
    }

    // Load orders
    function loadOrders() {
        let orders = JSON.parse(localStorage.getItem('userOrders') || '[]');
        let userOrders = orders.filter(o => o.email === currentUser?.email);

        const container = document.getElementById('orderHistory');
        if(userOrders.length === 0) {
            container.innerHTML = '<div class="text-center py-12 text-gray-400"><i class="fa-regular fa-face-frown text-4xl mb-2"></i><p>Belum ada pemesanan</p><a href="/daftar-wo" class="inline-block mt-3 text-[#a03d32] text-sm font-semibold">Cari WO sekarang →</a></div>';
            return;
        }

        container.innerHTML = userOrders.map(order => {
            // Cek apakah sudah pernah memberi rating
            let ratings = JSON.parse(localStorage.getItem('userRatings') || '[]');
            let hasRated = ratings.some(r => r.orderId === order.id);

            return `
            <div class="border rounded-xl p-4 hover:shadow-md transition">
                <div class="flex flex-wrap justify-between items-start gap-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            <p class="font-bold text-gray-900">${order.layanan}</p>
                            <span class="text-gray-400 text-xs">•</span>
                            <p class="text-sm text-gray-600">${order.wo}</p>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-2 text-sm">
                            <p class="text-gray-500"><i class="fa-regular fa-calendar mr-1"></i> Tanggal Acara: ${order.tglAcara}</p>
                            <p class="text-gray-500"><i class="fa-solid fa-location-dot mr-1"></i> Lokasi: ${order.lokasi}</p>
                        </div>
                        ${order.catatan ? `<p class="text-xs text-gray-400 mt-1"><i class="fa-regular fa-note-sticky mr-1"></i> Catatan: ${order.catatan}</p>` : ''}
                    </div>
                    <div class="text-right">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold status-badge status-${order.status}">
                            ${order.status === 'menunggu' ? '⏳ Menunggu Konfirmasi' : (order.status === 'proses' ? '🔄 Diproses' : '✅ Selesai')}
                        </span>
                        <p class="font-bold text-[#a03d32] mt-2">Rp ${parseInt(order.harga).toLocaleString()}</p>
                        <p class="text-xs text-gray-400">Order ID: #${order.id}</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2 mt-4 pt-3 border-t border-[#f0ddd8]">
                    <button onclick="downloadInvoice(${order.id})" class="px-3 py-1.5 bg-gray-100 rounded-lg text-sm hover:bg-gray-200 transition">
                        <i class="fa-solid fa-download"></i> Download Invoice
                    </button>
                    <button onclick="confirmWA(${order.id})" class="px-3 py-1.5 bg-[#25D366] text-white rounded-lg text-sm hover:opacity-90 transition">
                        <i class="fa-brands fa-whatsapp"></i> Konfirmasi via WA
                    </button>
                    ${order.status === 'selesai' && !hasRated ? `
                    <button onclick="openRatingModal(${order.id}, '${order.wo}')" class="px-3 py-1.5 bg-[#a03d32] text-white rounded-lg text-sm hover:opacity-90 transition">
                        <i class="fa-regular fa-star"></i> Beri Rating & Ulasan
                    </button>
                    ` : ''}
                    ${hasRated ? `
                    <span class="px-3 py-1.5 bg-green-100 text-green-700 rounded-lg text-sm">
                        <i class="fa-regular fa-circle-check"></i> Sudah memberi ulasan
                    </span>
                    ` : ''}
                </div>
            </div>
        `}).join('');

        // Update styling status badge
        document.querySelectorAll('.status-badge').forEach(badge => {
            if(badge.classList.contains('status-menunggu')) {
                badge.classList.add('bg-yellow-100', 'text-yellow-700');
            } else if(badge.classList.contains('status-proses')) {
                badge.classList.add('bg-blue-100', 'text-blue-700');
            } else if(badge.classList.contains('status-selesai')) {
                badge.classList.add('bg-green-100', 'text-green-700');
            }
        });
    }

    // Download invoice
    function downloadInvoice(orderId) {
        let orders = JSON.parse(localStorage.getItem('userOrders') || '[]');
        let order = orders.find(o => o.id == orderId);
        if(!order) return;

        let invoiceHtml = `
            <!DOCTYPE html>
            <html>
            <head>
                <title>Invoice #${order.id}</title>
                <style>
                    body { font-family: 'Segoe UI', sans-serif; padding: 40px; max-width: 800px; margin: 0 auto; }
                    .header { text-align: center; margin-bottom: 30px; }
                    .logo { font-size: 40px; }
                    .title { color: #a03d32; }
                    .info { margin: 20px 0; padding: 15px; background: #fce8e8; border-radius: 12px; }
                    table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                    th, td { padding: 12px; text-align: left; border-bottom: 1px solid #f0ddd8; }
                    .total { font-size: 18px; font-weight: bold; text-align: right; margin-top: 20px; }
                    .footer { text-align: center; margin-top: 40px; color: #999; font-size: 12px; }
                </style>
            </head>
            <body>
                <div class="header">
                    <div class="logo">❤️</div>
                    <h1>INVOICE PEMESANAN</h1>
                    <p class="title">PaluWedding</p>
                </div>
                <div class="info">
                    <p><strong>Order ID:</strong> #${order.id}</p>
                    <p><strong>Tanggal Order:</strong> ${order.tanggalOrder}</p>
                    <p><strong>Status:</strong> ${order.status === 'menunggu' ? 'Menunggu Konfirmasi' : (order.status === 'proses' ? 'Diproses' : 'Selesai')}</p>
                </div>
                <table>
                    <tr><th>Wedding Organizer</th><td>${order.wo}</td></tr>
                    <tr><th>Paket Layanan</th><td>${order.layanan}</td></tr>
                    <tr><th>Tanggal Acara</th><td>${order.tglAcara}</td></tr>
                    <tr><th>Lokasi Acara</th><td>${order.lokasi}</td></tr>
                    <tr><th>Nama Customer</th><td>${order.nama}</td></tr>
                    <tr><th>No. HP</th><td>${order.hp}</td></tr>
                </table>
                <div class="total">
                    <p>Total Pembayaran: <span style="color:#a03d32">Rp ${parseInt(order.harga).toLocaleString()}</span></p>
                </div>
                <div class="footer">
                    <p>Terima kasih telah mempercayakan hari spesial Anda kepada kami.</p>
                    <p>❤️ PaluWedding - Wedding Organizer Hub</p>
                </div>
            </body>
            </html>
        `;

        let blob = new Blob([invoiceHtml], {type: 'text/html'});
        let a = document.createElement('a');
        a.href = URL.createObjectURL(blob);
        a.download = `invoice_${order.id}.html`;
        a.click();
    }

    // Confirm via WhatsApp
    function confirmWA(orderId) {
        let orders = JSON.parse(localStorage.getItem('userOrders') || '[]');
        let order = orders.find(o => o.id == orderId);
        if(order) {
            let msg = `Halo%20${encodeURIComponent(order.wo)}%2C%20saya%20ingin%20mengkonfirmasi%20pemesanan%20dengan%20detail%3A%0A- Order ID%3A%20${order.id}%0A- Layanan%3A%20${order.layanan}%0A- Tanggal Acara%3A%20${order.tglAcara}%0A- Lokasi%3A%20${order.lokasi}%0A%0ATerima%20kasih.`;
            window.open(`https://wa.me/${order.hp || '6281234567890'}?text=${msg}`, '_blank');
        }
    }

    // Edit profile form
    document.getElementById('profileForm')?.addEventListener('submit', function(e) {
        e.preventDefault();

        let updatedUser = {
            ...currentUser,
            nama_lengkap: document.getElementById('editNamaLengkap').value,
            username: document.getElementById('editUsername').value,
            email: document.getElementById('editEmail').value,
            no_hp: document.getElementById('editNoHp').value
        };

        let newPassword = document.getElementById('editPassword').value;
        if(newPassword && newPassword.length >= 6) {
            updatedUser.password = newPassword;
        }

        // Update session
        if(localStorage.getItem('userSession')) {
            localStorage.setItem('userSession', JSON.stringify(updatedUser));
        } else {
            sessionStorage.setItem('userSession', JSON.stringify(updatedUser));
        }

        // Update users list
        let users = JSON.parse(localStorage.getItem('users') || '[]');
        let userIndex = users.findIndex(u => u.email === currentUser.email);
        if(userIndex !== -1) {
            users[userIndex] = {...users[userIndex], ...updatedUser};
            localStorage.setItem('users', JSON.stringify(users));
        }

        currentUser = updatedUser;
        updateProfileUI();
        alert('✅ Profil berhasil diperbarui!');
    });

    // Rating stars
    function initRatingStars() {
        document.querySelectorAll('#ratingStars i').forEach(star => {
            star.addEventListener('mouseover', function() {
                let rating = parseInt(this.dataset.rating);
                document.querySelectorAll('#ratingStars i').forEach((s, idx) => {
                    s.className = idx < rating ? 'fa-solid fa-star cursor-pointer text-yellow-400' : 'fa-regular fa-star cursor-pointer';
                });
            });
            star.addEventListener('mouseout', function() {
                document.querySelectorAll('#ratingStars i').forEach((s, idx) => {
                    s.className = idx < selectedRating ? 'fa-solid fa-star cursor-pointer text-yellow-400' : 'fa-regular fa-star cursor-pointer';
                });
            });
            star.addEventListener('click', function() {
                selectedRating = parseInt(this.dataset.rating);
                document.getElementById('ratingValue').value = selectedRating;
            });
        });
    }

    // Open rating modal
    function openRatingModal(orderId, woName) {
        selectedRating = 0;
        document.getElementById('ratingOrderId').value = orderId;
        document.getElementById('ratingWoName').innerText = `Berikan rating untuk ${woName}`;
        document.getElementById('ratingValue').value = '';
        document.getElementById('komentarUlasan').value = '';
        document.querySelectorAll('#ratingStars i').forEach(s => s.className = 'fa-regular fa-star cursor-pointer');
        document.getElementById('ratingModal').classList.add('flex');
        document.getElementById('ratingModal').classList.remove('hidden');
        initRatingStars();
    }

    function closeRatingModal() {
        document.getElementById('ratingModal').classList.add('hidden');
        document.getElementById('ratingModal').classList.remove('flex');
    }

    // Submit rating
    document.getElementById('ratingForm')?.addEventListener('submit', function(e) {
        e.preventDefault();

        if(selectedRating === 0) {
            alert('Silakan pilih rating terlebih dahulu!');
            return;
        }

        let komentar = document.getElementById('komentarUlasan').value;
        if(!komentar.trim()) {
            alert('Silakan isi komentar!');
            return;
        }

        let orderId = parseInt(document.getElementById('ratingOrderId').value);
        let orders = JSON.parse(localStorage.getItem('userOrders') || '[]');
        let order = orders.find(o => o.id === orderId);

        let ratings = JSON.parse(localStorage.getItem('userRatings') || '[]');
        ratings.push({
            id: Date.now(),
            orderId: orderId,
            woId: order.wo_id,
            woName: order.wo,
            rating: selectedRating,
            komentar: komentar,
            userEmail: currentUser.email,
            userName: currentUser.nama_lengkap,
            tanggal: new Date().toISOString().split('T')[0]
        });

        localStorage.setItem('userRatings', JSON.stringify(ratings));
        alert('✅ Terima kasih atas rating dan ulasannya!');
        closeRatingModal();
        loadOrders(); // Refresh daftar pesanan
    });

    // Tab switching
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const tab = btn.dataset.tab;

            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.remove('text-[#a03d32]', 'border-b-2', 'border-[#a03d32]');
                b.classList.add('text-gray-500');
            });
            btn.classList.remove('text-gray-500');
            btn.classList.add('text-[#a03d32]', 'border-b-2', 'border-[#a03d32]');

            document.querySelectorAll('.tab-content').forEach(content => {
                content.style.display = 'none';
            });

            if(tab === 'profile') {
                document.getElementById('tabProfile').style.display = 'block';
            } else {
                document.getElementById('tabOrders').style.display = 'block';
                loadOrders();
            }
        });
    });

    // Edit profile button
    document.getElementById('editProfileBtn')?.addEventListener('click', () => {
        document.getElementById('tabProfile').scrollIntoView({ behavior: 'smooth' });
    });

    // Initialize
    loadUserSession();
    loadOrders();
</script>

<style>
    .tab-btn {
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
</style>
@endsection
