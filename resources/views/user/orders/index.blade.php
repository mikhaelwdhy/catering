<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="font-bold text-xl text-stone-900">Pesanan Saya</h2>
                <p class="text-xs text-stone-500 mt-0.5">Pantau status verifikasi, ubah detail pesanan, atau lihat rincian transaksi Anda</p>
            </div>
            <a href="{{ route('user.catalog.index') }}" class="inline-flex items-center self-start sm:self-auto px-4 py-2.5 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-sm font-semibold shadow-xs transition">
                + Buat Pesanan Baru
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white rounded-2xl shadow-xs border border-stone-200/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-stone-200 text-sm">
                    <thead class="bg-stone-50/90 text-stone-600 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-5 py-3.5 text-left font-semibold">Kode &amp; Acara</th>
                            <th class="px-5 py-3.5 text-left font-semibold">Paket Catering</th>
                            <th class="px-5 py-3.5 text-left font-semibold">Tanggal Acara</th>
                            <th class="px-5 py-3.5 text-left font-semibold">Total Tagihan</th>
                            <th class="px-5 py-3.5 text-left font-semibold">Status</th>
                            <th class="px-5 py-3.5 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 bg-white">
                        @forelse($orders as $order)
                            @php
                                $statusStyle = match(strtolower($order->status)) {
                                    'approved', 'completed', 'disetujui', 'selesai' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                    'rejected', 'cancelled', 'ditolak', 'dibatalkan' => 'bg-red-50 text-red-700 border-red-200',
                                    default => 'bg-amber-50 text-amber-700 border-amber-200',
                                };
                            @endphp
                            <tr class="hover:bg-amber-50/30 transition">
                                <td class="px-5 py-4">
                                    <a href="{{ route('user.orders.show', $order) }}" class="font-bold text-amber-700 hover:underline">
                                        {{ $order->order_code }}
                                    </a>
                                    <div class="text-xs text-stone-600 font-medium mt-0.5">{{ $order->event_name }}</div>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="font-semibold text-stone-900">{{ $order->package->name }}</div>
                                    <div class="text-xs text-stone-500">{{ $order->portions }} porsi</div>
                                </td>
                                <td class="px-5 py-4 text-stone-700 whitespace-nowrap">
                                    {{ $order->event_date->format('d M Y') }}
                                </td>
                                <td class="px-5 py-4 font-bold text-stone-900 whitespace-nowrap">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $statusStyle }}">
                                        {{ strtoupper($order->status) }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-right whitespace-nowrap">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('user.orders.show', $order) }}" class="px-3 py-1.5 rounded-lg bg-stone-100 hover:bg-stone-200 text-stone-700 text-xs font-semibold transition">
                                            Detail
                                        </a>

                                        @if(strtolower($order->status) === 'pending')
                                            <a href="{{ route('user.orders.edit', $order) }}" class="px-3 py-1.5 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 text-xs font-semibold transition">
                                                Edit
                                            </a>

                                            <form method="POST" action="{{ route('user.orders.destroy', $order) }}" onsubmit="return confirm('Batalkan pesanan {{ $order->order_code }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 text-xs font-semibold transition">
                                                    Batalkan
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-12 text-center">
                                    <p class="font-semibold text-stone-800">Belum ada pesanan catering</p>
                                    <p class="text-xs text-stone-500 mt-1 mb-4">Mulai pilih paket catering favorit untuk acara Anda sekarang.</p>
                                    <a href="{{ route('user.catalog.index') }}" class="inline-flex items-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-xs font-semibold transition">
                                        Jelajahi Katalog Paket
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if(method_exists($orders, 'links'))
            <div>
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</x-app-layout>