<aside class="bg-[#4a7c59] md:flex-col h-screen w-80 p-4 hidden md:flex">
    {{-- logo --}}
    <div class="flex items-center space-x-2">
        <img src="{{ URL('storage/logo.jpg') }}" alt="logo" class="w-10 h-10">
        <x-heading title="SSPIA" class="text-white" />
    </div>

    <hr class="my-5 text-white">

    {{-- navigation --}}
    <nav>
        <ul>
            <x-sidebar-item route="dashboard" active="dashboard" icon="fa-home" label="Tableau de bord" />
            <x-sidebar-item route="parcelles.index" active="parcelles.*" icon="fa-landmark" label="Parcelles" />
            <x-sidebar-item route="interventions.index" active="interventions.*" icon="fa-bolt" label="Interventions" />
            <x-sidebar-item route="users.index" active="users.*" icon="fa-user" label="Utilisateurs" />
        </ul>

    </nav>
</aside>
