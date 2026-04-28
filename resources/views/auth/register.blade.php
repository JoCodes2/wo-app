@extends('layouts-ui.base')

@section('content')
<div class="min-h-screen bg-[#fdf8f5] py-10">
    <div class="max-w-3xl mx-auto px-4">
        <div class="bg-white rounded-2xl border border-[#f0ddd8] p-6 md:p-8">

            {{-- Header --}}
            <div class="text-center mb-6">
                <div class="text-4xl mb-2">❤️</div>
                <h2 class="font-display text-2xl md:text-3xl font-bold text-gray-900">Daftar Akun</h2>
                <p class="text-gray-500 text-sm mt-1">Gabung dan mulai rencanakan hari spesial Anda</p>
            </div>

            {{-- Progress Step --}}
            <div class="flex items-center justify-center gap-2 mb-8">
                <div class="w-3 h-3 rounded-full bg-[#a03d32]"></div>
                <div class="w-16 h-0.5 bg-gray-200"></div>
                <div class="w-3 h-3 rounded-full bg-gray-200" id="stepDot"></div>
            </div>

            <form id="registerForm">
                @csrf
                {{-- Step 1: Informasi Dasar --}}
                <div id="step1">
                    <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-user text-[#a03d32]"></i> Informasi Dasar
                    </h3>

                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                <i class="fa-regular fa-user text-[#a03d32] mr-1"></i> Nama Lengkap
                            </label>
                            <input type="text" id="nama_lengkap" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:border-[#a03d32] focus:outline-none transition" placeholder="Contoh: Ahmad Santoso" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                <i class="fa-regular fa-circle-user text-[#a03d32] mr-1"></i> Username
                            </label>
                            <input type="text" id="username" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:border-[#a03d32] focus:outline-none transition" placeholder="Contoh: ahmadsantoso" required>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                <i class="fa-regular fa-envelope text-[#a03d32] mr-1"></i> Email
                            </label>
                            <input type="email" id="email" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:border-[#a03d32] focus:outline-none transition" placeholder="contoh@email.com" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                <i class="fa-solid fa-phone text-[#a03d32] mr-1"></i> No. HP
                            </label>
                            <input type="tel" id="no_hp" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:border-[#a03d32] focus:outline-none transition" placeholder="081234567890" required>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                <i class="fa-solid fa-lock text-[#a03d32] mr-1"></i> Password
                            </label>
                            <input type="password" id="password" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:border-[#a03d32] focus:outline-none transition" placeholder="Minimal 6 karakter" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                <i class="fa-solid fa-lock text-[#a03d32] mr-1"></i> Konfirmasi Password
                            </label>
                            <input type="password" id="password_confirmation" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:border-[#a03d32] focus:outline-none transition" placeholder="Ulangi password" required>
                        </div>
                    </div>
                </div>

                {{-- Step 2: Pilih Role --}}
                <div id="step2" style="display: none;">
                    <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-users text-[#a03d32]"></i> Pilih Tipe Akun
                    </h3>

                    <div class="grid md:grid-cols-2 gap-4 mb-6">
                        <label class="border-2 rounded-xl p-4 cursor-pointer transition role-card" data-role="user">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-[#fce8e8] rounded-full flex items-center justify-center">
                                    <i class="fa-regular fa-heart text-xl text-[#a03d32]"></i>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <input type="radio" name="role" value="user" class="w-4 h-4 accent-[#a03d32]">
                                        <span class="font-semibold text-gray-900">Mempelai / Customer</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Cari dan pesan Wedding Organizer</p>
                                </div>
                            </div>
                        </label>

                        <label class="border-2 rounded-xl p-4 cursor-pointer transition role-card" data-role="wo">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-[#fce8e8] rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-briefcase text-xl text-[#a03d32]"></i>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <input type="radio" name="role" value="wo" class="w-4 h-4 accent-[#a03d32]">
                                        <span class="font-semibold text-gray-900">Wedding Organizer</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Daftarkan usaha WO Anda</p>
                                </div>
                            </div>
                        </label>
                    </div>

                    {{-- Form Tambahan untuk WO --}}
                    <div id="woForm" style="display: none;">
                        <div class="border-t border-[#f0ddd8] pt-5 mt-2">
                            <h4 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fa-solid fa-store text-[#a03d32]"></i> Data Wedding Organizer
                            </h4>

                            <div class="grid md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                                        <i class="fa-regular fa-building text-[#a03d32] mr-1"></i> Nama WO
                                    </label>
                                    <input type="text" id="nama_wo" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:border-[#a03d32] focus:outline-none transition" placeholder="Contoh: Elegan Bridal Palu">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                                        <i class="fa-solid fa-phone-alt text-[#a03d32] mr-1"></i> Kontak WO
                                    </label>
                                    <input type="text" id="kontak_wo" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:border-[#a03d32] focus:outline-none transition" placeholder="Nomor WhatsApp aktif">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">
                                    <i class="fa-solid fa-location-dot text-[#a03d32] mr-1"></i> Alamat WO
                                </label>
                                <textarea id="alamat_wo" rows="2" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:border-[#a03d32] focus:outline-none transition" placeholder="Alamat lengkap tempat usaha WO"></textarea>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                                        <i class="fa-regular fa-address-card text-[#a03d32] mr-1"></i> Biodata Pengelola
                                    </label>
                                    <textarea id="biodata_pengelola" rows="2" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:border-[#a03d32] focus:outline-none transition" placeholder="Pengalaman, latar belakang, dll"></textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                                        <i class="fa-regular fa-file-lines text-[#a03d32] mr-1"></i> Deskripsi WO
                                    </label>
                                    <textarea id="deskripsi_wo" rows="2" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:border-[#a03d32] focus:outline-none transition" placeholder="Deskripsi singkat tentang WO Anda"></textarea>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">
                                    <i class="fa-brands fa-instagram text-[#a03d32] mr-1"></i> Sosial Media (Opsional)
                                </label>
                                <input type="text" id="sosial_media" class="w-full border border-[#f0ddd8] rounded-xl px-4 py-2.5 focus:border-[#a03d32] focus:outline-none transition" placeholder="Instagram: @nama_wo">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Navigasi --}}
                <div class="flex justify-between gap-3 mt-6">
                    <button type="button" id="prevBtn" class="px-6 py-2.5 border border-[#f0ddd8] text-gray-600 rounded-xl font-semibold hover:bg-gray-50 transition" style="display: none;">
                        <i class="fa-solid fa-chevron-left text-xs mr-1"></i> Kembali
                    </button>
                    <button type="button" id="nextBtn" class="flex-1 px-6 py-2.5 bg-[#a03d32] text-white rounded-xl font-semibold hover:opacity-90 transition">
                        Selanjutnya <i class="fa-solid fa-chevron-right text-xs ml-1"></i>
                    </button>
                    <button type="submit" id="submitBtn" class="flex-1 px-6 py-2.5 bg-[#a03d32] text-white rounded-xl font-semibold hover:opacity-90 transition" style="display: none;">
                        <i class="fa-regular fa-circle-check mr-1"></i> Daftar Sekarang
                    </button>
                </div>
            </form>

            <p class="text-center text-sm mt-6 text-gray-500">
                Sudah punya akun? <a href="/login" class="text-[#a03d32] font-semibold hover:underline">Masuk</a>
            </p>
        </div>
    </div>
</div>

<script>
    let currentStep = 1;
    const totalSteps = 2;
    let selectedRole = null;

    // Role card styling
    document.querySelectorAll('.role-card').forEach(card => {
        card.addEventListener('click', function() {
            const radio = this.querySelector('input[type="radio"]');
            radio.checked = true;
            selectedRole = radio.value;

            // Update styling
            document.querySelectorAll('.role-card').forEach(c => {
                c.classList.remove('border-[#a03d32]', 'bg-[#fce8e8]');
                c.classList.add('border-[#f0ddd8]');
            });
            this.classList.remove('border-[#f0ddd8]');
            this.classList.add('border-[#a03d32]', 'bg-[#fce8e8]');

            // Tampilkan/sembunyikan form WO
            const woForm = document.getElementById('woForm');
            if(radio.value === 'wo') {
                woForm.style.display = 'block';
            } else {
                woForm.style.display = 'none';
            }
        });
    });

    // Navigasi step
    function updateStep() {
        const step1 = document.getElementById('step1');
        const step2 = document.getElementById('step2');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');
        const stepDot = document.getElementById('stepDot');

        if(currentStep === 1) {
            step1.style.display = 'block';
            step2.style.display = 'none';
            prevBtn.style.display = 'none';
            nextBtn.style.display = 'flex';
            submitBtn.style.display = 'none';
            stepDot.classList.remove('bg-[#a03d32]');
            stepDot.classList.add('bg-gray-200');
        } else {
            step1.style.display = 'none';
            step2.style.display = 'block';
            prevBtn.style.display = 'flex';
            nextBtn.style.display = 'none';
            submitBtn.style.display = 'flex';
            stepDot.classList.remove('bg-gray-200');
            stepDot.classList.add('bg-[#a03d32]');
        }
    }

    document.getElementById('nextBtn').addEventListener('click', function() {
        // Validasi step 1
        const nama = document.getElementById('nama_lengkap').value.trim();
        const username = document.getElementById('username').value.trim();
        const email = document.getElementById('email').value.trim();
        const noHp = document.getElementById('no_hp').value.trim();
        const password = document.getElementById('password').value;
        const passwordConf = document.getElementById('password_confirmation').value;

        if(!nama) { alert('❌ Nama lengkap wajib diisi!'); return; }
        if(!username) { alert('❌ Username wajib diisi!'); return; }
        if(!email) { alert('❌ Email wajib diisi!'); return; }
        if(!/^\S+@\S+\.\S+$/.test(email)) { alert('❌ Format email tidak valid!'); return; }
        if(!noHp) { alert('❌ No. HP wajib diisi!'); return; }
        if(!password) { alert('❌ Password wajib diisi!'); return; }
        if(password.length < 6) { alert('❌ Password minimal 6 karakter!'); return; }
        if(password !== passwordConf) { alert('❌ Konfirmasi password tidak cocok!'); return; }

        currentStep = 2;
        updateStep();
    });

    document.getElementById('prevBtn').addEventListener('click', function() {
        currentStep = 1;
        updateStep();
    });

    // Submit form
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Validasi role dipilih
        const role = document.querySelector('input[name="role"]:checked');
        if(!role) {
            alert('❌ Silakan pilih tipe akun (Mempelai atau Wedding Organizer)!');
            return;
        }

        // Jika role WO, validasi form WO
        if(role.value === 'wo') {
            const namaWo = document.getElementById('nama_wo').value.trim();
            const kontakWo = document.getElementById('kontak_wo').value.trim();
            const alamatWo = document.getElementById('alamat_wo').value.trim();

            if(!namaWo) { alert('❌ Nama WO wajib diisi!'); return; }
            if(!kontakWo) { alert('❌ Kontak WO wajib diisi!'); return; }
            if(!alamatWo) { alert('❌ Alamat WO wajib diisi!'); return; }
        }

        // Simulasi simpan data
        const userData = {
            nama_lengkap: document.getElementById('nama_lengkap').value,
            username: document.getElementById('username').value,
            email: document.getElementById('email').value,
            no_hp: document.getElementById('no_hp').value,
            password: document.getElementById('password').value,
            role: role.value,
            status_akun: 'pending'
        };

        if(role.value === 'wo') {
            userData.profil_wo = {
                nama_wo: document.getElementById('nama_wo').value,
                kontak: document.getElementById('kontak_wo').value,
                alamat_wo: document.getElementById('alamat_wo').value,
                biodata_pengelola: document.getElementById('biodata_pengelola').value,
                deskripsi_wo: document.getElementById('deskripsi_wo').value,
                sosial_media: document.getElementById('sosial_media').value
            };
        }

        // Simpan ke localStorage untuk simulasi
        let users = JSON.parse(localStorage.getItem('users') || '[]');
        // Cek username atau email sudah terdaftar
        if(users.find(u => u.username === userData.username)) {
            alert('❌ Username sudah terdaftar!');
            return;
        }
        if(users.find(u => u.email === userData.email)) {
            alert('❌ Email sudah terdaftar!');
            return;
        }

        users.push(userData);
        localStorage.setItem('users', JSON.stringify(users));

        alert(`✅ Pendaftaran berhasil! Akun ${role.value === 'wo' ? 'WO' : 'Mempelai'} Anda dalam proses verifikasi. Silakan login.`);
        window.location.href = '/login';
    });
</script>

<style>
    .role-card {
        transition: all 0.2s ease;
    }
    .role-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(160, 61, 50, 0.1);
    }
</style>
@endsection
