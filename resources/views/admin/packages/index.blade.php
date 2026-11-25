<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Kelola Paket Catering</h2>
            <a href="{{ route('admin.packages.create') }}" class="px-4 py-2 bg-amber-600 text-white rounded-lg text-sm font-medium hover:bg-amber-700">
                + Tambah Paket
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
        <form method="GET" class="flex flex-wrap gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama paket..." class="rounded-lg border-gray-300 text-sm w-64">
            <select name="category_id" class="rounded-lg border-gray-300 text-sm">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-lg text-sm">Filter</button>
        </form>

        <div class="bg-white rounded-xl shadow-sm border overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Foto</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Nama Paket</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Harga / Porsi</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">MOQ</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Kuota Harian</th>
                        <th class="px-6 py-3 text-right font-medium text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($packages as $package)
                        <tr>
                            <td class="px-6 py-4">
                                @if($package->image)
                                    <img src="{{ Storage::url($package->image) }}" class="h-12 w-16 object-cover rounded">
                                @else
                                    <div class="h-12 w-16 bg-gray-100 rounded flex items-center justify-center text-xs text-gray-400">No Img</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900">{{ $package->name }}</p>
                                <p class="text-xs text-gray-500">{{ $package->category->name }}</p>
                            </td>
                            <td class="px-6 py-4 font-semibold">Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">{{ $package->min_order }} porsi</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $package->daily_quota <= 50 ? 'bg-red-100 text-red-700' : 'bg-emerald-100 text-emerald-700' }}">
                                    {{ $package->daily_quota }} porsi
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.packages.edit', $package) }}" class="text-indigo-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" class="inline" onsubmit="return confirm('Yakin menghapus paket ini beserta fotonya?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $packages->links() }}
    </div>
</x-app-layout>