@aware([
    'radio'=> false,
    'checkbox' => false,
    'disabled' => false,
    'name' => null,
    'checkboxVariant' => false,
    'icon' => null,
    'shortcut' => null
])

<!-- prevent those props from been part of the attributes bag... -->
@props([
    'classes' => '',
    'value' => '',
    'iconClasses' => ''
])

@php
    $role = $checkbox ? 'menuitemcheckbox' : 'menuitemradio';
   
@endphp


<label
    {{ $attributes
        ->whereDoesntStartWith(['wire:model', 'x-model'])
        ->class(Arr::toCssClasses($classes))
    }}
    role="{{ $role }}"
    aria-disabled="{{ $disabled ? 'true' : 'false' }}"
    data-slot="dropdown-item"
    x-data="{ checked: false }"
    x-init="queueMicrotask(() => checked = $refs.input.checked)"
    x-bind:aria-checked="checked"
    x-on:keydown.enter.prevent.stop="$refs.input.click()"
    x-on:keydown.space.prevent.stop="$refs.input.click()"
>
    <input
        type="{{ $checkbox ? 'checkbox' : 'radio' }}"
        {{ $attributes->whereStartsWith(['wire:model', 'x-model']) }}
        value="{{ $value }}"
        x-ref="input"
        x-on:click="checked = !checked"
        @if ($name) name="{{ $name }}" @endif
        @disabled($disabled)
        class="peer sr-only"
    />

    @if ($checkboxVariant)
        <div class="relative inline-grid place-items-center size-5 mr-2">
            {{-- Checkbox background --}}
            <span
                class="
                    size-4.5 rounded ring-1 
                    ring-neutral-100 dark:ring-white/10
                    transition shadow
                "
                x-bind:class="{
                    'ring-2 bg-[var(--color-primary)]': checked,
                    'ring-1': !checked
                }"
            ></span>
            <x-ui.icon 
                name="check" 
                class="
                    absolute size-4 text-(--color-primary-fg)!
                    transition-all duration-200
                "
                x-bind:class="{
                    'opacity-100 scale-100': checked,
                    'opacity-0 scale-75': !checked
                }" 
            />
        </div>
    @else
        <x-ui.icon
            name="check"
            variant="mini"
            class="{{ Arr::toCssClasses([
                ...$iconClasses,
                'opacity-0 peer-checked:opacity-100 transition-opacity duration-150',
            ]) }}"
            aria-hidden="true"
        />
    @endif
    @if (filled($icon))
        <x-ui.icon
            :name="$icon"
            :variant="$iconVariant"
            :attributes="$iconAttributes"
            data-slot="right-icon"
        />
    @endif

    @if($slot->isNotEmpty())
        <span class="col-start-3 whitespace-nowrap flex items-center justify-between gap-4">
            <span>{{ $slot }}</span>

            @if(filled($shortcut))
                <x-ui.kbd>
                    {{ $shortcut }}
                </x-ui.kbd>
            @endif
        </span>
    @endif
</label>