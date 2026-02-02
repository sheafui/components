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

## Implementation Guide

This guide shows you how to build a fully functional multi-step wizard using Livewire. We'll create a user onboarding flow with account creation, profile setup, and preferences configuration.

@blade
<x-md.cta                                                            
    href="/demos/wizard"                                    
    label="See the complete wizard in action"
    ctaLabel="Visit Live Demo"
/>
@endblade

### Overview

We'll build a wizard that:
- **Tracks progress** through three steps: Account, Profile, Preferences
- **Validates each step** before allowing progression
- **Allows skipping** optional steps
- **Collects all data** and saves atomically at the end

### Step 1: Create Form Objects

Create separate form objects for each step to organize validation and data:

**Account Form `app/Livewire/Forms/AccountForm.php`:**
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

**Profile Form (app/Livewire/Forms/ProfileForm.php):**
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

**Preferences Form (app/Livewire/Forms/PreferencesForm.php):**
```php
<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class PreferencesForm extends Form
{
    public bool $email_notifications = true;
    
    public bool $push_notifications = false;
    
    public bool $sms_notifications = false;
}
```

### Step 2: Create the Wizard Component

Create your main Livewire component:

```php
<?php

namespace App\Livewire;

use App\Livewire\Forms\AccountForm;
use App\Livewire\Forms\ProfileForm;
use App\Livewire\Forms\PreferencesForm;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserOnboarding extends Component
{
    use WithFileUploads;

    public string $currentStep = 'account';
    public array $completed = [];

    public AccountForm $account;
    public ProfileForm $profile;
    public PreferencesForm $preferences;

    /**
     * Define wizard steps configuration
     */
    #[Computed]
    public function steps(): array
    {
        return [
            'account' => [
                'form' => $this->account,
                'skippable' => false,
            ],
            'profile' => [
                'form' => $this->profile,
                'skippable' => true,
            ],
            'preferences' => [
                'form' => $this->preferences,
                'skippable' => false,
            ],
        ];
    }

    /**
     * Get current step configuration
     */
    public function currentStepData(): array
    {
        return $this->steps()[$this->currentStep];
    }

    /**
     * Check if step can be skipped
     */
    public function isStepSkippable(string $step): bool
    {
        return $this->steps()[$step]['skippable'] ?? false;
    }

    /**
     * Check if on first step
     */
    public function isFirstStep(): bool
    {
        return $this->currentStep === array_key_first($this->steps());
    }

    /**
     * Check if on last step
     */
    public function isLastStep(): bool
    {
        return $this->currentStep === array_key_last($this->steps());
    }

    /**
     * Navigate to specific step
     */
    public function goToStep(string $step): void
    {
        if (array_key_exists($step, $this->steps())) {
            $this->currentStep = $step;
        }
    }

    /**
     * Move to next step with validation
     */
    public function nextStep(bool $validate = true): void
    {
        $keys = array_keys($this->steps());
        $currentIndex = array_search($this->currentStep, $keys);

        // Validate current step if required
        if ($validate) {
            $this->steps()[$this->currentStep]['form']->validate();
        }

        // Mark step as completed
        if (!in_array($this->currentStep, $this->completed)) {
            $this->completed[] = $this->currentStep;
        }

        // Move to next step
        $nextIndex = $currentIndex + 1;
        if (isset($keys[$nextIndex])) {
            $this->goToStep($keys[$nextIndex]);
        }
    }

    /**
     * Move to previous step
     */
    public function previousStep(): void
    {
        $keys = array_keys($this->steps());
        $currentIndex = array_search($this->currentStep, $keys);

        $prevIndex = $currentIndex - 1;
        if (isset($keys[$prevIndex])) {
            $this->goToStep($keys[$prevIndex]);
            
            // Remove current step from completed
            $this->completed = array_filter(
                $this->completed, 
                fn($step) => $step !== $this->currentStep
            );
        }
    }

    /**
     * Skip current step if allowed
     */
    public function skipStep(): void
    {
        if ($this->isStepSkippable($this->currentStep) && !$this->isLastStep()) {
            $this->nextStep(false); // Skip validation
        }
    }

    /**
     * Get all form data
     */
    public function getAllFormsData(): array
    {
        return collect($this->steps())
            ->mapWithKeys(fn($step, $key) => [$key => $step['form']->all()])
            ->toArray();
    }

    /**
     * Submit the wizard
     */
    public function submit(): void
    {
        // Validate all non-skippable steps
        foreach ($this->steps() as $stepKey => $stepConfig) {
            if (!$stepConfig['skippable']) {
                $stepConfig['form']->validate();
            }
        }

        $allData = $this->getAllFormsData();

        // Save everything in a transaction
        DB::transaction(function () use ($allData) {
            $user = User::create([
                'username' => $allData['account']['username'],
                'email' => $allData['account']['email'],
                'password' => Hash::make($allData['account']['password']),
                'first_name' => $allData['profile']['first_name'] ?? null,
                'last_name' => $allData['profile']['last_name'] ?? null,
            ]);

            // Handle avatar upload if present
            if ($allData['profile']['avatar'] ?? null) {
                $path = $allData['profile']['avatar']->store('avatars', 'public');
                $user->update(['avatar' => $path]);
            }

            // Save preferences
            $user->preferences()->create($allData['preferences']);

            // Log the user in
            auth()->login($user);
        });

        // Redirect to dashboard
        $this->redirect(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.user-onboarding');
    }
}
```

### Step 3: Create the View

Create the Blade template for your wizard:

**resources/views/livewire/user-onboarding.blade.php:**
```blade
<div>
    <x-ui.wizard >
        <x-ui.wizard.steps color="blue">
            <x-ui.wizard.step 
                :active="$currentStep === 'account'" 
                x-bind:data-completed="$wire.completed.includes('account')" 
                :label="1"
            >
                <x-ui.heading>Account Information</x-ui.heading>
                <x-ui.text class="opacity-70">
                    Create your account credentials.
                </x-ui.text>
            </x-ui.wizard.step>

            <x-ui.wizard.step 
                :active="$currentStep === 'profile'" 
                x-bind:data-completed="$wire.completed.includes('profile')" 
                :label="2"
            >
                <x-ui.heading>Profile Information</x-ui.heading>
                <x-ui.text class="opacity-70">
                    Tell us more about yourself.
                </x-ui.text>
            </x-ui.wizard.step>

            <x-ui.wizard.step 
                :active="$currentStep === 'preferences'" 
                x-bind:data-completed="$wire.completed.includes('preferences')" 
                :label="3"
            >
                <x-ui.heading>Preferences & Review</x-ui.heading>
                <x-ui.text class="opacity-70">
                    Customize your notification preferences.
                </x-ui.text>
            </x-ui.wizard.step>
        </x-ui.wizard.steps>

        <x-ui.wizard.body>
            <div class="p-6">
                @if ($currentStep === 'account')
                    <x-components::demos.user-on-boarding.account :$account />
                @elseif ($currentStep === 'profile')
                    <x-components::demos.user-on-boarding.profile :$profile />
                @elseif ($currentStep === 'preferences')
                    <x-components::demos.user-on-boarding.preferences :$preferences />
                @endif

                <div class="flex items-center justify-between mt-8 pt-6">
                    @if (!$this->isFirstStep())
                        <x-ui.button wire:click="previousStep" variant="soft">Previous</x-ui.button>
                    @else
                        <div></div>
                    @endif

                    <div class="flex gap-2 ml-auto">
                        @if ($this->isStepSkippable($currentStep) && !$this->isLastStep())
                            <x-ui.button wire:click="skipStep" variant="ghost">Skip</x-ui.button>
                        @endif

                        @if (!$this->isLastStep())
                            <x-ui.button wire:click="nextStep(true)" variant="outline">Next</x-ui.button>
                        @else
                            <x-ui.button wire:click="submit" variant="outline" color="green">Complete
                                Setup</x-ui.button>
                        @endif
                    </div>
                </div>
            </div>
        </x-ui.wizard.body>
    </x-ui.wizard>
</div>
```

### Step 4: Create Step Content Components

Create Blade components for each step's content:

**resources/views/livewire/wizard/steps/account.blade.php:**
```blade
@props([
    'account' // just in case you want to interact with it here  
]) 

<div {{ $attributes }} class="space-y-6">
    <div>
        <x-ui.heading size="lg">Account Information</x-ui.heading>
        <x-ui.text class="opacity-70 mt-2">
            Create your account credentials to get started
        </x-ui.text>
    </div>

    <form class="space-y-4">
        <x-ui.field required>
            <x-ui.label>Username</x-ui.label>
            <x-ui.input 
                wire:model="account.username" 
                type="text" 
                placeholder="johndoe" 
                autocomplete="username"
            />
            <x-ui.error name="username" />
            <x-ui.description>Choose a unique username that will identify you</x-ui.description>
        </x-ui.field>

        <x-ui.field required>
            <x-ui.label>Email Address</x-ui.label>
            <x-ui.input 
                wire:model="account.email" 
                type="email" 
                placeholder="john@example.com" 
                autocomplete="email"
            />
            <x-ui.error name="email" />
            <x-ui.description>We'll send verification to this email</x-ui.description>
        </x-ui.field>
    </form>
</div>
```

**resources/views/livewire/wizard/steps/profile.blade.php:**
```blade
@props(['profile'=>null])
<div {{ $attributes }} class="space-y-6">
    <div>
        <x-ui.heading size="lg">Profile Information</x-ui.heading>
        <x-ui.text class="opacity-70 mt-2">
            Tell us more about yourself to personalize your experience
        </x-ui.text>
    </div>

    <form class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <x-ui.field required>
                <x-ui.label>First Name</x-ui.label>
                <x-ui.input 
                    wire:model="profile.first_name" 
                    type="text" 
                    placeholder="John" 
                />
                <x-ui.error name="first_name" />
            </x-ui.field>

            <x-ui.field required>
                <x-ui.label>Last Name</x-ui.label>
                <x-ui.input 
                    wire:model="profile.last_name" 
                    type="text" 
                    placeholder="Doe" 
                />
                <x-ui.error name="last_name" />
            </x-ui.field>
        </div>
    </form>
</div>
```

**resources/views/livewire/wizard/steps/preferences.blade.php:**
```blade
<div {{ $attributes }} class="space-y-6">
    <div>
        <x-ui.heading size="lg">Preferences & Review</x-ui.heading>
        <x-ui.text class="opacity-70 mt-2">
            Customize your notification preferences and review your information before submitting
        </x-ui.text>
    </div>

    <div class="space-y-6">
        <div class="p-4 dark:bg-white/1 bg-neutral-800/1 rounded-lg space-y-4">
            <div>
                <x-ui.heading size="sm">Notification Channels</x-ui.heading>
                <x-ui.text size="sm" class="opacity-70 mt-1">
                    Choose how you want to receive notifications
                </x-ui.text>
            </div>

            <div class="space-y-3">
                <x-ui.switch 
                    wire:model.live="preferences.email_notifications"
                    label="Email Notifications"
                    description="Receive notifications via email"
                />

                <x-ui.switch 
                    wire:model.live="preferences.push_notifications"
                    label="Push Notifications"
                    description="Receive browser push notifications"
                />

                <x-ui.switch 
                    wire:model.live="preferences.sms_notifications"
                    label="SMS Notifications"
                    description="Receive text message alerts (standard rates apply)"
                />
            </div>
        </div>
    </div>
</div>
```

### How It Works

**Step Navigation:**
- User fills out form on current step
- Clicks "Next" → `nextStep()` validates current form
- If valid → marks step complete, moves to next
- Clicks "Previous" → goes back without validation

**Skippable Steps:**
- Profile step is marked `skippable: true`
- "Skip" button appears on profile step
- Clicking skip moves forward without validation

**Completion Tracking:**
- `completed` array tracks finished steps
- Alpine.js binds `data-completed` attribute
- CSS shows checkmark on completed steps

**Final Submission:**
- On last step, "Complete Setup" button appears
- Validates all required forms
- Saves all data in database transaction
- Redirects to dashboard

This pattern gives you a robust, production-ready wizard with clean separation of concerns!

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
| `active` | boolean | `false` | Whether this is the current active step |
| `completed` | boolean | `false` | Whether this step has been completed |
| `label` | mixed | `1` | Label to display (number or custom content) |
| `icon` | slot | `null` | Custom icon to replace label |
| `completedIcon` | string | `'check'` | Icon name to show when step is completed |

### ui.wizard.body

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `contained` | boolean | inherited | Remove border (inherited from parent `wizard`) |