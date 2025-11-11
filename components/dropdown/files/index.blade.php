@props([
    'position' => 'bottom-center',
    'teleport' => 'body',
    'portal' => false 
])

@php
    $classes = [
        'isolate z-50',
        'grid grid-cols-[auto_1fr_auto]',
        'z-10 [:where(&)]:max-w-96 [:where(&)]:min-w-40 text-start',
        'bg-white dark:bg-neutral-900 border border-black/10 dark:border-white/10 space-y-0.5',
        'rounded-(--dropdown-radius) p-(--dropdown-padding) [--dropdown-radius:var(--radius-box)] [--dropdown-padding:--spacing(.75)]',
    ];  
@endphp

<div {{ $attributes }}>
    <div
        x-data="{
            open: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }

                this.$refs.button.focus()
                this.open = true
            },
            isOpen(){
                return this.open
            },
            close(focusAfter) {
                if (! this.open) return

                this.open = false

                focusAfter && focusAfter.focus()
            },
            handleFocusInOut(event) {
                const panel = this.$refs.panel
                const button = this.$refs.button
                const target = event.target

                // If the panel or the button contains the focused element, do nothing
                if (panel.contains(target) || button.contains(target)) return;

                // If the focus is outside both the panel and button, check DOM order
                const lastFocusedElement = document.activeElement

                if (this.shouldCloseDropdown(button,panel,lastFocusedElement)) this.close(button);
            },
            shouldCloseDropdown(button, panel, lastFocusedElement) {
                return (!button.contains(lastFocusedElement) && !panel.contains(lastFocusedElement)) &&
                    (lastFocusedElement && (button.compareDocumentPosition(lastFocusedElement) & Node.DOCUMENT_POSITION_FOLLOWING));    
            },

        }"
        x-on:keydown.escape.prevent.stop="close($refs.button)"
        x-on:focusin.window="handleFocusInOut($event)"
        x-id="['dropdown-button']"
        class="relative"
    >
        <!-- Button -->
        <div 
            x-ref="button"
            {{ $button->attributes->class('flex items-center px-2 py-1 rounded-field') }}
            x-on:keydown.tab.prevent.stop="$focus.focus($focus.within($refs.panel).getFirst())"
            x-on:keydown.down.prevent.stop="$focus.focus($focus.within($refs.panel).getFirst())"
            x-on:keydown.space.stop.prevent="toggle()"
            x-on:keydown.enter.stop.prevent="toggle()"
            x-on:click="toggle()"
            x-bind:aria-expanded="open"
            x-bind:aria-controls="$id('dropdown-button')"
        >
            {{ $button }}
        </div>
        
        @if($portal)
            <template x-teleport="{{ $teleport }}">
        @endif
        
        <div 
            x-show="open"
            x-ref="panel"
            x-anchor.{{ $position }}.offset.6="$refs.button"
            x-on:keydown.down.prevent.stop="$focus.next()"
            x-on:keydown.up.prevent.stop="$focus.prev()"
            x-on:keydown.home.prevent.stop="$focus.first()"
            x-on:keydown.page-up.prevent.stop="$focus.first()"
            x-on:keydown.end.prevent.stop="$focus.last()"
            x-on:keydown.page-down.prevent.stop="$focus.last()"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            x-on:click.away="close($refs.button)"
            x-bind:id="$id('dropdown-button')"
            style="display: none; backdrop-filter: blur(64px); -webkit-backdrop-filter: blur(64px);z-index:9999"
            {{ $menu->attributes->class(Arr::toCssClasses($classes)) }}
        >
            {{ $menu }}
        </div>
        
        @if($portal)
            </template>
        @endif
    </div>
</div>