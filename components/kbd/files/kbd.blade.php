@props([
    'keys' => null,
    'separator' => '+'
])

@php
    $baseClasses = 'inline-flex items-center gap-1 font-mono text-sm';
    $kbdClasses = 'pointer-events-none inline-flex h-5 select-none items-center gap-1 rounded border border-neutral-200 bg-neutral-100 px-1.5 font-sans text-[10px] font-medium text-neutral-700 opacity-100 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300';
    
    $keyArray = $keys ? explode($separator, $keys) : [];
@endphp

<span {{ $attributes->merge(['class' => $baseClasses]) }}>
    @if($keyArray)
        @foreach($keyArray as $index => $key)
            <kbd class="{{ $kbdClasses }}">{{ trim($key) }}</kbd>
            @if(!$loop->last)
                <span class="text-neutral-400 text-xs">{{ $separator }}</span>
            @endif
        @endforeach
    @else
        <kbd class="{{ $kbdClasses }}">
            {{ $slot }}
        </kbd>
    @endif
</span>