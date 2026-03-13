---
name: combobox
---

## Introduction

The `Combobox` component is a **type-to-search** input that combines a text field with a dropdown list of options. Unlike `Select`, which uses a button trigger, `Combobox` exposes the input directly — users type to filter and navigate options without needing to open a separate search field. It supports multi-selection, grouping, server-side search, and seamless Livewire integration.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `combobox` component:

```bash
php artisan sheaf:install combobox
```

and then import the `combobox.js` file in your JS entry point:

```js
// app.js
import './components/combobox.js';
```

> Once installed, you can use the `<x-ui.combobox />` component in any Blade view.

## Usage

@blade
<x-demo class="flex justify-center">
    <div
        class="max-x-2xs mx-auto"
        x-data="{ members: [] }"
    >
        <x-ui.combobox
            class="w-3xs"
            placeholder="Team members"
            icon="users"
            x-model="members"
            multiple
            clearable
        >
            <x-ui.combobox.option value="john" icon="user">John Doe</x-ui.combobox.option>
            <x-ui.combobox.option value="jane" icon="user">Jane Smith</x-ui.combobox.option>
            <x-ui.combobox.option value="mike" icon="user">Mike Johnson</x-ui.combobox.option>
            <x-ui.combobox.option value="sarah" icon="user">Sarah Wilson</x-ui.combobox.option>
            <x-ui.combobox.option value="david" icon="user">David Brown</x-ui.combobox.option>
            <x-ui.combobox.option value="lisa" icon="user">Lisa Davis</x-ui.combobox.option>
        </x-ui.combobox>
    </div>
</x-demo>
@endblade

### Bind To Livewire

Use `wire:model="property"` to bind state to a Livewire component:

```blade
<x-ui.combobox
    wire:model="country"
    placeholder="Choose a country..."
>
    <x-ui.combobox.option value="us">United States</x-ui.combobox.option>
    <x-ui.combobox.option value="uk">United Kingdom</x-ui.combobox.option>
    <x-ui.combobox.option value="ca">Canada</x-ui.combobox.option>
    <x-ui.combobox.option value="au">Australia</x-ui.combobox.option>
    <x-ui.combobox.option value="de">Germany</x-ui.combobox.option>
    <x-ui.combobox.option value="fr">France</x-ui.combobox.option>
</x-ui.combobox>
```

### Using it within Blade & Alpine

You can use the combobox outside of Livewire with just Alpine and Blade:

```blade
<div x-data="{ country: '' }">
    <x-ui.combobox
        class="w-3xs"
        x-model="country"
        placeholder="Choose a country..."
    >
        <x-ui.combobox.option value="us">United States</x-ui.combobox.option>
        <x-ui.combobox.option value="uk">United Kingdom</x-ui.combobox.option>
        <x-ui.combobox.option value="ca">Canada</x-ui.combobox.option>
        <x-ui.combobox.option value="au">Australia</x-ui.combobox.option>
        <x-ui.combobox.option value="de">Germany</x-ui.combobox.option>
        <x-ui.combobox.option value="fr">France</x-ui.combobox.option>
    </x-ui.combobox>
</div>
```

### Size

The combobox comes in two sizes. The default size aligns with the `input` component height for use in forms. Use `size="sm"` for compact layouts like toolbars or filter bars.

```blade
<x-ui.combobox size="sm">
    <!-- options -->
</x-ui.combobox>
```

### Icons

Add a leading icon to the trigger and per-option icons for better visual communication.

@blade
<x-demo class="flex justify-center">
    <div class="max-x-2xs mx-auto">
        <x-ui.combobox
            class="w-3xs"
            placeholder="Choose status..."
            icon="flag"
        >
            <x-ui.combobox.option value="active" icon="check-circle">Active</x-ui.combobox.option>
            <x-ui.combobox.option value="pending" icon="clock">Pending</x-ui.combobox.option>
            <x-ui.combobox.option value="inactive" icon="x-circle">Inactive</x-ui.combobox.option>
            <x-ui.combobox.option value="archived" icon="archive-box">Archived</x-ui.combobox.option>
        </x-ui.combobox>
    </div>
</x-demo>
@endblade

```blade
<x-ui.combobox
    placeholder="Choose status..."
    wire:model="selectedStatus"
    icon="flag"
>
    <x-ui.combobox.option value="active" icon="check-circle">Active</x-ui.combobox.option>
    <x-ui.combobox.option value="pending" icon="clock">Pending</x-ui.combobox.option>
    <x-ui.combobox.option value="inactive" icon="x-circle">Inactive</x-ui.combobox.option>
    <x-ui.combobox.option value="archived" icon="archive-box">Archived</x-ui.combobox.option>
</x-ui.combobox>
```

### Groups

Use `<x-ui.combobox.group>` to visually organize related options under a labeled heading.

@blade
<x-demo class="flex justify-center">
    <div class="max-x-2xs mx-auto">
        <x-ui.combobox
            class="w-3xs"
            placeholder="Assign member..."
            icon="users"
        >
            <x-ui.combobox.option value="john" icon="user">John Doe</x-ui.combobox.option>
            <x-ui.combobox.separator />
            <x-ui.combobox.group label="Design Team">
                <x-ui.combobox.option value="jane" icon="user">Jane Smith</x-ui.combobox.option>
                <x-ui.combobox.option value="mike" icon="user">Mike Johnson</x-ui.combobox.option>
            </x-ui.combobox.group>
            <x-ui.combobox.group label="Engineering Team">
                <x-ui.combobox.option value="sarah" icon="user">Sarah Wilson</x-ui.combobox.option>
                <x-ui.combobox.option value="david" icon="user">David Brown</x-ui.combobox.option>
            </x-ui.combobox.group>
        </x-ui.combobox>
    </div>
</x-demo>
@endblade

```blade
<x-ui.combobox wire:model="member" placeholder="Assign member...">
    <x-ui.combobox.option value="john">John Doe</x-ui.combobox.option>
    <x-ui.combobox.separator />
    <x-ui.combobox.group label="Design Team">
        <x-ui.combobox.option value="jane">Jane Smith</x-ui.combobox.option>
        <x-ui.combobox.option value="mike">Mike Johnson</x-ui.combobox.option>
    </x-ui.combobox.group>
    <x-ui.combobox.group label="Engineering Team">
        <x-ui.combobox.option value="sarah">Sarah Wilson</x-ui.combobox.option>
        <x-ui.combobox.option value="david">David Brown</x-ui.combobox.option>
    </x-ui.combobox.group>
</x-ui.combobox>
```

### Multiple Selection

Allow users to select multiple options. Selected values appear as tags inside the input.

@blade
<x-demo class="flex justify-center">
    <div
        class="max-x-2xs mx-auto"
        x-data="{ selectedSkills: [] }"
    >
        <x-ui.combobox
            class="w-3xs"
            placeholder="Choose your skills..."
            multiple
            x-model="selectedSkills"
            clearable
        >
            <x-ui.combobox.option value="php" icon="code-bracket">PHP</x-ui.combobox.option>
            <x-ui.combobox.option value="javascript" icon="bolt">JavaScript</x-ui.combobox.option>
            <x-ui.combobox.option value="python" icon="variable">Python</x-ui.combobox.option>
            <x-ui.combobox.option value="react" icon="cube">React</x-ui.combobox.option>
            <x-ui.combobox.option value="vue" icon="sparkles">Vue.js</x-ui.combobox.option>
            <x-ui.combobox.option value="laravel" icon="academic-cap">Laravel</x-ui.combobox.option>
        </x-ui.combobox>
    </div>
</x-demo>
@endblade

```blade
<x-ui.combobox
    placeholder="Choose your skills..."
{+    multiple+}
    clearable
    wire:model="selectedSkills"
>
    <x-ui.combobox.option value="php" icon="code-bracket">PHP</x-ui.combobox.option>
    <x-ui.combobox.option value="javascript" icon="bolt">JavaScript</x-ui.combobox.option>
    <x-ui.combobox.option value="python" icon="variable">Python</x-ui.combobox.option>
    <x-ui.combobox.option value="react" icon="cube">React</x-ui.combobox.option>
    <x-ui.combobox.option value="vue" icon="sparkles">Vue.js</x-ui.combobox.option>
    <x-ui.combobox.option value="laravel" icon="academic-cap">Laravel</x-ui.combobox.option>
</x-ui.combobox>
```

### Server-side Search with Livewire

The combobox is purpose-built for server-driven search. Because the input is always exposed, you can wire it directly to a Livewire property and let your component handle all filtering.

```blade
<x-ui.combobox
    wire:model="options"
    placeholder="Search components..."
    multiple
>
    @foreach ($components as $item)
        <x-ui.combobox.option
            wire:key="{{ $item->server_name }}"
            value="{{ $item->server_name }}"
        >
            {{ $item->name }}
        </x-ui.combobox.option>
    @endforeach
</x-ui.combobox>
```

**Backend example**

```php
public string $query = '';
public $components = [];

public function mount(): void
{
    $this->components = Component::limit(10)->get();
}

public function updatedQuery(): void
{
    $this->components = Component::where('name', 'like', "%{$this->query}%")
        ->limit(10)
        ->get();
}
```

> Unlike `Select`, `Combobox` doesn't need a separate `<x-slot:search>` override — the input field is the trigger itself. Simply bind the input value with `wire:model.live` on the combobox and all filtering logic lives in your Livewire component.

### Loading State

When using server-side search, a loading indicator is shown automatically while Livewire is processing. You can customize it via the `loading` slot:

```blade
<x-ui.combobox
    wire:model="options"
    placeholder="Search..."
>
    <x-slot:loading>
        loading...
    </x-slot>

    @foreach ($results as $item)
        <x-ui.combobox.option value="{{ $item->id }}">
            {{ $item->name }}
        </x-ui.combobox.option>
    @endforeach
</x-ui.combobox>
```

> To disable the automatic loading indicator entirely (e.g., when you handle it yourself), pass `prevent-loading` to the combobox.

### Create Option

When no results match the user's query, you can offer an inline create action using `<x-ui.combobox.option.create>`:

> the `:preventLoading` flag is a workaround to hide loading indicator while the requests been sent to the server, due that there is no straight way to prevent them conditionally


```blade
<x-ui.combobox
    wire:model="options"
    placeholder="Search or create..."
    :preventLoading="strlen($query) > 3"
    multiple
>
    @if (!$components->count())
        @if (strlen($query) > 3)
            {+<x-ui.combobox.option.create wire:click="createComponent">+}
                Create "<span wire:text="query"></span>"
            {+</x-ui.combobox.option.create>+}
        @else
            <x-ui.combobox.empty>
                No results found
            </x-ui.combobox.empty>
        @endif
    @endif

    @foreach ($components as $component)
        <x-ui.combobox.option
            wire:key="{{ $component->server_name }}"
            value="{{ $component->server_name }}"
        >
            {{ $component->name }}
        </x-ui.combobox.option>
    @endforeach
</x-ui.combobox>
```

### Validation States

Apply error styling with the `invalid` prop:

```blade
<x-ui.combobox
    placeholder="Choose option..."
    :invalid="true"
    wire:model="selection"
>
    <x-ui.combobox.option value="option1">Option 1</x-ui.combobox.option>
    <x-ui.combobox.option value="option2">Option 2</x-ui.combobox.option>
</x-ui.combobox>
```

### Disabled State

```blade
<x-ui.combobox
    placeholder="This is disabled..."
    disabled
    wire:model="value"
>
    <x-ui.combobox.option value="option1">Option 1</x-ui.combobox.option>
    <x-ui.combobox.option value="option2">Option 2</x-ui.combobox.option>
</x-ui.combobox>
```

### Option Specific Disabled State

Individual options can be disabled while the rest remain interactive:

```blade
<x-ui.combobox wire:model="value" placeholder="Choose...">
    <x-ui.combobox.option value="option1">Option 1</x-ui.combobox.option>
    <x-ui.combobox.option value="option2" disabled>Option 2</x-ui.combobox.option>
    <x-ui.combobox.option value="option3">Option 3</x-ui.combobox.option>
    <x-ui.combobox.option value="option4" disabled>Option 4</x-ui.combobox.option>
</x-ui.combobox>
```

## Conventions

### Listening for Changes

React to selection changes with the `@change` event. The selected value is available in `$event.detail.value`:

```blade
<div x-data="{ country: '' }">
    <x-ui.combobox
        class="w-3xs"
        x-model="country"
        placeholder="Choose a country..."
        @change="fetchRegionalData($event.detail.value)"
    >
        <x-ui.combobox.option value="us">United States</x-ui.combobox.option>
        <x-ui.combobox.option value="uk">United Kingdom</x-ui.combobox.option>
        <x-ui.combobox.option value="ca">Canada</x-ui.combobox.option>
    </x-ui.combobox>
</div>
```


## Component Props

### ui.combobox

| Prop Name | Type | Default | Required | Description |
| --------- | ---- | ------- | -------- | ----------- |
| `name` | string | auto-detected from `wire:model` or `x-model` | No | Hidden input name attribute |
| `label` | string | `null` | No | Label displayed above the combobox |
| `triggerLabel` | string | `null` | No | Static label shown in the trigger area |
| `placeholder` | string | `'Type to search...'` | No | Placeholder text shown in the input |
| `multiple` | boolean | `false` | No | Enables multi-selection mode |
| `clearable` | boolean | `false` | No | Shows a clear/reset button |
| `disabled` | boolean | `false` | No | Disables the entire combobox |
| `pillbox` | boolean | `false` | No | Shows selected values as pills (requires `multiple`) |
| `icon` | string | `null` | No | Leading icon name in the trigger |
| `iconAfter` | string | `'chevron-up-down'` | No | Trailing icon name in the trigger |
| `checkIcon` | string | `'check'` | No | Icon shown next to selected options |
| `checkIconClass` | string | `null` | No | Additional CSS classes for the check icon |
| `invalid` | boolean | `null` | No | Applies error/invalid styling |
| `triggerClass` | string | `null` | No | Additional CSS classes for the trigger |
| `maxSelection` | number | `null` | No | Maximum number of selectable options (multiple mode) |
| `minSelection` | number | `null` | No | Minimum number of required selections (multiple mode) |
| `size` | string | `'default'` | No | Size variant (`'default'` or `'sm'`) |
| `empty` | mixed | `null` | No | Custom empty state slot/content |
| `loading` | mixed | `null` | No | Custom loading state slot/content |
| `preventLoading` | boolean | `false` | No | Disables the automatic `wire:loading` attribute on the options list |
| `slot` | slot | — | Yes | Content slot — accepts `<x-ui.combobox.option>` and other sub-components |

### ui.combobox.option

| Prop Name | Type | Default | Required | Description |
| --------- | ---- | ------- | -------- | ----------- |
| `value` | string | Falls back to slot text content | No | The value submitted/stored on selection |
| `label` | string | Falls back to slot text content | No | Display label (also used as search text fallback) |
| `searchLabel` | string | Falls back to `label` | No | Override text used when filtering via search |
| `icon` | string | `null` | No | Leading icon rendered before the label |
| `iconClass` | string | `null` | No | Additional CSS classes for the option icon |
| `disabled` | boolean | `false` | No | Disables this individual option |
| `allowCustomSlots` | boolean | `false` | No | Enables fully custom slot content. Requires `label` prop — throws `RuntimeException` if omitted |

### ui.combobox.group

| Prop Name | Type | Default | Required | Description |
| --------- | ---- | ------- | -------- | ----------- |
| `label` | string | `null` | No | Group heading label rendered above the grouped options |
| `slot` | slot | — | Yes | Content — accepts `<x-ui.combobox.option>` components |

### ui.combobox.separator

| Prop Name | Type | Default | Required | Description |
| --------- | ---- | ------- | -------- | ----------- |
| `$attributes` | mixed | — | No | Extra attributes/classes merged onto the separator element |

> Renders a thin horizontal rule. Use between options or groups for visual separation.

### ui.combobox.empty

| Prop Name | Type | Default | Required | Description |
| --------- | ---- | ------- | -------- | ----------- |
| `$attributes` | mixed | — | No | Extra attributes/classes merged onto the element |
| `slot` | slot | — | Yes | Content shown when no options match the current search |

> Hidden automatically when the options list is in a loading state (`[data-loading]`).

### ui.combobox.option.create

| Prop Name | Type | Default | Required | Description |
| --------- | ---- | ------- | -------- | ----------- |
| `$attributes` | mixed | — | No | Extra attributes/classes merged onto the `<li>` element |
| `slot` | slot | — | Yes | Content rendered inside the create-option row |

> Always rendered with `wire:key="create-option"`.