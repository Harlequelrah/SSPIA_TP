@props([
    'showLoader' => true,
    'type' => 'reset' // Par défaut reset, tu peux changer cette valeur à 'submit' ou 'button' si besoin
])

<button 
    x-data="{ loading: false }" 
    x-on:click="if ({{ $showLoader ? 'true' : 'false' }}) loading = true"
    @click.prevent="
        if ({{ $showLoader ? 'true' : 'false' }}) loading = true;
        $event.target.closest('form')?.submit(); // Se soumettre uniquement si type='submit'
    "
    {{ $attributes->merge([
        'class' =>
            'inline-flex items-center px-4 py-3 bg-white border border-green-300 rounded-md font-semibold text-xs text-green-700 tracking-widest shadow-sm hover:bg-green-50 focus:outline-none disabled:opacity-25 cursor-pointer transition ease-in-out duration-150',
    ]) }}
    :disabled="loading" 
    :class="loading ? 'opacity-75' : ''" 
    type="{{ $type }}"> <!-- Le type dynamique est appliqué ici -->
    <span x-show="!loading" class="flex items-center space-x-2">{{ $slot }}</span>
    @if ($showLoader)
        <span x-show="loading" class="flex items-center">
            <svg class="animate-spin h-4 w-4 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </span>
    @endif
</button>
