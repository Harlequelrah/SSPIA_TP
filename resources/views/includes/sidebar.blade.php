<aside class="bg-[#4a7c59] md:flex-col h-screen w-80 p-4 hidden md:flex flex-col justify-between">
    <div>
        {{-- logo --}}
        <div class="flex items-center space-x-2">
            <img src="{{ URL('assets/logo.jpg') }}" alt="logo" class="w-10 h-10">
            <x-heading title="SSPIA" class="text-white" />
        </div>
        <hr class="my-5 text-white">

        {{-- navigation --}}
        <nav>
            <ul>
                <div>
                    <x-sidebar-item route="dashboard" active="dashboard" icon="fa-home" label="Tableau de bord" />
                    <x-sidebar-item route="plots.index" active="plots.*" icon="fa-landmark" label="Parcelles" />
                    <x-sidebar-item route="interventions.index" active="interventions.*" icon="fa-bolt"
                        label="Interventions" />
                    @auth
                        @if (auth()->user()->role === App\Enums\RoleEnum::ADMIN)
                            <x-sidebar-item route="agriculteurs.index" active="agriculteurs.*" icon="fa-user"
                                label="Utilisateurs" />
                        @endif
                    @endauth
                </div>
            </ul>
        </nav>
    </div>

    {{-- Logout en bas --}}
    <div x-data>
        <!-- Bouton pour ouvrir le modal -->
        <a x-on:click="$dispatch('open-modal', 'confirm-logout'), console.log('Uche')"
            class="px-4 py-2 bg-red-300 text-white w-full rounded-lg flex items-center duration-200 transition-color justify-center mt-4 hover:bg-red-500 cursor-pointer">
            <i class="fa-solid fa-sign-out mr-2"></i>
            {{ __('Se déconnecter') }}
        </a>


        <!-- Modal de confirmation pour la déconnexion -->
        <x-modal name="confirm-logout" maxWidth="md">
            <div class="p-6">
                <h2 class="text-lg font-medium text-red-900">
                    Déconnectez-vous
                </h2>
                <p class="mt-1 text-sm text-slate-600">
                    Voulez-vous vraiment vous déconnecter ?
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button
                        x-on:click="$dispatch('close-modal', 'confirm-logout')">Annuler</x-secondary-button>

                    <form method="POST" action="{{ route('logout') }}" class="ml-3">
                        @csrf
                        <x-primary-button class="bg-red-500 hover:bg-red-600 transition duration-200 focus:bg-red-700"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Oui
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </x-modal>

    </div>

</aside>
