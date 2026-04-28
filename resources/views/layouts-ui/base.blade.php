<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PaluWedding — Wedding Organizer Hub</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/assets/logo-wo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
    let appUrl = '{{ env('APP_URL') }}';
</script>
  @include('layouts-ui.style')
</head>
<body class="antialiased text-gray-800">

@include('layouts-ui.navbar')

<main class="max-w-content ">
    @yield('content')
</main>

<footer class="bg-white border-t border-rose-100 py-8">
<div class="max-w-7xl mx-auto px-4 sm:px-6 flex flex-col sm:flex-row items-center justify-between gap-3">
    <div class="flex items-center gap-2 text-sm text-gray-600">
    <span class="text-[#a03d32]">♥</span>
    <span class="font-semibold font-display">
        <span class="text-gray-900">Palu</span><span class="text-[#a03d32]">Wedding</span>
    </span>
    <span class="text-gray-400">— Temukan Wedding Organizer terbaik di Kota Palu.</span>
    </div>
    <p class="text-xs text-gray-400">© 2026 PaluWedding. Semua hak dilindungi.</p>
</div>
</footer>

@include('layouts-ui.script')
@yield('scripts')
</body>
</html>
