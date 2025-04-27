@extends('app_layout')

@section('title', 'Utilisateur #' . $agriculteur->id)

@php
    use App\Enums\RoleEnum;
    $isAdmin = Auth::user()->role == RoleEnum::ADMIN; // Vérifie si l'agriculteur est un administrateur
@endphp

@section('content')

    @if (session('success'))
        <x-notification :message="session('success')" color="green" icon="fa-circle-check" />
    @elseif (session('error'))
        <x-notification :message="session('error')" color="red" icon="fa-circle-exclamation" />
    @endif

    <div x-data="{ showEditForm: false }"
        class="p-6 border rounded-lg bg-gradient-to-r from-green-50 to-green-100 shadow-md mt-4 max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-[#4a7c59]">
                Détails de l'agriculteur <span class="text-green-700">#{{ $agriculteur->id }}</span>
            </h2>

            @if ($isAdmin)
                <!-- Si l'agriculteur n'est pas admin, afficher le bouton Modifier -->
                <button @click="showEditForm = !showEditForm"
                    :class="showEditForm ? 'bg-red-600 hover:bg-red-700' : 'bg-[#4a7c59] hover:bg-green-700'"
                    class="px-4 py-2 text-white rounded-md flex items-center transition duration-200 space-x-2 cursor-pointer">
                    <i class="block" :class="showEditForm ? 'fa-solid fa-xmark' : 'fa-solid fa-pencil'"></i>
                    <span class="block" x-text="showEditForm ? 'Annuler' : 'Modifier'"></span>
                </button>
            @endif
        </div>

        {{-- Mode Affichage --}}
        <div x-show="!showEditForm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6 mb-4">
                <x-info-card title="Nom complet" :value="$agriculteur->name" />

                <x-info-card title="Nom d'agriculteur" :value="$agriculteur->username ?? 'Non renseigné'" />

                <x-info-card title="Email" :value="$agriculteur->email" />

                <x-info-card title="Téléphone" :value="$agriculteur->phone ?? 'Non renseigné'" />

                <x-info-card title="Adresse" :value="$agriculteur->address ?? 'Non renseignée'" />

                <x-info-card title="Actif" :value="!$agriculteur->deleted_at ? 'OUI' : 'NON'" />

                @if ($isAdmin)
                    <!-- Champs visibles uniquement pour les administrateurs -->
                    <x-info-card title="Créé le" :value="$agriculteur->created_at?->format('d/m/Y H:i')" />

                    <x-info-card title="Mis à jour le" :value="$agriculteur->updated_at?->format('d/m/Y H:i')" />

                    <x-info-card title="Supprimé le" :value="$agriculteur->deleted_at?->format('d/m/Y H:i') ?: 'Non supprimé'" />

                    <x-info-card title="Rôle" :value="$agriculteur->role ?? 'Non défini'" />
                @endif
            </div>
        </div>

        {{-- Mode Édition --}}
        @if ($isAdmin)
            <!-- Seuls les non-administrateurs peuvent modifier -->
            <div x-show="showEditForm">
                <form method="POST" action="{{ route('agriculteurs.update', $agriculteur) }}">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="user_id" value="{{ $agriculteur->id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6 mt-4 mb-4">
                        <x-info-card title="Nom complet">
                            <x-input-field id="name" name="name" :value="$agriculteur->name"
                                class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:border-green-500" />
                        </x-info-card>

                        <x-info-card title="Nom d'agriculteur">
                            <x-input-field id="username" name="username" :value="$agriculteur->username"
                                class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:border-green-500" />
                        </x-info-card>

                        <x-info-card title="Email">
                            <x-input-field type="email" id="email" name="email" :value="$agriculteur->email"
                                class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:border-green-500" />
                        </x-info-card>

                        <x-info-card title="Téléphone">
                            <x-input-field type="tel" id="phone" name="phone" :value="$agriculteur->phone"
                                class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:border-green-500" />
                        </x-info-card>

                        <x-info-card title="Adresse">
                            <x-input-field type="text" id="address" name="address" :value="$agriculteur->address"
                                class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:border-green-500" />
                        </x-info-card>
                    </div>

                    <div class="md:col-span-2 flex justify-end gap-3 mt-4">
                        <x-secondary-button @click="showEditForm = false">Annuler</x-secondary-button>
                        <x-primary-button>Enregistrer les modifications</x-primary-button>
                    </div>
                </form>
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('agriculteurs.index') }}"
                class="inline-flex items-center px-4 py-2 bg-[#4a7c59] text-white text-sm font-medium rounded hover:bg-[#3b6348] transition">
                <i class="fa-solid fa-arrow-left mr-2"></i> Retour à la liste
            </a>
        </div>
    </div>
@endsection
