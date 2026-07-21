{{-- Promotional offer banner, design v1 — a single item, not a repeater. --}}
{{-- Expects: $siteSettings (App\Models\SiteSetting, shared globally via the AppServiceProvider view composer). --}}
@if ($siteSettings->offer_title)
    <div class="wexnix_cta-area" style="background-image: url({{ $siteSettings->offer_background_url ?? '/frontend/assets/img/cta/01.jpg' }});">
        <div class="container">
            <div class="wexnix_cta-wrapper">
                <div class="row align-items-center">
                    <div class="col-lg-5 ms-lg-auto">
                        <div class="wexnix_cta-content">
                            <h1>{{ $siteSettings->offer_title }}</h1>
                            @if ($siteSettings->offer_description)
                                <p>{{ $siteSettings->offer_description }}</p>
                            @endif
                            @if ($siteSettings->offer_button_text)
                                <div class="wexnix_cta-btn">
                                    <a href="{{ $siteSettings->offer_button_url ?: '#' }}" class="wexnix_theme-btn">{{ $siteSettings->offer_button_text }}<i
                                            class="fas fa-arrow-right-long"></i></a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
