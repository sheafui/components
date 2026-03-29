@props([
    'name' => null,
    'variant' => null,
    'asButton' => false,
])

@php
    $name = str($name);

    $set = match (true) {
        $name->startsWith(['ps:', 'phosphor:']) => 'phosphor',
        $name->startsWith(['bk:', 'bladekit:']) => 'bladekit',
        default => 'heroicons',
    };

    $icon = $set !== 'heroicons'
        ? $name->after(':')->toString()
        : $name->toString();

    $component = match ($set) {
        'phosphor' => "phosphor.icons::" . match ($variant) {
            'thin', 'light', 'fill', 'regular', 'duotone', 'bold' => "{$variant}.{$icon}",
            default => "regular.{$icon}",
        },

        'heroicons' => match ($variant) {
            'solid', 'outline' => "heroicons::{$variant}.{$icon}",
            'mini', 'micro' => "heroicons::{$variant}.solid.{$icon}",
            default => "heroicons::outline.{$icon}",
        },

        'bladekit' => $icon,
    };

    $hasSize = str($attributes->get('class'))
        ->contains(['size-', 'w-', 'h-']);

    if (in_array($set, ['phosphor', 'bladekit']) && !$hasSize) {
        $attributes = $attributes->class('size-6');
    }
@endphp

@if ($asButton)
    <button {{ $attributes->class('cursor-pointer') }} type="button">
@endif

<x-dynamic-component
    :component="$component"
    {{ $attributes->class(['text-neutral-700 dark:text-neutral-300']) }}
    data-slot="icon"
/>

@if ($asButton)
    </button>
@endif