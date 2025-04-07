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
    <div class="mt-4" x-data="{
        showForm: false,
        selectedIntervention: null,
        interventions: {{ json_encode($interventions) }},
        pagination: {{ json_encode($pagination) }},
        currentPage: {{ $pagination['current_page'] }},
    
        init() {
            // Selectionner la dernière intervention par défaut
            this.selectedIntervention = this.interventions[this.interventions.length - 1];
        },
    
        goToPage(page) {
            if (page >= 1 && page <= this.pagination.last_page) {
                this.currentPage = page;
    
            }
        }
    }">
        <section class="mb-5">
            <div class="w-full flex justify-between items-center">
                <x-heading title="Liste des interventions" />
                <x-primary-button class="space-x-2" @click="showForm = !showForm">
                    <i class="fa-solid fa-plus"></i>
                    <x-heading-small title="Nouvelle Intervention" class="text-white" />
                </x-primary-button>
            </div>
        </section>
        <div x-show="showForm" x-transition class="mt-4" @click.outside="showForm = false">
            @include('interventions.partials.create')
        </div>

        @include('interventions.partials.search-bar')
        
        <!-- Intervention List -->
        @include('interventions.partials.interventions-list')

        @include('interventions.partials.details-intervention')
    </div>
@endsection
