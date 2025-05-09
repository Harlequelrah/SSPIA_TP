<div class="mt-4">
    <!-- Liste des parcelles -->
    <div class="overflow-x-auto bg-white rounded-lg shadow mt-4">
        <table class="w-full">
            <thead class="bg-teal-700 divide-x-2 text-sm text-left text-white">
                <th class="uppercase px-3 py-2">ID</th>
                <th class="uppercase px-3 py-2">Nom</th>
                <th class="uppercase px-3 py-2">Superficie (ha)</th>
                <th class="uppercase px-3 py-2">Culture</th>
                <th class="uppercase px-3 py-2">Date de plantation</th>
                <th class="uppercase px-3 py-2">Statut</th>
                @if ($isAdmin)
                    <th class="uppercase px-3 py-2">Agriculteur</th>
                @endif
                <th class="uppercase px-3 py-2">Actions</th>
            </thead>
            <tbody class="text-center">
                <template x-if='plots.length !== 0'>
                    <template x-for="plot in plots" :key="plot.id">
                        <tr class="text-sm text-left"
                            :class="{ 'bg-green-50': selectedPlot && selectedPlot.id === plot.id }">
                            <td class="px-3 py-2 text-slate-800" x-text="plot.id.substring(0, 20)"></td>
                            <td class="px-3 py-2 text-slate-800" x-text="plot.name"></td>
                            <td class="px-3 py-2 text-slate-800" x-text="plot.area"></td>
                            <td class="px-3 py-2 text-slate-800" x-text="plot.crop_type"></td>
                            <td class="px-3 py-2 text-slate-800" x-text="plot.plantation_date"></td>
                            <td class="text-slate-800">
                            <span :class="{
                                    'rounded-md text-xs text-gray-900 inline-block px-2 py-1 text-center bg-green-200': plot
                                        .status === '{{ \App\Enums\StatusEnum::EN_C }}',
                                    'rounded-md text-xs text-gray-900 inline-block px-2 py-1 text-center bg-yellow-200': plot
                                        .status === '{{ \App\Enums\StatusEnum::EN_J }}',
                                    'rounded-md text-xs text-gray-900 inline-block px-2 py-1 text-center bg-gray-200': plot
                                        .status === '{{ \App\Enums\StatusEnum::RCLT }}'
                                }" x-text="plot.status"></span>
                        </td>
                            @if ($isAdmin)
                                <td class="px-3 py-2 text-slate-800" x-text="plot.user.name"></td>
                            @endif


                            <td class="px-3 py-2 flex items-center justify-center space-x-3">
                                <a :href="`/plots/${plot.id}`"
                                    class="px-3 py-2 rounded-md">
                                    <i class="fa-solid fa-eye text-blue-600 text-lg"></i>
                                </a>
                                <a x-on:click="$dispatch('open-modal', 'confirm-delete')"
                                    class="px-3 py-2 cursor-pointer rounded-md">
                                    <i class="fa-solid fa-trash-alt text-xl text-red-600 "></i>
                                </a>
                                <a :href="`/plots/${plot.id}/interventions`"
                                    class="bg-gray-600 text-white px-3 py-2 rounded text-sm hover:bg-gray-800 transition-color duration-300 flex items-center space-x-1">
                                    <i class="fa-solid fa-list"></i>
                                    <span>Interv.</span>
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
                            <div class="text-sm text-gray-500">
                                Affichage de <span x-text="(currentPage - 1) * pagination.per_page + 1"></span> à
                                <span x-text="Math.min(currentPage * pagination.per_page, pagination.total)"></span>
                                sur <span x-text="pagination.total"></span> Parcelles
                            </div>
                            <div class="flex items-center space-x-1">
                                <!-- Previous Page Button -->
                                <button @click="window.location.href = '?page=' + (currentPage - 1)"
                                    :disabled="currentPage <= 1"
                                    :class="{ 'opacity-50 cursor-not-allowed': currentPage <= 1 }"
                                    class="px-3 py-1 rounded border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </button>

                                <!-- Pagination avec ellipsis optimisée -->
                                <div x-data="{
                                    pages() {
                                        let pages = [];
                                        let maxVisible = 7;

                                        if (pagination.last_page <= maxVisible) {
                                            // Si moins de 7 pages, afficher toutes les pages
                                            for (let i = 1; i <= pagination.last_page; i++) {
                                                pages.push({ value: i, type: 'page' });
                                            }
                                        } else {
                                            // Toujours afficher la première page
                                            pages.push({ value: 1, type: 'page' });

                                            // Calculer les pages centrales à afficher
                                            let leftBound = Math.max(2, currentPage - 2);
                                            let rightBound = Math.min(pagination.last_page - 1, currentPage + 2);

                                            // Ajouter ellipsis au début si nécessaire
                                            if (leftBound > 2) {
                                                pages.push({ value: '...', type: 'ellipsis' });
                                            }

                                            // Ajouter les pages centrales
                                            for (let i = leftBound; i <= rightBound; i++) {
                                                pages.push({ value: i, type: 'page' });
                                            }

                                            // Ajouter ellipsis à la fin si nécessaire
                                            if (rightBound < pagination.last_page - 1) {
                                                pages.push({ value: '...', type: 'ellipsis' });
                                            }

                                            // Toujours afficher la dernière page
                                            pages.push({ value: pagination.last_page, type: 'page' });
                                        }

                                        return pages;
                                    }
                                }" class="flex items-center space-x-1">
                                    <template x-for="(page, index) in pages()" :key="index">
                                        <template x-if="page.type === 'page'">
                                            <button @click="window.location.href = '?page=' + page.value"
                                                :class="{
                                                    'bg-teal-700 text-white px-4 py-1': currentPage === page.value,
                                                    'bg-white text-gray-700 hover:bg-green-50 px-3 py-1': currentPage !==
                                                        page.value
                                                }"
                                                class="rounded-lg border cursor-pointer border-gray-400 text-sm font-medium">
                                                <span x-text="page.value"></span>
                                            </button>
                                        </template>
                                        <template x-if="page.type === 'ellipsis'">
                                            <span class="px-2 py-1 text-gray-500">...</span>
                                        </template>
                                    </template>
                                </div>

                                <!-- Next Page Button -->
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

    <x-modal name="confirm-delete" maxWidth="md">
        <div class="p-6">
            <h2 class="text-lg font-medium text-green-900">
                Êtes-vous sûr de vouloir supprimer cette parcelles ?
            </h2>

            <p class="mt-1 text-sm text-slate-600">
                Cette action mettra la parcelle dans la corbeille. Vous pourrez la restaurer ultérieurement.
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close-modal', 'confirm-delete')">Annuler</x-secondary-button>

                <form method="POST" :action="`/plots/${selectedPlot.id}`" class="ml-3">
                    @csrf
                    @method('DELETE')
                    <x-primary-button
                        class="bg-red-500 hover:bg-red-600 transtion-color duration-200 focus:bg-red-700">Supprimer</x-primary-button>
                </form>
            </div>
        </div>
    </x-modal>
</div>
