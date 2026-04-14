---
name: calendar
---

## Introduction

The `Calendar` component is a **zero dependencies**, **fully-featured**, **accessible** date picker with support for single, multiple, and range selection modes. It integrates seamlessly with Livewire via `wire:model` and Alpine via `x-model`, with built-in constraints for min/max dates, unavailable dates, and range length validation.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `calendar` component:

```bash
php artisan sheaf:install calendar
```

Then import the script in your JS entry point:

```js
// app.js
import './components/calendar/index.js';
```

> Once installed, you can use the `<x-ui.calendar />` component in any Blade view.

## Usage

@blade
<x-demo class="flex justify-center">
    <x-ui.calendar />
</x-demo>
@endblade

### Bind to Livewire

Use `wire:model` to bind the selected date to a Livewire property. The value format depends on the selection mode (see [Selection Modes](#selection-modes)):

```blade
<x-ui.calendar wire:model="date" />
```

For real-time syncing:

```blade
<x-ui.calendar wire:model.live="date" />
```

### Using with Alpine

Outside of Livewire, bind with `x-model`:

```blade
<div x-data="{ date: '' }">
    <x-ui.calendar x-model="date" />
</div>
```

## Selection Modes

The calendar supports three distinct selection modes, each with a different value format.

### Single Selection (default)

Users select exactly one date. The bound value is an ISO date string `YYYY-MM-DD`.

@blade
<x-demo class="flex justify-center">
    <x-ui.calendar mode="single" />
</x-demo>
@endblade

```blade
<x-ui.calendar mode="single" wire:model="date" />
```

**Example value:** `"2026-04-15"`

### Multiple Selection

Users select multiple dates. The panel stays open after each selection — the user closes it manually via click-away or navigation. The bound value is a comma-separated string of ISO date strings.

@blade
<x-demo class="flex justify-center">
    <x-ui.calendar mode="multiple" />
</x-demo>
@endblade

```blade
<x-ui.calendar mode="multiple" wire:model="dates" />
```

**Example value:** `"2026-04-15,2026-04-20,2026-05-01"`

**Livewire backend:**

```php
public string $dates = '';

public function getSelectedDatesArrayProperty(): array
{
    return array_filter(explode(',', $this->dates));
}
```

### Range Selection

Users select a start and end date for a date range. Click once to set the start, click again to set the end. The bound value is a comma-separated string of two ISO date strings `[start,end]`.

@blade
<x-demo class="flex justify-center">
    <x-ui.calendar mode="range" />
</x-demo>
@endblade

```blade
<x-ui.calendar mode="range" wire:model="dateRange" />
```

**Example value:** `"2026-04-15,2026-04-25"`

The calendar shows a visual highlight across the selected range. After selecting the start date, hovering shows a preview of the range as you move across dates.

## Min / Max Dates

Restrict the selectable date range with `min` and `max`. Both accept ISO date strings `YYYY-MM-DD`. Dates outside this range are disabled and non-selectable.

@blade
<x-demo class="flex justify-center">
    <x-ui.calendar min="2026-04-01" max="2026-04-30" />
</x-demo>
@endblade

```blade
<x-ui.calendar min="2026-04-01" max="2026-04-30" wire:model="date" />
```

## Unavailable Dates

Mark specific dates as unavailable (greyed out, non-selectable) using a comma-separated array of ISO date strings. Unlike `min`/`max`, unavailable dates are visible but disabled.

@blade
<x-demo class="flex justify-center">
    <x-ui.calendar :unavailable-dates="['2026-04-15', '2026-04-20', '2026-04-25']" />
</x-demo>
@endblade

```blade
<x-ui.calendar :unavailable-dates="$blockedDates" wire:model="date" />
```

**Livewire backend:**

```php
public function getBlockedDatesProperty(): array
{
    return Holiday::pluck('date')
        ->map(fn($date) => $date->format('Y-m-d'))
        ->toArray();
}
```

## Range Constraints

In `range` mode, enforce minimum and maximum range lengths with `min-range` and `max-range` (both in days). Dates that would violate the constraints are disabled while selecting the end date.

@blade
<x-demo class="flex justify-center">
    <x-ui.calendar mode="range" :min-range="3" :max-range="14" />
</x-demo>
@endblade

```blade
{{-- Require at least 3 days, at most 2 weeks --}}
<x-ui.calendar 
    mode="range" 
    :min-range="3" 
    :max-range="14"
    wire:model="dateRange" 
/>
```

When `min-range` is set and you've selected the start date, all dates closer than `min-range` days are disabled until you reach the minimum distance.

## Fixed Week Heights

By default, calendar months have variable heights (4–6 rows depending on the number of weeks). Set `fixed-weeks` to lock all months to a consistent height (always 6 rows), which prevents layout shift when navigating.

@blade
<x-demo class="flex justify-center">
    <x-ui.calendar :fixed-weeks="true" />
</x-demo>
@endblade

```blade
<x-ui.calendar :fixed-weeks="true" wire:model="date" />
```

## Selectable Year and Months

By default, calendar months have variable heights (4–6 rows depending on the number of weeks). Set `fixed-weeks` to lock all months to a consistent height (always 6 rows), which prevents layout shift when navigating.

@blade
<x-demo class="flex justify-center">
    <x-ui.calendar selectable-months selectable-years  min-year="-10" max-years="+10" />
</x-demo>
@endblade

```blade
<x-ui.calendar :fixed-weeks="true" wire:model="date" />
```

## Multi-Month Display

Show multiple months side-by-side for easier range selection or date browsing. Set `number-of-months` to the desired count.

@blade
<x-demo class="flex justify-center">
    <x-ui.calendar :number-of-months="2" mode="range" />
</x-demo>
@endblade

```blade
{{-- Show 2 months side-by-side (great for range mode) --}}
<x-ui.calendar :number-of-months="2" mode="range" wire:model="dateRange" />

{{-- Show 3 months --}}
<x-ui.calendar :number-of-months="3" mode="multiple" wire:model="dates" />
```

## Navigation

By default, the calendar displays navigation buttons (previous/next month). Disable them with `allow-navigation="false"`.

```blade
{{-- Hide navigation buttons --}}
<x-ui.calendar :allow-navigation="false" wire:model="date" />
```

## Localization

By default the calendar uses the browser locale (`navigator.language`). Override it with any valid BCP-47 locale string. Locale affects both the weekday names and the first day of the week.

@blade
<x-demo class="flex gap-4 justify-center">
    <x-ui.calendar locale="en-US" />
    <x-ui.calendar locale="fr-FR" />
    <x-ui.calendar locale="ja-JP" />
</x-demo>
@endblade

```blade
<x-ui.calendar locale="en-US" wire:model="date" />
<x-ui.calendar locale="fr-FR" wire:model="date" />
<x-ui.calendar locale="de-DE" wire:model="date" />
```

> Locale automatically determines the first day of the week (e.g., Sunday in US, Monday in Europe) via the [Intl API](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Intl/Locale/getWeekInfo).

### Custom Week Start

Override the locale-determined first day of the week with `start-day` (0 = Sunday, 1 = Monday, etc.):

```blade
{{-- Force Monday as first day regardless of locale --}}
<x-ui.calendar locale="en-US" :start-day="1" wire:model="date" />
```

## Size

The calendar comes in multiple sizes to fit different UI contexts.

@blade
<x-demo class="flex flex-col gap-6 items-center">
    <x-ui.calendar size="xs" />
    <x-ui.calendar size="sm" />
    <x-ui.calendar size="md" />
    <x-ui.calendar size="lg" />
</x-demo>
@endblade

```blade
<x-ui.calendar size="xs" wire:model="date" />
<x-ui.calendar size="sm" wire:model="date" />
<x-ui.calendar size="md" wire:model="date" />
<x-ui.calendar size="lg" wire:model="date" />
```

## Highlighting Blank Days

By default, days from adjacent months (pre/post blanks) that fill out the calendar grid are visible but unstyled. Set `highlight-blank-days="false"` to hide them entirely.

```blade
{{-- Hide adjacent month days --}}
<x-ui.calendar :highlight-blank-days="false" wire:model="date" />
```

## Read-Only

Prevent all interaction by disabling the component entirely. Calendar remains visible for display purposes.

```blade
<x-ui.calendar :read-only="true" :disabled="true" wire:model="date" />
```

## Today Button

Show a "Go to today" button in the top-right corner of the calendar with `with-today`.

@blade
<x-demo class="flex justify-center">
    <x-ui.calendar :with-today="true" />
</x-demo>
@endblade

```blade
<x-ui.calendar :with-today="true" wire:model="date" />
```

## Advanced Examples

### Appointment Booking

Typical booking scenario: future dates only, exclude weekends and holidays.

```blade
<x-ui.calendar
    mode="single"
    :min="now()->addDay()->format('Y-m-d')"
    :unavailable-dates="$blockedDates"
    wire:model="appointmentDate"
    locale="auto"
/>
```

**Livewire backend:**

```php
public function getBlockedDatesProperty(): array
{
    return Holiday::whereBetween('date', [
        now(),
        now()->addMonths(3)
    ])
    ->pluck('date')
    ->map(fn($date) => $date->format('Y-m-d'))
    ->toArray();
}
```

### Date Range Booking with Constraints

Let users book a 3-14 day vacation starting next week:

```blade
<x-ui.calendar
    mode="range"
    :min="now()->addWeek()->format('Y-m-d')"
    :min-range="3"
    :max-range="14"
    :number-of-months="2"
    wire:model="vacationDates"
/>
```

### Multi-date Event Selection

Allow selecting multiple meeting dates across months:

```blade
<x-ui.calendar
    mode="multiple"
    :min="now()->format('Y-m-d')"
    :number-of-months="3"
    :unavailable-dates="$companyHolidays"
    wire:model="meetingDates"
/>
```

**Livewire backend:**

```php
public array $meetingDates = [];

public function getCompanyHolidaysProperty(): array
{
    return companyHolidays()->format('Y-m-d');
}

#[On('datePicked')]
public function saveMeetingDates()
{
    $dates = array_filter(explode(',', $this->meetingDates));
    $this->meeting->dates()->sync($dates);
}
```

### Calendar with Comparison (2 ranges)

Display two calendars side-by-side for comparing date ranges (e.g., year-over-year):

```blade
<div class="grid grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-semibold mb-2">Period 1</label>
        <x-ui.calendar 
            mode="range"
            :min="now()->subYear()->format('Y-m-d')"
            :max="now()->subYear()->endOfYear()->format('Y-m-d')"
            wire:model="period1"
        />
    </div>
    <div>
        <label class="block text-sm font-semibold mb-2">Period 2</label>
        <x-ui.calendar 
            mode="range"
            :min="now()->format('Y-m-d')"
            :max="now()->endOfYear()->format('Y-m-d')"
            wire:model="period2"
        />
    </div>
</div>
```

### Fixed Layout Calendar (No Shift)

For dashboards and reports where layout stability is critical:

```blade
<x-ui.calendar
    mode="multiple"
    :fixed-weeks="true"
    :highlight-blank-days="true"
    size="sm"
    wire:model="selectedDates"
/>
```

## Component Props

### ui.calendar

| Prop | Type | Default | Description |
| ---- | ---- | ------- | ----------- |
| `wire:model` | string | — | Binds to a Livewire property. Value format depends on mode: `YYYY-MM-DD` (single), `YYYY-MM-DD,YYYY-MM-DD,...` (multiple), `YYYY-MM-DD,YYYY-MM-DD` (range). Supports `.live` modifier. |
| `mode` | string | `'single'` | Selection mode. Options: `single`, `multiple`, `range`. |
| `min` | string | `null` | Earliest selectable date as `YYYY-MM-DD`. |
| `max` | string | `null` | Latest selectable date as `YYYY-MM-DD`. |
| `min-range` | integer | `null` | Minimum range length in days (range mode only). |
| `max-range` | integer | `null` | Maximum range length in days (range mode only). |
| `unavailable-dates` | array\|string | `[]` | Array or comma-separated list of unavailable dates as `YYYY-MM-DD`. |
| `locale` | string | `'auto'` | BCP-47 locale for weekday names and first day of week. `auto` uses `navigator.language`. |
| `start-day` | integer | `'auto'` | First day of the week (0 = Sunday, 1 = Monday, ..., 6 = Saturday). `auto` respects locale. |
| `number-of-months` | integer | `1` | Number of months to display side-by-side. |
| `fixed-weeks` | boolean | `false` | Lock all months to 6 rows for consistent layout height. |
| `allow-navigation` | boolean | `true` | Show previous/next month navigation buttons. |
| `highlight-blank-days` | boolean | `true` | Show days from adjacent months in the grid. |
| `with-today` | boolean | `false` | Show a "go to today" button in the header. |
| `selectable` | boolean | `false` | Replace month label with a month/year picker dropdown. |
| `read-only` | boolean | `false` | Disable all interaction (display-only). |
| `disabled` | boolean | `false` | Disable the entire component. |
| `size` | string | `'md'` | Size variant. Options: `xs`, `sm`, `md`, `lg`, `xl`, `2xl`. |

## Data Attributes

| Attribute | Description |
| --------- | ----------- |
| `data-slot="calendar-cell"` | Applied to each selectable day `<button>`. |
| `data-slot="calendar-blank-day-cell"` | Applied to blank days from adjacent months. |
| `data-selected` | Present on a cell when its date is selected. |
| `data-disabled` | Present on a cell when its date is disabled (outside min/max or unavailable). |
| `data-unavailable` | Present on a cell when explicitly marked unavailable (still visible, non-selectable). |
| `data-today` | Present on a cell representing today's date. |
| `data-focused` | Present on the currently focused cell (keyboard navigation). |
| `data-range-middle` | Present on cells between the start and end of a selected range. |
| `data-hover-preview` | Present on cells in the range preview while selecting range end (before click). |
| `data-hover-end` | Present on the hovered cell while selecting range end. |
| `data-first-in-row` | Present on the first cell of each week row. |
| `data-last-in-row` | Present on the last cell of each week row. |
| `data-highlight-blank-days` | Present on blank day cells (inherited from parent config). |

