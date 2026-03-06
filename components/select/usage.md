---
name: select
---

## Introduction

The `Select` component is a **versatile**, **accessible** dropdown selection component with advanced features like search, multi-selection, and customizable styling. It provides a modern alternative to native select elements with enhanced user experience and seamless Livewire integration.

## Installation
Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `select` component easily:

```bash
php artisan sheaf:install select
```

and then import the `select.js` file in your js entry point:

```js
// app.js
import './components/select.js';
```

> Once installed, you can use the `<x-ui.select />` component in any Blade view.

## Usage

@blade
<x-demo class="flex justify-center">
     <div
        class="max-x-2xs mx-auto"
        x-data="{
            members:[]
        }"
    >
        <x-ui.select 
            class="w-3xs"
            placeholder="Team members"
            icon="users"
            x-model="members"
            searchable
            multiple
            clearable
            >
                <x-ui.select.option value="john" icon="user">John Doe</x-ui.select.option>
                <x-ui.select.option value="jane" icon="user">Jane Smith</x-ui.select.option>
                <x-ui.select.option value="mike" icon="user">Mike Johnson</x-ui.select.option>
                <x-ui.select.option value="sarah" icon="user">Sarah Wilson</x-ui.select.option>
                <x-ui.select.option value="david" icon="user">David Brown</x-ui.select.option>
                <x-ui.select.option value="lisa" icon="user">Lisa Davis</x-ui.select.option>
        </x-ui.select>
    </div>
</x-demo>
@endblade

### Bind To Livewire

To use with Livewire you only need to use `wire:model="property"` to bind your input state:

```blade
<x-ui.select 
    wire:model="country"
    placeholder="Choose a country..."
>
        <x-ui.select.option value="us">United States</x-ui.select.option>
        <x-ui.select.option value="uk">United Kingdom</x-ui.select.option>
        <x-ui.select.option value="ca">Canada</x-ui.select.option>
        <x-ui.select.option value="au">Australia</x-ui.select.option>
        <x-ui.select.option value="de">Germany</x-ui.select.option>
        <x-ui.select.option value="fr">France</x-ui.select.option>
</x-ui.select>
```

### Using it within Blade & Alpine

You can use it outside Livewire with just Alpine (and Blade):

```blade
<div x-data="{ country: '' }">
    <x-ui.select 
        class="w-3xs"
        x-model="country"
        placeholder="Choose a country..."
    >
            <x-ui.select.option value="us">United States</x-ui.select.option>
            <x-ui.select.option value="uk">United Kingdom</x-ui.select.option>
            <x-ui.select.option value="ca">Canada</x-ui.select.option>
            <x-ui.select.option value="au">Australia</x-ui.select.option>
            <x-ui.select.option value="de">Germany</x-ui.select.option>
            <x-ui.select.option value="fr">France</x-ui.select.option>
    </x-ui.select>
</div>
```

### Size 
the default size of the select is designed to align up with the input component, but also we have `sm` size: 

@blade
<x-demo class=" justify-center">
    <div class="space-y-4">
        <div
            class="max-x-2xs mx-auto"
            x-data="{
                members:[]
            }"
        >
            <x-ui.select 
                class="w-3xs"
                placeholder="Team members"
                icon="users"
                x-model="members"
                searchable
                multiple
                clearable
                >
                    <x-ui.select.option value="john" icon="user">John Doe</x-ui.select.option>
                    <x-ui.select.option value="jane" icon="user">Jane Smith</x-ui.select.option>
                    <x-ui.select.option value="mike" icon="user">Mike Johnson</x-ui.select.option>
                    <x-ui.select.option value="sarah" icon="user">Sarah Wilson</x-ui.select.option>
                    <x-ui.select.option value="david" icon="user">David Brown</x-ui.select.option>
                    <x-ui.select.option value="lisa" icon="user">Lisa Davis</x-ui.select.option>
            </x-ui.select>
        </div>
        <div
            class="max-x-2xs mx-auto"
            x-data="{
                members:[]
            }"
        >
            <x-ui.select 
                class="w-3xs"
                placeholder="Team members"
                icon="users"
                x-model="members"
                size="sm"
                searchable
                multiple
                clearable
                >
                    <x-ui.select.option value="john" icon="user">John Doe</x-ui.select.option>
                    <x-ui.select.option value="jane" icon="user">Jane Smith</x-ui.select.option>
                    <x-ui.select.option value="mike" icon="user">Mike Johnson</x-ui.select.option>
                    <x-ui.select.option value="sarah" icon="user">Sarah Wilson</x-ui.select.option>
                    <x-ui.select.option value="david" icon="user">David Brown</x-ui.select.option>
                    <x-ui.select.option value="lisa" icon="user">Lisa Davis</x-ui.select.option>
            </x-ui.select>
        </div>
    </div>
</x-demo>
@endblade

```blade
<x-ui.select size="sm">
    <!-- options -->
</x-ui.select>
```


### Custom Slot

When you need rich, fully custom option layouts, enable `allow-custom-slots` on the parent `<x-ui.select>`. Each option then renders your slot content directly without the default check icon and label structure.

> **Important:** When using `allow-custom-slots`, every `<x-ui.select.option>` **must** provide a `label` prop. This is used internally for search filtering and trigger display. A `RuntimeException` will be thrown if `label` is omitted.

@blade
<x-demo class=" justify-center">
    <x-ui.select allow-custom-slots  placeholder="Select priority..."
        class="w-64">
        <x-ui.select.option value="critical" label="Critical">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                    <x-ui.icon name="exclamation-triangle" class="text-white !size-4" />
                </div>
                <div>
                    <div class="font-semibold text-red-600 dark:text-red-400">Critical</div>
                    <div class="text-xs text-gray-500">Immediate attention required</div>
                </div>
            </div>
        </x-ui.select.option>
        <!--  -->
        <x-ui.select.option value="high" label="High">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                    <x-ui.icon name="arrow-up" class="text-white !size-4" />
                </div>
                <div>
                    <div class="font-semibold text-orange-600 dark:text-orange-400">High</div>
                    <div class="text-xs text-gray-500">Important task</div>
                </div>
            </div>
        </x-ui.select.option>
        <!--  -->
        <x-ui.select.option value="medium" label="Medium">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                    <x-ui.icon name="minus" class="text-white !size-4" />
                </div>
                <div>
                    <div class="font-semibold text-yellow-600 dark:text-yellow-400">Medium</div>
                    <div class="text-xs text-gray-500">Normal priority</div>
                </div>
            </div>
        </x-ui.select.option>
        <!--  -->
        <x-ui.select.option value="low" label="Low">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                    <x-ui.icon name="arrow-down" class="text-white !size-4" />
                </div>
                <div>
                    <div class="font-semibold text-blue-600 dark:text-blue-400">Low</div>
                    <div class="text-xs text-gray-500">Can wait</div>
                </div>
            </div>
        </x-ui.select.option>
    </x-ui.select>
</x-demo>
@endblade

```blade
<x-ui.select 
    {+allow-custom-slots+}
    wire:model.live="priority" 
    placeholder="Select priority..."
    class="w-64"
>
    <x-ui.select.option value="critical" {+label="Critical"+}>
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                <x-ui.icon name="exclamation-triangle" class="text-white !size-4" />
            </div>
            <div>
                <div class="font-semibold text-red-600 dark:text-red-400">Critical</div>
                <div class="text-xs text-gray-500">Immediate attention required</div>
            </div>
        </div>
    </x-ui.select.option>

    <x-ui.select.option value="high" {+label="High"+}>
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                <x-ui.icon name="arrow-up" class="text-white !size-4" />
            </div>
            <div>
                <div class="font-semibold text-orange-600 dark:text-orange-400">High</div>
                <div class="text-xs text-gray-500">Important task</div>
            </div>
        </div>
    </x-ui.select.option>

    <x-ui.select.option value="medium" {+label="Medium"+}>
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                <x-ui.icon name="minus" class="text-white !size-4" />
            </div>
            <div>
                <div class="font-semibold text-yellow-600 dark:text-yellow-400">Medium</div>
                <div class="text-xs text-gray-500">Normal priority</div>
            </div>
        </div>
    </x-ui.select.option>

    <x-ui.select.option value="low" {+label="Low"+}>
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                <x-ui.icon name="arrow-down" class="text-white !size-4" />
            </div>
            <div>
                <div class="font-semibold text-blue-600 dark:text-blue-400">Low</div>
                <div class="text-xs text-gray-500">Can wait</div>
            </div>
        </div>
    </x-ui.select.option>
</x-ui.select>
```

### Icons

Enhance the select with leading icons and option-specific icons for better visual communication.

@blade
<x-demo class="flex justify-center">
    <div class="max-x-2xs mx-auto">
        <x-ui.select 
            class="w-3xs"
            placeholder="Choose status..."
            icon="flag"
        >
                <x-ui.select.option value="active" icon="check-circle">Active</x-ui.select.option>
                <x-ui.select.option value="pending" icon="clock">Pending</x-ui.select.option>
                <x-ui.select.option value="inactive" icon="x-circle">Inactive</x-ui.select.option>
                <x-ui.select.option value="archived" icon="archive-box">Archived</x-ui.select.option>
        </x-ui.select>
    </div>
</x-demo>
@endblade

```blade
<x-ui.select 
    placeholder="Choose status..."
    icon="flag"
    wire:model="selectedStatus"
>
        <x-ui.select.option value="active" icon="check-circle">Active</x-ui.select.option>
        <x-ui.select.option value="pending" icon="clock">Pending</x-ui.select.option>
        <x-ui.select.option value="inactive" icon="x-circle">Inactive</x-ui.select.option>
        <x-ui.select.option value="archived" icon="archive-box">Archived</x-ui.select.option>
</x-ui.select>
```

### Searchable Select

Add search functionality to easily find options in large lists.

@blade
<x-demo class="flex justify-center">
    <div class="max-x-2xs mx-auto">
        <x-ui.select 
            class="w-3xs"
            placeholder="Find a city..."
            icon="map-pin"
            searchable
        >
                <x-ui.select.option value="nyc">New York City</x-ui.select.option>
                <x-ui.select.option value="london">London</x-ui.select.option>
                <x-ui.select.option value="paris">Paris</x-ui.select.option>
                <x-ui.select.option value="tokyo">Tokyo</x-ui.select.option>
                <x-ui.select.option value="sydney">Sydney</x-ui.select.option>
                <x-ui.select.option value="berlin">Berlin</x-ui.select.option>
        </x-ui.select>
    </div>
</x-demo>
@endblade

```blade
<x-ui.select 
    placeholder="Find a city..."
    icon="map-pin"
    wire:model="selectedCity"
    {+searchable+}
>
    <!-- options -->
</x-ui.select>
```

> By default, options are searched by their `label` using NFD normalization. To customize what gets matched during search — for example, including aliases, transliterations, or alternate spellings — pass a `searchLabel` prop and the select will use it instead.


### Server-side Search with Livewire

For large datasets, you can replace the built-in client-side search with a fully server-driven one by passing a custom `search` slot. Wire it to a Livewire property and the select will delegate filtering entirely to your component.

```blade
<x-ui.select 
    placeholder="Search components..."
    wire:model="options"
    searchable
    multiple
>
    <x-slot:search>
        <x-ui.select.search wire:model.live="query" />
    </x-slot>

    @foreach ($components as $item)
        <x-ui.select.option 
            wire:key="{{ $item->server_name }}" 
            value="{{ $item->server_name }}"
        >
            {{ $item->name }}
        </x-ui.select.option>
    @endforeach
</x-ui.select>
```

**backend example**
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

> The custom search slot completely bypasses the built-in client-side filtering. All matching logic lives in your Livewire component — the select simply renders whatever options are present in the DOM.


### Create Option

When no results match, you can offer the user the ability to create a new entry inline using `<x-ui.select.option.create>`. Combine it with server-side search to build a full search-or-create flow.

```blade
<x-ui.select 
    wire:model="options"
    placeholder="Search or create..."
    searchable
    multiple
>
    <x-slot:search>
        <x-ui.select.search wire:model.live="query" />
    </x-slot>

    @if (!$components->count())
        @if (strlen($query) > 3)
            {+<x-ui.select.option.create wire:click="createComponent">+}
                Create "<span wire:text="query"></span>"
            {+</x-ui.select.option.create>+}
        @else
            <x-ui.select.empty>
                No results found
            </x-ui.select.empty>
        @endif
    @endif

    @foreach ($components as $component)
        <x-ui.select.option 
            wire:key="{{ $component->server_name }}" 
            value="{{ $component->server_name }}"
        >
            {{ $component->name }}
        </x-ui.select.option>
    @endforeach
</x-ui.select>
```

```php
public function createComponent(): void
{
    $component = Component::create(['name' => $this->query]);

    $this->components = Component::limit(10)->get();
    $this->query = '';

    $this->toastSuccess("'{$component->name}' created successfully.");
}
```

### Multiple Selection

Allow users to select multiple options with visual feedback.

@blade
<x-demo class="flex justify-center">
    <div
        class="max-x-2xs mx-auto"
        x-data="{
            selectedSkills:[]
        }"
    >
        <x-ui.select 
            class="w-3xs"
            placeholder="Choose your skills..."
            icon="academic-cap"
            multiple
            searchable
            x-model="selectedSkills"
            clearable
        >
                <x-ui.select.option value="php" icon="code-bracket">PHP</x-ui.select.option>
                <x-ui.select.option value="javascript" icon="bolt">JavaScript</x-ui.select.option>
                <x-ui.select.option value="python" icon="variable">Python</x-ui.select.option>
                <x-ui.select.option value="react" icon="cube">React</x-ui.select.option>
                <x-ui.select.option value="vue" icon="sparkles">Vue.js</x-ui.select.option>
                <x-ui.select.option value="laravel" icon="academic-cap">Laravel</x-ui.select.option>
        </x-ui.select>
    </div>
</x-demo>
@endblade

```blade
<x-ui.select 
    placeholder="Choose your skills..."
    icon="academic-cap"
    searchable
    {+multiple+}
    clearable
    wire:model="selectedSkills">
        <x-ui.select.option value="php" icon="code-bracket">PHP</x-ui.select.option>
        <x-ui.select.option value="javascript" icon="bolt">JavaScript</x-ui.select.option>
        <x-ui.select.option value="python" icon="variable">Python</x-ui.select.option>
        <x-ui.select.option value="react" icon="cube">React</x-ui.select.option>
        <x-ui.select.option value="vue" icon="sparkles">Vue.js</x-ui.select.option>
        <x-ui.select.option value="laravel" icon="academic-cap">Laravel</x-ui.select.option>
</x-ui.select>
```

### Pillbox Selection
@blade
<x-demo class="flex justify-center">
    <div
        class="max-x-2xs mx-auto"
        x-data="{
            selectedSkills:[]
        }"
    >
        <x-ui.select 
            class="w-3xs"
            placeholder="Choose your skills..."
            icon="academic-cap"
            searchable
            multiple
            x-model="selectedSkills"
            clearable
            pillbox
        >
                <x-ui.select.option value="php" icon="code-bracket">PHP</x-ui.select.option>
                <x-ui.select.option value="javascript" icon="bolt">JavaScript</x-ui.select.option>
                <x-ui.select.option value="python" icon="variable">Python</x-ui.select.option>
                <x-ui.select.option value="react" icon="cube">React</x-ui.select.option>
                <x-ui.select.option value="vue" icon="sparkles">Vue.js</x-ui.select.option>
                <x-ui.select.option value="laravel" icon="academic-cap">Laravel</x-ui.select.option>
        </x-ui.select>
    </div>
</x-demo>
@endblade

```blade
<x-ui.select 
    placeholder="Choose your skills..."
    icon="academic-cap"
    multiple
    {+pillbox+}
    clearable
    wire:model="selectedSkills"
>
    <!-- options -->
</x-ui.select>
```


### Validation States

Show different states for validation feedback.

@blade
<x-demo class="flex justify-center">
    <div class="max-x-2xs mx-auto space-y-4">
        <x-ui.select 
            class="w-3xs"
            placeholder="Choose option..."
            icon="exclamation-circle"
            :invalid="true"
            >
                <x-ui.select.option value="option1">Option 1</x-ui.select.option>
                <x-ui.select.option value="option2">Option 2</x-ui.select.option>
        </x-ui.select>
    </div>
</x-demo>
@endblade

```blade
<!-- Invalid state -->
<x-ui.select 
    placeholder="Choose option..."
    icon="exclamation-circle"
    invalid="true"
    wire:model="invalidSelection">
        <x-ui.select.option value="option1">Option 1</x-ui.select.option>
        <x-ui.select.option value="option2">Option 2</x-ui.select.option>
</x-ui.select>
```

### Disabled State and Option Specific 

@blade
<x-demo class="flex justify-center">
    <div class="max-x-2xs mx-auto">
        <x-ui.select 
            class="w-3xs"
            placeholder="This is disabled..."
            disabled
        >
                <x-ui.select.option value="option1">Option 1</x-ui.select.option>
                <x-ui.select.option value="option2">Option 2</x-ui.select.option>
        </x-ui.select>
    </div>
</x-demo>
@endblade

```blade
<x-ui.select 
    placeholder="This is disabled..."
    disabled
    wire:model="disabledValue">
        <x-ui.select.option value="option1">Option 1</x-ui.select.option>
        <x-ui.select.option value="option2">Option 2</x-ui.select.option>
</x-ui.select>
```

## Conventions
### Listening for Changes

You can react to selection changes by listening to the `@change` event. This is useful when you need to trigger side effects, validate selections, or update other parts of your UI based on the selected value.
The selected value is available in `$event.detail.value`:

```blade
<div x-data="{ country: '' }">
    <x-ui.select 
        class="w-3xs"
        x-model="country"
        placeholder="Choose a country..."
        @change="fetchRegionalData($event.detail.value)"
        >
            <x-ui.select.option value="us">United States</x-ui.select.option>
            <x-ui.select.option value="uk">United Kingdom</x-ui.select.option>
            <x-ui.select.option value="ca">Canada</x-ui.select.option>
            <x-ui.select.option value="au">Australia</x-ui.select.option>
            <x-ui.select.option value="de">Germany</x-ui.select.option>
            <x-ui.select.option value="fr">France</x-ui.select.option>
    </x-ui.select>
</div>
```

**When to use `@change`**

The `@change` event is useful when you want to trigger side effects or coordinate multiple components. For reading the selected value, we recommend binding it using `x-model` or `wire:model`. 

This is particularly useful when:
- You need to refresh data or trigger API calls when the selection changes
- Multiple selects need to coordinate (cascading dropdowns, dependent filters)
- You're working with Livewire and need to call component methods without watching nested properties

## Advanced Examples
### Dynamic Options with Livewire

```php
// In your Livewire component
public $selectedCategories = [];
public $categories = [
    'web' => 'Web Development',
    'mobile' => 'Mobile Development',
    'design' => 'UI/UX Design',
    'backend' => 'Backend Development',
];
```

```blade
<x-ui.select 
    placeholder="Choose categories..."
    multiple
    searchable
    clearable
    wire:model="selectedCategories"
>
    @foreach($categories as $key => $category)
        <x-ui.select.option value="{{ $key }}">
            {{ $category }}
        </x-ui.select.option>
    @endforeach
</x-ui.select>
```


### Handling Dynamic or Dependent Selects

When using dependent `<x-ui.select>` components (for example, Country -> State), Livewire may not correctly re-render the second select when its parent changes.
This can cause options to appear greyed out or not visually update, even though the correct value is submitted.

To fix this, **add unique `wire:key` attributes** to both the `<x-ui.select>` and each `<x-ui.select.option>` element.
This ensures Livewire can properly track and re-render the DOM when the data changes.

```blade
<x-ui.select
    wire:model.live="country_id"
    placeholder="Choose country..."
    searchable
>
    <x-ui.select.option value="">Select Country</x-ui.select.option>
    @foreach ($countries as $country)
        <x-ui.select.option value="{{ $country->id }}">
            {{ $country->name }}
        </x-ui.select.option>
    @endforeach
</x-ui.select>

<x-ui.select
    wire:model.live="state_id"
    :wire:key="'state-select-' . $country_id"
    placeholder="Choose state..."
    searchable
>
    <x-ui.select.option value="">Select State</x-ui.select.option>
    @foreach ($states as $state)
        <x-ui.select.option :wire:key="'state-option-' . $state->id" value="{{ $state->id }}">
            {{ $state->name }}
        </x-ui.select.option>
    @endforeach
</x-ui.select>
```

> **Tip:** Refer to the [Livewire docs on `wire:key`](https://livewire.laravel.com/docs/troubleshooting#adding-wirekey) for more details on how keys help with dynamic component re-renders.

### Conditional Options

```blade
<x-ui.select 
    placeholder="Choose a plan..."
    wire:model="selectedPlan">
        <x-ui.select.option value="free" icon="gift">Free Plan</x-ui.select.option>
        <x-ui.select.option value="pro" icon="star">Pro Plan</x-ui.select.option>
        @if($user->isEnterprise())
            <x-ui.select.option value="enterprise" icon="building-office">Enterprise Plan</x-ui.select.option>
        @endif
</x-ui.select>
```

## Component Props

### ui.select

| Prop Name | Type | Default | Required | Description |
| --------- | ---- | ------- | -------- | ----------- |
| `name` | string | auto-detected from `wire:model` or `x-model` | No | Hidden input name attribute |
| `label` | string | `null` | No | Label displayed above the select |
| `triggerLabel` | string | `null` | No | Static label shown in the trigger button |
| `placeholder` | string | `'select...'` | No | Placeholder text when no value is selected |
| `searchable` | boolean | `false` | No | Enables the search input inside the dropdown |
| `search` | mixed | `null` | No | Custom search slot/content override |
| `empty` | mixed | `null` | No | Custom empty state slot/content override |
| `multiple` | boolean | `false` | No | Enables multi-selection mode |
| `clearable` | boolean | `false` | No | Shows a clear/reset button in the trigger |
| `disabled` | boolean | `false` | No | Disables the entire select component |
| `pillbox` | boolean | `false` | No | Shows selected values as pills in the trigger (requires `multiple`) |
| `icon` | string | `null` | No | Leading icon name in the trigger |
| `iconAfter` | string | `'chevron-up-down'` | No | Trailing icon name in the trigger |
| `checkIcon` | string | `'check'` | No | Icon shown next to selected options |
| `checkIconClass` | string | `null` | No | Additional CSS classes for the check icon |
| `invalid` | boolean | `null` | No | Applies error/invalid styling |
| `triggerClass` | string | `null` | No | Additional CSS classes for the trigger button |
| `maxSelection` | number | `null` | No | Maximum number of selectable options (multiple mode) |
| `minSelection` | number | `null` | No | Minimum number of required selections (multiple mode) |
| `size` | string | `'default'` | No | Size variant of the select |
| `slot` | slot | — | Yes | Content slot — accepts `<x-ui.select.option>` and other sub-components |


### ui.select.option

| Prop Name | Type | Default | Required | Description |
| --------- | ---- | ------- | -------- | ----------- |
| `value` | string | Falls back to slot text content | No | The value submitted/stored on selection |
| `label` | string | Falls back to slot text content | No | Display label (also used as search text fallback) |
| `searchLabel` | string | Falls back to `label` | No | Override text used when filtering via search |
| `icon` | string | `null` | No | Leading icon rendered before the label |
| `iconClass` | string | `null` | No | Additional CSS classes for the option icon |
| `disabled` | boolean | `false` | No | Disables this individual option |
| `allowCustomSlots` | boolean | `false` | No | Enables fully custom slot content. When `true`, the default check icon and label structure are removed and your slot renders directly. Requires `label` prop — throws `RuntimeException` if omitted |

> **Note:** When `allowCustomSlots` is `false` (default), `value` and `label` fall back to the slot's plain text. When `allowCustomSlots` is `true`, a `label` prop is **required** or a `RuntimeException` is thrown.


### ui.select.group

| Prop Name | Type | Default | Required | Description |
| --------- | ---- | ------- | -------- | ----------- |
| `label` | string | `null` | No | Group heading label rendered above the grouped options |
| `slot` | slot | — | Yes | Content — accepts `<x-ui.select.option>` components |


### ui.select.search

| Prop Name | Type | Default | Required | Description |
| --------- | ---- | ------- | -------- | ----------- |
| `$attributes` | mixed | — | No | All attributes are forwarded to the underlying `<input>` element (e.g. `placeholder`, `x-model`) |

> This component has no declared `@props`. All behaviour is driven by `x-rover:input` and forwarded HTML attributes on the internal `<input>`.


### ui.select.separator

| Prop Name | Type | Default | Required | Description |
| --------- | ---- | ------- | -------- | ----------- |
| `$attributes` | mixed | — | No | Extra attributes/classes merged onto the separator `<div>` |

> No declared `@props`. Renders a thin horizontal rule via CSS. Use between option groups for visual separation.

### ui.select.create

| Prop Name | Type | Default | Required | Description |
| --------- | ---- | ------- | -------- | ----------- |
| `$attributes` | mixed | — | No | Extra attributes/classes merged onto the `<li>` element |
| `slot` | slot | — | Yes | Content rendered inside the create-option row (e.g. "Add new…" label) |

>  Always rendered with `wire:key="create-option"`.

### ui.select.empty

| Prop Name | Type | Default | Required | Description |
| --------- | ---- | ------- | -------- | ----------- |
| `$attributes` | mixed | — | No | Extra attributes/classes merged onto the `<li>` element |
| `slot` | slot | — | Yes | Content shown when no options match the current search |

> Hidden automatically via CSS when the options list is in a loading state (`[data-loading]`).
