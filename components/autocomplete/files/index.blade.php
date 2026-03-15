@props([
    'name' => $attributes->whereStartsWith('wire:model')->first() ?? $attributes->whereStartsWith('x-model')->first(),
    'placeholder' => 'search...',
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
    x-data="autocompleteComponent({
        livewire: @js(isset($livewireId)) ? window.Livewire.find(@js($livewireId)) : null,
        isLive: @js($isLive),
        model: @js($model),
    })"
    x-rover
    {{ $attributes->whereStartsWith(['wire:model', 'x-model']) }}
    @class([
       'relative text-start [--popup-round:var(--radius-box)] [--popup-padding:--spacing(1)]'
    ])
>
    <div 
        x-ref="autocompleteControl"
    >
        <x-ui.input
            x-rover:input
            x-on:input.stop
            bindToParentScope
            :placeholder="$placeholder"
            :attributes="$attributes->whereDoesntStartWith(['wire:model','x-model'])"
        />
    </div>   
    <x-ui.autocomplete.items>
        {{ $slot }}
    </x-ui.autocomplete.items>
</div>