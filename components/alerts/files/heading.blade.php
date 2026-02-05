@props(['icon' => null])


<x-ui.heading 
    data-slot="alert-heading" 
    :attributes="$attributes->merge(['class' => 'mb-1 flex items-center !text-(--heading-color)'])"
>
    @if (filled($icon))
        <x-ui.icon :name="$icon" class="text-[var(--icon-color)] mr-2 inline-block"  />
    @endif

    {{ $slot }}
</x-ui.heading>
