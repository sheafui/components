@aware(['animate' => 'glow', 'speed' => 'normal'])

@php
    $wave = [
        'relative overflow-hidden isolate',
        'before:absolute before:inset-0 _before:bg-red-500 before:-translate-x-full',
        'before:animate-[wave_1.5s_infinite_linear]',
        match ($speed) {
            'slow' => 'before:animate-[wave_3s_infinite_linear]',
            'normal' => 'before:animate-[wave_2s_infinite_linear]',
            'fast' => 'before:animate-[wave_1s_infinite_linear]',
            default => 'before:animate-[wave_2s_infinite_linear]',
        },
        // the moving effect is a gradient color of neutral and trasnparent and  tweack it as you need...
        'before:bg-gradient-to-r before:from-transparent 
         before:via-neutral-400/40 dark:before:via-neutral-600/40 
         before:to-transparent',
    ];

    $animationClasses = match ($animate) {
        'wave' => $wave,
        'glow' => [...$wave, 'animate-pulse'],
        'pulse' => ['animate-pulse'],
        'none' => [],
        default => ['animate-pulse'],
    };

@endphp
<div {{ $attributes->class($animationClasses) }}>
    {{ $slot }}
</div>
