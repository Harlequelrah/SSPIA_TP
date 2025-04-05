<x-guest-layout>
    <div class="mb-4 text-sm text-gray-700">
        {{ __('Avez-vous oublié votre mot de passe ? Pas de problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation qui vous permettra d\'en choisir un nouveau.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-input-field id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit"
                class="w-full bg-[#4a7c59] text-white p-2 mt-4 rounded-lg cursor-pointer transition-all duration-200 hover:bg-green-800 mb-4">{{ __('Envoyez') }}</button>
        </div>
    </form>
</x-guest-layout>
