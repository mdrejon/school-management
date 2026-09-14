@extends('frontend.layouts.app')

@section('title', ($pageSettings?->seo_title ?: 'Our Staff') . ' - ' . config('app.name'))
@section('meta_description', $pageSettings?->seo_description ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $pageSettings?->breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $pageSettings?->title ?: 'Staff' }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="active">{{ $pageSettings?->title ?: 'Staff' }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- team-area -->
        <div class="wexnix_team-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="wexnix_site-heading text-center">
                            <span class="wexnix_site-title-tagline"><i class="fas fa-users"></i> {{ __('Our Staff') }}</span>
                            <h2 class="wexnix_site-title">{{ $pageSettings?->title ?: 'Meet With Our Staff' }}</h2>
                        </div>
                    </div>
                </div>

                @if ($staffs->count())
                    <div class="row">
                        @foreach ($staffs as $staff)
                            @include('frontend.staff.partials.card', ['staff' => $staff])
                        @endforeach
                    </div>

                    <!-- pagination -->
                    {{ $staffs->links('frontend.pagination.wexnix') }}
                    <!-- pagination end -->
                @else
                    <p class="text-center">{{ __('No staff available right now — please check back soon.') }}</p>
                @endif
            </div>
        </div>
        <!-- team-area end -->

    </main>
@endsection
