{{-- "Latest Video" block, design v1 — a single item, not a repeater. --}}
{{-- Expects: $siteSettings (App\Models\SiteSetting, shared globally via the AppServiceProvider view composer). --}}
@php
    $titleHtml = e($siteSettings->video_title);
    if (! empty($siteSettings->video_highlight)) {
        $titleHtml = str_ireplace(e($siteSettings->video_highlight), '<span>' . e($siteSettings->video_highlight) . '</span>', $titleHtml);
    }
@endphp
@if ($siteSettings->video_title)
    <div class="wexnix_video-area">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 wow fadeInLeft" data-wow-delay=".25s">
                    <div class="wexnix_site-heading mb-3">
                        @if ($siteSettings->video_tagline)
                            <span class="wexnix_site-title-tagline"><i class="fas fa-book-open-reader"></i> {{ $siteSettings->video_tagline }}</span>
                        @endif
                        <h2 class="wexnix_site-title">
                            {!! $titleHtml !!}
                        </h2>
                    </div>
                    @if ($siteSettings->video_description)
                        <p class="wexnix_about-text">
                            {{ $siteSettings->video_description }}
                        </p>
                    @endif
                    @if ($siteSettings->video_button_text)
                        <a href="{{ $siteSettings->video_button_url ?: '#' }}" class="wexnix_theme-btn mt-30">{{ $siteSettings->video_button_text }}<i class="fas fa-arrow-right-long"></i></a>
                    @endif
                </div>
                <div class="col-lg-8 wow fadeInRight" data-wow-delay=".25s">
                    <div class="wexnix_video-content" style="background-image: url({{ $siteSettings->video_thumbnail_url ?? '/frontend/assets/img/video/01.jpg' }});">
                        <div class="row align-items-center">
                            <div class="col-lg-12">
                                <div class="wexnix_video-wrapper">
                                    <a class="wexnix_play-btn wexnix_popup-youtube" href="{{ $siteSettings->video_youtube_url ?: '#' }}">
                                        <i class="fas fa-play"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
