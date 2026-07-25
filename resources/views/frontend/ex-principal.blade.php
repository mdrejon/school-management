@extends('frontend.layouts.app')

@section('title', ($siteSettings->ex_principal_page_seo_title ?: $siteSettings->ex_principal_page_breadcrumb_title ?: 'Our EX Principal') . ' - ' . config('app.name'))
@section('meta_description', $siteSettings->ex_principal_page_seo_description ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $siteSettings->ex_principal_page_breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $siteSettings->ex_principal_page_breadcrumb_title ?: 'Our EX Principal' }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">{{ $siteSettings->ex_principal_page_breadcrumb_title ?: 'Our EX Principal' }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- ex-principal single -->
        <div class="wexnix_team-single pt-120 pb-120">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-md-4">
                        <div class="wexnix_team-single-img">
                            <img src="{{ $siteSettings->ex_principal_photo_url ?? '/frontend/assets/img/team/03.jpg' }}" alt="{{ $siteSettings->ex_principal_name ?: 'Our EX Principal' }}">
                        </div>
                        @if ($siteSettings->ex_principal_name || $siteSettings->ex_principal_designation)
                            <div class="text-center mt-3">
                                @if ($siteSettings->ex_principal_name)
                                    <h3 class="mb-1">{{ $siteSettings->ex_principal_name }}</h3>
                                @endif
                                @if ($siteSettings->ex_principal_designation)
                                    <strong>{{ $siteSettings->ex_principal_designation }}</strong>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="wexnix_team-details">
                            <h3>Message From Former Principal</h3>
                            @if ($siteSettings->ex_principal_message)
                                <p class="mt-3">{!! nl2br(e($siteSettings->ex_principal_message)) !!}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ex-principal single end -->

    </main>
@endsection
