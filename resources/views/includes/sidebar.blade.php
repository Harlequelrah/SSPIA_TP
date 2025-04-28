<div class="sticky top-0 h-screen">
    <aside class="bg-gradient-to-b from-teal-700 to-teal-800 h-screen md:flex-col w-72 shadow-2xl hidden md:flex flex-col justify-between">
        <div>
            <!-- Logo -->
            <div class="flex items-center px-6 pt-8 pb-6 border-b border-teal-600/30">
                <img src="{{ URL('assets/logo.jpg') }}" alt="logo" class="w-12 h-12 rounded-xl shadow-lg ring-2 ring-white/20">
                <div class="ml-3">
                    <h1 class="text-2xl font-bold text-white tracking-wide">SSPIA</h1>
                    <p class="text-xs text-teal-200/80 font-light tracking-wider">Système de Suivi des Parcelles</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="mt-8 px-4">
                <ul class="space-y-1.5">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-teal-600/50 shadow-md' : '' }}">
                            <i class="fa-solid fa-home w-5 text-center mr-3 {{ request()->routeIs('dashboard') ? 'text-teal-200' : 'text-teal-300' }}"></i>
                            <span class="{{ request()->routeIs('dashboard') ? 'font-medium' : 'font-light' }}">Tableau de bord</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('plots.index') }}" class="flex items-center px-4 py-3 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('plots.*') ? 'bg-teal-600/50 shadow-md' : '' }}">
                            <i class="fa-solid fa-landmark w-5 text-center mr-3 {{ request()->routeIs('plots.*') ? 'text-teal-200' : 'text-teal-300' }}"></i>
                            <span class="{{ request()->routeIs('plots.*') ? 'font-medium' : 'font-light' }}">Parcelles</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('interventions.index') }}" class="flex items-center px-4 py-3 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('interventions.*') ? 'bg-teal-600/50 shadow-md' : '' }}">
                            <i class="fa-solid fa-bolt w-5 text-center mr-3 {{ request()->routeIs('interventions.*') ? 'text-teal-200' : 'text-teal-300' }}"></i>
                            <span class="{{ request()->routeIs('interventions.*') ? 'font-medium' : 'font-light' }}">Interventions</span>
                        </a>
                    </li>
                    @auth
                        @if (auth()->user()->role === App\Enums\RoleEnum::ADMIN)
                            <li>
                                <a href="{{ route('agriculteurs.index') }}" class="flex items-center px-4 py-3 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('agriculteurs.*') ? 'bg-teal-600/50 shadow-md' : '' }}">
                                    <i class="fa-solid fa-user w-5 text-center mr-3 {{ request()->routeIs('agriculteurs.*') ? 'text-teal-200' : 'text-teal-300' }}"></i>
                                    <span class="{{ request()->routeIs('agriculteurs.*') ? 'font-medium' : 'font-light' }}">Utilisateurs</span>
                                </a>
                            </li>
                        @endif
                    @endauth
                    <li>
                        <a href="{{ route('parametres.index') }}" class="flex items-center px-4 py-3 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('parametres.*') ? 'bg-teal-600/50 shadow-md' : '' }}">
                            <i class="fa-solid fa-gear w-5 text-center mr-3 {{ request()->routeIs('parametres.*') ? 'text-teal-200' : 'text-teal-300' }}"></i>
                            <span class="{{ request()->routeIs('parametres.*') ? 'font-medium' : 'font-light' }}">Paramètres</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>


      <div class="px-4 py-3">
          <x-logout
              class="w-full cursor-pointer bg-red-400/20 hover:bg-red-500 text-white py-3 px-4 rounded-lg flex items-center justify-center space-x-2 transition-all duration-300" />
      </div>
    </aside>
</div>
