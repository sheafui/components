@props([
    'label',
    'disabled' => false,
])

@php
    $classes=[
        'contents',
        // if this followed by a separator or another submenu, compensite the missed space-y-(--dropdown-padding) caused by `contents` class
        '[&+[data-slot=dropdown-separator]]:mt-1',
        '[&+[data-slot=dropdown-submenu]_[data-slot=dropdown-item]]:mt-1',
    ]
@endphp

<div x-data="{ isOpen: false }" 
    class="{{ Arr::toCssClasses($classes) }}"
    data-slot="dropdown-submenu"
>
    <x-ui.dropdown.item 
        {{ $attributes->merge([ 'disabled' => $disabled, 'tabindex' => $disabled ? '-1' : '0' ]) }}
        x-ref="trigger"
        x-on:mouseenter="isOpen = true"
        x-on:mouseleave="isOpen = false"
        x-on:focus="isOpen = true"
        x-on:keydown.right.prevent.stop="
            isOpen = true;
            $nextTick(() => {
                const el = $refs.panel;
                if (el) $focus.focus($focus.within(el).getFirst());
            })
        "
        active
    >
        <div class="flex items-center justify-between">
            {{ $label }}
            <x-ui.icon name="chevron-right" variant="mini" class="inline-flex shrink-0 ml-2"/>
        </div>
    </x-ui.dropdown.item>

    <div 
        x-show="isOpen"
        x-ref="panel"
        x-anchor.right-start="$refs.trigger"
        x-on:mouseenter="isOpen = true"
        x-on:mouseleave="isOpen = false"
        x-on:keydown.left.prevent.stop="isOpen = false; $focus.focus($refs.trigger)"
        x-on:keydown.escape.prevent.stop="isOpen = false; $focus.focus($refs.trigger)"
        x-on:keydown.down.prevent.stop="$focus.next()"
        x-on:keydown.up.prevent.stop="$focus.prev()"
        x-on:keydown.home.prevent.stop="$focus.first()"
        x-on:keydown.end.prevent.stop="$focus.last()"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        style="display: none;"
        {{ $attributes->class([
            'bg-white dark:bg-neutral-900 ',
            'z-10 [:where(&)]:max-w-96 [:where(&)]:min-w-40 text-start shadow-md border border-black/10 dark:border-white/10',
            'grid grid-cols-[auto_1fr_auto]',
            'rounded-(--dropdown-radius) p-(--dropdown-padding) [--dropdown-radius:var(--radius-box)] [--dropdown-padding:--spacing(.75)]',
        ]) }}
    >
        {{ $slot }}
    </div>
</div>
