{{-- Dans settings.partials.security.blade.php --}}
<div x-show="activeTab === 'security'" x-cloak class="p-8">
    <div class="bg-white rounded-lg mb-8">
        <h3 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-shield text-md text-green-500 mr-2"></i>
            Authentification à deux facteurs
        </h3>
        <div class="bg-gray-50 border border-gray-100 rounded-lg p-4">
            <h2 class="text-center text-xl text-shadow-slate-700">En cours de développement</h2>

{{--            <div class="flex justify-between items-center">--}}
{{--                <div>--}}
{{--                    <h4 class="text-gray-800 font-medium">2FA</h4>--}}
{{--                    <p class="text-gray-600 text-sm">Protégez votre compte avec l'authentification à deux--}}
{{--                        facteurs</p>--}}
{{--                </div>--}}
{{--                <div class="flex items-center">--}}
{{--                    <span class="mr-3 text-sm font-medium text-gray-500">Désactivé</span>--}}
{{--                    <button--}}
{{--                        class="relative inline-flex items-center h-6 rounded-full w-11 bg-gray-300 transition-colors duration-200 ease-in-out focus:outline-none">--}}
{{--                        <span--}}
{{--                            class="inline-block w-4 h-4 transform bg-white rounded-full translate-x-1 transition duration-200 ease-in-out"></span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>

        <h3 class="text-lg font-medium text-gray-800 mt-6 mb-4 flex items-center">
            <i class="fa-solid fa-fingerprint text-md mr-2 text-green-500"></i>
            Sessions actives
        </h3>

        {{-- Sessions actives avec les données récupérées du contrôleur --}}
        <div class="bg-gray-50 border border-gray-100 rounded-lg">
            @forelse($sessions as $session)
                <div class="p-4 @if (!$loop->last) border-b border-gray-100 @endif">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            {{-- Icône conditionnelle selon le type d'appareil --}}
                            @if ($session['platform'] == 'Windows')
                                <i class="fa-solid fa-desktop text-xl text-gray-500 mr-3"></i>
                            @elseif($session['platform'] == 'Phone')
                                <i class="fa-solid fa-mobile-screen-button text-xl text-gray-500 mr-3"></i>
                            @elseif($session['platform'] == 'Tablet')
                                <i class="fa-solid fa-tablet-screen-button text-xl text-gray-500 mr-3"></i>
                            @else
                                <i class="fa-solid fa-question-circle text-xl text-gray-500 mr-3"></i>
                            @endif

                            <div>
                                <h4 class="text-gray-800 font-medium">
                                    {{ $session['is_current_device'] ? 'Cet appareil' : $session['browser'] . ' sur ' . $session['platform'] }}
                                </h4>
                                <p class="text-gray-600 text-sm flex items-center">
                                    <span class="mr-1">{{ $session['ip_address'] }}</span>
                                    <span class="mx-1">·</span>
                                    <span>{{ $session['browser'] }}</span>
                                    <span class="mx-1">·</span>
                                    <span>{{ $session['platform'] }}</span>
                                    <span class="mx-1">·</span>
                                    <span>Dernière activité: {{ $session['last_activity'] }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            @if ($session['is_current_device'])
                                <span
                                    class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full mr-2">Actif</span>
                            @else
                                <form action="{{ route('parametre.sessions.destroy', $session['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-800 text-sm font-medium transition duration-150">
                                        Déconnecter
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-4 text-center text-gray-500">
                    Aucune session active détectée.
                </div>
            @endforelse

            @if (count($sessions) > 1)
                <div class="p-4 bg-gray-100 border-t border-gray-200">
                    <form action="{{ route('parametre.sessions.destroy.all') }}" method="POST" class="text-center">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-red-600 hover:text-red-800 text-sm font-medium flex items-center justify-center mx-auto transition duration-150">
                            <i class="fa-solid fa-power-off mr-2"></i> Déconnecter tous les autres appareils
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
