@props(['message', 'color', 'icon'])


<div
    class="absolute text-md bg-{{ $color }}-100 bottom-0 right-0 text-{{ $color }}-900 p-3 rounded-lg mb-4">
    <i class="fa-solid {{ $icon }} text-{{ $color }}-600 mr-2"></i>
    <span class="text-sm">
        {{ $message }}
    </span>
</div>
