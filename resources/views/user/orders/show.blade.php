<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-bold text-xl text-stone-900">Detail Pesanan {{ $order->order_code }}</h2>
                <p class="text-xs text-stone-500 mt-0.5">Informasi lengkap paket, jadwal pengiriman, dan status verifikasi</p>
            </div>
            <a href="{{ route('user.orders.index') }}" class="inline-flex items-center self-start sm:self-auto px-3.5 py-2 rounded-xl bg-white border border-stone-300 text-stone-700 hover:bg-stone-50 text-xs font-semibold transition">
                &larr; Kembali ke Daftar Pesanan
            </a>
        </div>
    </x-slot>

    @php
        $statusStyle = match(strtolower($order->status)) {
            'approved', 'completed', 'disetujui', 'selesai' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'rejected', 'cancelled', 'ditolak', 'dibatalkan' => 'bg-red-50 text-red-700 border-red-200',
            default => 'bg-amber-50 text-amber-700 border-amber-200',
        };
    @endphp

    <div class="py-8 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xs border border-stone-200/80 overflow-hidden">
            <!-- Header Card -->
            <div class="p-6 bg-gradient-to-r from-amber-50/80 via-stone-50 to-orange-50/70 border-b border-stone-200/80 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-amber-700">{{ $order->order_code }}</span>
                    <h3 class="font-bold text-xl text-stone-900 mt-0.5">{{ $order->event_name }}</h3>
                </div>
                <span class="self-start sm:self-auto px-3.5 py-1.5 rounded-full text-xs font-bold border {{ $statusStyle }}">
                    {{ strtoupper($order->status) }}
                </span>
            </div>

            <!-- Rincian Data -->
            <div class="p-6 space-y-5 text-sm">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl bg-stone-50 border border-stone-200/70">
                        <span class="text-xs text-stone-500 block">Paket Catering</span>
                        <strong class="text-stone-900 text-base">{{ $order->package->name }}</strong>
                        <span class="text-xs text-amber-700 font-medium block mt-0.5">{{ $order->package->category->name }}</span>
                    </div>

                    <div class="p-4 rounded-xl bg-stone-50 border border-stone-200/70">
                        <span class="text-xs text-stone-500 block">Tanggal Acara</span>
                        <strong class="text-stone-900 text-base">{{ $order->event_date->format('d M Y') }}</strong>
                        <span class="text-xs text-stone-500 block mt-0.5">{{ $order->portions }} porsi &times; Rp {{ number_format($order->price_per_portion, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="space-y-3 border-t border-stone-100 pt-4">
                    <div>
                        <span class="text-xs font-semibold uppercase tracking-wider text-stone-400">Alamat Pengiriman</span>
                        <p class="text-stone-800 mt-1">{{ $order->event_address }}</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div>
                            <span class="text-xs font-semibold uppercase tracking-wider text-stone-400">Catatan Anda</span>
                            <p class="text-stone-700 mt-1">{{ $order->notes ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-xs font-semibold uppercase tracking-wider text-stone-400">Catatan Admin</span>
                            <p class="text-stone-700 mt-1">{{ $order->admin_note ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan Tagihan -->
                <div class="p-4 rounded-xl bg-amber-50/70 border border-amber-200/80 space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="text-stone-600 font-medium">Total Tagihan</span>
                        <strong class="text-amber-800 text-lg font-extrabold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                    </div>
                    @if($order->penalty_fee > 0)
                        <div class="flex justify-between items-center text-xs pt-2 border-t border-amber-200/60">
                            <span class="text-stone-600">Denda Tambahan</span>
                            <strong class="text-red-600 font-bold">Rp {{ number_format($order->penalty_fee, 0, ',', '.') }}</strong>
                        </div>
                    @endif
                </div>

                <!-- Aksi Bawah -->
                <div class="pt-4 border-t border-stone-100 flex flex-wrap justify-between items-center gap-3">
                    <div>
                        @if($order->payment_proof)
                            <a href="{{ Storage::url($order->payment_proof) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-200 rounded-xl text-xs font-semibold transition">
                                Lihat Bukti Pembayaran &nearr;
                            </a>
                        @endif
                    </div>

                    <div class="flex items-center gap-2">
                        @if(strtolower($order->status) === 'pending')
                            <a href="{{ route('user.orders.edit', $order) }}" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-xs font-semibold transition">
                                Edit Pesanan
                            </a>
                        @endif
                        <a href="{{ route('user.orders.index') }}" class="px-4 py-2 border border-stone-300 text-stone-700 hover:bg-stone-50 rounded-xl text-xs font-semibold transition">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>