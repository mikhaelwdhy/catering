<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="font-bold text-xl text-stone-900">Kelola Kategori Paket</h2>
                <p class="text-xs text-stone-500 mt-0.5">Atur pengelompokan menu catering untuk memudahkan pelanggan</p>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center self-start sm:self-auto px-4 py-2.5 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-sm font-semibold shadow-xs transition">
                + Tambah Kategori
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">
        <form method="GET" class="bg-white p-4 rounded-2xl border border-stone-200/80 shadow-xs flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama kategori..." class="rounded-xl border-stone-300 text-sm sm:w-72 focus:border-amber-500 focus:ring-amber-500">
            <div class="flex gap-2">
                <button type="submit" class="px-5 py-2.5 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-sm font-semibold transition">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.categories.index') }}" class="px-4 py-2.5 bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-xl text-sm font-medium transition">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        <div class="bg-white rounded-2xl shadow-xs border border-stone-200/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-stone-200 text-sm">
                    <thead class="bg-stone-50/90 text-stone-600 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3.5 text-left font-semibold">Nama Kategori</th>
                            <th class="px-6 py-3.5 text-left font-semibold">Deskripsi</th>
                            <th class="px-6 py-3.5 text-left font-semibold">Jumlah Paket</th>
                            <th class="px-6 py-3.5 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 bg-white">
                        @forelse($categories as $category)
                            <tr class="hover:bg-amber-50/30 transition">
                                <td class="px-6 py-4 font-bold text-stone-900">{{ $category->name }}</td>
                                <td class="px-6 py-4 text-stone-600">{{ Str::limit($category->description, 65) ?: '-' }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                                        {{ $category->packages_count }} Paket
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="px-3 py-1.5 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 text-xs font-semibold transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 text-xs font-semibold transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-stone-500">
                                    Belum ada data kategori paket.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            {{ $categories->links() }}
        </div>
    </div>
</x-app-layout>