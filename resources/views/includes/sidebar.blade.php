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
                    <x-sidebar-item route="dashboard.index" active="dashboard" icon="fa-home" label="Tableau de bord" />
                    <x-sidebar-item route="parcelles.index" active="parcelles.*" icon="fa-landmark" label="Parcelles" />
                    <x-sidebar-item route="interventions.index" active="interventions.*" icon="fa-bolt"
                        label="Interventions" />
                    <x-sidebar-item route="users.index" active="users.*" icon="fa-user" label="Utilisateurs" />
                </div>
            </ul>
        </nav>
    </div>

    {{-- Logout en bas --}}
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a class="px-4 py-2 bg-red-300 text-white w-full rounded-lg flex items-center duration-200 transition-color justify-center mt-4 hover:bg-red-500"
            href="{{ route('logout') }}"
            onclick="event.preventDefault(); this.closest('form').submit();">
            <i class="fa-solid fa-sign-out mr-2"></i>
            {{ __('Se déconnecter') }}
        </a>
    </form>
</aside>
