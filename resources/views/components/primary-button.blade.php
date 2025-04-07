<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-3 bg-green-800  border border-transparent rounded-md font-semibold text-sm text-white tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 cursor-pointer transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
