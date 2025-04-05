<div class="p-4 bg-[#4a7c59] w-full flex justify-between items-center">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Se déconnecter</button>
    </form>
    <button @click="openSidebar = !openSidebar" class="md:hidden bg-[#4a7c59] cursor-pointer">
        <i class="fa-solid fa-bars text-xl text-slate-100"></i>
    </button>


    <div class="flex items-center">
        <h1 class="text-white font-semibold text-xl capitalize">
            @yield('title')
        </h1>
    </div>
    <div class="flex items-center space-x-2 text-white">
        <p class="bg-green-900 w-8 h-8 flex items-center justify-center rounded-full font-semibold">JD</p>
        <h1 class="text-lg font-bold">Jean Doe</h1>
    </div>
</div>
