
const autocompleteComponent = ({
    model,
    livewire,
    livewireId,
    isLive,
}) => {

    const $entangle = (prop, live) => {
        const binding = livewire.$entangle(prop);
        return live ? binding.live : binding;
    };

    const $initState = (model, live) => model ? $entangle(model, live) : null;

    return {
        __state: $initState(model, isLive),
        __isOpen: false,

        init() {
            const inputManager = this.$rover.input;

            inputManager.enableDefaultInputHandlers();

            inputManager.on('keydown', (event, activeValue) => {

                if (event.key === 'Enter' && activeValue !== undefined) {
                    this.handleSelect(activeValue);
                    this.close();
                } else if (event.key === "Escape") {
                    this.close();
                } else {
                    // don't call this.open()...
                    this.__isOpen = true;
                }
            });

            inputManager.on('click', () => this.open());

            inputManager.on('input', () => {
                if (!this.__isOpen) this.open();

                if (inputManager.value === '') {
                    this.__state = null;
                }
            });

            // Click an option
            this.$rover.options.enableDefaultOptionsHandlers();

            this.$rover.options.on('click', (_event, closestOption) => {
                if (!closestOption) return;
                const value = closestOption.dataset.value;
                if (value === undefined) return;
                this.handleSelect(value);
                this.close();
            });


            // bridge for alpine bindings
            this.$nextTick(() => {
                this.__state = this.$root?._x_model?.get();

                Alpine.effect(() => {
                    // Sync with Alpine.js x-model
                    if (this.__state !== undefined) {
                        this.bindValue(this.__state);
                    }
                });

            })

            this.$watch('__state', (val) => {
                this.$root?._x_model?.set(val);
            });

        },

        handleSelect(val) {
            this.__state = val;
        },

        bindValue(val) {
            this.$nextTick(() => {
                // we need to fallback to val for valeus that aren't part of 
                // the provided items so they don't an associated label
                const label = this.utils.getLabel(val) ?? val;
                this.$rover.input.value = label;
            });
        },

        open() {
            this.__isOpen = true;
            this.$nextTick(() => {
                this.$rover.input.focus();
                this.$rover.activateFirst();
            });
        },

        close() {
            this.__isOpen = false;
            this.$rover.deactivate();
            this.$rover.collection.reset();
        },

        handleClickAway(event) {
            const control = this.$refs.autocompleteControl;
            if (control && control.contains(event.target)) return;
            this.close();
        },

        clear() {
            this.__state = null;
            this.$rover.input.value = '';
            this.$rover.collection.reset();
        },

        get isShown() {
            return this.__isOpen && this.$rover.hasVisibleOptions()
        },

        get hasSelection() {
            return this.__state != null;
        },
    };
};

Alpine.data('autocompleteComponent', autocompleteComponent);