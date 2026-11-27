<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'CateringKu') }} - Paket Catering &amp; Acara</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-['Plus_Jakarta_Sans',sans-serif] antialiased bg-stone-50 text-stone-800 selection:bg-amber-200 selection:text-amber-900">
        <!-- Navbar -->
        <header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-amber-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <a href="/" class="flex items-center gap-2.5 group">
                    <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 text-white flex items-center justify-center shadow-xs group-hover:scale-105 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 15h18M5 15a7 7 0 0114 0M12 5v3m-2 0h4M4 19h16" />
                        </svg>
                    </span>
                    <span class="font-bold text-xl tracking-tight text-stone-900">
                        Catering<span class="text-amber-600">Ku</span>
                    </span>
                </a>

                @if (Route::has('login'))
                    <nav class="flex items-center gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold shadow-xs transition">
                                Buka Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl text-sm font-semibold text-stone-700 hover:text-amber-700 hover:bg-amber-50 transition">
                                Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold shadow-sm shadow-amber-500/20 transition">
                                    Daftar Sekarang
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-gradient-to-br from-amber-50 via-stone-50 to-orange-50 border-b border-amber-100/80">
            <div class="absolute -top-24 right-0 w-96 h-96 bg-amber-200/30 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 left-0 w-96 h-96 bg-orange-200/30 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-100/80 border border-amber-200 text-amber-800 text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-amber-600"></span>
                        Pemesanan Paket Catering 
                    </div>

                    <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-stone-900 leading-tight">
                        Sajian Spesial untuk Setiap Momen <span class="text-amber-600">Acara Anda</span>
                    </h1>

                    <p class="text-base sm:text-lg text-stone-600 max-w-2xl leading-relaxed">
                        Pilih beragam paket snack, nasi kotak hingga prasmanan dengan pengaturan jumlah porsi fleksibel, transparansi kuota harian, dan konfirmasi pesanan yang cepat.
                    </p>

                    <div class="flex flex-wrap items-center gap-3 pt-2">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-6 py-3 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-semibold text-sm shadow-md shadow-amber-500/25 transition">
                                Masuk ke Dashboard &rarr;
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="px-6 py-3 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-semibold text-sm shadow-md shadow-amber-500/25 transition">
                                Mulai Pesan Paket &rarr;
                            </a>
                            <a href="{{ route('login') }}" class="px-6 py-3 rounded-xl bg-white hover:bg-stone-100 text-stone-800 border border-stone-200 font-semibold text-sm transition">
                                Sudah Punya Akun
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Kartu Highlight Menu -->
                <div class="lg:col-span-5">
                    <div class="bg-white rounded-3xl border border-amber-100 p-6 sm:p-7 shadow-xl shadow-stone-200/60 space-y-5">
                        <div class="flex items-center justify-between border-b border-stone-100 pb-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-amber-600">Pilihan Populer</p>
                                <h3 class="text-lg font-bold text-stone-900">Kategori Paket CateringKu</h3>
                            </div>
                            <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold">
                                Min. H-2
                            </span>
                        </div>

                        <div class="space-y-3">
                            <div class="p-4 rounded-2xl bg-stone-50 border border-stone-200/70 flex items-start justify-between gap-4">
                                <div>
                                    <h4 class="font-bold text-sm text-stone-900">Paket Prasmanan</h4>
                                    <p class="text-xs text-stone-500 mt-1">Cocok untuk pernikahan, syukuran, dan rapat besar.</p>
                                </div>
                                <span class="text-xs font-bold text-amber-700 bg-amber-100 px-2.5 py-1 rounded-lg shrink-0">Prasmanan</span>
                            </div>

                            <div class="p-4 rounded-2xl bg-stone-50 border border-stone-200/70 flex items-start justify-between gap-4">
                                <div>
                                    <h4 class="font-bold text-sm text-stone-900">Nasi Box Spesial</h4>
                                    <p class="text-xs text-stone-500 mt-1">Praktis untuk seminar, pelatihan, dan konsumsi harian.</p>
                                </div>
                                <span class="text-xs font-bold text-orange-700 bg-orange-100 px-2.5 py-1 rounded-lg shrink-0">Nasi Box</span>
                            </div>

                            <div class="p-4 rounded-2xl bg-stone-50 border border-stone-200/70 flex items-start justify-between gap-4">
                                <div>
                                    <h4 class="font-bold text-sm text-stone-900">Coffee Break &amp; Snack Box</h4>
                                    <p class="text-xs text-stone-500 mt-1">Aneka kue tradisional dan minuman pendamping acara.</p>
                                </div>
                                <span class="text-xs font-bold text-emerald-700 bg-emerald-100 px-2.5 py-1 rounded-lg shrink-0">Snack</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cara Pemesanan -->
        <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <h2 class="text-2xl sm:text-3xl font-bold text-stone-900">Alur Pemesanan Mudah</h2>
                <p class="mt-2 text-sm sm:text-base text-stone-500">Tiga langkah praktis untuk menyiapkan konsumsi acara Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl border border-stone-200/80 p-6 shadow-xs">
                    <span class="w-9 h-9 rounded-xl bg-amber-600 text-white font-bold text-sm flex items-center justify-center mb-4">1</span>
                    <h3 class="font-bold text-stone-900">Pilih Paket &amp; Kategori</h3>
                    <p class="mt-1.5 text-sm text-stone-500 leading-relaxed">
                        Telusuri katalog paket catering lengkap beserta rincian menu, harga per porsi, dan minimal pemesanan (MOQ).
                    </p>
                </div>

                <div class="bg-white rounded-2xl border border-stone-200/80 p-6 shadow-xs">
                    <span class="w-9 h-9 rounded-xl bg-amber-600 text-white font-bold text-sm flex items-center justify-center mb-4">2</span>
                    <h3 class="font-bold text-stone-900">Tentukan Tanggal Acara</h3>
                    <p class="mt-1.5 text-sm text-stone-500 leading-relaxed">
                        Masukkan jadwal acara (minimal H-2), jumlah porsi, dan alamat pengiriman sesuai ketersediaan kuota harian.
                    </p>
                </div>

                <div class="bg-white rounded-2xl border border-stone-200/80 p-6 shadow-xs">
                    <span class="w-9 h-9 rounded-xl bg-amber-600 text-white font-bold text-sm flex items-center justify-center mb-4">3</span>
                    <h3 class="font-bold text-stone-900">Verifikasi &amp; Siap Antar</h3>
                    <p class="mt-1.5 text-sm text-stone-500 leading-relaxed">
                        Pantau status pesanan Anda hingga disetujui oleh admin dan hidangan siap dikirim tepat waktu ke lokasi acara.
                    </p>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-white border-t border-stone-200/80 py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-stone-500">
                <span class="font-bold text-stone-800">Catering<span class="text-amber-600">Ku</span> &copy; {{ date('Y') }}</span>
                <span>Sistem Pemesanan Paket Catering &amp; Acara</span>
            </div>
        </footer>
    </body>
</html>