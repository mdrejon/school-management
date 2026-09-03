{{-- Homepage "Gallery" teaser, design v1 — reuses the same item partial as the gallery page. --}}
{{-- Expects: $images (Collection<App\Models\GalleryImage>), $pageSettings (App\Models\GalleryPageSetting). --}}
@php
    $titleHtml = e($pageSettings->section_title);
    if (! empty($pageSettings->section_highlight)) {
        $titleHtml = str_ireplace(e($pageSettings->section_highlight), '<span>' . e($pageSettings->section_highlight) . '</span>', $titleHtml);
    }
@endphp
@if ($pageSettings->section_title && $images->count())
    <div class="wexnix_gallery-area py-120">
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
            <div class="row wexnix_popup-gallery">
                @foreach ($images->chunk(2) as $column)
                    <div class="col-md-4 wow fadeInUp" data-wow-delay=".25s">
                        @foreach ($column as $image)
                            @include('frontend.gallery.partials.item', ['image' => $image])
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
