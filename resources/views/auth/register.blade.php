<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="">
        @csrf
        <h1 class="mb-4 text-2xl font-bold">Crée un compte admin</h1>
        <div class="grid grid-cols-2 gap-4 mb-3">
            <!-- Name -->

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-input-field id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="">
                <x-input-label for="email" :value="__('E-mail')" />
                <x-input-field id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <!-- Username -->
        <div class="mb-3">
            <x-input-label for="username" :value="__('Username')" />
            <x-input-field id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mb-3">
            <label for="role">Rôle</label>
            <select id="role" name="role"
                class="block mt-1 w-full w-full p-2 border rounded-md border-slate-400 bg-slate-200 focus:bg-white focus:border-green-500 focus:outline-none"
                required>
                @foreach (\App\Enums\RoleEnum::cases() as $role)
                    <option value="{{ $role->value }}" {{ old('role') === $role->value ? 'selected' : '' }}>
                        {{ $role->value }}
                    </option>
                @endforeach
            </select>
            @error('role')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />
            <x-input-field id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-input-field id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center ">
            <button type="submit"
                class="w-full bg-[#4a7c59] text-white p-2  rounded-lg cursor-pointer transition-all duration-200 hover:bg-green-800 mb-4">{{ __('Créer un compte') }}
            </button>
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Déjà enregistré?') }}
            </a>
        </div>
    </form>
</x-guest-layout>
