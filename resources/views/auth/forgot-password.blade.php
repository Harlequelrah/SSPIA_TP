<x-guest-layout>
    <div class="mb-6 text-center">
        <i class="fa-solid fa-key text-4xl text-green-600 mb-3"></i>
        <h1 class="text-2xl font-bold text-gray-800">{{ __('Récupération de mot de passe') }}</h1>
    </div>

    <div class="mb-6 text-sm text-gray-700 bg-gray-50 p-4 rounded-lg border-l-4 border-green-600">
        {{ __('Vous avez oublié votre mot de passe pour accéder à votre compte de suivi de colis ? Pas de problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation qui vous permettra d\'en choisir un nouveau.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Adresse e-mail')" />
            <div class="mt-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-envelope text-gray-400"></i>
                </div>
                <x-input-field id="email" class="pl-10" type="email" name="email" :value="old('email')" autofocus
                    placeholder="votreemail@exemple.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}" class="text-sm cursor-pointer text-green-600 hover:text-green-800 flex items-center">
                <i class="fa-solid fa-arrow-left mr-1"></i>
                {{ __('Retour à la connexion') }}
            </a>

            <x-primary-button>
                <i class="fa-solid fa-paper-plane mr-2"></i>
                {{ __('Envoyer le lien') }}
            </x-primary-button>
        </div>
    </form>

    {{-- <div class="mt-8 pt-6 border-t border-gray-200 text-center text-xs text-gray-500">
        <p>{{ __('Vous n\'avez pas encore de compte ?') }}
            <a href="{{ route('register') }}" class="text-green-600 hover:text-green-800 font-medium">
                {{ __('S\'inscrire') }}
            </a>
        </p>
    </div> --}}
</x-guest-layout>
