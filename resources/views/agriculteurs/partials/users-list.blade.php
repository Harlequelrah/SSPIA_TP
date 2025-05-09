<div>
    <div class="overflow-x-auto bg-white rounded-lg shadow mt-4">
        <table class="w-full">
            <thead class="bg-teal-700 divide-x-2 text-sm text-white text-left">
                <th class="uppercase px-3 py-2">ID</th>
                <th class="uppercase px-3 py-2">Nom complet</th>
                <th class="uppercase px-3 py-2">Téléphone</th>
                <th class="uppercase px-3 py-2">E-mail</th>
                <th class="uppercase px-3 py-2">Adresse</th>
                <th class="uppercase px-3 py-2">Compte actif</th>
                <th class="uppercase px-3 py-2">Actions</th>
            </thead>
            <tbody class="text-left">
                <template x-for="user in users" :key="user.id">
                    <tr class="text-sm" :class="{ 'bg-green-100': selectedUser && selectedUser.id === user.id }">
                        <td class="px-3 py-2 text-slate-800" x-text="user.id"></td>
                        <td class="px-3 py-2 text-slate-800" x-text="user.name"></td>
                        <td class="px-3 py-2 text-slate-800" x-text="user.phone ? user.phone : 'Non renseigné'">
                        </td>
                        <td class="px-3 py-2 text-slate-800" x-text="user.email"></td>
                        <td class="px-3 py-2 text-slate-800" x-text="user.address ? user.address : 'Non renseignée'">
                        </td>
                        <td class="px-3 py-2 text-slate-800">
                            <i x-show="!user.deleted_at" class="fa-solid fa-circle-check text-green-500"></i>
                            <i x-show="user.deleted_at" class="fa-solid fa-circle-xmark text-red-500"></i>
                        </td>
                        <td class="px-3 py-2">
                            <div class="flex items-center justify-center space-x-3">
                                <a :href="`/agriculteurs/${user.id}`"
                                    class=" px-3 py-2  rounded-md  cursor-pointer transition ease-in-out duration-150 ">
                                    <i class="fa-solid fa-eye text-lg text-blue-600 m-0 p-0"></i>
                                </a>
                                <a @click="selectedUser = user; $dispatch('open-modal', 'confirm-delete')"
                                    class=" px-4 py-2 cursor-pointer rounded-md ">
                                    <i class="fa-solid fa-trash-alt text-red-600 text-lg"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </template>
                <template x-if='users.length === 0'>
                    <tr>
                        <td colspan="7" class="px-3 py-2 text-center">
                            <span class="italic  text-slate-700">
                                Aucun utilisateur trouvé
                            </span>
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
                                <span x-text="pagination.total"></span> agriculteurs
                            </div>

                            <div class="flex items-center space-x-1">
                                <button @click="goToPage(currentPage - 1)" :disabled="currentPage <= 1"
                                    :class="{ ' cursor-not-allowed': currentPage <= 1 }"
                                    class="px-3 py-1 rounded border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </button>

                                <template x-for="page in Math.min(5, pagination.last_page)" :key="page">
                                    <button @click="goToPage(page)"
                                        :class="{
                                            'bg-teal-700 text-white px-4  py-1': currentPage === page,
                                            'bg-white text-gray-700 hover:bg-green-50 px-3 py-1': currentPage !==
                                                page
                                        }"
                                        class="rounded-lg border cursor-pointer border-gray-400 text-sm font-medium">
                                        <span x-text="page"></span>
                                    </button>
                                </template>

                                <button @click="goToPage(currentPage + 1)"
                                    :disabled="currentPage >= pagination.last_page"
                                    :class="{ 'cursor-not-allowed': currentPage >= pagination.last_page }"
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
                Êtes-vous sûr de vouloir supprimer cet agriculteur ?
            </h2>

            <p class="mt-1 text-sm text-slate-600">
                Cette action mettra l'intervention dans la corbeille. Vous pourrez la restaurer ultérieurement.
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close-modal', 'confirm-delete')">Annuler</x-secondary-button>

                <form method="POST" :action="`/agriculteurs/${selectedUser.id}`" class="ml-3">
                    @csrf
                    @method('DELETE')
                    <x-primary-button
                        class="bg-red-500 hover:bg-red-600 transtion-color duration-200 focus:bg-red-700">Supprimer</x-primary-button>
                </form>
            </div>
        </div>
    </x-modal>

</div>
