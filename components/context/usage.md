---
name: 'context'
---

## Introduction

The `context` component provides a powerful right-click context menu system with full keyboard navigation, submenus, grouping, and smart positioning.


## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `context` component easily:

```bash
php artisan sheaf:install context
```

## Basic Usage

@blade
<x-demo>
    <x-ui.context class="flex items-center justify-center">
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-16 py-8 w-64">
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

```blade    
<x-ui.context>
    <x-slot:trigger >
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
    <x-ui.context class="flex items-center justify-center">
        <x-slot:trigger >
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

```blade    
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

### Items with Shortcuts

Display keyboard shortcuts alongside context menu actions.

@blade
<x-demo>
    <x-ui.context class="flex items-center justify-center">
        <x-slot:trigger >
            <x-ui.card class="border-dashed border-2 px-16 py-8">
                <x-ui.text class="text-center">Right click for shortcuts</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        <x-slot:menu>
            <x-ui.context.item icon="pencil" shortcut="⌘E">
                Edit
            </x-ui.context.item>
            <x-ui.context.item icon="document-duplicate" shortcut="⌘D">
                Duplicate
            </x-ui.context.item>
            <x-ui.context.item icon="bookmark" shortcut="⌘S">
                Save
            </x-ui.context.item>
            <x-ui.context.item icon="trash" variant="danger" shortcut="⌫">
                Delete
            </x-ui.context.item>
        </x-slot:menu>
    </x-ui.context>
</x-demo>
@endblade

```blade
<x-ui.context>
    <x-slot:trigger>
        <x-ui.card class="border-dashed border-2 px-16 py-8">
            <x-ui.text class="text-center">Right click for shortcuts</x-ui.text>
        </x-ui.card>
    </x-slot:trigger>
    
    <x-slot:menu>
        <x-ui.context.item icon="pencil" shortcut="⌘E">
            Edit
        </x-ui.context.item>
        
        <x-ui.context.item icon="document-duplicate" shortcut="⌘D">
            Duplicate
        </x-ui.context.item>
        
        <x-ui.context.item icon="bookmark" shortcut="⌘S">
            Save
        </x-ui.context.item>
        
        <x-ui.context.item icon="trash" variant="danger" shortcut="⌫">
            Delete
        </x-ui.context.item>
    </x-slot:menu>
</x-ui.context>
```

### Linked Items

Create navigational items that link to other pages.

@blade
<x-demo>
    <x-ui.context class="flex items-center justify-center">
        <x-slot:trigger >
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

```blade    
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
    <x-ui.context class="flex items-center justify-center">
        <x-slot:trigger >
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

```blade    
<x-ui.context >
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
    <x-ui.context class="flex items-center justify-center">
        <x-slot:trigger >
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

```blade    
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
    <x-ui.context class="flex items-center justify-center">
        <x-slot:trigger >
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

```blade    
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
    <x-ui.context class="flex items-center justify-center">
        <x-slot:trigger >
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

```blade    
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

## Checkbox Variant

The context menu supports checkbox items for multi-selection scenarios, just like the dropdown.

### Basic Checkbox Usage

@blade
<x-demo class="flex justify-center">
    <x-ui.context checkbox>
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-16 py-8">
                <x-ui.text class="text-center">Right click to filter</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        
        <x-slot:menu>
            <x-ui.context.item wire:model="filters.active">
                Active Items
            </x-ui.context.item>
            
            <x-ui.context.item wire:model="filters.archived">
                Archived Items
            </x-ui.context.item>
            
            <x-ui.context.item wire:model="filters.deleted">
                Deleted Items
            </x-ui.context.item>
        </x-slot:menu>
    </x-ui.context>
</x-demo>
@endblade

```blade
<x-ui.context checkbox>
    <x-slot:trigger>
        <x-ui.card class="border-dashed border-2 px-16 py-8">
            <x-ui.text class="text-center">Right click to filter</x-ui.text>
        </x-ui.card>
    </x-slot:trigger>
    
    <x-slot:menu>
        <x-ui.context.item wire:model="filters.active">
            Active Items
        </x-ui.context.item>
        
        <x-ui.context.item wire:model="filters.archived">
            Archived Items
        </x-ui.context.item>
        
        <x-ui.context.item wire:model="filters.deleted">
            Deleted Items
        </x-ui.context.item>
    </x-slot:menu>
</x-ui.context>
```

### Custom Checkbox Variant

Use `checkboxVariant` for a more prominent checkbox style with visible checkboxes:

@blade
<x-demo class="flex justify-center">
    <x-ui.context checkbox checkboxVariant>
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-16 py-8">
                <x-ui.text class="text-center">Right click for columns</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        
        <x-slot:menu>
            <x-ui.context.item readOnly>
                Hidden Columns
            </x-ui.context.item>
            
            <x-ui.context.separator/>
            
            <x-ui.context.item wire:model="hiddenCols" value="probability">
                Probability
            </x-ui.context.item>
            
            <x-ui.context.item wire:model="hiddenCols" value="difficulty">
                Difficulty
            </x-ui.context.item>
            
            <x-ui.context.item wire:model="hiddenCols" value="status">
                Status
            </x-ui.context.item>
        </x-slot:menu>
    </x-ui.context>
</x-demo>
@endblade

```blade
<x-ui.context checkbox checkboxVariant>
    <x-slot:trigger>
        <x-ui.card class="border-dashed border-2 px-16 py-8">
            <x-ui.text class="text-center">Right click for columns</x-ui.text>
        </x-ui.card>
    </x-slot:trigger>
    
    <x-slot:menu>
        <x-ui.context.item readOnly>
            Hidden Columns
        </x-ui.context.item>
        
        <x-ui.context.separator/>
        
        <x-ui.context.item wire:model="hiddenCols" value="probability">
            Probability
        </x-ui.context.item>
        
        <x-ui.context.item wire:model="hiddenCols" value="difficulty">
            Difficulty
        </x-ui.context.item>
        
        <x-ui.context.item wire:model="hiddenCols" value="status">
            Status
        </x-ui.context.item>
    </x-slot:menu>
</x-ui.context>
```

**Differences:**
- `checkbox`: Uses a minimal checkmark icon that appears when selected
- `checkboxVariant`: Shows an actual checkbox UI element with background and border

## Radio Variant

For single-selection scenarios, use the radio variant:

@blade
<x-demo class="flex justify-center">
    <x-ui.context radio name="sortBy">
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-16 py-8">
                <x-ui.text class="text-center">Right click to sort</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        
        <x-slot:menu>
            <x-ui.context.item wire:model="sortBy" value="name">
                Name
            </x-ui.context.item>
            
            <x-ui.context.item wire:model="sortBy" value="date">
                Date
            </x-ui.context.item>
            
            <x-ui.context.item wire:model="sortBy" value="size">
                Size
            </x-ui.context.item>
        </x-slot:menu>
    </x-ui.context>
</x-demo>
@endblade

```blade
<x-ui.context radio name="sortBy">
    <x-slot:trigger>
        <x-ui.card class="border-dashed border-2 px-16 py-8">
            <x-ui.text class="text-center">Right click to sort</x-ui.text>
        </x-ui.card>
    </x-slot:trigger>
    
    <x-slot:menu>
        <x-ui.context.item wire:model="sortBy" value="name">
            Name
        </x-ui.context.item>
        
        <x-ui.context.item wire:model="sortBy" value="date">
            Date
        </x-ui.context.item>
        
        <x-ui.context.item wire:model="sortBy" value="size">
            Size
        </x-ui.context.item>
    </x-slot:menu>
</x-ui.context>
```

**Note:** Radio items require a `name` attribute to group them together.

## Read-Only Items (Titles)

Use `readOnly` items as non-interactive section titles or headers within your context menu:

@blade
<x-demo class="flex justify-center">
    <x-ui.context checkbox checkboxVariant>
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-16 py-8">
                <x-ui.text class="text-center">Right click for display options</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        
        <x-slot:menu>
            <x-ui.context.item readOnly>
                View Settings
            </x-ui.context.item>
            
            <x-ui.context.separator/>
            
            <x-ui.context.item wire:model="display.grid">
                Grid View
            </x-ui.context.item>
            
            <x-ui.context.item wire:model="display.list">
                List View
            </x-ui.context.item>
            
            <x-ui.context.separator/>
            
            <x-ui.context.item readOnly>
                Active Filters
            </x-ui.context.item>
            
            <x-ui.context.separator/>
            
            <x-ui.context.item wire:model="filters.active">
                Show Active Only
            </x-ui.context.item>
            
            <x-ui.context.item wire:model="filters.archived">
                Show Archived
            </x-ui.context.item>
        </x-slot:menu>
    </x-ui.context>
</x-demo>
@endblade

```blade
<x-ui.context checkbox checkboxVariant>
    <x-slot:trigger>
        <x-ui.card class="border-dashed border-2 px-16 py-8">
            <x-ui.text class="text-center">Right click for display options</x-ui.text>
        </x-ui.card>
    </x-slot:trigger>
    
    <x-slot:menu>
        <x-ui.context.item readOnly>
            View Settings
        </x-ui.context.item>
        
        <x-ui.context.separator/>
        
        <x-ui.context.item wire:model="display.grid">
            Grid View
        </x-ui.context.item>
        
        <x-ui.context.item wire:model="display.list">
            List View
        </x-ui.context.item>
        
        <x-ui.context.separator/>
        
        <x-ui.context.item readOnly>
            Active Filters
        </x-ui.context.item>
        
        <x-ui.context.separator/>
        
        <x-ui.context.item wire:model="filters.active">
            Show Active Only
        </x-ui.context.item>
        
        <x-ui.context.item wire:model="filters.archived">
            Show Archived
        </x-ui.context.item>
    </x-slot:menu>
</x-ui.context>
```

**Benefits:**
- Provides visual organization
- Non-interactive, preventing accidental clicks
- Spans full width for clear section separation
- Styled differently from regular items

## Positioning

Control where the context menu appears relative to the right-click position. By default, the menu appears at `bottom-start` position from the click point.

You can pass any of these values:

- Top: `top`, `top-start`, `top-end`
- Right: `right`, `right-start`, `right-end`
- Bottom: `bottom`, `bottom-start`, `bottom-end`
- Left: `left`, `left-start`, `left-end`

@blade
<x-demo class="flex justify-center gap-6 flex-wrap">
    <x-ui.context position="bottom">
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-12 py-6">
                <x-ui.text class="text-center text-sm">Bottom</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        <x-slot:menu>
            <x-ui.context.item icon="pencil">Edit</x-ui.context.item>
            <x-ui.context.item icon="document-duplicate">Duplicate</x-ui.context.item>
            <x-ui.context.item icon="trash" variant="danger">Delete</x-ui.context.item>
        </x-slot:menu>
    </x-ui.context>

    <x-ui.context position="top">
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-12 py-6">
                <x-ui.text class="text-center text-sm">Top</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        <x-slot:menu>
            <x-ui.context.item icon="pencil">Edit</x-ui.context.item>
            <x-ui.context.item icon="document-duplicate">Duplicate</x-ui.context.item>
            <x-ui.context.item icon="trash" variant="danger">Delete</x-ui.context.item>
        </x-slot:menu>
    </x-ui.context>

    <x-ui.context position="left">
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-12 py-6">
                <x-ui.text class="text-center text-sm">Left</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        <x-slot:menu>
            <x-ui.context.item icon="pencil">Edit</x-ui.context.item>
            <x-ui.context.item icon="document-duplicate">Duplicate</x-ui.context.item>
            <x-ui.context.item icon="trash" variant="danger">Delete</x-ui.context.item>
        </x-slot:menu>
    </x-ui.context>

    <x-ui.context position="right">
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-12 py-6">
                <x-ui.text class="text-center text-sm">Right</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        <x-slot:menu>
            <x-ui.context.item icon="pencil">Edit</x-ui.context.item>
            <x-ui.context.item icon="document-duplicate">Duplicate</x-ui.context.item>
            <x-ui.context.item icon="trash" variant="danger">Delete</x-ui.context.item>
        </x-slot:menu>
    </x-ui.context>
</x-demo>
@endblade

```blade
<x-ui.context position="bottom">
    <x-slot:trigger>
        <x-ui.card class="border-dashed border-2 px-12 py-6">
            <x-ui.text class="text-center text-sm">Bottom</x-ui.text>
        </x-ui.card>
    </x-slot:trigger>
    <x-slot:menu>
        <x-ui.context.item icon="pencil">Edit</x-ui.context.item>
        <x-ui.context.item icon="document-duplicate">Duplicate</x-ui.context.item>
        <x-ui.context.item icon="trash" variant="danger">Delete</x-ui.context.item>
    </x-slot:menu>
</x-ui.context>

<x-ui.context position="top">
    <x-slot:trigger>
        <x-ui.card class="border-dashed border-2 px-12 py-6">
            <x-ui.text class="text-center text-sm">Top</x-ui.text>
        </x-ui.card>
    </x-slot:trigger>
    <x-slot:menu>
        <x-ui.context.item icon="pencil">Edit</x-ui.context.item>
        <x-ui.context.item icon="document-duplicate">Duplicate</x-ui.context.item>
        <x-ui.context.item icon="trash" variant="danger">Delete</x-ui.context.item>
    </x-slot:menu>
</x-ui.context>
```

## Offset

Add spacing between the right-click point and the context menu by passing the `offset` prop. The default offset is `4` pixels.

@blade
<x-demo class="flex justify-center gap-6 flex-wrap">
    <x-ui.context :offset="0">
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-12 py-6">
                <x-ui.text class="text-center text-sm">No Offset (0)</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        <x-slot:menu>
            <x-ui.context.item icon="pencil">Edit</x-ui.context.item>
            <x-ui.context.item icon="document-duplicate">Duplicate</x-ui.context.item>
            <x-ui.context.item icon="trash" variant="danger">Delete</x-ui.context.item>
        </x-slot:menu>
    </x-ui.context>

    <x-ui.context :offset="8">
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-12 py-6">
                <x-ui.text class="text-center text-sm">Small Offset (8)</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        <x-slot:menu>
            <x-ui.context.item icon="pencil">Edit</x-ui.context.item>
            <x-ui.context.item icon="document-duplicate">Duplicate</x-ui.context.item>
            <x-ui.context.item icon="trash" variant="danger">Delete</x-ui.context.item>
        </x-slot:menu>
    </x-ui.context>

    <x-ui.context :offset="16">
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-12 py-6">
                <x-ui.text class="text-center text-sm">Medium Offset (16)</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        <x-slot:menu>
            <x-ui.context.item icon="pencil">Edit</x-ui.context.item>
            <x-ui.context.item icon="document-duplicate">Duplicate</x-ui.context.item>
            <x-ui.context.item icon="trash" variant="danger">Delete</x-ui.context.item>
        </x-slot:menu>
    </x-ui.context>

    <x-ui.context :offset="24">
        <x-slot:trigger>
            <x-ui.card class="border-dashed border-2 px-12 py-6">
                <x-ui.text class="text-center text-sm">Large Offset (24)</x-ui.text>
            </x-ui.card>
        </x-slot:trigger>
        <x-slot:menu>
            <x-ui.context.item icon="pencil">Edit</x-ui.context.item>
            <x-ui.context.item icon="document-duplicate">Duplicate</x-ui.context.item>
            <x-ui.context.item icon="trash" variant="danger">Delete</x-ui.context.item>
        </x-slot:menu>
    </x-ui.context>
</x-demo>
@endblade

```blade
<!-- No offset -->
<x-ui.context :offset="0">
    ...
</x-ui.context>

<!-- Custom offset -->
<x-ui.context :offset="16">
    ...
</x-ui.context>
```

## Teleport Mode

The `teleport` prop controls where the context menu is rendered in the DOM. By default, the menu is teleported to the `<body>` element. You can override the target selector if needed.

### When to Use a Custom Teleport Target

The default `body` teleport works well in most cases. Override it when rendering inside shadow DOM, isolated portals, or custom stacking contexts:

```blade
<!-- Default: teleports to body -->
<x-ui.context>
    ...
</x-ui.context>

<!-- Custom teleport target -->
<x-ui.context teleport="#my-portal">
    ...
</x-ui.context>
```

**Common scenarios for overriding:**
- Context menus inside shadow DOM components
- Custom modal or dialog portals with their own stacking context
- Isolated rendering environments

## Component Props

### ui.context

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `teleport` | string | `'body'` | No | Where to teleport the menu in the DOM |
| `position` | string | `'bottom-start'` | No | Menu position relative to click point: `top`, `top-start`, `top-end`, `right`, `right-start`, `right-end`, `bottom`, `bottom-start`, `bottom-end`, `left`, `left-start`, `left-end` |
| `offset` | integer | `4` | No | Spacing in pixels between the click point and the menu |
| `checkbox` | boolean | `false` | No | Enable checkbox mode for multi-selection |
| `checkboxVariant` | boolean | `false` | No | Use prominent checkbox UI (requires `checkbox`) |
| `radio` | boolean | `false` | No | Enable radio mode for single selection |
| `name` | string | `null` | No | Name attribute to group radio items |
| `resetFocus` | boolean | `false` | No | Return focus to trigger element when menu closes |
| `class` | string | `''` | No | Additional CSS classes |

### ui.context.item

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `disabled` | boolean | `false` | No | Whether the item is disabled |
| `icon` | string | `null` | No | Icon name to display before text |
| `iconAfter` | string | `null` | No | Icon name to display after text |
| `iconVariant` | string | `'mini'` | No | Icon variant/size |
| `shortcut` | string | `null` | No | Keyboard shortcut to display |
| `variant` | string | `'soft'` | No | Visual variant: `soft`, `danger` |
| `href` | string | `null` | No | URL for navigation items |
| `readOnly` | boolean | `false` | No | Makes item non-interactive (useful as section title) |
| `value` | string | `null` | No | Value for checkbox/radio items |
| `name` | string | `null` | No | Name attribute for radio groups |
| `class` | string | `''` | No | Additional CSS classes |

### ui.context.group

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `label` | string | `null` | No | Optional group label |
| `class` | string | `''` | No | Additional CSS classes |

### ui.context.submenu

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `label` | string | - | Yes | Submenu trigger label |
| `disabled` | boolean | `false` | No | Whether the submenu is disabled |
| `class` | string | `''` | No | Additional CSS classes |

### ui.context.separator

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `class` | string | `''` | No | Additional CSS classes |