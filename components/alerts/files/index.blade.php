@props([
    'variant' => 'info',
    'icon' => null,
    'color' => null,
    'controls' => null,
])

@php

    $color ??= match ($variant) {
        'info' => 'blue',
        'success' => 'green',
        'warning' => 'yellow',
        'error' => 'red',
        default => 'blue',
    };

    $colors = match ($color) {
        'zinc' => [
            '[--bg-color:var(--color-zinc-50)] [--border-color:var(--color-zinc-200)] [--text-color:var(--color-zinc-700)] [--heading-color:var(--color-zinc-900)] [--icon-color:var(--color-zinc-600)]',
            'dark:[--bg-color:var(--color-zinc-950)] dark:[--border-color:var(--color-zinc-800)] dark:[--text-color:var(--color-zinc-300)] dark:[--heading-color:var(--color-zinc-100)] dark:[--icon-color:var(--color-zinc-400)]',
        ],
        'red' => [
            '[--bg-color:var(--color-red-50)] [--border-color:var(--color-red-200)] [--text-color:var(--color-red-700)] [--heading-color:var(--color-red-900)] [--icon-color:var(--color-red-600)]',
            'dark:[--bg-color:var(--color-red-950)] dark:[--border-color:var(--color-red-800)] dark:[--text-color:var(--color-red-300)] dark:[--heading-color:var(--color-red-100)] dark:[--icon-color:var(--color-red-400)]',
        ],
        'orange' => [
            '[--bg-color:var(--color-orange-50)] [--border-color:var(--color-orange-200)] [--text-color:var(--color-orange-700)] [--heading-color:var(--color-orange-900)] [--icon-color:var(--color-orange-600)]',
            'dark:[--bg-color:var(--color-orange-950)] dark:[--border-color:var(--color-orange-800)] dark:[--text-color:var(--color-orange-300)] dark:[--heading-color:var(--color-orange-100)] dark:[--icon-color:var(--color-orange-400)]',
        ],
        'amber' => [
            '[--bg-color:var(--color-amber-50)] [--border-color:var(--color-amber-200)] [--text-color:var(--color-amber-800)] [--heading-color:var(--color-amber-900)] [--icon-color:var(--color-amber-600)]',
            'dark:[--bg-color:var(--color-amber-950)] dark:[--border-color:var(--color-amber-800)] dark:[--text-color:var(--color-amber-200)] dark:[--heading-color:var(--color-amber-100)] dark:[--icon-color:var(--color-amber-400)]',
        ],
        'yellow' => [
            '[--bg-color:var(--color-yellow-50)] [--border-color:var(--color-yellow-300)] [--text-color:var(--color-yellow-800)] [--heading-color:var(--color-yellow-900)] [--icon-color:var(--color-yellow-600)]',
            'dark:[--bg-color:var(--color-yellow-950)] dark:[--border-color:var(--color-yellow-700)] dark:[--text-color:var(--color-yellow-200)] dark:[--heading-color:var(--color-yellow-100)] dark:[--icon-color:var(--color-yellow-400)]',
        ],
        'lime' => [
            '[--bg-color:var(--color-lime-50)] [--border-color:var(--color-lime-200)] [--text-color:var(--color-lime-700)] [--heading-color:var(--color-lime-900)] [--icon-color:var(--color-lime-600)]',
            'dark:[--bg-color:var(--color-lime-950)] dark:[--border-color:var(--color-lime-800)] dark:[--text-color:var(--color-lime-300)] dark:[--heading-color:var(--color-lime-100)] dark:[--icon-color:var(--color-lime-400)]',
        ],
        'green' => [
            '[--bg-color:var(--color-green-50)] [--border-color:var(--color-green-200)] [--text-color:var(--color-green-700)] [--heading-color:var(--color-green-900)] [--icon-color:var(--color-green-600)]',
            'dark:[--bg-color:var(--color-green-950)] dark:[--border-color:var(--color-green-800)] dark:[--text-color:var(--color-green-300)] dark:[--heading-color:var(--color-green-100)] dark:[--icon-color:var(--color-green-400)]',
        ],
        'emerald' => [
            '[--bg-color:var(--color-emerald-50)] [--border-color:var(--color-emerald-200)] [--text-color:var(--color-emerald-700)] [--heading-color:var(--color-emerald-900)] [--icon-color:var(--color-emerald-600)]',
            'dark:[--bg-color:var(--color-emerald-950)] dark:[--border-color:var(--color-emerald-800)] dark:[--text-color:var(--color-emerald-300)] dark:[--heading-color:var(--color-emerald-100)] dark:[--icon-color:var(--color-emerald-400)]',
        ],
        'teal' => [
            '[--bg-color:var(--color-teal-50)] [--border-color:var(--color-teal-200)] [--text-color:var(--color-teal-700)] [--heading-color:var(--color-teal-900)] [--icon-color:var(--color-teal-600)]',
            'dark:[--bg-color:var(--color-teal-950)] dark:[--border-color:var(--color-teal-800)] dark:[--text-color:var(--color-teal-300)] dark:[--heading-color:var(--color-teal-100)] dark:[--icon-color:var(--color-teal-400)]',
        ],
        'cyan' => [
            '[--bg-color:var(--color-cyan-50)] [--border-color:var(--color-cyan-200)] [--text-color:var(--color-cyan-700)] [--heading-color:var(--color-cyan-900)] [--icon-color:var(--color-cyan-600)]',
            'dark:[--bg-color:var(--color-cyan-950)] dark:[--border-color:var(--color-cyan-800)] dark:[--text-color:var(--color-cyan-300)] dark:[--heading-color:var(--color-cyan-100)] dark:[--icon-color:var(--color-cyan-400)]',
        ],
        'sky' => [
            '[--bg-color:var(--color-sky-50)] [--border-color:var(--color-sky-200)] [--text-color:var(--color-sky-700)] [--heading-color:var(--color-sky-900)] [--icon-color:var(--color-sky-600)]',
            'dark:[--bg-color:var(--color-sky-950)] dark:[--border-color:var(--color-sky-800)] dark:[--text-color:var(--color-sky-300)] dark:[--heading-color:var(--color-sky-100)] dark:[--icon-color:var(--color-sky-400)]',
        ],
        'blue' => [
            '[--bg-color:var(--color-blue-50)] [--border-color:var(--color-blue-200)] [--text-color:var(--color-blue-700)] [--heading-color:var(--color-blue-900)] [--icon-color:var(--color-blue-600)]',
            'dark:[--bg-color:var(--color-blue-950)] dark:[--border-color:var(--color-blue-800)] dark:[--text-color:var(--color-blue-300)] dark:[--heading-color:var(--color-blue-100)] dark:[--icon-color:var(--color-blue-400)]',
        ],
        'indigo' => [
            '[--bg-color:var(--color-indigo-50)] [--border-color:var(--color-indigo-200)] [--text-color:var(--color-indigo-700)] [--heading-color:var(--color-indigo-900)] [--icon-color:var(--color-indigo-600)]',
            'dark:[--bg-color:var(--color-indigo-950)] dark:[--border-color:var(--color-indigo-800)] dark:[--text-color:var(--color-indigo-300)] dark:[--heading-color:var(--color-indigo-100)] dark:[--icon-color:var(--color-indigo-400)]',
        ],
        'violet' => [
            '[--bg-color:var(--color-violet-50)] [--border-color:var(--color-violet-200)] [--text-color:var(--color-violet-700)] [--heading-color:var(--color-violet-900)] [--icon-color:var(--color-violet-600)]',
            'dark:[--bg-color:var(--color-violet-950)] dark:[--border-color:var(--color-violet-800)] dark:[--text-color:var(--color-violet-300)] dark:[--heading-color:var(--color-violet-100)] dark:[--icon-color:var(--color-violet-400)]',
        ],
        'purple' => [
            '[--bg-color:var(--color-purple-50)] [--border-color:var(--color-purple-200)] [--text-color:var(--color-purple-700)] [--heading-color:var(--color-purple-900)] [--icon-color:var(--color-purple-600)]',
            'dark:[--bg-color:var(--color-purple-950)] dark:[--border-color:var(--color-purple-800)] dark:[--text-color:var(--color-purple-300)] dark:[--heading-color:var(--color-purple-100)] dark:[--icon-color:var(--color-purple-400)]',
        ],
        'fuchsia' => [
            '[--bg-color:var(--color-fuchsia-50)] [--border-color:var(--color-fuchsia-200)] [--text-color:var(--color-fuchsia-700)] [--heading-color:var(--color-fuchsia-900)] [--icon-color:var(--color-fuchsia-600)]',
            'dark:[--bg-color:var(--color-fuchsia-950)] dark:[--border-color:var(--color-fuchsia-800)] dark:[--text-color:var(--color-fuchsia-300)] dark:[--heading-color:var(--color-fuchsia-100)] dark:[--icon-color:var(--color-fuchsia-400)]',
        ],
        'pink' => [
            '[--bg-color:var(--color-pink-50)] [--border-color:var(--color-pink-200)] [--text-color:var(--color-pink-700)] [--heading-color:var(--color-pink-900)] [--icon-color:var(--color-pink-600)]',
            'dark:[--bg-color:var(--color-pink-950)] dark:[--border-color:var(--color-pink-800)] dark:[--text-color:var(--color-pink-300)] dark:[--heading-color:var(--color-pink-100)] dark:[--icon-color:var(--color-pink-400)]',
        ],
        'rose' => [
            '[--bg-color:var(--color-rose-50)] [--border-color:var(--color-rose-200)] [--text-color:var(--color-rose-700)] [--heading-color:var(--color-rose-900)] [--icon-color:var(--color-rose-600)]',
            'dark:[--bg-color:var(--color-rose-950)] dark:[--border-color:var(--color-rose-800)] dark:[--text-color:var(--color-rose-300)] dark:[--heading-color:var(--color-rose-100)] dark:[--icon-color:var(--color-rose-400)]',
        ],
        'slate' => [
            '[--bg-color:var(--color-slate-50)] [--border-color:var(--color-slate-200)] [--text-color:var(--color-slate-700)] [--heading-color:var(--color-slate-900)] [--icon-color:var(--color-slate-600)]',
            'dark:[--bg-color:var(--color-slate-950)] dark:[--border-color:var(--color-slate-800)] dark:[--text-color:var(--color-slate-300)] dark:[--heading-color:var(--color-slate-100)] dark:[--icon-color:var(--color-slate-400)]',
        ],
        'gray' => [
            '[--bg-color:var(--color-gray-50)] [--border-color:var(--color-gray-200)] [--text-color:var(--color-gray-700)] [--heading-color:var(--color-gray-900)] [--icon-color:var(--color-gray-600)]',
            'dark:[--bg-color:var(--color-gray-950)] dark:[--border-color:var(--color-gray-800)] dark:[--text-color:var(--color-gray-300)] dark:[--heading-color:var(--color-gray-100)] dark:[--icon-color:var(--color-gray-400)]',
        ],

        'neutral' => [
            '[--bg-color:var(--color-neutral-50)] [--border-color:var(--color-neutral-200)] [--text-color:var(--color-neutral-700)] [--heading-color:var(--color-neutral-900)] [--icon-color:var(--color-neutral-600)]',
            'dark:[--bg-color:var(--color-neutral-950)] dark:[--border-color:var(--color-neutral-800)] dark:[--text-color:var(--color-neutral-300)] dark:[--heading-color:var(--color-neutral-100)] dark:[--icon-color:var(--color-neutral-400)]',
        ],
        'stone' => [
            '[--bg-color:var(--color-stone-50)] [--border-color:var(--color-stone-200)] [--text-color:var(--color-stone-700)] [--heading-color:var(--color-stone-900)] [--icon-color:var(--color-stone-600)]',
            'dark:[--bg-color:var(--color-stone-950)] dark:[--border-color:var(--color-stone-800)] dark:[--text-color:var(--color-stone-300)] dark:[--heading-color:var(--color-stone-100)] dark:[--icon-color:var(--color-stone-400)]',
        ],

        default => [],
    };

    $containerClass = [
        'border flex items-center rounded-xl gap-2 p-2',
        // if it there is heading and description align the icon to the first.
        '[&:has([data-slot=alert-heading]):has([data-slot=alert-description])]:[&_[data-slot=alert-icon]]:self-start',
        'bg-[var(--bg-color)]/30 border-[var(--border-color)]/65 text-[var(--text-color)]',
        // icon color
        '[&_[data-slot=icon]]:text-(--icon-color)',
        ...filled($color) ? $colors : [],
    ];
@endphp

<div 
    {{ $attributes->class(Arr::toCssClasses($containerClass)) }} 
    data-slot="alert" 
    role="alert"
    aria-live="polite"
>
    @if (filled($icon))
        <div class="shrink-0 flex items-center justify-center" data-slot="alert-icon">
            <x-ui.icon name="{{ $icon }}" class="text-[var(--icon-color)]" />
        </div>
    @endif

    <div class="space-y-1">
        {{ $slot }}
    </div>

    @if (filled($controls))
        <div {{ $controls->attributes->class('h-full ml-auto') }} data-slot="alert-controls">
            {{ $controls }}
        </div>
    @endif
</div>
