<div class="bg-[#4a7c59] md:flex-col h-screen w-96 hidden md:flex" :class="{ 'hidden md:block': !openSidebar, 'block md:hidden': openSidebar }">
    <div class="p-4 flex space-x-2 items-center">
        <img src="{{ URL('storage/logo.jpg') }}" alt="logo" class="w-10 h-10">
        <x-heading title="SSPIA" class="text-white" />
    </div>
    <hr class="my-5 text-white">
    <div class="p-4">
        <ul>
            @foreach([
            'home' => 'Tableau de bord',
            'bolt' => 'Interventions',
            'landmark' => 'Parcelles',
            'users' => 'Utilisateurs'
            ] as $icon => $label)
            <li @click="activeMenu = '{{ $icon }}'"
                :class="{ 'bg-green-100 text-black': activeMenu === '{{ $icon }}', 
                             'text-white': activeMenu !== '{{ $icon }}' }"
                class="mb-3 flex items-center space-x-2 cursor-pointer px-3 py-2 rounded-lg duration-150 transition-all hover:bg-slate-100 hover:text-black">
                <x-icon :name="$icon" :show="true" />
                <span class="font-medium text-lg">{{ $label }}</span>
            </li>
            @endforeach
        </ul>
    </div>
    <div @click="activeMenu = 'gear'" :class="{'bg-green-100 text-black': activeMenu === 'gear', 'text-white': activeMenu !== 'gear'}" class="mt-auto mx-4 mb-4 cursor-pointer text-white px-3 py-2 rounded-lg duration-150 transition-all hover:bg-slate-100 hover:text-black">
        <x-icon name="gear" />
        <span class="font-semibold text-lg">Paramètres</span>
    </div>
</div>