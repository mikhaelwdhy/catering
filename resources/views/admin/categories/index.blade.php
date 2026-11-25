<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Kelola Kategori Paket</h2>
            <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-amber-600 text-white rounded-lg text-sm font-medium hover:bg-amber-700">
                + Tambah Kategori
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
        <form method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama kategori..." class="rounded-lg border-gray-300 text-sm w-64">
            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-lg text-sm">Cari</button>
        </form>

        <div class="bg-white rounded-xl shadow-sm border overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Nama Kategori</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Deskripsi</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Jumlah Paket</th>
                        <th class="px-6 py-3 text-right font-medium text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($categories as $category)
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ Str::limit($category->description, 60) }}</td>
                            <td class="px-6 py-4">{{ $category->packages_count }} Paket</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $categories->links() }}
    </div>
</x-app-layout>