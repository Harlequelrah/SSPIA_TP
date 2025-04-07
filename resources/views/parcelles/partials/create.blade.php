    <div class = 'shadow-lg rounded-lg p-5'>
        <div class="mb-6">
            <x-heading title="Ajouter une parcelles" class="text-lg font-bold mb-2" />
            <x-heading-small title="Les champs marqués avec (*) sont obligatoires" />
        </div>
        <form action="" @submit.prevent="">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-gray-700">Nom <span class="text-red-600">*</span> </label>
                    <x-input-field name="name" id="name" type="text" :placeholder="'Ex: Parcelle 1'" />
                </div>
                <div>
                    <label for="size" class="block text-gray-700">Superficie <span class="text-red-600">*</span>
                    </label>
                    <x-input-field name="size" id="size" type="text" :placeholder="'Ex: 2 hectares'" />
                </div>
                <div>
                    <label for="crop" class="block text-gray-700">Culture <span class="text-red-600">*</span>
                    </label>
                    <x-input-field name="crop" id="crop" type="text" :placeholder="'Ex: Blé'" />
                </div>
                <div>
                    <label for="plantationDate" class="block text-gray-700">Date de plantation <span
                            class="text-red-600">*</span> </label>
                    <x-input-field name="plantationDate" id="plantationDate" type="date" :placeholder="'Ex: 2024-12-26'" />
                </div>
            </div>
            <div class="mt-4">
                <label for="agriculturist" class="block text-gray-700">Statut de la culture</label>
                <select name="agriculturist" id="agriculturist"
                    class="w-full p-2 border rounded-md border-slate-400 bg-slate-200 focus:bg-white focus:border-green-500 focus:outline-none">
                    <option value="En culture">En culture</option>
                    <option value="En jachère">En jachère</option>
                    <option value="Récolte">Récolte</option>
                </select>
            </div>
            <div class="w-full flex justify-end space-x-2 mt-4">
                <x-secondary-button>Annuler</x-secondary-button>
                <x-primary-button>Ajouter</x-primary-button>
            </div>
        </form>
    </div>
