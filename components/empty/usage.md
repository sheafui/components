---
name: empty
---

## Introduction

The `Empty` component provides **beautiful empty state placeholders** for when there's no data to display. It offers a flexible composition API for creating meaningful empty states that guide users toward the next action.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `empty` component easily:

```bash
php artisan sheaf:install empty
```

> Once installed, you can use the `<x-ui.empty />`, `<x-ui.empty.media />`, and `<x-ui.empty.contents />` components in any Blade view.

## Usage

@blade
<x-demo class="w-full flex justify-center">
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

## Styling Variants

Customize the appearance using Tailwind classes:

### Bordered

@blade
<x-demo class="w-full flex justify-center">
    <div class="w-full max-w-2xl">
        <x-ui.empty class="border border-neutral-200 dark:border-neutral-800 rounded-box">
            <x-ui.empty.media>
                <x-ui.icon name="folder-open" class="size-10" />
            </x-ui.empty.media>
            <x-ui.empty.contents>
                <x-ui.heading>No items</x-ui.heading>
                <x-ui.text class="opacity-70">Get started by creating your first item.</x-ui.text>
            </x-ui.empty.contents>
        </x-ui.empty>
    </div>
</x-demo>
@endblade

```blade
<x-ui.empty class="border border-neutral-200 dark:border-neutral-800 rounded-box">
    <!-- content -->
</x-ui.empty>
```

### Background

@blade
<x-demo class="w-full flex justify-center">
    <div class="w-full ">
        <x-ui.empty class="bg-neutral-50 dark:bg-white/5 rounded-box">
            <x-ui.empty.media>
                <x-ui.icon name="folder-open" class="size-10" />
            </x-ui.empty.media>
            <x-ui.empty.contents>
                <x-ui.heading>No items</x-ui.heading>
                <x-ui.text class="opacity-70">Get started by creating your first item.</x-ui.text>
            </x-ui.empty.contents>
        </x-ui.empty>
    </div>
</x-demo>
@endblade

```blade
<x-ui.empty class="bg-neutral-50 dark:bg-white/5 rounded-box">
    <!-- content -->
</x-ui.empty>
```

## Media Styling

Customize the media area with Tailwind classes:

@blade
<x-demo class="w-full flex justify-center">
    <div class="w-full max-w-2xl grid grid-cols-2 gap-6">
        <x-ui.empty class="border border-neutral-200 dark:border-neutral-800 rounded-box">
            <x-ui.empty.media>
                <x-ui.icon name="inbox" class="size-10" />
            </x-ui.empty.media>
            <x-ui.empty.contents>
                <x-ui.heading>Simple Icon</x-ui.heading>
                <x-ui.text class="opacity-70">Default icon display</x-ui.text>
            </x-ui.empty.contents>
        </x-ui.empty>
        <!--  -->
        <x-ui.empty class="border border-neutral-200 dark:border-neutral-800 rounded-box">
            <x-ui.empty.media class="flex items-center justify-center w-12 h-12 rounded-full bg-neutral-100 dark:bg-neutral-800">
                <x-ui.icon name="document" class="size-6" />
            </x-ui.empty.media>
            <x-ui.empty.contents>
                <x-ui.heading>Icon with Circle</x-ui.heading>
                <x-ui.text class="opacity-70">Circular background</x-ui.text>
            </x-ui.empty.contents>
        </x-ui.empty>
    </div>
</x-demo>
@endblade

```blade
<!-- Simple icon -->
<x-ui.empty.media>
    <x-ui.icon name="inbox" class="size-10" />
</x-ui.empty.media>

<!-- Icon with circular background -->
<x-ui.empty.media class="flex items-center justify-center w-12 h-12 rounded-full bg-neutral-100 dark:bg-neutral-800">
    <x-ui.icon name="document" class="size-6" />
</x-ui.empty.media>
```

## Examples

### With Action Button

Guide users to take action with a prominent button:

@blade
<x-demo class="w-full flex justify-center">
    <div class="w-full max-w-lg">
        <x-ui.empty class="border border-neutral-200 dark:border-neutral-800 rounded-box">
            <x-ui.empty.media class="flex items-center justify-center w-12 h-12 rounded-full bg-neutral-100 dark:bg-neutral-800">
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
<x-ui.empty class="border border-neutral-200 dark:border-neutral-800 rounded-box">
    <x-ui.empty.media class="flex items-center justify-center w-12 h-12 rounded-full bg-neutral-100 dark:bg-neutral-800">
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
<x-demo class="w-full flex justify-center">
    <div class="w-full max-w-lg">
        <x-ui.empty>
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
                    Start by contacting the team.
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
<x-ui.empty>
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
            Start by contacting the team.
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
<x-demo class="w-full flex justify-center">
    <div class="w-full max-w-lg">
        <x-ui.empty>
            <x-ui.empty.media class="flex items-center justify-center w-12 h-12 rounded-full bg-neutral-100 dark:bg-neutral-800">
                <x-ui.icon name="magnifying-glass" class="size-6" />
            </x-ui.empty.media>
            <!--  -->
            <x-ui.empty.contents class="">
                <x-ui.heading>No results found</x-ui.heading>
                <x-ui.text class="opacity-70 text-center">
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
    <x-ui.empty.media class="flex items-center justify-center w-12 h-12 rounded-full bg-neutral-100 dark:bg-neutral-800">
        <x-ui.icon name="magnifying-glass" class="size-6" />
    </x-ui.empty.media>

    <x-ui.empty.contents>
        <x-ui.heading>No results found</x-ui.heading>
        <x-ui.text class="opacity-70 text-center">
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
<x-demo class="w-full flex justify-center">
    <div class="w-full max-w-3xl rounded-box overflow-hidden">
        <x-ui.table>
            <x-ui.table.header>
                <x-ui.table.columns>
                    <x-ui.table.head>
                        name
                    </x-ui.table.head>
                    <x-ui.table.head>
                        type
                    </x-ui.table.head>
                    <x-ui.table.head>
                        created at
                    </x-ui.table.head>
                    <x-ui.table.head>
                        description
                    </x-ui.table.head>
                </x-ui.table.columns>
            </x-ui.table.header>
            <x-ui.table.rows>
                    <x-ui.table.empty>
                            <x-ui.empty>
                                <x-ui.empty.media 
                                    class="flex items-center justify-center w-12 h-12 rounded-full bg-neutral-100 dark:bg-neutral-800"
                                >
                                    <x-ui.icon name="inbox" class="size-6" />
                                </x-ui.empty.media>
                                <x-ui.empty.contents>
                                    <x-ui.heading>No data available</x-ui.heading>
                                    <x-ui.text class="opacity-70">
                                        Start by adding your first entry.
                                    </x-ui.text>
                                </x-ui.empty.contents>
                            </x-ui.empty>
                    </x-ui.table.empty>
            </x-ui.table.rows>
        </x-ui.table>
    </div>
</x-demo>
@endblade

```blade
<x-ui.table>
    <!-- header-->
    <x-ui.table.rows>
        @forelse ($items as $item)
            <x-ui.table.row>
                <!-- table cells -->
            </x-ui.table.row>
        @empty
            <x-ui.table.row>
                <x-ui.table.cell colspan="4" class="!p-0">
                    <x-ui.empty>
                        <x-ui.empty.media class="flex items-center justify-center w-12 h-12 rounded-full bg-neutral-100 dark:bg-neutral-800">
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
<x-demo class="w-full flex justify-center">
    <div class="w-full max-w-lg">
        <x-ui.empty class="border border-neutral-200 dark:border-neutral-800 rounded-box">
            <x-ui.empty.media class="flex items-center justify-center w-12 h-12 rounded-full bg-neutral-100 dark:bg-neutral-800">
                <x-ui.icon name="folder-plus" class="size-6" />
            </x-ui.empty.media>
            <!--  -->
            <x-ui.empty.contents class="mt-auto">
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
<x-ui.empty class="border border-neutral-200 dark:border-neutral-800 rounded-box">
    <x-ui.empty.media class="flex items-center justify-center w-12 h-12 rounded-full bg-neutral-100 dark:bg-neutral-800">
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

## Common Styling Patterns

Here are some frequently used styling combinations:

```blade
<!-- Bordered card -->
<x-ui.empty class="border border-neutral-200 dark:border-neutral-800 rounded-box">

<!-- Elevated card -->
<x-ui.empty class="border border-neutral-200 dark:border-neutral-800 rounded-box shadow-sm">

<!-- Filled background -->
<x-ui.empty class="bg-neutral-50 dark:bg-neutral-900 rounded-box">

<!-- Filled with border -->
<x-ui.empty class="bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-box">

<!-- Subtle gradient background -->
<x-ui.empty class="bg-gradient-to-b from-neutral-50 to-white dark:from-neutral-900 dark:to-neutral-950 rounded-box">

<!-- Larger padding -->
<x-ui.empty class="py-16">

<!-- Icon container with color -->
<x-ui.empty.media class="flex items-center justify-center w-14 h-14 rounded-full bg-blue-100 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400">
    <x-ui.icon name="inbox" class="size-7" />
</x-ui.empty.media>
```