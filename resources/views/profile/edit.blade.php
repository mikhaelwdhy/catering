<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-xl text-stone-900 leading-tight">
                Profil Saya
            </h2>
            <p class="text-xs text-stone-500 mt-0.5">Kelola data akun, keamanan kata sandi, dan pengaturan profil Anda</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 sm:p-8 bg-white shadow-xs border border-stone-200/80 rounded-2xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-white shadow-xs border border-stone-200/80 rounded-2xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-white shadow-xs border border-red-100 rounded-2xl">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>