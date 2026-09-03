@extends('frontend.layouts.app')

@section('title', $portfolio->title . ' - ' . config('app.name'))

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $pageSettings->breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $portfolio->{{ __('title }}') }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li><a href="{{ route('portfolios.index') }}">{{ $pageSettings->{{ __('breadcrumb_title ?: \'Portfolio\' }}') }}</a></li>
                    <li class="active">{{ $portfolio->{{ __('title }}') }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- portfolio-single -->
        <div class="wexnix_portfolio-single-area py-120">
            <div class="container">
                <div class="wexnix_portfolio-single-wrapper">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4">
                            <div class="wexnix_portfolio-sidebar">
                                <div class="wexnix_widget wexnix_portfolio-sidebar-content">
                                    <h4 class="wexnix_portfolio-sidebar-title">{{ __('Portfolio Details') }}</h4>
                                    <ul>
                                        @if ($portfolio->{{ __('category)') }}
                                            <li>{{ __('Category') }} <span>{{ $portfolio->{{ __('category }}') }}</span></li>
                                        @endif
                                        @if ($portfolio->{{ __('event_date)') }}
                                            <li>{{ __('Date') }} <span>{{ $portfolio->event_date->{{ __('format(\'d F, Y\') }}') }}</span></li>
                                        @endif
                                        @if ($portfolio->{{ __('client_name)') }}
                                            <li>{{ __('Client Name') }} <span>{{ $portfolio->{{ __('client_name }}') }}</span></li>
                                        @endif
                                        @if ($portfolio->{{ __('cost)') }}
                                            <li>{{ __('Total Cost') }} <span>{{ $portfolio->{{ __('cost }}') }}</span></li>
                                        @endif
                                        @if ($portfolio->{{ __('manager_name)') }}
                                            <li>{{ __('Manager') }} <span>{{ $portfolio->{{ __('manager_name }}') }}</span></li>
                                        @endif
                                        @if ($portfolio->{{ __('location)') }}
                                            <li>{{ __('Location') }} <span>{{ $portfolio->{{ __('location }}') }}</span></li>
                                        @endif
                                        @if ($portfolio->{{ __('website_url)') }}
                                            <li>{{ __('Website') }} <span>{{ $portfolio->{{ __('website_url }}') }}</span></li>
                                        @endif
                                        @if ($portfolio->{{ __('rating)') }}
                                            <li>
                                                {{ __('Rating') }}
                                                <div class="wexnix_rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star" style="{{ $i > $portfolio->rating ? 'opacity:.35' : '' }}"></i>
                                                    @endfor
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8">
                            <div class="wexnix_portfolio-details">
                                @if ($portfolio->{{ __('image_url)') }}
                                    <div class="wexnix_portfolio-details-img mb-30">
                                        <img src="{{ $portfolio->image_url }}" alt="thumb">
                                    </div>
                                @endif
                                <div class="wexnix_portfolio-details">
                                    <h3 class="mb-20">{{ $portfolio->{{ __('title }}') }}</h3>
                                    @if ($portfolio->{{ __('description)') }}
                                        <div class="mb-20">{!! $portfolio->{{ __('description !!}') }}</div>
                                    @endif

                                    @if ($portfolio->gallery_image_1_url || $portfolio->{{ __('gallery_image_2_url)') }}
                                        <div class="row">
                                            @if ($portfolio->{{ __('gallery_image_1_url)') }}
                                                <div class="col-md-6 mb-20">
                                                    <img src="{{ $portfolio->gallery_image_1_url }}" alt="">
                                                </div>
                                            @endif
                                            @if ($portfolio->{{ __('gallery_image_2_url)') }}
                                                <div class="col-md-6 mb-20">
                                                    <img src="{{ $portfolio->gallery_image_2_url }}" alt="">
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    @php $highlightItems = $portfolio->highlightItems(); @endphp
                                    @if ($portfolio->highlight_title || count($highlightItems))
                                        <div class="my-4">
                                            @if ($portfolio->{{ __('highlight_title)') }}
                                                <div class="mb-3">
                                                    <h3 class="mb-3">{{ $portfolio->{{ __('highlight_title }}') }}</h3>
                                                </div>
                                            @endif
                                            @if (count($highlightItems))
                                                <ul class="wexnix_portfolio-single-list">
                                                    @foreach ($highlightItems as $item)
                                                        <li><i class="fas fa-check"></i>{{ $item }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    @endif

                                    @if ($portfolio->overview_title || $portfolio->{{ __('overview_description)') }}
                                        <div class="my-4">
                                            @if ($portfolio->{{ __('overview_title)') }}
                                                <h3 class="mb-3">{{ $portfolio->{{ __('overview_title }}') }}</h3>
                                            @endif
                                            @if ($portfolio->{{ __('overview_description)') }}
                                                <p>{{ $portfolio->{{ __('overview_description }}') }}</p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- portfolio-single end-->

    </main>
@endsection
