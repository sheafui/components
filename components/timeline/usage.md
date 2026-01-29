---
name: 'timeline'
---

## Introduction

The **Timeline** component provides a clean and flexible way to display chronological events, project milestones, changelogs, and activity feeds. 

## Installation

Use the Sheaf artisan command to install the timeline component:

```bash
php artisan sheaf:install timeline
```

> Once installed, you can use `<x-ui.timeline />` and `<x-ui.timeline.item />` in any Blade view.

## Basic Usage

Timeline items accept any content, making them perfect for detailed changelogs and project updates:

@blade
<x-demo class="max-h-72">
    <x-ui.timeline>
        <x-ui.timeline.item 
            heading="Project Kickoff" 
            subheading="v1.0.0"
        >
            <x-ui.heading level="4" class="mb-4">
                Launch of Version 1.0
            </x-ui.heading>
            <!--  -->
            <x-ui.text class="mb-6 opacity-70">
                We shipped the first stable release of our platform, introducing core functionalities such as user authentication, dashboard, and real-time notifications.
            </x-ui.text>
            <!--  -->
            <ul class="font-mono mb-6 space-y-2 text-white/80">
                <li><x-ui.text>Robust user registration and login flow </x-ui.text></li>
                <li><x-ui.text>Interactive dashboard  </x-ui.text></li>
                <li><x-ui.text>Real-time notifications  </x-ui.text></li>
            </ul>
        </x-ui.timeline.item>
        <!--  -->
        <x-ui.timeline.item 
            heading="Performance Update" 
            subheading="v1.1.0"
            icon="bolt"
            status="info"
        >
            <x-ui.heading level="4" class="mb-4">
                Optimizing User Experience
            </x-ui.heading>
            <!--  -->
            <x-ui.text class="mb-6">
                Focused on refining the user interface and speeding up page load times.
            </x-ui.text>
            <!--  -->
            <ul class="font-mono mb-6 space-y-2 text-white/80">
                <li><x-ui.text>Reduced dashboard load times by 40 </x-ui.text></li>
                <li><x-ui.text>Introduced lazy loading  </x-ui.text></li>
                <li><x-ui.text>Improved accessibility compliance </x-ui.text></li>
            </ul>
        </x-ui.timeline.item>
        <!--  -->
        <x-ui.timeline.item 
            heading="Security Patch" 
            subheading="v1.1.1"
        >
            <x-ui.heading level="4" class="mb-4">
                Critical Security Updates
            </x-ui.heading>
            <!--  -->
            <x-ui.text class="mb-6">
                Addressed several security vulnerabilities and enhanced data protection.
            </x-ui.text>
            <!--  -->
            <ul class="font-mono space-y-2 text-white/80">
                <li> <x-ui.text>Fixed XSS vulnerabilities </x-ui.text></li>
                <li> <x-ui.text>Enhanced CSRF protection </x-ui.text></li>
                <li> <x-ui.text>Updated dependencies </x-ui.text></li>
            </ul>
        </x-ui.timeline.item>
    </x-ui.timeline>
</x-demo>
@endblade

```blade
<x-ui.timeline>
    <x-ui.timeline.item heading="Version 2.0" subheading="Released Mar 15, 2024">
        <x-ui.heading level="5" class="mb-4">Major Feature Update</x-ui.heading>
        
        <x-ui.text class="mb-4">
            This release includes significant improvements across the platform.
        </x-ui.text>
        
        <x-ui.text class="mb-2 font-medium">New Features:</x-ui.text>
        <ul class="mb-4 space-y-1">
            <li>Advanced analytics dashboard</li>
            <li>Real-time collaboration tools</li>
            <li>Mobile app for iOS and Android</li>
        </ul>
    </x-ui.timeline.item>
</x-ui.timeline>
```

## Custom Pin Slot

Replace the default heading/subheading layout with custom content using the `pin` slot:

@blade
<x-demo>
    <x-ui.timeline>
        <x-ui.timeline.item>
            <x-slot:pin>
                <div class="bg-gradient-to-br from-purple-500 to-pink-500 p-3 rounded-lg">
                    <div class="text-xs font-bold text-white mb-1">FEATURED</div>
                    <div class="text-sm text-white/90">Jan 15, 2024</div>
                </div>
            </x-slot>
            <!--  -->
            <x-ui.heading level="5" class="mb-2">
                Major Product Launch
            </x-ui.heading>
            <x-ui.text>
                Introducing our flagship feature that revolutionizes team collaboration.
            </x-ui.text>
        </x-ui.timeline.item>
        <!--  -->
        <x-ui.timeline.item>
            <x-slot:pin>
                <div class="bg-blue-500/20 border border-blue-500/30 p-3 rounded-lg">
                    <div class="text-xs font-semibold text-blue-400 mb-1">UPCOMING</div>
                    <div class="text-sm text-blue-300">Feb 1, 2024</div>
                </div>
            </x-slot>
            <!--  -->
            <x-ui.heading level="5" class="mb-2">
                Webinar Series
            </x-ui.heading>
            <x-ui.text>
                Join us for educational webinars covering best practices and advanced features.
            </x-ui.text>
        </x-ui.timeline.item>
    </x-ui.timeline>
</x-demo>
@endblade

```blade
<x-ui.timeline>
    <x-ui.timeline.item>
        <x-slot:pin>
            <div class="bg-gradient-to-br from-purple-500 to-pink-500 p-3 rounded-lg">
                <div class="text-xs font-bold text-white">FEATURED</div>
                <div class="text-sm text-white/90">Jan 15, 2024</div>
            </div>
        </x-slot>
        
        <x-ui.heading level="5">Major Product Launch</x-ui.heading>
        <x-ui.text>Custom pin slot example...</x-ui.text>
    </x-ui.timeline.item>
</x-ui.timeline>
```

## Component Props

### ui.timeline

nothing

### ui.timeline.item

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `heading` | string | `''` | Main heading text displayed in the pin area |
| `subheading` | string | `''` | Secondary text displayed below the heading |
| `pin` | slot | - | Custom content for the pin area (replaces heading/subheading) |

