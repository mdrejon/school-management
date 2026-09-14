@extends('frontend.layouts.app')

@section('title', ($page?->seo_title ?: 'Education Levels') . ' - ' . config('app.name'))
@section('meta_description', $page?->seo_description ?: '')

@section('content')
<main class="wexnix_main">
    <!-- breadcrumb -->
    <div class="wexnix_site-breadcrumb" style="background: url({{ $page?->breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
        <div class="container">
            <h2 class="wexnix_breadcrumb-title">{{ $page?->breadcrumb_title ?: __('Education Levels') }}</h2>
            <ul class="wexnix_breadcrumb-menu">
                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="active">{{ $page?->breadcrumb_title ?: __('Education Levels') }}</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <div class="py-120">
        <div class="container">
            
            <style>
                .campus-banner {
                    background: var(--theme-color);
                    color: #fff;
                    padding: 15px 30px;
                    font-size: 1.5rem;
                    font-weight: 700;
                    margin-bottom: 20px;
                    margin-top: 40px;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }
                .campus-banner:first-child {
                    margin-top: 0;
                }
                .level-row {
                    display: flex;
                    flex-wrap: wrap;
                    margin-bottom: 15px;
                }
                .level-info-col {
                    flex: 0 0 35%;
                    max-width: 35%;
                    padding-right: 15px;
                }
                .level-classes-col {
                    flex: 0 0 65%;
                    max-width: 65%;
                    padding-left: 15px;
                }
                .level-info-box {
                    background: #f8f9fa;
                    border: 1px solid #e9ecef;
                    padding: 20px;
                    height: 100%;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                }
                .level-info-box h4 {
                    color: var(--theme-color);
                    margin-bottom: 5px;
                    font-size: 1.25rem;
                }
                .level-info-box p {
                    margin: 0;
                    color: var(--body-text-color);
                    font-size: 0.95rem;
                }
                .classes-box {
                    background: #fff;
                    border: 1px solid #e9ecef;
                    padding: 20px;
                    height: 100%;
                }
                .classes-list {
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    gap: 10px 20px;
                    list-style: none;
                    margin: 0;
                    padding: 0;
                }
                .classes-list li {
                    position: relative;
                    padding-left: 20px;
                    color: var(--heading-color);
                    font-weight: 500;
                }
                .classes-list li::before {
                    content: "\f101";
                    font-family: "Font Awesome 5 Free";
                    font-weight: 900;
                    position: absolute;
                    left: 0;
                    top: 2px;
                    color: var(--theme-color2);
                    font-size: 14px;
                }
                .edu-headers {
                    display: flex;
                    margin-bottom: 15px;
                    font-weight: 700;
                    font-size: 1.1rem;
                    color: var(--heading-color);
                }
                
                @media (max-width: 768px) {
                    .level-info-col, .level-classes-col {
                        flex: 0 0 100%;
                        max-width: 100%;
                        padding: 0;
                    }
                    .level-info-col {
                        margin-bottom: 10px;
                    }
                    .classes-list {
                        grid-template-columns: 1fr;
                    }
                    .edu-headers {
                        display: none;
                    }
                }
            </style>

            @if($campuses->isEmpty())
                <div class="text-center">
                    <p>{{ __('No education levels data available.') }}</p>
                </div>
            @endif

            @foreach($campuses as $campus)
                <div class="campus-banner">
                    <i class="fas fa-university"></i>
                    {{ $campus->name }}
                </div>

                @if($campus->levels->isNotEmpty())
                    <div class="edu-headers">
                        <div style="flex: 0 0 35%; max-width: 35%;">{{ __('Levels') }}</div>
                        <div style="flex: 0 0 65%; max-width: 65%;">{{ __('Classes/Departments') }}</div>
                    </div>

                    @foreach($campus->levels as $level)
                        <div class="level-row">
                            <div class="level-info-col">
                                <div class="level-info-box">
                                    <h4>{{ $level->name }}</h4>
                                    @if($level->description)
                                        <p>{{ $level->description }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="level-classes-col">
                                <div class="classes-box">
                                    @if($level->classes->isNotEmpty())
                                        <ul class="classes-list">
                                            @foreach($level->classes as $index => $class)
                                                <li>{{ $index + 1 }}. {{ $class->name }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="mb-0 text-muted">{{ __('No classes found for this level.') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">{{ __('No levels defined for this campus.') }}</p>
                @endif
            @endforeach

        </div>
    </div>
</main>
@endsection
