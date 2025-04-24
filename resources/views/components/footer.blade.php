@props([
    'showLogo' => true,
    'logoUrl' => URL('assets/logo.jpg'),
    'logoAlt' => 'SSPIA Logo',
    'appName' => 'SSPIA',
    'appFullName' => 'Système de Suivi et de Planification des Interventions Agricoles',
    'links' => [['text' => 'Conditions d\'utilisation', 'url' => '#'], ['text' => 'Support', 'url' => '#'], ['text' => 'Contact', 'url' => '#']],
    'bgColor' => 'bg-white',
    'textColor' => 'text-gray-600',
    'linkColor' => 'text-gray-500',
    'linkHoverColor' => 'hover:text-gray-700',
    'showShadow' => true,
])

<footer class="{{ $bgColor }} {{ $showShadow ? 'shadow-inner' : '' }} py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center mb-4 md:mb-0">
                @if ($showLogo)
                    <img src="{{ $logoUrl }}" alt="{{ $logoAlt }}" class="h-8 w-auto mr-2">
                @endif
                <p class="{{ $textColor }}">© {{ date('Y') }} {{ $appName }}
                    @if ($appFullName)
                        - {{ $appFullName }}
                    @endif
                </p>
            </div>

            @if (count($links) > 0)
                <div class="flex space-x-6">
                    @foreach ($links as $link)
                        <a href="{{ $link['url'] }}" class="{{ $linkColor }} {{ $linkHoverColor }}">
                            {{ $link['text'] }}
                        </a>
                    @endforeach
                </div>
            @endif

            {{ $slot ?? '' }}
        </div>
    </div>
</footer>
