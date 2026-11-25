<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Detail & Verifikasi Pesanan {{ $order->order_code }}</h2></x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border space-y-3 text-sm">
            <h3 class="font-semibold text-base text-gray-800 border-b pb-2">Informasi Pemesanan</h3>
            <p><span class="text-gray-500">Pemesan:</span> <strong>{{ $order->user->name }}</strong> ({{ $order->user->phone ?? '-' }})</p>
            <p><span class="text-gray-500">Nama Acara:</span> {{ $order->event_name }}</p>
            <p><span class="text-gray-500">Tanggal Acara:</span> {{ $order->event_date->format('d M Y') }}</p>
            <p><span class="text-gray-500">Alamat:</span> {{ $order->event_address }}</p>
            <p><span class="text-gray-500">Paket:</span> {{ $order->package->name }}</p>
            <p><span class="text-gray-500">Jumlah Porsi:</span> {{ $order->portions }} porsi (Sisa Kuota: {{ $order->package->daily_quota }})</p>
            <p><span class="text-gray-500">Total Tagihan:</span> <strong class="text-indigo-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></p>
            <p><span class="text-gray-500">Denda Tambahan:</span> Rp {{ number_format($order->penalty_fee, 0, ',', '.') }}</p>
            <p><span class="text-gray-500">Catatan Pemesan:</span> {{ $order->notes ?? '-' }}</p>

            <div class="pt-2">
                <p class="text-gray-500 mb-1">Bukti Pembayaran:</p>
                @if($order->payment_proof)
                    <a href="{{ Storage::url($order->payment_proof) }}" target="_blank" class="inline-block px-3 py-1.5 bg-indigo-50 text-indigo-700 rounded-lg font-medium hover:bg-indigo-100">
                        Lihat / Unduh Bukti Bayar
                    </a>
                @else
                    <span class="text-gray-400">Belum diunggah</span>
                @endif
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border space-y-4">
            <h3 class="font-semibold text-base text-gray-800 border-b pb-2">Tindakan Admin</h3>
            <p class="text-sm">Status Saat Ini: <span class="font-bold">{{ $order->status }}</span></p>

            <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" class="space-y-4">
                @csrf @method('PATCH')
                <div>
                    <label class="block text-sm font-medium text-gray-700">Ubah Status Pesanan</label>
                    <select name="status" class="mt-1 block w-full rounded-lg border-gray-300 text-sm">
                        <option value="Approved" @selected($order->status === 'Approved')>Approved (Setujui & Potong Kuota)</option>
                        <option value="Rejected" @selected($order->status === 'Rejected')>Rejected (Tolak Pesanan)</option>
                        <option value="Completed" @selected($order->status === 'Completed')>Completed (Acara Selesai)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Denda Keterlambatan / Kerusakan Alat (Rp)</label>
                    <input type="number" name="penalty_fee" value="{{ old('penalty_fee', $order->penalty_fee) }}" min="0" class="mt-1 block w-full rounded-lg border-gray-300 text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Catatan Admin</label>
                    <textarea name="admin_note" rows="3" class="mt-1 block w-full rounded-lg border-gray-300 text-sm">{{ old('admin_note', $order->admin_note) }}</textarea>
                </div>

                <button type="submit" class="w-full py-2.5 bg-amber-600 text-white rounded-lg text-sm font-semibold hover:bg-amber-700">
                    Simpan Perubahan Status
                </button>
            </form>
        </div>
    </div>
</x-app-layout>