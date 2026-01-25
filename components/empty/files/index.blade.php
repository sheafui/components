@props([
    'variant' => 'default', 
])

<div {{ $attributes->class('flex flex-col items-center justify-center py-6 px-6 text-center') }}>
    {{ $slot }}
</div>
