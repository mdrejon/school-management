@extends('frontend.layouts.app')

@section('title', ($siteSettings->principal_page_seo_title ?: $siteSettings->principal_page_breadcrumb_title ?: 'Our Principal') . ' - ' . config('app.name'))
@section('meta_description', $siteSettings->principal_page_seo_description ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $siteSettings->principal_page_breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $siteSettings->{{ __('principal_page_breadcrumb_title ?: \'Our Principal\' }}') }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="active">{{ $siteSettings->{{ __('principal_page_breadcrumb_title ?: \'Our Principal\' }}') }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- principal single -->
        <div class="wexnix_team-single pt-120 pb-120">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-md-4">
                        <div class="wexnix_team-single-img">
                            <img src="{{ $siteSettings->principal_photo_url ?? '/frontend/assets/img/team/03.jpg' }}" alt="{{ $siteSettings->principal_name ?: 'Our Principal' }}">
                        </div>
                        @if ($siteSettings->principal_name || $siteSettings->{{ __('principal_designation)') }}
                            <div class="text-center mt-3">
                                @if ($siteSettings->{{ __('principal_name)') }}
                                    <h3 class="mb-1">{{ $siteSettings->{{ __('principal_name }}') }}</h3>
                                @endif
                                @if ($siteSettings->{{ __('principal_designation)') }}
                                    <strong>{{ $siteSettings->{{ __('principal_designation }}') }}</strong>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="wexnix_team-details">
                            <h3>{{ __('Principal\'s Message') }}</h3>
                            @if ($siteSettings->{{ __('principal_message)') }}
                                <p class="mt-3">{!! nl2br(e($siteSettings->{{ __('principal_message)) !!}') }}</p>
                            @endif
                            <div class="wexnix_team-details-info">
                                <ul>
                                    @if ($siteSettings->{{ __('address)') }}
                                        <li><a href="#"><i class="fas fa-location-dot"></i> {{ $siteSettings->{{ __('address }}') }}</a></li>
                                    @endif
                                    @if ($siteSettings->{{ __('email)') }}
                                        <li><a href="mailto:{{ $siteSettings->email }}"><i class="fas fa-envelope"></i> {{ $siteSettings->{{ __('email }}') }}</a></li>
                                    @endif
                                    @if ($siteSettings->{{ __('phone)') }}
                                        <li><a href="tel:{{ $siteSettings->phone }}"><i class="fas fa-phone"></i> {{ $siteSettings->{{ __('phone }}') }}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- principal single end -->

    </main>
@endsection
