@aware([
    'variant' => 'default'
])

@props([
    'name' => null,
    'label' => null,
    'description' => null,
    'value' => null,
    'checked' => false,
    'indeterminate' => false,
    'disabled' => false,
    'invalid' => false,
    'size' => 'md',
    'variant' => 'default',
    'indicator' => true,
])

@php
    // Detect if the component is bound to a Livewire model
    $modelAttrs = collect($attributes->getAttributes())->keys()->first(fn($key) => str_starts_with($key, 'wire:model'));

    $model = $modelAttrs ? $attributes->get($modelAttrs) : null;

    // Detect if model binding uses `.live` modifier (for real-time syncing)
    $isLive = $modelAttrs && str_contains($modelAttrs, '.live');
@endphp
<div 
    data-slot="checkbox-wrapper"
    x-data="
        function(){
            const $entangle = (prop, live) => {
                const binding = $wire.$entangle(prop);
                return live ? binding.live : binding;
            };

            const $initState = (prop, live, checked) => {
                if (!prop) return checked;
                return $entangle(prop, live);
            };

            return {
            // ====================================================================
            // STATE INITIALIZATION
            // ====================================================================
            // Initialize component state from props
            _checked: $initState(@js($model), @js($isLive), @js($checked)) , // it's called _checked and not checked for prevent issue when the bounded property named ckecked
            value: @js($value),
            _indeterminate: @js($indeterminate),
            
            // ====================================================================
            // TOGGLE LOGIC
            // ====================================================================
            /**
            * Handles checkbox toggle interaction
            * Clears indeterminate state before toggling checked state
            */
            toggle() {
                // Clear indeterminate state when user interacts
                if (this._indeterminate) {
                    this._indeterminate = false;
                }

                this._checked = !this._checked;
                this.syncHiddenInput();
                this.dispatchChangeEvent();
            },
            
            // ====================================================================
            // COMPONENT INITIALIZATION
            // ====================================================================
            /**
            * Initialize component state based on context:
            * 1. Group context: sync with group's shared state array
            * 2. Individual context: sync with model binding (Alpine/Livewire)
            */
            init() {
                this.$nextTick(()=>{
                    // CASE 1: Checkbox is part of a group wrapper
                    if (this.inInGroup()) {
                        // Check if this checkbox's value exists in the group's state array
                        this._checked = this._state.includes(this.value);
                    }
                    // CASE 2: Standalone checkbox with model binding
                    else {
                        // get initial state from Alpine model or (wire:model) bindings
                        if(!this._checked) {
                            this._checked = this.$root._x_model?.get() ?? false;
                        }
                    }
                });

                // ====================================================================
                // STATE SYNCHRONIZATION WATCHER
                // ====================================================================
                /**
                * Watch for changes to checked state and sync with appropriate context
                */
                this.$watch('_checked', (isChecked) => {
                    // CASE 1: Group context - manage array of values
                    if (this.inInGroup()) {
                        this.syncWithGroupState(isChecked);
                    }
                    // CASE 2: Individual context - sync with model bindings
                    else{
                        // Sync with Alpine.js model binding
                        this.$root?._x_model?.set(isChecked);                
                    }
                });           
            },

            // ====================================================================
            // GROUP STATE MANAGEMENT
            // ====================================================================
            /**
            * Determines if this checkbox is controlled by a group wrapper
            * Group state is an array when model is bound, undefined when not bound
            */
            inInGroup() {
                return ![undefined, null].includes(this._state);
            },

            /**
            * Sync checkbox state with group's shared state array
            */
            syncWithGroupState(isChecked) {
                if (isChecked) {
                    // Add value to group state if not already present
                    if (!this._state.includes(this.value)) {
                        this._state.push(this.value);
                    }

                } else {
                    // Remove value from group state if present
                    if (this._state.includes(this.value)) {
                        this._state = this._state.filter((item) => item !== this.value);
                    }
                }
            },
            // ====================================================================
            // DOM SYNCHRONIZATION
            // ====================================================================
            /**
            * Keep hidden input in sync with component state
            * This ensures form submissions work correctly
            */
            syncHiddenInput() {
                const hiddenInput = this.$refs.hiddenInput;
                if (hiddenInput) {
                    hiddenInput.checked = this._checked;
                }
            },

            /**
            * Dispatch native change event for form integration
            */
            dispatchChangeEvent() {
                this.$refs.hiddenInput?.dispatchEvent(
                    new Event('change', { bubbles: true })
                );
            },
            
            // ====================================================================
            // INDETERMINATE STATE MANAGEMENT
            // ====================================================================
            /**
            * Set indeterminate state (usually called by parent components)
            * When indeterminate, the checkbox appears neither checked nor unchecked
            */
            setIndeterminate(isIndeterminate) {
                this._indeterminate = isIndeterminate;
                if (isIndeterminate) {
                    this._checked = false;
                }
            }
        }
    }"
    {{ $attributes }}
>
    {{-- 
        HIDDEN INPUT FOR FORM COMPATIBILITY
        This hidden input ensures the checkbox works with regular form submissions
        and provides a stable target for model bindings 
    --}}
    <input
        x-ref="hiddenInput"
        type="checkbox"
        @if($name) name="{{ $name }}" @endif
        @if($value !== null) value="{{ $value }}" @endif
        @if($checked) checked @endif
        @if($disabled) disabled @endif
        hidden
        tabindex="-1"
        {{ $attributes->whereStartsWith(['wire:model', 'x-model']) }}
    />
    
    {{-- 
        VISUAL CHECKBOX VARIANTS
        The actual visual representation based on variant prop 
    --}}

    @switch($variant)
        @case('pills')
            <x-ui.checkbox.variant.pill>
                {{ $slot }}
            </x-ui.checkbox.variant.pill>
            @break
            
        @case('cards')
            <x-ui.checkbox.variant.card>
                {{ $slot }}    
            </x-ui.checkbox.variant.card>
            @break
            
        @default
            <x-ui.checkbox.variant.default>                    
                {{ $slot }}
            </x-ui.checkbox.variant.default>                    
    @endswitch
</div>