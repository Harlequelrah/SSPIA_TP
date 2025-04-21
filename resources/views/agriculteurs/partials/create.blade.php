<div class="bg-white p-4 rounded-lg shadow-md mb-6">
    <x-heading-small title="Ajouter un agriculteur" class="mb-4 font-semibold text-lg" />
    <form method="post" action="{{ route('agriculteurs.store') }}">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="fistName" :value="__('Prénoms')" />
                <x-input-field name="firstName" id="firstName" type="text" :placeholder="'Ex: Jean'"
                    value="{{ old('firstName') }}" />
                @error('firstName')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <x-input-label for="lastName" :value="__('Nom de famille')" />
                <x-input-field name="lastName" id="lastName" type="text" :placeholder="'Ex: Dupont'"
                    value="{{ old('lastName') }}" />
                @error('lastName')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <x-input-label for="userName" :value="__('Nom d\'agriculteur')" />
                <x-input-field name="userName" id="userName" type="text" :placeholder="'Ex: JeanD'"
                    value="{{ old('userName') }}" />
                @error('userName')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <x-input-label for="phone" :value="__('Numéro de téléphone')" />
                <x-input-field name="phone" id="phone" type="text" :placeholder="'Ex: 71234567'"
                    value="{{ old('phone') }}" />
                @error('phone')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <x-input-label for="email" :value="__('E-mail')" />
                <x-input-field name="email" id="email" type="email" :placeholder="'Ex: jean@example.com'"
                    value="{{ old('email') }}" />
                @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <x-input-label for="address" :value="__('Adresse')" />
                <x-input-field name="address" id="address" type="text" :placeholder="'Ex: Lomé, Togo'"
                    value="{{ old('address') }}" />
                @error('address')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <div class="flex space-x-3 items-center justify-center mt-1 w" x-data="{ obscuredText: true }">
                <x-input-field id="password" class="w-full" x-bind:type="obscuredText ? 'password' : 'text'"
                    name="password" />
                <i :class="obscuredText ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"
                    class="cursor-pointer text-gray-500" @click="obscuredText = !obscuredText">
                </i>
            </div>
            @error('password')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="w-full flex justify-end space-x-2 mt-4">
            <x-secondary-button>Annuler</x-secondary-button>
            <x-primary-button>Ajouter</x-primary-button>
        </div>
    </form>
</div>
