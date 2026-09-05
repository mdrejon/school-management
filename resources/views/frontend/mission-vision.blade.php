@extends('frontend.layouts.app')

@section('title', $pageSettings->seo_title ?: ($pageSettings->breadcrumb_title ?: 'Our Vision & Mission'))
@section('meta_description', $pageSettings->seo_description ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url('{{ $pageSettings->breadcrumb_image_url ?: asset('assets/img/breadcrumb/01.jpg') }}')">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $pageSettings->breadcrumb_title ?: 'Vision & Mission' }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="active">{{ $pageSettings->breadcrumb_title ?: 'Vision & Mission' }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <div class="wexnix_about-area py-120">
            <div class="container d-flex flex-column gap-5">

                <!-- SECTION 1: VISION (Odd: Image Left, Text Right) -->
                <div class="row g-4 align-items-center mb-5 pb-5 border-bottom">
                    <div class="col-lg-6">
                        <div class="vision-mission-img-wrap wow fadeInLeft" data-wow-delay=".25s">
                            <img loading="lazy" class="img-fluid w-100"
                                src="{{ $pageSettings->image_1_url ?: asset('assets/img/about/01.jpg') }}"
                                alt="{{ $pageSettings->title ?: 'Our Vision' }}"
                                style="border-radius: 16px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); object-fit: cover; max-height: 460px;"
                            >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="wexnix_about-right wow fadeInRight" data-wow-delay=".25s">
                            <div class="wexnix_site-heading mb-3">
                                @if ($pageSettings->tagline)
                                    <span class="wexnix_site-title-tagline"><i class="fas fa-book-open-reader"></i> {{ $pageSettings->tagline }}</span>
                                @endif
                                <h2 class="wexnix_site-title">
                                    @php
                                        $fullTitle = $pageSettings->title ?: 'Shaping A Brighter Future For Every Student.';
                                        $highlight = $pageSettings->highlight ?: 'Brighter Future';
                                        if ($highlight && str_contains($fullTitle, $highlight)) {
                                            $formattedTitle = str_replace($highlight, '<span>' . e($highlight) . '</span>', e($fullTitle));
                                        } else {
                                            $formattedTitle = e($fullTitle);
                                        }
                                    @endphp
                                    {!! $formattedTitle !!}
                                </h2>
                            </div>
                            <p class="wexnix_about-text">
                                {{ $pageSettings->description ?: 'There are many variations of passages available but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.' }}
                            </p>
                        </div>
                    </div>
                </div>
                <!-- SECTION 1: VISION END -->

                <!-- SECTION 2: MISSION (Even: Text Left, Image Right / flex-lg-row-reverse) -->
                <div class="row g-4 align-items-center mb-5 pb-5 border-bottom flex-lg-row-reverse">
                    <div class="col-lg-6">
                        <div class="vision-mission-img-wrap wow fadeInRight" data-wow-delay=".25s">
                            <img loading="lazy" class="img-fluid w-100"
                                src="{{ $pageSettings->mission_image_1_url ?: asset('assets/img/about/02.jpg') }}"
                                alt="{{ $pageSettings->mission_title ?: 'Our Mission' }}"
                                style="border-radius: 16px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); object-fit: cover; max-height: 460px;"
                            >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="wexnix_about-right wow fadeInLeft" data-wow-delay=".25s">
                            <div class="wexnix_site-heading mb-3">
                                @if ($pageSettings->mission_tagline)
                                    <span class="wexnix_site-title-tagline"><i class="fas fa-book-open-reader"></i> {{ $pageSettings->mission_tagline }}</span>
                                @endif
                                <h2 class="wexnix_site-title">
                                    @php
                                        $fullMissionTitle = $pageSettings->mission_title ?: 'Empowering Students To Achieve Academic & Personal Excellence.';
                                        $missionHighlight = $pageSettings->mission_highlight ?: 'Empowering Students';
                                        if ($missionHighlight && str_contains($fullMissionTitle, $missionHighlight)) {
                                            $formattedMissionTitle = str_replace($missionHighlight, '<span>' . e($missionHighlight) . '</span>', e($fullMissionTitle));
                                        } else {
                                            $formattedMissionTitle = e($fullMissionTitle);
                                        }
                                    @endphp
                                    {!! $formattedMissionTitle !!}
                                </h2>
                            </div>
                            <p class="wexnix_about-text">
                                {{ $pageSettings->mission_description ?: 'Our mission is to provide an inclusive, inspiring learning environment that fosters critical thinking, creativity, moral values, and life-long learning skills.' }}
                            </p>
                        </div>
                    </div>
                </div>
                <!-- SECTION 2: MISSION END -->

                <!-- SECTION 3: CORE VALUES (Odd: Image Left, Text Right) -->
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <div class="vision-mission-img-wrap wow fadeInLeft" data-wow-delay=".25s">
                            <img loading="lazy" class="img-fluid w-100"
                                src="{{ $pageSettings->values_image_1_url ?: asset('assets/img/about/03.jpg') }}"
                                alt="{{ $pageSettings->values_title ?: 'Our Core Values' }}"
                                style="border-radius: 16px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); object-fit: cover; max-height: 460px;"
                            >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="wexnix_about-right wow fadeInRight" data-wow-delay=".25s">
                            <div class="wexnix_site-heading mb-3">
                                @if ($pageSettings->values_tagline)
                                    <span class="wexnix_site-title-tagline"><i class="fas fa-book-open-reader"></i> {{ $pageSettings->values_tagline }}</span>
                                @endif
                                <h2 class="wexnix_site-title">
                                    @php
                                        $fullValuesTitle = $pageSettings->values_title ?: 'Guiding Principles That Drive Our Educational Journey.';
                                        $valuesHighlight = $pageSettings->values_highlight ?: 'Core Values';
                                        if ($valuesHighlight && str_contains($fullValuesTitle, $valuesHighlight)) {
                                            $formattedValuesTitle = str_replace($valuesHighlight, '<span>' . e($valuesHighlight) . '</span>', e($fullValuesTitle));
                                        } else {
                                            $formattedValuesTitle = e($fullValuesTitle);
                                        }
                                    @endphp
                                    {!! $formattedValuesTitle !!}
                                </h2>
                            </div>
                            <p class="wexnix_about-text">
                                {{ $pageSettings->values_description ?: "Integrity, Excellence, Innovation, Respect, and Community Engagement form the foundation of our institution's culture and daily endeavors." }}
                            </p>
                        </div>
                    </div>
                </div>
                <!-- SECTION 3: CORE VALUES END -->

            </div>
        </div>

    </main>
@endsection
