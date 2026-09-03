{{-- Slider section, design v1 — the original WexNix hero carousel. --}}
{{-- Expects: $sliders (Collection of App\Models\Slider, active + ordered). --}}
<div class="wexnix_hero-section">
    <div class="wexnix_hero-slider owl-carousel wexnix_owl-theme">
        @forelse ($sliders as $slider)
            @php
                $titleHtml = e($slider->title);
                if (! empty($slider->highlight)) {
                    $titleHtml = str_ireplace(e($slider->{{ __('highlight), \'') }}<span>' . e($slider->{{ __('highlight) . \'') }}</span>', $titleHtml);
                }
            @endphp
            <div class="wexnix_hero-single" style="background: url({{ $slider->image_url }})">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-12 col-lg-7">
                            <div class="wexnix_hero-content">
                                @if ($slider->{{ __('sub_title)') }}
                                    <h6 class="wexnix_hero-sub-title" data-animation="fadeInDown" data-delay=".25s">
                                        <i class="fas fa-book-open-reader"></i>{{ $slider->{{ __('sub_title }}') }}
                                    </h6>
                                @endif
                                <h1 class="wexnix_hero-title" data-animation="fadeInRight" data-delay=".50s">
                                    {!! $titleHtml !!}
                                </h1>
                                @if ($slider->{{ __('description)') }}
                                    <p data-animation="fadeInLeft" data-delay=".75s">
                                        {{ $slider->{{ __('description }}') }}
                                    </p>
                                @endif
                                @if ($slider->button_text || $slider->{{ __('button2_text)') }}
                                    <div class="wexnix_hero-btn" data-animation="fadeInUp" data-delay="1s">
                                        @if ($slider->{{ __('button_text)') }}
                                            <a href="{{ $slider->button_url ?? '#' }}" class="wexnix_theme-btn">{{ $slider->{{ __('button_text }}') }}<i
                                                    class="fas fa-arrow-right-long"></i></a>
                                        @endif
                                        @if ($slider->{{ __('button2_text)') }}
                                            <a href="{{ $slider->button2_url ?? '#' }}" class="wexnix_theme-btn wexnix_theme-btn2">{{ $slider->{{ __('button2_text }}') }}<i
                                                    class="fas fa-arrow-right-long"></i></a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="wexnix_hero-single" style="background: url(/frontend/assets/img/slider/slider-1.jpg)">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-12 col-lg-7">
                            <div class="wexnix_hero-content">
                                <h1 class="wexnix_hero-title">{{ config('app.name') }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
