@props([
    'name' => $attributes->whereStartsWith('wire:model')->first() ?? $attributes->whereStartsWith('x-model')->first(),
    'label' => null,
    'triggerLabel' => null,
    'placeholder' => 'select...',
    'searchable' => false,
    'search' => null,
    'empty' => null,
    'multiple' => false,
    'clearable' => false,
    'disabled' => false,
    'pillbox' => false,
    'icon' => null,
    'iconAfter' => 'chevron-up-down',
    'checkIcon' => 'check',
    'checkIconClass' => null,
    'invalid' => null,
    'triggerClass' => null,
    'maxSelection' => null,
    'minSelection' => null,
    'size' => 'default',
    'disableUnSelectedOptionWhenReachingMax' => false
])
@php
    // Detect if the component is bound to a Livewire model
    $modelAttrs = collect($attributes->getAttributes())->keys()->first(fn($key) => str_starts_with($key, 'wire:model'));

    $model = $modelAttrs ? $attributes->get($modelAttrs) : null;

    // Detect if model binding uses `.live` modifier (for real-time syncing)
    $isLive = $modelAttrs && str_contains($modelAttrs, '.live');

    $livewireId = isset($__livewire) ? $__livewire->getId() : null;
@endphp

<div 
    x-data="selectComponent({
        model: @js($model),
        livewire: @js(isset($livewireId)) ? window.Livewire.find(@js($livewireId)) : null,
        livewireId: @js($livewireId),
        placeholder: @js($placeholder),
        isLive: @js($isLive),
        isMultiple: @js($multiple),
        isDisabled: @js($disabled),
        minSelection: @js($minSelection),
        maxSelection: @js($maxSelection),
        searchable: @js($searchable),
        disableUnSelectedOptionWhenReachingMax:@js($disableUnSelectedOptionWhenReachingMax),
    })"
    @if($disabled) aria-disabled @endif 
    @if($invalid) aria-invalid @endif 
    x-bind:aria-expanded="__isOpen"
    aria-haspopup="listbox"
    role="listbox"
    {{ $attributes->class([
        'relative [--popup-round:var(--radius-box)] [--popup-padding:--spacing(1)]',
        'dark:border-red-400! dark:shadow-red-400 text-red-400! placeholder:text-red-400!' => $invalid,
        ]),
    }}
    x-rover
>
    @if ($name)
        <input 
            type="hidden" 
            name="{{ $name }}" 
            x-bind:value="__isMultiple ? __state?.join(',') : __state"
        />
    @endif

    <div>
        @if($multiple && $pillbox)
            <x-ui.select.pillbox-trigger/>
        @else
            <x-ui.select.trigger/>
        @endif

        <x-ui.select.options 
            :checkIconClass="$checkIconClass"
            :checkIcon="$checkIcon"
        >
            {{ $slot }}
        </x-ui.select.options>
    </div>
</div>