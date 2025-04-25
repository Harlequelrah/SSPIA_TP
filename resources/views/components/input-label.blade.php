@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium mb-1 text-sm text-gray-800']) }}>
    {{ $value ?? $slot }}
</label>
