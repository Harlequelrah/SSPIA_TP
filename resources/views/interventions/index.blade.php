@extends('app_layout')

@section('title', 'Interventions')

@section('header', 'Historique des Interventions')
@php
    $interventions = [
        (object) [
            'id' => 1,
            'parcelle' => 'Parcelle Nord',
            'type' => 'Semis',
            'date' => '15-03-2024',
            'description' => 'Irrigation',
            'quantite' => '25 kg/ha',
        ],
        (object) [
            'id' => 2,
            'parcelle' => 'Parcelle Sud',
            'type' => 'Récolte',
            'date' => '20-03-2024',
            'description' => 'Récolte manuelle',
            'quantite' => '40 kg/ha',
        ],
    ];

    // Pagination configuration (normally you'd get this from a paginator)
$pagination = [
    'current_page' => 1,
    'last_page' => 5,
    'per_page' => 10,
    'total' => 45,
    ];
@endphp
@section('content')
    <div class="mt-4 p-4" x-data="{
        showForm: false,
        selectedIntervention: null,
        interventions: {{ json_encode($interventions) }},
        pagination: {{ json_encode($pagination) }},
        currentPage: {{ $pagination['current_page'] }},
    
        init() {
            // Selectionner la dernière intervention par défaut
            this.selectedIntervention = this.interventions[-1];
        },
    
        goToPage(page) {
            if (page >= 1 && page <= this.pagination.last_page) {
                this.currentPage = page;
    
            }
        }
    }">
        @include('interventions.includes.search-bar')
        <section class="mb-5">
            <div class="w-full flex justify-between items-center">
                <x-heading title="Liste des interventions" />
                <button @click="showForm = !showForm"
                    class="bg-[#4a7c59] px-3 py-2 rounded-lg text-white cursor-pointer duration-200 transition-all hover:bg-green-800 active:bg-green-700 active:scale-90">
                    <i class="fa-solid fa-plus"></i>
                    <span class="font-semibold" x-text="'Nouvelle Intervention'"></span>
                </button>
            </div>
        </section>
        <div x-show="showForm" x-transition class="mt-4">
            @include('interventions.create')
        </div>

        <!-- Intervention List -->
        <div class="overflow-x-auto bg-white rounded-lg shadow mt-4">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-[#4a7c59] text-white">
                        <th class="py-2 px-4 text-left">ID</th>
                        <th class="py-2 px-4 text-left">Parcelle</th>
                        <th class="py-2 px-4 text-left">Type</th>
                        <th class="py-2 px-4 text-left">Date</th>
                        <th class="py-2 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="even:bg-slate-50 odd:bg-slate-500">
                    <template x-for="intervention in interventions" :key="intervention.id">
                        <tr class="border-b transition-colors"
                            :class="{ 'bg-green-100': selectedIntervention && selectedIntervention.id === intervention.id }">
                            <td class="py-2 px-4" x-text="intervention.id"></td>
                            <td class="py-2 px-4" x-text="intervention.parcelle"></td>
                            <td class="py-2 px-4" x-text="intervention.type"></td>
                            <td class="py-2 px-4" x-text="intervention.date"></td>
                            <td class="py-2 px-4 space-x-4">
                                <button @click="selectedIntervention = intervention"
                                    class="text-blue-600 hover:text-blue-800 cursor-pointer">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <a href="#">
                                    <i class="fa-solid fa-pencil-alt text-amber-600"></i>
                                </a>
                                <a href="#">
                                    <i class="fa-solid fa-trash-alt text-red-500"></i>
                                </a>
                            </td>
                        </tr>
                    </template>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="py-3 px-4">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-500">
                                    Affichage de <span x-text="(currentPage - 1) * pagination.per_page + 1"></span> à
                                    <span x-text="Math.min(currentPage * pagination.per_page, pagination.total)"></span>
                                    sur <span x-text="pagination.total"></span> interventions
                                </div>
                                <div class="flex items-center space-x-1">
                                    <!-- Previous Page Button -->
                                    <button @click="goToPage(currentPage - 1)" :disabled="currentPage <= 1"
                                        :class="{ 'opacity-50 cursor-not-allowed': currentPage <= 1 }"
                                        class="px-3 py-1 rounded border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </button>

                                    <!-- Page Numbers -->
                                    <template x-for="page in Math.min(5, pagination.last_page)" :key="page">
                                        <button @click="goToPage(page)"
                                            :class="{ 'bg-[#4a7c59] text-white px-2 py-1': currentPage ===
                                                page, 'bg-white text-gray-700 hover:bg-green-50 px-3 py-1': currentPage !==
                                                    page }"
                                            class="rounded-lg border cursor-pointer border-gray-400 text-sm font-medium">
                                            <span x-text="page"></span>
                                        </button>
                                    </template>

                                    <!-- Last Page Button (if there are many pages) -->
                                    <button @click="goToPage(pagination.last_page)"
                                        :class="{ 'bg-[#4a7c59] text-white': currentPage === pagination
                                            .last_page, 'bg-white text-gray-700 hover:bg-gray-50': currentPage !==
                                                pagination.last_page }"
                                        class="px-3 py-1 rounded border border-gray-300 text-sm font-medium"
                                        x-show="pagination.last_page > 5">
                                        <span x-text="pagination.last_page"></span>
                                    </button>

                                    <!-- Next Page Button -->
                                    <button @click="goToPage(currentPage + 1)"
                                        :disabled="currentPage >= pagination.last_page"
                                        :class="{ 'opacity-50 cursor-not-allowed': currentPage >= pagination.last_page }"
                                        class="px-3 py-1 rounded border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Intervention Details -->
        <div class="p-4 border rounded-lg bg-green-50 shadow mt-4" x-show="selectedIntervention">
            <h2 class="text-xl font-bold text-[#4a7c59] mb-4">
                Détails de l'intervention <span x-text="selectedIntervention ? selectedIntervention.id : ''"></span>
            </h2>
            <ul class="space-y-2">
                <li><strong>ID:</strong> <span x-text="selectedIntervention ? selectedIntervention.id : ''"></span></li>
                <li><strong>Parcelle:</strong> <span
                        x-text="selectedIntervention ? selectedIntervention.parcelle : ''"></span></li>
                <li><strong>Type:</strong> <span x-text="selectedIntervention ? selectedIntervention.type : ''"></span></li>
                <li><strong>Date:</strong> <span x-text="selectedIntervention ? selectedIntervention.date : ''"></span></li>
                <li><strong>Description:</strong> <span
                        x-text="selectedIntervention ? selectedIntervention.description : ''"></span></li>
                <li><strong>Quantité:</strong> <span
                        x-text="selectedIntervention ? selectedIntervention.quantite : ''"></span></li>
            </ul>
        </div>
    </div>
@endsection
