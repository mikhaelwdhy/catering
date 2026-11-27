<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-bold text-xl text-stone-900">Detail &amp; Verifikasi Pesanan {{ $order->order_code }}</h2>
                <p class="text-xs text-stone-500 mt-0.5">Periksa kelengkapan pembayaran dan perbarui status persetujuan pesanan</p>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center self-start sm:self-auto px-3.5 py-2 rounded-xl bg-white border border-stone-300 text-stone-700 hover:bg-stone-50 text-xs font-semibold transition">
                &larr; Kembali ke Daftar Pesanan
            </a>
        </div>
    </x-slot>

    @php
        $statusStyle = match(strtolower($order->status)) {
            'approved', 'completed' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'rejected', 'cancelled' => 'bg-red-50 text-red-700 border-red-200',
            default => 'bg-amber-50 text-amber-700 border-amber-200',
        };
    @endphp

    <div class="py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Kolom Informasi Pemesanan -->
        <div class="lg:col-span-7 bg-white rounded-2xl shadow-xs border border-stone-200/80 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-amber-50/80 to-stone-50 border-b border-stone-200/80 flex items-center justify-between">
                <h3 class="font-bold text-base text-stone-900">Informasi Pemesanan</h3>
                <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusStyle }}">
                    {{ strtoupper($order->status) }}
                </span>
            </div>

            <div class="p-6 space-y-4 text-sm">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="p-3.5 rounded-xl bg-stone-50 border border-stone-200/70">
                        <span class="text-xs text-stone-500 block">Pemesan</span>
                        <strong class="text-stone-900">{{ $order->user->name }}</strong>
                        <span class="text-xs text-stone-500 block mt-0.5">{{ $order->user->phone ?? '-' }}</span>
                    </div>
                    <div class="p-3.5 rounded-xl bg-stone-50 border border-stone-200/70">
                        <span class="text-xs text-stone-500 block">Acara &amp; Tanggal</span>
                        <strong class="text-stone-900">{{ $order->event_name }}</strong>
                        <span class="text-xs text-amber-700 font-semibold block mt-0.5">{{ $order->event_date->format('d M Y') }}</span>
                    </div>
                </div>

                <div class="space-y-2.5 pt-1">
                    <p><span class="text-stone-500">Alamat Pengiriman:</span> <span class="text-stone-800 font-medium">{{ $order->event_address }}</span></p>
                    <p><span class="text-stone-500">Paket Catering:</span> <strong class="text-stone-900">{{ $order->package->name }}</strong></p>
                    <p>
                        <span class="text-stone-500">Jumlah Porsi:</span>
                        <strong class="text-stone-900">{{ $order->portions }} porsi</strong>
                        <span class="ml-1.5 px-2 py-0.5 rounded-md bg-stone-100 text-xs text-stone-600">Sisa Kuota: {{ $order->package->daily_quota }}</span>
                    </p>
                    <p><span class="text-stone-500">Catatan Pemesan:</span> <span class="text-stone-700">{{ $order->notes ?? '-' }}</span></p>
                </div>

                <div class="p-4 rounded-xl bg-amber-50/70 border border-amber-200/80 space-y-1.5">
                    <div class="flex justify-between items-center">
                        <span class="text-stone-600 font-medium">Total Tagihan</span>
                        <strong class="text-amber-800 text-base font-extrabold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-stone-500">Denda Tambahan</span>
                        <span class="font-semibold text-stone-700">Rp {{ number_format($order->penalty_fee, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="pt-2 border-t border-stone-100">
                    <p class="text-xs font-semibold uppercase tracking-wider text-stone-400 mb-2">Bukti Pembayaran</p>
                    @if($order->payment_proof)
                        <a href="{{ Storage::url($order->payment_proof) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-200 rounded-xl text-xs font-semibold transition">
                            Lihat / Unduh Bukti Bayar &nearr;
                        </a>
                    @else
                        <span class="text-xs text-stone-400 italic">Belum diunggah oleh pemesan</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Kolom Tindakan Admin -->
        <div class="lg:col-span-5 bg-white rounded-2xl shadow-xs border border-stone-200/80 overflow-hidden self-start">
            <div class="px-6 py-4 bg-stone-50 border-b border-stone-200/80">
                <h3 class="font-bold text-base text-stone-900">Tindakan Admin</h3>
            </div>

            <div class="p-6 space-y-4">
                <div class="p-3 rounded-xl bg-stone-50 border border-stone-200/70 flex items-center justify-between text-xs">
                    <span class="text-stone-500 font-medium">Status Saat Ini</span>
                    <span class="px-2.5 py-1 rounded-full font-bold border {{ $statusStyle }}">{{ strtoupper($order->status) }}</span>
                </div>

                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-sm font-semibold text-stone-700">Ubah Status Pesanan</label>
                        <select name="status" class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                            <option value="Approved" @selected($order->status === 'Approved')>Approved (Setujui &amp; Potong Kuota)</option>
                            <option value="Rejected" @selected($order->status === 'Rejected')>Rejected (Tolak Pesanan)</option>
                            <option value="Completed" @selected($order->status === 'Completed')>Completed (Acara Selesai)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-stone-700">Denda Keterlambatan / Kerusakan Alat (Rp)</label>
                        <input type="number" name="penalty_fee" value="{{ old('penalty_fee', $order->penalty_fee) }}" min="0" class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-stone-700">Catatan Admin</label>
                        <textarea name="admin_note" rows="3" placeholder="Tambahkan catatan konfirmasi atau alasan penolakan..." class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">{{ old('admin_note', $order->admin_note) }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-2.5 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-sm font-semibold shadow-sm transition">
                        Simpan Perubahan Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>