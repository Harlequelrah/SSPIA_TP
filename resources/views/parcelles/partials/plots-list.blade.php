<div class="mt-4">
    <!-- Liste des parcelles -->
    <x-heading title="Liste des parcelles" />

    <div class="overflow-x-auto bg-white rounded-lg shadow mt-4">
        <table class="w-full">
            <thead class="bg-[#4a7c59] divide-x-2 text-sm text-left text-white">
                <th class="uppercase px-3 py-2">ID</th>
                <th class="uppercase px-3 py-2">Nom</th>
                <th class="uppercase px-3 py-2">Superficie (ha)</th>
                <th class="uppercase px-3 py-2">Culture</th>
                <th class="uppercase px-3 py-2">Date de plantation</th>
                <th class="uppercase px-3 py-2">Statut</th>
                <th class="uppercase px-3 py-2">Agriculteur</th>
                <th class="uppercase px-3 py-2">Actions</th>
            </thead>
            <tbody class="text-center">
                <template x-if='plots.length !== 0'>
                    <template x-for="plot in plots" :key="plot.id">
                        <tr class="text-sm text-left"
                            :class="{ 'bg-green-50': selectedPlot && selectedPlot.id === plot.id }">
                            <td class="px-3 py-2 text-slate-800" x-text="plot.id"></td>
                            <td class="px-3 py-2 text-slate-800" x-text="plot.name"></td>
                            <td class="px-3 py-2 text-slate-800" x-text="plot.area"></td>
                            <td class="px-3 py-2 text-slate-800" x-text="plot.crop_type"></td>
                            <td class="px-3 py-2 text-slate-800" x-text="plot.plantation_date"></td>
                            <td class="px-3 py-2 text-slate-900 font-semibold rounded-lg"
                                :class="{
                                    'text-green-900': plot.status === '{{ \App\Enums\StatusEnum::EN_C }}',
                                    'text-yellow-900': plot.status === '{{ \App\Enums\StatusEnum::EN_J }}',
                                    'text-gray-900': plot.status === '{{ \App\Enums\StatusEnum::RCLT }}'
                                }"
                                x-text="plot.status"></td>
                            <td class="px-3 py-2 text-slate-800" x-text="plot.user"></td>

                            <td class="px-3 py-2 flex items-center justify-center space-x-3">
                                <button @click="selectedPlot = plot">
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
                </template>
                <template x-if='plots.length === 0'>
                    <tr>
                        <td colspan="8" class="px-3 py-2">
                            <span class="italic text-center text-slate-700">
                                Aucune parcelles enregistrées
                            </span>
                        </td>
                    </tr>
                </template>
            </tbody>
            <!-- Pagination -->
            <tfoot>
                <tr>
                    <td colspan="8" class="py-3 px-4">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">
                                Affichage de
                                <span x-text="(currentPage - 1) * pagination.per_page + 1"></span> à
                                <span x-text="Math.min(currentPage * pagination.per_page, pagination.total)"></span>
                                sur
                                <span x-text="pagination.total"></span> parcelles
                            </div>

                            <div class="flex items-center space-x-1">
                                <button @click="window.location.href = '?page=' + (currentPage - 1)"
                                    :disabled="currentPage <= 1"
                                    :class="{ 'opacity-50 cursor-not-allowed': currentPage <= 1 }"
                                    class="px-3 py-1 rounded border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </button>

                                <template x-for="page in pagination.last_page" :key="page">
                                    <button @click="window.location.href = '?page=' + page"
                                        :class="{
                                            'bg-[#4a7c59] text-white px-2 py-1': currentPage === page,
                                            'bg-white text-gray-700 hover:bg-green-50 px-3 py-1': currentPage !== page
                                        }"
                                        class="rounded-lg border cursor-pointer border-gray-400 text-sm font-medium">
                                        <span x-text="page"></span>
                                    </button>
                                </template>

                                <button @click="window.location.href = '?page=' + (currentPage + 1)"
                                    :disabled="currentPage >= pagination.last_page"
                                    :class="{ 'opacity-50 cursor-not-allowed': currentPage >= pagination.last_page }"
                                    class="px-3 py-1 rounded border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </button>

                            </div>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
