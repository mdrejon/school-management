@extends('frontend.layouts.app')

@section('title', $pageSettings->seo_title ?: ($pageSettings->breadcrumb_title ?: 'Class Schedule'))

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url('{{ $pageSettings->breadcrumb_image_url ?: asset('assets/img/breadcrumb/01.jpg') }}')">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $pageSettings->breadcrumb_title ?: 'Class Schedule' }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">{{ $pageSettings->breadcrumb_title ?: 'Class Schedule' }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- page content -->
        <div class="pt-80 pb-120">
            <div class="container">
                <!-- Header Banner Card -->
                <div class="wexnix_schedule-header-card text-center mb-5 p-4 rounded-4 shadow-sm bg-light-subtle">
                    <h2 class="wexnix_schedule-main-title font-weight-bold color-primary mb-2">
                        {{ $pageSettings->breadcrumb_title ?: 'Class Schedule' }}
                    </h2>
                    <div class="wexnix_title-line mx-auto"></div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="wexnix_schedule-content-box p-4 p-md-5 bg-white rounded-4 border shadow-sm">
                            <h4 class="wexnix_schedule-section-heading mb-4 font-weight-bold text-dark">
                                {{ $pageSettings->section_title ?: 'Daily Activities' }}
                            </h4>

                            @if (!empty($pageSettings->section_description))
                                <p class="text-muted mb-4">{{ $pageSettings->section_description }}</p>
                            @endif

                            <div class="wexnix_schedule-list-wrapper">
                                @forelse ($schedules as $item)
                                    <div class="wexnix_schedule-item d-flex flex-wrap align-items-baseline mb-2 {{ $item->is_bullet ? 'ps-4 ms-2' : '' }}">
                                        <div class="wexnix_schedule-label font-weight-bold text-secondary me-3" style="min-width: 180px;">
                                            @if ($item->is_bullet)
                                                <span class="wexnix_bullet-dot me-2">•</span>
                                            @endif
                                            {{ $item->title }}
                                        </div>
                                        <div class="wexnix_schedule-separator me-3">:</div>
                                        <div class="wexnix_schedule-value font-weight-medium text-dark flex-grow-1">
                                            {{ $item->time_info }}
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-4 text-muted">
                                        <p>No class schedule available at this time.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page content end -->

    </main>

    @push('styles')
        <style>
            .wexnix_schedule-main-title {
                font-size: 2.2rem;
                color: var(--theme-color, #0f172a);
            }
            .wexnix_title-line {
                width: 60px;
                height: 3px;
                background-color: var(--theme-color2, #2563eb);
                border-radius: 2px;
            }
            .wexnix_schedule-item {
                font-size: 1.05rem;
                line-height: 1.8;
            }
            .wexnix_bullet-dot {
                font-size: 1.2rem;
                color: var(--theme-color2, #2563eb);
            }
        </style>
    @endpush
@endsection
