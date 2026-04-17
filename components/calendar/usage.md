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
<x-demo lazy class="flex justify-center">
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
<x-demo lazy class="flex justify-center">
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
<x-demo lazy class="flex justify-center">
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
<x-demo lazy class="flex justify-center">
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
<x-demo lazy class="flex justify-center">
    <x-ui.calendar min="2026-04-01" max="2026-04-30" />
</x-demo>
@endblade

```blade
<x-ui.calendar min="2026-04-01" max="2026-04-30" wire:model="date" />
```

## Unavailable Dates

Mark specific dates as unavailable (greyed out, non-selectable) using a comma-separated array of ISO date strings. Unlike `min`/`max`, unavailable dates are visible but disabled.

@blade
<x-demo lazy class="flex justify-center">
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
<x-demo lazy class="flex justify-center">
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



## Selectable Months and Years

Enable dropdown selectors for quick month and year navigation with `selectable-months` and `selectable-years`. These provide an alternative to clicking through months with navigation buttons, especially useful for calendars spanning multiple years or when users need to jump to a specific date quickly.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.calendar selectable-months selectable-years :years-range="[-10, 10]" />
</x-demo>
@endblade

```blade
{{-- Show both month and year selectors --}}
<x-ui.calendar 
    selectable-months 
    selectable-years 
    :years-range="[-10, 10]"
    wire:model="date" 
/>

{{-- Only year selector --}}
<x-ui.calendar 
    selectable-years 
    :years-range="[2020, 2030]"
    wire:model="date" 
/>
```

### Years Range Configuration

The `years-range` prop accepts an array with two values `[start, end]`:
- **Relative offsets**: Values with absolute value ≤ 100 are treated as offsets from the current year. For example, `[-10, 10]` shows years from 10 years ago to 10 years in the future.
- **Absolute years**: Larger values (e.g., `2020`) are treated as absolute year numbers. For example, `[2020, 2030]` shows years 2020 through 2030.

When multiple months are displayed, the month and year selectors appear only in the first month's header to avoid duplication.

## Open To Date

By default, when no date is selected, the calendar opens to the current month. Use `open-to` to set a specific date the calendar should open to instead.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.calendar open-to="2028-09-01" />
</x-demo>
@endblade

```blade
{{-- Open to a future month when no date is selected --}}
<x-ui.calendar open-to="2028-09-01" wire:model="date" />
```

If the user already has a selected date, `open-to` is ignored — the calendar will still scroll to the selected date. Add the `force-open-to` flag to make the calendar always open to the `open-to` date regardless of selection:

```blade
{{-- Always open to this date, even if a date is already selected --}}
<x-ui.calendar open-to="2026-09-01" force-open-to wire:model="date" />
```





## Multi-Month Display

Show multiple months side-by-side for easier range selection or date browsing. Set `number-of-months` to the desired count.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.calendar :number-of-months="2" mode="range" />
</x-demo>
@endblade

```blade
{{-- Show 2 months side-by-side (great for range mode) --}}
<x-ui.calendar :number-of-months="2" mode="range" wire:model="dateRange" />

{{-- Show 3 months --}}
<x-ui.calendar :number-of-months="3" mode="multiple" wire:model="dates" />
```

## Fixed Week Heights

By default, calendar months have variable heights (4–6 rows depending on the number of weeks). Set `fixed-weeks` to lock all rendered months to a consistent week number, which prevents layout shift when navigating.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.calendar fixed-weeks :number-of-months="2" />
</x-demo>
@endblade

```blade
<x-ui.calendar :fixed-weeks="true" wire:model="date" />
```
## Week Numbers

Display ISO 8601 week numbers in a dedicated column on the left side of the calendar. This is especially useful for business reports, payroll, project planning, and any application that relies on week‑based scheduling.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.calendar week-numbers  />
</x-demo>
@endblade

```blade
{{-- Show week numbers in a single month --}}
<x-ui.calendar week-numbers wire:model="date" />

```

The calendar follows the **ISO 8601** standard:
- Weeks start on **Monday** (regardless of your `start-day` setting – the week number column always uses ISO weeks).
- Week 1 of any year is the week that contains the first **Thursday** of that year.
- Weeks are numbered from 1 to 52 or 53.

> **Note:** Because the week number is taken from the **first day of each calendar row** (which is Sunday if your `start-day` is 0), you may see week 53 in January for rows that start in the previous year.

## Navigation

By default, the calendar displays navigation buttons (previous/next month). Disable them with `allow-navigation="false"`.

```blade
{{-- Hide navigation buttons --}}
<x-ui.calendar :allow-navigation="false" wire:model="date" />
```

## Localization

By default the calendar uses the browser locale (`navigator.language`). Override it with any valid BCP-47 locale string. Locale affects both the weekday names and the first day of the week.

@blade
<x-demo lazy class="flex gap-4 justify-center">
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

The calendar comes in multiple sizes to fit different UI contexts (`'xs'`,`'sm'`,`'md'`,`'lg'`,`'xl'`,`'2xl'`).

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

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.calendar read-only />
</x-demo>
@endblade


```blade
<x-ui.calendar :read-only="true"  wire:model="date" />
```

## Today Button

Show a "Go to today" button in the top-right corner of the calendar with `with-today`.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.calendar :with-today="true" />
</x-demo>
@endblade

```blade
<x-ui.calendar :with-today="true" wire:model="date" />
```

## Special Days

Mark specific dates with custom categories (e.g., `holiday`, `birthday`, `blocked`). Style them with Tailwind, optionally disable selection for certain categories, and add tooltips.

### Static Special Dates with Color

Pass a `special-days` associative array. Each date gets a `data-special` attribute with space‑separated category names. Use Tailwind’s arbitrary variant `[&_[data-special~=...]]` to style.

@blade
<x-demo lazy class="flex justify-center">
    <div class="[&_[data-special~=holiday]]:text-yellow-600 [&_[data-special~=birthday]]:text-pink-500 [&_[data-special~=blocked]]:text-red-500">
        <x-ui.calendar 
            mode="multiple"
            open-to="2026-04-01"
            :special-days="[
                'holiday'   => ['2026-04-20', '2026-04-21'],
                'birthday'  => ['2026-04-15'],
                'blocked'   => ['2026-04-25', '2026-04-27'],
            ]"
        />
    </div>
</x-demo>
@endblade

```blade
<div class="
            <!-- get holidays yellow colors -->
            [&_[data-special~=holiday]]:text-yellow-600 

            <!-- get birthday pink colors -->
            [&_[data-special~=birthday]]:text-pink-500 
            
            <!-- get blocked red colors -->
            [&_[data-special~=blocked]]:text-red-500">
    <x-ui.calendar 
        :special-days="[
            'holiday'   => ['2026-04-20', '2026-04-21'],
            'birthday'  => ['2026-04-15'],
            'blocked'   => ['2026-04-25', '2026-04-27'],
        ]"
    />
</div>
```


### Disable Specific Categories

Prevent selection of certain special days by adding `special-disabled` with the category keys.

@blade
<x-demo lazy class="flex justify-center">
    <div class="[&_[data-special~=holiday]]:text-yellow-600 
                [&_[data-special~=birthday]]:text-pink-500 
                [&_[data-special~=blocked]]:text-red-500">
        <x-ui.calendar 
            mode="multiple"
            :special-days="[
                'holiday'   => ['2026-04-20', '2026-04-21'],
                'birthday'  => ['2026-04-15'],
                'blocked'   => ['2026-04-25', '2026-04-27'],
            ]"
            :special-disabled="['blocked']"
            fixed-weeks
        />
    </div>
</x-demo>
@endblade

```blade
<x-ui.calendar 
    :special-days="[...]"
    :special-disabled="['blocked']"
/>
```
Now days with the `blocked` category are non‑selectable (disabled), while holidays and birthdays remain selectable.


### Add Tooltips

Provide tooltip text for each category using `special-tooltips`. The tooltip appears on hover.

@blade
<x-demo lazy class="flex justify-center">
    <div class="[&_[data-special~=holiday]]:text-yellow-600 
                [&_[data-special~=birthday]]:text-pink-500 
                [&_[data-special~=blocked]]:text-red-500">
        <x-ui.calendar 
            mode="multiple"
            :special-days="[
                'holiday'   => ['2026-04-20', '2026-04-21'],
                'birthday'  => ['2026-04-15'],
                'blocked'   => ['2026-04-25', '2026-04-27'],
            ]"
            :special-disabled="['blocked']"
            :special-tooltips="[
                'blocked' => 'Blocked day – unavailable',
                'holiday' => 'Public holiday',
                'birthday' => 'Birthday celebration 🎂',
            ]"
        />
    </div>
</x-demo>
@endblade

```blade
<x-ui.calendar 
    :special-days="[...]"
    :special-disabled="['blocked']"
    :special-tooltips="[
        'blocked' => 'Blocked day – unavailable',
        'holiday' => 'Public holiday',
        'birthday' => 'Birthday celebration 🎂',
    ]"
/>
```

**Tooltip precedence:** If a day belongs to multiple categories, the tooltip from the **first matching key** in `special-tooltips` is shown.

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
| `special-days` | array | `[]` | Associative array of category keys → arrays of ISO date strings. Adds `data-special` attribute to each day. |
| `special-disabled` | array | `[]` | List of category keys that should be non‑selectable (disabled). |
| `special-tooltips` | array | `[]` | Associative array of category keys → tooltip text. Tooltip appears on hover. |
| `locale` | string | `'auto'` | BCP‑47 locale for weekday names and first day of week. `auto` uses `navigator.language`. |
| `start-day` | integer\|string | `'auto'` | First day of the week (0 = Sunday, 1 = Monday, …, 6 = Saturday). `auto` respects locale. |
| `number-of-months` | integer | `1` | Number of months to display side‑by‑side. |
| `fixed-weeks` | boolean | `false` | Lock all months to 6 rows for consistent layout height. |
| `allow-navigation` | boolean | `true` | Show previous/next month navigation buttons. |
| `highlight-blank-days` | boolean | `true` | Show days from adjacent months in the grid. |
| `with-today` | boolean | `false` | Show a “go to today” button in the header. |
| `selectable-months` | boolean | `false` | Show month selector dropdown in the calendar header. |
| `selectable-years` | boolean | `false` | Show year selector dropdown in the calendar header. |
| `years-range` | array | `[-10, 10]` | Range of selectable years as `[start, end]`. Values ≤ 100 are relative offsets from current year; larger values are absolute years. |
| `read-only` | boolean | `false` | Disable all interaction (display‑only). |
| `size` | string | `'md'` | Size variant. Options: `xs`, `sm`, `md`, `lg`, `xl`, `2xl`. |
| `open-to` | string | `null` | Date (`YYYY-MM-DD`) the calendar opens to when no date is selected. Ignored if a date is already selected. |
| `force-open-to` | boolean | `false` | When `true`, forces the calendar to always open to the `open-to` date, even if a date is selected. Requires `open-to`. |
| `week-numbers` | boolean | `false` | Show ISO week numbers in a separate column. |

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
| `data-special` | Present on cells that have at least one special category. Value is a space‑separated list of category keys (e.g., `"holiday birthday"`). |
| `data-has-tooltip` | Present on cells that have a tooltip (from `special-tooltips`). Useful for CSS selectors like `[data-has-tooltip]:hover [data-special-tooltip]`. |
| `data-slot="calendar-week-num-cell"` | Applied to each week number cell. |