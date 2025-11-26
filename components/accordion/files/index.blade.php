@props([
    'reverse' => false
])

<div 
    x-data="{ active: null }" 
    {{ $attributes->merge([
        'class'=>"w-full flex flex-col"
    ]) }}
>
    {{ $slot }}
</div>