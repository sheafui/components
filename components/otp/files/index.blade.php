@props([
    'name' => $attributes->whereStartsWith('wire:model')->first() ?? $attributes->whereStartsWith('x-model')->first(),
    'length' => 4,
    'type' => 'text',
    'allowedPattern' => '[0-9]',
    'autofocus' => false,
])

@php
    // Detect if the component is bound to a Livewire model
    $modelAttrs = collect($attributes->getAttributes())->keys()->first(fn($key) => str_starts_with($key, 'wire:model'));

    $model = $modelAttrs ? $attributes->get($modelAttrs) : null;

    // Detect if model binding uses `.live` modifier (for real-time syncing)
    $isLive = $modelAttrs && str_contains($modelAttrs, '.live');
@endphp

<div
    x-data="
        function() {

        // Bridge function between Livewire entanglement and local Alpine reactivity
        const $entangle = (prop, live) => {
            const binding = $wire.$entangle(prop);
            return live ? binding.live : binding;
        };

        // Initialize component state based on presence of Livewire model
        const $initState = (model, live) => model ? $entangle(model, live) : '';

        return {
            // The actual OTP value (joined from inputs)
            _state: $initState(@js($model), @js($isLive)),

            // List of input DOM nodes
            _inputs: [],

            length: @js($length),
            allowedPattern: @js($allowedPattern),
            autofocus: @js($autofocus),

            // Main setup entrypoint
            init() {
                $nextTick(() => {
                    this.setupInputs();
                    this.updateInputAvailability();

                    // Hydrate from existing Alpine/Livewire model if available (SSR-safe)
                    const externalState = this.$root?._x_model?.get();
                    if (externalState) {
                        const chars = String(externalState).slice(0, this.length).split('');
                        this._state = chars.join('');

                        chars.forEach((char, i) => {
                            if (this._inputs[i]) {
                                this._inputs[i].value = char;
                            }
                        });
                    }

                    // Determine where to start focus (last empty input)
                    const lastEmptyInputBox = this._state.length;

                    if (this._inputs[lastEmptyInputBox]) {
                        this._inputs[lastEmptyInputBox].disabled = false;

                        if (this.autofocus) {
                            // Wait for rendering before focusing (avoids flickers)
                            requestAnimationFrame(() => this._inputs[lastEmptyInputBox].focus())
                        }
                    }
                });

                // React to changes in the joined OTP value
                this.$watch('_state', (value) => {
                    // Keep Alpine/Livewire state in sync
                    this.$root?._x_model?.set(value);
                    this.updateInputAvailability();

                    // Trigger completion event when all boxes filled
                    if (value.length === this.length) {
                        // if so wait until the last input get filled then call `onComplete`
                        $nextTick(()=> this.onComplete());
                    }
                });
            },

            // Collect all OTP input nodes and assign meta data
            setupInputs() {
                this._inputs = Array.from(this.$el.querySelectorAll('[data-slot=otp-input]'));

                this._inputs.forEach((input, index) => {
                    input.setAttribute('data-order', index);
                    input.setAttribute('aria-label', `Digit ${index + 1} of ${this.length}`);
                });
            },

            // Enable only the next valid input (lock the rest)
            updateInputAvailability() {
                // Inputs are enabled only up to (filled count + 1)
                const enableCount = this._state.length < this.length ? this._state.length + 1 : this.length;

                this._inputs.forEach((input, index) => {
                    input.disabled = index >= enableCount;
                });
            },

            // Dispatch event when OTP is completely filled
            onComplete() {
                this.$dispatch('otp-complete', { code: this._state });
            },

            // Handle user typing in a single input
            handleInput(el) {
                const index = parseInt(el.dataset.order);
                let value = el.value;

                // Always keep last typed character (avoid multi-char paste in one box)
                if (value.length > 1) {
                    value = value.slice(-1);
                    el.value = value;
                }

                // Reject characters not matching the pattern
                const regex = new RegExp(`^${this.allowedPattern}$`);
                if (!regex.test(value)) {
                    el.value = '';
                    return;
                }

                // After a valid input, update and move focus
                requestAnimationFrame(() => {
                    this.$updateStateFromInputs();

                    const next = this._inputs[index + 1];
                    if (next) this.focusAndSelect(next);
                });
            },

            // Handle paste: distribute valid chars across remaining inputs
            handlePaste(e) {
                const pasted = e.clipboardData.getData('text');
                const regex = new RegExp(`^${this.allowedPattern}$`);
                const validChars = Array.from(pasted).filter(char => regex.test(char));
                const startIndex = parseInt(e.target.dataset.order);

                // Clear all inputs after paste start position
                for (let i = startIndex; i < this._inputs.length; i++) {
                    this._inputs[i].value = '';
                }

                // Fill inputs sequentially with valid chars
                validChars.slice(0, this.length - startIndex).forEach((char, offset) => {
                    this.enableAndFill(char, offset + startIndex);
                });

                // Recalculate state and focus next target input
                $nextTick(() => {
                    this.$updateStateFromInputs();

                    const nextIndex = startIndex + validChars.length;
                    const next = this._inputs[nextIndex];

                    if (next) {
                        this.focusAndSelect(next);
                    } else if (validChars.length + startIndex >= this.length) {
                        // If paste fills all boxes, focus last input for convenience
                        const lastInput = this._inputs[this.length - 1];
                        if (lastInput) {
                            requestAnimationFrame(() => {
                                lastInput.focus();
                                lastInput.select();
                            });
                        }
                    }
                });
            },

            // Handle backspace press (supports deleting from middle)
            handleBackspace(e) {
                const input = e.target;
                const index = parseInt(input.dataset.order);

                input.value = '';

                // Shift subsequent characters left (maintains continuity)
                this.shiftInputsToLeft(index);
                this.$updateStateFromInputs();

                // Determine focus target (stay or move back)
                if (index > 0 && input.value === '') {
                    const prev = this._inputs[index - 1];
                    if (prev) {
                        requestAnimationFrame(() => {
                            prev.focus();
                            prev.select();
                        });
                    }
                } else {
                    requestAnimationFrame(() => {
                        input.focus();
                        input.select();
                    });
                }
            },

            // Shift values left from the given index (used in deletion)
            shiftInputsToLeft(fromIndex) {
                for (let i = fromIndex; i < this._inputs.length - 1; i++) {
                    const current = this._inputs[i];
                    const next = this._inputs[i + 1];

                    if (next && next.value) {
                        current.value = next.value;
                        current.disabled = false;
                    } else break;
                }

                // Clear last input that had a value
                for (let i = this._inputs.length - 1; i > fromIndex; i--) {
                    if (this._inputs[i].value) {
                        this._inputs[i].value = '';
                        break;
                    }
                }
            },

            // Utility to enable and fill a given index with a character
            enableAndFill(char, index) {
                const input = this._inputs[index];
                if (!input) return;

                input.disabled = false;
                input.value = char;
            },

            // Utility to safely focus and select an input
            focusAndSelect(el) {
                if (!el) return;
                el.disabled = false;
                requestAnimationFrame(() => {
                    el.focus();
                    el.select();
                });
            },

            // Recompute internal state based on input values
            $updateStateFromInputs() {
                this._state = this._inputs.map(input => input.value || '').join('');
            },

            // Public method: Clear all inputs and reset focus
            clear() {
                this._inputs.forEach(input => {
                    input.value = '';
                    input.disabled = true;
                });

                if (this._inputs[0]) this._inputs[0].disabled = false;
                this._state = '';

                if (this.autofocus && this._inputs[0]) {
                    requestAnimationFrame(() => this._inputs[0].focus());
                }
            },

            // Public method: Focus first empty input box
            focus() {
                const firstEmpty = this._inputs.find(input => !input.value) || this._inputs[0];
                if (firstEmpty) this.focusAndSelect(firstEmpty);
            },

            // Handle clicks anywhere inside the container (smart focus delegation)
            handleClick(e) {
                const clickedInput = e.target.closest('[data-slot=otp-input]');

                // If clicked directly on an active input
                if (clickedInput && !clickedInput.disabled) {
                    this.focusAndSelect(clickedInput);
                    return;
                }

                // Otherwise, find the best input to focus next
                const firstEmpty = this._inputs.find(input => !input.value && !input.disabled);

                if (firstEmpty) {
                    this.focusAndSelect(firstEmpty);
                } else {
                    // All filled: focus last for easy editing
                    const lastInput = this._inputs[this.length - 1];
                    if (lastInput && !lastInput.disabled) {
                        this.focusAndSelect(lastInput);
                    }
                }
            }
        }
    }"
    {{ $attributes->except('class') }}
    class="contents" 
    x-on:otp-clear.window="clear()"
    x-on:otp-focus.window="focus()"
    wire:ignore
>
    <div 
        x-ref="inputsWrapper" 
        role="group" 
        aria-label="One Time Password Input" 
        {{ $attributes->class('text-start') }}
    >
        <div
            @class([
                'flex rounded-box items-center z-isolate',
                '[:where(&>[data-slot=otp-input]:has(+[data-slot=separator]))]:rounded-r-box',
                '[:where(&>[data-slot=separator]+[data-slot=otp-input])]:rounded-l-box',
            ]) 
            x-on:click="handleClick($event)"
        >
            @if ($slot->isNotEmpty())
                {{-- Developer-defined slot version (for custom design control) --}}
                {{ $slot }}
            @else
                {{-- Default autogenerated inputs when no slot provided --}}
                @foreach (range(1, $length) as $column)
                    <x-ui.otp.input />
                @endforeach
            @endif
        </div>
    </div>
</div>
