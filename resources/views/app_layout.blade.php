<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ str_replace('_TP', '', config('app.name')) }} | @yield('title', 'Tableau de bord') </title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @livewireStyles()
</head>

<body class="bg-gray-100 overflow-hidden h-screen">
    <div class="flex h-full">
        <!-- Sidebar -->
        <div class="sticky top-0 h-screen">
            @include('includes.sidebar')
        </div>
        <!-- Contenu principal -->
        <div class="flex-1 flex flex-col h-screen">
            <div class="sticky top-0 z-10">
                @include('includes.navbar')
            </div>
            <main class="flex-1 overflow-y-auto p-4">
                @if (request()->route() == 'dashboard.index')
                    @include('dashboard')
                @else
                    @yield('content')
                @endif
            </main>
        </div>
    </div>
    @livewireScripts()
</body>

</html>
