@aware([
    'href' => '#',
    'logo' => null,
    'name' => '',
    'alt' => '',
    'target' => '_self',
    'logoClass' => '',
])

@props([
    'href' => '#',
    'logo' => null,
    'name' => '',
    'alt' => '',
    'target' => '_self',
    'logoClass' => '',
])



<a href="{{ $href }}" target="{{ $target }}"
    {{ $attributes->merge(['class' => 'flex items-center justify-center gap-x-3 text-decoration-none hover:opacity-80 transition-opacity text-black dark:text-white']) }}>
    {{-- Logo Section --}}
    @if ($logo || isset($logo))
        <div class="flex-shrink-0">
            @if (isset($logo) && is_string($logo))
                <img src="{{ $logo }}" alt="{{ $alt }} Logo" class="h-8 w-auto {{ $logoClass }}">
            @elseif($logo && $logo->isNotEmpty())
                {{ $logo }}
            @endif
        </div>
    @endif

    {{-- Brand Name --}}
    @if ($name)
        <div
            data-slot="brand-name" 
            class="font-semibold text-lg w-full"
        >{{ $name }}</div>
    @endif
</a>
