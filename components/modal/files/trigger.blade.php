@props([
    'id' => null,
    'shortcut' => []
])

<div x-data>
    <div
        @foreach (Arr::wrap($shortcut) as $item )
            x-on:keydown.{{ $item }}.prevent.window="$modal.open(@js($id))"
        @endforeach
        x-on:click="$modal.open(@js($id))"
        {{ $attributes->merge(["modal-trigger [:where(&)]:inline cursor-pointer"]) }}
    >
        {{ $slot }}
    </div>
</div>