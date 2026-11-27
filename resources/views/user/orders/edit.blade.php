<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-bold text-xl text-stone-900">Edit Pesanan {{ $order->order_code }}</h2>
                <p class="text-xs text-stone-500 mt-0.5">Perbarui detail pesanan sebelum diverifikasi oleh admin</p>
            </div>
            <span class="inline-flex items-center self-start sm:self-auto px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                {{ strtoupper($order->status) }}
            </span>
        </div>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('user.orders.update', $order) }}" enctype="multipart/form-data" class="bg-white p-6 sm:p-8 rounded-2xl shadow-xs border border-stone-200/80 space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-stone-700">Pilih Paket Catering</label>
                <select name="package_id" id="packageSelect" required class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                    @foreach($packages as $pkg)
                        <option value="{{ $pkg->id }}" data-price="{{ $pkg->price }}" @selected(old('package_id', $order->package_id) == $pkg->id)>
                            {{ $pkg->name }} - Rp {{ number_format($pkg->price, 0, ',', '.') }}/porsi (MOQ: {{ $pkg->min_order }})
                        </option>
                    @endforeach
                </select>
                @error('package_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-stone-700">Jumlah Porsi</label>
                    <input type="number" name="portions" id="portionsInput" value="{{ old('portions', $order->portions) }}" required class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                    @error('portions') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-stone-700">Tanggal Acara (Minimal H-2)</label>
                    <input type="date" name="event_date" min="{{ $minEventDate }}" value="{{ old('event_date', $order->event_date->toDateString()) }}" required class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                    @error('event_date') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="p-4 bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                <span class="text-xs font-semibold uppercase tracking-wide text-amber-800">Estimasi Total Baru</span>
                <strong id="estimatedTotal" class="text-xl font-extrabold text-amber-700">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </strong>
            </div>

            <div>
                <label class="block text-sm font-semibold text-stone-700">Nama Acara</label>
                <input type="text" name="event_name" value="{{ old('event_name', $order->event_name) }}" required class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-stone-700">Alamat Lengkap Lokasi Acara</label>
                <textarea name="event_address" rows="2" required class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">{{ old('event_address', $order->event_address) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-stone-700">Ganti Bukti Pembayaran (Opsional)</label>
                <input type="file" name="payment_proof" accept=".jpg,.jpeg,.png,.pdf" class="mt-1.5 block w-full text-sm text-stone-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 border border-stone-300 rounded-xl p-1.5">
                @error('payment_proof') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-stone-700">Catatan Tambahan</label>
                <textarea name="notes" rows="2" class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">{{ old('notes', $order->notes) }}</textarea>
            </div>

            <div class="pt-3 border-t border-stone-100 flex justify-end gap-3">
                <a href="{{ route('user.orders.index') }}" class="px-5 py-2.5 border border-stone-300 text-stone-700 hover:bg-stone-50 rounded-xl text-sm font-medium transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-sm font-semibold shadow-sm transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <script>
        function updateEstimate() {
            const sel = document.getElementById('packageSelect');
            const price = parseInt(sel.options[sel.selectedIndex]?.dataset.price || 0);
            const portions = parseInt(document.getElementById('portionsInput').value || 0);
            document.getElementById('estimatedTotal').innerText = 'Rp ' + (price * portions).toLocaleString('id-ID');
        }
        document.getElementById('packageSelect').addEventListener('change', updateEstimate);
        document.getElementById('portionsInput').addEventListener('input', updateEstimate);
        updateEstimate();
    </script>
</x-app-layout>