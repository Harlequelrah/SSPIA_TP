<x-guest-layout>
    <div class="mb-6 text-center">
        <i class="fa-solid fa-key-skeleton text-4xl text-green-600 mb-3"></i>
        <h1 class="text-2xl font-bold text-gray-800">{{ __('Nouveau mot de passe') }}</h1>
    </div>

    <div class="mb-6 text-sm text-gray-700 bg-gray-50 p-4 rounded-lg border-l-4 border-green-600">
        {{ __('Veuillez créer un nouveau mot de passe sécurisé pour votre compte de suivi de colis. Assurez-vous qu\'il soit différent de vos mots de passe précédents.') }}
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Adresse e-mail')" />
            <div class="mt-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-envelope text-gray-400"></i>
                </div>
                <x-input-field id="email" class="pl-10" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" readonly />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Nouveau mot de passe')" />
            <div class="mt-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-lock text-gray-400"></i>
                </div>
                <x-input-field id="password" class="pl-10" type="password" name="password" required autocomplete="new-password" />
            </div>
            <p class="mt-1 text-xs text-gray-500">{{ __('Minimum 8 caractères, avec au moins un chiffre et un caractère spécial.') }}</p>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <div class="mt-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-lock-keyhole text-gray-400"></i>
                </div>
                <x-input-field id="password_confirmation" class="pl-10" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-6">
            <x-primary-button class="w-full justify-center">
                <i class="fa-solid fa-check-circle mr-2"></i>
                {{ __("Réinitialiser mon mot de passe") }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-8 pt-6 border-t border-gray-200 text-center text-xs text-gray-500">
        <p>{{ __('Vous vous souvenez de votre mot de passe ?') }} 
            <a href="{{ route('login') }}" class="text-green-600 hover:text-green-800 font-medium">
                {{ __('Se connecter') }}
            </a>
        </p>
    </div>
</x-guest-layout>