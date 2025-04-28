@props([
    'buttonText' => __('Se déconnecter'),
    'buttonClass' =>'transition-all duration-300',
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
            <i class="fa-solid fa-sign-out w-5 mr-3 text-gray-400"></i>
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
                <button class="inline-flex items-center px-4 py-3 bg-white border border-green-300 rounded-md font-semibold text-xs text-green-700 tracking-widest shadow-sm hover:bg-green-50 focus:outline-none disabled:opacity-25 cursor-pointer transition ease-in-out duration-150" x-on:click="$dispatch('close-modal', 'confirm-logout')">
                    {{ $cancelText }}
                </button>
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
