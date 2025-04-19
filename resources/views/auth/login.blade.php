<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - SSPAI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            background-size: cover;
            background-position: center;
            transition: background-image 1s ease-in-out;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
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
                <label for="email" class="block text-white mb-1">E-mail</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2 rounded-lg bg-white/20 text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-white border border-white/30">
                @error('email')
                    <span class="text-red-300 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div class="mb-4" x-data="{ show: false }">
                <label for="password" class="block text-white mb-1">Mot de passe</label>
                <div class="flex items-center space-x-2">
                    <input :type="show ? 'text' : 'password'" id="password" name="password" required
                        class="w-full px-4 py-2 rounded-lg bg-white/20 text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-white border border-white/30">
                    <i class="fas cursor-pointer text-white" :class="show ? 'fa-eye-slash' : 'fa-eye'" @click="show = !show"></i>
                </div>
                @error('password')
                    <span class="text-red-300 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Connexion -->
            <button type="submit"
                class="w-full py-2 mt-4 bg-white text-green-900 font-semibold rounded-full hover:bg-purple-200 transition">
                Connexion
            </button>

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



