<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'flex justify-center items-center px-4 py-3 bg-green-800  border border-transparent rounded-md font-semibold text-sm text-white tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none cursor-pointer transition ease-in-out duration-150 disabled:cursor-not-allowed']) }}>
    {{ $slot }}
</button>
