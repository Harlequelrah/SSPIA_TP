<div class="bg-white rounded-lg w-full mb-5">
    <div class="p-6">
        <div class="mb-6">
            <x-heading title="Formulaire d'ajout d'une intervention" />
            <x-heading-small title="Les champs marqués avec (*) sont obligatoires" />
        </div>

        <form action="{{ route('interventions.store') }}">
            <div class="grid grid-cols-2 gap-4 mb-4">
                {{-- parcelle concernée --}}
                <div>
                    <label for="plot_id" class="text-slate-700">Parcelle concernée <span
                            class="text-red-600">*</span></label>

                    @if ($plots->isEmpty())
                        <p class="text-red-600">Aucune parcelle disponible. Veuillez en ajouter d'abord.</p>
                    @else
                        <select name="plot_id" id="plot_id" required
                            class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:border-green-500">
                            <option value="">Sélectionnez une parcelle</option>
                            @foreach ($plots as $plot)
                                <option value="{{ $plot->id }}">{{ $plot->name }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                {{-- type d'intervention --}}
                <select name="intervention_type" id="intervention_type" required
                    class="w-full p-2 border rounded-sm border-slate-400 bg-white focus:border-green-500">
                    <option disabled>Sélectionnez un type</option>
                    @foreach (App\Enums\InterventionTypeEnum::values() as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>

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
                        <input type="number" name="quantiteProduit" id="quantiteProduit"
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
                <x-secondary-button>Annuler</x-secondary-button>
                <x-primary-button>Ajouter</x-primary-button>
            </div>
        </form>
    </div>
</div>
