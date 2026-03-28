---
name: 'repeater'
---

## Introduction

The **Repeater** component provides a dynamic, UUID-based solution for managing collections of form items. Perfect for product variants, contact lists, line items, or any scenario where users need to add, remove, and duplicate related entries. Built natively for Livewire, state lives in a typed `Repeater` property backed by a custom Synthesizer, so it feels like a first-class Livewire citizen.

## Installation

```bash
php artisan sheaf:install repeater
```

> Once installed, you can use `<x-ui.repeater />` and `<x-ui.repeater.item />` in any Blade view, and the `Repeater` and `RepeaterSynthesizer` classes are available in your application.

Then register the synthesizer in your service provider so Livewire knows how to serialize the `Repeater` object between requests:

```php
use Livewire\Livewire;
use App\Livewire\Synthesizers\RepeaterSynthesizer;

public function boot(): void
{
    Livewire::propertySynthesizer(RepeaterSynthesizer::class);
}
```

## Basic Structure

The repeater component is a visual wrapper. State lives in your Livewire component as a typed `Repeater`.

@blade
<x-demo class="flex justify-center">
    <div class="max-w-2xl w-full">
        <x-ui.text class="mb-4 text-center opacity-70">
            Visual example only. See the implementation guide below for a working demo.
        </x-ui.text>
        <x-ui.repeater class="[&_button]:pointer-events-none">
            <x-ui.repeater.item
                uuid="uuid-123"
                deleteHandler="deleteItem('uuid-123')"
                duplicateHandler="duplicateItem('uuid-123')"
            >
                <div class="space-y-4">
                    <x-ui.field>
                        <x-ui.label text="Item Name"/>
                        <x-ui.input placeholder="Enter name..." />
                    </x-ui.field>
                    <x-ui.field>
                        <x-ui.label text="Description"/>
                        <x-ui.textarea placeholder="Enter description..." />
                    </x-ui.field>
                </div>
            </x-ui.repeater.item>
            <x-ui.repeater.item
                uuid="uuid-456"
                deleteHandler="deleteItem('uuid-456')"
                duplicateHandler="duplicateItem('uuid-456')"
            >
                <div class="space-y-4">
                    <x-ui.field>
                        <x-ui.label text="Item Name"/>
                        <x-ui.input placeholder="Enter name..." />
                    </x-ui.field>
                    <x-ui.field>
                        <x-ui.label text="Description"/>
                        <x-ui.textarea placeholder="Enter description..." />
                    </x-ui.field>
                </div>
            </x-ui.repeater.item>
            <x-slot:actions>
                <x-ui.button variant="outline" icon="plus">Add Item</x-ui.button>
            </x-slot:actions>
        </x-ui.repeater>
    </div>
</x-demo>
@endblade

```blade
<x-ui.repeater>
    @foreach ($variants->all() as $uuid => $item)
        <x-ui.repeater.item
            wire:key="item-{{ $uuid }}"
            deleteHandler="deleteVariant('{{ $uuid }}')"
            duplicateHandler="duplicateVariant('{{ $uuid }}')"
        >
            <x-ui.field>
                <x-ui.label text="Item Name"/>
                <x-ui.input wire:model.live="variants.{{ $uuid }}.name" />
            </x-ui.field>
        </x-ui.repeater.item>
    @endforeach

    <x-slot:actions>
        <x-ui.button wire:click="addVariant" icon="plus">Add Item</x-ui.button>
    </x-slot:actions>
</x-ui.repeater>
```

## Repeater Actions

Action buttons are opt-in per item — pass `deleteHandler` and/or `duplicateHandler` directly on `<x-ui.repeater.item>`. Omit either prop and that button simply won't render. There's no toggle on the wrapper.

@blade
<x-demo class="flex flex-col gap-6 [&_button]:pointer-events-none">
    <div class="max-w-2xl w-full mx-auto">
        <x-ui.text class="mb-4 font-medium">Delete only</x-ui.text>
        <x-ui.repeater>
            <x-ui.repeater.item uuid="uuid-1" deleteHandler="deleteItem('uuid-1')">
                <x-ui.field>
                    <x-ui.input placeholder="Item with delete..." />
                </x-ui.field>
            </x-ui.repeater.item>
        </x-ui.repeater>
    </div>
    <div class="max-w-2xl w-full mx-auto">
        <x-ui.text class="mb-4 font-medium">Duplicate only</x-ui.text>
        <x-ui.repeater>
            <x-ui.repeater.item uuid="uuid-2" duplicateHandler="duplicateItem('uuid-2')">
                <x-ui.field>
                    <x-ui.input placeholder="Item with duplicate..." />
                </x-ui.field>
            </x-ui.repeater.item>
        </x-ui.repeater>
    </div>
    <div class="max-w-2xl w-full mx-auto">
        <x-ui.text class="mb-4 font-medium">Both actions</x-ui.text>
        <x-ui.repeater>
            <x-ui.repeater.item uuid="uuid-3" deleteHandler="deleteItem('uuid-3')" duplicateHandler="duplicateItem('uuid-3')">
                <x-ui.field>
                    <x-ui.input placeholder="Item with both actions..." />
                </x-ui.field>
            </x-ui.repeater.item>
        </x-ui.repeater>
    </div>
</x-demo>
@endblade

```blade
<!-- Delete only -->
<x-ui.repeater.item deleteHandler="deleteItem('{{ $uuid }}')">...</x-ui.repeater.item>

<!-- Duplicate only -->
<x-ui.repeater.item duplicateHandler="duplicateItem('{{ $uuid }}')">...</x-ui.repeater.item>

<!-- Both -->
<x-ui.repeater.item
    deleteHandler="deleteItem('{{ $uuid }}')"
    duplicateHandler="duplicateItem('{{ $uuid }}')"
>...</x-ui.repeater.item>
```

## Repeater Header

Add a header section for titles or instructions:

@blade
<x-demo class="flex justify-center [&_button]:pointer-events-none">
    <div class="max-w-2xl w-full">
        <x-ui.repeater>
            <x-slot:header class="pb-4 mb-4">
                <x-ui.heading>Product Variants</x-ui.heading>
                <x-ui.text class="opacity-70 mt-1">
                    Add different sizes, colors, or configurations of your product
                </x-ui.text>
            </x-slot:header>
            <x-ui.repeater.item
                uuid="uuid-789"
                deleteHandler="deleteVariant('uuid-789')"
                duplicateHandler="duplicateVariant('uuid-789')"
            >
                <x-ui.field>
                    <x-ui.input placeholder="Variant name..." />
                </x-ui.field>
            </x-ui.repeater.item>
            <x-slot:actions>
                <x-ui.button variant="outline" icon="plus">Add Variant</x-ui.button>
            </x-slot:actions>
        </x-ui.repeater>
    </div>
</x-demo>
@endblade

```blade
<x-ui.repeater>
{+    <x-slot:header class="pb-4">
        <x-ui.heading>Product Variants</x-ui.heading>
        <x-ui.text class="opacity-70">Add different configurations</x-ui.text>
    </x-slot:header>+}

    <!-- items -->
</x-ui.repeater>
```

## Item Footer

Add per-item actions or metadata using the `footer` slot:

@blade
<x-demo class="flex justify-center [&_button]:pointer-events-none">
    <div class="max-w-2xl w-full">
        <x-ui.repeater>
            <x-ui.repeater.item uuid="uuid-abc" deleteHandler="deleteItem('uuid-abc')">
                <x-ui.field>
                    <x-ui.label text="Task"/>
                    <x-ui.input placeholder="Task description..." />
                </x-ui.field>
                <x-slot:footer class="mt-4 pt-2 border-t border-neutral-200 dark:border-white/10">
                    <x-ui.button size="sm" variant="soft" icon="clock">Set Deadline</x-ui.button>
                    <x-ui.button size="sm" variant="soft" icon="tag">Add Tags</x-ui.button>
                </x-slot:footer>
            </x-ui.repeater.item>
            <x-slot:actions>
                <x-ui.button variant="outline" icon="plus">Add Task</x-ui.button>
            </x-slot:actions>
        </x-ui.repeater>
    </div>
</x-demo>
@endblade

```blade
<x-ui.repeater.item
    deleteHandler="deleteItem('{{ $uuid }}')"
    duplicateHandler="duplicateItem('{{ $uuid }}')"
>
    <!-- item content -->

{+   <x-slot:footer class="mt-4 pt-2 border-t border-neutral-200 dark:border-white/10">
        <x-ui.button size="sm" variant="soft" icon="clock">Set Deadline</x-ui.button>
        <x-ui.button size="sm" variant="soft" icon="tag">Add Tags</x-ui.button>
    </x-slot:footer>+}
</x-ui.repeater.item>
```

## Implementation Guide

This guide shows you how to build a fully functional repeater for managing product variants with validation and persistence.

@blade
<x-md.cta
    href="/demos/repeater"
    label="See the repeater in action with full functionality"
    ctaLabel="Visit Live Demo"
/>
@endblade

### Overview

We'll build a repeater that:
- **Manages product variants** with name, SKU, price, stock, and description
- **Generates unique SKUs** automatically for each new item and on duplication
- **Validates all fields** before saving with clean, readable error messages
- **Adds, removes, and duplicates items** 

### Step 1: Create Your Livewire Component

Declare a typed `Repeater` property and initialize it in `mount()` using `Repeater::mount()`. The factory callable is called fresh per item — so if your structure includes generated values like SKUs, each item gets its own on creation. The synthesizer persists the resolved factory alongside items, so `add()` always has it available after hydration.

```php
<?php

namespace App\Livewire;

use App\View\Components\Repeater;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class ProductVariants extends Component
{
    public Repeater $variants;

    public function mount(): void
    {
        $this->variants = Repeater::mount(
            count: 2,
            factory: fn() => $this->variantsStructure(),
        );
    }

    protected function variantsStructure(): array
    {
        return [
            'name'        => '',
            'sku'         => $this->generateSKU(),
            'price'       => 0,
            'stock'       => 0,
            'description' => '',
        ];
    }

    public function addVariant(): void
    {
        $uuid = $this->variants->add();
        $this->variants->tap($uuid, ['sku' => $this->generateSKU()]);
    }

    public function deleteVariant(string $uuid): void
    {
        $this->variants->delete($uuid);
    }

    public function duplicateVariant(string $uuid): void
    {
        $newUuid = $this->variants->duplicate($uuid);
        $this->variants->tap($newUuid, ['sku' => $this->generateSKU()]);
    }

    public function save(): void
    {
        $this->validate(
            rules: [
                'variants.*.name'        => 'required|string|max:255',
                'variants.*.sku'         => 'required|string',
                'variants.*.price'       => 'required|numeric|min:0',
                'variants.*.stock'       => 'required|integer|min:0',
                'variants.*.description' => 'required|min:10',
            ],
            attributes: [
                'variants.*.name'        => 'name',
                'variants.*.sku'         => 'sku',
                'variants.*.price'       => 'price',
                'variants.*.stock'       => 'stock',
                'variants.*.description' => 'description',
            ]
        );

        $data = $this->variants->values(); // flat array, ready for Eloquent
    }

    public function render(): View
    {
        return view('livewire.product-variants');
    }

    private function generateSKU(): string
    {
        return 'SKU-' . mb_strtoupper(Str::random(8));
    }
}
```

**Key points:**
- `Repeater::mount()` only runs on the first request — on subsequent requests the synthesizer restores state from JSON and `mount()` is never called again
- The `factory` callable is invoked fresh per item at mount time, so each item gets its own generated values (like unique SKUs) from the start
- `addVariant()` calls `tap()` after `add()` to stamp a fresh SKU on the new item — since the stored factory is a resolved snapshot, generated values like SKUs would otherwise repeat
- `duplicateVariant()` does the same: duplicate preserves the source item's data exactly, then `tap()` gives the copy a new unique SKU
- The `attributes` map in `validate()` strips the `variants.uuid.field` path down to just `field` in error messages — without it, validation errors read like database column names
- `$this->variants->values()` returns a flat array without UUID keys, ready for validation and persistence

### Step 2: Create the View

Wire `deleteHandler` and `duplicateHandler` on each item by interpolating the UUID into the method call string. Use `<x-ui.error>` with the `:name` prop to display field-level validation errors scoped to each UUID.

```blade
<div>
    <x-ui.repeater>
        <x-slot:header class="pb-4">
            <x-ui.heading>Product Variants</x-ui.heading>
            <x-ui.text class="opacity-70 mt-1">
                Add different sizes, colors, or configurations
            </x-ui.text>
        </x-slot:header>

        @foreach ($variants->all() as $uuid => $item)
            <x-ui.repeater.item
                wire:key="item-{{ $uuid }}"
                deleteHandler="deleteVariant('{{ $uuid }}')"
                duplicateHandler="duplicateVariant('{{ $uuid }}')"
            >
                <div class="space-y-4">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                        <x-ui.field required>
                            <x-ui.label text="Variant Name"/>
                            <x-ui.input
                                wire:model.live="variants.{{ $uuid }}.name"
                                placeholder="e.g., Red Small"
                            />
                            <x-ui.error :name="'variants.' . $uuid . '.name'" />
                        </x-ui.field>

                        <x-ui.field required>
                            <x-ui.label text="SKU"/>
                            <x-ui.input
                                wire:model.live="variants.{{ $uuid }}.sku"
                                placeholder="SKU-XXXXXXXX"
                                readonly
                            />
                            <x-ui.error :name="'variants.' . $uuid . '.sku'" />
                        </x-ui.field>

                        <x-ui.field required>
                            <x-ui.label text="Price"/>
                            <x-ui.input
                                wire:model.live="variants.{{ $uuid }}.price"
                                type="number"
                                step="0.01"
                                placeholder="0.00"
                            />
                            <x-ui.error :name="'variants.' . $uuid . '.price'" />
                        </x-ui.field>

                        <x-ui.field required>
                            <x-ui.label text="Stock"/>
                            <x-ui.input
                                wire:model.live="variants.{{ $uuid }}.stock"
                                type="number"
                                placeholder="0"
                            />
                            <x-ui.error :name="'variants.' . $uuid . '.stock'" />
                        </x-ui.field>
                    </div>

                    <x-ui.field required>
                        <x-ui.label text="Description"/>
                        <x-ui.textarea
                            wire:model.live="variants.{{ $uuid }}.description"
                            placeholder="Describe this product variant"
                        />
                        <x-ui.error :name="'variants.' . $uuid . '.description'" />
                    </x-ui.field>
                </div>
            </x-ui.repeater.item>
        @endforeach

        <x-slot:actions>
            <x-ui.button
                variant="outline"
                class="rounded-box"
                icon="plus"
                wire:click="addVariant"
            >
                Add product variant
            </x-ui.button>
        </x-slot:actions>
    </x-ui.repeater>

    <div class="mt-6 flex justify-end">
        <x-ui.button wire:click="save" variant="primary" class="rounded-box" size="lg">
            Save
        </x-ui.button>
    </div>
</div>
```

**Key points:**
- `$variants->all()` returns the UUID-keyed array for the `@foreach`

- `<x-ui.error :name="'variants.' . $uuid . '.name'" />` scopes each error to the right item — the UUID in the key is what makes that work

- `deleteHandler` and `duplicateHandler` are plain Livewire action strings — the item component renders a button with `wire:click` set to exactly this value

### How It Works

**Mount vs hydration:** `Repeater::mount()` runs once inside your component's `mount()`. From that point on, the synthesizer takes over — on every subsequent request it calls `Repeater::from($state)` to restore the full instance from the JSON snapshot, and `mount()` is never called again.

**Factory persistence:** The resolved factory array is stored as a `public` property on `Repeater`, so the synthesizer includes it in the dehydrated state automatically. This means `add()` always has the blank-item template available without any extra wiring or `boot()` hook. For values that need to be unique per item (like SKUs), generate them after `add()` using `tap()`.

**`wire:model` binding:** `variants.{uuid}.name` is resolved by `RepeaterSynthesizer::get()` and `set()`, which delegate to `Repeater::getItem()` and `Repeater::setItem()`. This is identical to how Livewire's own synthesizer examples handle dot-notation property access.

**Validation:** `$this->validate(['variants.*.name' => '...'])` works because Livewire expands the synthesizer state for validation. The `*` wildcard matches every UUID key in the items array. The `attributes` map keeps error messages human-readable by stripping the UUID path.

## Multiple Repeaters

Because `Repeater` is a typed property rather than a shared trait, you can have as many repeaters as you need in one component — each is independently serialized:

```php
public Repeater $variants;
public Repeater $images;

public function mount(): void
{
    $this->variants = Repeater::mount(count: 1, factory: fn() => $this->variantsStructure());
    $this->images   = Repeater::mount(count: 1, factory: ['url' => '', 'alt' => '']);
}

public function addVariant(): void { $this->variants->add(); }
public function deleteVariant(string $uuid): void { $this->variants->delete($uuid); }

public function addImage(): void { $this->images->add(); }
public function deleteImage(string $uuid): void { $this->images->delete($uuid); }
```

Each property gets its own synthesizer snapshot — they don't interfere with each other.

## Component Props

### ui.repeater

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `header` | slot | `null` | Optional header section for title/description |
| `actions` | slot | `null` | Actions slot for the "Add Item" button or other controls |

### ui.repeater.item

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `uuid` | string | required | Unique identifier used to scope the item's DOM node via `wire:key` |
| `deleteHandler` | string | `null` | Livewire action string called when the delete button is clicked, e.g. `"deleteVariant('{{ $uuid }}')"` |
| `duplicateHandler` | string | `null` | Livewire action string called when the duplicate button is clicked |
| `footer` | slot | `null` | Optional per-item footer for extra actions or metadata |

## Component API

### `Repeater`

The core state container. Instantiated in `mount()` and serialized between requests by `RepeaterSynthesizer`.

| Method | Returns | Description |
|--------|---------|-------------|
| `Repeater::mount(int $count, array\|callable $factory)` | `Repeater` | Create a fresh repeater with `$count` blank items shaped by `$factory`. Pass a callable to get a fresh invocation per item. |
| `Repeater::from(array $state)` | `Repeater` | Restore from synthesizer state — used internally, not called directly |
| `add()` | `string` | Append a new blank item using the stored factory, returns its UUID |
| `delete(string $uuid)` | `void` | Remove an item by UUID |
| `duplicate(string $uuid)` | `string\|null` | Copy an existing item inline (preserving order), returns the new UUID or `null` if not found |
| `tap(string $uuid, array $overrides)` | `void` | Merge overrides into an existing item, use after `add()` or `duplicate()` to stamp unique values |
| `all()` | `array` | UUID-keyed items — use in Blade `@foreach` |
| `values()` | `array` | Flat array without UUID keys — use for saving and persistence |
| `collection()` | `Collection` | Same as `values()` wrapped in a Laravel Collection |
| `count()` | `int` | Number of items currently in the repeater |
| `getItem(string $uuid)` | `mixed` | Read an item by UUID — called by the synthesizer for `wire:model` |
| `setItem(string $uuid, mixed $value)` | `void` | Merge values into an item by UUID — called by the synthesizer for `wire:model` |
| `getState()` | `array` | Serializable state — used internally by the synthesizer |

### `RepeaterSynthesizer`

Handles Livewire's dehydration/hydration cycle for `Repeater` properties. No configuration needed beyond the one-time service provider registration.

```php
// AppServiceProvider::boot()
use App\Livewire\Synthesizers\RepeaterSynthesizer;
use Livewire\Livewire;

Livewire::propertySynthesizer(RepeaterSynthesizer::class);
```

> After registration, any Livewire component property typed as `Repeater` is automatically serialized between requests. The synthesizer also handles `wire:model` binding by routing `get` and `set` calls through `Repeater::getItem()` and `Repeater::setItem()` — you never interact with it directly.