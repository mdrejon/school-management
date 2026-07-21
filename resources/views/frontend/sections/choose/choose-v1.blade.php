{{-- "Why Choose Us" block, design v1 — single item + a repeater of feature boxes. --}}
{{-- Expects: $siteSettings (App\Models\SiteSetting, shared globally via the AppServiceProvider view composer). --}}
@php
    $titleHtml = e($siteSettings->choose_title);
    if (! empty($siteSettings->choose_highlight)) {
        $titleHtml = str_ireplace(e($siteSettings->choose_highlight), '<span>' . e($siteSettings->choose_highlight) . '</span>', $titleHtml);
    }
    $features = $siteSettings->chooseFeatureItems();
@endphp
@if ($siteSettings->choose_title)
    <div class="wexnix_choose-area pt-80 pb-80">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="wexnix_choose-content wow fadeInUp" data-wow-delay=".25s">
                        <div class="wexnix_choose-content-info">
                            <div class="wexnix_site-heading mb-0">
                                @if ($siteSettings->choose_tagline)
                                    <span class="wexnix_site-title-tagline"><i class="fas fa-book-open-reader"></i> {{ $siteSettings->choose_tagline }}</span>
                                @endif
                                <h2 class="wexnix_site-title text-white mb-10">{!! $titleHtml !!}</h2>
                                @if ($siteSettings->choose_description)
                                    <p class="text-white">{{ $siteSettings->choose_description }}</p>
                                @endif
                            </div>
                            @if (count($features))
                                <div class="wexnix_choose-content-wrap">
                                    <div class="row g-4">
                                        @foreach ($features as $feature)
                                            <div class="col-md-6">
                                                <div class="wexnix_choose-item">
                                                    <div class="wexnix_choose-item-icon">
                                                        <x-dynamic-icon :icon="$feature['icon']" />
                                                    </div>
                                                    <div class="wexnix_choose-item-info">
                                                        <h4>{{ $feature['title'] }}</h4>
                                                        <p>{{ $feature['description'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="wexnix_choose-img wow fadeInRight" data-wow-delay=".25s">
                        <img src="{{ $siteSettings->choose_image_url ?? '/frontend/assets/img/choose/01.jpg' }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
