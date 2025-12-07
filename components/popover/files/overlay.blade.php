@aware([
    'position' => 'bottom',
    'offset' => 3,
])

@props([
    'position' => 'bottom',
    'offset' => 3,
])

<x-ui.popup
    :attributes="$attributes->merge([
        'x-anchor.' . $position . '.offset.' . $offset => '$refs.popoverTrigger',
        'class' => str($attributes->get('class'))->contains(['!w-']) ? '' : 'w-max',
        'x-show' => 'open',
        'x-on:click.away' => 'hide()',
        'x-on:keydown.escape' => 'hide()'
    ])"
>
    {{ $slot }}
</x-ui.popup>


