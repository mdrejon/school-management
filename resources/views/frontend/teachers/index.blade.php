@extends('frontend.layouts.app')

@section('title', ($pageSettings->seo_title ?: $pageSettings->breadcrumb_title ?: 'Our Teachers') . ' - ' . config('app.name'))
@section('meta_description', $pageSettings->seo_description ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $pageSettings->breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $pageSettings->breadcrumb_title ?: 'Teachers' }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">{{ $pageSettings->breadcrumb_title ?: 'Teachers' }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- team-area -->
        <div class="wexnix_team-area py-120">
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
                                    <span class="wexnix_site-title-tagline"><i class="fas fa-book-open-reader"></i> {{ $pageSettings->section_tagline }}</span>
                                @endif
                                <h2 class="wexnix_site-title">{!! $titleHtml !!}</h2>
                                @if ($pageSettings->section_description)
                                    <p>{{ $pageSettings->section_description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                @if ($teachers->count())
                    <div class="row">
                        @foreach ($teachers as $teacher)
                            @include('frontend.teachers.partials.card', ['teacher' => $teacher])
                        @endforeach
                    </div>

                    <!-- pagination -->
                    {{ $teachers->links('frontend.pagination.wexnix') }}
                    <!-- pagination end -->
                @else
                    <p class="text-center">No teachers available right now — please check back soon.</p>
                @endif
            </div>
        </div>
        <!-- team-area end -->

    </main>
@endsection
