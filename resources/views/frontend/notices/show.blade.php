@extends('frontend.layouts.app')

@section('title', $notice->title . ' - ' . config('app.name'))

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $pageSettings->breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $notice->title }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('notices.index') }}">{{ $pageSettings->breadcrumb_title ?: 'Notice' }}</a></li>
                    <li class="active">{{ $notice->title }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- notice single -->
        <div class="wexnix_blog-single-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="wexnix_blog-single-wrapper">
                            <div class="wexnix_blog-single-content">
                                <div class="wexnix_blog-info">
                                    <div class="wexnix_blog-meta">
                                        <div class="wexnix_blog-meta-left">
                                            <ul>
                                                @if ($notice->published_at)
                                                    <li><i class="fas fa-calendar-alt"></i> {{ $notice->published_at->format('d M, Y') }}</li>
                                                @endif
                                            </ul>
                                        </div>
                                        @if ($notice->pdf_url)
                                            <div class="wexnix_blog-meta-right">
                                                <a href="{{ $notice->pdf_url }}" target="_blank" class="wexnix_theme-btn"><i class="fas fa-download"></i> Download PDF</a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="wexnix_blog-details">
                                        <h3 class="wexnix_blog-details-title mb-20">{{ $notice->title }}</h3>
                                        @if ($notice->description)
                                            <div>{!! $notice->description !!}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- notice single end -->

    </main>
@endsection
