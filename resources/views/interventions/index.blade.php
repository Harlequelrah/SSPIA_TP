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
    $canCreate = Auth::user()->role === App\Enums\RoleEnum::AGRICULTEUR;
    // dd($canCreate);
@endphp
@section('content')
    <div class="mt-4" x-data="{
        showForm: {{ $errors->any() ? 'true' : 'false' }},
        selectedIntervention: null,
        interventions: {{ json_encode($interventions->items()) }},
        pagination: {{ json_encode($pagination) }},
        currentPage: {{ $pagination['current_page'] }},
        searchQuery: '', // <-- ADD THIS
        selectIntervention(item) {
            this.selectedIntervention = item;
        },
        init() {
            this.selectedIntervention = this.interventions.length > 0 ? this.interventions[0] : null;
        },
        get filteredInterventions() {
            if (!this.searchQuery) {
                return this.interventions;
            }
            return this.interventions.filter((item) => {
                return (item.plot?.name?.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    item.type?.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    (item.date && item.date.includes(this.searchQuery)));
            });
        },
    }">

        @if (session('success'))
            <x-notification :message="session('success')" color="green" icon="fa-circle-check" />
        @elseif (session('error'))
            <x-notification :message="session('error')" color="red" icon="fa-circle-exclamation" />
        @endif


        <section class="mb-5">
            <div class="w-full flex justify-between items-center">
                @auth
                    @if ($canCreate)
                        <x-heading title="Gestion des interventions" />

                        <x-primary-button :show-loader="false" class="space-x-2" @click="showForm = !showForm">
                            <i class="fa-solid fa-plus"></i>
                            <x-heading-small title="Nouvelle Intervention" class="text-white" />
                        </x-primary-button>
                    @else
                        <x-heading title="Liste des interventions" />
                    @endif
                @endauth

            </div>
        </section>
        <div x-show="showForm" x-transition class="mt-4" @click.outside="showForm = false">
            @include('interventions.partials.create')
        </div>
        @include('interventions.partials.search-bar')

        <!-- Intervention List -->
        @include('interventions.partials.interventions-list')


    </div>

@endsection
