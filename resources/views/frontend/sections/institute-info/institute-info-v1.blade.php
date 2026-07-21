{{-- Institute info strip, design v1 — the original WexNix 4-stat band. --}}
{{-- Expects: $siteSettings (App\Models\SiteSetting, shared globally via the AppServiceProvider view composer). --}}
@php $items = $siteSettings->instituteInfoItems(); @endphp
@if (count($items))
    <div class="wexnix_institute-info-area">
        <div class="row g-0 text-center">
            @foreach ($items as $index => $item)
                <div class="col-6 col-lg-{{ max(intdiv(12, count($items)), 3) }}" style="background: var(--theme-color{{ $index % 2 === 0 ? '2' : '' }});">
                    <div class="py-4 text-white">
                        <h6 class="text-uppercase mb-1">{{ $item['label'] }}</h6>
                        <h2 class="mb-0 text-white">{{ $item['value'] !== '' ? $item['value'] : '—' }}</h2>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
