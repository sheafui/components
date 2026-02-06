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


then add this css to your `app.css`:
```css
@keyframes wave {
    0% {
        transform: translateX(0%);
    }

    100% {
        transform: translateX(200%);
    }
}
```
> Once installed, you can use the `<x-ui.skeleton />` and `<x-ui.skeleton.text />` components in any Blade view.

## Usage

@blade
<x-demo class="flex justify-center">
    <div class="w-xl space-y-4">
        <x-ui.skeleton class="h-8 w-40" />
        <x-ui.skeleton class="h-4 w-full" />
        <x-ui.skeleton class="h-4 w-5/6" />
        <x-ui.skeleton class="h-4 w-4/6" />
    </div>
</x-demo>
@endblade

### Basic Skeleton

The most basic usage is a simple placeholder with custom dimensions:

```blade
<x-ui.skeleton class="h-8 w-40" />
<x-ui.skeleton class="h-4 w-full" />
<x-ui.skeleton class="size-12 rounded-full" />
```

## Animation Variants

Choose from different animation styles to match your design preference:

@blade
<x-demo class="flex justify-center">
    <div class=" mx-auto space-y-6">
        <div class="space-y-2">
            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Pulse </p>
            <x-ui.skeleton animate="pulse" class="h-8 w-80" />
        </div>
        <div class="space-y-2">
            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Wave</p>
            <x-ui.skeleton animate="wave" class="h-8 w-80" />
        </div>
        <div class="space-y-2">
            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Glow (wave + pulse)</p>
            <x-ui.skeleton animate="glow" class="h-8 w-80" />
        </div>
        <div class="space-y-2">
            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">None</p>
            <x-ui.skeleton animate="none" class="h-8 w-80" />
        </div>
    </div>
</x-demo>
@endblade

```blade
<!-- Pulse animation  -->
<x-ui.skeleton animate="pulse" class="h-8 w-80" />

<!-- Wave animation -->
<x-ui.skeleton animate="wave" class="h-8 w-80" />

<!-- Glow animation (default) -->
<x-ui.skeleton animate="glow" class="h-8 w-80" />

<!-- No animation -->
<x-ui.skeleton animate="none" class="h-8 w-80" />
```

## Animation Speed

@blade
<x-demo class="flex justify-center">
    <div class="w-full max-w-md space-y-6">
        <div class="space-y-2">
            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Slow </p>
            <x-ui.skeleton speed="slow"  class="h-10 w-80" />
        </div>
        <div class="space-y-2">
            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Normal</p>
        <x-ui.skeleton speed="normal" class="h-10 w-80" />
        </div>
        <div class="space-y-2">
            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Dast</p>
          <x-ui.skeleton speed="fast" class="h-10 w-80" />
        </div>
    </div>
</x-demo>
@endblade

```blade
<!-- slow animation  -->
<x-ui.skeleton speed="slow" speed class="h-10 w-80" />

<!-- normal animation (default) -->
<x-ui.skeleton speed="normal" class="h-10 w-80" />

<!-- fast animation -->
<x-ui.skeleton speed="fast" class="h-10 w-80" />
```

## Text Skeleton

Use the `skeleton.text` component for text line placeholders with predefined heights:

@blade
<x-demo class="flex justify-center">
    <div class="w-3xl space-y-4 " >
        <div class="space-y-2">
            <x-ui.skeleton.text size="sm"  />
        </div>
        <div class="space-y-2">
            <x-ui.skeleton.text size="base" />
        </div>
        <div class="space-y-2">
            <x-ui.skeleton.text size="lg" />
        </div>
        <div class="space-y-2">
            <x-ui.skeleton.text size="xl" />
        </div>
    </div>
</x-demo>
@endblade

```blade
<!-- Small text -->
<x-ui.skeleton.text size="sm" />

<!-- Base text (default) -->
<x-ui.skeleton.text />

<!-- Large text -->
<x-ui.skeleton.text size="lg" />

<!-- Extra large text -->
<x-ui.skeleton.text size="xl" />
```

## Examples


### Card Skeleton

Create complex loading states by combining skeleton components:

@blade
<x-demo class="flex justify-center">
    <div class="w-full max-w-2xl rounded-box border border-neutral-200 dark:border-neutral-800 p-4 space-y-4">
        <div class="flex items-center gap-3">
            <x-ui.skeleton class="size-10 rounded-full" />
            <div class="flex-1 space-y-2">
                <x-ui.skeleton.text class="w-40" />
                <x-ui.skeleton.text size="sm" class="w-24" />
            </div>
        </div>
        <div class="space-y-2">
            <x-ui.skeleton.text />
            <x-ui.skeleton.text class="w-5/6" />
        </div>
        <x-ui.skeleton class="h-48 w-full rounded-box" />
        <div class="flex gap-4 pt-2">
            <x-ui.skeleton class="h-8 w-25 rounded-box" />
            <x-ui.skeleton class="h-8 w-25 rounded-box" />
        </div>
    </div>
</x-demo>
@endblade

```blade
<div class="rounded-box border border-neutral-200 dark:border-neutral-800 p-4 space-y-4">
    <!-- Header -->
    <div class="flex items-center gap-3">
        <x-ui.skeleton class="size-10 rounded-full" />
        <div class="flex-1 space-y-2">
            <x-ui.skeleton.text class="w-32" />
            <x-ui.skeleton.text size="sm" class="w-24" />
        </div>
    </div>
    
    <!-- Content -->
    <div class="space-y-2">
        <x-ui.skeleton.text />
        <x-ui.skeleton.text class="w-5/6" />
    </div>
    
    <!-- Image -->
    <x-ui.skeleton class="h-48 w-full rounded-box" />
    
    <!-- Actions -->
    <div class="flex gap-4 pt-2">
        <x-ui.skeleton class="h-8 w-20 rounded-box" />
        <x-ui.skeleton class="h-8 w-20 rounded-box" />
    </div>
</div>
```
### Grid Skeleton

For card grids and gallery layouts:

@blade
<x-demo class="flex justify-center">
    <div class="w-4xl grid grid-cols-3 gap-4">
        @foreach(range(1, 6) as $i)
            <div class="space-y-3">
                <x-ui.skeleton class="h-32 w-full rounded-box" />
                <x-ui.skeleton.text class="w-3/4" />
                <x-ui.skeleton.text size="sm" />
            </div>
        @endforeach
    </div>
</x-demo>
@endblade

```blade
<div class="grid grid-cols-3 gap-4">
    @foreach(range(1, 6) as $i)
        <div class="space-y-3">
            <x-ui.skeleton class="h-48 w-full rounded-box" />
            <x-ui.skeleton.text class="w-3/4" />
            <x-ui.skeleton.text size="sm" />
        </div>
    @endforeach
</div>
```

### Table Skeleton

Use with tables and data grids:

@blade
<x-demo class="flex justify-center">
    <div class="w-4xl max-w-4xl">
        <table class="w-full">
            <thead class="text-base font-normalt">
                <tr>
                <th>#</th>
                <th>Number</th>
                <th>Status</th>
                <th>Punishments</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-800">
                @foreach(range(1, 5) as $i)
                    <tr>
                        <td class="px-4 py-3"><x-ui.skeleton.text /></td>
                        <td class="px-4 py-3"><x-ui.skeleton.text /></td>
                        <td class="px-4 py-3"><x-ui.skeleton.text /></td>
                        <td class="px-4 py-3"><x-ui.skeleton.text /></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-demo>
@endblade

```blade
<table class="w-full">
     <thead class="text-base font-normalt">
        <tr>
            <th>#</th>
            <th>Number</th>
            <th>Status</th>
            <th>Punishments</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-neutral-200 dark:divide-neutral-800">
        @foreach(range(1, 5) as $i)
            <tr>
                <td class="px-4 py-3"><x-ui.skeleton.text /></td>
                <td class="px-4 py-3"><x-ui.skeleton.text /></td>
                <td class="px-4 py-3"><x-ui.skeleton.text /></td>
                <td class="px-4 py-3"><x-ui.skeleton.text /></td>
            </tr>
        @endforeach
    </tbody>
</table>
```


## Component Props

#### ui.skeleton

| Prop Name  | Type   | Default  | Required | Description                                              |
| ---------- | ------ | -------- | -------- | -------------------------------------------------------- |
| `animate`  | string | `'glow'` | No       | Animation style: `'pulse'`, `'wave'`, `'glow'`, `'none'` |

#### ui.skeleton.text

| Prop Name  | Type   | Default   | Required | Description                                              |
| ---------- | ------ | --------- | -------- | -------------------------------------------------------- |
| `animate`  | string | `'glow'`  | No       | Animation style: `'pulse'`, `'wave'`, `'glow'`, `'none'` |
| `size`     | string | `'base'`  | No       | Text size: `'sm'`, `'base'`, `'lg'`, `'xl'`              |
