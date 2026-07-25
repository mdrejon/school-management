@extends('frontend.layouts.app')

@section('title', ($siteSettings->about_page_seo_title ?: $siteSettings->about_page_breadcrumb_title ?: 'About Us') . ' - ' . config('app.name'))
@section('meta_description', $siteSettings->about_page_seo_description ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $siteSettings->about_page_breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $siteSettings->about_page_breadcrumb_title ?: 'About Us' }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">{{ $siteSettings->about_page_breadcrumb_title ?: 'About Us' }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- about area -->
        @include('frontend.sections.about.' . config('frontend.sections.about'), ['siteSettings' => $siteSettings])
        <!-- about area end -->

        <!-- counter area -->
        @include('frontend.sections.counter.' . config('frontend.sections.counter'), ['siteSettings' => $siteSettings])
        <!-- counter area end -->

        <!-- team-area -->
        @include('frontend.sections.teacher.' . config('frontend.sections.teacher'), ['teachers' => $teachers, 'pageSettings' => $teacherPageSettings])
        <!-- team-area end -->

        <!-- testimonial area -->
        @include('frontend.sections.testimonial.' . config('frontend.sections.testimonial'), ['testimonials' => $testimonials, 'pageSettings' => $testimonialPageSettings])
        <!-- testimonial area end -->

        <!-- partner area -->
        @include('frontend.sections.partner.' . config('frontend.sections.partner'), ['siteSettings' => $siteSettings])
        <!-- partner area end -->

    </main>
@endsection
