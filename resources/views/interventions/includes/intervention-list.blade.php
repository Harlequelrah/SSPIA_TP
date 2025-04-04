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
            @for ($i = 0; $i < 2; $i++)
                <tr class="even:bg-green-100 odd:bg-green-50 text-left">
                    <td class="px-4 py-3">001</td>
                    <td class="px-4 py-3">Parcelle Nord</td>
                    <td class="px-4 py-3">Semis</td>
                    <td class="px-4 py-3">15-03-2024</td>
                    <td class="px-4 py-3">Irrigation</td>
                    <td class="px-4 py-3">25 kg/ha</td>
                    <td class="px-4 py-3 space-x-3 ">
                        <button class="cursor-pointer">
                            <i class="fa-solid fa-eye text-blue-600"></i>
                        </button>
                        <button class="cursor-pointer">
                            <i class="fa-solid fa-pencil-alt text-amber-600"></i>
                        </button>
                        <button class="cursor-pointer">
                            <i class="fa-solid fa-trash-alt text-red-600"></i>
                        </button>
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>
</section>
