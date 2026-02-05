Here's the comprehensive, updated documentation:

```markdown
---
name: alerts
---

## Introduction

The `Alerts` component is a flexible notification system designed to communicate important information to users. It supports semantic variants, extensive color customization, two distinct icon layout patterns, and optional action controls for interactive notifications.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `alerts` component easily:

```bash
php artisan sheaf:install alerts
```

> Once installed, you can use the `<x-ui.alerts />`, `<x-ui.alerts.heading />` and `<x-ui.alerts.description />` components in any Blade view.

## Basic Usage

### Alert Variants

The alert component provides four semantic variants, each automatically applying appropriate colors when no custom color is specified.

@blade
<x-demo>
    <div class="w-full space-y-4">
        <x-ui.alerts variant="info" icon="information-circle">
            <x-ui.alerts.heading>Information</x-ui.alerts.heading>
            <x-ui.alerts.description>This is an informational message.</x-ui.alerts.description>
        </x-ui.alerts>
        <!--  -->
        <x-ui.alerts variant="success" icon="check-circle">
            <x-ui.alerts.heading>Success</x-ui.alerts.heading>
            <x-ui.alerts.description>Operation completed successfully.</x-ui.alerts.description>
        </x-ui.alerts>
        <!--  -->
        <x-ui.alerts variant="warning" icon="exclamation-triangle">
            <x-ui.alerts.heading>Warning</x-ui.alerts.heading>
            <x-ui.alerts.description>Please review this important notice.</x-ui.alerts.description>
        </x-ui.alerts>
        <!--  -->
        <x-ui.alerts variant="error" icon="exclamation-circle">
            <x-ui.alerts.heading>Error</x-ui.alerts.heading>
            <x-ui.alerts.description>An error occurred during processing.</x-ui.alerts.description>
        </x-ui.alerts>
    </div>
</x-demo>
@endblade

```blade
<!-- Info alert (default) -->
<x-ui.alerts variant="info" icon="information-circle">
    <x-ui.alerts.heading>Information</x-ui.alerts.heading>
    <x-ui.alerts.description>This is an informational message.</x-ui.alerts.description>
</x-ui.alerts>

<!-- Success alert -->
<x-ui.alerts variant="success" icon="check-circle">
    <x-ui.alerts.heading>Success</x-ui.alerts.heading>
    <x-ui.alerts.description>Operation completed successfully.</x-ui.alerts.description>
</x-ui.alerts>

<!-- Warning alert -->
<x-ui.alerts variant="warning" icon="exclamation-triangle">
    <x-ui.alerts.heading>Warning</x-ui.alerts.heading>
    <x-ui.alerts.description>Please review this important notice.</x-ui.alerts.description>
</x-ui.alerts>

<!-- Error alert -->
<x-ui.alerts variant="error" icon="exclamation-circle">
    <x-ui.alerts.heading>Error</x-ui.alerts.heading>
    <x-ui.alerts.description>An error occurred during processing.</x-ui.alerts.description>
</x-ui.alerts>
```

### Description Only Alerts

You can create simple alerts with just a description, no heading required.

@blade
<x-demo>
    <div class="w-full space-y-4">
        <x-ui.alerts variant="info" icon="sparkles">
            <x-ui.alerts.description>Version 2.0 is now available for download.</x-ui.alerts.description>
        </x-ui.alerts>
        
        <x-ui.alerts variant="success" icon="check-circle">
            <x-ui.alerts.description>Your changes have been saved successfully.</x-ui.alerts.description>
        </x-ui.alerts>
    </div>
</x-demo>
@endblade

```blade
<!-- Alert with description only -->
<x-ui.alerts variant="info" icon="sparkles">
    <x-ui.alerts.description>Version 2.0 is now available for download.</x-ui.alerts.description>
</x-ui.alerts>

<x-ui.alerts variant="success" icon="check-circle">
    <x-ui.alerts.description>Your changes have been saved successfully.</x-ui.alerts.description>
</x-ui.alerts>
```

## Icon Placement

The alert component supports two distinct icon layout patterns to suit different design needs.

### Alert-Level Icons (Left Side)

Place icons at the alert level for a traditional notification layout with the icon positioned to the left of all content.

@blade
<x-demo>
    <div class="w-full space-y-4">
        <x-ui.alerts variant="success" icon="check-circle">
            <x-ui.alerts.heading>Payment successful</x-ui.alerts.heading>
            <x-ui.alerts.description>Your payment has been processed successfully.</x-ui.alerts.description>
        </x-ui.alerts>
        <!--  -->
        <x-ui.alerts variant="error" icon="shield-exclamation">
            <x-ui.alerts.heading>Authentication failed</x-ui.alerts.heading>
            <x-ui.alerts.description>Invalid credentials. Please check your email and password.</x-ui.alerts.description>
        </x-ui.alerts>
    </div>
</x-demo>
@endblade

```blade
<!-- Icon positioned at alert level (left side) -->
<x-ui.alerts variant="success" icon="check-circle">
    <x-ui.alerts.heading>Payment successful</x-ui.alerts.heading>
    <x-ui.alerts.description>Your payment has been processed successfully.</x-ui.alerts.description>
</x-ui.alerts>

<x-ui.alerts variant="error" icon="shield-exclamation">
    <x-ui.alerts.heading>Authentication failed</x-ui.alerts.heading>
    <x-ui.alerts.description>Invalid credentials. Please check your email and password.</x-ui.alerts.description>
</x-ui.alerts>
```

> **Note:** When both heading and description are present, the alert-level icon automatically aligns to the top for better visual balance.

### Heading-Level Icons (Inline)

Place icons directly in the heading for a more integrated, inline appearance.

@blade
<x-demo>
    <div class="w-full space-y-4">
        <x-ui.alerts variant="warning">
            <x-ui.alerts.heading icon="server-stack">Storage almost full</x-ui.alerts.heading>
            <x-ui.alerts.description>You've used 90% of your storage space. Consider upgrading your plan.</x-ui.alerts.description>
        </x-ui.alerts>
        <!--  -->
        <x-ui.alerts color="blue">
            <x-ui.alerts.heading icon="light-bulb">Information</x-ui.alerts.heading>
            <x-ui.alerts.description>This is a blue informational alert message.</x-ui.alerts.description>
        </x-ui.alerts>
    </div>
</x-demo>
@endblade

```blade
<!-- Icon positioned at heading level (inline) -->
<x-ui.alerts variant="warning">
    <x-ui.alerts.heading icon="server-stack">Storage almost full</x-ui.alerts.heading>
    <x-ui.alerts.description>You've used 90% of your storage space. Consider upgrading your plan.</x-ui.alerts.description>
</x-ui.alerts>

<x-ui.alerts color="blue">
    <x-ui.alerts.heading icon="light-bulb">Information</x-ui.alerts.heading>
    <x-ui.alerts.description>This is a blue informational alert message.</x-ui.alerts.description>
</x-ui.alerts>
```

> **Important:** Use either alert-level OR heading-level icons, not both. They represent two different layout patterns.

## Custom Colors

Override the default variant colors with any of the 22+ available color options.

## Custom Colors

Override the default variant colors with any of the 22+ available color options.

@blade
<x-demo>
    <div class="max-h-100 py-4 w-full overflow-y-scroll">
        @php
            $colors = [
                'red' => ['icon' => 'exclamation-circle', 'title' => 'Red', 'description' => 'A red colored alert for errors.'],
                'orange' => ['icon' => 'bell-alert', 'title' => 'Orange', 'description' => 'An orange colored alert for warnings.'],
                'amber' => ['icon' => 'clock', 'title' => 'Amber', 'description' => 'An amber colored alert for pending items.'],
                'yellow' => ['icon' => 'exclamation-triangle', 'title' => 'Yellow', 'description' => 'A yellow colored alert for cautions.'],
                'lime' => ['icon' => 'bolt', 'title' => 'Lime', 'description' => 'A lime colored alert for new features.'],
                'green' => ['icon' => 'check-circle', 'title' => 'Green', 'description' => 'A green colored alert for success.'],
                'emerald' => ['icon' => 'shield-check', 'title' => 'Emerald', 'description' => 'An emerald colored alert for confirmations.'],
                'teal' => ['icon' => 'link', 'title' => 'Teal', 'description' => 'A teal colored alert for connections.'],
                'cyan' => ['icon' => 'arrow-down-tray', 'title' => 'Cyan', 'description' => 'A cyan colored alert for downloads.'],
                'sky' => ['icon' => 'cloud', 'title' => 'Sky', 'description' => 'A sky colored alert for cloud services.'],
                'blue' => ['icon' => 'information-circle', 'title' => 'Blue', 'description' => 'A blue colored alert for information.'],
                'indigo' => ['icon' => 'inbox', 'title' => 'Indigo', 'description' => 'An indigo colored alert for messages.'],
                'violet' => ['icon' => 'star', 'title' => 'Violet', 'description' => 'A violet colored alert for premium features.'],
                'purple' => ['icon' => 'sparkles', 'title' => 'Purple', 'description' => 'A purple colored alert for special items.'],
                'fuchsia' => ['icon' => 'gift', 'title' => 'Fuchsia', 'description' => 'A fuchsia colored alert for offers.'],
                'pink' => ['icon' => 'heart', 'title' => 'Pink', 'description' => 'A pink colored alert for welcomes.'],
                'rose' => ['icon' => 'no-symbol', 'title' => 'Rose', 'description' => 'A rose colored alert for denials.'],
                'slate' => ['icon' => 'square-3-stack-3d', 'title' => 'Slate', 'description' => 'A neutral slate colored alert.'],
                'gray' => ['icon' => 'square-3-stack-3d', 'title' => 'Gray', 'description' => 'A neutral gray colored alert.'],
                'zinc' => ['icon' => 'square-3-stack-3d', 'title' => 'Zinc', 'description' => 'A neutral zinc colored alert.'],
                'neutral' => ['icon' => 'square-3-stack-3d', 'title' => 'Neutral', 'description' => 'A neutral colored alert.'],
                'stone' => ['icon' => 'square-3-stack-3d', 'title' => 'Stone', 'description' => 'A neutral stone colored alert.'],
            ];
        @endphp
        <!--  -->
        <div class="w-full space-y-3">
            @foreach($colors as $color => $config)
                <x-ui.alerts :color="$color" :icon="$config['icon']">
                    <x-ui.alerts.heading >{{ $config['title'] }}</x-ui.alerts.heading>
                    <x-ui.alerts.description>{{ $config['description'] }}</x-ui.alerts.description>
                </x-ui.alerts>
            @endforeach
        </div>
    </div>
</x-demo>
@endblade

```blade
<x-ui.alerts color="red">...</x-ui.alerts>
<x-ui.alerts color="orange">...</x-ui.alerts>
<x-ui.alerts color="amber">...</x-ui.alerts>
<x-ui.alerts color="yellow">...</x-ui.alerts>
<x-ui.alerts color="lime">...</x-ui.alerts>
<x-ui.alerts color="green">...</x-ui.alerts>
<x-ui.alerts color="emerald">...</x-ui.alerts>
<x-ui.alerts color="teal">...</x-ui.alerts>
<x-ui.alerts color="cyan">...</x-ui.alerts>
<x-ui.alerts color="sky">...</x-ui.alerts>
<x-ui.alerts color="blue">...</x-ui.alerts>
<x-ui.alerts color="indigo">...</x-ui.alerts>
<x-ui.alerts color="violet">...</x-ui.alerts>
<x-ui.alerts color="purple">...</x-ui.alerts>
<x-ui.alerts color="fuchsia">...</x-ui.alerts>
<x-ui.alerts color="pink">...</x-ui.alerts>
<x-ui.alerts color="rose">...</x-ui.alerts>
<x-ui.alerts color="slate">...</x-ui.alerts>
<x-ui.alerts color="gray">...</x-ui.alerts>
<x-ui.alerts color="zinc">...</x-ui.alerts>
<x-ui.alerts color="neutral">...</x-ui.alerts>
<x-ui.alerts color="stone">...</x-ui.alerts>
```

## Alerts with Controls

Add interactive buttons or controls that users can act upon directly within the alert.

@blade
<x-demo>
    <div class="w-full space-y-4">
        <x-ui.alerts variant="info" icon="sparkles">
            <x-ui.alerts.description>Version 2.0 is now available for download.</x-ui.alerts.description>
            <x-slot:controls>
                <x-ui.button color="blue" icon="cloud-arrow-down">Download</x-ui.button>
            </x-slot:controls>
        </x-ui.alerts>
        
        <x-ui.alerts variant="success" icon="check-circle">
            <x-ui.alerts.heading>Payment successful</x-ui.alerts.heading>
            <x-ui.alerts.description>Your payment has been processed successfully.</x-ui.alerts.description>
            <x-slot:controls class="self-center">
                <x-ui.button color="neutral" icon="key">Grant Access</x-ui.button>
            </x-slot:controls>
        </x-ui.alerts>
    </div>
</x-demo>
@endblade

```blade
<!-- Alert with action button -->
<x-ui.alerts variant="info" icon="sparkles">
    <x-ui.alerts.description>Version 2.0 is now available for download.</x-ui.alerts.description>
    <x-slot:controls>
        <x-ui.button color="blue" icon="cloud-arrow-down">Download</x-ui.button>
    </x-slot:controls>
</x-ui.alerts>

<!-- Controls with custom alignment -->
<x-ui.alerts variant="success" icon="check-circle">
    <x-ui.alerts.heading>Payment successful</x-ui.alerts.heading>
    <x-ui.alerts.description>Your payment has been processed successfully.</x-ui.alerts.description>
    <x-slot:controls class="self-center">
        <x-ui.button color="neutral" icon="key">Grant Access</x-ui.button>
    </x-slot:controls>
</x-ui.alerts>
```

> **Tip:** Use the `class` attribute on the controls slot to customize alignment (`self-start`, `self-center`, `self-end`).


## Component Props 

### ui.alert

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `variant` | `string` | `'info'` | Semantic variant: `'info'`, `'success'`, `'warning'`, `'error'` |
| `color` | `string` | `null` | Custom color (overrides variant color). See available colors above. |
| `icon` | `string\|null` | `null` | Icon name for alert-level icon placement |
| `controls` | `slot` | `null` | Slot for action buttons or interactive elements |

### ui.alert.heading

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `icon` | `string\|null` | `null` | Icon name for heading-level icon placement |

### ui.alert.description

The description component accepts only the default slot for content and automatically applies appropriate text styling.

## Default Variant Mappings

| Variant | Default Color | Common Use Case |
|---------|---------------|-----------------|
| `info` | Blue | Informational messages, updates, tips |
| `success` | Green | Successful operations, confirmations |
| `warning` | Yellow | Warnings, cautions, non-critical issues |
| `error` | Red | Errors, failures, critical issues |