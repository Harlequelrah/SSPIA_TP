<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ str_replace('_TP', '', config('app.name')) }} | @yield('title', 'Tableau de bord') </title>
    @vite(["resources/css/app.css", "resources/js/app.js", "node_modules/@fortawesome/fontawesome-free/webfonts/fa-regular-400.ttf"])
    <link rel="shortcut icon" href="{{ URL('assets/logo.jpg') }}" type="image/x-icon" class="rounded-full">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    @livewireStyles()
</head>

<body class="bg-slate-50 font-sans h-screen flex flex-col">
<div class="flex flex-grow overflow-hidden">
    <!-- Sidebar - fixe -->
    <aside class="h-screen sticky top-0 flex-shrink-0">
        @include('includes.sidebar')
    </aside>

    <!-- Contenu principal -->
    <div class="flex-1 flex flex-col">
        <!-- Navbar - fixe -->
        <header class="sticky top-0 z-0 flex-shrink-0">
            @include('includes.navbar')
        </header>

        <!-- Zone de contenu scrollable -->
        <main class="flex-1 overflow-y-auto bg-slate-50 p-6">
            <!-- Fil d'Ariane (breadcrumb) -->
            <div class="flex items-center text-sm text-slate-500 mb-6">
                <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors">
                    <i class="fa-solid fa-home"></i>
                </a>
                <i class="fa-solid fa-chevron-right mx-2 text-xs text-slate-400"></i>
                <span class="text-slate-700 font-medium">@yield('title')</span>
            </div>

            <!-- Contenu de la page -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 mb-6">
                @yield('content')
            </div>

            <!-- Footer -->
            <div class="text-center text-sm text-slate-500 mt-4 pb-4">
                &copy; {{ date('Y') }} {{ str_replace('_TP', '', config('app.name')) }} - Tous droits réservés
            </div>
        </main>
    </div>
</div>

@stack('scripts')
@livewireScripts()
</body>

</html>
