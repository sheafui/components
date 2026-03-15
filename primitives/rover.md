---
name: rover primitive
---
# Rover

Rover is a lightweight Alpine.js engine that manages **keyboard navigation, activation state, and search filtering** for listable UI components: selects, comboboxes, autocompletes, command palettes, and anything else that renders a navigable list of options.

It exposes a declarative directive API (`x-rover`, `x-rover:input`, `x-rover:options`, etc.) and a programmatic magic API (`$rover`) that your component logic calls into.


## Installation

### CDN

```html
<script src="https://unpkg.com/alpinejs" defer></script>
<script src="/path/to/rover.cdn.js" defer></script>
```


### As a plugin

```js
import Alpine from 'alpinejs'
import rover from './rover'

Alpine.plugin(rover)
Alpine.start()
```

---

## Core concepts

Rover is built around three layers:

1. **`RoverCollection`** — the internal engine. Holds all registered options, tracks activation state, builds navigation indexes, and runs search. You don't touch this directly, you go through `$rover`.

2. **Directives** — HTML attributes that wire up your markup. They handle ARIA, ID management, and connect elements to the collection engine.

3. **Managers** — helpers (`InputManager`, `OptionsManager`, `ButtonManager`, `OptionManager`) that abstract event binding on specific elements. Accessed via `$rover.input`, `$rover.options`, `$rover.button`, `$rover.option`.


## Directives

Apply these as attributes on your HTML elements.

| Directive | Element | Description |
|---|---|---|
| `x-rover` | Root wrapper | Initializes the Rover root. All other directives must live inside this element. |
| `x-rover:input` | `<input>` | Marks the text input. Wires up ARIA attributes (`aria-autocomplete`, `aria-controls`, `aria-activedescendant`). |
| `x-rover:options` | List container | Marks the scrollable list wrapper. Gets `role="listbox"` and the matching `id` for `aria-controls`. |
| `x-rover:option` | Each option | Marks an individual option. Registers it in the collection and gives it `role="option"` and a unique `id`. |
| `x-rover:button` | Trigger button | Marks a toggle button. Gets `tabindex="-1"` so focus stays on the input. |
| `x-rover:group` | Option group | Groups options under a `role="group"` with an `aria-labelledby`. Automatically hides when all its options are filtered out. |
| `x-rover:separator` | Divider | Gets `role="separator"`. Hidden automatically during search. |
| `x-rover:empty` | Empty state | Shown when the search query yields no results. Use `.hide` modifier to invert: `x-rover:empty.hide` hides the element when empty. |
| `x-rover:loading` | Loading indicator | Shown when `pending` is true. Use `.hide` modifier to invert. Gets `role="status"` and `aria-live="polite"`. |

### Option attributes

Each `x-rover:option` element reads a few data attributes to configure itself:

| Attribute | Type | Description |
|---|---|---|
| `value` | `string` | **Required.** Unique identifier for this option. |
| `data-label` | `string` | Human-readable label. Used as display text and in `$rover.getLabel()`. Defaults to `value` if omitted. |
| `data-search` | `string` | Searchable text. Normalized (lowercased, diacritics stripped) before indexing. Defaults to `value`. |
| `disabled` | boolean attr | Excludes this option from keyboard navigation. |

---

## Basic markup structure

```html
<div x-rover>

  <!-- Optional search input -->
  <input x-rover:input type="text" placeholder="Search..." />

  <!-- Optional toggle button -->
  <button x-rover:button>Open</button>

  <!-- The list -->
  <ul x-rover:options>

    <!-- Group (optional) -->
    <li x-rover:group>
      <span id="group-label">Fruits</span>

      <ul>
        <li x-rover:option value="apple" data-label="Apple">Apple</li>
        <li x-rover:option value="banana" data-label="Banana">Banana</li>
        <li x-rover:option value="mango" data-label="Mango" disabled>Mango</li>
      </ul>
    </li>

    <!-- Separator -->
    <li x-rover:separator></li>

    <!-- Plain options -->
    <li x-rover:option value="carrot" data-label="Carrot">Carrot</li>

  </ul>

  <!-- Empty state -->
  <p x-rover:empty>No results found.</p>

  <!-- Loading indicator -->
  <p x-rover:loading>Loading...</p>

</div>
```

---

## The `$rover` magic

Inside any element that lives within an `x-rover` root, you have access to the `$rover` magic property. This is how your component logic drives the engine.

```js
this.$rover.activate('apple')
this.$rover.activateNext()
this.$rover.getLabel('apple') // → 'Apple'
```

### Navigation

| Method | Description |
|---|---|
| `activate(value)` | Activates the option with the given value. |
| `deactivate()` | Clears the active option. |
| `activateNext()` | Moves activation to the next navigable option (wraps around). |
| `activatePrev()` | Moves activation to the previous navigable option (wraps around). |
| `activateFirst()` | Activates the first navigable option. |
| `activateLast()` | Activates the last navigable option. |
| `activateByKey(key)` | Types `key` into an internal buffer and jumps to the first option whose searchable text starts with the buffered string. Buffer resets after 500ms. |
| `getActiveItem()` | Returns the currently active item object `{ value, label, searchable, disabled }` or `null`. |
| `getActiveItemEl()` | Returns the DOM element of the active option. |

### Search

| Method | Description |
|---|---|
| `searchUsing(query)` | Runs a search against all registered options. Results are prefix-matched first, then mid-string matched. Filters the visible nav index. Returns an array of matching item objects. |

Search is incremental — if the new query starts with the previous query, Rover narrows the search to the previous result set instead of rescanning all options. This makes it efficient with large lists.

Built-in input handling (via `enableDefaultInputHandlers`) wires search automatically to the `input` event on `x-rover:input`. For remote/async search (where filtering happens server-side), Rover detects an `x-model` binding on the input and skips local filtering.

### DOM queries

| Method | Description |
|---|---|
| `getLabel(value)` | Returns the label string for a given value. |
| `getSearchable(value)` | Returns the normalized searchable string for a value. |
| `isDisabled(value)` | Returns `true` if the option is disabled. |
| `getOptionElByValue(value)` | Returns the DOM element for a given value. |
| `getElementByValue(value)` | Alias for `getOptionElByValue`. |
| `getItemByValue(value)` | Returns the item object `{ value, label, searchable, disabled }`. |
| `isEmpty()` | Returns `true` if no options are currently visible (all filtered out). |
| `hasVisibleOptions()` | Returns `true` if at least one option is visible. |

### DOM reconciliation

| Method | Description |
|---|---|
| `reconcileDom()` | Rebuilds the internal option index and recomputes the nav order from DOM order. Call this after dynamic option lists change — for example after a Livewire response. |

### Sub-managers

| Property | Description |
|---|---|
| `$rover.input` | The `InputManager` for the `x-rover:input` element. |
| `$rover.options` | The `OptionsManager` for the `x-rover:options` container. |
| `$rover.button` | The `ButtonManager` for the `x-rover:button` element. |
| `$rover.option` | The `OptionManager` for individual `x-rover:option` elements. |
| `$rover.collection` | Direct access to the underlying `RoverCollection` instance. |
| `$rover.inputEl` | The raw `<input>` DOM element, or `null`. |
| `$rover.isLoading` | Boolean. Reflects the collection's `pending` state. |

---

## Managers

Managers are thin wrappers around event binding on specific elements. They use `AbortController` internally, so all listeners are cleaned up on destroy.

### InputManager — `$rover.input`

Manages the `x-rover:input` element.

```js
const input = this.$rover.input
```

#### Methods

| Method | Description |
|---|---|
| `on(eventKey, handler)` | Attaches an event listener. Handler receives `(event, activeValue)`. |
| `enableDefaultInputHandlers(disabledEvents?)` | Registers default keyboard handling: `ArrowDown/Up` navigate, `Home/End` jump to first/last, `Escape` refocuses input, `Tab` stops typing mode. Pass an array of event names to skip specific defaults, e.g. `['focus']`. |
| `focus(preventScroll?)` | Focuses the input element. Defaults to `preventScroll: true`. |
| `reset()` | Clears the input value. |

#### Properties

| Property | Description |
|---|---|
| `value` | Get/set the current text value of the input. |
| `el` | The raw input DOM element. |

---

### OptionsManager — `$rover.options`

Manages the `x-rover:options` container via event delegation.

```js
const options = this.$rover.options
```

#### Methods

| Method | Description |
|---|---|
| `on(eventKey, handler)` | Attaches a delegated listener. Handler receives `(event, closestOptionEl, activeValue)`. |
| `enableDefaultOptionsHandlers(disabledEvents?)` | Registers default handlers: `mouseover/mousemove` activates hovered option, `mouseout` deactivates, keyboard arrows navigate, `Escape` deactivates, `Tab` deactivates. Pass an array of event names to skip. |
| `focus(preventScroll?)` | Focuses the options container. |
| `flush()` | Rebuilds the option index (alias for `reconcileDom`). |

#### Properties

| Property | Description |
|---|---|
| `all` | Array of all `x-rover:option` elements currently in the DOM. |

---

### ButtonManager — `$rover.button`

Manages the `x-rover:button` element.

```js
const button = this.$rover.button
```

#### Methods

| Method | Description |
|---|---|
| `on(eventKey, handler)` | Attaches an event listener. Handler receives `(event, activeValue)`. |

---

### OptionManager — `$rover.option`

Manages individual `x-rover:option` elements — useful when you need to attach the same event to every option rather than delegating from the container.

```js
const option = this.$rover.option
```

#### Methods

| Method | Description |
|---|---|
| `on(eventKey, handler)` | Attaches the listener to every option element currently in the DOM. Handler receives `(event, activeValue)`. |

---

## RoverCollection

The internal state engine. Accessible via `$rover.collection` if you need low-level control, but most use cases are covered by `$rover` methods directly.

### Key behaviors

**Navigation index** — Rover builds a `navIndex` (an ordered array of navigable values) from DOM order, filtered to only enabled, visible options. This index is rebuilt lazily via microtask batching whenever the collection is mutated (options added/removed, search results change). Methods like `activateNext` and `activatePrev` operate on this index.

**Search** — `search(query)` normalizes the query (lowercase, strips diacritics) and scores all items: prefix matches come first, then substring matches. Calling `reset()` clears the query and restores the full nav index.

**Activation** — `activatedValue` is a reactive Alpine object. Rover uses it in an `effect` to patch `data-active` and `aria-current` attributes directly on option DOM elements — no template expressions needed on each option.

**Visibility patching** — Rover maintains a `prevVisibleArray` and diffs it against the new filter results to minimize DOM writes when search results change.

---

## Component recipe

Here is the pattern used by all three built-in components (select, combobox, autocomplete):

```js
Alpine.data('myListComponent', ({ model, livewire, isLive }) => ({
  __state: model ? livewire.$entangle(model, isLive) : null,
  __isOpen: false,

  init() {
    // 1. Set up options container interactions
    const options = this.$rover.options
    options.enableDefaultOptionsHandlers()

    options.on('click', (_event, closestOption) => {
      if (!closestOption) return
      this.select(closestOption.dataset.value)
    })

    options.on('keydown', (event, _el, activeValue) => {
      if (event.key === 'Enter' && activeValue !== undefined) {
        this.select(activeValue)
      }
    })

    // 2. Set up input interactions (if searchable)
    const input = this.$rover.input
    input.enableDefaultInputHandlers()

    input.on('keydown', (event, activeValue) => {
      if (event.key === 'Enter' && activeValue !== undefined) {
        this.select(activeValue)
      }
      if (event.key === 'Escape') this.close()
    })

    // 3. React to state changes (mark selected options in DOM)
    Alpine.effect(() => {
      const el = this.$rover.getOptionElByValue(this.__state)
      if (el) el.dataset.selected = 'true'
    })
  },

  select(value) {
    this.__state = value
    this.close()
  },

  open() {
    this.__isOpen = true
    this.$nextTick(() => {
      this.$rover.input.focus()
      this.$rover.activateFirst()
    })
  },

  close() {
    this.__isOpen = false
    this.$rover.deactivate()
  },
}))
```

---

## Livewire integration

When options are rendered server-side and the DOM updates after a Livewire commit, call `reconcileDom()` to resync Rover's internal index.

```js
if (window.Livewire) {
  window.Livewire.hook('commit', ({ component, succeed }) => {
    if (component.id === livewireId) {
      succeed(() => {
        this.$nextTick(() => {
          this.$rover.reconcileDom()
          // Re-mark selected options that came back from the server
          this.ensureSelectedMarked()
        })
      })
    }
  })
}
```

For remote/async search where the server filters the options, bind the input with `x-model`. Rover detects this and skips its local search, deferring to whatever Livewire sends back.

```html
<input x-rover:input x-model.live.debounce.300ms="query" />
```

---

## Accessibility

Rover handles ARIA automatically when you use the directives correctly.

| ARIA attribute | Set by | Value |
|---|---|---|
| `role="listbox"` | `x-rover:options` | Static |
| `role="option"` | `x-rover:option` | Static |
| `role="group"` | `x-rover:group` | Static |
| `role="separator"` | `x-rover:separator` | Static |
| `aria-autocomplete="list"` | `x-rover:input` | Static |
| `aria-controls` | `x-rover:input` | ID of the `x-rover:options` element |
| `aria-activedescendant` | `x-rover:input` | ID of the active `x-rover:option` element |
| `aria-disabled` | `x-rover:option` | Reflects the `disabled` attribute |
| `aria-selected` | Your component | Set via `el.setAttribute('aria-selected', 'true')` in your `patchDom` logic |
| `aria-current` | Rover core | Set automatically on the active option |
| `data-active` | Rover core | Set automatically on the active option |

> Rover does not set `aria-selected` for you — that's your component's job, since Rover doesn't know your selection model. Patch it in your `Alpine.effect` when `__state` changes.

---

## Other magics

In addition to `$rover`, Rover provides two scoped magics for use deeper in the tree.

### `$roverOption`

Available inside an `x-rover:option` element. Exposes the same navigation methods as `$rover` but scoped to the option's data stack.

```html
<li x-rover:option value="apple" @click="$roverOption.activate('apple')">Apple</li>
```

### `$roverOptions`

Available inside an `x-rover:options` element.

| Method | Description |
|---|---|
| `isOpen()` | Returns whether the parent root's `__isOpen` is true. |
| `isStatic()` | Returns whether the root is marked as static (always open). |

---

## State attributes

Rover and its components communicate state through `data-*` attributes on option elements, making CSS styling straightforward.

| Attribute | Set when |
|---|---|
| `data-active="true"` | Option is keyboard-focused / hovered |
| `data-selected="true"` | Option is part of the current selection (set by your component) |
| `aria-current="true"` | Same as `data-active` — for screen readers |
| `aria-selected="true/false"` | Selection state (set by your component) |
| `style="display: none"` | Option is hidden by search filtering |

```css
[x-rover\:option][data-active] {
  background: hsl(240 5% 15%);
}

[x-rover\:option][data-selected] {
  font-weight: 500;
}

[x-rover\:option][data-selected][data-active] {
  background: hsl(240 70% 25%);
}
```

---

## Full example — searchable select

```html
<div
  x-rover
  x-data="selectComponent({ model: 'selectedValue', livewire: $wire, livewireId: 'abc123', isLive: false, isMultiple: false })"
  x-on:click.outside="handleClickAway($event.target)"
>

  <!-- Trigger -->
  <button x-rover:button x-ref="trigger" @click="handleButtonClick">
    <span x-text="hasSelection ? selectedLabel : 'Pick an option'"></span>
  </button>

  <!-- Panel -->
  <div x-show="__isOpen">

    <!-- Search -->
    <input x-rover:input type="text" placeholder="Search..." />

    <!-- List -->
    <ul x-rover:options>
      <li x-rover:option value="apple"  data-label="Apple">Apple</li>
      <li x-rover:option value="banana" data-label="Banana">Banana</li>
      <li x-rover:option value="cherry" data-label="Cherry">Cherry</li>
    </ul>

    <p x-rover:empty>No results.</p>

  </div>

</div>
```