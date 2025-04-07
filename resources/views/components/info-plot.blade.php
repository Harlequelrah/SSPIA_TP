@props([
    'name' => 'Parcelle',
    'status' => 'En culture',
    'size' => '0 hectareq',
    'crop' => 'Culture inconnue',
    'plantationDate' => 'Date inconnue',
])

<div class="bg-slate-100 w-[380px] px-4 py-3 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-4">
        <x-heading-small :title="$name" class="font-bold" />
        <span class="bg-green-100 text-[#4a7c59] block text-sm rounded-full px-2 py-1">{{ $status }}</span>
    </div>
    <div class="flex flex-col space-y-3 mb-4">
        <div class="flex items-center space-x-2">
            <i class="fa-solid fa-ruler-combined text-[#4a7c59] text-md"></i>
            <p class="font-semibold">Superficie:</p>
            <p>{{ $size }}</p>
        </div>
        <div class="flex items-center space-x-2">
            <i class="fa-solid fa-seedling text-[#4a7c59] text-md"></i>
            <p class="font-semibold">Culture:</p>
            <p>{{ $crop }}</p>
        </div>
        <div class="flex items-center space-x-2">
            <i class="fa-solid fa-database text-[#4a7c59] text-md"></i>
            <p class="font-semibold">Plantation:</p>
            <p>{{ $plantationDate }}</p>
        </div>
    </div>
    <div class="flex items-center justify-between lg:gap-3 md:gap-3">
        <button class="text-green-800 flex items-center justify-center space-x-1 cursor-pointer">
            <i class="fa-solid fa-eye"></i>
            <p class="text-md hidden lg:block md:block ">Détails</p>
        </button>
        <button class="text-amber-800 flex items-center justify-center space-x-1 cursor-pointer">
            <i class="fa-solid fa-pencil"></i>
            <p class="text-md hidden lg:block md:block ">Modifier</p>
        </button>
        <button class="text-red-800 flex items-center justify-center space-x-1 cursor-pointer">
            <i class="fa-solid fa-trash"></i>
            <p class="text-md hidden lg:block md:block ">Supprimer</p>
        </button>
    </div>
</div>
