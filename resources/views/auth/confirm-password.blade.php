<x-guest-layout>
    <div class="mb-5 text-center">
        <h2 class="text-xl font-bold text-stone-900">Konfirmasi Kata Sandi</h2>
        <p class="mt-1 text-sm text-stone-500">
            Ini adalah area aman. Silakan konfirmasi kata sandi Anda sebelum melanjutkan.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Kata Sandi" class="text-stone-700 font-medium" />
            <x-text-input id="password"
                class="block mt-1.5 w-full rounded-xl border-stone-300 focus:border-amber-500 focus:ring-amber-500"
                type="password"
                name="password"
                placeholder="Masukkan kata sandi saat ini"
                required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-amber-600 hover:bg-amber-700 active:bg-amber-800 text-white font-semibold text-sm rounded-xl shadow-sm shadow-amber-500/20 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition">
                Konfirmasi
            </button>
        </div>
    </form>
</x-guest-layout>