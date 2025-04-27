<section class="bg-slate-50 mb-5" x-data="{
    searchQuery: '{{ request('search', '') }}',
    showFilters: false,
    filters: {
        status: '{{ request('status', '') }}',
        date_from: '{{ request('date_from', '') }}',
    },

    resetFilters() {
        this.filters = {
            status: '',
            date_from: '',
        };
    }
}">
    <form x-ref="form" action="{{ route('plots.index') }}" method="GET" @submit="validateDates()">
        <div class="bg-green-50">
            <div class="flex flex-col space-y-3">
                <!-- Barre de recherche principale -->
                <div class="flex items-center gap-2">
                    <div class="w-96">
                        <x-input-field x-model="searchQuery" type="search" name="search" id="search"
                            placeholder="Rechercher une parcelle" />
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
                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-slate-700 mb-1">Statut</label>
                            <select id="status" name="status" x-model="filters.status"
                                class="w-full p-2 border rounded-md border-slate-300 focus:border-green-500 focus:outline-none text-sm">
                                <option value="">Tous les statuts</option>
                                @foreach (App\Enums\StatusEnum::values() as $status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date de plantation - Du -->
                        <div>
                            <label for="date_from" class="block text-sm font-medium text-slate-700 mb-1">Planté à partir
                                du</label>
                            <input type="date" id="date_from" name="date_from" x-model="filters.date_from"
                                class="w-full p-2 border rounded-md border-slate-300 focus:border-green-500 focus:outline-none text-sm">
                        </div>


                    </div>

                    <!-- Message d'erreur pour les dates -->
                    <div x-show="dateError" class="text-red-500 text-sm mb-4" x-text="dateError"></div>

                    <div class="flex items-end gap-4">
                        <x-secondary-button>
                            Réinitialiser
                        </x-secondary-button>
                        <x-primary-button>
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

                <template x-if="filters.status">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-sm bg-green-100 text-green-800">
                        Statut: <span x-text="filters.status" class="font-medium ml-1"></span>
                        <button type="button" @click="filters.status = '';"
                            class="ml-1 text-green-600 hover:text-green-800">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    </span>
                </template>

                <template x-if="filters.date_from">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-sm bg-green-100 text-green-800">
                        Plantation:
                        <span x-text="filters.date_from ? filters.date_from : 'début'" class="font-medium ml-1"></span>
                        <span class="mx-1">à</span>
                        <span x-text="Aujourd'hui" class="font-medium"></span>
                        <button type="button"
                            @click="filters.date_from = ''; filters.date_to = '';"
                            class="ml-1 text-green-600 hover:text-green-800">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    </span>
                </template>

                <button type="submit" @click="searchQuery = ''; resetFilters();"
                    class="text-sm cursor-pointer text-slate-600 hover:text-slate-800 underline">
                    Effacer tous les filtres
                </button>
            </div>
        </div>
    </form>
</section>
