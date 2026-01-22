---
name: 'table'
---

# Table Component

## Introduction

The `table` component provides a powerful, composable system for building feature-rich data tables. Built with Livewire and Alpine.js, it offers pagination, sorting, searching, selection, bulk actions, column visibility controls, drag-and-drop reordering, and more all with excellent accessibility and a clean, modern design.

Our approach uses **composable traits** on the backend and **slot-based components** on the frontend, giving you complete control over your table's structure and behavior while maintaining clean, reusable code.

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


## Sorting 
This component includes everything you need to add sorting to your tables. To enable sorting, first add the `App\Livewire\Concerns\WithSorting` trait to your Livewire component like this:

```php
{~
use App\Models\User;
use App\Livewire\Concerns\WithSorting;
use App\Livewire\Concerns\WithPagination;
class Theorems extends Component
{ ~}
    {+
    use WithSorting;+}

    public function render()
    {
        $users = User::query()
{+            ->when(filled($this->sortBy), function ($query) {
                return $this->applySorting($query);
            })+}
            ->paginate();

        return view('livewire.users', [
            'users' => $users,
        ]);
    }
}
```
`$this->sortBy` and `$this->applySorting()` are coming from that `WithSorting` trait.

In your table header view, mark sortable columns and pass the current sort state like this:

```blade
<x-ui.table.head
{+    column="name"
    sortable
    :currentSortBy="$sortBy"
    :currentSortDir="$sortDir"+}
>
    name
</x-ui.table.head>
```
- `column` should match your database column name.
- `sortable` marks the column as sortable.
- `currentSortBy` and `currentSortDir` are reactive Livewire properties tracking the current sort state.

> Note, if you want to restrict sorting on the backend side you can use the `sortableColumns()` method on the component class 


### Sorting variants
There are two sorting variants:

- `default`: shows sorting icons on hover and cycles sorting on click.
- `dropdown`: opens a menu where the user explicitly chooses the sorting direction.

```blade
<x-ui.table.head
{~    column="name"
    sortable
    :currentSortBy="$sortBy"
    :currentSortDir="$sortDir"~}
{+    variant="default" <!-- default --> +} 
    <!-- or -->
{+    variant="dropdown"+}
>
    name
</x-ui.table.head>
```
You can see these variants in action on our interactive [Math Theorems demo](/demos/datatables).
Sorting by year uses the dropdown variant, while mathematician and difficulty columns use the default variant.

## Pagination

Add pagination to your table by passing a Laravel paginator to table component.

First, create a Livewire component that uses the `App\Livewire\Concerns\WithPagination` trait:

```php
    use \App\Livewire\Concerns\WithPagination;
    // livewire class side 
    $users = User::query()
{+        ->paginate();+}
        // or (if you using length aware paginator with full variant)
{+        ->paginate($this->perPage);+}
```
and pass the users collection to the `paginator` prop on the view:

```blade
<div>
    <x-ui.table 
{+        :paginator="$users"+}
    >
       <!-- table contents... -->
    </x-ui.table>
</div>
```


### More About Pagination ? 
@blade
<x-md.cta                                                            
    href="/docs/components/pagination"                                    
    label="the pagination component has a very detailled documentations and demoing parts there"
    ctaLabel="Visit Docs"
/>
@endblade

## Search 
This component includes everything you need to add search to your tables. To enable search, first add the `App\Livewire\Concerns\WithSorting` trait to your Livewire component like this:

```php
{~
use App\Models\User;
use App\Livewire\Concerns\WithSearch;
use App\Livewire\Concerns\WithPagination;
class Theorems extends Component
{ ~}
    {+
    use WithSearch;+}

    public function render()
    {
        $users = User::query()
{+            ->when(filled($this->searchQuery), function ($query) {
                return $this->applySearch($query);
            })+}
            ->paginate();

        return view('livewire.users', [
            'users' => $users,
        ]);
    }

{+  protected function applySearch($query)
    {
        return $query->where('name', 'like', '%'.$this->searchQuery.'%');
    }+}
}
```

the `applySearch` is up to you to implement...

then binding to an input that you can put in the top of the table 

```blade
 <x-ui.input 
    placeholder="search..." 
    leftIcon="magnifying-glass" 
{+    wire:model.live="searchQuery" <!-- this is what's important-->+}
/>
```

see the search on the guide below for real layout. 
## Selection

the component cames with all logic you need to add select rows and select all functionality for handling bulk actions...


## Loading Logic
due the nature of datatables are usually data heavy.


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

> **Note:** When using sticky header, columns, always apply a background color to prevent content overlap during scrolling.


## Implementation Guide

### Overview

This guide walks you through using the data table component alongside other utilities to create a polished, feature-rich data table. We'll display a list of mathematical theorems, including their discovery year and the mathematicians behind them.

### Setup Theorems Data

First, create a`Theorem` model with fields: (id, name, mathematician, field, year_discovered, difficulty_level, is_proven, statement and applications), For this demo, we use the Sushi package with an in-memory array model. Our `App\Models\Theorem` looks like this: 

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
            ['id' => 3, 'name' => 'Fermat\'s Last Theorem', 'mathematician' => 'Andrew Wiles', 'field' => 'Number Theory', 'year_discovered' => 1995, 'difficulty_level' => 10, 'is_proven' => true, 'statement' => 'No three positive integers satisfy aⁿ + bⁿ = cⁿ for n > 2', 'applications' => 'Pure Mathematics'],
            ['id' => 4, 'name' => 'Gödel\'s Incompleteness Theorems', 'mathematician' => 'Kurt Gödel', 'field' => 'Logic', 'year_discovered' => 1931, 'difficulty_level' => 9, 'is_proven' => true, 'statement' => 'Any consistent formal system has unprovable truths', 'applications' => 'Computer Science, Philosophy'],
            ['id' => 5, 'name' => 'Euler\'s Identity', 'mathematician' => 'Leonhard Euler', 'field' => 'Complex Analysis', 'year_discovered' => 1748, 'difficulty_level' => 6, 'is_proven' => true, 'statement' => 'e^(iπ) + 1 = 0', 'applications' => 'Signal Processing, Quantum Mechanics'],
            ['id' => 6, 'name' => 'Central Limit Theorem', 'mathematician' => 'Pierre-Simon Laplace', 'field' => 'Probability', 'year_discovered' => 1810, 'difficulty_level' => 6, 'is_proven' => true, 'statement' => 'Sum of random variables approaches normal distribution', 'applications' => 'Statistics, Data Science'],
            ['id' => 7, 'name' => 'Riemann Hypothesis', 'mathematician' => 'Bernhard Riemann', 'field' => 'Number Theory', 'year_discovered' => 1859, 'difficulty_level' => 10, 'is_proven' => false, 'statement' => 'All non-trivial zeros of ζ(s) have real part 1/2', 'applications' => 'Prime Number Distribution'],
            ['id' => 8, 'name' => 'Cauchy\'s Integral Theorem', 'mathematician' => 'Augustin-Louis Cauchy', 'field' => 'Complex Analysis', 'year_discovered' => 1825, 'difficulty_level' => 7, 'is_proven' => true, 'statement' => 'Integral of holomorphic function over closed curve is zero', 'applications' => 'Engineering, Physics'],
            ['id' => 9, 'name' => 'Banach Fixed-Point Theorem', 'mathematician' => 'Stefan Banach', 'field' => 'Functional Analysis', 'year_discovered' => 1922, 'difficulty_level' => 7, 'is_proven' => true, 'statement' => 'Contraction mappings have unique fixed points', 'applications' => 'Differential Equations'],
            ['id' => 10, 'name' => 'Nash Equilibrium Theorem', 'mathematician' => 'John Nash', 'field' => 'Game Theory', 'year_discovered' => 1950, 'difficulty_level' => 6, 'is_proven' => true, 'statement' => 'Every finite game has a mixed strategy equilibrium', 'applications' => 'Economics, Political Science'],
            ['id' => 11, 'name' => 'Stokes\' Theorem', 'mathematician' => 'George Stokes', 'field' => 'Vector Calculus', 'year_discovered' => 1854, 'difficulty_level' => 8, 'is_proven' => true, 'statement' => 'Relates surface integral to line integral', 'applications' => 'Fluid Dynamics, Electromagnetism'],
            ['id' => 12, 'name' => 'Brouwer Fixed-Point Theorem', 'mathematician' => 'L.E.J. Brouwer', 'field' => 'Topology', 'year_discovered' => 1911, 'difficulty_level' => 8, 'is_proven' => true, 'statement' => 'Continuous function from ball to itself has fixed point', 'applications' => 'Economics, Differential Equations'],
            ['id' => 13, 'name' => 'Four Color Theorem', 'mathematician' => 'Kenneth Appel & Wolfgang Haken', 'field' => 'Graph Theory', 'year_discovered' => 1976, 'difficulty_level' => 7, 'is_proven' => true, 'statement' => 'Any planar map needs at most 4 colors', 'applications' => 'Cartography, Computer Science'],
            ['id' => 14, 'name' => 'Poincaré Conjecture', 'mathematician' => 'Grigori Perelman', 'field' => 'Topology', 'year_discovered' => 2003, 'difficulty_level' => 10, 'is_proven' => true, 'statement' => 'Every simply connected 3-manifold is homeomorphic to 3-sphere', 'applications' => 'Cosmology, Shape of Universe'],
            ['id' => 15, 'name' => 'Law of Large Numbers', 'mathematician' => 'Jakob Bernoulli', 'field' => 'Probability', 'year_discovered' => 1713, 'difficulty_level' => 5, 'is_proven' => true, 'statement' => 'Sample average converges to expected value', 'applications' => 'Statistics, Machine Learning'],
            ['id' => 16, 'name' => 'Fundamental Theorem of Algebra', 'mathematician' => 'Carl Friedrich Gauss', 'field' => 'Algebra', 'year_discovered' => 1799, 'difficulty_level' => 6, 'is_proven' => true, 'statement' => 'Every polynomial has at least one complex root', 'applications' => 'Control Theory, Signal Processing'],
            ['id' => 17, 'name' => 'Green\'s Theorem', 'mathematician' => 'George Green', 'field' => 'Vector Calculus', 'year_discovered' => 1828, 'difficulty_level' => 6, 'is_proven' => true, 'statement' => 'Relates line integral to double integral', 'applications' => 'Fluid Mechanics, Electrostatics'],
            ['id' => 18, 'name' => 'Spectral Theorem', 'mathematician' => 'David Hilbert', 'field' => 'Linear Algebra', 'year_discovered' => 1906, 'difficulty_level' => 8, 'is_proven' => true, 'statement' => 'Normal operators have orthonormal eigenbasis', 'applications' => 'Quantum Mechanics, Principal Component Analysis'],
            ['id' => 19, 'name' => 'Bolzano-Weierstrass Theorem', 'mathematician' => 'Bernard Bolzano & Karl Weierstrass', 'field' => 'Analysis', 'year_discovered' => 1817, 'difficulty_level' => 6, 'is_proven' => true, 'statement' => 'Bounded sequence has convergent subsequence', 'applications' => 'Real Analysis, Optimization'],
            ['id' => 20, 'name' => 'Hahn-Banach Theorem', 'mathematician' => 'Hans Hahn & Stefan Banach', 'field' => 'Functional Analysis', 'year_discovered' => 1927, 'difficulty_level' => 9, 'is_proven' => true, 'statement' => 'Bounded linear functionals can be extended', 'applications' => 'Optimization, Economics'],
            ['id' => 21, 'name' => 'Intermediate Value Theorem', 'mathematician' => 'Bernard Bolzano', 'field' => 'Analysis', 'year_discovered' => 1817, 'difficulty_level' => 4, 'is_proven' => true, 'statement' => 'Continuous function takes all intermediate values', 'applications' => 'Root Finding, Numerical Analysis'],
            ['id' => 22, 'name' => 'Cayley-Hamilton Theorem', 'mathematician' => 'Arthur Cayley & William Hamilton', 'field' => 'Linear Algebra', 'year_discovered' => 1858, 'difficulty_level' => 7, 'is_proven' => true, 'statement' => 'Every matrix satisfies its characteristic equation', 'applications' => 'Control Systems, Matrix Functions'],
            ['id' => 23, 'name' => 'Liouville\'s Theorem', 'mathematician' => 'Joseph Liouville', 'field' => 'Complex Analysis', 'year_discovered' => 1844, 'difficulty_level' => 7, 'is_proven' => true, 'statement' => 'Bounded entire function is constant', 'applications' => 'Complex Analysis, Physics'],
            ['id' => 24, 'name' => 'Prime Number Theorem', 'mathematician' => 'Jacques Hadamard & Charles de la Vallée-Poussin', 'field' => 'Number Theory', 'year_discovered' => 1896, 'difficulty_level' => 9, 'is_proven' => true, 'statement' => 'π(x) ~ x/ln(x) as x → ∞', 'applications' => 'Cryptography, Number Distribution'],
            ['id' => 25, 'name' => 'Bayes\' Theorem', 'mathematician' => 'Thomas Bayes', 'field' => 'Probability', 'year_discovered' => 1763, 'difficulty_level' => 5, 'is_proven' => true, 'statement' => 'P(A|B) = P(B|A)P(A)/P(B)', 'applications' => 'Machine Learning, Medical Diagnosis'],
            ['id' => 26, 'name' => 'Divergence Theorem', 'mathematician' => 'Carl Friedrich Gauss', 'field' => 'Vector Calculus', 'year_discovered' => 1813, 'difficulty_level' => 7, 'is_proven' => true, 'statement' => 'Flux through surface equals volume integral of divergence', 'applications' => 'Electromagnetism, Fluid Dynamics'],
            ['id' => 27, 'name' => 'Noether\'s Theorem', 'mathematician' => 'Emmy Noether', 'field' => 'Mathematical Physics', 'year_discovered' => 1915, 'difficulty_level' => 9, 'is_proven' => true, 'statement' => 'Every symmetry has a corresponding conservation law', 'applications' => 'Particle Physics, General Relativity'],
            ['id' => 28, 'name' => 'Cantor\'s Theorem', 'mathematician' => 'Georg Cantor', 'field' => 'Set Theory', 'year_discovered' => 1891, 'difficulty_level' => 7, 'is_proven' => true, 'statement' => 'Power set is strictly larger than original set', 'applications' => 'Foundations of Mathematics'],
            ['id' => 29, 'name' => 'Mean Value Theorem', 'mathematician' => 'Augustin-Louis Cauchy', 'field' => 'Analysis', 'year_discovered' => 1823, 'difficulty_level' => 5, 'is_proven' => true, 'statement' => 'f\'(c) = (f(b) - f(a))/(b - a) for some c', 'applications' => 'Optimization, Error Analysis'],
            ['id' => 30, 'name' => 'Isoperimetric Inequality', 'mathematician' => 'Jakob Steiner', 'field' => 'Geometry', 'year_discovered' => 1838, 'difficulty_level' => 8, 'is_proven' => true, 'statement' => 'Circle encloses maximum area for given perimeter', 'applications' => 'Optimization, Calculus of Variations'],
            ['id' => 31, 'name' => 'Collatz Conjecture', 'mathematician' => 'Lothar Collatz', 'field' => 'Number Theory', 'year_discovered' => 1937, 'difficulty_level' => 10, 'is_proven' => false, 'statement' => 'All sequences reach 1 via 3n+1 or n/2', 'applications' => 'Dynamical Systems'],
            ['id' => 32, 'name' => 'P vs NP Problem', 'mathematician' => 'Stephen Cook', 'field' => 'Complexity Theory', 'year_discovered' => 1971, 'difficulty_level' => 10, 'is_proven' => false, 'statement' => 'Can every verified solution be found quickly?', 'applications' => 'Computer Science, Cryptography'],
            ['id' => 33, 'name' => 'Riesz Representation Theorem', 'mathematician' => 'Frigyes Riesz', 'field' => 'Functional Analysis', 'year_discovered' => 1907, 'difficulty_level' => 8, 'is_proven' => true, 'statement' => 'Continuous linear functionals representable as integrals', 'applications' => 'Quantum Mechanics, PDEs'],
            ['id' => 34, 'name' => 'Rolle\'s Theorem', 'mathematician' => 'Michel Rolle', 'field' => 'Analysis', 'year_discovered' => 1691, 'difficulty_level' => 4, 'is_proven' => true, 'statement' => 'f\'(c) = 0 for some c if f(a) = f(b)', 'applications' => 'Calculus, Root Finding'],
            ['id' => 35, 'name' => 'Goldbach Conjecture', 'mathematician' => 'Christian Goldbach', 'field' => 'Number Theory', 'year_discovered' => 1742, 'difficulty_level' => 10, 'is_proven' => false, 'statement' => 'Every even integer > 2 is sum of two primes', 'applications' => 'Number Theory Research'],
        ];
    }
}

```

> This is a demo using array-based models for simplicity. Your real application will use standard Laravel Eloquent models, but the integration remains the same regardless of data source.

### Table with Pagination


Add the `App\Livewire\Concerns\WithPagination` trait to your Livewire component to enable pagination:

```php

use App\Models\Theorem;
use App\Livewire\Concerns\WithSorting;
use App\Livewire\Concerns\WithPagination;

class Theorems extends Component
{
{+  use WithPagination;+}

    public function render()
    {
{+      $theorems = $this->baseQuery()->paginate($this->perPage);+}

        return view('livewire.theorems', [
            'theorems' => $theorems,
        ]);
    }

{+  protected function baseQuery(): Builder
    {
        return Theorem::query();
    }+}
}
```

- We use a custom `WithPagination` trait that extends Livewire's native pagination with `$perPage` property and reactive updates.
- The `baseQuery` method encapsulates the core query builder, making it reusable for sorting, filtering, and other operations in later steps.

The view integrates pagination, displays theorem details with badges and icons:

```blade
<x-ui.table 
{+    :paginator="$theorems"  +}
{+    pagination:variant="full"+}
>
    <x-ui.table.header>
        <x-ui.table.columns>
            <x-ui.table.head>
                ID
            </x-ui.table.head>
            <x-ui.table.head>
                Theorem
            </x-ui.table.head>
            <x-ui.table.head>
                Mathematician
            </x-ui.table.head>
            <x-ui.table.head>
                Field
            </x-ui.table.head>
            <x-ui.table.head>
                Year
            </x-ui.table.head>
            <x-ui.table.head>
                Difficulty
            </x-ui.table.head>
            <x-ui.table.head>
                Status
            </x-ui.table.head>
        </x-ui.table.columns>
    </x-ui.table.header>

    <x-ui.table.rows>
        @forelse($paginator as $theorem)
            <x-ui.table.row 
                :key="$theorem->id"
            >
                <x-ui.table.cell sticky class="dark:bg-neutral-950 bg-neutral-50">
                    {{ $theorem->id }}
                </x-ui.table.cell>
                <x-ui.table.cell class="dark:bg-neutral-950 bg-neutral-50">
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
                        <!-- this is a dump way, but for a demo I will leave it like this -->
                        $fieldColors = [
                            'Number Theory' => 'purple',
                            'Analysis' => 'blue',
                            'Geometry' => 'green',
                            'Algebra' => 'red',
                            'Topology' => 'orange',
                            'Probability' => 'pink',
                            'Complex Analysis' => 'cyan',
                            'Functional Analysis' => 'indigo',
                            'Vector Calculus' => 'teal',
                            'Game Theory' => 'violet',
                            'Graph Theory' => 'lime',
                            'Logic' => 'amber',
                            'Linear Algebra' => 'rose',
                            'Set Theory' => 'fuchsia',
                            'Mathematical Physics' => 'sky',
                            'Complexity Theory' => 'emerald',
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
    {+
    use WithSorting;+}
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


#### Step 2: Updates on the View

Let's make `mathematicien`, `year` and `Difficulty` sortable, while making sort by year special by using the `dropdown` sorting variant for sorting:

```blade

<x-ui.table 
    :paginator="$theorems"  
    pagination:variant="full"
    loadOn="
        pagination,
        {+sorting,+}
    "
>
 <x-ui.table.header>
    <x-ui.table.columns>
        <!-- other headers -->
        <x-ui.table.head
{+            column="mathematician"
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
{+            column="year_discovered"
            sortable
            variant="dropdown"
            :currentSortBy="$sortBy"
            :currentSortDir="$sortDir"+}
        >
            Year
        </x-ui.table.head>
        <x-ui.table.head
{+            column="difficulty_level"
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
```

### Add Search

Enable real-time search across your table data,

#### Step 1: Add the Trait

Include the `WithSearch` trait:

```php
<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Livewire\Concerns\WithPagination;
use App\Livewire\Concerns\WithSearch;

class UsersTable extends Component
{
    use WithPagination;
    use WithSearch;

    public function render()
    {
        $theorems = User::query()
            ->when(filled($this->sortBy), function ($query) {
                return $this->applySorting($query);
            })
{+           ->when(filled($this->searchQuery), function ($query) {
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
            ->orWhere('statemen', 'like', '%'.$this->searchQuery.'%');
    }+}
}
```


#### Step 2: Add the Search Input

first let's wrap our table and all of filters logic into the `table.container` blade component, wich is responsible for manaing padding between pagination table and filters in a good way,

```blade
{+<x-ui.table.container+}
{+ 
    <div 
        class="flex items-center"
    >
        {{-- SEARCH INPUT --}}
        <div class="ml-auto">
            <x-ui.input 
                class="[&_input]:bg-transparent" <!-- target underline input and make it transparent...  -->    
                placeholder="search..." 
                leftIcon="magnifying-glass" 
                wire:model.live="searchQuery"
            />
        </div>
    </div>
+}
    <x-ui.table 
        :paginator="$theorems"  
        pagination:variant="full"
        loadOn="
            pagination,
            {+search,+}
            sorting
        "
    >
        <!-- other contents -->
    </x-ui.table>
{+</x-ui.table.container+}
```

### Handle Empty States

Provide helpful feedback when no results are found. use our [empty state component](/docs/components/empty) 

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

use App\Models\User;
use Livewire\Component;

use App\Livewire\Concerns\CanExportCsv;
use App\Livewire\Concerns\WithSelection;

class Theorems extends Component
{
{~    use CanExportCsv;
    use WithPagination;
    use WithSearch;
    use WithSorting;~}
{+  use WithSelection;+}

    public function render()
    {
        $theorems = $this->baseQuery()->...();

        // Store visible IDs for "select all" functionality
{+       $this->visibleIds = $theorems->pluck('id')
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
{+   withCheckAll+}
>
</x-ui.table.columns>

<!-- aaaand -->
<x-ui.table.rows>
    @foreach ($theorems as $user)
        <x-ui.table.row 
           wire:key="user-{{ $user->id }}"
{+          :checkboxId="$user->id"+}
        >
            <x-ui.table.cell>{{ $user->name }}</x-ui.table.cell>
            <x-ui.table.cell>{{ $user->email }}</x-ui.table.cell>
        </x-ui.table.row>
    @endforeach
</x-ui.table.rows>
```

### Bulk Actions (Delete and CSV Export Example)

let add a checkbox button that shows only when there is selected rows.

#### Step 1: Add the CSV Export Trait

Include the `CanExportCsv` trait:

```php
<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Renderless;
use App\Livewire\Concerns\WithSelection;
use App\Livewire\Concerns\CanExportCsv;

class UsersTable extends Component
{
    use WithSelection;
    use CanExportCsv;

    #[Renderless]
    public function exportSelected()
    {
        $theorems = $this->baseQuery();

        if (filled($this->selectedIds)) {
            $theorems = $theorems->whereIn('id', $this->selectedIds);
        }

        return $this->csv($theorems->get());
    }
}
```

#### Step 2: Add Bulk Actions UI

Use the `top` slot to add bulk action controls:

```blade
<x-ui.table :paginator="$theorems">
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
                        wire:confirm="Are you sure you want to delete the selected theorems?"
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
        'selectedIds.*' => 'integer|exists:theorems,id',
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
        'message' => "{$deleted} theorems deleted successfully",
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
    return 'theorems_export_' . now()->format('Y-m-d_His') . '.csv';
}

protected function getExportableColumns(): array
{
    // Limit which columns are exported
    return ['id', 'name', 'email', 'created_at'];
}
```

### Add Column Visibility

Let theorems show/hide columns dynamically.

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
    visibleCols: $persist(['name', 'email', 'role']).as('theorems-table-visible-columns')
}">
    <!-- Column Visibility Dropdown -->
    <x-ui.table :paginator="$theorems">
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
            @foreach ($theorems as $user)
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
    :paginator="$theorems"
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
        $theorems = User::query()
            ->orderBy('sort_order')
            ->paginate($this->perPage);

        return view('livewire.theorems', [
            'theorems' => $theorems,
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

namespace App\Livewire\Concerns;

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
use App\Livewire\Concerns\WithFilters;
use App\Livewire\Concerns\WithPagination;

class UsersTable extends Component
{
    use WithPagination;
    use WithFilters;

    public function render()
    {
        $theorems = User::query()
            ->when(filled($this->filters), function ($query) {
                return $this->applyFilters($query);
            })
            ->paginate($this->perPage);

        return view('livewire.theorems', [
            'theorems' => $theorems,
        ]);
    }
}
```

#### Step 3: Add Filter UI

```blade
<x-ui.table :paginator="$theorems">
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
    :paginator="$theorems"
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
use App\Livewire\Concerns\CanExportCsv;
use App\Livewire\Concerns\WithPagination;
use App\Livewire\Concerns\WithSearch;
use App\Livewire\Concerns\WithSelection;
use App\Livewire\Concerns\WithSorting;

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

### table

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

### table.header

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `sticky` | boolean | `false` | Make header stick to top while scrolling |
| `class` | string | `''` | Additional CSS classes |

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

## Available Traits

### WithPagination

```php
use App\Livewire\Concerns\WithPagination;

public int $perPage = 15;
```

### WithSearch

```php
use App\Livewire\Concerns\WithSearch;

public string $searchQuery = '';

protected function applySearch($query)
{
    // Your search logic
}
```

### WithSorting

```php
use App\Livewire\Concerns\WithSorting;

public string $sortBy = '';
public string $sortDir = 'asc';

protected function sortableColumns(): array
{
    return ['name', 'email', 'created_at'];
}
```

### WithSelection

```php
use App\Livewire\Concerns\WithSelection;

public array $selectedIds = [];
public array $visibleIds = [];
```

### CanExportCsv

```php
use App\Livewire\Concerns\CanExportCsv;

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
$theorems = User::with('role', 'department')
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
        'selectedIds.*' => 'integer|exists:theorems,id',
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
    $theorems = User::query()->paginate($this->perPage);
    
    // This is crucial for checkbox sync
    $this->visibleIds = $theorems->pluck('id')
        ->map(fn ($id) => (string) $id)
        ->toArray();
        
    return view('livewire.theorems', ['theorems' => $theorems]);
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