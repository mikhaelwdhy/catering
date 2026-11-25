<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Edit Pesanan {{ $order->order_code }}</h2></x-slot>

    <div class="py-8 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('user.orders.update', $order) }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-sm border space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700">Pilih Paket Catering</label>
                <select name="package_id" required class="mt-1 block w-full rounded-lg border-gray-300">
                    @foreach($packages as $pkg)
                        <option value="{{ $pkg->id }}" @selected(old('package_id', $order->package_id) == $pkg->id)>
                            {{ $pkg->name }} - Rp {{ number_format($pkg->price, 0, ',', '.') }}/porsi (MOQ: {{ $pkg->min_order }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jumlah Porsi</label>
                    <input type="number" name="portions" value="{{ old('portions', $order->portions) }}" required class="mt-1 block w-full rounded-lg border-gray-300">
                    @error('portions') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Acara (Minimal H-2)</label>
                    <input type="date" name="event_date" min="{{ $minEventDate }}" value="{{ old('event_date', $order->event_date->toDateString()) }}" required class="mt-1 block w-full rounded-lg border-gray-300">
                    @error('event_date') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Acara</label>
                <input type="text" name="event_name" value="{{ old('event_name', $order->event_name) }}" required class="mt-1 block w-full rounded-lg border-gray-300">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Alamat Lengkap Lokasi Acara</label>
                <textarea name="event_address" rows="2" required class="mt-1 block w-full rounded-lg border-gray-300">{{ old('event_address', $order->event_address) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Ganti Bukti Pembayaran (Opsional)</label>
                <input type="file" name="payment_proof" accept=".jpg,.jpeg,.png,.pdf" class="mt-1 block w-full text-sm">
                @error('payment_proof') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Catatan Tambahan</label>
                <textarea name="notes" rows="2" class="mt-1 block w-full rounded-lg border-gray-300">{{ old('notes', $order->notes) }}</textarea>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('user.orders.index') }}" class="px-4 py-2 border rounded-lg text-sm">Batal</a>
                <button type="submit" class="px-4 py-2 bg-amber-600 text-white rounded-lg text-sm">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-app-layout>