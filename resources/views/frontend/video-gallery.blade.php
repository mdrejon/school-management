@extends('frontend.layouts.app')

@section('title', ($pageSettings->seo_title ?: $pageSettings->breadcrumb_title ?: 'Our Video Gallery') . ' - ' . config('app.name'))
@section('meta_description', $pageSettings->seo_description ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $pageSettings->breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $pageSettings->breadcrumb_title ?: 'Video Gallery' }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="active">{{ $pageSettings->breadcrumb_title ?: 'Video Gallery' }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- video-gallery-area -->
        <div class="wexnix_gallery-area py-120">
            <div class="container">
                @if ($pageSettings->section_title)
                    @php
                        $titleHtml = e($pageSettings->section_title);
                        if (! empty($pageSettings->section_highlight)) {
                            $titleHtml = str_ireplace(e($pageSettings->section_highlight), '<span>' . e($pageSettings->section_highlight) . '</span>', $titleHtml);
                        }
                    @endphp
                    <div class="row">
                        <div class="col-lg-6 mx-auto">
                            <div class="wexnix_site-heading text-center">
                                @if ($pageSettings->section_tagline)
                                    <span class="wexnix_site-title-tagline"><i class="fas fa-video"></i> {{ $pageSettings->section_tagline }}</span>
                                @endif
                                <h2 class="wexnix_site-title">{!! $titleHtml !!}</h2>
                                @if ($pageSettings->section_description)
                                    <p>{{ $pageSettings->section_description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                @if ($videos->count())
                    <div class="row">
                        @foreach ($videos as $video)
                            <div class="col-md-4 col-sm-6 mb-4 wow fadeInUp" data-wow-delay=".25s">
                                <div class="wexnix_gallery-item shadow-sm rounded overflow-hidden" style="position: relative; padding-bottom: 56.25%; height: 0;">
                                    <iframe src="{{ $video->video_url }}" title="{{ $video->caption }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
                                </div>
                                @if($video->caption)
                                    <h5 class="text-center mt-3">{{ $video->caption }}</h5>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- pagination -->
                    {{ $videos->links('frontend.pagination.wexnix') }}
                    <!-- pagination end -->
                @else
                    <p class="text-center">{{ __('No videos available right now — please check back soon.') }}</p>
                @endif
            </div>
        </div>
        <!-- video-gallery-area end -->

    </main>
@endsection
