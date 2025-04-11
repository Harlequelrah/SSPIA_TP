<div class="p-4 border rounded-lg bg-green-50 shadow mt-4" x-show="selectedIntervention">
    <h2 class="text-xl font-bold text-[#4a7c59] mb-4">
        Détails de l'intervention <span x-text="selectedIntervention ? selectedIntervention.id : ''"></span>
    </h2>
    <ul class="space-y-2">
        <li><strong>ID:</strong> <span x-text="selectedIntervention ? selectedIntervention.id : ''"></span></li>
        <li><strong>Parcelle:</strong> <span x-text="selectedIntervention ? selectedIntervention.plot.name : ''"></span>
        </li>
        <li><strong>Type:</strong> <span
                x-text="selectedIntervention ? selectedIntervention.intervention_type : ''"></span></li>
        <li><strong>Date:</strong> <span
                x-text="selectedIntervention ? selectedIntervention.intervention_date : ''"></span></li>
        <li><strong>Description:</strong>
            <span
                x-text="selectedIntervention && selectedIntervention.description ? selectedIntervention.description : 'Non spécifié'"></span>
        </li>

        <li><strong>Quantité:</strong>
            <span
                x-text="selectedIntervention && selectedIntervention.product_used_quantity ? selectedIntervention.product_used_quantity : 'Non spécifié'"></span>
        </li>

    </ul>
</div>
