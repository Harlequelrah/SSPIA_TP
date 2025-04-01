 <div class="mt-4" x-data="{
    showAgriForm: false,
    toggleAgriForm() {
        this.showAgriForm = !this.showAgriForm
        console.log(this.showAgriForm)
    },
    enregister() {
        this.showAgriForm = false
    }
 }">
     <div class="flex items-center justify-between mb-6">
         <x-heading title="Gestion des agriculteurs" />
         <button @click="toggleAgriForm()" class="bg-[#4a7c59] text-white px-3 py-2 rounded-lg cursor-pointer transition-all duration-200 hover:bg-green-900 active:bg-green-800">
             <template x-if='!showAgriForm'>
                 <i class="fa-solid fa-chevron-down"></i>
             </template>
             <template x-if='showAgriForm'>
                 <i class="fa-solid fa-chevron-up"></i>
             </template>
             <span>Ajouter un agriculteur</span>
         </button>
     </div>

     <!-- formulaire d'ajout d'un agriculteur -->
     <div x-show="showAgriForm" class="bg-white p-4 rounded-lg shadow-md mb-6">
         <form @submit.prevent=''>
             <div class="grid grid-cols-2 gap-4">
                 <div>
                     <label for="firstName" class="block text-gray-700">Nom</label>
                     <x-input-field name="firstName" id="firstName" type="text" :placeholder="'Ex: Jean Dupont'" />
                 </div>
                 <div>
                     <label for="lastName" class="block text-gray-700">Prénoms</label>
                     <x-input-field name="lastName" id="lastName" type="text" :placeholder="'Ex: Jean Dupont'" />
                 </div>
                 <div>
                     <label for="userName" class="block text-gray-700">Nom d'utilisateur</label>
                     <x-input-field name="userName" id="userName" type="text" :placeholder="'Ex: JeanD'" />
                 </div>
                 <div>
                     <label for="phone" class="block text-gray-700">Téléphone</label>
                     <x-input-field name="phone" id="phone" type="text" :placeholder="'Ex: 71234567'" />
                 </div>
                 <div>
                     <label for="email" class="block text-gray-700">E-mail</label>
                     <x-input-field name="email" id="email" type="email" :placeholder="'Ex: jean@example.com'" />
                 </div>
                 <div>
                     <label for="address" class="block text-gray-700">Adresse</label>
                     <x-input-field name="address" id="address" type="text" :placeholder="'Ex: Lomé, Togo'" />
                 </div>
             </div>
             <div class="mt-4 flex justify-end">
                 <button type="submit" class="bg-[#4a7c59] cursor-pointer transition-all duration-200 text-white px-4 py-2 rounded-lg hover:bg-green-900 active:bg-green-800">Enregistrer</button>
             </div>
         </form>
     </div>

     <table class="w-full">
         <thead class="bg-[#4a7c59] divide-x-2 text-sm text-white">
             <th class="uppercase px-3 py-2">ID</th>
             <th class="uppercase px-3 py-2">Nom complet</th>
             <th class="uppercase px-3 py-2">Nom d'utilisateur</th>
             <th class="uppercase px-3 py-2">Téléphone</th>
             <th class="uppercase px-3 py-2">E-mail</th>
             <th class="uppercase px-3 py-2">Adresse</th>
             <th class="uppercase px-3 py-2">Date d'ajout</th>
             <th class="uppercase px-3 py-2">Date de modification</th>
             <th class="uppercase px-3 py-2">Compte actif</th>
             <th class="uppercase px-3 py-2">Actions</th>
         </thead>
         <tbody class="text-center">
             <tr class="odd:bg-slate-200 text-sm even:bg-slate-300">
                 <td class="px-3 py-2 text-slate-800">1</td>
                 <td class="px-3 py-2 text-slate-800">Uche Lekwauwa</td>
                 <td class="px-3 py-2 text-slate-800">UcheLek</td>
                 <td class="px-3 py-2 text-slate-800">71610653</td>
                 <td class="px-3 py-2 text-slate-800">uche@gmail.com</td>
                 <td class="px-3 py-2 text-slate-800">Bè-kpota</td>
                 <td class="px-3 py-2 text-slate-800">2024-20-20</td>
                 <td class="px-3 py-2 text-slate-800">2024-20-20</td>
                 <td class="px-3 py-2 text-slate-800">OUI</td>
                 <td class="px-3 py-2 flex items-center justify-center space-x-3">
                     <button @click=""><i class="fa-solid cursor-pointer fa-eye text-green-800"></i></button>
                     <button @click=""><i class="fa-solid cursor-pointer fa-pencil text-blue-800"></i></button>
                     <button @click=""><i class="fa-solid cursor-pointer fa-trash text-red-800"></i></button>
                 </td>
             </tr>
         </tbody>
     </table>
 </div>