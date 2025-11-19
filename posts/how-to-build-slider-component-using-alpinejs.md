---
id: slider
title: Build an Advanced Slider Component for TALL Stack Apps (The Right Way)
slug: build-advanced-slider-component-tall-stack-the-right-way
excerpt: HTML range inputs are limiting. Third-party slider libraries break with Livewire. Building from scratch takes forever. Here's how to create a powerful, production-ready slider component that works beautifully with the TALL stack—complete with tooltips, multiple handles, pips, and dead-simple syntax.
author: mohamed charrafi
created_at: 20-11-2025
published_at: 11-11-2025  
category: core component reveal  
---

# Build an Advanced Slider Component for TALL Stack Apps (The Right Way)

> If you read all this post, you'll be eligible to understand the whole SheafUI slider component, so you can customize things I did, that you don't like do easily without needing help from anyone (at least if you're a begineer). So give this its time it will help you understand my open source work well.

Look, I spent ten-ish of hours building this explanation, and I'm gonna be real with you: building a slider component that actually *works* and doesn't make you want to throw your laptop out the window is harder than it looks. But stick with me, because we're about to build something genuinely awesome.

we're going to build a slider that has tons of features and customizable as hell, this is a looking example of it:


@blade
<x-demo x-data="{ budgets: [2000, 5000, 8000] }">
    <div>
        <h3 class="text-lg font-semibold mb-4">Department Budget Allocation</h3>
        <x-ui.slider 
            x-model="budgets"
            :max-value="10000"
            :step="100"
            pips
            pipsMode="steps"
            :pipsDensity="10"
            tooltips
            :fill-track="[true, true, true, false]"
            handleVariant="circle"
            x-init="
                formatTooltipUsing((value) => '€' + (value / 1000).toFixed(1) + 'K');
                formatPipValueUsing((value) => '€' + (value / 1000) + 'K');
                filterPipsUsing((value, type) => {
                    if (type === 0 && value < 1000) return -1;
                    if (value % 2000 === 0) return 1;
                    if (value % 1000 === 0) return 2;
                    return 0;
                });
            "
        />
        <div class="mt-6 grid grid-cols-4 gap-4 text-center text-sm">
            <div>
                <div class="font-semibold text-blue-600">Marketing</div>
                <div x-text="'€' + budgets[0]"></div>
            </div>
            <div>
                <div class="font-semibold text-green-600">Development</div>
                <div x-text="'€' + (budgets[1] - budgets[0])"></div>
            </div>
            <div>
                <div class="font-semibold text-purple-600">Operations</div>
                <div x-text="'€' + (budgets[2] - budgets[1])"></div>
            </div>
            <div>
                <div class="font-semibold text-neutral-600">Reserve</div>
                <div x-text="'€' + (10000 - budgets[2])"></div>
            </div>
        </div>
    </div>
</x-demo>
@endblade


## Why Even Bother?

Before we dive in, you might be thinking: **Why not just use a basic HTML range input?** Well, well, friend, because basic range inputs are about as customizable as a brick. Need tooltips? Good luck with it. Want multiple handles for a price range? Ha! Non-linear scales? Keep dreaming...

That's why [noUiSlider](https://refreshless.com/nouislider/) library comes in. I saw the Filament team choose it, and when I tried it, I realized it's the beast that powers great slider experiences, giving us all the flexibility we need. But here's the thing: noUiSlider's interaction API izzzz a sh.. let's just say it's "feature-rich" 🙂. We're going to wrap it in something beautiful that plays nicely with Laravel, Livewire, and Alpine.js.

## The Component Plan

Here's what we're building:
- A Blade component that feels native to Laravel but is fully reactive
- Seamless **two-way** data binding with both **Livewire** and **Alpine**
- A clean API that doesn't require a PhD to use
- Customizable everything: tooltips, pips, handles, formatters...
- custom design

> we're going to follow the same pattern I've explained in previous post of [how to build reusable blade component for livewire and alpinejs](/blog/post/building-reusable-tall-stack-components-with-wire-model-x-model)

## Step 1: Setting Up the Foundation

First things first, let's get noUiSlider installed:

```bash
npm install nouislider
```

Now, let's think about our file structure. We need three main pieces:
1. `index.blade.php`: Our Blade component
2. `slider.js`: The Alpine component that does the heavy lifting
3. `slider.css`: Css overrides for making it looks good 

the files structure
```
resources/
  views/components/ui/slider/index.blade.php
  js/components/slider.js
  css/components/slider.css
```

## Step 2: The Blade Component - Our Public Interface

This is where the magic begins. We want developers to write something as simple as:

```blade
<x-ui.slider wire:model="volume" :step="1" tooltips />
```

OR

```blade
<div x-data="{ volume: [30] }">
    <x-ui.slider x-model="volume" :step="1" tooltips />
</div>
```

And have it just *work* with 1 stepped and have a top tooltip. No fuss, no muss.

> just try to understand the idea, you'll find the whole code source of the blade file at end of the step


Here's the approach: we'll accept a ton of props but make them all optional with sensible defaults. The component should be smart enough to handle both Livewire (`wire:model`) and Alpine (`x-model`) without the developer even having to think about it.

```blade
@props([
    'id' => null,
    'name' => $attributes->whereStartsWith('wire:model')->first() 
        ?? $attributes->whereStartsWith('x-model')->first(),
    'minValue' => 0,
    'maxValue' => 100,
    'step' => null,
    // ... more props
])
```

See that `name` prop? That's doing some detective work grabbing either `wire:model` or `x-model` automatically. Smart, right?

Here's a cool trick we're using: we're wrapping the actual slider in a container div. Why? Because pips and tooltips need space! If you don't account for this, your tooltips will get cut off, and you'll spend an hour debugging CSS. Been there, done that.

```blade
<div @class([
    'slider-wrapper',
    'ps-10' => $vertical && $hasTooltips,  // Space for vertical tooltips
    'pb-8' => !$vertical && $hasPips,       // Space for horizontal pips
    $attributes->get('class'),
])>
```

Also here, where we construct the slider object using Blade props and pass them to our Alpine component:

```blade
<div
    x-data="sliderComponent({
        arePipsStepped: @js($arePipsStepped),
        behavior: @js($behavior),
        decimalPlaces: @js($decimalPlaces),
        fillTrack: @js($fillTrack),
        isRtl: @js(($rtl ?? $vertical) && !$topToBottom),
        isVertical: @js($vertical),
        // ... all other config
    })"
    data-slot="slider"
    data-variant="{{ $handleVariant }}"
    data-vertical="{{ $vertical ? 'true' : 'false' }}"
    wire:ignore
></div>
```

Notice that `wire:ignore`? That's crucial! It tells Livewire to leave this DOM alone during morphing. Without it, Livewire will try to update the slider's DOM and everything breaks.

other attribtues:

- `data-slot`: we love this way to target our elements in tailwind or css (This pattern was inspired by [Adam Wathan’s talk at Laracon](https://www.youtube.com/watch?v=MrzrSFbxW7M), where he broke down how to build scalable UI libraries). 

Here's the full Blade component:

```blade
@props([
    'id' => null,
    'name' => $attributes->whereStartsWith('wire:model')->first() ?? $attributes->whereStartsWith('x-model')->first(),
    'minValue' => 0,
    'maxValue' => 100,
    'step' => null,
    'decimalPlaces' => null,
    'vertical' => false,
    'topToBottom' => false,
    'rtl' => null,
    'fillTrack' => null,
    'tooltips' => false,
    // pips management
    'pips' => false, 
    'pipsMode' => null,
    'pipsDensity' => null,
    'pipsFilter' => null,
    'pipsValues' => null,
    'pipsFormatter' => null,
    'arePipsStepped' => false,
    
    'behavior' => 'tap',
    'margin' => null,
    'limit' => null,
    'rangePadding' => null,
    'nonLinearPoints' => null,
    'handleVariant' => 'default',
])

@php
    // Enable pips by pips prop if no mode specified
    if($pips && is_null($pipsMode)) $pipsMode = 'range';
    $componentId = $id ?? 'slider-' . uniqid();
    $hasPips = filled($pipsMode);
    $hasTooltips = $tooltips !== false;
@endphp

<div
    @class([
        'slider-wrapper',
        'ps-10' => $vertical && $hasTooltips,
        'pb-8' => !$vertical && $hasPips,
        $attributes->get('class'),
    ])
>
    <div
        x-data="sliderComponent({
            arePipsStepped: @js($arePipsStepped),
            behavior: @js($behavior),
            decimalPlaces: @js($decimalPlaces),
            fillTrack: @js($fillTrack),
            isRtl: @js(($rtl ?? $vertical) && !$topToBottom),
            isVertical: @js($vertical),
            limit: @js($limit),
            margin: @js($margin),
            maxValue: @js($maxValue),
            minValue: @js($minValue),
            nonLinearPoints: @js($nonLinearPoints),
            pipsDensity: @js($pipsDensity),
            pipsFormatter: @js($pipsFormatter),
            pipsValues: @js($pipsValues),
            pipsFilter: @js($pipsFilter),
            pipsMode: @js($pipsMode),
            padding: @js($rangePadding),
            step: @js($step),
            tooltips: @js($tooltips),
        })"
        data-slot="slider"
        data-variant="{{ $handleVariant }}"
        data-vertical="{{ $vertical ? 'true' : 'false' }}"
        @class([
            'relative my-5',
            'h-40' => $vertical,
            'w-full' => !$vertical,
            '!mb-8' => !$vertical && $hasPips,
            '!mt-14' => !$vertical && $hasTooltips,
        ])
        {{ $attributes->except('class') }}
        wire:ignore
    ></div>
</div>
```

## Step 3: The JavaScript Component - Where The Real Magic Happens

Alright, now we're getting to the fun part. Open up `slider.js` and let's build something that'll make other developers jealous.

### The Core Structure

We're using Alpine's `Alpine.data()` to create a reusable component factory. Think of it as a blueprint that creates slider instances:

```javascript
const sliderComponent = ({
    livewire,      // Livewire component instance ($wire)
    model,         // Property name to entangle
    isLive,        // Use .live modifier?
    arePipsStepped,
    behavior,
    decimalPlaces,
    // ... all our config options
}) => {
    // Bridge function between Livewire entanglement and local Alpine reactivity
    const $entangle = (prop, live) => {
        const binding = livewire.$entangle(prop);
        return live ? binding.live : binding;
    };

    // Initialize component state based on presence of Livewire model
    const $initState = (model, live) => model ? $entangle(model, live) : null;

    return {
        _state: $initState(model, isLive),
        _slider: null,
        
        // Callbacks that users can override
        pipLabelFormater: (label) => label,
        tooltipFormatter: (value) => value,
        pipFilter: undefined,
        
        init() {
            // Magic happens here
        }
    }
}
```

### The Synchronization Problem (And How We Solved It)

Here's where it gets tricky—and honestly, this is where I spent most of my debugging time. We need to sync state between multiple places:

1. The internal slider state (`_state`)
2. Alpine's `x-model` (if using Alpine)
3. Livewire's `wire:model` (if using Livewire)

And here's the kicker: they all need to stay in sync **both ways**. When the slider moves, update the model. When the model changes externally, update the slider.

### The Livewire Entanglement - The Secret Sauce

Here's the part that took me forever to get right. Livewire has this amazing feature called "entanglement" that creates a two-way reactive binding between JavaScript and PHP. But you need to set it up correctly.

First, we need to pass Livewire context and model information from Blade to our JavaScript component. Look at how we initialize state:

```javascript
const sliderComponent = ({
    livewire,      // The Livewire component instance
    model,         // The property name (e.g., "volume")
    isLive,        // Whether to use .live modifier
    // ... other config
}) => {
    // Bridge function between Livewire entanglement and local Alpine reactivity
    const $entangle = (prop, live) => {
        const binding = livewire.$entangle(prop);
        return live ? binding.live : binding;
    };

    // Initialize component state based on presence of Livewire model
    const $initState = (model, live) => model ? $entangle(model, live) : null;

    return {
        _state: $initState(model, isLive),
        _slider: null,
        // ...
    }
}
```

**What's happening here?**

1. **`$entangle(prop, live)`** - This creates a magical two-way binding with Livewire. When you change the value in JavaScript, Livewire automatically syncs it to the server. When Livewire updates the value, JavaScript gets notified.

2. **`$initState(model, live)`** - This checks if we're using Livewire (`wire:model`). If yes, it entangles. If no (using Alpine `x-model`), it returns `null` and we fall back to Alpine's reactivity.

3. **The `live` parameter** - This respects Livewire's `.live` modifier. If someone writes `wire:model.live="volume"`, we use real-time syncing. Without `.live`, it waits for the next Livewire request.

Now here's the complete initialization:

```javascript
init() {
    this.$nextTick(() => {
        // Priority: entangled state (Livewire) > x-model (Alpine) > null
        if (!this._state) {
            this._state = this.$root?._x_model?.get();
        }
        
        this.initSlider();
        
        // When slider changes, update our state
        this._slider.on('change', (values) => {
            this._state = values.length > 1 ? values : values[0]
        })
        
        // When state changes, update everything
        this.$watch('_state', (value) => {
            this._slider.set(Alpine.raw(value))
            
            // Sync with Alpine x-model (if using Alpine binding)
            this.$root?._x_model?.set(value);
            
            // Note: Livewire entanglement handles itself automatically!
            // No manual syncing needed because $entangle is reactive
        })
    });
}
```

**The beautiful part:** If `_state` is entangled with Livewire, it's already reactive! When you update `this._state = newValue`, Livewire automatically sees it and syncs to the server. When Livewire updates from the server, `_state` automatically updates in JavaScript, triggering `$watch`, which updates the slider. It's a perfect circle of reactivity!

**Why `$nextTick()`?** Because Alpine's reactive system isn't fully initialized during the component's `init()`. Without `$nextTick()`, `_x_model` might be undefined, and things go sideways. It's like trying to read a book before someone finishes writing it.

**Why `Alpine.raw()`?** When you pass reactive data to noUiSlider, it tries to observe it and things get weird. `Alpine.raw()` unwraps the reactive proxy and gives us the plain value that noUiSlider expects.

### How This Gets Wired Up From Blade

Now, you might be wondering: "Where do `livewire`, `model`, and `isLive` come from?" Great question! We need to extract this from the Blade attributes.

In your Blade component, you'd add logic like this:

```php
@php
    // Detect Livewire binding
    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $isLiveWire = !empty($wireModel);
    
    if ($isLiveWire) {
        // Extract the property name
        $modelValue = $attributes->get($wireModel);
        // Check if .live modifier is present
        $isLive = str_contains($wireModel, '.live');
    }
@endphp

<div
    x-data="sliderComponent({
        livewire: @js($isLiveWire ? true : null),
        model: @js($isLiveWire ? $modelValue : null),
        isLive: @js($isLiveWire ? $isLive : false),
        // ... other config
    })"
    @if($isLiveWire)
        wire:ignore
        x-init="
            // Pass the Livewire component instance
            $el.__x.$data.livewire = $wire;
        "
    @endif
></div>
```

Wait, that's getting complex! Actually, there's a simpler way if you trust the entanglement happens automatically through `wire:model` on the element itself. Let me show you the cleaner approach that's actually in our code...

Actually, looking at the real implementation, it's even more elegant. The Livewire instance (`$wire`) is automatically available in Alpine components within Livewire components. So we pass it directly:

```blade
<div
    x-data="sliderComponent({
        livewire: $wire ?? null,  // Pass Livewire instance if available
        model: @js($wireModelProperty),
        isLive: @js($isLive),
        // ... other config
    })"
    wire:ignore
></div>
```

But here's the thing: we need to extract that `$wireModelProperty` from the attributes in Blade. The component parses `wire:model="volume"` and passes `"volume"` as the `model` parameter.

### Why Entanglement Matters - A Real Example

Let's say you have a volume slider and a "Mute" button in your Livewire component:

```php
class AudioControl extends Component
{
    public $volume = 50;
    
    public function mute()
    {
        $this->volume = 0;
    }
}
```

```blade
<div>
    <x-ui.slider wire:model="volume" tooltips />
    
    <button wire:click="mute">Mute</button>
</div>
```

**Without entanglement:** When you click "Mute", Livewire sets `$volume = 0` on the server. The page re-renders, but your slider doesn't move because it's inside `wire:ignore`. You'd need to manually listen for Livewire updates and sync the slider. Messy!

**With entanglement:** When you click "Mute", Livewire sets `$volume = 0`. Because `_state` is entangled, it automatically gets notified: "Hey, volume changed to 0!" This triggers the `$watch`, which updates the slider. The slider smoothly moves to 0. Beautiful!

It works both ways:
- **User drags slider → `_state` updates → Entanglement syncs to Livewire → `$volume` updates on server**
- **Button clicked → `$volume` updates on server → Entanglement syncs to `_state` → `$watch` fires → Slider updates**

This is the magic of Livewire entanglement. It creates a real-time, two-way reactive binding without you writing any manual sync code.

### The Complete Picture

So the full JavaScript with entanglement looks like this:

```javascript
import noUiSlider from 'nouislider'

const sliderComponent = ({
    livewire,      // Livewire component instance ($wire)
    model,         // Property name to entangle
    isLive,        // Use .live modifier?
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
}) => {
    // Bridge function between Livewire entanglement and local Alpine reactivity
    const $entangle = (prop, live) => {
        const binding = livewire.$entangle(prop);
        return live ? binding.live : binding;
    };

    // Initialize component state based on presence of Livewire model
    const $initState = (model, live) => model ? $entangle(model, live) : null;

    return {
        _state: $initState(model, isLive),
        _slider: null,

        // Callbacks to be overridden
        pipLabelFormater: (label) => label,
        tooltipFormatter: (value) => value,
        pipFilter: undefined,

        init() {
            this.$nextTick(() => {
                // If not entangled, fall back to Alpine's x-model
                if (!this._state) {
                    this._state = this.$root?._x_model?.get();
                }

                this.initSlider();

                this._slider.on('change', (values) => {
                    this._state = values.length > 1 ? values : values[0]
                })

                this.$watch('_state', (value) => {
                    this._slider.set(Alpine.raw(value))

                    // Sync with Alpine x-model (if using Alpine, not Livewire)
                    this.$root?._x_model?.set(value);
                    
                    // Livewire entanglement handles itself! 
                    // No manual sync needed - it's reactive automatically
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
                    ? { to: (value) => this.tooltipFormatter(value) }
                    : tooltips
            }

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

                if (pipsValues !== null) config.pips.values = pipsValues
            }

            this._slider = noUiSlider.create(this.$el, config)
        },

        get $slider() {
            return this;
        },

        disable(index = null) {
            this.$nextTick(() => {
                if (index !== null) {
                    this._slider.disable(index);
                } else {
                    this._slider.disable();
                    this.$root.setAttribute('disabled', 'true');
                }
            })
        },

        destroy() {
            if (this._slider) {
                this._slider.destroy()
                this._slider = null
            }
        },
    }
}

Alpine.data('sliderComponent', sliderComponent)
```

### Key Takeaways About Entanglement

1. **It's opt-in**: If you use `x-model`, entanglement isn't used. If you use `wire:model`, entanglement kicks in.

2. **It's bidirectional**: Changes flow both ways automatically without manual event listeners.

3. **It respects modifiers**: The `.live` modifier works through the `isLive` parameter.

4. **It's efficient**: Livewire only syncs when needed, avoiding unnecessary server requests.

5. **It requires `wire:ignore`**: The slider DOM is complex and shouldn't be morphed by Livewire, but entanglement works through JavaScript, not DOM morphing.

This dual-mode approach (entanglement OR x-model) is what makes the component work seamlessly with both Livewire and pure Alpine setups. Users don't need to think about it—they just use `wire:model` or `x-model` and it works!

### Configuring noUiSlider - Translating Props to Config

Now we need to translate all those nice Blade props into noUiSlider's configuration format:

```javascript
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
    
    // Conditionally add optional configs
    if (step !== null) config.step = step
    if (limit !== null) config.limit = limit
    if (margin !== null) config.margin = margin
    if (padding !== null) config.padding = padding
    
    // Tooltips configuration
    if (tooltips !== false) {
        config.tooltips = tooltips === true
            ? { to: (value) => this.tooltipFormatter(value) }
            : tooltips
    }
    
    // Pips configuration
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
        
        if (pipsValues !== null) config.pips.values = pipsValues
    }
    
    this._slider = noUiSlider.create(this.$el, config)
}
```

Notice how we only add optional configs if they're not null? This keeps the config object clean and lets noUiSlider use its defaults when appropriate.

### The Formatter Pattern - Giving Users Control

Here's something I'm really proud of—we're giving users escape hatches to customize display without touching the core component:

```javascript
formatTooltipUsing(callback) {
    this.tooltipFormatter = callback;
}

formatPipValueUsing(callback) {
    this.pipLabelFormater = callback;
}

filterPipsUsing(callback) {
    this.pipFilter = callback;
}
```

Users can now customize their sliders like this:

```blade
<x-ui.slider 
    x-model="price"
    tooltips
    x-init="$slider.formatTooltipUsing((value) => '$' + value.toFixed(2))"
/>
```

That `$slider` magic? We expose it via a getter:

```javascript
get $slider() {
    return this;
}
```

This makes the API feel natural: `$slider.formatTooltipUsing()` instead of just `formatTooltipUsing()`.

### Cleanup and Utility Methods

We also provide some utility methods:

```javascript
disable(index = null) {
    this.$nextTick(() => {
        if (index !== null) {
            this._slider.disable(index);
        } else {
            this._slider.disable();
            this.$root.setAttribute('disabled', 'true');
        }
    })
}

destroy() {
    if (this._slider) {
        this._slider.destroy()
        this._slider = null
    }
}
```

The `disable()` method can disable a specific handle or the entire slider. The `destroy()` method cleans up when the component is removed from the DOM.

Here's the complete JavaScript:

```javascript
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

    // Callbacks to be overridden easily when using the component 
    pipLabelFormater: (label) => label,
    tooltipFormatter: (value) => value,
    pipFilter: undefined,

    init() {
        this.$nextTick(() => {
            // Sync external state (Alpine x-model)
            this._state = this.$root?._x_model?.get();

            this.initSlider();

            this._slider.on('change', (values) => {
                this._state = values.length > 1 ? values : values[0]
            })

            this.$watch('_state', (value) => {
                this._slider.set(Alpine.raw(value))

                // Sync with Alpine x-model
                this.$root?._x_model?.set(value);
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
                ? { to: (value) => this.tooltipFormatter(value) }
                : tooltips
        }

        // Pips configurations  
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

            if (pipsValues !== null) config.pips.values = pipsValues
        }

        this._slider = noUiSlider.create(this.$el, config)
    },

    get $slider() {
        return this;
    },

    disable(index = null) {
        this.$nextTick(() => {
            if (index !== null) {
                this._slider.disable(index);
            } else {
                this._slider.disable();
                this.$root.setAttribute('disabled', 'true');
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
```

## Step 4: Styling - Making It Look Professional

Now let's talk CSS. We're using Tailwind's `@layer components` to keep everything organized and override noUiSlider's default styles.

First, import noUiSlider's base CSS:

```css
@layer base {
    @import 'nouislider/dist/nouislider.css';
}
```

### The Track

```css
[data-slot='slider'] {
    @apply relative flex items-center justify-center h-3 
           rounded-box border-0 bg-transparent 
           ring-1 ring-neutral-950/10 dark:ring-white/20;
}
```

We're using `ring` instead of `border` because it doesn't affect layout—super important when things need to line up perfectly. The `rounded-box` is a custom Tailwind utility that gives us consistent border radius across the design system.

### The Connects (Fill Areas)

```css
& .noUi-connects {
    @apply rounded-box bg-neutral-950/5 dark:bg-white/5;
}

& .noUi-connect {
    @apply absolute left-0 top-0 h-full bg-[var(--color-primary)];
}

&[disabled='true'] .noUi-connect {
    @apply opacity-25;
}
```

The connects are the filled portions of the track. We use CSS custom properties for the primary color so users can theme it easily.

### The Handle - Two Variants

Here's where we get fancy. We support two handle styles:

**Default Handle** - That classic rectangle with grip lines:
```css
& .noUi-handle {
    @apply absolute rounded-box border border-neutral-950/10 
           bg-neutral-100 dark:bg-neutral-700 shadow-none 
           dark:border-[var(--color-primary)] 
           backface-hidden 
           hover:ring-4 hover:ring-[color-mix(in_oklab,var(--color-primary)_25%,var(--color-primary-fg)_60%)] 
           focus:ring-4 focus:ring-[color-mix(in_oklab,_var(--color-primary)_25%,_var(--color-primary-fg)_60%)];
    
    &::before, &::after {
        @apply w-0.5 mx-[1px] bg-neutral-400;
    }
}
```

For vertical sliders, we rotate the grip lines:
```css
&[data-vertical='true'] .noUi-handle {
    &::before, &::after {
        @apply !h-0.5 !my-[1px] w-1/2 bg-neutral-400;
    }
}
```

**Circle Variant** - For that modern, minimal look:
```css
&[data-variant='circle'] .noUi-handle {
    @apply !w-6 !h-6 rounded-full shadow-md;
    translate: -3px !important;
    
    &::before, &::after {
        @apply hidden;
    }
}
```

### Tooltips

```css
& .noUi-tooltip {
    @apply rounded-box mb-0.5 border-0 bg-white text-neutral-950 
           shadow-sm ring-1 ring-neutral-950/10 
           dark:bg-neutral-800 dark:text-white dark:ring-white/20;
}
```

### Pips (Value Markers)

```css
& .noUi-pips {
    @apply mt-1;
}

& .noUi-pips .noUi-value {
    @apply mt-1 text-neutral-950 dark:text-white;
}
```

### Dark Mode Done Right

Notice how we're using Tailwind's `dark:` modifier everywhere? This gives us automatic dark mode support. No JavaScript theme switching needed—it just works based on the user's system preference or your app's theme class.

Here's the complete CSS:

```css
@layer base {
    @import 'nouislider/dist/nouislider.css';
}

@layer components {
    [data-slot='slider'] {
        @apply relative flex items-center justify-center h-3 rounded-box border-0 bg-transparent ring-1 ring-neutral-950/10 dark:ring-white/20;

        /* Base track */
        & .noUi-target,
        & .noUi-base {
            @apply relative border-none m-0 rounded-box overflow-visible;
        }

        & .noUi-connects {
            @apply rounded-box bg-neutral-950/5 dark:bg-white/5;
        }

        & .noUi-connect {
            @apply absolute left-0 top-0 h-full bg-[var(--color-primary)];
        }

        &[disabled='true'] .noUi-connect {
            @apply opacity-25;
        }

        /* Handle base */
        & .noUi-handle {
            @apply absolute rounded-box border border-neutral-950/10 bg-neutral-100 dark:bg-neutral-700 shadow-none dark:border-[var(--color-primary)] backface-hidden hover:ring-4 hover:ring-[color-mix(in_oklab,var(--color-primary)_25%,var(--color-primary-fg)_60%)] focus:ring-4 focus:ring-[color-mix(in_oklab,_var(--color-primary)_25%,_var(--color-primary-fg)_60%)];

            &::before,
            &::after {
                @apply w-0.5 mx-[1px] bg-neutral-400;
            }
        }

        &[data-vertical='true'] .noUi-handle {
            &::before,
            &::after {
                @apply !h-0.5 !my-[1px] w-1/2 bg-neutral-400;
            }
        }

        /* Variant: circle */
        &[data-variant='circle'] .noUi-handle {
            @apply !w-6 !h-6 rounded-full shadow-md;
            translate: -3px !important;

            &::before,
            &::after {
                @apply hidden;
            }
        }

        /* Handle positioning */
        & .noUi-horizontal .noUi-handle {
            @apply left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform;
        }

        /* Tooltips */
        & .noUi-tooltip {
            @apply rounded-box mb-0.5 border-0 bg-white text-neutral-950 shadow-sm ring-1 ring-neutral-950/10 dark:bg-neutral-800 dark:text-white dark:ring-white/20;
        }

        /* Pips */
        & .noUi-pips {
            @apply mt-1;
        }

        & .noUi-pips .noUi-value {
            @apply mt-1 text-neutral-950 dark:text-white;
        }
    }
}
```

## Installation and Setup

Ready to use this in your project? Here's how to get started:

**Step 1: Install via Sheaf CLI**
```bash
php artisan sheaf:install slider
```

**Step 2: Install noUiSlider**
```bash
npm install nouislider
```

**Step 3: Import the JavaScript**

In your `app.js` or main JavaScript file:
```javascript
import './components/slider.js'
```

**Step 4: Import the CSS**

In your `app.css` or main CSS file:
```css
@import './components/slider.css';
```

**Step 5: Build your assets**
```bash
npm run build
```

That's it! You're ready to start using the slider component.

#

**Blade Component** (`resources/views/components/ui/slider/index.blade.php`):
```blade
@props([
    'id' => null,
    'name' => $attributes->whereStartsWith('wire:model')->first() ?? $attributes->whereStartsWith('x-model')->first(),
    'minValue' => 0,
    'maxValue' => 100,
    'step' => null,
    'decimalPlaces' => null,
    'vertical' => false,
    'topToBottom' => false,
    'rtl' => null,
    'fillTrack' => null,
    'tooltips' => false,
    'pips' => false, 
    'pipsMode' => null,
    'pipsDensity' => null,
    'pipsFilter' => null,
    'pipsValues' => null,
    'pipsFormatter' => null,
    'arePipsStepped' => false,
    'behavior' => 'tap',
    'margin' => null,
    'limit' => null,
    'rangePadding' => null,
    'nonLinearPoints' => null,
    'handleVariant' => 'default',
])

@php
    if($pips && is_null($pipsMode)) $pipsMode = 'range';
    $componentId = $id ?? 'slider-' . uniqid();
    $hasPips = filled($pipsMode);
    $hasTooltips = $tooltips !== false;
@endphp

<div
    @class([
        'slider-wrapper',
        'ps-10' => $vertical && $hasTooltips,
        'pb-8' => !$vertical && $hasPips,
        $attributes->get('class'),
    ])
>
    <div
        x-data="sliderComponent({
            arePipsStepped: @js($arePipsStepped),
            behavior: @js($behavior),
            decimalPlaces: @js($decimalPlaces),
            fillTrack: @js($fillTrack),
            isRtl: @js(($rtl ?? $vertical) && !$topToBottom),
            isVertical: @js($vertical),
            limit: @js($limit),
            margin: @js($margin),
            maxValue: @js($maxValue),
            minValue: @js($minValue),
            nonLinearPoints: @js($nonLinearPoints),
            pipsDensity: @js($pipsDensity),
            pipsFormatter: @js($pipsFormatter),
            pipsValues: @js($pipsValues),
            pipsFilter: @js($pipsFilter),
            pipsMode: @js($pipsMode),
            padding: @js($rangePadding),
            step: @js($step),
            tooltips: @js($tooltips),
        })"
        data-slot="slider"
        data-variant="{{ $handleVariant }}"
        data-vertical="{{ $vertical ? 'true' : 'false' }}"
        @class([
            'relative my-5',
            'h-40' => $vertical,
            'w-full' => !$vertical,
            '!mb-8' => !$vertical && $hasPips,
            '!mt-14' => !$vertical && $hasTooltips,
        ])
        {{ $attributes->except('class') }}
        wire:ignore
    ></div>
</div>
```

**JavaScript** (`resources/js/components/slider.js`):
```javascript
import noUiSlider from 'nouislider'

const sliderComponent = ({
    livewire,
    model,
    isLive,
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
}) => {
    // Bridge function between Livewire entanglement and local Alpine reactivity
    const $entangle = (prop, live) => {
        const binding = livewire.$entangle(prop);
        return live ? binding.live : binding;
    };

    // Initialize component state based on presence of Livewire model
    const $initState = (model, live) => model ? $entangle(model, live) : null;

    return {
        _state: $initState(model, isLive),
        _slider: null,

        pipLabelFormater: (label) => label,
        tooltipFormatter: (value) => value,
        pipFilter: undefined,

        init() {
            this.$nextTick(() => {
                // If not entangled, fall back to Alpine's x-model
                if (!this._state) {
                    this._state = this.$root?._x_model?.get();
                }

                this.initSlider();

                this._slider.on('change', (values) => {
                    this._state = values.length > 1 ? values : values[0]
                })

                this.$watch('_state', (value) => {
                    this._slider.set(Alpine.raw(value))
                    this.$root?._x_model?.set(value);
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
                    ? { to: (value) => this.tooltipFormatter(value) }
                    : tooltips
            }

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

                if (pipsValues !== null) config.pips.values = pipsValues
            }

            this._slider = noUiSlider.create(this.$el, config)
        },

        get $slider() {
            return this;
        },

        disable(index = null) {
            this.$nextTick(() => {
                if (index !== null) {
                    this._slider.disable(index);
                } else {
                    this._slider.disable();
                    this.$root.setAttribute('disabled', 'true');
                }
            })
        },

        destroy() {
            if (this._slider) {
                this._slider.destroy()
                this._slider = null
            }
        },
    }
}

Alpine.data('sliderComponent', sliderComponent)
```

**CSS** (`resources/css/components/slider.css`):
```css
@layer base {
    @import 'nouislider/dist/nouislider.css';
}

@layer components {
    [data-slot='slider'] {
        @apply relative flex items-center justify-center h-3 rounded-box border-0 bg-transparent ring-1 ring-neutral-950/10 dark:ring-white/20;

        & .noUi-target,
        & .noUi-base {
            @apply relative border-none m-0 rounded-box overflow-visible;
        }

        & .noUi-connects {
            @apply rounded-box bg-neutral-950/5 dark:bg-white/5;
        }

        & .noUi-connect {
            @apply absolute left-0 top-0 h-full bg-[var(--color-primary)];
        }

        &[disabled='true'] .noUi-connect {
            @apply opacity-25;
        }

        & .noUi-handle {
            @apply absolute rounded-box border border-neutral-950/10 bg-neutral-100 dark:bg-neutral-700 shadow-none dark:border-[var(--color-primary)] backface-hidden hover:ring-4 hover:ring-[color-mix(in_oklab,var(--color-primary)_25%,var(--color-primary-fg)_60%)] focus:ring-4 focus:ring-[color-mix(in_oklab,_var(--color-primary)_25%,_var(--color-primary-fg)_60%)];

            &::before,
            &::after {
                @apply w-0.5 mx-[1px] bg-neutral-400;
            }
        }

        &[data-vertical='true'] .noUi-handle {
            &::before,
            &::after {
                @apply !h-0.5 !my-[1px] w-1/2 bg-neutral-400;
            }
        }

        &[data-variant='circle'] .noUi-handle {
            @apply !w-6 !h-6 rounded-full shadow-md;
            translate: -3px !important;

            &::before,
            &::after {
                @apply hidden;
            }
        }

        & .noUi-horizontal .noUi-handle {
            @apply left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform;
        }

        & .noUi-tooltip {
            @apply rounded-box mb-0.5 border-0 bg-white text-neutral-950 shadow-sm ring-1 ring-neutral-950/10 dark:bg-neutral-800 dark:text-white dark:ring-white/20;
        }

        & .noUi-pips {
            @apply mt-1;
        }

        & .noUi-pips .noUi-value {
            @apply mt-1 text-neutral-950 dark:text-white;
        }
    }
}
```

---

**Questions? Found a bug? Have a feature request?** 

Open an issue on GitHub or join the community Discord. Happy coding! 🚀