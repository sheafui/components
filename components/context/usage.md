---
name: 'context'
---

## Introduction

The `context` component provides a powerful right-click context menu system with full keyboard navigation, submenus, grouping, and smart positioning. It appears at the cursor location when users right-click on the trigger area, featuring smooth animations, proper focus management, and comprehensive ARIA support. Perfect for data tables, file managers, canvas elements, and any interface requiring contextual actions.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `context` component easily:

```bash
php artisan sheaf:install context
```

## Basic Usage

@blade
<x-demo>
    <x-ui.context>
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-16 py-8">
                <x-ui.text class="text-center">Right click here</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        <x-slot:menu>
            <x-ui.context.item>
                Edit
            </x-ui.context.item>
            <x-ui.context.item>
                Duplicate
            </x-ui.context.item>
            <x-ui.context.item>
                Archive
            </x-ui.context.item>
            <x-ui.context.item variant="danger">
                Delete
            </x-ui.context.item>
        </x-slot:menu>
    </x-ui.context>
</x-demo>
@endblade

```html
<x-ui.context>
    <x-slot:trigger>
        <x-ui.card class="border-dashed border-2 px-16 py-8">
            <x-ui.text class="text-center">Right click here</x-ui.text>
        </x-ui.card>
    </x-slot:trigger>
    
    <x-slot:menu>
        <x-ui.context.item>
            Edit
        </x-ui.context.item>
        
        <x-ui.context.item>
            Duplicate
        </x-ui.context.item>
        
        <x-ui.context.item>
            Archive
        </x-ui.context.item>
        
        <x-ui.context.item variant="danger">
            Delete
        </x-ui.context.item>
    </x-slot:menu>
</x-ui.context>
```

## Context Menu Items

### Items with Icons

Add visual clarity with icons for better user experience.

@blade
<x-demo>
    <x-ui.context>
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-16 py-8">
                <x-ui.text class="text-center">Right click for actions</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        <x-slot:menu>
            <x-ui.context.item icon="pencil">
                Edit
            </x-ui.context.item>
            <x-ui.context.item icon="document-duplicate">
                Duplicate
            </x-ui.context.item>
            <x-ui.context.item icon="archive-box">
                Archive
            </x-ui.context.item>
            <x-ui.context.item icon="trash" variant="danger">
                Delete
            </x-ui.context.item>
        </x-slot:menu>
    </x-ui.context>
</x-demo>
@endblade

```html
<x-ui.context>
    <x-slot:trigger>
        <x-ui.card class="border-dashed border-2 px-16 py-8">
            <x-ui.text class="text-center">Right click for actions</x-ui.text>
        </x-ui.card>
    </x-slot:trigger>
    
    <x-slot:menu>
        <x-ui.context.item icon="pencil">
            Edit
        </x-ui.context.item>
        
        <x-ui.context.item icon="document-duplicate">
            Duplicate
        </x-ui.context.item>
        
        <x-ui.context.item icon="archive-box">
            Archive
        </x-ui.context.item>
        
        <x-ui.context.item icon="trash" variant="danger">
            Delete
        </x-ui.context.item>
    </x-slot:menu>
</x-ui.context>
```

### Linked Items

Create navigational items that link to other pages.

@blade
<x-demo>
    <x-ui.context>
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-16 py-8">
                <x-ui.text class="text-center">Right click for navigation</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        <x-slot:menu>
            <x-ui.context.item href="/dashboard" icon="home">
                Dashboard
            </x-ui.context.item>
            <x-ui.context.item href="/profile" icon="user">
                Profile
            </x-ui.context.item>
            <x-ui.context.item href="/settings" icon="cog">
                Settings
            </x-ui.context.item>
        </x-slot:menu>
    </x-ui.context>
</x-demo>
@endblade

```html
<x-ui.context>
    <x-slot:trigger>
        <x-ui.card class="border-dashed border-2 px-16 py-8">
            <x-ui.text class="text-center">Right click for navigation</x-ui.text>
        </x-ui.card>
    </x-slot:trigger>
    
    <x-slot:menu>
        <x-ui.context.item href="/dashboard" icon="home">
            Dashboard
        </x-ui.context.item>
        
        <x-ui.context.item href="/profile" icon="user">
            Profile
        </x-ui.context.item>
        
        <x-ui.context.item href="/settings" icon="cog">
            Settings
        </x-ui.context.item>
    </x-slot:menu>
</x-ui.context>
```

### Disabled Items

Temporarily disable certain actions while keeping them visible.

@blade
<x-demo>
    <x-ui.context>
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-16 py-8">
                <x-ui.text class="text-center">Right click for mixed states</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        <x-slot:menu>
            <x-ui.context.item icon="pencil">
                Edit
            </x-ui.context.item>
            <x-ui.context.item icon="document-duplicate">
                Duplicate
            </x-ui.context.item>
            <x-ui.context.item icon="shield-check" disabled>
                Protected Action
            </x-ui.context.item>
            <x-ui.context.item icon="trash" variant="danger" disabled>
                Delete (Restricted)
            </x-ui.context.item>
        </x-slot:menu>
    </x-ui.context>
</x-demo>
@endblade

```html
<x-ui.context>
    <x-slot:trigger>
        <x-ui.card class="border-dashed border-2 px-16 py-8">
            <x-ui.text class="text-center">Right click for mixed states</x-ui.text>
        </x-ui.card>
    </x-slot:trigger>
    
    <x-slot:menu>
        <x-ui.context.item icon="pencil">
            Edit
        </x-ui.context.item>
        
        <x-ui.context.item icon="document-duplicate">
            Duplicate
        </x-ui.context.item>
        
        <x-ui.context.item icon="shield-check" disabled>
            Protected Action
        </x-ui.context.item>
        
        <x-ui.context.item icon="trash" variant="danger" disabled>
            Delete (Restricted)
        </x-ui.context.item>
    </x-slot:menu>
</x-ui.context>
```

## Separators

Use separators to group related items and create visual hierarchy.

@blade
<x-demo>
    <x-ui.context>
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-16 py-8">
                <x-ui.text class="text-center">Right click for grouped actions</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        <x-slot:menu>
            <x-ui.context.item icon="pencil">
                Edit
            </x-ui.context.item>
            <x-ui.context.item icon="document-duplicate">
                Duplicate
            </x-ui.context.item>
            <x-ui.context.separator />
            <x-ui.context.item icon="eye">
                View Details
            </x-ui.context.item>
            <x-ui.context.item icon="share">
                Share
            </x-ui.context.item>
            <x-ui.context.separator />
            <x-ui.context.item icon="trash" variant="danger">
                Delete
            </x-ui.context.item>
        </x-slot:menu>
    </x-ui.context>
</x-demo>
@endblade

```html
<x-ui.context>
    <x-slot:trigger>
        <x-ui.card class="border-dashed border-2 px-16 py-8">
            <x-ui.text class="text-center">Right click for grouped actions</x-ui.text>
        </x-ui.card>
    </x-slot:trigger>
    
    <x-slot:menu>
        <x-ui.context.item icon="pencil">
            Edit
        </x-ui.context.item>
        
        <x-ui.context.item icon="document-duplicate">
            Duplicate
        </x-ui.context.item>
        
        <x-ui.context.separator />
        
        <x-ui.context.item icon="eye">
            View Details
        </x-ui.context.item>
        
        <x-ui.context.item icon="share">
            Share
        </x-ui.context.item>
        
        <x-ui.context.separator />
        
        <x-ui.context.item icon="trash" variant="danger">
            Delete
        </x-ui.context.item>
    </x-slot:menu>
</x-ui.context>
```

## Grouping Items

Use groups to organize related items with optional labels.

@blade
<x-demo>
    <x-ui.context>
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-16 py-8">
                <x-ui.text class="text-center">Right click for grouped menu</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        <x-slot:menu>
            <x-ui.context.item icon="user">
                Edit Profile
            </x-ui.context.item>
            <x-ui.context.separator />
            <x-ui.context.item>
                Duplicate
            </x-ui.context.item>
            <x-ui.context.group label="Operations">
                <x-ui.context.item icon="archive-box">
                    Archive
                </x-ui.context.item>
                <x-ui.context.item variant="danger" icon="trash">
                    Delete
                </x-ui.context.item>
            </x-ui.context.group>
        </x-slot:menu>
    </x-ui.context>
</x-demo>
@endblade

```html
<x-ui.context>
    <x-slot:trigger>
        <x-ui.card class="border-dashed border-2 px-16 py-8">
            <x-ui.text class="text-center">Right click for grouped menu</x-ui.text>
        </x-ui.card>
    </x-slot:trigger>
    
    <x-slot:menu>
        <x-ui.context.item icon="user">
            Edit Profile
        </x-ui.context.item>

        <x-ui.context.separator />
        
        <x-ui.context.item>
            Duplicate
        </x-ui.context.item>
        
        <x-ui.context.group label="Operations">
            <x-ui.context.item icon="archive-box">
                Archive
            </x-ui.context.item>
            
            <x-ui.context.item variant="danger" icon="trash">
                Delete
            </x-ui.context.item>
        </x-ui.context.group>
    </x-slot:menu>
</x-ui.context>
```

## Submenus

Create hierarchical menus with nested items.

@blade
<x-demo>
    <x-ui.context>
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-16 py-8">
                <x-ui.text class="text-center">Right click for file menu</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        <x-slot:menu>
            <x-ui.context.item icon="document-plus">
                New File
            </x-ui.context.item>
            <x-ui.context.item icon="folder-open">
                Open File
            </x-ui.context.item>
            <x-ui.context.submenu label="Recent Files">
                <x-ui.context.item icon="document">
                    document1.pdf
                </x-ui.context.item>
                <x-ui.context.item icon="document">
                    notes.txt
                </x-ui.context.item>
                <x-ui.context.item icon="document">
                    spreadsheet.xlsx
                </x-ui.context.item>
                <x-ui.context.separator />
                <x-ui.context.item class="text-gray-500 dark:text-gray-400">
                    Clear Recent
                </x-ui.context.item>
            </x-ui.context.submenu>
            <x-ui.context.submenu label="Export">
                <x-ui.context.item icon="document">
                    Export as PDF
                </x-ui.context.item>
                <x-ui.context.item icon="document">
                    Export as Word
                </x-ui.context.item>
                <x-ui.context.item icon="document">
                    Export as Excel
                </x-ui.context.item>
            </x-ui.context.submenu>
            <x-ui.context.separator />
            <x-ui.context.item icon="cog">
                Settings
            </x-ui.context.item>
        </x-slot:menu>
    </x-ui.context>
</x-demo>
@endblade

```html
<x-ui.context>
    <x-slot:trigger>
        <x-ui.card class="border-dashed border-2 px-16 py-8">
            <x-ui.text class="text-center">Right click for file menu</x-ui.text>
        </x-ui.card>
    </x-slot:trigger>
    
    <x-slot:menu>
        <x-ui.context.item icon="document-plus">
            New File
        </x-ui.context.item>
        
        <x-ui.context.item icon="folder-open">
            Open File
        </x-ui.context.item>
        
        <x-ui.context.submenu label="Recent Files">
            <x-ui.context.item icon="document">
                document1.pdf
            </x-ui.context.item>
            
            <x-ui.context.item icon="document">
                notes.txt
            </x-ui.context.item>
            
            <x-ui.context.item icon="document">
                spreadsheet.xlsx
            </x-ui.context.item>
            
            <x-ui.context.separator />
            
            <x-ui.context.item class="text-gray-500 dark:text-gray-400">
                Clear Recent
            </x-ui.context.item>
        </x-ui.context.submenu>
        
        <x-ui.context.submenu label="Export">
            <x-ui.context.item icon="document">
                Export as PDF
            </x-ui.context.item>
            
            <x-ui.context.item icon="document">
                Export as Word
            </x-ui.context.item>
            
            <x-ui.context.item icon="document">
                Export as Excel
            </x-ui.context.item>
        </x-ui.context.submenu>

        <x-ui.context.separator />
        
        <x-ui.context.item icon="cog">
            Settings
        </x-ui.context.item>
    </x-slot:menu>
</x-ui.context>
```

## Component Props

### Context (Main Component)

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `teleport` | string | `'body'` | No | Where to teleport the menu in the DOM |
| `class` | string | `''` | No | Additional CSS classes |

### Context Item

The context item component wraps the dropdown item component and inherits all its props:

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `disabled` | boolean | `false` | No | Whether the item is disabled |
| `icon` | string | `null` | No | Icon name to display before text |
| `iconAfter` | string | `null` | No | Icon name to display after text |
| `iconVariant` | string | `'mini'` | No | Icon variant/size |
| `variant` | string | `'soft'` | No | Visual variant: `soft`, `danger` |
| `href` | string | `null` | No | URL for navigation items |
| `class` | string | `''` | No | Additional CSS classes |

### Context Group

The context group component wraps the dropdown group component:

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `label` | string | `null` | No | Optional group label |
| `class` | string | `''` | No | Additional CSS classes |

### Context Submenu

The context submenu component wraps the dropdown submenu component:

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `label` | string | - | Yes | Submenu trigger label |
| `disabled` | boolean | `false` | No | Whether the submenu is disabled |
| `class` | string | `''` | No | Additional CSS classes |

### Context Separator

The context separator component wraps the dropdown separator:

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `class` | string | `''` | No | Additional CSS classes |


