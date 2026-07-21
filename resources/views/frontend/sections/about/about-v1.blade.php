{{-- "About Us" block, design v1 — single item + a repeater of feature items (same icon/title/description shape as "Why Choose Us"). --}}
{{-- Expects: $siteSettings (App\Models\SiteSetting, shared globally via the AppServiceProvider view composer). --}}
@php
    $titleHtml = e($siteSettings->about_title);
    if (! empty($siteSettings->about_highlight)) {
        $titleHtml = str_ireplace(e($siteSettings->about_highlight), '<span>' . e($siteSettings->about_highlight) . '</span>', $titleHtml);
    }
    $items = $siteSettings->aboutItems();
@endphp
@if ($siteSettings->about_title)
    <div class="wexnix_about-area py-120">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="wexnix_about-left wow fadeInLeft" data-wow-delay=".25s">
                        <div class="wexnix_about-img">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <img class="wexnix_img-1" src="{{ $siteSettings->about_image_1_url ?? '/frontend/assets/img/about/01.jpg' }}" alt="">
                                    @if ($siteSettings->about_badge_text)
                                        <div class="wexnix_about-experience mt-4">
                                            <div class="wexnix_about-experience-icon">
                                                <x-dynamic-icon :icon="$siteSettings->about_badge_icon" />
                                            </div>
                                            <b class="text-start">{{ $siteSettings->about_badge_text }}</b>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <img class="wexnix_img-2" src="{{ $siteSettings->about_image_2_url ?? '/frontend/assets/img/about/02.jpg' }}" alt="">
                                    <img class="wexnix_img-3 mt-4" src="{{ $siteSettings->about_image_3_url ?? '/frontend/assets/img/about/03.jpg' }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="wexnix_about-right wow fadeInRight" data-wow-delay=".25s">
                        <div class="wexnix_site-heading mb-3">
                            @if ($siteSettings->about_tagline)
                                <span class="wexnix_site-title-tagline"><i class="fas fa-book-open-reader"></i> {{ $siteSettings->about_tagline }}</span>
                            @endif
                            <h2 class="wexnix_site-title">
                                {!! $titleHtml !!}
                            </h2>
                        </div>
                        @if ($siteSettings->about_description)
                            <p class="wexnix_about-text">
                                {{ $siteSettings->about_description }}
                            </p>
                        @endif
                        @if (count($items) || $siteSettings->about_quote)
                            <div class="wexnix_about-content">
                                <div class="row">
                                    @if (count($items))
                                        <div class="col-md-7">
                                            @foreach ($items as $item)
                                                <div class="wexnix_about-item">
                                                    <div class="wexnix_about-item-icon">
                                                        <x-dynamic-icon :icon="$item['icon']" />
                                                    </div>
                                                    <div class="wexnix_about-item-content">
                                                        <h5>{{ $item['title'] }}</h5>
                                                        <p>{{ $item['description'] }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if ($siteSettings->about_quote)
                                        <div class="col-md-5">
                                            <div class="wexnix_about-quote">
                                                <p>{{ $siteSettings->about_quote }}</p>
                                                <i class="fas fa-quote-right"></i>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        @if ($siteSettings->about_button_text || $siteSettings->phone)
                            <div class="wexnix_about-bottom">
                                @if ($siteSettings->about_button_text)
                                    <a href="{{ $siteSettings->about_button_url ?: '#' }}" class="wexnix_theme-btn">{{ $siteSettings->about_button_text }}<i
                                            class="fas fa-arrow-right-long"></i></a>
                                @endif
                                @if ($siteSettings->phone)
                                    <div class="wexnix_about-phone">
                                        <div class="wexnix_icon"><i class="fas fa-headset"></i></div>
                                        <div class="wexnix_number">
                                            <span>Call Now</span>
                                            <h6><a href="tel:{{ $siteSettings->phone }}">{{ $siteSettings->phone }}</a></h6>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
