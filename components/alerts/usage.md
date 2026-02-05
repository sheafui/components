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

> Once installed, you can use the `<x-ui.alerts />` component in any Blade view.

## Basic Usage

### Alert Variants

The alert component provides four semantic variants, each automatically applying appropriate colors when no custom color is specified.

@blade
<x-demo>
    <div class="w-full space-y-4">
        <x-ui.alerts variant="info">
            <x-ui.alerts.heading>Information</x-ui.alerts.heading>
            <x-ui.alerts.description>This is an informational message.</x-ui.alerts.description>
        </x-ui.alerts>
        
        <x-ui.alerts variant="success">
            <x-ui.alerts.heading>Success</x-ui.alerts.heading>
            <x-ui.alerts.description>Operation completed successfully.</x-ui.alerts.description>
        </x-ui.alerts>
        
        <x-ui.alerts variant="warning">
            <x-ui.alerts.heading>Warning</x-ui.alerts.heading>
            <x-ui.alerts.description>Please review this important notice.</x-ui.alerts.description>
        </x-ui.alerts>
        
        <x-ui.alerts variant="error">
            <x-ui.alerts.heading>Error</x-ui.alerts.heading>
            <x-ui.alerts.description>An error occurred during processing.</x-ui.alerts.description>
        </x-ui.alerts>
    </div>
</x-demo>
@endblade

```blade
<!-- Info alert (default) -->
<x-ui.alerts variant="info">
    <x-ui.alerts.heading>Information</x-ui.alerts.heading>
    <x-ui.alerts.description>This is an informational message.</x-ui.alerts.description>
</x-ui.alerts>

<!-- Success alert -->
<x-ui.alerts variant="success">
    <x-ui.alerts.heading>Success</x-ui.alerts.heading>
    <x-ui.alerts.description>Operation completed successfully.</x-ui.alerts.description>
</x-ui.alerts>

<!-- Warning alert -->
<x-ui.alerts variant="warning">
    <x-ui.alerts.heading>Warning</x-ui.alerts.heading>
    <x-ui.alerts.description>Please review this important notice.</x-ui.alerts.description>
</x-ui.alerts>

<!-- Error alert -->
<x-ui.alerts variant="error">
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
        
        <x-ui.alerts variant="error" icon="shield-exclamation">
            <x-ui.alerts.heading>Authentication failed</x-ui.alerts.heading>
            <x-ui.alerts.description>Invalid credentials. Please check your email and password.</x-ui.alerts.description>
        </x-ui.alerts>
        
        <x-ui.alerts color="zinc" icon="bell">
            <x-ui.alerts.heading>System notification</x-ui.alerts.heading>
            <x-ui.alerts.description>Your system has been updated to the latest version.</x-ui.alerts.description>
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
        
        <x-ui.alerts color="blue">
            <x-ui.alerts.heading icon="light-bulb">Information</x-ui.alerts.heading>
            <x-ui.alerts.description>This is a blue informational alert message.</x-ui.alerts.description>
        </x-ui.alerts>
        
        <x-ui.alerts color="red">
            <x-ui.alerts.heading icon="server">Critical error</x-ui.alerts.heading>
            <x-ui.alerts.description>The server is not responding. Please try again later.</x-ui.alerts.description>
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

@blade
<x-demo>
    <div class="w-full space-y-4">
        <x-ui.alerts color="purple">
            <x-ui.alerts.heading icon="credit-card">Subscription renewed</x-ui.alerts.heading>
            <x-ui.alerts.description>Your annual subscription has been renewed successfully.</x-ui.alerts.description>
        </x-ui.alerts>
        
        <x-ui.alerts color="cyan">
            <x-ui.alerts.heading icon="arrow-down-tray">Download ready</x-ui.alerts.heading>
            <x-ui.alerts.description>Your export file is ready for download.</x-ui.alerts.description>
        </x-ui.alerts>
        
        <x-ui.alerts color="amber">
            <x-ui.alerts.heading icon="clock">Pending approval</x-ui.alerts.heading>
            <x-ui.alerts.description>Your submission is waiting for admin review.</x-ui.alerts.description>
        </x-ui.alerts>
        
        <x-ui.alerts color="emerald">
            <x-ui.alerts.heading icon="shield-check">Backup completed</x-ui.alerts.heading>
            <x-ui.alerts.description>Your data has been backed up successfully to the cloud.</x-ui.alerts.description>
        </x-ui.alerts>
    </div>
</x-demo>
@endblade

```blade
<x-ui.alerts color="purple">
    <x-ui.alerts.heading icon="credit-card">Subscription renewed</x-ui.alerts.heading>
    <x-ui.alerts.description>Your annual subscription has been renewed successfully.</x-ui.alerts.description>
</x-ui.alerts>

<x-ui.alerts color="cyan">
    <x-ui.alerts.heading icon="arrow-down-tray">Download ready</x-ui.alerts.heading>
    <x-ui.alerts.description>Your export file is ready for download.</x-ui.alerts.description>
</x-ui.alerts>

<x-ui.alerts color="amber">
    <x-ui.alerts.heading icon="clock">Pending approval</x-ui.alerts.heading>
    <x-ui.alerts.description>Your submission is waiting for admin review.</x-ui.alerts.description>
</x-ui.alerts>
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

## Complete Color Palette

The alert component supports 22+ colors with full dark mode compatibility.

@blade
<x-demo>
    <div class="w-full space-y-3">
        <x-ui.alerts color="blue">
            <x-ui.alerts.heading icon="information-circle">Blue</x-ui.alerts.heading>
            <x-ui.alerts.description>A blue colored alert.</x-ui.alerts.description>
        </x-ui.alerts>
        
        <x-ui.alerts color="green">
            <x-ui.alerts.heading icon="check-circle">Green</x-ui.alerts.heading>
            <x-ui.alerts.description>A green colored alert.</x-ui.alerts.description>
        </x-ui.alerts>
        
        <x-ui.alerts color="yellow">
            <x-ui.alerts.heading icon="exclamation-triangle">Yellow</x-ui.alerts.heading>
            <x-ui.alerts.description>A yellow colored alert.</x-ui.alerts.description>
        </x-ui.alerts>
        
        <x-ui.alerts color="red">
            <x-ui.alerts.heading icon="exclamation-circle">Red</x-ui.alerts.heading>
            <x-ui.alerts.description>A red colored alert.</x-ui.alerts.description>
        </x-ui.alerts>
        
        <x-ui.alerts color="purple">
            <x-ui.alerts.heading icon="sparkles">Purple</x-ui.alerts.heading>
            <x-ui.alerts.description>A purple colored alert.</x-ui.alerts.description>
        </x-ui.alerts>
        
        <x-ui.alerts color="pink">
            <x-ui.alerts.heading icon="heart">Pink</x-ui.alerts.heading>
            <x-ui.alerts.description>A pink colored alert.</x-ui.alerts.description>
        </x-ui.alerts>
    </div>
</x-demo>
@endblade

### Available Colors

**Primary Colors:** `blue`, `green`, `red`, `yellow`, `orange`

**Extended Palette:** `amber`, `lime`, `emerald`, `teal`, `cyan`, `sky`, `indigo`, `violet`, `purple`, `fuchsia`, `pink`, `rose`

**Neutral Colors:** `zinc`, `gray`, `neutral`, `slate`, `stone`

## Complex Examples

### Multi-Action Alert

@blade
<x-demo>
    <div class="w-full">
        <x-ui.alerts variant="warning" icon="wrench-screwdriver">
            <x-ui.alerts.heading>Maintenance scheduled</x-ui.alerts.heading>
            <x-ui.alerts.description>System maintenance will occur on Sunday at 2 AM EST. Services will be temporarily unavailable.</x-ui.alerts.description>
            <x-slot:controls>
                <div class="flex gap-2">
                    <x-ui.button color="yellow" size="sm">View Schedule</x-ui.button>
                    <x-ui.button variant="outline" size="sm">Dismiss</x-ui.button>
                </div>
            </x-slot:controls>
        </x-ui.alerts>
    </div>
</x-demo>
@endblade

```blade
<x-ui.alerts variant="warning" icon="wrench-screwdriver">
    <x-ui.alerts.heading>Maintenance scheduled</x-ui.alerts.heading>
    <x-ui.alerts.description>System maintenance will occur on Sunday at 2 AM EST. Services will be temporarily unavailable.</x-ui.alerts.description>
    <x-slot:controls>
        <div class="flex gap-2">
            <x-ui.button color="yellow" size="sm">View Schedule</x-ui.button>
            <x-ui.button variant="outline" size="sm">Dismiss</x-ui.button>
        </div>
    </x-slot:controls>
</x-ui.alerts>
```

### Rich Content Alert

@blade
<x-demo>
    <div class="w-full">
        <x-ui.alerts color="fuchsia" icon="gift">
            <x-ui.alerts.heading>Special offer</x-ui.alerts.heading>
            <x-ui.alerts.description>
                <p class="mb-2">Get 50% off on your next purchase.</p>
                <ul class="list-disc list-inside text-sm space-y-1">
                    <li>Valid for premium plans only</li>
                    <li>Offer expires in 24 hours</li>
                    <li>Cannot be combined with other offers</li>
                </ul>
            </x-ui.alerts.description>
            <x-slot:controls>
                <x-ui.button color="fuchsia" size="sm">Claim Offer</x-ui.button>
            </x-slot:controls>
        </x-ui.alerts>
    </div>
</x-demo>
@endblade

```blade
<x-ui.alerts color="fuchsia" icon="gift">
    <x-ui.alerts.heading>Special offer</x-ui.alerts.heading>
    <x-ui.alerts.description>
        <p class="mb-2">Get 50% off on your next purchase.</p>
        <ul class="list-disc list-inside text-sm space-y-1">
            <li>Valid for premium plans only</li>
            <li>Offer expires in 24 hours</li>
            <li>Cannot be combined with other offers</li>
        </ul>
    </x-ui.alerts.description>
    <x-slot:controls>
        <x-ui.button color="fuchsia" size="sm">Claim Offer</x-ui.button>
    </x-slot:controls>
</x-ui.alerts>
```

## Component API

### Alert Component Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `variant` | `string` | `'info'` | Semantic variant: `'info'`, `'success'`, `'warning'`, `'error'` |
| `color` | `string` | `null` | Custom color (overrides variant color). See available colors above. |
| `icon` | `string\|null` | `null` | Icon name for alert-level icon placement |
| `controls` | `slot` | `null` | Slot for action buttons or interactive elements |

### Heading Component Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `icon` | `string\|null` | `null` | Icon name for heading-level icon placement |

### Description Component

The description component accepts only the default slot for content and automatically applies appropriate text styling.

## Default Variant Mappings

| Variant | Default Color | Common Use Case |
|---------|---------------|-----------------|
| `info` | Blue | Informational messages, updates, tips |
| `success` | Green | Successful operations, confirmations |
| `warning` | Yellow | Warnings, cautions, non-critical issues |
| `error` | Red | Errors, failures, critical issues |

## Accessibility

The alert component includes built-in accessibility features:

- `role="alert"` for proper ARIA semantics
- `aria-live="polite"` for screen reader announcements
- Semantic color hierarchy with sufficient contrast
- Keyboard-accessible controls and buttons

## Best Practices

1. **Icon Placement**: Choose one icon pattern per alert - either alert-level OR heading-level, not both
2. **Color Consistency**: Use semantic variants for standard notifications, custom colors for branded or special alerts
3. **Content Clarity**: Keep headings concise, use descriptions for additional context
4. **Action Alignment**: Use `self-center` for controls in single-line alerts, default for multi-line content
5. **Accessibility**: Ensure sufficient color contrast and provide clear, descriptive text

## Dark Mode

All alert colors include carefully crafted dark mode variants that maintain readability and visual hierarchy. The component automatically adapts to your application's color scheme with no additional configuration needed.
```

This documentation is comprehensive and includes:

✅ Clear explanation of both icon placement patterns
✅ Practical examples for every major feature
✅ Complete color palette showcase
✅ Interactive demos using the actual component syntax
✅ Best practices and accessibility information
✅ Clear API reference with all props documented
✅ Real-world complex examples
✅ No component:: prefixing