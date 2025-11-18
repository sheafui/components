---
id: two-way-data-bindings
title: Building Reusable TALL Stack Components with wire:model & x-model
slug: building-reusable-tall-stack-components-with-wire-model-x-model
excerpt: Learn the exact pattern for building Blade components that work natively with both wire:model and x-model. Includes x-modelable tutorial and advanced entanglement techniques for complex Laravel components.
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

## Toggle Component with x-modelable

Let's implement a  toggle component using `x-modelable` first (then we're going to build it usingf the entanglement way). Remember, **we're using a toggle just for simplicity** this pattern works great for toggles! But the advanced entanglement pattern we'll cover later is designed for truly complex components like sliders, autocompletes, or date pickers... 

> **For real-world advanced implementations**, check out our [Range Slider component](/docs/components/slider) or other advanced components like select/otp in the SheafUI library where the entanglement pattern really shines.

### Simple Toggle Implementation

Here's our toggle using `x-modelable`:

```blade
@props(['label' => null])

<div class="flex items-center gap-3">
    @if($label)
        <label class="font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif
    
    <button
        type="button"
        x-data="{ state: false }"
        x-modelable="state"
        x-on:click="state = !state"
        x-bind:class="state ? 'bg-green-600' : 'bg-neutral-200 dark:bg-neutral-800'"
        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        {{ $attributes }}
    >
        <span
            :class="state ? 'translate-x-6' : 'translate-x-1'"
            class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform"
        ></span>
    </button>
</div>
```
### How It Works

The magic happens with three simple Alpine directives:

1. **`x-data="{ state: false }"`** - Creates our internal state
2. **`x-modelable="state"`** - Exposes `state` to parent components via `x-model` or `wire:model`
3. **`x-on:click="state = !state"`** - Toggles the state when clicked

### Usage

Now you can use it exactly like a native input:
```blade
<!-- With Livewire -->
<x-ui.simple-toggle wire:model="isActive" label="Enable Feature" />

<!-- With Alpine -->
<div x-data="{ isActive: false }">
    <x-ui.simple-toggle x-model="isActive" label="Enable Feature" />
    <p x-show="isActive">Feature is active!</p>
</div>
```

**That's it!** For this toggle component, `x-modelable` is actually the perfect solution. Clean, simple, and it just works.

### Why We Need More: When x-modelable Hits Its Limits

The `x-modelable` approach works beautifully for our toggle because:
- Single boolean state
- Simple click interaction
- No external libraries
- No complex transformations

But what about components like:

- **Range Slider** - Needs NoUISlider integration, min/max/step validation, dual handles, formatting
- **Autocomplete** - Async data fetching, debouncing, keyboard navigation, selected items management
- **Date Picker** - Calendar library integration, date parsing/formatting, range selections
- **Rich Text Editor** - Quill/TinyMCE integration, toolbar state, content sanitization
- ...

For these scenarios, you need:
- Fine-grained control over when and how syncing happens
- Integration with third-party library instances
- Complex internal state management
- Lifecycle hooks for initialization and cleanup
- The ability to detect and respond to `.live` modifiers

**That's where custom entanglement comes in.** Let's rebuild our toggle using the advanced pattern not because the toggle needs it, but to understand the architecture for when you *do* need it.

> **Rule of thumb:** Use `x-modelable` for simple wrapped inputs. Use custom entanglement (explained below) for components with complex behavior.

## Advanced Solution: Custom Entanglement Pattern

Our solution has three layers that work together. This is the foundation you need to build any reactive Blade component:

```blade
                                                ┌──────────────────────────────────────┐
                                                │   Layer 1: Blade Component        │
                                                │   (Detects wire:model or x-model) │
                                                └──────────────────────────────────────┘
                                                                    ↓
                                                ┌──────────────────────────────────────┐
                                                │   Layer 2: Alpine Component       │
                                                │   (Handles entanglement/x-model)  │
                                                └──────────────────────────────────────┘
                                                                    ↓
                                                ┌──────────────────────────────────────┐
                                                │   Layer 3: Your Component Logic   │
                                                │   (Just reads/writes to _state)   │
                                                └──────────────────────────────────────┘
```

> Let's build this step by step.

### Step 1: Understanding Livewire Entanglement

Before writing any code, you need to understand Livewire's **secret weapon**: entanglement.

#### What is Entanglement?

@blade
<x-md.callout variant="info" title="How Entanglement Works">

<strong>JavaScript → PHP</strong>: When you change a value in JavaScript, it automatically syncs to your Livewire component on the server.

<br>

<strong>PHP → JavaScript</strong>: When Livewire updates the property on the server, the JavaScript value automatically updates—no manual event listeners needed!

</x-md.callout>
@endblade

Here's the simplest example:

```javascript
// Inside an Alpine component within a Livewire component
init() {
    // Create an entangled property
    this.volume = this.$wire.$entangle('volume');
    
    // Now changes flow automatically:
    this.volume = 75;  // ← Syncs to server automatically
    
    // When the server updates volume to 50:
    // this.volume becomes 50 automatically in JavaScript!
}
```

#### The Two Modes of Entanglement

```javascript
const bladeComponent = () => ({
    // 1. Deferred (default) - Syncs on the next Livewire request
    volume: this.$wire.$entangle('volume'),
    // 2. Live - Syncs immediately (triggers instant server request)
    volume: this.$wire.$entangle('volume').live,
})
```

@blade
<x-md.callout variant="warning" title="Performance Tip">
Use `.live` mode sparingly! Every change triggers a server round-trip. For most use cases, deferred mode (the default) provides better performance while maintaining reactivity.
</x-md.callout>
@endblade



### Step 2: Building the Blade Component

Now let's build a component that automatically detects whether the user wants Livewire or Alpine binding.

#### Detecting the Binding Method

First, we detect if the user is using `wire:model`:

```blade
@props([
    'label' => null,
    // ... other props
])

@php
    // Detect if wire:model is present
    $modelAttrs = collect($attributes->getAttributes())
        ->keys()
        ->first(fn($key) => str_starts_with($key, 'wire:model'));

    // Extract the property name: wire:model="isActive" → "isActive"
    $model = $modelAttrs ? $attributes->get($modelAttrs) : null;

    // Check for .live modifier: wire:model.live="isActive"
    $isLive = $modelAttrs && str_contains($modelAttrs, '.live');
    
    // Get Livewire component ID (only available in Livewire context)
    $livewireId = isset($__livewire) ? $__livewire->getId() : null;
@endphp
```

**What's happening here?**

1. **Find `wire:model`** - We search for any attribute starting with `wire:model`
2. **Extract property name** - If found, get the value (the property name to bind)
3. **Check for `.live`** - Determine if immediate syncing is needed
4. **Get Livewire ID** - Safely grab the Livewire component ID if available; we need this to interact with the component from JavaScript

#### Passing Configuration to JavaScript

Next, we pass this configuration to our Alpine component:

```blade
<div
    x-data="toggleComponent({
        model: @js($model),
        livewire: @js($livewireId) ? window.Livewire.find(@js($livewireId)) : null,
        isLive: @js($isLive),
    })"
    {{ $attributes }}
    wire:ignore 
>
    <!-- Component markup here -->
</div>
```

**Key Elements:**

- **`model`** - The property name to entangle (e.g., "isActive")
- **`livewire`** - The Livewire component instance (null if not in Livewire context)
- **`isLive`** - Whether to use live syncing
- **`wire:ignore`** - **Critical!** Tells Livewire not to replace this DOM element during updates

#### Complete Toggle Component Example

Here's a full working implementation:


```blade
@props([
    'label' => null,
])

@php
    
    // Detect if the component is bound to a Livewire model
    $modelAttrs = collect($attributes->getAttributes())->keys()->first(fn($key) => str_starts_with($key, 'wire:model'));

    $model = $modelAttrs ? $attributes->get($modelAttrs) : null;

    // Detect if model binding uses `.live` modifier (for real-time syncing)
    $isLive = $modelAttrs && str_contains($modelAttrs, '.live');

    
    $livewireId = isset($__livewire) ? $__livewire->getId() : null;
@endphp

<div class="flex items-center gap-3">
    @if($label)
        <label class="font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif
    
    <button
        type="button"
        x-data="toggleComponent({
            // You can use $wire object here instead of manually finding the component using the id, but based on my experience it breaks under nested Blade components and this is the most stable way I have worked with.
            livewire: @js($livewireId) ? window.Livewire.find(@js($livewireId)) : null, 
            model: @js($model),
            isLive: @js($isLive),
        })"
        
        x-on:click="toggle()"
        x-bind:class="isOn ? 'bg-green-600' : 'bg-neutral-200 dark:bg-neutral-800'"
        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        {{ $attributes }}
        
        @if(filled($model)) wire:ignore @endif
    >
        <!-- Toggle circle -->
        <span
            :class="isOn ? 'translate-x-6' : 'translate-x-1'"
            class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform"
        ></span>
    </button>
</div>
```

### Step 3: The Alpine Component with Dual-Mode Binding

Now for the **magic**—the JavaScript that seamlessly handles both Livewire and Alpine binding.

#### The Component Structure

@blade
<x-md.file file="resources/js/components/toggle.js" open>
const toggleComponent = ({
    livewire,  // Livewire instance or null
    model,     // Property name (e.g., "isActive") or null
    isLive,    // Use .live modifier?
}) => {
    // Helper: Create entangled state for Livewire
    const $entangle = (prop, live) => {
        if (!livewire || !prop) return null;
        const binding = livewire.$entangle(prop);
        return live ? binding.live : binding;
    };

    // Initialize state based on binding mode
    const $initState = (model, live) => {
        return model ? $entangle(model, live) : null;
    };

    return {
        // Internal state - either entangled (Livewire) or linked to x-model (Alpine)
        _state: $initState(model, isLive),
        
        // Computed getter/setter for clean API
        get isOn() {
            return this._state ?? false;
        },
        
        set isOn(value) {
            this._state = value;
        },
        
        init() {
            this.$nextTick(() => {
                // Fallback: If not using Livewire, check for x-model
                if (this._state == null) {
                    this._state = this.$root?._x_model?.get() ?? false;
                }
                
                // Watch state changes and sync with x-model if present
                this.$watch('_state', (value) => {
                    this.$root?._x_model?.set(value);
                });
            });
        },
        
        // Public method: Toggle the state
        toggle() {
            this.isOn = !this.isOn;
        },
    };
};

// Register with Alpine
Alpine.data('toggleComponent', toggleComponent);
</x-md.file>
@endblade

## How It Works

Let's walk through what happens in each usage scenario:

### Scenario 1: Livewire Binding

**Usage:**
```blade
<x-ui.toggle wire:model="isActive" />
```

**The Flow:**

1. **Blade Detection** → Detects `wire:model`, passes `livewire: $wire`, `model: 'isActive'`
2. **State Initialization** → `$initState()` calls `$entangle('isActive')`
3. **Entanglement Created** → `_state` is now entangled with the Livewire property
4. **User Interaction** → User clicks toggle → `this.isOn = !this.isOn` → Updates `_state`
5. **Auto-Sync to Server** → Entanglement automatically syncs the change to the server
6. **Server Updates** → If Livewire updates `isActive` on the server → `_state` automatically updates in JavaScript


### Scenario 2: Alpine Binding

**Usage:**
```blade
<div x-data="{ isActive: false }">
    <x-ui.toggle x-model="isActive" />
</div>
```

**The Flow:**

1. **Blade Detection** → No `wire:model` found, passes `livewire: null`, `model: null`
2. **State Initialization** → `$initState()` returns `null`
3. **Alpine Fallback** → In `init()`, falls back to `this.$root?._x_model?.get()`
4. **Link to x-model** → `_state` is now linked to Alpine's reactive `isActive` property
5. **User Interaction** → User clicks toggle → `this.isOn = !this.isOn` → Updates `_state`
6. **Manual Sync** → `$watch` triggers and syncs to x-model via `$root._x_model.set(value)`

### Scenario 3: No Binding (Standalone Component)

**Usage:**
```blade
<x-ui.toggle />
```

**The Flow:**

1. **No Binding** → Both `livewire` and `model` are `null`
2. **Default State** → `_state` defaults to `false`
3. **Self-Contained** → Component works perfectly, state just isn't shared externally
4. **Still Functional** → Great for demos, prototypes, or purely visual components

## Understanding the Critical Parts

### Why `$nextTick()`?

```javascript
init() {
    this.$nextTick(() => {
        // Access _x_model here
    });
}
```

Alpine's reactive system isn't fully initialized when `init()` first runs. Without `$nextTick()`, `_x_model` might be `undefined`. The `$nextTick()` ensures Alpine has fully set up the component before we access advanced APIs.

**Think of it like:** Waiting for the door to fully open before walking through.

---

### Why Optional Chaining (`?.`)?

```javascript
this.$root?._x_model?.get()
```

The `?.` operator is **crucial** for graceful degradation:

- ✅ Not every component uses `x-model`
- ✅ Prevents crashes when APIs don't exist
- ✅ Allows the same code to work in all three scenarios

**Without it:** Your component would crash when used without `x-model`.  
**With it:** Everything just works!

---

### Why Watch `_state`?

```javascript
this.$watch('_state', (value) => {
    this.$root?._x_model?.set(value);
});
```

**For Livewire:** Entanglement automatically syncs both directions—no watcher needed for that!

**For Alpine:** We need to manually sync changes back to the parent component's reactive system. Alpine's `x-model` requires explicit syncing, unlike Livewire's automatic entanglement.

**The Watcher:** Listens for any change to `_state` and pushes it back to Alpine's `x-model`.

### Common Pitfalls and Solutions

#### Pitfall 1: Forgetting `wire:ignore`

**Problem:** Livewire keeps resetting your component during updates.

**Solution:** Always add `wire:ignore` when using Livewire binding:

```blade
@if($hasWireModel) wire:ignore @endif
```

#### Pitfall 2: Not Using `Alpine.raw()`

**Problem:** When passing state to third-party libraries, you get errors about proxies.

**Solution:** Unwrap the reactive proxy:

```javascript
// ❌ Wrong
thirdPartyLib.setValue(this._state);

// ✅ Correct
thirdPartyLib.setValue(Alpine.raw(this._state));
```

#### Pitfall 3: Infinite Update Loops

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

#### Pitfall 4: Reactive Data in Non-Reactive Contexts

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


@blade
<x-md.callout title="AI Credits">
    This article is 80-90% written by hand to speak to you directly in a human, understandable way. The remaining 10-20% consists of refinements by AI (Claude) and grammar corrections, since the SheafUI team are not native English speakers.
</x-md.callout>
@endblade