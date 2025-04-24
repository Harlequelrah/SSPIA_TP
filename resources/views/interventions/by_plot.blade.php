@extends('app_layout')

@section('title', 'Liste des interventions d\'une parcelle')

@section('content')
    @if (session('success'))
        <x-notification :message="session('success')" color="green" icon="fa-circle-check" />
    @elseif (session('error'))
        <x-notification :message="session('error')" color="red" icon="fa-circle-exclamation" />
    @endif
    <div class="max-w-6xl mx-auto p-4" x-data="{ interventionIdToDelete: null }">
        <h1 class="text-2xl font-bold mb-4 text-[#4a7c59]">
            Interventions de la parcelle : {{ $plot->name }}
        </h1>

        <div class="flex items-center justify-between">
            <a href="{{ route('plots.index') }}" class="mb-4 inline-block text-sm text-blue-600 hover:underline">
                ← Retour à la liste des parcelles
            </a>

            <a href="{{ route('plot.etiquette', $plot->id) }}"
                class="border text-green-800 border-green-800 rounded-lg px-3 py-2 text-sm hover:bg-green-800 hover:text-white transition-colors duration-200">
                {{ __('Imprimer etiquette ') }}
            </a>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow mt-4">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-[#4a7c59] text-white">
                        <th class="py-2 px-4 text-left">ID</th>
                        <th class="py-2 px-4 text-left">Type</th>
                        <th class="py-2 px-4 text-left">Date</th>
                        <th class="py-2 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="even:bg-slate-50 odd:bg-slate-200">
                    @forelse($interventions as $intervention)
                        <tr>
                            <td class="py-2 px-4">{{ $intervention->id }}</td>
                            <td class="py-2 px-4">{{ $intervention->intervention_type }}</td>
                            <td class="py-2 px-4">{{ $intervention->intervention_date }}</td>
                            <td class="py-2 px-4 flex space-x-2">
                                <a href="{{ route('interventions.show', $intervention->id) }}"
                                    class="bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-800">
                                    Voir
                                </a>
                                <a href="#"
                                    @click.prevent="interventionIdToDelete = '{{ $intervention->id }}'; $dispatch('open-modal', 'confirm-delete')"
                                    class="px-3 py-2 bg-red-600 cursor-pointer rounded-md hover:bg-red-800">
                                    <i class="fa-solid fa-trash-alt text-white"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-500 italic">
                                Aucune intervention trouvée pour cette parcelle.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $interventions->links() }}
            </div>
        </div>

        <!-- Modal de confirmation -->
        <x-modal name="confirm-delete" maxWidth="md">
            <div class="p-6">
                <h2 class="text-lg font-medium text-green-900">
                    Êtes-vous sûr de vouloir supprimer cette intervention ?
                </h2>

                <p class="mt-1 text-sm text-slate-600">
                    Cette action supprimera l’intervention de manière définitive.
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button @click="$dispatch('close-modal', 'confirm-delete')">Annuler</x-secondary-button>

                    <form method="POST" :action="`{{ url('interventions') }}/${interventionIdToDelete}`" class="ml-3">
                        @csrf
                        @method('DELETE')
                        <x-primary-button
                            class="bg-red-500 hover:bg-red-600 transtion-color duration-200 focus:bg-red-700">Supprimer</x-primary-button>
                    </form>
                </div>
            </div>
        </x-modal>
    </div>
@endsection
