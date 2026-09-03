@extends('frontend.layouts.app')

@section('title', ($pageSettings->seo_title ?: $pageSettings->breadcrumb_title ?: "Faq's") . ' - ' . config('app.name'))
@section('meta_description', $pageSettings->seo_description ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $pageSettings->breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $pageSettings->{{ __('breadcrumb_title ?: "Faq\'s" }}') }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="active">{{ $pageSettings->{{ __('breadcrumb_title ?: "Faq\'s" }}') }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- faq area -->
        <div class="wexnix_faq-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="wexnix_faq-right">
                            @if ($pageSettings->section_title)
                                @php
                                    $titleHtml = e($pageSettings->section_title);
                                    if (! empty($pageSettings->section_highlight)) {
                                        $titleHtml = str_ireplace(e($pageSettings->{{ __('section_highlight), \'') }}<span>' . e($pageSettings->{{ __('section_highlight) . \'') }}</span>', $titleHtml);
                                    }
                                @endphp
                                <div class="wexnix_site-heading mb-3">
                                    @if ($pageSettings->{{ __('section_tagline)') }}
                                        <span class="wexnix_site-title-tagline justify-content-start"><i class="fas fa-book-open-reader"></i> {{ $pageSettings->{{ __('section_tagline }}') }}</span>
                                    @endif
                                    <h2 class="wexnix_site-title my-3">{!! $titleHtml !!}</h2>
                                </div>
                            @endif
                            @if ($pageSettings->{{ __('section_description)') }}
                                <p class="mb-4">{{ $pageSettings->{{ __('section_description }}') }}</p>
                            @endif
                            @if ($pageSettings->cta_button_text && $pageSettings->{{ __('cta_button_url)') }}
                                <a href="{{ $pageSettings->cta_button_url }}" class="wexnix_theme-btn mt-2">{{ $pageSettings->{{ __('cta_button_text }}') }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        @if ($faqs->{{ __('count())') }}
                            <div class="accordion" id="wexnixFaqAccordion">
                                @foreach ($faqs as $faq)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                            <button
                                                class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $faq->id }}"
                                                aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                                aria-controls="collapse{{ $faq->id }}"
                                            >
                                                <span><i class="fas fa-question"></i></span> {{ $faq->{{ __('question }}') }}
                                            </button>
                                        </h2>
                                        <div
                                            id="collapse{{ $faq->id }}"
                                            class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                            aria-labelledby="heading{{ $faq->id }}"
                                            data-bs-parent="#wexnixFaqAccordion"
                                        >
                                            <div class="accordion-body">
                                                {{ $faq->{{ __('answer }}') }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>{{ __('No frequently asked questions available right now — please check back soon.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- faq area end -->

    </main>
@endsection
