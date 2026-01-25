---
name: 'otp'
---

# OTP Input Component

## Introduction

The `otp` component provides a secure and user-friendly way to handle One-Time Password (OTP) input. It features automatic focus progression, intelligent shift-left deletion, paste handling, validation with custom patterns, click-to-focus on disabled inputs, completion events, accessibility support, and seamless integration with both Livewire and Alpine.js. Perfect for authentication flows, verification codes, and any multi-digit input scenarios.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `otp` component easily:

```bash
php artisan sheaf:install otp
```

## Basic Usage

@blade
<x-demo class="flex justify-center !text-start" x-data="{ code: null }">
    <x-ui.otp 
        x-model="code" 
    />
</x-demo>
@endblade

```html
<x-ui.otp 
    wire:model="verificationCode"
/>
```

### Bind To Livewire

To use with Livewire you need to only use `wire:model="code"` to bind your OTP state:
```php
<!--
    this assumes you have $verificationCode in your class component
-->

<div class="max-w-md mx-auto">
    <x-ui.otp 
        wire:model="verificationCode"
    />
</div>
```

For real-time synchronization, use the `.live` modifier:

```html
<x-ui.otp 
    wire:model.live="verificationCode"
/>
```

### Using it within Blade & Alpine

You can use it outside Livewire with just Alpine (with Blade):

```html
<div class="max-w-md mx-auto" x-data="{ code: null }">
    <x-ui.otp 
        x-model="code" 
    />
</div>
```

> **Note:** The component uses `_state` and `_inputs` internally, so avoid using these variable names in your Alpine scope.

## Customization

### Custom Length

Control the number of input fields with the `length` parameter.

@blade
<x-demo class="flex justify-center !text-start" x-data="{ code4: null, code6: null, code8: null }">
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium mb-2">4-digit code (default)</label>
            <x-ui.otp 
                x-model="code4"
                :length="4"
            />
        </div>
        <div>
            <label class="block text-sm font-medium mb-2">6-digit code</label>
            <x-ui.otp 
                x-model="code6"
                :length="6"
            />
        </div>
        <div>
            <label class="block text-sm font-medium mb-2">8-digit code</label>
            <x-ui.otp 
                x-model="code8"
                :length="8"
            />
        </div>
    </div>
</x-demo>
@endblade

```html
<x-ui.otp 
    wire:model="code4"
    :length="4"
/>
<x-ui.otp 
    wire:model="code6"
    :length="6"
/>
<x-ui.otp 
    wire:model="code8"
    :length="8"
/>
```

### Slotted Inputs

You can pass individual inputs as a slot and customize them as needed.

> **Note:** Use `<x-ui.otp.input>` not the native input element.
 
@blade
<x-demo class="flex justify-center !text-start">
    <div 
        x-data="{
            code: null,
        }" 
        class="max-w-md mx-auto">
        <x-ui.otp 
            x-model="code"
            :length="5"
        >
            <x-ui.otp.input class="rounded-full m-2" />
            <x-ui.otp.input class="rounded-full m-2"/>
            <x-ui.otp.input class="rounded-full m-2"/>
            <x-ui.otp.input class="rounded-full m-2"/>
            <x-ui.otp.input class="rounded-full m-2"/>
        </x-ui.otp>    
    </div>
</x-demo>
@endblade

```html
<x-ui.otp
    wire:model="code"
    :length="5"
>
    <x-ui.otp.input class="rounded-full m-2" />
    <x-ui.otp.input class="rounded-full m-2"/>
    <x-ui.otp.input class="rounded-full m-2"/>
    <x-ui.otp.input class="rounded-full m-2"/>
    <x-ui.otp.input class="rounded-full m-2"/>
</x-ui.otp>    
```

### Separator 

Add visual separators between input groups for better readability (e.g., for phone numbers or formatted codes).

@blade
<x-demo class="flex justify-center !text-start">
    <div 
        x-data="{
            code: null,
        }" 
        class="max-w-md mx-auto"
    >
        <x-ui.otp x-model="code"
            :length="6"
        >
            <x-ui.otp.input />
            <x-ui.otp.input />
            <x-ui.otp.separator/>
            <x-ui.otp.input />
            <x-ui.otp.input />
            <x-ui.otp.separator/>
            <x-ui.otp.input />
            <x-ui.otp.input />
        </x-ui.otp>    
    </div>
</x-demo>
@endblade

```html
<x-ui.otp
    wire:model="code"
    :length="6"
>
    <x-ui.otp.input />
    <x-ui.otp.input/>
    
    <x-ui.otp.separator/>
    
    <x-ui.otp.input />
    <x-ui.otp.input />
    
    <x-ui.otp.separator/>
    
    <x-ui.otp.input />
    <x-ui.otp.input />
</x-ui.otp>    
```

### Input Types and Validation

Control what characters are allowed with different input types and patterns.

@blade
<x-demo class="flex justify-center !text-start" x-data="{ numericCode: null, alphanumericCode: null, customCode: null }">
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium mb-2">Numeric only (default)</label>
            <x-ui.otp 
                x-model="numericCode"
                allowedPattern="[0-9]"
            />
        </div>
        <div>
            <label class="block text-sm font-medium mb-2">Alphanumeric</label>
            <x-ui.otp 
                x-model="alphanumericCode"
                allowedPattern="[A-Za-z0-9]"
            />
        </div>
        <div>
            <label class="block text-sm font-medium mb-2">Letters only</label>
            <x-ui.otp 
                x-model="customCode"
                allowedPattern="[A-Za-z]"
            />
        </div>
    </div>
</x-demo>
@endblade

```html
<x-ui.otp 
    wire:model="numericCode"
    allowedPattern="[0-9]"
/>
<x-ui.otp 
    wire:model="alphanumericCode"
    allowedPattern="[A-Za-z0-9]"
/>
<x-ui.otp 
    wire:model="letterCode"
    allowedPattern="[A-Za-z]"
/>
```

### AutoFocus

Automatically focus the first relevant input on component initialization:

```html
<x-ui.otp 
    wire:model="code"
    autofocus
/>
```

## Advanced Features

### Intelligent Shift-Left Deletion

When you delete a digit from the middle of the OTP, all subsequent digits automatically shift left to fill the gap. This creates a natural editing experience similar to a text input field.

@blade
<x-demo class="flex justify-center !text-start" x-data="{ shiftCode: '123456' }">
    <div>
        <label class="block text-sm font-medium mb-2">Try deleting from the middle</label>
        <x-ui.otp 
            x-model="shiftCode"
            :length="6"
        />
        <p class="text-sm text-neutral-600 mt-2">Place cursor on any digit and press backspace/delete to see the shift effect.</p>
    </div>
</x-demo>
@endblade

**Example behavior:**
- Initial: `[1][2][3][4]`
- Delete `2`: `[1][3][4][ ]` (values shift left)
- No gaps remain between digits

### Click-to-Focus on Disabled Inputs

Click anywhere in the OTP input container, even on disabled inputs, to automatically focus the appropriate input box.

@blade
<x-demo class="flex justify-center !text-start" x-data="{ clickCode: '12' }">
    <div>
        <label class="block text-sm font-medium mb-2">Click on any input (even disabled ones)</label>
        <x-ui.otp 
            x-model="clickCode"
            :length="6"
        />
        <p class="text-sm text-neutral-600 mt-2">Try clicking on neutraled-out (disabled) inputs - focus will jump to the next available input.</p>
    </div>
</x-demo>
@endblade

**How it works:**
- Click on an enabled input → focuses that input
- Click on a disabled input → focuses the first empty input
- Click on empty space → focuses the first empty input

> **Technical Note:** This feature uses a CSS `::after` pseudo-element overlay trick to capture click events on disabled inputs, which normally block all pointer events.

### Completion Events

Listen for the `otp-complete` event when all digits are filled:

```html
<x-ui.otp 
    wire:model="code"
    x-on:otp-complete="handleComplete($event.detail.code)"
/>
```

**Auto-submit example:**

```html
<form wire:submit="verify">
    <x-ui.otp 
        wire:model.live="code"
        x-on:otp-complete="$wire.submit()"
    />
</form>
```

### Pre-filled Values

The component automatically handles external state synchronization and can display pre-filled values.

#### with Livewire

in your component class make sure you have defined `$prefilledCode` property with inital `1234` as initial value
@blade
<x-demo class="flex justify-center !text-start" x-data="{ prefilledCode: 1234 }">
    <div>
        <label class="block text-sm font-medium mb-2">Pre-filled code</label>
        <x-ui.otp 
            x-model="prefilledCode"
        />
        <p class="text-sm text-neutral-600 mt-2">Current value: <span x-text="prefilledCode"></span></p>
    </div>
</x-demo>
@endblade

```html
<div>
    <x-ui.otp wire:model.live="prefilledCode" />
    <p class="text-sm text-neutral-600 mt-2">Current value: <span wire:text="prefilledCode"></span></p>
</div>
```
#### with Alpine
@blade
<x-demo class="flex justify-center !text-start" x-data="{ prefilledCode: 1234 }">
    <div>
        <label class="block text-sm font-medium mb-2">Pre-filled code</label>
        <x-ui.otp 
            x-model="prefilledCode"
        />
        <p class="text-sm text-neutral-600 mt-2">Current value: <span x-text="prefilledCode"></span></p>
    </div>
</x-demo>
@endblade

```html
<div x-data="{ code: '1234' }">
    <x-ui.otp x-model="code" />
    <p class="text-sm text-neutral-600 mt-2">Current value: <span x-text="prefilledCode"></span></p>
</div>
```

### Paste Handling

The component intelligently handles pasted content, filtering valid characters, clearing subsequent inputs, and auto-filling from the paste position.

@blade
<x-demo class="flex justify-center !text-start" x-data="{ pasteCode: null }">
    <div>
        <label class="block text-sm font-medium mb-2">Try pasting "12345678" or "abc123xyz"</label>
        <x-ui.otp 
            x-model="pasteCode"
            :length="6"
        />
        <p class="text-sm text-neutral-600 mt-2">The component will extract valid digits and fill the inputs automatically.</p>
    </div>
</x-demo>
@endblade

**Paste behavior:**
- Filters characters by `allowedPattern`
- Clears all inputs from paste position onward
- Fills sequentially with valid characters
- Focuses next empty or last filled input

### Real-time Validation

Monitor input changes in real-time with Alpine.js effects.

@blade
<x-demo class="flex justify-center !text-start">
    <div 
        x-data="{
            code: null,
            isValid: false,
        }"
        x-init="
            $nextTick(() => {
                Alpine.effect(() => {
                    isValid = code && code.length === 4;
                });
            });
        "
    >
        <label class="block text-sm font-medium mb-2">Enter 4-digit code</label>
        <x-ui.otp x-model="code" />
        <div class="mt-2">
            <span x-show="isValid" style="display: none;" class="text-green-600 text-sm">✓ Valid code entered</span>
            <span x-show="!isValid" style="display: none;" class="text-red-600 text-sm">Please enter a complete 4-digit code</span>
        </div>
    </div>
</x-demo>
@endblade

```html
<div 
    x-data="{
        code: null,
        isValid: false,
    }"
    x-init="
        $nextTick(() => {
            Alpine.effect(() => {
                isValid = code && code.length === 4;
            });
        });
    "
>
    <label class="block text-sm font-medium mb-2">Enter 4-digit code</label>
    <x-ui.otp x-model="code" />
    <div class="mt-2">
        <span x-show="isValid" class="text-green-600 text-sm">✓ Valid code entered</span>
        <span x-show="!isValid" class="text-red-600 text-sm">Please enter a complete 4-digit code</span>
    </div>
</div>
```

## Public API

The component exposes methods that can be called from outside:

### Clear All Inputs

```html
<button x-on:click="$dispatch('otp-clear')">Clear OTP</button>

<x-ui.otp wire:model="code" />
```

### Focus First Empty Input

```html
<button x-on:click="$dispatch('otp-focus')">Focus OTP</button>

<x-ui.otp wire:model="code" />
```

## Accessibility

The component includes comprehensive accessibility features:

- **ARIA labels**: Each input has a descriptive label (e.g., "Digit 1 of 4")
- **Autocomplete**: `autocomplete="one-time-code"` for better mobile support
- **Keyboard navigation**: Arrow keys move between inputs
- **Screen reader friendly**: Proper roles and labels
- **Focus management**: Clear visual focus indicators

## Component Props

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `length` | integer | `4` | No | Number of input fields to render |
| `type` | string | `'text'` | No | HTML input type attribute |
| `allowedPattern` | string | `'[0-9]'` | No | Regex pattern for allowed characters |
| `autofocus` | boolean | `false` | No | Auto-focus first input on mount |
| `wire:model` | string | - | Yes* | Livewire property to bind to |
| `x-model` | string | - | Yes* | Alpine.js property to bind to |
| `class` | string | - | No | Additional CSS classes for container |

*Either `wire:model` or `x-model` is required

## Events

| Event Name | Payload | Description |
|------------|---------|-------------|
| `otp-complete` | `{ code: string }` | Fired when all inputs are filled |
| `otp-clear` | - | Clears all inputs (listen with window) |
| `otp-focus` | - | Focuses first empty input (listen with window) |
