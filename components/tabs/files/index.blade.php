@aware([ 'variant' => 'outlined', 'size' => 'default'])

@props([
    'label' => null,
    'name' => null,
    'iconAfter' => null,
    'icon' => null,
    'iconVariant' => null,
    'iconClasses' => null,
])

@php
    $classes = match($variant){
        'outlined' => [
            'p-3 dark:border-neutral-300/20 border-neutral-950/10 rounded-box rounded-b-none justify-center focus:outline-none focus:bg-white/5 hover:bg-white/5',
            'data-[active=true]:bg-white dark:data-[active=true]:bg-neutral-800',
            'data-[active=true]:border-b-0', // Remove bottom border when active
            'data-[active=true]:border',
        ],
        'non-contained' => [
            'data-[active=true]:bg-neutral-900/10 dark:data-[active=true]:bg-white/10 text-neutral-900 dark:text-neutral-50',
            'hover:bg-white/10 focus:bg-white/10', // focus and hover
            'rounded-[calc(var(--noncontained-variant-radius)-var(--noncontained-variant-padding))]', // those variables are defined on the group wrapper
        ],
        'pills' => [
            'rounded-full h-8 whitespace-nowrap rounded-full text-sm font-medium',
            'data-[active=true]:bg-(--color-primary) data-[active=true]:text-(--color-primary-fg)'
        ],
        default => [],
    };

    // if tab has name we need to bind it, so we can prirotize it then in orders
    // we can mutate the AttributeBag Objet as an array, it implement \ArrayAccess interafce
    if(filled($name)) $attributes['data-name'] = $name;
@endphp

<x-ui.button
    :attributes="$attributes->class(Arr::toCssClasses($classes))"
    x-on:click="handleTabClick($el)"
    data-slot="tab"
    tabindex="0"
    variant="none"
>
    @if($slot->isNotEmpty())
        <span class="flex-1">{{ $slot }}</span>
    @else
        {{ $label }}
    @endif
</x-ui.button>
