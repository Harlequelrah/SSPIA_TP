<div class="bg-white rounded-lg w-full mb-5">
    <div class="p-6">
        <x-heading title="Formulaire d'ajout d'une intervention" class="mb-5" />
        <form action="" @submit.prevent=''>
            <div class="grid grid-cols-2 gap-4 mb-4">
                {{-- parcelle concernée --}}
                <div>
                    <label for="parcelleConcernee" class="text-slate-700">Parcelles concernée <span
                            class="text-red-600">*</span> </label>
                    <select name="parcelleConcernee" id="parcelleConcernee"
                        class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:bg-white focus:border-green-500 focus:outline-none text-sm placeholder:text-sm">
                        <option value="">Selectionnez une parcelles</option>
                    </select>
                </div>
                {{-- type d'intervention --}}
                <div>
                    <label for="typeIntervention" class="text-slate-700">Type d'intervention <span
                            class="text-red-600">*</span> </label>
                    <select name="typeIntervention" id="typeIntervention"
                        class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:bg-white focus:border-green-500 focus:outline-none text-sm placeholder:text-sm">
                        <option value="">Selectionnez un type</option>
                    </select>
                </div>
                {{-- date d'intervention --}}
                <div>
                    <label for="dateIntervention" class="text-slate-700">Date de l'intervention <span
                            class="text-red-600">*</span> </label>
                    <input type="date" name="dateIntervention" id="dateIntervention"
                        class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:bg-white focus:border-green-500 focus:outline-none text-sm placeholder:text-sm">
                </div>
                {{-- quantité de produit utilisé --}}
                <div>
                    <label for="quantiteProduit" class="text-slate-700">Quantité de produit utilisé</label>
                    <div class="flex">
                        <input type="text" name="quantiteProduit" id="quantiteProduit"
                            class="w-full p-2 border rounded-tl-sm rounded-bl-sm border-slate-400 bg-white focus:bg-white focus:border-green-500 focus:outline-none text-sm placeholder:text-sm">
                        <select name="type" id="type"
                            class="w-14 text-center p-2 border rounded-tr-sm rounded-br-sm border-slate-400 bg-slate-200 focus:bg-white focus:border-green-500 focus:outline-none text-sm placeholder:text-sm">
                            <option value="kg">Kg</option>
                            <option value="kg">L</option>
                        </select>
                    </div>
                </div>
            </div>
            {{-- description --}}
            <div class="mb-4">
                <label for="quantiteProduit" class="text-slate-700">Quantité de produit utilisé</label>
                <textarea name="description" id="description" cols="30" rows="10"
                    placeholder="D'écrivez l'intervention réaliser"
                    class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:bg-white focus:border-green-500 focus:outline-none resize-none text-sm placeholder:text-sm"></textarea>
            </div>
            <div class="w-full flex justify-end space-x-2">
                <button
                    class="border border-slate-600 rounded-md cursor-pointer duration-200 transition-all px-3 py-2 hover:bg-black hover:text-white">Annuler</button>
                <button
                    class="bg-[#4a7c59] text-white rounded-md cursor-pointer duration-200 transition-all px-3 py-2 hover:bg-white hover:border hover:border-[#4a7c59] hover:text-[#4a7c59]">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
