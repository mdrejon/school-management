@extends('frontend.layouts.app')

@section('title', ($pageSettings->seo_title ?: $pageSettings->breadcrumb_title ?: 'Campus Tour') . ' - ' . config('app.name'))
@section('meta_description', $pageSettings->seo_description ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url('{{ $pageSettings->breadcrumb_image_url ?: asset('assets/img/breadcrumb/01.jpg') }}')">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $pageSettings->breadcrumb_title ?: 'Campus Tour' }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="active">{{ $pageSettings->breadcrumb_title ?: 'Campus Tour' }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- campus tour gallery-area -->
        <div class="wexnix_gallery-area py-120">
            <div class="container">
                @if ($pageSettings->title || $pageSettings->tagline)
                    @php
                        $titleHtml = e($pageSettings->title ?: 'Take A Look At Our Campus');
                        if (! empty($pageSettings->highlight)) {
                            $titleHtml = str_ireplace(e($pageSettings->highlight), '<span>' . e($pageSettings->highlight) . '</span>', $titleHtml);
                        }
                    @endphp
                    <div class="row">
                        <div class="col-lg-6 mx-auto">
                            <div class="wexnix_site-heading text-center">
                                @if ($pageSettings->tagline)
                                    <span class="wexnix_site-title-tagline"><i class="fas fa-book-open-reader"></i> {{ $pageSettings->tagline }}</span>
                                @endif
                                <h2 class="wexnix_site-title">{!! $titleHtml !!}</h2>
                                @if ($pageSettings->description)
                                    <p>{{ $pageSettings->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                @if ($images->count())
                    <div class="row wexnix_popup-gallery">
                        @foreach ($images->getCollection()->chunk(2) as $column)
                            <div class="col-md-4 wow fadeInUp" data-wow-delay=".25s">
                                @foreach ($column as $image)
                                    @include('frontend.gallery.partials.item', ['image' => $image])
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <!-- pagination -->
                    {{ $images->links('frontend.pagination.wexnix') }}
                    <!-- pagination end -->
                @else
                    <div class="col-12 text-center py-5 text-muted">
                        <p>{{ __('No campus tour photos available right now — please check back soon.') }}</p>
                    </div>
                @endif
            </div>
        </div>
        <!-- campus tour gallery-area end -->

    </main>
@endsection
