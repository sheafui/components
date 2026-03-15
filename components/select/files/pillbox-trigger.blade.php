@aware([
    'iconAfter' => 'chevron-up-down',
    'disabled' => false,
    'clearable' => false,
    'searchable' => false,
    'triggerClass' => '',
    'invalid' => false,
    'trigger' => null,
    'placeholder' => 'select...',
    'size' => 'default'
])

@php
    $classes = [
        'border-red-600/30 border-2 data-open:border-red-600/30 data-open:ring-red-600/20 dark:border-red-400/30 dark:data-open:border-red-400/30 dark:data-open:ring-red-400/20' => $invalid,
        'border-black/10 data-open:border-black/15 data-open:ring-neutral-900/15 dark:border-white/15 dark:data-open:border-white/20 dark:data-open:ring-neutral-100/15' => !$invalid,
        'border bg-white truncate flex flex-wrap border-black/10 dark:bg-neutral-900 dark:border-white/10 border-gray-300 dark:text-gray-300 rounded-box text-start',
        'data-open:ring-2 data-open:ring-offset-0 data-open:outline-none',
        'disabled:opacity-60 flex disabled:cursor-auto cursor-pointer',
        'col-span-4 col-start-1 row-start-1 justify-self-stretch',
        'overflow-hidden whitespace-nowrap', 
        $triggerClass,
        match($size){
            'sm' => 'min-h-8 p-0.5 gap-0.5',
            default => 'min-h-10 p-1 gap-1'
        } 
    ];
@endphp

<div 
    x-ref="trigger" 
    x-on:click="handleButtonClick"
    wire:ignore
    data-slot="trigger" 
    {{ $attributes->class([
        'relative grid items-start justify-center grid-cols-[1fr_auto]',
        // when there is only one icon (iconAfter), give pillboxes container padding-right for single icon
        '[&:has([data-slot=select-control]+[data-slot=icon])>[data-slot=select-control]]:pr-9',
        '[&_[data-slot=icon]]:opacity-40 [&_[data-slot=icon]]:cursor-auto' => $disabled,
    ]) }}
>
    {{-- tags --}}
    <div 
        x-bind:aria-expanded="__isOpen.toString()"
        x-bind:aria-controls="$id('rover-options')"
        x-bind:aria-activedescendant="$rover.getActiveItemId() ?? false"
        x-bind:aria-multiselectable="__isMultiple ? 'true' : false"
        x-bind:aria-label="@js($placeholder)"
        x-bind:data-open="__isOpen"
        data-slot="select-control"
        @class($classes)
        @disabled($disabled)
    >
        <template 
            x-for="(item, index) in selectedTags" 
            x-bind:key="item.value"
        >
            <div
                @class([
                    "inline-flex items-center rounded-md font-medium
                    bg-neutral-100 text-neutral-800
                    dark:bg-neutral-800 dark:text-neutral-200
                    border border-black/5 dark:border-white/10
                    max-w-full",
                    match($size){
                        'sm' => 'text-xs px-1.5 py-0.5',
                        default => 'text-sm px-2 py-1'           
                    }
                ])
            >
                <span class="truncate" x-text="item.label"></span>

                <button
                    type="button"
                    class="ml-1 rounded-sm hover:bg-black/5 dark:hover:bg-white/10
                        focus:outline-none focus:ring-2 focus:ring-neutral-400/30"
                    x-on:click.stop="deselect(item.value)"
                    data-slot="remove-btn"
                    x-bind:aria-label="'Remove ' + item.label"
                >
                    <x-ui.icon 
                        name="x-mark"
                        class="size-3.5 opacity-60"
                    />
                </button>
            </div>
        </template>
        
        <template x-if="selectedTags.length === 0">
            {{-- this is span isn't optional inside template... --}}
            <span class="pl-2 self-center"> 
                {{ $placeholder }}
            </span>
        </template>
        
        {{-- visible during Alpine boot, hidden the moment Alpine processes x-show="false" 
            thuss templates has evaluated and rendered, creating a seamless handoff with zero flash --}}
        <span x-show="false" class="pl-2 self-center">
            {{ $placeholder }}
        </span>
    </div>
    
    @if (filled($iconAfter))
        <div 
            data-slot="icon"
            @if ($clearable)
                x-show="!hasSelection"
            @endif
            x-cloak
            class="col-span-1 row-start-1 pt-1 pr-1 h-full justify-self-center [&:has(+[data-slot=select-clear])]:col-start-2 [&:not(:has(+[data-slot=select-clear]))]:col-start-3"
        >
            <x-ui.icon
                :name="$iconAfter"
                @class([
                    "rounded-md dark:hover:bg-white/5 hover:bg-neutral-800/5",
                    match($size){
                        'sm' => 'size-6 p-0.75',
                        default => 'size-8 p-1',
                    }      
                ]) 
            />
        </div>
    @endif

    @if ($clearable)
        <div 
            class="col-span-1 row-start-1 pt-1 pr-1 justify-self-center h-full col-start-3"
            x-bind:class="!hasSelection && 'opacity-50'"
            x-on:keydown.space.prevent.stop="clear"
            x-bind:aria-disabled="!hasSelection"
            x-on:keydown.enter.stop="clear"
            aria-label="Clear selection"
            data-slot="select-clear"
            x-on:click.stop="clear"
            x-show="hasSelection"
            role="button"
            tabindex="0"
            x-cloak
        >
            <x-ui.icon
                name="x-mark"
                @class([
                    "rounded-md dark:hover:bg-white/5 hover:bg-neutral-800/5  ",
                    match($size){
                        'sm' => 'size-6 p-0.75',
                        default => 'size-8 p-1',
                    }      
                ]) 
            />
        </div>
    @endif
</div>
