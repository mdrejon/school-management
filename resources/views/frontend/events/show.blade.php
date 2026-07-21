@extends('frontend.layouts.app')

@section('title', $event->title . ' - ' . config('app.name'))
@section('meta_description', $event->short_description ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $pageSettings->breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $event->title }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('events.index') }}">{{ $pageSettings->breadcrumb_title ?: 'Events' }}</a></li>
                    <li class="active">{{ $event->title }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- event single area -->
        <div class="wexnix_event-single-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="wexnix_event-details">
                            @if ($event->image_url)
                                <img src="{{ $event->image_url }}" alt="">
                            @endif

                            @foreach ($event->contentBlocks() as $block)
                                <div class="my-4">
                                    @if ($block['title'])
                                        <h3 class="mb-2">{{ $block['title'] }}</h3>
                                    @endif
                                    @if ($block['description'])
                                        <p>{{ $block['description'] }}</p>
                                    @endif
                                </div>
                            @endforeach

                            @if ($event->gallery_image_1_url || $event->gallery_image_2_url)
                                <div class="row">
                                    @if ($event->gallery_image_1_url)
                                        <div class="col-md-6 mb-4">
                                            <img src="{{ $event->gallery_image_1_url }}" alt="">
                                        </div>
                                    @endif
                                    @if ($event->gallery_image_2_url)
                                        <div class="col-md-6 mb-4">
                                            <img src="{{ $event->gallery_image_2_url }}" alt="">
                                        </div>
                                    @endif
                                </div>
                            @endif

                            @if ($event->map_embed_url)
                                <div class="wexnix_event-map mt-5">
                                    <iframe src="{{ $event->map_embed_url }}" style="border:0;" allowfullscreen loading="lazy"></iframe>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="wexnix_widget wexnix_event-single-info">
                            <h4 class="wexnix_widget-title">Event Information</h4>
                            @if ($event->sidebar_intro)
                                <p>{{ $event->sidebar_intro }}</p>
                            @endif
                            <div class="wexnix_event-content">
                                @if ($event->event_date)
                                    <div class="wexnix_event-content-single">
                                        <h5><a href="#">Event Date</a></h5>
                                        <p><i class="fas fa-calendar-alt"></i> {{ $event->event_date->format('d F Y') }}</p>
                                    </div>
                                @endif
                                @if ($event->event_time)
                                    <div class="wexnix_event-content-single">
                                        <h5><a href="#">Event Time</a></h5>
                                        <p><i class="fas fa-clock"></i> {{ $event->event_time }}</p>
                                    </div>
                                @endif
                                @if ($event->location)
                                    <div class="wexnix_event-content-single">
                                        <h5><a href="#">Event Location</a></h5>
                                        <p><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</p>
                                    </div>
                                @endif
                                @if ($event->cost)
                                    <div class="wexnix_event-content-single">
                                        <h5><a href="#">Event Cost</a></h5>
                                        <p><i class="fas fa-circle-dollar-to-slot"></i> {{ $event->cost }}</p>
                                    </div>
                                @endif

                                @if ($event->button_text && $event->button_url)
                                    <a href="{{ $event->button_url }}" class="wexnix_theme-btn mt-4">{{ $event->button_text }} <i class="fas fa-arrow-right-long"></i></a>
                                @endif
                            </div>
                        </div>
                        @if ($event->organizer_name)
                            <div class="wexnix_widget wexnix_event-author">
                                <h4 class="wexnix_widget-title">Event Organizer</h4>
                                <div class="wexnix_event-author-info">
                                    @if ($event->organizer_photo_url)
                                        <img src="{{ $event->organizer_photo_url }}" alt="">
                                    @endif
                                    <h5>{{ $event->organizer_name }}</h5>
                                    @if ($event->organizer_bio)
                                        <p>{{ $event->organizer_bio }}</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- event single area end -->

    </main>
@endsection
