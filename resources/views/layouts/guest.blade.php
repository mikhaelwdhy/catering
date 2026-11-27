<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CateringKu') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-['Plus_Jakarta_Sans',sans-serif] text-stone-800 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center px-4 py-8 bg-gradient-to-br from-amber-50 via-stone-50 to-orange-50 relative overflow-hidden">
            <!-- Dekorasi latar lembut -->
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-amber-200/30 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-orange-200/30 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col items-center text-center">
                <a href="/" class="inline-flex items-center gap-3 group">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-500 to-orange-600 text-white flex items-center justify-center shadow-md shadow-amber-500/25 group-hover:scale-105 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 15h18M5 15a7 7 0 0114 0M12 5v3m-2 0h4M4 19h16" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <span class="block text-2xl font-bold tracking-tight text-stone-900">Catering<span class="text-amber-600">Ku</span></span>
                        <span class="block text-xs font-medium text-stone-500">Sistem Pemesanan Paket Acara</span>
                    </div>
                </a>
            </div>

            <div class="relative z-10 w-full sm:max-w-md mt-6 px-7 py-6 bg-white/95 backdrop-blur-sm border border-amber-100 shadow-xl shadow-stone-200/60 overflow-hidden rounded-2xl">
                {{ $slot }}
            </div>

            <div class="relative z-10 mt-6 text-xs text-stone-500">
                <a href="/" class="hover:text-amber-700 font-medium transition">&larr; Kembali ke Halaman Utama</a>
            </div>
        </div>
    </body>
</html>