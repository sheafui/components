---
name: icon
new: [BladeKit Icons (Optional)]
---

## Introduction

The `Icon` component is designed to be **headless**, **customizable**, and **easy to use**. It supports two icon providers and optional blade ui kit under the hood:

- [Heroicons](https://heroicons.com)
- [Phosphor Icons](https://phosphoricons.com)

We leverage [WireUI's wrappers](https://wireui.com) for both providers to deliver a simple and expressive interface.

> **Note:** You must install the relevant WireUI wrapper packages based on the icon provider you intend to use.


## Installation

> This already happens if you run the `sheaf:init` command.
```shell
composer require wireui/heroicons
```

For using Phosphor icons you need to install the WireUI wrapper package:
```shell
composer require wireui/phosphoricons
```

> Once installed, you can start using the `<x-ui.icon />` component seamlessly in your views.

## Component Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `icon` component easily:
```bash
php artisan sheaf:install icon
```

## Customization

### Variants

Each variant offers different sizes and styles:

#### Heroicons

@blade
<x-demo class="flex gap-2 justify-center items-center">
    <x-ui.icon name="academic-cap" class="text-white"/>
    <x-ui.icon name="academic-cap" variant="solid" class="text-white"/>
    <x-ui.icon name="academic-cap" variant="mini" class="text-white"/>
    <x-ui.icon name="academic-cap" variant="micro" class="text-white"/>
</x-demo>
@endblade

```blade
<!-- 24px, outline -->
<x-ui.icon name="academic-cap" class="text-white"/>
<!-- 24px, solid -->
<x-ui.icon name="academic-cap" variant="solid" class="text-white"/>
<!-- 20px, solid -->
<x-ui.icon name="academic-cap" variant="mini" class="text-white"/>
<!-- 16px, solid -->
<x-ui.icon name="academic-cap" variant="micro" class="text-white"/>
```

#### Phosphor Icons

To use Phosphor icons, prefix the name with `ps:` or `phosphor:`.

@blade
<x-demo class="flex gap-2 justify-center items-center">
    <x-ui.icon name="ps:align-top" variant="thin" class="text-white"/>
    <x-ui.icon name="ps:align-top" variant="light" class="text-white"/>
    <x-ui.icon name="ps:align-top" class="text-white"/>
    <x-ui.icon name="ps:align-top" variant="duotone" class="text-white"/>
    <x-ui.icon name="ps:align-top" variant="bold" class="text-white"/>
    <x-ui.icon name="ps:align-top" variant="fill" class="text-white"/>
</x-demo>
@endblade

```blade
<!-- thin variant -->
<x-ui.icon name="ps:align-top" variant="thin" class="text-white"/>
<!-- light variant -->
<x-ui.icon name="ps:align-top" variant="light" class="text-white"/>
<!-- regular variant (default) -->
<x-ui.icon name="ps:align-top" class="text-white"/>
<!-- duotone variant -->
<x-ui.icon name="ps:align-top" variant="duotone" class="text-white"/>
<!-- bold variant -->
<x-ui.icon name="ps:align-top" variant="bold" class="text-white"/>
<!-- fill variant -->
<x-ui.icon name="ps:align-top" variant="fill" class="text-white"/>
```


## BladeKit Icons (Optional)

The icon component optionally supports any icon set from the [Blade Icons](https://blade-ui-kit.com/blade-icons) ecosystem by Blade UI Kit. This is opt-in and not installed by default.

First, install the core package:
```shell
composer require blade-ui-kit/blade-icons
```

Then install whichever icon set you need. For example, for Font Awesome:
```shell
composer require owenvoke/blade-fontawesome
```

To use a BladeKit icon, prefix the name with `bk:` or `bladekit:`:

@blade
<x-demo class="flex gap-2 justify-center items-center">
    <x-ui.icon name="bk:fas-fighter-jet" />
    <x-ui.icon name="bk:fas-jet-fighter" />
</x-demo>
@endblade

```blade
<x-ui.icon name="bk:fas-fighter-jet" />
<x-ui.icon name="bk:fas-jet-fighter" />
```

> **Note:** BladeKit icons do not support the `variant` prop. If no size class is provided, `size-6` is applied as a fallback.

### Sizes

@blade
<x-demo class="flex gap-2 justify-center items-center">
    <x-ui.icon name="cpu-chip" class="size-12"/>
    <x-ui.icon name="cpu-chip" variant="solid" class="size-12"/>
</x-demo>
@endblade

```blade
<x-ui.icon name="academic-cap" class="size-12"/>
<x-ui.icon name="academic-cap" variant="solid" class="size-12"/>
```

Use Tailwind `size-*` utilities to control icon dimensions.

If you're using **Phosphor** or **BladeKit** icons and no size is defined, the component applies a default `size-6`.

> While you're free to override the icon size, we recommend sticking with the provided variant sizes — they're crafted for optimal balance and clarity.

### Custom Styles

@blade
<x-demo class="flex gap-2 justify-center items-center">
    <x-ui.icon name="cpu-chip" class="text-purple-500"/>
    <x-ui.icon name="cpu-chip" variant="solid" class="size-12"/>
    <x-ui.icon name="cpu-chip" variant="solid" class="fill-red-600 size-12"/>
</x-demo>
@endblade

```blade
<x-ui.icon name="cpu-chip" class="text-purple-500"/>
<x-ui.icon name="cpu-chip" variant="solid" class="size-12"/>
<x-ui.icon name="cpu-chip" variant="solid" class="fill-red-600 size-12"/>
```


## Component Props

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `name` | string | — | Yes | Icon name. Prefix with `ps:`/`phosphor:` for Phosphor Icons, or `bk:`/`bladekit:` for BladeKit icons. |
| `variant` | string | `outline` | No | Icon style variant. Not applicable for BladeKit icons. |
| `class` | string | `''` | No | Tailwind class string to style the icon (size, color, etc). |
| `asButton` | bool | `false` | No | Renders the icon inside a `<button>` with `type="button"` and `cursor-pointer`. |