<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tableau de bord')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-green-700 text-white min-h-screen p-4">
            <h2 class="text-xl font-bold mb-4">SSPIA</h2>
            <nav>
                <ul>
                    <li class="mb-2"><a href="{{ route('dashboard') }}" class="block p-2 hover:bg-green-600">🏠 Tableau de bord</a></li>
                    <li class="mb-2"><a href="{{ route('parcelles.index') }}" class="block p-2 hover:bg-green-600">📍 Parcelles</a></li>
                    <li class="mb-2"><a href="{{ route('interventions.index') }}" class="block p-2 hover:bg-green-600">⚙️ Interventions</a></li>
                    <li class="mb-2"><a href="#" class="block p-2 hover:bg-green-600">👤 Utilisateurs</a></li>

                </ul>
            </nav>
        </aside>

        <!-- Contenu principal -->
        <main class="flex-1 p-6">
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <h1 class="text-xl font-bold">@yield('header', 'Bienvenue')</h1>
                <div>
                    <span class="text-gray-700 font-semibold">👤 Jean Dupont</span>
{{-- <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Se déconnecter</button>
</form> --}}
</div>
            </header>

            <div class="mt-4">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
