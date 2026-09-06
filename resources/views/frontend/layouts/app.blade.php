<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ $currentLanguage?->direction ?? 'ltr' }}">

<head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', config('app.name') . ' - School Management')">
    <meta name="keywords" content="">

    <!-- title -->
    <title>@yield('title', config('app.name', 'School') . ' - Home')</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="/frontend/assets/img/logo/favicon.png">

    <!-- css -->
    <link rel="stylesheet" href="/frontend/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/frontend/assets/css/all-fontawesome.min.css">
    <link rel="stylesheet" href="/frontend/assets/css/animate.min.css">
    <link rel="stylesheet" href="/frontend/assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="/frontend/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/frontend/assets/css/style.css">

    {{-- Sizing/coloring for inline Lucide <svg> icons — the original theme's
         icon boxes only ever styled <img loading="lazy">, so these dynamic icon slots
         (counter strip, "Why Choose Us" feature boxes, course sidebar
         features) need their own rules. --}}
    <style>
        .wexnix_counter-box .wexnix_icon svg {
            width: 60px;
            height: 60px;
        }

        .wexnix_choose-item-icon svg {
            width: 45px;
            height: 45px;
            color: #fff;
        }

        .wexnix_course-feature-list a svg {
            width: 18px;
            height: 18px;
            color: var(--theme-color2);
            vertical-align: -4px;
            margin-right: 4px;
        }

        .wexnix_course-feature-list a img {
            width: 18px;
            height: 18px;
            vertical-align: -4px;
            margin-right: 4px;
        }
    </style>

    {{-- Language-specific font overrides --}}
    @if (app()->getLocale() === 'bn')
    {{--
            Bengali (Hind Siliguri) renders ~15-20% visually larger than Roboto/Yantramanav
            at the same px size because Bengali glyphs have greater height/weight.
            We load Hind Siliguri and scale every TEXT font-size to ~85% of its English
            equivalent so the visual density matches across both languages.
            Icon font-sizes (fa-icons) are intentionally left unchanged.
        --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap">
    <style>
        /* ── Font family ─────────────────────────────────────────── */
        :root {
            --body-font: 'Hind Siliguri', sans-serif;
            --heading-font: 'Hind Siliguri', sans-serif;
        }

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        li,
        td,
        th,
        label,
        span,
        a,
        button,
        input,
        textarea,
        select {
            font-family: 'Hind Siliguri', sans-serif !important;
        }

        /* ── Body (16px × 0.85 = 13.6 → 14px) ──────────────────── */
        body {
            font-size: 14px !important;
            line-height: 1.75 !important;
        }

        /* ── Generic headings (×0.85) ────────────────────────────── */
        /* h1: 40px → 34px */
        h1 {
            font-size: 34px !important;
        }

        /* h2: 35px → 30px */
        h2 {
            font-size: 30px !important;
        }

        /* h3: 28px → 24px */
        h3 {
            font-size: 24px !important;
        }

        /* h4: 22px → 19px */
        h4 {
            font-size: 19px !important;
        }

        /* h5: 18px → 15px */
        h5 {
            font-size: 15px !important;
        }

        /* h6: 16px → 14px */
        h6 {
            font-size: 14px !important;
        }

        /* ── Section title (.wexnix_site-title: 55px → 47px) ─────── */
        .wexnix_site-title {
            font-size: 47px !important;
        }

        /* tagline (18px → 15px) */
        .wexnix_site-title-tagline {
            font-size: 15px !important;
            letter-spacing: 2px !important;
        }

        /* ── Hero title (.wexnix_hero-title: 72px → 61px) ───────── */
        .wexnix_hero-single .wexnix_hero-content .wexnix_hero-title {
            font-size: 61px !important;
        }

        /* Responsive hero title (50px → 43px) */
        @media all and (max-width: 991px) {
            .wexnix_hero-single .wexnix_hero-content .wexnix_hero-title {
                font-size: 43px !important;
            }
        }

        @media all and (max-width: 767px) {
            .wexnix_hero-single .wexnix_hero-content .wexnix_hero-title {
                font-size: 34px !important;
            }
        }

        /* Hero sub-title (25px → 21px) */
        .wexnix_hero-single .wexnix_hero-content .wexnix_hero-sub-title {
            font-size: 21px !important;
            letter-spacing: 3px !important;
        }

        /* Hero paragraph (18px → 15px) */
        .wexnix_hero-single .wexnix_hero-content p {
            font-size: 15px !important;
        }

        /* ── Counter number (50px → 43px) ────────────────────────── */
        .wexnix_counter-box .wexnix_counter {
            font-size: 43px !important;
        }

        /* Counter label (20px → 17px) */
        .wexnix_counter-box .wexnix_title {
            font-size: 17px !important;
        }

        /* ── Choose / features item heading (21px → 18px) ────────── */
        .wexnix_choose-item-info h4 {
            font-size: 18px !important;
        }

        /* ── Navbar (14px → 13px) ────────────────────────────────── */
        .wexnix_main-navigation .nav-link {
            font-size: 13px !important;
        }
    </style>
    @endif

    @php
    $primaryColor = $siteSettings->primary_color ?? '#0054A5';
    $secondaryColor = $siteSettings->secondary_color ?? '#F26F21';
    $parsed = sscanf($primaryColor, "#%02x%02x%02x");
    $primaryRgb = $parsed && count($parsed) === 3 ? implode(', ', $parsed) : '0, 84, 165';
    @endphp
    <style>
        :root {
            --theme-color: {{ $primaryColor }} !important;
            --theme-color2: {{ $secondaryColor }} !important;
            --theme-color-light: rgba({{ $primaryRgb }}, 0.09) !important;
        }
        /* ── Navbar flex-wrap to allow long menus to wrap gracefully ──────────────── */
        @media (min-width: 992px) {
            .wexnix_main-navigation .navbar-nav {
                flex-wrap: wrap;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- preloader -->
    <div class="wexnix_preloader">
        <div class="wexnix_loader-book">
            <div class="wexnix_loader-book-page"></div>
            <div class="wexnix_loader-book-page"></div>
            <div class="wexnix_loader-book-page"></div>
        </div>
    </div>
    <!-- preloader end -->


    <!-- header area -->
    <header class="wexnix_header">
        <!-- header top -->
        <div class="wexnix_header-top">
            <div class="container">
                <div class="wexnix_header-top-wrap">
                    <div class="wexnix_header-top-left">
                        <div class="wexnix_header-top-social">
                            <span>{{ __('Follow Us:') }} </span>
                            @if ($siteSettings->facebook_url)
                            <a href="{{ $siteSettings->facebook_url }}" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                            @endif
                            @if ($siteSettings->instagram_url)
                            <a href="{{ $siteSettings->instagram_url }}" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
                            @endif
                            @if ($siteSettings->youtube_url)
                            <a href="{{ $siteSettings->youtube_url }}" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a>
                            @endif
                            @if ($siteSettings->whatsapp_url)
                            <a href="{{ $siteSettings->whatsapp_url }}" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="wexnix_header-top-right">
                        <div class="wexnix_header-top-contact">
                            <ul>
                                @if ($siteSettings->address)
                                <li>
                                    <a href="#"><i class="fas fa-location-dot"></i> {{ $siteSettings->address }}</a>
                                </li>
                                @endif
                                @if ($siteSettings->email)
                                <li>
                                    <a href="mailto:{{ $siteSettings->email }}"><i class="fas fa-envelope"></i> {{ $siteSettings->email }}</a>
                                </li>
                                @endif
                                @if ($siteSettings->phone)
                                <li>
                                    <a href="tel:{{ $siteSettings->phone }}"><i class="fas fa-phone-volume"></i> {{ $siteSettings->phone }}</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                        <div class="wexnix_header-lang">
                            @foreach ($languages as $lang)
                            <a href="{{ route('language.switch', $lang->code) }}" class="{{ app()->getLocale() === $lang->code ? 'active' : '' }}">{{ strtoupper($lang->code) }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- header middle -->
        <div class="wexnix_header-middle">
            <div class="container">
                <div class="wexnix_header-middle-wrap">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img loading="lazy" src="{{ $siteSettings->logo_url ?? '/frontend/assets/img/logo/logo.png' }}" alt="{{ $siteSettings->site_name }}">
                    </a>
                    <div class="wexnix_header-middle-right">
                        <form class="wexnix_header-search-form" action="{{ route('search') }}" method="GET">
                            <input type="search" name="q" placeholder="{{ __('Search Here...') }}">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                        <a href="application-form.html" class="wexnix_theme-btn"><span
                                class="fas fa-pencil"></span>{{ __('Apply Now') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- header middle end -->

        <div class="wexnix_main-navigation">
            <nav class="navbar navbar-expand-lg">
                <div class="container position-relative">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="wexnix_navbar-toggler-mobile-icon"><i class="fas fa-bars"></i></span>
                    </button>
                    <div class="collapse navbar-collapse" id="main_nav">
                        <ul class="navbar-nav">
                            @foreach ($headerMenuItems as $item)
                            @include('frontend.partials.menu-item', ['item' => $item, 'depth' => 0])
                            @endforeach
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <!-- notice marquee -->
        @if (\App\Models\ModuleSetting::isEnabled('notices') && $marqueeNotices->count())
        <div class="wexnix_notice-marquee">
            <div class="container">
                <div class="wexnix_notice-marquee-wrap">
                    <span class="wexnix_notice-label">{{ $noticePageSettings->marquee_label ?: 'Notice' }}</span>
                    <div class="wexnix_marquee-viewport">
                        <div class="wexnix_marquee-track">
                            @foreach ($marqueeNotices as $notice)
                            <span><a href="{{ route('notices.show', $notice) }}">{{ $notice->title }}</a></span>
                            @endforeach
                            @foreach ($marqueeNotices as $notice)
                            <span><a href="{{ route('notices.show', $notice) }}">{{ $notice->title }}</a></span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- notice marquee end -->
    </header>
    <!-- header area end -->


    <!-- popup search -->
    <div class="wexnix_search-popup">
        <button class="wexnix_close-search"><span class="fas fa-times"></span></button>
        <form action="{{ route('search') }}" method="GET">
            <div class="wexnix_form-group">
                <input type="search" name="q" placeholder="{{ __('Search Here...') }}" required>
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
    <!-- popup search end -->



    @yield('content')



    <!-- footer area -->
    <footer class="wexnix_footer-area">
        <div class="wexnix_footer-shape">
            <img loading="lazy" src="/frontend/assets/img/shape/03.png" alt="">
        </div>
        <div class="wexnix_footer-widget">
            <div class="container">
                <div class="row wexnix_footer-widget-wrapper pt-100 pb-70">
                    <div class="col-md-6 col-lg-4">
                        <div class="wexnix_footer-widget-box wexnix_about-us">
                            <a href="{{ route('home') }}" class="wexnix_footer-logo">
                                <img loading="lazy" src="{{ $siteSettings->footer_logo_url ?? '/frontend/assets/img/logo/logo-light.png' }}" alt="{{ $siteSettings->site_name }}">
                            </a>
                            @if ($siteSettings->footer_about)
                            <p class="mb-3">
                                {{ $siteSettings->footer_about }}
                            </p>
                            @endif
                            <ul class="wexnix_footer-contact">
                                @if ($siteSettings->phone)
                                <li><a href="tel:{{ $siteSettings->phone }}"><i class="fas fa-phone"></i>{{ $siteSettings->phone }}</a></li>
                                @endif
                                @if ($siteSettings->address)
                                <li><i class="fas fa-map-marker-alt"></i>{{ $siteSettings->address }}</li>
                                @endif
                                @if ($siteSettings->email)
                                <li><a href="mailto:{{ $siteSettings->email }}"><i
                                            class="fas fa-envelope"></i>{{ $siteSettings->email }}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="wexnix_footer-widget-box wexnix_list">
                            <h4 class="wexnix_footer-widget-title">{{ $siteSettings->footer_quick_links_title ?: 'Quick Links' }}</h4>
                            <ul class="wexnix_footer-list">
                                @foreach ($siteSettings->footerQuickLinkItems() as $link)
                                <li><a href="{{ $link['url'] }}"><i class="fas fa-caret-right"></i> {{ $link['label'] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="wexnix_footer-widget-box wexnix_list">
                            <h4 class="wexnix_footer-widget-title">{{ $siteSettings->footer_campus_title ?: 'Our Campus' }}</h4>
                            <ul class="wexnix_footer-list">
                                @foreach ($siteSettings->footerCampusLinkItems() as $link)
                                <li><a href="{{ $link['url'] }}"><i class="fas fa-caret-right"></i> {{ $link['label'] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="wexnix_footer-widget-box wexnix_list">
                            <h4 class="wexnix_footer-widget-title">{{ $siteSettings->footer_newsletter_title ?: 'Newsletter' }}</h4>
                            <div class="wexnix_footer-newsletter">
                                <p>{{ $siteSettings->footer_newsletter_text ?: 'Subscribe Our Newsletter To Get Latest Update And News' }}</p>
                                <div class="wexnix_subscribe-form">
                                    <form action="#">
                                        <input type="email" class="form-control" placeholder="{{ __('Your Email') }}">
                                        <button class="wexnix_theme-btn" type="submit">
                                            {{ __('Subscribe Now') }} <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wexnix_copyright">
            <div class="container">
                <div class="wexnix_copyright-wrapper">
                    <div class="row">
                        <div class="col-md-6 align-self-center">
                            <p class="wexnix_copyright-text">
                                &copy; Copyright <span id="date"></span> <a href="{{ route('home') }}"> {{ $siteSettings->site_name }} </a> {{ $siteSettings->copyright_text ?? 'All Rights Reserved.' }}
                            </p>
                        </div>
                        <div class="col-md-6 align-self-center">
                            <ul class="wexnix_footer-social">
                                @if ($siteSettings->facebook_url)
                                <li><a href="{{ $siteSettings->facebook_url }}" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a></li>
                                @endif
                                @if ($siteSettings->linkedin_url)
                                <li><a href="{{ $siteSettings->linkedin_url }}" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a></li>
                                @endif
                                @if ($siteSettings->whatsapp_url)
                                <li><a href="{{ $siteSettings->whatsapp_url }}" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i></a></li>
                                @endif
                                @if ($siteSettings->youtube_url)
                                <li><a href="{{ $siteSettings->youtube_url }}" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->


    <!-- scroll-top -->
    <a href="#" id="scroll-top"><i class="fas fa-arrow-up"></i></a>
    <!-- scroll-top end -->


    <!-- js -->
    <script src="/frontend/assets/js/jquery-3.7.1.min.js"></script>
    <script src="/frontend/assets/js/modernizr.min.js"></script>
    <script src="/frontend/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/frontend/assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="/frontend/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/frontend/assets/js/isotope.pkgd.min.js"></script>
    <script src="/frontend/assets/js/jquery.appear.min.js"></script>
    <script src="/frontend/assets/js/jquery.easing.min.js"></script>
    <script src="/frontend/assets/js/owl.carousel.min.js"></script>
    <script src="/frontend/assets/js/counter-up.js"></script>
    <script src="/frontend/assets/js/wow.min.js"></script>
    <script src="/frontend/assets/js/main.js"></script>

    @stack('scripts')
</body>