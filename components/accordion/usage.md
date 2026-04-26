---
name: accordion
---

## Introduction

The `Accordion` component is a collapsible content component designed to organize information in an expandable format. It allows users to show and hide sections of related content, making it perfect for FAQs, product details, settings panels, and other scenarios where space-efficient content organization is needed.

## Installation

Use the [Sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `accordion` component easily:

```bash
php artisan sheaf:install accordion
```

> Once installed, you can use the <x-ui.accordion />, <x-ui.accordion.item />, <x-ui.accordion.trigger />, and <x-ui.accordion.content /> components in any Blade view.

## Usage

### Basic Accordion

@blade
<x-demo>
    <div class="w-full">
        <x-ui.accordion>
            <x-ui.accordion.item>
                <x-ui.accordion.trigger>
                    What is your return policy?
                </x-ui.accordion.trigger>
                <x-ui.accordion.content>
                    <p>We offer a 30-day return policy for all unused items in their original packaging. Simply contact our customer service team to initiate a return.</p>
                </x-ui.accordion.content>
            </x-ui.accordion.item>
            <x-ui.accordion.item>
                <x-ui.accordion.trigger>
                    How long does shipping take?
                </x-ui.accordion.trigger>
                <x-ui.accordion.content>
                    <p>Standard shipping typically takes 3-5 business days, while express shipping takes 1-2 business days. International orders may take 7-14 business days depending on the destination.</p>
                </x-ui.accordion.content>
            </x-ui.accordion.item>
            <x-ui.accordion.item>
                <x-ui.accordion.trigger>
                    Do you offer international shipping?
                </x-ui.accordion.trigger>
                <x-ui.accordion.content>
                    <p>Yes, we ship to over 50 countries worldwide. Shipping costs and delivery times vary by destination. You can see the exact cost and estimated delivery time at checkout.</p>
                </x-ui.accordion.content>
            </x-ui.accordion.item>
        </x-ui.accordion>
    </div>
</x-demo>
@endblade

```blade
<x-ui.accordion>
    <x-ui.accordion.item>
        <x-ui.accordion.trigger>
            What is your return policy?
        </x-ui.accordion.trigger>
        <x-ui.accordion.content>
            <p>We offer a 30-day return policy for all unused items in their original packaging. Simply contact our customer service team to initiate a return.</p>
        </x-ui.accordion.content>
    </x-ui.accordion.item>

    <x-ui.accordion.item>
        <x-ui.accordion.trigger>
            How long does shipping take?
        </x-ui.accordion.trigger>
        <x-ui.accordion.content>
            <p>Standard shipping typically takes 3-5 business days, while express shipping takes 1-2 business days.</p>
        </x-ui.accordion.content>
    </x-ui.accordion.item>
</x-ui.accordion>
```

### Shorthand Syntax

For simple accordions, you can use the shorthand syntax with the `trigger` prop.

@blade
<x-demo>
    <div class="w-full">
        <x-ui.accordion>
            <x-ui.accordion.item trigger="Account Settings">
                <p>Manage your account preferences, update your profile information, and configure notification settings.</p>
                <div class="mt-3 space-y-2">
                    <div class="flex items-center justify-between">
                        <span>Email notifications</span>
                        <span class="text-green-600">Enabled</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Two-factor authentication</span>
                        <span class="text-green-600">Enabled</span>
                    </div>
                </div>
            </x-ui.accordion.item>
            <x-ui.accordion.item trigger="Privacy & Security">
                <p>Control your privacy settings and security preferences to keep your account safe.</p>
                <ul class="mt-3 space-y-1 list-disc list-inside">
                    <li>Password requirements</li>
                    <li>Login history</li>
                    <li>Data sharing preferences</li>
                </ul>
            </x-ui.accordion.item>
        </x-ui.accordion>
    </div>
</x-demo>
@endblade

```blade
<x-ui.accordion>
    <x-ui.accordion.item trigger="Account Settings">
        <p>Manage your account preferences, update your profile information, and configure notification settings.</p>
        <div class="mt-3 space-y-2">
            <div class="flex items-center justify-between">
                <span>Email notifications</span>
                <span class="text-green-600">Enabled</span>
            </div>
            <div class="flex items-center justify-between">
                <span>Two-factor authentication</span>
                <span class="text-green-600">Enabled</span>
            </div>
        </div>
    </x-ui.accordion.item>

    <x-ui.accordion.item trigger="Privacy & Security">
        <p>Control your privacy settings and security preferences to keep your account safe.</p>
        <ul class="mt-3 space-y-1 list-disc list-inside">
            <li>Password requirements</li>
            <li>Login history</li>
            <li>Data sharing preferences</li>
        </ul>
    </x-ui.accordion.item>
</x-ui.accordion>
```

### Expanded by Default

Set an accordion item to be expanded when the component loads.

@blade
<x-demo>
    <div class="w-full">
        <x-ui.accordion>
            <x-ui.accordion.item expanded trigger="Getting Started">
                <p>Welcome! This section is expanded by default to help you get started quickly.</p>
                <div class="mt-3 p-3 rounded">
                    <x-ui.alerts>
                        <p class="text-sm">💡 <strong>Tip:</strong> Use the <code>expanded</code> prop to open important sections by default.</p>
                    </x-ui.alerts>
                </div>
            </x-ui.accordion.item>
            <x-ui.accordion.item trigger="Advanced Features">
                <p>Explore advanced features and customization options for power users.</p>
            </x-ui.accordion.item>
            <x-ui.accordion.item trigger="Troubleshooting">
                <p>Common issues and solutions to help you resolve problems quickly.</p>
            </x-ui.accordion.item>
        </x-ui.accordion>
    </div>
</x-demo>
@endblade

```blade
<div class="w-full">
    <x-ui.accordion>
        <x-ui.accordion.item expanded trigger="Getting Started">
            <p>Welcome! This section is expanded by default to help you get started quickly.</p>
            <div class="mt-3 p-3 rounded">
                <x-ui.alerts>
                    <p class="text-sm">💡 <strong>Tip:</strong> Use the <code>expanded</code> prop to open important sections by default.</p>
                </x-ui.alerts>
            </div>
        </x-ui.accordion.item>
        <x-ui.accordion.item trigger="Advanced Features">
            <p>Explore advanced features and customization options for power users.</p>
        </x-ui.accordion.item>
        <x-ui.accordion.item trigger="Troubleshooting">
            <p>Common issues and solutions to help you resolve problems quickly.</p>
        </x-ui.accordion.item>
    </x-ui.accordion>
</div>
```

### Disabled Items

Disable specific accordion items to prevent user interaction.

@blade
<x-demo>
    <div class="w-full">
        <x-ui.accordion>
            <x-ui.accordion.item trigger="Available Features">
                <p>These features are currently available and ready to use.</p>
                <ul class="mt-3 space-y-1 list-disc list-inside">
                    <li>User management</li>
                    <li>Basic reporting</li>
                    <li>Email notifications</li>
                </ul>
            </x-ui.accordion.item>
            <!--  -->
            <x-ui.accordion.item disabled trigger="Premium Features (Coming Soon)">
                <p>This content is not yet available.</p>
            </x-ui.accordion.item>
            <!--  -->
            <x-ui.accordion.item trigger="Documentation">
                <p>Access comprehensive documentation and guides for all features.</p>
            </x-ui.accordion.item>
        </x-ui.accordion>
    </div>
</x-demo>
@endblade

```blade
<x-ui.accordion>
    //
    <x-ui.accordion.item 
        disabled 
        trigger="Premium Features (Coming Soon)">
        <p>This content is not yet available.</p>
    </x-ui.accordion.item>
    //
</x-ui.accordion>
```

### Reverse Layout

Use the reverse layout to position chevron icons on the left side.

@blade
<x-demo>
    <div class="w-full">
        <x-ui.accordion reverse>
            <x-ui.accordion.item trigger="System Requirements">
                <div class="space-y-3">
                    <div>
                        <h4 class="font-semibold">Minimum Requirements:</h4>
                        <ul class="mt-1 space-y-1 list-disc list-inside text-sm">
                            <li>4GB RAM</li>
                            <li>2GB available storage</li>
                            <li>Internet connection</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold">Recommended:</h4>
                        <ul class="mt-1 space-y-1 list-disc list-inside text-sm">
                            <li>8GB RAM or more</li>
                            <li>5GB available storage</li>
                            <li>High-speed internet</li>
                        </ul>
                    </div>
                </div>
            </x-ui.accordion.item>
            <!--  -->
            <x-ui.accordion.item trigger="Supported Platforms">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h4 class="font-semibold">Desktop</h4>
                        <ul class="mt-1 space-y-1 text-sm">
                            <li>Windows 10+</li>
                            <li>macOS 10.15+</li>
                            <li>Linux (Ubuntu 18+)</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold">Mobile</h4>
                        <ul class="mt-1 space-y-1 text-sm">
                            <li>iOS 13+</li>
                            <li>Android 8+</li>
                        </ul>
                    </div>
                </div>
            </x-ui.accordion.item>
        </x-ui.accordion>
    </div>
</x-demo>
@endblade

```blade
<x-ui.accordion reverse>
    //..
</x-ui.accordion>
```

## Component Props Reference

### ui.accordion

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `reverse` | `boolean` | `false` | Whether to reverse the trigger layout (chevron on left) |

### ui.accordion.item

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `disabled` | `boolean` | `false` | Whether the accordion item is disabled |
| `trigger` | `string` | `null` | Shorthand trigger content (alternative to using trigger slot) |
| `expanded` | `boolean` | `false` | Whether the item is expanded by default |

### Inherited Props (Accordion Item)

These props are automatically inherited from the parent `accordion` component:

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `reverse` | `boolean` | `false` | Reverse layout inherited from parent accordion |

### ui.accordion.trigger

| Prop | Type | Description |
|------|------|-------------|
| `disabled` | `boolean` | Disabled state inherited from parent item |
| `reverse` | `boolean` | Reverse layout inherited from accordion |
