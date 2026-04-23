---
name: date-picker
---

## Introduction

The `DatePicker` component is a **zero dependencies**, **fully accessible**, and **deeply customizable** that wraps the powerful `Calendar` component with an elegant dialog, preset buttons, and intelligent date formatting. It combines the full feature set of the calendar (single, multiple, and range selection modes) with a polished UI layer that includes preset ranges, smart formatting...

it differ from the calendar of dialog-based date selector with presets, formatting, and positioning. Perfect for triggering from buttons or input fields.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `date-picker` component:

```bash
php artisan sheaf:install date-picker
```

Then import the script in your JS entry point:

```js
// app.js
import './components/date-picker/index.js';
```

import the css (if you haven't did it for the calendar component before):

```css
/* app.css */
@import './components/calendar/cell.css';
```

> Once installed, you can use the `<x-ui.date-picker />` component in any Blade view.

if you're using range mode with livewire, we recomend to register the synthesizer in your service provider so Livewire knows how to serialize the `DateRange` object between requests:

```php
use App\Livewire\Synthesizers\DateRangeSynthesizer;
use Livewire\Livewire;

// ...
public function boot(): void
{
    Livewire::propertySynthesizer(DateRangeSynthesizer::class);
}
```

## Usage
@blade
<x-demo lazy class="flex justify-center">
    <x-ui.date-picker />
</x-demo>
@endblade

### Bind to Livewire

Use `wire:model` to sync the calendar with a Livewire property. The format depends on the mode.

#### Single Mode
```php
public ?string $date = null;
```
```blade
<x-ui.date-picker mode="single" wire:model="date" />             
```

#### Multiple Mode
```php
public array $dates = [];
```
```blade
<x-ui.date-picker mode="multiple" wire:model="dates" />
```

#### Range Mode

**A) Simple associative array** (start + end as ISO strings):
```php
public array $range = ['start' => null, 'end' => null];
```
```blade
<x-ui.date-picker mode="range" wire:model="range" />
```

**B) `DateRange` object** (recommended – provides presets, date methods, and seamless hydration).  
See [The DateRange Synth](#content-the-daterange-synthesizer) for full details.

```php
use App\View\Components\DateRange;
public DateRange $range;

// ....
public function mount(){
    $this->range = new DateRange(start: now(), end: now()->addDays(2));
}

```
```blade
<x-ui.date-picker mode="range" wire:model="range" />
```

### Using with Alpine 

Outside Livewire, bind with `x-model`:

```blade
<!-- Single -->
<div x-data="{ date: null }">
    <x-ui.date-picker x-model="date" />
</div>

<!-- bind durrent's day date -->
<div x-data="{ date: new Date().toISOString() }"> 
    <x-ui.date-picker x-model="date" />
</div>

<!-- Multiple -->
<div x-data="{ dates: [] }">
    <x-ui.date-picker mode="multiple" x-model="dates" />
</div>

<!-- Range (simple object) -->
<div x-data="{ range: { start: null, end: null } }">
    <x-ui.date-picker mode="range" x-model="range" />
</div>
```
## Trigger
## Presets

Date picker includes powerful preset buttons for quick selection of common date ranges. Presets are context-aware and generate the appropriate date range based on today's date.

### Available Presets

```blade
@php
$availablePresets = [
    'today'                => 'Today',
    'yesterday'            => 'Yesterday',
    'this_week'            => 'This Week',
    'last_week'            => 'Last Week',
    'this_month'           => 'This Month',
    'last_month'           => 'Last Month',
    'this_quarter'         => 'This Quarter',
    'last_quarter'         => 'Last Quarter',
    'this_year'            => 'This Year',
    'last_year'            => 'Last Year',
    'last_3_days'          => 'Last 3 Days',
    'last_7_days'          => 'Last 7 Days',
    'last_14_days'         => 'Last 14 Days',
    'last_30_days'         => 'Last 30 Days',
    'last_90_days'         => 'Last 90 Days',
    'last_3_months'        => 'Last 3 Months',
    'last_6_months'        => 'Last 6 Months',
    'year_to_date'         => 'Year to Date',
    'last_week_to_date'    => 'Last Week to Date',
    'last_month_to_date'   => 'Last Month to Date',
    'last_quarter_to_date' => 'Last Quarter to Date',
    'next_7_days'          => 'Next 7 Days',
    'next_30_days'         => 'Next 30 Days',
    'next_month'           => 'Next Month',
    'next_quarter'         => 'Next Quarter',
    'next_year'            => 'Next Year',
    'all'                  => 'All Time',
    'custom'               => 'Custom Range',
];
@endphp
```

### Customize Displayed Presets

Pass a comma-separated string or array to show only specific presets:

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.date-picker 
        mode="range"
        :presets="['today', 'yesterday', 'this_week', 'last_week', 'this_month', 'last_month']"
    />
</x-demo>
@endblade

```blade
{{-- Array style --}}
<x-ui.date-picker 
    mode="range"
    :presets="['today', 'this_week', 'this_month', 'last_month']"
/>

{{-- String style (comma-separated) --}}
<x-ui.date-picker 
    mode="range"
    presets="today,this_week,this_month,last_month"
/>
```

### Presets in Different Modes

- **Single mode** - Presets select a single date (e.g., "today", "yesterday")
- **Range mode** - Presets select a full date range (e.g., "this_month" → start to end of month)
- **Multiple mode** - Not typically used with presets (multiple selection is inherently click-based)

> **Tip:** When a preset is selected in single mode, the date picker automatically closes. In range mode, it stays open so you can continue refining the selection.



## Smart Date Formatting

The date picker automatically formats selected dates in human-readable format:

- **Today** - Shows "Today"
- **Tomorrow** - Shows "Tomorrow"
- **Yesterday** - Shows "Yesterday"
- **Other dates** - Shows formatted date like "Apr 15, 2026"

### Range Formatting

When a date range is selected, the display format adapts to show both dates efficiently:

```
Same month & year:  Apr 12 → 25, 2026
Same year only:     Apr 12 → Jun 5, 2026
Different years:    Apr 12, 2026 → Jan 5, 2027
```

### Customize Range Separator

Change the separator between start and end date in range display:

@blade
<x-demo lazy class="flex gap-4 justify-center">
    <x-ui.date-picker mode="range" separator="→" />
    <x-ui.date-picker mode="range" separator="-" />
    <x-ui.date-picker mode="range" separator="to" />
</x-demo>
@endblade

```blade
{{-- Different separators --}}
<x-ui.date-picker mode="range" separator="→" />    {{-- Arrow (default) --}}
<x-ui.date-picker mode="range" separator="-" />    {{-- Dash --}}
<x-ui.date-picker mode="range" separator="to" />   {{-- Text --}}
```

## Constraints & Validation

### Min & Max Dates

Restrict the selectable date range by setting `min` and `max`. Dates outside this range are disabled and cannot be selected.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.date-picker min="2026-04-05" max="2026-04-25" />
</x-demo>
@endblade

```blade
<x-ui.date-picker 
    min="2026-04-05" 
    max="2026-04-25" 
    wire:model="date" 
/>
```

### Unavailable Dates

Mark specific dates as unavailable (visible but disabled) using a comma-separated array of ISO date strings.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.date-picker :unavailable-dates="['2026-04-15', '2026-04-20', '2026-04-25']" />
</x-demo>
@endblade

```blade
<x-ui.date-picker :unavailable-dates="$blockedDates" wire:model="date" />
```

### Range Constraints

In `range` mode, enforce minimum and maximum range lengths with `min-range` and `max-range` (both in days).

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.date-picker mode="range" :min-range="3" :max-range="14" />
</x-demo>
@endblade

```blade
{{-- Require at least 3 days, at most 2 weeks --}}
<x-ui.date-picker 
    mode="range" 
    :min-range="3" 
    :max-range="14"
    wire:model="range"
/>
```

## Months & Navigation

### Display Multiple Months

Show multiple months side-by-side for easier date browsing.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.date-picker :months="2" mode="range" />
</x-demo>
@endblade

```blade
{{-- Show 2 months side-by-side --}}
<x-ui.date-picker :months="2" mode="range" wire:model="range" />

{{-- Show 3 months --}}
<x-ui.date-picker :months="3" wire:model="date" />
```

### Open To Date

Set the initial month the date picker opens to using `open-to`.

```blade
{{-- Open to September 2028 when no date is selected --}}
<x-ui.date-picker open-to="2028-09-01" wire:model="date" />

{{-- Always open to this date, even if a date is already selected --}}
<x-ui.date-picker open-to="2028-09-01" force-open-to wire:model="date" />
```

### Navigation Controls

Disable month navigation buttons if needed.

```blade
<x-ui.date-picker :allow-navigation="false" />
```

### Selectable Months & Years

Enable dropdown selectors for quick jumps to specific months and years.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.date-picker selectable-months selectable-years />
</x-demo>
@endblade

```blade
<x-ui.date-picker selectable-months selectable-years wire:model="date" />
```

## Appearance & UX

### Size Variants

Choose from multiple sizes to fit different UI contexts.

```blade
<x-ui.date-picker size="xs" />
<x-ui.date-picker size="sm" />
<x-ui.date-picker size="md" />  {{-- default --}}
<x-ui.date-picker size="lg" />
<x-ui.date-picker size="xl" />
<x-ui.date-picker size="2xl" />
```

### Today Button

Show a button to jump to today's date.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.date-picker :with-today="true" />
</x-demo>
@endblade

```blade
<x-ui.date-picker :with-today="true" wire:model="date" />
```

### Week Numbers

Display ISO 8601 week numbers for project planning and reporting.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.date-picker week-numbers />
</x-demo>
@endblade

```blade
<x-ui.date-picker week-numbers wire:model="date" />
```

### Fixed Week Heights

Lock all months to a consistent layout height (6 rows) for stable layouts.

```blade
<x-ui.date-picker :fixed-weeks="true" :months="2" wire:model="date" />
```

### Readonly

Display the date picker without allowing interaction.

```blade
<x-ui.date-picker readonly />
```

## Localization

### Set Locale

Override the browser's default locale to control weekday names and the first day of the week.

@blade
<x-demo lazy class="flex gap-4 justify-center">
    <x-ui.date-picker locale="ar-Ma" mode="range" />
    <x-ui.date-picker locale="fr-Ma" mode="range" />
</x-demo>
@endblade

```blade
<x-ui.date-picker locale="ar-Ma" wire:model="date" />
<x-ui.date-picker locale="fr-Ma" wire:model="date" />
```

### Custom Week Start

Override the locale-determined first day of the week.

```blade
{{-- Force Monday as first day regardless of locale --}}
<x-ui.date-picker locale="en-US" :start-day="1" wire:model="date" />
```

## Special Days

Mark specific dates with custom categories for styling, disabling, and tooltips. This is especially useful for booking systems where you need to highlight holidays, unavailable dates, or special events.

### Mark Special Dates with Color

Pass a `special-days` associative array where each key is a category name.

@blade
<x-demo lazy class="flex justify-center">
    <div class="[&_[data-special~=holiday]]:text-yellow-600 [&_[data-special~=birthday]]:text-pink-500 [&_[data-special~=blocked]]:text-red-500">
        <x-ui.date-picker 
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
    [&_[data-special~=holiday]]:text-yellow-600 
    [&_[data-special~=birthday]]:text-pink-500 
    [&_[data-special~=blocked]]:text-red-500
">
    <x-ui.date-picker 
        :special-days="[
            'holiday'   => ['2026-04-20', '2026-04-21'],
            'birthday'  => ['2026-04-15'],
            'blocked'   => ['2026-04-25', '2026-04-27'],
        ]"
    />
</div>
```

### Disable Specific Categories

Prevent selection of certain special day categories.

```blade
<x-ui.date-picker 
    :special-days="[
        'holiday'   => ['2026-04-20', '2026-04-21'],
        'blocked'   => ['2026-04-25'],
    ]"
    :special-disabled="['blocked']"
/>
```

Now dates with the `blocked` category cannot be selected, while holidays remain selectable.

### Add Tooltips

Show helpful text on hover for special day categories.

@blade
<x-demo lazy class="flex justify-center">
    <div class="[&_[data-special~=holiday]]:text-yellow-600 [&_[data-special~=blocked]]:text-red-500">
        <x-ui.date-picker 
            :special-days="[
                'holiday'   => ['2026-04-20'],
                'blocked'   => ['2026-04-25'],
            ]"
            :special-disabled="['blocked']"
            :special-tooltips="[
                'blocked' => 'Already booked',
                'holiday' => 'Public holiday',
            ]"
        />
    </div>
</x-demo>
@endblade

```blade
<x-ui.date-picker 
    :special-days="[...]"
    :special-disabled="['blocked']"
    :special-tooltips="[
        'blocked' => 'Blocked day – unavailable',
        'holiday' => 'Public holiday',
        'birthday' => 'Birthday celebration 🎂',
    ]"
/>
```

Control where the date picker dialog appears relative to the trigger button using the `position` and `offset` props.

@blade
<x-demo lazy class="flex gap-4 justify-center">
    <x-ui.date-picker position="bottom-start" />
    <x-ui.date-picker position="bottom-end" />
    <x-ui.date-picker position="top-start" />
</x-demo>
@endblade

```blade
{{-- Bottom-left (default) --}}
<x-ui.date-picker position="bottom-start" offset="3" />

{{-- Bottom-right --}}
<x-ui.date-picker position="bottom-end" offset="3" />

{{-- Top-left --}}
<x-ui.date-picker position="top-start" offset="3" />

{{-- Top-right --}}
<x-ui.date-picker position="top-end" offset="3" />
```

Available positions: `top-start`, `top`, `top-end`, `bottom-start`, `bottom`, `bottom-end`, `left-start`, `left`, `left-end`, `right-start`, `right`, `right-end`.


## Component Props

### x-ui.date-picker

| Prop | Type | Default | Description |
| ---- | ---- | ------- | ----------- |
| `trigger` | slot | `null` | Custom trigger element. If not provided, a default button is shown. |
| `label` | string | `'select a date'` | Label text for the default trigger button. |
| `position` | string | `'bottom-start'` | Dialog position relative to trigger. Options: `top-start`, `top`, `top-end`, `bottom-start`, `bottom`, `bottom-end`, `left-start`, `left`, `left-end`, `right-start`, `right`, `right-end`. |
| `offset` | integer | `3` | Distance in pixels between dialog and trigger. |
| `presets` | array\|string | `[]` | Preset keys to display. Pass as array or comma-separated string. Leave empty to hide presets. |
| `separator` | string | `'→'` | Separator text between start and end date in range display. |
| `wire:model` | string | — | Binds to a Livewire property. Value format depends on mode. |
| `mode` | string | `'single'` | Selection mode. Options: `single`, `multiple`, `range`. |
| `min` | string | `null` | Earliest selectable date as `YYYY-MM-DD`. |
| `max` | string | `null` | Latest selectable date as `YYYY-MM-DD`. |
| `min-range` | integer | `null` | Minimum range length in days (range mode only). |
| `max-range` | integer | `null` | Maximum range length in days (range mode only). |
| `unavailable-dates` | array\|string | `[]` | Array or comma-separated list of unavailable dates as `YYYY-MM-DD`. |
| `special-days` | array | `[]` | Associative array of category keys → arrays of ISO date strings. |
| `special-disabled` | array | `[]` | List of category keys that should be non‑selectable (disabled). |
| `special-tooltips` | array | `[]` | Associative array of category keys → tooltip text. |
| `locale` | string | `'auto'` | BCP‑47 locale for weekday names and first day of week. `auto` uses `navigator.language`. |
| `start-day` | integer\|string | `'auto'` | First day of the week (0 = Sunday, 1 = Monday, …, 6 = Saturday). `auto` respects locale. |
| `months` | integer | `1` | Number of months to display side‑by‑side. |
| `fixed-weeks` | boolean | `false` | Lock all months to 6 rows for consistent layout height. |
| `allow-navigation` | boolean | `true` | Show previous/next month navigation buttons. |
| `with-today` | boolean | `false` | Show a "go to today" button. |
| `selectable-months` | boolean | `false` | Show month selector dropdown. |
| `selectable-years` | boolean | `false` | Show year selector dropdown. |
| `years-range` | array | `[-10, 10]` | Range of selectable years. Values ≤ 100 are relative offsets from current year. |
| `readonly` | boolean | `false` | Disable all interaction (display‑only). |
| `size` | string | `'md'` | Size variant. Options: `xs`, `sm`, `md`, `lg`, `xl`, `2xl`. |
| `open-to` | string | `null` | Date (`YYYY-MM-DD`) the calendar opens to when no date is selected. |
| `force-open-to` | boolean | `false` | When `true`, forces calendar to always open to `open-to`, even if a date is selected. |
| `week-numbers` | boolean | `false` | Show ISO week numbers in a separate column. |
| `top-inputs` | boolean | `false` | Show date input field(s) above the calendar for direct keyboard entry. Note: typically handled by presets and formatting in date picker. |

## Advanced Usage

### Combining Presets with Constraints

Use presets with date constraints to create a restricted date picker:

```blade
{{-- Allow selection only within the current year with preset options --}}
<x-ui.date-picker 
    mode="range"
    open-to="2026-01-01"
    min="2026-01-01"
    max="2026-12-31"
    :presets="['this_month', 'last_month', 'this_quarter']"
    wire:model="range"
/>
```

### Complex Special Days Scenario

Use special days for a booking system where customers can see available, booked, and featured dates:

```blade
@php
$bookedDates = app(BookingRepository::class)->getBookedDates();
$featuredDates = app(PropertyRepository::class)->getFeaturedDates();

// Today onwards to 1 year from now
$minDate = now()->format('Y-m-d');
$maxDate = now()->addYear()->format('Y-m-d');
@endphp

<div class="[&_[data-special~=booked]]:line-through [&_[data-special~=booked]]:opacity-50 [&_[data-special~=featured]]:font-bold [&_[data-special~=featured]]:text-amber-600">
    <x-ui.date-picker 
        mode="range"
        :min-range="2"
        :max-range="14"
        :min="$minDate"
        :max="$maxDate"
        :special-days="[
            'booked' => $bookedDates,
            'featured' => $featuredDates,
        ]"
        :special-disabled="['booked']"
        :special-tooltips="[
            'booked' => 'Already reserved',
            'featured' => 'Special rate available!',
        ]"
        wire:model="stay"
    />
</div>
```

### Mobile-Responsive Date Picker

The date picker is responsive by default, but you can optimize it for mobile:

```blade
{{-- Single month on mobile, multiple on desktop --}}
<x-ui.date-picker 
    mode="range"
    :months="request()->is('api/*') ? 1 : 2"
    size="sm"
    position="bottom-center"
    :presets="['today', 'this_week', 'this_month', 'last_month']"
/>
```

## Common Patterns

### Analytics Date Range Picker

```php
// In your Livewire component
public DateRange $reportRange;

public function mount()
{
    $this->reportRange = new DateRange(
        start: now()->subDays(30)->format('Y-m-d'),
        end: now()->format('Y-m-d')
    );
}
```

```blade
<x-ui.date-picker 
    mode="range"
    :presets="['last_7_days', 'last_30_days', 'last_90_days', 'year_to_date']"
    wire:model="reportRange"
/>
```

### Vacation Request Picker

```blade
<x-ui.date-picker 
    mode="range"
    :min-range="1"
    :unavailable-dates="$companyHolidays"
    :special-days="['holiday' => $publicHolidays]"
    :special-disabled="['holiday']"
    wire:model="vacationDates"
/>
```

### Appointment Scheduler

```blade
{{-- Show first available date, hide weekends, disable booked dates --}}
<x-ui.date-picker 
    mode="single"
    open-to="$nextAvailableDate"
    :unavailable-dates="$bookedSlots"
    :special-days="['weekend' => $weekendDates]"
    :special-disabled="['weekend']"
    size="sm"
    wire:model="appointmentDate"
/>
```

## Data Attributes

The date picker dialog and underlying calendar both expose data attributes for advanced CSS customization:

| Attribute | Applied To | Description |
| --------- | ---------- | ----------- |
| `data-slot="calendar-cell"` | Date button | Present on each selectable day. |
| `data-selected` | Date button | Present when the date is selected. |
| `data-disabled` | Date button | Present when the date is disabled (outside min/max). |
| `data-today` | Date button | Present on today's date. |
| `data-focused` | Date button | Present on the keyboard-focused date. |
| `data-range-middle` | Date button | Present on dates within a selected range. |
| `data-hover-preview` | Date button | Present on dates in the range preview (before finalized). |
| `data-special` | Date button | Present on special days. Value is space-separated category keys. |
| `data-selected` | Preset button | Present on the active preset. |

## Accessibility

The date picker inherits all calendar accessibility features:

- **ARIA Labels** - All controls have appropriate `aria-label`, `aria-selected`, and `aria-disabled` attributes
- **Keyboard Navigation** - Full keyboard support with arrow keys, Enter, Space, Tab, and Escape
- **Screen Readers** - Current month/year announced via live region
- **Focus Management** - Focus trapped in dialog, returned to trigger on close
- **Semantic HTML** - Proper heading levels, button roles, and grid semantics

## Performance

The date picker uses efficient rendering techniques:

- **Memoized selection cache** - Avoids rebuilding lookups on every access
- **Efficient re-rendering** - Only the affected months re-render on navigation
- **Static utilities** - Keeps Alpine proxy issues at a minimum
- **Lazy initialization** - Preset sidebar height dynamically matches calendar

For datasets with hundreds of special dates, consider batching them into categories rather than rendering individual dates.

## Troubleshooting

### Date picker not responding to `wire:model`

Ensure you're using the correct binding format:
- Single mode: `$selectedDate` should be `?string`
- Range mode: `$range` should be `array` with `['start' => null, 'end' => null]`
- Multiple mode: `$dates` should be `array`

### Presets not appearing

Check that:
1. You passed valid preset keys to the `presets` prop
2. The preset keys are spelled correctly (lowercase with underscores)
3. You're not in multiple mode (presets are for single and range only)

### Dialog positioned incorrectly

Use the `position` and `offset` props to adjust. If still misaligned, check that the trigger element isn't inside a positioned ancestor with `overflow: hidden`.

## Examples in Real Applications

See the SheafUI component library documentation for integration examples with Livewire forms, Alpine components, and standalone HTML.
