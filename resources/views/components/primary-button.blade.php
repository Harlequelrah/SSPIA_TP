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
        'class' =>
            'flex justify-center items-center px-5 py-3 bg-gradient-to-r from-teal-700 to-teal-800 rounded-lg font-medium text-sm text-white tracking-widest  hover:from-teal-600 hover:to-teal-700 shadow-sm focus:bg-teal-700 active:bg-teal-900 focus:outline-none cursor-pointer transition ease-in-out duration-150 disabled:cursor-not-allowed',
    ]) }}

    :disabled="loading" :class="loading ? 'opacity-75' : ''">
    <span x-show="!loading" class="flex items-center space-x-2">{{ $slot }}</span>

    @if ($showLoader)
        <span x-show="loading" class="flex items-center">
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
