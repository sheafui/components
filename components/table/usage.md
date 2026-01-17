---
name: 'table'
---

# Table Component

## Introduction

The `table` component provides a powerful, composable system for building feature-rich data tables. Built with Livewire and Alpine.js, it offers pagination, sorting, searching, selection, bulk actions, column visibility controls, drag-and-drop reordering, and more—all with excellent accessibility and a clean, modern design.

Unlike monolithic table libraries, our approach uses **composable traits** on the backend and **slot-based components** on the frontend, giving you complete control over your table's structure and behavior while maintaining clean, reusable code.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `table` component:

```bash
php artisan sheaf:install table
```

## Basic Static Table

Let's start with a simple static table without any dynamic features.

@blade
<x-demo>
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

## Pagination

Add pagination to your table by passing a Laravel paginator and enabling the pagination feature.

### Creating the Livewire Component

First, create a Livewire component that uses the `WithPagination` trait:

```php
<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Src\Components\Livewire\Concerns\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public function render()
    {
        $users = User::query()
            ->paginate($this->perPage);

        return view('livewire.users-table', [
            'users' => $users,
        ]);
    }
}
```

### The View

```blade
<div>
    <x-ui.table :paginator="$users">
        <x-ui.table.header>
            <x-ui.table.columns>
                <x-ui.table.head>Name</x-ui.table.head>
                <x-ui.table.head>Email</x-ui.table.head>
                <x-ui.table.head>Role</x-ui.table.head>
            </x-ui.table.columns>
        </x-ui.table.header>

        <x-ui.table.rows>
            @foreach ($users as $user)
                <x-ui.table.row wire:key="user-{{ $user->id }}">
                    <x-ui.table.cell>{{ $user->name }}</x-ui.table.cell>
                    <x-ui.table.cell>{{ $user->email }}</x-ui.table.cell>
                    <x-ui.table.cell>{{ $user->role }}</x-ui.table.cell>
                </x-ui.table.row>
            @endforeach
        </x-ui.table.rows>
    </x-ui.table>
</div>
```

### Customizing Items Per Page

The `WithPagination` trait includes a `$perPage` property that defaults to 15. You can override it:

```php
use WithPagination;

public int $perPage = 25;
```

### Pagination Variants

Control the pagination appearance with the `pagination:variant` attribute:

```blade
<x-ui.table 
    :paginator="$users"
    pagination:variant="simple"
>
    <!-- ... -->
</x-ui.table>
```

Available variants:
- `full` - Shows page numbers, previous/next (default)
- `simple` - Shows only previous/next buttons
- `compact` - Minimal pagination controls

## Feature Guides

### Stickiness

Make columns or headers stick to the viewport while scrolling.

#### Sticky Header

Keep the header visible while scrolling through long tables:

@blade
<x-demo>
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

#### Sticky Column

Make the first column stick when scrolling horizontally:

@blade
<x-demo>
    <x-ui.table>
        <x-ui.table.header sticky class="dark:bg-neutral-900 bg-white">
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

> **Note:** When using sticky columns, always apply a background color to prevent content overlap during scrolling.

### Add Sorting

Enable column sorting with visual indicators and flexible behavior.

#### Step 1: Add the Trait

Include the `WithSorting` trait in your Livewire component:

```php
<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Src\Components\Livewire\Concerns\WithSorting;
use Src\Components\Livewire\Concerns\WithPagination;

class UsersTable extends Component
{
    use WithPagination;
    use WithSorting;

    public function render()
    {
        $users = User::query()
            ->when(filled($this->sortBy), function ($query) {
                return $this->applySorting($query);
            })
            ->paginate($this->perPage);

        return view('livewire.users-table', [
            'users' => $users,
        ]);
    }

    protected function sortableColumns(): array
    {
        return ['name', 'email', 'created_at'];
    }
}
```

#### Step 2: Update the View

Mark columns as sortable and pass the current sort state:

```blade
<x-ui.table.header sticky class="dark:bg-neutral-900 bg-white">
    <x-ui.table.columns>
        <x-ui.table.head 
            column="name"
            sortable
            :currentSortBy="$sortBy"
            :currentSortDir="$sortDir"
        >
            Name
        </x-ui.table.head>
        
        <x-ui.table.head 
            column="email"
            sortable
            :currentSortBy="$sortBy"
            :currentSortDir="$sortDir"
        >
            Email
        </x-ui.table.head>
        
        <x-ui.table.head 
            column="created_at"
            sortable
            :currentSortBy="$sortBy"
            :currentSortDir="$sortDir"
        >
            Created At
        </x-ui.table.head>
    </x-ui.table.columns>
</x-ui.table.header>
```

#### Sorting Variants

The table supports two sorting variants: `default` (click to toggle) and `dropdown` (menu-based).

**Default Variant:**

@blade
<x-demo>
    <x-ui.table>
        <x-ui.table.header sticky class="dark:bg-neutral-900 bg-white">
            <x-ui.table.columns>
                <x-ui.table.head 
                    column="product"
                    sortable
                    currentSortBy="product"
                    currentSortDir="asc"
                >
                    Product
                </x-ui.table.head>
                <x-ui.table.head 
                    column="price"
                    sortable
                    currentSortBy=""
                    currentSortDir="asc"
                >
                    Price
                </x-ui.table.head>
            </x-ui.table.columns>
        </x-ui.table.header>
        <x-ui.table.rows>
            <x-ui.table.row>
                <x-ui.table.cell>Widget A</x-ui.table.cell>
                <x-ui.table.cell>$29.99</x-ui.table.cell>
            </x-ui.table.row>
        </x-ui.table.rows>
    </x-ui.table>
</x-demo>
@endblade

```blade
<x-ui.table.head 
    column="name"
    sortable
    variant="default"
    :currentSortBy="$sortBy"
    :currentSortDir="$sortDir"
>
    Name
</x-ui.table.head>
```

**Dropdown Variant:**

@blade
<x-demo>
    <x-ui.table>
        <x-ui.table.header sticky class="dark:bg-neutral-900 bg-white">
            <x-ui.table.columns>
                <x-ui.table.head 
                    column="product"
                    sortable
                    variant="dropdown"
                    currentSortBy="product"
                    currentSortDir="desc"
                >
                    Product
                </x-ui.table.head>
                <x-ui.table.head 
                    column="price"
                    sortable
                    variant="dropdown"
                    currentSortBy=""
                    currentSortDir="asc"
                >
                    Price
                </x-ui.table.head>
            </x-ui.table.columns>
        </x-ui.table.header>
        <x-ui.table.rows>
            <x-ui.table.row>
                <x-ui.table.cell>Widget A</x-ui.table.cell>
                <x-ui.table.cell>$29.99</x-ui.table.cell>
            </x-ui.table.row>
        </x-ui.table.rows>
    </x-ui.table>
</x-demo>
@endblade

```blade
<x-ui.table.head 
    column="name"
    sortable
    variant="dropdown"
    :currentSortBy="$sortBy"
    :currentSortDir="$sortDir"
>
    Name
</x-ui.table.head>
```

The dropdown variant provides "Sort Ascending", "Sort Descending", and "Clear Sort" options.

#### How It Works

The `WithSorting` trait provides:

- `sortByColumn($column, $dir = null)` - Handles sort toggling
- `clearSorting()` - Resets sorting state
- `applySorting($query)` - Applies sort to the query
- `sortableColumns()` - Whitelist of sortable columns

Clicking a sortable header cycles through: **asc → desc → no sort**.

### Add Search

Enable real-time search across your table data.

#### Step 1: Add the Trait

Include the `WithSearch` trait:

```php
<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Src\Components\Livewire\Concerns\WithPagination;
use Src\Components\Livewire\Concerns\WithSearch;

class UsersTable extends Component
{
    use WithPagination;
    use WithSearch;

    public function render()
    {
        $users = User::query()
            ->when(filled($this->searchQuery), function ($query) {
                return $this->applySearch($query);
            })
            ->paginate($this->perPage);

        return view('livewire.users-table', [
            'users' => $users,
        ]);
    }

    protected function applySearch($query)
    {
        $search = str_replace(
            ['\\', '%', '_'], 
            ['\\\\', '\\%', '\\_'], 
            $this->searchQuery
        );
        
        return $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }
}
```

> **Security Note:** Always escape LIKE wildcards (`%`, `_`) and wrap OR conditions in a closure to prevent SQL logic bugs.

#### Step 2: Add the Search Input

Use the table's `top` slot to add a search field:

```blade
<x-ui.table :paginator="$users">
    <x-slot name="top" class="flex justify-between">
        <div class="ml-auto">
            <x-ui.input 
                class="w-64 [&_input]:bg-transparent" 
                placeholder="Search users..." 
                leftIcon="magnifying-glass" 
                wire:model.live.debounce.300ms="searchQuery"
            />
        </div>
    </x-slot>
    
    <!-- Table content... -->
</x-ui.table>
```

#### Optimizing Search Performance

**Use Debouncing:**

```blade
wire:model.live.debounce.300ms="searchQuery"
```

This reduces server requests by waiting 300ms after the user stops typing.

**Use Model Scopes:**

Instead of putting search logic in the component, create a reusable scope:

```php
// App/Models/User.php
public function scopeSearch($query, string $search)
{
    $search = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $search);
    
    return $query->where(function($q) use ($search) {
        $q->where('name', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%");
    });
}

// In your component
protected function applySearch($query)
{
    return $query->search($this->searchQuery);
}
```

**Use Full-Text Search for Large Datasets:**

```php
protected function applySearch($query)
{
    return $query->whereFullText(['name', 'email'], $this->searchQuery);
}
```

### Handle Empty States

Provide helpful feedback when no results are found.

@blade
<x-demo>
    <x-ui.table>
        <x-ui.table.header>
            <x-ui.table.columns>
                <x-ui.table.head>Name</x-ui.table.head>
                <x-ui.table.head>Email</x-ui.table.head>
            </x-ui.table.columns>
        </x-ui.table.header>

        <x-ui.table.rows>
            <x-ui.table.empty>
                <x-ui.empty>
                    <x-ui.empty.media>
                        <x-ui.icon name="inbox" class="size-10" />
                    </x-ui.empty.media>

                    <x-ui.empty.contents>
                        <h3 class="text-lg font-semibold">No users found</h3>
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
    @forelse ($users as $user)
        <x-ui.table.row wire:key="user-{{ $user->id }}">
            <x-ui.table.cell>{{ $user->name }}</x-ui.table.cell>
            <x-ui.table.cell>{{ $user->email }}</x-ui.table.cell>
        </x-ui.table.row>
    @empty
        <x-ui.table.empty>
            <x-ui.empty>
                <x-ui.empty.media>
                    <x-ui.icon name="inbox" class="size-10" />
                </x-ui.empty.media>

                <x-ui.empty.contents>
                    <h3 class="text-lg font-semibold">No users found</h3>
                    <p class="text-sm text-neutral-500">
                        Try adjusting your search or create a new user.
                    </p>
                </x-ui.empty.contents>
            </x-ui.empty>
        </x-ui.table.empty>
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

use App\Models\User;
use Livewire\Component;
use Src\Components\Livewire\Concerns\WithSelection;

class UsersTable extends Component
{
    use WithSelection;

    public function render()
    {
        $users = User::query()->paginate($this->perPage);

        // Store visible IDs for "select all" functionality
        $this->visibleIds = $users->pluck('id')
            ->map(fn ($id) => (string) $id)
            ->toArray();

        return view('livewire.users-table', [
            'users' => $users,
        ]);
    }
}
```

#### Step 2: Add Checkboxes to the View

Enable the "check all" header and add checkboxes to rows:

```blade
<x-ui.table.header sticky class="dark:bg-neutral-900 bg-white">
    <x-ui.table.columns withCheckAll>
        <x-ui.table.head>Name</x-ui.table.head>
        <x-ui.table.head>Email</x-ui.table.head>
    </x-ui.table.columns>
</x-ui.table.header>

<x-ui.table.rows>
    @foreach ($users as $user)
        <x-ui.table.row 
            wire:key="user-{{ $user->id }}"
            :checkboxId="$user->id"
        >
            <x-ui.table.cell>{{ $user->name }}</x-ui.table.cell>
            <x-ui.table.cell>{{ $user->email }}</x-ui.table.cell>
        </x-ui.table.row>
    @endforeach
</x-ui.table.rows>
```

#### How It Works

The checkbox system uses Alpine.js for smooth client-side interactions:

- Clicking the header checkbox toggles all visible rows
- Individual checkboxes update the selection state
- The header shows an indeterminate state when some (but not all) rows are selected
- Selected IDs are stored in the `$selectedIds` array (as strings)

**The header checkbox has three states:**
- **Checked** - All visible rows selected
- **Indeterminate** - Some rows selected
- **Unchecked** - No rows selected

### Bulk Actions (CSV Export Example)

Perform actions on multiple selected rows.

#### Step 1: Add the CSV Export Trait

Include the `CanExportCsv` trait:

```php
<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Renderless;
use Src\Components\Livewire\Concerns\WithSelection;
use Src\Components\Livewire\Concerns\CanExportCsv;

class UsersTable extends Component
{
    use WithSelection;
    use CanExportCsv;

    #[Renderless]
    public function exportSelected()
    {
        $users = User::query();

        if (filled($this->selectedIds)) {
            $users = $users->whereIn('id', $this->selectedIds);
        }

        return $this->csv($users->get());
    }
}
```

#### Step 2: Add Bulk Actions UI

Use the `top` slot to add bulk action controls:

```blade
<x-ui.table :paginator="$users">
    <x-slot name="top" class="flex justify-between gap-4">
        <!-- Bulk Actions Dropdown -->
        <div x-show="$wire.selectedIds.length > 0">
            <x-ui.dropdown position="bottom-start" :offset="1">
                <x-slot:button class="justify-center">
                    <x-ui.button 
                        icon="ellipsis-vertical" 
                        variant="soft"
                        class="rounded-box outline dark:outline-white/20 outline-neutral-900/20"
                    >
                        Bulk Actions
                    </x-ui.button>
                </x-slot:button>
                
                <x-slot:menu>
                    <x-ui.dropdown.item 
                        icon="arrow-down-on-square"
                        wire:click="exportSelected"
                    >
                        Export Selected to CSV
                    </x-ui.dropdown.item>
                    
                    <x-ui.dropdown.item 
                        icon="trash"
                        variant="danger"
                        wire:click="deleteSelected"
                        wire:confirm="Are you sure you want to delete the selected users?"
                    >
                        Delete Selected
                    </x-ui.dropdown.item>
                </x-slot:menu>
            </x-ui.dropdown>
        </div>

        <!-- Search Input -->
        <div class="ml-auto">
            <x-ui.input 
                class="w-64" 
                placeholder="Search..." 
                leftIcon="magnifying-glass" 
                wire:model.live.debounce.300ms="searchQuery"
            />
        </div>
    </x-slot>
    
    <!-- Table content... -->
</x-ui.table>
```

#### Implementing Delete Action

Add a delete method with proper validation:

```php
public function deleteSelected()
{
    // Validate that IDs are valid
    $this->validate([
        'selectedIds' => 'required|array|min:1',
        'selectedIds.*' => 'integer|exists:users,id',
    ]);

    // Optional: Add authorization
    // Gate::authorize('delete-multiple', User::class);

    $deleted = User::query()
        ->whereIn('id', $this->selectedIds)
        ->delete();

    // Clear selection
    $this->selectedIds = [];

    // Notify user
    $this->dispatch('notify', [
        'message' => "{$deleted} users deleted successfully",
        'type' => 'success'
    ]);
}
```

> **Security:** Always validate `selectedIds` to prevent client-side manipulation. Never trust data from the frontend!

#### Customizing CSV Export

Override methods in the `CanExportCsv` trait to customize the export:

```php
protected function getCsvFilename(): string
{
    return 'users_export_' . now()->format('Y-m-d_His') . '.csv';
}

protected function getExportableColumns(): array
{
    // Limit which columns are exported
    return ['id', 'name', 'email', 'created_at'];
}
```

### Add Column Visibility

Let users show/hide columns dynamically.

@blade
<x-demo>
    <div x-data="{ visibleCols: ['name', 'email', 'role'] }">
        <div class="mb-4 flex justify-end">
            <x-ui.dropdown checkbox position="bottom-end">
                <x-slot:button>
                    <x-ui.button 
                        icon="eye" 
                        variant="soft"
                        size="sm"
                    >
                        Columns
                    </x-ui.button>
                </x-slot:button>
                
                <x-slot:menu>
                    <x-ui.dropdown.item x-model="visibleCols" value="name">
                        Name
                    </x-ui.dropdown.item>
                    <x-ui.dropdown.item x-model="visibleCols" value="email">
                        Email
                    </x-ui.dropdown.item>
                    <x-ui.dropdown.item x-model="visibleCols" value="role">
                        Role
                    </x-ui.dropdown.item>
                    <x-ui.dropdown.item x-model="visibleCols" value="status">
                        Status
                    </x-ui.dropdown.item>
                </x-slot:menu>
            </x-ui.dropdown>
        </div>

        <x-ui.table>
            <x-ui.table.header>
                <x-ui.table.columns>
                    <x-ui.table.head x-show="visibleCols.includes('name')">
                        Name
                    </x-ui.table.head>
                    <x-ui.table.head x-show="visibleCols.includes('email')">
                        Email
                    </x-ui.table.head>
                    <x-ui.table.head x-show="visibleCols.includes('role')">
                        Role
                    </x-ui.table.head>
                    <x-ui.table.head x-show="visibleCols.includes('status')">
                        Status
                    </x-ui.table.head>
                </x-ui.table.columns>
            </x-ui.table.header>

            <x-ui.table.rows>
                <x-ui.table.row>
                    <x-ui.table.cell x-show="visibleCols.includes('name')">
                        Alice Johnson
                    </x-ui.table.cell>
                    <x-ui.table.cell x-show="visibleCols.includes('email')">
                        alice@example.com
                    </x-ui.table.cell>
                    <x-ui.table.cell x-show="visibleCols.includes('role')">
                        Admin
                    </x-ui.table.cell>
                    <x-ui.table.cell x-show="visibleCols.includes('status')">
                        Active
                    </x-ui.table.cell>
                </x-ui.table.row>
            </x-ui.table.rows>
        </x-ui.table>
    </div>
</x-demo>
@endblade

```blade
<div x-data="{ 
    visibleCols: $persist(['name', 'email', 'role']).as('users-table-visible-columns')
}">
    <!-- Column Visibility Dropdown -->
    <x-ui.table :paginator="$users">
        <x-slot name="top" class="flex justify-between">
            <div class="ml-auto">
                <x-ui.dropdown checkbox position="bottom-end">
                    <x-slot:button>
                        <x-ui.button 
                            icon="eye" 
                            variant="soft"
                            size="sm"
                        >
                            Columns
                        </x-ui.button>
                    </x-slot:button>
                    
                    <x-slot:menu>
                        <x-ui.dropdown.item x-model="visibleCols" value="name">
                            Name
                        </x-ui.dropdown.item>
                        <x-ui.dropdown.item x-model="visibleCols" value="email">
                            Email
                        </x-ui.dropdown.item>
                        <x-ui.dropdown.item x-model="visibleCols" value="created_at">
                            Created At
                        </x-ui.dropdown.item>
                    </x-slot:menu>
                </x-ui.dropdown>
            </div>
        </x-slot>

        <x-ui.table.header>
            <x-ui.table.columns>
                <x-ui.table.head x-show="visibleCols.includes('name')">
                    Name
                </x-ui.table.head>
                <x-ui.table.head x-show="visibleCols.includes('email')">
                    Email
                </x-ui.table.head>
                <x-ui.table.head x-show="visibleCols.includes('created_at')">
                    Created At
                </x-ui.table.head>
            </x-ui.table.columns>
        </x-ui.table.header>

        <x-ui.table.rows>
            @foreach ($users as $user)
                <x-ui.table.row wire:key="user-{{ $user->id }}">
                    <x-ui.table.cell x-show="visibleCols.includes('name')">
                        {{ $user->name }}
                    </x-ui.table.cell>
                    <x-ui.table.cell x-show="visibleCols.includes('email')">
                        {{ $user->email }}
                    </x-ui.table.cell>
                    <x-ui.table.cell x-show="visibleCols.includes('created_at')">
                        {{ $user->created_at->format('M d, Y') }}
                    </x-ui.table.cell>
                </x-ui.table.row>
            @endforeach
        </x-ui.table.rows>
    </x-ui.table>
</div>
```

#### Persisting Column Preferences

Use Alpine's `$persist` plugin to save user preferences across sessions:

```blade
x-data="{ 
    visibleCols: $persist(['name', 'email']).as('table-visible-columns')
}"
```

This stores the user's column visibility choices in `localStorage`.

### Add Re-Ordering

Enable drag-and-drop row reordering using Alpine's sort plugin.

#### Step 1: Enable Draggable Mode

Add the `draggable` attribute to your table:

```blade
<x-ui.table 
    :paginator="$users"
    draggable
>
    <!-- Table content... -->
</x-ui.table>
```

This automatically adds:
- A drag handle column at the start
- Sort functionality via Alpine's `x-sort` directive
- Visual feedback during dragging

#### Step 2: Handle Reorder Events

Listen for reorder events in your Livewire component:

```php
<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersTable extends Component
{
    protected $listeners = ['reorder' => 'handleReorder'];

    public function handleReorder($orderedIds)
    {
        foreach ($orderedIds as $index => $id) {
            User::where('id', $id)->update([
                'sort_order' => $index + 1
            ]);
        }

        $this->dispatch('notify', [
            'message' => 'Order updated successfully',
            'type' => 'success'
        ]);
    }

    public function render()
    {
        $users = User::query()
            ->orderBy('sort_order')
            ->paginate($this->perPage);

        return view('livewire.users-table', [
            'users' => $users,
        ]);
    }
}
```

#### Dispatch Reorder Event from Alpine

Add event dispatch to the sortable container:

```blade
<x-ui.table.rows
    x-on:sort="$wire.call('handleReorder', $event.detail.orderedIds)"
>
    <!-- Rows... -->
</x-ui.table.rows>
```

> **Note:** Row reordering works best with smaller datasets. For paginated tables, consider reordering within the current page only.

### Add Filters

Implement advanced filtering with multiple criteria.

#### Step 1: Create a Filter Trait

```php
<?php

namespace Src\Components\Livewire\Concerns;

trait WithFilters
{
    public array $filters = [];

    public function applyFilters($query)
    {
        foreach ($this->filters as $field => $value) {
            if (filled($value)) {
                $query->where($field, $value);
            }
        }

        return $query;
    }

    public function resetFilters()
    {
        $this->filters = [];
        $this->resetPage();
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }
}
```

#### Step 2: Use in Component

```php
<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Src\Components\Livewire\Concerns\WithFilters;
use Src\Components\Livewire\Concerns\WithPagination;

class UsersTable extends Component
{
    use WithPagination;
    use WithFilters;

    public function render()
    {
        $users = User::query()
            ->when(filled($this->filters), function ($query) {
                return $this->applyFilters($query);
            })
            ->paginate($this->perPage);

        return view('livewire.users-table', [
            'users' => $users,
        ]);
    }
}
```

#### Step 3: Add Filter UI

```blade
<x-ui.table :paginator="$users">
    <x-slot name="top" class="flex justify-between gap-4">
        <!-- Filter Dropdowns -->
        <div class="flex gap-2">
            <x-ui.select 
                wire:model.live="filters.role"
                placeholder="All Roles"
            >
                <option value="">All Roles</option>
                <option value="admin">Admin</option>
                <option value="editor">Editor</option>
                <option value="viewer">Viewer</option>
            </x-ui.select>

            <x-ui.select 
                wire:model.live="filters.status"
                placeholder="All Statuses"
            >
                <option value="">All Statuses</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </x-ui.select>

            <x-ui.button 
                wire:click="resetFilters"
                variant="ghost"
                icon="x-mark"
            >
                Clear Filters
            </x-ui.button>
        </div>

        <!-- Search -->
        <div class="ml-auto">
            <x-ui.input 
                wire:model.live.debounce.300ms="searchQuery"
                placeholder="Search..."
                leftIcon="magnifying-glass"
            />
        </div>
    </x-slot>
    
    <!-- Table content... -->
</x-ui.table>
```

#### Advanced Filter Example with Date Ranges

```php
public function applyFilters($query)
{
    if (filled($this->filters['role'])) {
        $query->where('role', $this->filters['role']);
    }

    if (filled($this->filters['date_from'])) {
        $query->where('created_at', '>=', $this->filters['date_from']);
    }

    if (filled($this->filters['date_to'])) {
        $query->where('created_at', '<=', $this->filters['date_to']);
    }

    return $query;
}
```

### Playing with Table Design

Customize the table's appearance with utility classes and variants.

#### Bordered Table

@blade
<x-demo>
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

#### Striped Rows

@blade
<x-demo>
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

#### Hover Effects

@blade
<x-demo>
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
<x-ui.table.row class="hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors">
    <!-- Cells... -->
</x-ui.table.row>
```

#### Compact Table

@blade
<x-demo>
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
    {{ $user->name }}
</x-ui.table.cell>
```

#### Custom Loading States

```blade
<x-ui.table 
    :paginator="$users"
    wire:loading
    wire:target="searchQuery,sortByColumn"
    loadOnPagination
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

## Complete Example

Here's a full-featured datatable combining all the features:

```php
<?php

namespace App\Livewire;

use App\Models\Component as ComponentModel;
use Illuminate\View\View;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Src\Components\Livewire\Concerns\CanExportCsv;
use Src\Components\Livewire\Concerns\WithPagination;
use Src\Components\Livewire\Concerns\WithSearch;
use Src\Components\Livewire\Concerns\WithSelection;
use Src\Components\Livewire\Concerns\WithSorting;

class ComponentsTable extends Component
{
    use CanExportCsv;
    use WithPagination;
    use WithSearch;
    use WithSelection;
    use WithSorting;

    #[Renderless]
    public function exportToCsv()
    {
        $components = $this->baseQuery();

        if (filled($this->searchQuery)) {
            $components = $this->applySearch($components);
        }

        if (filled($this->sortBy)) {
            $components = $this->applySorting($components);
        }

        if (filled($this->selectedIds)) {
            $components = $this->applySelection($components);
        }

        return $this->csv($components->get());
    }

    public function deleteSelected()
    {
        $this->validate([
            'selectedIds' => 'required|array|min:1',
            'selectedIds.*' => 'integer|exists:components,id',
        ]);

        $deleted = $this->baseQuery()
            ->whereIn('id', $this->selectedIds)
            ->delete();

        $this->selectedIds = [];

        $this->dispatch('notify', [
            'message' => "{$deleted} components deleted",
            'type' => 'success'
        ]);
    }

    public function render(): View
    {
        $components = $this->baseQuery()
            ->when(filled($this->sortBy), fn($q) => $this->applySorting($q))
            ->when(filled($this->searchQuery), fn($q) => $this->applySearch($q))
            ->paginate($this->perPage);

        $this->visibleIds = $components->pluck('id')
            ->map(fn ($id) => (string) $id)
            ->toArray();

        return view('livewire.components-table', [
            'components' => $components,
        ]);
    }

    protected function applySearch($query)
    {
        $search = str_replace(
            ['\\', '%', '_'], 
            ['\\\\', '\\%', '\\_'], 
            $this->searchQuery
        );
        
        return $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    protected function sortableColumns(): array
    {
        return ['name', 'type', 'created_at'];
    }

    protected function baseQuery()
    {
        return ComponentModel::query();
    }
}
```

```blade
<div 
    x-data="{ 
        visibleCols: $persist(['name', 'type', 'created_at', 'description']).as('components-table-cols')
    }"
>
    <x-ui.table 
        :paginator="$components" 
        pagination:variant="full"
        wire:loading
        wire:target="sortByColumn,searchQuery"
        loadOnPagination
        class="border border-neutral-900/5 dark:border-white/5 rounded-lg"
    >
        <x-slot name="top" class="flex justify-between gap-4">
            <!-- Bulk Actions -->
            <div x-show="$wire.selectedIds.length > 0">
                <x-ui.dropdown position="bottom-start">
                    <x-slot:button>
                        <x-ui.button icon="ellipsis-vertical" variant="soft">
                            Bulk Actions
                        </x-ui.button>
                    </x-slot:button>
                    
                    <x-slot:menu>
                        <x-ui.dropdown.item 
                            icon="arrow-down-on-square"
                            wire:click="exportToCsv"
                        >
                            Export Selected CSV
                        </x-ui.dropdown.item>
                        
                        <x-ui.dropdown.item 
                            icon="trash"
                            variant="danger"
                            wire:click="deleteSelected"
                            wire:confirm="Are you sure?"
                        >
                            Delete Selected
                        </x-ui.dropdown.item>
                    </x-slot:menu>
                </x-ui.dropdown>
            </div>

            <!-- Search -->
            <div class="ml-auto">
                <x-ui.input 
                    class="w-64" 
                    placeholder="Search..." 
                    leftIcon="magnifying-glass" 
                    wire:model.live.debounce.300ms="searchQuery"
                />
            </div>

            <!-- Column Visibility -->
            <x-ui.dropdown checkbox position="bottom-end">
                <x-slot:button>
                    <x-ui.button icon="eye" variant="soft" size="sm">
                        Columns
                    </x-ui.button>
                </x-slot:button>
                
                <x-slot:menu>
                    <x-ui.dropdown.item x-model="visibleCols" value="name">
                        Name
                    </x-ui.dropdown.item>
                    <x-ui.dropdown.item x-model="visibleCols" value="type">
                        Type
                    </x-ui.dropdown.item>
                    <x-ui.dropdown.item x-model="visibleCols" value="created_at">
                        Created At
                    </x-ui.dropdown.item>
                    <x-ui.dropdown.item x-model="visibleCols" value="description">
                        Description
                    </x-ui.dropdown.item>
                </x-slot:menu>
            </x-ui.dropdown>
        </x-slot>

        <x-ui.table.header sticky class="dark:bg-neutral-900 bg-white">
            <x-ui.table.columns withCheckAll>
                <x-ui.table.head 
                    column="name"
                    sortable
                    :currentSortBy="$sortBy"
                    :currentSortDir="$sortDir"
                    sticky 
                    class="dark:bg-neutral-900 bg-white"
                    x-show="visibleCols.includes('name')"
                >
                    Name
                </x-ui.table.head>
                
                <x-ui.table.head x-show="visibleCols.includes('type')">
                    Type
                </x-ui.table.head>
                
                <x-ui.table.head 
                    column="created_at"
                    sortable
                    :currentSortBy="$sortBy"
                    :currentSortDir="$sortDir"
                    x-show="visibleCols.includes('created_at')"
                >
                    Created At
                </x-ui.table.head>
                
                <x-ui.table.head x-show="visibleCols.includes('description')">
                    Description
                </x-ui.table.head>

                <x-ui.table.head />
            </x-ui.table.columns>
        </x-ui.table.header>

        <x-ui.table.rows>
            @forelse ($components as $component)
                <x-ui.table.row 
                    wire:key="component-{{ $component->id }}" 
                    :checkboxId="$component->id"
                >
                    <x-ui.table.cell 
                        sticky 
                        class="dark:bg-neutral-950 bg-neutral-50"
                        x-show="visibleCols.includes('name')"
                    >
                        {{ $component->name }}
                    </x-ui.table.cell>
                    
                    <x-ui.table.cell x-show="visibleCols.includes('type')">
                        {{ $component->type }}
                    </x-ui.table.cell>
                    
                    <x-ui.table.cell x-show="visibleCols.includes('created_at')">
                        {{ $component->created_at->format('M d, Y') }}
                    </x-ui.table.cell>
                    
                    <x-ui.table.cell x-show="visibleCols.includes('description')">
                        {{ str($component->description)->limit(100) }}
                    </x-ui.table.cell>
                    
                    <x-ui.table.cell>
                        <x-ui.dropdown position="bottom-start">
                            <x-slot:button>
                                <x-ui.button 
                                    icon="ellipsis-horizontal" 
                                    variant="ghost"
                                    square
                                />
                            </x-slot:button>
                            
                            <x-slot:menu>
                                <x-ui.dropdown.item icon="pencil">
                                    Edit
                                </x-ui.dropdown.item>
                                <x-ui.dropdown.item icon="trash" variant="danger">
                                    Delete
                                </x-ui.dropdown.item>
                            </x-slot:menu>
                        </x-ui.dropdown>
                    </x-ui.table.cell>
                </x-ui.table.row>
            @empty
                <x-ui.table.empty>
                    <x-ui.empty>
                        <x-ui.empty.media>
                            <x-ui.icon name="inbox" class="size-10" />
                        </x-ui.empty.media>
                        <x-ui.empty.contents>
                            <h3 class="text-lg font-semibold">No results found</h3>
                            <p class="text-sm text-neutral-500">
                                Try adjusting your search or create a new component.
                            </p>
                        </x-ui.empty.contents>
                    </x-ui.empty>
                </x-ui.table.empty>
            @endforelse
        </x-ui.table.rows>
    </x-ui.table>
</div>
```

## Component Props

### Table

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `paginator` | Paginator\|null | `null` | Laravel paginator instance |
| `pagination:variant` | string | `'full'` | Pagination style: `full`, `simple`, `compact` |
| `loading` | slot | `null` | Custom loading indicator |
| `top` | slot | `null` | Content above the table (filters, search, etc.) |
| `footer` | slot | `null` | Content below the table |
| `draggable` | boolean | `false` | Enable drag-and-drop reordering |
| `loadOnPagination` | boolean | `false` | Show loading state during pagination |
| `wire:loading` | boolean | `false` | Enable Livewire loading states |
| `wire:target` | string | `null` | Specific Livewire actions to track |
| `class` | string | `''` | Additional CSS classes |

### Table.Header

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `sticky` | boolean | `false` | Make header stick to top while scrolling |
| `class` | string | `''` | Additional CSS classes |

### Table.Head

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `column` | string\|null | `null` | Column name for sorting |
| `sortable` | boolean | `false` | Enable sorting for this column |
| `variant` | string | `'default'` | Sorting UI: `default`, `dropdown` |
| `currentSortBy` | string | `''` | Current sort column |
| `currentSortDir` | string | `''` | Current sort direction |
| `sticky` | boolean | `false` | Make column stick while scrolling horizontally |
| `class` | string | `''` | Additional CSS classes |

### Table.Row

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `key` | string\|null | `null` | Unique key for Livewire tracking |
| `checkboxId` | string\|int\|null | `null` | ID for checkbox selection |
| `class` | string | `''` | Additional CSS classes |

### Table.Cell

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `sticky` | boolean | `false` | Make cell stick while scrolling horizontally |
| `class` | string | `''` | Additional CSS classes |

## Available Traits

### WithPagination

```php
use Src\Components\Livewire\Concerns\WithPagination;

public int $perPage = 15;
```

### WithSearch

```php
use Src\Components\Livewire\Concerns\WithSearch;

public string $searchQuery = '';

protected function applySearch($query)
{
    // Your search logic
}
```

### WithSorting

```php
use Src\Components\Livewire\Concerns\WithSorting;

public string $sortBy = '';
public string $sortDir = 'asc';

protected function sortableColumns(): array
{
    return ['name', 'email', 'created_at'];
}
```

### WithSelection

```php
use Src\Components\Livewire\Concerns\WithSelection;

public array $selectedIds = [];
public array $visibleIds = [];
```

### CanExportCsv

```php
use Src\Components\Livewire\Concerns\CanExportCsv;

#[Renderless]
public function exportToCsv()
{
    return $this->csv($query->get());
}
```

## Tips & Best Practices

### Performance Optimization

**1. Use Debouncing for Search**
```blade
wire:model.live.debounce.300ms="searchQuery"
```

**2. Add Loading States**
```blade
<x-ui.table 
    wire:loading
    wire:target="searchQuery,sortByColumn"
    loadOnPagination
>
```

**3. Eager Load Relationships**
```php
$users = User::with('role', 'department')
    ->paginate($this->perPage);
```

**4. Use Query Scopes**
```php
// Instead of complex component logic
protected function applySearch($query)
{
    return $query->search($this->searchQuery);
}
```

### Security Best Practices

**1. Always Validate Selected IDs**
```php
public function deleteSelected()
{
    $this->validate([
        'selectedIds' => 'required|array|min:1',
        'selectedIds.*' => 'integer|exists:users,id',
    ]);
    
    // Safe to proceed
}
```

**2. Escape Search Queries**
```php
protected function applySearch($query)
{
    $search = str_replace(
        ['\\', '%', '_'], 
        ['\\\\', '\\%', '\\_'], 
        $this->searchQuery
    );
    
    return $query->where(function($q) use ($search) {
        // Safely use $search here
    });
}
```

**3. Whitelist Sortable Columns**
```php
protected function sortableColumns(): array
{
    return ['name', 'email', 'created_at'];
}
```

**4. Add Authorization Checks**
```php
public function deleteSelected()
{
    Gate::authorize('delete-multiple', User::class);
    
    // Delete logic...
}
```

### Accessibility

The table component is built with accessibility in mind:

- **Keyboard Navigation**: Checkboxes and buttons are fully keyboard accessible
- **Screen Reader Support**: Proper ARIA labels and semantic HTML
- **Focus Management**: Clear focus indicators on interactive elements
- **Sort Indicators**: Visual and semantic indicators for sort state

### Common Patterns

**Reset All Filters**
```php
public function resetAll()
{
    $this->searchQuery = '';
    $this->sortBy = '';
    $this->sortDir = 'asc';
    $this->selectedIds = [];
    $this->filters = [];
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
    
    return $this->csv($query->get());
}
```

**Per-Page Selector**
```blade
<x-ui.select wire:model.live="perPage" class="w-32">
    <option value="10">10</option>
    <option value="25">25</option>
    <option value="50">50</option>
    <option value="100">100</option>
</x-ui.select>
```

## Troubleshooting

### Checkboxes Not Syncing

Ensure you're setting `visibleIds` in your render method:

```php
public function render()
{
    $users = User::query()->paginate($this->perPage);
    
    // This is crucial for checkbox sync
    $this->visibleIds = $users->pluck('id')
        ->map(fn ($id) => (string) $id)
        ->toArray();
        
    return view('livewire.users-table', ['users' => $users]);
}
```

### Search Not Resetting Pagination

Make sure the `WithSearch` trait's `updatedSearchQuery` is working:

```php
public function updatedSearchQuery()
{
    $this->resetPage();
}
```

### Column Visibility Not Persisting

Install and configure Alpine's persist plugin:

```js
import persist from '@alpinejs/persist'
Alpine.plugin(persist)
```

Then use it in your component:
```blade
x-data="{ visibleCols: $persist(['name']).as('table-cols') }"
```

### Sorting Not Working

1. Check the column name matches your database column
2. Verify the column is in `sortableColumns()`
3. Ensure you're passing `currentSortBy` and `currentSortDir` to the head component

## Related Components

- [Pagination](/docs/components/pagination) - Standalone pagination component
- [Dropdown](/docs/components/dropdown) - Used for bulk actions and filters
- [Input](/docs/components/input) - Used for search fields
- [Checkbox](/docs/components/checkbox) - Used for row selection
- [Empty State](/docs/components/empty) - Used when no results found