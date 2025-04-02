<div class="mt-4 px-4">
    <x-back-to-home />

    <div class="flex flex-col md:flex-col lg:flex-row lg:items-start lg:justify-around gap-6">
        <!-- Liste des parcelles -->
        <h1 class="font-bold text-lg md:block lg:hidden">Liste des parcelles</h1>
        <div class="flex md:overflow-x-auto md:space-x-4 lg:flex-col lg:space-y-4 lg:overflow-y-auto lg:h-[730px] sm:w-[700px] lg:w-[400px] sm:overflow-x-auto sm:space-x-4">
            <h1 class="font-bold mb-4 text-lg hidden md:hidden lg:block">Liste des parcelles</h1>

            <x-info-plot status="En culture" size="2 hectares" crop="Blé" plantationDate="2024-12-26" />
            <x-info-plot status="En culture" size="2 hectares" crop="Blé" plantationDate="2024-12-26" />
            <x-info-plot status="En culture" size="2 hectares" crop="Blé" plantationDate="2024-12-26" />
            <x-info-plot status="En culture" size="2 hectares" crop="Blé" plantationDate="2024-12-26" />
            <x-info-plot status="En culture" size="2 hectares" crop="Blé" plantationDate="2024-12-26" />
        </div>

        <!-- Formulaire d'ajout d'une parcelle -->
        <x-form-plot class="w-full lg:w-full sm:max-w-3xl" />
    </div>
</div>