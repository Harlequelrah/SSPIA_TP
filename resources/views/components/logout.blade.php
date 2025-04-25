@props([
    'buttonText' => __('Se déconnecter'),
    'buttonClass' =>
        'px-4 py-2 bg-red-300 text-white w-full rounded-lg flex items-center duration-200 transition-color justify-center mt-4 hover:bg-red-500 cursor-pointer',
    'modalTitle' => 'Déconnectez-vous',
    'modalMessage' => 'Voulez-vous vraiment vous déconnecter ?',
    'cancelText' => 'Annuler',
    'confirmText' => 'Oui',
    'confirmBtnClass' => 'bg-red-500 hover:bg-red-600 transition duration-200 focus:bg-red-700',
    'showIcon' => true,
])

<div x-data>
    <!-- Bouton pour ouvrir le modal -->
    <a x-on:click="$dispatch('open-modal', 'confirm-logout')" {{ $attributes->merge(['class' => $buttonClass]) }}>
        @if ($showIcon)
            <i class="fa-solid fa-sign-out mr-2"></i>
        @endif
        {{ $buttonText }}
    </a>

    <!-- Modal de confirmation pour la déconnexion -->
    <x-modal name="confirm-logout" maxWidth="md">
        <div class="p-6">
            <h2 class="text-lg font-medium text-red-500">
                {{ $modalTitle }}
            </h2>
            <p class="mt-1 text-sm text-slate-600">
                {{ $modalMessage }}
            </p>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close-modal', 'confirm-logout')">
                    {{ $cancelText }}
                </x-secondary-button>
                <form method="POST" action="{{ route('logout') }}" class="ml-3">
                    @csrf
                    <x-primary-button class="{{ $confirmBtnClass }}"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ $confirmText }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </x-modal>
</div>
