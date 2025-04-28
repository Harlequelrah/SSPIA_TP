<div class="bg-teal-600 p-4 shadow-lg flex justify-between items-center">
    <div class="flex items-center">
        <button @click="openSidebar = !openSidebar" class="md:hidden bg-teal-700 hover:bg-teal-800 p-2 rounded-md cursor-pointer transition-colors duration-200">
            <i class="fa-solid fa-bars text-white"></i>
        </button>
        <h1 class="text-white font-medium text-xl ml-4 capitalize tracking-wide">
            @yield('title')
        </h1>
    </div>

    <div class="flex items-center space-x-4">
        @php
            $currentUserName = auth()->user()->name;
            $initials = \App\Helpers\AppHelpers::initials($currentUserName);
        @endphp

            <!-- User menu -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" @click.away="open = false" class="cursor-pointer bg-teal-700/30 hover:bg-teal-700/50 px-4 py-2 rounded-full flex items-center transition-all duration-200">
                <div class="bg-teal-800 text-teal-100 w-8 h-8 flex items-center justify-center rounded-full font-medium shadow-inner">
                    {{ $initials }}
                </div>
                <span class="text-white font-medium ml-3"> {{ $currentUserName }} </span>
                <i class="fa-solid fa-chevron-down text-xs ml-2 text-teal-200 transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
            </button>

            <!-- Dropdown menu -->
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute right-0 mt-2 w-60 rounded-lg bg-white shadow-lg ring-1 focus:outline-none z-50"
                 style="display: none;">
                <div class="p-4 border-b border-gray-100">
                    <p class="text-sm font-medium text-gray-900">{{ $currentUserName }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                </div>
                <div class="py-2">
                    <a href="{{ route('parametres.index') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-700">
                        <i class="fa-solid fa-user-edit w-5 mr-3 text-gray-400"></i>
                        Modifier mon profil
                    </a>

                    @if (auth()->user()->role === App\Enums\RoleEnum::ADMIN)
                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-700">
                            <i class="fa-solid fa-shield-alt w-5 mr-3 text-gray-400"></i>
                            Administration
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
