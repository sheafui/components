---
name: 'image-diff'
---

## Introduction

The `image-diff` component provides an interactive before/after image comparison slider. Drag the handle to reveal differences between two images - perfect for showcasing edits, transformations, or any visual changes.

## Installation
```bash
php artisan sheaf:install image-diff
```

## Basic Usage
> we're using css filters to differ images, you can use diffrent image also
@blade
<x-demo>
     <x-ui.image-diff :aspectRatio="16/9">
        <x-ui.image-diff.before class="blur-sm" src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800&q=80" alt="Blurred" />
        <x-ui.image-diff.after src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800&q=80" alt="Sharp" />
    </x-ui.image-diff>
</x-demo>
@endblade

```html
<x-ui.image-diff :aspectRatio="16/9">
    <x-ui.image-diff.before class="blur-sm" src="/before.jpg" alt="Before" />
    <x-ui.image-diff.after src="/after.jpg" alt="After" />
</x-ui.image-diff>
```

## Aspect Ratios

Control the aspect ratio to match your images.

@blade
<x-demo>
    <div class="space-y-4">
        <x-ui.image-diff :aspectRatio="16/9">
            <x-ui.image-diff.before class="grayscale" src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=800&q=80" alt="Before" />
            <x-ui.image-diff.after src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=800&q=80" alt="After" />
        </x-ui.image-diff>
        <x-ui.image-diff :aspectRatio="1">
            <x-ui.image-diff.before class="grayscale" src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?w=800&q=80" alt="Before" />
            <x-ui.image-diff.after src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?w=800&q=80" alt="After" />
        </x-ui.image-diff>
    </div>
</x-demo>
@endblade

```html
<x-ui.image-diff :aspectRatio="16/9">...</x-ui.image-diff>
<x-ui.image-diff :aspectRatio="1">...</x-ui.image-diff>
...
```
## Vertical Orientation

Switch to vertical comparison for top-to-bottom reveals.

@blade
<x-demo>
    <x-ui.image-diff :aspectRatio="4/3" vertical>
        <x-ui.image-diff.before class="grayscale" src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80" alt="Before" />
        <x-ui.image-diff.after src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80" alt="After" />
    </x-ui.image-diff>
</x-demo>
@endblade
```html
<x-ui.image-diff vertical>
    <x-ui.image-diff.before class="grayscale" src="/before.jpg" alt="Before" />
    <x-ui.image-diff.after src="/after.jpg" alt="After" />
</x-ui.image-diff>
```


## Creative Effects

Use Tailwind filters on the before image for different comparisons.

@blade
<x-demo>
    <div class="space-y-4">
        {{-- Blur --}}
        <x-ui.image-diff :aspectRatio="16/9">
            <x-ui.image-diff.before class="blur-sm" src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800&q=80" alt="Blurred" />
            <x-ui.image-diff.after src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800&q=80" alt="Sharp" />
        </x-ui.image-diff>

        {{-- Brightness --}}
        <x-ui.image-diff :aspectRatio="16/9">
            <x-ui.image-diff.before class="brightness-50" src="https://images.unsplash.com/photo-1495567720989-cebdbdd97913?w=800&q=80" alt="Dark" />
            <x-ui.image-diff.after src="https://images.unsplash.com/photo-1495567720989-cebdbdd97913?w=800&q=80" alt="Bright" />
        </x-ui.image-diff>

        {{-- Sepia --}}
        <x-ui.image-diff :aspectRatio="16/9">
            <x-ui.image-diff.before class="sepia" src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800&q=80" alt="Sepia" />
            <x-ui.image-diff.after src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800&q=80" alt="Original" />
        </x-ui.image-diff>
    </div>
</x-demo>
@endblade
```html
<x-ui.image-diff.before class="grayscale" src="/photo.jpg" />
<x-ui.image-diff.before class="blur-sm" src="/photo.jpg" />
<x-ui.image-diff.before class="brightness-50" src="/photo.jpg" />
<x-ui.image-diff.before class="sepia" src="/photo.jpg" />
```

## Component Props

### Image Diff

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `aspectRatio` | number | `1` | Aspect ratio (e.g., `16/9`, `4/3`, `1`) |
| `vertical` | boolean | `false` | Enable vertical (top-to-bottom) comparison |

### Before/After Images

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `src` | string | required | Image source URL |
| `alt` | string | `''` | Alt text for accessibility |
| `class` | string | `''` | Additional classes (filters like `grayscale`, `blur-sm`) |

## Features to Make it More Robust
