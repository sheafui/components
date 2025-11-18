---
name: 'checkbox'
---

# Checkbox Component

## Introduction

The `checkbox` component provides a powerful and flexible foundation for checkbox input fields.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `checkbox` component easily:

```bash
php artisan sheaf:install checkbox
```

## Basic Usage

@blade
<x-demo 
    x-data="{ agreed: false }"
>
  <div class="flex flex-col gap-y-4 mx-auto w-fit">
    <x-ui.checkbox 
        x-model="agreed"
        label="I agree to the terms and conditions"
        description="By checking this box, you agree to abide by our terms and conditions."
    />
  </div>
</x-demo>
@endblade

```blade
<x-ui.checkbox 
    wire:model="agreed"
    label="I agree to the terms and conditions"
    description="By checking this box, you agree to abide by our terms and conditions."
/>
```


## Integration

### Bind To Livewire 
To use with Livewire you need to only use `wire:model="agreed"` to bind your `checkbox` state:

```blade
<x-ui.checkbox 
    wire:model="agreed"
    label="I agree to the terms and conditions"
    description="By checking this box, you agree to abide by our terms and conditions."
/>
```

### Using it within Blade & Alpine

You can use it outside Livewire with just Alpine (with Blade):

```blade
<div x-data="{ agreed: false }">
    <x-ui.checkbox 
        x-model="agreed"
        label="I agree to the terms and conditions"
        description="By checking this box, you agree to abide by our terms and conditions."
    />
</div>
```


## Managing State
### Individual Checkbox (Boolean State)

For single checkboxes that manage their own boolean state, bind directly to the checkbox:

@blade
<x-demo x-data="{ agreed: false }">
  <div class="flex flex-col gap-y-4 mx-auto w-fit">
    <x-ui.checkbox 
        x-model="agreed"
        label="I agree to the terms and conditions"
        description="By checking this box, you agree to abide by our terms and conditions."
    />
  </div>
</x-demo>
@endblade

```blade
    <x-ui.checkbox 
        wire:model="agreed"
        label="I agree to the terms and conditions"
        description="By checking this box, you agree to abide by our terms and conditions."
    />
```

### Checkbox Group (Array State)

For multiple checkboxes that should manage a shared array of values, bind the model to the **group wrapper only**:

@blade
<x-demo>
    <div class="max-w-md mx-auto">
        <x-ui.checkbox.group>
            <x-ui.checkbox 
                label="Laravel"
                value="laravel"
                description="A powerful PHP web framework with elegant syntax for building modern web applications quickly."
            />
            <x-ui.checkbox 
                label="PHP" 
                value="php"
                description="Popular server-side scripting language for creating dynamic websites and web applications." 
            />
            <x-ui.checkbox 
                label="Alpine.js"
                value="alpinejs"
                description="Lightweight JavaScript framework for adding reactive behavior to HTML without complexity."
            />
            <x-ui.checkbox
                label="Livewire"
                value="livewire"
                description="Laravel framework for building dynamic UIs using PHP instead of JavaScript."
            />
            <x-ui.checkbox 
                label="Tailwind CSS"
                value="tailwind"
                description="Utility-first CSS framework for rapid custom design development."
            />
        </x-ui.checkbox.group>
    </div>
</x-demo>
@endblade

```blade
<!-- Group manages array state - bind model to GROUP only -->
<x-ui.checkbox.group wire:model="skills">
    <x-ui.checkbox 
        label="Laravel"
        value="laravel"
        description="A powerful PHP web framework with elegant syntax for building modern web applications quickly."
    />
    <x-ui.checkbox 
        label="PHP" 
        value="php"
        description="Popular server-side scripting language for creating dynamic websites and web applications." 
    />
    <x-ui.checkbox 
        label="Alpine.js"
        value="alpinejs"
        description="Lightweight JavaScript framework for adding reactive behavior to HTML without complexity."
    />
    <x-ui.checkbox
        label="Livewire"
        value="livewire"
        description="Laravel framework for building dynamic UIs using PHP instead of JavaScript."
    />
    <x-ui.checkbox 
        label="Tailwind CSS"
        value="tailwind"
        description="Utility-first CSS framework for rapid custom design development."
    />
</x-ui.checkbox.group>
```

**Important**: When using groups, only add the `wire:model` or `x-model` to the `<x-ui.checkbox.group>` component, not to individual checkboxes. The group automatically manages the array state.

## Understanding State Management

The checkbox system intelligently adapts based on context:

### Individual Mode
- Each checkbox manages its own boolean state
- Use `wire:model` directly on the checkbox
- Perfect for independent settings and toggles

### Group Mode  
- Group manages a shared array of selected values
- Use `wire:model` only on the group wrapper
- Individual checkboxes provide their `value` to the array
- Perfect for multi-select scenarios

```blade
<!-- INDIVIDUAL MODE: Separate boolean states -->
<x-ui.checkbox wire:model="terms" label="Accept terms" />
<x-ui.checkbox wire:model="privacy" label="Accept privacy policy" />
<x-ui.checkbox wire:model="newsletter" label="Subscribe to newsletter" />

<!-- GROUP MODE: Single array state -->
<x-ui.checkbox.group wire:model="preferences">
    <x-ui.checkbox value="email" label="Email notifications" />
    <x-ui.checkbox value="sms" label="SMS notifications" />
    <x-ui.checkbox value="push" label="Push notifications" />
</x-ui.checkbox.group>
```

## Checkbox States

### Basic States

@blade
<x-demo >
    <div
        x-data="{ basic: false, checked: true, indeterminate: false }"
        class="flex flex-col gap-y-4 mx-auto w-fit"
    >
        <x-ui.checkbox 
            x-model="basic"
            label="Unchecked checkbox"
        />
        <x-ui.checkbox 
            x-model="checked"
            label="Checked checkbox"
        />
        <x-ui.checkbox 
            x-model="indeterminate"
            label="Indeterminate checkbox"
            indeterminate
        />
    </div>
</x-demo>
@endblade

```blade
<x-ui.checkbox wire:model="basic" label="Basic checkbox" />
<x-ui.checkbox wire:model="checked" label="Already checked" checked />
<x-ui.checkbox wire:model="partial" label="Partially selected" indeterminate />
```

### Disabled State

@blade
<x-demo>
    <div class="flex flex-col gap-y-4 mx-auto w-fit">
        <x-ui.checkbox 
            label="Disabled unchecked"
            disabled
        />
        <x-ui.checkbox 
            label="Disabled checked"
            checked
            disabled
        />
        <x-ui.checkbox 
            label="Disabled indeterminate"
            indeterminate
            disabled
        />
    </div>
</x-demo>
@endblade

```blade
<x-ui.checkbox 
    wire:model="disabled"
    label="Cannot change this"
    disabled
/>
```

### Invalid State

@blade
<x-demo>
    <div class="flex flex-col gap-y-4 mx-auto w-fit">
        <x-ui.checkbox 
            label="Disabled unchecked"
            invalid
        />
        <x-ui.checkbox 
            label="Disabled checked"
            checked
            invalid
        />
        <x-ui.checkbox 
            label="Disabled indeterminate"
            indeterminate
            invalid
        />
    </div>
</x-demo>
@endblade

```blade
<x-ui.checkbox 
    wire:model="disabled"
    label="Cannot change this"
    invalid
/>
```

## Sizes

The checkbox component supports multiple sizes to match your design needs:

@blade
<x-demo>
    <div class="flex flex-col gap-y-4 mx-auto w-fit">
        <x-ui.checkbox size="xs" label="Extra small checkbox" />
        <x-ui.checkbox size="sm" label="Small checkbox" />
        <x-ui.checkbox size="md" label="Medium checkbox (default)" />
        <x-ui.checkbox size="lg" label="Large checkbox" />
    </div>
</x-demo>
@endblade

```blade
<x-ui.checkbox size="xs" label="Extra small" />
<x-ui.checkbox size="sm" label="Small" />
<x-ui.checkbox size="md" label="Medium (default)" />
<x-ui.checkbox size="lg" label="Large" />
```

## Group Variants

Different layout styles for checkbox groups:

### Default Variant

Smart vertical spacing with content-aware gaps:

@blade
<x-demo>
    <div class="flex flex-col gap-y-4 mx-auto w-fit">
        <x-ui.checkbox.group>
            <x-ui.checkbox 
                label="Email notifications"
                description="Receive important updates via email"
                checked
            />
            <x-ui.checkbox 
                label="SMS notifications"
                description="Get instant alerts on your phone"
            />
            <x-ui.checkbox 
                label="Push notifications"
                checked
            />
        </x-ui.checkbox.group>
    </div>
</x-demo>
@endblade

```blade
<x-ui.checkbox.group wire:model="notifications">
    <x-ui.checkbox 
        value="email" 
        label="Email notifications"
        description="Receive important updates via email"
    />
    <x-ui.checkbox value="sms" label="SMS notifications" />
    <x-ui.checkbox value="push" label="Push notifications" />
</x-ui.checkbox.group>
```

### Pills Variant

Horizontal layout with wrapping, perfect for tags and skills:

@blade
<x-demo>
    <div class="flex flex-col gap-y-4 mx-auto w-fit">
        <x-ui.checkbox.group variant="pills">
            <x-ui.checkbox label="Laravel" value="laravel" checked />
            <x-ui.checkbox label="PHP" value="php" />
            <x-ui.checkbox label="Alpine.js" value="alpinejs" checked />
            <x-ui.checkbox label="Livewire" value="livewire" />
            <x-ui.checkbox label="Vue.js" value="vuejs" checked />
            <x-ui.checkbox label="React" value="react" />
            <x-ui.checkbox label="Tailwind CSS" value="tailwind" checked />
            <x-ui.checkbox label="MySQL" value="mysql" />
        </x-ui.checkbox.group>
    </div>
</x-demo>
@endblade

```blade
<x-ui.checkbox.group wire:model="skills" variant="pills">
    <x-ui.checkbox label="Laravel" value="laravel" />
    <x-ui.checkbox label="Vue.js" value="vuejs" />
    <x-ui.checkbox label="React" value="react" />
    <x-ui.checkbox label="Tailwind CSS" value="tailwind" />
</x-ui.checkbox.group>
```

### Cards Variant

Full card-like components with enhanced spacing and hover effects:

@blade
<x-demo>
    <div class=" max-w-md flex flex-col gap-y-4 mx-auto w-fit">
        <x-ui.checkbox.group variant="cards">
            <x-ui.checkbox 
                label="Advanced Analytics Dashboard"
                description="Get detailed insights with custom reports, real-time metrics, and data visualization tools."
                value="analytics"
                checked
            />
            <x-ui.checkbox 
                label="API Access & Webhooks"
                description="Full REST API access with rate limiting, webhook support, and comprehensive documentation."
                value="api"
            />
            <x-ui.checkbox 
                label="Priority Support"
                description="24/7 priority support with dedicated account manager and faster response times."
                value="support"
                checked
            />
        </x-ui.checkbox.group>
    </div>
</x-demo>
@endblade

```blade
<x-ui.checkbox.group wire:model="features" variant="cards">
    <x-ui.checkbox 
        value="analytics"
        label="Advanced Analytics Dashboard"
        description="Get detailed insights with custom reports and real-time metrics."
    />
    <x-ui.checkbox 
        value="api"
        label="API Access & Webhooks"
        description="Full REST API access with webhook support."
    />
</x-ui.checkbox.group>
```

## Form Integration

### With Field Component

Use the field component for proper form structure:

@blade
<x-demo>
    <x-ui.field class="max-w-md mx-auto">
        <x-ui.label>Newsletter Subscription</x-ui.label>
        <x-ui.description>Receive updates about new features and product announcements</x-ui.description>
        <x-ui.checkbox 
            wire:model="newsletter"
            label="Yes, I want to receive the newsletter"
        />
    </x-ui.field>
</x-demo>
@endblade

```blade
<x-ui.field>
    <x-ui.label>Newsletter Subscription</x-ui.label>
    <x-ui.description>Receive updates about new features and announcements</x-ui.description>
    <x-ui.checkbox 
        wire:model="newsletter"
        label="Yes, I want to receive the newsletter"
    />
    <x-ui.error name="newsletter" />
</x-ui.field>
```

### Validation States

The checkbox automatically detects validation errors when used with Livewire:

@blade
<x-demo>
    <x-ui.field class="max-w-md mx-auto">
        <x-ui.label>Terms and Conditions</x-ui.label>
        <x-ui.checkbox 
            wire:model="terms"
            label="I agree to the terms and conditions"
            invalid
        />
        <x-ui.error :messages="['You must accept the terms and conditions to continue']" />
    </x-ui.field>
</x-demo>
@endblade

```blade
<x-ui.field>
    <x-ui.label>Terms and Conditions</x-ui.label>
    <x-ui.checkbox 
        wire:model="terms"
        label="I agree to the terms and conditions"
    />
    <x-ui.error name="terms" />
</x-ui.field>
```

## Component Props

### Checkbox Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `name` | string | - | Input name attribute for form submission |
| `label` | string | - | Label text displayed next to checkbox |
| `description` | string | - | Description text below the label |
| `value` | string | - | Value sent when checkbox is checked (required for groups) |
| `checked` | boolean | `false` | Whether checkbox is initially checked |
| `indeterminate` | boolean | `false` | Whether checkbox is in indeterminate state |
| `disabled` | boolean | `false` | Whether checkbox is disabled |
| `invalid` | boolean | `false` | Whether checkbox has validation errors |
| `size` | string | `'md'` | Size variant: `xs`, `sm`, `md`, `lg` |
| `variant` | string | `'default'` | Style variant: `default`, `pills`, `cards` |
| `wire:model.*` `x-model.*` | mixed | `no-state-bounded` | to manage the state  |

### Checkbox Group Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `variant` | string | `'default'` | Layout variant: `default`, `pills`, `cards` |
| `wire:model.*` `x-model.*` | mixed | `no-state-bounded` | to manage the state  |

