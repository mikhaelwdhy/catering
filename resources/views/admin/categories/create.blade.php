<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Tambah Kategori</h2></x-slot>
    <div class="py-8 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('admin.categories.store') }}" class="bg-white p-6 rounded-xl shadow-sm border space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="mt-1 block w-full rounded-lg border-gray-300">
                @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" rows="3" class="mt-1 block w-full rounded-lg border-gray-300">{{ old('description') }}</textarea>
            </div>
            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 border rounded-lg text-sm">Batal</a>
                <button type="submit" class="px-4 py-2 bg-amber-600 text-white rounded-lg text-sm">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>