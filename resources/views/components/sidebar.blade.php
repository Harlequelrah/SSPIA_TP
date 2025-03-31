<div class="bg-[#4a7c59] md:flex-col h-screen w-80 p-4 hidden md:flex">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
        <img src="{{ URL('storage/logo.jpg') }}" alt="logo" class="w-10 h-10">
        <x-heading title="SSPIA" class="text-white" />
    </div>

    <hr class="my-5 text-white">

    <!-- Menu -->
    <ul class="p-4 space-y-3">
        @foreach([
            'home' => 'Tableau de bord',
            'bolt' => 'Interventions',
            'landmark' => 'Parcelles',
            'users' => 'Agriculteurs'
        ] as $icon => $label)
            <li @click="activeMenu = '{{ $icon }}'"
                class="flex items-center space-x-2 px-3 py-2 rounded-lg transition hover:bg-slate-100 hover:text-black cursor-pointer"
                :class="{ 'bg-green-100 text-black': activeMenu === '{{ $icon }}', 'text-white': activeMenu !== '{{ $icon }}' }">
                <i class="fa-solid fa-{{ $icon }}"></i>
                <span class="font-medium text-md">{{ $label }}</span>
            </li>
        @endforeach
    </ul>

    <!-- Paramètres -->
    <div @click="activeMenu = 'gear'"
         class="mt-auto mx-4 mb-4 cursor-pointer px-3 py-2 rounded-lg transition hover:bg-slate-100 hover:text-black"
         :class="{ 'bg-green-100 text-black': activeMenu === 'gear', 'text-white': activeMenu !== 'gear' }">
        <i class="fa-solid fa-gear"></i>
        <span class="font-semibold text-md">Paramètres</span>
    </div>
</div>
