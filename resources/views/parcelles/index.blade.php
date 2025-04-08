@extends('app_layout')

@section('title', 'Mes Parcelles')

@section('header', 'Liste des Parcelles')

@php
    $pagination = [
        'current_page' => $plots->currentPage(),
        'last_page' => $plots->lastPage(),
        'per_page' => $plots->perPage(),
        'total' => $plots->total(),
    ];
@endphp
@section('content')
    <div class="mt-4" x-data="{
        showForm: true,
        plots: {{ json_encode($plots->items()) }},
        pagination: {{ json_encode($pagination) }},
        currentPage: {{ $pagination['current_page'] }},
        selectedPlot: null,
    
        init() {
            this.selectedPlot = this.plots[0];
        },
    
        goToPage(page) {
            if (page >= 1 && page <= this.pagination.last_page) {
                this.currentPage = page;
            }
        }
    }">
        <section class ="mb-5">
            <div class="w-full flex justify-between items-center">
                <x-heading title="Gestion des parcelles" />
                {{-- <x-primary-button class="space-x-2" @click="showForm = !showForm">
                    <i class="fa-solid fa-plus"></i>
                    <x-heading-small title="Nouvelle Parcelle" class="text-white" />
                </x-primary-button> --}}
            </div>
        </section>
        <div x-show="showForm" x-transition class="mt-4">
            @include('parcelles.partials.create')
        </div>

        @include('parcelles.partials.plots-list')
    </div>
@endsection
