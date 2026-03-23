@aware([
    'placeholder'   => 'Type to search...',
    'disabled'      => false,
    'search'        => null,
    'clearable'     => false,
    'invalid'       => false,
    'icon'          => null,
    'iconAfter'     => 'chevron-up-down',
    'size'          => 'default',
    'triggerLabel'  => 'Type to search...',
])

@php
    $wrapperClasses=[
        '[&_[data-slot=icon]]:opacity-40 [&_[data-slot=icon]]:cursor-auto' => $disabled,
        'relative grid items-start grid-cols-[1fr_auto]',
    ];

    $classes = [
        'border-red-600/30 border-2 focus-within:border-red-600/30 focus-within:ring-red-600/20 dark:border-red-400/30 dark:focus-within:border-red-400/30 dark:focus-within:ring-red-400/20' => $invalid,
        'border-black/10 focus-within:border-black/15 focus-within:ring-neutral-900/15 dark:border-white/15 dark:focus-within:border-white/20 dark:focus-within:ring-neutral-100/15' => !$invalid,
        'focus-within:ring-2 focus-within:ring-offset-0 focus-within:outline-none',
        'border bg-white dark:bg-neutral-900 dark:text-gray-300 rounded-box',
        'col-span-4 col-start-1 row-start-1 justify-self-stretch',
        'flex flex-wrap items-center cursor-text',
        'transition-shadow duration-150',
        'disabled:opacity-60',
        match($size) {
            'sm'    => 'min-h-8 p-0.5 gap-0.5 pr-4',
            default => 'min-h-10 p-1 gap-1 pr-8',
        }
    ];
@endphp

<div
    {{ $attributes->class($wrapperClasses) }}
    x-on:click="$rover.input.focus()"
    x-bind:data-open="__isOpen"
    x-ref="trigger"
    data-slot="trigger"
    wire:ignore
>
    <div
        data-slot="combobox-control"
        @class($classes)
    >
        {{-- Leading icon --}}
        @if (filled($icon))
            <x-ui.icon
                :name="$icon"
                @class([
                    'shrink-0 text-neutral-400 dark:text-neutral-500',
                    match($size) { 'sm' => 'size-4 ml-1', default => 'size-4 ml-1.5' }
                ])
            />
        @endif
        
        <template x-if="__isMultiple">
            <template x-for="(item, index) in selectedTags" x-bind:key="item.value">
                <div
                    @class([
                        'bg-neutral-100 text-neutral-800 dark:bg-neutral-800 dark:text-neutral-200',
                        'inline-flex items-center rounded-md font-medium shrink-0 max-w-full',
                        'border border-black/5 dark:border-white/10',
                        'text-sm p-1'
                    ])
                >
                    <span class="truncate" x-text="item.label"></span>
                    <button
                        class="ml-1 rounded-sm hover:bg-black/5 dark:hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-neutral-400/30"
                        x-bind:aria-label="'Remove ' + item.label"
                        x-on:click.stop="deselect(item.value)"
                        type="button"
                    >
                        <x-ui.icon name="x-mark" class="size-3.5 opacity-60" />
                    </button>
                </div>
            </template>
        </template>
        
        @if ($search instanceof \Illuminate\View\ComponentSlot)
            {{ $search }}        
        @else
            <x-ui.combobox.input />
        @endif
    </div>

    @if (filled($iconAfter))
        <div
            class="col-span-1 col-start-2 row-start-1 pt-1 pr-1 h-full justify-self-center ml-1"
            @if ($clearable) x-show="!hasSelection" @endif
            x-on:click="open()"
            data-slot="icon"
            x-cloak
        >
            <x-ui.icon
                :name="$iconAfter"
                @class([
                    'rounded-md dark:hover:bg-white/5 hover:bg-neutral-800/5',
                    match($size) {
                        'sm'    => 'size-6 p-0.75',
                        default => 'size-8 p-1',
                    }
                ])
            />
        </div>
    @endif

    @if ($clearable)
        <div
            class="col-span-1 col-start-2 row-start-1 pt-1 pr-1 justify-self-center h-full ml-1"
            x-bind:class="!hasSelection && 'opacity-50'"
            x-on:keydown.space.prevent.stop="clear"
            x-bind:aria-disabled="!hasSelection"
            x-on:keydown.enter.stop="clear"
            aria-label="Clear selection"
            data-slot="combobox-clear"
            x-on:click.stop="clear"
            x-show="hasSelection"
            role="button"
            tabindex="0"
            x-cloak
        >
            <x-ui.icon
                name="x-mark"
                @class([
                    'rounded-md dark:hover:bg-white/5 hover:bg-neutral-800/5',
                    match($size) {
                        'sm'    => 'size-6 p-0.75',
                        default => 'size-8 p-1',
                    }
                ])
            />
        </div>
    @endif
</div>