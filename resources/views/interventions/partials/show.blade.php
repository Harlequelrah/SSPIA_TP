@extends('app_layout')

@section('title', 'Intervention #' . $intervention->id)

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
                Détails de l'intervention <span class="text-green-700">#{{ $intervention->id }}</span>
            </h2>

            @if (!$isAdmin)
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
                <x-info-card title="Parcelle" :value="$intervention->plot->name" />

                <x-info-card title="Type d'intervention">
                    <span
                        class="px-3 py-1 rounded-full text-sm font-medium
                {{ match ($intervention->intervention_type) {
                    'Semis' => 'bg-green-100 text-green-800',
                    'Arrosage' => 'bg-blue-100 text-blue-800',
                    'Fertilisation' => 'bg-yellow-100 text-yellow-800',
                    'Traitement' => 'bg-purple-100 text-purple-800',
                    'Récolte' => 'bg-red-100 text-red-800',
                    default => 'bg-gray-100 text-gray-800',
                } }}">
                        {{ $intervention->intervention_type }}
                    </span>
                </x-info-card>

                <x-info-card title="Date" :value="$intervention->intervention_date" />

                <x-info-card title="Quantité de produit utilisé" :value="$intervention->product_used_quantity && $intervention->unit
                    ? $intervention->product_used_quantity . ' ' . $intervention->unit->value
                    : 'Non spécifiée'" />

            </div>
            <x-info-card title="Nom du produit utilisé" :class="'w-full mb-4'">
                {{ old('product_used_name', $intervention->product_used_name ?? '') }}
            </x-info-card>

            <x-info-card title="Description" :class="'w-full'"
                value="{{ $intervention->description ?? 'Non spécifiée' }}"></x-info-card>
        </div>

        {{-- Mode Édition --}}
        @if (!$isAdmin)
            <div x-show="showEditForm">
                <form method="POST" action="{{ route('interventions.update', $intervention) }}">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="plot_id" value="{{ $intervention->plot->id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6 mt-4 mb-4">
                        <x-info-card title="Parcelle" :value="$intervention->plot->name" />

                        <x-info-card title="Type d'intervention">
                            <select id="intervention_type" name="intervention_type"
                                class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:border-green-500">
                                @foreach (App\Enums\InterventionTypeEnum::values() as $type)
                                    <option value="{{ $type }}" @selected($type == $intervention->intervention_type)>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                        </x-info-card>

                        <x-info-card title="Date">
                            <input type="date" id="intervention_date" name="intervention_date"
                                value="{{ $intervention->intervention_date }}"
                                class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:border-green-500">
                        </x-info-card>

                        <x-info-card title="Quantité de produit utilisé">
                            <div class="flex">
                                <input type="number" name="product_used_quantity" id="product_used_quantity"
                                    value="{{ $intervention->product_used_quantity }}"
                                    class="w-full p-2 border rounded-tl-sm rounded-bl-sm border-slate-400 bg-white focus:border-green-500 text-sm" />
                                <select name="unit" id="unit"
                                    class="w-20 text-center p-2 border rounded-tr-sm rounded-br-sm border-slate-400 bg-slate-200 focus:border-green-500 text-sm">
                                    @foreach (App\Enums\UnitEnum::values() as $type)
                                        <option value="{{ $type }}" @selected($type == $intervention->unit->value)>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('product_used_quantity')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </x-info-card>


                    </div>
                    <x-info-card title="Nom du produit utilisé" class="w-full">
                        <input type="text" id="product_used_name" name="product_used_name"
                            value="{{ old('product_used_name', $intervention->product_used_name ?? '') }}"
                            class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:border-green-500">
                    </x-info-card>

                    <x-info-card title="Description" class="md:col-span-2 w-full mt-4">
                        <textarea id="description" name="description" rows="4"
                            class="w-full p-2 border rounded-sm border-slate-400 bg-white resize-none focus:border-green-500"
                            placeholder="Ajoutez une description détaillée">{{ $intervention->description }}</textarea>
                    </x-info-card>

                    <div class="md:col-span-2 flex justify-end gap-3 mt-4">
                        <x-secondary-button @click="showEditForm = false">Annuler</x-secondary-button>
                        <x-primary-button type="submit">Enregistrer les modifications</x-primary-button>
                    </div>
                </form>
            </div>

        @endif

        <div class="mt-6">
            <a href="{{ route('interventions.index') }}"
                class="inline-flex items-center px-4 py-2 bg-[#4a7c59] text-white text-sm font-medium rounded hover:bg-[#3b6348] transition">
                <i class="fa-solid fa-arrow-left mr-2"></i> Retour à la liste
            </a>
        </div>
    </div>
@endsection
