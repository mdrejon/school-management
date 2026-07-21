{{-- Homepage "Events" teaser, design v1 — an owl-carousel, matching the original theme's homepage design --}}
{{-- (the standalone events list page uses a plain grid instead). Reuses the same bare item partial. --}}
{{-- Expects: $events (Collection<App\Models\Event>), $pageSettings (App\Models\EventPageSetting). --}}
@php
    $titleHtml = e($pageSettings->section_title);
    if (! empty($pageSettings->section_highlight)) {
        $titleHtml = str_ireplace(e($pageSettings->section_highlight), '<span>' . e($pageSettings->section_highlight) . '</span>', $titleHtml);
    }
@endphp
@if ($pageSettings->section_title && $events->count())
    <div class="wexnix_event-area wexnix_bg py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="wexnix_site-heading text-center">
                        @if ($pageSettings->section_tagline)
                            <span class="wexnix_site-title-tagline"><i class="fas fa-book-open-reader"></i> {{ $pageSettings->section_tagline }}</span>
                        @endif
                        <h2 class="wexnix_site-title">{!! $titleHtml !!}</h2>
                        @if ($pageSettings->section_description)
                            <p>{{ $pageSettings->section_description }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="wexnix_event-slider owl-carousel wexnix_owl-theme">
                @foreach ($events as $event)
                    @include('frontend.events.partials.item', ['event' => $event])
                @endforeach
            </div>
        </div>
    </div>
@endif
