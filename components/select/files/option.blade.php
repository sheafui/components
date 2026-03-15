@aware([
    'checkIcon' => 'check',
    'checkIconClass' => '',
    'searchable' => false,
    'allowCustomSlots' => false
])

@props([
    'value' => null,
    'label' => null,
    'searchLabel' => null,
    'icon' => null,
    'iconClass' => null,
    'disabled' => false,
    'allowCustomSlots' => false
])

@php
    if (!$allowCustomSlots) {
        $value = filled($value) ? $value : $slot->__toString();
        $label = filled($label) ? $label : $slot->__toString();
        $searchLabel = filled($searchLabel) ? $searchLabel : $label;
    } else {
        if (blank($label)) {
            throw new RuntimeException("A string label prop is required for custom slots");
        }

        $value = filled($value) ? $value : $label;
        $searchLabel = filled($searchLabel) ? $searchLabel : $label;
    }

    $classes = [
        "rounded-[calc(var(--popup-round)-var(--popup-padding))] group self-center gap-x-2 items-center",
        "focus:bg-neutral-100 focus:dark:bg-neutral-700 px-3 py-0.5 w-full text-[1rem]",
        "data-active:bg-neutral-800/5 dark:data-active:bg-white/5",
        "col-span-full grid grid-cols-subgrid" => !$allowCustomSlots,
        'col-span-full' => $allowCustomSlots,
        '[&[aria-disabled=true]]:pointer-events-none [&[aria-disabled=true]]:opacity-50',
        '[ul:is([data-loading])>&]:hidden'
    ];
@endphp

<li 
    data-search="{{ $searchLabel }}"
    data-label="{{ $label }}"
    value="{{ $value }}"
    data-slot="option"
    x-rover:option
    
    {{-- morph will remove data-value for none changed els so the init ain't rerun --}} 
    wire:ignore.self
    
    @if($disabled) disabled aria-disabled="true" @endif

    {{ $attributes->class($classes) }}
>
    @if (!$allowCustomSlots)
        {{-- Check Icon for selected state --}}
        <x-ui.icon 
            :name="$checkIcon"
            @class([
                'z-10 place-self-center opacity-0 group-data-selected:opacity-100 size-[1.15rem]',
                $checkIconClass,
            ])
        />

        {{-- Optional icon --}}
        @if (filled($icon))
            <x-ui.icon 
                :name="$icon"
                @class([
                    'z-10 pl-1.5',
                    $iconClass
                ]) 
            />
        @endif

        {{-- Option label --}}
        <span class="col-start-3 text-start text-neutral-950 dark:text-neutral-50">
            {{ $slot }}
        </span>
    @else
        {{ $slot }}
    @endif
</li>
