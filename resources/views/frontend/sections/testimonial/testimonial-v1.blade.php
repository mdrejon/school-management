{{-- Homepage "Testimonial" teaser, design v1 — reuses the same bare item partial as the testimonials page. --}}
{{-- Expects: $testimonials (Collection<App\Models\Testimonial>), $pageSettings (App\Models\TestimonialPageSetting). --}}
@php
    $titleHtml = e($pageSettings->section_title);
    if (! empty($pageSettings->section_highlight)) {
        $titleHtml = str_ireplace(e($pageSettings->section_highlight), '<span>' . e($pageSettings->section_highlight) . '</span>', $titleHtml);
    }
@endphp
@if ($pageSettings->section_title && $testimonials->count())
    <div class="wexnix_testimonial-area wexnix_ts-bg pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="wexnix_site-heading text-center">
                        @if ($pageSettings->section_tagline)
                            <span class="wexnix_site-title-tagline"><i class="fas fa-book-open-reader"></i> {{ $pageSettings->section_tagline }}</span>
                        @endif
                        <h2 class="wexnix_site-title text-white">{!! $titleHtml !!}</h2>
                        @if ($pageSettings->section_description)
                            <p class="text-white">{{ $pageSettings->section_description }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="wexnix_testimonial-slider owl-carousel wexnix_owl-theme">
                @foreach ($testimonials as $testimonial)
                    @include('frontend.testimonials.partials.item', ['testimonial' => $testimonial])
                @endforeach
            </div>
        </div>
    </div>
@endif
