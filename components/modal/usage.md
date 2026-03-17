---
name: 'modal'
new: [bare, shortcut]
---

# Modal Component

## Overview

Welcome to this advanced modal component engineered for **complete flexibility** and designed to be used seamlessly from anywhere in your application.

## Installation

Use the [sheaf artisan command](/docs/guides/cli-installation#content-component-management) to install the `modal` component easily:

```bash
php artisan sheaf:install modal
```

then you need to import the `./globals/modals.js` in your app.js like so:

```js
// ...
import './globals/modals.js';
// ...
```


### Basic Usage

All you need is to bind a trigger to a modal using a unique `id`. That's it.

@blade 
<x-demo>
    <x-ui.modal.trigger id="basic-modal" class="my-4">
        <x-ui.button>
            Open
        </x-ui.button>
    </x-ui.modal.trigger>
    <x-ui.modal
        id="basic-modal"
        heading="Basic Modal"
        description="This is a simple modal example"
    >
        <p>Modal content goes here...</p>
    </x-ui.modal> 
</x-demo>
@endblade

```blade
<x-ui.modal.trigger id="basic-modal">
    <x-ui.button>
        Open
    </x-ui.button>
</x-ui.modal.trigger>

<x-ui.modal 
    id="basic-modal"
    heading="Basic Modal"
    description="This is a simple modal example"
>
    <p>Modal content goes here...</p>
</x-ui.modal>
```

This component is designed to be controlled **globally via events** while supporting **isolated scoped instances**, giving you maximum control and flexibility for any UI scenario.

When using modals inside loops or repeated components, it's critical to generate unique modal ids dynamically. Without unique identifiers, a single modal trigger will open all modals sharing the same id on the page, leading to unpredictable and unwanted behavior.

```blade
@foreach ($posts as $post)
    <x-ui.modal :id="'edit-post-' . $post->slug">
        <!-- You may put the trigger here, and bind to it the same id -->
    </x-ui.modal>
@endforeach
```

### Usage with Livewire

Just dispatch events like you would do normally:

```php
use Livewire\Component;
 
class CreatePost extends Component
{
    public function update()
    {
        // ...

        $this->dispatch('open-modal', id: 'confirm-update');         
    }
}
```

> See an example of how to build a [confirmation modal](#confirmation-modal) below

### Usage with Blade 

```html
<x-ui.button 
    x-on:click="$modal.open('confirm-update')"
>
    Open confirm update modal
</x-ui.button>

<x-ui.button 
    x-on:click="$modal.close('confirm-update')"
>
    Close confirm update modal
</x-ui.button>

<x-ui.button
    x-on:click="$modal.closeAll()"
>
    Close all modals
</x-ui.button>
```

> See a deeper look at [modal store](#deeper-look-at-modal-store) below

## Positioning

By default, the modal is aligned vertically to the top, but you can also position it at center or bottom.

### Center & Bottom Positioning

@blade 
<x-demo>
    <div class="flex gap-2 justify-center">
        <x-ui.modal.trigger id="center-position" class="my-4">
            <x-ui.button>
                Center Modal Trigger
            </x-ui.button>
        </x-ui.modal.trigger>
        <x-ui.modal.trigger id="bottom-position" class="my-4">
            <x-ui.button>
                Bottom Modal Trigger
            </x-ui.button>
        </x-ui.modal.trigger>
    </div>
    <!-- CENTER POSITION MODAL -->
    <x-ui.modal
        id="center-position"
        position="center"
        heading="Center Modal"
        description="This modal is centered vertically"
    >
        <p>Modal content goes here...</p>
    </x-ui.modal> 
    <!-- BOTTOM POSITION MODAL -->
    <x-ui.modal
        id="bottom-position"
        position="bottom"
        heading="Bottom Modal"
        description="This modal appears at the bottom"
    >
        <p>Modal content goes here...</p>
    </x-ui.modal> 
</x-demo>
@endblade

```blade
<div class="flex gap-2 justify-center">
    <x-ui.modal.trigger id="center-position" class="my-4">
        <x-ui.button>
            Center Modal Trigger
        </x-ui.button>
    </x-ui.modal.trigger>
    <x-ui.modal.trigger id="bottom-position" class="my-4">
        <x-ui.button>
            Bottom Modal Trigger
        </x-ui.button>
    </x-ui.modal.trigger>
</div>

<!-- CENTER POSITION MODAL -->
<x-ui.modal
    id="center-position"
    {+position="center"+}
    heading="Center Modal"
    description="This modal is centered vertically"
>
    <p>Modal content goes here...</p>
</x-ui.modal> 

<!-- BOTTOM POSITION MODAL -->
<x-ui.modal
    id="bottom-position"
    {+position="bottom"+}
    heading="Bottom Modal"
    description="This modal appears at the bottom"
>
    <p>Modal content goes here...</p>
</x-ui.modal> 
```

## Slideover

You can transform the overlay modal into a slideover using the `slideover` prop:

@blade 
<x-demo>
    <x-ui.modal.trigger id="slideover-demo" class="my-4">
        <x-ui.button>
            Open Slideover
        </x-ui.button>
    </x-ui.modal.trigger>
    <x-ui.modal
        id="slideover-demo"
        heading="Slideover Modal"
        description="This is a slideover example"
        slideover
    >
        <p>Slideover content goes here...</p>
        <p>This panel slides in from the right side of the screen.</p>
    </x-ui.modal> 
</x-demo>
@endblade

```blade
<x-ui.modal.trigger id="slideover-demo">
    <x-ui.button>
        Open Slideover
    </x-ui.button>
</x-ui.modal.trigger>

<x-ui.modal 
    id="slideover-demo"
    heading="Slideover Modal"
    description="This is a slideover example"
    {+slideover+}
>
    <p>Slideover content goes here...</p>
</x-ui.modal>
```

## Bare

Sometimes you just need the modal shell, no heading, no padding, no close button. Pass `bare` to get raw modal functionality with full control over the content. for example you may use this for a command pallete

@blade
<x-demo>
    <x-ui.modal.trigger id="bare-demo">
        <x-ui.button>Open</x-ui.button>
    </x-ui.modal.trigger>
    <x-ui.modal id="bare-demo" bare width="sm">
        <div class="">
            <p class="text-sm text-neutral-600 dark:text-neutral-400">Full control over content.</p>
        </div>
    </x-ui.modal>
</x-demo>
@endblade
```blade
<x-ui.modal bare width="xl">
    {{-- everything is yours --}}
</x-ui.modal>
```

## Shortcut

Pass `:shortcut` to `modal.trigger` to bind one or more keyboard shortcuts — Alpine's modifier syntax, no setup needed.

@blade
<x-demo>
    <x-ui.modal.trigger id="shortcut-demo" :shortcut="['ctrl.k', 'cmd.k']">
        <x-ui.input as="button" kbd="⌘K" placeholder="Search..." leftIcon="magnifying-glass" />
    </x-ui.modal.trigger>
    <x-ui.modal 
        id="shortcut-demo" 
        width="xl"
        heading="Opened With Shortcut "
        description="This is a modal "
    />
</x-demo>
@endblade

```blade
<x-ui.modal.trigger id="shortcut-demo" :shortcut="['ctrl.k', 'cmd.k']">
    <x-ui.input as="button" kbd="⌘K" placeholder="Search..." leftIcon="magnifying-glass" />
</x-ui.modal.trigger>

    <x-ui.modal 
        id="shortcut-demo" 
        width="xl"
        heading="Opened With Shortcut "
        description="This is a modal "
    />
```

## Backdrop Options

By default, the modal uses a small blur effect as backdrop. In addition, you can choose between `transparent` and `dark` variants:

@blade 
<x-demo>
    <div class="flex gap-2 justify-center">
        <x-ui.modal.trigger id="transparent-backdrop" class="my-4">
            <x-ui.button>
                Transparent Backdrop
            </x-ui.button>
        </x-ui.modal.trigger>
        <x-ui.modal.trigger id="dark-backdrop" class="my-4">
            <x-ui.button>
                Dark Backdrop
            </x-ui.button>
        </x-ui.modal.trigger>
    </div>
    <!-- TRANSPARENT BACKDROP MODAL -->
    <x-ui.modal
        id="transparent-backdrop"
        backdrop="transparent"
        heading="Transparent Backdrop"
        description="This modal has a transparent backdrop"
    >
        <p>You can see the background clearly through the transparent backdrop.</p>
    </x-ui.modal> 
    <!-- DARK BACKDROP MODAL -->
    <x-ui.modal
        id="dark-backdrop"
        backdrop="dark"
        heading="Dark Backdrop"
        description="This modal has a dark backdrop"
    >
        <p>The background is darkened for better focus.</p>
    </x-ui.modal> 
</x-demo>
@endblade

```blade
<div class="flex gap-2 justify-center">
    <x-ui.modal.trigger id="transparent-backdrop" class="my-4">
        <x-ui.button>
            Transparent Backdrop
        </x-ui.button>
    </x-ui.modal.trigger>
    <x-ui.modal.trigger id="dark-backdrop" class="my-4">
        <x-ui.button>
            Dark Backdrop
        </x-ui.button>
    </x-ui.modal.trigger>
</div>

<!-- TRANSPARENT BACKDROP MODAL -->
<x-ui.modal
    id="transparent-backdrop"
    {+backdrop="transparent"+}
    heading="Transparent Backdrop"
    description="This modal has a transparent backdrop"
>
    <p>You can see the background clearly through the transparent backdrop.</p>
</x-ui.modal> 

<!-- DARK BACKDROP MODAL -->
<x-ui.modal
    id="dark-backdrop"
    {+backdrop="dark"+}
    heading="Dark Backdrop"
    description="This modal has a dark backdrop"
>
    <p>The background is darkened for better focus.</p>
</x-ui.modal> 
```

> Need a custom backdrop effect? You own the code, go tweak it for your needs!

## Animation Options

Control how your modal appears and disappears with different animation styles:

@blade 
<x-demo>
    <div class="flex gap-2 justify-center flex-wrap">
        <x-ui.modal.trigger id="scale-animation" class="my-2">
            <x-ui.button>
                Scale Animation
            </x-ui.button>
        </x-ui.modal.trigger>
        <x-ui.modal.trigger id="slide-animation" class="my-2">
            <x-ui.button>
                Slide Animation
            </x-ui.button>
        </x-ui.modal.trigger>
        <x-ui.modal.trigger id="fade-animation" class="my-2">
            <x-ui.button>
                Fade Animation
            </x-ui.button>
        </x-ui.modal.trigger>
    </div>
    
    <x-ui.modal
        id="scale-animation"
        animation="scale"
        heading="Scale Animation"
        description="This modal scales in and out"
    >
        <p>The modal scales from 95% to 100% size with opacity transition.</p>
    </x-ui.modal>
    
    <x-ui.modal
        id="slide-animation" 
        animation="slide"
        heading="Slide Animation"
        description="This modal slides in from the right"
    >
        <p>The modal slides in from the right side of the screen.</p>
    </x-ui.modal>
    
    <x-ui.modal
        id="fade-animation"
        animation="fade"
        heading="Fade Animation"
        description="This modal fades in and out"
    >
        <p>The modal simply fades in and out with opacity transition only.</p>
    </x-ui.modal>
</x-demo>
@endblade

```blade
<!-- Scale Animation (default) -->
<x-ui.modal
    id="scale-animation"
    {+animation="scale"+}
    heading="Scale Animation"
>
    <p>Scales from 95% to 100% size</p>
</x-ui.modal>

<!-- Slide Animation -->
<x-ui.modal
    id="slide-animation"
    {+animation="slide"+}
    heading="Slide Animation"
>
    <p>Slides in from the right</p>
</x-ui.modal>

<!-- Fade Animation -->
<x-ui.modal
    id="fade-animation"
    {+animation="fade"+}
    heading="Fade Animation"
>
    <p>Simple opacity transition</p>
</x-ui.modal>
```

## Modal Sizes

Control the width of your modals with predefined size options:

@blade 
<x-demo>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
        <x-ui.modal.trigger id="xs-modal" class="my-1">
            <x-ui.button size="sm">XS Modal</x-ui.button>
        </x-ui.modal.trigger>
        <x-ui.modal.trigger id="sm-modal" class="my-1">
            <x-ui.button size="sm">SM Modal</x-ui.button>
        </x-ui.modal.trigger>
        <x-ui.modal.trigger id="md-modal" class="my-1">
            <x-ui.button size="sm">MD Modal</x-ui.button>
        </x-ui.modal.trigger>
        <x-ui.modal.trigger id="lg-modal" class="my-1">
            <x-ui.button size="sm">LG Modal</x-ui.button>
        </x-ui.modal.trigger>
        <x-ui.modal.trigger id="xl-modal" class="my-1">
            <x-ui.button size="sm">XL Modal</x-ui.button>
        </x-ui.modal.trigger>
        <x-ui.modal.trigger id="2xl-modal" class="my-1">
            <x-ui.button size="sm">2XL Modal</x-ui.button>
        </x-ui.modal.trigger>
        <x-ui.modal.trigger id="full-modal" class="my-1">
            <x-ui.button size="sm">Full Modal</x-ui.button>
        </x-ui.modal.trigger>
        <x-ui.modal.trigger id="screen-modal" class="my-1">
            <x-ui.button size="sm">Screen Modal</x-ui.button>
        </x-ui.modal.trigger>
    </div>
    
    <x-ui.modal id="xs-modal" width="xs" heading="Extra Small Modal">
        <p>This is an extra small modal (max-w-xs)</p>
    </x-ui.modal>
    
    <x-ui.modal id="sm-modal" width="sm" heading="Small Modal">
        <p>This is a small modal (max-w-sm) - the default size</p>
    </x-ui.modal>
    
    <x-ui.modal id="md-modal" width="md" heading="Medium Modal">
        <p>This is a medium modal (max-w-md)</p>
    </x-ui.modal>
    
    <x-ui.modal id="lg-modal" width="lg" heading="Large Modal">
        <p>This is a large modal (max-w-lg)</p>
    </x-ui.modal>
    
    <x-ui.modal id="xl-modal" width="xl" heading="Extra Large Modal">
        <p>This is an extra large modal (max-w-xl)</p>
    </x-ui.modal>
    
    <x-ui.modal id="2xl-modal" width="2xl" heading="2XL Modal">
        <p>This is a 2XL modal (max-w-2xl)</p>
    </x-ui.modal>
    
    <x-ui.modal id="full-modal" width="full" heading="Full Width Modal">
        <p>This modal takes the full available width (max-w-full)</p>
    </x-ui.modal>
    
    <x-ui.modal id="screen-modal" width="screen" heading="Full Screen Modal">
        <p>This modal covers the entire screen (fixed inset-0)</p>
        <p>Perfect for mobile-first experiences or when you need maximum space.</p>
    </x-ui.modal>
</x-demo>
@endblade

```blade
<!-- Available width options -->
<x-ui.modal width="xs" />     <!-- max-w-xs -->
<x-ui.modal width="sm" />     <!-- max-w-sm (default) -->
<x-ui.modal width="md" />     <!-- max-w-md -->
<x-ui.modal width="lg" />     <!-- max-w-lg -->
<x-ui.modal width="xl" />     <!-- max-w-xl -->
<x-ui.modal width="2xl" />    <!-- max-w-2xl -->
<x-ui.modal width="3xl" />    <!-- max-w-3xl -->
<x-ui.modal width="4xl" />    <!-- max-w-4xl -->
<x-ui.modal width="5xl" />    <!-- max-w-5xl -->
<x-ui.modal width="6xl" />    <!-- max-w-6xl -->
<x-ui.modal width="7xl" />    <!-- max-w-7xl -->
<x-ui.modal width="full" />   <!-- max-w-full -->
<x-ui.modal width="screen-sm" />  <!-- max-w-screen-sm -->
<x-ui.modal width="screen-md" />  <!-- max-w-screen-md -->
<x-ui.modal width="screen-lg" />  <!-- max-w-screen-lg -->
<x-ui.modal width="screen-xl" />  <!-- max-w-screen-xl -->
<x-ui.modal width="screen-2xl" /> <!-- max-w-screen-2xl -->
<x-ui.modal width="screen" />     <!-- fixed inset-0 (full screen) -->
```

## Persistent Modals

Create modals that cannot be closed by clicking away or pressing escape:

@blade 
<x-demo>
    <x-ui.modal.trigger id="persistent-modal" class="my-4">
        <x-ui.button variant="warning">
            Open Persistent Modal
        </x-ui.button>
    </x-ui.modal.trigger>
    <!-- MODAL -->
    <x-ui.modal
        id="persistent-modal"
        persistent
        heading="Persistent Modal"
        description="This modal can only be closed using the close button"
    >
        <p>Try clicking outside or pressing escape - it won't close!</p>
        <p>You must use the close button or programmatically close it.</p>
    </x-ui.modal>
</x-demo>
@endblade

```blade
<x-ui.modal
    id="persistent-modal"
    {+persistent+}
    heading="Persistent Modal"
    description="This modal can only be closed using the close button"
>
    <p>This modal cannot be closed by clicking away or pressing escape.</p>
</x-ui.modal>
```

## Custom Headers and Footers

### Custom Footer

Add action buttons and custom footer content:

@blade 
<x-demo>
    <x-ui.modal.trigger id="custom-footer-modal" class="my-4">
        <x-ui.button>
            Custom Footer Modal
        </x-ui.button>
    </x-ui.modal.trigger>
    
    <x-ui.modal 
        id="custom-footer-modal"
        heading="Modal with Custom Footer"
        description="This modal has action buttons in the footer"
    >
        <p>This modal demonstrates custom footer with action buttons.</p>
        <p>Perfect for confirmation dialogs, forms, or any modal requiring user actions.</p>
        
        <x-slot name="footer">
            <div class="flex justify-end space-x-3">
                <x-ui.button x-on:click="$data.close();" variant="outline">
                    Cancel
                </x-ui.button>
                <x-ui.button x-on:click="$data.close();" variant="primary">
                    Confirm Action
                </x-ui.button>
            </div>
        </x-slot>
    </x-ui.modal>
</x-demo>
@endblade

```blade
<x-ui.modal 
    id="custom-footer-modal"
    heading="Modal with Custom Footer"
>
    <p>Modal content goes here...</p>
    
    <x-slot name="footer">
        <div class="flex justify-end space-x-3">
            <x-ui.button x-on:click="$data.close();" variant="outline">
                Cancel
            </x-ui.button>
            <x-ui.button x-on:click="$data.close();" variant="primary">
                Confirm Action
            </x-ui.button>
        </div>
    </x-slot>
</x-ui.modal>
```

## Sticky Headers and Footers

For modals with long content, make headers and footers stick to their positions:

@blade 
<x-demo>
    <x-ui.modal.trigger id="sticky-modal" class="my-4">
        <x-ui.button>
            Sticky Header/Footer Modal
        </x-ui.button>
    </x-ui.modal.trigger>
    
    <x-ui.modal
        id="sticky-modal"
        width="lg"
        heading="Sticky Header and Footer"
        description="Scroll to see the sticky behavior"
        sticky-header
        sticky-footer
    >
        <div class="space-y-4">
            @for($i = 1; $i <= 20; $i++)
                <p>This is paragraph {{ $i }}. The header and footer will remain visible as you scroll through this long content. This demonstrates the sticky behavior of both header and footer sections.</p>
            @endfor
        </div>
        
        <x-slot name="footer">
            <div class="flex justify-end space-x-3">
                <x-ui.button x-on:click="$data.close();" variant="outline">
                    Cancel
                </x-ui.button>
                <x-ui.button variant="primary">
                    Save Changes
                </x-ui.button>
            </div>
        </x-slot>
    </x-ui.modal>
</x-demo>
@endblade

```blade
<x-ui.modal
    id="sticky-modal"
    heading="Sticky Header and Footer"
    {+sticky-header+}
    {+sticky-footer+}
>
    <!-- Long content that scrolls -->
    <div class="space-y-4">
        <!-- Lots of content here -->
    </div>
    
    <x-slot name="footer">
        <!-- Footer buttons stay visible -->
    </x-slot>
</x-ui.modal>
```

## Text Alignment

Control the text alignment within your modal:

@blade 
<x-demo>
    <div class="flex gap-2 justify-center flex-wrap">
        <x-ui.modal.trigger id="left-align-modal" class="my-2">
            <x-ui.button size="sm">Left Align</x-ui.button>
        </x-ui.modal.trigger>
        <x-ui.modal.trigger id="center-align-modal" class="my-2">
            <x-ui.button size="sm">Center Align</x-ui.button>
        </x-ui.modal.trigger>
        <x-ui.modal.trigger id="right-align-modal" class="my-2">
            <x-ui.button size="sm">Right Align</x-ui.button>
        </x-ui.modal.trigger>
    </div>
    <!--  -->
    <x-ui.modal
        id="left-align-modal"
        alignment="left"
        heading="Left Aligned Modal"
        description="All text is aligned to the left"
    >
        <p>This content is left-aligned (default behavior).</p>
        <p>Great for regular content and reading flow.</p>
    </x-ui.modal>
    <!--  -->
    <x-ui.modal
        id="center-align-modal"
        alignment="center"
        heading="Center Aligned Modal"
        description="All text is centered"
    >
        <p>This content is center-aligned.</p>
        <p>Perfect for announcements or symmetric layouts.</p>
    </x-ui.modal>
    <!--  -->
    <x-ui.modal
        id="right-align-modal"
        alignment="right"
        heading="Right Aligned Modal"
        description="All text is aligned to the right"
    >
        <p>This content is right-aligned.</p>
        <p>Useful for RTL languages or special design requirements.</p>
    </x-ui.modal>
</x-demo>
@endblade

```blade
<!-- Text alignment options -->
<x-ui.modal alignment="left" />    <!-- text-left (default) -->
<x-ui.modal alignment="center" />  <!-- text-center -->
<x-ui.modal alignment="right" />   <!-- text-right -->
<x-ui.modal alignment="start" />   <!-- text-left (alias) -->
<x-ui.modal alignment="end" />     <!-- text-right (alias) -->
```

## Close Button Control

Customize or hide the close button:

@blade 
<x-demo>
    <div class="flex gap-2 justify-center">
        <x-ui.modal.trigger id="no-close-button-modal" class="my-4">
            <x-ui.button>
                No Close Button
            </x-ui.button>
        </x-ui.modal.trigger>
        <x-ui.modal.trigger id="custom-close-modal" class="my-4">
            <x-ui.button>
                Custom Close Action
            </x-ui.button>
        </x-ui.modal.trigger>
    </div>
    
    <x-ui.modal
        id="no-close-button-modal"
        :close-button="false"
        heading="No Close Button"
        description="Click outside to close"
    >
        <p>This modal has no close button in the header.</p>
        <p>You can still close it by clicking outside or pressing escape.</p>
    </x-ui.modal>
    
    <x-ui.modal
        id="custom-close-modal"
        heading="Custom Close Action"
        description="Modal with custom footer action"
    >
        <p>This modal has a close button, but also a custom action in the footer.</p>
        
        <x-slot name="footer">
            <x-ui.button x-on:click="$data.close();" variant="primary" class="w-full">
                Got it, close modal
            </x-ui.button>
        </x-slot>
    </x-ui.modal>
</x-demo>
@endblade

```blade
<!-- Hide the close button -->
<x-ui.modal
    {+close-button="false"+}
    heading="No Close Button"
>
    <p>Modal without close button</p>
</x-ui.modal>

<!-- With custom close action -->
<x-ui.modal heading="Custom Close">
    <p>Modal content</p>
    
    <x-slot name="footer">
        <x-ui.button x-on:click="$data.close();">
            Custom Close Button
        </x-ui.button>
    </x-slot>
</x-ui.modal>
```

## Event Handling

### Custom Event Names

Customize the event names used to open and close modals:

```blade
<x-ui.modal
    id="custom-events-modal"
    {+open-event-name="show-modal"+}
    {+close-event-name="hide-modal"+}
    heading="Custom Events"
>
    <p>This modal uses custom event names</p>
</x-ui.modal>

<!-- Trigger with custom events -->
<x-ui.button x-on:click="$dispatch('show-modal', { id: 'custom-events-modal' })">
    Open with Custom Event
</x-ui.button>
```

### Modal Event Listeners

Listen to modal open/close events:

```blade
<div x-data="{}" 
     @modal-opened.window="console.log('Modal opened:', $event.detail.id)"
     @modal-closed.window="console.log('Modal closed:', $event.detail.id)">
    
    <x-ui.modal id="event-demo" heading="Event Demo">
        <p>Check your browser console for events</p>
    </x-ui.modal>
</div>
```

## Accessibility Features

The modal component includes comprehensive accessibility support:

- **ARIA Labels**: Properly labeled for screen readers
- **Focus Management**: Automatic focus handling and restoration
- **Keyboard Navigation**: Full keyboard support including escape key
- **Screen Reader Support**: Proper modal role and aria attributes

```blade
<x-ui.modal
    id="accessible-modal"
    {+aria-labelledby="custom-label"+}
    {+aria-description="Detailed description for screen readers"+}
    heading="Accessible Modal"
>
    <p>This modal has enhanced accessibility features</p>
</x-ui.modal>
```

## Advanced Configuration

### Disable Specific Close Methods

Fine-tune how users can close your modals:

```blade
<x-ui.modal
    id="restricted-close-modal"
    {+close-by-clicking-away="false"+}
    {+close-by-escaping="false"+}
    heading="Restricted Close"
>
    <p>This modal can only be closed using the close button</p>
</x-ui.modal>
```

### Autofocus Control

Control focus behavior when the modal opens:

```blade
<x-ui.modal
    id="no-autofocus-modal"
    {+autofocus="false"+}
    heading="No Autofocus"
>
    <p>This modal won't automatically focus on the first input</p>
    <input type="text" placeholder="This won't be focused automatically" />
</x-ui.modal>
```

### Visibility Control

Control initial visibility:

```blade
<x-ui.modal
    id="initially-hidden-modal"
    {+visible="false"+}
    heading="Initially Hidden"
>
    <p>This modal is initially hidden from the DOM</p>
</x-ui.modal>
```

## Deeper Look at `$modal` Store

The `$modal` magic utility in Alpine.js is a **global reactive store** that manages modals across your entire app. Think of it as a central controller that knows which modals are open and which are closed — and it makes opening and closing modals smooth and consistent everywhere.

```js
modal = Alpine.reactive({
    openModals: new Set(),

    open(id) {
        if (this.openModals.has(id)) return;
        
        this.openModals.add(id);
        window.dispatchEvent(new CustomEvent('open-modal', { detail: { id } }));
    },

    close(id) {
        if(!this.openModals.has(id)) return;

        this.openModals.delete(id);
        window.dispatchEvent(new CustomEvent('close-modal', { detail: { id } }));
    },

    closeAll() {
        this.openModals.forEach(id => {
            this.close(id);
        });
    },
    
    getOpenedModals(){
        return Array.from(Alpine.raw(this.openModals));
    },
    
    isOpen(id) {
        return this.openModals.has(id);
    }
})
```
### Dealing with stacking context
this modal teleport itself to the body end at load time, this ensure this modal can't get stucked behind container that had `isolate` property or higher z-index

### How it Works

* **`openModals`**  
  This is a `Set` holding the IDs of all currently open modals. Using a `Set` ensures no duplicate IDs, so a modal can't be opened twice by accident.

* **`open(id)`**  
  Opens a modal with the given `id`.
  * First, it checks if this modal is already open. If yes, it does nothing (prevents duplicates).
  * If not open yet, it adds the `id` to `openModals`.
  * Then, it dispatches a global browser event `open-modal` with the modal `id` in the event's details. This event lets other parts of your app know to show that modal.

* **`close(id)`**  
  Closes the modal with the specified `id`.
  * Checks if the modal is currently open; if not, does nothing.
  * Removes the modal `id` from the `openModals` set.
  * Dispatches a `close-modal` event with the modal `id` so your app can respond by hiding the modal.

* **`closeAll()`**  
  Closes every open modal by iterating over `openModals` and calling `close(id)` on each.

* **`getOpenedModals()`**  
  Returns an array of all currently open modal IDs.  
  Uses `Alpine.raw()` to get the raw underlying data of the reactive `Set`, then converts it to a normal array for easy use.

* **`isOpen(id)`**  
  Returns `true` if the modal with this `id` is open; otherwise `false`.

### Quick Example Usage

```js
$modal.open('login');   // Opens the login modal
$modal.close('login');  // Closes the login modal
console.log($modal.isOpen('login'));  // false after close
$modal.closeAll();      // Close every open modal instantly
console.log($modal.getOpenedModals()); // []
```

## Component Props

| Prop Name | Type | Default | Description |
|-----------|------|---------|-------------|
| `id` | string | `null` | Unique identifier for the modal (auto-generated if not provided) |
| `heading` | string | `null` | Modal title text |
| `description` | string | `null` | Modal description text |
| `width` | string | `'sm'` | Modal width: `xs`, `sm`, `md`, `lg`, `xl`, `2xl`, `3xl`, `4xl`, `5xl`, `6xl`, `7xl`, `full`, `screen-sm`, `screen-md`, `screen-lg`, `screen-xl`, `screen-2xl`, `screen` |
| `position` | string | `'top'` | Modal position: `top`, `center`, `bottom` |
| `backdrop` | string | `'blur'` | Backdrop style: `blur`, `dark`, `transparent` |
| `animation` | string | `'scale'` | Animation type: `scale`, `slide`, `fade` |
| `slideover` | boolean | `false` | Transform modal into a slideover panel |
| `persistent` | boolean | `false` | Prevent closing by clicking away or escape key |
| `alignment` | string | `'start'` | Text alignment: `start`, `center`, `end`, `left`, `right` |
| `close-button` | boolean | `true` | Show/hide the close button in header |
| `close-by-clicking-away` | boolean | `true` | Allow closing by clicking backdrop |
| `close-by-escaping` | boolean | `true` | Allow closing with escape key |
| `autofocus` | boolean | `true` | Auto-focus first focusable element |
| `sticky-header` | boolean | `false` | Make header sticky when scrolling |
| `sticky-footer` | boolean | `false` | Make footer sticky when scrolling |
| `visible` | boolean | `true` | Initial visibility state |
| `display-classes` | string | `'inline-block'` | CSS classes for display behavior |
| `open-event-name` | string | `'open-modal'` | Custom event name for opening |
| `close-event-name` | string | `'close-modal'` | Custom event name for closing |
| `aria-labelledby` | string | `null` | ARIA labelledby attribute |
| `trigger` | slot | `null` | Inline trigger element |
| `header` | slot | `null` | Custom header content |
| `footer` | slot | `null` | Custom footer content |

## Trigger Component

The `<x-ui.modal.trigger>` component provides a convenient way to create modal triggers:

```blade
<x-ui.modal.trigger 
    id="my-modal" 
    class="inline-block"
>
    <x-ui.button>Open Modal</x-ui.button>
</x-ui.modal.trigger>
```

### Trigger Props

| Prop Name | Type | Default | Description |
|-----------|------|---------|-------------|
| `id` | string | required | ID of the modal to trigger |
| `class` | string | `''` | Additional CSS classes |

## Best Practices

### 1. Always Use Unique IDs
```blade
<!-- Good -->
@foreach($items as $item)
    <x-ui.modal :id="'edit-item-' . $item->id">
        <!-- Modal content -->
    </x-ui.modal>
@endforeach

<!-- Bad -->
@foreach($items as $item)
    <x-ui.modal id="edit-item">
        <!-- This will cause conflicts -->
    </x-ui.modal>
@endforeach
```

### 2. Use Appropriate Sizes
```blade
<!-- For simple confirmations -->
<x-ui.modal width="sm" />

<!-- For forms -->
<x-ui.modal width="lg" />

<!-- For complex content -->
<x-ui.modal width="2xl" />

<!-- For mobile-first full-screen experience -->
<x-ui.modal width="screen" />
```

### 3. Handle Long Content
```blade
<!-- For scrollable content -->
<x-ui.modal 
    width="lg"
    sticky-header
    sticky-footer
>
    <!-- Long content here -->
</x-ui.modal>
```

### 4. Accessibility Considerations
```blade
<!-- Always provide meaningful headings -->
<x-ui.modal 
    heading="Delete Account"
    description="This action cannot be undone"
>
    <!-- Content -->
</x-ui.modal>

<!-- Use persistent for critical actions -->
<x-ui.modal persistent>
    <!-- Important content that requires user action -->
</x-ui.modal>
```

### 5. Event Handling Patterns
```blade
<!-- Livewire pattern -->
<x-ui.button wire:click="$dispatch('open-modal', { id: 'confirm-delete' })">
    Delete
</x-ui.button>

<!-- Alpine.js pattern -->
<x-ui.button x-on:click="$modal.open('confirm-delete')">
    Delete
</x-ui.button>

<!-- Custom event pattern -->
<x-ui.button x-on:click="$dispatch('show-confirmation')">
    Delete
</x-ui.button>
```

This modal component provides the perfect balance of simplicity and power, making it easy to create beautiful, accessible modals while giving you complete control over behavior and appearance.