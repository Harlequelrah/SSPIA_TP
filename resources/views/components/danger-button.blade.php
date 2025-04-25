@props([
    'showLoader' => true,
])
<button x-data="{ loading: false }" x-on:click="if ({{ $showLoader ? 'true' : 'false' }}) loading = true"
    @click.prevent="
        if ({{ $showLoader ? 'true' : 'false' }}) loading = true;
        $event.target.closest('form')?.submit()
    "
    {{ $attributes->merge([
        'type' => 'submit', 
        'class' => 'inline-flex items-center px-4 py-3 cursor-pointer bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none transition ease-in-out duration-150'
    ]) }} 
    :disabled="loading" :class="loading ? 'opacity-75' : ''">
    <span x-show="!loading" class="flex items-center space-x-2">{{ $slot }}</span>
    @if ($showLoader)
        <span x-show="loading">
            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
        </span>
    @endif
</button>