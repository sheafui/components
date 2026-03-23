@php
    $classes = [
        'rounded-[calc(var(--popup-round)-var(--popup-padding))] col-span-full group self-center gap-x-2 items-center',
        'focus:bg-neutral-100 focus:dark:bg-neutral-700 px-3 py-0.5 w-full text-[1rem]',
        'data-active:bg-neutral-800/5 dark:data-active:bg-white/5',
    ];
@endphp

<li 
    data-slot="create-option" 
    x-data="CreateNewOptionActivator"
    wire:key="create-option"
    {{ $attributes->class($classes) }}
>
    {{ $slot }}
</li>
