@aware([
    'disabled' => false,
    'reverse' => false
])

<button x-on:disabled($disabled)
    {{ $attributes->class(Arr::toCssClasses(['flex w-full items-center gap-2 justify-start px-6 py-4 text-xl font-bold dark:text-white', 'cursor-pointer' => !$disabled, 'flex-row-reverse' => $reverse])) }}
    x-on:click="toggle()" x-bind:aria-expanded="isVisible">
    <span class="flex-1 text-start font-normal text-base">{{ $slot }}</span>
    <span style="display: none" x-show="isVisible"><x-ui.icon class="size-5" name="chevron-up" /></span>
    <span x-show="!isVisible"> <x-ui.icon class="size-5" name="chevron-down" /></span>
</button>
