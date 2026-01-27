---
name: 'kanban'
---

## Introduction

The **Kanban** component provides a flexible board interface for organizing tasks, workflows, and projects into columns. With extensive customization through slots and a clean API, it's perfect for project management, workflow visualization, and any column-based organization system.

## Installation

Use the Sheaf artisan command to install the kanban component:

```bash
php artisan sheaf:install kanban
```

> Once installed, you can use `<x-ui.kanban />`, `<x-ui.kanban.column />`, `<x-ui.kanban.header />`, `<x-ui.kanban.cards />`, and `<x-ui.kanban.card />` components in any Blade view.


## Basic Usage

@blade
<x-demo class="flex justify-center">
    <x-ui.kanban>
        <x-ui.kanban.column id="axioms">
            <x-ui.kanban.header :count="6">
                <x-ui.heading>Axioms</x-ui.heading>
                <x-ui.text>Foundational statements</x-ui.text>
            </x-ui.kanban.header>            
            <x-ui.kanban.cards>
                <x-ui.kanban.card :id="1">
                    <x-ui.text class="font-semibold">
                        Parallel Postulate
                    </x-ui.text>
                    <x-ui.text class="opacity-60 text-xs">
                        Through a point not on a line, exactly one parallel line exists
                    </x-ui.text>
                </x-ui.kanban.card>
                <x-ui.kanban.card :id="2">
                    <x-ui.text class="font-semibold">
                        Commutativity of Addition
                    </x-ui.text>
                    <x-ui.text class="opacity-60 text-xs">
                        For all numbers a and b: a + b = b + a
                    </x-ui.text>
                </x-ui.kanban.card>
                <x-ui.kanban.card :id="3">
                    <x-ui.text class="font-semibold">
                        Well-Ordering Principle
                    </x-ui.text>
                    <x-ui.text class="opacity-60 text-xs">
                        Every non-empty set of positive integers has a least element
                    </x-ui.text>
                </x-ui.kanban.card>
                <x-ui.kanban.card :id="4">
                    <x-ui.text class="font-semibold">
                        Axiom of Choice
                    </x-ui.text>
                    <x-ui.text class="opacity-60 text-xs">
                        Product of non-empty sets is non-empty
                    </x-ui.text>
                </x-ui.kanban.card>
            </x-ui.kanban.cards>
        </x-ui.kanban.column>
        <!--  -->
        <x-ui.kanban.column id="lemmas">
            <x-ui.kanban.header :count="5">
                <x-ui.heading>Lemmas</x-ui.heading>
                <x-ui.text>Helper theorems</x-ui.text>
            </x-ui.kanban.header>
            <x-ui.kanban.cards>
                <x-ui.kanban.card :id="7">
                    <div class="flex items-center gap-2">
                        <div class="size-2 rounded-full bg-blue-500"></div>
                        <x-ui.text class="font-semibold">
                            Gauss's Lemma
                        </x-ui.text>
                    </div>
                    <x-ui.text class="opacity-60 text-xs">
                        Product of primitive polynomials is primitive
                    </x-ui.text>
                </x-ui.kanban.card>
                <x-ui.kanban.card :id="8">
                    <div class="flex items-center gap-2">
                        <div class="size-2 rounded-full bg-blue-500"></div>
                        <x-ui.text class="font-semibold">
                            Zorn's Lemma
                        </x-ui.text>
                    </div>
                    <x-ui.text class="opacity-60 text-xs">
                        Chain condition implies maximal element exists
                    </x-ui.text>
                </x-ui.kanban.card>
                <x-ui.kanban.card :id="9">
                    <div class="flex items-center gap-2">
                        <div class="size-2 rounded-full bg-blue-500"></div>
                        <x-ui.text class="font-semibold">
                            Pumping Lemma
                        </x-ui.text>
                    </div>
                    <x-ui.text class="opacity-60 text-xs">
                        Used to prove languages are not regular
                    </x-ui.text>
                </x-ui.kanban.card>
                <x-ui.kanban.card :id="10">
                    <div class="flex items-center gap-2">
                        <div class="size-2 rounded-full bg-blue-500"></div>
                        <x-ui.text class="font-semibold">
                            Fatou's Lemma
                        </x-ui.text>
                    </div>
                    <x-ui.text class="opacity-60 text-xs">
                        Inequality for limit inferior of integrals
                    </x-ui.text>
                </x-ui.kanban.card>
                <x-ui.kanban.card :id="11">
                    <div class="flex items-center gap-2">
                        <div class="size-2 rounded-full bg-blue-500"></div>
                        <x-ui.text class="font-semibold">
                            Schur's Lemma
                        </x-ui.text>
                    </div>
                    <x-ui.text class="opacity-60 text-xs">
                        Irreducible representation theory
                    </x-ui.text>
                </x-ui.kanban.card>
            </x-ui.kanban.cards>
        </x-ui.kanban.column>
        <!--  -->
        <x-ui.kanban.column id="theorems">
            <x-ui.kanban.header :count="4">
                <x-ui.heading>Proven Theorems</x-ui.heading>
            </x-ui.kanban.header>
            <!--  -->
            <x-ui.kanban.cards>
                <x-ui.kanban.card :id="12">
                    <div class="flex items-center gap-2">
                        <div class="size-2 rounded-full bg-green-500"></div>
                        <x-ui.text class="font-semibold">
                            Pythagorean Theorem
                        </x-ui.text>
                    </div>
                    <x-ui.text class="opacity-60 text-xs">
                        a² + b² = c² for right triangles
                    </x-ui.text>
                </x-ui.kanban.card>
                <x-ui.kanban.card :id="13">
                    <div class="flex items-center gap-2">
                        <div class="size-2 rounded-full bg-green-500"></div>
                        <x-ui.text class="font-semibold">
                            Fundamental Theorem of Calculus
                        </x-ui.text>
                    </div>
                    <x-ui.text class="opacity-60 text-xs">
                        Differentiation and integration are inverse operations
                    </x-ui.text>
                </x-ui.kanban.card>
                <x-ui.kanban.card :id="14">
                    <div class="flex items-center gap-2">
                        <div class="size-2 rounded-full bg-green-500"></div>
                        <x-ui.text class="font-semibold">
                            Fermat's Last Theorem
                        </x-ui.text>
                    </div>
                    <x-ui.text class="opacity-60 text-xs">
                        No integer solutions for x^n + y^n = z^n when n > 2
                    </x-ui.text>
                </x-ui.kanban.card>
                <x-ui.kanban.card :id="15">
                    <div class="flex items-center gap-2">
                        <div class="size-2 rounded-full bg-green-500"></div>
                        <x-ui.text class="font-semibold">
                            Gödel's Incompleteness
                        </x-ui.text>
                    </div>
                    <x-ui.text class="opacity-60 text-xs">
                        Formal systems contain unprovable truths
                    </x-ui.text>
                </x-ui.kanban.card>
            </x-ui.kanban.cards>
        </x-ui.kanban.column>
    </x-ui.kanban>
</x-demo>
@endblade

```blade
<x-ui.kanban>
    <x-ui.kanban.column>
        <x-ui.kanban.header :count="6">
            <x-ui.heading>Axioms</x-ui.heading>
            <x-ui.text>Foundational statements</x-ui.text>
        </x-ui.kanban.header>
        
        <x-ui.kanban.cards>
            <x-ui.kanban.card :id="1">
                <x-ui.text class="font-semibold">
                    Parallel Postulate
                </x-ui.text>
                <x-ui.text class="opacity-60 text-xs">
                    Through a point not on a line, exactly one parallel line exists
                </x-ui.text>
            </x-ui.kanban.card>
            <!-- More cards... -->
        </x-ui.kanban.cards>
    </x-ui.kanban.column>
    
    <x-ui.kanban.column>
        <x-ui.kanban.header :count="5">
            <x-ui.heading>Lemmas</x-ui.heading>
            <x-ui.text>Helper theorems</x-ui.text>
        </x-ui.kanban.header>
        
        <x-ui.kanban.cards>
            <!-- Cards... -->
        </x-ui.kanban.cards>
    </x-ui.kanban.column>
    
    <x-ui.kanban.column>
        <x-ui.kanban.header>
            <x-ui.heading>Proven Theorems</x-ui.heading>
        </x-ui.kanban.header>
        
        <x-ui.kanban.cards>
            <x-slot:empty>
                <p class="text-sm text-neutral-500">No proven theorems yet</p>
            </x-slot:empty>
        </x-ui.kanban.cards>
    </x-ui.kanban.column>
</x-ui.kanban>
```

## Column Width

Control column width using CSS custom properties:

@blade
<x-demo class="flex justify-center">
    <x-ui.kanban class="[--column-width:18rem]">
        <x-ui.kanban.column>
            <x-ui.kanban.header :count="4">
                <x-ui.heading>Conjectures</x-ui.heading>
            </x-ui.kanban.header>
            <!--  -->
            <x-ui.kanban.cards>
                <x-ui.kanban.card>
                    <x-ui.text class="font-semibold text-sm">Collatz Conjecture</x-ui.text>
                    <x-ui.text class="opacity-60" size="xs">Proposed 1937</x-ui.text>
                </x-ui.kanban.card>
                <x-ui.kanban.card>
                    <x-ui.text class="font-semibold text-sm">Twin Prime Conjecture</x-ui.text>
                    <x-ui.text class="opacity-60" size="xs">Infinitely many twin primes exist</x-ui.text>
                </x-ui.kanban.card>
                <x-ui.kanban.card>
                    <x-ui.text class="font-semibold text-sm">Goldbach's Conjecture</x-ui.text>
                    <x-ui.text class="opacity-60" size="xs">Every even integer > 2 is sum of two primes</x-ui.text>
                </x-ui.kanban.card>
                <x-ui.kanban.card>
                    <x-ui.text class="font-semibold text-sm">Riemann Hypothesis</x-ui.text>
                    <x-ui.text class="opacity-60" size="xs">Zeros of zeta function</x-ui.text>
                </x-ui.kanban.card>
            </x-ui.kanban.cards>
        </x-ui.kanban.column>
        <!--  -->
        <x-ui.kanban.column class="[--column-width:28rem]">
            <x-ui.kanban.header :count="5">
                <x-ui.heading>Proof Techniques</x-ui.heading>
            </x-ui.kanban.header>
            <!--  -->
            <x-ui.kanban.cards>
                <x-ui.kanban.card>
                    <x-ui.text class="font-semibold text-sm">Proof by Contradiction</x-ui.text>
                    <x-ui.text class="opacity-60" size="xs">Assume negation leads to impossibility</x-ui.text>
                </x-ui.kanban.card>
                <x-ui.kanban.card>
                    <x-ui.text class="font-semibold text-sm">Mathematical Induction</x-ui.text>
                    <x-ui.text class="opacity-60" size="xs">Base case + inductive step</x-ui.text>
                </x-ui.kanban.card>
                <x-ui.kanban.card>
                    <x-ui.text class="font-semibold text-sm">Direct Proof</x-ui.text>
                    <x-ui.text class="opacity-60" size="xs">Logical chain from hypothesis to conclusion</x-ui.text>
                </x-ui.kanban.card>
                <x-ui.kanban.card>
                    <x-ui.text class="font-semibold text-sm">Proof by Contrapositive</x-ui.text>
                    <x-ui.text class="opacity-60" size="xs">Prove ¬Q → ¬P instead of P → Q</x-ui.text>
                </x-ui.kanban.card>
                <x-ui.kanban.card>
                    <x-ui.text class="font-semibold text-sm">Proof by Cases</x-ui.text>
                    <x-ui.text class="opacity-60" size="xs">Exhaust all possibilities</x-ui.text>
                </x-ui.kanban.card>
            </x-ui.kanban.cards>
        </x-ui.kanban.column>
    </x-ui.kanban>
</x-demo>
@endblade

```blade
<!-- Narrow columns (18rem) -->
<x-ui.kanban class="[--column-width:18rem]">
    <!-- Columns will be 18rem wide -->
</x-ui.kanban>

<!-- Wide columns (24rem) -->
<x-ui.kanban class="[--column-width:28rem]">
    <!-- Columns will be 28rem wide -->
</x-ui.kanban>

<!-- (20rem is the default) -->
```


## Card Variations

### Card with Top and Bottom Slots

Add metadata above and below the main content, (this helps organize things out more than just optional):

@blade
<x-demo class="flex justify-center">
    <x-ui.kanban>
        <x-ui.kanban.column>
            <x-ui.kanban.header :count="5">
                <x-ui.heading>Complexity Classes</x-ui.heading>
            </x-ui.kanban.header>
            <!--  -->
            <x-ui.kanban.cards>
                <x-ui.kanban.card>
                    <x-slot:top>
                        <div class="flex items-center justify-between mb-2">
                            <x-ui.badge color="green" variant="outline" size="sm">P</x-ui.badge>
                            <x-ui.text size="xs" class="opacity-50">Polynomial time</x-ui.text>
                        </div>
                    </x-slot:top>
                    <div>
                        <x-ui.text class="font-semibold">P vs NP Problem</x-ui.text>
                        <x-ui.text size="sm" class="opacity-60">
                            Can every problem whose solution can be verified quickly also be solved quickly?
                        </x-ui.text>
                    </div>
                    <!--  -->
                    <x-slot:bottom>
                        <div class="flex items-center justify-between mt-3 pt-3 border-t border-neutral-200 dark:border-neutral-800">
                            <x-ui.text size="xs" class="opacity-60">Stephen Cook (1971)</x-ui.text>
                            <div class="flex items-center gap-1">
                                <svg class="size-3 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <x-ui.text size="xs" class="opacity-50">Millennium Prize</x-ui.text>
                            </div>
                        </div>
                    </x-slot:bottom>
                </x-ui.kanban.card>
                <!--  -->
                <x-ui.kanban.card>
                    <x-slot:top>
                        <div class="flex items-center justify-between mb-2">
                            <x-ui.badge color="blue" variant="outline" size="sm">NP</x-ui.badge>
                            <x-ui.text size="xs" class="opacity-50">Nondeterministic polynomial</x-ui.text>
                        </div>
                    </x-slot:top>
                    <!--  -->
                    <div>
                        <x-ui.text class="font-semibold">Traveling Salesman</x-ui.text>
                        <x-ui.text size="sm" class="opacity-60">
                            Find shortest route visiting all cities exactly once
                        </x-ui.text>
                    </div>
                    <!--  -->
                    <x-slot:bottom>
                        <div class="flex items-center justify-between mt-3 pt-3 border-t border-neutral-200 dark:border-neutral-800">
                            <x-ui.text size="xs" class="opacity-60">Classic NP-Complete</x-ui.text>
                            <x-ui.text size="xs" class="opacity-50">Graph Theory</x-ui.text>
                        </div>
                    </x-slot:bottom>
                </x-ui.kanban.card>
            </x-ui.kanban.cards>
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
            <x-ui.text size="xs">Polynomial time</x-ui.text>
        </div>
    </x-slot:top>
    
    <!-- Main card content -->
    <div>
        <x-ui.text class="font-semibold">P vs NP Problem</x-ui.text>
        <x-ui.text size="sm">Description here</x-ui.text>
    </div>
    
    <x-slot:bottom>
        <!-- Content below main card content -->
        <div class="flex items-center justify-between mt-3">
            <x-ui.text size="xs">Stephen Cook (1971)</x-ui.text>
            <x-ui.text size="xs">Millennium Prize</x-ui.text>
        </div>
    </x-slot:bottom>
</x-ui.kanban.card>
```

### Card Size Variants

Adjust card padding with size variants, use them as your condesing more contents :

@blade
<x-demo class="flex justify-center">
    <x-ui.kanban>
        <x-ui.kanban.column size="xs">
            <x-ui.kanban.header :count="3">
                <x-ui.heading>Extra Small</x-ui.heading>
            </x-ui.kanban.header>
            <!--  -->
            <x-ui.kanban.cards>
                <x-ui.kanban.card>
                    <h4 class="text-xs font-medium">Axiom of Extensionality</h4>
                </x-ui.kanban.card>
                <x-ui.kanban.card>
                    <h4 class="text-xs font-medium">Axiom of Pairing</h4>
                </x-ui.kanban.card>
                <x-ui.kanban.card>
                    <h4 class="text-xs font-medium">Axiom of Union</h4>
                </x-ui.kanban.card>
            </x-ui.kanban.cards>
        </x-ui.kanban.column>
        <!--  -->
        <x-ui.kanban.column size="sm">
            <x-ui.kanban.header :count="3">
                <x-ui.heading>Small</x-ui.heading>
            </x-ui.kanban.header>
            <!--  -->
            <x-ui.kanban.cards>
                <x-ui.kanban.card>
                    <h4 class="text-sm font-medium">Identity Element</h4>
                    <p class="text-xs text-neutral-600 dark:text-neutral-400">a + 0 = a</p>
                </x-ui.kanban.card>
                <x-ui.kanban.card>
                    <h4 class="text-sm font-medium">Inverse Element</h4>
                    <p class="text-xs text-neutral-600 dark:text-neutral-400">a + (-a) = 0</p>
                </x-ui.kanban.card>
                <x-ui.kanban.card>
                    <h4 class="text-sm font-medium">Associativity</h4>
                    <p class="text-xs text-neutral-600 dark:text-neutral-400">(a+b)+c = a+(b+c)</p>
                </x-ui.kanban.card>
            </x-ui.kanban.cards>
        </x-ui.kanban.column>
        <!--  -->
        <x-ui.kanban.column size="md">
            <x-ui.kanban.header :count="3">
                <x-ui.heading>Medium (Default)</x-ui.heading>
            </x-ui.kanban.header>
            <!--  -->
            <x-ui.kanban.cards>
                <x-ui.kanban.card>
                    <h4 class="font-medium">Cauchy Sequence</h4>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">For all ε > 0, there exists N such that |aₙ - aₘ| < ε for n,m > N</p>
                </x-ui.kanban.card>
                <x-ui.kanban.card>
                    <h4 class="font-medium">Limit Definition</h4>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">lim f(x) = L if for all ε > 0, exists δ > 0</p>
                </x-ui.kanban.card>
                <x-ui.kanban.card>
                    <h4 class="font-medium">Continuity</h4>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">f continuous at c if lim[x→c] f(x) = f(c)</p>
                </x-ui.kanban.card>
            </x-ui.kanban.cards>
        </x-ui.kanban.column>
    </x-ui.kanban>
</x-demo>
@endblade

```blade
<!-- Extra small cards -->
<x-ui.kanban.column size="xs">
    <x-ui.kanban.header>
        <x-ui.heading>Tasks</x-ui.heading>
    </x-ui.kanban.header>
    
    <x-ui.kanban.cards>
        <x-ui.kanban.card>
            <h4 class="text-xs">Compact card</h4>
        </x-ui.kanban.card>
    </x-ui.kanban.cards>
</x-ui.kanban.column>

<!-- Small cards -->
<x-ui.kanban.column size="sm">
    <x-ui.kanban.header>
        <x-ui.heading>Tasks</x-ui.heading>
    </x-ui.kanban.header>
    
    <x-ui.kanban.cards>
        <x-ui.kanban.card>
            <h4 class="text-sm">Small card</h4>
        </x-ui.kanban.card>
    </x-ui.kanban.cards>
</x-ui.kanban.column>

<!-- Medium cards (default) -->
<x-ui.kanban.column>
    <x-ui.kanban.header>
        <x-ui.heading>Tasks</x-ui.heading>
    </x-ui.kanban.header>
    
    <x-ui.kanban.cards>
        <x-ui.kanban.card>
            <h4>Medium card</h4>
        </x-ui.kanban.card>
    </x-ui.kanban.cards>
</x-ui.kanban.column>
```

## Empty States

Provide custom empty states for columns with no cards:

@blade
<x-demo class="flex justify-center">
    <x-ui.kanban>
        <x-ui.kanban.column>
            <x-ui.kanban.header>
                <x-ui.heading>Unsolved Problems</x-ui.heading>
            </x-ui.kanban.header>
            
            <x-ui.kanban.cards>
                <x-slot:empty>
                    <div class="py-8 text-center">
                        <svg class="mx-auto size-12 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                        <h4 class="mt-4 font-medium text-neutral-900 dark:text-neutral-100">No unsolved problems</h4>
                        <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                            All mathematical problems have been solved!
                        </p>
                        <button class="mt-4 px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Propose New Problem
                        </button>
                    </div>
                </x-slot:empty>
            </x-ui.kanban.cards>
        </x-ui.kanban.column>
    </x-ui.kanban>
</x-demo>
@endblade

```blade
<x-ui.kanban.column>
    <x-ui.kanban.header>
        <x-ui.heading>Column Name</x-ui.heading>
    </x-ui.kanban.header>
    
    <x-ui.kanban.cards>
        <x-slot:empty>
            <!-- Your custom empty state -->
            <div class="py-8 text-center">
                <svg class="mx-auto size-12 text-neutral-400">...</svg>
                <h4 class="mt-4 font-medium">No items yet</h4>
                <p class="mt-1 text-sm text-neutral-600">Add your first item to get started</p>
            </div>
        </x-slot:empty>
    </x-ui.kanban.cards>
</x-ui.kanban.column>
```

---

## Column Footers

Add interactive elements to column footers:

@blade
<x-demo class="flex justify-center">
    <x-ui.kanban>
        <x-ui.kanban.column>
            <x-ui.kanban.header :count="6">
                <x-ui.heading>Open Problems</x-ui.heading>
            </x-ui.kanban.header>
            
            <x-ui.kanban.cards>
                <x-ui.kanban.card>
                    <h4 class="font-medium">Riemann Hypothesis</h4>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Zeros of the Riemann zeta function</p>
                </x-ui.kanban.card>
                
                <x-ui.kanban.card>
                    <h4 class="font-medium">Navier-Stokes Existence</h4>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Smooth solutions for 3D fluid equations</p>
                </x-ui.kanban.card>
                
                <x-ui.kanban.card>
                    <h4 class="font-medium">Birch and Swinnerton-Dyer</h4>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Elliptic curves and L-functions</p>
                </x-ui.kanban.card>
                
                <x-ui.kanban.card>
                    <h4 class="font-medium">Hodge Conjecture</h4>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Algebraic cycles in algebraic geometry</p>
                </x-ui.kanban.card>
                
                <x-ui.kanban.card>
                    <h4 class="font-medium">Yang-Mills Theory</h4>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Mass gap in quantum field theory</p>
                </x-ui.kanban.card>
                
                <x-ui.kanban.card>
                    <h4 class="font-medium">P vs NP</h4>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Computational complexity classes</p>
                </x-ui.kanban.card>
            </x-ui.kanban.cards>
            
            <x-slot:footer>
                <div class="space-y-2">
                    <input 
                        type="text" 
                        placeholder="Add a new millennium problem..." 
                        class="w-full px-3 py-2 text-sm bg-white dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 px-3 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Add Problem
                        </button>
                        <button type="button" class="px-3 py-2 text-sm border border-neutral-300 dark:border-neutral-600 rounded-lg hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-colors">
                            Import
                        </button>
                    </div>
                </div>
            </x-slot:footer>
        </x-ui.kanban.column>
    </x-ui.kanban>
</x-demo>
@endblade

```blade
<x-ui.kanban.column>
    <x-ui.kanban.header>
        <x-ui.heading>Tasks</x-ui.heading>
    </x-ui.kanban.header>
    
    <x-ui.kanban.cards>
        <!-- Cards go here -->
    </x-ui.kanban.cards>
    
    <x-slot:footer>
        <!-- Footer content with form -->
        <div class="space-y-2">
            <input 
                type="text" 
                placeholder="Add new item..." 
                class="w-full px-3 py-2 text-sm border rounded-lg"
            >
            <button class="w-full px-3 py-2 text-sm bg-blue-600 text-white rounded-lg">
                Add Item
            </button>
        </div>
    </x-slot:footer>
</x-ui.kanban.column>
```

---
## Complete Example

Here's a comprehensive example showcasing all features:

@blade
<x-demo class="flex justify-center">
    <x-ui.kanban class="[--column-width:24rem]">
        <!-- Conjectures Column -->
        <x-ui.kanban.column id="conjectures">
            <x-ui.kanban.header :count="4">
                <x-ui.heading>Conjectures</x-ui.heading>
                <x-ui.text>Unproven statements</x-ui.text>
            </x-ui.kanban.header>
            
            <x-ui.kanban.cards>
                <x-ui.kanban.card>
                    <x-slot:top>
                        <div class="flex items-center gap-2 mb-2">
                            <x-ui.badge color="purple" size="sm">Number Theory</x-ui.badge>
                            <x-ui.badge color="amber" size="sm" variant="outline">1742</x-ui.badge>
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
                                <div class="size-6 rounded-full bg-blue-100 dark:bg-blue-900/30 border-2 border-white dark:border-neutral-900 flex items-center justify-center text-xs font-medium">
                                    CG
                                </div>
                                <div class="size-6 rounded-full bg-green-100 dark:bg-green-900/30 border-2 border-white dark:border-neutral-900 flex items-center justify-center text-xs font-medium">
                                    LE
                                </div>
                            </div>
                            <div class="text-xs text-neutral-500">Verified to 4×10¹⁸</div>
                        </div>
                    </x-slot:bottom>
                </x-ui.kanban.card>
                
                <x-ui.kanban.card>
                    <x-slot:top>
                        <div class="flex items-center gap-2 mb-2">
                            <x-ui.badge color="blue" size="sm">Topology</x-ui.badge>
                            <x-ui.badge color="amber" size="sm" variant="outline">1904</x-ui.badge>
                        </div>
                    </x-slot:top>
                    
                    <div>
                        <h4 class="font-medium">Poincaré Conjecture</h4>
                        <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                            Every simply connected 3-manifold is homeomorphic to the 3-sphere.
                        </p>
                    </div>
                    
                    <x-slot:bottom>
                        <div class="flex items-center justify-between mt-3 pt-3 border-t border-neutral-200 dark:border-neutral-800">
                            <span class="text-xs text-green-600 dark:text-green-400 font-medium">✓ Proven by Perelman (2003)</span>
                        </div>
                    </x-slot:bottom>
                </x-ui.kanban.card>
                
                <x-ui.kanban.card>
                    <x-slot:top>
                        <div class="flex items-center gap-2 mb-2">
                            <x-ui.badge color="indigo" size="sm">Analysis</x-ui.badge>
                            <x-ui.badge color="amber" size="sm" variant="outline">1859</x-ui.badge>
                        </div>
                    </x-slot:top>
                    
                    <div>
                        <h4 class="font-medium">Riemann Hypothesis</h4>
                        <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                            All non-trivial zeros of the zeta function have real part equal to 1/2.
                        </p>
                    </div>
                    
                    <x-slot:bottom>
                        <div class="flex items-center justify-between mt-3 pt-3 border-t border-neutral-200 dark:border-neutral-800">
                            <div class="flex -space-x-2">
                                <div class="size-6 rounded-full bg-purple-100 dark:bg-purple-900/30 border-2 border-white dark:border-neutral-900 flex items-center justify-center text-xs font-medium">
                                    BR
                                </div>
                            </div>
                            <div class="text-xs text-neutral-500">$1M Prize</div>
                        </div>
                    </x-slot:bottom>
                </x-ui.kanban.card>
                
                <x-ui.kanban.card>
                    <x-slot:top>
                        <div class="flex items-center gap-2 mb-2">
                            <x-ui.badge color="pink" size="sm">Graph Theory</x-ui.badge>
                            <x-ui.badge color="amber" size="sm" variant="outline">1852</x-ui.badge>
                        </div>
                    </x-slot:top>
                    
                    <div>
                        <h4 class="font-medium">Four Color Theorem</h4>
                        <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                            Any map can be colored with four colors so no adjacent regions share a color.
                        </p>
                    </div>
                    
                    <x-slot:bottom>
                        <div class="flex items-center justify-between mt-3 pt-3 border-t border-neutral-200 dark:border-neutral-800">
                            <span class="text-xs text-green-600 dark:text-green-400 font-medium">✓ Proven (1976)</span>
                            <span class="text-xs text-neutral-500">Computer-assisted</span>
                        </div>
                    </x-slot:bottom>
                </x-ui.kanban.card>
            </x-ui.kanban.cards>
        </x-ui.kanban.column>
        
        <!-- Under Review Column -->
        <x-ui.kanban.column id="review">
            <x-slot:header>
                <div class="p-4 border-b border-neutral-200 dark:border-neutral-800">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="size-3 rounded-full bg-blue-500 animate-pulse"></div>
                            <div>
                                <h3 class="font-semibold">Under Review</h3>
                                <p class="text-sm text-neutral-600 dark:text-neutral-400">Peer verification in progress</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-full">
                            3 active
                        </span>
                    </div>
                </div>
            </x-slot:header>
            
            <x-ui.kanban.cards>
                <x-ui.kanban.card>
                    <div class="space-y-2">
                        <div class="flex items-start justify-between">
                            <h4 class="font-medium">Twin Prime Conjecture</h4>
                            <x-ui.badge color="blue" size="sm">Zhang</x-ui.badge>
                        </div>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">
                            Bounded gaps between primes (2013)
                        </p>
                        <div class="pt-2">
                            <div class="flex items-center justify-between text-xs text-neutral-600 dark:text-neutral-400 mb-1">
                                <span>Verification progress</span>
                                <span>85%</span>
                            </div>
                            <div class="h-1.5 bg-neutral-200 dark:bg-neutral-800 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-500" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                </x-ui.kanban.card>
                
                <x-ui.kanban.card>
                    <div class="space-y-2">
                        <div class="flex items-start justify-between">
                            <h4 class="font-medium">abc Conjecture Proof</h4>
                            <x-ui.badge color="purple" size="sm">Mochizuki</x-ui.badge>
                        </div>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">
                            Inter-universal Teichmüller theory
                        </p>
                        <div class="pt-2">
                            <div class="flex items-center justify-between text-xs text-neutral-600 dark:text-neutral-400 mb-1">
                                <span>Verification progress</span>
                                <span>60%</span>
                            </div>
                            <div class="h-1.5 bg-neutral-200 dark:bg-neutral-800 rounded-full overflow-hidden">
                                <div class="h-full bg-purple-500" style="width: 60%"></div>
                            </div>
                        </div>
                    </div>
                </x-ui.kanban.card>
                
                <x-ui.kanban.card>
                    <div class="space-y-2">
                        <div class="flex items-start justify-between">
                            <h4 class="font-medium">Collatz Conjecture Analysis</h4>
                            <x-ui.badge color="green" size="sm">Tao</x-ui.badge>
                        </div>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">
                            Almost all orbits attain small values
                        </p>
                        <div class="pt-2">
                            <div class="flex items-center justify-between text-xs text-neutral-600 dark:text-neutral-400 mb-1">
                                <span>Verification progress</span>
                                <span>92%</span>
                            </div>
                            <div class="h-1.5 bg-neutral-200 dark:bg-neutral-800 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500" style="width: 92%"></div>
                            </div>
                        </div>
                    </div>
                </x-ui.kanban.card>
            </x-ui.kanban.cards>
        </x-ui.kanban.column>
        
        <!-- Proven Theorems Column -->
        <x-ui.kanban.column id="proven">
            <x-ui.kanban.header :count="0">
                <x-ui.heading>Proven Theorems</x-ui.heading>
            </x-ui.kanban.header>
            
            <x-ui.kanban.cards>
                <x-slot:empty>
                    <div class="text-center py-8">
                        <svg class="mx-auto size-12 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h4 class="mt-4 font-medium text-neutral-900 dark:text-neutral-100">Awaiting verification</h4>
                        <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                            Proofs will appear here once peer-reviewed
                        </p>
                    </div>
                </x-slot:empty>
            </x-ui.kanban.cards>
        </x-ui.kanban.column>
    </x-ui.kanban>
</x-demo>
@endblade

--- 

## Component Props

### ui.kanban

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `size` | string | `'md'` | Board size variant |
| `class` | string | - | Additional CSS classes |
| `--column-width` | CSS var | `20rem` | Width of each column (use arbitrary values like `[--column-width:24rem]`) |

### ui.kanban.column

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `id` | string | `null` | Unique identifier for the column |
| `size` | string | `'md'` | Size variant (inherited from board or set explicitly) |
| `header` | slot | - | Custom header content (replaces default header) |
| `footer` | slot | - | Footer content at bottom of column |

### ui.kanban.header

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `count` | number | `null` | Item count badge (displayed in header) |

### ui.kanban.cards

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `empty` | slot | - | Custom empty state when no cards present |

### ui.kanban.card

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `id` | string | `null` | Unique identifier for the card |
| `size` | string | `'md'` | Size variant: `'xs'`, `'sm'`, `'md'` (inherited from column or set explicitly) |
| `top` | slot | - | Content above main card content |
| `bottom` | slot | - | Content below main card content |
| `handle` | slot | - | Drag handle (shown on hover, positioned top-left) |

---

## Component Structure

The kanban component consists of five parts:

**Board** (`<x-ui.kanban>`) - Container that manages the horizontal scrolling layout and column sizing

**Column** (`<x-ui.kanban.column>`) - Vertical container for cards with optional header and footer

**Header** (`<x-ui.kanban.header>`) - Column header with optional count badge

**Cards** (`<x-ui.kanban.cards>`) - Container for card items with optional empty state

**Card** (`<x-ui.kanban.card>`) - Individual item container with slots for top/bottom metadata and drag handles