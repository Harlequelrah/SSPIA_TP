@extends('app_layout')

@section('title', 'Utilisateurs')

@section('header', 'Utilisateur')

@php

    $pagination = [
        'current_page' => $agriculteurs->currentPage(),
        'last_page' => $agriculteurs->lastPage(),
        'per_page' => $agriculteurs->perPage(),
        'total' => $agriculteurs->total(),
    ];
@endphp

@section('content')
    <div class="mt-4" x-data="{
        showForm: {{ $errors->any() ? 'true' : 'false' }},
        users: {{ json_encode($agriculteurs->items()) }},
        pagination: {{ json_encode($pagination) }},
        currentPage: {{ $pagination['current_page'] }},
        selectedUser: null,
    
        init() {
            this.selectedUser = this.users[this.users.length - 1];
        },
    
        goToPage(page) {
            if (page >= 1 && page <= this.pagination.last_page) {
                this.currentPage = page;
            }
        }
    }">
        <div class="flex items-center justify-between mb-6">
            <x-heading title="Gestion des agriculteurs" />
            <x-primary-button class="space-x-2" @click="showForm = !showForm">
                <i class="fa-solid fa-plus"></i>
                <x-heading-small title="Nouveau utilisateur" class="text-white" />
            </x-primary-button>
        </div>

        <div x-show="showForm" x-transition @click.outside="showForm = false">
            @include('agriculteurs.partials.create')
        </div>

        @include('agriculteurs.partials.users-list')

    </div>
@endsection
