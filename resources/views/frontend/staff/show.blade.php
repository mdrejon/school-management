@extends('frontend.layouts.app')

@section('title', $staff->name . ' - ' . config('app.name'))
@section('meta_description', $staff->designation ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $pageSettings?->breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $staff->name }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li><a href="{{ route('staff.index') }}">{{ $pageSettings?->title ?: 'Staff' }}</a></li>
                    <li class="active">{{ $staff->name }}</li>
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
                            <img loading="lazy" src="{{ $staff->photo_url ?? '/frontend/assets/img/team/01.jpg' }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="wexnix_team-details">
                            <h3>{{ $staff->name }}</h3>
                            @if ($staff->designation)
                                <strong>{{ $staff->designation }}</strong>
                            @endif
                            @if ($staff->address || $staff->email || $staff->phone || $staff->blood_group || $staff->joining_date || $staff->religion || $staff->gender)
                                <div class="wexnix_team-details-info mt-4">
                                    <ul>
                                        @if ($staff->address)
                                            <li><a href="#"><i class="fas fa-location-dot"></i> {{ $staff->address }}</a></li>
                                        @endif
                                        @if ($staff->email)
                                            <li><a href="mailto:{{ $staff->email }}"><i class="fas fa-envelope"></i> {{ $staff->email }}</a></li>
                                        @endif
                                        @if ($staff->phone)
                                            <li><a href="tel:{{ $staff->phone }}"><i class="fas fa-phone"></i> {{ $staff->phone }}</a></li>
                                        @endif
                                        @if ($staff->blood_group)
                                            <li><a href="#"><i class="fas fa-tint"></i> Blood Group: {{ $staff->blood_group }}</a></li>
                                        @endif
                                        @if ($staff->gender)
                                            <li><a href="#"><i class="fas fa-user"></i> Gender: {{ $staff->gender }}</a></li>
                                        @endif
                                        @if ($staff->religion)
                                            <li><a href="#"><i class="fas fa-praying-hands"></i> Religion: {{ $staff->religion }}</a></li>
                                        @endif
                                        @if ($staff->joining_date)
                                            <li><a href="#"><i class="fas fa-calendar-alt"></i> Joining Date: {{ $staff->joining_date->format('M d, Y') }}</a></li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- team single end -->

    </main>
@endsection
