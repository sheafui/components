---
name: skeleton
---

## Introduction

The `Skeleton` component provides **loading placeholders** that mimic the structure of your content while data is being fetched. It offers multiple animation styles and a flexible API for creating custom loading states that match your UI perfectly.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `skeleton` component easily:

```bash
php artisan sheaf:install skeleton
```

> Once installed, you can use the `<x-ui.skeleton />` and `<x-ui.skeleton.text />` components in any Blade view.

## Usage

@blade
<x-demo class="flex justify-center">
    <div class="w-full max-w-md space-y-4">
        <x-ui.skeleton class="h-8 w-40" />
        <x-ui.skeleton class="h-4 w-full" />
        <x-ui.skeleton class="h-4 w-5/6" />
        <x-ui.skeleton class="h-4 w-4/6" />
    </div>
</x-demo>
@endblade

### Basic Skeleton

The most basic usage is a simple placeholder with custom dimensions:

```html
<x-ui.skeleton class="h-8 w-40" />
<x-ui.skeleton class="h-4 w-full" />
<x-ui.skeleton class="size-12 rounded-full" />
```

### Animation Variants

Choose from different animation styles to match your design preference:

@blade
<x-demo class="flex justify-center">
    <div class="w-full max-w-md space-y-6">
        <div class="space-y-2">
            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Pulse (default)</p>
            <x-ui.skeleton animate="pulse" class="h-8 w-full" />
        </div>
        
        <div class="space-y-2">
            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Wave</p>
            <x-ui.skeleton animate="wave" class="h-8 w-full" />
        </div>
        
        <div class="space-y-2">
            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Glow (wave + pulse)</p>
            <x-ui.skeleton animate="glow" class="h-8 w-full" />
        </div>
        
        <div class="space-y-2">
            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">None</p>
            <x-ui.skeleton animate="none" class="h-8 w-full" />
        </div>
    </div>
</x-demo>
@endblade

```html
<!-- Pulse animation (default) -->
<x-ui.skeleton animate="pulse" class="h-8 w-40" />

<!-- Wave animation -->
<x-ui.skeleton animate="wave" class="h-8 w-40" />

<!-- Glow animation (combines wave + pulse) -->
<x-ui.skeleton animate="glow" class="h-8 w-40" />

<!-- No animation -->
<x-ui.skeleton animate="none" class="h-8 w-40" />
```

### Text Skeleton

Use the `skeleton.text` component for text line placeholders with predefined heights:

@blade
<x-demo class="flex justify-center">
    <div class="w-full max-w-md space-y-4">
        <div class="space-y-2">
            <x-ui.skeleton.text size="sm" />
            <x-ui.skeleton.text size="sm" class="w-3/4" />
        </div>
        <div class="space-y-2">
            <x-ui.skeleton.text size="base" />
            <x-ui.skeleton.text size="base" class="w-5/6" />
        </div>
        <div class="space-y-2">
            <x-ui.skeleton.text size="lg" />
            <x-ui.skeleton.text size="lg" class="w-2/3" />
        </div>
        <div class="space-y-2">
            <x-ui.skeleton.text size="xl" />
            <x-ui.skeleton.text size="xl" class="w-4/5" />
        </div>
    </div>
</x-demo>
@endblade

```html
<!-- Small text -->
<x-ui.skeleton.text size="sm" />
<x-ui.skeleton.text size="sm" class="w-3/4" />

<!-- Base text (default) -->
<x-ui.skeleton.text />
<x-ui.skeleton.text class="w-5/6" />

<!-- Large text -->
<x-ui.skeleton.text size="lg" />
<x-ui.skeleton.text size="lg" class="w-2/3" />

<!-- Extra large text -->
<x-ui.skeleton.text size="xl" />
<x-ui.skeleton.text size="xl" class="w-4/5" />
```

### Card Skeleton

Create complex loading states by combining skeleton components:

@blade
<x-demo class="flex justify-center">
    <div class="w-full max-w-md rounded-box border border-neutral-200 dark:border-neutral-800 p-4 space-y-4">
        <div class="flex items-center gap-3">
            <x-ui.skeleton animate="glow" class="size-10 rounded-full" />
            <div class="flex-1 space-y-2">
                <x-ui.skeleton.text animate="glow" class="w-32" />
                <x-ui.skeleton.text animate="glow" size="sm" class="w-24" />
            </div>
        </div>
        <div class="space-y-2">
            <x-ui.skeleton.text animate="glow" />
            <x-ui.skeleton.text animate="glow" class="w-5/6" />
        </div>
        <x-ui.skeleton animate="glow" class="h-48 w-full rounded-box" />
        <div class="flex gap-4 pt-2">
            <x-ui.skeleton animate="glow" class="h-8 w-20 rounded-box" />
            <x-ui.skeleton animate="glow" class="h-8 w-20 rounded-box" />
        </div>
    </div>
</x-demo>
@endblade

```html
<div class="rounded-box border border-neutral-200 dark:border-neutral-800 p-4 space-y-4">
    <!-- Header -->
    <div class="flex items-center gap-3">
        <x-ui.skeleton animate="glow" class="size-10 rounded-full" />
        <div class="flex-1 space-y-2">
            <x-ui.skeleton.text animate="glow" class="w-32" />
            <x-ui.skeleton.text animate="glow" size="sm" class="w-24" />
        </div>
    </div>
    
    <!-- Content -->
    <div class="space-y-2">
        <x-ui.skeleton.text animate="glow" />
        <x-ui.skeleton.text animate="glow" class="w-5/6" />
    </div>
    
    <!-- Image -->
    <x-ui.skeleton animate="glow" class="h-48 w-full rounded-box" />
    
    <!-- Actions -->
    <div class="flex gap-4 pt-2">
        <x-ui.skeleton animate="glow" class="h-8 w-20 rounded-box" />
        <x-ui.skeleton animate="glow" class="h-8 w-20 rounded-box" />
    </div>
</div>
```

### List Skeleton

Perfect for loading lists or feeds:

@blade
<x-demo class="flex justify-center">
    <div class="w-full max-w-md space-y-3">
        @foreach(range(1, 4) as $i)
            <div class="flex items-center gap-3">
                <x-ui.skeleton class="size-12 rounded-full" />
                <div class="flex-1 space-y-2">
                    <x-ui.skeleton.text class="w-1/3" />
                    <x-ui.skeleton.text size="sm" class="w-1/2" />
                </div>
            </div>
        @endforeach
    </div>
</x-demo>
@endblade

```html
<div class="space-y-3">
    @foreach(range(1, 5) as $i)
        <div class="flex items-center gap-3">
            <x-ui.skeleton class="size-12 rounded-full" />
            <div class="flex-1 space-y-2">
                <x-ui.skeleton.text class="w-1/3" />
                <x-ui.skeleton.text size="sm" class="w-1/2" />
            </div>
        </div>
    @endforeach
</div>
```

### Grid Skeleton

For card grids and gallery layouts:

@blade
<x-demo class="flex justify-center">
    <div class="w-full max-w-4xl grid grid-cols-3 gap-4">
        @foreach(range(1, 6) as $i)
            <div class="space-y-3">
                <x-ui.skeleton animate="wave" class="h-32 w-full rounded-box" />
                <x-ui.skeleton.text animate="wave" class="w-3/4" />
                <x-ui.skeleton.text animate="wave" size="sm" />
            </div>
        @endforeach
    </div>
</x-demo>
@endblade

```html
<div class="grid grid-cols-3 gap-4">
    @foreach(range(1, 6) as $i)
        <div class="space-y-3">
            <x-ui.skeleton animate="wave" class="h-48 w-full rounded-box" />
            <x-ui.skeleton.text animate="wave" class="w-3/4" />
            <x-ui.skeleton.text animate="wave" size="sm" />
        </div>
    @endforeach
</div>
```

### Table Skeleton

Use with tables and data grids:

@blade
<x-demo class="flex justify-center">
    <div class="w-full max-w-4xl">
        <table class="w-full">
            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-800">
                @foreach(range(1, 5) as $i)
                    <tr>
                        <td class="px-4 py-3"><x-ui.skeleton.text /></td>
                        <td class="px-4 py-3"><x-ui.skeleton.text /></td>
                        <td class="px-4 py-3"><x-ui.skeleton.text /></td>
                        <td class="px-4 py-3"><x-ui.skeleton.text class="w-20" /></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-demo>
@endblade

```html
<table class="w-full">
    <tbody class="divide-y divide-neutral-200 dark:divide-neutral-800">
        @foreach(range(1, 5) as $i)
            <tr>
                <td class="px-4 py-3"><x-ui.skeleton.text /></td>
                <td class="px-4 py-3"><x-ui.skeleton.text /></td>
                <td class="px-4 py-3"><x-ui.skeleton.text /></td>
                <td class="px-4 py-3"><x-ui.skeleton.text class="w-20" /></td>
            </tr>
        @endforeach
    </tbody>
</table>
```

## Conventions

### Conditional Loading with Livewire

The most common pattern is to show skeletons while loading data:

```html
@if($loading)
    <div class="space-y-3">
        @foreach(range(1, 5) as $i)
            <div class="flex items-center gap-3 p-3 rounded-box">
                <x-ui.skeleton animate="glow" class="size-12 rounded-full" />
                <div class="flex-1 space-y-2">
                    <x-ui.skeleton.text animate="glow" class="w-32" />
                    <x-ui.skeleton.text animate="glow" size="sm" class="w-48" />
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="space-y-3">
        @foreach($users as $user)
            <x-user-item :user="$user" />
        @endforeach
    </div>
@endif
```

### Matching Content Structure

For the best UX, make your skeleton match the actual content structure as closely as possible:

```html
{{-- This skeleton matches a product card --}}
<div class="rounded-box border border-neutral-200 dark:border-neutral-800 overflow-hidden">
    <x-ui.skeleton animate="wave" class="h-48 w-full" />
    <div class="p-4 space-y-3">
        <x-ui.skeleton.text animate="wave" size="lg" class="w-3/4" />
        <x-ui.skeleton.text animate="wave" size="sm" />
        <x-ui.skeleton.text animate="wave" size="sm" class="w-2/3" />
        <div class="flex items-center justify-between pt-2">
            <x-ui.skeleton.text animate="wave" class="w-20" />
            <x-ui.skeleton animate="wave" class="h-9 w-24 rounded-box" />
        </div>
    </div>
</div>
```

### Component Props

#### Skeleton Component

| Prop Name  | Type   | Default  | Required | Description                                              |
| ---------- | ------ | -------- | -------- | -------------------------------------------------------- |
| `animate`  | string | `'glow'` | No       | Animation style: `'pulse'`, `'wave'`, `'glow'`, `'none'` |

#### Skeleton Text Component

| Prop Name  | Type   | Default   | Required | Description                                              |
| ---------- | ------ | --------- | -------- | -------------------------------------------------------- |
| `animate`  | string | `'glow'`  | No       | Animation style: `'pulse'`, `'wave'`, `'glow'`, `'none'` |
| `size`     | string | `'base'`  | No       | Text size: `'sm'`, `'base'`, `'lg'`, `'xl'`              |

## Component Structure

The skeleton component consists of:

- **Base Component**: `<x-ui.skeleton>` - Generic skeleton placeholder
- **Text Component**: `<x-ui.skeleton.text>` - Text line placeholder with size variants
- **Abstract Component**: `<x-ui.skeleton.abstract>` - Internal animation logic (not for direct use)
