<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-stone-900">Selamat Datang Kembali</h2>
        <p class="mt-1 text-sm text-stone-500">Masuk untuk mengelola atau memesan paket catering acara Anda</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" class="text-stone-700 font-medium" />
            <x-text-input id="email"
                class="block mt-1.5 w-full rounded-xl border-stone-300 focus:border-amber-500 focus:ring-amber-500"
                type="email"
                name="email"
                :value="old('email')"
                placeholder="contoh@catering.test"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" value="Kata Sandi" class="text-stone-700 font-medium" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-medium text-amber-700 hover:text-amber-800 hover:underline focus:outline-none" href="{{ route('password.request') }}">
                        Lupa kata sandi?
                    </a>
                @endif
            </div>

            <x-text-input id="password"
                class="block mt-1.5 w-full rounded-xl border-stone-300 focus:border-amber-500 focus:ring-amber-500"
                type="password"
                name="password"
                placeholder="••••••••"
                required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-stone-300 text-amber-600 shadow-xs focus:ring-amber-500" name="remember">
                <span class="ms-2 text-sm text-stone-600">Ingat saya</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-amber-600 hover:bg-amber-700 active:bg-amber-800 text-white font-semibold text-sm rounded-xl shadow-sm shadow-amber-500/20 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition">
                Masuk
            </button>
        </div>

        @if (Route::has('register'))
            <p class="text-center text-sm text-stone-600 pt-2 border-t border-stone-100">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold text-amber-700 hover:text-amber-800 hover:underline">
                    Daftar sekarang
                </a>
            </p>
        @endif
    </form>
</x-guest-layout>