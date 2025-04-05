@props(['route', 'icon', 'label', 'active'])

@php
    $isActive = request()->routeIs($active);
@endphp

<a href="{{ route($route) }}"
    class="mb-2 flex items-center rounded-lg transition px-3 py-2 space-x-2 cursor-pointer
           {{ $active ? 'bg-white text-black' : 'text-white hover:bg-slate-100 hover:text-black' }}">
    <i class="fa-solid {{ $icon }} block"></i>
    <span>{{ $label }}</span>
</a>
