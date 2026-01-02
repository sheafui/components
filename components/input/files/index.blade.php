@props([
    'name' => $attributes->whereStartsWith('wire:model')->first() ?? $attributes->whereStartsWith('x-model')->first(),
    'prefix' => null,
    'suffix' => null,
    'leftIcon' => null,
    'rightIcon' => null,
    'prefixIcon' => null,
    'suffixIcon' => null,
    'clearable' => null,
    'copyable' => null,
    'revealable' => null,
    'invalid' => null,
    'type' => 'text',
    'mask' => null,
    'size' => null,
    'kbd' => null,
    'as' => null,
    'bindScopeToParent' => false
])

@php
    
    $invalid ??= $name && $errors->has($name);

    $classes = [
        // isolate stacking context to prevent z-index and shadow bleed from parent
        'isolate',

        'relative flex items-stretch w-full shadow-xs disabled:shadow-none transition-colors duration-200',

        'rounded-box',
        // Tailwind v4 '_input' means space + 'input'; these selectors target the input child
        '[&:has([data-slot=input-prefix])_input]:rounded-l-none',  // remove left border-radius if prefix exists

        '[&:has([data-slot=input-suffix])_input]:rounded-r-none',  // remove right border-radius if suffix exists

        '[&:has([data-slot=input-prefix]):has([data-slot=input-suffix])_input]:rounded-none', // no border-radius if both exist
    ];

    $hasLeftIconSlot = $leftIcon instanceof \Illuminate\View\ComponentSlot;
    
    $hasLeftIcon = filled($leftIcon);
    
    $hasRightIconSlot = $rightIcon instanceof \Illuminate\View\ComponentSlot;
    
    // Count icons including rightIcon slot
    $iconCount = count(array_filter([$clearable, $copyable, $revealable, $rightIcon]));
@endphp

<div {{ $attributes->class(Arr::toCssClasses($classes)) }}>
    {{-- HANDLE PREFIX SLOTS --}}
    @if (filled($prefix) || filled($prefixIcon))
        <x-ui.input.extra-slot data-slot="input-prefix">
            @if ($prefix instanceof \Illuminate\View\ComponentSlot)
                {{ $prefix }}
            @elseif ($prefixIcon)
                <x-ui.icon name="{{ $prefixIcon }}" />
            @endif
        </x-ui.input.extra-slot>
    @endif

    <div
        @unless($bindScopeToParent)
            {{-- 
                When this input component is used on its own, it needs its own Alpine.js scope (`x-data`) 
                to handle features like copy, clear, reveal, etc.

                However, when this input is nested inside a parent component that already has an Alpine.js scope,
                giving it a separate `x-data` creates duplicate Alpine scopes. 

                Duplicate scopes mean that methods like `handleKeydown` exist both in the parent and child, 
                so the same event gets handled twice, which is why you were seeing the keydown fire handled two times...

                Setting '$bindScopeToParent = true' disables this child scope, allowing the input to 
                use the parent's Alpine.js scope, preventing duplicate event handling while still 
                keeping all parent features intact.
            --}}
            x-data
        @endunless

        
        @class([
            // ============================================================================
            // GRID CONTAINER SETUP 
            // ============================================================================
            // Creates a CSS Grid container that enables complex overlapping layouts, I challenge you to do the same with flex  
            'w-full grid isolate',

            // ============================================================================
            // RIGHT-SIDE ACTIONS POSITIONING SYSTEM
            // ============================================================================ 
            // Complex conditional positioning for the actions container based on left icon presence
            // The actions need to be in different columns depending on grid layout:
            // - Without left icon: 2-column grid, actions go in column 2  
            // - With left icon: 3-column grid, actions go in column 3
            
            // When no left icon exists, place actions in column 2
            '[&:not(:has([data-slot=left-icon]))>[data-slot=input-actions]]:col-start-2',
            
            // When left icon exists, place actions in column 3 
            '[&:has([data-slot=left-icon])>[data-slot=input-actions]]:col-start-3',
            
            // '[&>[data-slot=input-actions]]:col-start-3',
            
            // Standard positioning for all action containers
            '[&>[data-slot=input-actions]]:row-start-1',        // Same row as input
            '[&>[data-slot=input-actions]]:place-self-center',  // Center within grid cell
            '[&>[data-slot=input-actions]]:z-10',               // Overlay above input (it work effect other elementswe're using `isolate`)

            // ============================================================================
            // INPUT FIELD BASE POSITIONING
            // ============================================================================
            // Input spans the full width regardless of icon presence - icons overlay on top
            '[&>[data-slot=control]]:col-start-1',      // Always start at column 1
            '[&>[data-slot=control]]:row-start-1',      // First (and only) row
            '[&>[data-slot=control]]:col-span-3',       // Span across all possible columns (it handle the case of 2 as well)
            
            // ============================================================================
            // LEFT ICON POSITIONING SYSTEM (when there is a one actually it handled like this has([data-slot=left-icon]))
            // ============================================================================
            // Left icon positioning - only applies when left icon exists
            // Places icon in first column, overlaying on top of input
            
            // Grid positioning 
            '[&:has([data-slot=left-icon])>[data-slot=left-icon]]:col-start-1',      // First column
            '[&:has([data-slot=left-icon])>[data-slot=left-icon]]:row-start-1',      // Same row as input (what actually force overlap)
            '[&:has([data-slot=left-icon])>[data-slot=left-icon]]:place-self-center', // Center within cell
            
            // Z-index stacking - higher than input and actions to be visible
            '[&:has([data-slot=left-icon])>[data-slot=left-icon]]:!z-20',
            
            // ============================================================================
            // DYNAMIC PADDING MANAGEMENT SYSTEM
            // ============================================================================
            // Prevents text from overlapping with overlaid icons by adding padding
            
            // LEFT PADDING: Space for left icon when present
            '[&:has([data-slot=left-icon])>[data-slot=control]]:pl-[2.2rem]',
            
            // RIGHT PADDING: Dynamic padding based on number of action elements
            // Each action input option (or right icon) takes ~1.9rem of space, padding increases accordingly
            
            // 1 action element (clearable OR copyable OR revealable OR rightIcon so there is [1-4] element)
            '[&:has([data-slot=input-actions]):has([data-slot=input-option])>[data-slot=control]]:pr-[1.9rem]',
            
            // 2 action elements 
            '[&:has([data-slot=input-actions]):has([data-slot=input-option]+[data-slot=input-option])>[data-slot=control]]:pr-[3.8rem]',
            
            // 3 action elements
            '[&:has([data-slot=input-actions]):has([data-slot=input-option]+[data-slot=input-option]+[data-slot=input-option])>[data-slot=control]]:pr-[5.7rem]',
            
            // 4 action elements 
            '[&:has([data-slot=input-actions]):has([data-slot=input-option]+[data-slot=input-option]+[data-slot=input-option]+[data-slot=input-option])>[data-slot=control]]:pr-[7.6rem]',
        ])
        
        {{-- ========================================================================== --}}
        {{-- DYNAMIC GRID COLUMN TEMPLATE SYSTEM --}}
        {{-- ========================================================================== --}}
        {{-- Dynamically adjusts grid structure based on icon presence --}}
        @style([
            // CSS custom properties for calculations
            '--icon-count: '. $iconCount,              // Number of right-side action icons
            '--icon-width: 2rem',                      // Standard width for each icon
            
            // WITHOUT LEFT ICON: 2-column layout
            // Column 1: Input (flexible width)
            // Column 2: Action icons (fixed width based on count)
            'grid-template-columns: 1fr calc(var(--icon-width) * var(--icon-count))' => !$hasLeftIcon,
            
            // WITH LEFT ICON: 3-column layout  
            // Column 1: Left icon (fixed 2.3rem) 2 seems too small spacially for  left icons
            // Column 2: Input (flexible width)
            // Column 3: Action icons (fixed width based on count)
            'grid-template-columns: 2.3rem 1fr calc(var(--icon-width) * var(--icon-count))' => $hasLeftIcon,
        ])
    >
        @if($hasLeftIcon)
            <div
                class="!text-neutral-500 dark:!text-neutral-500"
                data-slot="left-icon"
            >
                @if($hasLeftIconSlot)
                    {{ $leftIcon }}
                @else
                    <x-ui.icon :name="$leftIcon" class="!size-[1.15rem]" />
                @endif
            </div>
        @endif

        <input
            @class([
                'z-10',
                'inline-block border p-2 w-full text-base sm:text-sm text-neutral-800 disabled:text-neutral-500 placeholder-neutral-400 disabled:placeholder-neutral-400/70 dark:text-neutral-300 dark:disabled:text-neutral-400 dark:placeholder-neutral-400 dark:disabled:placeholder-neutral-500',
                'bg-white dark:bg-neutral-900 dark:disabled:bg-neutral-800',
                'disabled:cursor-not-allowed transition-colors duration-200',
                'shadow-none dark:shadow-sm disabled:shadow-none rounded-box',
                'focus:ring-2 focus:ring-offset-0 focus:outline-none',
                'border-black/10 focus:border-black/15 focus:ring-neutral-900/15 dark:border-white/15 dark:focus:border-white/20 dark:focus:ring-neutral-100/15' => !$invalid,
                'border-red-600/30 border-2 focus:border-red-600/30 focus:ring-red-600/20 dark:border-red-400/30 dark:focus:border-red-400/30 dark:focus:ring-red-400/20' => $invalid,
            ])
            name="{{ $name }}"
            type="{{ $type }}"
            data-slot="control"
            {{ $attributes }}
            data-control-id="input" {{-- used for actions --}}
            @if($invalid) invalid @endif
        />
        <div class="flex items-center justify-center h-full mr-1" data-slot="input-actions">
            @if ($copyable)   <x-ui.input.options.copyable />   @endif
            @if ($clearable)  <x-ui.input.options.clearable />  @endif
            @if ($revealable) <x-ui.input.options.revealable /> @endif

            {{-- This isn't a real input option, just an icon slotted as one. 
                It's here purely to handle padding logic easly, don't judge me 🤓 --}}
            @if ($rightIcon)
                <div class="!text-neutral-500 dark:!text-neutral-500" data-slot="input-option">
                    @if($hasRightIconSlot)
                        {{ $rightIcon }}
                    @else
                        <x-ui.icon :name="$rightIcon" />
                    @endif
                </div>
            @endif
        </div>
    </div>

    {{-- HANDLE SUFFIX SLOTS--}}
    @if (filled($suffix) || filled($suffixIcon))
        <x-ui.input.extra-slot data-slot="input-suffix">
            @if ($suffix instanceof \Illuminate\View\ComponentSlot)
                {{ $suffix }}
            @elseif ($suffixIcon)
                <x-ui.icon name="{{ $suffixIcon }}" />
            @endif
        </x-ui.input.extra-slot>
    @endif
</div>