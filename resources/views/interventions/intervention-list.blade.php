@php
    $interventions = [
        (object) [
            'id' => 1,
            'parcelle' => 'Parcelle Nord',
            'type' => 'Semis',
            'date' => '15-03-2024',
            'description' => 'Irrigation',
            'quantite' => '25 kg/ha',
        ],
        (object) [
            'id' => 2,
            'parcelle' => 'Parcelle Sud',
            'type' => 'Récolte',
            'date' => '20-03-2024',
            'description' => 'Récolte manuelle',
            'quantite' => '40 kg/ha',
        ],
    ];
@endphp


<section>
    <table class="w-full">
        <thead class="bg-[#4a7c59] text-white text-left">
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Parcelles</th>
            <th class="px-4 py-3">Type d'intervention</th>
            <th class="px-4 py-3">Date d'intervention</th>
            <th class="px-4 py-3">Description</th>
            <th class="px-4 py-3">Quantité</th>
            <th class="px-4 py-3">Actions</th>
        </thead>
        <tbody>

            @foreach ($interventions as $intervention)
                <tr class="even:bg-green-100 odd:bg-green-50 text-left">
                    <td class="px-4 py-3">{{ $intervention->id }}</td>
                    <td class="px-4 py-3">{{ $intervention->parcelle }}</td>
                    <td class="px-4 py-3">{{ $intervention->type }}</td>
                    <td class="px-4 py-3">{{ $intervention->date }}</td>
                    <td class="px-4 py-3">{{ $intervention->description }}</td>
                    <td class="px-4 py-3">{{ $intervention->quantite }}</td>
                    <td class="px-4 py-3 space-x-3 ">
                        <a href="{{ route('interventions.show', $intervention->id) }}" class="cursor-pointer">
                            <i class="fa-solid fa-eye text-blue-600"></i>
                        </a>
                        <a href="#" class="cursor-pointer">
                            <i class="fa-solid fa-pencil-alt text-amber-600"></i>
                        </a>
                        <a href="#" class="cursor-pointer">
                            <i class="fa-solid fa-trash-alt text-red-600"></i>
                        </a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</section>
