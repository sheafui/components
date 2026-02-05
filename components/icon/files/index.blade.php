@props([
    'name' => null,
    'variant' => null,
    'asButton' => false,
])

@php
    // Detect icon set
    $isPhosphorSet = str($name)->startsWith(['ps:', 'phosphor:']);
    $isHeroiconsSet = ! $isPhosphorSet;

    // Normalize icon name safely
    $iconName = $isPhosphorSet
        ? str($name)->after(':')
        : $name;


    // Resolve component name
    $componentName = match (true) {
        $isPhosphorSet => match ($variant) {
            'thin', 'light', 'fill', 'regular', 'duotone', 'bold' => "phosphor.icons::{$variant}.{$iconName}",
            default => "phosphor.icons::regular.{$iconName}",
        },
        $isHeroiconsSet => match ($variant) {
            'solid', 'outline' => "heroicons::{$variant}.{$iconName}",
            'mini', 'micro' => "heroicons::{$variant}.solid.{$iconName}",
            default => "heroicons::outline.{$iconName}",
        },
    };

    /* PHOSPHOR ICONS AREN'T STYLED WE size-6 AS A FALLBACK */
    if ($isPhosphorSet && ! str($attributes->get('class'))->contains(['size-', 'w-', 'h-'])) {
        $attributes = $attributes->class('size-6');
    }
@endphp

@if ($asButton)
    <button {{ $attributes->class('cursor-pointer') }} type="button">
@endif

<x-dynamic-component :component="$componentName" {{ $attributes->class(['[:where(&)]:text-neutral-700 [:where(&)]:dark:text-neutral-300']) }}  data-slot="icon" />

@if ($asButton)
    </button>
@endif               