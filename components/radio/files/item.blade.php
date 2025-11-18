@aware([
    'variant' => 'default',
    'disabled' => false,
    'indicator' => true,
    'name' => '',
])

@props([
    'value',
    'label',
    'checked' => false,
    'description' => '',
    'icon' => '',
    'iconVariant' => 'outline',
    'iconClass' => '',
])

@php

    $isSegmented = $variant === 'segmented';
    $isCards = $variant === 'cards';
    $isPills = $variant === 'pills';
    $showIcon = ($isSegmented || $isCards) && filled($icon);
    $showInput = !$isSegmented && (!$isCards || $indicator) && !$isPills;

    $labelClasses = [
        'flex-1 cursor-pointer text-sm font-medium flex items-center gap-2 transition duration-200',
        'text-neutral-900 dark:text-neutral-200 hover:text-neutral-800 dark:hover:text-white',
        'peer-checked:[&>[data-slot=radio-item-indicator]]:border-black peer-checked:[&>[data-slot=radio-item-indicator]]:ring-white peer-checked:[&>[data-slot=radio-item-indicator]]:bg-black',
        'peer-checked:[&>[data-slot=radio-item-indicator]]:after:block',
        'dark:peer-checked:[&>[data-slot=radio-item-indicator]]:border-white dark:peer-checked:[&>[data-slot=radio-item-indicator]]:bg-white',
        'peer-disabled:opacity-50 cursor-auto',
        'peer-disabled:[&>[data-slot=radio-item-indicator]]:opacity-50 peer-disabled:[&>[data-slot=radio-item-indicator]]:shadow-none',

        'text-neutral-300 hover:text-neutral-950 p-2 rounded-field peer-checked:shadow-xs dark:text-white/70 peer-checked:bg-white/80 dark:peer-checked:bg-neutral-700 hover:bg-white dark:hover:bg-neutral-700' => $isSegmented,
        'peer-checked:bg-primary-content peer-checked:text-primary-fg px-2 py-0.5 rounded-full peer-checked:hover:text-primary-fg' => $isPills,
        '[&>[data-slot=radio-item-indicator]]:order-3 [&>[data-slot=radio-item-indicator]]:ml-auto' => $isCards
    ];

    $containerClasses = [
        'relative isolate transition duration-200',
        'flex-1 bg-white dark:bg-neutral-900 py-4 px-6 rounded-field border border-black/5 dark:border-white/5 dark:hover:bg-neutral-700 hover:bg-neutral-100' => $isCards,
        'has-[:checked]:bg-white/5 dark:has-[:checked]:bg-neutral-700 has-[:checked]:border-neutral-950/10 dark:has-[:checked]:border-white/10' => $isCards,
    ];


    $descriptionClasses = ['text-neutral-700 dark:text-neutral-200 w-full text-sm text-start', 'pl-0!' => $isCards, 'pl-5 ' => !$isCards];


@endphp

<div
    @class($containerClasses)
    x-init="
        $nextTick(()=>{
            if (@js($checked) && ($data._state == null)) {
                $data._state = @js($value);
            }
        })
    "
>
    <input 
        data-slot="radio-item-control"
        class="peer"
        name="{{ $name }}"
        hidden
        id="{{ $value }}-{{ $name }}"
        value="{{ $value }}" 
        type="radio"
        x-model="$data._state"
    />

    <label for="{{ $value }}-{{ $name }}" @class($labelClasses)>
        @if ($indicator && !$isPills)
            <x-ui.radio.indicator />
        @endif
        @if ($isCards)
            <span class="absolute size-full inset-0 "></span>
        @endif

        @if ($showIcon)
            <x-ui.icon 
                name="{{ $icon }}"
                variant="{{ $iconVariant }}" 
                class="{{ $iconClass }}"
                 
            />
        @endif

        <span class="font-semibold">{{ $label }}</span>
    </label>

    @if ($description && !$isPills)
        <p data-slot="radio-item-control-description" @class($descriptionClasses)>{{ $description }}
        </p>
    @endif
</div>
