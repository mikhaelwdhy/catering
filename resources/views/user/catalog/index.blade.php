<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-bold text-xl text-stone-900">Katalog Paket Catering &amp; Acara</h2>
                <p class="text-xs text-stone-500 mt-0.5">Pilih paket hidangan sesuai jenis acara, MOQ, dan kuota harian</p>
            </div>
            <a href="{{ route('user.orders.index') }}" class="inline-flex items-center self-start sm:self-auto px-3.5 py-2 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 text-xs font-semibold hover:bg-amber-100 transition">
                Lihat Pesanan Saya &rarr;
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <!-- Filter & Pencarian -->
        <form method="GET" class="bg-white p-4 rounded-2xl border border-stone-200/80 shadow-xs flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama paket atau menu..." class="w-full rounded-xl border-stone-300 text-sm focus:border-amber-500 focus:ring-amber-500">
            </div>
            <select name="category_id" class="rounded-xl border-stone-300 text-sm sm:w-56 focus:border-amber-500 focus:ring-amber-500">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
            <div class="flex gap-2">
                <button type="submit" class="px-5 py-2.5 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-sm font-semibold shadow-xs transition">
                    Cari Paket
                </button>
                @if(request('search') || request('category_id'))
                    <a href="{{ route('user.catalog.index') }}" class="px-4 py-2.5 bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-xl text-sm font-medium transition">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        <!-- Grid Paket Catering -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($packages as $pkg)
                <div class="bg-white rounded-2xl shadow-xs hover:shadow-md border border-stone-200/80 overflow-hidden flex flex-col justify-between transition group">
                    <div>
                        <div class="relative overflow-hidden">
                            @if($pkg->image)
                                <img src="{{ Storage::url($pkg->image) }}" alt="{{ $pkg->name }}" class="h-48 w-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="h-48 w-full bg-gradient-to-br from-amber-50 to-orange-100 flex flex-col items-center justify-center text-amber-600">
                                    <svg class="w-10 h-10 mb-1.5 opacity-75" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 15h18M5 15a7 7 0 0114 0M12 5v3m-2 0h4M4 19h16" />
                                    </svg>
                                    <span class="text-xs font-semibold">Foto Paket Catering</span>
                                </div>
                            @endif

                            <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wide bg-white/95 text-amber-700 shadow-xs border border-amber-100">
                                {{ $pkg->category->name }}
                            </span>
                        </div>

                        <div class="p-5 space-y-2">
                            <h3 class="font-bold text-lg text-stone-900 group-hover:text-amber-700 transition">{{ $pkg->name }}</h3>
                            <p class="text-sm text-stone-600 leading-relaxed line-clamp-3">{{ $pkg->description }}</p>
                        </div>
                    </div>

                    <div class="p-5 pt-0 space-y-4">
                        <div class="border-t border-stone-100 pt-3 flex justify-between text-xs text-stone-500">
                            <span class="px-2.5 py-1 rounded-lg bg-stone-50 border border-stone-200/70">
                                MOQ: <strong class="text-stone-800">{{ $pkg->min_order }} porsi</strong>
                            </span>
                            <span class="px-2.5 py-1 rounded-lg bg-stone-50 border border-stone-200/70">
                                Kuota Harian: <strong class="text-stone-800">{{ $pkg->daily_quota }}</strong>
                            </span>
                        </div>

                        <div class="flex justify-between items-center pt-1">
                            <div>
                                <span class="block text-[11px] text-stone-400">Harga Paket</span>
                                <span class="text-lg font-extrabold text-amber-700">
                                    Rp {{ number_format($pkg->price, 0, ',', '.') }}<span class="text-xs font-normal text-stone-400">/porsi</span>
                                </span>
                            </div>
                            <a href="{{ route('user.orders.create', ['package_id' => $pkg->id]) }}" class="px-4 py-2.5 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-sm font-semibold shadow-xs transition">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white rounded-2xl border border-stone-200 p-10 text-center">
                    <p class="font-semibold text-stone-800">Paket catering tidak ditemukan</p>
                    <p class="text-sm text-stone-500 mt-1">Coba ubah kata kunci pencarian atau pilih kategori lainnya.</p>
                </div>
            @endforelse
        </div>

        <div>
            {{ $packages->links() }}
        </div>
    </div>
</x-app-layout>