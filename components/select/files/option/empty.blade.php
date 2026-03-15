<li {{ $attributes->class('col-span-full [:where(&)]:px-4 [:where(&)]:py-2 [ul:is([data-loading])_&]:hidden') }}>
    {{ $slot }}
</li>
