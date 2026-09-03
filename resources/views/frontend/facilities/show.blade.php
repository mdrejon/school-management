@extends('frontend.layouts.app')

@section('title', $facility->title . ' - ' . config('app.name'))
@section('meta_description', $facility->short_description ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $pageSettings->breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $facility->title }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li><a href="{{ route('facilities.index') }}">{{ $pageSettings->breadcrumb_title ?: 'Our Facilities' }}</a></li>
                    <li class="active">{{ $facility->title }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- facility single -->
        <div class="wexnix_course-single-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="wexnix_course-details">
                            @if ($facility->image_url)
                                <div class="wexnix_course-details-img mb-30">
                                    <img src="{{ $facility->image_url }}" alt="thumb">
                                </div>
                            @endif
                            <h3 class="mb-20">{{ $facility->title }}</h3>
                            @if ($facility->description)
                                <div class="mb-20">{!! $facility->description !!}</div>
                            @endif

                            @if ($facility->gallery_image_1_url || $facility->gallery_image_2_url)
                                <div class="row">
                                    @if ($facility->gallery_image_1_url)
                                        <div class="col-md-6 mb-20">
                                            <img src="{{ $facility->gallery_image_1_url }}" alt="">
                                        </div>
                                    @endif
                                    @if ($facility->gallery_image_2_url)
                                        <div class="col-md-6 mb-20">
                                            <img src="{{ $facility->gallery_image_2_url }}" alt="">
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- facility single end -->

    </main>
@endsection
