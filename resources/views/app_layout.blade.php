<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ str_replace('_TP', '', config('app.name')) }} | @yield('title', 'Tableau de bord') </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        @include('includes.sidebar')
        <!-- Contenu principal -->
        <main class="flex-1">
            @include('includes.navbar')
            <div class="mt-4 p-4">
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>
