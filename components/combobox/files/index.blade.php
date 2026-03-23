@props([
    'name'          => $attributes->whereStartsWith('wire:model')->first() ?? $attributes->whereStartsWith('x-model')->first(),
    'label'         => null,
    'search'        => null,
    'placeholder'   => 'Type to search...',
    'multiple'      => false,
    'clearable'     => false,
    'disabled'      => false,
    'icon'          => null,
    'iconAfter'     => 'chevron-up-down',
    'checkIcon'     => 'check',
    'checkIconClass'=> null,
    'invalid'       => null,
    'triggerClass'  => null,
    'maxSelection'  => null,
    'minSelection'  => null,
    'size'          => 'default',
    'empty'         => null,
    'loading'       => null,
    'preventLoading'=> false,
])

@php
    $modelAttrs = collect($attributes->getAttributes())->keys()->first(fn($key) => str_starts_with($key, 'wire:model'));
    $model      = $modelAttrs ? $attributes->get($modelAttrs) : null;
    $isLive     = $modelAttrs && str_contains($modelAttrs, '.live');
    $livewireId = isset($__livewire) ? $__livewire->getId() : null;
@endphp

<div
    x-data="comboboxComponent({
        model: @js($model),
        livewire: @js(isset($livewireId)) ? window.Livewire.find(@js($livewireId)) : null,
        livewireId: @js($livewireId),
        placeholder: @js($placeholder),
        isLive: @js($isLive),
        isMultiple: @js($multiple),
        isDisabled: @js($disabled),
        minSelection: @js($minSelection),
        maxSelection: @js($maxSelection),
    })"
    x-rover
    @if($disabled) aria-disabled @endif
    @if($invalid)  aria-invalid  @endif
    x-bind:aria-expanded="__isOpen"
    aria-haspopup="listbox"
    x-bind:id="$id('combobox')"
    role="combobox"
    {{ 
        $attributes->class([
            'relative [--popup-round:var(--radius-box)] [--popup-padding:--spacing(1)]',
            'dark:border-red-400! dark:shadow-red-400 text-red-400! placeholder:text-red-400!' => $invalid,
        ]) 
    }}
>
    <x-ui.combobox.trigger/>

    <x-ui.combobox.options>
        {{ $slot }}
    </x-ui.combobox.options>
</div>