<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-bold text-xl text-stone-900 leading-tight">
                    Dashboard {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Pelanggan' }}
                </h2>
                <p class="text-xs text-stone-500 mt-0.5">
                    Ringkasan akses cepat layanan pemesanan paket catering
                </p>
            </div>
            <span class="inline-flex items-center self-start sm:self-auto px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 border border-amber-200">
                Halo, {{ Auth::user()->name }}
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <!-- Hero Banner Selamat Datang -->
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-amber-600 via-amber-500 to-orange-600 p-6 sm:p-8 text-white shadow-lg shadow-amber-500/20">
                <div class="relative z-10 max-w-2xl">
                    <span class="inline-block px-3 py-1 rounded-full bg-white/20 backdrop-blur-xs text-xs font-semibold tracking-wide mb-3">
                        CateringKu &bull; Layanan Paket Acara
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-bold tracking-tight">
                        Selamat datang kembali, {{ Auth::user()->name }}!
                    </h3>
                    <p class="mt-2 text-sm sm:text-base text-amber-50 leading-relaxed">
                        @if(Auth::user()->role === 'admin')
                            Kelola kategori menu, atur kuota produksi harian paket catering, dan verifikasi pesanan pelanggan dari satu tempat.
                        @else
                            Rencanakan hidangan terbaik untuk acara Anda. Pilih paket catering sesuai kebutuhan dan pantau status verifikasi pesanan Anda secara langsung.
                        @endif
                    </p>

                    <div class="mt-6 flex flex-wrap gap-3">
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white text-amber-700 font-semibold text-sm shadow-sm hover:bg-amber-50 transition">
                                Kelola Pesanan Masuk
                            </a>
                            <a href="{{ route('admin.packages.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-amber-700/40 border border-white/30 text-white font-semibold text-sm hover:bg-amber-700/60 transition">
                                Atur Paket Catering
                            </a>
                        @else
                            <a href="{{ route('user.catalog.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white text-amber-700 font-semibold text-sm shadow-sm hover:bg-amber-50 transition">
                                Jelajahi Katalog Paket
                            </a>
                            <a href="{{ route('user.orders.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-amber-700/40 border border-white/30 text-white font-semibold text-sm hover:bg-amber-700/60 transition">
                                Lihat Pesanan Saya
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Aksen dekoratif -->
                <div class="hidden md:block absolute -right-10 -bottom-10 w-64 h-64 rounded-full bg-white/10 pointer-events-none"></div>
                <div class="hidden md:block absolute right-16 -top-12 w-40 h-40 rounded-full bg-orange-400/25 pointer-events-none"></div>
            </div>

            <!-- Kartu Informasi & Pintasan Cepat -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-white rounded-2xl border border-stone-200/80 p-6 shadow-xs">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-stone-900">Pemesanan Minimal H-2</h4>
                    <p class="mt-1.5 text-sm text-stone-500 leading-relaxed">
                        Pastikan tanggal acara dipilih minimal 2 hari sebelum pelaksanaan agar persiapan bahan baku tetap optimal.
                    </p>
                </div>

                <div class="bg-white rounded-2xl border border-stone-200/80 p-6 shadow-xs">
                    <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-700 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-stone-900">Kuota Harian &amp; MOQ</h4>
                    <p class="mt-1.5 text-sm text-stone-500 leading-relaxed">
                        Setiap paket memiliki batas minimal pemesanan (MOQ) dan kuota produksi harian untuk menjaga kualitas sajian.
                    </p>
                </div>

                <div class="bg-white rounded-2xl border border-stone-200/80 p-6 shadow-xs">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-stone-900">Verifikasi Transparan</h4>
                    <p class="mt-1.5 text-sm text-stone-500 leading-relaxed">
                        Status setiap transaksi diperbarui secara real-time setelah diverifikasi oleh tim admin CateringKu.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>