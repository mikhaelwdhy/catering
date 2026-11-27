<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-bold text-xl text-stone-900">Dashboard Pelanggan</h2>
                <p class="text-xs text-stone-500 mt-0.5">Ringkasan aktivitas dan riwayat pemesanan paket catering Anda</p>
            </div>
            <a href="{{ route('user.catalog.index') }}" class="inline-flex items-center self-start sm:self-auto px-4 py-2.5 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-sm font-semibold shadow-xs transition">
                + Pesan Paket Catering
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <!-- Kartu Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white p-5 rounded-2xl shadow-xs border border-stone-200/80">
                <p class="text-xs font-semibold uppercase tracking-wider text-stone-400">Total Pesanan Saya</p>
                <p class="text-3xl font-extrabold text-stone-900 mt-2">{{ $totalOrders }}</p>
                <p class="text-xs text-stone-500 mt-1">Seluruh transaksi tercatat</p>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-xs border border-amber-200/80">
                <p class="text-xs font-semibold uppercase tracking-wider text-amber-600">Menunggu Verifikasi</p>
                <p class="text-3xl font-extrabold text-amber-600 mt-2">{{ $pendingOrders }}</p>
                <p class="text-xs text-stone-500 mt-1">Sedang dicek oleh admin</p>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-xs border border-emerald-200/80">
                <p class="text-xs font-semibold uppercase tracking-wider text-emerald-600">Disetujui / Selesai</p>
                <p class="text-3xl font-extrabold text-emerald-600 mt-2">{{ $approvedOrders }}</p>
                <p class="text-xs text-stone-500 mt-1">Siap atau telah terlaksana</p>
            </div>

            <div class="bg-gradient-to-br from-amber-600 to-orange-600 p-5 rounded-2xl shadow-sm text-white">
                <p class="text-xs font-semibold uppercase tracking-wider text-amber-100">Total Transaksi Aktif</p>
                <p class="text-2xl font-extrabold mt-2">Rp {{ number_format($totalSpent, 0, ',', '.') }}</p>
                <p class="text-xs text-amber-100 mt-1">Akumulasi pesanan aktif</p>
            </div>
        </div>

        <!-- Riwayat Pemesanan Terbaru -->
        <div class="bg-white p-6 rounded-2xl shadow-xs border border-stone-200/80">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 pb-4 border-b border-stone-100">
                <div>
                    <h3 class="font-bold text-base text-stone-900">Riwayat Pemesanan Terbaru</h3>
                    <p class="text-xs text-stone-500">Klik kode pesanan untuk melihat detail transaksi</p>
                </div>
                <a href="{{ route('user.orders.index') }}" class="text-xs font-semibold text-amber-700 hover:text-amber-800 hover:underline">
                    Lihat Semua Pesanan &rarr;
                </a>
            </div>

            <div class="divide-y divide-stone-100 mt-2">
                @forelse($recentOrders as $order)
                    @php
                        $statusStyle = match(strtolower($order->status)) {
                            'approved', 'completed', 'disetujui', 'selesai' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                            'rejected', 'cancelled', 'ditolak', 'dibatalkan' => 'bg-red-50 text-red-700 border-red-200',
                            default => 'bg-amber-50 text-amber-700 border-amber-200',
                        };
                    @endphp
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-3.5 gap-2 text-sm hover:bg-stone-50/70 px-2 rounded-xl transition">
                        <div>
                            <a href="{{ route('user.orders.show', $order) }}" class="font-bold text-amber-700 hover:underline">
                                {{ $order->order_code }}
                            </a>
                            <span class="text-stone-400 mx-1.5">&bull;</span>
                            <span class="font-semibold text-stone-800">{{ $order->event_name }}</span>
                            <p class="text-xs text-stone-500 mt-0.5">
                                {{ $order->package->name }} ({{ $order->portions }} porsi) &bull; Acara {{ $order->event_date->format('d M Y') }}
                            </p>
                        </div>

                        <div class="flex items-center gap-3 self-start sm:self-auto">
                            <span class="text-xs font-bold text-stone-800">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusStyle }}">
                                {{ strtoupper($order->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center">
                        <p class="text-sm font-medium text-stone-600">Belum ada riwayat pemesanan.</p>
                        <a href="{{ route('user.catalog.index') }}" class="inline-block mt-3 px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-xs font-semibold transition">
                            + Pesan Paket Catering Pertama Anda
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>