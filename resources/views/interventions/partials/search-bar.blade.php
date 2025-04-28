<section class="bg-slate-50 mb-5" x-data="{
    searchQuery: '{{ request('search', '') }}',
    showFilters: false,
    filters: {
        intervention_type: '{{ request('intervention_type', '') }}',
        plot_id: '{{ request('plot_id', '') }}',
        date_from: '{{ request('date_from', '') }}',
        product_used: '{{ request('product_used', '') }}'
    },
    resetFilters() {
        this.filters = {
            intervention_type: '',
            plot_id: '',
            date_from: '',
            product_used: ''
        };
    }
}">
    <form action="{{ route('interventions.index') }}" method="GET">
        <div class="bg-white">
            <div class="flex flex-col space-y-3">
                <!-- Barre de recherche principale -->
                <div class="flex items-center gap-2">
                    <div class="w-96">
                        <x-input-field x-model="searchQuery" type="search" name="search" id="search"
                            placeholder="Rechercher une intervention" />
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
                    <!-- Type d'intervention -->
                    <div class=" grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="intervention_type" class="block text-sm font-medium text-slate-700 mb-1">Type
                                d'intervention</label>
                            <select id="intervention_type" name="intervention_type" x-model="filters.intervention_type"
                                class="w-full p-2 border rounded-md border-slate-300 focus:border-green-500 focus:outline-none text-sm">
                                <option value="">Tous les types</option>
                                @foreach (App\Enums\InterventionTypeEnum::values() as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Parcelle -->
                        <div>
                            <label for="plot_id" class="block text-sm font-medium text-slate-700 mb-1">Parcelle</label>
                            <select id="plot_id" name="plot_id" x-model="filters.plot_id"
                                class="w-full p-2 border rounded-md border-slate-300 focus:border-green-500 focus:outline-none text-sm">
                                <option value="" disabled>
                                    {{ count($plots) == 0 ? 'Aucune parcelle' : 'Toutes les parcelles' }}</option>
                                @foreach ($plots as $plot)
                                    <option value="{{ $plot->id }}">{{ $plot->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Produit utilisé -->
                        <div>
                            <label for="product_used" class="block text-sm font-medium text-slate-700 mb-1">Produit
                                utilisé</label>
                            <input type="text" id="product_used" name="product_used" x-model="filters.product_used"
                                class="w-full p-2 border rounded-md border-slate-300 focus:border-green-500 focus:outline-none text-sm"
                                placeholder="Nom du produit...">
                        </div>

                        <!-- Période de dates -->

                        <div>
                            <label for="date_from" class="block text-sm font-medium text-slate-700 mb-1">A partir
                                du</label>
                            <input type="date" id="date_from" name="date_from" x-model="filters.date_from"
                                class="w-full p-2 border rounded-md border-slate-300 focus:border-green-500 focus:outline-none text-sm">
                        </div>

                    </div>
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
            <div x-show="Object.values(filters).some(val => val !== '')" class="flex flex-wrap items-center gap-2 py-2">
                <span class="text-sm font-medium text-slate-700">Filtres actifs:</span>

                <template x-if="filters.intervention_type">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-sm bg-green-100 text-green-800">
                        Type d'intervention: <span x-text="filters.intervention_type" class="font-medium ml-1"></span>
                        <button type="submit" @click="filters.intervention_type = ''"
                            class="ml-1 text-green-600 hover:text-green-800">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    </span>
                </template>

                <template x-if="filters.plot_id">
                    <span type="submit" class="inline-flex items-center px-2 py-1 rounded-full text-sm bg-green-100 text-green-800">
                        Parcelle: <span x-text="getPlotName(filters.plot_id)" class="font-medium ml-1"></span>
                        <button type="submit" @click="filters.plot_id = ''" class="ml-1 text-green-600 hover:text-green-800">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    </span>
                </template>

                <template x-if="filters.product_used">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-sm bg-green-100 text-green-800">
                        Produit: <span x-text="filters.product_used" class="font-medium ml-1"></span>
                        <button type="submit" @click="filters.product_used = ''" class="ml-1 text-green-600 hover:text-green-800">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    </span>
                </template>

                <template x-if="filters.date_from">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-sm bg-green-100 text-green-800">
                        Période:
                        <span x-text="filters.date_from ? filters.date_from : 'début'" class="font-medium ml-1"></span>
                        <span class="mx-1">à</span>
                        <span x-text="'Aujourd\'hui'" class="font-medium"></span>
                        <button type="submit" @click="filters.date_from = ''" class="ml-1 text-green-600 hover:text-green-800">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    </span>
                </template>

                <button type="submit" @click="resetFilters()"
                    class="text-sm cursor-pointer text-slate-600 hover:text-slate-800 underline">
                    Effacer tous les filtres
                </button>
            </div>
        </div>
    </form>
</section>
