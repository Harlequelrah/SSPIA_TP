<div>
    <div {{ $attributes->merge(['class' => 'shadow-lg rounded-lg p-5']) }}>
        <div class="mb-6">
            <h1 class="text-lg font-bold mb-2">Ajouter une parcelles</h1>
            <h2 class="text-gray-700 text-sm">Les champs marqués avec (*) sont obligatoires</h2>
        </div>
        <form action="" @submit.prevent="">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-gray-700">Nom*</label>
                    <x-input-field name="name" id="name" type="text" :placeholder="'Ex: Parcelle 1'" />
                </div>
                <div>
                    <label for="size" class="block text-gray-700">Superficie*</label>
                    <x-input-field name="size" id="size" type="text" :placeholder="'Ex: 2 hectares'" />
                </div>
                <div>
                    <label for="crop" class="block text-gray-700">Culture*</label>
                    <x-input-field name="crop" id="crop" type="text" :placeholder="'Ex: Blé'" />
                </div>
                <div>
                    <label for="plantationDate" class="block text-gray-700">Date de plantation*</label>
                    <x-input-field name="plantationDate" id="plantationDate" type="date" :placeholder="'Ex: 2024-12-26'" />
                </div>
            </div>
            <div class="mt-4">
                <label for="agriculturist" class="block text-gray-700">Statut de la culture</label>
                <select name="agriculturist" id="agriculturist" class="w-full p-2 border rounded-md border-slate-400 bg-slate-200 focus:bg-white focus:border-green-500 focus:outline-none">
                    <option value="En culture">En culture</option>
                    <option value="En jachère">En jachère</option>
                    <option value="Récolte">Récolte</option>
                </select>
            </div>
            <div class="mt-4 flex justify-end">
                <button type="submit" class="bg-[#4a7c59] text-white px-4 py-2 rounded-lg cursor-pointer transition-all duration-200 hover:bg-green-900 active:bg-green-800">Ajouter</button>
            </div>
        </form>
    </div>
</div>