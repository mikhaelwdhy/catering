<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-red-700">
            Hapus Akun
        </h2>

        <p class="mt-1 text-sm text-stone-500">
            Setelah akun Anda dihapus, seluruh data dan riwayat pemesanan akan dihapus secara permanen. Pastikan Anda telah menyimpan informasi yang diperlukan sebelum melanjutkan.
        </p>
    </header>

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-5 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-semibold text-xs uppercase tracking-wider rounded-xl shadow-xs transition"
    >
        Hapus Akun
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-7">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-stone-900">
                Apakah Anda yakin ingin menghapus akun ini?
            </h2>

            <p class="mt-1.5 text-sm text-stone-500 leading-relaxed">
                Setelah akun dihapus, seluruh data Anda akan hilang permanen. Masukkan kata sandi Anda untuk mengonfirmasi penghapusan akun.
            </p>

            <div class="mt-5">
                <x-input-label for="password" value="Kata Sandi" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full sm:w-3/4 rounded-xl border-stone-300 focus:border-amber-500 focus:ring-amber-500"
                    placeholder="Masukkan kata sandi Anda"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="px-4 py-2.5 border border-stone-300 text-stone-700 hover:bg-stone-50 rounded-xl text-xs font-semibold uppercase tracking-wider transition"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl text-xs font-semibold uppercase tracking-wider shadow-xs transition"
                >
                    Ya, Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>