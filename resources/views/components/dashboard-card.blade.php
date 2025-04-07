@props([
    'title' => '',
    'count' => '',
    'activeMenu' => '',
])

<div
    {{ $attributes->merge(['class' => 'p-4 text-left bg-slate-100 flex flex-col justify-between border-l-4 rounded-2xl shadow-lg w-[200px] h-[150px] hover:scale-105 transition-all duration-200']) }}>
    <h1 class="text-slate-600">{{ $title }}</h1>
    <span class="block text-5xl font-bold">{{ $count }}</span>
</div>
