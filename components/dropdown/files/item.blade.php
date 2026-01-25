@aware(['checkbox' => false, 'radio' => false, 'checkboxVariant' => false])

@props([
    'disabled' => false,
    'icon' => null,
    'iconVariant' => 'mini',
    'shortcut' => null,
    'variant' => 'soft',
    'as' => 'button',
    'active' => false,
    'value' => null,
    'name' => null,
    'checkboxVariant' => false,
    'readOnly' => false
])

@php
    $isDefaultDropdownVariant = !($checkbox || $radio);

    $variantClasses = match ($variant) {
        'soft' => 'hover:bg-neutral-100 focus-within:bg-neutral-100 dark:hover:bg-white/5 dark:focus-within:bg-white/5',
        'danger' => 'hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-400/20 dark:hover:text-red-400 focus-within:text-red-600 focus-within:bg-red-50 dark:focus-within:bg-red-400/20 dark:focus-within:text-red-400',
        default => '',
    };

    $iconClasses = [
        'inline-flex shrink-0 mr-2',
        match ($variant) {
            'soft' => '',
            'danger' => 'group-hover:text-red-500! dark:group-hover:text-red-400! group-focus-within:text-red-500! dark:group-focus-within:text-red-400!',
            default => '',
        },
    ];

    $iconAttributes = (new Illuminate\View\ComponentAttributeBag())
        ->class($iconClasses)
        ->merge(['aria-hidden' => 'true']);

    $value ??= trim($slot->__toString());

    $classes = [
        'grid grid-cols-subgrid group relative overflow-hidden',
        'col-span-2' => $isDefaultDropdownVariant,
        'col-span-3' => ! $isDefaultDropdownVariant,
        'w-full px-2 py-1.5 text-sm transition-colors duration-200 text-start',
        'text-neutral-800 dark:text-white',
        'rounded-[calc(var(--dropdown-radius)-var(--dropdown-padding))]',
        'focus-within:outline-none',
        'data-active:bg-neutral-950/[3%] dark:data-active:bg-white/[3%]',
        $variantClasses . ' cursor-pointer' => ! $disabled,
        'opacity-50 cursor-not-allowed text-neutral-500 dark:text-neutral-400' => $disabled,
    ];

    if ($active) {
        $attributes['data-active'] = 'true';
    }
@endphp

@if ($isDefaultDropdownVariant)
    <x-ui.button.abstract
        :$as
        :attributes="$attributes
            ->class(Arr::toCssClasses($classes))
            ->merge([
                'disabled' => $disabled,
                'tabindex' => $disabled ? '-1' : '0',
                'aria-disabled' => $disabled ? 'true' : 'false',
                'role' => 'menuitem',
            ])"
        data-slot="dropdown-item"
    >
        @if (filled($icon))
            <x-ui.icon
                :name="$icon"
                :variant="$iconVariant"
                :attributes="$iconAttributes"
                data-slot="right-icon"
            />
        @endif

       <span class="col-start-2 whitespace-nowrap flex items-center justify-between gap-4_">
                <span class="flex-1">{{ $slot }}</span>
                
                @if(filled($shortcut))
                    <x-ui.kbd>
                        {{ $shortcut }}
                    </x-ui.kbd>
                @endif
            </span>
    </x-ui.button.abstract>
@elseif($readOnly)
    <div class="text-center col-span-full text-neutral-800 dark:text-white w-full px-3 py-1.5 text-sm" {{ $attributes }}>
        {{ $slot }}
    </div>
@else   
   <x-ui.dropdown.checkbox-or-radio 
        :$attributes
        :$classes
        :$iconClasses
        :$value
    >
        {{ $slot }}
    </x-ui.dropdown.checkbox-or-radio>
@endif