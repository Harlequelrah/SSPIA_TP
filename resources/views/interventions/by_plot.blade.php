@extends('app_layout')

@section('title', 'Interventions sur la parcelles')

@section('content')
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-[#4a7c59]">
            Interventions de la parcelle : {{ $plot->name }}
        </h1>

        <a href="{{ route('plots.index') }}" class="mb-4 inline-block text-sm text-blue-600 hover:underline">
            ← Retour à la liste des parcelles
        </a>

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
                                    class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-800">
                                    Voir
                                </a>
                                <form method="POST" action="{{ route('interventions.destroy', $intervention->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-800"
                                        onclick="return confirm('Supprimer cette intervention ?')">
                                        Supprimer
                                    </button>
                                </form>
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
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $interventions->links() }}
        </div>
    </div>
@endsection
