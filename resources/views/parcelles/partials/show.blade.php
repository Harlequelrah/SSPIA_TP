@extends('app_layout')

@section('title', 'Parcelle #' . $plot->id)

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
                Détails de la parcelle <span class="text-green-700">#{{ $plot->id }}</span>
            </h2>
            @if (!$isAdmin)
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
                <x-info-card title="Nom" :value="$plot->name" />

                <x-info-card title="Superficie" :value="$plot->area . ' hectare'" />

                <x-info-card title="Type de culture" :value="$plot->crop_type" />

                <x-info-card title="Date de plantation" :value="$plot->plantation_date" />

                <x-info-card title="Statut" :value="$plot->status" />

                @if ($isAdmin)
                    <!-- Champs visibles uniquement pour les administrateurs -->
                    <x-info-card title="Créé le" :value="$plot->created_at?->format('d/m/Y H:i')" />

                    <x-info-card title="Mis à jour le" :value="$plot->updated_at?->format('d/m/Y H:i')" />

                    <x-info-card title="Supprimé le" :value="$plot->deleted_at?->format('d/m/Y H:i') ?: 'Non supprimé'" />

                    <x-info-card title="Agriculteur" :value="$plot->user?->name ?? 'Non attribué'" />
                @endif
            </div>
        </div>

        {{-- Mode Édition --}}
        @if (!$isAdmin)
            <!-- Seuls les non-administrateurs peuvent modifier -->
            <div x-show="showEditForm">
                <form method="POST" action="{{ route('parcelles.update', $plot) }}">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="plot_id" value="{{ $plot->id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6 mt-4 mb-4">

                        <x-info-card title="name">
                            <x-input-field id="name" name="name" :value="$plot->name"
                                class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:border-green-500" />
                        </x-info-card>

                        <x-info-card title="Superficie">
                            <x-input-field id="area" name="area" :value="$plot->area"
                                class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:border-green-500" />
                        </x-info-card>

                        <x-info-card title="Date de plantation">
                            <x-input-field type="date" id="plantation_date" name="plantation_date" :value="$plot->plantation_date"
                                class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:border-green-500" />
                        </x-info-card>

                        <x-info-card title="Type de culture">
                            <x-input-field type="text" id="crop_type" name="crop_type" :value="$plot->crop_type"
                                class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:border-green-500" />
                        </x-info-card>

                        <x-info-card title="Statut">
                            <x-input-field type="text" id="status" name="status" :value="$plot->status"
                                class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:border-green-500" />
                        </x-info-card>
                    </div>

                    <div class="md:col-span-2 flex justify-end gap-3 mt-4">
                        <x-secondary-button @click="showEditForm = false">Annuler</x-secondary-button>
                        <x-primary-button type="submit">Enregistrer les modifications</x-primary-button>
                    </div>
                </form>
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('parcelles.index') }}"
                class="inline-flex items-center px-4 py-2 bg-[#4a7c59] text-white text-sm font-medium rounded hover:bg-[#3b6348] transition">
                <i class="fa-solid fa-arrow-left mr-2"></i> Retour à la liste
            </a>
        </div>
    </div>
@endsection
