{{-- Shared portfolio card — used by the portfolio list page. --}}
{{-- Expects: $portfolio (App\Models\Portfolio). --}}
<div class="col-md-4">
    <div class="wexnix_portfolio-item">
        <div class="wexnix_portfolio-img">
            <img src="{{ $portfolio->image_url ?? '/frontend/assets/img/portfolio/01.jpg' }}" alt="">
        </div>
        <div class="wexnix_portfolio-content">
            <div class="wexnix_portfolio-info">
                <div class="wexnix_portfolio-title-info">
                    @if ($portfolio->{{ __('category)') }}
                        <h5 class="wexnix_portfolio-subtitle"><span>//</span> {{ $portfolio->{{ __('category }}') }}</h5>
                    @endif
                    <a href="{{ route('portfolios.show', $portfolio) }}">
                        <h4 class="wexnix_portfolio-title">{{ $portfolio->{{ __('title }}') }}</h4>
                    </a>
                </div>
                <a href="{{ route('portfolios.show', $portfolio) }}" class="wexnix_portfolio-btn"><i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>
