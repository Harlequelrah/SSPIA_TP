<div class="p-4 bg-[#4a7c59] w-full flex justify-between items-center">
    <button @click="console.log(openSidebar = !openSidebar)" class="md:hidden bg-[#4a7c59] cursor-pointer">
        <x-icon name="bars" :show="true" :class="'text-white text-2xl'" />
    </button>

    <div class="flex items-center space-x-2">
        <x-icon name="table-columns" class="text-white" />
        <h1 class="text-white font-semibold text-xl">Tableau de bord</h1>
    </div>
    <div class="flex items-center space-x-2 text-white">
        <p class="bg-green-900 w-8 h-8 flex items-center justify-center rounded-full font-semibold">JD</p>
        <h1 class="text-lg font-bold">Jean Doe</h1>
    </div>
</div>