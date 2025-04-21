@props(['message', 'color' => 'green', 'icon' => 'fa-circle-check'])

<div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 4000)"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2"
    @class([
        'fixed text-md p-3 rounded-lg bottom-4 right-4 z-50 shadow-lg',
        "bg-{$color}-100" => $color,
        "text-{$color}-900" => $color,
    ])>

    <i @class(["fa-solid", $icon, "text-{$color}-600", "mr-2"])></i>
    <span class="text-sm">
        {{ $message }}
    </span>
</div>
