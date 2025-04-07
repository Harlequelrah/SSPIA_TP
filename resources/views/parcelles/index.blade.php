@extends('app_layout')

@section('title', 'Mes Parcelles')

@section('header', 'Liste des Parcelles')

@php
    $plots = [
        (object) [
            'id' => 1,
            'name' => 'Parcelle Nord',
            'area' => '25',
            'crop_type' => 'Blé',
            'plantation_date' => '2024-06-06',
            'status' => 'En jachère',
            'user' => 'Uche',
        ],
    ];

    $pagination = [
        'current_page' => 1,
        'last_page' => 3,
        'per_page' => 10,
        'total' => 21,
    ];
@endphp
@section('content')
    <div class="mt-4" x-data="{
        showForm: false,
        plots: {{ json_encode($plots) }},
        pagination: {{ json_encode($pagination) }},
        currentPage: {{ $pagination['current_page'] }},
        selectedPlot: null,

        init() {
            this.selectedPlot = this.plots[this.plots.length - 1];
        },

        goToPage(page) {
            if (page >= 1 && page <= this.pagination.last_page) {
                this.currentPage = page;
            }
        }
    }">
        <section class ="mb-5">
            <div class="w-full flex justify-between items-center">
                <x-heading title="Liste des parcelles" />
                <x-primary-button class="space-x-2" @click="showForm = !showForm">
                    <i class="fa-solid fa-plus"></i>
                    <x-heading-small title="Nouvelle Parcelle" class="text-white" />
                </x-primary-button>
            </div>
        </section>
        <div x-show="showForm" x-transition class="mt-4" @click.outside="showForm = false">
            @include('parcelles.partials.create')
        </div>

        @include('parcelles.partials.plots-list')
    </div>
@endsection
