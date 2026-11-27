<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-stone-900">Buat Akun Baru</h2>
        <p class="mt-1 text-sm text-stone-500">Daftar untuk mulai memesan paket catering acara Anda</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nama Lengkap" class="text-stone-700 font-medium" />
            <x-text-input id="name"
                class="block mt-1.5 w-full rounded-xl border-stone-300 focus:border-amber-500 focus:ring-amber-500"
                type="text"
                name="name"
                :value="old('name')"
                placeholder="Nama lengkap Anda"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Alamat Email" class="text-stone-700 font-medium" />
            <x-text-input id="email"
                class="block mt-1.5 w-full rounded-xl border-stone-300 focus:border-amber-500 focus:ring-amber-500"
                type="email"
                name="email"
                :value="old('email')"
                placeholder="nama@email.com"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Kata Sandi" class="text-stone-700 font-medium" />
            <x-text-input id="password"
                class="block mt-1.5 w-full rounded-xl border-stone-300 focus:border-amber-500 focus:ring-amber-500"
                type="password"
                name="password"
                placeholder="Minimal 8 karakter"
                required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="Konfirmasi Kata Sandi" class="text-stone-700 font-medium" />
            <x-text-input id="password_confirmation"
                class="block mt-1.5 w-full rounded-xl border-stone-300 focus:border-amber-500 focus:ring-amber-500"
                type="password"
                name="password_confirmation"
                placeholder="Ulangi kata sandi"
                required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-amber-600 hover:bg-amber-700 active:bg-amber-800 text-white font-semibold text-sm rounded-xl shadow-sm shadow-amber-500/20 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition">
                Daftar Akun
            </button>
        </div>

        <p class="text-center text-sm text-stone-600 pt-2 border-t border-stone-100">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold text-amber-700 hover:text-amber-800 hover:underline">
                Masuk di sini
            </a>
        </p>
    </form>
</x-guest-layout>