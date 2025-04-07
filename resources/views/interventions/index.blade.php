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
    <div class="mt-4" x-data="{
        showForm: false,
        selectedIntervention: null,
        interventions: {{ json_encode($interventions->items()) }},
        pagination: {{ json_encode($pagination) }},
        currentPage: {{ $pagination['current_page'] }},

        init() {
            // Selectionner la dernière intervention par défaut
            this.selectedIntervention = this.interventions[this.interventions.length - 1];
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
