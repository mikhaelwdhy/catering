<x-guest-layout>
    <div class="mb-5 text-center">
        <h2 class="text-xl font-bold text-stone-900">Verifikasi Email Anda</h2>
        <p class="mt-1 text-sm text-stone-500">
            Terima kasih telah mendaftar! Silakan klik tautan verifikasi yang baru saja kami kirimkan ke email Anda. Jika belum menerima email, kami dapat mengirimkannya ulang.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-sm font-medium text-emerald-700">
            Tautan verifikasi baru telah dikirim ke alamat email yang Anda daftarkan.
        </div>
    @endif

    <div class="mt-5 flex flex-col sm:flex-row items-center justify-between gap-3">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
            @csrf
            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-amber-600 hover:bg-amber-700 active:bg-amber-800 text-white font-semibold text-sm rounded-xl shadow-sm shadow-amber-500/20 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm font-medium text-stone-500 hover:text-stone-800 underline transition">
                Keluar
            </button>
        </form>
    </div>
</x-guest-layout>