---
name: navlist
---

## Introduction

The `Navlist` component is a **flexible**, **collapsible** navigation list system designed for sidebar navigation. It provides a clean way to organize navigation items with support for icons, badges, tooltips, grouping, and multiple visual variants. Perfect for application sidebars with responsive collapse behavior.

<!-- ## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `navlist` component easily:

```bash
php artisan sheaf:install navlist
``` -->

> Once installed, you can use the `<x-ui.sidebar.navlist />` component in any Blade view.

## Usage

### Basic Navigation List

The simplest implementation with navigation items:

```blade
<x-ui.sidebar.navlist>
    <x-ui.sidebar.navlist.item 
        label="Dashboard"
        icon="home"
        href="/dashboard"
    />
    <x-ui.sidebar.navlist.item 
        label="Settings"
        icon="cog"
        href="/settings"
    />
    <x-ui.sidebar.navlist.item 
        label="Profile"
        icon="user"
        href="/profile"
    />
</x-ui.sidebar.navlist>
```
## Group Variants

### Default Variant with Groups

Organize navigation items into logical groups with labels:

```blade
<x-ui.sidebar.navlist>
    <x-ui.sidebar.navlist.group label="Main">
        <x-ui.sidebar.navlist.item 
            label="Dashboard"
            icon="home"
            href="/dashboard"
        />
        <x-ui.sidebar.navlist.item 
            label="Analytics"
            icon="chart-bar"
            href="/analytics"
        />
    </x-ui.sidebar.navlist.group>

    <x-ui.sidebar.navlist.group label="Content">
        <x-ui.sidebar.navlist.item 
            label="Posts"
            icon="document-text"
            href="/posts"
        />
        <x-ui.sidebar.navlist.item 
            label="Media"
            icon="photo"
            href="/media"
        />
    </x-ui.sidebar.navlist.group>
</x-ui.sidebar.navlist>
```

[View Demo](/demo/navlist/default-variant)

### Compact Variant

A more condensed visual style for navigation groups:

```blade
<x-ui.sidebar.navlist>
    <x-ui.sidebar.navlist.group 
        label="Shop"
        variant="compact"
    >
        <x-ui.sidebar.navlist.item 
            label="Products"
            icon="shopping-bag"
            href="/shop/products"
        />
        <x-ui.sidebar.navlist.item 
            label="Orders"
            icon="shopping-cart"
            href="/shop/orders"
        />
        <x-ui.sidebar.navlist.item 
            label="Customers"
            icon="users"
            href="/shop/customers"
        />
    </x-ui.sidebar.navlist.group>
</x-ui.sidebar.navlist>
```

[View Demo](/demo/navlist/compact-variant)

## More Features
### Collapsable Groups

Create expandable/collapsible navigation sections:

```blade
<x-ui.sidebar.navlist>
    <x-ui.sidebar.navlist.group 
        label="Products"
        collapsable
    >
        <x-ui.sidebar.navlist.item 
            label="All Products"
            icon="cube"
            href="/products"
        />
        <x-ui.sidebar.navlist.item 
            label="Categories"
            icon="squares-2x2"
            href="/products/categories"
        />
        <x-ui.sidebar.navlist.item 
            label="Inventory"
            icon="archive-box"
            href="/products/inventory"
        />
    </x-ui.sidebar.navlist.group>

    <x-ui.sidebar.navlist.group 
        label="Settings"
        collapsable
    >
        <x-ui.sidebar.navlist.item 
            label="General"
            icon="cog"
            href="/settings/general"
        />
        <x-ui.sidebar.navlist.item 
            label="Security"
            icon="lock-closed"
            href="/settings/security"
        />
    </x-ui.sidebar.navlist.group>
</x-ui.sidebar.navlist>
```

### Navigation with Badges

Add badges to items for notifications, counts, or status indicators:

- **Note:** `badge:*`, Any attribute prefixed with `badge:` is passed to the badge component (e.g., `badge:variant="outline"`) you can pass any prop that [the badge component](/docs/components/badge#content-badge-props) can accept 


```blade
<x-ui.sidebar.navlist>
    <x-ui.sidebar.navlist.item 
        label="Messages"
        icon="envelope"
        href="/messages"
        badge="12"
        badge:variant="primary"
    />
    <x-ui.sidebar.navlist.item 
        label="Notifications"
        icon="bell"
        href="/notifications"
        badge="3"
        badge:variant="danger"
    />
    <x-ui.sidebar.navlist.item 
        label="Tasks"
        icon="clipboard-list"
        href="/tasks"
        badge="5"
        badge:variant="warning"
    />
</x-ui.sidebar.navlist>
```

### Custom Icon Styling

Customize individual item icons with icon-prefixed attributes:

```blade
<x-ui.sidebar.navlist>
    <x-ui.sidebar.navlist.item 
        label="Critical Alerts"
        icon="exclamation-triangle"
        icon:class="!text-red-500"
        href="/alerts"
    />
    <x-ui.sidebar.navlist.item 
        label="Success Stories"
        icon="check-circle"
        icon:class="!text-green-500"
        href="/stories"
    />
</x-ui.sidebar.navlist>
```


## Active State

By default, the `navlist.item` component automatically detects the active link using an **exact match** on the `href`.
If you need more control, you can manually pass an `:active` boolean prop. This is useful when you want to:

* Support **wildcard patterns** (`request()->is('posts*')`)
* Match by **route names** (`request()->routeIs('posts.*')`)
* Highlight parent sections for nested routes

#### Examples

```blade
<x-ui.sidebar.navlist>
    {{-- Exact match: active when URL is exactly /dashboard --}}
    <x-ui.sidebar.navlist.item 
        label="Dashboard"
        icon="home"
        href="/dashboard"
    />

    {{-- Wildcard match: active for /posts, /posts/create, /posts/123, etc. --}}
    <x-ui.sidebar.navlist.item 
        label="Posts"
        icon="document-text"
        href="/posts"
        :active="request()->is('posts*')"
    />

    {{-- Route name match: active for any route inside posts.* --}}
    <x-ui.sidebar.navlist.item 
        label="Posts (via route name)"
        icon="document-text"
        href="/posts"
        :active="request()->routeIs('posts.*')"
    />
</x-ui.sidebar.navlist>
```


## Component Props

### Navlist Component

| Prop Name    | Type   | Default | Required | Description                                    |
| ------------ | ------ | ------- | -------- | ---------------------------------------------- |
| `slot`       | mixed  | `''`    | Yes      | Navigation groups and items                    |

### Navlist Group Component

| Prop Name     | Type    | Default     | Required | Description                                        |
| ------------- | ------- | ----------- | -------- | -------------------------------------------------- |
| `label`       | string  | `false`     | No       | Label text for the navigation group                |
| `collapsable` | boolean | `false`     | No       | Whether the group can be collapsed/expanded        |
| `variant`     | string  | `'default'` | No       | Visual style variant (`'default'` or `'compact'`)  |
| `slot`        | mixed   | `''`        | Yes      | Navigation items within the group                  |

### Navlist Item Component

| Prop Name        | Type    | Default | Required | Description                                           |
| ---------------- | ------- | ------- | -------- | ----------------------------------------------------- |
| `label`          | string  | `null`  | No       | Label text for the navigation item                    |
| `icon`           | string  | `null`  | No       | Icon name to display                                  |
| `href`           | string  | `'#'`   | No       | URL the item links to                                 |
| `active`         | boolean | `null`  | No       | Whether this item is currently active                 |
| `badge`          | mixed   | `null`  | No       | Badge content (number or text)                        |
| `collapsible`    | boolean | `true`  | No       | Inherited from parent, controls tooltip behavior      |

**Note:** The `navlist.item` component also accepts prefixed attributes:
- `icon:*` - Any attribute prefixed with `icon:` is passed to the icon component (e.g., `icon:class="text-red-500"`)
- `badge:*` - Any attribute prefixed with `badge:` is passed to the badge component (e.g., `badge:variant="danger"`)

## Component Structure

The navlist system is built with multiple sub-components:

- **Main Component**: `<x-ui.sidebar.navlist>` - The container for all navigation items
- **Group Component**: `<x-ui.sidebar.navlist.group>` - Groups related navigation items
- **Item Component**: `<x-ui.sidebar.navlist.item>` - Individual navigation link
- **Tooltip Helper**: `<x-ui.sidebar.navlist.has-tooltip>` - Internal component for tooltip behavior (internal)

## Advanced Examples

### Dynamic Navigation with Livewire

```php
// In your Livewire component
public $menuItems = [
    ['label' => 'Dashboard', 'icon' => 'home', 'href' => '/dashboard'],
    ['label' => 'Posts', 'icon' => 'document-text', 'href' => '/posts', 'badge' => 5],
    ['label' => 'Settings', 'icon' => 'cog', 'href' => '/settings'],
];
```

```blade
<x-ui.sidebar.navlist>
    @foreach($menuItems as $item)
        <x-ui.sidebar.navlist.item 
            :label="$item['label']"
            :icon="$item['icon']"
            :href="$item['href']"
            :badge="$item['badge'] ?? null"
            :active="request()->is(ltrim($item['href'], '/'))"
        />
    @endforeach
</x-ui.sidebar.navlist>
```

### Conditional Navigation Items

```blade
<x-ui.sidebar.navlist>
    <x-ui.sidebar.navlist.group label="Main">
        <x-ui.sidebar.navlist.item 
            label="Dashboard"
            icon="home"
            href="/dashboard"
        />
        
        @can('manage-users')
            <x-ui.sidebar.navlist.item 
                label="User Management"
                icon="users"
                href="/users"
            />
        @endcan
        
        @if(auth()->user()->isAdmin())
            <x-ui.sidebar.navlist.item 
                label="System Logs"
                icon="document-text"
                href="/logs"
            />
        @endif
    </x-ui.sidebar.navlist.group>
</x-ui.sidebar.navlist>
```

## Styling & Theming

The navlist component uses CSS custom properties and Tailwind utilities for theming. Key styling features include:

- **Hover States**: Subtle background color changes on hover
- **Active States**: Primary color highlighting for active items
- **Dark Mode**: Full dark mode support with appropriate color adjustments
- **Collapsed State**: Automatic layout adjustments when sidebar is collapsed
- **Smooth Transitions**: All state changes are animated smoothly

The component automatically responds to a `[data-collapsed]` attribute on a parent sidebar component for collapsed state styling.

so if you want to add some tailwind based on collapsed or expanded state:

- `[:not(:has([data-collapsed]_&))_&]:bg-green-500` : means if the sidebar is not collapsed add green color
- `[:has([data-collapsed]_&)_&]:bg-red-500` means if the sidebar is collapsed adds red color