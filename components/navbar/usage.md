---
name: navbar
---

## Introduction

The `Navbar` component is a **horizontal** navigation system designed for headers and top-level navigation. It provides a clean, accessible way to organize primary navigation links with support for icons, badges, and active states.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `navbar` component:

```bash
php artisan sheaf:install navbar
```

> Once installed, you can use the `<x-ui.navbar>` component in any Blade view.

## Usage

### Basic Navbar

The simplest implementation with navigation items:

```html
<x-ui.navbar>
    <x-ui.navbar.item icon="home" label="Home" href="/" />
    <x-ui.navbar.item icon="document-text" label="Docs" href="/docs" />
    <x-ui.navbar.item icon="users" label="Team" href="/team" />
    <x-ui.navbar.item icon="cog" label="Settings" href="/settings" />
</x-ui.navbar>
```

### Navbar with Icons

Add visual clarity with leading icons:

```html
<x-ui.navbar>
    <x-ui.navbar.item 
        icon="home" 
        label="Dashboard" 
        href="/dashboard" 
    />
    <x-ui.navbar.item 
        icon="chart-bar" 
        label="Analytics" 
        href="/analytics" 
    />
    <x-ui.navbar.item 
        icon="shopping-cart" 
        label="Orders" 
        href="/orders" 
    />
    <x-ui.navbar.item 
        icon="users" 
        label="Customers" 
        href="/customers" 
    />
</x-ui.navbar>
```

### Navbar with Badges

Display notifications or counts on navigation items:

```html
<x-ui.navbar>
    <x-ui.navbar.item 
        icon="home" 
        label="Home" 
        href="/" 
    />
    <x-ui.navbar.item 
        icon="envelope" 
        label="Messages" 
        href="/messages"
        badge="5"
        badge:variant="primary"
    />
    <x-ui.navbar.item 
        icon="bell" 
        label="Notifications" 
        href="/notifications"
        badge="12"
        badge:variant="danger"
    />
    <x-ui.navbar.item 
        icon="clipboard-list" 
        label="Tasks" 
        href="/tasks"
        badge="3"
        badge:variant="warning"
    />
</x-ui.navbar>
```

### Active State Highlighting

Highlight the current active navigation item:

```html
<x-ui.navbar>
    <x-ui.navbar.item 
        icon="home" 
        label="Dashboard" 
        href="/dashboard"
        :active="request()->is('dashboard')"
    />
    <x-ui.navbar.item 
        icon="folder" 
        label="Projects" 
        href="/projects"
        :active="request()->is('projects*')"
    />
    <x-ui.navbar.item 
        icon="chart-bar" 
        label="Reports" 
        href="/reports"
        :active="request()->is('reports*')"
    />
</x-ui.navbar>
```

### Custom Icon Styling

Customize individual item icons with icon-prefixed attributes:

```html
<x-ui.navbar>
    <x-ui.navbar.item 
        icon="home" 
        label="Home" 
        href="/" 
    />
    <x-ui.navbar.item 
        icon="exclamation-triangle" 
        icon:class="text-red-500"
        label="Alerts" 
        href="/alerts" 
    />
    <x-ui.navbar.item 
        icon="check-circle" 
        icon:class="text-green-500"
        label="Completed" 
        href="/completed" 
    />
</x-ui.navbar>
```

### Navbar in Header Context

Typical usage within a header component:

```html
<x-ui.header>
    <x-ui.navbar class="flex-1">
        <x-ui.navbar.item icon="home" label="Home" href="/" />
        <x-ui.navbar.item icon="folder" label="Projects" href="/projects" />
        <x-ui.navbar.item icon="users" label="Team" href="/team" />
    </x-ui.navbar>

    <div class="flex items-center gap-x-3">
        <x-ui.avatar src="/user.jpg" circle size="sm" />
        <x-ui.theme-switcher variant="inline" />
    </div>
</x-ui.header>
```

## Component Props

### Navbar Component

| Prop Name | Type  | Default | Required | Description              |
| --------- | ----- | ------- | -------- | ------------------------ |
| `slot`    | mixed | `''`    | Yes      | Navigation items         |

### Navbar Item Component

| Prop Name | Type    | Default | Required | Description                                     |
| --------- | ------- | ------- | -------- | ----------------------------------------------- |
| `label`   | string  | `null`  | No       | Label text for the navigation item              |
| `icon`    | string  | `null`  | No       | Icon name to display                            |
| `href`    | string  | `'#'`   | No       | URL the item links to                           |
| `active`  | boolean | `null`  | No       | Whether this item is currently active           |
| `badge`   | mixed   | `null`  | No       | Badge content (number or text)                  |

**Note:** The `navbar.item` component also accepts prefixed attributes:
- `icon:*` - Any attribute prefixed with `icon:` is passed to the icon component (e.g., `icon:class="text-red-500"`)
- `badge:*` - Any attribute prefixed with `badge:` is passed to the badge component (e.g., `badge:variant="danger"`)

## Component Structure

The navbar system consists of:

- **Main Component**: `<x-ui.navbar>` - The horizontal container for navigation items
- **Item Component**: `<x-ui.navbar.item>` - Individual navigation link

## Advanced Examples

### Dynamic Navigation with Livewire

```php
// In your Livewire component
public $navItems = [
    ['icon' => 'home', 'label' => 'Dashboard', 'href' => '/dashboard'],
    ['icon' => 'chart-bar', 'label' => 'Analytics', 'href' => '/analytics'],
    ['icon' => 'folder', 'label' => 'Projects', 'href' => '/projects', 'badge' => 5],
];
```

```html
<x-ui.navbar>
    @foreach($navItems as $item)
        <x-ui.navbar.item 
            :icon="$item['icon']"
            :label="$item['label']"
            :href="$item['href']"
            :badge="$item['badge'] ?? null"
            :active="request()->is(ltrim($item['href'], '/'))"
        />
    @endforeach
</x-ui.navbar>
```

### Conditional Navigation Items

```html
<x-ui.navbar>
    <x-ui.navbar.item icon="home" label="Home" href="/" />
    
    @auth
        <x-ui.navbar.item icon="folder" label="My Projects" href="/projects" />
        
        @can('admin')
            <x-ui.navbar.item icon="cog" label="Admin" href="/admin" />
        @endcan
    @endauth
    
    <x-ui.navbar.item icon="question-mark-circle" label="Help" href="/help" />
</x-ui.navbar>
```

### Navbar with Section Grouping

```html
<x-ui.header>
    <x-ui.navbar class="flex-1">
        <!-- Primary navigation -->
        <x-ui.navbar.item icon="home" label="Home" href="/" />
        <x-ui.navbar.item icon="chart-bar" label="Analytics" href="/analytics" />
        
        <span class="h-6 w-px bg-neutral-200 dark:bg-neutral-700 mx-2"></span>
        
        <!-- Secondary navigation -->
        <x-ui.navbar.item icon="document-text" label="Docs" href="/docs" />
        <x-ui.navbar.item icon="question-mark-circle" label="Support" href="/support" />
    </x-ui.navbar>

    <x-ui.avatar src="/user.jpg" circle size="sm" />
</x-ui.header>
```

### Navbar with Custom Badge Variants

```html
<x-ui.navbar>
    <x-ui.navbar.item 
        icon="inbox" 
        label="Inbox" 
        href="/inbox"
        badge="42"
        badge:variant="info"
    />
    <x-ui.navbar.item 
        icon="exclamation-triangle" 
        label="Urgent" 
        href="/urgent"
        badge="3"
        badge:variant="danger"
    />
    <x-ui.navbar.item 
        icon="clock" 
        label="Pending" 
        href="/pending"
        badge="8"
        badge:variant="warning"
    />
    <x-ui.navbar.item 
        icon="check-circle" 
        label="Completed" 
        href="/completed"
        badge="156"
        badge:variant="success"
    />
</x-ui.navbar>
```

## Styling & Theming

The navbar component includes:

- **Hover States**: Subtle background color changes on hover
- **Active States**: Primary color highlighting for active items
- **Dark Mode**: Full dark mode support with appropriate colors
- **Smooth Transitions**: All state changes are animated smoothly
- **Flexible Layout**: Horizontal flexbox with gap spacing

## Accessibility Features

The navbar component includes several accessibility enhancements:

- **Semantic HTML**: Uses proper anchor tags for navigation
- **Keyboard Navigation**: Full keyboard support
- **Active State**: Clear visual indication of current page
- **Icon Labels**: All icons paired with text labels for clarity