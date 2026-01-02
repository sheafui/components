---
name: 'input'
---

# Input Component

## Introduction

The `input` component provides a powerful and flexible foundation for text input fields. It features customizable prefixes and suffixes, icon support, input actions (copy, clear, reveal), validation states, and full accessibility support. Perfect for forms, search fields, and any text input scenario.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `input` component easily:

```bash
php artisan sheaf:install input
```

## Basic Usage

@blade
<x-demo x-data="{ value: '' }">
    <x-ui.input 
        class="max-w-sm mx-auto"
        x-model="value" 
        placeholder="Enter text..."
    />
</x-demo>
@endblade

```blade
<x-ui.input 
    wire:model="name"  
    placeholder="Enter your name..."
/>
```

### Bind To Livewire

To use with Livewire you only need to use `wire:model="property"` to bind your input state:

```blade
<x-ui.input 
    wire:model="email" 
    placeholder="Enter email..."
    type="email"
/>
```

### Using it within Blade & Alpine

You can use it outside Livewire with just Alpine (and Blade):

```blade
<div x-data="{ email: '' }">
    <x-ui.input 
        x-model="email" 
        placeholder="Enter email..."
        type="email"
    />
</div>
```

## Input Types

### Basic Text Input

@blade
<x-demo x-data="{ text: '' }">
    <x-ui.input 
        x-model="text" 
        class="max-w-sm mx-auto"
        placeholder="Enter text..."
        type="text"
    />
</x-demo>
@endblade

```blade
<x-ui.input 
    wire:model="text" 
    placeholder="Enter text..."
    type="text"
/>
```

### Email Input

@blade
<x-demo x-data="{ email: '' }">
    <x-ui.input 
        x-model="email" 
        class="max-w-sm mx-auto"
        placeholder="Enter email..."
        type="email"
    />
</x-demo>
@endblade

```blade
<x-ui.input 
    wire:model="email" 
    placeholder="Enter email..."
    type="email"
/>
```

### Password Input

@blade
<x-demo x-data="{ password: '' }">
    <x-ui.input 
        x-model="password" 
        class="max-w-sm mx-auto"
        placeholder="Enter password..."
        type="password"
    />
</x-demo>
@endblade

```blade
<x-ui.input 
    wire:model="password" 
    placeholder="Enter password..."
    type="password"
/>
```

### Number Input

@blade
<x-demo x-data="{ number: '' }">
    <x-ui.input 
        x-model="number" 
        class="max-w-sm mx-auto"
        placeholder="Enter number..."
        type="number"
    />
</x-demo>
@endblade

```blade
<x-ui.input 
    wire:model="age" 
    placeholder="Enter age..."
    type="number"
/>
```

## Prefixes and Suffixes

### Text Prefix and Suffix

@blade
<x-demo x-data="{ url: 'charrafi' }">
    <x-ui.input 
        x-model="url" 
        class="max-w-sm mx-auto"
        placeholder="Enter your site name"
    >
        <x-slot name="prefix">
            https://
        </x-slot>
        <x-slot name="suffix">
            .com
        </x-slot>
    </x-ui.input>
</x-demo>
@endblade

```blade
<x-ui.input 
    wire:model="url" 
    placeholder="Enter your site name"
>
    <x-slot name="prefix">
        https://
    </x-slot>
    <x-slot name="suffix">
        .com
    </x-slot>
</x-ui.input>
```

### Icon Prefix and Suffix

@blade
<x-demo x-data="{ search: '' }">
    <x-ui.input 
        x-model="search" 
        placeholder="Search..."
        class="max-w-sm mx-auto"
        prefixIcon="magnifying-glass"
        suffixIcon="document-duplicate"
    />
</x-demo>
@endblade

```blade
<x-ui.input 
    wire:model="search" 
    placeholder="Search..."
    prefixIcon="magnifying-glass"
    suffixIcon="document-duplicate"
/>
```

### Static Right and Left Icons

you can pass left icon to the `leftIcon` prop
@blade
<x-demo x-data="{ search: '' }">
    <x-ui.input 
        x-model="search" 
        placeholder="search..."
        class="max-w-sm mx-auto"
        leftIcon="magnifying-glass"
    />
</x-demo>
@endblade

```blade
<x-ui.input 
    x-model="search" 
    placeholder="Search..."
    class="max-w-sm mx-auto"
    leftIcon="magnifying-glass"
/>
```
you can pass the right icon to the `rightIcon` prop

@blade
<x-demo x-data="{ search: '' }">
    <x-ui.input 
        x-model="search" 
        placeholder="what name of you bank account?"
        class="max-w-sm mx-auto"
        rightIcon="banknotes"
    />
</x-demo>
@endblade

```blade
<x-ui.input 
    x-model="search" 
    placeholder="Search..."
    class="max-w-sm mx-auto"
    rightIcon="magnifying-glass"
/>
```


## Input Actions

### Copyable Input

@blade
<x-demo x-data="{ apiKey: 'sk-1234567890abcdef' }">
    <x-ui.input 
        x-model="apiKey" 
        placeholder="API Key"
        class="max-w-sm mx-auto"
        copyable
        readonly
    />
</x-demo>
@endblade

```blade
<x-ui.input 
    wire:model="apiKey" 
    placeholder="API Key"
    copyable
    readonly
/>
```

### Clearable Input

@blade
<x-demo x-data="{ search: 'Clear me!' }">
    <x-ui.input 
        x-model="search" 
        placeholder="Search..."
        class="max-w-sm mx-auto"
        clearable
    />
</x-demo>
@endblade

```blade
<x-ui.input 
    wire:model="search" 
    placeholder="Search..."
    clearable
/>
```

### Revealable Password

@blade
<x-demo x-data="{ password: 'secret123' }">
    <x-ui.input 
        x-model="password" 
        placeholder="Password"
        type="password"
        class="max-w-sm mx-auto"
        revealable
    />
</x-demo>
@endblade

```blade
<x-ui.input 
    wire:model="password" 
    placeholder="Password"
    type="password"
    revealable
/>
```

### Multiple Actions

@blade
<x-demo x-data="{ value: 'Multiple actions!' }">
    <x-ui.input 
        x-model="value" 
        class="max-w-sm mx-auto"
        placeholder="Try all actions..."
        copyable
        clearable
        revealable
    />
</x-demo>
@endblade

```blade
<x-ui.input 
    wire:model="value" 
    placeholder="Try all actions..."
    copyable
    clearable
    revealable
/>
```

## Form Structure Components

### Field Component

The `field` component provides proper spacing and structure for form inputs with labels, descriptions, and errors.
read more about [field component](/field)
@blade
<x-demo>
    <x-ui.field required
                class="max-w-sm mx-auto"
    >
        <x-ui.label>Full Name</x-ui.label>
        <x-ui.description>Your first and last name as it appears on official documents</x-ui.description>
        <x-ui.input 
            wire:model="name" 
            placeholder="John Doe"
            clearable
        />
    </x-ui.field>
</x-demo>
@endblade

```blade
<x-ui.field required>
    <x-ui.label>Full Name</x-ui.label>
    <x-ui.description>Your first and last name as it appears on official documents</x-ui.description>
    <x-ui.input 
        wire:model="name" 
        placeholder="John Doe"
        clearable
    />
    <x-ui.error name="name" />
</x-ui.field>
```

### Label Component

read more about [label component](/components/label)

```blade
<x-ui.label>Email Address</x-ui.label>
<!-- or -->
<x-ui.label text="Email Address" />
```

### Description Component
read more about [description component](/components/error)

intent to be used with inputs 
@blade
<x-demo>
    <x-ui.description>
        This information will be displayed publicly so be careful what you share.
    </x-ui.description>
</x-demo>
@endblade

```blade
<x-ui.description>
    This information will be displayed publicly so be careful what you share.
</x-ui.description>
```

### Error Component

read more about [error component](/components/error)

```blade
<x-ui.error name="email" />
<!-- or with manual messages -->
<x-ui.error messages="['Custom error message']" />
```

## Fieldset Component

Group related form fields together with a fieldset. read more about [fieldset component](/components/fieldset)

@blade
<x-demo>
    <x-ui.fieldset label="Account Information">
        <x-ui.field required>
            <x-ui.label>Email</x-ui.label>
            <x-ui.input 
                wire:model="email" 
                type="email"
                placeholder="john@example.com"
            />
        </x-ui.field>
        <!--  -->
        <x-ui.field required>
            <x-ui.label>Password</x-ui.label>
            <x-ui.input 
                wire:model="password" 
                type="password"
                placeholder="••••••••"
                revealable
            />
        </x-ui.field>
    </x-ui.fieldset>
</x-demo>
@endblade

```blade
<x-ui.fieldset label="Account Information">
    <x-ui.field required>
        <x-ui.label>Email</x-ui.label>
        <x-ui.input 
            wire:model="email" 
            type="email"
            placeholder="john@example.com"
        />
        <x-ui.error name="email" />
    </x-ui.field>

    <x-ui.field required>
        <x-ui.label>Password</x-ui.label>
        <x-ui.input 
            wire:model="password" 
            type="password"
            placeholder="••••••••"
            revealable
        />
        <x-ui.error name="password" />
    </x-ui.field>
</x-ui.fieldset>
```

## Complete Form Example

@blade
<x-demo>
    <form class="space-y-6">
        <x-ui.fieldset label="Personal Information">
            <x-ui.field required>
                <x-ui.label>Full Name</x-ui.label>
                <x-ui.description>Your first and last name</x-ui.description>
                <x-ui.input 
                    wire:model="name"
                    placeholder="John Doe"
                    clearable
                />
            </x-ui.field>
            <!--  -->
            <x-ui.field required>
                <x-ui.label>Email Address</x-ui.label>
                <x-ui.input 
                    wire:model="email"
                    type="email"
                    placeholder="john@example.com"
                />
            </x-ui.field>
            <!--  -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-ui.field required>
                    <x-ui.label>Password</x-ui.label>
                    <x-ui.input 
                        wire:model="password"
                        type="password"
                        placeholder="••••••••"
                        revealable
                    />
                </x-ui.field>
                <!--  -->
                <x-ui.field required>
                    <x-ui.label>Confirm Password</x-ui.label>
                    <x-ui.input 
                        wire:model="password_confirmation"
                        type="password"
                        placeholder="••••••••"
                        revealable
                    />
                </x-ui.field>
            </div>
        </x-ui.fieldset>
        <!--  -->
        <x-ui.fieldset label="Professional Details">
            <x-ui.field>
                <x-ui.label>Website</x-ui.label>
                <x-ui.description>Your personal or company website</x-ui.description>
                <x-ui.input 
                    wire:model="website"
                    type="url"
                    placeholder="charrafi"
                    copyable
                >
                    <x-slot name="prefix">https://</x-slot>
                    <x-slot name="suffix">.com</x-slot>
                </x-ui.input>
            </x-ui.field>
            <!--  -->
            <x-ui.field>
                <x-ui.label>Company</x-ui.label>
                <x-ui.input 
                    wire:model="company"
                    placeholder="Acme Inc."
                    clearable
                />
            </x-ui.field>
        </x-ui.fieldset>
    </form>
</x-demo>
@endblade

```blade
<form class="space-y-6">
    <x-ui.fieldset label="Personal Information">
        <x-ui.field required>
            <x-ui.label>Full Name</x-ui.label>
            <x-ui.description>Your first and last name</x-ui.description>
            <x-ui.input 
                wire:model="name"
                placeholder="John Doe"
                clearable
            />
            <x-ui.error name="name" />
        </x-ui.field>

        <x-ui.field required>
            <x-ui.label>Email Address</x-ui.label>
            <x-ui.input 
                wire:model="email"
                type="email"
                placeholder="john@example.com"
            />
            <x-ui.error name="email" />
        </x-ui.field>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-ui.field required>
                <x-ui.label>Password</x-ui.label>
                <x-ui.input 
                    wire:model="password"
                    type="password"
                    placeholder="••••••••"
                    revealable
                />
                <x-ui.error name="password" />
            </x-ui.field>

            <x-ui.field required>
                <x-ui.label>Confirm Password</x-ui.label>
                <x-ui.input 
                    wire:model="password_confirmation"
                    type="password"
                    placeholder="••••••••"
                    revealable
                />
                <x-ui.error name="password_confirmation" />
            </x-ui.field>
        </div>
    </x-ui.fieldset>

    <x-ui.fieldset label="Professional Details">
        <x-ui.field>
            <x-ui.label>Website</x-ui.label>
            <x-ui.description>Your personal or company website</x-ui.description>
            <x-ui.input 
                wire:model="website"
                type="url"
                placeholder="charrafi"
                copyable
            >
                <x-slot name="prefix">https://</x-slot>
                <x-slot name="suffix">.com</x-slot>
            </x-ui.input>
            <x-ui.error name="website" />
        </x-ui.field>

        <x-ui.field>
            <x-ui.label>Company</x-ui.label>
            <x-ui.input 
                wire:model="company"
                placeholder="Acme Inc."
                clearable
            />
            <x-ui.error name="company" />
        </x-ui.field>
    </x-ui.fieldset>
</form>
```

## Validation States

### Invalid State

When validation fails, the input automatically shows error styling.

@blade
<x-demo>
    <x-ui.field
        class="max-w-sm mx-auto"
    >
        <x-ui.label>Email</x-ui.label>
        <x-ui.input 
            wire:model="email"
            type="email"
            placeholder="Enter email..."
            invalid
        />
        <!-- <x-ui.error messages="['Please enter a valid email address']" /> -->
    </x-ui.field>
</x-demo>
@endblade

```blade
<x-ui.field>
    <x-ui.label>Email</x-ui.label>
    <x-ui.input 
        wire:model="email"
        type="email"
        placeholder="Enter email..."
    />
    <x-ui.error name="email" />
</x-ui.field>
```

### Disabled State

@blade
<x-demo>
    <x-ui.field 
        disabled
        class="max-w-sm mx-auto"
    >
        <x-ui.label>Disabled Input</x-ui.label>
        <x-ui.description>This field is currently disabled</x-ui.description>
        <x-ui.input 
            wire:model="disabled"
            placeholder="Cannot edit this"
            disabled
        />
    </x-ui.field>
</x-demo>
@endblade

```blade
<x-ui.field disabled>
    <x-ui.label>Disabled Input</x-ui.label>
    <x-ui.description>This field is currently disabled</x-ui.description>
    <x-ui.input 
        wire:model="disabled"
        placeholder="Cannot edit this"
        disabled
    />
</x-ui.field>
```

## Input Masking

Transform your input fields into smart, formatted text controls using Alpine.js's powerful mask plugin. The input component seamlessly integrates with Alpine's masking capabilities to provide real-time formatting as users type.

### Basic Masking

Apply simple masks using the `x-mask` directive with wildcard patterns:

@blade
<x-demo>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <x-ui.field class="max-w-sm">
            <x-ui.label>Phone Number</x-ui.label>
            <x-ui.input 
                x-mask="(999) 999-9999"
                placeholder="(555) 123-4567"
                leftIcon="phone"
            />
        </x-ui.field>
        
        <x-ui.field class="max-w-sm">
            <x-ui.label>Date of Birth</x-ui.label>
            <x-ui.input 
                x-mask="99/99/9999"
                placeholder="MM/DD/YYYY"
                leftIcon="calendar"
            />
        </x-ui.field>
    </div>
</x-demo>
@endblade

```blade
<!-- Phone Number -->
<x-ui.input 
    x-mask="(999) 999-9999"
    placeholder="(555) 123-4567"
    leftIcon="phone"
/>

<!-- Date -->
<x-ui.input 
    x-mask="99/99/9999"
    placeholder="MM/DD/YYYY"
    leftIcon="calendar"
/>
```

### Mask Wildcards

Alpine.js supports several wildcard characters for different input requirements:

@blade
<x-demo>
    <div class="space-y-4">
        <x-ui.field>
            <x-ui.label>Product Code (Any characters)</x-ui.label>
            <x-ui.description>Wildcard: * (any character)</x-ui.description>
            <x-ui.input 
                x-mask="***-****-***"
                placeholder="ABC-1234-XYZ"
                class="max-w-sm"
            />
        </x-ui.field>
        
        <x-ui.field>
            <x-ui.label>Department Code (Letters only)</x-ui.label>
            <x-ui.description>Wildcard: a (alpha characters only)</x-ui.description>
            <x-ui.input 
                x-mask="aaa-aaa"
                placeholder="DEV-OPS"
                class="max-w-sm"
            />
        </x-ui.field>
        
        <x-ui.field>
            <x-ui.label>Employee ID (Numbers only)</x-ui.label>
            <x-ui.description>Wildcard: 9 (numeric characters only)</x-ui.description>
            <x-ui.input 
                x-mask="9999-9999"
                placeholder="1234-5678"
                class="max-w-sm"
            />
        </x-ui.field>
    </div>
</x-demo>
@endblade

```blade
<!-- Any character (*) -->
<x-ui.input x-mask="***-****-***" placeholder="ABC-1234-XYZ" />

<!-- Alpha only (a) -->
<x-ui.input x-mask="aaa-aaa" placeholder="DEV-OPS" />

<!-- Numeric only (9) -->
<x-ui.input x-mask="9999-9999" placeholder="1234-5678" />
```

| Wildcard | Description | Example |
|----------|-------------|---------|
| `*` | Any character | `***-***` → `ABC-123` |
| `a` | Alpha characters (a-z, A-Z) | `aaa-aaa` → `DEV-OPS` |
| `9` | Numeric characters (0-9) | `999-999` → `123-456` |

### Dynamic Masking

For complex scenarios where the mask needs to change based on user input, use `x-mask:dynamic`:

@blade
<x-demo>
    <x-ui.field>
        <x-ui.label>Credit Card Number</x-ui.label>
        <x-ui.description>
            Try typing a number starting with 34 or 37 (Amex format) vs other numbers
        </x-ui.description>
        <x-ui.input 
            x-mask:dynamic="
                $input.startsWith('34') || $input.startsWith('37')
                    ? '9999 999999 99999' : '9999 9999 9999 9999'
            "
            placeholder="Enter credit card number"
            leftIcon="credit-card"
            class="max-w-sm"
        />
    </x-ui.field>
</x-demo>
@endblade

```blade
<x-ui.input 
    x-mask:dynamic="
        $input.startsWith('34') || $input.startsWith('37')
            ? '9999 999999 99999' : '9999 9999 9999 9999'
    "
    placeholder="Enter credit card number"
    leftIcon="credit-card"
/>
```

### Money Input Masking

Alpine provides a built-in `$money()` function for currency formatting:

@blade
<x-demo>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <x-ui.field>
            <x-ui.label>USD Amount</x-ui.label>
            <x-ui.input 
                x-mask:dynamic="$money($input)"
                placeholder="0.00"
                leftIcon="banknotes"
            >
                <x-slot name="prefix">$</x-slot>
            </x-ui.input>
        </x-ui.field>
        
        <x-ui.field>
            <x-ui.label>EUR Amount</x-ui.label>
            <x-ui.input 
                x-mask:dynamic="$money($input, ',')"
                placeholder="0,00"
                leftIcon="banknotes"
            >
                <x-slot name="suffix">€</x-slot>
            </x-ui.input>
        </x-ui.field>
        
        <x-ui.field>
            <x-ui.label>High Precision</x-ui.label>
            <x-ui.input 
                x-mask:dynamic="$money($input, '.', ',', 4)"
                placeholder="0.0000"
                leftIcon="banknotes"
            >
                <x-slot name="prefix">$</x-slot>
            </x-ui.input>
        </x-ui.field>
    </div>
</x-demo>
@endblade

```blade
<!-- Standard USD format -->
<x-ui.input x-mask:dynamic="$money($input)" placeholder="0.00">
    <x-slot name="prefix">$</x-slot>
</x-ui.input>

<!-- European format (comma as decimal separator) -->
<x-ui.input x-mask:dynamic="$money($input, ',')" placeholder="0,00">
    <x-slot name="suffix">€</x-slot>
</x-ui.input>

<!-- Custom separators and precision -->
<x-ui.input 
    x-mask:dynamic="$money($input, '.', ',', 4)" 
    placeholder="0.0000"
>
    <x-slot name="prefix">$</x-slot>
</x-ui.input>
```

### Advanced Masking Examples

#### Social Security Number
@blade
<x-demo>
    <x-ui.field class="max-w-sm mx-auto">
        <x-ui.label>Social Security Number</x-ui.label>
        <x-ui.input 
            x-mask="999-99-9999"
            placeholder="123-45-6789"
            leftIcon="identification"
        />
    </x-ui.field>
</x-demo>
@endblade

```blade
<x-ui.input 
    x-mask="999-99-9999"
    placeholder="123-45-6789"
    leftIcon="identification"
/>
```

#### License Plate
@blade
<x-demo>
    <x-ui.field class="max-w-sm mx-auto">
        <x-ui.label>License Plate</x-ui.label>
        <x-ui.input 
            x-mask="aaa-9999"
            placeholder="ABC-1234"
            leftIcon="truck"
        />
    </x-ui.field>
</x-demo>
@endblade

```blade
<x-ui.input 
    x-mask="aaa-9999"
    placeholder="ABC-1234"
    leftIcon="truck"
/>
```

#### Custom Business Logic
@blade
<x-demo>
    <x-ui.field class="max-w-sm mx-auto">
        <x-ui.label>Account Number</x-ui.label>
        <x-ui.description>Different format based on account type</x-ui.description>
        <x-ui.input 
            x-mask:dynamic="
                $input.startsWith('SAV') ? 'aaa-9999-9999' : 
                $input.startsWith('CHK') ? 'aaa-999-999-999' : 
                '999-999-999'
            "
            placeholder="SAV-1234-5678"
            leftIcon="building-library"
        />
    </x-ui.field>
</x-demo>
@endblade

```blade
<x-ui.input 
    x-mask:dynamic="
        $input.startsWith('SAV') ? 'aaa-9999-9999' : 
        $input.startsWith('CHK') ? 'aaa-999-999-999' : 
        '999-999-999'
    "
    placeholder="SAV-1234-5678"
/>
```

### International Phone Numbers

Handle different international phone formats dynamically:

@blade
<x-demo>
    <x-ui.field class="max-w-sm mx-auto">
        <x-ui.label>International Phone</x-ui.label>
        <x-ui.description>US: +1, UK: +44, others: flexible format</x-ui.description>
        <x-ui.input 
            x-mask:dynamic="
                $input.startsWith('+1') ? '+1 (999) 999-9999' :
                $input.startsWith('+44') ? '+44 9999 999 999' :
                $input.startsWith('+') ? '+** *** *** ****' :
                '(999) 999-9999'
            "
            placeholder="+1 (555) 123-4567"
            leftIcon="phone"
        />
    </x-ui.field>
</x-demo>
@endblade

```blade
<x-ui.input 
    x-mask:dynamic="
        $input.startsWith('+1') ? '+1 (999) 999-9999' :
        $input.startsWith('+44') ? '+44 9999 999 999' :
        $input.startsWith('+') ? '+** *** *** ****' :
        '(999) 999-9999'
    "
    placeholder="+1 (555) 123-4567"
/>
```

### Complete Form with Masking

@blade
<x-demo>
    <form class="space-y-6">
        <x-ui.fieldset label="Personal Information">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-ui.field required>
                    <x-ui.label>Phone Number</x-ui.label>
                    <x-ui.input 
                        x-mask="(999) 999-9999"
                        placeholder="(555) 123-4567"
                        leftIcon="phone"
                    />
                </x-ui.field>
                <!--  -->
                <x-ui.field required>
                    <x-ui.label>Date of Birth</x-ui.label>
                    <x-ui.input 
                        x-mask="99/99/9999"
                        placeholder="MM/DD/YYYY"
                        leftIcon="calendar"
                    />
                </x-ui.field>
            </div>
            <!--  -->
            <x-ui.field>
                <x-ui.label>Social Security Number</x-ui.label>
                <x-ui.input 
                    x-mask="999-99-9999"
                    placeholder="123-45-6789"
                    type="password"
                    revealable
                    leftIcon="identification"
                />
            </x-ui.field>
        </x-ui.fieldset>
        <!--  -->
        <x-ui.fieldset label="Financial Information">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-ui.field>
                    <x-ui.label>Credit Card</x-ui.label>
                    <x-ui.input 
                        x-mask:dynamic="
                            $input.startsWith('34') || $input.startsWith('37')
                                ? '9999 999999 99999' : '9999 9999 9999 9999'
                        "
                        placeholder="1234 5678 9012 3456"
                        leftIcon="credit-card"
                    />
                </x-ui.field>
                <!--  -->
                <x-ui.field>
                    <x-ui.label>Annual Salary</x-ui.label>
                    <x-ui.input 
                        x-mask:dynamic="$money($input)"
                        placeholder="75,000.00"
                        leftIcon="banknotes"
                    >
                        <x-slot name="suffix">$</x-slot>
                    </x-ui.input>
                </x-ui.field>
            </div>
        </x-ui.fieldset>
    </form>
</x-demo>
@endblade

```blade
<form class="space-y-6">
    <x-ui.fieldset label="Personal Information">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-ui.field required>
                <x-ui.label>Phone Number</x-ui.label>
                <x-ui.input 
                    wire:model="phone"
                    x-mask="(999) 999-9999"
                    placeholder="(555) 123-4567"
                    leftIcon="phone"
                />
                <x-ui.error name="phone" />
            </x-ui.field>
            
            <x-ui.field required>
                <x-ui.label>Date of Birth</x-ui.label>
                <x-ui.input 
                    wire:model="dob"
                    x-mask="99/99/9999"
                    placeholder="MM/DD/YYYY"
                    leftIcon="calendar"
                />
                <x-ui.error name="dob" />
            </x-ui.field>
        </div>
        
        <x-ui.field>
            <x-ui.label>Social Security Number</x-ui.label>
            <x-ui.input 
                wire:model="ssn"
                x-mask="999-99-9999"
                placeholder="123-45-6789"
                type="password"
                revealable
                leftIcon="identification"
            />
            <x-ui.error name="ssn" />
        </x-ui.field>
    </x-ui.fieldset>
    
    <x-ui.fieldset label="Financial Information">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-ui.field>
                <x-ui.label>Credit Card</x-ui.label>
                <x-ui.input 
                    wire:model="credit_card"
                    x-mask:dynamic="
                        $input.startsWith('34') || $input.startsWith('37')
                            ? '9999 999999 99999' : '9999 9999 9999 9999'
                    "
                    placeholder="1234 5678 9012 3456"
                    leftIcon="credit-card"
                />
                <x-ui.error name="credit_card" />
            </x-ui.field>
            
            <x-ui.field>
                <x-ui.label>Annual Salary</x-ui.label>
                <x-ui.input 
                    wire:model="salary"
                    x-mask:dynamic="$money($input)"
                    placeholder="75,000.00"
                    leftIcon="banknotes"
                >
                    <x-slot name="prefix">$</x-slot>
                </x-ui.input>
                <x-ui.error name="salary" />
            </x-ui.field>
        </div>
    </x-ui.fieldset>
</form>
```

### Money Function Parameters

The `$money()` function accepts several parameters for customization:

```javascript
$money(input, decimal_separator, thousands_separator, precision)
```

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `input` | string | - | The current input value |
| `decimal_separator` | string | `'.'` | Character for decimal separation |
| `thousands_separator` | string | `','` | Character for thousands separation |
| `precision` | number | `2` | Number of decimal places |

## Component Props

### Input Component Props

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `wire:model` | string | - | Yes | Livewire property to bind to |
| `name` | string | - | No | Input name attribute |
| `type` | string | `'text'` | No | Input type (text, email, password, etc.) |
| `placeholder` | string | - | No | Placeholder text |
| `disabled` | boolean | `false` | No | Whether input is disabled |
| `readonly` | boolean | `false` | No | Whether input is readonly |
| `invalid` | boolean | `false` | No | Whether input has validation errors |
| `prefix` | slot | - | No | Content to show before input |
| `suffix` | slot | - | No | Content to show after input |
| `prefixIcon` | string | - | No | Icon name to show as prefix |
| `suffixIcon` | string | - | No | Icon name to show as suffix |
| `leftIcon` | string/slot | - | No | Icon name or custom content (slottable) |
| `rightIcon` | string/slot | - | No | Icon name or custom content (slottable) |
| `copyable` | boolean | `false` | No | Add copy to clipboard button |
| `clearable` | boolean | `false` | No | Add clear input button |
| `revealable` | boolean | `false` | No | Add password reveal toggle |
| `autocomplete` | string | - | No | HTML autocomplete attribute |
| `class` | string | `''` | No | Additional CSS classes |

### Field Component Props

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `required` | boolean | `false` | No | Whether field is required |
| `disabled` | boolean | `false` | No | Whether field is disabled |

### Label Component Props

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `text` | string | - | No | Label text (alternative to slot) |
| `required` | boolean | `false` | No | Whether to show required indicator |

### Error Component Props

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `name` | string | - | No | Field name to get errors from $errors bag |
| `messages` | array | `[]` | No | Manual error messages |

### Fieldset Component Props

| Prop Name | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `label` | string | - | No | Fieldset legend text |
| `labelHidden` | boolean | `false` | No | Whether to hide the legend visually |