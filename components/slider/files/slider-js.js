import noUiSlider from 'nouislider'


const sliderComponent = ({
    arePipsStepped,
    behavior,
    decimalPlaces,
    fillTrack,
    isRtl,
    isVertical,
    limit,
    margin,
    maxValue,
    minValue,
    nonLinearPoints,
    pipsDensity,
    pipsMode,
    pipsValues,
    padding,
    step,
    tooltips,

}) => ({
    _state: null,
    _slider: null,

    // callbacks to be overriden easily when using the component 
    pipLabelFormater: (label) => label,
    tooltipFormatter: (value) => value,
    pipFilter: undefined,

    init() {

        this.$nextTick(() => {
            // Sync external state (Alpine x-model or Livewire wire:model)
            this._state = this.$root?._x_model?.get();

            this.initSlider();

            this._slider.on('change', (values) => {
                this._state = values.length > 1 ? values : values[0]
            })

            this.$watch('_state', (value) => {

                this._slider.set(Alpine.raw(value))

                // Sync with Alpine x-model
                this.$root?._x_model?.set(value);

                // Sync with Livewire wire:model
                let wireModel = this.$root.getAttributeNames()?.find(n => n.startsWith('wire:model'))

                if (this.$wire && wireModel) {
                    let prop = this.$root.getAttribute(wireModel)
                    this.$wire.set(prop, value, wireModel?.includes('.live'));
                }
            })

        });
    },

    formatPipValueUsing(callback) {
        this.pipLabelFormater = callback
    },

    filterPipsUsing(callback) {
        this.pipFilter = callback;
    },

    formatTooltipUsing(callback) {
        this.tooltipFormatter = callback;
    },

    initSlider() {
        const config = {
            behaviour: behavior,
            direction: isRtl ? 'rtl' : 'ltr',
            connect: fillTrack,
            format: {
                from: (value) => value,
                to: (value) =>
                    decimalPlaces !== null
                        ? +value.toFixed(decimalPlaces)
                        : value,
            },
            orientation: isVertical ? 'vertical' : 'horizontal',
            range: {
                min: minValue,
                ...(nonLinearPoints ?? {}),
                max: maxValue,
            },
            start: Alpine.raw(this._state),
        }

        if (step !== null) config.step = step
        if (limit !== null) config.limit = limit
        if (margin !== null) config.margin = margin
        if (padding !== null) config.padding = padding

        if (tooltips !== false) {
            config.tooltips = tooltips === true
                ? {
                    to: (value) => this.tooltipFormatter(value)
                }
                : tooltips
        }

        // pips configurations  
        if (pipsMode !== null) {
            config.pips = {
                density: pipsDensity ?? 10,

                mode: pipsMode,
                format: {
                    to: (value) => this.pipLabelFormater(value)
                },
                stepped: arePipsStepped,
            }

            if (typeof this.pipFilter === 'function') {
                config.pips.filter = (value, type) => this.pipFilter(value, type)
            }

            // if (pipsFilter !== null) config.pips.filter = pipsFilter
            if (pipsValues !== null) config.pips.values = pipsValues
        }

        this._slider = noUiSlider.create(this.$el, config)
    },
    get $slider() {
        return this;
    },

    disable(index = null) {
        this.$nextTick(()=>{
            if (index) {
                this._slider.disable(index);
            } else {
                this._slider.disable();
                this.$root.setAttribute('disabled','true');
            }
        })
    },
    destroy() {
        if (this._slider) {
            this._slider.destroy()
            this._slider = null
        }
    },
})

Alpine.data('sliderComponent', sliderComponent)