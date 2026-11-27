<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-xl text-stone-900">Daftar Semua Pesanan Masuk</h2>
            <p class="text-xs text-stone-500 mt-0.5">Verifikasi bukti pembayaran, kelola status pesanan, dan pantau jadwal acara</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">
        <form method="GET" class="bg-white p-4 rounded-2xl border border-stone-200/80 shadow-xs flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode / acara / pemesan..." class="rounded-xl border-stone-300 text-sm sm:w-72 focus:border-amber-500 focus:ring-amber-500">
            <select name="status" class="rounded-xl border-stone-300 text-sm sm:w-48 focus:border-amber-500 focus:ring-amber-500">
                <option value="">Semua Status</option>
                @foreach(['Pending', 'Approved', 'Rejected', 'Completed'] as $st)
                    <option value="{{ $st }}" @selected(request('status') === $st)>{{ $st }}</option>
                @endforeach
            </select>
            <div class="flex gap-2">
                <button type="submit" class="px-5 py-2.5 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-sm font-semibold transition">
                    Filter
                </button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.orders.index') }}" class="px-4 py-2.5 bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-xl text-sm font-medium transition">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        <div class="bg-white rounded-2xl shadow-xs border border-stone-200/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-stone-200 text-sm">
                    <thead class="bg-stone-50/90 text-stone-600 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3.5 text-left font-semibold">Kode</th>
                            <th class="px-6 py-3.5 text-left font-semibold">Pemesan</th>
                            <th class="px-6 py-3.5 text-left font-semibold">Paket &amp; Tgl Acara</th>
                            <th class="px-6 py-3.5 text-left font-semibold">Total Tagihan</th>
                            <th class="px-6 py-3.5 text-left font-semibold">Status</th>
                            <th class="px-6 py-3.5 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 bg-white">
                        @forelse($orders as $order)
                            @php
                                $statusStyle = match(strtolower($order->status)) {
                                    'approved', 'completed' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                    'rejected', 'cancelled' => 'bg-red-50 text-red-700 border-red-200',
                                    default => 'bg-amber-50 text-amber-700 border-amber-200',
                                };
                            @endphp
                            <tr class="hover:bg-amber-50/30 transition">
                                <td class="px-6 py-4 font-bold text-amber-700 whitespace-nowrap">{{ $order->order_code }}</td>
                                <td class="px-6 py-4 font-medium text-stone-900">{{ $order->user->name }}</td>
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-stone-900">{{ $order->package->name }} ({{ $order->portions }} porsi)</p>
                                    <p class="text-xs text-stone-500 mt-0.5">Acara: {{ $order->event_date->format('d M Y') }}</p>
                                </td>
                                <td class="px-6 py-4 font-bold text-stone-900 whitespace-nowrap">
                                    Rp {{ number_format($order->total_price + $order->penalty_fee, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $statusStyle }}">
                                        {{ strtoupper($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center px-3.5 py-1.5 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold shadow-2xs transition">
                                        Verifikasi
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-stone-500">
                                    Belum ada pesanan masuk yang sesuai filter.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            {{ $orders->links() }}
        </div>
    </div>
</x-app-layout>