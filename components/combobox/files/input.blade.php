@aware([
    'disabled' => false,
    'placeholder' => 'Type to search...',
    'size' => 'default'
])

@php
    $classes = [
        'flex-1 min-w-[6rem] bg-transparent outline-none border-0 ring-0',
        'placeholder:text-neutral-400 dark:placeholder:text-neutral-500',
        'text-neutral-900 dark:text-neutral-50',
        match($size) {
            'sm'    => 'text-sm px-1.5 py-0.5',
            default => 'px-2 py-1',
        },
    ];
@endphp

<input
    x-rover:input
    x-ref:input
    x-on:input.stop
    placeholder="{{ $placeholder }}"
    x-bind:placeholder="hasSelection && __isMultiple ? '' : @js($placeholder)"
    x-bind:aria-label="@js($placeholder)"
    x-bind:aria-autocomplete="'list'"
    x-bind:disabled="@js($disabled)"
    autocomplete="off"
    spellcheck="false"
    type="text"
    data-slot="combobox-input"
    {{ $attributes->class($classes) }}
/>