@props([
    'reverse' => false,
    'faq' => false
])

@php
    $faqSchema = null;

    if ($faq) {
        $slotHtml = trim((string) $slot);

        if ($slotHtml !== '') {
            $questions = [];

            libxml_use_internal_errors(true);
            $dom = new \DOMDocument();
            $dom->loadHTML(
                '<?xml encoding="utf-8" ?><div>' . $slotHtml . '</div>',
                LIBXML_NOERROR | LIBXML_NOWARNING
            );
            libxml_clear_errors();

            foreach ((new \DOMXPath($dom))->query('//*[@role="region"]') as $region) {
                $trigger = null;
                $panel = null;

                foreach ($region->childNodes as $child) {
                    if (!$child instanceof \DOMElement) {
                        continue;
                    }

                    if ($child->tagName === 'button' && !$trigger) {
                        $trigger = $child;
                    } elseif ($child->tagName === 'div' && !$panel) {
                        $panel = $child;
                    }
                }

                if (!$trigger || !$panel) {
                    continue;
                }

                $question = trim(preg_replace('/\s+/', ' ', $trigger->textContent));

                $answerHtml = '';
                foreach ($panel->firstElementChild?->childNodes ?? [] as $node) {
                    $answerHtml .= $dom->saveHTML($node);
                }
                $answerHtml = trim($answerHtml);

                if ($question === '' || $answerHtml === '') {
                    continue;
                }

                $questions[] = [
                    '@type' => 'Question',
                    'name' => $question,
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $answerHtml,
                    ],
                ];
            }

            if (!empty($questions)) {
                $faqSchema = [
                    '@context' => 'https://schema.org',
                    '@type' => 'FAQPage',
                    'mainEntity' => $questions,
                ];
            }
        }
    }
@endphp

@if ($faqSchema)
    @push('head')
        <script type="application/ld+json">{!! str_replace('</', '<\/', json_encode($faqSchema, JSON_UNESCAPED_UNICODE)) !!}</script>
    @endpush
@endif

<div
    x-data="{ active: null }"
    {{ $attributes->merge([
        'class'=>"w-full flex flex-col"
    ]) }}
>
    {{ $slot }}
</div>