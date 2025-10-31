@props([
    'id' => null,
    'name' => $attributes->whereStartsWith('wire:model')->first() ?? $attributes->whereStartsWith('x-model')->first(),
    'minValue' => 0,
    'maxValue' => 100,
    'step' => null,
    'decimalPlaces' => null,
    'vertical' => false,
    'topToBottom' => false,
    'rtl' => null,
    'fillTrack' => null,
    'tooltips' => false,
    // pips managements
    'pips' => false, 
    'pipsMode' => null,
    'pipsDensity' => null,
    'pipsFilter' => null,
    'pipsValues' => null,
    'pipsFormatter' => null,
    'arePipsStepped' => false,
    
    'behavior' => 'tap',
    'margin' => null,
    'limit' => null,
    'rangePadding' => null,
    'nonLinearPoints' => null,
    'handleVariant' => 'default',
])

@php
    // enable pips by pips props as well don't always override the pips mode
    if($pips && is_null($pipsMode)) $pipsMode = 'range';
    $componentId = $id ?? 'slider-' . uniqid();
    $hasPips = filled($pipsMode);
    $hasTooltips = $tooltips !== false;
@endphp

<div
    @class([
        'slider-wrapper',
        'ps-10' => $vertical && $hasTooltips,
        'pb-8' => !$vertical && $hasPips,
        $attributes->get('class'),  // delegate the styles to this wrapper, while pass all other $attrs to the slider object
    ])
>
    <div
        x-data="sliderComponent({
            arePipsStepped: @js($arePipsStepped),
            behavior: @js($behavior),
            decimalPlaces: @js($decimalPlaces),
            fillTrack: @js($fillTrack),
            isRtl: @js(($rtl ?? $vertical) && !$topToBottom),
            isVertical: @js($vertical),
            limit: @js($limit),
            margin: @js($margin),
            maxValue: @js($maxValue),
            minValue: @js($minValue),
            nonLinearPoints: @js($nonLinearPoints),
            
            // pips
            pipsDensity: @js($pipsDensity),
            pipsFormatter: @js($pipsFormatter),
            pipsValues: @js($pipsValues),
            pipsFilter: @js($pipsFilter),
            pipsMode: @js($pipsMode),
            padding: @js($rangePadding),
            step: @js($step),
            tooltips: @js($tooltips),
        })"
        data-slot="slider"
        data-variant="{{ $handleVariant }}"
        data-vertical="{{ $vertical ? 'true' : 'false' }}"
        @class([
            'relative  my-5',
            'h-40' => $vertical,
            'w-full' => !$vertical,
            '!mb-8' => !$vertical && $hasPips,
            '!mt-14' => !$vertical && $hasTooltips,
        ])
        {{ $attributes->except('class') }}
        wire:ignore
    ></div>
</div>
