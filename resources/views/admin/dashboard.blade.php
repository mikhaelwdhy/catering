<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Admin</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white p-5 rounded-xl shadow-sm border">
                <p class="text-sm text-gray-500">Total Pelanggan</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalUsers }}</p>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border">
                <p class="text-sm text-gray-500">Pesanan Pending</p>
                <p class="text-2xl font-bold text-amber-600 mt-1">{{ $pendingOrders }}</p>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border">
                <p class="text-sm text-gray-500">Pesanan Selesai</p>
                <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $completedOrders }}</p>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border">
                <p class="text-sm text-gray-500">Total Pendapatan</p>
                <p class="text-2xl font-bold text-indigo-600 mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border">
                <h3 class="font-semibold text-gray-800 mb-4">Peringatan Kuota Produksi Menipis (&le; 50 Porsi)</h3>
                @forelse($lowQuotaPackages as $pkg)
                    <div class="flex justify-between items-center py-2.5 border-b last:border-0">
                        <div>
                            <p class="font-medium text-gray-800">{{ $pkg->name }}</p>
                            <p class="text-xs text-gray-500">{{ $pkg->category->name }}</p>
                        </div>
                        <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">
                            Sisa {{ $pkg->daily_quota }} porsi
                        </span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Semua paket memiliki kuota produksi yang aman.</p>
                @endforelse
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border">
                <h3 class="font-semibold text-gray-800 mb-4">Pesanan Masuk Terbaru</h3>
                @foreach($recentOrders as $order)
                    <div class="flex justify-between items-center py-2.5 border-b last:border-0">
                        <div>
                            <a href="{{ route('admin.orders.show', $order) }}" class="font-medium text-indigo-600 hover:underline">
                                {{ $order->order_code }}
                            </a>
                            <p class="text-xs text-gray-500">{{ $order->user->name }} &bull; {{ $order->portions }} porsi</p>
                        </div>
                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                            {{ $order->status }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>