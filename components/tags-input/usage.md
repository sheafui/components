---
name: 'tags-input'
---

# Tags Input Component

## Introduction

The `tags-input` component provides a powerful and flexible way to handle multiple tags or keywords input. It features autocomplete suggestions, drag-and-drop reordering, validation, persistence, and full accessibility support. Perfect for skills, categories, keywords, or any multi-value input scenario.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `tags-input` component easily:

```bash
php artisan sheaf:install tags-input
```

## Basic Usage

@blade
<x-demo  x-data="{ tags: ['convergephp','sheaf','eigenify']}">
    <x-ui.tags-input 
        x-model="tags" 
        placeholder="Add tags..."
    />
</x-demo>
@endblade

```html
<x-ui.tags-input 
    wire:model="tags"  
    placeholder="Add tags..."
/>
```
### Bind To livewire

to use with livewire you need to only to use `wire:mode="tags"` to bind your tags state 

### Using it within Blade & Alpine
you can use it outside livewire and just alpine (with blade):

```html
<div class="w-full" x-data="{ tags: ['convergephp','sheaf','eigenify']}">
    <x-ui.tags-input 
        x-model="tags" 
        placeholder="Add tags..."
    />
</div>
```
because we're making this possible using the `x-modelable` API so you can't use `state` as a name variable because the component use it internally


## Customization

### Tag Variants

Control the visual appearance of your tags with different shapes.

@blade
<x-demo  >
    <div   x-data="{ tags: ['convergephp','sheaf','eigenify']}">
        <x-ui.tags-input 
            x-model="tags" 
            placeholder="Rounded tags (default)"
            tagVariant="rounded"
            class="mb-4"
        />
        <x-ui.tags-input 
            x-model="tags"  
            placeholder="Pill-shaped tags"
            tagVariant="pill"
        />
    </div>
</x-demo>
@endblade

```html
<x-ui.tags-input 
    wire:model="tags" 
    placeholder="Rounded tags (default)"
    tagVariant="rounded"
/>
<x-ui.tags-input 
    wire:model="tags" 
    placeholder="Pill-shaped tags"
    tagVariant="pill"
/>
```


### Tag Color
by default tags input uses the primary color but you can any tailwind color you want:

@blade
<x-demo  >
    <div class="space-y-6 max-w-2xlw-full mx-auto h-[25rem] overflow-y-auto p-4" x-data="{ tags: ['convergephp','sheaf','eigenify']}">
        @foreach([
            'red', 'orange', 'amber', 'yellow', 'lime', 'green',
            'emerald', 'teal', 'cyan', 'sky', 'blue', 'indigo',
            'violet', 'purple', 'fuchsia', 'pink', 'rose',
        ] as $color)
                @php
                    $placeholder = "Add new $color tag ";
                @endphp
                <x-ui.tags-input 
                    x-model="tags" 
                    :placeholder="$placeholder"
                    tagVariant="rounded"
                    class="mb-2"
                    :tagColor="$color"
                />
        @endforeach
    </div>
</x-demo>
@endblade

```html
<div class="space-y-6 max-w-2xlw-full mx-auto h-[25rem] overflow-y-auto p-4">
    @foreach([
        'red', 'orange', 'amber', 'yellow', 'lime', 'green',
        'emerald', 'teal', 'cyan', 'sky', 'blue', 'indigo',
        'violet', 'purple', 'fuchsia', 'pink', 'rose',
    ] as $color)
            @php
                $placeholder = "Add new $color tag ";
            @endphp
            <x-ui.tags-input 
                wire:model.defer="fake"
                :placeholder="$placeholder"
                tagVariant="rounded"
                class="mb-2"
                :tagColor="$color"
            />
    @endforeach
</div>
```

## Advanced Features

### Suggestions and Autocomplete

Provide users with helpful suggestions as they type.

@blade
<x-demo  >
    <x-ui.tags-input 
        placeholder="Type to see suggestions..."
        :suggestions="['PHP', 'Laravel', 'Vue.js', 'Alpine.js', 'Tailwind CSS', 'JavaScript']"
    />
</x-demo>
@endblade

```html
<x-ui.tags-input 
    wire:model="skillTags" 
    placeholder="Type to see suggestions..."
    :suggestions="['PHP', 'Laravel', 'Vue.js', 'Alpine.js', 'Tailwind CSS', 'JavaScript', 'Python', 'React', 'Node.js']"
/>
```

to force of choosing only predifined tags you by setting   ``:allowCustom="false"``
@blade
<x-demo  >
    <x-ui.tags-input 
        :allowCustom="false"
        placeholder="Type something isn't in the suggestions list"
        :suggestions="['PHP', 'Laravel', 'Vue.js', 'Alpine.js', 'Tailwind CSS', 'JavaScript']"
    />
</x-demo>
@endblade

```html
<x-ui.tags-input 
    wire:model="skillTags" 
    :allowCustom="false"
    placeholder="Type something isn't in the suggestions list"
    :suggestions="['PHP', 'Laravel', 'Vue.js', 'Alpine.js', 'Tailwind CSS', 'JavaScript', 'Python', 'React', 'Node.js']"
/>
```

### Validation and Constraints

Set limits and validation rules to ensure data quality.

@blade
<x-demo  >
    <x-ui.tags-input 
        placeholder="Max 3 tags, 2-10 characters each"
        :max-tags="3"
        :min-tag-length="2"
        :max-tag-length="10"
        :show-counter="true"
    />
</x-demo>
@endblade

```html
<x-ui.tags-input 
    wire:model="constrainedTags" 
    placeholder="Max 3 tags, 2-10 characters each"
    :max-tags="3"
    :min-tag-length="2"
    :max-tag-length="10"
    :show-counter="true"
/>
```



### Custom Separators

Define which keys should create new tags.

> use can use this feature when you want to paste formated data in specific format 

@blade
<x-demo  >
    <x-ui.tags-input 
        placeholder="Use asterik, comma, space or semicolon to separate"
        :split-keys="['*',' ',',', ';']"
    />
</x-demo>
@endblade

```html
<x-ui.tags-input 
    wire:model="customSeparators" 
    placeholder="Use asterik, comma, space or semicolon to separate"
    :split-keys="['*',' ', ',', ';']"
/>
```



### Bulk Operations

Enable counter display and clear all functionality.

@blade
<x-demo   x-data="{ tags: ['convergephp','sheaf','eigenify']}">
    <x-ui.tags-input 
        x-model="tags" 
        placeholder="Tags with counter and clear all"
        :show-counter="false"
        :show-clear-all="false"
    />
</x-demo>
@endblade

```html
<x-ui.tags-input 
    wire:model="bulkTags" 
    placeholder="Tags with counter and clear all"
    :show-counter="false"
    :show-clear-all="false"
/>
```

## States and Validation

### Disabled State

@blade
<x-demo  >
    <x-ui.tags-input 
        placeholder="Disabled tags input"
        disabled
    />
</x-demo>
@endblade

```html
<x-ui.tags-input 
    wire:model="disabledTags" 
    placeholder="Disabled tags input"
    disabled
/>
```



### Character Validation

Restrict input to specific character patterns.

@blade
<x-demo  >
    <x-ui.tags-input 
        placeholder="Only alphanumeric characters allowed"
        allowed-chars="^[a-zA-Z0-9]+$"
    />
</x-demo>
@endblade

```html
<x-ui.tags-input 
    wire:model="alphanumericTags" 
    placeholder="Only alphanumeric characters allowed"
    allowed-chars="^[a-zA-Z0-9]+$"
/>
```

### Blocked Words

while you can't use character validation as previsouly but for conveniece you can prevent specific words from being added as tags expecitly.

@blade
<x-demo  >
    <x-ui.tags-input 
        placeholder="Try typing 'spam' or 'test'"
        :blocked-words="['spam', 'test', 'admin']"
    />
</x-demo>
@endblade

```html
<x-ui.tags-input 
    wire:model="filteredTags" 
    placeholder="Try typing 'spam' or 'test'"
    :blocked-words="['spam', 'test', 'admin']"
/>
```

## Auto-Sorting

Automatically sort tags alphabetically.

@blade
<x-demo  >
    <x-ui.tags-input 
        placeholder="Tags will be sorted automatically"
        :sort-tags="true"
    />
</x-demo>
@endblade

```html
<x-ui.tags-input 
    wire:model="sortedTags" 
    placeholder="Tags will be sorted automatically"
    :sort-tags="true"
/>
```

> you can change the direction using the ``sort-direction="desc"``
## Drag and Drop

Users can reorder tags by dragging and dropping them.

> The component includes zero dependency built-in drag-and-drop functionality. Simply drag tags to reorder them.

@blade
<x-demo   x-data="{ tags: ['convergephp','sheaf','eigenify']}">
    <x-ui.tags-input
        x-model="tags"  
        placeholder="Add tags and drag to reorder"
    />
</x-demo>
@endblade

```html
<x-ui.tags-input 
    x-model="tags" 
    placeholder="Add tags and drag to reorder"
/>
```

## Component Props

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `wire:model` | string | - | Yes | Livewire property to bind to |
| `placeholder` | string | `'Add tags...'` | No | Input placeholder text |
| `tag-variant` | string | `'rounded'` | No | variant: `rounded`, `pill` |
| `tag-color` | string | `'primary'` | No | colors: `red`.... |
| `disabled` | boolean | `false` | No | Whether the input is disabled |
| `max-tags` | integer | `null` | No | Maximum number of tags allowed |
| `min-tag-length` | integer | `1` | No | Minimum characters per tag |
| `max-tag-length` | integer | `50` | No | Maximum characters per tag |
| `allow-duplicates` | boolean | `false` | No | Allow duplicate tags |
| `case-sensitive` | boolean | `false` | No | Case-sensitive duplicate checking |
| `split-keys` | array | `[' ', ',', ';']` | No | Keys that create new tags |
| `suggestions` | array | `[]` | No | Autocomplete suggestions |
| `allow-custom` | boolean | `true` | No | Allow custom tags beyond suggestions |
| `blocked-words` | array | `[]` | No | Words that cannot be added as tags |
| `allowed-chars` | string | `null` | No | Regex pattern for allowed characters |
| `show-counter` | boolean | `false` | No | Show tag counter |
| `show-clear-all` | boolean | `false` | No | Show clear all button |
| `sort-tags` | boolean | `false` | No | Auto-sort tags alphabetically |
| `sort-direction` | string | `'asc'` | No | Sort direction: `asc`, `desc` |
| `create-on-blur` | boolean | `true` | No | Create tag when input loses focus |
| `create-on-paste` | boolean | `true` | No | Handle paste with auto-splitting |
| `aria-label` | string | `'Tags input'` | No | ARIA label for accessibility |
| `aria-description` | string | `null` | No | ARIA description |
| `class` | string | `''` | No | Additional CSS classes |