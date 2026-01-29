---
name: 'progress'
---

## Introduction

The **Progress** component provides a flexible and accessible way to display progress indicators, loading states, and completion tracking. It supports both determinate (known progress) and indeterminate (unknown duration) states, buffer visualization for streaming content, and extensive customization options. Perfect for file uploads, form completion, video buffering, data processing, and any scenario requiring progress visualization.

## Installation

Use the Sheaf artisan command to install the progress component:

```bash
php artisan sheaf:install progress
```

> Once installed, you can use `<x-ui.progress />` in any Blade view.

## Basic Usage

@blade
<x-demo>
    <div class="space-y-6">
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">25% Progress</x-ui.text>
            <x-ui.progress value="25" />
        </div>
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">50% Progress</x-ui.text>
            <x-ui.progress value="50" />
        </div>
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">75% Progress</x-ui.text>
            <x-ui.progress value="75" />
        </div>
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">100% Complete</x-ui.text>
            <x-ui.progress value="100" />
        </div>
    </div>
</x-demo>
@endblade

```blade
<!-- Static progress values -->
<div class="space-y-2">
    <x-ui.text size="sm" class="font-medium">25% Progress</x-ui.text>
    <x-ui.progress value="25" />
</div>
<x-ui.progress value="50" />
<x-ui.progress value="75" />
<x-ui.progress value="100" />
```

## Size Variants

The progress bar comes in five sizes, from extra small to extra large. Control the height using the `size` prop:

@blade
<x-demo>
    <div class="space-y-6">
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">Extra Small (xs)</x-ui.text>
            <x-ui.progress value="65" size="xs" />
        </div>
        <!--  -->
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">Small (sm)</x-ui.text>
            <x-ui.progress value="65" size="sm" />
        </div>
        <!--  -->
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">Medium (md) - Default</x-ui.text>
            <x-ui.progress value="65" size="md" />
        </div>
        <!--  -->
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">Large (lg)</x-ui.text>
            <x-ui.progress value="65" size="lg" />
        </div>
        <!--  -->
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">Extra Large (xl)</x-ui.text>
            <x-ui.progress value="65" size="xl" />
        </div>
    </div>
</x-demo>
@endblade

```blade
<x-ui.progress value="65" size="xs" />
<x-ui.progress value="65" size="sm" />
<x-ui.progress value="65" size="md" />
<x-ui.progress value="65" size="lg" />
<x-ui.progress value="65" size="xl" />
```

## Livewire Integration

Bind the progress component to Livewire state using `wire:model.live` for real-time updates:

@blade
<x-demo>
    <div>
        <div class="space-y-4" x-data="{ progress: 45}">
            <div class="space-y-2" >
                <x-ui.text size="sm" class="font-medium">
                    Upload Progress: <span x-text="progress"></span>%
                </x-ui.text>
                <x-ui.progress x-model="progress" class="[&_[data-slot=bar]]:bg-rose-500"/>
            </div>
            
            <div class="flex gap-2">
                <x-ui.button size="sm" variant="outline" x-on:click="progress = 0">
                    Reset Upload
                </x-ui.button>
                <x-ui.button size="sm" variant="outline" x-on:click="progress = 100">
                    Simulate Upload
                </x-ui.button>
            </div>
        </div>
    </div>
</x-demo>
@endblade

```blade
<div>
    <x-ui.text>Upload Progress: {{ $uploadProgress }}%</x-ui.text>
    <x-ui.progress wire:model.live="uploadProgress" />
    
    <x-ui.button wire:click="simulateUpload">
        Start Upload
    </x-ui.button>
</div>
```

## Alpine.js Integration

Use `x-model` for client-side reactive progress updates. This works great for pure frontend interactions or in combination with Livewire:

@blade
<x-demo>
    <div x-data="{ progress: 50 }">
        <div class="space-y-4">
            <div class="space-y-2">
                <x-ui.text size="sm" class="font-medium">
                    Alpine Progress: <span x-text="progress"></span>%
                </x-ui.text>
                <x-ui.progress x-model="progress" />
            </div>
            <!--  -->
            <div class="flex gap-2">
                <x-ui.button x-on:click="progress = Math.min(progress + 10, 100)" size="sm">
                    +10%
                </x-ui.button>
                <x-ui.button x-on:click="progress = Math.max(progress - 10, 0)" size="sm" variant="outline">
                    -10%
                </x-ui.button>
            </div>
            <!--  -->
            <input 
                type="range" 
                x-model="progress" 
                min="0" 
                max="100" 
                class="w-full"
            />
        </div>
    </div>
</x-demo>
@endblade

```blade
<div x-data="{ progress: 50 }">

    <x-ui.progress x-model="progress" />

    <x-ui.button x-on:click="progress = Math.min(progress + 10, 100)" size="sm">
        +10%
    </x-ui.button>
    <x-ui.button x-on:click="progress = Math.max(progress - 10, 0)" size="sm" variant="outline">
        -10%
    </x-ui.button>    
    <input type="range" x-model="progress" min="0" max="100" />
</div>
```

## Customizing Bar Color

To use a different color from your theme's primary color, use the `[&_[data-slot=bar]]` selector with any Tailwind color:

@blade
<x-demo>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-white dark:bg-neutral-900 rounded-lg border border-neutral-200 dark:border-neutral-800">
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">Primary (default)</x-ui.text>
            <x-ui.progress value="70" />
        </div>
        <!--  -->
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">Red</x-ui.text>
            <x-ui.progress value="70" class="[&_[data-slot=bar]]:bg-red-500" />
        </div>
        <!--  -->
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">Amber</x-ui.text>
            <x-ui.progress value="70" class="[&_[data-slot=bar]]:bg-amber-500" />
        </div>
        <!--  -->
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">Orange</x-ui.text>
            <x-ui.progress value="70" class="[&_[data-slot=bar]]:bg-orange-500" />
        </div>
        <!--  -->
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">Teal</x-ui.text>
            <x-ui.progress value="70" class="[&_[data-slot=bar]]:bg-teal-500" />
        </div>
        <!--  -->
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">Rose</x-ui.text>
            <x-ui.progress value="70" class="[&_[data-slot=bar]]:bg-rose-500" />
        </div>
        <!--  -->
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">Blue</x-ui.text>
            <x-ui.progress value="70" class="[&_[data-slot=bar]]:bg-blue-500" />
        </div>
        <!--  -->
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">Fuchsia</x-ui.text>
            <x-ui.progress value="70" class="[&_[data-slot=bar]]:bg-fuchsia-500" />
        </div>
    </div>
</x-demo>
@endblade

```blade
<!-- Red -->
<x-ui.progress value="70" class="[&_[data-slot=bar]]:bg-red-500" />

<!-- Amber -->
<x-ui.progress value="70" class="[&_[data-slot=bar]]:bg-amber-500" />
```

## Animated Progress

Simulate smooth progress updates using JavaScript's `requestAnimationFrame()` function for frame-perfect animations:

@blade
<x-demo>
    <div 
        x-data="{
            value: 0,
            animate() {
                const duration = 4000;
                const delay = 1000;
                const startTime = performance.now();
                <!--  -->
                const updateProgress = (currentTime) => {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    <!--  -->
                    this.value = progress * 100;
                    <!--  -->
                    if (progress < 1) {
                        requestAnimationFrame(updateProgress);
                    } else {
                        setTimeout(() => {
                            this.value = 0;
                            this.animate();
                        }, delay);
                    }
                };
                <!--  -->
                requestAnimationFrame(updateProgress);
            }
        }" 
        x-init="animate()"
    >
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">
                <span x-text="Math.floor(value)" class="pr-2"></span>
                <span>% Progress</span>
            </x-ui.text>
            <x-ui.progress class="[&_[data-slot=bar]]:bg-amber-500" x-model="value" />
        </div>
    </div>
</x-demo>
@endblade

```blade
<div 
    x-data="{
        value: 0,
        animate() {
            const duration = 4000;
            const startTime = performance.now();
            
            const updateProgress = (currentTime) => {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                
                this.value = progress * 100;
                
                if (progress < 1) {
                    requestAnimationFrame(updateProgress);
                } else {
                    setTimeout(() => {
                        this.value = 0;
                        this.animate();
                    }, 1000);
                }
            };
            
            requestAnimationFrame(updateProgress);
        }
    }" 
    x-init="animate()"
>
    <x-ui.progress class="[&_[data-slot=bar]]:bg-amber-500" x-model="value" />
</div>
```

## Wave Animation

Add a shimmer wave effect to provide visual feedback during slow or long-running progress updates:

@blade
<x-demo>
    <div class="space-y-6">
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">Progress with Wave</x-ui.text>
            <x-ui.progress 
                value="35" 
                class="[&_[data-slot=bar]]:bg-orange-500"
                wave 
            />
        </div>
        
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">Slow Download Simulation</x-ui.text>
            <x-ui.progress class="[&_[data-slot=bar]]:bg-green-500" value="15" wave size="lg" />
        </div>
    </div>
</x-demo>
@endblade

```blade
<!-- Wave animation provides visual feedback on slow progress -->
<x-ui.progress class="[&_[data-slot=bar]]:bg-orange-500" value="35" wave />
<x-ui.progress class="[&_[data-slot=bar]]:bg-green-500" value="15" wave size="lg" />
```

> **Note:** The wave animation uses a white gradient overlay, so it may not be visible on light backgrounds or when using light colors like the default white primary color.

## Top and Bottom Slots

Add custom content above or below the progress bar using named slots:

@blade
<x-demo>
    <div class="space-y-6">
        <x-ui.progress value="65">
            <x-slot:top>
                <div class="flex items-center justify-between mb-2">
                    <x-ui.text size="sm" class="font-medium">Uploading files...</x-ui.text>
                    <x-ui.text size="sm" class="opacity-60">65%</x-ui.text>
                </div>
            </x-slot:top>
        </x-ui.progress>
        
        <x-ui.progress value="45">
            <x-slot:top>
                <div class="flex items-center justify-between mb-2">
                    <x-ui.text size="sm" class="font-medium">Processing data</x-ui.text>
                    <x-ui.text size="sm" class="opacity-60">45%</x-ui.text>
                </div>
            </x-slot:top>
            <x-slot:bottom>
                <div class="flex items-center justify-between mt-2">
                    <x-ui.text size="xs" class="opacity-50">2.4 MB of 5.3 MB</x-ui.text>
                    <x-ui.text size="xs" class="opacity-50">~2 min remaining</x-ui.text>
                </div>
            </x-slot:bottom>
        </x-ui.progress>
    </div>
</x-demo>
@endblade

```blade
<x-ui.progress value="65">
    <x-slot:top>
        <div class="flex justify-between mb-2">
            <x-ui.text>Uploading files...</x-ui.text>
            <x-ui.text>65%</x-ui.text>
        </div>
    </x-slot:top>
    
    <x-slot:bottom>
        <div class="flex justify-between mt-2">
            <x-ui.text size="xs">2.4 MB of 5.3 MB</x-ui.text>
            <x-ui.text size="xs">~2 min remaining</x-ui.text>
        </div>
    </x-slot:bottom>
</x-ui.progress>
```

## Advanced Features

The progress component supports compound state objects for advanced use cases like video buffering and indeterminate loading.

### Understanding State Formats

The progress component accepts state in three different formats:

**1. Simple Integer (Basic Progress)**
```php
public $progress = 50;  // Just a number
```

**2. Compound Object (Advanced Features)**
```php
// Value + Buffer (for streaming content)
public $progress = ['value' => 50, 'buffer' => 75];

// Value + Indeterminate (for unknown duration tasks)
public $progress = ['value' => 0, 'indeterminate' => true];

// All properties combined
public $progress = [
    'value' => 50,
    'buffer' => 75,
    'indeterminate' => false
];
```

**State Rules:**
- `buffer` automatically adjusts to never be less than `value`
- When `indeterminate: true`, the bar displays an animated loading state regardless of value
- All values are automatically clamped between `min` and `max`

### Dynamic Color Transitions

Create progress bars that smoothly transition colors based on completion percentage:

@blade
<x-demo>
    <div 
        x-data="{
            value: 0,
            currentColor: 'rgb(239, 68, 68)',
            animate() {
                const duration = 6000;
                const delay = 1000;
                const startTime = performance.now();
                const updateProgress = (currentTime) => {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    this.value = progress * 100;
                    this.currentColor = this.getProgressColor();
                    if (progress < 1) {
                        requestAnimationFrame(updateProgress);
                    } else {
                        setTimeout(() => {
                            this.value = 0;
                            this.currentColor = this.getProgressColor();
                            this.animate();
                        }, delay);
                    }
                };
                requestAnimationFrame(updateProgress);
            },
            getProgressColor() {
                const percent = this.value;
                let r, g, b;
                if (percent < 25) {
                    // Red to Orange (0-25%)
                    const ratio = percent / 25;
                    r = 239;
                    g = Math.floor(68 + (147 * ratio));
                    b = 68;
                } else if (percent < 50) {
                    // Orange to Yellow (25-50%)
                    const ratio = (percent - 25) / 25;
                    r = Math.floor(239 + (15 * ratio));
                    g = Math.floor(215 + (25 * ratio));
                    b = Math.floor(68 - (54 * ratio));
                } else if (percent < 75) {
                    // Yellow to Lime (50-75%)
                    const ratio = (percent - 50) / 25;
                    r = Math.floor(254 - (122 * ratio));
                    g = Math.floor(240 - (24 * ratio));
                    b = Math.floor(14 + (8 * ratio));
                } else {
                    // Lime to Green (75-100%)
                    const ratio = (percent - 75) / 25;
                    r = Math.floor(132 - (10 * ratio));
                    g = Math.floor(216 + (28 * ratio));
                    b = Math.floor(22 + (43 * ratio));
                }
                return `rgb(${r}, ${g}, ${b})`;
            }
        }" 
        x-init="animate()"
    >
        <div class="space-y-2">
            <x-ui.text  class="font-medium flex">
                <span x-text="Math.floor(value)" class="min-w-5"></span>% <span class="ml-auto">Color transitions from Red → Orange → Yellow → Green</span>
            </x-ui.text>
            <x-ui.progress 
                wave
                x-model="value"
                x-bind:style="`--color-primary: ${currentColor}`"
            />
        </div>
    </div>
</x-demo>
@endblade

```blade
<div 
    x-data="{
        value: 0,
        currentColor: 'rgb(239, 68, 68)',
        getProgressColor() {
            const percent = this.value;
            let r, g, b;
            
            if (percent < 25) {
                const ratio = percent / 25;
                r = 239;
                g = Math.floor(68 + (147 * ratio));
                b = 68;
            } else if (percent < 50) {
                const ratio = (percent - 25) / 25;
                r = Math.floor(239 + (15 * ratio));
                g = Math.floor(215 + (25 * ratio));
                b = Math.floor(68 - (54 * ratio));
            } else if (percent < 75) {
                const ratio = (percent - 50) / 25;
                r = Math.floor(254 - (122 * ratio));
                g = Math.floor(240 - (24 * ratio));
                b = Math.floor(14 + (8 * ratio));
            } else {
                const ratio = (percent - 75) / 25;
                r = Math.floor(132 - (10 * ratio));
                g = Math.floor(216 + (28 * ratio));
                b = Math.floor(22 + (43 * ratio));
            }
            
            return `rgb(${r}, ${g}, ${b})`;
        }
    }"
>
    <x-ui.progress 
        x-model="value"
        x-bind:style="`--color-primary: ${currentColor}`"
        wave
    />
</div>
```

> **Note:** While color spaces like `oklch` or `HSL` provide better color interpolation, RGB is used here for performance and simplicity in dynamically generating specific color values.

### Static Color Switching

Switch between predefined colors based on progress value using Alpine's reactive classes:

@blade
<x-demo>
    <div x-data="{ progress: 30 }">
        <div class="space-y-4">
            <div class="space-y-2">
                <x-ui.text size="sm" class="font-medium">
                    Progress: <span x-text="progress"></span>%
                </x-ui.text>
                <x-ui.progress 
                    x-model="progress"
                    x-bind:class="{
                        '[&_[data-slot=bar]]:bg-red-500': progress < 25,
                        '[&_[data-slot=bar]]:bg-orange-500': progress >= 25 && progress < 50,
                        '[&_[data-slot=bar]]:bg-yellow-500': progress >= 50 && progress < 75,
                        '[&_[data-slot=bar]]:bg-green-500': progress >= 75
                    }"
                />
            </div>
            
            <input 
                type="range" 
                x-model="progress" 
                min="0" 
                max="100" 
                class="w-full"
            />
        </div>
    </div>
</x-demo>
@endblade

```blade
<x-ui.progress 
    x-model="progress"
    x-bind:class="{
        '[&_[data-slot=bar]]:bg-red-500': progress < 25,
        '[&_[data-slot=bar]]:bg-orange-500': progress >= 25 && progress < 50,
        '[&_[data-slot=bar]]:bg-yellow-500': progress >= 50 && progress < 75,
        '[&_[data-slot=bar]]:bg-green-500': progress >= 75
    }"
/>
```

### Buffer Progress

Display dual progress bars for buffering scenarios like video players or file downloads. Pass a compound object with both `value` and `buffer` properties:

@blade
<x-demo>
    <div class="space-y-6" x-data="{progress: {value: 12, buffer: 34}}">
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">Buffering</x-ui.text>
            <x-ui.progress class="[&_[data-slot=bar]]:bg-teal-500" x-model="progress" />
        </div>
         <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-ui.text size="sm" class="font-medium mb-2">Played Position</x-ui.text>
                    <input 
                        type="range" 
                        x-model="progress.value"
                        min="0" 
                        max="100" 
                        class="w-full"
                    />
                </div>
                <div>
                    <x-ui.text size="sm" class="font-medium mb-2">Buffer Amount</x-ui.text>
                    <input 
                        type="range" 
                        x-model="progress.buffer"
                        min="0" 
                        max="100" 
                        class="w-full"
                    />
                </div>
            </div>
    </div>
</x-demo>
@endblade

```blade
<!-- Alpine.js -->
<div x-data="{ progress: {value: 12, buffer: 34 }}">
    <x-ui.progress x-model="progress" />
</div>

<!-- Livewire -->
<!-- public array $progress = ['value' => 12, 'buffer' => 34] -->
<x-ui.progress wire:model.live="progress" />
```

**How it works:** The buffer bar always stays ahead of or equal to the current value. If you try to set the value higher than the buffer, the buffer automatically adjusts upward.

### Indeterminate Loading

For tasks with unknown duration, use the `indeterminate` property to display an animated loading state:

@blade
<x-demo>
    <div class="space-y-6" x-data="{progress: {indeterminate: true}}">
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">Indeterminate Loading...</x-ui.text>
            <x-ui.progress class="[&_[data-slot=bar]]:bg-teal-500" x-model="progress" />
        </div>
    </div>
</x-demo>
@endblade

```blade
<!-- Livewire -->
<!-- public array $progress = ['value' => 0, 'indeterminate' => true] -->
<x-ui.progress wire:model.live="progress" />

<!-- Alpine.js -->
<div x-data="{progress: {value: 0, indeterminate: true}}">
    <x-ui.progress x-model="progress" />
</div>
```

### Complete Example: Video Buffering with Indeterminate Support

This example demonstrates using all compound properties together:

@blade
<x-demo>
    <div 
        x-data="{
            progress: {
                value: 12,
                buffer: 46,
                indeterminate: false
            }
        }" 
        class="space-y-6 p-6 bg-white dark:bg-neutral-900 max-w-2xl rounded-lg border border-neutral-200 dark:border-neutral-800"
    >
        <div class="space-y-2">
            <x-ui.text size="sm" class="font-medium">Video Buffering Simulation With Indeterminate Loading Support</x-ui.text>
            <x-ui.text size="xs" class="opacity-60">
                Played: <span x-text="progress.value"></span>% 
                | Buffered: <span x-text="progress.buffer"></span>%</x-ui.text>
            <x-ui.progress 
                x-model="progress" 
                class="[&_[data-slot=bar]]:bg-teal-500"
            />
        </div>
        <!--  -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-ui.text size="sm" class="font-medium mb-2">Played Position</x-ui.text>
                <input 
                    type="range" 
                    x-model="progress.value" 
                    min="0" 
                    max="100" 
                    class="w-full"
                />
            </div>
            <div>
                <x-ui.text size="sm" class="font-medium mb-2">Buffer Amount</x-ui.text>
                <input 
                    type="range" 
                    x-model="progress.buffer" 
                    min="0" 
                    max="100" 
                    class="w-full"
                />
            </div>
            <x-ui.button 
                variant="outline"
                x-on:click="progress.indeterminate = !progress.indeterminate"
            >
                toggle indeterminate
            </x-ui.button>
        </div>
    </div>
</x-demo>
@endblade

```blade
<!-- Livewire -->
<!-- public array $progress = ['value' => 12, 'buffer' => 46, 'indeterminate' => false] -->
<x-ui.progress wire:model.live="progress" />
<x-ui.button wire:click="$toggle('progress.indeterminate')">
    Toggle Indeterminate
</x-ui.button>

<!-- Alpine.js -->
<div x-data="{progress: {value: 12, buffer: 46, indeterminate: false}}">
    <x-ui.progress x-model="progress" />
    <x-ui.button x-on:click="progress.indeterminate = !progress.indeterminate">
        Toggle Indeterminate
    </x-ui.button>
</div>
```

## Component Props

### ui.progress

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `value` | number | `0` | Current progress value (0-100) |
| `max` | number | `100` | Maximum value for progress calculation |
| `min` | number | `0` | Minimum value for progress calculation |
| `size` | string | `'md'` | Bar height: `'xs'`, `'sm'`, `'md'`, `'lg'`, `'xl'` |
| `buffer` | number\|null | `null` | Buffer progress value for dual progress bars |
| `wave` | boolean | `false` | Enable shimmer wave animation |
| `duration` | number | `300` | Transition duration in milliseconds |
| `top` | slot | - | Custom content displayed above the progress bar |
| `bottom` | slot | - | Custom content displayed below the progress bar |

## Styling

The progress component provides multiple ways to customize colors:

### Using CSS Custom Properties

```blade
<!-- Static CSS variable -->
<x-ui.progress 
    value="60"
    style="--color-primary: rgb(59, 130, 246)"
/>

<!-- Dynamic color with Alpine -->
<x-ui.progress 
    x-model="progress"
    x-bind:style="`--color-primary: ${dynamicColor}`"
/>
```

### Using Data-Slot Selector

```blade
<!-- Static color -->
<x-ui.progress 
    value="60"
    class="[&_[data-slot=bar]]:bg-purple-500"
/>

<!-- Conditional colors with Alpine -->
<x-ui.progress 
    x-model="progress"
    x-bind:class="{
        '[&_[data-slot=bar]]:bg-red-500': progress < 50,
        '[&_[data-slot=bar]]:bg-green-500': progress >= 50
    }"
/>
```
