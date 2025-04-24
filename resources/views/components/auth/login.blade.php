 <div class="w-[450px]">
     <form action="">
         <div class="flex flex-col items-center justify-center">
             <img src="{{ URL('storage/logo.jpg') }}" alt="logo" class="w-20 h-20   ">
             <x-heading-small class="text-center my-6"
                 title="Système de Suivi des 
                  et des Interventions Agricoles" />
         </div>

         <div class="mb-4">
             <label for="username">Nom d'agriculteur</label>
             <x-input-field type="text" id="username" name="username" class="mt-2" />
         </div>

         <div class="mb-4">
             <label for="password">Mot de passe</label>
             <div class="flex space-x-3 items-center mt-2" x-data="{ obscuredText: true }">
                 <x-input-field x-bind:type="obscuredText ? 'password' : 'text'" id="password" name="password" />
                 <i :class="obscuredText ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"
                     class="cursor-pointer text-gray-500" @click="obscuredText = !obscuredText">
                 </i>
             </div>

         </div>

         <button type="submit"
             class="w-full bg-[#4a7c59] text-white p-2 mt-4 rounded-lg cursor-pointer transition-all duration-200 hover:bg-green-800">Connexion</button>
         <x-text-small title="Mot de passe oublié" class="mt-4 underline cursor-pointer text-[#4a7c59] text-center" />
     </form>
 </div>
