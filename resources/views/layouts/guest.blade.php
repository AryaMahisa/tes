<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Absensi') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="relative flex min-h-screen flex-col items-center justify-center overflow-hidden bg-slate-50 px-4 py-10 sm:px-6">

        <!-- Aksen dekoratif -->
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -top-32 -left-24 h-72 w-72 rounded-full bg-teal-100/60 blur-3xl"></div>
            <div class="absolute -bottom-32 -right-24 h-72 w-72 rounded-full bg-teal-50 blur-3xl"></div>
        </div>

        <!-- Logo & nama aplikasi -->
        <a href="{{ route('login') }}" class="relative z-10 mb-8 flex items-center gap-2.5">
            <img src="{{ asset('bendera.png') }}" alt="Logo" class="h-11 w-11 rounded-xl object-contain">
            <span class="text-xl font-semibold text-slate-800">Absensi<span class="text-teal-700">Ku</span></span>
        </a>

        <!-- Kartu form -->
        <div class="relative z-10 w-full max-w-md rounded-2xl border border-slate-200 bg-white px-6 py-8 shadow-lg shadow-slate-200/60 sm:px-8">
            {{ $slot }}
        </div>

        <p class="relative z-10 mt-8 text-xs text-slate-400">
            &copy; {{ date('Y') }} AbsensiKu. Sistem absensi pegawai.
        </p>
    </div>
</body>
</html>
