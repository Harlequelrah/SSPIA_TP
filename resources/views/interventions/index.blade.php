@extends('app_layout')

@section('title', 'Interventions')

@section('header', 'Historique des Interventions')
@php
    $pagination = [
        'current_page' => $interventions->currentPage(),
        'last_page' => $interventions->lastPage(),
        'per_page' => $interventions->perPage(),
        'total' => $interventions->total(),
    ];
@endphp
@section('content')
    <div class="p-4 relative h-full" x-data="{
        showForm: false,
        selectedIntervention: null,
        interventions: {{ json_encode($interventions->items()) }},
        pagination: {{ json_encode($pagination) }},
        currentPage: {{ $pagination['current_page'] }},
    
        init() {
            if (this.interventions.length) {
                this.selectedIntervention = this.interventions.last;
            }
        },
    
        selectIntervention(item) {
            this.selectedIntervention = item;
        }
    }">
        @if (session('success'))
            <x-notification message='{{ session('success') }}' color="green" icon='fa-circle-check' />
        @else
            <x-notification message='{{ session('error') }}' color="red" icon='fa-circle-exclamation' />
        @endif


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
            @include('interventions.create', ['plots' => $plots])
        </div>

        <!-- Intervention List -->

        @include('interventions.includes.search-bar')

        <div class="overflow-x-auto bg-white rounded-lg shadow mt-4">
            <table class="min-w-full bg-white" id="interventions">
                <thead>
                    <tr class="bg-[#4a7c59] text-white">
                        <th class="py-2 px-4 text-left">ID</th>
                        <th class="py-2 px-4 text-left">Parcelle</th>
                        <th class="py-2 px-4 text-left">Type</th>
                        <th class="py-2 px-4 text-left">Date</th>
                        <th class="py-2 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- When there are interventions -->
                    <template x-if="interventions.length !== 0">
                        <template x-for="intervention in interventions" :key="intervention.id">
                            <tr class="cursor-pointer" @click="selectIntervention(intervention)"
                                :class="{ 'bg-green-200': selectedIntervention && selectedIntervention.id === intervention.id }">
                                <td class="py-2 px-4" x-text="intervention.id"></td>
                                <td class="py-2 px-4" x-text="intervention.parcelle"></td>
                                <td class="py-2 px-4" x-text="intervention.type"></td>
                                <td class="py-2 px-4" x-text="intervention.date"></td>
                                <td class="py-2 px-4">
                                    <i class="fa-solid fa-eye text-blue-600"></i>
                                </td>
                            </tr>
                        </template>
                    </template>
                    <template x-if="interventions.length === 0">
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500 italic">
                                Aucune intervention trouvée.
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
                                            :class="{
                                                'bg-[#4a7c59] text-white px-2 py-1': currentPage ===
                                                    page,
                                                'bg-white text-gray-700 hover:bg-green-50 px-3 py-1': currentPage !==
                                                    page
                                            }"
                                            class="rounded-lg border cursor-pointer border-gray-400 text-sm font-medium">
                                            <span x-text="page"></span>
                                        </button>
                                    </template>

                                    <!-- Last Page Button (if there are many pages) -->
                                    <button @click="goToPage(pagination.last_page)"
                                        :class="{
                                            'bg-[#4a7c59] text-white': currentPage === pagination
                                                .last_page,
                                            'bg-white text-gray-700 hover:bg-gray-50': currentPage !==
                                                pagination.last_page
                                        }"
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
