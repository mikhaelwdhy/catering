<nav x-data="{ open: false }" class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-amber-100 shadow-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group">
                        <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 text-white flex items-center justify-center shadow-xs group-hover:scale-105 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 15h18M5 15a7 7 0 0114 0M12 5v3m-2 0h4M4 19h16" />
                            </svg>
                        </span>
                        <span class="font-bold text-xl tracking-tight text-stone-900">
                            Catering<span class="text-amber-600">Ku</span>
                        </span>
                    </a>
                </div>

                <div class="hidden space-x-2 sm:-my-px sm:ms-8 sm:flex h-full items-center">
                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="px-3 py-2 rounded-lg text-sm font-medium">
                            Dashboard
                        </x-nav-link>
                        <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')" class="px-3 py-2 rounded-lg text-sm font-medium">
                            Kategori
                        </x-nav-link>
                        <x-nav-link :href="route('admin.packages.index')" :active="request()->routeIs('admin.packages.*')" class="px-3 py-2 rounded-lg text-sm font-medium">
                            Paket Catering
                        </x-nav-link>
                        <x-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.*')" class="px-3 py-2 rounded-lg text-sm font-medium">
                            Kelola Pesanan
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')" class="px-3 py-2 rounded-lg text-sm font-medium">
                            Dashboard
                        </x-nav-link>
                        <x-nav-link :href="route('user.catalog.index')" :active="request()->routeIs('user.catalog.*')" class="px-3 py-2 rounded-lg text-sm font-medium">
                            Katalog Paket
                        </x-nav-link>
                        <x-nav-link :href="route('user.orders.index')" :active="request()->routeIs('user.orders.*')" class="px-3 py-2 rounded-lg text-sm font-medium">
                            Pesanan Saya
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
                <span class="px-2.5 py-1 text-[11px] font-bold tracking-wider rounded-full border {{ Auth::user()->role === 'admin' ? 'bg-purple-50 text-purple-700 border-purple-200' : 'bg-amber-50 text-amber-700 border-amber-200' }}">
                    {{ strtoupper(Auth::user()->role) }}
                </span>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-1.5 border border-stone-200 text-sm leading-4 font-medium rounded-xl text-stone-700 bg-stone-50/70 hover:bg-amber-50 hover:border-amber-200 hover:text-amber-800 focus:outline-none transition">
                            <span class="w-6 h-6 rounded-full bg-amber-600 text-white text-xs font-bold flex items-center justify-center">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="fill-current h-4 w-4 text-stone-400" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">Profil Saya</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600 hover:bg-red-50">
                                Keluar
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-stone-500 hover:text-amber-700 hover:bg-amber-50 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-amber-100">
        <div class="pt-2 pb-3 space-y-1 px-3">
            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    Dashboard
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')">
                    Kategori
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.packages.index')" :active="request()->routeIs('admin.packages.*')">
                    Paket Catering
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.*')">
                    Kelola Pesanan
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">
                    Dashboard
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('user.catalog.index')" :active="request()->routeIs('user.catalog.*')">
                    Katalog Paket
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('user.orders.index')" :active="request()->routeIs('user.orders.*')">
                    Pesanan Saya
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-3 pb-3 border-t border-stone-200 px-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="font-semibold text-sm text-stone-800">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-stone-500">{{ Auth::user()->email }}</div>
                </div>
                <span class="px-2.5 py-0.5 text-[11px] font-bold rounded-full {{ Auth::user()->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-amber-100 text-amber-800' }}">
                    {{ strtoupper(Auth::user()->role) }}
                </span>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Profil Saya</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600">
                        Keluar
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

@if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="flex items-center gap-2.5 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm shadow-xs">
            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="flex items-center gap-2.5 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-sm shadow-xs">
            <svg class="w-5 h-5 text-red-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    </div>
@endif