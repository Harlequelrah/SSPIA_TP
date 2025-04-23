<button
    {{ $attributes->merge(['type' => 'reset', 'class' => 'inline-flex items-center px-4 py-3 bg-white border border-green-300 rounded-md font-semibold text-xs text-green-700 tracking-widest shadow-sm hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2  disabled:opacity-25 cursor-pointer transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
