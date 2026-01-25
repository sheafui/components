@props(['animate' => 'glow', 'speed' => 'normal'])

<x-ui.skeleton.abstract 
    :attributes="$attributes->class([
        '[:where(&)]:h-4 [:where(&)]:rounded-md',
        '[:where(&)]:bg-[--alpha(var(--color-neutral-400)_/_20%)]',
        'dark:[:where(&)]:bg-[--alpha(var(--color-neutral-600)_/_20%)]',
    ])" 
    data-slot="skeleton"
>
    {{ $slot }}
</x-ui.skeleton.abstract>
