@extends('frontend.layouts.app')

@section('title', ($page->seo_title ?: $page->title) . ' - ' . config('app.name'))
@section('meta_description', $page->seo_description ?: '')

@if ($page->custom_css)
    @push('styles')
        <style>{!! $page->custom_css !!}</style>
    @endpush
@endif

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $page->breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $page->{{ __('title }}') }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="active">{{ $page->{{ __('title }}') }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- page content -->
        <div class="wexnix_page-builder py-120">
            <div class="container">
                {!! $page->{{ __('content !!}') }}
            </div>
        </div>
        <!-- page content end -->

    </main>
@endsection
