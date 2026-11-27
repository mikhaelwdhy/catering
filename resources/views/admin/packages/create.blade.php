<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-bold text-xl text-stone-900">Tambah Paket Catering</h2>
                <p class="text-xs text-stone-500 mt-0.5">Tambahkan pilihan paket menu baru beserta harga, MOQ, dan kuota harian</p>
            </div>
            <a href="{{ route('admin.packages.index') }}" class="inline-flex items-center self-start sm:self-auto px-3.5 py-2 rounded-xl bg-white border border-stone-300 text-stone-700 hover:bg-stone-50 text-xs font-semibold transition">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('admin.packages.store') }}" enctype="multipart/form-data" class="bg-white p-6 sm:p-8 rounded-2xl shadow-xs border border-stone-200/80 space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-stone-700">Kategori</label>
                <select name="category_id" required class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-stone-700">Nama Paket</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Paket Prasmanan Gold" required class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-stone-700">Deskripsi Menu</label>
                <textarea name="description" rows="3" placeholder="Rincian lauk utama, sayur, pelengkap, dan minuman..." required class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-stone-700">Harga / Porsi (Rp)</label>
                    <input type="number" name="price" value="{{ old('price') }}" placeholder="35000" required class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-stone-700">Min. Order (MOQ)</label>
                    <input type="number" name="min_order" value="{{ old('min_order', 30) }}" required class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-stone-700">Kuota Harian</label>
                    <input type="number" name="daily_quota" value="{{ old('daily_quota', 200) }}" required class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-stone-700">Foto Paket (JPG/PNG, Max 2MB)</label>
                <input type="file" name="image" accept="image/*" class="mt-1.5 block w-full text-sm text-stone-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 border border-stone-300 rounded-xl p-1.5">
                @error('image') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-3 border-t border-stone-100 flex justify-end gap-3">
                <a href="{{ route('admin.packages.index') }}" class="px-5 py-2.5 border border-stone-300 text-stone-700 hover:bg-stone-50 rounded-xl text-sm font-medium transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-sm font-semibold shadow-sm transition">
                    Simpan Paket
                </button>
            </div>
        </form>
    </div>
</x-app-layout>