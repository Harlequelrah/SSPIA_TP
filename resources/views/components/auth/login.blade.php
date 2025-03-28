 <div class="w-[400px]">
            <form action="">
                <x-heading title="Connexion" class="text-center" />
                <x-heading-small class="text-center" title="Système de Suivi des Parcelles et des Interventions Agricole" />
                <div class="mb-4">
                    <label for="username">Nom d'utilisateur</label>  
                    <x-input-field type="text" id="username" name="username" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label for="password">Mot de passe</label>
                   <div class="flex space-x-3 items-center mt-2" x-data="{ show: false }">
                    <x-input-field x-bind:type="show ? 'text': 'password'" id="password" name="password" />
                    <button type="button" @click="show = !show" class="text-gray-500">
                        <x-icon show="show" name="eye" class="" />
                        <x-icon show="!show" name="eye-slash" class="" />
                    </button>
                   </div> 
                </div>
                <button type="submit" class="w-full bg-[#1d7a4c] text-white p-2 mt-4 rounded-lg cursor-pointer transition-all duration-200 hover:bg-green-800">Connexion</button>
                <x-text-small title="Mot de passe oublié" class="mt-4 underline cursor-pointer text-[#1d7a4c] text-center" />
            </form>
        </div>