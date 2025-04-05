@props([
    'title' => 'string',
])

<p {{ $attributes->merge(['class' => 'text-[15px] font-medium text-center']) }}>{{ $title }}</p>
