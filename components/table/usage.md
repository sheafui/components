---
name: 'table'
---

# Table Component

## Introduction

The `table` component provides a powerful, composable system for building feature-rich data tables. Built with Livewire and Alpine.js, it offers pagination, sorting, searching, selection, bulk actions, column visibility controls, and more all with excellent accessibility and a clean, modern design.

Our approach uses **composable traits** on the backend and **Blade components** on the frontend, giving you complete control over your table's structure and behavior while maintaining clean, reusable code.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `table` component:

```bash
php artisan sheaf:install data-table
```

## Basic Static Table

Let's start with a simple static table without any dynamic features.

@blade
<x-demo class="w-full">
    <x-ui.table>
        <x-ui.table.header>
            <x-ui.table.columns>
                <x-ui.table.head>Name</x-ui.table.head>
                <x-ui.table.head>Email</x-ui.table.head>
                <x-ui.table.head>Role</x-ui.table.head>
            </x-ui.table.columns>
        </x-ui.table.header>
        <x-ui.table.rows>
            <x-ui.table.row>
                <x-ui.table.cell>Alice Johnson</x-ui.table.cell>
                <x-ui.table.cell>alice@example.com</x-ui.table.cell>
                <x-ui.table.cell>Admin</x-ui.table.cell>
            </x-ui.table.row>
            <x-ui.table.row>
                <x-ui.table.cell>Bob Smith</x-ui.table.cell>
                <x-ui.table.cell>bob@example.com</x-ui.table.cell>
                <x-ui.table.cell>Editor</x-ui.table.cell>
            </x-ui.table.row>
            <x-ui.table.row>
                <x-ui.table.cell>Carol White</x-ui.table.cell>
                <x-ui.table.cell>carol@example.com</x-ui.table.cell>
                <x-ui.table.cell>Viewer</x-ui.table.cell>
            </x-ui.table.row>
        </x-ui.table.rows>
    </x-ui.table>
</x-demo>
@endblade

```blade
<x-ui.table>
    <x-ui.table.header>
        <x-ui.table.columns>
            <x-ui.table.head>Name</x-ui.table.head>
            <x-ui.table.head>Email</x-ui.table.head>
            <x-ui.table.head>Role</x-ui.table.head>
        </x-ui.table.columns>
    </x-ui.table.header>

    <x-ui.table.rows>
        <x-ui.table.row>
            <x-ui.table.cell>Alice Johnson</x-ui.table.cell>
            <x-ui.table.cell>alice@example.com</x-ui.table.cell>
            <x-ui.table.cell>Admin</x-ui.table.cell>
        </x-ui.table.row>
        <!-- More rows... -->
    </x-ui.table.rows>
</x-ui.table>
```

---

## Sorting

Add column sorting with visual indicators and flexible behavior. To enable sorting, first add the `App\Livewire\Concerns\WithSorting` trait to your Livewire component:

```php
{~
use App\Models\User;
use App\Livewire\Concerns\WithSorting;
use App\Livewire\Concerns\WithPagination;

class UsersTable extends Component
{~}
    {+
    use WithSorting;+}

    public function render()
    {
        $users = User::query()
{+            ->when(filled($this->sortBy), function ($query) {
                return $this->applySorting($query);
            })+}
            ->paginate();

        return view('livewire.users-table', [
            'users' => $users,
        ]);
    }
}
```

The `$this->sortBy` and `$this->applySorting()` methods come from the `WithSorting` trait.

In your table header view, mark sortable columns and pass the current sort state:

```blade
<x-ui.table.head
{+    column="name"
    sortable
    :currentSortBy="$sortBy"
    :currentSortDir="$sortDir"+}
>
    Name
</x-ui.table.head>
```

**Key attributes:**
- `column` — Database column name
- `sortable` — Marks the column as sortable
- `currentSortBy` and `currentSortDir` — Reactive Livewire properties tracking sort state

> **Note:** If you want to restrict sorting on the backend, you can use the `sortableColumns()` method on the component class.

### Sorting Variants

There are two sorting variants:

- **`default`** — Shows sorting icons on hover and cycles sorting on click
- **`dropdown`** — Opens a menu where the user explicitly chooses the sorting direction

```blade
<x-ui.table.head
{~    column="name"
    sortable
    :currentSortBy="$sortBy"
    :currentSortDir="$sortDir"~}
{+    variant="default" <!-- default -->+}
    <!-- or -->
{+    variant="dropdown"+}
>
    Name
</x-ui.table.head>
```

You can see these variants in action on our interactive [Math Theorems demo](/demos/datatables). Sorting by year uses the dropdown variant, while mathematician and difficulty columns use the default variant.

---

## Pagination

Add pagination to your table by passing a Laravel paginator to the table component.

First, create a Livewire component that uses the `App\Livewire\Concerns\WithPagination` trait:

```php
use App\Livewire\Concerns\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public function render()
    {
        $users = User::query()
{+            ->paginate();+}
            // or (if using length-aware paginator with full variant)
{+            ->paginate($this->perPage);+}

        return view('livewire.users-table', [
            'users' => $users,
        ]);
    }
}
```

Then pass the paginator to the `paginator` prop in the view:

```blade
<x-ui.table 
{+    :paginator="$users"+}
>
    <!-- table contents... -->
</x-ui.table>
```

### More About Pagination

@blade
<x-md.cta                                                            
    href="/docs/components/pagination"                                    
    label="The pagination component has very detailed documentation and demos there"
    ctaLabel="Visit Docs"
/>
@endblade

---

## Search

Enable real-time search across your table data. To enable search, first add the `App\Livewire\Concerns\WithSearch` trait to your Livewire component:

```php
{~
use App\Models\User;
use App\Livewire\Concerns\WithSearch;
use App\Livewire\Concerns\WithPagination;

class UsersTable extends Component
{~}
    {+
    use WithSearch;+}

    public function render()
    {
        $users = User::query()
{+            ->when(filled($this->searchQuery), function ($query) {
                return $this->applySearch($query);
            })+}
            ->paginate();

        return view('livewire.users-table', [
            'users' => $users,
        ]);
    }

{+    protected function applySearch($query)
    {
        return $query->where('name', 'like', '%'.$this->searchQuery.'%');
    }+}
}
```

The `applySearch()` method is where you define your search logic.

Then bind an input to the search query:

```blade
<x-ui.input 
    placeholder="Search..." 
    leftIcon="magnifying-glass" 
{+    wire:model.live="searchQuery" <!-- this is what's important -->+}
/>
```

See the search implementation in the complete guide below for a real-world layout.

---

## Selection

The component comes with all the logic you need to add row selection and "select all" functionality for handling bulk actions. To enable selection, first add the `App\Livewire\Concerns\WithSelection` trait to your Livewire component:

```php
{~
use App\Models\User;
use App\Livewire\Concerns\WithSelection;

class UsersTable extends Component
{~}
    {+
    use WithSelection;+}

    public function render()
    {
        $users = User::query()->paginate();

        // This is crucial - it tells us about the visible rows on the page
{+        $this->visibleIds = $users->pluck('id')
            ->map(fn ($id) => (string) $id)
            ->toArray();+}

        return view('livewire.users-table', [
            'users' => $users,
        ]);
    }
}
```

Then in the view, add `:checkboxId` to each `table.row` component to show the checkbox at the start of the row. To add "check all" functionality, add `withCheckAll` to the `table.columns` component:

```blade
<x-ui.table.columns
{+    withCheckAll+}
>
    <!-- other head components -->
</x-ui.table.columns>

<!-- AND -->

<x-ui.table.row 
{+    :checkboxId="$user->id"+}
    :key="$user->id"
>
    <!-- cells... -->
</x-ui.table.row>
```

Now you can perform operations on the selected IDs like this:

```php
public function deleteSelected()
{
    User::query()->whereIn('id', $this->selectedIds)->delete();
}

public function archiveSelected()
{
    User::query()->whereIn('id', $this->selectedIds)->each->archive();
}
```

---

## Loading States

Due to the nature of datatables being usually data-heavy, this component comes with a clean way to handle loading states.

To enable loading indicators, just add `wire:loading` to the table component:

```blade
<x-ui.table 
{+    wire:loading+}
>
    <!-- table content... -->
</x-ui.table>
```

For convenience, we've made it easy to enable loading on sorting, searching, and pagination by passing them comma-separated to the `loadOn` prop:

```blade
<x-ui.table 
{+    wire:loading
    loadOn="pagination, search, sorting"+}
>
    <!-- table content... -->
</x-ui.table>
```

To add other targets, you can use `wire:target` as you would in regular usage:

```blade
<x-ui.table 
{+    wire:loading
    wire:target="customAction, archiveSomething"+}
>
    <!-- table content... -->
</x-ui.table>
```

---

## Stickiness

Make columns or headers stick to the viewport while scrolling.

### Sticky Header

Keep the header visible while scrolling through long tables:

@blade
<x-demo class="w-full">
    <x-ui.table class="max-h-64">
        <x-ui.table.header sticky class="dark:bg-neutral-900 bg-white">
            <x-ui.table.columns>
                <x-ui.table.head>Product</x-ui.table.head>
                <x-ui.table.head>Price</x-ui.table.head>
                <x-ui.table.head>Stock</x-ui.table.head>
            </x-ui.table.columns>
        </x-ui.table.header>
        <x-ui.table.rows>
            @for ($i = 1; $i <= 20; $i++)
                <x-ui.table.row>
                    <x-ui.table.cell>Product {{ $i }}</x-ui.table.cell>
                    <x-ui.table.cell>${{ rand(10, 100) }}</x-ui.table.cell>
                    <x-ui.table.cell>{{ rand(0, 50) }}</x-ui.table.cell>
                </x-ui.table.row>
            @endfor
        </x-ui.table.rows>
    </x-ui.table>
</x-demo>
@endblade

```blade
<x-ui.table class="max-h-96">
    <x-ui.table.header sticky class="dark:bg-neutral-900 bg-white">
        <x-ui.table.columns>
            <x-ui.table.head>Product</x-ui.table.head>
            <x-ui.table.head>Price</x-ui.table.head>
        </x-ui.table.columns>
    </x-ui.table.header>
    
    <!-- ... -->
</x-ui.table>
```

### Sticky Column

Make the first column stick when scrolling horizontally:

@blade
<x-demo>
    <x-ui.table>
        <x-ui.table.header class="dark:bg-neutral-900 bg-white">
            <x-ui.table.columns>
                <x-ui.table.head 
                    sticky 
                    class="dark:bg-neutral-900 bg-white"
                >
                    Name
                </x-ui.table.head>
                <x-ui.table.head>Email</x-ui.table.head>
                <x-ui.table.head>Department</x-ui.table.head>
                <x-ui.table.head>Location</x-ui.table.head>
                <x-ui.table.head>Start Date</x-ui.table.head>
                <x-ui.table.head>End Date</x-ui.table.head>
            </x-ui.table.columns>
        </x-ui.table.header>
        <x-ui.table.rows>
            <x-ui.table.row>
                <x-ui.table.cell 
                    sticky 
                    class="dark:bg-neutral-950 bg-neutral-50"
                >
                    Alice Johnson
                </x-ui.table.cell>
                <x-ui.table.cell>alice@company.com</x-ui.table.cell>
                <x-ui.table.cell>Engineering</x-ui.table.cell>
                <x-ui.table.cell>San Francisco, CA</x-ui.table.cell>
                <x-ui.table.cell>2023-01-15</x-ui.table.cell>
                <x-ui.table.cell>2029-01-15</x-ui.table.cell>
            </x-ui.table.row>
            <x-ui.table.row>
                <x-ui.table.cell 
                    sticky 
                    class="dark:bg-neutral-950 bg-neutral-50"
                >
                    Bob Smith
                </x-ui.table.cell>
                <x-ui.table.cell>bob@company.com</x-ui.table.cell>
                <x-ui.table.cell>Marketing</x-ui.table.cell>
                <x-ui.table.cell>New York, NY</x-ui.table.cell>
                <x-ui.table.cell>2022-08-20</x-ui.table.cell>
                <x-ui.table.cell>2028-08-20</x-ui.table.cell>
            </x-ui.table.row>
        </x-ui.table.rows>
    </x-ui.table>
</x-demo>
@endblade

```blade
<x-ui.table.header sticky class="dark:bg-neutral-900 bg-white">
    <x-ui.table.columns>
        <x-ui.table.head 
            sticky 
            class="dark:bg-neutral-900 bg-white"
        >
            Name
        </x-ui.table.head>
        <!-- Other headers... -->
    </x-ui.table.columns>
</x-ui.table.header>

<x-ui.table.rows>
    <x-ui.table.row>
        <x-ui.table.cell 
            sticky 
            class="dark:bg-neutral-950 bg-neutral-50"
        >
            Alice Johnson
        </x-ui.table.cell>
        <!-- Other cells... -->
    </x-ui.table.row>
</x-ui.table.rows>
```

> **Note:** When using sticky headers or columns, always apply a background color to prevent content overlap during scrolling.


when you've enable `reorderable` feature with sticky columns, adding background color to rows will kill the animated opacity for the sticky cell, so it's better to add the background only if there is not a sorting happenings and you can do that easily by using `[body:not(.sorting)_&]:` as a variant there.

```blade
<x-ui.table.row 
    :checkboxId="$theorem->id" 
    :key="$theorem->id"
>
    <x-ui.table.cell 
        sticky 
{+        class="[body:not(.sorting)_&]:dark:bg-neutral-950 [body:not(.sorting)_&]:bg-neutral-50"+}
    >
        {{ $theorem->id }}
    </x-ui.table.cell>
    <!-- .... -->
</x-ui.table.row>
```
---

## Implementation Guide

### Overview

This guide walks you through building a polished, feature-rich data table using the table component alongside other utilities. We'll display a list of mathematical theorems, including their discovery year and the mathematicians behind them.

### Setup Theorems Data

First, create a `Theorem` model with fields: `id`, `name`, `mathematician`, `field`, `year_discovered`, `difficulty_level`, `is_proven`, `statement`, and `applications`. 

For this demo, we use the Sushi package with an in-memory array model. Our `App\Models\Theorem` looks like this:

```php
<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Theorem extends Model
{
    use Sushi;

    protected $casts = [
        'year_discovered' => 'integer',
        'difficulty_level' => 'integer',
        'is_proven' => 'boolean',
    ];

    protected function getRows(): array
    {
        return [
            ['id' => 1, 'name' => 'Pythagorean Theorem', 'mathematician' => 'Pythagoras', 'field' => 'Geometry', 'year_discovered' => -500, 'difficulty_level' => 2, 'is_proven' => true, 'statement' => 'In a right triangle, a² + b² = c²', 'applications' => 'Architecture, Navigation'],
            ['id' => 2, 'name' => 'Fundamental Theorem of Calculus', 'mathematician' => 'Isaac Newton & Gottfried Leibniz', 'field' => 'Analysis', 'year_discovered' => 1666, 'difficulty_level' => 7, 'is_proven' => true, 'statement' => 'Links differentiation and integration', 'applications' => 'Physics, Engineering'],
            // ... (rest of theorems)
        ];
    }
}
```

> **Note:** This demo uses array-based models for simplicity. Your real application will use standard Laravel Eloquent models, but the integration remains the same regardless of data source.

### Table with Pagination

Add the `App\Livewire\Concerns\WithPagination` trait to your Livewire component to enable pagination:

```php
use App\Models\Theorem;
use App\Livewire\Concerns\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class Theorems extends Component
{
{+    use WithPagination;+}

    public function render()
    {
{+        $theorems = $this->baseQuery()->paginate($this->perPage);+}

        return view('livewire.theorems', [
            'theorems' => $theorems,
        ]);
    }

{+    protected function baseQuery(): Builder
    {
        return Theorem::query();
    }+}
}
```

**Key points:**
- We use a custom `WithPagination` trait that extends Livewire's native pagination with a `$perPage` property and reactive updates
- The `baseQuery()` method encapsulates the core query builder, making it reusable for sorting, filtering, and other operations in later steps

The view integrates pagination and displays theorem details with badges and icons:

```blade
<x-ui.table 
{+    :paginator="$theorems"+}
{+    pagination:variant="full"+}
>
    <x-ui.table.header>
        <x-ui.table.columns>
            <x-ui.table.head>ID</x-ui.table.head>
            <x-ui.table.head>Theorem</x-ui.table.head>
            <x-ui.table.head>Mathematician</x-ui.table.head>
            <x-ui.table.head>Field</x-ui.table.head>
            <x-ui.table.head>Year</x-ui.table.head>
            <x-ui.table.head>Difficulty</x-ui.table.head>
            <x-ui.table.head>Status</x-ui.table.head>
        </x-ui.table.columns>
    </x-ui.table.header>

    <x-ui.table.rows>
        @forelse($theorems as $theorem)
            <x-ui.table.row :key="$theorem->id">
                <x-ui.table.cell sticky class="dark:bg-neutral-950 bg-neutral-50">
                    {{ $theorem->id }}
                </x-ui.table.cell>
                
                <x-ui.table.cell>
                    <div class="max-w-xs">
                        <div class="font-medium text-neutral-900 dark:text-neutral-100">
                            {{ $theorem->name }}
                        </div>
                        <div class="text-xs text-neutral-500 dark:text-neutral-400 mt-1 line-clamp-2">
                            {{ $theorem->statement }}
                        </div>
                    </div>
                </x-ui.table.cell>
                
                <x-ui.table.cell>
                    <div class="text-sm text-neutral-700 dark:text-neutral-300">
                        {{ $theorem->mathematician }}
                    </div>
                </x-ui.table.cell>
                
                <x-ui.table.cell>
                    @php
                        $fieldColors = [
                            'Number Theory' => 'purple',
                            'Analysis' => 'blue',
                            'Geometry' => 'green',
                            // ... more field colors
                        ];
                        $color = $fieldColors[$theorem->field] ?? 'neutral';
                    @endphp
                    <x-ui.badge :color="$color" size="sm" variant="outline">
                        {{ $theorem->field }}
                    </x-ui.badge>
                </x-ui.table.cell>
                
                <x-ui.table.cell>
                    <div class="text-sm font-mono text-neutral-600 dark:text-neutral-400">
                        {{ $theorem->year_discovered < 0 ? abs($theorem->year_discovered) . ' BC' : $theorem->year_discovered }}
                    </div>
                </x-ui.table.cell>
                
                <x-ui.table.cell>
                    <div class="flex items-center gap-1">
                        @for($i = 1; $i <= min($theorem->difficulty_level, 10); $i++)
                            <svg class="size-3 {{ $i <= 3 ? 'text-green-500' : ($i <= 6 ? 'text-yellow-500' : 'text-red-500') }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <div class="text-xs text-neutral-500 dark:text-neutral-400 mt-1">
                        Level {{ $theorem->difficulty_level }}
                    </div>
                </x-ui.table.cell>
                
                <x-ui.table.cell>
                    @if($theorem->is_proven)
                        <x-ui.badge icon="check-circle" color="green" size="sm" variant="outline">
                            Proven
                        </x-ui.badge>
                    @else
                        <x-ui.badge icon="exclamation-triangle" color="orange" size="sm" variant="outline">
                            Conjecture
                        </x-ui.badge>
                    @endif
                </x-ui.table.cell>
            </x-ui.table.row>
        @empty
            <!-- to implement in upcoming section -->
        @endforelse
    </x-ui.table.rows>
</x-ui.table>
```

### Add Sorting

Enable column sorting with visual indicators and flexible behavior.

#### Step 1: Add the Trait

Include the `App\Livewire\Concerns\WithSorting` trait in your Livewire component:

```php
use App\Models\Theorem;
use App\Livewire\Concerns\WithSorting;
use App\Livewire\Concerns\WithPagination;

class Theorems extends Component
{
{+    use WithSorting;+}
    use WithPagination;

    public function render()
    {
        $theorems = $this->baseQuery()
{+            ->when(filled($this->sortBy), function ($query) {
                return $this->applySorting($query);
            })+}
            ->paginate($this->perPage);

        return view('livewire.theorems', [
            'theorems' => $theorems,
        ]);
    }

    protected function baseQuery(): Builder
    {
        return Theorem::query();
    }
}
```

#### Step 2: Update the View

Let's make `mathematician`, `year`, and `difficulty` sortable, while making sort by year special by using the `dropdown` sorting variant:

```blade
<x-ui.table 
    :paginator="$theorems"
    pagination:variant="full"
{+    loadOn="pagination, sorting"+}
>
    <x-ui.table.header>
        <x-ui.table.columns>
            <!-- other headers -->
            <x-ui.table.head
{+                column="mathematician"
                sortable
                :currentSortBy="$sortBy"
                :currentSortDir="$sortDir"+}
            >
                Mathematician
            </x-ui.table.head>
            
            <x-ui.table.head>
                Field
            </x-ui.table.head>
            
            <x-ui.table.head
{+                column="year_discovered"
                sortable
                variant="dropdown"
                :currentSortBy="$sortBy"
                :currentSortDir="$sortDir"+}
            >
                Year
            </x-ui.table.head>
            
            <x-ui.table.head
{+                column="difficulty_level"
                sortable
                :currentSortBy="$sortBy"
                :currentSortDir="$sortDir"+}
            >
                Difficulty
            </x-ui.table.head>
            
            <x-ui.table.head>
                Status
            </x-ui.table.head>
        </x-ui.table.columns>
    </x-ui.table.header>
    
    <!-- table rows... -->
</x-ui.table>
```

### Add Search

Enable real-time search across your table data.

#### Step 1: Add the Trait

Include the `WithSearch` trait:

```php
<?php

namespace App\Livewire;

use App\Models\Theorem;
use Livewire\Component;
use App\Livewire\Concerns\WithPagination;
use App\Livewire\Concerns\WithSorting;
use App\Livewire\Concerns\WithSearch;

class Theorems extends Component
{
    use WithPagination;
    use WithSorting;
{+    use WithSearch;+}

    public function render()
    {
        $theorems = $this->baseQuery()
            ->when(filled($this->sortBy), function ($query) {
                return $this->applySorting($query);
            })
{+            ->when(filled($this->searchQuery), function ($query) {
                return $this->applySearch($query);
            })+}
            ->paginate($this->perPage);

        return view('livewire.theorems', [
            'theorems' => $theorems,
        ]);
    }

{+    protected function applySearch($query)
    {
        return $query->where('name', 'like', '%'.$this->searchQuery.'%')
            ->orWhere('mathematician', 'like', '%'.$this->searchQuery.'%')
            ->orWhere('field', 'like', '%'.$this->searchQuery.'%')
            ->orWhere('statement', 'like', '%'.$this->searchQuery.'%');
    }+}

    protected function baseQuery(): Builder
    {
        return Theorem::query();
    }
}
```

#### Step 2: Add the Search Input

First, let's wrap our table and all filter logic into the `table.container` Blade component, which is responsible for managing padding between pagination, table, and filters in a clean way:

```blade
{+<x-ui.table.container>+}
{+    <div class="flex items-center">
        {{-- SEARCH INPUT --}}
        <div class="ml-auto">
            <x-ui.input 
                class="[&_input]:bg-transparent" <!-- target underlying input and make it transparent -->
                placeholder="Search..." 
                leftIcon="magnifying-glass" 
                wire:model.live="searchQuery"
            />
        </div>
    </div>+}

    <x-ui.table 
        :paginator="$theorems"
        pagination:variant="full"
{+        loadOn="pagination, search, sorting"+}
    >
        <!-- table contents... -->
    </x-ui.table>
{+</x-ui.table.container>+}
```

### Handle Empty States

Provide helpful feedback when no results are found using our [empty state component](/docs/components/empty):

@blade
<x-demo>
    <x-ui.table>
        <x-ui.table.header>
        </x-ui.table.header>
        <x-ui.table.rows>
            <x-ui.table.empty>
                <x-ui.empty>
                    <x-ui.empty.media>
                        <x-ui.icon name="inbox" class="size-10" />
                    </x-ui.empty.media>

                    <x-ui.empty.contents>
                        <h3 class="text-lg font-semibold">No theorems found</h3>
                        <p class="text-sm text-neutral-500">
                            Try adjusting your search or filters.
                        </p>
                    </x-ui.empty.contents>
                </x-ui.empty>
            </x-ui.table.empty>
        </x-ui.table.rows>
    </x-ui.table>
</x-demo>
@endblade



```blade
<x-ui.table.rows>
    @forelse ($theorems as $user)
       <!-- hidden contents -->
    @empty
{+      <x-ui.table.empty>
            <x-ui.empty>
                <x-ui.empty.media>
                    <x-ui.icon name="inbox" class="size-10" />
                </x-ui.empty.media>
                <x-ui.empty.contents>
                    <h3 class="text-lg font-semibold">No theorems found</h3>
                    <p class="text-sm text-neutral-500">
                        Try adjusting your search or create a new user.
                    </p>
                </x-ui.empty.contents>
            </x-ui.empty>
        </x-ui.table.empty>+}
    @endforelse
</x-ui.table.rows>
```

### Add Checkbox Selection

Enable row selection with checkboxes and a "select all" header.

#### Step 1: Add the Trait

Include the `WithSelection` trait:

```php
<?php

namespace App\Livewire;

use App\Models\Theorem;
use Livewire\Component;
use App\Livewire\Concerns\WithPagination;
use App\Livewire\Concerns\WithSorting;
use App\Livewire\Concerns\WithSearch;
use App\Livewire\Concerns\WithSelection;

class Theorems extends Component
{
{~    use WithPagination;
    use WithSorting;
    use WithSearch;~}
{+    use WithSelection;+}

    public function render()
    {
        $theorems = $this->baseQuery()->...();

        // Store visible IDs for "select all" functionality
{+        $this->visibleIds = $theorems->pluck('id')
            ->map(fn ($id) => (string) $id)
            ->toArray();+}

        return view('livewire.theorems', [
            'theorems' => $theorems,
        ]);
    }
}
```

#### Step 2: Add Checkboxes to the View

Enable the "check all" header and add checkboxes to rows:

```blade
<x-ui.table.columns 
{+    withCheckAll+}
>
    <!-- header cells... -->
</x-ui.table.columns>

<!-- AND -->

<x-ui.table.rows>
    @foreach ($theorems as $theorem)
        <x-ui.table.row 
            :key="$theorem->id"
{+            :checkboxId="$theorem->id"+}
        >
            <!-- cells... -->
        </x-ui.table.row>
    @endforeach
</x-ui.table.rows>
```

### Bulk Actions (Delete and CSV Export Example)

Let's add bulk action buttons that only show when there are selected rows. We'll implement delete and CSV export for the selected rows.

#### Step 1: Add the CSV Export Trait

Include the `CanExportCsv` trait:

```php
<?php

namespace App\Livewire;

use App\Livewire\Concerns\CanExportCsv;
use Livewire\Attributes\Renderless;

class Theorems extends Component
{
{~    use WithPagination;
    use WithSorting;
    use WithSearch;
    use WithSelection;~}
{+    use CanExportCsv;+}

{+    #[Renderless]
    public function exportSelected()
    {
        $theorems = $this->baseQuery();
        
        if (filled($this->selectedIds)) {
            $theorems = $theorems->whereIn('id', $this->selectedIds);
        }
        
        // Apply filters like search and sorting if you want
        // then convert them into CSV...
        return $this->csv($theorems->get());
    }+}

{+    public function deleteSelected()
    {
        // ⚠️ Don't forget validation & authorization

        // Gate::authorize('delete-theorem', Theorem::class);
        
        $this->baseQuery()
            ->whereIn('id', $this->selectedIds)
            ->delete();

        // You may clear selection after deletes
        $this->deselectAll();
    }+}

    // other methods...
}
```

#### Step 2: Add Bulk Actions UI

Add bulk action controls that appear when rows are selected:

```blade
<x-ui.table.container>
    <div class="flex items-center">
{+        {{-- BULK ACTIONS --}}
        <div
            style="display:none;" 
            wire:show="selectedIds.length"
        >
            <x-ui.dropdown position="bottom-start">
                <x-slot:button class="justify-center">
                    <!-- desktop button -->
                    <x-ui.button 
                        icon="ellipsis-vertical" 
                        variant="soft"
                        size="sm"
                        class="
                            rounded-box mr-2 [@media(width<40rem)]:hidden outline 
                            dark:outline-white/20 outline-neutral-900/10 
                            dark:ring-white/15 ring-neutral-900/15 
                            [[data-open]>&]:bg-white/5 [[data-open]>&]:ring-2 shadow-sm
                        " 
                    >
                        Bulk Actions
                    </x-ui.button>
                    
                    <!-- mobile button (icon only) -->
                    <x-ui.button 
                        icon="ellipsis-vertical" 
                        variant="soft"
                        size="sm"
                        class="
                            rounded-box mr-2 sm:hidden outline dark:outline-white/20
                            outline-neutral-900/10 dark:ring-white/15 ring-neutral-900/15 
                            [[data-open]>&]:bg-white/5 [[data-open]>&]:ring-2 shadow-sm
                        " 
                    />
                </x-slot:button>
                
                <x-slot:menu>
                    <x-ui.dropdown.item 
                        icon="arrow-down-on-square"
                        wire:click="exportSelected"
                    >
                        Export Selected CSV
                    </x-ui.dropdown.item>
                    
                    <x-ui.dropdown.item 
                        icon="trash"
                        variant="danger"
                        wire:click="deleteSelected"
                        wire:confirm="Are you sure you want to delete?"
                    >
                        Delete Selected
                    </x-ui.dropdown.item>
                </x-slot:menu>
            </x-ui.dropdown>
        </div>+}

        {{-- SEARCH INPUT --}}
        <div class="ml-auto">
            <x-ui.input 
                class="[&_input]:bg-transparent"
                placeholder="Search..." 
                leftIcon="magnifying-glass" 
                wire:model.live="searchQuery"
            />
        </div>
    </div>
    
    <x-ui.table ...>
        <!-- table content... -->
    </x-ui.table>
</x-ui.table.container>
```

### Add Column Visibility

Let's make status and difficulty hideable columns in our theorems table. Here's how:

@blade
<x-demo>
    <div x-data="{ hiddenCols: [] }">
        <div class="mb-4 flex justify-end">
            <x-ui.dropdown
                checkbox
                checkboxVariant
                position="bottom-end"
            >
                <x-slot:button>
                    <x-ui.button 
                        icon="view-columns" 
                        variant="soft"
                        size="sm"
                        class="rounded-box ml-2 outline dark:outline-white/20 outline-neutral-900/10 dark:ring-white/15 ring-neutral-900/15 [[data-open]>&]:bg-white/5 [[data-open]>&]:ring-2 shadow-sm" 
                    />
                </x-slot:button>
                
                <x-slot:menu>                        
                    <x-ui.dropdown.item readOnly>
                        Hidden Columns
                    </x-ui.dropdown.item> 
                    <x-ui.dropdown.separator/> 
                    <x-ui.dropdown.item value="difficulty" x-model="hiddenCols">
                        Difficulty
                    </x-ui.dropdown.item> 
                    <x-ui.dropdown.item value="status" x-model="hiddenCols">
                        Status
                    </x-ui.dropdown.item> 
                </x-slot:menu>
            </x-ui.dropdown>
        </div>
        
        <x-ui.table>
            <x-ui.table.header>
                <x-ui.table.columns>
                    <x-ui.table.head>#ID</x-ui.table.head>
                    <x-ui.table.head>Theorem</x-ui.table.head>
                    <x-ui.table.head>Mathematician</x-ui.table.head>
                    <x-ui.table.head>Field</x-ui.table.head>
                    <x-ui.table.head>Year</x-ui.table.head>
                    <x-ui.table.head x-show="!hiddenCols.includes('difficulty')" x-cloak>
                        Difficulty
                    </x-ui.table.head>
                    <x-ui.table.head x-show="!hiddenCols.includes('status')" x-cloak>
                        Status
                    </x-ui.table.head>
                </x-ui.table.columns>
            </x-ui.table.header>
            
            <x-ui.table.rows>
                <x-ui.table.row>
                    <x-ui.table.cell>1</x-ui.table.cell>
                    <x-ui.table.cell>Fundamental Theorem of Calculus</x-ui.table.cell>
                    <x-ui.table.cell>Isaac Newton & Gottfried Leibniz</x-ui.table.cell>
                    <x-ui.table.cell>
                        <x-ui.badge color="blue" variant="outline">
                            Analysis
                        </x-ui.badge>
                    </x-ui.table.cell>
                    <x-ui.table.cell>1666</x-ui.table.cell>
                    <x-ui.table.cell x-show="!hiddenCols.includes('difficulty')" x-cloak>
                        7
                    </x-ui.table.cell>
                    <x-ui.table.cell x-show="!hiddenCols.includes('status')" x-cloak>
                        <x-ui.badge color="green" variant="outline">
                            Proven
                        </x-ui.badge>
                    </x-ui.table.cell>
                </x-ui.table.row>
                
                <x-ui.table.row>
                    <x-ui.table.cell>2</x-ui.table.cell>
                    <x-ui.table.cell>Fermat's Last Theorem</x-ui.table.cell>
                    <x-ui.table.cell>Andrew Wiles</x-ui.table.cell>
                    <x-ui.table.cell>
                        <x-ui.badge color="pink" variant="outline">
                            Number Theory
                        </x-ui.badge>
                    </x-ui.table.cell>
                    <x-ui.table.cell>1995</x-ui.table.cell>
                    <x-ui.table.cell x-show="!hiddenCols.includes('difficulty')" x-cloak>
                        10
                    </x-ui.table.cell>
                    <x-ui.table.cell x-show="!hiddenCols.includes('status')" x-cloak>
                        <x-ui.badge color="green" variant="outline">
                            Proven
                        </x-ui.badge>
                    </x-ui.table.cell>
                </x-ui.table.row>
            </x-ui.table.rows>
        </x-ui.table>
    </div>
</x-demo>
@endblade

```blade
<x-ui.table.container x-data="{ hiddenCols: ['status', 'difficulty'] }">
    <div class="flex items-center">
        <!-- BULK ACTIONS CONTENT... -->
        <!-- SEARCH INPUT CONTENT... -->

{+        {{-- HIDDEN COLUMNS --}}
        <x-ui.dropdown
            checkbox
            checkboxVariant
            position="bottom-end"
        >
            <x-slot:button>
                <x-ui.button 
                    icon="view-columns" 
                    variant="soft"
                    size="sm"
                    class="rounded-box ml-2 outline dark:outline-white/20 outline-neutral-900/10 dark:ring-white/15 ring-neutral-900/15 [[data-open]>&]:bg-white/5 [[data-open]>&]:ring-2 shadow-sm" 
                />
            </x-slot:button>
            
            <x-slot:menu>                        
                <x-ui.dropdown.item readOnly>
                    Hidden Columns
                </x-ui.dropdown.item> 
                <x-ui.dropdown.separator/> 
                <x-ui.dropdown.item value="difficulty" x-model="hiddenCols">
                    Difficulty
                </x-ui.dropdown.item> 
                <x-ui.dropdown.item value="status" x-model="hiddenCols">
                    Status
                </x-ui.dropdown.item> 
            </x-slot:menu>
        </x-ui.dropdown>+}
    </div>
    
    <x-ui.table 
        :paginator="$theorems"
        pagination:variant="full"
        loadOn="pagination, search, sorting"
    >
        <x-ui.table.header sticky class="dark:bg-neutral-900 bg-white">
            <x-ui.table.columns withCheckAll>
                <x-ui.table.head sticky class="dark:bg-neutral-900 bg-white">
                    #ID
                </x-ui.table.head>
                <x-ui.table.head>Theorem</x-ui.table.head>
                <x-ui.table.head
                    column="mathematician"
                    sortable
                    :currentSortBy="$sortBy"
                    :currentSortDir="$sortDir"
                >
                    Mathematician
                </x-ui.table.head>
                <x-ui.table.head>Field</x-ui.table.head>
                <x-ui.table.head
                    column="year_discovered"
                    sortable
                    variant="dropdown"
                    :currentSortBy="$sortBy"
                    :currentSortDir="$sortDir"
                >
                    Year
                </x-ui.table.head>
                <x-ui.table.head
                    column="difficulty_level"
                    sortable
                    :currentSortBy="$sortBy"
                    :currentSortDir="$sortDir"
{+                    x-show="!hiddenCols.includes('difficulty')"+}
                >
                    Difficulty
                </x-ui.table.head>
                <x-ui.table.head  
{+                    x-show="!hiddenCols.includes('status')"+}
                >
                    Status
                </x-ui.table.head>
            </x-ui.table.columns>
        </x-ui.table.header>

        <x-ui.table.rows>
            @forelse($theorems as $theorem)
                <x-ui.table.row 
                    :checkboxId="$theorem->id" 
                    :key="$theorem->id"
                >
                    <!-- ID, Theorem, Mathematician, Field, Year cells... -->
                    
                    <x-ui.table.cell 
{+                        x-show="!hiddenCols.includes('difficulty')"+}
                    >
                        <!-- difficulty stars -->
                        <div class="text-xs text-neutral-500 dark:text-neutral-400 mt-1">
                            Level {{ $theorem->difficulty_level }}
                        </div>
                    </x-ui.table.cell>
                    
                    <x-ui.table.cell  
{+                        x-show="!hiddenCols.includes('status')"+}
                    >
                        @if($theorem->is_proven)
                            <x-ui.badge icon="check-circle" color="green" size="sm" variant="outline">
                                Proven
                            </x-ui.badge>
                        @else
                            <x-ui.badge icon="exclamation-triangle" color="orange" size="sm" variant="outline">
                                Conjecture
                            </x-ui.badge>
                        @endif
                    </x-ui.table.cell>
                </x-ui.table.row>
            @empty
                <!-- empty state... -->
            @endforelse
        </x-ui.table.rows>
    </x-ui.table>
</x-ui.table.container>
```

#### Persisting Column Preferences

Use Alpine's `$persist` plugin to save user preferences across sessions:

```blade
x-data="{ 
    hiddenCols: $persist(['status', 'difficulty']).as('table-hidden-columns')
}"
```

This stores the user's column visibility choices in `localStorage`.

---

## Design Cookbook

Customize the table's appearance with utility classes and variants.

### Bordered Table

@blade
<x-demo class="w-full">
    <x-ui.table class="border border-neutral-200 dark:border-neutral-800 rounded-lg">
        <x-ui.table.header>
            <x-ui.table.columns>
                <x-ui.table.head>Product</x-ui.table.head>
                <x-ui.table.head>Price</x-ui.table.head>
                <x-ui.table.head>Stock</x-ui.table.head>
            </x-ui.table.columns>
        </x-ui.table.header>

        <x-ui.table.rows>
            <x-ui.table.row>
                <x-ui.table.cell>Widget A</x-ui.table.cell>
                <x-ui.table.cell>$29.99</x-ui.table.cell>
                <x-ui.table.cell>45</x-ui.table.cell>
            </x-ui.table.row>
            <x-ui.table.row>
                <x-ui.table.cell>Widget B</x-ui.table.cell>
                <x-ui.table.cell>$39.99</x-ui.table.cell>
                <x-ui.table.cell>12</x-ui.table.cell>
            </x-ui.table.row>
        </x-ui.table.rows>
    </x-ui.table>
</x-demo>
@endblade

```blade
<x-ui.table class="border border-neutral-200 dark:border-neutral-800 rounded-lg">
    <!-- Table content... -->
</x-ui.table>
```
if you have dynamic data table, it recomended to add the border to the table container and let's the container manager the padding between pagination, filters, and the actual table data.

just add the border prop to the container, you may tweack it on the container source code, the code is yours

```blade
<x-ui.table.container border>
    <div 
        class="flex items-center"
    >
        <!-- dynamic filters... -->
    </div>

    <!-- Demo Table -->
    <x-ui.table >
    <!-- table contents -->
    </x-ui.table >
</x-ui.table.container>
```


### Striped Rows

@blade
<x-demo class="w-full">
    <x-ui.table>
        <x-ui.table.header>
            <x-ui.table.columns>
                <x-ui.table.head>Name</x-ui.table.head>
                <x-ui.table.head>Email</x-ui.table.head>
            </x-ui.table.columns>
        </x-ui.table.header>

        <x-ui.table.rows class="[&>tr:nth-child(odd)]:bg-neutral-50 dark:[&>tr:nth-child(odd)]:bg-neutral-900/50">
            <x-ui.table.row>
                <x-ui.table.cell>Alice Johnson</x-ui.table.cell>
                <x-ui.table.cell>alice@example.com</x-ui.table.cell>
            </x-ui.table.row>
            <x-ui.table.row>
                <x-ui.table.cell>Bob Smith</x-ui.table.cell>
                <x-ui.table.cell>bob@example.com</x-ui.table.cell>
            </x-ui.table.row>
            <x-ui.table.row>
                <x-ui.table.cell>Carol White</x-ui.table.cell>
                <x-ui.table.cell>carol@example.com</x-ui.table.cell>
            </x-ui.table.row>
        </x-ui.table.rows>
    </x-ui.table>
</x-demo>
@endblade

```blade
<x-ui.table.rows class="[&>tr:nth-child(odd)]:bg-neutral-50 dark:[&>tr:nth-child(odd)]:bg-neutral-900/50">
    <!-- Rows... -->
</x-ui.table.rows>
```

### Hover Effects

@blade
<x-demo class="w-full">
    <x-ui.table>
        <x-ui.table.header>
            <x-ui.table.columns>
                <x-ui.table.head>Name</x-ui.table.head>
                <x-ui.table.head>Status</x-ui.table.head>
            </x-ui.table.columns>
        </x-ui.table.header>

        <x-ui.table.rows>
            <x-ui.table.row class="hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors cursor-pointer">
                <x-ui.table.cell>Alice Johnson</x-ui.table.cell>
                <x-ui.table.cell>Active</x-ui.table.cell>
            </x-ui.table.row>
            <x-ui.table.row class="hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors cursor-pointer">
                <x-ui.table.cell>Bob Smith</x-ui.table.cell>
                <x-ui.table.cell>Active</x-ui.table.cell>
            </x-ui.table.row>
        </x-ui.table.rows>
    </x-ui.table>
</x-demo>
@endblade

```blade
<x-ui.table.row class="hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors cursor-pointer">
    <!-- Cells... -->
</x-ui.table.row>
```

### Compact Table

@blade
<x-demo class="w-full">
    <x-ui.table>
        <x-ui.table.header>
            <x-ui.table.columns>
                <x-ui.table.head class="py-2">Name</x-ui.table.head>
                <x-ui.table.head class="py-2">Email</x-ui.table.head>
            </x-ui.table.columns>
        </x-ui.table.header>

        <x-ui.table.rows>
            <x-ui.table.row>
                <x-ui.table.cell class="py-2">Alice Johnson</x-ui.table.cell>
                <x-ui.table.cell class="py-2">alice@example.com</x-ui.table.cell>
            </x-ui.table.row>
            <x-ui.table.row>
                <x-ui.table.cell class="py-2">Bob Smith</x-ui.table.cell>
                <x-ui.table.cell class="py-2">bob@example.com</x-ui.table.cell>
            </x-ui.table.row>
        </x-ui.table.rows>
    </x-ui.table>
</x-demo>
@endblade

```blade
<!-- Override cell padding for compact layout -->
<x-ui.table.cell class="py-2">
    {{ $theorem->name }}
</x-ui.table.cell>
```

### Custom Loading States

```blade
<x-ui.table 
    :paginator="$theorems"
    wire:loading
    loadOn="pagination, search, sorting"
>
    <x-slot name="loading">
        <div class="flex items-center gap-2">
            <x-ui.icon.loading class="size-5" />
            <span class="text-sm">Loading data...</span>
        </div>
    </x-slot>
    
    <!-- Table content... -->
</x-ui.table>
```

---

## Component Props

### table

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `paginator` | Paginator\|null | `null` | Laravel paginator instance |
| `pagination:variant` | string | `'full'` | Pagination style: `full`, `simple`, `compact` |
| `loadOn` | string | `null` | Comma-separated list of actions to show loading: `pagination`, `search`, `sorting` |
| `loading` | slot | `null` | Custom loading indicator |
| `footer` | slot | `null` | Content below the table |
| `wire:loading` | boolean | `false` | Enable Livewire loading states |
| `wire:target` | string | `null` | Specific Livewire actions to track |
| `class` | string | `''` | Additional CSS classes |

### table.container

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `border` | boolean | `true` | Show container border |
| `class` | string | `''` | Additional CSS classes |

### table.header

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `sticky` | boolean | `false` | Make header stick to top while scrolling |
| `class` | string | `''` | Additional CSS classes |

### table.columns

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `withCheckAll` | boolean | `false` | Add "select all" checkbox in header |

### table.head

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `column` | string\|null | `null` | Column name for sorting |
| `sortable` | boolean | `false` | Enable sorting for this column |
| `variant` | string | `'default'` | Sorting UI: `default`, `dropdown` |
| `currentSortBy` | string | `''` | Current sort column |
| `currentSortDir` | string | `''` | Current sort direction |
| `sticky` | boolean | `false` | Make column stick while scrolling horizontally |
| `class` | string | `''` | Additional CSS classes |

### table.row

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `key` | string\|null | `null` | Unique key for Livewire tracking |
| `checkboxId` | string\|int\|null | `null` | ID for checkbox selection |
| `class` | string | `''` | Additional CSS classes |

### table.cell

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `sticky` | boolean | `false` | Make cell stick while scrolling horizontally |
| `class` | string | `''` | Additional CSS classes |

### Common Patterns

**Reset All Filters**
```php
public function resetAll()
{
    $this->searchQuery = '';
    $this->sortBy = '';
    $this->sortDir = 'asc';
    $this->selectedIds = [];
    $this->resetPage();
}
```

**Export All vs Selected**
```php
public function export($exportType = 'selected')
{
    $query = $this->baseQuery();
    
    if ($exportType === 'selected' && filled($this->selectedIds)) {
        $query->whereIn('id', $this->selectedIds);
    }
    
    // Apply current filters/search
    if (filled($this->searchQuery)) {
        $query = $this->applySearch($query);
    }

    .....
    
    return $this->csv($query->get());
}
```

## Troubleshooting

### Checkboxes Not Syncing

Ensure you're setting `visibleIds` in your render method:

```php
public function render()
{
    $theorems = Theorem::query()->paginate($this->perPage);
    
    // This is crucial for checkbox sync
    $this->visibleIds = $theorems->pluck('id')
        ->map(fn ($id) => (string) $id)
        ->toArray();
        
    return view('livewire.theorems', ['theorems' => $theorems]);
}
```


## Related Components

- [Pagination](/docs/components/pagination) - Standalone pagination component
- [Dropdown](/docs/components/dropdown) - Used for bulk actions and filters
- [Input](/docs/components/input) - Used for search fields
- [Checkbox](/docs/components/checkbox) - Used for row selection
- [Empty State](/docs/components/empty) - Used when no results found