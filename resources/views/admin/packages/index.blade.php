<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="font-bold text-xl text-stone-900">Kelola Paket Catering</h2>
                <p class="text-xs text-stone-500 mt-0.5">Daftar paket hidangan, tarif per porsi, MOQ, dan sisa kuota harian</p>
            </div>
            <a href="{{ route('admin.packages.create') }}" class="inline-flex items-center self-start sm:self-auto px-4 py-2.5 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-sm font-semibold shadow-xs transition">
                + Tambah Paket
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">
        <form method="GET" class="bg-white p-4 rounded-2xl border border-stone-200/80 shadow-xs flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama paket..." class="rounded-xl border-stone-300 text-sm sm:w-72 focus:border-amber-500 focus:ring-amber-500">
            <select name="category_id" class="rounded-xl border-stone-300 text-sm sm:w-52 focus:border-amber-500 focus:ring-amber-500">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
            <div class="flex gap-2">
                <button type="submit" class="px-5 py-2.5 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-sm font-semibold transition">
                    Filter
                </button>
                @if(request('search') || request('category_id'))
                    <a href="{{ route('admin.packages.index') }}" class="px-4 py-2.5 bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-xl text-sm font-medium transition">
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
                            <th class="px-6 py-3.5 text-left font-semibold">Foto</th>
                            <th class="px-6 py-3.5 text-left font-semibold">Nama Paket</th>
                            <th class="px-6 py-3.5 text-left font-semibold">Harga / Porsi</th>
                            <th class="px-6 py-3.5 text-left font-semibold">MOQ</th>
                            <th class="px-6 py-3.5 text-left font-semibold">Kuota Harian</th>
                            <th class="px-6 py-3.5 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 bg-white">
                        @forelse($packages as $package)
                            <tr class="hover:bg-amber-50/30 transition">
                                <td class="px-6 py-4">
                                    @if($package->image)
                                        <img src="{{ Storage::url($package->image) }}" alt="{{ $package->name }}" class="h-12 w-16 object-cover rounded-xl border border-stone-200">
                                    @else
                                        <div class="h-12 w-16 bg-amber-50 border border-amber-100 rounded-xl flex items-center justify-center text-[11px] font-medium text-amber-600">
                                            No Img
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-stone-900">{{ $package->name }}</p>
                                    <span class="inline-block mt-0.5 text-xs font-medium text-amber-700">{{ $package->category->name }}</span>
                                </td>
                                <td class="px-6 py-4 font-bold text-stone-900 whitespace-nowrap">
                                    Rp {{ number_format($package->price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-stone-700 whitespace-nowrap">{{ $package->min_order }} porsi</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $package->daily_quota <= 50 ? 'bg-red-50 text-red-700 border-red-200' : 'bg-emerald-50 text-emerald-700 border-emerald-200' }}">
                                        {{ $package->daily_quota }} porsi
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('admin.packages.edit', $package) }}" class="px-3 py-1.5 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 text-xs font-semibold transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" class="inline" onsubmit="return confirm('Yakin menghapus paket ini beserta fotonya?')">
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
                                <td colspan="6" class="px-6 py-10 text-center text-stone-500">
                                    Belum ada data paket catering.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            {{ $packages->links() }}
        </div>
    </div>
</x-app-layout>