---
name: calendar
---

## Introduction

The `Calendar` component is a **zero dependencies**, **fully-featured**, **accessible** calendar with support for single, multiple, and range selection modes. It integrates seamlessly with Livewire via `wire:model` and Alpine via `x-model`, with built-in constraints for min/max dates, unavailable dates, and range length validation and much much more.

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

import the css:

```css
/* app.css */
@import './components/calendar/cell.css';
```

> Once installed, you can use the `<x-ui.calendar />` component in any Blade view.

If you're using range mode with livewire, we recomend to register the synthesizer in your service provider so Livewire knows how to serialize the `DateRange` object between requests:

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
    <x-ui.calendar />
</x-demo>
@endblade

### Bind to Livewire

Use `wire:model` to sync the calendar with a Livewire property. The format depends on the mode.

#### Single Mode
```php
public ?string $date = null;
```
```blade
<x-ui.calendar mode="single" wire:model="date" />             
```

#### Multiple Mode
```php
public array $dates = [];
```
```blade
<x-ui.calendar mode="multiple" wire:model="dates" />
```

#### Range Mode

**A) Simple associative array** (start + end as ISO strings):
```php
public array $range = ['start' => null, 'end' => null];
```
```blade
<x-ui.calendar mode="range" wire:model="range" />
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
<x-ui.calendar mode="range" wire:model="range" />
```

### Using with Alpine 

Outside Livewire, bind with `x-model`:

```blade
<!-- Single -->
<div x-data="{ date: null }">
    <x-ui.calendar x-model="date" />
</div>

<!-- bind durrent's day date -->
<div x-data="{ date: new Date().toISOString() }"> 
    <x-ui.calendar x-model="date" />
</div>

<!-- Multiple -->
<div x-data="{ dates: [] }">
    <x-ui.calendar mode="multiple" x-model="dates" />
</div>

<!-- Range (simple object) -->
<div x-data="{ range: { start: null, end: null } }">
    <x-ui.calendar mode="range" x-model="range" />
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

### Multiple Selection

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.calendar mode="multiple" />
</x-demo>
@endblade

```blade
<x-ui.calendar mode="multiple" wire:model="dates" />
```

### Range Selection

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.calendar mode="range" />
</x-demo>
@endblade

```blade
<x-ui.calendar mode="range" wire:model="dateRange" />
```
## Min / Max Dates

Restrict the selectable date range with `min` and `max`. Both accept ISO date strings `YYYY-MM-DD`. Dates outside this range are disabled and non-selectable.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.calendar min="2026-04-05" open-to="2026-04-01"  max="2026-04-25" />
</x-demo>
@endblade

```blade
<x-ui.calendar min="2026-04-05" max="2026-04-25" wire:model="date" />
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


## Readonly

Prevent all interaction by disabling the component entirely. Calendar remains visible for display purposes.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.calendar readonly />
</x-demo>
@endblade


```blade
<x-ui.calendar readonly wire:model="date" />
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


## With Inputs
Add date input fields above the calendar for direct keyboard entry with `top-inputs`. Inputs support full keyboard navigation — arrow keys increment/decrement each segment, and typing auto-advances between segments.


### Single Mode

In single mode, one input field is displayed. The value stays in sync with the calendar — clicking a date updates the input, and typing in the input updates the calendar.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.calendar top-inputs mode="single" />
</x-demo>
@endblade

```blade
<x-ui.calendar top-inputs mode="single" wire:model="date" />
```

### Range Mode

In range mode, two inputs are displayed — one for the start date and one for the end date. Each input is independently editable and stays in sync with the calendar selection.

@blade
<x-demo lazy class="flex justify-center">
    <x-ui.calendar top-inputs mode="range" :number-of-months="2"  />
</x-demo>
@endblade

```blade
<x-ui.calendar top-inputs mode="range" :number-of-months="2" wire:model="dateRange" />
```

> **Note:** `top-inputs` is not supported in `multiple` mode. 
> Multiple date selection is inherently click-based

### Custom Separator

By default, date segments are separated by `-` (`yyyy-mm-dd`). Use the `separator` prop to change the display separator in the inputs.

@blade
<x-demo lazy class="flex gap-4 justify-center">
    <x-ui.calendar top-inputs separator="/" />
</x-demo>
@endblade

```blade
{{-- Display as yyyy/mm/dd --}}
<x-ui.calendar top-inputs separator="/" wire:model="date" />
```

> The separator only affects the **display format** in the inputs. The value bound to `wire:model` or `x-model` is always ISO `YYYY-MM-DD` regardless of separator.


##  The `DateRange` Synthesizer

When using `mode="range"` with Livewire, we recommend binding the calendar to a `DateRange` object instead of a raw `['start'=>'...', 'end'=>'...']`. This powerful object extends Laravel's `CarbonPeriod` and provides a rich API for working with date ranges.

#### Installation

First, register the synthesizer in your service provider:

```php
use App\Livewire\Synthesizers\DateRangeSynthesizer;
use Livewire\Livewire;

// ...
public function boot(): void
{
    Livewire::propertySynthesizer(DateRangeSynthesizer::class);
}
```

#### Basic Usage

In your Livewire component, type-hint the property:

```php
use App\View\Components\DateRange;

class Dashboard extends Component
{
    public DateRange $range;

    public function mount()
    {
        // Initialize as empty range
        $this->range = new DateRange();
        
        // Or initialize with specific dates
        $this->range = new DateRange('2026-04-15', '2026-04-25');
        
        // Or using Carbon instances
        $this->range = new DateRange(now()->subDays(1), now()->addDays(4));
    }
}
```

Then bind it to your calendar view:

```blade
<flux:calendar mode="range" wire:model.live="range" />
```

#### Core Methods

```php
// Get the start date as a Y-m-d string (or null if not set)
$start = $this->vacation->getStart(); // e.g., "2026-04-15"

// Get the end date as a Y-m-d string (or null if not set)
$end = $this->vacation->getEnd();     // e.g., "2026-04-25"

// Check if the range has a start date
if ($this->vacation->hasStart()) {
    // Start is set
}

// Check if the range has an end date
if ($this->vacation->hasEnd()) {
    // End is set
}

// Get the preset used to create this range (e.g., DateRangePreset::ThisWeek)
$preset = $this->vacation->getPreset();

// Manually set the preset (e.g., after modifying dates)
$this->vacation->preset(DateRangePreset::Custom);

// Create a new range with only a start date
$partial = DateRange::setStart('2026-04-15'); // end will be null

// Create a new range with only an end date
$partial = DateRange::setEnd('2026-04-25');   // start will be null

```


#### Advanced Use Cases

Because `DateRange` extends `CarbonPeriod`, you can leverage its full power.

##### Iterating Over the Range

```php
foreach ($this->range as $date) {
    echo $date->format('Y-m-d'); // Each $date is a Carbon instance
}
```

##### Filtering the Range

Use `addFilter()` to include or exclude specific days. For example, to get all weekdays within a range:

```php
$weekdays = $this->range->addFilter('isWeekday')->toArray();
```

##### Using with Eloquent

The `DateRange` object works directly with `whereBetween`:

```php
use App\Models\Booking;

$bookings = Booking::whereBetween('date', $this->range)->get();
```

##### Validating the Range

```php
use Illuminate\Validation\Validator;

public function rules(): array
{
    return [
        'vacation.start' => 'required|date_format:Y-m-d',
        'vacation.end' => 'required|date_format:Y-m-d|after:vacation.start',
    ];
}
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
| `with-today` | boolean | `false` | Show a “go to today” button in the header. |
| `selectable-months` | boolean | `false` | Show month selector dropdown in the calendar header. |
| `selectable-years` | boolean | `false` | Show year selector dropdown in the calendar header. |
| `years-range` | array | `[-10, 10]` | Range of selectable years as `[start, end]`. Values ≤ 100 are relative offsets from current year; larger values are absolute years. |
| `readonly` | boolean | `false` | Disable all interaction (display‑only). |
| `size` | string | `'md'` | Size variant. Options: `xs`, `sm`, `md`, `lg`, `xl`, `2xl`. |
| `open-to` | string | `null` | Date (`YYYY-MM-DD`) the calendar opens to when no date is selected. Ignored if a date is already selected. |
| `force-open-to` | boolean | `false` | When `true`, forces the calendar to always open to the `open-to` date, even if a date is selected. Requires `open-to`. |
| `week-numbers` | boolean | `false` | Show ISO week numbers in a separate column. |
| `top-inputs` | boolean | `false` | Show date input field(s) above the calendar for direct keyboard entry. In `range` mode, two inputs are shown (start and end). |
| `separator` | string | `'-'` | Segment separator used in the input display. Common values: `'-'`, `'/'`, `'.'`. Does not affect the bound value format. |

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
| `data-special` | Present on cells that have at least one special category. Value is a space‑separated list of category keys (e.g., `"holiday birthday"`). |
| `data-has-tooltip` | Present on cells that have a tooltip (from `special-tooltips`). Useful for CSS selectors like `[data-has-tooltip]:hover [data-special-tooltip]`. |
| `data-slot="calendar-week-num-cell"` | Applied to each week number cell. |

## DateRange

| Method | Description |
| :--- | :--- |
| **Instance Methods** | |
| `getStart(): ?string` | Returns the start date as a `Y-m-d` string, or `null` if not set. |
| `getEnd(): ?string` | Returns the end date as a `Y-m-d` string, or `null` if not set. |
| `hasStart(): bool` | Checks if the start date is set. |
| `hasEnd(): bool` | Checks if the end date is set. |
| `getPreset(): DateRangePreset` | Returns the preset used to create this range (e.g., `DateRangePreset::ThisWeek`). |
| `preset(DateRangePreset $preset): void` | Manually sets the preset for the range. |
| **Static Factory Methods** | |
| `setStart($start): static` | Creates a new `DateRange` with only the start date set (end is `null`). |
| `setEnd($end): static` | Creates a new `DateRange` with only the end date set (start is `null`). |
| `fromPreset(DateRangePreset $preset): static` | Creates a `DateRange` from a preset enum value. |
| `today(): static` | Creates a range for today only. |
| `yesterday(): static` | Creates a range for yesterday only. |
| `thisWeek(): static` | Creates a range for the current week (Monday–Sunday, respecting locale). |
| `lastWeek(): static` | Creates a range for the previous week. |
| `last7Days(): static` | Creates a range for the last 7 days (including today). |
| `thisMonth(): static` | Creates a range for the current month. |
| `lastMonth(): static` | Creates a range for the previous month. |
| `thisQuarter(): static` | Creates a range for the current quarter. |
| `lastQuarter(): static` | Creates a range for the previous quarter. |
| `thisYear(): static` | Creates a range for the current year. |
| `lastYear(): static` | Creates a range for the previous year. |
| `last14Days(): static` | Creates a range for the last 14 days. |
| `last30Days(): static` | Creates a range for the last 30 days. |
| `last3Months(): static` | Creates a range for the last 3 months. |
| `last6Months(): static` | Creates a range for the last 6 months. |
| `yearToDate(): static` | Creates a range from January 1st of the current year to today. |
| `lastWeekToDate(): static` | Creates a range from the start of last week (Monday) to today. |
| `lastMonthToDate(): static` | Creates a range from the first of last month to today. |
| `lastQuarterToDate(): static` | Creates a range from the start of last quarter to today. |
| `next7Days(): static` | Creates a range from today through the next 7 days. |
| `next30Days(): static` | Creates a range from today through the next 30 days. |
| `nextMonth(): static` | Creates a range for the next full calendar month. |
| `nextQuarter(): static` | Creates a range for the next full quarter. |
| `nextYear(): static` | Creates a range for the next full calendar year. |
| `all(): static` | Creates a range with no start date and today as the end (unbounded history). |

> **Note:** `DateRange` extends `CarbonPeriod`, so it also inherits all methods from `CarbonPeriod` (e.g., `getStartDate()`, `getEndDate()`, `addFilter()`, `toArray()`, etc.). For a complete list of those, refer to the official [CarbonPeriod documentation](https://carbon.nesbot.com/guide/specialized-use/carbon-period.html). The table above only lists methods that are **exclusive to your `DateRange` class**.
