---
name: empty
---

## Introduction

The `Empty` component provides **beautiful empty state placeholders** for when there's no data to display. It offers multiple variants and a flexible composition API for creating meaningful empty states that guide users toward the next action.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `empty` component easily:

```bash
php artisan sheaf:install empty
```

> Once installed, you can use the `<x-ui.empty />`, `<x-ui.empty.media />`, and `<x-ui.empty.contents />` components in any Blade view.

## Usage

@blade
<x-demo class="flex justify-center">
    <div class="w-full max-w-lg">
        <x-ui.empty>
            <x-ui.empty.media>
                <x-ui.icon name="inbox" class="size-10" />
            </x-ui.empty.media>
            <x-ui.empty.contents>
                <x-ui.heading>No results found</x-ui.heading>
                <x-ui.text class="opacity-70">
                    Try adjusting your filters or create a new item.
                </x-ui.text>
            </x-ui.empty.contents>
        </x-ui.empty>
    </div>
</x-demo>
@endblade

### Basic Empty State

The most basic usage combines media (icon/image) with descriptive content:

```blade
<x-ui.empty>
    <x-ui.empty.media>
        <x-ui.icon name="inbox" class="size-10" />
    </x-ui.empty.media>

    <x-ui.empty.contents>
        <x-ui.heading>No messages</x-ui.heading>
        <x-ui.text class="opacity-70">
            Your inbox is empty. Start a conversation!
        </x-ui.text>
    </x-ui.empty.contents>
</x-ui.empty>
```

## Variants

Choose from different visual styles to match your design:

@blade
<x-demo class="flex justify-center">
    <div class="w-full max-w-2xl space-y-8">
        <div class="space-y-2">
            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Default</p>
            <x-ui.empty>
                <x-ui.empty.media>
                    <x-ui.icon name="folder-open" class="size-10" />
                </x-ui.empty.media>
                <x-ui.empty.contents>
                    <x-ui.heading>No items</x-ui.heading>
                    <x-ui.text class="opacity-70">Get started by creating your first item.</x-ui.text>
                </x-ui.empty.contents>
            </x-ui.empty>
        </div>

        <div class="space-y-2">
            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Bordered</p>
            <x-ui.empty variant="bordered">
                <x-ui.empty.media>
                    <x-ui.icon name="folder-open" class="size-10" />
                </x-ui.empty.media>
                <x-ui.empty.contents>
                    <x-ui.heading>No items</x-ui.heading>
                    <x-ui.text class="opacity-70">Get started by creating your first item.</x-ui.text>
                </x-ui.empty.contents>
            </x-ui.empty>
        </div>

        <div class="space-y-2">
            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Background</p>
            <x-ui.empty variant="background">
                <x-ui.empty.media>
                    <x-ui.icon name="folder-open" class="size-10" />
                </x-ui.empty.media>
                <x-ui.empty.contents>
                    <x-ui.heading>No items</x-ui.heading>
                    <x-ui.text class="opacity-70">Get started by creating your first item.</x-ui.text>
                </x-ui.empty.contents>
            </x-ui.empty>
        </div>
    </div>
</x-demo>
@endblade

```blade
<!-- Default variant -->
<x-ui.empty>
    <!-- content -->
</x-ui.empty>

<!-- Bordered variant -->
<x-ui.empty variant="bordered">
    <!-- content -->
</x-ui.empty>

<!-- Background variant -->
<x-ui.empty variant="background">
    <!-- content -->
</x-ui.empty>
```

## Media Variants

Use different media styles to emphasize your empty state:

@blade
<x-demo class="flex justify-center">
    <div class="w-full max-w-2xl grid grid-cols-2 gap-6">
        <x-ui.empty variant="bordered">
            <x-ui.empty.media>
                <x-ui.icon name="inbox" class="size-10" />
            </x-ui.empty.media>
            <x-ui.empty.contents>
                <x-ui.heading>Icon Media</x-ui.heading>
                <x-ui.text class="opacity-70">Simple icon display</x-ui.text>
            </x-ui.empty.contents>
        </x-ui.empty>

        <x-ui.empty variant="bordered">
            <x-ui.empty.media variant="icon">
                <x-ui.icon name="document" class="size-6" />
            </x-ui.empty.media>
            <x-ui.empty.contents>
                <x-ui.heading>Icon Variant</x-ui.heading>
                <x-ui.text class="opacity-70">With background circle</x-ui.text>
            </x-ui.empty.contents>
        </x-ui.empty>
    </div>
</x-demo>
@endblade

```blade
<!-- Default media -->
<x-ui.empty.media>
    <x-ui.icon name="inbox" class="size-10" />
</x-ui.empty.media>

<!-- Icon variant with background -->
<x-ui.empty.media variant="icon">
    <x-ui.icon name="document" class="size-6" />
</x-ui.empty.media>
```

## Examples

### With Action Button

Guide users to take action with a prominent button:

@blade
<x-demo class="flex justify-center">
    <div class="w-full max-w-lg">
        <x-ui.empty variant="bordered">
            <x-ui.empty.media variant="icon">
                <x-ui.icon name="document" class="size-6" />
            </x-ui.empty.media>

            <x-ui.empty.contents>
                <x-ui.heading>No documents</x-ui.heading>
                <x-ui.text class="opacity-70">
                    You haven't created any documents yet.
                </x-ui.text>

                <x-ui.button size="sm" class="mt-3">
                    Create document
                </x-ui.button>
            </x-ui.empty.contents>
        </x-ui.empty>
    </div>
</x-demo>
@endblade

```blade
<x-ui.empty variant="bordered">
    <x-ui.empty.media variant="icon">
        <x-ui.icon name="document" class="size-6" />
    </x-ui.empty.media>

    <x-ui.empty.contents>
        <x-ui.heading>No documents</x-ui.heading>
        <x-ui.text class="opacity-70">
            You haven't created any documents yet.
        </x-ui.text>

        <x-ui.button size="sm" class="mt-3">
            Create document
        </x-ui.button>
    </x-ui.empty.contents>
</x-ui.empty>
```

### With Avatar Group

Show team or user context in your empty state:

@blade
<x-demo class="flex justify-center">
    <div class="w-full max-w-lg">
        <x-ui.empty variant="background">
            <x-ui.empty.media>
                <x-ui.avatar.group>
                    <x-ui.avatar circle src="/mohamed.png" name="Mohamed Charrafi" />
                    <x-ui.avatar circle src="/youssef.jpeg" name="Youssef" />
                    <x-ui.avatar circle>+1</x-ui.avatar>
                </x-ui.avatar.group>
            </x-ui.empty.media>

            <x-ui.empty.contents>
                <x-ui.heading class="text-lg font-semibold">The Team Above</x-ui.heading>
                <x-ui.text class="opacity-70">
                    Start by adding your first item.
                </x-ui.text>

                <div class="flex gap-2 mt-4">
                    <x-ui.button>Create</x-ui.button>
                    <x-ui.button variant="ghost">Learn more</x-ui.button>
                </div>
            </x-ui.empty.contents>
        </x-ui.empty>
    </div>
</x-demo>
@endblade

```blade
<x-ui.empty variant="background">
    <x-ui.empty.media>
        <x-ui.avatar.group>
            <x-ui.avatar circle src="/user1.png" name="User 1" />
            <x-ui.avatar circle src="/user2.png" name="User 2" />
            <x-ui.avatar circle>+3</x-ui.avatar>
        </x-ui.avatar.group>
    </x-ui.empty.media>

    <x-ui.empty.contents>
        <x-ui.heading class="text-lg font-semibold">The Team Above</x-ui.heading>
        <x-ui.text class="opacity-70">
            Start by adding your first item.
        </x-ui.text>

        <div class="flex gap-2 mt-4">
            <x-ui.button>Create</x-ui.button>
            <x-ui.button variant="ghost">Learn more</x-ui.button>
        </div>
    </x-ui.empty.contents>
</x-ui.empty>
```

### Search Results Empty State

Handle empty search results with helpful messaging:

@blade
<x-demo class="flex justify-center">
    <div class="w-full max-w-lg">
        <x-ui.empty>
            <x-ui.empty.media variant="icon">
                <x-ui.icon name="magnifying-glass" class="size-6" />
            </x-ui.empty.media>

            <x-ui.empty.contents>
                <x-ui.heading>No results found</x-ui.heading>
                <x-ui.text class="opacity-70">
                    We couldn't find anything matching "your search". Try different keywords.
                </x-ui.text>

                <x-ui.button variant="outline" size="sm" class="mt-3">
                    Clear search
                </x-ui.button>
            </x-ui.empty.contents>
        </x-ui.empty>
    </div>
</x-demo>
@endblade

```blade
<x-ui.empty>
    <x-ui.empty.media variant="icon">
        <x-ui.icon name="magnifying-glass" class="size-6" />
    </x-ui.empty.media>

    <x-ui.empty.contents>
        <x-ui.heading>No results found</x-ui.heading>
        <x-ui.text class="opacity-70">
            We couldn't find anything matching "{{ $searchQuery }}". Try different keywords.
        </x-ui.text>

        <x-ui.button variant="outline" size="sm" class="mt-3">
            Clear search
        </x-ui.button>
    </x-ui.empty.contents>
</x-ui.empty>
```

### In Table Context

Use empty states within tables for better UX:

@blade
<x-demo class="flex justify-center">
    <div class="w-full max-w-3xl border border-neutral-200 dark:border-neutral-800 rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-neutral-50 dark:bg-neutral-900/50 border-b border-neutral-200 dark:border-neutral-800">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-medium">Name</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" class="p-0">
                        <x-ui.empty>
                            <x-ui.empty.media variant="icon">
                                <x-ui.icon name="inbox" class="size-6" />
                            </x-ui.empty.media>
                            <x-ui.empty.contents>
                                <x-ui.heading>No data available</x-ui.heading>
                                <x-ui.text class="opacity-70">
                                    Start by adding your first entry.
                                </x-ui.text>
                            </x-ui.empty.contents>
                        </x-ui.empty>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-demo>
@endblade

```blade
<x-ui.table>
    <x-ui.table.rows>
        @forelse ($items as $item)
            <x-ui.table.row>
                <!-- table cells -->
            </x-ui.table.row>
        @empty
            <x-ui.table.row>
                <x-ui.table.cell colspan="4" class="!p-0">
                    <x-ui.empty>
                        <x-ui.empty.media variant="icon">
                            <x-ui.icon name="inbox" class="size-6" />
                        </x-ui.empty.media>
                        <x-ui.empty.contents>
                            <x-ui.heading>No data available</x-ui.heading>
                            <x-ui.text class="opacity-70">
                                Start by adding your first entry.
                            </x-ui.text>
                        </x-ui.empty.contents>
                    </x-ui.empty>
                </x-ui.table.cell>
            </x-ui.table.row>
        @endforelse
    </x-ui.table.rows>
</x-ui.table>
```

### Multiple Actions

Provide users with multiple paths forward:

@blade
<x-demo class="flex justify-center">
    <div class="w-full max-w-lg">
        <x-ui.empty variant="bordered">
            <x-ui.empty.media variant="icon">
                <x-ui.icon name="folder-plus" class="size-6" />
            </x-ui.empty.media>

            <x-ui.empty.contents>
                <x-ui.heading>No projects yet</x-ui.heading>
                <x-ui.text class="opacity-70">
                    Create your first project or import an existing one.
                </x-ui.text>

                <div class="flex gap-2 mt-4">
                    <x-ui.button size="sm">New project</x-ui.button>
                    <x-ui.button variant="outline" size="sm">Import</x-ui.button>
                </div>
            </x-ui.empty.contents>
        </x-ui.empty>
    </div>
</x-demo>
@endblade

```blade
<x-ui.empty variant="bordered">
    <x-ui.empty.media variant="icon">
        <x-ui.icon name="folder-plus" class="size-6" />
    </x-ui.empty.media>

    <x-ui.empty.contents>
        <x-ui.heading>No projects yet</x-ui.heading>
        <x-ui.text class="opacity-70">
            Create your first project or import an existing one.
        </x-ui.text>

        <div class="flex gap-2 mt-4">
            <x-ui.button size="sm">New project</x-ui.button>
            <x-ui.button variant="outline" size="sm">Import</x-ui.button>
        </div>
    </x-ui.empty.contents>
</x-ui.empty>
```

## Component Props

#### Empty Component

| Prop Name | Type   | Default     | Required | Description                                       |
| --------- | ------ | ----------- | -------- | ------------------------------------------------- |
| `variant` | string | `'default'` | No       | Visual style: `'default'`, `'bordered'`, `'background'` |

#### Empty Media Component

| Prop Name | Type   | Default     | Required | Description                                       |
| --------- | ------ | ----------- | -------- | ------------------------------------------------- |
| `variant` | string | `'default'` | No       | Media style: `'default'`, `'icon'`                |

#### Empty Contents Component

The contents component accepts any content and has no specific props beyond standard attributes.

## Component Structure

The empty component consists of:

- **Container**: `<x-ui.empty>` - Main wrapper with variant styling
- **Media**: `<x-ui.empty.media>` - Icon, image, or avatar display area
- **Contents**: `<x-ui.empty.contents>` - Text, buttons, and action elements

## Best Practices

1. **Be Helpful**: Explain why the state is empty and what users can do next
2. **Stay Positive**: Use encouraging language rather than negative phrasing
3. **Provide Action**: Include a clear call-to-action when appropriate
4. **Match Context**: Use different messages for "no data" vs "no search results"
5. **Keep it Simple**: Don't overwhelm users with too many options