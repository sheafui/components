@props([
    'variant' => 'default', // default, icon
])

<div {{ $attributes->class('mb-4') }}>
    {{ $slot }}
</div>
