---
name: badge
---

## Introduction

The `Badge` component is a versatile labeling component designed to highlight status, categories, or other important metadata. It provides multiple visual variants, extensive color options, and flexible icon support for creating informative and visually appealing badges.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `badge` component easily:

```bash
php artisan sheaf:install badge
```

> Once installed, you can use the <x-ui.badge /> component in any Blade view.

## Usage

### Basic Badge Variants

The badge component supports two main visual variants with different corner radius styles.

@blade
<x-demo class="flex justify-center">
    <div class="flex flex-wrap items-center justify-center gap-4">
        <x-components::ui.badge>Default Badge</x-components::ui.badge>
        <x-components::ui.badge pill>Pill Badge</x-components::ui.badge>
    </div>
</x-demo>
@endblade

```blade
<!-- Default rounded badge -->
<x-ui.badge>Default Badge</x-ui.badge>

<!-- Pill-shaped badge -->
<x-ui.badge pill>Pill Badge</x-ui.badge>
```

### Badge Sizes

Choose from three different sizes to match your design hierarchy and context.

@blade
<x-demo class="flex justify-center">
    <div class="flex flex-wrap items-center justify-center gap-4">
        <x-components::ui.badge size="sm">Small Badge</x-components::ui.badge>
        <x-components::ui.badge>Default Badge</x-components::ui.badge>
        <x-components::ui.badge size="lg">Large Badge</x-components::ui.badge>
    </div>
</x-demo>
@endblade

```blade
<!-- Small badge -->
<x-ui.badge size="sm">Small Badge</x-ui.badge>

<!-- Default size badge -->
<x-ui.badge>Default Badge</x-ui.badge>

<!-- Large badge -->
<x-ui.badge size="lg">Large Badge</x-ui.badge>
```

### Color Variants - Solid Style (Default)

The solid style provides bold, high-contrast badges with white text on colored backgrounds.

@blade
<x-demo class="flex justify-center">
    <div class="grid grid-cols-4 lg:grid-cols-6 gap-2">
        <x-components::ui.badge>Default</x-components::ui.badge>
        <x-components::ui.badge color="red">Red</x-components::ui.badge>
        <x-components::ui.badge color="orange">Orange</x-components::ui.badge>
        <x-components::ui.badge color="amber">Amber</x-components::ui.badge>
        <x-components::ui.badge color="yellow">Yellow</x-components::ui.badge>
        <x-components::ui.badge color="lime">Lime</x-components::ui.badge>
        <x-components::ui.badge color="green">Green</x-components::ui.badge>
        <x-components::ui.badge color="emerald">Emerald</x-components::ui.badge>
        <x-components::ui.badge color="teal">Teal</x-components::ui.badge>
        <x-components::ui.badge color="cyan">Cyan</x-components::ui.badge>
        <x-components::ui.badge color="sky">Sky</x-components::ui.badge>
        <x-components::ui.badge color="blue">Blue</x-components::ui.badge>
        <x-components::ui.badge color="indigo">Indigo</x-components::ui.badge>
        <x-components::ui.badge color="violet">Violet</x-components::ui.badge>
        <x-components::ui.badge color="purple">Purple</x-components::ui.badge>
        <x-components::ui.badge color="fuchsia">Fuchsia</x-components::ui.badge>
        <x-components::ui.badge color="pink">Pink</x-components::ui.badge>
        <x-components::ui.badge color="rose">Rose</x-components::ui.badge>
    </div>
</x-demo>
@endblade

```blade
<!-- Solid style badges (default) -->
<x-ui.badge>Default</x-ui.badge>
<x-ui.badge color="red">Red</x-ui.badge>
<x-ui.badge color="green">Green</x-ui.badge>
<x-ui.badge color="blue">Blue</x-ui.badge>
<x-ui.badge color="purple">Purple</x-ui.badge>
```

### Color Variants - Outline Style

The outline style provides colored text and border.

@blade
<x-demo class="flex justify-center">
    <div class="grid grid-cols-4 lg:grid-cols-6 gap-2">
        <x-components::ui.badge variant="outline">Default</x-components::ui.badge>
        <x-components::ui.badge variant="outline" color="red">Red</x-components::ui.badge>
        <x-components::ui.badge variant="outline" color="orange">Orange</x-components::ui.badge>
        <x-components::ui.badge variant="outline" color="amber">Amber</x-components::ui.badge>
        <x-components::ui.badge variant="outline" color="yellow">Yellow</x-components::ui.badge>
        <x-components::ui.badge variant="outline" color="lime">Lime</x-components::ui.badge>
        <x-components::ui.badge variant="outline" color="green">Green</x-components::ui.badge>
        <x-components::ui.badge variant="outline" color="emerald">Emerald</x-components::ui.badge>
        <x-components::ui.badge variant="outline" color="teal">Teal</x-components::ui.badge>
        <x-components::ui.badge variant="outline" color="cyan">Cyan</x-components::ui.badge>
        <x-components::ui.badge variant="outline" color="sky">Sky</x-components::ui.badge>
        <x-components::ui.badge variant="outline" color="blue">Blue</x-components::ui.badge>
        <x-components::ui.badge variant="outline" color="indigo">Indigo</x-components::ui.badge>
        <x-components::ui.badge variant="outline" color="violet">Violet</x-components::ui.badge>
        <x-components::ui.badge variant="outline" color="purple">Purple</x-components::ui.badge>
        <x-components::ui.badge variant="outline" color="fuchsia">Fuchsia</x-components::ui.badge>
        <x-components::ui.badge variant="outline" color="pink">Pink</x-components::ui.badge>
        <x-components::ui.badge variant="outline" color="rose">Rose</x-components::ui.badge>
    </div>
</x-demo>
@endblade

```blade
<!-- Outline style badges -->
<x-ui.badge variant="outline">Default</x-ui.badge>
<x-ui.badge variant="outline" color="red">Red</x-ui.badge>
<x-ui.badge variant="outline" color="green">Green</x-ui.badge>
<x-ui.badge variant="outline" color="blue">Blue</x-ui.badge>
<x-ui.badge variant="outline" color="purple">Purple</x-ui.badge>
```

### Badges with Icons

Add leading icons to provide visual context and improve recognition.

@blade
<x-demo class="flex justify-center">
    <div class="flex flex-wrap items-center gap-4">
        <x-components::ui.badge icon="check-circle" color="green">Completed</x-components::ui.badge>
        <x-components::ui.badge icon="clock" color="amber">Pending</x-components::ui.badge>
        <x-components::ui.badge icon="x-circle" color="red">Failed</x-components::ui.badge>
        <x-components::ui.badge icon="star" color="yellow" variant="outline">Featured</x-components::ui.badge>
    </div>
</x-demo>
@endblade

```blade
<!-- Badges with leading icons -->
<x-ui.badge icon="check-circle" color="green">Completed</x-ui.badge>
<x-ui.badge icon="clock" color="amber">Pending</x-ui.badge>
<x-ui.badge icon="x-circle" color="red">Failed</x-ui.badge>
<x-ui.badge icon="star" color="yellow" variant="outline">Featured</x-ui.badge>
```

### Badges with Trailing Icons

Use trailing icons for actions like removal or additional information.

@blade
<x-demo class="flex justify-center">
    <div class="flex flex-wrap items-center gap-4">
        <x-components::ui.badge iconAfter="x-mark" color="blue">JavaScript</x-components::ui.badge>
        <x-components::ui.badge iconAfter="chevron-down" color="purple">More Options</x-components::ui.badge>
        <x-components::ui.badge icon="tag" iconAfter="x-mark" color="green" pill variant="outline">Design</x-components::ui.badge>
    </div>
</x-demo>
@endblade

```blade
<!-- Badges with trailing icons -->
<x-ui.badge iconAfter="x-mark" color="blue">JavaScript</x-ui.badge>
<x-ui.badge iconAfter="chevron-down" color="purple">More Options</x-ui.badge>

<!-- Badge with both leading and trailing icons -->
<x-ui.badge icon="tag" iconAfter="x-mark" color="green" variant="outline" pill>Design</x-ui.badge>
```

### Icon Variants

Control the icon style using the `iconVariant` prop, supporting both micro and outline styles.

@blade
<x-demo class="flex justify-center">
    <div class="flex flex-wrap items-center gap-4">
        <x-components::ui.badge icon="heart" iconVariant="micro" color="red">Micro Icon</x-components::ui.badge>
        <x-components::ui.badge icon="heart" iconVariant="outline" color="red">Outline Icon</x-components::ui.badge>
    </div>
</x-demo>
@endblade

```blade
<!-- Micro icon variant (default) -->
<x-ui.badge icon="heart" iconVariant="micro" color="red">Micro Icon</x-ui.badge>

<!-- Outline icon variant -->
<x-ui.badge icon="heart" iconVariant="outline" color="red">Outline Icon</x-ui.badge>
```

### Interactive Badges

Badges can function as buttons with hover states when appropriate attributes are applied.

@blade
<x-demo class="flex justify-center">
    <div class="flex flex-wrap items-center gap-4">
        <x-components::ui.badge onclick="alert('Badge clicked!')" color="blue" class="cursor-pointer">Clickable Badge</x-components::ui.badge>
        <x-components::ui.badge onclick="alert('Remove tag')" icon="tag" iconAfter="x-mark" color="green" pill class="cursor-pointer">Remove Tag</x-components::ui.badge>
    </div>
</x-demo>
@endblade

```blade
<!-- Interactive badges with hover effects -->
<x-ui.badge onclick="alert('Badge clicked!')" color="blue" class="cursor-pointer">
    Clickable Badge
</x-ui.badge>

<x-ui.badge onclick="alert('Remove tag')" icon="tag" iconAfter="x-mark" color="green" pill class="cursor-pointer">
    Remove Tag
</x-ui.badge>
```

### Status Badge Examples

Common usage patterns for status indicators and labels.

@blade
<x-demo class="flex justify-center">
    <div class="space-y-4">
        <div class="flex flex-wrap items-center gap-2">
            <span class="text-sm font-medium">Order Status:</span>
            <x-components::ui.badge icon="truck" color="blue" variant="outline">Shipped</x-components::ui.badge>
        </div>
        
        <div class="flex flex-wrap items-center gap-2">
            <span class="text-sm font-medium">Priority:</span>
            <x-components::ui.badge color="red" size="sm">High</x-components::ui.badge>
            <x-components::ui.badge color="amber" size="sm">Medium</x-components::ui.badge>
            <x-components::ui.badge color="green" size="sm">Low</x-components::ui.badge>
        </div>
        
        <div class="flex flex-wrap items-center gap-2">
            <span class="text-sm font-medium">Tags:</span>
            <x-components::ui.badge pill iconAfter="x-mark" color="purple">React</x-components::ui.badge>
            <x-components::ui.badge pill iconAfter="x-mark" color="blue">TypeScript</x-components::ui.badge>
            <x-components::ui.badge pill iconAfter="x-mark" color="green">Tailwind</x-components::ui.badge>
        </div>
    </div>
</x-demo>
@endblade

```blade
<!-- Status indicators -->
<div class="flex items-center gap-2">
    <span class="text-sm font-medium">Order Status:</span>
    <x-ui.badge icon="truck" color="blue" variant="outline">Shipped</x-ui.badge>
</div>

<!-- Priority levels -->
<div class="flex items-center gap-2">
    <span class="text-sm font-medium">Priority:</span>
    <x-ui.badge color="red" size="sm">High</x-ui.badge>
    <x-ui.badge color="amber" size="sm">Medium</x-ui.badge>
    <x-ui.badge color="green" size="sm">Low</x-ui.badge>
</div>

<!-- Removable tags -->
<div class="flex items-center gap-2">
    <span class="text-sm font-medium">Tags:</span>
    <x-ui.badge pill iconAfter="x-mark" color="purple">React</x-ui.badge>
    <x-ui.badge pill iconAfter="x-mark" color="blue">TypeScript</x-ui.badge>
    <x-ui.badge pill iconAfter="x-mark" color="green">Tailwind</x-ui.badge>
</div>
```

## Component Props 

### ui.badge

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `variant` | `string` | `solid` | Visual variant: `'solid'` for fully solid, `outline` for outline style |
| `color` | `string` | `null` | Color theme: `'red'`, `'green'`, `'blue'`, `'purple'`, `'amber'`, `'yellow'`, `'lime'`, `'emerald'`, `'teal'`, `'cyan'`, `'sky'`, `'indigo'`, `'violet'`, `'fuchsia'`, `'pink'`, `'rose'`, `'orange'` |
| `size` | `string` | `null` | Size variant: `'sm'`, `null` (default), `'lg'` |
| `icon` | `string\|mixed` | `null` | Leading icon name or custom icon content |
| `iconAfter` | `string\|mixed` | `null` | Trailing icon name or custom icon content |
| `iconVariant` | `string` | `'micro'` | Icon style: `'micro'`, `'outline'` |
| `pill` | `bool` | `'false'` | for full rounded: `'false'`, `'true'`, `'null'` |
