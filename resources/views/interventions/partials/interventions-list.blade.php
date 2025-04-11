<div>
    <div class="overflow-x-auto bg-white rounded-lg shadow mt-4">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-[#4a7c59] text-white">
                    <th class="py-2 px-4 text-left">ID</th>
                    <th class="py-2 px-4 text-left">Parcelle</th>
                    <th class="py-2 px-4 text-left">Type</th>
                    <th class="py-2 px-4 text-left">Date</th>
                    <th class="py-2 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="even:bg-slate-50 odd:bg-slate-500">
                <template x-if='interventions.length !== 0'>
                    <template x-for="intervention in interventions" :key="intervention.id">
                        <tr class="transition-colors"
                            :class="{ 'bg-green-100': selectedIntervention && selectedIntervention.id === intervention.id }">
                            <td class="py-2 px-4" x-text="intervention.id"></td>
                            <td class="py-2 px-4" x-text="intervention.plot.name"></td>
                            <td class="py-2 px-4" x-text="intervention.intervention_type"></td>
                            <td class="py-2 px-4" x-text="intervention.intervention_date"></td>
                            <td class="py-2 px-4 space-x-4">
                                <button @click="selectedIntervention = intervention"
                                    class="text-blue-600 hover:text-blue-600 cursor-pointer">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <a href="#">
                                    <i class="fa-solid fa-pencil-alt text-amber-600"></i>
                                </a>
                                <a :href="'/parcelles/' + intervention.plot.id" class="text-red-600 hover:text-red-800">
                                    <i class="fa-solid fa-trash-alt"></i>
                                </a>

                            </td>
                        </tr>
                    </template>
                </template>
                <template x-if='interventions.length === 0'>
                    <tr>
                        <td colspan="5" class="px-3 py-2 text-center">
                            <span class="italic  text-slate-700">
                                Aucune intervention
                            </span>
                        </td>
                    </tr>
                </template>
            </tbody>
            <!-- Pagination -->
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

                                <!-- Page Numbers -->
                                <template x-for="page in pagination.last_page" :key="page">
                                    <button @click="window.location.href = '?page=' + page"
                                        :class="{
                                            'bg-[#4a7c59] text-white px-2 py-1': currentPage ===
                                                page,
                                            'bg-white text-gray-700 hover:bg-green-50 px-3 py-1': currentPage !==
                                                page
                                        }"
                                        class="rounded-lg border cursor-pointer border-gray-400 text-sm font-medium">
                                        <span x-text="page"></span>
                                    </button>
                                </template>

                                <!-- Last Page Button (if there are many pages) -->
                                {{-- <button @click="goToPage(pagination.last_page)"
                                    :class="{
                                        'bg-[#4a7c59] text-white': currentPage === pagination
                                            .last_page,
                                        'bg-white text-gray-700 hover:bg-gray-50': currentPage !==
                                            pagination.last_page
                                    }"
                                    class="px-3 py-1 rounded border border-gray-300 text-sm font-medium"
                                    x-show="pagination.last_page > 5">
                                    <span x-text="pagination.last_page"></span>
                                </button> --}}

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
</div>
