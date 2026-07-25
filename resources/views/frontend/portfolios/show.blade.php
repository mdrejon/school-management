@extends('frontend.layouts.app')

@section('title', $portfolio->title . ' - ' . config('app.name'))

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $pageSettings->breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $portfolio->title }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('portfolios.index') }}">{{ $pageSettings->breadcrumb_title ?: 'Portfolio' }}</a></li>
                    <li class="active">{{ $portfolio->title }}</li>
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
                                    <h4 class="wexnix_portfolio-sidebar-title">Portfolio Details</h4>
                                    <ul>
                                        @if ($portfolio->category)
                                            <li>Category <span>{{ $portfolio->category }}</span></li>
                                        @endif
                                        @if ($portfolio->event_date)
                                            <li>Date <span>{{ $portfolio->event_date->format('d F, Y') }}</span></li>
                                        @endif
                                        @if ($portfolio->client_name)
                                            <li>Client Name <span>{{ $portfolio->client_name }}</span></li>
                                        @endif
                                        @if ($portfolio->cost)
                                            <li>Total Cost <span>{{ $portfolio->cost }}</span></li>
                                        @endif
                                        @if ($portfolio->manager_name)
                                            <li>Manager <span>{{ $portfolio->manager_name }}</span></li>
                                        @endif
                                        @if ($portfolio->location)
                                            <li>Location <span>{{ $portfolio->location }}</span></li>
                                        @endif
                                        @if ($portfolio->website_url)
                                            <li>Website <span>{{ $portfolio->website_url }}</span></li>
                                        @endif
                                        @if ($portfolio->rating)
                                            <li>
                                                Rating
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
                                @if ($portfolio->image_url)
                                    <div class="wexnix_portfolio-details-img mb-30">
                                        <img src="{{ $portfolio->image_url }}" alt="thumb">
                                    </div>
                                @endif
                                <div class="wexnix_portfolio-details">
                                    <h3 class="mb-20">{{ $portfolio->title }}</h3>
                                    @if ($portfolio->description)
                                        <div class="mb-20">{!! $portfolio->description !!}</div>
                                    @endif

                                    @if ($portfolio->gallery_image_1_url || $portfolio->gallery_image_2_url)
                                        <div class="row">
                                            @if ($portfolio->gallery_image_1_url)
                                                <div class="col-md-6 mb-20">
                                                    <img src="{{ $portfolio->gallery_image_1_url }}" alt="">
                                                </div>
                                            @endif
                                            @if ($portfolio->gallery_image_2_url)
                                                <div class="col-md-6 mb-20">
                                                    <img src="{{ $portfolio->gallery_image_2_url }}" alt="">
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    @php $highlightItems = $portfolio->highlightItems(); @endphp
                                    @if ($portfolio->highlight_title || count($highlightItems))
                                        <div class="my-4">
                                            @if ($portfolio->highlight_title)
                                                <div class="mb-3">
                                                    <h3 class="mb-3">{{ $portfolio->highlight_title }}</h3>
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

                                    @if ($portfolio->overview_title || $portfolio->overview_description)
                                        <div class="my-4">
                                            @if ($portfolio->overview_title)
                                                <h3 class="mb-3">{{ $portfolio->overview_title }}</h3>
                                            @endif
                                            @if ($portfolio->overview_description)
                                                <p>{{ $portfolio->overview_description }}</p>
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
