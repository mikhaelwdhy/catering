<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-bold text-xl text-stone-900 leading-tight">Dashboard Admin</h2>
                <p class="text-xs text-stone-500 mt-0.5">Ringkasan aktivitas pesanan, kuota produksi harian, dan pendapatan</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-3.5 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold shadow-xs transition">
                    Kelola Pesanan
                </a>
                <a href="{{ route('admin.packages.create') }}" class="inline-flex items-center px-3.5 py-2 rounded-xl bg-white border border-stone-300 text-stone-700 hover:bg-stone-50 text-xs font-semibold transition">
                    + Paket Baru
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <!-- Kartu Statistik Utama -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white p-5 rounded-2xl shadow-xs border border-stone-200/80">
                <p class="text-xs font-semibold uppercase tracking-wider text-stone-400">Total Pelanggan</p>
                <p class="text-3xl font-extrabold text-stone-900 mt-2">{{ $totalUsers }}</p>
                <p class="text-xs text-stone-500 mt-1">Akun pengguna terdaftar</p>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-xs border border-amber-200/80">
                <p class="text-xs font-semibold uppercase tracking-wider text-amber-600">Pesanan Pending</p>
                <p class="text-3xl font-extrabold text-amber-600 mt-2">{{ $pendingOrders }}</p>
                <p class="text-xs text-stone-500 mt-1">Menunggu verifikasi admin</p>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-xs border border-emerald-200/80">
                <p class="text-xs font-semibold uppercase tracking-wider text-emerald-600">Pesanan Selesai</p>
                <p class="text-3xl font-extrabold text-emerald-600 mt-2">{{ $completedOrders }}</p>
                <p class="text-xs text-stone-500 mt-1">Acara telah terlaksana</p>
            </div>

            <div class="bg-gradient-to-br from-amber-600 to-orange-600 p-5 rounded-2xl shadow-sm text-white">
                <p class="text-xs font-semibold uppercase tracking-wider text-amber-100">Total Pendapatan</p>
                <p class="text-2xl font-extrabold mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                <p class="text-xs text-amber-100 mt-1">Akumulasi transaksi terverifikasi</p>
            </div>
        </div>

        <!-- Panel Bawah: Kuota Menipis & Pesanan Terbaru -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-xs border border-stone-200/80">
                <div class="flex items-center justify-between pb-4 border-b border-stone-100">
                    <div>
                        <h3 class="font-bold text-base text-stone-900">Peringatan Kuota Produksi Menipis</h3>
                        <p class="text-xs text-stone-500">Paket dengan sisa kuota harian &le; 50 porsi</p>
                    </div>
                    <a href="{{ route('admin.packages.index') }}" class="text-xs font-semibold text-amber-700 hover:underline">
                        Atur Kuota &rarr;
                    </a>
                </div>

                <div class="divide-y divide-stone-100 mt-2">
                    @forelse($lowQuotaPackages as $pkg)
                        <div class="flex justify-between items-center py-3">
                            <div>
                                <p class="font-semibold text-sm text-stone-900">{{ $pkg->name }}</p>
                                <p class="text-xs text-stone-500">{{ $pkg->category->name }}</p>
                            </div>
                            <span class="px-3 py-1 bg-red-50 border border-red-200 text-red-700 text-xs font-bold rounded-full">
                                Sisa {{ $pkg->daily_quota }} porsi
                            </span>
                        </div>
                    @empty
                        <div class="py-8 text-center">
                            <p class="text-sm text-stone-500">Semua paket memiliki kuota produksi yang aman.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-xs border border-stone-200/80">
                <div class="flex items-center justify-between pb-4 border-b border-stone-100">
                    <div>
                        <h3 class="font-bold text-base text-stone-900">Pesanan Masuk Terbaru</h3>
                        <p class="text-xs text-stone-500">Klik kode pesanan untuk memverifikasi</p>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="text-xs font-semibold text-amber-700 hover:underline">
                        Semua Pesanan &rarr;
                    </a>
                </div>

                <div class="divide-y divide-stone-100 mt-2">
                    @forelse($recentOrders as $order)
                        @php
                            $statusStyle = match(strtolower($order->status)) {
                                'approved', 'completed' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                'rejected', 'cancelled' => 'bg-red-50 text-red-700 border-red-200',
                                default => 'bg-amber-50 text-amber-700 border-amber-200',
                            };
                        @endphp
                        <div class="flex justify-between items-center py-3">
                            <div>
                                <a href="{{ route('admin.orders.show', $order) }}" class="font-bold text-sm text-amber-700 hover:underline">
                                    {{ $order->order_code }}
                                </a>
                                <p class="text-xs text-stone-500 mt-0.5">{{ $order->user->name }} &bull; {{ $order->portions }} porsi</p>
                            </div>
                            <span class="px-2.5 py-1 text-xs font-bold rounded-full border {{ $statusStyle }}">
                                {{ strtoupper($order->status) }}
                            </span>
                        </div>
                    @empty
                        <div class="py-8 text-center">
                            <p class="text-sm text-stone-500">Belum ada pesanan masuk.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>