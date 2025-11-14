---
id: two-way-data-bindings
title: Livewire + Alpine Data Binding, The Pattern SheafUI Uses
slug: livewire-and-alpine-data-binding-the-pattern-sheaui-uses
excerpt: Building Blade components that work seamlessly with both Livewire's wire:model and Alpine's x-model isn't magic? it's a pattern. Learn the exact architecture that we follow at sheafui's work, for building complex component that feels native to livewire or alpine, so you can use by just throwing wire:model or x-model there.
author: mohamed charrafi
created_at: 11-12-2025
published_at: 12-11-2025  
category: advanced techniques
---

# Master Two-Way Data Binding for Universal TALL Stack Components

@blade
<x-md.callout title="Notice">
    This guide was created by Mohamed, who built most of the components at SheafUI. This isn't our first approach—we've evolved through three different patterns to make Blade components feel native with both Livewire and Alpine.js. If you explore our component source code, you'll notice not all of them follow this pattern yet. We're working to migrate them one by one.
    
    Enjoy this piece of material!
</x-md.callout>
@endblade

@blade
<x-md.callout title="AI Credits">
    This article is 80-90% written by hand to speak to you directly in a human, understandable way. The remaining 10-20% consists of refinements by AI (Claude) and grammar corrections, since the SheafUI team are not native English speakers.
</x-md.callout>
@endblade

**What if there was a pattern that makes your components work with both frameworks automatically, feeling native to each?**

That's what we're building today: a universal two-way data binding system that supports:
- Livewire's `wire:model`
- Livewire's `.live` modifier
- Alpine's `x-model`
- Pure Alpine apps (no Livewire at all)
- Hybrid setups (Livewire + Alpine)
 
And the user doesn't have to change a single line of code. They just use `wire:model` or `x-model`, and it works.

## The Problem We're Solving

Let's say you're building a custom toggle component. Users want to use it like this:

```blade
<!-- In a Livewire component -->
<x-ui.toggle wire:model="isActive" />

<!-- In a pure Alpine app -->
<div x-data="{ isActive: false }">
    <x-ui.toggle x-model="isActive" />
</div>
```

**The challenge:** How do you make the same Blade component work with both frameworks? These directives (`x-model` and `wire:model`) are intended for specific HTML tags, not custom components. How do you maintain two-way reactivity without creating a mess of conditional logic?

## The Solutions 

### Alpine's Modelable API

Alpine provides a powerful directive called `x-modelable` ([learn more in Alpine docs](https://alpinejs.dev/directives/modelable)) that binds internal state from an Alpine component (including Blade components) to external parent components. This is also the [recommended approach in Livewire's documentation](https://livewire.laravel.com/docs/3.x/forms#custom-form-controls) for building custom form controls.

#### Basic Example

Let's say you want to create a custom textarea with additional logic beyond the native HTML element:

```blade
<!-- resources/views/components/ui/textarea.blade.php -->
@props(['name' => ''])

<div
    x-data="{ state: null }"
    {{ $attributes }}
>
    <textarea 
        x-model="state"
        name="{{ $name }}"
        class="w-full rounded border..."
    />
    <!-- Additional custom UI elements here -->
</div>
```

The problem? Since this is a custom component, you can't directly use `x-model` or `wire:model` on it—these directives are designed to work with native form elements only.

#### Enter x-modelable

This is where `x-modelable` solves the problem:

```blade
<!-- resources/views/components/ui/textarea.blade.php -->
@props(['name' => ''])

<div
    x-data="{ state: null }"
    x-modelable="state"
    {{ $attributes }}
>
    <textarea 
        x-model="state"
        name="{{ $name }}"
        class="w-full rounded border..."
    />
</div>
```

Now you can use your custom component exactly like a native input:

```blade
<!-- With Livewire -->
<x-ui.textarea wire:model="content" />

<!-- With Alpine -->
<div x-data="{ content: '' }">
    <x-ui.textarea x-model="content" />
</div>
```

The `x-modelable="state"` directive tells Alpine: "When someone uses `x-model` or `wire:model` on this component, bind it to the `state` property."

#### When x-modelable Isn't Enough

While `x-modelable` works beautifully for simple components (textareas, switches, basic inputs), it becomes **limiting for complex components** that require:

- **Advanced JavaScript logic** (autocomplete, date pickers, sliders)
- **Multiple internal states** (open/closed dropdown + selected value)
- **Third-party library integrations** (NoUISlider, Choices.js, etc.)
- **Complex reactivity patterns** (debouncing, validation, transformation)

For these advanced use cases, you need finer control over state management and synchronization. That's when we move beyond `x-modelable` to **custom entanglement patterns**—which is exactly what this guide will teach you.

> **Rule of thumb:** Use `x-modelable` for simple wrapped inputs. Use custom entanglement (explained below) for components with complex behavior.

### Advanced Solution 
Our solution has three layers that work together. This is the foundation you need to build any reactive Blade component:

- **Layer 1**: The Blade Component (*Public API*)
- **Layer 2**: The Alpine Component (*Reactivity Engine*)
- **Layer 3**: Your Component Logic

Let's build this step by step.

## Step 1: Understanding Livewire Entanglement

Before we code anything, you need to understand what Livewire entanglement is. It's the **secret weapon** that makes Livewire components reactive.

### What is Entanglement?

Entanglement creates a two-way reactive bridge between JavaScript and PHP. When you entangle a property:

1. **JS → PHP**: Changes in JavaScript automatically sync to the server.
2. **PHP → JS**: Server updates automatically reflect in JavaScript.

Here's the simplest example:

```javascript
// In an Alpine component within a Livewire component
init() {
    // Create an entangled property
    this.volume = this.$wire.$entangle('volume');
    
    // Now, when you update it in JS...
    this.volume = 75;  // ← Automatically syncs to server
    
    // And when Livewire updates it on the server...
    // this.volume automatically updates in JS!
}
```
Entanglement has two modes:

```javascript
// Deferred (default): Syncs on next Livewire request
this.volume = this.$wire.$entangle('volume');

// Live: Syncs immediately
this.volume = this.$wire.$entangle('volume').live;
```

The `.live` mode triggers a server request immediately when the value changes. Use it sparingly!

## Step 2: Building the Blade Component

Let's build a generic component that supports both binding methods. We'll use a toggle as an example, but this pattern works for ANY interactive component.

### Detecting the Binding Method

First, we need to detect whether the user is using `wire:model` or `x-model`:

```blade
@props([
    'label' => null,
    // ... other props
])
<!-- one of 100 solution to get the model propetry name and if it live or not -->
@php
    // Detect if the component is bound to a Livewire model
    $modelAttrs = collect($attributes->getAttributes())->keys()->first(fn($key) => str_starts_with($key, 'wire:model'));

    $model = $modelAttrs ? $attributes->get($modelAttrs) : null;

    // Detect if model binding uses `.live` modifier (for real-time syncing)
    $isLive = $modelAttrs && str_contains($modelAttrs, '.live');
    
    // grab the livewire id of the component we're inside
    $livewireId = isset($__livewire) ? $__livewire->getId() : null;
@endphp
```

**What's happening here?**

- `whereStartsWith('wire:model')` finds any attribute starting with `wire:model`
- We extract the property name from the attribute value
- We check if `.live` is in the attribute name

### Passing Data to JavaScript

Now we pass this information to our Alpine component:

```blade
<div
    x-data="toggleComponent({
        // adapt component with livewire natively
        model: @js($model),
        livewire: @js(isset($livewireId)) ? window.Livewire.find(@js($livewireId)) : null,
        isLive: @js($isLive),
    })"
    {{ $attributes}}
    wire:ignore 
>
    <!-- Component markup here -->
</div>
```

**Key points:**

1. **`livewire: $wire`** - We pass the Livewire instance (only available in Livewire components)
2. **`model: "isActive"`** - The property name to entangle
3. **`isLive: true/false`** - Whether to use live syncing
4. **`wire:ignore`** - Critical! Tells Livewire not to morph (replace) this element's DOM

### The Complete Blade Template

Here's a full toggle component example:

```blade
@props([
    'label' => null,
    'onLabel' => 'On',
    'offLabel' => 'Off',
])

@php
    $wireModelAttr = $attributes->whereStartsWith('wire:model')->first();
    $hasWireModel = !empty($wireModelAttr);
    
    $wireModelValue = null;
    $isLive = false;
    
    if ($hasWireModel) {
        $wireModelValue = $attributes->get($wireModelAttr);
        $isLive = str_contains($wireModelAttr, '.live');
    }
@endphp

<div class="flex items-center gap-3">
    @if($label)
        <label class="text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif
    
    <button
        type="button"
        x-data="toggleComponent({
            livewire: @if($hasWireModel) $wire @else null @endif,
            model: @js($wireModelValue),
            isLive: @js($isLive),
        })"
        @click="toggle()"
        :class="isOn ? 'bg-blue-600' : 'bg-gray-200'"
        class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors"
        {{ $attributes->except(['class', 'wire:model', 'wire:model.live', 'x-model']) }}
        @if($hasWireModel) wire:ignore @endif
    >
        <span
            :class="isOn ? 'translate-x-6' : 'translate-x-1'"
            class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform"
        ></span>
        
        <span x-show="isOn" class="ml-2 text-xs text-white">{{ $onLabel }}</span>
        <span x-show="!isOn" class="ml-2 text-xs text-gray-600">{{ $offLabel }}</span>
    </button>
</div>
```

## Step 3: The Alpine Component with Dual-Mode Binding

Now for the magic—the JavaScript that handles both Livewire and Alpine binding.

### The Basic Structure

```javascript
const toggleComponent = ({
    livewire,  // Livewire instance ($wire) or null
    model,     // Property name for Livewire ("isActive") or null
    isLive,    // Use .live modifier?
}) => {
    // Helper: Create entangled state if using Livewire
    const $entangle = (prop, live) => {
        if (!livewire || !prop) return null;
        const binding = livewire.$entangle(prop);
        return live ? binding.live : binding;
    };

    // Initialize state
    const $initState = (model, live) => {
        return model ? $entangle(model, live) : null;
    };

    return {
        // Internal state - will be either entangled or x-model
        _state: $initState(model, isLive),
        
        // Computed property for easy access
        get isOn() {
            return this._state ?? false;
        },
        
        set isOn(value) {
            this._state = value;
        },
        
        init() {
            this.$nextTick(() => {
                // If not using Livewire, fall back to Alpine's x-model
                if (!this._state) {
                    this._state = this.$root?._x_model?.get() ?? false;
                }
                
                // Watch for changes and sync with x-model if used
                this.$watch('_state', (value) => {
                    this.$root?._x_model?.set(value);
                });
            });
        },
        
        toggle() {
            this.isOn = !this.isOn;
        },
    };
};

Alpine.data('toggleComponent', toggleComponent);
```

### How This Works - The Flow

Let me break down what happens in different scenarios:

#### Scenario 1: Using `wire:model="isActive"`

```blade
<x-ui.toggle wire:model="isActive" />
```

**The Flow:**
1. Blade detects `wire:model`, passes `livewire: $wire` and `model: 'isActive'`
2. `$initState()` calls `$entangle('isActive')`
3. `_state` is now entangled with the Livewire property
4. User clicks toggle → `this.isOn = !this.isOn` → Updates `_state`
5. Entanglement automatically syncs to server
6. If server updates `isActive` → Entanglement automatically updates `_state`

#### Scenario 2: Using `x-model="isActive"`

```blade
<div x-data="{ isActive: false }">
    <x-ui.toggle x-model="isActive" />
</div>
```

**The Flow:**
1. Blade detects no `wire:model`, passes `livewire: null` and `model: null`
2. `$initState()` returns `null`
3. In `init()`, we fall back to `this.$root?._x_model?.get()`
4. `_state` is now linked to Alpine's x-model
5. User clicks toggle → `this.isOn = !this.isOn` → Updates `_state`
6. `$watch` triggers and syncs to x-model via `$root?._x_model?.set(value)`

#### Scenario 3: Standalone (No Binding)

```blade
<x-ui.toggle />
```

**The Flow:**
1. Both `livewire` and `model` are null
2. `_state` defaults to `false`
3. Component works, but state isn't shared with anything external
4. Still fully functional for UI purposes!

### The Critical Parts Explained

#### Why `$nextTick()`?

```javascript
init() {
    this.$nextTick(() => {
        // Code here
    });
}
```

Alpine's reactive system isn't fully initialized during `init()`. Without `$nextTick()`, `_x_model` might be `undefined`. This ensures everything is ready before we try to access it.

#### Why Check for `_x_model`?

```javascript
this.$root?._x_model?.get()
```

The optional chaining (`?.`) is crucial because:
- Not every component uses `x-model`
- Some components are used standalone
- This prevents errors when these APIs don't exist

#### Why Watch `_state`?

```javascript
this.$watch('_state', (value) => {
    this.$root?._x_model?.set(value);
});
```

When using `x-model`, we need to manually sync changes back to Alpine's reactive system. Livewire entanglement does this automatically, but Alpine's `x-model` requires explicit syncing.

## Step 4: Advanced Patterns

### Pattern 1: Multiple Values (Arrays/Objects)

Some components need to bind arrays or objects. The pattern is the same:

```javascript
const multiSelectComponent = ({
    livewire,
    model,
    isLive,
}) => {
    const $entangle = (prop, live) => {
        if (!livewire || !prop) return null;
        const binding = livewire.$entangle(prop);
        return live ? binding.live : binding;
    };

    const $initState = (model, live) => {
        return model ? $entangle(model, live) : null;
    };

    return {
        _state: $initState(model, isLive),
        
        get selectedItems() {
            return this._state ?? [];
        },
        
        set selectedItems(value) {
            this._state = value;
        },
        
        init() {
            this.$nextTick(() => {
                if (!this._state) {
                    this._state = this.$root?._x_model?.get() ?? [];
                }
                
                this.$watch('_state', (value) => {
                    this.$root?._x_model?.set(value);
                });
            });
        },
        
        toggleItem(item) {
            const current = [...this.selectedItems];
            const index = current.indexOf(item);
            
            if (index > -1) {
                current.splice(index, 1);
            } else {
                current.push(item);
            }
            
            this.selectedItems = current;
        },
    };
};
```

**Key point:** Always create a new array/object reference when updating, or reactivity won't trigger properly.

### Pattern 2: Complex Components with Internal State

Some components have both internal state AND bound state:

```javascript
const datePickerComponent = ({
    livewire,
    model,
    isLive,
}) => {
    const $entangle = (prop, live) => {
        if (!livewire || !prop) return null;
        const binding = livewire.$entangle(prop);
        return live ? binding.live : binding;
    };

    const $initState = (model, live) => {
        return model ? $entangle(model, live) : null;
    };

    return {
        // Bound state (syncs externally)
        _state: $initState(model, isLive),
        
        // Internal state (component-only)
        isOpen: false,
        currentMonth: new Date().getMonth(),
        currentYear: new Date().getFullYear(),
        
        get selectedDate() {
            return this._state ?? null;
        },
        
        set selectedDate(value) {
            this._state = value;
        },
        
        init() {
            this.$nextTick(() => {
                if (!this._state) {
                    this._state = this.$root?._x_model?.get() ?? null;
                }
                
                this.$watch('_state', (value) => {
                    this.$root?._x_model?.set(value);
                });
            });
        },
        
        selectDate(date) {
            this.selectedDate = date;
            this.isOpen = false;  // Internal state doesn't sync
        },
    };
};
```

**Rule of thumb:** Anything that needs to be shared with the parent component goes in `_state`. Everything else is internal.

### Pattern 3: Validation and Transformation

Sometimes you need to validate or transform values before syncing:

```javascript
const numberInputComponent = ({
    livewire,
    model,
    isLive,
    min = null,
    max = null,
}) => {
    const $entangle = (prop, live) => {
        if (!livewire || !prop) return null;
        const binding = livewire.$entangle(prop);
        return live ? binding.live : binding;
    };

    const $initState = (model, live) => {
        return model ? $entangle(model, live) : null;
    };

    return {
        _state: $initState(model, isLive),
        _inputValue: '',
        
        get value() {
            return this._state ?? 0;
        },
        
        set value(val) {
            // Validate and constrain
            let num = parseFloat(val) || 0;
            
            if (min !== null && num < min) num = min;
            if (max !== null && num > max) num = max;
            
            this._state = num;
        },
        
        init() {
            this.$nextTick(() => {
                if (!this._state) {
                    this._state = this.$root?._x_model?.get() ?? 0;
                }
                
                this._inputValue = String(this._state);
                
                this.$watch('_state', (value) => {
                    this._inputValue = String(value);
                    this.$root?._x_model?.set(value);
                });
            });
        },
        
        handleInput(event) {
            const val = event.target.value;
            this._inputValue = val;
            
            // Only update state if valid number
            if (!isNaN(val) && val !== '') {
                this.value = val;
            }
        },
    };
};
```

## Step 5: Common Pitfalls and Solutions

### Pitfall 1: Forgetting `wire:ignore`

**Problem:** Livewire keeps resetting your component during updates.

**Solution:** Always add `wire:ignore` when using Livewire binding:

```blade
@if($hasWireModel) wire:ignore @endif
```

### Pitfall 2: Not Using `Alpine.raw()`

**Problem:** When passing state to third-party libraries, you get errors about proxies.

**Solution:** Unwrap the reactive proxy:

```javascript
// ❌ Wrong
thirdPartyLib.setValue(this._state);

// ✅ Correct
thirdPartyLib.setValue(Alpine.raw(this._state));
```

### Pitfall 3: Infinite Update Loops

**Problem:** Component enters an infinite loop of updates.

**Solution:** Don't update `_state` inside the `$watch` for `_state`:

```javascript
// ❌ Wrong - Creates infinite loop
this.$watch('_state', (value) => {
    this._state = transformValue(value);  // BAD!
    this.$root?._x_model?.set(value);
});

// ✅ Correct - Use a computed property or separate method
this.$watch('_state', (value) => {
    this.$root?._x_model?.set(value);
});
```

### Pitfall 4: Reactive Data in Non-Reactive Contexts

**Problem:** Passing reactive Alpine data to functions that expect plain JavaScript.

**Solution:** Always unwrap with `Alpine.raw()`:

```javascript
// Your component method
updateExternalLibrary() {
    externalLib.update({
        value: Alpine.raw(this._state),
        options: Alpine.raw(this.options),
    });
}
```

### Pitfall 5: Not Handling Null/Undefined

**Problem:** Component breaks when no initial value is provided.

**Solution:** Always provide defaults:

```javascript
get value() {
    return this._state ?? defaultValue;
}

init() {
    this.$nextTick(() => {
        if (!this._state) {
            this._state = this.$root?._x_model?.get() ?? defaultValue;
        }
    });
}
```

## Step 6: Testing Your Component

### Test Case 1: Livewire Binding

```php
// Livewire Component
class TestComponent extends Component
{
    public $isActive = false;
    
    public function toggle()
    {
        $this->isActive = !$this->isActive;
    }
    
    public function render()
    {
        return view('livewire.test-component');
    }
}
```

```blade
<!-- View -->
<div>
    <x-ui.toggle wire:model="isActive" label="Status" />
    
    <button wire:click="toggle">
        Toggle from Server
    </button>
    
    <p>Server Value: {{ $isActive ? 'ON' : 'OFF' }}</p>
</div>
```

**What to test:**
- ✅ Clicking toggle updates `$isActive` on server
- ✅ Clicking "Toggle from Server" updates the toggle UI
- ✅ State persists across Livewire requests

### Test Case 2: Alpine Binding

```blade
<div x-data="{ status: false }">
    <x-ui.toggle x-model="status" label="Status" />
    
    <button @click="status = !status">
        Toggle from Alpine
    </button>
    
    <p x-text="status ? 'ON' : 'OFF'"></p>
</div>
```

**What to test:**
- ✅ Clicking toggle updates Alpine's `status`
- ✅ Clicking "Toggle from Alpine" updates the toggle UI
- ✅ No console errors

### Test Case 3: Standalone

```blade
<x-ui.toggle label="Status" />
```

**What to test:**
- ✅ Toggle works visually
- ✅ No console errors
- ✅ Component doesn't crash

## Step 7: A Complete Real-World Example

Let's build a complete custom select component using this pattern:

### The Blade Component
@blade
<x-md.file file="resources/views/js/components/dede.js">
const customSelectComponent = ({
    livewire,
    model,
    isLive,
    options,
    placeholder,
}) => {
    const $entangle = (prop, live) => {
        if (!livewire || !prop) return null;
        const binding = livewire.$entangle(prop);
        return live ? binding.live : binding;
    };

    const $initState = (model, live) => {
        return model ? $entangle(model, live) : null;
    };

    return {
        _state: $initState(model, isLive),
        options: options,
        placeholder: placeholder,
        isOpen: false,
        
        get selectedValue() {
            return this._state ?? null;
        },
        
        set selectedValue(value) {
            this._state = value;
        },
        
        get selectedLabel() {
            if (!this.selectedValue) return this.placeholder;
            
            const option = this.options.find(opt => opt.value === this.selectedValue);
            return option ? option.label : this.placeholder;
        },
        
        init() {
            this.$nextTick(() => {
                if (!this._state) {
                    this._state = this.$root?._x_model?.get() ?? null;
                }
                
                this.$watch('_state', (value) => {
                    this.$root?._x_model?.set(value);
                });
            });
        },
        
        selectOption(value) {
            this.selectedValue = value;
            this.isOpen = false;
        },
        
        isSelected(value) {
            return this.selectedValue === value;
        },
    };
};

Alpine.data('customSelectComponent', customSelectComponent);
</x-md.file>
@endblade

@blade

<x-md.file file="de.blade.php">
@props([
    'placeholder' => 'Select an option',
    'options' => [],
])

@php
    $wireModelAttr = $attributes->whereStartsWith('wire:model')->first();
    $hasWireModel = !empty($wireModelAttr);
    
    $wireModelValue = null;
    $isLive = false;
    
    if ($hasWireModel) {
        $wireModelValue = $attributes->get($wireModelAttr);
        $isLive = str_contains($wireModelAttr, '.live');
    }
@endphp

<div
    x-data="customSelectComponent({
        livewire: @if($hasWireModel) $wire @else null @endif,
        model: @js($wireModelValue),
        isLive: @js($isLive),
        options: @js($options),
        placeholder: @js($placeholder),
    })"
    class="relative"
    {{ $attributes->except(['class', 'wire:model', 'wire:model.live', 'x-model']) }}
    @if($hasWireModel) wire:ignore @endif
    @click.away="isOpen = false"
>
    <!-- Selected value display -->
    <button
        type="button"
        @click="isOpen = !isOpen"
        class="w-full px-4 py-2 text-left bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
    >
        <span x-text="selectedLabel" class="block truncate"></span>
        <span class="absolute inset-y-0 right-0 flex items-center pr-2">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </span>
    </button>

    <!-- Dropdown -->
    <div
        x-show="isOpen"
        x-transition
        class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-auto"
    >
        <template x-for="option in options" :key="option.value">
            <div
                @click="selectOption(option.value)"
                class="px-4 py-2 cursor-pointer hover:bg-blue-50"
                :class="{ 'bg-blue-100': isSelected(option.value) }"
            >
                <span x-text="option.label"></span>
            </div>
        </template>
    </div>
</div>
</x-md.file>
@endblade

### The JavaScript Component


### Usage Examples

```blade
<!-- With Livewire -->
<x-ui.custom-select 
    wire:model.live="country"
    :options="[
        ['value' => 'us', 'label' => 'United States'],
        ['value' => 'uk', 'label' => 'United Kingdom'],
        ['value' => 'ca', 'label' => 'Canada'],
    ]"
    placeholder="Select a country"
/>

<!-- With Alpine -->
<div x-data="{ selectedCountry: null }">
    <x-ui.custom-select 
        x-model="selectedCountry"
        :options="[
            ['value' => 'us', 'label' => 'United States'],
            ['value' => 'uk', 'label' => 'United Kingdom'],
            ['value' => 'ca', 'label' => 'Canada'],
        ]"
        placeholder="Select a country"
    />
    
    <p x-show="selectedCountry">
        You selected: <span x-text="selectedCountry"></span>
    </p>
</div>
```