let COMBOBOX_LIVEWIRE_ID;

const comboboxComponent = ({
    livewire,
    livewireId,
    placeholder,
    model,
    isLive,
    isMultiple,
    isDisabled,
    minSelection = null,
    maxSelection = null,
}) => {

    COMBOBOX_LIVEWIRE_ID = livewireId;

    const $entangle = (prop, live) => {
        const binding = livewire.$entangle(prop);
        return live ? binding.live : binding;
    };

    const $initState = (model, live) => model ? $entangle(model, live) : (isMultiple ? [] : null);

    return {
        __state: $initState(model, isLive),
        __isMultiple: isMultiple,
        __isDisabled: isDisabled,
        __isOpen: false,
        __minSelection: minSelection,
        __maxSelection: maxSelection,
        __previousSelected: undefined,
        __isUsingExternalSearch: false,
        __selectedTags: [],

        init() {

            this.input = this.$rover.input;

            if (window.Livewire !== undefined) {
                window.Livewire.hook('commit', ({ component, succeed }) => {
                    if (component.id === COMBOBOX_LIVEWIRE_ID) {
                        succeed(() => {
                            this.$nextTick(() => {
                                this.$rover.reconcileDom();
                                this.__ensureSelectedMarked();
                            });
                        });
                    }
                });
            }

            const optionsManager = this.$rover.options;

            optionsManager.enableDefaultOptionsHandlers();

            optionsManager.on('click', (_event, closestOption) => {
                if (!closestOption) return;
                const value = closestOption.dataset.value;
                if (value === undefined) return;
                this.selectValue(value);
            });

            optionsManager.on('keydown', (event, _el, activeValue) => {
                if (event.key === 'Enter' && activeValue !== undefined) {
                    this.selectValue(activeValue);
                }
            });

            const inputManager = this.$rover.input;

            inputManager.enableDefaultInputHandlers()

            inputManager.on('keydown', (event, activeValue) => {

                if (event.key === 'Enter' && activeValue !== undefined) {
                    this.handleSelection(activeValue);
                    this.__isMultiple || this.close();
                } else if (event.key === 'Escape') {
                    this.close();
                } else {
                    // keep the dropdown open 
                    this.__isOpen = true;
                }
            })

            inputManager.on('click', () => this.open());


            // init and watch filled states for single selection
            if (!this.__isMultiple) {
                Alpine.effect(() => {
                    // wait for rover engine to collect the values...
                    this.__state && this.$nextTick(() => {
                        inputManager.value = this.utils.getLabel(this.__state);
                    });
                })
            }

            // multiple mode already handled in first runs of the effect 
            Alpine.effect(() => {
                const currentArray = Array.isArray(this.__state)
                    ? this.__state
                    : this.__state != null
                        ? [this.__state]
                        : [];

                const selectedSet = new Set(currentArray);

                if (!this.__previousSelected) this.__previousSelected = new Set();

                const [toAdd, toRemove] = this.__generateDiff(this.__previousSelected, selectedSet);

                if (toAdd.length > 0 || toRemove.length > 0) {
                    requestAnimationFrame(() => {
                        this.__patchDom(toAdd, toRemove);
                    });

                    this.__previousSelected.clear();
                    for (const v of selectedSet) this.__previousSelected.add(v);
                }
            });

            this.$nextTick(() => {
                Alpine.effect(() => {
                    if (!this.__state) { this.__selectedTags = []; return; }

                    const values = Array.isArray(this.__state) ? this.__state : [this.__state];

                    this.__selectedTags = values.map(value => {
                        // keep existing tag with its label if already resolved
                        const existing = this.__selectedTags.find(t => t.value === value);
                        if (existing?.label) return existing;

                        // return new tag object else
                        return {
                            value,
                            label: this.utils.getLabel(value),
                        };
                    });
                });;
            })
        },

        open() {
            this.__isOpen = true;

            this.$rover.input.focus();

            this.$nextTick(() => {
                this.__activateSelectedOrFirst();
            });
        },

        close() {
            this.__isOpen = false;

            this.$rover.deactivate();

            this.$rover.input.focus();
        },

        selectValue(value) {
            this.handleSelection(value);
        },

        // iff the click outside the panel but on the trigger we should
        //  prevent the panel from closing  
        handleClickAway(target) {
            const trigger = this.$refs.trigger;

            if (trigger && trigger.contains(target)) {
                return;
            }

            this.close();
        },

        handleSelection(value) {
            if (!this.__isMultiple) {
                this.__state = this.__state === value ? null : value;
                return;
            }

            if (!Array.isArray(this.__state)) this.__state = [];

            const index = this.__state.indexOf(value);
            const isSelected = index !== -1;

            if (isSelected) {
                if (this.__minSelection !== null && this.__state.length <= this.__minSelection) return;
                this.__state.splice(index, 1);
            } else {
                if (this.__maxSelection !== null && this.__state.length >= this.__maxSelection) return;
                this.__state.push(value);
            }

            
            requestAnimationFrame(() => {
                this.$rover.input.value = ''
            })
            this.$rover.input.focus();
        },

        deselect(value) {
            if (!Array.isArray(this.__state)) return;
            this.__state = this.__state.filter(v => v !== value);
        },

        clear() {
            if (this.__isMultiple) {
                this.__state = this.__minSelection
                    ? this.__state.slice(0, this.__minSelection)
                    : [];
            } else {
                this.__state = null;
            }
            this.close();
        },

        __generateDiff(oldItems, newItems) {
            const toAdd = [];
            const toRemove = [];
            if (!oldItems) oldItems = new Set();
            for (const v of newItems) if (!oldItems.has(v)) toAdd.push(v);
            for (const v of oldItems) if (!newItems.has(v)) toRemove.push(v);
            return [toAdd, toRemove];
        },

        __patchDom(toAdd, toRemove) {
            this.$nextTick(() => {
                for (const v of toAdd) {
                    const el = this.$rover.getOptionElByValue(v);
                    if (el) {
                        el.setAttribute('aria-selected', 'true');
                        el.dataset.selected = 'true';
                    }
                }
                for (const v of toRemove) {
                    const el = this.$rover.getOptionElByValue(v);
                    if (el) {
                        el.setAttribute('aria-selected', 'false');
                        delete el.dataset.selected;
                    }
                }
            });
        },

        __ensureSelectedMarked() {
            const values = Array.isArray(this.__state) ? this.__state : (this.__state ? [this.__state] : []);
            values.forEach(val => {
                const el = this.$rover.getElementByValue(val);
                if (!el || Object.hasOwn(el.dataset, 'selected')) return;
                el.dataset.selected = 'true';
            });
        },

        __activateSelectedOrFirst() {
            if (this.__state) {
                const valueToActivate = this.__isMultiple
                    ? (Array.isArray(this.__state) ? this.__state[0] : null)
                    : this.__state;

                if (valueToActivate) {
                    this.$rover.activate(valueToActivate);
                    return;
                }
            }

            if (!this.$rover.getActiveItem()) {
                this.$rover.activateFirst();
            }
        },


        get hasSelection() {
            if (this.__isMultiple) return Array.isArray(this.__state) && this.__state.length > 0;
            return this.__state != null;
        },

        get selectedLabel() {
            if (!this.__state || this.__isMultiple) return '';
            return this.$rover.getLabel(this.__state) || '';
        },

        get selectedTags() {
            return this.__selectedTags;
        },

        get isAtMax() {
            if (!this.__isMultiple || this.__maxSelection === null) return false;

            return Array.isArray(this.__state) && this.__state.length >= this.__maxSelection;
        },

        get isAtMin() {
            if (!this.__isMultiple || this.__minSelection === null) return false;

            return Array.isArray(this.__state) && this.__state.length <= this.__minSelection;
        },

        destroy() { },
    };
};

Alpine.data('comboboxComponent', comboboxComponent);