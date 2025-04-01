<div>
    <div class="flex items-center justify-between mb-6">
        <x-heading title="Gestion des parcelles" />

        <button @click="" class="bg-[#4a7c59] text-white px-3 py-2 rounded-lg cursor-pointer">
            <i class="fa-solid fa-plus"></i>
            <span>Ajouter une parcelle</span>
        </button>
    </div>
    <!-- liste des plots -->
    <div class="flex items-center flex-wrap">
        <x-info-plot
            status='En culture' 
            size='2 hectares'
            crop='Blé'
            plantationDate='2024-12-26'
            />
    </div>
</div>