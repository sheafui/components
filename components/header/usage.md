---
name: header
---

## Introduction


The `Header` component is a **sticky**, **responsive** application header designed to sit at the top of your main content area. It provides a consistent navigation bar with mobile menu toggle integration and seamless integration with the sidebar layout system.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `header` component:

```bash
php artisan sheaf:install header
```

> Once installed, you can use the `<x-ui.header>` component within your layout's main area.

## Usage

### Basic Header

The simplest implementation with a navbar and user actions:

```html
<x-ui.layout.main>
    <x-ui.header>
        <x-ui.navbar class="flex-1">
            <x-ui.navbar.item icon="home" label="Home" href="/" />
            <x-ui.navbar.item icon="cog-6-tooth" label="Settings" href="/settings" />
        </x-ui.navbar>
        
        <div class="flex gap-x-3 items-center">
            <x-ui.avatar size="sm" src="/avatar.png" circle />
            <x-ui.theme-switcher variant="inline" />
        </div>
    </x-ui.header>

    <div class="p-6">
        <!-- Your page content -->
    </div>
</x-ui.layout.main>
```

### Header with Navigation Only

A simple header focused on navigation:

```html
<x-ui.header>
    <x-ui.navbar class="flex-1">
        <x-ui.navbar.item icon="home" label="Dashboard" href="/dashboard" />
        <x-ui.navbar.item icon="chart-bar" label="Analytics" href="/analytics" />
        <x-ui.navbar.item icon="users" label="Team" href="/team" />
        <x-ui.navbar.item icon="folder" label="Projects" href="/projects" />
    </x-ui.navbar>
</x-ui.header>
```

### Header with Search and Actions

Add search functionality and action buttons:

```html
<x-ui.header>
    <x-ui.navbar class="flex-1">
        <x-ui.navbar.item icon="home" label="Home" href="/" />
        <x-ui.navbar.item icon="document-text" label="Docs" href="/docs" />
    </x-ui.navbar>

    <div class="flex items-center gap-x-4">
        <x-ui.input 
            placeholder="Search..." 
            icon="magnifying-glass"
            class="w-64"
        />
        <x-ui.button variant="primary" icon="plus">
            New Project
        </x-ui.button>
        <x-ui.avatar src="/user.jpg" circle size="sm" />
    </div>
</x-ui.header>
```

### Header with Breadcrumbs

Combine navigation with breadcrumbs for better context:

```html
<x-ui.header>
    <div class="flex-1 flex items-center gap-x-6">
        <x-ui.navbar>
            <x-ui.navbar.item icon="home" label="Home" href="/" />
            <x-ui.navbar.item icon="folder" label="Projects" href="/projects" />
        </x-ui.navbar>

        <div class="flex items-center gap-x-2 text-sm text-neutral-500">
            <span>Projects</span>
            <x-ui.icon name="chevron-right" class="size-4" />
            <span>Website Redesign</span>
        </div>
    </div>

    <x-ui.theme-switcher variant="inline" />
</x-ui.header>
```

### Mobile Menu Toggle

The header automatically includes a mobile menu toggle button that:
- Only appears on mobile devices (< 768px)
- Integrates with the sidebar's mobile overlay
- Hidden on tablet and desktop viewports

```html
<x-ui.layout>
    <x-ui.sidebar brand="My App">
        <!-- Sidebar content -->
    </x-ui.sidebar>

    <x-ui.layout.main>
        <x-ui.header>
            <!-- Mobile toggle is automatically included -->
            <x-ui.navbar class="flex-1">
                <x-ui.navbar.item icon="home" label="Home" href="/" />
            </x-ui.navbar>
        </x-ui.header>
    </x-ui.layout.main>
</x-ui.layout>
```

### Complete Layout Example

A full application shell with header, sidebar, and content:

```html
<x-ui.layout>
    <x-ui.sidebar scrollable>
        <x-slot:brand>
            <img src="/logo.svg" class="size-8" />
            <span class="[:has([data-collapsed]_&)_&]:hidden font-bold">AppName</span>
        </x-slot:brand>

        <x-ui.sidebar.navlist>
            <x-ui.sidebar.navlist.item 
                label="Dashboard" 
                icon="home" 
                href="/dashboard" 
            />
            <x-ui.sidebar.navlist.item 
                label="Projects" 
                icon="folder" 
                href="/projects" 
            />
        </x-ui.sidebar.navlist>
    </x-ui.sidebar>

    <x-ui.layout.main>
        <x-ui.header>
            <x-ui.navbar class="flex-1">
                <x-ui.navbar.item icon="home" label="Home" href="/" />
                <x-ui.navbar.item icon="bell" label="Notifications" href="/notifications" badge="3" />
            </x-ui.navbar>

            <div class="flex gap-x-3 items-center">
                <x-ui.avatar src="/user.jpg" circle size="sm" />
                <x-ui.theme-switcher variant="inline" />
            </div>
        </x-ui.header>

        <div class="p-6">
            <h1 class="text-3xl font-bold mb-4">Dashboard</h1>
            <!-- Page content -->
        </div>
    </x-ui.layout.main>
</x-ui.layout>
```

## Component Props

### Header Component

| Prop Name | Type  | Default | Required | Description                      |
| --------- | ----- | ------- | -------- | -------------------------------- |
| `slot`    | mixed | `''`    | Yes      | Header content (navbar, actions) |

## Component Structure

The header component consists of:

- **Main Container**: `<x-ui.header>` - The header wrapper with border and padding
- **Mobile Toggle**: Auto-included button for mobile sidebar control (internal)
- **Content Area**: Flexible space for navigation and actions

## Styling & Layout

The header component includes:

- Fixed minimum height matching sidebar brand area (`--header-height: 4rem`)
- Bottom border for visual separation
- Automatic flexbox layout for content alignment
- Responsive padding that adapts to viewport size
- Dark mode support with appropriate border colors

## Advanced Examples

### Header with User Menu

```html
<x-ui.header>
    <x-ui.navbar class="flex-1">
        <x-ui.navbar.item icon="home" label="Dashboard" href="/dashboard" />
        <x-ui.navbar.item icon="chart-bar" label="Reports" href="/reports" />
    </x-ui.navbar>

    <div class="flex items-center gap-x-4">
        <x-ui.dropdown>
            <x-slot:trigger>
                <x-ui.button variant="ghost">
                    <x-ui.avatar src="/user.jpg" size="sm" circle />
                    <span>John Doe</span>
                    <x-ui.icon name="chevron-down" class="size-4" />
                </x-ui.button>
            </x-slot:trigger>

            <x-ui.dropdown.item icon="user" label="Profile" href="/profile" />
            <x-ui.dropdown.item icon="cog" label="Settings" href="/settings" />
            <x-ui.dropdown.divider />
            <x-ui.dropdown.item icon="arrow-right-on-rectangle" label="Logout" href="/logout" />
        </x-ui.dropdown>
    </div>
</x-ui.header>
```

### Header with Notifications

```html
<x-ui.header>
    <x-ui.navbar class="flex-1">
        <x-ui.navbar.item icon="home" label="Home" href="/" />
    </x-ui.navbar>

    <div class="flex items-center gap-x-3">
        <x-ui.button variant="ghost" icon="bell" class="relative">
            <span class="absolute top-1 right-1 size-2 bg-red-500 rounded-full"></span>
        </x-ui.button>
        
        <x-ui.button variant="ghost" icon="envelope" />
        
        <x-ui.avatar src="/user.jpg" circle size="sm" />
    </div>
</x-ui.header>
```

### Conditional Header Content

```html
<x-ui.header>
    <x-ui.navbar class="flex-1">
        <x-ui.navbar.item icon="home" label="Home" href="/" />
        
        @auth
            <x-ui.navbar.item icon="folder" label="My Projects" href="/projects" />
            <x-ui.navbar.item icon="star" label="Favorites" href="/favorites" />
        @endauth
    </x-ui.navbar>

    <div class="flex items-center gap-x-3">
        @auth
            <x-ui.avatar src="{{ auth()->user()->avatar }}" circle size="sm" />
        @else
            <x-ui.button variant="primary" href="/login">Sign In</x-ui.button>
        @endauth
    </div>
</x-ui.header>
```
