{{-- Shared facility card — used by the facilities list page. --}}
{{-- Expects: $facility (App\Models\Facility). --}}
<div class="col-md-6 col-lg-4">
    <div class="wexnix_facility-item wow fadeInUp" data-wow-delay=".25s">
        <div class="wexnix_facility-img">
            <img src="{{ $facility->image_url ?? '/frontend/assets/img/facility/01.jpg' }}" alt="">
        </div>
        <div class="wexnix_facility-content">
            <h3 class="wexnix_facility-title">
                <a href="{{ route('facilities.show', $facility) }}">{{ $facility->title }}</a>
            </h3>
            @if ($facility->short_description)
                <p class="wexnix_facility-text">{{ $facility->short_description }}</p>
            @endif
            <div class="wexnix_facility-arrow">
                <a href="{{ route('facilities.show', $facility) }}" class="wexnix_theme-btn">{{ __('Read More') }}<i class="fas fa-arrow-right-long"></i></a>
            </div>
        </div>
    </div>
</div>
