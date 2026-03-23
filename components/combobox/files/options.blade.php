@aware([
     'checkIcon'      => 'check',
    'checkIconClass' => null,
    'empty'          => 'No results found',
    'loading'        => null,
    'label'          => null,
    'preventLoading' => false,
])


<div
    class="absolute z-50 bg-white [:where(&)]:w-full dark:bg-neutral-800 mt-1 backdrop-blur-xl border dark:border-neutral-700 border-neutral-200 rounded-(--popup-round) shadow-lg py-(--popup-padding)"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 transform scale-95"
    x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-150 pointer-events-none"
    x-transition:leave-start="opacity-100 scale-100"
    x-on:click.away="handleClickAway($event.target)"
    x-transition:leave-end="opacity-0 scale-95"
    x-show="__isOpen"
    x-cloak
>
    <ul
        class="grid grid-cols-[auto_auto_1fr] gap-y-1 relative overflow-y-auto data-loading:h-24 px-(--popup-padding) max-h-60"
        x-bind:aria-multiselectable="__isMultiple ? 'true' : 'false'"
        {{ $attributes->whereStartsWith('wire:target') }}
        x-bind:aria-label="@js($label ?? 'Options')"
        @if (!$preventLoading)
            wire:loading.attr="data-loading"
        @endif
        x-rover:options
    >
        {{ $slot }}

        {{-- Empty state --}}
        <li
            class="col-span-full [ul:is([data-loading])_&]:hidden"
            x-rover:empty
        >
            @if ($empty instanceof \Illuminate\View\ComponentSlot)
                {{ $empty }}
            @else
                <x-ui.text class="h-14 flex items-center justify-center">
                    {{ $empty }}
                </x-ui.text>
            @endif
        </li>

        {{-- Loading state --}}
        <x-ui.combobox.loading>
            @if ($loading instanceof \Illuminate\View\ComponentSlot)
                {{ $loading }}
            @else
                <x-ui.icon.loading class="opacity-50" />
            @endif
        </x-ui.combobox.loading>
    </ul>
</div>