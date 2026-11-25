<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Daftar Semua Pesanan Masuk</h2></x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
        <form method="GET" class="flex flex-wrap gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode / acara / pemesan..." class="rounded-lg border-gray-300 text-sm w-64">
            <select name="status" class="rounded-lg border-gray-300 text-sm">
                <option value="">Semua Status</option>
                @foreach(['Pending', 'Approved', 'Rejected', 'Completed'] as $st)
                    <option value="{{ $st }}" @selected(request('status') === $st)>{{ $st }}</option>
                @endforeach
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-lg text-sm">Filter</button>
        </form>

        <div class="bg-white rounded-xl shadow-sm border overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Kode</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Pemesan</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Paket & Tgl Acara</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Total Tagihan</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Status</th>
                        <th class="px-6 py-3 text-right font-medium text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($orders as $order)
                        <tr>
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $order->order_code }}</td>
                            <td class="px-6 py-4">{{ $order->user->name }}</td>
                            <td class="px-6 py-4">
                                <p class="font-medium">{{ $order->package->name }} ({{ $order->portions }} porsi)</p>
                                <p class="text-xs text-gray-500">Acara: {{ $order->event_date->format('d M Y') }}</p>
                            </td>
                            <td class="px-6 py-4 font-semibold">Rp {{ number_format($order->total_price + $order->penalty_fee, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100">{{ $order->status }}</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-indigo-600 font-medium hover:underline">Verifikasi</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $orders->links() }}
    </div>
</x-app-layout>