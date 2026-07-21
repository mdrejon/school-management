{{-- Partner logo strip, design v1 — the original WexNix owl-carousel band. --}}
{{-- Expects: $siteSettings (App\Models\SiteSetting, shared globally via the AppServiceProvider view composer). --}}
@php $items = $siteSettings->partnerLogoItems(); @endphp
@if (count($items))
    <div class="wexnix_partner-area wexnix_bg pt-50 pb-50">
        <div class="container">
            <div class="wexnix_partner-wrapper wexnix_partner-slider owl-carousel wexnix_owl-theme">
                @foreach ($items as $item)
                    <img src="{{ $item['image_url'] }}" alt="thumb">
                @endforeach
            </div>
        </div>
    </div>
@endif
