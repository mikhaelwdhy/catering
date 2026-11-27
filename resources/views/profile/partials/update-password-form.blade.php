<section>
    <header>
        <h2 class="text-lg font-bold text-stone-900">
            Perbarui Kata Sandi
        </h2>

        <p class="mt-1 text-sm text-stone-500">
            Pastikan akun Anda menggunakan kata sandi yang panjang dan unik agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" value="Kata Sandi Saat Ini" class="text-stone-700 font-semibold" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1.5 block w-full rounded-xl border-stone-300 focus:border-amber-500 focus:ring-amber-500" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" value="Kata Sandi Baru" class="text-stone-700 font-semibold" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1.5 block w-full rounded-xl border-stone-300 focus:border-amber-500 focus:ring-amber-500" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" value="Konfirmasi Kata Sandi Baru" class="text-stone-700 font-semibold" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1.5 block w-full rounded-xl border-stone-300 focus:border-amber-500 focus:ring-amber-500" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-amber-600 hover:bg-amber-700 active:bg-amber-800 text-white font-semibold text-xs uppercase tracking-wider rounded-xl shadow-xs transition">
                Simpan Kata Sandi
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-emerald-600"
                >Tersimpan.</p>
            @endif
        </div>
    </form>
</section>