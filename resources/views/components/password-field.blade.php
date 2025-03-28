<div x-data="{ show: false }" {{ $attributes->merge(['class' => 'flex items-center']) }}>
    <button
        type="button" 
        @click="show = !show" 
        class="text-gray-500 p-2.5 rounded-lg"
    >
        <x-icon :show="!show" name="eye" /> 
        <x-icon :show="show" name="eye-slash" />
    </button>
</div>