{{--
    Checkbox Group Wrapper Component
    
    Manages shared state for multiple checkboxes, supporting:
    - Individual checkbox selection (array of values)
    - Different visual layouts (default, pills, cards)
    - Automatic spacing based on content (descriptions, etc.)
    - Model binding synchronization (Alpine.js and Livewire)
--}}

@props([
    'variant' => 'default',
    'model' => $attributes->whereStartsWith(['wire:model', 'x-model'])
])

@php
// ====================================================================
// VARIANT-BASED LAYOUT CLASSES
// ====================================================================
$classes = match($variant) {
        // Pills: Horizontal layout with wrapping
        'pills' => 'flex gap-2 flex-wrap',
        
        // Cards: Vertical stack layout
        'cards' => 'flex flex-col gap-2',
        
        // Default: Smart vertical spacing with content-aware gaps
        default => [
            // Base spacing: 0.75rem (12px) between checkbox wrappers (except first)
            '[&>[data-slot=checkbox-wrapper]:not(:first-child)]:mt-3',
            
            // Enhanced spacing: 1rem (16px) when a checkbox with description 
            // is followed by another checkbox (provides better visual separation)
            '[&>[data-slot=checkbox-wrapper]:has([data-slot=checkbox-description])+[data-slot=checkbox-wrapper]]:mt-4'
        ]
    };

    // Detect if the component is bound to a Livewire model
    $modelAttrs = collect($attributes->getAttributes())->keys()->first(fn($key) => str_starts_with($key, 'wire:model'));

    $model = $modelAttrs ? $attributes->get($modelAttrs) : null;

    // Detect if model binding uses `.live` modifier (for real-time syncing)
    $isLive = $modelAttrs && str_contains($modelAttrs, '.live');

@endphp

<div
    x-data="
    function(){
        const $entangle = (prop, live) => {
            const binding = $wire.$entangle(prop);
            return live ? binding.live : binding;
        };

        const $initState = (prop, live) => {
            if (!prop) return undefined;
            return $entangle(prop, live);
        };

        return {
            _state: $initState(@js($model), @js($isLive)),

            init() {
                this.$nextTick(() => {

                    if (this._state == undefined) {
                        this._state = this.$root?._x_model?.get() ?? undefined;
                    }

                });
                
                this.$watch('_state', (values) => {
                    
                    if (values === undefined) return;

                    this.$root?._x_model?.set(values);
                });
            },
        }
    }"
    {{ $attributes->class($classes) }}

    data-slot="checkbox-group"
>
    {{-- 
        CHILD CHECKBOXES
        All child checkboxes will inherit the group's Alpine scope
        and can access 'groupState' via 'this._state' property
    --}}
    {{ $slot }}
</div>