@props([
'title' => '',
'count' => '',
'activeMenu' => ''
])

<div class="flex flex-col justify-center items-center space-y-4 bg-green-50 rounded-lg shadow-md p-4 w-[350px] h-[150px] hover:scale-105 transition-all duration-200">
    <h1 class="font-bold text-2xl">{{ $title }}</h1>
    <span class="text-3xl font-bold text-[#4a7c59]">{{ $count }}</span>
    <div @click="activeMenu = '{{ $activeMenu }}'" class="text-green-800 flex items-center space-x-2 cursor-pointer transition-all duration-200 active:scale-105">
        <x-text-small title="Voir détail" class="underline" />
        <i class="fa-solid fa-arrow-right"></i>
    </div>
</div>