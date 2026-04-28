@extends('layouts-ui.base')

@section('content')
<div class="min-h-screen bg-[#fdf8f5] flex items-center justify-center py-10">
    <div class="max-w-md w-full mx-4">

        {{-- Card Login --}}
        <div class="bg-white rounded-2xl border border-[#f0ddd8] overflow-hidden shadow-lg">

            {{-- Header dengan Gradasi --}}
            <div class="bg-gradient-to-r from-[#a03d32] to-[#c95a4a] p-6 text-center">
                <div class="text-5xl mb-2">❤️</div>
                <h2 class="font-display text-2xl font-bold text-white">Selamat Datang</h2>
                <p class="text-white/80 text-sm mt-1">Masuk ke akun PaluWedding Anda</p>
            </div>

            {{-- Form --}}
            <div class="p-6 md:p-8">
                {{-- Alert Demo (opsional) --}}
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-3 mb-5 flex items-start gap-2">
                    <i class="fa-solid fa-circle-info text-blue-500 text-sm mt-0.5"></i>
                    <p class="text-xs text-blue-700">Demo: gunakan email <strong>user@example.com</strong> dan password <strong>123456</strong></p>
                </div>

                <form id="loginForm">
                    @csrf
                    {{-- Field Email --}}
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-regular fa-envelope text-[#a03d32] mr-1"></i> Alamat Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-regular fa-envelope text-gray-400 text-sm"></i>
                            </div>
                            <input type="email" id="email"
                                   class="w-full border border-[#f0ddd8] rounded-xl pl-10 pr-4 py-3 focus:border-[#a03d32] focus:outline-none focus:ring-2 focus:ring-[#a03d32]/20 transition"
                                   placeholder="contoh@email.com"
                                   value="user@example.com">
                        </div>
                    </div>

                    {{-- Field Password --}}
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-lock text-[#a03d32] mr-1"></i> Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-lock text-gray-400 text-sm"></i>
                            </div>
                            <input type="password" id="password"
                                   class="w-full border border-[#f0ddd8] rounded-xl pl-10 pr-12 py-3 focus:border-[#a03d32] focus:outline-none focus:ring-2 focus:ring-[#a03d32]/20 transition"
                                   placeholder="Masukkan password"
                                   value="123456">
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fa-regular fa-eye text-gray-400 hover:text-gray-600 transition"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Remember Me & Lupa Password --}}
                    <div class="flex justify-between items-center mb-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" id="remember" class="w-4 h-4 accent-[#a03d32] rounded">
                            <span class="text-sm text-gray-600">Ingat saya</span>
                        </label>
                        <a href="#" class="text-sm text-[#a03d32] hover:underline">Lupa password?</a>
                    </div>

                    {{-- Tombol Login --}}
                    <button type="submit" class="w-full py-3 bg-[#a03d32] text-white rounded-xl font-semibold hover:opacity-90 transition transform hover:scale-[1.02] active:scale-[0.98] shadow-md">
                        <i class="fa-solid fa-arrow-right-to-bracket mr-2"></i> Masuk
                    </button>
                </form>

                {{-- Separator --}}
                <div class="flex items-center gap-3 my-6">
                    <div class="flex-1 h-px bg-[#f0ddd8]"></div>
                    <span class="text-xs text-gray-400">atau</span>
                    <div class="flex-1 h-px bg-[#f0ddd8]"></div>
                </div>

                {{-- Tombol Demo --}}
                <button type="button" id="demoUserBtn" class="w-full py-2.5 border border-[#f0ddd8] rounded-xl font-semibold text-gray-600 hover:bg-gray-50 transition flex items-center justify-center gap-2">
                    <i class="fa-regular fa-user"></i> Login sebagai Mempelai (Demo)
                </button>
                <button type="button" id="demoWoBtn" class="w-full mt-2 py-2.5 border border-[#f0ddd8] rounded-xl font-semibold text-gray-600 hover:bg-gray-50 transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-briefcase"></i> Login sebagai WO (Demo)
                </button>

                {{-- Link Register --}}
                <p class="text-center text-sm mt-6 text-gray-500">
                    Belum punya akun?
                    <a href="/register" class="text-[#a03d32] font-semibold hover:underline">Daftar Sekarang</a>
                </p>
            </div>
        </div>

        {{-- Footer Card --}}
        <div class="text-center mt-6">
            <p class="text-xs text-gray-400">
                <i class="fa-regular fa-heart"></i> Bergabunglah dengan ribuan pasangan bahagia di Palu
            </p>
        </div>
    </div>
</div>

<script>
    // Toggle Password Visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword?.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    // Demo data users (sinkron dengan register)
    const demoUsers = [
        { email: 'user@example.com', password: '123456', role: 'user', name: 'Budi Santoso' },
        { email: 'wo@example.com', password: '123456', role: 'wo', name: 'Elegan Bridal Palu' }
    ];

    // Fungsi login
    function doLogin(email, password) {
        // Ambil data dari localStorage (hasil register)
        let registeredUsers = JSON.parse(localStorage.getItem('users') || '[]');

        // Cek di registered users dulu
        let user = registeredUsers.find(u => u.email === email && u.password === password);

        // Jika tidak ditemukan, cek demo users
        if(!user) {
            user = demoUsers.find(u => u.email === email && u.password === password);
        }

        if(user) {
            // Simpan session login
            const loggedInUser = {
                id: Date.now(),
                email: user.email,
                nama_lengkap: user.nama_lengkap || user.name,
                role: user.role,
                isLoggedIn: true
            };

            // Jika remember me dicentang, simpan ke localStorage
            if(document.getElementById('remember')?.checked) {
                localStorage.setItem('userSession', JSON.stringify(loggedInUser));
            } else {
                sessionStorage.setItem('userSession', JSON.stringify(loggedInUser));
            }

            // Tampilkan alert sukses
            alert(`✅ Selamat datang kembali, ${loggedInUser.nama_lengkap}!`);

            // Redirect berdasarkan role
            if(user.role === 'wo') {
                window.location.href = '/dashboard-wo';
            } else {
                window.location.href = '/';
            }
        } else {
            alert('❌ Email atau password salah! Silakan coba lagi atau daftar terlebih dahulu.');
        }
    }

    // Form submit
    document.getElementById('loginForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;

        if(!email) {
            alert('❌ Email wajib diisi!');
            return;
        }
        if(!password) {
            alert('❌ Password wajib diisi!');
            return;
        }

        doLogin(email, password);
    });

    // Demo User (Mempelai)
    document.getElementById('demoUserBtn')?.addEventListener('click', function() {
        document.getElementById('email').value = 'user@example.com';
        document.getElementById('password').value = '123456';
        doLogin('user@example.com', '123456');
    });

    // Demo WO
    document.getElementById('demoWoBtn')?.addEventListener('click', function() {
        document.getElementById('email').value = 'wo@example.com';
        document.getElementById('password').value = '123456';
        doLogin('wo@example.com', '123456');
    });

    // Enter key submit
    document.getElementById('password')?.addEventListener('keypress', function(e) {
        if(e.key === 'Enter') {
            document.getElementById('loginForm').dispatchEvent(new Event('submit'));
        }
    });
</script>

<style>
    /* Animasi fade in */
    .bg-white {
        animation: fadeInUp 0.5s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Hover effect pada tombol demo */
    #demoUserBtn:hover, #demoWoBtn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
</style>
@endsection
