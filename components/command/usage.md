Looking at the source, here's the full command palette docs matching your select doc style exactly:

````markdown
name: command

## Introduction

The `Command` component is a keyboard-navigable command palette with built-in search, grouping, and Livewire integration. It's powered by the Rover primitive and works standalone or inside a modal.

## Installation

```bash
php artisan sheaf:install command
```

> **Requires Rover Plugin.** This component is powered by the [Rover primitive](/docs/primitives/rover). Make sure it's installed and registered before using it.

## Usage

@blade
<x-demo class="w-full min-h-[360px]">
    <x-ui.command>
        <x-ui.command.input clearable />
        <x-ui.command.items>
            <x-ui.command.item icon="user-plus"  kbd="⌘⇧N">Invite Team Member</x-ui.command.item>
            <x-ui.command.item icon="user-group" kbd="⌘⇧T">Manage Team</x-ui.command.item>
            <x-ui.command.item icon="envelope"   kbd="⌘⇧M">Send Message</x-ui.command.item>
            <x-ui.command.separator />
            <x-ui.command.group heading="Projects">
                <x-ui.command.item icon="folder-plus" kbd="⌘N">Create Project</x-ui.command.item>
                <x-ui.command.item icon="folder-open" kbd="⌘O">Open Project</x-ui.command.item>
            </x-ui.command.group>
            <x-ui.command.separator />
            <x-ui.command.item icon="home" kbd="⌘H">Go to Dashboard</x-ui.command.item>
            <x-ui.command.item icon="arrow-right-on-rectangle">Sign Out</x-ui.command.item>
        </x-ui.command.items>
    </x-ui.command>
</x-demo>
@endblade

```blade
<x-ui.command>
    <x-ui.command.input clearable />
    <x-ui.command.items>
        <x-ui.command.item icon="user-plus" kbd="⌘⇧N">Invite Team Member</x-ui.command.item>
        <x-ui.command.item icon="envelope"  kbd="⌘⇧M">Send Message</x-ui.command.item>
    </x-ui.command.items>
</x-ui.command>
```

### With Livewire

Wire up item actions directly with `wire:click`:

```blade
<x-ui.command>
    <x-ui.command.input clearable />
    <x-ui.command.items>
        <x-ui.command.item icon="user-plus" wire:click="inviteTeamMember">
            Invite Team Member
        </x-ui.command.item>
        <x-ui.command.item icon="trash" wire:click="deleteProject">
            Delete Project
        </x-ui.command.item>
    </x-ui.command.items>
</x-ui.command>
```

### Groups

Use `<x-ui.command.group>` to organize items under a labeled heading. Groups are purely visual — they don't affect keyboard navigation or value behavior.

@blade
<x-demo>
    <x-ui.command class="w-96">
        <x-ui.command.input clearable />
        <x-ui.command.items>
            <x-ui.command.group heading="Team">
                <x-ui.command.item icon="user-plus"  kbd="⌘⇧N">Invite Team Member</x-ui.command.item>
                <x-ui.command.item icon="user-group" kbd="⌘⇧T">Manage Team</x-ui.command.item>
            </x-ui.command.group>
            <x-ui.command.separator />
            <x-ui.command.group heading="Projects">
                <x-ui.command.item icon="folder-plus" kbd="⌘N">Create Project</x-ui.command.item>
                <x-ui.command.item icon="folder-open" kbd="⌘O">Open Project</x-ui.command.item>
                <x-ui.command.item icon="archive-box" kbd="⌘⇧A">Archive Project</x-ui.command.item>
            </x-ui.command.group>
        </x-ui.command.items>
    </x-ui.command>
</x-demo>
@endblade

```blade
<x-ui.command>
    <x-ui.command.input clearable />
    <x-ui.command.items>
        <x-ui.command.group heading="Team">
            <x-ui.command.item icon="user-plus"  kbd="⌘⇧N">Invite Team Member</x-ui.command.item>
            <x-ui.command.item icon="user-group" kbd="⌘⇧T">Manage Team</x-ui.command.item>
        </x-ui.command.group>
        <x-ui.command.separator />
        <x-ui.command.group heading="Projects">
            <x-ui.command.item icon="folder-plus" kbd="⌘N">Create Project</x-ui.command.item>
            <x-ui.command.item icon="folder-open" kbd="⌘O">Open Project</x-ui.command.item>
        </x-ui.command.group>
    </x-ui.command.items>
</x-ui.command>
```

### Separator

Use `<x-ui.command.separator>` to render a thin horizontal rule between items or groups.

```blade
<x-ui.command.items>
    <x-ui.command.item icon="home">Dashboard</x-ui.command.item>
    <x-ui.command.separator />
    <x-ui.command.item icon="arrow-right-on-rectangle">Sign Out</x-ui.command.item>
</x-ui.command.items>
```

### Keyboard Shortcuts

Pass `kbd` to any item to display a keyboard shortcut hint alongside it. This is purely visual — wire up the actual shortcut with Alpine wherever it makes sense.

@blade
<x-demo>
    <x-ui.command class="w-96">
        <x-ui.command.input />
        <x-ui.command.items>
            <x-ui.command.item icon="home"             kbd="⌘H">Go to Dashboard</x-ui.command.item>
            <x-ui.command.item icon="magnifying-glass" kbd="⌘F">Search Files</x-ui.command.item>
            <x-ui.command.item icon="cog-6-tooth"      kbd="⌘,">Preferences</x-ui.command.item>
        </x-ui.command.items>
    </x-ui.command>
</x-demo>
@endblade

```blade
<x-ui.command.item icon="home" kbd="⌘H">Go to Dashboard</x-ui.command.item>
```

### Empty State

When search yields no results, a default empty message is shown automatically. Customize it via the `empty` prop or slot.

```blade
{{-- Simple string --}}
<x-ui.command.items empty="Nothing matched your search.">
    <!-- items -->
</x-ui.command.items>

{{-- Rich slot --}}
<x-ui.command.items>
    <x-slot:empty>
        <x-ui.empty >No results found</x-ui.empty>
    </x-slot:empty>
    <!-- items -->
</x-ui.command.items>
```

### Disabled Items

@blade
<x-demo>
    <x-ui.command class="w-96">
        <x-ui.command.input />
        <x-ui.command.items>
            <x-ui.command.item icon="check">Available Action</x-ui.command.item>
            <x-ui.command.item icon="lock-closed" disabled>Restricted Action</x-ui.command.item>
        </x-ui.command.items>
    </x-ui.command>
</x-demo>
@endblade

```blade
<x-ui.command.item icon="lock-closed" disabled>Restricted Action</x-ui.command.item>
```


## As a Command Palette

The real power of `Command` is inside a modal triggered by a keyboard shortcut. Combine `<x-ui.modal>` with `bare`, `<x-ui.modal.trigger>`, and `<x-ui.input as="button">` for the full pattern.

@blade
<x-demo class="flex justify-center">
    <x-ui.modal.trigger id="command-palette-demo" :shortcut="['ctrl.k']">
        <x-ui.input
            kbd="⌘K"
            as="button"
            placeholder="Search..."
            leftIcon="magnifying-glass"
            class="w-64!"
        />
    </x-ui.modal.trigger>
    <!--  -->
    <x-ui.modal id="command-palette-demo" width="xl" bare>
        <x-ui.command>
            <x-ui.command.input clearable />
            <x-ui.command.items>
                <x-ui.command.item icon="user-plus"  kbd="⌘⇧N">Invite Team Member</x-ui.command.item>
                <x-ui.command.item icon="user-group" kbd="⌘⇧T">Manage Team</x-ui.command.item>
                <x-ui.command.separator />
                <x-ui.command.group heading="Projects">
                    <x-ui.command.item icon="folder-plus" kbd="⌘N">Create Project</x-ui.command.item>
                    <x-ui.command.item icon="folder-open" kbd="⌘O">Open Project</x-ui.command.item>
                </x-ui.command.group>
                <x-ui.command.separator />
                <x-ui.command.item icon="home" kbd="⌘H">Go to Dashboard</x-ui.command.item>
                <x-ui.command.item icon="arrow-right-on-rectangle">Sign Out</x-ui.command.item>
            </x-ui.command.items>
        </x-ui.command>
    </x-ui.modal>
</x-demo>
@endblade

```blade
{{-- Trigger: click or ⌘K --}}
<x-ui.modal.trigger id="command-palette" :shortcut="['ctrl.k']">
    <x-ui.input
        kbd="⌘K"
        as="button"
        placeholder="Search..."
        leftIcon="magnifying-glass"
    />
</x-ui.modal.trigger>

{{-- Palette: bare modal so command owns its own chrome --}}
<x-ui.modal id="command-palette" width="xl" bare>
    <x-ui.command>
        <x-ui.command.input clearable />
        <x-ui.command.items>
            <x-ui.command.item icon="user-plus"  kbd="⌘⇧N">Invite Team Member</x-ui.command.item>
            <x-ui.command.item icon="user-group" kbd="⌘⇧T">Manage Team</x-ui.command.item>
            <x-ui.command.separator />
            <x-ui.command.group heading="Projects">
                <x-ui.command.item icon="folder-plus" kbd="⌘N">Create Project</x-ui.command.item>
                <x-ui.command.item icon="folder-open" kbd="⌘O">Open Project</x-ui.command.item>
            </x-ui.command.group>
            <x-ui.command.separator />
            <x-ui.command.item icon="home" kbd="⌘H">Go to Dashboard</x-ui.command.item>
            <x-ui.command.item icon="arrow-right-on-rectangle">Sign Out</x-ui.command.item>
        </x-ui.command.items>
    </x-ui.command>
</x-ui.modal>
```

> `bare` strips the modal's own heading, padding, and close button — leaving `Command` in full control of its appearance. Escape closes the palette automatically via the command's built-in keydown handler.


## Component Props

### ui.command

| Prop | Type | Default | Description |
| ---- | ---- | ------- | ----------- |
| `label` | string | `'command palette'` | `aria-label` for the component root, used by screen readers |

### ui.command.input

| Prop | Type | Default | Description |
| ---- | ---- | ------- | ----------- |
| `placeholder` | string | `'Search...'` | Input placeholder text |
| `icon` | string \| slot | `'magnifying-glass'` | Leading icon — pass a string name or a custom slot |
| `clearable` | boolean | `false` | Shows an × button to reset the search query |

### ui.command.item

| Prop | Type | Default | Description |
| ---- | ---- | ------- | ----------- |
| `icon` | string | `null` | Leading icon displayed before the label |
| `kbd` | string | `null` | Keyboard shortcut hint displayed on the trailing edge |
| `disabled` | boolean | `false` | Prevents the item from being focused or activated |

### ui.command.group

| Prop | Type | Default | Description |
| ---- | ---- | ------- | ----------- |
| `heading` | string | `''` | Label rendered above the group — hidden from keyboard navigation |

### ui.command.items

| Prop | Type | Default | Description |
| ---- | ---- | ------- | ----------- |
| `empty` | string \| slot | `'No results found'` | Content shown when no items match the current search |

### ui.command.separator

No props. Renders a thin horizontal rule spanning all grid columns.
