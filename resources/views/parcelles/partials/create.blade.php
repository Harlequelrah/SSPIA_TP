    <div class = 'shadow-lg rounded-lg p-5'>
        <div class="mb-6">
            <x-heading title="Ajouter une parcelles" class="text-lg font-bold mb-2" />
            <x-heading-small title="Les champs marqués avec (*) sont obligatoires" />
        </div>
        <form action="{{ route('parcelles.store') }}" method='POST' >
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-gray-700">Nom <span class="text-red-600">*</span> </label>
                    <x-input-field name="name" id="name" type="text" :value="old('name')" :placeholder="'Ex: Parcelle 1'" />
                    @error('name')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="size" class="block text-gray-700">Superficie <span class="text-red-600">*</span>
                    </label>
                    <x-input-field name="area" id="area" type="text" :value="old('area')" :placeholder="'Ex: 2'" />
                    @error('area')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="crop" class="block text-gray-700">Culture <span class="text-red-600">*</span>
                    </label>
                    <!-- Culture -->
                    <x-input-field name="crop_type" id="crop_type" :value="old('crop_type')" type="text" :placeholder="'Ex: Blé'" />
                    @error('crop_type')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="plantationDate" class="block text-gray-700">Date de plantation <span
                            class="text-red-600">*</span> </label>
                    <!-- Date de plantation -->
                    <x-input-field name="plantation_date" id="plantation_date" :value="old('plantation_date')" type="date"
                        :placeholder="'Ex: 2024-12-26'" />
                    @error('plantation_date')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror

                </div>
            </div>
            <!-- Statut -->
            <div class="mt-4">
                <label for="status" class="block text-gray-700">Statut de la culture</label>
                <select name="status" id="status" :value="old('status')"
                    class="w-full p-2 border rounded-md border-slate-400 bg-slate-200 focus:bg-white focus:border-green-500 focus:outline-none">
                    <option disabled>Selectionnez une option</option>
                    @foreach (App\Enums\StatusEnum::values() as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
                @error('status')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full flex justify-end space-x-2 mt-4">
                <x-secondary-button>Annuler</x-secondary-button>
                <x-primary-button>Ajouter</x-primary-button>
            </div>
        </form>
    </div>
