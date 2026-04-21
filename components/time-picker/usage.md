---
name: time-picker
---

## Introduction

The `Time Picker` component is a **zero dependencies**, **fully-featured**, **accessible** time selection dropdown with support for 12/24-hour formats, locale-aware display, interval control, unavailable time ranges, and multiple selection. It integrates seamlessly with Livewire via `wire:model` and Alpine via `x-model`.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `time-picker` component:

```bash
php artisan sheaf:install time-picker
```

> **Requires Rover Plugin.** This component is powered by the [Rover primitive](/docs/primitives/rover). Make sure it's installed and registered before using this component.

Then import the script in your JS entry point:

```js
// app.js
import './components/time-picker/index.js';
```

> Once installed, you can use the `<x-ui.time-picker />` component in any Blade view.

## Usage

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.time-picker  placeholder="Select a time" clearable />
</x-demo>
@endblade

### Bind to Livewire

Use `wire:model` to bind the selected time to a Livewire property. The value is always a `H:i` formatted 24-hour string (e.g. `"09:30"`):

```blade
<x-ui.time-picker wire:model="time" />
```

For real-time syncing:

```blade
<x-ui.time-picker wire:model.live="time" />
```

### Using with Alpine

Outside of Livewire, bind with `x-model`:

```blade
<div x-data="{ time: '' }">
    <x-ui.time-picker x-model="time" />
</div>
```

## Trigger Types

### Button (default)

The default trigger is a styled button showing the selected time and an optional clear action.

```blade
<x-ui.time-picker wire:model="time" clearable />
```

### Input

Attach the picker to a segmented `HH:MM` input for direct keyboard entry. Arrow keys increment/decrement each segment, and the dropdown opens for quick selection.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.time-picker trigger="input"  />
</x-demo>
@endblade

```blade
<x-ui.time-picker trigger="input" wire:model="time" />
```

> In 12-hour locales, an AM/PM toggle appears automatically next to the minute segment.

**without time slots panel**


@blade
<x-demo lazy class="flex justify-center">
    <x-ui.time-picker trigger="input" :open-panel="false"  />
</x-demo>
@endblade

```blade
<x-ui.time-picker trigger="input" :open-panel="false" wire:model="time" />
```

### Pills

The pills trigger renders each selected time as a removable pill inside the trigger. Best used with `multiple`.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.time-picker trigger="pills" multiple clearable  />
</x-demo>
@endblade

```blade
<x-ui.time-picker trigger="pills" multiple clearable wire:model="times" />
```

## Multiple Selection

Allow users to select more than one time slot. The panel stays open after each selection — the user closes it manually via click-away or the trigger button. The bound value is a comma-separated string of `H:i` values.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.time-picker multiple clearable  />
</x-demo>
@endblade

```blade
<x-ui.time-picker multiple clearable wire:model="times" />
```

**Example value:** `"09:00,13:30,17:00"`

### Checkbox Variant

In multiple mode, use `variant="checkbox"` to replace the check icon with a mini checkbox for each option:

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.time-picker multiple variant="checkbox" clearable  />
</x-demo>
@endblade

```blade
<x-ui.time-picker multiple variant="checkbox" wire:model="times" />
```

## Time Format

By default the picker respects the browser's locale to determine 12 or 24-hour display. Override it explicitly with `format`:

@blade
<x-demo lazy class="flex gap-4 justify-center">
    <x-ui.time-picker format="12-hour" placeholder="12-hour"  />
    <x-ui.time-picker format="24-hour" placeholder="24-hour"  />
</x-demo>
@endblade

```blade
{{-- Force 12-hour display --}}
<x-ui.time-picker format="12-hour" wire:model="time" />

{{-- Force 24-hour display --}}
<x-ui.time-picker format="24-hour" wire:model="time" />
```

## Interval

Control the number of minutes between each displayed slot. Default is `30`.

@blade
<x-demo lazy class="flex gap-4 justify-center">
    <x-ui.time-picker :interval="15" placeholder="Every 15 min" />
    <x-ui.time-picker :interval="60" placeholder="Every hour"  />
</x-demo>
@endblade

```blade
{{-- Every 15 minutes --}}
<x-ui.time-picker :interval="15" wire:model="time" />

{{-- Hourly only --}}
<x-ui.time-picker :interval="60" wire:model="time" />
```

## Min / Max Times

Restrict the selectable range with `min` and `max`. Both accept a `H:i` string or the `"now"` shorthand.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.time-picker min="09:00" max="17:00" placeholder="Business hours"  />
</x-demo>
@endblade

```blade
<x-ui.time-picker min="09:00" max="17:00" wire:model="time" />
```

Using `"now"` as a boundary:

```blade
{{-- Only future times --}}
<x-ui.time-picker min="now" wire:model="time" />

{{-- Only past times --}}
<x-ui.time-picker max="now" wire:model="time" />
```

## Unavailable Times

Disable specific times or ranges using a comma-separated string. Ranges use a `-` separator between two `H:i` values. Unavailable slots are still visible but greyed out and non-selectable.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.time-picker unavailable="12:00,12:30,14:00-15:30" placeholder="Some times blocked"  />
</x-demo>
@endblade

```blade
{{-- Block individual times and a range --}}
<x-ui.time-picker unavailable="12:00,12:30,14:00-15:30" wire:model="time" />
```

## Open To

Set the scroll position when the dropdown opens. Useful for jumping to a relevant time period without restricting the full range. Falls back to: selected time → nearest time to now.

@blade
<x-demo lazy class="flex gap-4 justify-center">
    <x-ui.time-picker open-to="10:00"  />
</x-demo>
@endblade
```blade
<x-ui.time-picker open-to="10:00" wire:model="time" />
```

## Localization

By default the picker uses the browser locale (`navigator.language`). Override it with any valid BCP-47 locale string:

@blade
<x-demo lazy class="flex gap-4 justify-center">
    <x-ui.time-picker locale="ja-JP" placeholder="ja-JP"  />
    <x-ui.time-picker locale="fr" placeholder="fr"  />
</x-demo>
@endblade

```blade
<x-ui.time-picker locale="ja-JP" wire:model="time" />
<x-ui.time-picker locale="fr"    wire:model="time" />
```

> Locale affects both the display label (e.g. `午後2:00` vs `2:00 PM` vs `14:00`) and whether the 12-hour AM/PM toggle appears in `trigger="input"` mode.

## Size

The picker comes in Two sizes. The default aligns with the standard `input` height for easy side-by-side use in forms.

@blade
<x-demo lazy class="flex flex-col gap-3 items-center">
    <x-ui.time-picker size="default" placeholder="Default"  />
    <x-ui.time-picker size="sm"      placeholder="Small"    />
</x-demo>
@endblade

```blade
<x-ui.time-picker size="default" wire:model="time" />
<x-ui.time-picker size="sm"      wire:model="time" />
```

## Clearable

Show a clear button when a value is selected. In `trigger="pills"` mode this clears all selected times at once.

```blade
<x-ui.time-picker clearable wire:model="time" />
```

## Validation States

### Invalid

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.time-picker :invalid="true" placeholder="Required field"  />
</x-demo>
@endblade

```blade
<x-ui.time-picker :invalid="$errors->has('time')" wire:model="time" />
```

### Disabled

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.time-picker disabled placeholder="Not available"  />
</x-demo>
@endblade

```blade
<x-ui.time-picker disabled wire:model="time" />
```

## Special Slots

The special prop allows you to mark specific time slots with custom tags that can be used for styling, labeling, or advanced UI behavior.

Unlike `unavailable`, special slots are not disabled by default. They are simply annotated and exposed to the DOM

```blade
<x-ui.time-picker 
    :special="['blocked' => '14:00,15:00']"
/>
```

**Styling with CSS**

You can target slots directly using attribute selectors:
```css

[data-special~="blocked"] {
    opacity: 0.5;
    content: "blocked";
    color: yellowgreen
}
```
the `~=` is there to check if `data-special` value contain the targeted string

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.time-picker
        :special="['blocked' => '14:00,15:00']"
        min="12:00"
        max="18:00"
    />
</x-demo>
@endblade



> this pattern is better than simple tag management gives you a ton flexibility

## Advanced Examples

### Appointment Booking

Typical scheduling scenario: business hours, 30-minute slots, lunch blocked out.

```blade
<x-ui.time-picker
    wire:model="appointmentTime"
    min="09:00"
    max="18:00"
    :interval="30"
    unavailable="12:00-13:30"
    open-to="09:00"
    clearable
    placeholder="Pick a time"
/>
```

### Multi-slot Scheduling with Pills

Allow a user to pick multiple meeting slots displayed as pills:

```blade
<x-ui.time-picker
    trigger="pills"
    multiple
    clearable
    :interval="30"
    min="08:00"
    max="20:00"
    wire:model="meetingSlots"
    placeholder="Add time slots"
/>
```

**Livewire backend:**

```php
public string $meetingSlots = '';

public function getMeetingSlotsArrayProperty(): array
{
    return array_filter(explode(',', $this->meetingSlots));
}
```

### Input Trigger with Validation

```blade
<x-ui.field>
    <x-ui.label>Start time</x-ui.label>
    <x-ui.time-picker
        trigger="input"
        wire:model="startTime"
        format="24-hour"
        :interval="15"
        :invalid="$errors->has('startTime')"
        clearable
    />
    <x-ui.error name="startTime" />
</x-ui.field>
```

### Dynamic Unavailable Slots from Livewire

Compute blocked times server-side and pass them down:

```blade
<x-ui.time-picker
    wire:model="time"
    :unavailable="$bookedSlots"
    :interval="30"
    min="09:00"
    max="17:00"
/>
```

```php
public string $time = '';

public function getBookedSlotsProperty(): string
{
    return Booking::whereDate('date', $this->selectedDate)
        ->pluck('time')             // ["09:00", "11:30", "14:00"]
        ->implode(',');             // "09:00,11:30,14:00"
}
```

## Component Props

### ui.time-picker

| Prop | Type | Default | Description |
| ---- | ---- | ------- | ----------- |
| `wire:model` | string | — | Binds to a Livewire property. Value format: `H:i` (single) or `H:i,H:i` (multiple). Supports `.live` modifier. |
| `format` | string | `'auto'` | Time display format. Options: `auto`, `12-hour`, `24-hour`. `auto` follows the browser locale. |
| `multiple` | boolean | `false` | Shorthand for `mode="multiple"`. |
| `interval` | integer | `30` | Minutes between each displayed slot. |
| `min` | string | `null` | Earliest selectable time as `H:i` or `"now"`. |
| `max` | string | `null` | Latest selectable time as `H:i` or `"now"`. |
| `unavailable` | string | `null` | Comma-separated blocked times and/or ranges e.g. `"03:00,05:30-07:00"`. |
| `open-to` | string | `null` | Scroll target on open as `H:i`. Falls back to selected time, then nearest to now. |
| `locale` | string | `'auto'` | BCP-47 locale for display. `auto` uses `navigator.language`. |
| `trigger` | string | `'button'` | Trigger variant. Options: `button`, `input`, `pills`. |
| `variant` | string | `'default'` | Option indicator style in multiple mode. Options: `default` (check icon), `checkbox`. |
| `clearable` | boolean | `false` | Shows a clear button when a value is selected. Clears all in multiple mode. |
| `placeholder` | string | `'Select a time'` | Placeholder text shown when no value is selected. Defaults to `'--:--'` for `trigger="input"`. |
| `disabled` | boolean | `false` | Disables the entire component. |
| `invalid` | boolean | `false` | Applies error styling to the trigger. |
| `size` | string | `'default'` | Size variant. Options: `default`, `sm`, `xs`. |
| `label` | string | `null` | ARIA label forwarded to the options list. |
| `special` | array | `[]`    | Map of custom slot tags. Format: `['key' => 'H:i,H:i-H:i']`. Adds `data-special` attribute to matching slots. |


| Attribute | Description |
| --------- | ----------- |
| `data-slot="trigger"` | Applied to the trigger wrapper element. |
| `data-slot="select-control"` | Applied to the interactive control inside the trigger. |
| `data-slot="option"` | Applied to each time slot `<li>` in the panel. |
| `data-open` | Present on the trigger control when the panel is open. |
| `data-selected` | Present on a slot `<li>` and its checkbox span when selected. |
| `data-disabled` | Present on a slot `<li>` when unavailable. |
| `data-special` | Present on a slot `<li>` when special tags are passed. |