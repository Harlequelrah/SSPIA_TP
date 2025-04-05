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
            this.selectedUser = this.users[0];
        },
    
        goToPage(page) {
            if (page >= 1 && page <= this.pagination.last_page) {
                this.currentPage = page;
                // Normally here you’d fetch users for the new page
            }
        }
    }">
        <div class="flex items-center justify-between mb-6">
            <x-heading title="Gestion des agriculteurs" />
            <button @click="showForm = !showForm"
                class="bg-[#4a7c59] text-white px-3 py-2 rounded-lg cursor-pointer transition-all duration-200 hover:bg-green-900 active:bg-green-800">
                <i class="fa-solid fa-plus"></i>
                <span>Ajouter un agriculteur</span>
            </button>
        </div>

        <div x-show="showForm" x-transition @click.outside="showForm = false">
            @include('users.includes.create')
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow mt-4">
            <table class="w-full">
                <thead class="bg-[#4a7c59] divide-x-2 text-sm text-white">
                    <th class="uppercase px-3 py-2">ID</th>
                    <th class="uppercase px-3 py-2">Nom complet</th>
                    <th class="uppercase px-3 py-2">Téléphone</th>
                    <th class="uppercase px-3 py-2">E-mail</th>
                    <th class="uppercase px-3 py-2">Adresse</th>
                    <th class="uppercase px-3 py-2">Compte actif</th>
                    <th class="uppercase px-3 py-2">Actions</th>
                </thead>
                <tbody class="text-center">
                    <template x-for="user in users" :key="user.id">
                        <tr class="odd:bg-slate-200 even:bg-slate-50 text-sm"
                            :class="{ 'bg-green-100': selectedUser && selectedUser.id === user.id }">
                            <td class="px-3 py-2 text-slate-800" x-text="user.id"></td>
                            <td class="px-3 py-2 text-slate-800" x-text="user.name"></td>
                            <td class="px-3 py-2 text-slate-800" x-text="user.telephone"></td>
                            <td class="px-3 py-2 text-slate-800" x-text="user.email"></td>
                            <td class="px-3 py-2 text-slate-800" x-text="user.adresse"></td>
                            <td class="px-3 py-2 text-slate-800" x-text="user.actif ? 'OUI' : 'NON'"></td>
                            <td class="px-3 py-2 flex items-center justify-center space-x-3">
                                <button @click="selectedUser = user">
                                    <i class="fa-solid cursor-pointer fa-eye text-blue-600"></i>
                                </button>
                                <a href="#">
                                    <i class="fa-solid cursor-pointer fa-pencil text-amber-600"></i>
                                </a>
                                <a href="#">
                                    <i class="fa-solid cursor-pointer fa-trash-alt text-red-600"></i>
                                </a>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 flex items-center justify-between">
            <div class="text-sm text-gray-600">
                Affichage de
                <span x-text="(currentPage - 1) * pagination.per_page + 1"></span> à
                <span x-text="Math.min(currentPage * pagination.per_page, pagination.total)"></span>
                sur
                <span x-text="pagination.total"></span> utilisateurs
            </div>

            <div class="flex items-center space-x-1">
                <button @click="goToPage(currentPage - 1)" :disabled="currentPage <= 1"
                    :class="{ 'opacity-50 cursor-not-allowed': currentPage <= 1 }"
                    class="px-3 py-1 rounded border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <template x-for="page in Math.min(5, pagination.last_page)" :key="page">
                    <button @click="goToPage(page)"
                        :class="{
                            'bg-[#4a7c59] text-white px-2 py-1': currentPage === page,
                            'bg-white text-gray-700 hover:bg-green-50 px-3 py-1': currentPage !== page
                        }"
                        class="rounded-lg border cursor-pointer border-gray-400 text-sm font-medium">
                        <span x-text="page"></span>
                    </button>
                </template>

                <button @click="goToPage(currentPage + 1)" :disabled="currentPage >= pagination.last_page"
                    :class="{ 'opacity-50 cursor-not-allowed': currentPage >= pagination.last_page }"
                    class="px-3 py-1 rounded border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- User Details -->
        <div class="p-4 border rounded-lg bg-green-50 shadow mt-4" x-show="selectedUser" x-transition>
            <h2 class="text-xl font-bold text-[#4a7c59] mb-4">
                Détails de l'utilisateur <span x-text="selectedUser ? selectedUser.id : ''"></span>
            </h2>
            <ul class="space-y-2">
                <li><strong>ID:</strong> <span x-text="selectedUser.id"></span></li>
                <li><strong>Nom complet:</strong> <span x-text="selectedUser.name"></span></li>
                <li><strong>Nom d'utilisateur:</strong> <span x-text="selectedUser.username"></span></li>
                <li><strong>Téléphone:</strong> <span x-text="selectedUser.telephone"></span></li>
                <li><strong>Email:</strong> <span x-text="selectedUser.email"></span></li>
                <li><strong>Adresse:</strong> <span x-text="selectedUser.adresse"></span></li>
                <li><strong>Actif:</strong> <span x-text="selectedUser.actif ? 'OUI' : 'NON'"></span></li>
            </ul>
        </div>
    </div>
@endsection
