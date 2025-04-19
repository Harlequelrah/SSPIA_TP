<div class="p-4 border rounded-lg bg-green-50 shadow mt-4" x-show="selectedUser" x-transition>
    <h2 class="text-xl font-bold text-[#4a7c59] mb-4">
        Détails de l'utilisateur <span x-text="selectedUser ? selectedUser.id : ''"></span>
    </h2>
    <ul class="space-y-2 text-sm text-slate-800">
        <li><strong>ID:</strong> <span x-text="selectedUser.id"></span></li>
        <li><strong>Nom complet:</strong> <span x-text="selectedUser.name"></span></li>
        <li><strong>Nom d'utilisateur:</strong> <span x-text="selectedUser.username ?? 'Non renseigné'"></span></li>
        <li><strong>Téléphone:</strong> 
            <span x-text="selectedUser.phone ? selectedUser.phone : 'Non renseigné'"></span>
        </li>
        <li><strong>Email:</strong> <span x-text="selectedUser.email"></span></li>
        <li><strong>Adresse:</strong> 
            <span x-text="selectedUser.address ? selectedUser.address : 'Non renseignée'"></span>
        </li>
        <li><strong>Actif:</strong> 
            <span x-text="!selectedUser.deleted_at ? 'OUI' : 'NON'"></span>
        </li>
    </ul>
</div>
