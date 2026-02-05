---
name: icon
---

## Introduction

The `Icon` component is designed to be **headless**, **customizable**, and **easy to use**. It supports two icon providers under the hood:

- [Heroicons](https://heroicons.com)
- [Phosphor Icons](https://phosphoricons.com)

We leverage [WireUI's wrappers](https://wireui.com) for both providers to deliver a simple and expressive interface.

> **Note:** You must install the relevant WireUI wrapper packages based on the icon provider you intend to use.

---
## Installation 

> this is already happens if you run the sheaf:init commad

```shell
composer require wireui/heroicons
```

for using phosphor icon you need to install the wuireui's wrapper package

```shell
composer require wireui/phosphoricons
```

> Once installed, you can start using the <x-ui.icon /> component seamlessly in your views.


## Component Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `icon` component easily:

```bash
php artisan sheaf:install icon
```


## Customization 

### Variants

Each variant offers different sizes and styles:
#### Hero icons
@blade
<x-demo class="flex gap-2 justify-center items-center">
    <x-ui.icon name="academic-cap"  class="text-white"/> 
    <x-ui.icon name="academic-cap" variant="solid" class="text-white"/>
    <x-ui.icon name="academic-cap" variant="mini" class="text-white"/>
    <x-ui.icon name="academic-cap" variant="micro" class="text-white"/>
</x-demo>
@endblade


```html
    <!-- 24px, outline -->
    <x-ui.icon name="academic-cap"  class="text-white"/> 
    <!-- 24px, solid -->
    <x-ui.icon name="academic-cap" variant="solid" class="text-white"/> 
    <!-- 20px, solid -->
    <x-ui.icon name="academic-cap" variant="mini" class="text-white"/> 
     <!-- 16px, solid -->
    <x-ui.icon name="academic-cap" variant="micro" class="text-white"/>
```

#### Phosphor icons

To use Phosphor icons, prefix the name with ps: or phosphor:.
@blade
<x-demo class="flex gap-2 justify-center items-center">
    <x-ui.icon name="ps:align-top" variant="thin" class="text-white"/>
    <x-ui.icon name="ps:align-top" variant="light" class="text-white"/>
    <x-ui.icon name="ps:align-top"  class="text-white"/> 
    <x-ui.icon name="ps:align-top" variant="duotone" class="text-white"/>
    <x-ui.icon name="ps:align-top" variant="bold" class="text-white"/>
    <x-ui.icon name="ps:align-top" variant="fill" class="text-white"/>
</x-demo>
@endblade


```html
    <!-- thin variant -->
    <x-ui.icon name="ps:align-top" variant="thin" class="text-white"/>
    <!-- light variant -->
    <x-ui.icon name="ps:align-top" variant="light" class="text-white"/>
    <!-- regular variant (default) -->
    <x-ui.icon name="ps:align-top"  class="text-white"/> 
    <!-- duotone variant  -->
    <x-ui.icon name="ps:align-top" variant="duotone" class="text-white"/>
    <!-- bold variant  -->
    <x-ui.icon name="ps:align-top" variant="bold" class="text-white"/>
    <!-- fill variant  -->
    <x-ui.icon name="ps:align-top" variant="fill" class="text-white"/>
```

### Sizes

@blade
<x-demo class="flex gap-2 justify-center items-center">
    <x-ui.icon name="cpu-chip"  class="size-12"/> 
    <x-ui.icon name="cpu-chip" variant="solid" class="size-12"/>
</x-demo>
@endblade

```html
<x-demo class="flex gap-2 justify-center items-center">
    <x-ui.icon name="academic-cap"  class="size-12"/> 
    <x-ui.icon name="academic-cap" variant="solid" class="size-12"/>
</x-demo>
```

Use Tailwind size utilities or ``size-*`` utilities (required for Phosphor icons).

If you're using **Phosphor icons** and no size is defined, the component applies a default ``size-6``.

> While you’re free to override the icon size, we recommend sticking with the provided variant sizes they’re crafted for optimal balance and clarity.

### Custom styles

@blade
<x-demo class="flex gap-2 justify-center items-center">
    <x-ui.icon name="cpu-chip"  class="text-purple-500"/> 
    <x-ui.icon name="cpu-chip" variant="solid" class="size-12"/>
    <x-ui.icon name="cpu-chip" variant="solid" class="fill-red-600 size-12"/>
</x-demo>
@endblade

```html
<x-demo class="flex gap-2 justify-center items-center">
    <x-ui.icon name="academic-cap"  class="size-12"/> 
    <x-ui.icon name="academic-cap" variant="solid" class="size-12"/>
    <x-ui.icon name="cpu-chip" variant="solid" class="fill-red-600 size-12"/>
</x-demo>
```

## Component Props

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `name` | string | no default | Yes | Icon name. Prefix with ``ps``: or ``phosphor``: for Phosphor Icons |
| `variant` | string | outline | No |Icon style variant.|
| `class` | string | `''` | No | Tailwind class string to style the icon (size, color, etc). |
| `asButton` | string | `''` | No | render the icon inside button with type button and cursor pointer |