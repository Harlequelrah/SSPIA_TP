<aside
    class="bg-green-800 md:flex-col h-screen w-80 p-4 hidden md:flex flex-col shadow-xl rounded-br-4xl justify-between">
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
                    <x-sidebar-item route="parametres.index" active="parametres.*" icon="fa-gear" label="Paramètres" />

                </div>
            </ul>
        </nav>
    </div>

    {{-- Logout en bas --}}
    <x-logout buttonClass="px-3 py-1 cursor-pointer text-white rounded hover:bg-red-500 transition duration-200"
        confirmBtnClass="bg-blue-600 hover:bg-blue-700" />
</aside>
