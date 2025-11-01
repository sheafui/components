---
name: 'sidebar' 
---

## Introduction

The `Sidebar` component is a **responsive**, **collapsable** navigation sidebar designed for modern web applications. It features smooth transitions, touch-friendly interactions, and intelligent behavior across mobile, tablet, and desktop viewports.
## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `sidebar` component easily:

```bash
php artisan sheaf:install sidebar
```

## Usage

@blade
<x-md.cta                                                            
    href="/docs/layouts/layout#content-variants"                                    
    label="this sidebar can be used in two variants, read more about it"
    ctaLabel="Visit Docs"
/>
@endblade


### Basic Sidebar Layout

The simplest implementation combining layout, sidebar, and main content:

```blade
<x-ui.layout>
    <x-ui.sidebar>
        <x-slot:brand>
            <x-ui.brand  
                name="Sheaf UI"
                href="/test"
            >
                <x-slot:logo>
                        <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 100 100"
                        class="size-5">
                        <rect x="15" y="10" width="80" height="15" fill="currentColor" rx="5" ry="0" />
                        <rect x="15" y="30" width="60" height="15" fill="currentColor" />
                        <rect x="15" y="50" width="30" height="15" fill="currentColor" />
                        <rect x="15" y="55" width="10" height="30" fill="currentColor" />
                    </svg>
                </x-slot:logo>
            </x-ui.brand>
        </x-slot:brand>

        <x-ui.navlist>
            <x-ui.navlist.item 
                label="Dashboard"
                icon="home"
                href="/dashboard"
            />
            <x-ui.navlist.item 
                label="Settings"
                icon="cog"
                href="/settings"
            />
        </x-ui.navlist>
    </x-ui.sidebar>

    <x-ui.layout.main>
        <!-- Your main content here -->
        <h1>Welcome to Dashboard</h1>
    </x-ui.layout.main>
</x-ui.layout>

```

### Managing Brand in the Sidebar

The recommended approach is to use the [brand component](/docs/components/brand) with your logo and brand name. When the sidebar expands, the full brand name will be displayed alongside the logo.

```blade
<x-ui.sidebar>
    <x-slot:brand>
        <x-ui.brand  
            name="Sheaf UI"
            href="#"
        >
            <x-slot:logo>
                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 100 100"
                     class="size-5">
                    <rect x="15" y="10" width="80" height="15" fill="currentColor" rx="5" ry="0" />
                    <rect x="15" y="30" width="60" height="15" fill="currentColor" />
                    <rect x="15" y="50" width="30" height="15" fill="currentColor" />
                    <rect x="15" y="55" width="10" height="30" fill="currentColor" />
                </svg>
            </x-slot:logo>
        </x-ui.brand>
    </x-slot:brand>

    <x-ui.navlist>
        <!-- Navigation items -->
    </x-ui.navlist>
</x-ui.sidebar>
```
#### Custom Logo Variants

If you need different logos for expanded and collapsed states (e.g., a full logo vs. an icon-only variant), you can control this using CSS classes that respond to the sidebar's state:

```blade
<x-ui.sidebar>
    <x-slot:brand>
        <x-long-logo class="[:not(:has([data-collapsed]_&))_&]:inline-flex [:has([data-collapsed]_&)_&]:hidden" />
        <x-short-logo class="[:not(:has([data-collapsed]_&))_&]:hidden [:has([data-collapsed]_&)_&]:inline-flex" />
    </x-slot:brand>

    <x-ui.navlist>
        <!-- Navigation items -->
    </x-ui.navlist>
</x-ui.sidebar>
```

**How it works:**
- `<x-long-logo />` displays when the sidebar is **expanded**
- `<x-short-logo />` displays when the sidebar is **collapsed**

**State-aware classes:**
- `[:has([data-collapsed]_&)_&]`: Applies when the sidebar is collapsed
- `[:not(:has([data-collapsed]_&))_&]`: Applies when the sidebar is expanded

#### Brand on Mobile

When using the `sidebar-main` variant, the brand section isn’t displayed on mobile by default. If you want it visible, render it manually inside the header or any visible container. (keep it only under `md:` breack point on other it will be on the sidebar)

```blade
<x-ui.layout.header>
    <x-ui.brand name="Sheaf UI" href="/" class="md:hidden">
        <x-slot:logo>
            <svg xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 100 100"
                class="size-5">
                <rect x="15" y="10" width="80" height="15" fill="currentColor" rx="5" />
                <rect x="15" y="30" width="60" height="15" fill="currentColor" />
                <rect x="15" y="50" width="30" height="15" fill="currentColor" />
                <rect x="15" y="55" width="10" height="30" fill="currentColor" />
            </svg>
        </x-slot:logo>
    </x-ui.brand>
</x-ui.layout.header>
```

This gives you full control over brand placement on mobile screens while keeping the sidebar minimal.


### Sidebar Toggler

In the `sidebar-main` variant, the toggler appears automatically next to the brand on larger screens. On mobile, add it manually inside your header.

```blade
<x-ui.layout.header>
    <x-ui.sidebar.toggle class="md:hidden" />
    <!-- navbar -->
</x-ui.layout.header>
```

Use `md:hidden` to show it only on mobile. The variant handles everything else automatically on larger screens.

### Sidebar with Footer Content

When your sidebar includes both main navigation and footer actions (like user settings or status indicators), use the `x-ui.sidebar.push` component to **push** the footer section to the bottom of the sidebar.
It creates flexible spacing that ensures the footer always stays fixed at the bottom, regardless of how much content the upper section has.

> When using the dropdown for navlist, You need to pass `portal` prop to the dropdown wrapper, it solves the stacking context issue  

#### Example

```blade
<x-ui.sidebar>
    <!-- Brand or header content -->
    <x-ui.navlist>
        <!-- Top navigation items -->
    </x-ui.navlist>

    <!-- Push element (flex spacer)
         keeps following content pinned at the bottom -->
    <x-ui.sidebar.push />

    <!-- Footer section -->
    <x-ui.dropdown portal>
        <x-slot:button>
            <x-ui.navlist.item 
                label="Profile Settings"
                icon="user"
                class="w-full"
            />
        </x-slot:button>
        
        <x-slot:menu class="!w-[14rem]">
            <x-ui.dropdown.item href="#" icon="adjustments-horizontal">
                Preferences
            </x-ui.dropdown.item>
            <x-ui.dropdown.item href="#" icon="user-circle">
                Profile
            </x-ui.dropdown.item>
            <x-ui.dropdown.item href="#" icon="lock-closed">
                Security
            </x-ui.dropdown.item>
            <x-ui.dropdown.item href="#" icon="bell" variant="danger">
                Notifications
            </x-ui.dropdown.item>
        </x-slot:menu>
    </x-ui.dropdown>
</x-ui.sidebar>
```


* `x-ui.sidebar.push` **does not render visible content**; it’s a layout utility.


### Complete Application Layout

A full example with header, navigation, and content:

```blade

<x-ui.layout>
    <x-ui.sidebar>
        <x-slot:brand>
            <x-ui.brand  
                name="Sheaf UI"
                href="#"
            >
                <x-slot:logo>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 100 100"
                        class="size-5">
                        <rect x="15" y="10" width="80" height="15" fill="currentColor" rx="5" ry="0" />
                        <rect x="15" y="30" width="60" height="15" fill="currentColor" />
                        <rect x="15" y="50" width="30" height="15" fill="currentColor" />
                        <rect x="15" y="55" width="10" height="30" fill="currentColor" />
                    </svg>
                </x-slot:logo>
            </x-ui.brand>
        </x-slot:brand>
        <x-ui.navlist>
            <x-ui.navlist.group label="Main">
                <x-ui.navlist.item 
                    label="Dashboard"
                    icon="home"
                    href="/dashboard"
                    :active="request()->is('dashboard')"
                />
                <x-ui.navlist.item 
                    label="Analytics"
                    icon="chart-bar"
                    href="/analytics"
                />
            </x-ui.navlist.group>

            <x-ui.navlist.group 
                label="Management"
                collapsable
            >
                <x-ui.navlist.item 
                    label="Users"
                    icon="users"
                    href="/users"
                    badge="12"
                />
                <x-ui.navlist.item 
                    label="Products"
                    icon="cube"
                    href="/products"
                />
            </x-ui.navlist.group>
        </x-ui.navlist>

        <x-ui.sidebar.push />

       <x-ui.dropdown portal>
            <x-slot:button>
                <x-ui.navlist.item 
                    label="Profile Settings"
                    icon="user"
                    class="w-full"
                />
                <!-- or wrap it with navlist without w-full class -->
                {{-- <x-ui.navlist>
                    <x-ui.navlist.item 
                        label="Profile Settings"
                        icon="user"
                        class="w-full"
                    />
                </x-ui.navlist> --}}
            </x-slot:button>
            
            <x-slot:menu class="!w-[14rem]">
                <x-ui.dropdown.item href="#" icon="adjustments-horizontal">
                    Preference
                </x-ui.dropdown.item>
                
                <x-ui.dropdown.item href="#" icon="user-circle">
                    Profile
                </x-ui.dropdown.item>
                
                <x-ui.dropdown.item href="#" icon="lock-closed">
                    Security
                </x-ui.dropdown.item>
                
                <x-ui.dropdown.item href="#" icon="bell" variant="danger">
                    Notifications
                </x-ui.dropdown.item>
            </x-slot:menu>
        </x-ui.dropdown>
    </x-ui.sidebar>
    <x-ui.layout.main>
        <x-ui.layout.header>
            <x-ui.sidebar.toggle class="md:hidden"/>
            <x-ui.navbar class="flex-1 hidden lg:flex">
                <x-ui.navbar.item
                    icon="home"
                    label="Home" 
                    :href="('/demos/sidebar/home')"
                />
                <x-ui.navbar.item 
                    icon="cog-6-tooth" 
                    label="Settings" 
                    badge="3"
                    badge:color="orange"
                    badge:variant="outline"
                    :href="('/demos/sidebar/settings')"
                />
                <x-ui.dropdown>
                    <x-slot:button>
                        <x-ui.navbar.item 
                            icon="shopping-bag"
                            icon:variant="min" 
                            label="Store" 
                        />
                    </x-slot:button>
                    
                    <x-slot:menu>
                        <x-ui.dropdown.item icon="shopping-bag" :href="('/demos/sidebar/shop/products')">
                            Products
                        </x-ui.dropdown.item>
                        <x-ui.dropdown.item icon="receipt-percent" :href="('/demos/sidebar/shop/orders')">
                            Orders
                        </x-ui.dropdown.item>
                        <x-ui.dropdown.item icon="users" :href="('/demos/sidebar/shop/customers')">
                            Customers
                        </x-ui.dropdown.item>
                        <x-ui.dropdown.item icon="ticket" :href="('/demos/sidebar/shop/discounts')">
                            Discounts
                        </x-ui.dropdown.item>
                    </x-slot:menu>
                </x-ui.dropdown>
            </x-ui.navbar>

            <div class="flex ml-auto gap-x-3 items-center">
                    <x-ui.dropdown position="bottom-end">
                    <x-slot:button class="justify-center">
                        <x-ui.avatar size="sm" src="/mohamed.png" circle alt="Profile Picture" />
                    </x-slot:button>

                    <x-slot:menu class="w-56">
                        <x-ui.dropdown.group label="signed in as">
                            <x-ui.dropdown.item>
                                bo3aza@gmail.com
                            </x-ui.dropdown.item>
                        </x-ui.dropdown.group>

                        <x-ui.dropdown.separator />

                        <x-ui.dropdown.item href="#" wire:navigate.live>
                            Account
                        </x-ui.dropdown.item>

                        <x-ui.dropdown.separator />

                        <form
                            action="#"
                            method="post"
                            class="contents"
                        >
                            @csrf
                            <x-ui.dropdown.item as="button" type="submit">
                                Sign Out
                            </x-ui.dropdown.item>
                        </form>

                    </x-slot:menu>
                </x-ui.dropdown>

                <x-ui.theme-switcher variant="inline" />
            </div>
        </x-ui.layout.header>
    </x-ui.layout.main>
</x-ui.layout>
```

## Sidebar Width
@blade
<x-md.cta                                                            
    href="/docs/layouts/layout#content-essential-css-variables"                                    
    label="need to change the sidebar width ?"
    ctaLabel="Visit Docs"
/>
@endblade

## Component Structure

The sidebar system is built with multiple components working together:

- **Layout Container**: `<x-ui.layout>` - The root grid container managing responsive behavior
- **Sidebar**: `<x-ui.sidebar>` - The sidebar navigation area
- **Sidebar Brand**: Uses `brand` prop or `brand` slot for header content
- **Sidebar Toggle**: `<x-ui.sidebar.toggle>` - Collapse/expand button (internal, auto-included)
- **Sidebar Push**: `<x-ui.sidebar.push>` - Spacer to push content to bottom
- **Main Content**: `<x-ui.layout.main>` - The primary content area

## Component Props

### Layout Component

| Prop Name     | Type    | Default | Required | Description                                    |
| ------------- | ------- | ------- | -------- | ---------------------------------------------- |
| `collapsable` | boolean | `true`  | No       | Whether the layout supports sidebar collapse   |
| `slot`        | mixed   | `''`    | Yes      | Contains sidebar and main content              |

### Sidebar Component

| Prop Name     | Type    | Default        | Required | Description                                          |
| ------------- | ------- | -------------- | -------- | ---------------------------------------------------- |
| `brand`       | string  | `'Brand Name'` | No       | Brand text displayed in sidebar header               |
| `scrollable`  | boolean | `false`        | No       | Whether sidebar content should be scrollable         |
| `collapsable` | boolean | `true`         | No       | Whether sidebar can be collapsed (inherits from layout) |
| `slot`        | mixed   | `''`           | Yes      | Navigation and content within sidebar                |

### Sidebar Push Component

| Prop Name | Type  | Default | Required | Description                                    |
| --------- | ----- | ------- | -------- | ---------------------------------------------- |
| `slot`    | mixed | `''`    | No       | Pushes subsequent content to bottom of sidebar |

### Sidebar Toggle Component

| Prop Name | Type   | Default | Required | Description                           |
| --------- | ------ | ------- | -------- | ------------------------------------- |
| `tooltip` | string | `null`  | No       | Custom tooltip text for toggle button |

**Note:** The toggle is automatically hidden when `collapsable="false"`.

### Layout Main Component

| Prop Name | Type  | Default | Required | Description            |
| --------- | ----- | ------- | -------- | ---------------------- |
| `slot`    | mixed | `''`    | Yes      | Main application content |

