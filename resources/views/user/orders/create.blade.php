<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Buat Pemesanan Catering</h2></x-slot>

    <div class="py-8 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('user.orders.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-sm border space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Pilih Paket Catering</label>
                <select name="package_id" id="packageSelect" required class="mt-1 block w-full rounded-lg border-gray-300">
                    @foreach($packages as $pkg)
                        <option value="{{ $pkg->id }}" data-price="{{ $pkg->price }}" data-moq="{{ $pkg->min_order }}" @selected(old('package_id', $selectedPackageId) == $pkg->id)>
                            {{ $pkg->name }} - Rp {{ number_format($pkg->price, 0, ',', '.') }}/porsi (MOQ: {{ $pkg->min_order }}, Kuota: {{ $pkg->daily_quota }})
                        </option>
                    @endforeach
                </select>
                @error('package_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jumlah Porsi (Sesuai MOQ)</label>
                    <input type="number" name="portions" id="portionsInput" value="{{ old('portions', 50) }}" required class="mt-1 block w-full rounded-lg border-gray-300">
                    @error('portions') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Acara (Minimal H-2)</label>
                    <input type="date" name="event_date" min="{{ $minEventDate }}" value="{{ old('event_date', $minEventDate) }}" required class="mt-1 block w-full rounded-lg border-gray-300">
                    @error('event_date') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="p-3 bg-amber-50 border border-amber-200 rounded-lg text-sm">
                Estimasi Total Tagihan: <strong id="estimatedTotal" class="text-amber-800">Rp 0</strong>
                <span class="block text-xs text-gray-500">*Total resmi dihitung otomatis oleh sistem saat penyimpanan.</span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Acara</label>
                <input type="text" name="event_name" value="{{ old('event_name') }}" placeholder="Contoh: Rapat Tahunan / Syukuran" required class="mt-1 block w-full rounded-lg border-gray-300">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Alamat Lengkap Lokasi Acara</label>
                <textarea name="event_address" rows="2" required class="mt-1 block w-full rounded-lg border-gray-300">{{ old('event_address') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Upload Bukti Pembayaran (JPG/PNG/PDF, Max 2MB)</label>
                <input type="file" name="payment_proof" accept=".jpg,.jpeg,.png,.pdf" required class="mt-1 block w-full text-sm">
                @error('payment_proof') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Catatan Tambahan (Opsional)</label>
                <textarea name="notes" rows="2" class="mt-1 block w-full rounded-lg border-gray-300">{{ old('notes') }}</textarea>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('user.orders.index') }}" class="px-4 py-2 border rounded-lg text-sm">Batal</a>
                <button type="submit" class="px-4 py-2 bg-amber-600 text-white rounded-lg text-sm font-medium">Kirim Pesanan</button>
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