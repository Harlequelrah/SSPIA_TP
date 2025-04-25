<div x-show="activeTab === 'notifications'" x-cloak class="p-8">
    <div class="bg-white rounded-lg mb-8">
        <h3 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-bell text-green-500 text-md mr-2"></i>
            Préférences de notifications
        </h3>

        <div class="space-y-4">
            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                <div>
                    <h4 class="text-gray-800 font-medium">Notifications par e-mail</h4>
                    <p class="text-gray-600 text-sm">Recevez des mises à jour et des alertes importantes par
                        e-mail</p>
                </div>
                <div class="flex items-center">
                    <button
                        class="relative inline-flex items-center h-6 rounded-full w-11 bg-green-500 transition-colors duration-200 ease-in-out focus:outline-none">
                        <span
                            class="inline-block w-4 h-4 transform bg-white rounded-full translate-x-6 transition duration-200 ease-in-out"></span>
                    </button>
                </div>
            </div>

            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                <div>
                    <h4 class="text-gray-800 font-medium">Notifications push</h4>
                    <p class="text-gray-600 text-sm">Recevez des notifications instantanées sur votre
                        navigateur</p>
                </div>
                <div class="flex items-center">
                    <button
                        class="relative inline-flex items-center h-6 rounded-full w-11 bg-gray-300 transition-colors duration-200 ease-in-out focus:outline-none">
                        <span
                            class="inline-block w-4 h-4 transform bg-white rounded-full translate-x-1 transition duration-200 ease-in-out"></span>
                    </button>
                </div>
            </div>

            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                <div>
                    <h4 class="text-gray-800 font-medium">Alertes de sécurité</h4>
                    <p class="text-gray-600 text-sm">Soyez alerté des tentatives de connexion suspectes</p>
                </div>
                <div class="flex items-center">
                    <button
                        class="relative inline-flex items-center h-6 rounded-full w-11 bg-green-500 transition-colors duration-200 ease-in-out focus:outline-none">
                        <span
                            class="inline-block w-4 h-4 transform bg-white rounded-full translate-x-6 transition duration-200 ease-in-out"></span>
                    </button>
                </div>
            </div>

            <div class="flex justify-between items-center py-3">
                <div>
                    <h4 class="text-gray-800 font-medium">Newsletter</h4>
                    <p class="text-gray-600 text-sm">Recevez nos dernières actualités et offres spéciales</p>
                </div>
                <div class="flex items-center">
                    <button
                        class="relative inline-flex items-center h-6 rounded-full w-11 bg-gray-300 transition-colors duration-200 ease-in-out focus:outline-none">
                        <span
                            class="inline-block w-4 h-4 transform bg-white rounded-full translate-x-1 transition duration-200 ease-in-out"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
