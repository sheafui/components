@aware(['type' => 'text'])

@php
$classes = [
    'z-0 relative', // reset stacking context
    'focus:z-10', // prevent this input to get clipped from next input
    '[:where(&:first-child)]:rounded-l-box overflow-visible [:where(&:last-child)]:rounded-r-box', // default rounding with zero specificity, allows external classes to override without !
    'text-center text-base max-w-12 w-full h-12',
    'bg-white dark:bg-neutral-900', // background
    'text-neutral-900 dark:text-neutral-100 placeholder:text-neutral-400 dark:placeholder:text-neutral-500',
    'border border-black/10 dark:border-white/10', // base border
    'focus:outline-none focus:ring-3 focus:ring-[color-mix(in_oklab,_var(--color-primary)_15%,_var(--color-primary-fg)_60%)]',
    'transition duration-300 ease-in-out',
    'shadow-sm',
    'disabled:pointer-events-none',
    // overlay for disabled inputs to catch clicks, it a hack but needed for better UX
    'disabled:after:content-[""] disabled:after:absolute disabled:after:inset-0 disabled:after:cursor-text disabled:after:pointer-events-auto',
];
@endphp

<input
    {{ $attributes
        ->merge([
            'type' => $type,
        ])
        ->class($classes) 
    }}
    
    required
    maxlength="1"
    data-slot="otp-input"
    x-on:input="handleInput($el)"
    x-on:keydown.enter="handleInput($el)"
    x-on:paste="handlePaste($event)"
    {{-- traits delete key as backspace --}}
    x-on:keydown.delete.prevent="await handleBackspace($event)"
    {{-- handle backspace key --}}
    x-on:keydown.backspace.prevent="await handleBackspace($event)"
    
    {{-- accessibilty addons --}}
    {{-- index.blade.php gives the first box `one-time-code`; the rest stay off, so
         a password manager has one field to aim at rather than six. --}}
    autocomplete="off"
    x-on:keydown.right="$focus.within($refs.inputsWrapper).next()"
    x-on:keydown.up="$focus.within($refs.inputsWrapper).next()"
    x-on:keydown.left="$focus.within($refs.inputsWrapper).prev()"
    x-on:keydown.down="$focus.within($refs.inputsWrapper).prev()"
    
    {{-- on focus select for easy replacement 
     NOTE: In Firefox, calling $el.select() immediately after focus does nothing 
     if the input was just focused programmatically. Wrapping it in requestAnimationFrame 
     defers the selection to the next frame, after the browser has fullly applied focus 
     This is the only way I got consistent behavior across Chrome, Safari (maybe haha), and Firefox 
     after lot of debugging. --}}
    x-on:focus="requestAnimationFrame(() => $el.select())"
/>
