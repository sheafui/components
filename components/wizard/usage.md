---
name: 'wizard'
---

## Introduction

The **Wizard** component provides a step-by-step interface for multi-step forms and workflows. With clean visual progress indicators and flexible content areas, it's perfect for onboarding flows, multi-page forms, and guided processes.

## Installation

Use the Sheaf artisan command to install the wizard component:

```bash
php artisan sheaf:install wizard
```

> Once installed, you can use `<x-ui.wizard />`, `<x-ui.wizard.steps />`, `<x-ui.wizard.step />`, and `<x-ui.wizard.body />` components in any Blade view.

## Basic Usage

@blade
<x-demo class="flex justify-center">
    <x-ui.wizard variant="default">
        <x-ui.wizard.steps color="blue">
            <x-ui.wizard.step :active="false" :completed="true" :label="1">
                <x-ui.heading>Personal Info</x-ui.heading>
                <x-ui.text class="opacity-70">Name and email</x-ui.text>
            </x-ui.wizard.step>

            <x-ui.wizard.step :active="false" :completed="true" :label="2">
                <x-ui.heading>Account Details</x-ui.heading>
                <x-ui.text class="opacity-70">addresses</x-ui.text>
            </x-ui.wizard.step>

            <x-ui.wizard.step :active="true" :completed="false" :label="3">
                <x-ui.heading>Verification</x-ui.heading>
                <x-ui.text class="opacity-70">Confirm your email</x-ui.text>
            </x-ui.wizard.step>
        </x-ui.wizard.steps>

        <x-ui.wizard.body>
            <div class="p-6">
                <x-ui.text>Step 3 content goes here</x-ui.text>
            </div>
        </x-ui.wizard.body>
    </x-ui.wizard>
</x-demo>
@endblade

```blade
<x-ui.wizard variant="default">
    <x-ui.wizard.steps color="sky">
        <x-ui.wizard.step :active="false" :completed="true" :label="1">
            <x-ui.heading>Personal Info</x-ui.heading>
            <x-ui.text class="opacity-70">Name and email</x-ui.text>
        </x-ui.wizard.step>

        <x-ui.wizard.step :active="false" :completed="true" :label="2">
            <x-ui.heading>Account Details</x-ui.heading>
            <x-ui.text class="opacity-70">Username and password</x-ui.text>
        </x-ui.wizard.step>

        <x-ui.wizard.step :active="true" :completed="false" :label="3">
            <x-ui.heading>Verification</x-ui.heading>
            <x-ui.text class="opacity-70">Confirm your email</x-ui.text>
        </x-ui.wizard.step>
    </x-ui.wizard.steps>

    <x-ui.wizard.body>
        <div class="p-6">
            <x-ui.text>Step 3 content goes here</x-ui.text>
        </div>
    </x-ui.wizard.body>
</x-ui.wizard>
```

## Variants

The wizard component supports two visual variants, in addition to the default variant above there is minimal variant:

### Minimal Variant

A cleaner design with connecting lines between steps:

@blade
<x-demo class="flex justify-center">
    <x-ui.wizard variant="minimal">
        <x-ui.wizard.steps>
            <x-ui.wizard.step :active="false" :completed="true" :label="1">
                <x-ui.heading>Choose Plan</x-ui.heading>
                <x-ui.text class="opacity-70">Select your subscription</x-ui.text>
            </x-ui.wizard.step>

            <x-ui.wizard.step :active="true" :completed="false" :label="2">
                <x-ui.heading>Payment</x-ui.heading>
                <x-ui.text class="opacity-70">Enter billing details</x-ui.text>
            </x-ui.wizard.step>

            <x-ui.wizard.step :active="false" :completed="false" :label="3">
                <x-ui.heading>Confirm</x-ui.heading>
                <x-ui.text class="opacity-70">Review and submit</x-ui.text>
            </x-ui.wizard.step>
        </x-ui.wizard.steps>

        <x-ui.wizard.body>
            <div class="p-6">
                <x-ui.text>Payment form goes here</x-ui.text>
            </div>
        </x-ui.wizard.body>
    </x-ui.wizard>
</x-demo>
@endblade

```blade
<x-ui.wizard variant="minimal">
    <x-ui.wizard.steps>
        <!-- Steps -->
    </x-ui.wizard.steps>

    <x-ui.wizard.body>
        <!-- Content -->
    </x-ui.wizard.body>
</x-ui.wizard>
```
## Color Customization

Customize the wizard's accent color using the `color` prop on `wizard.steps`:

@blade
<x-demo class="flex flex-col gap-y-6 justify-center">
    <x-ui.wizard variant="default">
        <x-ui.wizard.steps color="purple">
            <x-ui.wizard.step :active="false" :completed="true" :label="1">
                <x-ui.heading>Step 1</x-ui.heading>
                <x-ui.text class="opacity-70">Purple accent</x-ui.text>
            </x-ui.wizard.step>

            <x-ui.wizard.step :active="true" :label="2">
                <x-ui.heading>Step 2</x-ui.heading>
                <x-ui.text class="opacity-70">Active with purple</x-ui.text>
            </x-ui.wizard.step>

            <x-ui.wizard.step :active="false" :label="3">
                <x-ui.heading>Step 3</x-ui.heading>
                <x-ui.text class="opacity-70">Upcoming</x-ui.text>
            </x-ui.wizard.step>
        </x-ui.wizard.steps>

        <x-ui.wizard.body>
            <div class="p-6">
                <x-ui.text> purple themed wizard for default variant</x-ui.text>
            </div>
        </x-ui.wizard.body>
    </x-ui.wizard>
    <x-ui.wizard variant="minimal">
        <x-ui.wizard.steps color="teal">
            <x-ui.wizard.step :active="false" :completed="true" :label="1">
                <x-ui.heading>Step 1</x-ui.heading>
                <x-ui.text class="opacity-70">Purple accent</x-ui.text>
            </x-ui.wizard.step>

            <x-ui.wizard.step :active="true" :label="2">
                <x-ui.heading>Step 2</x-ui.heading>
                <x-ui.text class="opacity-70">Active with purple</x-ui.text>
            </x-ui.wizard.step>

            <x-ui.wizard.step :active="false" :label="3">
                <x-ui.heading>Step 3</x-ui.heading>
                <x-ui.text class="opacity-70">Upcoming</x-ui.text>
            </x-ui.wizard.step>
        </x-ui.wizard.steps>

        <x-ui.wizard.body>
            <div class="p-6">
                <x-ui.text>teal themed wizard for minimal variant </x-ui.text>
            </div>
        </x-ui.wizard.body>
    </x-ui.wizard>
</x-demo>
@endblade

```blade
<x-ui.wizard>
    <x-ui.wizard.steps color="purple">
        <x-ui.wizard.step :active="true" :label="1">
            <x-ui.heading>Step 1</x-ui.heading>
        </x-ui.wizard.step>
        <!-- More steps -->
    </x-ui.wizard.steps>
</x-ui.wizard>
<x-ui.wizard variant="minimal">
    <x-ui.wizard.steps color="teal">
        <x-ui.wizard.step :active="true" :label="1">
            <x-ui.heading>Step 1</x-ui.heading>
        </x-ui.wizard.step>
        <!-- More steps -->
    </x-ui.wizard.steps>
</x-ui.wizard>
```

Available colors: `slate`, `neutral`, `zinc`, `stone`, `red`, `orange`, `amber`, `yellow`, `lime`, `green`, `emerald`, `teal`, `cyan`, `sky`, `blue`, `indigo`, `violet`, `purple`, `fuchsia`, `pink`, `rose`

## Custom Icons

Use custom icons instead of numbers for step labels:

@blade
<x-demo class="flex justify-center">
    <x-ui.wizard variant="minimal">
        <x-ui.wizard.steps >
            <x-ui.wizard.step icon="user" :active="false" :completed="true">
                <x-ui.heading>Profile</x-ui.heading>
                <x-ui.text class="opacity-70">Basic information</x-ui.text>
            </x-ui.wizard.step>

            <x-ui.wizard.step icon="credit-card" :active="true">
                <x-ui.heading>Payment</x-ui.heading>
                <x-ui.text class="opacity-70">Billing details</x-ui.text>
            </x-ui.wizard.step>

            <x-ui.wizard.step icon="check-circle" :active="false">
                <x-ui.heading>Complete</x-ui.heading>
                <x-ui.text class="opacity-70">Finish setup</x-ui.text>
            </x-ui.wizard.step>
        </x-ui.wizard.steps>

        <x-ui.wizard.body>
            <div class="p-6">
                <x-ui.text>Icon-based steps</x-ui.text>
            </div>
        </x-ui.wizard.body>
    </x-ui.wizard>
</x-demo>
@endblade

```blade
<x-ui.wizard.step icon="user" :active="true">
    </x-slot:icon>
    <x-ui.heading>Profile</x-ui.heading>
    <x-ui.text>Basic information</x-ui.text>
</x-ui.wizard.step>
```

You can also customize the completed icon:
@blade
<x-demo class="flex justify-center">
    <x-ui.wizard variant="minimal">
        <x-ui.wizard.steps >
            <x-ui.wizard.step icon="user" :active="false" completedIcon="check-badge" :completed="true">
                <x-ui.heading>Profile</x-ui.heading>
                <x-ui.text class="opacity-70">Basic information</x-ui.text>
            </x-ui.wizard.step>

            <x-ui.wizard.step icon="credit-card" :active="true">
                <x-ui.heading>Payment</x-ui.heading>
                <x-ui.text class="opacity-70">Billing details</x-ui.text>
            </x-ui.wizard.step>

            <x-ui.wizard.step icon="check-circle" :active="false">
                <x-ui.heading>Complete</x-ui.heading>
                <x-ui.text class="opacity-70">Finish setup</x-ui.text>
            </x-ui.wizard.step>
        </x-ui.wizard.steps>

        <x-ui.wizard.body>
            <div class="p-6">
                <x-ui.text>Icon-based steps</x-ui.text>
            </div>
        </x-ui.wizard.body>
    </x-ui.wizard>
</x-demo>
@endblade

```blade
<x-ui.wizard.step :completed="true" completedIcon="check-badge">
    <x-ui.heading>Completed</x-ui.heading>
</x-ui.wizard.step>
```

Looking at the datatable guide for structure inspiration, here's a clean implementation guide for the wizard — usage-focused, no internals exposed.

---

## Implementation Guide

This guide shows you how to build a fully functional multi-step wizard using Livewire. We'll create a user onboarding flow with account creation, profile setup, and preferences configuration.

### Overview

We'll build a wizard that:
- **Tracks progress** through three steps: Account, Profile, Preferences
- **Validates each step** before allowing progression
- **Allows skipping** optional steps
- **Collects all data** and saves atomically at the end


### Step 1: Create Form Objects

Create a separate Livewire Form class for each step to own its fields and validation rules.

**Account Form — `app/Livewire/Forms/AccountForm.php`:**
```php
<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class AccountForm extends Form
{
    #[Validate('required|min:3')]
    public string $username = '';

    #[Validate('required|email')]
    public string $email = '';
}
```

**Profile Form — `app/Livewire/Forms/ProfileForm.php`:**
```php
<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ProfileForm extends Form
{
    #[Validate('required|min:3')]
    public string $first_name = '';

    #[Validate('required|min:3')]
    public string $last_name = '';
}
```

**Preferences Form — `app/Livewire/Forms/PreferencesForm.php`:**
```php
<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class PreferencesForm extends Form
{
    public bool $email_notifications = true;
    public bool $push_notifications = false;
    public bool $sms_notifications = false;
}
```

> **Note:** Steps with no validation rules (like Preferences) will advance freely. The wizard handles this automatically.

---

### Step 2: Create the Wizard Component

Use the `HasWizard` trait and implement `setupWizard()` to define your steps:

```php
<?php

namespace App\Livewire;

use App\View\Components\Step;
use App\View\Components\Wizard;
use App\Livewire\Forms\AccountForm;
use App\Livewire\Forms\ProfileForm;
use App\Livewire\Forms\PreferencesForm;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;
use App\Livewire\Concerns\HasWizard;

class UserOnboarding extends Component
{
    use HasWizard;

    public Wizard $wizard;

    public AccountForm $account;
    public ProfileForm $profile;
    public PreferencesForm $preferences;

    public function submit(): void
    {
        DB::transaction(function () {
            // $this->wizard->all() returns all form data keyed by step
            $data = $this->wizard->all();
            // persist $data...
        });
    }

    public function render(): View
    {
        return view('livewire.user-onboarding');
    }

    protected function setupWizard(): array
    {
        return [
            new Step(
                key: 'account',
                form: $this->account,
                view: 'livewire.wizard.steps.account',
            ),
            new Step(
                key: 'profile',
                form: $this->profile,
                view: 'livewire.wizard.steps.profile',
                skippable: true,
            ),
            new Step(
                key: 'preferences',
                form: $this->preferences,
                view: 'livewire.wizard.steps.preferences',
            ),
        ];
    }
}
```

**Key points:**
- `HasWizard` provides `nextStep()`, `previousStep()`, `skipStep()`, and `goToStep()`: wire these directly from your blade
- `setupWizard()` is the only method you implement — return an array of `Step` objects
- Mark optional steps with `skippable: true`
- `$this->wizard->all()` returns all form data keyed by step key at submit time


### Step 3: Create the Wizard View

```blade
<div>
    <x-ui.wizard variant="default">
        <x-ui.wizard.steps color="orange">
            <x-ui.wizard.step
                :active="$wizard->isActive('account')"
                :completed="$wizard->isCompleted('account')"
                :label="1"
            >
                <x-ui.heading>Account Information</x-ui.heading>
                <x-ui.text class="opacity-70">Create your account credentials.</x-ui.text>
            </x-ui.wizard.step>

            <x-ui.wizard.step
                :active="$wizard->isActive('profile')"
                :completed="$wizard->isCompleted('profile')"
                :label="2"
            >
                <x-ui.heading>Profile Information</x-ui.heading>
                <x-ui.text class="opacity-70">Tell us more about yourself.</x-ui.text>
            </x-ui.wizard.step>

            <x-ui.wizard.step
                :active="$wizard->isActive('preferences')"
                :completed="$wizard->isCompleted('preferences')"
                :label="3"
            >
                <x-ui.heading>Preferences & Review</x-ui.heading>
                <x-ui.text class="opacity-70">Customize your notification preferences.</x-ui.text>
            </x-ui.wizard.step>
        </x-ui.wizard.steps>

        <x-ui.wizard.body>
            <div class="p-6">
                {{-- Render the current step's view dynamically --}}
                <x-dynamic-component
                    :component="$wizard->currentStep()->view()"
                    :statePath="$wizard->currentStep()->statePath()"
                />

                <div class="flex items-center justify-between mt-8 pt-6">
                    @if (!$wizard->isFirst())
                        <x-ui.button wire:click="previousStep" size="sm" variant="soft">
                            Previous
                        </x-ui.button>
                    @endif

                    <div class="flex gap-2 ml-auto">
                        @if ($wizard->isSkippable($wizard->currentKey()) && !$wizard->isLast())
                            <x-ui.button wire:click="skipStep" size="sm" variant="ghost">
                                Skip
                            </x-ui.button>
                        @endif

                        @if (!$wizard->isLast())
                            <x-ui.button wire:click="nextStep" size="sm" variant="outline">
                                Next
                            </x-ui.button>
                        @else
                            <x-ui.button wire:click="submit" size="sm" variant="outline" color="green">
                                Complete Setup
                            </x-ui.button>
                        @endif
                    </div>
                </div>
            </div>
        </x-ui.wizard.body>
    </x-ui.wizard>
</div>
```

**Key points:**
- `$wizard->isActive()`, `isCompleted()`, `isFirst()`, `isLast()`, `isSkippable()` drive all the conditional UI
- `$wizard->currentStep()->view()` and `->statePath()` are passed to `x-dynamic-component` so each step renders its own Blade partial with the correct `wire:model` prefix
- No `@if` chain per step — the dynamic component handles it cleanly

### Step 4: Create Step Content Partials

Each step is a standalone Blade component that receives `$statePath` — use it as the `wire:model` prefix so bindings stay decoupled from the parent component's property names.

**`resources/views/livewire/wizard/steps/account.blade.php`:**
```blade
@props(['statePath'])

<div class="space-y-6">
    <div>
        <x-ui.heading size="lg">Account Information</x-ui.heading>
        <x-ui.text class="opacity-70 mt-2">Create your account credentials to get started.</x-ui.text>
    </div>

    <div class="space-y-4">
        <x-ui.field required>
            <x-ui.label>Username</x-ui.label>
            <x-ui.input
                wire:model="{{ $statePath }}.username"
                type="text"
                placeholder="johndoe"
                autocomplete="username"
            />
            <x-ui.error name="username" />
            <x-ui.description>Choose a unique username that will identify you.</x-ui.description>
        </x-ui.field>

        <x-ui.field required>
            <x-ui.label>Email Address</x-ui.label>
            <x-ui.input
                wire:model="{{ $statePath }}.email"
                type="email"
                placeholder="john@example.com"
                autocomplete="email"
            />
            <x-ui.error name="email" />
            <x-ui.description>We'll send verification to this email.</x-ui.description>
        </x-ui.field>
    </div>
</div>
```

**`resources/views/livewire/wizard/steps/profile.blade.php`:**
```blade
@props(['statePath'])

<div class="space-y-6">
    <div>
        <x-ui.heading size="lg">Profile Information</x-ui.heading>
        <x-ui.text class="opacity-70 mt-2">Tell us more about yourself to personalize your experience.</x-ui.text>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <x-ui.field required>
            <x-ui.label>First Name</x-ui.label>
            <x-ui.input
                wire:model="{{ $statePath }}.first_name"
                type="text"
                placeholder="John"
            />
            <x-ui.error name="first_name" />
        </x-ui.field>

        <x-ui.field required>
            <x-ui.label>Last Name</x-ui.label>
            <x-ui.input
                wire:model="{{ $statePath }}.last_name"
                type="text"
                placeholder="Doe"
            />
            <x-ui.error name="last_name" />
        </x-ui.field>
    </div>
</div>
```

**`resources/views/livewire/wizard/steps/preferences.blade.php`:**
```blade
@props(['statePath'])

<div class="space-y-6">
    <div>
        <x-ui.heading size="lg">Preferences</x-ui.heading>
        <x-ui.text class="opacity-70 mt-2">Customize how you receive notifications.</x-ui.text>
    </div>

    <div class="space-y-3">
        <x-ui.switch
            wire:model.live="{{ $statePath }}.email_notifications"
            label="Email Notifications"
            description="Receive notifications via email"
        />
        <x-ui.switch
            wire:model.live="{{ $statePath }}.push_notifications"
            label="Push Notifications"
            description="Receive browser push notifications"
        />
        <x-ui.switch
            wire:model.live="{{ $statePath }}.sms_notifications"
            label="SMS Notifications"
            description="Receive text message alerts"
        />
    </div>
</div>
```

> **Note:** Always use `{{ $statePath }}.fieldName` as your `wire:model` target. `statePath()` resolves to the Livewire component property name that owns the form (e.g. `account`, `profile`), keeping your step partials fully reusable across different wizard instances.


### How It Works

**Step navigation:** Clicking Next calls `nextStep()` which validates the current step's form. If validation passes, the step is marked complete and the wizard advances. Previous goes back without re-validating.

**Skippable steps:** When a step is marked `skippable: true`, a Skip button appears. Clicking it advances without triggering validation.

**Dynamic rendering:** `x-dynamic-component` renders whichever view the current step declares. No `@if/$currentStep === 'x'` chains needed — adding a new step is a single `Step` entry in `setupWizard()`.

**Final submission:** `$this->wizard->all()` returns a keyed array of every form's data, ready to persist in a transaction.


## Component Props

### ui.wizard

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `variant` | string | `'default'` | Visual variant: `'default'` or `'minimal'` |
| `contained` | boolean | `false` | Remove borders/spacing for custom containers |

### ui.wizard.steps

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `color` | string | `null` | Accent color for active/completed states (any Tailwind color) |
| `variant` | string | inherited | Visual variant (inherited from parent `wizard`) |
| `contained` | boolean | inherited | Remove borders (inherited from parent `wizard`) |

### ui.wizard.step

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `active` or `data-active` | boolean | `false` | Whether this is the current active step |
| `completed` or `data-active` | boolean | `false` | Whether this step has been completed |
| `label` | mixed | `1` | Label to display (number or custom content) |
| `icon` | slot | `null` | Custom icon to replace label |
| `completedIcon` | string | `'check'` | Icon name to show when step is completed |

### ui.wizard.body

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `contained` | boolean | inherited | Remove border (inherited from parent `wizard`) |