@props(['label' => null])

<div 
    x-rover:group 
    {{ $attributes->merge(['class' => 'group pt-1 col-span-full grid grid-cols-subgrid']) }}
>
    @if($label)
        <div class="text-sm text-start mb-0.5 col-span-full px-[calc(--spacing(1.5)_+_var(--popup-padding))] font-medium text-neutral-500 dark:text-neutral-400 tracking-wide">
            {{ $label }}
        </div>
    @endif
    {{ $slot }}
</div>