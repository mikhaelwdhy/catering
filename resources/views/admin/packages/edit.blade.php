<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-bold text-xl text-stone-900">Edit Paket: {{ $package->name }}</h2>
                <p class="text-xs text-stone-500 mt-0.5">Perbarui harga, batas MOQ, kuota harian, atau foto paket catering</p>
            </div>
            <a href="{{ route('admin.packages.index') }}" class="inline-flex items-center self-start sm:self-auto px-3.5 py-2 rounded-xl bg-white border border-stone-300 text-stone-700 hover:bg-stone-50 text-xs font-semibold transition">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('admin.packages.update', $package) }}" enctype="multipart/form-data" class="bg-white p-6 sm:p-8 rounded-2xl shadow-xs border border-stone-200/80 space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-stone-700">Kategori</label>
                <select name="category_id" required class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(old('category_id', $package->category_id) == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-stone-700">Nama Paket</label>
                <input type="text" name="name" value="{{ old('name', $package->name) }}" required class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-stone-700">Deskripsi Menu</label>
                <textarea name="description" rows="3" required class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">{{ old('description', $package->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-stone-700">Harga / Porsi (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $package->price) }}" required class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-stone-700">Min. Order (MOQ)</label>
                    <input type="number" name="min_order" value="{{ old('min_order', $package->min_order) }}" required class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-stone-700">Kuota Harian</label>
                    <input type="number" name="daily_quota" value="{{ old('daily_quota', $package->daily_quota) }}" required class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-stone-700">Ganti Foto Paket (Opsional)</label>
                @if($package->image)
                    <div class="mt-2 mb-3">
                        <img src="{{ Storage::url($package->image) }}" alt="{{ $package->name }}" class="h-24 w-36 object-cover rounded-xl border border-stone-200 shadow-2xs">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="mt-1.5 block w-full text-sm text-stone-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 border border-stone-300 rounded-xl p-1.5">
            </div>

            <div class="pt-3 border-t border-stone-100 flex justify-end gap-3">
                <a href="{{ route('admin.packages.index') }}" class="px-5 py-2.5 border border-stone-300 text-stone-700 hover:bg-stone-50 rounded-xl text-sm font-medium transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-sm font-semibold shadow-sm transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>