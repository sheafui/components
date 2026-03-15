
let LIVEWIRE_ID;

const selectComponent = ({
    livewire,
    placeholder,
    livewireId,
    model,
    isLive,
    isMultiple,
    isDisabled,
    minSelection = null,
    maxSelection = null,
    searchable,
    pillbox
}) => {

    LIVEWIRE_ID = livewireId;

    const $entangle = (prop, live) => {
        const binding = livewire.$entangle(prop)
        return live ? binding.live : binding
    }

    const $initState = (model, live) => model ? $entangle(model, live) : (isMultiple ? [] : null);

    return {
        __state: $initState(model, isLive),
        __selectedTags: [],
        __isMultiple: isMultiple,
        __isDisabled: isDisabled,
        __isOpen: false,
        __minSelection: minSelection,
        __maxSelection: maxSelection,
        __previousSelected: undefined,
        __usingExternalSearch: false,
        __selectedTags: [],


        init() {

            if (window.Livewire !== undefined) {
                window.Livewire.hook('commit', ({ component, succeed }) => {
                    if (component.id === LIVEWIRE_ID) {
                        succeed(() => {
                            // we need to wait until alpine finish it process then reconcile 
                            // the dom with the new coming or deleted nodes
                            this.$nextTick(() => {
                                this.$rover.reconcileDom();
                                this.ensureSelectedMarked();
                            });
                        });
                    }
                });
            }
            //  handle dom interactions... 
            if (searchable) {
                let inputManager = this.$rover.input

                inputManager.enableDefaultInputHandlers()

                inputManager.on('keydown', (event, activeValue) => {
                    if (event.key === 'Enter' && activeValue !== undefined) {
                        this.handleSelection(activeValue)
                        this.__isMultiple || this.close()
                    }
                    if (event.key === "Escape") {
                        this.close();
                    }
                })
            }

            let optionsManager = this.$rover.options;

            this.$rover.button.on('click', () => this.handleButtonClick());

            optionsManager.enableDefaultOptionsHandlers()

            optionsManager.on('click', (_event, closestOption) => {
                if (closestOption !== undefined) {
                    const value = closestOption.dataset.value;
                    if (value !== undefined) {
                        this.handleSelection(value);
                        this.__isMultiple || this.close();
                    }
                }
            });

            optionsManager.on('keydown', (event, _el, activeValue) => {

                if (event.key.length === 1 && new RegExp('^[a-zA-Z0-9]$').test(event.key)) {
                    this.$rover.activateByKey(event.key);
                    return;
                }

                if (event.key === 'Enter' && activeValue !== undefined) {
                    this.handleSelection(activeValue)
                    this.__isMultiple || this.close()
                }

                if (event.key === "Escape") {
                    this.close();
                }
            });

            // handle states changes...
            Alpine.effect(() => {
                const currentArray = Array.isArray(this.__state)
                    ? this.__state
                    : this.__state != null
                        ? [this.__state]
                        : [];

                const selectedSet = new Set(currentArray);


                if (!this.__previousSelected) this.__previousSelected = new Set();

                let toAdd, toRemove;

                [toAdd, toRemove] = this.generateDiff(this.__previousSelected, selectedSet);

                if (toAdd.length > 0 || toRemove.length > 0) {

                    // diff based patching in single repaint to 
                    // prevent redundant reflows, repaints... 
                    requestAnimationFrame(() => {
                        this.patchDom(toAdd, toRemove);
                        this.updateTriggerValue();
                    });

                    // refresh the cached last optimizer 
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
        generateDiff(oldItems, newItems) {

            const valuestoAdd = [];
            const valuesToRemove = [];

            if (!oldItems) oldItems = new Set();

            for (const v of newItems) if (!oldItems.has(v)) valuestoAdd.push(v);

            for (const v of oldItems) if (!newItems.has(v)) valuesToRemove.push(v);

            return [valuestoAdd, valuesToRemove]
        },
        patchDom(toAdd, toRemove) {
            // we need to wait for alpine to flush the internal scheduler, thus 
            // the rover get collect the options, ans so we have access to `getOptionElByValue` 
            // method
            this.$nextTick(() => {
                for (let i = 0; i < toAdd.length; i++) {
                    const el = this.$rover.getOptionElByValue(toAdd[i])
                    if (el) {
                        el.setAttribute('aria-selected', 'true')
                        el.dataset.selected = 'true'
                    }
                }

                for (let i = 0; i < toRemove.length; i++) {
                    const el = this.$rover.getOptionElByValue(toRemove[i])
                    if (el) {
                        el.setAttribute('aria-selected', 'false')
                        delete el.dataset.selected
                    }
                }
            });
        },

        ensureSelectedMarked() {
            if (isMultiple) {
                this.__state.map((val) => {
                    let el = this.$rover.getElementByValue(val)

                    if (el === undefined) return;

                    if (Object.hasOwn(el.dataset, 'selected')) return;

                    el.dataset.selected = 'true';
                })
            } else if (!isMultiple && this.__state) {
                let el = this.$rover.getElementByValue(this.__state)

                if (el === undefined) return;

                el.dataset.selected = 'true';
            }
        },
        handleButtonClick() {
            this.__isOpen ? this.close() : this.open();
        },

        open() {
            this.__isOpen = true;

            this.$nextTick(() => {
                // this already happens on next frame at the rover core...
                if (searchable) {
                    this.$rover.input.focus();
                } else {
                    this.$rover.options.focus();
                }

                this.activateSelectedOrActivatedOrFirst()
            });
        },

        close() {
            this.__isOpen = false;
        },

        handleClickAway(target) {
            const trigger = this.$refs.trigger;

            if (trigger && trigger.contains(target)) {
                return;
            }

            this.close();
        },

        deselect(value) {
            this.__state = this.__state.filter((val) => val !== value);
        },

        handleSelection(value) {
            if (!this.__isMultiple) {
                this.__state = this.__state === value ? null : value;
                return
            }

            if (!Array.isArray(this.__state)) this.__state = [];

            const index = this.__state.indexOf(value);
            const isSelected = index !== -1;

            if (isSelected) {
                if (this.__minSelection !== null && this.__state.length <= this.__minSelection) return
                this.__state.splice(index, 1);
            } else {
                if (this.__maxSelection !== null && this.__state.length >= this.__maxSelection) return
                this.__state.push(value);
            }
        },

        updateTriggerValue() {
            // we need to wait until alpine boots up and all
            //  options get collected by the `rover collector` 
            this.$nextTick(() => {
                const trigger = this.$root.querySelector('[x-ref\\:trigger-value]');
                if (!trigger) return;

                const bindValueToTrigger = val => trigger.textContent = val;
                const getLabel = val => this.$rover.getOptionElByValue(val)?.dataset?.label || '';

                if (!this.__isMultiple) {
                    bindValueToTrigger(getLabel(this.__state));
                } else if (!this.__state || this.__state.length === 0) {
                    bindValueToTrigger(placeholder);
                } else if (this.__state.length === 1) {
                    bindValueToTrigger(getLabel(this.__state[0]));
                } else {
                    bindValueToTrigger(`${this.__state.length} items selected`);
                }
            });
        },

        activateSelectedOrActivatedOrFirst() {
            if (this.__state) {
                const valueToActivate = this.__isMultiple
                    ? Array.isArray(this.__state) ? this.__state[0] : null
                    : this.__state

                if (valueToActivate) {
                    this.$rover.activate(valueToActivate)
                    return
                }
            }

            if (this.$rover.getActiveItem()) return;

            this.$rover.activateFirst()
        },

        get hasSelection() {
            if (this.__isMultiple) return Array.isArray(this.__state) && this.__state.length > 0
            return this.__state != null
        },

        get isAtMax() {
            if (!this.__isMultiple || this.__maxSelection === null) return false
            return Array.isArray(this.__state) && this.__state.length >= this.__maxSelection
        },

        get isAtMin() {
            if (!this.__isMultiple || this.__minSelection === null) return false
            return Array.isArray(this.__state) && this.__state.length <= this.__minSelection
        },
        clear() {
            if (this.__isMultiple) {
                this.__state = this.__minSelection ? this.__state.slice(0, this.__minSelection) : []
                return
            }
            this.__state = null
        },
        get selectedTags() {
            return this.__selectedTags
        },
    }
}

const CreateNewOptionActivator = () => ({
    init() {
        // defer until Alpine finishes bootstrapping (on the current microtask)
        //  this element's directives
        queueMicrotask(() => this.activate())

        if (window.Livewire !== undefined) {
            window.Livewire.hook('commit', ({ component, succeed }) => {
                if (component.id === LIVEWIRE_ID) {
                    succeed(() => {
                        // wait for Alpine's scheduler to flush 
                        // after the Livewire commit
                        this.$nextTick(() => this.activate());
                    });
                }
            });
        }

        this.$rover.input.on('keydown', (event,) => {
            if (event.key === "Enter") {
                this.$el.click();
            }
        })
    },
    activate() {
        this.$el.dataset.active = 'true';
    },
    deactivate() {
        delete this.$el.dataset.active;
    },
    destroy() {
        this.deactivate();
    }
});
Alpine.data('selectComponent', selectComponent);
Alpine.data('CreateNewOptionActivator', CreateNewOptionActivator);