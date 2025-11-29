@aware([
    'disabled' => false,
    'inputClass'=>''
])

@props([
    'placeholder' => null
])

@php

$classes=[
    'w-full border-0 shadow-sm focus:outline-0 h-full! p-3 ring-0 dark:focus:bg-white/5 focus:bg-black/5 transition-all duration-200 bg-transparent dark:text-white dark:placeholder-neutral-400',
];

@endphp

<input
    {{ $attributes->except(['disabled','class']) }}
    placeholder="{{ $placeholder }}"
    type="text"
    class="{{ Arr::toCssClasses($classes) }}"
    :class="{ 'border-red-500 focus:border-red-500 focus:ring-red-500': isRowDuplicate(index) }"
    @disabled($disabled)
>