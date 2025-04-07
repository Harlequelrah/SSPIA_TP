@extends('app_layout')

@section('title', 'Utilisateurs')

@section('header', 'Utilisateur')

@php
    $users = [
        (object) [
            'id' => 1,
            'name' => 'Uche Lekwauwa',
            'username' => 'Uche',
            'telephone' => '71610653',
            'email' => 'uche@gmail.com',
            'adresse' => 'Bè-kpota',
            'actif' => true,
        ],
        (object) [
            'id' => 2,
            'name' => 'Uche',
            'username' => 'Klau',
            'telephone' => '71610658',
            'email' => 'uche@gmail.com',
            'adresse' => 'Bè-kpota',
            'actif' => false,
        ],
        (object) [
            'id' => 3,
            'name' => 'hanoukopé',
            'username' => 'haha',

            'telephone' => '78520003',
            'email' => 'hanakop@gmail.com',
            'adresse' => 'Bè',
            'actif' => true,
        ],
        (object) [
            'id' => 4,
            'name' => 'afangbédzi',
            'username' => 'aefaef',

            'telephone' => '70610653',
            'email' => 'uche@gmail.com',
            'adresse' => 'Bè-kpota',
            'actif' => false,
        ],
        // Tu peux ajouter d'autres utilisateurs ici
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
        users: {{ json_encode($users) }},
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
            @include('users.partials.create')
        </div>

        @include('users.partials.users-list')

        @include('users.partials.details-user')
    </div>
@endsection
