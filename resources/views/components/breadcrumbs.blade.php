@props(['links'])

<nav class="text-sm text-gray-600 mb-4" aria-label="breadcrumb">
    <ol class="list-reset flex">
        @foreach ($links as $label => $url)
            <li>
                @if (!$loop->last)
                    <a href="{{ $url }}" class="text-blue-600 hover:underline">{{ $label }}</a>
                    <span class="mx-2">/</span>
                @else
                    <span class="text-gray-800 font-semibold">{{ $label }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
