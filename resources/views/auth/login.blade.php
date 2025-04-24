<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion - SSPAI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/app.css')
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            background-size: cover;
            background-position: center;
            transition: background-image 1s ease-in-out;
        }
    </style>
    <link rel='icon' href="{{ URL('assets/logo.jpg') }}" type='image/x-icon'>
</head>

<body class="min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white/10 backdrop-blur-lg rounded-2xl shadow-xl p-8">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="flex flex-col items-center mb-6">
                <img src="{{ asset('assets/logo.jpg') }}" alt="logo" class="w-24 h-24 rounded-full shadow-md mb-4">
                <h2 class="text-white text-xl font-semibold text-center leading-tight">
                    Système de Suivi des Parcelles<br>et des Interventions Agricoles
                </h2>
            </div>

            <!-- E-mail -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('E-mail')" class="text-white" />
                <x-input-field type="email" id="email" name="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 rounded-lg bg-white/20 border-white/30" />
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Mot de passe')" class="text-white" />
                <div class="flex space-x-3 items-center justify-center mt-1 w" x-data="{ obscuredText: true }">
                    <x-input-field id="password" class="bg-white/20 border-white/30"
                        x-bind:type="obscuredText ? 'password' : 'text'" name="password" />
                    <i :class="obscuredText ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"
                        class="cursor-pointer text-gray-800" @click="obscuredText = !obscuredText">
                    </i>
                </div>
                @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Connexion -->
            <x-primary-button class="w-full mt-5">Connexion</x-primary-button>

            <!-- Mot de passe oublié -->
            <div class="text-center mt-4">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-white underline text-sm hover:text-gray-300">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Script JS pour changer les images -->
    <script>
        const images = [
            "{{ asset('assets/bg1.jpg') }}",
            "{{ asset('assets/bg2.jpg') }}",
            "{{ asset('assets/bg3.jpg') }}"
        ];

        let current = 0;
        const body = document.body;

        function changeBackground() {
            current = (current + 1) % images.length;
            body.style.backgroundImage = `url('${images[current]}')`;
        }

        // Initial background
        body.style.backgroundImage = `url('${images[0]}')`;

        // Changer toutes les 5 secondes
        setInterval(changeBackground, 5000);
    </script>
</body>

</html>
