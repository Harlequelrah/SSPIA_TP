@props([
    'type' => 'text',
    'id' => null,
    'name' => null,
    'disabled' => false,
    'value' => null,
])
<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 outline-none']) }}
    @if ($id) id="{{ $id }}" @endif
    @if ($name) name="{{ $name }}" @endif type="{{ $type }}"
    value="{{ $value }}" />
