---
name: 'popover'
---

## Introduction

The `popover` component provides a flexible overlay system for displaying contextual information or interactive content. 

> it is like a [dropdown](/docs/components/dropdown) with full freedom 

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `popover` component easily:

```bash
php artisan sheaf:install popover
```

## Basic Usage

@blade
<x-demo>
    <x-ui.popover>
        <x-ui.popover.trigger>
            <x-ui.button icon="plus">
                send a note
            </x-ui.button>
        </x-ui.popover.trigger>
        <!--  -->
        <x-ui.popover.overlay class="w-xl">
            <div class="p-2">
                <x-ui.heading>Add Note</x-ui.heading>
                <form class="space-y-3">
                     <x-ui.field required>
                        <x-ui.label>Title</x-ui.label>
                        <x-ui.input 
                            wire:model="title" 
                            placeholder="Note title"
                        />
                    </x-ui.field>
                    <x-ui.field required>
                        <x-ui.label>Contents</x-ui.label>
                        <x-ui.textarea 
                            wire:model="contents" 
                            placeholder="Your note..."
                        />
                    </x-ui.field>
                    <!--  -->
                    <div class="flex gap-2 justify-end">
                        <x-ui.button size="sm" variant="outline" x-on:click="hide()">
                            Cancel
                        </x-ui.button>
                        <x-ui.button 
                            size="sm"
                            x-on:click="
                                $data.hide();
                                $dispatch('notify', {type:'success', content: 'we accepted your note!'})
                            "
                        >
                            Save Note
                        </x-ui.button>
                    </div>
                </form>
            </div>
        </x-ui.popover.overlay>
    </x-ui.popover>
</x-demo>
@endblade

```blade
    <x-ui.popover>
        <x-ui.popover.trigger>
            <x-ui.button>
                Open Popover
            </x-ui.button>
        </x-ui.popover.trigger>
        
        <x-ui.popover.overlay class="w-xl">
            <div class="p-2">
                <x-ui.heading>Add Note</x-ui.heading>
                <form class="space-y-3">
                     <x-ui.field required>
                        <x-ui.label>Title</x-ui.label>
                        <x-ui.input 
                            wire:model="title" 
                            placeholder="Note title"
                        />
                    </x-ui.field>
                    <x-ui.field required>
                        <x-ui.label>Contents</x-ui.label>
                        <x-ui.textarea 
                            wire:model="contents" 
                            placeholder="Your note..."
                        />
                    </x-ui.field>
                    
                    <div class="flex gap-2 justify-end">
                        <x-ui.button size="sm" variant="outline" x-on:click="$data.hide()">
                            Cancel
                        </x-ui.button>
                        <!-- use this button to sumbit the form, we make just to hide the popup,
                        we're not the same -->
                        <x-ui.button 
                            size="sm"
                            x-on:click="
                                $data.hide();
                                $dispatch('notify', {type:'success', content: 'we accepted your note!'})
                            "
                        >
                            Save Note
                        </x-ui.button>
                    </div>
                </form>
            </div>
        </x-ui.popover.overlay>
    </x-ui.popover>
```

## Positioning

Control where the popover appears relative to the trigger element.

you can pass any of these values:

- Top: `top`, `top-start`, `top-end`
- Right: `right`, `right-start`, `right-end`
- Bottom: `bottom`, `bottom-start`, `bottom-end`
- Left: `left`, `left-start`, `left-end`


@blade
<x-demo class="flex justify-center">
    <div class="flex gap-4 flex-wrap">
        <x-ui.popover>
            <x-ui.popover.trigger>
                <x-ui.button>Bottom</x-ui.button>
            </x-ui.popover.trigger>
            <x-ui.popover.overlay position="bottom" :offset="8">
                <div class="p-3">
                    <p class="text-sm">Bottom positioned</p>
                </div>
            </x-ui.popover.overlay>
        </x-ui.popover>
        <!--  -->
        <x-ui.popover>
            <x-ui.popover.trigger>
                <x-ui.button>Top</x-ui.button>
            </x-ui.popover.trigger>
            <x-ui.popover.overlay position="top" :offset="8">
                <div class="p-3">
                    <p class="text-sm">Top positioned</p>
                </div>
            </x-ui.popover.overlay>
        </x-ui.popover>
        <!--  -->
        <x-ui.popover>
            <x-ui.popover.trigger>
                <x-ui.button>Left</x-ui.button>
            </x-ui.popover.trigger>
            <x-ui.popover.overlay position="left" :offset="8">
                <div class="p-3">
                    <p class="text-sm">Left positioned</p>
                </div>
            </x-ui.popover.overlay>
        </x-ui.popover>
        <!--  -->
        <x-ui.popover>
            <x-ui.popover.trigger>
                <x-ui.button>Right</x-ui.button>
            </x-ui.popover.trigger>
            <x-ui.popover.overlay position="right" :offset="8">
                <div class="p-3">
                    <p class="text-sm">Right positioned</p>
                </div>
            </x-ui.popover.overlay>
        </x-ui.popover>
    </div>
</x-demo>
@endblade

```blade
<x-ui.popover>
    <x-ui.popover.trigger>
        <x-ui.button>Bottom</x-ui.button>
    </x-ui.popover.trigger>
    <x-ui.popover.overlay position="bottom" :offset="8">
        <div class="p-3">
            <p class="text-sm">Bottom positioned</p>
        </div>
    </x-ui.popover.overlay>
</x-ui.popover>

<x-ui.popover>
    <x-ui.popover.trigger>
        <x-ui.button>Top</x-ui.button>
    </x-ui.popover.trigger>
    <x-ui.popover.overlay position="top" :offset="8">
        <div class="p-3">
            <p class="text-sm">Top positioned</p>
        </div>
    </x-ui.popover.overlay>
</x-ui.popover>
```
## offset 
You can add an offset to your anchored element by passing `offset` prop to `<x-ui.popover offset="14">` or to the overlay `<x-ui.popover.overlay offset="14">`  

```blade
<x-ui.popover.overlay :offset="8">
    <!-- overlay contents -->
</x-ui.popover.overlay>
```

## Interactive Content

Create popovers with interactive elements like forms or action buttons.

@blade
<x-demo class="flex justify-center">
    <x-ui.popover>
        <x-ui.popover.trigger>
            <x-ui.button>
                User Profile
            </x-ui.button>
        </x-ui.popover.trigger>
        <x-ui.popover.overlay class="!w-80">
            <div class="p-2 ">
                <div class="flex items-center gap-3 mb-3">
                    <x-ui.avatar src="https://avatars.githubusercontent.com/u/130717329?v=4"/>
                    <div>
                        <x-ui.heading class="font-semibold">CHARRAFI MOHAMED</x-ui.heading>
                        <x-ui.text class="text-sm text-neutral-600 dark:text-neutral-400">med@charrafi.com</x-ui.text>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <x-ui.button size="sm" variant="outline" x-on:click="hide()">
                        View Profile
                    </x-ui.button>
                    <x-ui.button size="sm" x-on:click="hide()">
                        Edit
                    </x-ui.button>
                </div>
            </div>
        </x-ui.popover.overlay>
    </x-ui.popover>
</x-demo>
@endblade

```blade
<x-ui.popover>
    <x-ui.popover.trigger>
        <x-ui.button>
            User Profile
        </x-ui.button>
    </x-ui.popover.trigger>
    <x-ui.popover.overlay class="!w-80">
        <div class="p-2">
            <div class="flex items-center gap-3 mb-3">
                <x-ui.avatar src="https://avatars.githubusercontent.com/u/130717329?v=4"/>
                <div>
                    <x-ui.heading class="font-semibold">CHARRAFI MOHAMED</x-ui.heading>
                    <x-ui.text class="text-sm text-neutral-600 dark:text-neutral-400">med@charrafi.com</x-ui.text>
                </div>
            </div>
            <div class="flex justify-end gap-2">
                <x-ui.button size="sm" variant="outline" x-on:click="hide()">
                    View Profile
                </x-ui.button>
                <x-ui.button size="sm" x-on:click="hide()">
                    Edit
                </x-ui.button>
            </div>
        </div>
    </x-ui.popover.overlay>
</x-ui.popover>
```

## Information Popover && On hover trigger

Perfect for displaying additional context or help information.

@blade
<x-demo class="flex justify-center">
    <div class="flex gap-4">
        <x-ui.popover on-hover>
            <x-ui.popover.trigger>
                <x-ui.button icon="information-circle" variant="ghost" size="sm">
                    Help
                </x-ui.button>
            </x-ui.popover.trigger>
            <x-ui.popover.overlay position="top" class="!w-64">
                <div class="p-4 text-start  ">
                    <x-ui.heading class="mb-2">How to use this feature</x-ui.heading>
                    <x-ui.text class="mb-3">
                        This feature allows you to quickly access common actions. Click on any item to perform the action.
                    </x-ui.text>
                    <ul class="text-sm list-disc text-neutral-600 dark:text-neutral-400 space-y-1">
                        <li>Use keyboard shortcuts for faster access</li>
                        <li>Right-click for additional options</li>
                        <li>Hold Shift to select multiple items</li>
                    </ul>
                </div>
            </x-ui.popover.overlay>
        </x-ui.popover>
        <!--  -->
        <x-ui.popover>
            <x-ui.popover.trigger on-hover>
                <x-ui.button icon="information-circle" variant="ghost" size="sm">
                    API Key
                </x-ui.button>
            </x-ui.popover.trigger>
            <x-ui.popover.overlay position="right" :offset="8" class="!w-56">
                <div class="p-3">
                    <x-ui.text class="text-sm text-neutral-600 dark:text-neutral-400">
                        Your API key is used to authenticate requests. Keep it secure and don't share it publicly.
                    </x-ui.text>
                </div>
            </x-ui.popover.overlay>
        </x-ui.popover>
    </div>
</x-demo>
@endblade

```blade
<div class="flex gap-4">
    <x-ui.popover on-hover>
        <x-ui.popover.trigger>
            <x-ui.button icon="information-circle" variant="ghost" size="sm">
                Help
            </x-ui.button>
        </x-ui.popover.trigger>
        <x-ui.popover.overlay position="top" class="!w-64">
            <div class="p-4 text-start  ">
                <x-ui.heading class="mb-2">How to use this feature</x-ui.heading>
                <x-ui.text class="mb-3">
                    This feature allows you to quickly access common actions. Click on any item to perform the action.
                </x-ui.text>
                <ul class="text-sm list-disc text-neutral-600 dark:text-neutral-400 space-y-1">
                    <li>Use keyboard shortcuts for faster access</li>
                    <li>Right-click for additional options</li>
                    <li>Hold Shift to select multiple items</li>
                </ul>
            </div>
        </x-ui.popover.overlay>
    </x-ui.popover>
    <!--  -->
    <x-ui.popover>
        <x-ui.popover.trigger on-hover>
            <x-ui.button icon="information-circle" variant="ghost" size="sm">
                API Key
            </x-ui.button>
        </x-ui.popover.trigger>
        <x-ui.popover.overlay position="right" :offset="8" class="!w-56">
            <div class="p-3">
                <x-ui.text class="text-sm text-neutral-600 dark:text-neutral-400">
                    Your API key is used to authenticate requests. Keep it secure and don't share it publicly.
                </x-ui.text>
            </div>
        </x-ui.popover.overlay>
    </x-ui.popover>
</div>
```

## Custom Styling

Customize the appearance and behavior of popovers.

@blade
<x-demo class="flex justify-center">
    <div class="flex gap-4">
        <x-ui.popover>
            <x-ui.popover.trigger>
                <x-ui.button variant="outline">
                    Custom Width
                </x-ui.button>
            </x-ui.popover.trigger>
            <x-ui.popover.overlay class="!w-96">
                <div class="p-4">
                    <h3 class="font-semibold mb-2">Wide Popover</h3>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">
                        This popover has a custom width set using Tailwind classes.
                        You can control the width by passing !w-* classes to the overlay component.
                    </p>
                </div>
            </x-ui.popover.overlay>
        </x-ui.popover>

        <x-ui.popover>
            <x-ui.popover.trigger>
                <x-ui.button>
                    Large Offset
                </x-ui.button>
            </x-ui.popover.trigger>
            <x-ui.popover.overlay position="bottom" :offset="24">
                <div class="p-4">
                    <p class="text-sm">This popover has a larger offset from the trigger.</p>
                </div>
            </x-ui.popover.overlay>
        </x-ui.popover>
    </div>
</x-demo>
@endblade

```blade
<x-ui.popover>
    <x-ui.popover.trigger>
        <x-ui.button variant="outline">
            Custom Width
        </x-ui.button>
    </x-ui.popover.trigger>
    
    <x-ui.popover.overlay class="!w-96">
        <div class="p-4">
            <h3 class="font-semibold mb-2">Wide Popover</h3>
            <p class="text-sm text-neutral-600 dark:text-neutral-400">
                This popover has a custom width set using Tailwind classes.
            </p>
        </div>
    </x-ui.popover.overlay>
</x-ui.popover>

<x-ui.popover>
    <x-ui.popover.trigger>
        <x-ui.button>
            Large Offset
        </x-ui.button>
    </x-ui.popover.trigger>
    
    <x-ui.popover.overlay position="bottom" :offset="24">
        <div class="p-4">
            <p class="text-sm">This popover has a larger offset from the trigger.</p>
        </div>
    </x-ui.popover.overlay>
</x-ui.popover>
```

## Component Props

### Popover (Main Component)

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `position` | string | `'bottom'` | No | Popover positioning: `bottom`, `top`, `left`, `right` |
| `offset` | integer | `3` | No | Distance from trigger element in pixels |
| `class` | string | `''` | No | Additional CSS classes |
| `on-hover` | string | `false` | No | if you want to open the overlay when hovering the trigger |

### Popover Trigger

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `class` | string | `'cursor-pointer'` | No | Additional CSS classes |

### Popover Overlay

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `position` | string | `'bottom'` | No | Popover positioning: `bottom`, `top`, `left`, `right` |
| `offset` | integer | `3` | No | Distance from trigger element in pixels |
| `on-hover` | string | `false` | No | if you want to open the overlay when hovering the trigger |
| `class` | string | `''` | No | Additional CSS classes |

> You can control the width of the popover by passing `!w-*` Tailwind classes to the overlay component.

## Keyboard Navigation

The popover component supports full keyboard accessibility:

- **Escape**: Closes the popover
- **Click outside**: Closes the popover
- **Focus management**: Proper focus trapping when popover contains interactive elements

