<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Dashboard Pelanggan</h2></x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white p-5 rounded-xl shadow-sm border">
                <p class="text-sm text-gray-500">Total Pesanan Saya</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalOrders }}</p>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border">
                <p class="text-sm text-gray-500">Menunggu Verifikasi</p>
                <p class="text-2xl font-bold text-amber-600 mt-1">{{ $pendingOrders }}</p>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border">
                <p class="text-sm text-gray-500">Disetujui / Selesai</p>
                <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $approvedOrders }}</p>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border">
                <p class="text-sm text-gray-500">Total Transaksi Aktif</p>
                <p class="text-2xl font-bold text-indigo-600 mt-1">Rp {{ number_format($totalSpent, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-800">Riwayat Pemesanan Terbaru</h3>
                <a href="{{ route('user.catalog.index') }}" class="px-4 py-2 bg-amber-600 text-white rounded-lg text-sm font-medium hover:bg-amber-700">
                    + Pesan Paket Catering
                </a>
            </div>
            @forelse($recentOrders as $order)
                <div class="flex justify-between items-center py-3 border-b last:border-0 text-sm">
                    <div>
                        <a href="{{ route('user.orders.show', $order) }}" class="font-semibold text-indigo-600 hover:underline">{{ $order->order_code }}</a>
                        <p class="text-gray-600">{{ $order->package->name }} ({{ $order->portions }} porsi) &bull; Acara {{ $order->event_date->format('d M Y') }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100">{{ $order->status }}</span>
                </div>
            @empty
                <p class="text-sm text-gray-500">Belum ada riwayat pemesanan.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>