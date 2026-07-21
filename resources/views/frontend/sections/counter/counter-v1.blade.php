{{-- Counter/CTA stat strip, design v1 — the original WexNix 4-icon counter band. --}}
{{-- Expects: $siteSettings (App\Models\SiteSetting, shared globally via the AppServiceProvider view composer). --}}
@php $items = $siteSettings->ctaStatsItems(); @endphp
@if (count($items))
    <div class="wexnix_counter-area pt-60 pb-60">
        <div class="container">
            <div class="row">
                @foreach ($items as $item)
                    <div class="col-lg-3 col-sm-6">
                        <div class="wexnix_counter-box">
                            <div class="wexnix_icon">
                                <x-dynamic-icon :icon="$item['icon']" />
                            </div>
                            <div>
                                <span class="wexnix_counter" data-count="+" data-to="{{ $item['value'] }}" data-speed="3000">{{ $item['value'] }}</span>
                                <h6 class="wexnix_title">+ {{ $item['label'] }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
