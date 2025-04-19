<div class="p-4 border rounded-lg bg-green-50 shadow mt-4" x-show="selectedPlot">
    <h2 class="text-xl font-bold text-[#4a7c59] mb-4">
        Détails de l'intervention <span x-text="selectedPlot ? selectedPlot.id : ''"></span>
    </h2>
    <ul class="space-y-2">
        <li><strong>ID:</strong> <span x-text="selectedPlot ? selectedPlot.id : ''"></span></li>
        <li><strong>Nom de la parcelles:</strong> <span x-text="selectedPlot ? selectedPlot.name : ''"></span>
        </li>
        <li><strong>Superficie:</strong> <span
                x-text="selectedPlot ? selectedPlot.area : ''"></span></li>
        <li><strong>Date:</strong> <span
                x-text="selectedPlot ? selectedPlot.plantation_date : ''"></span></li>
        <li><strong>Status:</strong>
            <span
                x-text="selectedPlot && selectedPlot.status ? selectedPlot.status : 'Non spécifié'"></span>
        </li>

        <li><strong>Agriculteur:</strong>
            <span
                x-text="selectedPlot && selectedPlot.user ? selectedPlot.user : 'Non spécifié'"></span>
        </li>

    </ul>
</div>
