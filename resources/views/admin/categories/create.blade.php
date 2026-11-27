<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-bold text-xl text-stone-900">Tambah Kategori Paket</h2>
                <p class="text-xs text-stone-500 mt-0.5">Buat kategori baru untuk mengelompokkan menu catering</p>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center self-start sm:self-auto px-3.5 py-2 rounded-xl bg-white border border-stone-300 text-stone-700 hover:bg-stone-50 text-xs font-semibold transition">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('admin.categories.store') }}" class="bg-white p-6 sm:p-8 rounded-2xl shadow-xs border border-stone-200/80 space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-stone-700">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Prasmanan Nusantara / Nasi Box" required class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-stone-700">Deskripsi</label>
                <textarea name="description" rows="3" placeholder="Jelaskan jenis acara atau karakteristik hidangan dalam kategori ini..." class="mt-1.5 block w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">{{ old('description') }}</textarea>
            </div>

            <div class="pt-3 border-t border-stone-100 flex justify-end gap-3">
                <a href="{{ route('admin.categories.index') }}" class="px-5 py-2.5 border border-stone-300 text-stone-700 hover:bg-stone-50 rounded-xl text-sm font-medium transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-sm font-semibold shadow-sm transition">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</x-app-layout>