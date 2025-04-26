<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion - SSPAI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(["resources/css/app.css", "resources/js/app.js", "node_modules/@fortawesome/fontawesome-free/webfonts/fa-regular-400.ttf"])
    <style>
        body {
            background-size: cover;
            background-position: center;
            transition: all 1.5s ease;
            position: relative;
            overflow: hidden;
        }

        /* body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: -1;
        } */

        .slide-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            transition: opacity 1.5s ease-in-out;
            z-index: -2;
        }

        /* .login-card {
            transform: translateY(0);
            transition: transform 0.6s ease, box-shadow 0.6s ease;
        } */

        /* .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        } */

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(72, 187, 120, 0.7);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(72, 187, 120, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(72, 187, 120, 0);
            }
        }

        .btn-shine {
            position: relative;
            overflow: hidden;
        }

        .btn-shine:after {
            content: '';
            position: absolute;
            top: -50%;
            left: -100%;
            width: 70%;
            height: 200%;
            background: linear-gradient(to right,
                    rgba(255, 255, 255, 0) 0%,
                    rgba(255, 255, 255, 0.3) 50%,
                    rgba(255, 255, 255, 0) 100%);
            transform: rotate(25deg);
            transition: all 0.7s;
        }

        .btn-shine:hover:after {
            left: 100%;
        }
    </style>
    <link rel='icon' href="{{ URL('assets/logo.jpg') }}" type='image/x-icon'>
</head>

<body class="min-h-screen flex items-center justify-center">
    <!-- Background slides -->
    <div id="slide1" class="slide-bg opacity-100"></div>
    <div id="slide2" class="slide-bg opacity-0"></div>
    <div id="slide3" class="slide-bg opacity-0"></div>

    <div
        class="w-full max-w-md login-card bg-white/15 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-white/20">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="flex flex-col items-center mb-8">
                <div class="relative mb-6">
                    <img src="{{ asset('assets/logo.jpg') }}" alt="logo"
                        class="w-24 h-24 rounded-full shadow-lg pulse object-cover border-4 border-white/30">
                    <div
                        class="absolute -bottom-3 -right-3 bg-green-500 text-white rounded-full w-10 h-10 flex items-center justify-center shadow-lg">
                        <i class="fas fa-leaf"></i>
                    </div>
                </div>
                <h2 class="text-white text-xl font-bold text-center leading-tight">
                    Système de Suivi des Parcelles<br>et des Interventions Agricoles
                </h2>
                <div class="w-16 h-1 bg-gradient-to-r from-green-300 to-green-600 rounded-full mt-3"></div>
            </div>
            <!-- E-mail -->
            <div class="mb-6">
                <x-input-label for="email" :value="__('E-mail')" class="text-white font-medium mb-2 flex items-center" />
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-white/70">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <x-input-field type="email" id="email" name="email" value="{{ old('email') }}"
                        class="input-field pl-10 bg-white/20 border-white/30 focus:border-green-400 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                        placeholder="votre@email.com" />
                </div>
                @error('email')
                    <span class="text-red-300 text-sm mt-1 block"><i
                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                @enderror
            </div>
            <!-- Mot de passe -->
            <div class="mb-6">
                <x-input-label for="password" :value="__('Mot de passe')" class="text-white font-medium mb-2 flex items-center" />
                <div class="relative" x-data="{ obscuredText: true }">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-white/70">
                        <i class="fas fa-lock"></i>
                    </span>
                    <x-input-field id="password"
                        class="input-field pl-10 bg-white/20 border-white/30 focus:border-green-400 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                        x-bind:type="obscuredText ? 'password' : 'text'" name="password" placeholder="••••••••" />
                    <button type="button" @click="obscuredText = !obscuredText"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white/70 hover:text-white transition">
                        <i :class="obscuredText ? 'fas fa-eye' : 'fas fa-eye-slash'"></i>
                    </button>
                </div>
                @error('password')
                    <span class="text-sm text-red-300 mt-1 block"><i
                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                @enderror
            </div>
            
            <!-- Connexion -->
            <x-primary-button
                class="w-full justify-center py-3 text-base font-medium btn-shine bg-gradient-to-r from-green-500 to-green-700 hover:from-green-600 hover:to-green-800 transition-all duration-300 transform hover:scale-[1.02]">
                <i class="fas fa-sign-in-alt mr-2"></i>Connexion
            </x-primary-button>
            <!-- Mot de passe oublié -->
            <div class="text-center mt-6">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-white/80 text-sm hover:text-white hover:underline transition-all flex items-center justify-center">
                        <i class="fas fa-question-circle mr-1"></i>
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Script JS pour les animations -->
    <script>
        // Array of backgrounds
        const images = [
            "{{ asset('assets/bg1.jpg') }}",
            "{{ asset('assets/bg2.jpg') }}",
            "{{ asset('assets/bg3.jpg') }}"
        ];

        // Set initial backgrounds
        document.getElementById('slide1').style.backgroundImage = `url('${images[0]}')`;
        document.getElementById('slide2').style.backgroundImage = `url('${images[1]}')`;
        document.getElementById('slide3').style.backgroundImage = `url('${images[2]}')`;

        let current = 0;

        function changeBackground() {
            // Fade out current slide
            document.getElementById(`slide${current + 1}`).style.opacity = "0";

            // Update current slide index
            current = (current + 1) % 3;

            // Fade in new slide
            document.getElementById(`slide${current + 1}`).style.opacity = "1";

            // Change body background color for transition effect
            const colors = ['#1a341a', '#2c3e50', '#141e30'];
            document.body.style.backgroundColor = colors[current];
        }

        // Change every 7 seconds for better viewing experience
        setInterval(changeBackground, 10000);

        // Add a smooth entrance animation
        window.addEventListener('load', function() {
            const loginCard = document.querySelector('.login-card');
            loginCard.style.opacity = 0;
            loginCard.style.transform = 'translateY(20px)';

            setTimeout(() => {
                loginCard.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                loginCard.style.opacity = 1;
                loginCard.style.transform = 'translateY(0)';
            }, 300);
        });
    </script>
</body>

</html>
