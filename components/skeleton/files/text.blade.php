@props(['animate' => 'glow', 'size' => 'base', 'speed' => 'normal'])


@php
    $sizeClasses = match ($size) {
        'sm' => '[:where(&)]:h-4 py-[3px]',
        'base' => '[:where(&)]:h-5 py-[3px]',
        'lg' => '[:where(&)]:h-6 py-[2px]',
        'xl' => '[:where(&)]:h-8 py-[2px]',
        default => '[:where(&)]:h-5 py-[3px]',
    };
@endphp

<x-ui.skeleton.abstract 
    :attributes="$attributes->class([
        '[:where(&)]:w-full flex',
        '[:where(&)]:rounded-field',
        $sizeClasses
    ])" 
    data-skeleton
/>
