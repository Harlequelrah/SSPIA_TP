<section class="bg-slate-50 mb-5" x-data="{
    searchQuery: '{{ request('search', '') }}',
    showFilters: false,
    filters: {
        name: '{{ request('name', '') }}',
        userName: '{{ request('userName', '') }}',
        phone: '{{ request('phone', '') }}',
        email: '{{ request('email', '') }}',
        address: '{{ request('address', '') }}'
    },
    resetFilters() {
        this.filters = {
            name: '',
            userName: '',
            phone: '',
            email: '',
            address: ''
        };
    }
}">
    <form x-ref="form" action="{{ route('agriculteurs.index') }}" method="GET">
        <div class="bg-white">
            <div class="flex flex-col space-y-3">
                <!-- Barre de recherche principale -->
                <div class="flex items-center gap-2">
                    <div class="w-96">
                        <x-input-field x-model="searchQuery" type="search" name="search" id="search"
                            placeholder="Rechercher un utilisateur" />
                    </div>
                    <button type="button" @click="showFilters = !showFilters"
                        class="inline-flex items-center px-4 py-3 bg-white border border-green-300 rounded-md font-semibold text-xs text-green-700 tracking-widest shadow-sm hover:bg-green-50 focus:outline-none disabled:opacity-25 cursor-pointer transition ease-in-out duration-150">
                        <i class="fa-solid fa-filter"></i>
                        <span class="text-sm ml-1"
                            x-text="showFilters ? 'Masquer les filtres' : 'Filtres avancés'"></span>
                    </button>
                </div>

                <!-- Filtres avancés -->
                <div x-show="showFilters" x-transition
                    class="bg-white p-4 rounded-lg shadow-md border border-slate-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <!-- Nom complete -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Prénom</label>
                            <input type="text" id="name" name="name" x-model="filters.name"
                                class="w-full p-2 border rounded-md border-slate-300 focus:border-green-500 focus:outline-none text-sm"
                                placeholder="Nom complet de l'utilisateur">
                        </div>

                        <!-- Nom d'utilisateur -->
                        <div>
                            <label for="userName" class="block text-sm font-medium text-slate-700 mb-1">Nom d'utilisateur</label>
                            <input type="text" id="userName" name="userName" x-model="filters.userName"
                                class="w-full p-2 border rounded-md border-slate-300 focus:border-green-500 focus:outline-none text-sm"
                                placeholder="Nom d'utilisateur">
                        </div>

                        <!-- Téléphone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-slate-700 mb-1">Téléphone</label>
                            <input type="text" id="phone" name="phone" x-model="filters.phone"
                                class="w-full p-2 border rounded-md border-slate-300 focus:border-green-500 focus:outline-none text-sm"
                                placeholder="Numéro de téléphone">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                            <input type="email" id="email" name="email" x-model="filters.email"
                                class="w-full p-2 border rounded-md border-slate-300 focus:border-green-500 focus:outline-none text-sm"
                                placeholder="Adresse email">
                        </div>

                        <!-- Adresse -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-slate-700 mb-1">Adresse</label>
                            <input type="text" id="address" name="address" x-model="filters.address"
                                class="w-full p-2 border rounded-md border-slate-300 focus:border-green-500 focus:outline-none text-sm"
                                placeholder="Adresse">
                        </div>
                    </div>

                    <div class="flex items-end gap-4">
                        <x-secondary-button type="button" @click="resetFilters()">
                            Réinitialiser
                        </x-secondary-button>
                        <x-primary-button type="submit">
                            Appliquer les filtres
                        </x-primary-button>
                    </div>
                </div>
            </div>

            <!-- Filtres actifs -->
            <div x-show="Object.values(filters).some(val => val !== '') || searchQuery !== ''"
                class="flex flex-wrap items-center gap-2 py-2">
                <span class="text-sm font-medium text-slate-700">Filtres actifs:</span>

                <template x-if="searchQuery">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-sm bg-green-100 text-green-800">
                        Recherche: <span x-text="searchQuery" class="font-medium ml-1"></span>
                        <button type="button" @click="searchQuery = '';"
                            class="ml-1 text-green-600 hover:text-green-800">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    </span>
                </template>

                <template x-if="filters.firstName">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-sm bg-green-100 text-green-800">
                        Prénom: <span x-text="filters.firstName" class="font-medium ml-1"></span>
                        <button type="button" @click="filters.firstName = '';"
                            class="ml-1 text-green-600 hover:text-green-800">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    </span>
                </template>

                <template x-if="filters.lastName">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-sm bg-green-100 text-green-800">
                        Nom: <span x-text="filters.lastName" class="font-medium ml-1"></span>
                        <button type="button" @click="filters.lastName = '';"
                            class="ml-1 text-green-600 hover:text-green-800">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    </span>
                </template>

                <template x-if="filters.userName">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-sm bg-green-100 text-green-800">
                        Nom d'utilisateur: <span x-text="filters.userName" class="font-medium ml-1"></span>
                        <button type="button" @click="filters.userName = '';"
                            class="ml-1 text-green-600 hover:text-green-800">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    </span>
                </template>

                <template x-if="filters.phone">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-sm bg-green-100 text-green-800">
                        Téléphone: <span x-text="filters.phone" class="font-medium ml-1"></span>
                        <button type="button" @click="filters.phone = '';"
                            class="ml-1 text-green-600 hover:text-green-800">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    </span>
                </template>

                <template x-if="filters.email">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-sm bg-green-100 text-green-800">
                        Email: <span x-text="filters.email" class="font-medium ml-1"></span>
                        <button type="button" @click="filters.email = '';"
                            class="ml-1 text-green-600 hover:text-green-800">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    </span>
                </template>

                <template x-if="filters.address">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-sm bg-green-100 text-green-800">
                        Adresse: <span x-text="filters.address" class="font-medium ml-1"></span>
                        <button type="button" @click="filters.address = '';"
                            class="ml-1 text-green-600 hover:text-green-800">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    </span>
                </template>

                <button type="button" @click="searchQuery = ''; resetFilters();"
                    class="text-sm cursor-pointer text-slate-600 hover:text-slate-800 underline">
                    Effacer tous les filtres
                </button>
            </div>
        </div>
    </form>
</section>
