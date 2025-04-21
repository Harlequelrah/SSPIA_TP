@props([
    'type' => 'text',
    'id' => null,
    'name' => null,
    'disabled' => false,
    'value' => null,
])
<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'w-full p-2 border rounded-lg border-slate-400 bg-slate-200 focus:bg-white focus:border-green-500 focus:outline-none']) }}
    @if ($id) id="{{ $id }}" @endif
    @if ($name) name="{{ $name }}" @endif type="{{ $type }}"
    value="{{ $value }}" />
