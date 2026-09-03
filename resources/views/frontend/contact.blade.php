@extends('frontend.layouts.app')

@section('title', ($siteSettings->contact_page_seo_title ?: $siteSettings->contact_page_breadcrumb_title ?: 'Contact Us') . ' - ' . config('app.name'))
@section('meta_description', $siteSettings->contact_page_seo_description ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $siteSettings->contact_page_breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $siteSettings->{{ __('contact_page_breadcrumb_title ?: \'Contact Us\' }}') }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="active">{{ $siteSettings->{{ __('contact_page_breadcrumb_title ?: \'Contact Us\' }}') }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- contact area -->
        <div class="wexnix_contact-area py-120">
            <div class="container">
                <div class="wexnix_contact-content">
                    <div class="row">
                        @if ($siteSettings->{{ __('contact_address_value)') }}
                            <div class="col-md-3">
                                <div class="wexnix_contact-info">
                                    <div class="wexnix_contact-info-icon">
                                        <i class="fas fa-map-location-dot"></i>
                                    </div>
                                    <div class="wexnix_contact-info-content">
                                        <h5>{{ $siteSettings->{{ __('contact_address_label ?: \'Office Address\' }}') }}</h5>
                                        <p>{{ $siteSettings->{{ __('contact_address_value }}') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($siteSettings->{{ __('contact_phone_value)') }}
                            <div class="col-md-3">
                                <div class="wexnix_contact-info">
                                    <div class="wexnix_contact-info-icon">
                                        <i class="fas fa-phone-volume"></i>
                                    </div>
                                    <div class="wexnix_contact-info-content">
                                        <h5>{{ $siteSettings->{{ __('contact_phone_label ?: \'Call Us\' }}') }}</h5>
                                        <p>{{ $siteSettings->{{ __('contact_phone_value }}') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($siteSettings->{{ __('contact_email_value)') }}
                            <div class="col-md-3">
                                <div class="wexnix_contact-info">
                                    <div class="wexnix_contact-info-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="wexnix_contact-info-content">
                                        <h5>{{ $siteSettings->{{ __('contact_email_label ?: \'Email Us\' }}') }}</h5>
                                        <p>{{ $siteSettings->{{ __('contact_email_value }}') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($siteSettings->{{ __('contact_open_time)') }}
                            <div class="col-md-3">
                                <div class="wexnix_contact-info">
                                    <div class="wexnix_contact-info-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="wexnix_contact-info-content">
                                        <h5>{{ $siteSettings->{{ __('contact_open_time_label ?: \'Open Time\' }}') }}</h5>
                                        <p>{{ $siteSettings->{{ __('contact_open_time }}') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="wexnix_contact-wrapper">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="wexnix_contact-img">
                                <img src="{{ $siteSettings->contact_image_url ?? '/frontend/assets/img/contact/01.jpg' }}" alt="{{ $siteSettings->contact_form_title ?: 'Contact Us' }}">
                            </div>
                        </div>
                        <div class="col-lg-7 align-self-center">
                            <div class="wexnix_contact-form">
                                <div class="wexnix_contact-form-header">
                                    <h2>{{ $siteSettings->{{ __('contact_form_title ?: \'Get In Touch\' }}') }}</h2>
                                    @if ($siteSettings->{{ __('contact_form_description)') }}
                                        <p>{{ $siteSettings->{{ __('contact_form_description }}') }}</p>
                                    @endif
                                </div>
                                <form method="post" action="{{ route('contact.store') }}" id="contact-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="wexnix_form-group">
                                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="{{ __('Your Name') }}" required>
                                                @error('name')
                                                    <p class="text-danger small mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="wexnix_form-group">
                                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ __('Your Email') }}" required>
                                                @error('email')
                                                    <p class="text-danger small mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wexnix_form-group">
                                        <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" placeholder="{{ __('Your Subject') }}" required>
                                        @error('subject')
                                            <p class="text-danger small mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="wexnix_form-group">
                                        <textarea name="message" cols="30" rows="5" class="form-control" placeholder="{{ __('Write Your Message') }}">{{ old('message') }}</textarea>
                                        @error('message')
                                            <p class="text-danger small mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button type="submit" class="wexnix_theme-btn">{{ __('Send Message') }} <i class="fas fa-paper-plane"></i></button>
                                    <div class="col-md-12 mt-3">
                                        @if (session('success'))
                                            <div class="wexnix_form-messege text-success">{{ session('success') }}</div>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end contact area -->

        <!-- map -->
        @if ($siteSettings->{{ __('contact_map_embed_url)') }}
            <div class="wexnix_contact-map">
                <iframe src="{{ $siteSettings->contact_map_embed_url }}" style="border:0;" allowfullscreen loading="lazy"></iframe>
            </div>
        @endif

    </main>
@endsection
