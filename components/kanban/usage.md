# **Kanban Component Documentation**

```markdown
---
name: 'kanban'
---

# Introduction

The **Kanban Board** is a flexible, modern component for visualizing and organizing tasks, workflows, and projects in columns. Inspired by mathematical organization and problem-solving workflows, it offers a clean API with extensive customization through slots.

## Key Features

- **Flexible Layout**: Responsive columns with customizable widths
- **Slot-based Architecture**: Complete control over header, content, and footer
- **Dark Mode Ready**: Built-in support for light/dark themes
- **Accessibility First**: Semantic HTML with proper ARIA labels
- **Customizable Cards**: Support for handles, metadata, and interactive elements
- **Empty States**: Built-in empty state handling

## Installation

Use the Sheaf artisan command to install the kanban component:

```bash
php artisan sheaf:install kanban
```

> Once installed, you can use `<x-ui.kanban />`, `<x-ui.kanban.column />`, and `<x-ui.kanban.card />` components in any Blade view.

---

## Basic Usage

@blade
<x-demo class="flex justify-center">
    <x-ui.kanban>
        <x-ui.kanban.column
            id="axioms" 
            title="Axioms"
            description="Foundational statements accepted without proof"
            :count="3"
        >
            <x-ui.kanban.card :id="1">
                <x-ui.text>Parallel postulate</x-ui.text>
            </x-ui.kanban.card>
            <x-ui.kanban.card :id="2">
                <x-ui.text>Commutativity of addition</x-ui.text>
            </x-ui.kanban.card>
            <x-ui.kanban.card :id="3">
                <x-ui.text>Well-ordering principle</x-ui.text>
            </x-ui.kanban.card>
        </x-ui.kanban.column>
        
        <x-ui.kanban.column
            id="lemmas" 
            title="Lemmas" 
            description="Helper theorems"
            :count="2"
        >
            <x-ui.kanban.card :id="4">
                <div class="flex items-center gap-2">
                    <div class="size-2 rounded-full bg-blue-500"></div>
                    <x-ui.text>Gauss's lemma</x-ui.text>
                </div>
            </x-ui.kanban.card>
            <x-ui.kanban.card :id="5">
                <x-ui.text>Zorn's lemma</x-ui.text>
            </x-ui.kanban.card>
        </x-ui.kanban.column>
        
        <x-ui.kanban.column id="theorems" title="Proven Theorems" :count="1">
            <x-ui.kanban.card :id="6">
                <div class="flex items-center gap-2">
                    <div class="size-2 rounded-full bg-green-500"></div>
                    <x-ui.text>Pythagorean theorem</x-ui.text>
                </div>
            </x-ui.kanban.card>
        </x-ui.kanban.column>
    </x-ui.kanban>
</x-demo>
@endblade

```blade
<x-ui.kanban>
    <x-ui.kanban.column
        id="axioms" 
        title="Axioms"
        description="Foundational statements accepted without proof"
        :count="3"
    >
        <x-ui.kanban.card :id="1">
            <x-ui.text>Parallel postulate</x-ui.text>
        </x-ui.kanban.card>
        <x-ui.kanban.card :id="2">
            <x-ui.text>Commutativity of addition</x-ui.text>
        </x-ui.kanban.card>
    </x-ui.kanban.column>
    
    <x-ui.kanban.column
        id="lemmas" 
        title="Lemmas" 
        description="Helper theorems"
        :count="2"
    >
        <!-- Card content -->
    </x-ui.kanban.column>
    
    <x-ui.kanban.column id="theorems" title="Proven Theorems">
        <x-slot:empty>
            <p class="text-sm text-neutral-500">No proven theorems yet</p>
        </x-slot:empty>
    </x-ui.kanban.column>
</x-ui.kanban>
```

---

## Custom Column Width

Control column width using CSS custom properties:

@blade
<x-demo class="flex justify-center">
    <x-ui.kanban class="[--column-width:18rem]">
        <x-ui.kanban.column title="Conjectures">
            <x-ui.kanban.card>
                <p class="text-sm">Collatz conjecture (1937)</p>
            </x-ui.kanban.card>
        </x-ui.kanban.column>
        
        <x-ui.kanban.column title="Proof Techniques">
            <x-ui.kanban.card>
                <p class="text-sm">Proof by contradiction</p>
            </x-ui.kanban.card>
            <x-ui.kanban.card>
                <p class="text-sm">Mathematical induction</p>
            </x-ui.kanban.card>
        </x-ui.kanban.column>
    </x-ui.kanban>
</x-demo>
@endblade

```blade
<!-- Narrow columns -->
<x-ui.kanban class="[--column-width:18rem]">
    <!-- Columns will be 18rem wide -->
</x-ui.kanban>

<!-- Wide columns -->
<x-ui.kanban class="[--column-width:28rem]">
    <!-- Columns will be 28rem wide -->
</x-ui.kanban>
```

---

## Custom Headers with Slots

Replace the default header with your own design using the `header` slot:

@blade
<x-demo class="flex justify-center">
    <x-ui.kanban>
        <x-ui.kanban.column id="number-theory">
            <x-slot:header>
                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-purple-50 to-blue-50 dark:from-purple-900/20 dark:to-blue-900/20">
                    <div class="flex items-center gap-3">
                        <div class="size-8 flex items-center justify-center bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                            <span class="text-lg font-bold text-purple-600 dark:text-purple-400">ℕ</span>
                        </div>
                        <div>
                            <h3 class="font-semibold">Number Theory</h3>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400">Properties of integers</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-1 text-xs font-medium bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 rounded-full">
                            8 problems
                        </span>
                        <button class="p-1 hover:bg-white dark:hover:bg-neutral-800 rounded-lg transition-colors">
                            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                    </div>
                </div>
            </x-slot:header>
            
            <x-ui.kanban.card>
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="font-medium">Goldbach's conjecture</span>
                        <x-ui.badge color="amber" size="sm">Open</x-ui.badge>
                    </div>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">
                        Every even integer greater than 2 can be expressed as the sum of two primes
                    </p>
                    <div class="flex items-center gap-2 text-xs text-neutral-500">
                        <span>Proposed: 1742</span>
                        <span>•</span>
                        <span>Field: Additive number theory</span>
                    </div>
                </div>
            </x-ui.kanban.card>
        </x-ui.kanban.column>
    </x-ui.kanban>
</x-demo>
@endblade

```blade
<x-ui.kanban.column>
    <x-slot:header>
        <!-- Your custom header design -->
        <div class="p-4 bg-gradient-to-r from-purple-50 to-blue-50">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="size-8 bg-purple-100 rounded-lg">ℕ</div>
                    <div>
                        <h3 class="font-semibold">Number Theory</h3>
                        <p class="text-sm text-neutral-600">Properties of integers</p>
                    </div>
                </div>
                <span class="px-2 py-1 text-xs bg-purple-100 text-purple-700 rounded-full">
                    8 problems
                </span>
            </div>
        </div>
    </x-slot:header>
    
    <!-- Cards go here -->
</x-ui.kanban.column>
```

---

## Card Variations

### Card with Top and Bottom Slots

Add metadata above and below the main content:

@blade
<x-demo class="flex justify-center">
    <x-ui.kanban>
        <x-ui.kanban.column title="Complexity Classes">
            <x-ui.kanban.card>
                <x-slot:top>
                    <div class="flex items-center justify-between mb-2">
                        <x-ui.badge color="green" size="sm">P</x-ui.badge>
                        <span class="text-xs text-neutral-500">Time complexity</span>
                    </div>
                </x-slot:top>
                
                <div>
                    <h4 class="font-medium">P vs NP Problem</h4>
                    <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                        Can every problem whose solution can be verified quickly also be solved quickly?
                    </p>
                </div>
                
                <x-slot:bottom>
                    <div class="flex items-center justify-between mt-3 pt-3 border-t border-neutral-200 dark:border-neutral-800">
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-neutral-600 dark:text-neutral-400">Stephen Cook (1971)</span>
                        </div>
                        <div class="flex items-center gap-3 text-xs text-neutral-500">
                            <span class="flex items-center gap-1">
                                <svg class="size-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Millennium Prize
                            </span>
                        </div>
                    </div>
                </x-slot:bottom>
            </x-ui.kanban.card>
        </x-ui.kanban.column>
    </x-ui.kanban>
</x-demo>
@endblade

```blade
<x-ui.kanban.card>
    <x-slot:top>
        <!-- Content above main card content -->
        <div class="flex items-center justify-between mb-2">
            <x-ui.badge color="green" size="sm">P</x-ui.badge>
            <span class="text-xs text-neutral-500">Time complexity</span>
        </div>
    </x-slot:top>
    
    <!-- Main card content -->
    <div>
        <h4 class="font-medium">P vs NP Problem</h4>
        <p class="mt-1 text-sm text-neutral-600">Description here</p>
    </div>
    
    <x-slot:bottom>
        <!-- Content below main card content -->
        <div class="flex items-center justify-between mt-3">
            <!-- Footer content -->
        </div>
    </x-slot:bottom>
</x-ui.kanban.card>
```

### Card with Drag Handle

Add a custom drag handle that appears on hover:

@blade
<x-demo class="flex justify-center">
    <x-ui.kanban>
        <x-ui.kanban.column title="Proof Steps">
            <x-ui.kanban.card>
                <x-slot:handle>
                    <div class="p-1.5 hover:bg-neutral-200 dark:hover:bg-neutral-800 rounded cursor-move">
                        <svg class="size-4 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                        </svg>
                    </div>
                </x-slot:handle>
                
                <div>
                    <h4 class="font-medium">Lemma 1.2</h4>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">
                        If f is continuous on [a,b], then f is bounded
                    </p>
                </div>
            </x-ui.kanban.card>
            
            <x-ui.kanban.card>
                <x-slot:handle>
                    <div class="p-1.5 hover:bg-neutral-200 dark:hover:bg-neutral-800 rounded cursor-move">
                        <svg class="size-4 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </div>
                </x-slot:handle>
                
                <div>
                    <h4 class="font-medium">Theorem 2.3</h4>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">
                        Extreme value theorem
                    </p>
                </div>
            </x-ui.kanban.card>
        </x-ui.kanban.column>
    </x-ui.kanban>
</x-demo>
@endblade

```blade
<x-ui.kanban.card>
    <x-slot:handle>
        <!-- Your custom drag handle -->
        <div class="p-1.5 hover:bg-neutral-200 rounded cursor-move">
            <svg class="size-4 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
            </svg>
        </div>
    </x-slot:handle>
    
    <!-- Card content -->
</x-ui.kanban.card>
```

---

## Empty States

Provide custom empty states for columns with no cards:

@blade
<x-demo class="flex justify-center">
    <x-ui.kanban>
        <x-ui.kanban.column title="Unsolved Problems">
            <x-slot:empty>
                <div class="py-8 text-center">
                    <svg class="mx-auto size-12 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                    <h4 class="mt-4 font-medium text-neutral-900 dark:text-neutral-100">No unsolved problems</h4>
                    <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                        All mathematical problems have been solved! (Unlikely)
                    </p>
                    <button class="mt-4 px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Propose New Problem
                    </button>
                </div>
            </x-slot:empty>
        </x-ui.kanban.column>
    </x-ui.kanban>
</x-demo>
@endblade

```blade
<x-ui.kanban.column>
    <x-slot:empty>
        <!-- Your custom empty state -->
        <div class="py-8 text-center">
            <svg class="mx-auto size-12 text-neutral-400">...</svg>
            <h4 class="mt-4 font-medium">No items yet</h4>
            <p class="mt-1 text-sm text-neutral-600">Description here</p>
        </div>
    </x-slot:empty>
</x-ui.kanban.column>
```

---

## Column Footers

Add interactive elements to column footers:

@blade
<x-demo class="flex justify-center">
    <x-ui.kanban>
        <x-ui.kanban.column title="Research Problems" :count="2">
            <x-ui.kanban.card>
                <div>
                    <h4 class="font-medium">Riemann Hypothesis</h4>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Distribution of prime numbers</p>
                </div>
            </x-ui.kanban.card>
            
            <x-ui.kanban.card>
                <div>
                    <h4 class="font-medium">Navier-Stokes Existence</h4>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Fluid dynamics equations</p>
                </div>
            </x-ui.kanban.card>
            
            <x-slot:footer>
                <form class="space-y-2 p-3">
                    <input 
                        type="text" 
                        placeholder="Add a new research problem..." 
                        class="w-full px-3 py-2 text-sm border border-neutral-300 dark:border-neutral-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 px-3 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Add Problem
                        </button>
                        <button type="button" class="px-3 py-2 text-sm border border-neutral-300 dark:border-neutral-600 rounded-lg hover:bg-neutral-50 dark:hover:bg-neutral-800">
                            Import
                        </button>
                    </div>
                </form>
            </x-slot:footer>
        </x-ui.kanban.column>
    </x-ui.kanban>
</x-demo>
@endblade

```blade
<x-ui.kanban.column>
    <!-- Cards go here -->
    
    <x-slot:footer>
        <!-- Footer content -->
        <form class="p-3">
            <input type="text" placeholder="Add new item..." />
            <button type="submit">Add</button>
        </form>
    </x-slot:footer>
</x-ui.kanban.column>
```

## Implementation Guide 

- Advanced Example: Mathematical Proof Pipeline

Here's a complete example showcasing the component's flexibility with a mathematical theme:

@blade
<x-demo class="flex justify-center">
    <x-ui.kanban class="[--column-width:24rem]">
        <!-- Conjectures Column -->
        <x-ui.kanban.column
            id="conjectures"
            title="Conjectures"
            description="Unproven mathematical statements"
            :count="3"
        >
            <x-ui.kanban.card>
                <x-slot:top>
                    <div class="flex items-center gap-2 mb-2">
                        <x-ui.badge color="purple" size="sm">Number Theory</x-ui.badge>
                        <x-ui.badge color="amber" size="sm" variant="outline">Open since 1742</x-ui.badge>
                    </div>
                </x-slot:top>
                
                <div>
                    <h4 class="font-medium">Goldbach's Conjecture</h4>
                    <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                        Every even integer greater than 2 can be expressed as the sum of two primes.
                    </p>
                </div>
                
                <x-slot:bottom>
                    <div class="flex items-center justify-between mt-3 pt-3 border-t border-neutral-200 dark:border-neutral-800">
                        <div class="flex -space-x-2">
                            <div class="size-6 rounded-full bg-blue-100 dark:bg-blue-900/30 border-2 border-white dark:border-neutral-900 flex items-center justify-center text-xs">
                                CG
                            </div>
                            <div class="size-6 rounded-full bg-green-100 dark:bg-green-900/30 border-2 border-white dark:border-neutral-900 flex items-center justify-center text-xs">
                                LE
                            </div>
                        </div>
                        <div class="text-xs text-neutral-500">Verified to 4×10¹⁸</div>
                    </div>
                </x-slot:bottom>
            </x-ui.kanban.card>
        </x-ui.kanban.column>
        
        <!-- In Progress Column -->
        <x-ui.kanban.column
            id="in-progress"
            title="Under Review"
            description="Proofs being verified"
            :count="2"
        >
            <x-slot:header>
                <div class="p-4 border-b border-neutral-200 dark:border-neutral-800">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="size-3 rounded-full bg-green-500 animate-pulse"></div>
                            <div>
                                <h3 class="font-semibold">Under Review</h3>
                                <p class="text-sm text-neutral-600 dark:text-neutral-400">Proof verification in progress</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-full">
                            2 active
                        </span>
                    </div>
                </div>
            </x-slot:header>
            
            <x-ui.kanban.card>
                <div class="space-y-2">
                    <div class="flex items-start justify-between">
                        <h4 class="font-medium">Twin Prime Proof</h4>
                        <x-ui.badge color="blue" size="sm">Yitang Zhang</x-ui.badge>
                    </div>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">
                        Bounded gaps between primes (2013)
                    </p>
                    <div class="pt-2">
                        <div class="h-1.5 bg-neutral-200 dark:bg-neutral-800 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-500" style="width: 85%"></div>
                        </div>
                        <p class="text-xs text-neutral-500 mt-1">85% verified</p>
                    </div>
                </div>
            </x-ui.kanban.card>
        </x-ui.kanban.column>
        
        <!-- Proven Theorems Column -->
        <x-ui.kanban.column id="proven" title="Proven Theorems">
            <x-slot:empty>
                <div class="text-center py-8">
                    <svg class="mx-auto size-12 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="mt-2 text-sm text-neutral-500">All theorems are still conjectures</p>
                </div>
            </x-slot:empty>
        </x-ui.kanban.column>
    </x-ui.kanban>
</x-demo>
@endblade

---

## Component Props Reference

### ui.kanban

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `class` | string | - | Additional CSS classes |
| `--column-width` | CSS custom property | `20rem` | Width of each column |

### ui.kanban.column

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `id` | string | `null` | Unique identifier for the column |
| `title` | string | `null` | Column title (displayed in default header) |
| `description` | string | `null` | Column description |
| `count` | number | `null` | Number of items in column (displayed in header) |
| `size` | string | `'md'` | Size variant |
| `header` | slot | - | Custom header content |
| `empty` | slot | - | Custom empty state |
| `footer` | slot | - | Custom footer content |

### ui.kanban.card

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `id` | string | `null` | Unique identifier for the card |
| `size` | string | `'md'` | Size variant (`'xs'`, `'sm'`, `'md'`) |
| `top` | slot | - | Content above main card content |
| `bottom` | slot | - | Content below main card content |
| `handle` | slot | - | Custom drag handle (appears on hover) |

---

## Mathematical Theme Examples

### Proof Stages Board

```blade
<x-ui.kanban class="[--column-width:22rem]">
    <!-- Axioms -->
    <x-ui.kanban.column
        id="axioms"
        title="Axioms"
        description="Foundational assumptions"
    >
        <x-ui.kanban.card>
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <div class="size-2 rounded-full bg-gray-500"></div>
                    <h4 class="font-medium">ZFC Axioms</h4>
                </div>
                <p class="text-sm text-neutral-600">Zermelo–Fraenkel set theory with choice</p>
            </div>
        </x-ui.kanban.card>
    </x-ui.kanban.column>
    
    <!-- Lemmas -->
    <x-ui.kanban.column
        id="lemmas"
        title="Lemmas"
        description="Intermediate results"
    >
        <x-ui.kanban.card>
            <div class="space-y-2">
                <h4 class="font-medium">Pumping Lemma</h4>
                <p class="text-sm text-neutral-600">Regular languages in automata theory</p>
                <x-ui.badge color="blue" size="sm">Formal languages</x-ui.badge>
            </div>
        </x-ui.kanban.card>
    </x-ui.kanban.column>
    
    <!-- Theorems -->
    <x-ui.kanban.column
        id="theorems"
        title="Theorems"
        description="Proven statements"
    >
        <x-ui.kanban.card>
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <h4 class="font-medium">Fundamental Theorem</h4>
                    <x-ui.badge color="green" size="sm">Proven</x-ui.badge>
                </div>
                <p class="text-sm text-neutral-600">Calculus: differentiation and integration are inverse operations</p>
            </div>
        </x-ui.kanban.card>
    </x-ui.kanban.column>
</x-ui.kanban>
```

### Problem Solving Pipeline

```blade
<x-ui.kanban>
    <!-- Problem Statement -->
    <x-ui.kanban.column title="Problem">
        <x-ui.kanban.card>
            <div class="space-y-3">
                <h4 class="font-medium">Solve: x² + 1 = 0</h4>
                <div class="text-sm text-neutral-600 space-y-1">
                    <p>Field: Complex Analysis</p>
                    <p>Difficulty: ★☆☆☆☆</p>
                </div>
            </div>
        </x-ui.kanban.card>
    </x-ui.kanban.column>
    
    <!-- Approach -->
    <x-ui.kanban.column title="Approach">
        <x-ui.kanban.card>
            <div class="space-y-2">
                <h4 class="font-medium">Method: Algebraic</h4>
                <p class="text-sm text-neutral-600">x² = -1 → x = ±√(-1) = ±i</p>
            </div>
        </x-ui.kanban.card>
    </x-ui.kanban.column>
    
    <!-- Solution -->
    <x-ui.kanban.column title="Solution">
        <x-ui.kanban.card>
            <div class="space-y-2">
                <h4 class="font-medium">Solution Set</h4>
                <p class="text-sm text-neutral-600">x ∈ {i, -i}</p>
                <x-ui.badge color="green" size="sm">Verified</x-ui.badge>
            </div>
        </x-ui.kanban.card>
    </x-ui.kanban.column>
</x-ui.kanban>
```