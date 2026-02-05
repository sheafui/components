---
name: 'textarea'
---

# Textarea Component

## Introduction

The `textarea` component provides a fully featured multi-line text input with automatic resizing, validation states, and modern styling. It saves you from creating complex textarea elements each time you need one.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `textarea` component easily:

```bash
php artisan sheaf:install textarea
```

## Basic Usage

@blade
<x-demo>
    <x-ui.textarea 
        class="max-w-sm mx-auto"
        wire:model="description" 
        placeholder="Enter your description..."
    />
</x-demo>
@endblade

```html
<x-ui.textarea 
    wire:model="description" 
    placeholder="Enter your description..."
/>
```

## Customization

### Rows

The textarea component uses `3` rows as the default, but you can adjust the initial size to meet your needs.

@blade
<x-demo>
    <div class="max-w-md mx-auto w-full space-y-4">
        <x-ui.textarea 
            wire:model="smallText" 
            placeholder="Small textarea"
            rows="2"
        />
        <x-ui.textarea 
            wire:model="defaultText" 
            placeholder="Default size (3 rows)"
        />
        <x-ui.textarea 
            wire:model="largeText" 
            placeholder="Large textarea"
            rows="6"
        />
    </div>
</x-demo>
@endblade

```html
<x-ui.textarea 
    wire:model="smallText" 
    placeholder="Small textarea"
    rows="2"
/>
<x-ui.textarea 
    wire:model="defaultText" 
    placeholder="Default size (3 rows)"
/>
<x-ui.textarea 
    wire:model="largeText" 
    placeholder="Large textarea"
    rows="6"
/>
```

### Resize Options

Control how users can resize the textarea. The default behavior is `vertical` resizing.

@blade
<x-demo>
    <div class="max-w-md mx-auto w-full space-y-4">
        <x-ui.textarea 
            wire:model="noResize" 
            placeholder="No resizing allowed"
            resize="none"
        />
        <x-ui.textarea 
            wire:model="verticalResize" 
            placeholder="Vertical resizing (default)"
            resize="vertical"
        />
        <x-ui.textarea 
            wire:model="horizontalResize" 
            placeholder="Horizontal resizing"
            resize="horizontal"
        />
        <x-ui.textarea 
            wire:model="bothResize" 
            placeholder="Both directions"
            resize="both"
        />
    </div>
</x-demo>
@endblade

```html
<x-ui.textarea 
    wire:model="noResize" 
    placeholder="No resizing allowed"
    resize="none"
/>
<x-ui.textarea 
    wire:model="verticalResize" 
    placeholder="Vertical resizing (default)"
    resize="vertical"
/>
<x-ui.textarea 
    wire:model="horizontalResize" 
    placeholder="Horizontal resizing"
    resize="horizontal"
/>
<x-ui.textarea 
    wire:model="bothResize" 
    placeholder="Both directions"
    resize="both"
/>
```

### States

The component supports different states including disabled and validation states.

@blade
<x-demo>
    <div class="flex gap-2 ">
        <x-ui.textarea 
            wire:model="normalState" 
            placeholder="Normal state"
        />
        <x-ui.textarea 
            wire:model="disabledState" 
            placeholder="Disabled state"
            disabled
        />
        <x-ui.textarea 
            wire:model="invalidState" 
            placeholder="Invalid state"
            invalid
        />
    </div>
</x-demo>
@endblade

```html
<x-ui.textarea 
    wire:model="normalState" 
    placeholder="Normal state"
/>
<x-ui.textarea 
    wire:model="disabledState" 
    placeholder="Disabled state"
    disabled
/>
<x-ui.textarea 
    wire:model="invalidState" 
    placeholder="Invalid state"
    invalid
/>
```

## Auto-Resizing

The textarea automatically adjusts its height to fit the content as you type, providing a smooth user experience.

> we use javascript for this feature, so it work in all browsers 

@blade
<x-demo>
    <x-ui.textarea 
        class="max-w-md mx-auto "
        wire:model="autoResizeText" 
        placeholder="Start typing to see the auto-resize in action..."
        rows="3"
    />
</x-demo>
@endblade

```html
<x-ui.textarea 
    wire:model="autoResizeText" 
    placeholder="Start typing to see the auto-resize in action..."
    rows="3"
/>
```

<!-- ## Value Persistence

Keep user input even after page refreshes by enabling persistence.

@blade
<x-demo>
    <x-ui.textarea 
        wire:model="draftContent" 
        placeholder="This content will persist across page reloads"
        persist="true"
    />
    <x-ui.textarea 
        wire:model="customKeyContent" 
        placeholder="Custom persistence key"
        persist="my-custom-key"
    />
</x-demo>
@endblade

```html
<x-ui.textarea 
    wire:model="draftContent" 
    placeholder="This content will persist across page reloads"
    persist="true"
/>
<x-ui.textarea 
    wire:model="customKeyContent" 
    placeholder="Custom persistence key"
    persist="my-custom-key"
/> -->
<!-- ``` -->

## Component Props

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `wire:model` | string | - | Yes | Livewire property to bind to |
| `rows` | integer | `3` | No | Initial number of rows |
| `resize` | string | `vertical` | No | Resize behavior: `none`, `vertical`, `horizontal`, `both` |
| `disabled` | boolean | `false` | No | Whether the textarea is disabled |
| `invalid` | boolean | `null` | No | Whether to show validation error state |
| `persist` | string/boolean | `null` | No | Enable value persistence with optional custom key |
| `placeholder` | string | `''` | No | Placeholder text |
| `class` | string | `''` | No | Additional CSS classes to apply |