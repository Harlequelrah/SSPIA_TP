<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ str_replace('_TP', '', config('app.name')) }} | @yield('title', 'Tableau de bord') </title>
    <link rel="shortcut icon" href="{{ URL('assets/logo.jpg') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ URL('assets/logo.jpg') }}" />
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
    @livewireScripts()
</body>

</html>
