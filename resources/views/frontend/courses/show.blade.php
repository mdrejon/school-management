@extends('frontend.layouts.app')

@section('title', $course->title . ' - ' . config('app.name'))
@section('meta_description', $course->short_description ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $pageSettings->breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $course->title }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('courses.index') }}">{{ $pageSettings->breadcrumb_title ?: 'Our Courses' }}</a></li>
                    <li class="active">{{ $course->title }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- course-single -->
        <div class="wexnix_course-single-area py-120">
            <div class="container">
                <div class="wexnix_course-single-wrapper">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8">
                            <div class="wexnix_course-details">
                                @if ($course->thumbnail_url)
                                    <div class="wexnix_course-details-img mb-30">
                                        <img src="{{ $course->thumbnail_url }}" alt="thumb">
                                    </div>
                                @endif
                                <div class="wexnix_course-details">
                                    <h3 class="mb-20">{{ $course->title }}</h3>
                                    @if ($course->description)
                                        <div class="mb-20">{!! $course->description !!}</div>
                                    @endif

                                    @if ($course->gallery_image_1_url || $course->gallery_image_2_url)
                                        <div class="row">
                                            @if ($course->gallery_image_1_url)
                                                <div class="col-md-6 mb-20">
                                                    <img src="{{ $course->gallery_image_1_url }}" alt="">
                                                </div>
                                            @endif
                                            @if ($course->gallery_image_2_url)
                                                <div class="col-md-6 mb-20">
                                                    <img src="{{ $course->gallery_image_2_url }}" alt="">
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    @php $requirementItems = $course->requirementItems(); @endphp
                                    @if ($course->requirement_title || count($requirementItems))
                                        <div class="my-4">
                                            @if ($course->requirement_title)
                                                <div class="mb-3">
                                                    <h3 class="mb-3">{{ $course->requirement_title }}</h3>
                                                </div>
                                            @endif
                                            @if (count($requirementItems))
                                                <ul class="wexnix_course-single-list">
                                                    @foreach ($requirementItems as $item)
                                                        <li><i class="fas fa-check"></i>{{ $item }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    @endif

                                    @if ($course->experience_title || $course->experience_description)
                                        <div class="my-4">
                                            @if ($course->experience_title)
                                                <h3 class="mb-3">{{ $course->experience_title }}</h3>
                                            @endif
                                            @if ($course->experience_description)
                                                <p>{{ $course->experience_description }}</p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                            <div class="wexnix_course-single-sidebar">
                                <div class="wexnix_widget">
                                    <h4 class="wexnix_widget-title">Course Info</h4>
                                    <div class="wexnix_course-single-info">
                                        @if ($course->instructor_name)
                                            <div class="wexnix_single-info wexnix_author">
                                                @if ($course->instructor_image_url)
                                                    <div class="wexnix_author-img">
                                                        <img src="{{ $course->instructor_image_url }}" alt="#">
                                                    </div>
                                                @endif
                                                <div class="wexnix_single-info-content">
                                                    <h4>Teacher</h4>
                                                    <span>{{ $course->instructor_name }}</span>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($course->category)
                                            <div class="wexnix_single-info wexnix_category">
                                                <i class="fas fa-bolt"></i>
                                                <div class="wexnix_single-info-content">
                                                    <h4>Category</h4>
                                                    <span>{{ $course->category }}</span>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($course->enrolled_text)
                                            <div class="wexnix_single-info wexnix_s-enroll">
                                                <i class="fas fa-users"></i>
                                                <div class="wexnix_single-info-content">
                                                    <h4>Enrolled</h4>
                                                    <span>{{ $course->enrolled_text }}</span>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($course->duration)
                                            <div class="wexnix_single-info wexnix_rattings">
                                                <i class="fas fa-clock"></i>
                                                <div class="wexnix_single-info-content">
                                                    <h4>Course Time</h4>
                                                    <span>{{ $course->duration }}</span>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($course->price)
                                            <div class="wexnix_single-info wexnix_rattings">
                                                <i class="fas fa-dollar"></i>
                                                <div class="wexnix_single-info-content">
                                                    <h4>Course Fees</h4>
                                                    <span>{{ $course->price }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @if ($siteSettings->phone)
                                        <a href="tel:{{ $siteSettings->phone }}" class="wexnix_theme-btn">Enroll Now<i class="fas fa-arrow-right-long"></i></a>
                                    @endif
                                </div>

                                @php $features = $course->featureItems(); @endphp
                                @if (count($features))
                                    <div class="wexnix_widget">
                                        <h4 class="wexnix_widget-title">Course Features</h4>
                                        <div class="wexnix_course-feature-list">
                                            @foreach ($features as $feature)
                                                <a href="#"><x-dynamic-icon :icon="$feature['icon']" /> {{ $feature['label'] }} <span>{{ $feature['value'] }}</span></a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- course-single end-->

    </main>
@endsection
