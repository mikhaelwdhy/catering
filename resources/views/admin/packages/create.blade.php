<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Tambah Paket Catering</h2></x-slot>
    <div class="py-8 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('admin.packages.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-sm border space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category_id" required class="mt-1 block w-full rounded-lg border-gray-300">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Paket</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="mt-1 block w-full rounded-lg border-gray-300">
                @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Deskripsi Menu</label>
                <textarea name="description" rows="3" required class="mt-1 block w-full rounded-lg border-gray-300">{{ old('description') }}</textarea>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga / Porsi (Rp)</label>
                    <input type="number" name="price" value="{{ old('price') }}" required class="mt-1 block w-full rounded-lg border-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Min. Order (MOQ)</label>
                    <input type="number" name="min_order" value="{{ old('min_order', 30) }}" required class="mt-1 block w-full rounded-lg border-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kuota Harian</label>
                    <input type="number" name="daily_quota" value="{{ old('daily_quota', 200) }}" required class="mt-1 block w-full rounded-lg border-gray-300">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Foto Paket (JPG/PNG, Max 2MB)</label>
                <input type="file" name="image" accept="image/*" class="mt-1 block w-full text-sm">
                @error('image') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.packages.index') }}" class="px-4 py-2 border rounded-lg text-sm">Batal</a>
                <button type="submit" class="px-4 py-2 bg-amber-600 text-white rounded-lg text-sm">Simpan Paket</button>
            </div>
        </form>
    </div>
</x-app-layout>