---
name: autocomplete
---

## Introduction

The `Autocomplete` component is a **responsive**, **accessible** search input component with dropdown suggestions. It provides real-time filtering, keyboard navigation, and seamless integration with Livewire for dynamic data binding.

## Installation
Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `autocomplete` component easily:

```bash
php artisan sheaf:install autocomplete
```

> Once installed, you can use the `<x-ui.autocomplete />` component in any Blade view.

## Usage
@blade
<x-demo>
    <div class="w-full max-w-3xs mx-auto">
        <x-ui.autocomplete 
            placeholder="Type to search..."
            leftIcon="map-pin"
        >
            <x-ui.autocomplete.item>Khouribga</x-ui.autocomplete.item>
            <x-ui.autocomplete.item>Casablanca</x-ui.autocomplete.item>
            <x-ui.autocomplete.item>Rabat</x-ui.autocomplete.item>
            <x-ui.autocomplete.item>Marrakech</x-ui.autocomplete.item>
            <x-ui.autocomplete.item>Fès</x-ui.autocomplete.item>
            <x-ui.autocomplete.item>Tanger</x-ui.autocomplete.item>
            <x-ui.autocomplete.item>Agadir</x-ui.autocomplete.item>
        </x-ui.autocomplete>
    </div>
</x-demo>
@endblade

```blade
<x-ui.autocomplete 
    placeholder="Type to search..."
    leftIcon="map-pin"
>
        <x-ui.autocomplete.item>United States</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>United Kingdom</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>Canada</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>Australia</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>Germany</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>France</x-ui.autocomplete.item>
</x-ui.autocomplete>
```

### Bind To Livewire

To use with Livewire you only need to use `wire:model="property"` to bind your input state:

```blade
<x-ui.autocomplete 
    wire:model="product"
    placeholder="Find products..." 
>
        <x-ui.autocomplete.item>iPhone 15 Pro</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>MacBook Air M2</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>AirPods Pro</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>iPad Pro</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>Apple Watch Series 9</x-ui.autocomplete.item>
</x-ui.autocomplete>
```

### Using it within Blade & Alpine

You can use it outside Livewire with just Alpine (and Blade):

```blade
<x-ui.autocomplete 
    x-model="product"
    placeholder="Find products..." 
>
        <x-ui.autocomplete.item>iPhone 15 Pro</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>MacBook Air M2</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>AirPods Pro</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>iPad Pro</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>Apple Watch Series 9</x-ui.autocomplete.item>
</x-ui.autocomplete>
```

### Add Label & Description
@blade
<x-demo>
    <x-ui.field class="max-w-64">
        <x-ui.label>Search Products</x-ui.label>
        <x-ui.description>Search through our product catalog</x-ui.description>
        <x-ui.autocomplete 
            x-model="product"
            placeholder="Find products..." 
        >
                <x-ui.autocomplete.item>iPhone 15 Pro</x-ui.autocomplete.item>
                <x-ui.autocomplete.item>MacBook Air M2</x-ui.autocomplete.item>
                <x-ui.autocomplete.item>AirPods Pro</x-ui.autocomplete.item>
                <x-ui.autocomplete.item>iPad Pro</x-ui.autocomplete.item>
                <x-ui.autocomplete.item>Apple Watch Series 9</x-ui.autocomplete.item>
        </x-ui.autocomplete>
    </x-ui.field>
</x-demo>
@endblade

```blade
<x-ui.field class="max-w-64">
    <x-ui.label>Search Products</x-ui.label>
    <x-ui.description>Search through our product catalog</x-ui.description>
    <x-ui.autocomplete>
        <!-- items -->
    </x-ui.autocomplete>
</x-ui.field>
```
### with Icons

Enhance the autocomplete with leading and trailing icons for better visual communication.

@blade
<x-demo>
    <div class="w-full max-w-3xs mx-auto">
        <x-ui.autocomplete 
            placeholder="Find your favorite tech..."
            leftIcon="code-bracket"
            rightIcon="magnifying-glass"
           >
                <x-ui.autocomplete.item>Laravel</x-ui.autocomplete.item>
                <x-ui.autocomplete.item>Vue.js</x-ui.autocomplete.item>
                <x-ui.autocomplete.item>React</x-ui.autocomplete.item>
                <x-ui.autocomplete.item>Tailwind CSS</x-ui.autocomplete.item>
                <x-ui.autocomplete.item>Alpine.js</x-ui.autocomplete.item>
                <x-ui.autocomplete.item>Livewire</x-ui.autocomplete.item>
        </x-ui.autocomplete>
    </div>
</x-demo>
@endblade

```blade
<x-ui.autocomplete 
    placeholder="Find your favorite tech..."
    leftIcon="code-bracket"
    rightIcon="magnifying-glass"
    wire:model="selectedTech">
        <x-ui.autocomplete.item>Laravel</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>Vue.js</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>React</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>Tailwind CSS</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>Alpine.js</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>Livewire</x-ui.autocomplete.item>
</x-ui.autocomplete>
```

### Clearable

Add a clear button to easily reset the input value.

@blade
<x-demo>
    <div class="w-full max-w-3xs mx-auto">
        <x-ui.autocomplete 
            placeholder="Type city name..."
            icon="map-pin"
            clearable
            description="Search for cities worldwide"
            >
                <x-ui.autocomplete.item>New York</x-ui.autocomplete.item>
                <x-ui.autocomplete.item>Los Angeles</x-ui.autocomplete.item>
                <x-ui.autocomplete.item>Chicago</x-ui.autocomplete.item>
                <x-ui.autocomplete.item>Houston</x-ui.autocomplete.item>
                <x-ui.autocomplete.item>Phoenix</x-ui.autocomplete.item>
                <x-ui.autocomplete.item>Philadelphia</x-ui.autocomplete.item>
        </x-ui.autocomplete>
    </div>
</x-demo>
@endblade

```blade
<x-ui.autocomplete 
    placeholder="Type city name..."
    icon="map-pin"
    clearable="true"
    description="Search for cities worldwide"
    wire:model="selectedCity">
        <x-ui.autocomplete.item>New York</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>Los Angeles</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>Chicago</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>Houston</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>Phoenix</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>Philadelphia</x-ui.autocomplete.item>
</x-ui.autocomplete>
```

### Validation States

Show different states for validation feedback.

@blade
<x-demo>
    <div class="w-full max-w-3xs mx-auto space-y-4">
        <x-ui.autocomplete 
            placeholder="Search..."
            icon="exclamation-circle"
            invalid="true"
            description="Please select a valid option"
            >
                <x-ui.autocomplete.item>Option 1</x-ui.autocomplete.item>
                <x-ui.autocomplete.item>Option 2</x-ui.autocomplete.item>
        </x-ui.autocomplete>
    </div>
</x-demo>
@endblade

```blade
<!-- Invalid state -->
<x-ui.autocomplete 
    placeholder="Search..."
    icon="exclamation-circle"
    invalid="true"
    description="Please select a valid option"
    >
        <x-ui.autocomplete.item>Option 1</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>Option 2</x-ui.autocomplete.item>
</x-ui.autocomplete>
```

### Disabled and Readonly States

@blade
<x-demo>
    <div class="w-full max-w-3xs mx-auto space-y-4">
        <x-ui.autocomplete 
            placeholder="This is disabled..."
            disabled
        >
            <x-ui.autocomplete.item>Option 1</x-ui.autocomplete.item>
            <x-ui.autocomplete.item>Option 2</x-ui.autocomplete.item>
        </x-ui.autocomplete>
        <x-ui.autocomplete 
            placeholder="This is readonly..."
            readonly
        >
                <x-ui.autocomplete.item>Option 1</x-ui.autocomplete.item>
                <x-ui.autocomplete.item>Option 2</x-ui.autocomplete.item>
        </x-ui.autocomplete>
    </div>
</x-demo>
@endblade

```blade
<!-- Disabled -->
<x-ui.autocomplete 
    placeholder="This is disabled..."
    disabled="true"
    wire:model="disabledValue">
        <x-ui.autocomplete.item>Option 1</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>Option 2</x-ui.autocomplete.item>
</x-ui.autocomplete>

<!-- Readonly -->
<x-ui.autocomplete 
    placeholder="This is readonly..."
    readonly
    wire:model="readonlyValue">
        <x-ui.autocomplete.item>Option 1</x-ui.autocomplete.item>
        <x-ui.autocomplete.item>Option 2</x-ui.autocomplete.item>
</x-ui.autocomplete>
```

## Component Prop

### ui.autocomplete

| Prop Name      | Type    | Default       | Required | Description                                                                  |
| -------------- | ------- | ------------- | -------- | ---------------------------------------------------------------------------- |
| `label`        | string  | `''`          | No       | Label text displayed above the input                                         |
| `name`         | string  | `wire:model`  | No       | Name attribute for the input (auto-detected from wire:model)                |
| `placeholder`  | string  | `Search...`   | No       | Placeholder text for the input                                               |
| `variant`      | string  | `default`     | No       | Visual variant (currently only `default` supported)                         |
| `disabled`     | boolean | `false`       | No       | Whether the input is disabled                                                |
| `readonly`     | boolean | `false`       | No       | Whether the input is readonly                                                |
| `invalid`      | boolean | `false`       | No       | Whether to show invalid/error state styling                                  |
| `leftIcon`         | string  | `''`          | No       | left side of the icon name                                                            |
| `rightIcon` | string  | `''`          | No       | Right side of the icon name                                                           |
| `copyable` | boolean | `false` | No | Add copy to clipboard button |
| `clearable` | boolean | `false` | No | Add clear input button |
| `revealable` | boolean | `false` | No | Add password reveal toggle |

### ui.autocomplete.item
| Prop         | Type      | Default       | Description                                                                 |
| ------------ | --------- | ------------- | --------------------------------------------------------------------------- |
| `value`      | `string`  | slot content  | The value bound to the model on selection. Falls back to slot text content. |
| `label`      | `string`  | slot content  | Display label used in search filtering. Falls back to slot text content.    |
| `disabled`   | `boolean` | `false`       | Prevents the item from being selected.                                      |