<section>
    <header>
        <h2 class="text-lg font-bold text-stone-900">
            Informasi Profil
        </h2>

        <p class="mt-1 text-sm text-stone-500">
            Perbarui informasi nama profil dan alamat email akun CateringKu Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="Nama Lengkap" class="text-stone-700 font-semibold" />
            <x-text-input id="name" name="name" type="text" class="mt-1.5 block w-full rounded-xl border-stone-300 focus:border-amber-500 focus:ring-amber-500" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Alamat Email" class="text-stone-700 font-semibold" />
            <x-text-input id="email" name="email" type="email" class="mt-1.5 block w-full rounded-xl border-stone-300 focus:border-amber-500 focus:ring-amber-500" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 rounded-xl bg-amber-50 border border-amber-200">
                    <p class="text-sm text-stone-800">
                        Alamat email Anda belum terverifikasi.

                        <button form="send-verification" class="underline text-sm font-semibold text-amber-700 hover:text-amber-800 rounded-md focus:outline-none">
                            Klik di sini untuk mengirim ulang email verifikasi.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-emerald-600">
                            Tautan verifikasi baru telah dikirim ke alamat email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-amber-600 hover:bg-amber-700 active:bg-amber-800 text-white font-semibold text-xs uppercase tracking-wider rounded-xl shadow-xs transition">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
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