---
name: 'pagination'
---

# Pagination Component

## Introduction

The `pagination` component provides a flexible, accessible navigation system for paginated data. Built on top of Laravel's pagination system, it automatically detects whether you're using simple pagination or length-aware pagination and renders the appropriate interface. With two visual variants and full Livewire integration, it seamlessly handles user navigation through large datasets.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `pagination` component:

```bash
php artisan sheaf:install pagination
```

> Once installed, you can use the <x-ui.pagination /> component in any livewire component.


## Basic Usage

### With Length-Aware Pagination

Length-aware pagination provides page numbers and total count, ideal for datasets where users need to know the total number of pages.

```php
use App\Livewire\Concerns\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.users-table', [
            'users' => User::paginate($this->perPage)
        ]);
    }
}
```

```blade
<!-- In your view -->
<div>
    @foreach($users as $user)
        <div>{{ $user->name }}</div>
    @endforeach

    <x-ui.pagination :paginator="$users" />
</div>
```

### With Simple Pagination

Simple pagination only shows Previous/Next buttons without total page count, optimized for large datasets where counting all records would be expensive.

```php
// In your Livewire component
public function render()
{
    return view('livewire.users-table', [
        'users' => User::simplePaginate($this->perPage)
    ]);
}
```

```blade
<!-- Same view code works automatically -->
<x-ui.pagination :paginator="$users" />
```

> **Note:** The component automatically detects whether you're using `paginate()` or `simplePaginate()` and renders the appropriate interface.

> **Note:** the `perPage` is optional and we need it only when using the length aware pagination with full variant otherwise you can keep it just as a reusable flag across your paginations.

## Pagination Variants

### Default Variant

Compact pagination with minimal UI on the right corner for *simpl* and **length aware** paginations.

@blade
<x-md.cta                                                            
    href="/demos/pagination?variant=default"                                    
    label="look under the table section to see how pagination looks, play around with the control to demo all the 4 morphs of the ui there"
    ctaLabel="Visit The Demo"
/>
@endblade

### Full Variant

Comprehensive pagination with item counts, page information, and per-page selector (for length-aware only), and expand the pagination to the full width for the simple pagination.

**Features:**
- Shows "1-15 of 150" item range
- Displays "Page 1 of 10"
- Includes per-page selector (10, 20, 30, 40, 50)
- First/Last page buttons

@blade
<x-md.cta                                                            
    href="/demos/pagination?variant=full"                                    
    label="look under the table section to see how pagination looks, play around with the control to demo all the 4 morphs of the ui there"
    ctaLabel="Visit The Demo"
/>
@endblade
## Usage with Table Component

The pagination component integrates seamlessly with the table component.

### Basic Integration

```blade
<x-ui.table :paginator="$users">
    <x-ui.table.header>
        <x-ui.table.columns>
            <x-ui.table.head>Name</x-ui.table.head>
            <x-ui.table.head>Email</x-ui.table.head>
        </x-ui.table.columns>
    </x-ui.table.header>

    <x-ui.table.rows>
        @foreach($users as $user)
            <x-ui.table.row>
                <x-ui.table.cell>{{ $user->name }}</x-ui.table.cell>
                <x-ui.table.cell>{{ $user->email }}</x-ui.table.cell>
            </x-ui.table.row>
        @endforeach
    </x-ui.table.rows>
</x-ui.table>
```

> **Tip:** When you pass `:paginator` to the table component, it automatically renders pagination at the bottom. No need to add `<x-ui.pagination>` separately!

### Specifying Pagination Variant

Control the pagination variant through the table component:

```blade
<x-ui.table 
    :paginator="$users" 
    pagination:variant="full"
>
    <!-- Table content -->
</x-ui.table>
```


### With Full Variant Per-Page Options

pass your own `:options` prop to `pagination` component 

```blade
<x-ui.pagination :paginator="$users" :options="[10, 20, 30]" variant="full" />
```

or 

```
<x-ui.table 
    :paginator="$users" 
    :pagination:options="[10, 20, 30]"
>
    <!-- Table content -->
</x-ui.table>
```

for tables



### Reset Pagination on Filter Change

```php
use App\Livewire\Concerns\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public string $searchQuery = '';

    public function updatedSearchQuery()
    {
        $this->resetPage(); // Reset to page 1 when search changes
    }

    public function render()
    {
        $users = User::query()
            ->when($this->searchQuery, fn($q) => 
                $q->where('name', 'like', "%{$this->searchQuery}%")
            )
            ->paginate($this->perPage);

        return view('livewire.users-table', ['users' => $users]);
    }
}
```
## Component Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `paginator` | `Paginator\|LengthAwarePaginator\|CursorPaginator` | `null` | Laravel paginator instance (required) |
| `variant` | `string` | `'default'` | Visual variant: `'default'` or `'full'` |
