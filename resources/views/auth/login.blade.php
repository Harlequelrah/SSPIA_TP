<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="flex flex-col items-center justify-center">
                <img src="{{ URL('storage/logo.jpg') }}" alt="logo" class="w-25 h-25">
                <x-heading-small class="text-center my-4"
                    title="Système de Suivi des plots et des Interventions Agricole" />
            </div>

            <div class="mb-4">
                <x-input-label for="email" :value="__('E-mail')" />
                <x-input-field id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- mot de passe --}}
            <div class="mb-4">
                <x-input-label for="password" :value="__('Mot de passe')" />
                <div class="flex space-x-3 items-center justify-center mt-1 w" x-data="{ obscuredText: true }">
                    <x-input-field id="password" class="w-full" type="password" name="password" required
                        autocomplete="current-password" />
                    <i :class="obscuredText ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"
                        class="cursor-pointer text-gray-500" @click="obscuredText = !obscuredText">
                    </i>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

            </div>

            <button type="submit"
                class="w-full bg-[#4a7c59] text-white p-2 mt-4 rounded-lg cursor-pointer transition-all duration-200 hover:bg-green-800 mb-4">Connexion</button>
            <div class="w-full flex items-center justify-center">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-[#4a7c59] text-center" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié?') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
</x-guest-layout>
