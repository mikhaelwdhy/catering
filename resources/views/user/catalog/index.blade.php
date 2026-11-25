<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Katalog Paket Catering & Acara</h2></x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <form method="GET" class="flex flex-wrap gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari paket atau menu..." class="rounded-lg border-gray-300 text-sm w-64">
            <select name="category_id" class="rounded-lg border-gray-300 text-sm">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-lg text-sm">Cari Paket</button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($packages as $pkg)
                <div class="bg-white rounded-xl shadow-sm border overflow-hidden flex flex-col justify-between">
                    <div>
                        @if($pkg->image)
                            <img src="{{ Storage::url($pkg->image) }}" class="h-44 w-full object-cover">
                        @else
                            <div class="h-44 w-full bg-amber-50 flex items-center justify-center text-amber-500 font-medium">Foto Paket Catering</div>
                        @endif
                        <div class="p-5 space-y-2">
                            <span class="text-xs font-semibold text-amber-600 uppercase">{{ $pkg->category->name }}</span>
                            <h3 class="font-bold text-lg text-gray-900">{{ $pkg->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $pkg->description }}</p>
                        </div>
                    </div>
                    <div class="p-5 pt-0 space-y-3">
                        <div class="border-t pt-3 flex justify-between text-sm">
                            <span class="text-gray-500">MOQ: <strong>{{ $pkg->min_order }} porsi</strong></span>
                            <span class="text-gray-500">Kuota Harian: <strong>{{ $pkg->daily_quota }}</strong></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-indigo-600">Rp {{ number_format($pkg->price, 0, ',', '.') }}<span class="text-xs text-gray-400">/porsi</span></span>
                            <a href="{{ route('user.orders.create', ['package_id' => $pkg->id]) }}" class="px-4 py-2 bg-amber-600 text-white rounded-lg text-sm font-medium hover:bg-amber-700">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $packages->links() }}
    </div>
</x-app-layout>