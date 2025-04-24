    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Changer votre mot de passe | SSPIA</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel='icon' href="{{ URL('assets/logo.jpg') }}" type='image/x-icon' class="rounded-full">
    </head>

    <body class="flex flex-col min-h-screen bg-gray-100">
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ URL('assets/logo.jpg') }}" alt="SSPIA Logo" class="h-10 w-auto">
                        </a>
                        <h1 class="ml-3 text-xl font-bold text-gray-800">SSPIA</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700">{{ Auth::user()->name }}</span>
                        <x-logout
                            buttonClass="px-3 py-1 bg-red-400  cursor-pointer text-white rounded hover:bg-red-500 transition duration-200"
                            confirmBtnClass="bg-blue-600 hover:bg-blue-700" />
                    </div>
                </div>
            </div>
        </header>
        @if (session('success'))
            <x-notification :message="session('success')" color="green" icon="fa-circle-check" />
        @elseif (session('error'))
            <x-notification :message="session('error')" color="red" icon="fa-circle-exclamation" />
        @endif
        <!-- Main Content -->
        <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-md">
                <div class="flex justify-center mb-6">
                    <div class="p-2 rounded-full bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                </div>

                <h2 class="text-2xl font-bold mb-6 text-center">Changer votre mot de passe</h2>

                @if (session('error'))
                    <div class="mb-4 p-3 bg-red-100 text-red-600 rounded-lg flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-600 rounded-lg flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('password.change') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="mb-5">
                        <x-input-label for="current_password" class="mb-2" :value="__('Mot de passe actuel')" />
                        <x-input-field type="password" id="current_password" name="current_password"
                            value="{{ old('current_password') }}"
                            class="w-full px-4 py-2 rounded-lg bg-black/30 border-gray" />
                        @error('current_password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <x-input-label for="new_password" class="mb-2" :value="__('Nouveau mot de passe')" />
                        <x-input-field type="password" id="new_password" name="new_password"
                            value="{{ old('new_password') }}"
                            class="w-full px-4 py-2 rounded-lg bg-black/30 border-gray" />
                        @error('new_password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <x-input-label for="new_password_confirmation" class="mb-2" :value="__('Confirmer le nouveau mot de passe')" />
                        <x-input-field type="password" id="new_password_confirmation" name="new_password_confirmation"
                            value="{{ old('new_password_confirmation') }}"
                            class="w-full px-4 py-2 rounded-lg bg-black/30 border-gray" />
                    </div>

                    <div class="mt-8">
                        <x-primary-button class="w-full flex justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Mettre à jour

                        </x-primary-button>
                    </div>
                </form>

                {{-- <div class="mt-6 text-center">
                    <a href="{{ route('dashboard') }}"
                        class="text-sm text-blue-600 hover:text-blue-800 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        Retour au tableau de bord
                    </a>
                </div> --}}
            </div>
        </main>

        <!-- Footer -->
        <x-footer />
    </body>

    </html>
