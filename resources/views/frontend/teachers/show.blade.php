@extends('frontend.layouts.app')

@section('title', $teacher->name . ' - ' . config('app.name'))
@section('meta_description', $teacher->short_intro ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $pageSettings->breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $teacher->name }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('teachers.index') }}">{{ $pageSettings->breadcrumb_title ?: 'Teachers' }}</a></li>
                    <li class="active">{{ $teacher->name }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- team single -->
        <div class="wexnix_team-single pt-120 pb-80">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="wexnix_team-single-img">
                            <img src="{{ $teacher->photo_url ?? '/frontend/assets/img/team/01.jpg' }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="wexnix_team-details">
                            <h3>{{ $teacher->name }}</h3>
                            @if ($teacher->designation)
                                <strong>{{ $teacher->designation }}</strong>
                            @endif
                            @if ($teacher->short_intro)
                                <p class="mt-3">{{ $teacher->short_intro }}</p>
                            @endif
                            @if ($teacher->address || $teacher->email || $teacher->phone)
                                <div class="wexnix_team-details-info">
                                    <ul>
                                        @if ($teacher->address)
                                            <li><a href="#"><i class="fas fa-location-dot"></i> {{ $teacher->address }}</a></li>
                                        @endif
                                        @if ($teacher->email)
                                            <li><a href="mailto:{{ $teacher->email }}"><i class="fas fa-envelope"></i> {{ $teacher->email }}</a></li>
                                        @endif
                                        @if ($teacher->phone)
                                            <li><a href="tel:{{ $teacher->phone }}"><i class="fas fa-phone"></i> {{ $teacher->phone }}</a></li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                            @if ($teacher->facebook_url || $teacher->whatsapp_url || $teacher->behance_url || $teacher->pinterest_url || $teacher->linkedin_url)
                                <div class="wexnix_team-details-social">
                                    @if ($teacher->facebook_url)
                                        <a href="{{ $teacher->facebook_url }}" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                                    @endif
                                    @if ($teacher->whatsapp_url)
                                        <a href="{{ $teacher->whatsapp_url }}" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i></a>
                                    @endif
                                    @if ($teacher->behance_url)
                                        <a href="{{ $teacher->behance_url }}" target="_blank" rel="noopener"><i class="fab fa-behance"></i></a>
                                    @endif
                                    @if ($teacher->pinterest_url)
                                        <a href="{{ $teacher->pinterest_url }}" target="_blank" rel="noopener"><i class="fab fa-pinterest"></i></a>
                                    @endif
                                    @if ($teacher->linkedin_url)
                                        <a href="{{ $teacher->linkedin_url }}" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- team single end -->

        <!-- biography & skill -->
        @php $skills = $teacher->skillItems(); @endphp
        @if ($teacher->biography || count($skills))
            <div class="wexnix_biography-skil pb-120">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($teacher->biography)
                                <div class="wexnix_biography">
                                    <h4 class="mb-3">Biography</h4>
                                    <div class="mb-10">{!! $teacher->biography !!}</div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if (count($skills))
                                <div class="wexnix_team-skill">
                                    <h4 class="mb-3">Professional Skills</h4>
                                    <div class="wexnix_skills-section">
                                        @foreach ($skills as $skill)
                                            <div class="wexnix_progress-box">
                                                <h5>{{ $skill['label'] }} <span class="wexnix_pull-right">{{ $skill['percentage'] }}%</span></h5>
                                                <div class="progress" data-value="{{ $skill['percentage'] }}">
                                                    <div class="progress-bar" role="progressbar"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- biography & skill end -->

    </main>
@endsection
