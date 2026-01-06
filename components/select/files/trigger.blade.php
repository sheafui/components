@aware([
    'icon' => '',
    'iconAfter' => 'chevron-up-down',
    'disabled' => false,
    'clearable' => false,
    'searchable' => false,
    'triggerClass' => '',
    'invalid' => false,
    'trigger' => null,
])
<div 
    x-ref="selectTrigger" 
    data-slot="trigger" 
    role="combobox"
    {{ $attributes->class([
        'relative grid place-items-center grid-cols-[40px_1fr_26px_35px]',
        // when there is a left icon, give the select-control button padding-left so text doesn't overlap
        '[&>[data-slot=icon]+[data-slot=select-control]]:pl-10',
        // when there is only one icon (iconAfter), give button padding-right for single icon
        '[&:has([data-slot=select-control]+[data-slot=icon])>[data-slot=select-control]]:pr-7',
        // when there are two icons (iconAfter + clearable), give button more padding-right
        '[&:has([data-slot=select-control]+[data-slot=icon]+[data-slot=select-clear])>[data-slot=select-control]]:pr-14',
        // disable left icon opacity and cursor if component is disabled
        '[&_[data-slot=icon]]:opacity-40 [&_[data-slot=icon]]:cursor-auto' => $disabled,
    ]) }}
>
    @if (filled($icon))
        <x-ui.icon 
            :name="$icon"
            class="col-span-1 col-start-1 row-start-1 text-black flex items-center justify-center z-10 !size-[1.10rem]"
        />
    @endif

    <button 
        x-on:click="toggle()"
        x-bind:aria-expanded="open"
        type="button"
        aria-haspopup="listbox"
        data-slot="select-control"
        {{ $attributes->class([
            'border bg-white truncate border-black/10 dark:bg-neutral-900 dark:border-white/15 rounded-box text-base sm:text-sm px-2 py-2 text-start focus:ring-2 focus:ring-offset-0 focus:outline-none focus:border-black/15 dark:focus:border-white/20 focus:ring-neutral-900/15 dark:focus:ring-neutral-100/15',
            'col-span-4 col-start-1 row-start-1 justify-self-stretch',
            // make button span all available grid columns 
            'disabled:opacity-60 flex items-center disabled:cursor-auto cursor-pointer',
            'overflow-hidden whitespace-nowrap', 
            'border-red-500/50!' => $invalid, 
            $triggerClass, 
        ]) }}
        {{-- when not searchable, the trigger who managed the active aria... --}}
        x-bind:aria-activedescendant="!isSearchable && activeIndex !== null ? 'option-' + activeIndex : null"
        @disabled($disabled)
    >
        <span class="truncate block w-full text-base sm:text-sm">
            <span x-text="label">select...</span>
        </span>
    </button>

    @if (filled($iconAfter))
        <x-ui.icon
            :name="$iconAfter" 
            class="col-span-1 row-start-1 [&:has(+[data-slot=select-clear])]:col-start-3 [&:not(:has(+[data-slot=select-clear]))]:col-start-4 !size-[1.15rem]"
        />
    @endif

    @if ($clearable)
        <x-ui.icon
            name="trash"
            data-slot="select-clear"
            x-on:click="clear"
            class="col-span-1 row-start-1 !size-[1.15rem] col-start-4 cursor-pointer"
            x-bind:class="!hasSelection && 'opacity-50'"
        />
    @endif
</div>
