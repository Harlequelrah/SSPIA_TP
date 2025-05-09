    <div class = 'shadow-lg rounded-lg p-5'>
        <div class="mb-6">
            <x-heading title="Ajouter une parcelles" class="text-lg font-bold mb-2" />
            <x-heading-small title="Les champs marqués avec (*) sont obligatoires" />
        </div>
        <form action="{{ route('plots.store') }}" method='POST'>
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
                    <label for="size" class="block text-gray-700">Superficie (hectare) <span
                            class="text-red-600">*</span>
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
{{--            <div class="mb-4">--}}
{{--                <label for="map" class="block text-sm font-medium text-gray-700">Position sur la carte</label>--}}
{{--                <div id="map" class="h-96 rounded border"></div>--}}
{{--                <input type="hidden" name="latitude" id="latitude">--}}
{{--                <input type="hidden" name="longitude" id="longitude">--}}
{{--            </div>--}}

            <div class="w-full flex justify-end space-x-2 mt-4">
                <x-secondary-button>Annuler</x-secondary-button>
                <x-primary-button>Ajouter</x-primary-button>
            </div>
        </form>
    </div>

  @push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Coordonnées du centre du Togo (latitude, longitude)
        const togoCenter = [8.6195, 0.8248]; // Centre approximatif du Togo

        // Initialisation de la carte
        const map = L.map('map').setView(togoCenter, 7); // Zoom level ajusté pour couvrir tout le Togo

        // Ajout d'une couche de tuiles OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 10,
            tileSize: 1024,
            zoomOffset: -1,
        }).addTo(map);

        // Icône personnalisée pour le marqueur
        const customIcon = L.icon({
            iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon.png', // URL de l'icône
            iconSize: [25, 41], // Taille de l'icône
            iconAnchor: [12, 41], // Point d'ancrage de l'icône
            popupAnchor: [1, -34], // Position du popup par rapport à l'icône
        });

        let marker;

        // Gestion du clic sur la carte pour ajouter ou déplacer un marqueur
        map.on('click', function(e) {
            const { lat, lng } = e.latlng;

            if (marker) {
                marker.setLatLng([lat, lng]); // Déplace le marqueur existant
            } else {
                marker = L.marker([lat, lng], { icon: customIcon }).addTo(map); // Ajoute un nouveau marqueur
                marker.bindPopup("Position sélectionnée").openPopup(); // Ajoute un popup
            }

            // Met à jour les champs cachés avec les coordonnées
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });
    });
</script>
@endpush
