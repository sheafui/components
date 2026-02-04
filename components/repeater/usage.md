---
name: 'repeater'
---

## Introduction

The **Repeater** component provides a dynamic, UUID-based solution for managing collections of form items. Perfect for product variants, contact lists, task items, or any scenario where users need to add, remove, and duplicate related data entries. Built with Livewire (pure blade sorry you need to wait, or you adapt the UI with your backend using js). it handles state management seamlessly.

## Installation

Use the Sheaf artisan command to install the repeater component:

```bash
php artisan sheaf:install repeater
```

> Once installed, you can use `<x-ui.repeater />` and `<x-ui.repeater.item />` components in any Blade view.

## Basic Structure

The repeater component is intentionally simple, it's just a visual wrapper. The magic happens in your Livewire component with the `HasRepeater` trait.

@blade
<x-demo class="flex justify-center">
    <div class="max-w-2xl w-full">
        <x-ui.text class="mb-4 text-center opacity-70">
            This is a visual example. isn't functional, See the implementation guide below for a working demo.
        </x-ui.text>
        <!--  -->
        <x-ui.repeater deletable duplicatable class="[&_button]:pointer-events-none">
            <x-ui.repeater.item uuid="uuid-123">
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
            <!--  -->
            <x-ui.repeater.item uuid="uuid-456">
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
            <!--  -->
            <x-slot:actions>
                <x-ui.button variant="outline" icon="plus">
                    Add Item
                </x-ui.button>
            </x-slot:actions>
        </x-ui.repeater>
    </div>
</x-demo>
@endblade

```blade
<x-ui.repeater deletable duplicatable>
    @foreach ($items as $uuid => $item)
        <x-ui.repeater.item wire:key="item-{{ $uuid }}" :$uuid>
            <div class="space-y-4">
                <x-ui.field>
                    <x-ui.label text="Item Name"/>
                    <x-ui.input wire:model="items.{{ $uuid }}.name" />
                </x-ui.field>
                <!-- more ... -->
            </div>
        </x-ui.repeater.item>
    @endforeach

    <x-slot:actions>
        <x-ui.button wire:click="addItem" icon="plus">
            Add Item
        </x-ui.button>
    </x-slot:actions>
</x-ui.repeater>
```


## Repeater Actions

Control which action buttons appear on each item:

@blade
<x-demo class="flex flex-col gap-6 [&_button]:pointer-events-none">
    <div class="max-w-2xl w-full mx-auto">
        <x-ui.text class="mb-4 font-medium">With Delete Only</x-ui.text>
        <x-ui.repeater deletable>
            <x-ui.repeater.item uuid="uuid-1">
                <x-ui.field>
                    <x-ui.input placeholder="Item with delete..." />
                </x-ui.field>
            </x-ui.repeater.item>
        </x-ui.repeater>
    </div>
    <!--  -->
    <div class="max-w-2xl w-full mx-auto">
        <x-ui.text class="mb-4 font-medium">With Duplicate Only</x-ui.text>
        <x-ui.repeater duplicatable>
            <x-ui.repeater.item uuid="uuid-2">
                <x-ui.field>
                    <x-ui.input placeholder="Item with duplicate..." />
                </x-ui.field>
            </x-ui.repeater.item>
        </x-ui.repeater>
    </div>
    <!--  -->
    <div class="max-w-2xl w-full mx-auto">
        <x-ui.text class="mb-4 font-medium">With Both Actions</x-ui.text>
        <x-ui.repeater deletable duplicatable>
            <x-ui.repeater.item uuid="uuid-3">
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
<x-ui.repeater deletable>
    <!-- items -->
</x-ui.repeater>

<!-- Duplicate only -->
<x-ui.repeater duplicatable>
    <!-- items -->
</x-ui.repeater>

<!-- Both actions -->
<x-ui.repeater deletable duplicatable>
    <!-- items -->
</x-ui.repeater>
```

## Repeater Header

Add a header section for titles, instructions, or summary information:

@blade
<x-demo class="flex justify-center [&_button]:pointer-events-none">
    <div class="max-w-2xl w-full">
        <x-ui.repeater deletable duplicatable>
            <x-slot:header class="pb-4 mb-4">
                <x-ui.heading>Product Variants</x-ui.heading>
                <x-ui.text class="opacity-70 mt-1">
                    Add different sizes, colors, or configurations of your product
                </x-ui.text>
            </x-slot:header>
            <!--  -->
            <x-ui.repeater.item uuid="uuid-789">
                <x-ui.field>
                    <x-ui.input placeholder="Variant name..." />
                </x-ui.field>
            </x-ui.repeater.item>
            <!--  -->
            <x-slot:actions>
                <x-ui.button variant="outline" icon="plus">
                    Add Variant
                </x-ui.button>
            </x-slot:actions>
        </x-ui.repeater>
    </div>
</x-demo>
@endblade

```blade
<x-ui.repeater>
{+    <x-slot:header class="pb-4">
        <x-ui.heading>Product Variants</x-ui.heading>
        <x-ui.text class="opacity-70">
            Add different configurations
        </x-ui.text>
    </x-slot:header>+}
    
    <!-- items -->
</x-ui.repeater>
```

## Repeater Item Actions

Add custom actions to individual items using the `actions` slot:

@blade
<x-demo class="flex justify-center [&_button]:pointer-events-none">
    <div class="max-w-2xl w-full">
        <x-ui.repeater deletable>
            <x-ui.repeater.item uuid="uuid-abc">
                <x-ui.field>
                    <x-ui.label text="Task"/>
                    <x-ui.input placeholder="Task description..." />
                </x-ui.field>
                <!--  -->
                <x-slot:footer class="mt-4 pt-2 border-t border-neutral-200 dark:border-white/10">
                    <x-ui.button size="sm" variant="soft" icon="clock">
                        Set Deadline
                    </x-ui.button>
                    <x-ui.button size="sm" variant="soft" icon="tag">
                        Add Tags
                    </x-ui.button>
                </x-slot:footer>
            </x-ui.repeater.item>
            <!--  -->
            <x-slot:actions>
                <x-ui.button variant="outline" icon="plus">
                    Add Task
                </x-ui.button>
            </x-slot:actions>
        </x-ui.repeater>
    </div>
</x-demo>
@endblade

```blade
<x-ui.repeater.item :$uuid>
    <!-- item content -->
    
{+    <x-slot:footer class="mt-4">
        <x-ui.button size="sm" icon="clock" variant="soft">
            Set Deadline
        </x-ui.button>
        <!-- ... -->
    </x-slot:footer>+}
</x-ui.repeater.item>
```

## Implementation Guide

This guide shows you how to build a fully functional repeater for managing product variants with validation, duplicate prevention, and database persistence.

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
- **Generates unique SKUs** automatically
- **Validates data** before saving
- **Handles existing data** for editing scenarios
- **Prevents duplicates** and maintains data integrity

### Step 1: Copy the HasRepeater Trait

The `HasRepeater` trait is included with your Sheaf UI purchase. Copy it to your project:

**app/Livewire/Concerns/HasRepeater.php:**

This trait is shipped with the repeater component files. Simply copy the `HasRepeater.php` file from the component package to your `app/Livewire/Concerns/` directory (create the directory if it doesn't exist).

The trait provides these key methods:
- `mountRepeater(int $initialCount)` - Initialize with empty items
- `addItem()` - Add a new item
- `deleteItem(string $uuid)` - Remove an item
- `duplicateItem(string $uuid)` - Duplicate an item
- `getItemsData()` - Get clean array for saving (without UUIDs)
- `getItemsCollection()` - Get items as a Laravel collection

And these hook methods you can override:
- `afterItemAdded(string $uuid)` - Called after adding an item
- `afterItemDeleted(string $uuid)` - Called after deleting an item
- `afterItemDuplicated(string $originalUuid, string $newUuid)` - Called after duplicating

### Step 2: Create Your Livewire Component

Create a component that uses the trait to manage product variants:

**app/Livewire/ProductVariants.php:**
```php
<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Livewire\Concerns\HasRepeater;

class ProductVariants extends Component
{
    use HasRepeater;

    public ?Product $product = null;

    public function mount(?Product $product = null): void
    {
        $this->product = $product;

        if ($product?->variants->isNotEmpty()) {
            // Load existing variants - map each variant to a UUID key
            $this->items = collect($product->variants)->mapWithKeys(function ($variant) {
                return [
                    $this->generateUuid() => $variant->toArray(),
                ];
            })->toArray();
        } else {
            // Start with one empty variant
            $this->mountRepeater(initialCount: 1);
        }
    }

    /**
     * Define the structure of each variant
     */
    protected function itemStructure(): array
    {
        return [
            'id' => null, // For tracking existing records
            'name' => '',
            'sku' => '', // Will be generated on add
            'price' => 0,
            'stock' => 0,
            'description' => '',
        ];
    }

    /**
     * Generate SKU after item is added
     */
    protected function afterItemAdded(string $uuid): void
    {
        $this->items[$uuid]['sku'] = $this->generateSKU();
    }

    /**
     * Generate new SKU when duplicating
     */
    protected function afterItemDuplicated(string $originalUuid, string $newUuid): void
    {
        // Clear the ID so it creates a new record
        $this->items[$newUuid]['id'] = null;
        // Generate new unique SKU
        $this->items[$newUuid]['sku'] = $this->generateSKU();
    }

    /**
     * Validate and save all variants
     */
    public function save(): void
    {
        $this->validate([
            'items.*.name' => 'required|string|max:255',
            'items.*.sku' => 'required|string|max:100',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.stock' => 'required|integer|min:0',
            'items.*.description' => 'nullable|string|max:1000',
        ]);

        $itemsData = $this->getItemsData();

        foreach ($itemsData as $variantData) {
            if (!empty($variantData['id'])) {
                // Update existing variant
                $this->product->variants()
                    ->find($variantData['id'])
                    ->update($variantData);
            } else {
                // Create new variant
                $this->product->variants()->create($variantData);
            }
        }

        session()->flash('message', 'Product variants saved successfully!');
        
        $this->redirect(route('products.show', $this->product));
    }

    /**
     * Generate unique SKU
     */
    private function generateSKU(): string
    {
        return 'SKU-' . strtoupper(Str::random(8));
    }

    public function render()
    {
        return view('livewire.product-variants');
    }
}
```

### Step 3: Create the View

Create the Blade template with the repeater component:

**resources/views/livewire/product-variants.blade.php:**
```blade
<div>
    <x-ui.repeater deletable duplicatable>
        <x-slot:header class="border-b pb-4">
            <x-ui.heading>Product Variants</x-ui.heading>
            <x-ui.text class="opacity-70 mt-1">
                Add different sizes, colors, or configurations for {{ $product->name }}
            </x-ui.text>
        </x-slot:header>

        @foreach ($items as $uuid => $item)
            <x-ui.repeater.item
                wire:key="item-{{ $uuid }}"
                :$uuid
            >
                <div class="space-y-4">
                    {{-- Main Fields Grid --}}
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                        <x-ui.field required>
                            <x-ui.label text="Variant Name"/>
                            <x-ui.input 
                                wire:model.blur="items.{{ $uuid }}.name"
                                placeholder="e.g., Red Small"
                            />
                            @error("items.{$uuid}.name")
                                <x-ui.error>{{ $message }}</x-ui.error>
                            @enderror
                        </x-ui.field>

                        <x-ui.field required>
                            <x-ui.label text="SKU"/>
                            <x-ui.input 
                                wire:model.blur="items.{{ $uuid }}.sku"
                                placeholder="SKU-XXXXXXXX"
                                readonly
                            />
                            @error("items.{$uuid}.sku")
                                <x-ui.error>{{ $message }}</x-ui.error>
                            @enderror
                            <x-ui.description>Auto-generated unique code</x-ui.description>
                        </x-ui.field>

                        <x-ui.field required>
                            <x-ui.label text="Price"/>
                            <x-ui.input 
                                wire:model.blur="items.{{ $uuid }}.price"
                                type="number"
                                step="0.01"
                                placeholder="0.00"
                            />
                            @error("items.{$uuid}.price")
                                <x-ui.error>{{ $message }}</x-ui.error>
                            @enderror
                        </x-ui.field>

                        <x-ui.field required>
                            <x-ui.label text="Stock"/>
                            <x-ui.input 
                                wire:model.blur="items.{{ $uuid }}.stock"
                                type="number"
                                placeholder="0"
                            />
                            @error("items.{$uuid}.stock")
                                <x-ui.error>{{ $message }}</x-ui.error>
                            @enderror
                        </x-ui.field>
                    </div>

                    {{-- Description --}}
                    <x-ui.field>
                        <x-ui.label text="Description"/>
                        <x-ui.textarea 
                            wire:model.blur="items.{{ $uuid }}.description"
                            placeholder="Describe this product variant..."
                            rows="3"
                        />
                        @error("items.{$uuid}.description")
                            <x-ui.error>{{ $message }}</x-ui.error>
                        @enderror
                    </x-ui.field>
                </div>
            </x-ui.repeater.item>
        @endforeach

        <x-slot:actions>
            <x-ui.button 
                wire:click="addItem"
                variant="outline"
                icon="plus"
                wire:loading.attr="disabled"
            >
                Add Variant
            </x-ui.button>
        </x-slot:actions>
    </x-ui.repeater>

    {{-- Save Button --}}
    <div class="mt-6 flex justify-end gap-3">
        <x-ui.button 
            wire:click="$dispatch('cancel')"
            variant="ghost"
        >
            Cancel
        </x-ui.button>
        
        <x-ui.button 
            wire:click="save"
            variant="primary"
            wire:loading.attr="disabled"
        >
            <span wire:loading.remove wire:target="save">Save Variants</span>
            <span wire:loading wire:target="save">Saving...</span>
        </x-ui.button>
    </div>
</div>
```

### Step 4: Understanding the Data Flow

**Creating New Items:**
```php
// User clicks "Add Variant"
addItem()
    ↓
// Generates UUID: "9b1deb4d-3b7d-4bad-9bdd-2b0d7b3dcb6d"
// Creates structure from itemStructure()
$this->items[$uuid] = [
    'id' => null,
    'name' => '',
    'sku' => '',  // Empty initially
    'price' => 0,
    'stock' => 0,
    'description' => '',
];
    ↓
// Hook generates SKU
afterItemAdded($uuid)
$this->items[$uuid]['sku'] = 'SKU-A7B2C3D4';
```

**Loading Existing Data:**
```php
// In mount() - simple and clean!
$this->items = collect($product->variants)->mapWithKeys(function ($variant) {
    return [
        $this->generateUuid() => $variant->toArray(),
    ];
})->toArray();

// Result:
$this->items = [
    '9b1deb4d-3b7d-4bad-9bdd-2b0d7b3dcb6d' => [
        'id' => 1,
        'name' => 'Red Small',
        'sku' => 'SKU-EXISTING1',
        'price' => 100,
        'stock' => 50,
        'description' => 'Small red variant',
    ],
    'a8c2f1e5-9d4e-4a3b-8c7f-1e2d3c4b5a6d' => [
        'id' => 2,
        'name' => 'Blue Large',
        'sku' => 'SKU-EXISTING2',
        'price' => 150,
        'stock' => 30,
        'description' => 'Large blue variant',
    ],
];
```

**Saving Data:**
```php
// User clicks "Save Variants"
save()
    ↓
// Get clean array without UUIDs
$itemsData = getItemsData();
// Returns: [
//   ['id' => 1, 'name' => 'Red Small', 'sku' => '...', ...],
//   ['id' => null, 'name' => 'Blue Large', 'sku' => '...', ...],
// ]
    ↓
// Update or create based on presence of 'id'
foreach ($itemsData as $data) {
    if ($data['id']) {
        update($data);  // Update existing
    } else {
        create($data);  // Create new
    }
}
```

### Step 5: Advanced Patterns

**Custom Validation Messages:**
```php
public function messages(): array
{
    return [
        'items.*.name.required' => 'Each variant must have a name',
        'items.*.sku.required' => 'SKU is required for all variants',
        'items.*.price.min' => 'Price cannot be negative',
    ];
}
```

**Prevent Duplicate SKUs:**
```php
protected function afterItemAdded(string $uuid): void
{
    // Keep generating until unique
    do {
        $sku = $this->generateSKU();
    } while ($this->skuExists($sku));
    
    $this->items[$uuid]['sku'] = $sku;
}

private function skuExists(string $sku): bool
{
    // Check in current items
    foreach ($this->items as $item) {
        if (($item['sku'] ?? '') === $sku) {
            return true;
        }
    }
    
    // Check in database
    return ProductVariant::where('sku', $sku)->exists();
}
```

**Bulk Operations:**
```php
public function deleteAllEmpty(): void
{
    $this->items = collect($this->items)
        ->filter(function ($item) {
            return !empty($item['name']) || !empty($item['description']);
        })
        ->toArray();
        
    session()->flash('message', 'Empty variants removed');
}
```

**Export/Import:**
```php
public function exportToCsv(): void
{
    $itemsData = $this->getItemsData();
    
    // Generate CSV
    $csv = collect($itemsData)
        ->map(fn($item) => implode(',', $item))
        ->prepend('Name,SKU,Price,Stock,Description')
        ->implode("\n");
        
    return response()->streamDownload(
        fn() => print($csv),
        'variants.csv'
    );
}
```

### How It Works

**UUID Management:**
- Each item gets a unique UUID when created: `"9b1deb4d-3b7d-4bad-9bdd-2b0d7b3dcb6d"`
- Used as array key internally: `$items[$uuid] = [...]`
- Used in `wire:key` to prevent Livewire conflicts
- Stripped out when saving via `getItemsData()`

**State Persistence:**
- `$items` holds all data with UUID keys
- Livewire syncs changes automatically via `wire:model`
- `itemStructure()` ensures consistent field structure
- Hook methods allow custom behavior per action

**Data Transformation:**
```php
// Internal state (with UUIDs)
$this->items = [
    '9b1deb4d-...' => ['name' => 'Red', 'sku' => 'SKU-123', ...],
    'a8c2f1e5-...' => ['name' => 'Blue', 'sku' => 'SKU-456', ...],
];

// Database format (clean array)
$this->getItemsData() = [
    ['name' => 'Red', 'sku' => 'SKU-123', ...],
    ['name' => 'Blue', 'sku' => 'SKU-456', ...],
];
```

This pattern gives you a production-ready repeater with clean separation of concerns, reliable state management, and excellent developer experience!

## Component Props

### ui.repeater

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `deletable` | boolean | `false` | Show delete button on each item |
| `duplicatable` | boolean | `false` | Show duplicate button on each item |
| `header` | slot | `null` | Optional header section for title/description |
| `actions` | slot | `null` | Actions slot for "Add Item" button or other controls |

### ui.repeater.item

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `uuid` | string | required | Unique identifier for the item (from your `$items` array) |
| `deletable` | boolean | inherited | Override parent's deletable setting |
| `duplicatable` | boolean | inherited | Override parent's duplicatable setting |
| `actions` | slot | `null` | Optional per-item actions (buttons, links, etc.) |

## Best Practices

**Always use `wire:key`:**
```blade
{{-- ✅ Correct --}}
<x-ui.repeater.item wire:key="item-{{ $uuid }}" :$uuid>

{{-- ❌ Wrong - will cause issues --}}
<x-ui.repeater.item :$uuid>
```

**Use `getItemsData()` when saving:**
```php
// ✅ Correct - clean array for database
$data = $this->getItemsData();

// ❌ Wrong - includes UUID keys
$data = $this->items;
```

**Initialize in `mount()`, not in property:**
```php
// ✅ Correct
public function mount() {
    $this->mountRepeater(3);
}

// ❌ Wrong - won't work reliably
public array $items = [/* ... */];
```

**Validate with wildcard:**
```php
// ✅ Correct - validates all items
'items.*.name' => 'required'

// ❌ Wrong - only validates specific keys
'items.uuid-123.name' => 'required'
```

## Common Use Cases

**Contact List:**
```php
protected function itemStructure(): array
{
    return [
        'name' => '',
        'email' => '',
        'phone' => '',
        'role' => 'member',
    ];
}
```

**Task List:**
```php
protected function itemStructure(): array
{
    return [
        'title' => '',
        'description' => '',
        'due_date' => null,
        'priority' => 'medium',
        'completed' => false,
    ];
}
```

**Pricing Tiers:**
```php
protected function itemStructure(): array
{
    return [
        'name' => '',
        'price' => 0,
        'features' => [],
        'highlighted' => false,
    ];
}
```

**Order Items:**
```php
protected function itemStructure(): array
{
    return [
        'product_id' => null,
        'quantity' => 1,
        'price' => 0,
        'discount' => 0,
        'notes' => '',
    ];
}
```