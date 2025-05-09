<div>
    <div class="overflow-x-auto bg-white rounded-lg shadow mt-4">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-teal-700 text-white">
                    <th class="py-2 px-4 text-left">ID</th>
                    <th class="py-2 px-4 text-left">Parcelle</th>
                    <th class="py-2 px-4 text-left">Type</th>
                    <th class="py-2 px-4 text-left">Date</th>
                    <th class="py-2 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="even:bg-slate-50 odd:bg-slate-500">
                <template x-if='filteredInterventions.length !== 0'>
                    <template x-for="intervention in filteredInterventions" :key="intervention.id">
                        <tr class="transition-colors"
                            :class="{ 'bg-green-100': selectedIntervention && selectedIntervention.id === intervention.id }">
                            <td class="py-2 px-4" x-text="intervention.id.substring(0, 20)"></td>
                            <td class="py-2 px-4" x-text="intervention.plot.name"></td>
                            <td class="py-2 px-4" x-text="intervention.intervention_type"></td>
                            <td class="py-2 px-4" x-text="intervention.intervention_date"></td>
                            <td class="py-2 px-4 space-x-4 flex items-center">
                                <a :href="`/interventions/${intervention.id}`"
                                    class=" px-3 py-2  rounded-md  cursor-pointer ">
                                    <i class="fa-solid fa-eye text-blue-600 m-0 p-0 text-lg"></i>
                                </a>
                                <a x-on:click="$dispatch('open-modal', 'confirm-delete')" class=" px-4 py-2">
                                    <i class="fa-solid fa-trash-alt text-lg text-red-600"></i>
                                </a>


                            </td>
                        </tr>
                    </template>
                </template>
                <template x-if='filteredInterventions.length === 0'>
                    <tr>
                        <td colspan="5" class="px-3 py-2 text-center">
                            <span class="italic  text-slate-700">
                                Aucune intervention
                            </span>
                        </td>
                    </tr>
                </template>
            </tbody>
            <!-- Pagination améliorée avec ellipsis -->
            <tfoot>
                <tr>
                    <td colspan="5" class="py-3 px-4">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-500">
                                Affichage de <span x-text="(currentPage - 1) * pagination.per_page + 1"></span> à
                                <span x-text="Math.min(currentPage * pagination.per_page, pagination.total)"></span>
                                sur <span x-text="pagination.total"></span> interventions
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
                Êtes-vous sûr de vouloir supprimer cette intervention ?
            </h2>

            <p class="mt-1 text-sm text-slate-600">
                Cette action mettra l'intervention dans la corbeille. Vous pourrez la restaurer ultérieurement.
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close-modal', 'confirm-delete')">Annuler</x-secondary-button>

                <form method="POST" :action="`/interventions/${selectedIntervention.id}`" class="ml-3">
                    @csrf
                    @method('DELETE')
                    <x-primary-button
                        class="bg-red-500 hover:bg-red-600 transtion-color duration-200 focus:bg-red-700">Supprimer</x-primary-button>
                </form>
            </div>
        </div>
    </x-modal>
</div>
