<div x-show="activeTab === 'profile'" x-cloak class="p-8">
    <div class="flex items-start mb-8">
        <div class="relative group">
            <div
                class="w-20 h-20 rounded-full bg-gray-400 opacity-50 flex items-center justify-center text-white text-2xl font-bold mr-6 overflow-hidden">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            {{-- <div
                class="absolute inset-0 w-20 h-20 rounded-full bg-black bg-opacity-0 group-hover:bg-opacity-40 flex items-center justify-center transition duration-200 opacity-0 group-hover:opacity-100 cursor-pointer">
                <i class="fa-solid fa-camera-alt text-white"></i>
            </div> --}}
        </div>
        <div>
            <h2 class="text-xl font-semibold">{{ Auth::user()->name }}</h2>
            <p class="text-gray-500">{{ Auth::user()->email }}</p>
            {{-- <button class="mt-2 text-sm text-green-600 hover:text-green-800 flex items-center">
                <i class="fa-solid fa-camera-alt mr-1"></i>
                Changer la photo
            </button> --}}
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-x-10">
        <!-- Personal Information -->
        <div class="bg-white rounded-lg mb-8">
            <h3 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                <i class="fa-solid fa-user mr-2 text-green-600 text-md"></i>
                Informations personnelles
            </h3>
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-5"> @csrf
                @method('PUT')
                <div>
                    <x-input-label for="name" :value="__('Nom complet')" />
                    <x-input-field type="text" id="name" name="name" :value="old('name', Auth::user()->name)" />
                </div>
                <div>
                    <x-input-label for="email" :value="__('Adresse e-mail')" />
                    <x-input-field type="email" id="email" name="email" :value="old('email', Auth::user()->email)" />
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <x-input-label for="phone" :value="__('Numero de téléphone')" />
                    <x-input-field type="phone" id="phone" name="phone" :value="old('phone', Auth::user()->phone)" :placeholder="Auth::user()->phone ?? 'Non spécifié'" />
                    @error('phone')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label for="address" :value="__('Adresse')" />
                    <x-input-field type="text" id="address" name="address" :value="old('address', Auth::user()->address)" :placeholder="Auth::user()->address ?? 'Non spécifié'" />
                </div>
                <div>
                    <x-input-label for="username" :value="__('Nom d\'utilisateur')" />
                    <x-input-field type="text" id="username" name="username" :value="old('username', Auth::user()->username)"
                        :placeholder="Auth::user()->username ?? 'Non spécifié'" />
                    @error('username')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="pt-4">
                    <x-primary-button>
                        <i class="fa-solid fa-rotate mr-2 text-sm"></i>
                        Mettre à jour
                    </x-primary-button>
                </div>
            </form>
        </div>

        <!-- Password Change -->
        <div class="bg-white rounded-lg">
            <h3 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                <i class="fa-solid fa-lock text-md text-green-600 mr-2"></i>
                Changer de mot de passe
            </h3>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-5"> @csrf
                @method('PUT')
                <div>
                    <x-input-label for="current_password" :value="__('Mot de passe actuel')" />
                    <x-input-field type="password" id="current_password" name="current_password" />
                    @error('current_password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label for="new_password" :value="__('Nouveau mot de passe')" />
                    <x-input-field type="password" id="new_password" name="new_password" />
                    <p class="mt-1 text-xs text-gray-500">Minimum 8 caractères, avec au moins un chiffre et un
                        caractère spécial.</p>
                    @error('new_password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label for="new_password_confirmation" :value="__('Confirmer le nouveau mot de passe')" />
                    <x-input-field type="password" id="new_password_confirmation" name="new_password_confirmation" />
                    @error('new_password_confirmation')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="pt-4">
                    <x-primary-button>
                        <i class="fa-solid fa-key text-sm mr-2"></i>
                        Changer le mot de passe
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <!-- Account Danger Zone -->
    <div class="mt-6 border-t border-gray-200 pt-6">
        <h3 class="text-lg font-medium text-red-600 mb-4 flex items-center">
            <i class="fa-solid fa-triangle-exclamation mr-2"></i>
            Zone dangereuse
        </h3>
        <div class="bg-red-50 border border-red-100 rounded-lg p-4 flex justify-between items-center">
            <div>
                <h4 class="text-red-800 font-medium">Supprimer mon compte</h4>
                <p class="text-red-600 text-sm">Cette action est irréversible. Toutes vos données seront
                    supprimées définitivement.</p>
            </div>
            <x-danger-button x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="py-2">
                <i class="fa-solid fa-trash-alt"></i>
            </x-danger-button>
        </div>


        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()">
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6"> @csrf
                @method('delete')

                <x-heading
                    title="
                    {{ __('Êtes-vous sûr de vouloir supprimer votre compte?') }}
                " />
                <x-heading-small
                    title="
                {{ __('Une fois le compte supprimé, toutes vos données et resources seront supprimer permanament. Entrez votre mot de passe pour confirmer que vous voulez vraiment supprimer votre compte.') }}" />

                <div class="mt-6">
                    <x-input-label for="password" value="{{ __('Mot de passe') }}" class="sr-only" />

                    <x-input-field id="password" name="password" type="password"
                        placeholder="{{ __('Mot de passe') }}" />

                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close-modal', 'confirm-user-deletion')">
                        {{ __('Annuler') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        {{ __('Supprimer') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </div>
</div>
