<div class="bg-white p-4 rounded-lg shadow-md mb-6">
    <x-heading-small title="Ajouter un agriculteur" class="mb-4 font-semibold text-lg" />
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
            <button type="submit"
                class="bg-[#4a7c59] cursor-pointer transition-all duration-200 text-white px-4 py-2 rounded-lg hover:bg-green-900 active:bg-green-800">Enregistrer</button>
        </div>
    </form>
</div>
