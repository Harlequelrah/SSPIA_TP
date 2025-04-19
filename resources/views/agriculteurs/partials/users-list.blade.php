<div class="overflow-x-auto bg-white rounded-lg shadow mt-4">
    <table class="w-full">
        <thead class="bg-[#4a7c59] divide-x-2 text-sm text-white">
            <th class="uppercase px-3 py-2">ID</th>
            <th class="uppercase px-3 py-2">Nom complet</th>
            <th class="uppercase px-3 py-2">Téléphone</th>
            <th class="uppercase px-3 py-2">E-mail</th>
            <th class="uppercase px-3 py-2">Adresse</th>
            <th class="uppercase px-3 py-2">Compte actif</th>
            <th class="uppercase px-3 py-2">Actions</th>
        </thead>
        <tbody class="text-center">
            <template x-for="user in users" :key="user.id">
                <tr class="text-sm" :class="{ 'bg-green-100': selectedUser && selectedUser.id === user.id }">
                    <td class="px-3 py-2 text-slate-800" x-text="user.id"></td>
                    <td class="px-3 py-2 text-slate-800" x-text="user.name"></td>
                    <td class="px-3 py-2 text-slate-800" x-text="user.phone ? user.phone : 'Non renseigné'">
                    </td>
                    <td class="px-3 py-2 text-slate-800" x-text="user.email"></td>
                    <td class="px-3 py-2 text-slate-800" x-text="user.address ? user.address : 'Non renseignée'"></td>
                    <td class="px-3 py-2 text-slate-800">
                        <i x-show="!user.deleted_at" class="fa-solid fa-circle-check text-green-500"></i>
                        <i x-show="user.deleted_at" class="fa-solid fa-circle-xmark text-red-500"></i>
                    </td>
                    <td class="px-3 py-2">
                        <div class="flex items-center justify-center space-x-3">
                            <button @click="selectedUser = user">
                                <i class="fa-solid cursor-pointer fa-eye text-blue-600"></i>
                            </button>
                            <a href="#">
                                <i class="fa-solid cursor-pointer fa-pencil text-amber-600"></i>
                            </a>
                            <a href="#">
                                <i class="fa-solid cursor-pointer fa-trash-alt text-red-600"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            </template>
        </tbody>

        <tfoot>
            <tr>
                <td class="px-3 py-2" colspan="7">
                    <div class="mt-4 flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            Affichage de
                            <span x-text="(currentPage - 1) * pagination.per_page + 1"></span> à
                            <span x-text="Math.min(currentPage * pagination.per_page, pagination.total)"></span>
                            sur
                            <span x-text="pagination.total"></span> utilisateurs
                        </div>

                        <div class="flex items-center space-x-1">
                            <button @click="goToPage(currentPage - 1)" :disabled="currentPage <= 1"
                                :class="{ 'opacity-50 cursor-not-allowed': currentPage <= 1 }"
                                class="px-3 py-1 rounded border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>

                            <template x-for="page in Math.min(5, pagination.last_page)" :key="page">
                                <button @click="goToPage(page)"
                                    :class="{
                                        'bg-[#4a7c59] text-white px-2 py-1': currentPage === page,
                                        'bg-white text-gray-700 hover:bg-green-50 px-3 py-1': currentPage !==
                                            page
                                    }"
                                    class="rounded-lg border cursor-pointer border-gray-400 text-sm font-medium">
                                    <span x-text="page"></span>
                                </button>
                            </template>

                            <button @click="goToPage(currentPage + 1)" :disabled="currentPage >= pagination.last_page"
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
