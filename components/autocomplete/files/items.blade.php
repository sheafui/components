@php
    $classes = [
        "absolute z-50 bg-white [:where(&)]:w-full dark:bg-neutral-800 mt-1 backdrop-blur-xl border dark:border-neutral-700 border-neutral-200 rounded-(--popup-round) shadow-lg py-(--popup-padding)",
    ]
@endphp
<div 
    @class($classes)
    x-transition
    x-on:click.away="handleClickAway($event.target)"
    x-anchor="$refs.autocompleteControl" 
    x-show="isShown" 
    x-cloak  
>
    <ul 
        x-rover:options
        class="flex flex-col gap-y-1 px-(--popup-padding)"  
        role="listbox"              
    >
        {{ $slot }}
    </ul>
</div>