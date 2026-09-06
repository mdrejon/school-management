@extends('frontend.layouts.app')

@section('title', ($siteSettings->chairman_page_seo_title ?: $siteSettings->chairman_page_breadcrumb_title ?: 'Our Chairman') . ' - ' . config('app.name'))
@section('meta_description', $siteSettings->chairman_page_seo_description ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $siteSettings->chairman_page_breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $siteSettings->chairman_page_breadcrumb_title ?: 'Our Chairman' }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="active">{{ $siteSettings->chairman_page_breadcrumb_title ?: 'Our Chairman' }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- chairman single -->
        <div class="wexnix_team-single pt-120 pb-120">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-md-4">
                        <div class="wexnix_team-single-img">
                            <img loading="lazy" src="{{ $siteSettings->chairman_photo_url ?? '/frontend/assets/img/team/03.jpg' }}" alt="{{ $siteSettings->chairman_name ?: 'Our Chairman' }}">
                        </div>
                        @if ($siteSettings->chairman_name || $siteSettings->chairman_designation)
                            <div class="text-center mt-3">
                                @if ($siteSettings->chairman_name)
                                    <h3 class="mb-1">{{ $siteSettings->chairman_name }}</h3>
                                @endif
                                @if ($siteSettings->chairman_designation)
                                    <strong>{{ $siteSettings->chairman_designation }}</strong>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="wexnix_team-details">
                            <h3>{{ __('Chairman\'s Message') }}</h3>
                            @if ($siteSettings->chairman_message)
                                <p class="mt-3">{!! nl2br(e($siteSettings->chairman_message)) !!}</p>
                            @endif
                            <div class="wexnix_team-details-info">
                                <ul>
                                    @if ($siteSettings->address)
                                        <li><a href="#"><i class="fas fa-location-dot"></i> {{ $siteSettings->address }}</a></li>
                                    @endif
                                    @if ($siteSettings->email)
                                        <li><a href="mailto:{{ $siteSettings->email }}"><i class="fas fa-envelope"></i> {{ $siteSettings->email }}</a></li>
                                    @endif
                                    @if ($siteSettings->phone)
                                        <li><a href="tel:{{ $siteSettings->phone }}"><i class="fas fa-phone"></i> {{ $siteSettings->phone }}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- chairman single end -->

    </main>
@endsection
