<x-guest-layout>
    <div class="mb-5 text-center">
        <h2 class="text-xl font-bold text-stone-900">Lupa Kata Sandi?</h2>
        <p class="mt-1 text-sm text-stone-500">
            Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Alamat Email" class="text-stone-700 font-medium" />
            <x-text-input id="email"
                class="block mt-1.5 w-full rounded-xl border-stone-300 focus:border-amber-500 focus:ring-amber-500"
                type="email"
                name="email"
                :value="old('email')"
                placeholder="nama@email.com"
                required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="pt-2 space-y-3">
            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-amber-600 hover:bg-amber-700 active:bg-amber-800 text-white font-semibold text-sm rounded-xl shadow-sm shadow-amber-500/20 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition">
                Kirim Tautan Reset Kata Sandi
            </button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-xs font-medium text-stone-500 hover:text-amber-700 transition">
                    Kembali ke halaman masuk
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>