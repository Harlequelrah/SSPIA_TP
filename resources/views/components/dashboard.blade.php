{{-- composant dashboard --}}
@props([
    'isAdmin',
    'interventions',
    'plots',
    'plotsInCulture',
    'plotsHarvested',
    'plotsInFallow',
    'totalPlots',
    'totalCultivatedArea',
    'interventionTypesCount',
    'recentInterventions',
    'cultureTypes',
    'needAttentionPlots',
    'latestInterventions',
    'interventionsByMonth',
])

<div class="p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 ">
        <!-- Donut Chart - Statut des parcelles -->
        <div class="bg-white rounded-lg p-5 h-80">
            <x-heading class="mb-3" title="Status des parcelles" />
            <div class="h-64">
                <canvas id="plotStatusChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Bar Chart - Type d'intervention -->
        <div class="bg-white rounded-lg p-5 h-80">
            <x-heading class="mb-3" title="Status des interventions" />
            <div class="h-60">
                <canvas id="interventionTypeChart" class="w-full h-full"></canvas>
            </div>
        </div>
    </div>

    {{-- État général --}}
    <div class="flex flex-col justify-around md:flex-row mb-10 gap-4">
        <x-dashboard-card title="{{ $isAdmin ? 'Parcelles totales' : 'Mes parcelles' }}" count="{{ $totalPlots }}"
            class="border-green-500" />
        <x-dashboard-card title="{{ $isAdmin ? 'Interventions totales' : 'Mes interventions' }}"
            count="{{ $interventions->count() }}" class="border-amber-500" />
        <x-dashboard-card title="Surface cultivée" count="{{ $totalCultivatedArea }} ha" class="border-blue-500" />
        <x-dashboard-card title="Parcelles nécessitant attention" count="{{ $needAttentionPlots->count() }}"
            class="border-red-500" />
    </div>

    {{-- Message de bienvenue pour les nouveaux utilisateurs agriculteurs --}}
    @if ($totalPlots === 0 && !$isAdmin)
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6" role="alert">
            <p class="font-bold">Bienvenue dans votre tableau de bord !</p>
            <p>Pour commencer, ajoutez votre première parcelle en cliquant sur le bouton "Ajouter une parcelle"
                ci-dessous.</p>
            <div class="mt-4">
                <a href="{{ route('parcelles.index') }}"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded duration-200 transition-colors">
                    Ajouter une parcelle
                </a>
            </div>
        </div>
    @endif

    {{-- Message d'information pour les administrateurs --}}
    @if ($isAdmin)
        <div class="bg-amber-50 border-l-4 border-amber-500 text-amber-700 p-4 mb-6" role="alert">
            <p class="font-bold">Mode administrateur</p>
            <p>Vous visualisez l'ensemble des données du système. En tant qu'administrateur, vous pouvez consulter
                toutes les parcelles et interventions mais vous ne pouvez pas en ajouter.</p>
        </div>
    @endif

    {{-- Graphiques et statistiques --}}
    @if ($totalPlots > 0 || $isAdmin)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            {{-- Répartition des statuts de parcelles --}}
            <div class="bg-white rounded-lg shadow-lg p-6">
                <x-heading title="Répartion des parcelles" />
                <div class="flex items-center justify-center h-64">
                    @if ($totalPlots > 0)
                        <div class="flex items-center justify-around w-full">
                            <div class="text-center">
                                <div class="w-32 h-32 rounded-full bg-green-500 flex items-center justify-center">
                                    <span class="text-white text-2xl font-bold">{{ $plotsInCulture }}</span>
                                </div>
                                <p class="mt-2 font-medium">{{ App\Enums\StatusEnum::EN_C }}</p>
                            </div>
                            <div class="text-center">
                                <div class="w-32 h-32 rounded-full bg-amber-500 flex items-center justify-center">
                                    <span class="text-white text-2xl font-bold">{{ $plotsInFallow }}</span>
                                </div>
                                <p class="mt-2 font-medium">{{ App\Enums\StatusEnum::EN_J }}</p>
                            </div>
                            <div class="text-center">
                                <div class="w-32 h-32 rounded-full bg-gray-400 flex items-center justify-center">
                                    <span class="text-white text-2xl font-bold">{{ $plotsHarvested }}</span>
                                </div>
                                <p class="mt-2 font-medium">{{ App\Enums\StatusEnum::RCLT }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500 italic">Aucune donnée disponible</p>
                    @endif
                </div>
            </div>

            {{-- Types d'interventions --}}
            <div class="bg-white rounded-lg shadow-lg p-6">
                <x-heading title="Types d'interventions" />
                <div class="h-64">
                    @if ($interventions->count() > 0)
                        <div class="flex flex-col h-full justify-center">
                            @foreach ($interventionTypesCount as $type => $count)
                                <div class="mb-3">
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm font-medium">{{ $type }}</span>
                                        <span class="text-sm font-medium">{{ $count }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-green-600 h-3 rounded-full"
                                            style="width: {{ $count > 0 ? ($count / $interventions->count()) * 100 : 0 }}%">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="flex items-center justify-center h-full">
                            <p class="text-gray-500 italic">Aucune intervention enregistrée</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            {{-- Parcelles nécessitant attention --}}
            <div class="bg-white rounded-lg shadow-lg p-6">
                <x-heading title="Parcelles nécessitant attention" />
                <div class="overflow-x-auto">
                    @if ($needAttentionPlots->count() > 0)
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th
                                        class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nom</th>
                                    <th
                                        class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Culture</th>
                                    @if ($isAdmin)
                                        <th
                                            class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Agriculteur</th>
                                    @endif
                                    <th
                                        class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($needAttentionPlots as $plot)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $plot->name }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $plot->crop_type }}</td>
                                        @if ($isAdmin)
                                            <td class="py-2 px-4 border-b border-gray-200">
                                                {{ $plot->user->name ?? 'N/A' }}</td>
                                        @endif
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            <a href="{{ route('parcelles.index', $plot->id) }}"
                                                class="text-blue-600 hover:text-blue-900">Voir détails</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-green-600 flex items-center h-64 justify-center py-4">
                            @if ($isAdmin)
                                <p> Aucune parcelle ne nécessite d'attention pour le moment</p>
                            @else
                                Toutes vos parcelles sont à jour !
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            {{-- Dernières interventions --}}
            <div class="bg-white rounded-lg shadow-lg p-6">
                <x-heading title="Dernières interventions" />
                <div class="overflow-x-auto">
                    @if ($latestInterventions->count() > 0)
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th
                                        class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date</th>
                                    <th
                                        class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Parcelle</th>
                                    @if ($isAdmin)
                                        <th
                                            class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Agriculteur</th>
                                    @endif
                                    <th
                                        class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestInterventions as $intervention)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            {{ \Carbon\Carbon::parse($intervention->date)->format('d/m/Y') }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            {{ $plots->firstWhere('id', $intervention->plot_id)->name ?? 'N/A' }}</td>
                                        @if ($isAdmin)
                                            <td class="py-2 px-4 border-b border-gray-200">
                                                {{ $plots->firstWhere('id', $intervention->plot_id)->user->name ?? 'N/A' }}
                                            </td>
                                        @endif
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if ($intervention->intervention_type == 'Semis') bg-green-100 text-green-800
                                                @elseif($intervention->intervention_type == 'Arrosage') bg-blue-100 text-blue-800
                                                @elseif($intervention->intervention_type == 'Fertilisation') bg-yellow-100 text-yellow-800
                                                @elseif($intervention->intervention_type == 'Traitement') bg-purple-100 text-purple-800
                                                @elseif($intervention->intervention_type == 'Récolte') bg-red-100 text-red-800 @endif">
                                                {{ $intervention->intervention_type }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500 italic text-center py-4">Aucune intervention enregistrée</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Section pour les statistiques supplémentaires admin --}}
        @if ($isAdmin)
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <x-heading title="Statistique système" class="mb-3" />
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {{-- Mois avec le plus d'interventions --}}
                    <div>
                        <h3 class="text-lg font-medium mb-3">Mois les plus actifs</h3>
                        @if ($interventionsByMonth->count() > 0)
                            <ul class="space-y-2">
                                @foreach ($interventionsByMonth as $month)
                                    <li class="flex justify-between">
                                        <span>{{ $month['month'] }}</span>
                                        <span class="font-semibold">{{ $month['count'] }} interventions</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 italic">Aucune donnée disponible</p>
                        @endif
                    </div>

                    {{-- Répartition globale des cultures --}}
                    <div>
                        <h3 class="text-lg font-medium mb-3">Répartition globale des cultures</h3>
                        @if ($cultureTypes->count() > 0)
                            <div class="space-y-2">
                                @foreach ($cultureTypes as $type => $count)
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span>{{ $type ?: 'Non spécifié' }}</span>
                                            <span class="font-semibold">{{ $count }} parcelles</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-600 h-2 rounded-full"
                                                style="width: {{ ($count / $totalPlots) * 100 }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">Aucune donnée disponible</p>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
            {{-- Carte des parcelles (placeholder) --}}
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Carte des parcelles</h2>
                <div class="bg-gray-100 h-64 rounded-lg flex items-center justify-center">
                    @if ($totalPlots > 0)
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">Carte interactive en cours de développement</p>
                        </div>
                    @else
                        <p class="text-gray-500 italic">Ajoutez des parcelles pour visualiser la carte</p>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- Actions rapides (uniquement pour les agriculteurs) --}}
    @if (!$isAdmin)
        <div class="mt-8">
            <x-heading title="Action rapide" class="mb-3" />
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('parcelles.index') }}"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Ajouter une parcelle
                </a>
                <a href="{{ route('parcelles.index') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Voir toutes les parcelles
                </a>
                @if ($totalPlots > 0)
                    <a href="{{ route('interventions.index') }}"
                        class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Ajouter une intervention
                    </a>
                @endif
            </div>
        </div>
    @else
        {{-- Actions pour administrateurs (consultation uniquement) --}}
        <div class="mt-8">
            <x-heading title="Navigation administrateur" class="mb-3" />
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('parcelles.index') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Consulter toutes les parcelles
                </a>
                <a href="{{ route('interventions.index') }}"
                    class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Consulter toutes les interventions
                </a>
                <a href="{{ route('users.index') }}"
                    class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Gérer les utilisateurs
                </a>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const plotStatusChartEl = document.getElementById('plotStatusChart');
            const interventionTypeChartEl = document.getElementById('interventionTypeChart');

            if (plotStatusChartEl) {
                const ctx = plotStatusChartEl.getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['En culture', 'Récoltées', 'En jachère'],
                        datasets: [{
                            data: [{{ $plotsInCulture }}, {{ $plotsHarvested }},
                                {{ $plotsInFallow }}
                            ],
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(255, 159, 64, 0.6)',
                                'rgba(201, 203, 207, 0.6)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(201, 203, 207, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }

            if (interventionTypeChartEl && @json($interventionTypesCount->values()->count() > 0)) {
                const ctx = interventionTypeChartEl.getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: @json($interventionTypesCount->keys()),
                        datasets: [{
                            label: 'Nombre d\'interventions',
                            data: @json($interventionTypesCount->values()),
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                precision: 0
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush
