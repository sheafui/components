---
name: 'dropdown'
---

## Introduction

The `dropdown` component provides a powerful and accessible dropdown menu system with full keyboard navigation, submenus, grouping, and customizable positioning. It features smooth animations, proper focus management, and comprehensive ARIA support. Perfect for actions menus, navigation, settings, and any hierarchical menu structure.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `dropdown` component easily:

```bash
php artisan sheaf:install dropdown
```

## Basic Usage

@blade
<x-demo >
    <x-ui.dropdown>
        <x-slot:button class="justify-center">
            <x-ui.button >
                Actions
            </x-ui.button>
        </x-slot:button>
        <x-slot:menu>
            <x-ui.dropdown.item>
                Edit
            </x-ui.dropdown.item>
            <x-ui.dropdown.item>
                Duplicate
            </x-ui.dropdown.item>
            <x-ui.dropdown.item>
                Archive
            </x-ui.dropdown.item>
            <x-ui.dropdown.item variant="danger">
                Delete
            </x-ui.dropdown.item>
        </x-slot:menu>
    </x-ui.dropdown>
</x-demo>
@endblade

```blade
<x-ui.dropdown>
    <x-slot:button class="justify-center">
        <x-ui.button >
            Actions
        </x-ui.button>
    </x-slot:button>
    
    <x-slot:menu>
        <x-ui.dropdown.item>
            Edit
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item>
            Duplicate
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item>
            Archive
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item variant="danger">
            Delete
        </x-ui.dropdown.item>
    </x-slot:menu>
</x-ui.dropdown>
```

## Dropdown Items

### Items with Icons

Add visual clarity with icons for better user experience.

@blade
<x-demo >
    <x-ui.dropdown>
        <x-slot:button class="justify-center">
            <x-ui.button >
                Actions with Icons
            </x-ui.button>
        </x-slot:button>
        <x-slot:menu>
            <x-ui.dropdown.item icon="pencil" iconAfter="pencil">
                Edit
            </x-ui.dropdown.item>
            <x-ui.dropdown.item icon="document-duplicate">
                Duplicate
            </x-ui.dropdown.item>
            <x-ui.dropdown.item icon="archive-box">
                Archive
            </x-ui.dropdown.item>
            <x-ui.dropdown.item icon="trash" variant="danger">
                Delete
            </x-ui.dropdown.item>
        </x-slot:menu>
    </x-ui.dropdown>
</x-demo>
@endblade

```blade
<x-ui.dropdown>
    <x-slot:button class="justify-center">
        <x-ui.button >
            Actions with Icons
        </x-ui.button>
    </x-slot:button>
    
    <x-slot:menu>
        <x-ui.dropdown.item icon="pencil">
            Edit
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item icon="document-duplicate">
            Duplicate
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item icon="archive-box">
            Archive
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item icon="trash" variant="danger">
            Delete
        </x-ui.dropdown.item>
    </x-slot:menu>
</x-ui.dropdown>
```

### Items with Shortcuts

Display keyboard shortcuts for power users.

@blade
<x-demo >
    <x-ui.dropdown>
        <x-slot:button class="justify-center">
            <x-ui.button >
                File Menu
            </x-ui.button>
        </x-slot:button>
        <x-slot:menu>
            <x-ui.dropdown.item icon="document-plus" shortcut="⌘N">
                New File
            </x-ui.dropdown.item>
            <x-ui.dropdown.item icon="folder-open" shortcut="⌘O">
                Open File
            </x-ui.dropdown.item>
            <x-ui.dropdown.item icon="bookmark" shortcut="⌘S">
                Save
            </x-ui.dropdown.item>
            <x-ui.dropdown.item icon="document-duplicate" shortcut="⌘D">
                Duplicate
            </x-ui.dropdown.item>
        </x-slot:menu>
    </x-ui.dropdown>
</x-demo>
@endblade

```blade
<x-ui.dropdown>
    <x-slot:button class="justify-center">
        <x-ui.button >
            File Menu
        </x-ui.button>
    </x-slot:button>
    
    <x-slot:menu>
        <x-ui.dropdown.item icon="document-plus" shortcut="⌘N">
            New File
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item icon="folder-open" shortcut="⌘O">
            Open File
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item icon="bookmark" shortcut="⌘S">
            Save
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item icon="document-duplicate" shortcut="⌘D">
            Duplicate
        </x-ui.dropdown.item>
    </x-slot:menu>
</x-ui.dropdown>
```

### Linked Items

Create navigational items that link to other pages.

@blade
<x-demo >
    <x-ui.dropdown>
        <x-slot:button class="justify-center">
            <x-ui.button >
                Navigation
            </x-ui.button>
        </x-slot:button>
        <x-slot:menu>
            <x-ui.dropdown.item href="/dashboard" icon="home">
                Dashboard
            </x-ui.dropdown.item>
            <x-ui.dropdown.item href="/profile" icon="user">
                Profile
            </x-ui.dropdown.item>
            <x-ui.dropdown.item href="/settings" icon="cog">
                Settings
            </x-ui.dropdown.item>
        </x-slot:menu>
    </x-ui.dropdown>
</x-demo>
@endblade

```blade
<x-ui.dropdown>
    <x-slot:button class="justify-center">
        <x-ui.button >
            Navigation
        </x-ui.button>
    </x-slot:button>
    
    <x-slot:menu>
        <x-ui.dropdown.item href="/dashboard" icon="home">
            Dashboard
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item href="/profile" icon="user">
            Profile
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item href="/settings" icon="cog">
            Settings
        </x-ui.dropdown.item>
    </x-slot:menu>
</x-ui.dropdown>
```

### Disabled Items

Temporarily disable certain actions while keeping them visible.

@blade
<x-demo >
    <x-ui.dropdown>
        <x-slot:button class="justify-center">
            <x-ui.button >
                Mixed States
            </x-ui.button>
        </x-slot:button>
        <x-slot:menu>
            <x-ui.dropdown.item icon="pencil">
                Edit
            </x-ui.dropdown.item>
            <x-ui.dropdown.item icon="document-duplicate">
                Duplicate
            </x-ui.dropdown.item>
            <x-ui.dropdown.item icon="shield-check" disabled>
                Protected Action
            </x-ui.dropdown.item>
            <x-ui.dropdown.item icon="trash" variant="danger" disabled>
                Delete (Restricted)
            </x-ui.dropdown.item>
        </x-slot:menu>
    </x-ui.dropdown>
</x-demo>
@endblade

```blade
<x-ui.dropdown>
    <x-slot:button class="justify-center">
        <x-ui.button >
            Mixed States
        </x-ui.button>
    </x-slot:button>
    
    <x-slot:menu>
        <x-ui.dropdown.item icon="pencil">
            Edit
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item icon="document-duplicate">
            Duplicate
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item icon="shield-check" disabled>
            Protected Action
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item icon="trash" variant="danger" disabled>
            Delete (Restricted)
        </x-ui.dropdown.item>
    </x-slot:menu>
</x-ui.dropdown>
```

## Separators

Use separators to group related items and create visual hierarchy.

@blade
<x-demo >
    <x-ui.dropdown>
        <x-slot:button class="justify-center">
            <x-ui.button >
                Grouped Actions
            </x-ui.button>
        </x-slot:button>
        <x-slot:menu>
            <x-ui.dropdown.item icon="pencil">
                Edit
            </x-ui.dropdown.item>
            <x-ui.dropdown.item icon="document-duplicate">
                Duplicate
            </x-ui.dropdown.item>
            <x-ui.dropdown.separator />
            <x-ui.dropdown.item icon="eye">
                View Details
            </x-ui.dropdown.item>
            <x-ui.dropdown.item icon="share">
                Share
            </x-ui.dropdown.item>
            <x-ui.dropdown.separator />
            <x-ui.dropdown.item icon="trash" variant="danger">
                Delete
            </x-ui.dropdown.item>
        </x-slot:menu>
    </x-ui.dropdown>
</x-demo>
@endblade

```blade
<x-ui.dropdown>
    <x-slot:button class="justify-center">
        <x-ui.button >
            Grouped Actions
        </x-ui.button>
    </x-slot:button>
    
    <x-slot:menu>
        <x-ui.dropdown.item icon="pencil">
            Edit
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item icon="document-duplicate">
            Duplicate
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.separator />
        
        <x-ui.dropdown.item icon="eye">
            View Details
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item icon="share">
            Share
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.separator />
        
        <x-ui.dropdown.item icon="trash" variant="danger">
            Delete
        </x-ui.dropdown.item>
    </x-slot:menu>
</x-ui.dropdown>
```

## Grouping Items

Use groups to organize related items with optional labels.

@blade
<x-demo >
    <x-ui.dropdown>
        <x-slot:button class="justify-center">
            <x-ui.button >
                Grouped Menu
            </x-ui.button>
        </x-slot:button>
        <x-slot:menu>
            <x-ui.dropdown.item icon="user">
                Edit Profile
            </x-ui.dropdown.item>
            <x-ui.dropdown.separator />
            <x-ui.dropdown.item shortcut="⌘D">
                Duplicate
            </x-ui.dropdown.item>
            <x-ui.dropdown.group label="Operations">
                <x-ui.dropdown.item icon="archive-box">
                    Archive
                </x-ui.dropdown.item>
                <x-ui.dropdown.item variant="danger" icon="trash">
                    Delete
                </x-ui.dropdown.item>
            </x-ui.dropdown.group>
        </x-slot:menu>
    </x-ui.dropdown>
</x-demo>
@endblade

```blade
<x-ui.dropdown>
    <x-slot:button class="justify-center">
        <x-ui.button >
            Grouped Menu
        </x-ui.button>
    </x-slot:button>
    
    <x-slot:menu>
        <x-ui.dropdown.item icon="user">
            Edit Profile
        </x-ui.dropdown.item>

        <x-ui.dropdown.separator />
        
        <x-ui.dropdown.item shortcut="⌘D">
            Duplicate
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.group label="Operations">
            <x-ui.dropdown.item icon="archive-box">
                Archive
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item variant="danger" icon="trash">
                Delete
            </x-ui.dropdown.item>
        </x-ui.dropdown.group>
    </x-slot:menu>
</x-ui.dropdown>
```

## Positioning

Control where the dropdown appears relative to the trigger button.

@blade
<x-demo class="flex justify-center">
     <div class="flex gap-4 flex-wrap">
        <x-ui.dropdown position="bottom-center">
            <x-slot:button class="justify-center">
                <x-ui.button >
                    Bottom Center
                </x-ui.button>
            </x-slot:button>
            <x-slot:menu>
                <x-ui.dropdown.item>Edit</x-ui.dropdown.item>
                <x-ui.dropdown.item>Copy</x-ui.dropdown.item>
                <x-ui.dropdown.item>Delete</x-ui.dropdown.item>
            </x-slot:menu>
        </x-ui.dropdown>
        <x-ui.dropdown position="bottom-start">
            <x-slot:button>
                <x-ui.button >
                    Bottom Start
                </x-ui.button>
            </x-slot:button>
            <x-slot:menu>
                <x-ui.dropdown.item>Edit</x-ui.dropdown.item>
                <x-ui.dropdown.item>Copy</x-ui.dropdown.item>
                <x-ui.dropdown.item>Delete</x-ui.dropdown.item>
            </x-slot:menu>
        </x-ui.dropdown>
        <x-ui.dropdown position="bottom-end">
            <x-slot:button>
                <x-ui.button >
                    Bottom End
                </x-ui.button>
            </x-slot:button>
            <x-slot:menu>
                <x-ui.dropdown.item>Edit</x-ui.dropdown.item>
                <x-ui.dropdown.item>Copy</x-ui.dropdown.item>
                <x-ui.dropdown.item>Delete</x-ui.dropdown.item>
            </x-slot:menu>
        </x-ui.dropdown>
    </div>
</x-demo>
@endblade

```blade
<x-ui.dropdown position="bottom-center">
    <x-slot:button class="justify-center">
        <x-ui.button >
            Bottom Center
        </x-ui.button>
    </x-slot:button>
    
    <x-slot:menu>
        <x-ui.dropdown.item>Edit</x-ui.dropdown.item>
        <x-ui.dropdown.item>Copy</x-ui.dropdown.item>
        <x-ui.dropdown.item>Delete</x-ui.dropdown.item>
    </x-slot:menu>
</x-ui.dropdown>

<x-ui.dropdown position="bottom-start">
    <x-slot:button class="justify-center">
        <x-ui.button >
            Bottom Start
        </x-ui.button>
    </x-slot:button>
    
    <x-slot:menu>
        <x-ui.dropdown.item>Edit</x-ui.dropdown.item>
        <x-ui.dropdown.item>Copy</x-ui.dropdown.item>
        <x-ui.dropdown.item>Delete</x-ui.dropdown.item>
    </x-slot:menu>
</x-ui.dropdown>
```

## Submenus

Create hierarchical menus with nested items.

@blade
<x-demo class="flex justify-center">
    <x-ui.dropdown position="bottom-start">
        <x-slot:button>
            <x-ui.button >
                File Menu
            </x-ui.button>
        </x-slot:button>
        <x-slot:menu>
            <x-ui.dropdown.item icon="document-plus" shortcut="⌘N">
                New File
            </x-ui.dropdown.item>
            <x-ui.dropdown.item icon="folder-open" shortcut="⌘O">
                Open File
            </x-ui.dropdown.item>
            <x-ui.dropdown.submenu label="Recent Files">
                <x-ui.dropdown.item icon="document">
                    document1.pdf
                </x-ui.dropdown.item>
                <x-ui.dropdown.item icon="document">
                    project-notes.txt
                </x-ui.dropdown.item>
                <x-ui.dropdown.item icon="document">
                    spreadsheet.xlsx
                </x-ui.dropdown.item>
                <x-ui.dropdown.separator />
                <x-ui.dropdown.item class="text-gray-500 dark:text-gray-400">
                    Clear Recent
                </x-ui.dropdown.item>
            </x-ui.dropdown.submenu>
            <x-ui.dropdown.submenu label="Export">
                <x-ui.dropdown.item icon="document">
                    Export as PDF
                </x-ui.dropdown.item>
                <x-ui.dropdown.item icon="document">
                    Export as Word
                </x-ui.dropdown.item>
                <x-ui.dropdown.item icon="document">
                    Export as Excel
                </x-ui.dropdown.item>
            </x-ui.dropdown.submenu>
            <x-ui.dropdown.separator />
            <x-ui.dropdown.item icon="cog">
                Settings
            </x-ui.dropdown.item>
        </x-slot:menu>
    </x-ui.dropdown>
</x-demo>
@endblade

```blade
<x-ui.dropdown position="bottom-start">
    <x-slot:button>
        <x-ui.button >
            File Menu
        </x-ui.button>
    </x-slot:button>
    
    <x-slot:menu>
        <x-ui.dropdown.item icon="document-plus" shortcut="⌘N">
            New File
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item icon="folder-open" shortcut="⌘O">
            Open File
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.submenu label="Recent Files">
            <x-ui.dropdown.item icon="document">
                document1.pdf
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item icon="document">
                project-notes.txt
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item icon="document">
                spreadsheet.xlsx
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.separator />
            
            <x-ui.dropdown.item class="text-gray-500 dark:text-gray-400">
                Clear Recent
            </x-ui.dropdown.item>
        </x-ui.dropdown.submenu>
        
        <x-ui.dropdown.submenu label="Export">
            <x-ui.dropdown.item icon="document">
                Export as PDF
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item icon="document">
                Export as Word
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item icon="document">
                Export as Excel
            </x-ui.dropdown.item>
        </x-ui.dropdown.submenu>

        <x-ui.dropdown.separator />
        
        <x-ui.dropdown.item icon="cog">
            Settings
        </x-ui.dropdown.item>
    </x-slot:menu>
</x-ui.dropdown>
```

## Complex Structure

Combine all features for sophisticated dropdown menus.

@blade
<x-demo class="flex justify-center">
    <x-ui.dropdown position="bottom-start">
        <x-slot:button>
            <x-ui.button >
                Advanced Menu
            </x-ui.button>
        </x-slot:button>
        <x-slot:menu>
            <x-ui.dropdown.group label="File Operations">
                <x-ui.dropdown.item icon="document-plus" shortcut="⌘N">
                    New File
                </x-ui.dropdown.item>
                <x-ui.dropdown.item icon="folder-open" shortcut="⌘O">
                    Open File
                </x-ui.dropdown.item>
                <x-ui.dropdown.item icon="bookmark" shortcut="⌘S">
                    Save
                </x-ui.dropdown.item>
            </x-ui.dropdown.group>
            <x-ui.dropdown.submenu label="Recent Files">
                <x-ui.dropdown.item icon="document">
                    Important Document.pdf
                </x-ui.dropdown.item>
                <x-ui.dropdown.item icon="document">
                    Meeting Notes.txt
                </x-ui.dropdown.item>
                <x-ui.dropdown.item icon="document">
                    Budget 2024.xlsx
                </x-ui.dropdown.item>
            </x-ui.dropdown.submenu>
            <x-ui.dropdown.separator />
            <x-ui.dropdown.group label="Actions">
                <x-ui.dropdown.item icon="pencil">
                    Edit
                </x-ui.dropdown.item>
                <x-ui.dropdown.item icon="document-duplicate" shortcut="⌘C">
                    Copy
                </x-ui.dropdown.item>
                <x-ui.dropdown.item icon="clipboard" shortcut="⌘V">
                    Paste
                </x-ui.dropdown.item>
                <x-ui.dropdown.item icon="share">
                    Share
                </x-ui.dropdown.item>
            </x-ui.dropdown.group>
            <x-ui.dropdown.separator />
            <x-ui.dropdown.item icon="cog">
                Settings
            </x-ui.dropdown.item>
            <x-ui.dropdown.item icon="question-mark-circle">
                Help
            </x-ui.dropdown.item>
            <x-ui.dropdown.separator />
            <x-ui.dropdown.item icon="trash" variant="danger">
                Delete
            </x-ui.dropdown.item>
        </x-slot:menu>
    </x-ui.dropdown>
</x-demo>
@endblade

```blade
<x-ui.dropdown position="bottom-start">
    <x-slot:button>
        <x-ui.button >
            Advanced Menu
        </x-ui.button>
    </x-slot:button>
    
    <x-slot:menu>
        <x-ui.dropdown.group label="File Operations">
            <x-ui.dropdown.item icon="document-plus" shortcut="⌘N">
                New File
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item icon="folder-open" shortcut="⌘O">
                Open File
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item icon="bookmark" shortcut="⌘S">
                Save
            </x-ui.dropdown.item>
        </x-ui.dropdown.group>
        
        <x-ui.dropdown.submenu label="Recent Files">
            <x-ui.dropdown.item icon="document">
                Important Document.pdf
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item icon="document">
                Meeting Notes.txt
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item icon="document">
                Budget 2024.xlsx
            </x-ui.dropdown.item>
        </x-ui.dropdown.submenu>
        
        <x-ui.dropdown.separator />
        
        <x-ui.dropdown.group label="Actions">
            <x-ui.dropdown.item icon="pencil">
                Edit
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item icon="document-duplicate" shortcut="⌘C">
                Copy
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item icon="clipboard" shortcut="⌘V">
                Paste
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item icon="share">
                Share
            </x-ui.dropdown.item>
        </x-ui.dropdown.group>
        
        <x-ui.dropdown.separator />
        
        <x-ui.dropdown.item icon="cog">
            Settings
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item icon="question-mark-circle">
            Help
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.separator />
        
        <x-ui.dropdown.item icon="trash" variant="danger">
            Delete
        </x-ui.dropdown.item>
    </x-slot:menu>
</x-ui.dropdown>
```

Here's the section to add to your dropdown documentation:

## Checkbox Variant

The dropdown now supports checkbox items for multi-selection scenarios. When enabled, items can be toggled on/off independently.

### Basic Checkbox Usage

@blade
<x-demo class="flex justify-center">
    <x-ui.dropdown checkbox>
        <x-slot:button>
            <x-ui.button icon="funnel" variant="soft" size="sm">
                Filters
            </x-ui.button>
        </x-slot:button>
        
        <x-slot:menu>
            <x-ui.dropdown.item wire:model="filters.active">
                Active Items
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item wire:model="filters.archived">
                Archived Items
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item wire:model="filters.deleted">
                Deleted Items
            </x-ui.dropdown.item>
        </x-slot:menu>
    </x-ui.dropdown>
</x-demo>
@endblade

```blade
<x-ui.dropdown checkbox>
    <x-slot:button>
        <x-ui.button icon="funnel" variant="soft" size="sm">
            Filters
        </x-ui.button>
    </x-slot:button>
    
    <x-slot:menu>
        <x-ui.dropdown.item wire:model="filters.active">
            Active Items
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item wire:model="filters.archived">
            Archived Items
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item wire:model="filters.deleted">
            Deleted Items
        </x-ui.dropdown.item>
    </x-slot:menu>
</x-ui.dropdown>
```

### Custom Checkbox Variant

Use `checkboxVariant` for a more prominent checkbox style with visible checkboxes:

@blade
<x-demo class="flex justify-center">
    <x-ui.dropdown checkbox checkboxVariant>
        <x-slot:button>
            <x-ui.button icon="funnel" variant="soft" size="sm">
                Column Visibility
            </x-ui.button>
        </x-slot:button>
        
        <x-slot:menu>
            <x-ui.dropdown.item readOnly>
                Hidden Columns
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.separator/>
            
            <x-ui.dropdown.item wire:model="hiddenCols" value="probability">
                Probability
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item wire:model="hiddenCols" value="difficulty">
                Difficulty
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item wire:model="hiddenCols" value="status">
                Status
            </x-ui.dropdown.item>
        </x-slot:menu>
    </x-ui.dropdown>
</x-demo>
@endblade

```blade
<x-ui.dropdown checkbox checkboxVariant>
    <x-slot:button>
        <x-ui.button icon="funnel" variant="soft" size="sm">
            Column Visibility
        </x-ui.button>
    </x-slot:button>
    
    <x-slot:menu>
        <x-ui.dropdown.item readOnly>
            Hidden Columns
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.separator/>
        
        <x-ui.dropdown.item wire:model="hiddenCols" value="probability">
            Probability
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item wire:model="hiddenCols" value="difficulty">
            Difficulty
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item wire:model="hiddenCols" value="status">
            Status
        </x-ui.dropdown.item>
    </x-slot:menu>
</x-ui.dropdown>
```

**Differences:**
- `checkbox`: Uses a minimal checkmark icon that appears when selected
- `checkboxVariant`: Shows an actual checkbox UI element with background and border

## Radio Variant

For single-selection scenarios, use the radio variant:

@blade
<x-demo class="flex justify-center">
    <x-ui.dropdown radio name="sortBy">
        <x-slot:button>
            <x-ui.button icon="arrows-up-down" variant="soft" size="sm">
                Sort By
            </x-ui.button>
        </x-slot:button>
        
        <x-slot:menu>
            <x-ui.dropdown.item wire:model="sortBy" value="name">
                Name
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item wire:model="sortBy" value="date">
                Date
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item wire:model="sortBy" value="size">
                Size
            </x-ui.dropdown.item>
        </x-slot:menu>
    </x-ui.dropdown>
</x-demo>
@endblade

```blade
<x-ui.dropdown radio name="sortBy">
    <x-slot:button>
        <x-ui.button icon="arrows-up-down" variant="soft" size="sm">
            Sort By
        </x-ui.button>
    </x-slot:button>
    
    <x-slot:menu>
        <x-ui.dropdown.item wire:model="sortBy" value="name">
            Name
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item wire:model="sortBy" value="date">
            Date
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item wire:model="sortBy" value="size">
            Size
        </x-ui.dropdown.item>
    </x-slot:menu>
</x-ui.dropdown>
```

**Note:** Radio items require a `name` attribute to group them together.

## Read-Only Items (Titles)

Use `readOnly` items as non-interactive section titles or headers within your dropdown:

@blade
<x-demo class="flex justify-center">
    <x-ui.dropdown checkbox checkboxVariant>
        <x-slot:button>
            <x-ui.button icon="adjustments-horizontal">
                Display Options
            </x-ui.button>
        </x-slot:button>
        
        <x-slot:menu>
            <x-ui.dropdown.item readOnly>
                View Settings
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.separator/>
            
            <x-ui.dropdown.item wire:model="display.grid">
                Grid View
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item wire:model="display.list">
                List View
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.separator/>
            
            <x-ui.dropdown.item readOnly>
                Active Filters
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.separator/>
            
            <x-ui.dropdown.item wire:model="filters.active">
                Show Active Only
            </x-ui.dropdown.item>
            
            <x-ui.dropdown.item wire:model="filters.archived">
                Show Archived
            </x-ui.dropdown.item>
        </x-slot:menu>
    </x-ui.dropdown>
</x-demo>
@endblade

```blade
<x-ui.dropdown checkbox checkboxVariant>
    <x-slot:button>
        <x-ui.button icon="adjustments-horizontal">
            Display Options
        </x-ui.button>
    </x-slot:button>
    
    <x-slot:menu>
        <x-ui.dropdown.item readOnly>
            View Settings
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.separator/>
        
        <x-ui.dropdown.item wire:model="display.grid">
            Grid View
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item wire:model="display.list">
            List View
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.separator/>
        
        <x-ui.dropdown.item readOnly>
            Active Filters
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.separator/>
        
        <x-ui.dropdown.item wire:model="filters.active">
            Show Active Only
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item wire:model="filters.archived">
            Show Archived
        </x-ui.dropdown.item>
    </x-slot:menu>
</x-ui.dropdown>
```

**Benefits:**
- Provides visual organization
- Non-interactive, preventing accidental clicks
- Spans full width for clear section separation
- Styled differently from regular items

## Portal Mode

The `portal` prop controls where the dropdown menu is rendered in the DOM. By default (`portal="false"`), the menu renders as a child of the dropdown component. When enabled (`portal="true"`), the menu is teleported to the end of the `<body>` element.

### When to Use Portal

Enable portal mode when using dropdowns inside containers with overflow constraints:

```blade
<!-- Sidebar with overflow-y-auto -->
<x-ui.sidebar>
    <x-ui.dropdown portal>
        <x-slot:button>Profile Settings</x-slot:button>
        <x-slot:menu class="w-56">
            <!-- Menu renders at body level, no clipping -->
        </x-slot:menu>
    </x-ui.dropdown>
</x-ui.sidebar>
```

**Common scenarios:**
- Dropdowns in collapsible sidebars
- Dropdowns in modals or dialogs
- Dropdowns in scrollable panels
- Any container with `overflow: hidden` or `overflow: auto`

### Trade-offs

**Without Portal (default):**
- ✅ Simpler DOM structure
- ✅ CSS variables from parent are accessible
- ❌ Can be clipped by parent's overflow

**With Portal:**
- ✅ Never clipped by overflow contexts
- ✅ Always appears on top (proper z-index stacking)
- ❌ Loses access to parent CSS custom properties
- ❌ Slightly more complex DOM (teleported element)

### CSS Variable Limitation

When `portal="true"`, the dropdown menu loses access to parent CSS custom properties because it's rendered outside the original DOM hierarchy. Use fixed widths instead:

```blade
<!-- ❌ Won't work with portal -->
<x-ui.dropdown portal>
    <x-slot:menu class="w-[calc(var(--sidebar-width)-1rem)]">

<!-- ✅ Use fixed width -->
<x-ui.dropdown portal>
    <x-slot:menu class="w-56">
```

**Note:** The menu remains properly positioned via `x-anchor` regardless of portal usage.


## Component Props

### ui.dropdown

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `position` | string | `'bottom-center'` | No | Dropdown positioning: `bottom-center`, `bottom-start`, `bottom-end`, `top-center`, `top-start`, `top-end` |
| `portal` | string | `null` | No | teleported dropdown: `portal` prop |
| `class` | string | `''` | No | Additional CSS classes |
| `checkbox` | boolean | `false` | No | Enable checkbox mode for multi-selection |
| `radio` | boolean | `false` | No | Enable radio mode for single selection |
| `resetFocus` | boolean | `false` | No | Return focus to trigger button when dropdown closes |
| `checkboxVariant` | boolean | `false` | No | Use prominent checkbox UI (requires `checkbox="true"`) |

### ui.dropdown.item

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `disabled` | boolean | `false` | No | Whether the item is disabled |
| `icon` | string | `null` | No | Icon name to display before text |
| `iconAfter` | string | `null` | No | Icon name to display after text |
| `iconVariant` | string | `'mini'` | No | Icon variant/size |
| `shortcut` | string | `null` | No | Keyboard shortcut to display |
| `variant` | string | `'soft'` | No | Visual variant: `soft`, `danger` |
| `href` | string | `null` | No | URL for navigation items |
| `class` | string | `''` | No | Additional CSS classes |
| `readOnly` | boolean | `false` | No | Makes item non-interactive (useful as section title) |
| `value` | string | `null` | No | Value for checkbox/radio items |
| `name` | string | `null` | No | Name attribute for radio groups |

### ui.dropdown.group

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `label` | string | `null` | No | Optional group label |
| `class` | string | `''` | No | Additional CSS classes |

### ui.dropdown.submenu

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `label` | string | - | Yes | Submenu trigger label |
| `disabled` | boolean | `false` | No | Whether the submenu is disabled |
| `class` | string | `''` | No | Additional CSS classes |

> you can pass the width as w-* class to control the width of the menu

### ui.dropdown.separator

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `class` | string | `''` | No | Additional CSS classes |