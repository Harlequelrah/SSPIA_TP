@props(['title', 'count', 'class'])

<div class="bg-white rounded-lg shadow-lg p-6 border-l-4 {{ $class }} flex flex-col items-center justify-center h-32 w-full">
    <h2 class="text-lg font-semibold text-center">{{ $title }}</h2>
    <p class="text-3xl font-bold mt-2">{{ $count }}</p>
</div>