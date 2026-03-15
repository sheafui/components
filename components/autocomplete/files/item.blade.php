@props([
    'value' => null,
    'label' => null,
    'disabled' => false,
    'allowCustomSlots' => false
])

@php
    $value = filled($value) ? $value : $slot->__toString();
    $label = filled($label) ? $label : $slot->__toString();

    $classes = [
        "rounded-[calc(var(--popup-round)-var(--popup-padding))] group self-center gap-x-2 items-center",
        "focus:bg-neutral-100 focus:dark:bg-neutral-700 px-3 py-0.5 w-full text-[1rem]",
        '[&[aria-disabled=true]]:pointer-events-none [&[aria-disabled=true]]:opacity-50',
        "data-active:bg-neutral-800/5 dark:data-active:bg-white/5",
        '[ul:is([data-loading])>&]:hidden',
    ];
@endphp

<li 
    data-label="{{ $label }}"
    value="{{ $value }}"
    data-slot="autocomplete-item"
    x-rover:option
    {{-- morph will remove data-value for none changed els so the init ain't re-run --}} 
    wire:ignore.self
    
    @if($disabled) disabled aria-disabled="true" @endif

    {{ $attributes->class($classes) }}
>
    {{ $slot }}
</li>
