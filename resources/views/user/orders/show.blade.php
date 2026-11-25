<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Detail Pesanan {{ $order->order_code }}</h2></x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border space-y-3 text-sm">
            <div class="flex justify-between items-center border-b pb-3">
                <span class="font-bold text-lg text-gray-800">{{ $order->event_name }}</span>
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100">{{ $order->status }}</span>
            </div>
            <p><span class="text-gray-500">Paket Catering:</span> <strong>{{ $order->package->name }}</strong> ({{ $order->package->category->name }})</p>
            <p><span class="text-gray-500">Tanggal Acara:</span> {{ $order->event_date->format('d M Y') }}</p>
            <p><span class="text-gray-500">Alamat Pengiriman:</span> {{ $order->event_address }}</p>
            <p><span class="text-gray-500">Jumlah Porsi:</span> {{ $order->portions }} porsi &times; Rp {{ number_format($order->price_per_portion, 0, ',', '.') }}</p>
            <p><span class="text-gray-500">Total Tagihan:</span> <strong class="text-indigo-600 text-base">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></p>
            @if($order->penalty_fee > 0)
                <p><span class="text-gray-500">Denda Tambahan:</span> <strong class="text-red-600">Rp {{ number_format($order->penalty_fee, 0, ',', '.') }}</strong></p>
            @endif
            <p><span class="text-gray-500">Catatan Anda:</span> {{ $order->notes ?? '-' }}</p>
            <p><span class="text-gray-500">Catatan Admin:</span> {{ $order->admin_note ?? '-' }}</p>

            @if($order->payment_proof)
                <div class="pt-2">
                    <a href="{{ Storage::url($order->payment_proof) }}" target="_blank" class="inline-block px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg font-medium">
                        Lihat Bukti Pembayaran
                    </a>
                </div>
            @endif

            <div class="pt-4 border-t flex justify-end">
                <a href="{{ route('user.orders.index') }}" class="px-4 py-2 border rounded-lg">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>