@aware([
    'checkIcon' => 'check',
    'checkIconClass' => '',
    'searchable' => false
])

@props([
    'value' => null,
    'label' => null,
    'icon' => null,
    'iconClass' => null,
])

@php
    // if there no label provided (when the value is the same as label) give the slot the value's value
    $slot = filled($slot->__toString()) ? $slot->__toString() : $value;
@endphp

<li 
    
    tabindex="0"

    x-bind:data-value="@js($value)"
    x-bind:data-label="@js($slot)"

    x-show="isItemShown(@js($slot))"

    x-on:mouseleave="handleMouseLeave($el)"
    
    {{--
        this required only when using none searchable select because 
        it moves out the focus state from the input
    --}}
    @if(!$searchable)
        x-on:mouseover="$focus.focus($el)"
    @endif

    x-on:mouseover="handleMouseEnter(@js($value))"


    x-bind:id="'option-' + getFilteredIndex(@js($value))"
    x-on:click="select(@js($value))"
    
    x-bind:class="{
        'bg-neutral-300 dark:bg-neutral-700 ': isFocused(@js($value)),
        {{-- 'hover:bg-neutral-100 hover:dark:bg-neutral-700': !isFocused(@js($value)), --}}
        '[&>[data-slot=icon]]:opacity-100': isSelected(@js($value)),
    }"
    role="option"
    data-slot="option"
    
    class="
        rounded-[calc(var(--popup-round)-var(--popup-padding))] col-span-full grid grid-cols-subgrid items-center
        focus:bg-neutral-100 focus:dark:bg-neutral-700 px-3 py-0.5 w-full text-base sm:text-sm
        self-center gap-x-2 
    "
>
    <x-ui.icon 
        :name="$checkIcon"
        @class([
            ' z-10 place-self-center opacity-0 size-[1.15rem]',
            $checkIconClass,
        ])
    />
    @if (filled($icon))
        <x-ui.icon 
            :name="$icon"
            @class([
                'z-10 pl-1.5',
                $iconClass
            ]) 
        />
    @endif
    
    <span class="col-start-3 text-start text-neutral-950 dark:text-neutral-50">{{ $slot  }}</span>
</li>
