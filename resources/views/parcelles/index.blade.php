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

    $isAdmin = Auth::user()->role === App\Enums\RoleEnum::ADMIN;
@endphp
@section('content')
    <div class="mt-4" x-data="{
        showForm: {{ $errors->any() ? 'true' : 'false' }},
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
        @if (session('success'))
            <x-notification :message="session('success')" color="green" icon="fa-circle-check" />
        @elseif (session('error'))
            <x-notification :message="session('error')" color="red" icon="fa-circle-exclamation" />
        @endif


        <section class ="mb-5">
            <div class="w-full flex justify-between items-center">
                @auth
                    @if (!$isAdmin)
                        <x-heading title="Gestion des Parcelles" />
                        <x-primary-button class="space-x-2" @click="showForm = !showForm">
                            <i class="fa-solid fa-plus"></i>
                            <x-heading-small title="Nouvelle parcelles" class="text-white" />
                        </x-primary-button>
                    @else
                        <x-heading title="Liste des Parcelles" />
                    @endif
                @endauth
            </div>
        </section>
        <div x-show="showForm" x-transition class="mt-4" @click.outside="showForm = false">
            @include('parcelles.partials.create')
        </div>

        @include('parcelles.partials.plots-list', ['isAdmin' => $isAdmin])

        @include('parcelles.partials.detail-parcelles')
    </div>
@endsection
