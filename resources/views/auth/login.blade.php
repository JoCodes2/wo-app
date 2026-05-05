@extends('layouts-ui.base')

@section('content')
<div class="min-h-screen bg-[#fdf8f5] flex items-center justify-center py-10">
    <div class="max-w-md w-full mx-4">
        <div class="bg-white rounded-2xl border border-[#f0ddd8] overflow-hidden shadow-lg animate-fade-up">
            <div class="bg-gradient-to-r from-[#a03d32] to-[#c95a4a] p-6 text-center">
                <div class="text-5xl mb-2">❤️</div>
                <h2 class="font-display text-2xl font-bold text-white">Selamat Datang</h2>
                <p class="text-white/80 text-sm mt-1">Masuk ke akun PaluWedding Anda</p>
            </div>

            <div class="p-6 md:p-8">
                <form id="loginForm">
                    @csrf
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-regular fa-envelope text-[#a03d32] mr-1"></i> Alamat Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-regular fa-envelope text-gray-400 text-sm"></i>
                            </div>
                            <input type="email" id="email" name="email"
                                   class="w-full border border-[#f0ddd8] rounded-xl pl-10 pr-10 py-3 focus:border-[#a03d32] focus:outline-none focus:ring-2 focus:ring-[#a03d32]/20 transition"
                                   placeholder="contoh@email.com">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-lock text-[#a03d32] mr-1"></i> Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-lock text-gray-400 text-sm"></i>
                            </div>
                            <input type="password" id="password" name="password"
                                   class="w-full border border-[#f0ddd8] rounded-xl pl-10 pr-12 py-3 focus:border-[#a03d32] focus:outline-none focus:ring-2 focus:ring-[#a03d32]/20 transition"
                                   placeholder="Masukkan password">
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center z-10">
                                <i class="fa-regular fa-eye text-gray-400 hover:text-gray-600 transition"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" id="btnLogin" class="w-full py-3 bg-[#a03d32] text-white rounded-xl font-semibold hover:opacity-90 transition transform hover:scale-[1.01] active:scale-[0.98] shadow-md">
                        <i class="fa-solid fa-arrow-right-to-bracket mr-2"></i> Masuk
                    </button>
                </form>

                <p class="text-center text-sm mt-8 text-gray-500">
                    Belum punya akun?
                    <a href="/register" class="text-[#a03d32] font-semibold hover:underline">Daftar Sekarang</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="module" src="{{ asset('controllers/auth.controller.js') }}"></script>

<style>
    .animate-fade-up {
        animation: fadeInUp 0.5s ease-out;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
