@php
    $currentUserName = auth()->user()->name;
    $initials = \App\Helpers\AppHelpers::initials($currentUserName);
@endphp

<div class="p-4 bg-green-800 w-full flex rounded-br-4xl shadow-xl justify-between items-center">
  
    <button @click="openSidebar = !openSidebar" class="md:hidden bg-[#4a7c59] cursor-pointer">
        <i class="fa-solid fa-bars text-xl text-slate-100"></i>
    </button>


    <div class="flex items-center">
        <h1 class="text-white font-semibold text-xl capitalize">
            @yield('title')
        </h1>
    </div>
    <div class="flex items-center space-x-2 text-white">
        <p class="bg-green-900 w-8 h-8 flex items-center justify-center rounded-full font-semibold">{{ $initials }}
        </p>
        <h1 class="text-lg font-bold"> {{ $currentUserName }} </h1>
    </div>
</div>
