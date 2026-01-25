---
name: kbd
---

## Introduction

The `Kbd` component is a visual representation of keyboard keys, styled to mimic physical keyboard buttons. It's designed to display keyboard shortcuts in documentation, tooltips, and UI hints, making it immediately clear to users which keys to press.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `kbd` component easily:

```bash
php artisan sheaf:install kbd
```

> Once installed, you can use the <x-ui.kbd /> component in any Blade view.

## Usage

### Basic Keyboard Key

Display a single keyboard key with default styling.

@blade
<x-demo class="flex justify-center">
    <x-ui.kbd>K</x-ui.kbd>
</x-demo>
@endblade

```html
<x-ui.kbd>K</x-ui.kbd>
```

### Keyboard Shortcuts

Display multiple keys as a shortcut combination using the `keys` prop.

@blade
<x-demo class="flex justify-center">
    <div class="flex flex-wrap items-center gap-4">
        <x-ui.kbd keys="Ctrl+K" />
        <x-ui.kbd keys="Cmd+Shift+P" />
        <x-ui.kbd keys="Alt+F4" />
    </div>
</x-demo>
@endblade

```html
<x-ui.kbd keys="Ctrl+K" />
<x-ui.kbd keys="Cmd+Shift+P" />
<x-ui.kbd keys="Alt+F4" />
```

### Custom Separator

Change the separator between keys using the `separator` prop.

@blade
<x-demo class="flex justify-center">
    <div class="flex flex-wrap items-center gap-4">
        <x-ui.kbd keys="Ctrl or Cmd" separator=" or " />
        <x-ui.kbd keys="Ctrl|Alt|Delete" separator="|" />
    </div>
</x-demo>
@endblade

```html
<!-- Space separator -->
<x-ui.kbd keys="Ctrl or Cmd" separator=" or " />

<!-- Pipe separator -->
<x-ui.kbd keys="Ctrl|Alt|Delete" separator="|" />
```

## Component Props Reference

### Kbd Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `keys` | `string` | `null` | Keyboard shortcut string that will be split by separator (e.g., `"Ctrl+K"`) |
| `separator` | `string` | `'+'` | Character or string used to split the `keys` prop into individual keys |

### Slot Content

When the `keys` prop is not provided, the component will render whatever content is passed to its default slot:

```html
<!-- Using slot content -->
<x-ui.kbd>Custom Content</x-ui.kbd>
```
