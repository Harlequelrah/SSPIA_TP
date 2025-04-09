<div class="bg-white rounded-lg w-full mb-5">
    <div class="p-6">
        <div class="mb-6">
            <x-heading title="Formulaire d'ajout d'une intervention" />
            <x-heading-small title="Les champs marqués avec (*) sont obligatoires" />
        </div>

        <form action="{{ route('interventions.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4 mb-4">
                {{-- parcelle concernée --}}
                <div>
                    <label for="plot_id" class="text-slate-700">Parcelle concernée <span
                            class="text-red-600">*</span></label>

                    @if ($plots->isEmpty())
                        <p class="text-red-600">Aucune parcelle disponible. Veuillez en ajouter d'abord.</p>
                    @else
                        <select name="plot_id" id="plot_id"
                            class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:border-green-500">
                            <option value="" disabled>Sélectionnez une parcelle</option>
                            <select name="plot_id" id="plot_id" required
                                class="w-full border p-2 rounded-sm border-slate-400 bg-white focus:border-green-500">
                                <option value="">Sélectionnez une parcelle</option>
                                @foreach ($plots as $plot)
                                    <option value="{{ $plot->id }}">{{ $plot->name }}</option>
                                @endforeach
                            </select>
                    @endif
                    @error('plot_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                {{-- type d'intervention --}}
                <div>

                    <label for="intervention_type">Type d'intervention</label>
                    <select name="intervention_type" id="intervention_type" required
                        class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:border-green-500">
                        <option disabled>Sélectionnez un type</option>
                        @foreach (App\Enums\InterventionTypeEnum::values() as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                    {{-- @error('intervention_type')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror --}}
                </div>

                {{-- date d'intervention --}}
                <div>
                    <label for="intervention_date" class="text-slate-700">Date de l'intervention <span
                            class="text-red-600">*</span> </label>
                    <input type="date" name="intervention_date" id="intervention_date"
                        class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:bg-white focus:border-green-500 focus:outline-none text-sm placeholder:text-sm">
                    @error('intervention_date')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                </div>
                {{-- quantité de produit utilisé --}}
                <div>
                    <label for="product_used_quantity" class="text-slate-700">Quantité de produit utilisé</label>
                    <div class="flex">
                        <input type="number" name="product_used_quantity" id="product_used_quantity"
                            class="w-full p-2 border rounded-tl-sm rounded-bl-sm border-slate-400 bg-white focus:bg-white focus:border-green-500 focus:outline-none text-sm placeholder:text-sm">
                        <select name="product_used_name" id="product_used_name"
                            class="w-14 text-center p-2 border rounded-tr-sm rounded-br-sm border-slate-400 bg-slate-200 focus:bg-white focus:border-green-500 focus:outline-none text-sm placeholder:text-sm">
                            @foreach (App\Enums\UnitEnum::values() as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- @error('product_used_quantity')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror --}}
                </div>
            </div>
            {{-- description --}}
            <div class="mb-4">
                <label for="description" class="text-slate-700">Description</label>
                <textarea name="description" id="description" cols="30" rows="10"
                    placeholder="D'écrivez l'intervention réaliser"
                    class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:bg-white focus:border-green-500 focus:outline-none resize-none text-sm placeholder:text-sm"></textarea>
                {{-- @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror --}}
            </div>
            <div class="w-full flex justify-end space-x-2">
                <x-secondary-button>Annuler</x-secondary-button>
                <x-primary-button>Ajouter</x-primary-button>
            </div>
        </form>
    </div>
</div>
