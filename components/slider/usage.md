---
name: 'slider'
---

# Slider Component

## Introduction

The `slider` component provides a powerful and intuitive way to select numeric values or ranges through an interactive draggable interface. Built on top of the robust [noUiSlider](https://refreshless.com/nouislider) library, it features support for single and multiple handles, tooltips, visual track fills, pips (value markers), custom formatting, non-linear scales, and full accessibility support. Perfect for price ranges, ratings, measurements, or any numeric input scenario.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `slider` component easily:

```bash
php artisan sheaf:install slider
```

then import the component javascripts:

```js
// app.js
import './components/slider.js'
```
then import the css:

```css
 /* app.css */
@import './components/slider.css';
```



## Basic Usage

@blade
<x-demo x-data="{ volume: [50] }">
    <x-ui.slider 
        x-model="volume"
        :step="1"
        :fill-track="[true, false]" 
    />
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="volume"
    :step="1"
    :fill-track="[true, false]" 
/>
```

### Bind To Livewire

To use with Livewire, simply use `wire:model` to bind your state:

```blade
<!-- this asume you have something like `public $volume = [50]` in your bounded livewire component  -->
<x-ui.slider 
    wire:model.live="volume"
/>
```

### Using it within Blade & Alpine

You can use it outside Livewire with just Alpine (with Blade):

```blade
<div class="w-full" x-data="{ volume: [50] }">
    <x-ui.slider 
        x-model="volume"
    />
</div>
```

Because we're making this possible using the `x-modelable` *like* but not explicitly API, you can't use `state` as a variable name because the component uses it internally.

## Visual Customization

### Handle Variants

Choose between different handle styles to match your design.

@blade
<x-demo>
    <div class="space-y-6" x-data="{ defaultV: [30], circle: [60] }">
        <div>
            <p class="text-sm font-medium mb-2">Default Handle</p>
            <x-ui.slider 
                x-model="defaultV"
                :step="1"
            />
        </div>
        <div>
            <p class="text-sm font-medium mb-2">Circle Handle</p>
            <x-ui.slider 
                x-model="circle"
                :step="1"
                handle-variant="circle"
            />
        </div>
    </div>
</x-demo>
@endblade

```blade
<!-- Default handle -->
<x-ui.slider 
    wire:model="volume"
    :step="1"
/>

<!-- Circle handle -->
<x-ui.slider 
    wire:model="volume"
    :step="1"
    handleVariant="circle"
/>
```

### Track Fills

Visually highlight portions of the track with color fills.

#### Single Handle Fill

@blade
<x-demo x-data="{ volume: [65] }">
    <x-ui.slider 
        x-model="volume"
        :fill-track="[true, false]"
    />
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="volume"
    :fill-track="[true, false]"
/>
```

#### Multiple Handle Fills

Control which segments between handles are filled by passing an array of boolean values.

@blade
<x-demo x-data="{ range: [25, 75] }">
    <x-ui.slider 
        x-model="range"
        :fill-track="[false, true, false]"
    />
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="range"
    :fill-track="[false, true, false]"
/>
```

## Tooltips

Display dynamic tooltips showing the current value of each handle.

### Basic Tooltips

@blade
<x-demo x-data="{ value: [45] }">
    <x-ui.slider 
        x-model="value"
        :step="1"
        tooltips
    />
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="value"
    :step="1"
    tooltips
/>
```

### Custom Tooltip Formatting

Use the `$slider.formatTooltipUsing()` method via `x-init` to customize tooltip display.

> you can use the `formatTooltipUsing()` without `$slider` but it's there for better DX and understandable code

@blade
<x-demo x-data="{ price: [49.99] }">
    <x-ui.slider 
        x-model="price"
        tooltips
        x-init="$slider.formatTooltipUsing((value) => '$' + value.toFixed(2))"
    />
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="price"
    tooltips
    x-init="$slider.formatTooltipUsing((value) => '$' + value.toFixed(2))"
/>
```

#### Time Format Example

@blade
<x-demo x-data="{ hour: [14.5] }">
    <x-ui.slider 
        x-model="hour"
        :max-value="24"
        :step="0.25"
        tooltips
        x-init="
            $slider.formatTooltipUsing((value) => {
                const h = Math.floor(value);
                const m = Math.round((value - h) * 60);
                return h.toString().padStart(2, '0') + ':' + m.toString().padStart(2, '0');
            });
        "
    />
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="meetingTime"
    :max-value="24"
    :step="0.25"
    tooltips
    x-init="
        $slider.formatTooltipUsing((value) => {
            const h = Math.floor(value);
            const m = Math.round((value - h) * 60);
            return h.toString().padStart(2, '0') + ':' + m.toString().padStart(2, '0');
        });
    "
/>
```

##### Calculating the step Value for a 24-Hour Slider

> When you want a slider to represent time in 24 hours, and you want each step to represent a fixed interval  (like 15 minutes, 30 minutes, etc.), you can calculate the step value in hours using this formula:
`step = interval in minutes / 60` example of 15 min per step : `s = 15 / 60 = 0.25`
	​


#### Percentage Format Example

@blade
<x-demo x-data="{ completion: [67] }">
    <x-ui.slider 
        x-model="completion"
        tooltips
        x-init="$slider.formatTooltipUsing((value) => value.toFixed() + '%')"
    />
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="completion"
    tooltips
    x-init="$slider.formatTooltipUsing((value) => value.toFixed() + '%')"
/>
```

## Range Configuration

### Setting Min/Max Values

Define the boundaries of your slider with custom minimum and maximum values.

@blade
<x-demo x-data="{ range: [40] }">
    <x-ui.slider 
        x-model="range"
        :min-value="20"
        :max-value="80"
        :fill-track="[true, false]"
        :step="1"
        tooltips
    />
    <!-- keep highlight -->
    <p class="mt-2 text-sm text-neutral-600">Value: <span x-text="range"></span></p>
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="temperature"
    :min-value="20"
    :max-value="80"
    :fill-track="[true, false]"
    :step="1"
    tooltips
/>
<p class="mt-2 text-sm text-neutral-600">Value: <span wire:text="range"></span></p>
```

### Step Size

Control the increment between selectable values using the `step` attribute.

@blade
<x-demo x-data="{ price: [50] }">
    <x-ui.slider 
        x-model="price"
        :fill-track="[true, false]"
        :step="10"
    />
    <p class="mt-2 text-sm text-neutral-600">Value: $<span x-text="price"></span></p>
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="price"
    :fill-track="[true, false]"
    :step="10"
/>
<p class="mt-2 text-sm text-neutral-600">Value: $<span wire:text="price"></span></p>
```

### Decimal Places

For precise control without step restrictions, specify the number of decimal places.

@blade
<x-demo x-data="{ measurement: [3.14] }">
    <x-ui.slider 
        x-model="measurement"
        :max-value="10"
        :decimalPlaces="2"
        :fill-track="[true, false]"
    />
    <p class="mt-2 text-sm text-neutral-600">Value: <span x-text="measurement"></span></p>
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="measurement"
    :max-value="10"
    :decimalPlaces="2"
    :fill-track="[true, false]"
    tooltips
/>
```

### Range Padding

Add behavioral padding to prevent values from reaching the absolute edges of the track.

@blade
<x-demo x-data="{ value: [30] }">
    <x-ui.slider 
        x-model="value"
        :fill-track="[true, false]"
        :step="1"
        :range-padding="10"
        tooltips
    />
    <p class="mt-2 text-sm text-neutral-600">Value: <span x-text="value"></span> (Range: 10-90)</p>
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="value"
    :fill-track="[true, false]"
    :step="1"
    :range-padding="10"
    tooltips
/>
<p class="mt-2 text-sm text-neutral-600">Value: <span wire:text="value"></span> (Range: 10-90)</p>

```

For asymmetric padding, pass an array with start and end values:

@blade
<x-demo x-data="{ value: [50] }">
    <x-ui.slider 
        x-model="value"
        :fill-track="[true, false]"
        :step="1"
        :range-padding="[10, 30]"
        tooltips
    />
    <p class="mt-2 text-sm text-neutral-600">Value: <span x-text="value[0]"></span> (Range: 10-70)</p>
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="value"
    :range-padding="[10, 30]"
    tooltips
/>
```

## Multiple Handles

Create range selectors with multiple draggable handles by providing an array of values.

@blade
<x-demo x-data="{ priceRange: [20, 75] }">
    <x-ui.slider 
        x-model="priceRange"
        :step="1"
        :fill-track="[false, true, false]"
    />
    <p class="mt-2 text-sm text-neutral-600">Range: $<span x-text="priceRange[0]"></span> - $<span x-text="priceRange[1]"></span></p>
</x-demo>
@endblade

```blade
 <!-- you may have $priceRange = [20, 75] -->
<x-ui.slider 
    wire:model="priceRange"
    :fill-track="[false, true, false]"
    tooltips
/>
<p class="mt-2 text-sm text-neutral-600">Range: $<span wire:text="priceRange[0]"></span> - $<span wire:text="priceRange[1]"></span></p>
```

### Handle Constraints

#### Minimum Distance Between Handles

Ensure handles maintain a minimum distance from each other.

@blade
<x-demo x-data="{ range: [30, 70] }">
    <x-ui.slider 
        x-model="range"
        :margin="10"
        :step="1"
        :fill-track="[false, true, false]"
        tooltips
    />
    <p class="mt-2 text-sm text-neutral-600">Range: <span x-text="range[0]"></span> - <span x-text="range[1]"></span> (Min gap: 10)</p>
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="range"
    :margin="10"
    :step="1"
    :fill-track="[false, true, false]"
    tooltips
/>
<p class="mt-2 text-sm text-neutral-600">Range: <span wire:text="range[0]"></span> - <span wire:text="range[1]"></span> (Min gap: 10)</p>
```

#### Maximum Distance Between Handles

Limit the maximum distance between handles using the `limit` attribute.

@blade
<x-demo x-data="{ range: [40, 60] }">
    <x-ui.slider 
        x-model="range"
        :limit="30"
        :step="1"
        :fill-track="[false, true, false]"
        tooltips
    />
    <p class="mt-2 text-sm text-neutral-600">Range: <span x-text="range[0]"></span> - <span x-text="range[1]"></span> (Max gap: 30)</p>
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="range"
    :limit="30"
    :step="1"
    :fill-track="[false, true, false]"
    tooltips
/>
<p class="mt-2 text-sm text-neutral-600">Range: <span wire:text="range[0]"></span> - <span wire:text="range[1]"></span> (Max gap: 30)</p>
```



## Pips (Value Markers)

Add visual markers along the track to help users identify specific values.

### Basic Pips

@blade
<x-demo x-data="{ value: [50] }">
    <x-ui.slider 
        x-model="value"
        :step="1"
        pips
    />
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="value"
    :step="1"
    pips
/>
```

### Pip Density

Control how frequently pips appear using the `pipsDensity` attribute. Higher values = fewer pips.

@blade
<x-demo x-data="{ value: [50] }">
    <div class="space-y-8 mb-20">
        <div>
            <p class="text-sm font-medium mb-2">Density: 5 (More pips)</p>
            <x-ui.slider 
                x-model="value"
                :pipsDensity="5"
                :step="1"
                tooltips
                pips
            />
        </div>
        <div>
            <p class="text-sm font-medium mb-2">Density: 20 (Fewer pips)</p>
            <x-ui.slider 
                x-model="value"
                :pipsDensity="20"
                tooltips
                :step="1"
                pips
            />
        </div>
    </div>
</x-demo>
@endblade

```blade
<!-- More frequent pips -->
<x-ui.slider 
    wire:model="value"
    :pipsDensity="5"
    tooltips
    :step="1"
    pips
/>

<!-- Less frequent pips -->
<x-ui.slider 
    wire:model="value"
    :pipsDensity="20"
    tooltips
    :step="1"
    pips
/>
```

### Pip Modes

#### Steps Mode

Display pips at every step interval.

@blade
<x-demo x-data="{ value: [50] }">
    <x-ui.slider 
        x-model="value"
        :step="12"
        :max-value="96"
        pips
        pipsMode="steps"
        :pipsDensity="1"
    />
</x-demo>
@endblade

```blade
<x-ui.slider 
    x-model="value"
    :step="12"
    :max-value="96"
    pips
    pipsMode="steps"
    :pipsDensity="1"
/>
```

#### Positions Mode

Place pips at specific percentage positions along the track.

@blade
<x-demo x-data="{ value: [50] }">
    <x-ui.slider 
        x-model="value"
        pips
        :step="25/3"
        pipsMode="positions"
        :pipsValues="[0, 25, 50, 75, 100]"
    />
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="value"
    pips
    :step="25/3"
    pipsMode="positions"
    :pipsValues="[0, 25, 50, 75, 100]"
/>
```

#### Count Mode

Display a specific number of evenly distributed pips.

@blade
<x-demo x-data="{ value: [50] }">
    <x-ui.slider 
        x-model="value"
        pips
        pipsMode="count"
        :pipsValues="5"
    />
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="value"
    pips
    pipsMode="count"
    :pipsValues="5"
/>
```
this is may intrduce large digits if the path length is divisible by the count so in this case the pip label formatter is required:

@blade
<x-demo x-data="{ value: [50] }">
    <x-ui.slider 
        x-model="value"
        pips
        pipsMode="count"
        :pipsValues="13"
        x-init="$slider.formatPipValueUsing((value) => value.toFixed(2))"
    />
</x-demo>
@endblade

```blade
<x-ui.slider 
    x-model="value"
    pips
    pipsMode="count"
    :pipsValues="13"
    x-init="$slider.formatPipValueUsing((value) => value.toFixed(2))"
/>
```

#### Values Mode

Place pips at exact slider values.

@blade
<x-demo x-data="{ value: [50] }">
    <x-ui.slider 
        x-model="value"
        pips
        pipsMode="values"
        :max-value="150"
        :pipsValues="[0, 20, 40, 60, 80, 100]"
    />
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="value"
    pips
    pipsMode="values"
    :max-value="150" <!-- to ilustrate that is value based not percentage-->
    :pipsValues="[0, 20, 40, 60, 80, 100]"
/>
```

### Custom Pip Label Formatting

Format pip labels using the `$slider.formatPipValueUsing()` method.

@blade
<x-demo x-data="{ price: [250] }">
    <x-ui.slider 
        x-model="price"
        :max-value="500"
        :step="50"
        pips
        pipsMode="steps"
        x-init="$slider.formatPipValueUsing((value) => '$' + value)"
    />
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="price"
    :max-value="500"
    :step="50"
    pips
    pipsMode="steps"
    x-init="$slider.formatPipValueUsing((value) => '$' + value)"
/>
```

### Custom Pip Filtering

Fine-tune which pips are displayed and their size using `filterPipsUsing()`. Return values:
- `1` = Large pip with label
- `2` = Small pip without label
- `0` = Pip without label
- `-1` = Hidden

@blade
<x-demo x-data="{ value: [250] }">
    <x-ui.slider 
        x-model="value"
        pipsMode="steps"
        :max-value="500"
        :pipsDensity="1"
        tooltips
        :step="5"
        pips
        x-init="
            $slider.formatTooltipUsing((value) => '$' + value.toFixed(0));
            $slider.formatPipValueUsing((value) => '$' + value);
            $slider.filterPipsUsing((value, type) => {
                if (value < 50) return -1;
                if (value % 100 === 0) return 1;
                if (value % 50 === 0) return 2;
                return 0;
            });
        "
    />
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="budget"
    pipsMode="steps"
    :max-value="500"
    :pipsDensity="1"
    :step="5"
    tooltips
    pips
    x-init="
        $slider.formatTooltipUsing((value) => '$' + value.toFixed(0));
        $slider.formatPipValueUsing((value) => '$' + value);
        $slider.filterPipsUsing((value, type) => {
            if (value < 50) return -1;        // Hide below $50
            if (value % 100 === 0) return 1;  // Large pip every $100
            if (value % 50 === 0) return 2;   // Small pip every $50
            return 0;                          // Hide others
        });
    "
/>
```

### Stepped Pips

For non-linear sliders, ensure pip labels only appear at selectable stepped positions.

@blade
<x-demo x-data="{ value: [50] }">
    <x-ui.slider 
        :nonLinearPoints="['20%' => 50, '50%' => 75]"
        :arePipsStepped="true"
        x-model="value"
        pips
    />
</x-demo>
@endblade

```blade
<x-ui.slider 
    :nonLinearPoints="['20%' => 50, '50%' => 75]"
    :arePipsStepped="true"
    wire:model="value"
    pips
/>
```

## Orientation & Direction

### Vertical Sliders

Display the slider vertically instead of horizontally.

@blade
<x-demo x-data="{ volume: [70] }">
    <div class="flex justify-center h-64">
        <x-ui.slider 
            :fill-track="[true, false]"
            x-model="volume"
            :step="1"
            vertical
            tooltips
        />
    </div>
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="volume"
    :fill-track="[true, false]"
    tooltips
    vertical
    :step="1"
/>
```

### Top-to-Bottom Orientation

Reverse the direction of a vertical slider so minimum is at the top.

@blade
<x-demo x-data="{ value: [30] }">
    <div class="flex justify-center h-64">
        <x-ui.slider 
            x-model="value"
            :fill-track="[true, false]"
            top-to-bottom
            :step="1"
            vertical
            tooltips
        />
    </div>
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="temperature"
    top-to-bottom
    :step="1"
    vertical
    tooltips
/>
```

### Right-to-Left

Force the slider to operate right-to-left (useful for RTL languages).

@blade
<x-demo x-data="{ value: [40] }">
    <x-ui.slider 
        x-model="value"
        :fill-track="[true, false]"
        tooltips
        :step="1"
        rtl
    />
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="value"
    :step="1"
    tooltips
    rtl
/>
```

### Circle Variant

@blade
<x-demo x-data="{ value: [30] }">
    <div class="flex justify-center h-64">
        <x-ui.slider 
            x-model="value"
            :fill-track="[true, false]"
            top-to-bottom
            handle-variant="circle"
            :step="1"
            vertical
            tooltips
        />
    </div>
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="temperature"
    handle-variant="circle"
    top-to-bottom
    :step="1"
    vertical
    tooltips
/>
```
## Advanced Features

### Non-Linear Tracks

Create sliders where certain portions of the track represent different value ranges.

> This was buggy in the original library because the slider can return strings or decimals even specifying the step to int. We need to manually fix it to integers.
@blade
<x-demo x-data="{ value: [50] }">
    <x-ui.slider 
        x-model="value"
        :nonLinearPoints="['30%' => 50, '70%' => 80]"
        x-init="$slider.formatTooltipUsing((val)=>val.toFixed())"
        :step="1"
        pips
        tooltips
    />
    <p class="mt-6 text-sm text-neutral-600">Value (buggy): <span x-text="value"></span></p>
    <p class="mt-2 text-sm text-neutral-600">Value (manually): <span x-text="Number(value).toFixed()"></span></p>
</x-demo>
@endblade

```blade
 <x-ui.slider 
    wire:model="value"
    :nonLinearPoints="['30%' => 50, '70%' => 80]"
    x-init="$slider.formatTooltipUsing((val)=>val.toFixed())"
    :step="1"
    pips
    tooltips
/>
<p class="mt-6 text-sm text-neutral-600">Value (buggy): <span wire:text="value"></span></p>
<p class="mt-2 text-sm text-neutral-600">Value (manually): <span wire:text="Number(value).toFixed()"></span></p>
```

In this example:
- `0-30%` of the track represents values 0-50
- `30-70%` of the track represents values 50-80
- `70-100%` of the track represents values 80-100

### Behavior Customization

Control how users interact with the slider using the `behavior` attribute. Available options:
- `tap` - Click anywhere on the track to move the handle (default)
- `drag` - Allow dragging the filled portion between handles
- `drag-fixed` - Drag both handles together maintaining their distance
- `none` - Disable click-to-move behavior

@blade
<x-demo x-data="{ range: [30, 70] }">
    <x-ui.slider 
        x-model="range"
        :fill-track="[false, true, false]"
        behavior="drag"
        tooltips
        :step="1"
    />
    <p class="mt-2 text-sm text-neutral-600">Try dragging the filled area between handles</p>
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="range"
    behavior="drag"
    :step="1"
    :fill-track="[false, true, false]"
/>
```

### Disabled State

Disable user interaction with the slider.

@blade
<x-demo x-data="{ value: [12] }">
    <x-ui.slider 
        x-model="value"
        x-init="$slider.disable()"
        :fill-track="[true, false]"
    />
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="value"
    x-init="$slider.disable()"
    disabled
/>
```

> you may pass the slider index (starting from `0`) to the disable function for disabling specific hanle (eg `$slider.disable(1)`): 

## Real-World Examples

### Price Range Filter

@blade
<x-demo x-data="{ priceRange: [100, 750] }">
    <div>
        <h3 class="text-lg font-semibold mb-4">Filter Products by Price</h3>
        <x-ui.slider 
            x-model="priceRange"
            :max-value="1000"
            :step="10"
            pips
            pipsMode="steps"
            :pipsDensity="2"
            tooltips
            :fill-track="[false, true, false]"
            handleVariant="circle"
            x-init="
                formatTooltipUsing((value) => '$' + value);
                formatPipValueUsing((value) => '$' + value);
                filterPipsUsing((value, type) => {
                    if (value % 250 === 0) return 1;
                    if (value % 100 === 0) return 2;
                    return 0;
                });
            "
        />
        <div class="mt-4 text-center">
            <span class="text-neutral-700">Showing products from 
                <strong class="text-neutral-950 dark:text-white">$<span  x-text="priceRange[0]"></span></strong> to 
                <strong class="text-neutral-950 dark:text-white">$<span  x-text="priceRange[1]"></span></strong>
            </span>
        </div>
    </div>
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="priceRange"
    :max-value="1000"
    :step="10"
    pips
    pipsMode="steps"
    :pipsDensity="2"
    tooltips
    :fill-track="[false, true, false]"
    handleVariant="circle"
    x-init="
        formatTooltipUsing((value) => '$' + value);
        formatPipValueUsing((value) => '$' + value);
        filterPipsUsing((value, type) => {
            if (value % 250 === 0) return 1;
            if (value % 100 === 0) return 2;
            return 0;
        });
    "
/>
 <div class="mt-4 text-center">
    <span class="text-neutral-700">Showing products from 
        <strong class="text-neutral-950 dark:text-white">$<span  wire:text="priceRange[0]"></span></strong> to 
        <strong class="text-neutral-950 dark:text-white">$<span  wire:text="priceRange[1]"></span></strong>
    </span>
</div>
```

### Volume Control

@blade
<x-demo>
     <div x-data="{ volume: [75] }" class="flex justify-center items-end gap-4 ">
        <svg class="w-5 h-5 text-neutral-600 mb-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828 1 1 0 010-1.415z" clip-rule="evenodd" />
        </svg>
        <x-ui.slider 
            x-model="volume"
            tooltips
            :step="1"
            :fill-track="[true, false]"
            class="flex-1"
            x-init="$slider.formatTooltipUsing((value) => value + '%')"
        />
        <span class="text-sm text-neutral-600 min-w-[3rem] ml-3 mb-4" x-text="volume + '%'"></span>
    </div>
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="volume"
    tooltips
    :fill-track="[true, false]"
    x-init="$slider.formatTooltipUsing((value) => value + '%')"
/>
```

### Meeting Time Scheduler

@blade
<x-demo x-data="{ meetingTime: [9, 17] }">
    <div>
        <h3 class="text-lg font-semibold mb-4">Select Meeting Hours</h3>
        <x-ui.slider 
            x-model="meetingTime"
            :max-value="23"
            :step="1"
            pips
            pipsMode="steps"
            :pipsDensity="3"
            tooltips
            :fill-track="[false, true, false]"
            handleVariant="circle"
            x-init="
                $slider.formatTooltipUsing((value) => {
                    const hour = value === 0 ? 12 : (value > 12 ? value - 12 : value);
                    const period = value < 12 ? 'AM' : 'PM';
                    return hour.toFixed() + ':00 ' + period;
                });
                $slider.formatPipValueUsing((value) => {
                    if (value === 0) return '12AM';
                    if (value === 12) return '12PM';
                    const hour = value > 12 ? value - 12 : value;
                    const period = value < 12 ? 'AM' : 'PM';
                    return hour.toFixed() + period;
                });
                $slider.filterPipsUsing((value, type) => {
                    if (value === 0 || value === 12) return 1;
                    if (value % 6 === 0) return 2;
                    return 0;
                });
            "
        />
        <div class="mt-4 text-center">
            <span class="text-neutral-700">Meeting available from 
                <strong x-text="
                    (() => {
                        const h = meetingTime[0] === 0 ? 12 : (meetingTime[0] > 12 ? meetingTime[0] - 12 : meetingTime[0]);
                        const p = meetingTime[0] < 12 ? 'AM' : 'PM';
                        return h.toFixed() + ':00 ' + p;
                    })()
                "></strong> to 
                <strong x-text="
                    (() => {
                        const h = meetingTime[1] === 0 ? 12 : (meetingTime[1] > 12 ? meetingTime[1] - 12 : meetingTime[1]);
                        const p = meetingTime[1] < 12 ? 'AM' : 'PM';
                        return h.toFixed() + ':00 ' + p;
                    })()
                "></strong>
            </span>
        </div>
    </div>
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="meetingTime"
    :max-value="23"
    :step="1"
    pips
    pipsMode="steps"
    :pipsDensity="3"
    tooltips
    :fill-track="[false, true, false]"
    x-init="
        formatTooltipUsing((value) => {
            const hour = value === 0 ? 12 : (value > 12 ? value - 12 : value);
            const period = value < 12 ? 'AM' : 'PM';
            return hour + ':00 ' + period;
        });
        formatPipValueUsing((value) => {
            if (value === 0) return '12AM';
            if (value === 12) return '12PM';
            const hour = value > 12 ? value - 12 : value;
            const period = value < 12 ? 'AM' : 'PM';
            return hour + period;
        });
        filterPipsUsing((value, type) => {
            if (value === 0 || value === 12) return 1;
            if (value % 6 === 0) return 2;
            return 0;
        });
    "
/>
```

### Star Rating Selector

@blade
<x-demo x-data="{ rating: [3.5] }">
    <div>
        <h3 class="text-lg font-semibold mb-4">Rate Your Experience</h3>
        <x-ui.slider 
            x-model="rating"
            :max-value="5"
            :step="0.5"
            pips
            pipsMode="steps"
            :pipsDensity="2"
            tooltips
            :fill-track="[true, false]"
            handleVariant="circle"
            x-init="
                formatTooltipUsing((value) => '⭐'.repeat(Math.floor(value)) + (value % 1 ? '½' : ''));
                formatPipValueUsing((value) => value % 1 === 0 ? '⭐ ' + value : '');
                filterPipsUsing((value, type) => {
                    return value % 1 === 0 ? 1 : 0;
                });
            "
        />
        <div class="mt-4 text-center">
            <div class="text-3xl" x-text="'⭐'.repeat(Math.floor(rating)) + (rating % 1 ? '½' : '')"></div>
            <div class="text-neutral-600 mt-2" x-text="rating + ' out of 5 stars'"></div>
        </div>
    </div>
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="rating"
    :max-value="5"
    :step="0.5"
    pips
    pipsMode="steps"
    :pipsDensity="2"
    tooltips
    :fill-track="[true, false]"
    x-init="
        formatTooltipUsing((value) => '⭐'.repeat(Math.floor(value)) + (value % 1 ? '½' : ''));
        formatPipValueUsing((value) => value % 1 === 0 ? '⭐ ' + value : '');
        filterPipsUsing((value, type) => {
            return value % 1 === 0 ? 1 : 0;
        });
    "
/>
```

### Temperature Range Control

@blade
<x-demo x-data="{ temperature: [68] }">
    <div>
        <h3 class="text-lg font-semibold mb-4">Thermostat Control</h3>
        <x-ui.slider 
            x-model="temperature"
            :min-value="50"
            :max-value="85"
            :step="1"
            pips
            pipsMode="steps"
            :pipsDensity="5"
            tooltips
            :fill-track="[true, false]"
            handleVariant="circle"
            x-init="
                formatTooltipUsing((value) => value + '°F');
                formatPipValueUsing((value) => value + '°');
                filterPipsUsing((value, type) => {
                    if (value % 10 === 0) return 1;
                    if (value % 5 === 0) return 2;
                    return 0;
                });
            "
        />
        <div class="mt-4 text-center">
            <span class="text-2xl font-bold" x-text="temperature + '°F'"></span>
            <div class="text-sm text-neutral-600 mt-1">
                <span x-show="temperature < 65">❄️ Cool</span>
                <span x-show="temperature >= 65 && temperature < 72">😊 Comfortable</span>
                <span x-show="temperature >= 72">🔥 Warm</span>
            </div>
        </div>
    </div>
</x-demo>
@endblade

```blade
<x-ui.slider 
    wire:model="temperature"
    :min-value="50"
    :max-value="85"
    :step="1"
    pips
    pipsMode="steps"
    :pipsDensity="5"
    tooltips
    :fill-track="[true, false]"
    x-init="
        formatTooltipUsing((value) => value + '°F');
        formatPipValueUsing((value) => value + '°');
        filterPipsUsing((value, type) => {
            if (value % 10 === 0) return 1;
            if (value % 5 === 0) return 2;
            return 0;
        });
    "
/>
 <div class="mt-4 text-center">
    <span class="text-2xl font-bold" x-text="temperature + '°F'"></span>
    <div class="text-sm text-neutral-600 mt-1">
        <span x-show="temperature < 65">❄️ Cool</span>
        <span x-show="temperature >= 65 && temperature < 72">😊 Comfortable</span>
        <span x-show="temperature >= 72">🔥 Warm</span>
    </div>
</div>
```

### Budget Allocation

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

```blade
<x-ui.slider 
    wire:model="departmentBudgets"
    :max-value="10000"
    :step="100"
    pips
    pipsMode="steps"
    :pipsDensity="10"
    tooltips
    :fill-track="[true, true, true, false]"
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
```

## Component Props

| Prop Name                | Type           | Default     | Description                                                |
| ------------------------ | -------------- | ----------- | ---------------------------------------------------------- |
| `wire:model` / `x-model` | string         | -           | Bind to Livewire or Alpine state                           |
| `name`                   | string         | -           | Input name attribute                                       |
| `min-value`              | integer        | `0`         | Minimum value of the slider                                |
| `max-value`              | integer        | `100`       | Maximum value of the slider                                |
| `step`                   | integer\|null  | `null`      | Step increment (null = any decimal)                        |
| `decimal-places`         | integer\|null  | `null`      | Number of decimal places to round to                       |
| `range-padding`          | integer\|array | `null`      | Behavioral padding at track edges                          |
| `vertical`               | boolean        | `false`     | Display slider vertically                                  |
| `top-to-bottom`          | boolean        | `false`     | Reverse vertical slider direction                          |
| `rtl`                    | boolean        | `null`      | Force right-to-left direction                              |
| `fill-track`             | array\|boolean | `null`      | Which track segments to fill with color                    |
| `tooltips`               | boolean        | `false`     | Show tooltips on handles                                   |
| `handle-variant`         | string         | `'default'` | Handle style: `default`, `circle`                          |
| `pips`                   | boolean        | `false`     | Enable pips (value markers)                                |
| `pips-mode`              | string\|null   | `null`      | Pip mode: `range`, `steps`, `positions`, `count`, `values` |
| `pips-density`           | integer        | `10`        | Pip frequency (higher = fewer pips)                        |
| `pips-values`            | array\|integer | `null`      | Values/positions for pips (mode-dependent)                 |
| `are-pips-stepped`       | boolean        | `false`     | Round pips to steps (non-linear sliders)                   |
| `margin`                 | integer\|null  | `null`      | Minimum distance between handles                           |
| `limit`                  | integer\|null  | `null`      | Maximum distance between handles                           |
| `behavior`               | string         | `'tap'`     | Interaction behavior: `tap`, `drag`, `drag-fixed`, `none`  |
| `non-linear-points`      | array\|null    | `null`      | Define non-linear track sections                           |
| `disabled`               | boolean        | `false`     | Disable user interaction                                   |
| `class`                  | string         | `''`        | Additional CSS classes                                     |

## JavaScript Callbacks

These methods are available via `x-init` to customize the slider's display:

### `formatTooltipUsing(callback)`

Customize how tooltip values are displayed.

```blade
x-init="$slider.formatTooltipUsing((value) => ' + value.toFixed(2))"
```

**Parameters:**
- `value` (number) - The current handle value

**Returns:** Formatted string to display in tooltip

---

### `formatPipValueUsing(callback)`

Customize how pip labels are displayed.

```blade
x-init="formatPipValueUsing((value) => value + '%')"
```

**Parameters:**
- `value` (number) - The pip value

**Returns:** Formatted string to display as pip label

---

### `filterPipsUsing(callback)`

Control which pips are displayed and their size.

```blade
x-init="filterPipsUsing((value, type) => {
    if (value % 50 === 0) return 1;  // Large pip
    if (value % 10 === 0) return 2;  // Small pip
    return 0;                         // No label
})"
```

**Parameters:**
- `value` (number) - The pip value
- `type` (integer) - The pip type from noUiSlider (0, 1, or 2)

**Returns:**
- `1` - Display large pip with label
- `2` - Display small pip without label
- `0` - Display pip without label
- `-1` - Hide pip completely

---

### Combining Multiple Callbacks

You can chain multiple callbacks in `x-init`:

```blade
x-init="
    formatTooltipUsing((value) => ' + value.toFixed(2));
    formatPipValueUsing((value) => ' + value);
    filterPipsUsing((value, type) => {
        if (value % 100 === 0) return 1;
        if (value % 25 === 0) return 2;
        return 0;
    });
"
```

## Accessibility

The slider component is built with accessibility in mind:

- Keyboard navigation support (arrow keys to adjust values)
- ARIA labels for screen readers
- Proper focus management
- Semantic HTML structure
- High contrast mode compatible

## Browser Support

The slider component works in all modern browsers that support:
- ES6 JavaScript
- CSS Grid and Flexbox
- Alpine.js v3.x
- Livewire v3.x (for Livewire integration)

## Tips & Best Practices

### When to Use Steps vs Decimal Places

- Use `step` when you want discrete, predictable intervals (e.g., $10, $20, $30)
- Use `decimal-places` when you want smooth movement with controlled precision (e.g., 3.142, 5.678)

### Optimizing Pip Display

For sliders with large ranges, use pip filtering to avoid clutter:

```blade
<x-ui.slider 
    :max-value="1000"
    pips
    x-init="
        filterPipsUsing((value, type) => {
            if (value % 250 === 0) return 1;  // Major markers
            if (value % 50 === 0) return 2;   // Minor markers
            return -1;                         // Hide the rest
        });
    "
/>
```

### Multiple Handles Best Practices

- Always define `fill-track` with multiple handles for better UX
- Use `margin` to prevent handles from overlapping
- Use `limit` to enforce business rules (e.g., max budget range)
- Provide clear labels/tooltips to distinguish handle purposes

### Performance Considerations

- Avoid overly dense pips (use `pipsDensity` wisely)
- Keep tooltip formatting functions simple and fast
- Use `wire:model.live` sparingly if you don't need real-time updates