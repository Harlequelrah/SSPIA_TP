{{-- resources/views/components/info-card.blade.php --}}
@props(['title', 'value' => null])

<div {{ $attributes->merge(['class' => 'bg-white p-4 rounded-lg shadow-sm']) }}>
    <div class="text-sm text-gray-500 mb-1">{{ $title }}</div>
    <div class="font-semibold text-gray-800">
        {{ $value ?? $slot }}
    </div>
</div>
