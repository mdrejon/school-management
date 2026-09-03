@extends('frontend.layouts.app')

@section('title', $settings->board_exam_result_page_seo_title ?? 'Board Exam Result')
@section('meta_description', $settings->board_exam_result_page_seo_description)
@section('meta_keywords', $settings->board_exam_result_page_seo_keywords)

@section('content')

    <!-- breadcrumb -->
    <div class="wexnix_site-breadcrumb" @if($settings->board_exam_result_page_breadcrumb_image_url) style="background: url('{{ $settings->board_exam_result_page_breadcrumb_image_url }}')" @else style="background: url('{{ asset('frontend/assets/img/breadcrumb/01.jpg') }}')" @endif>
        <div class="container">
            <h2 class="wexnix_breadcrumb-title">{{ $settings->{{ __('board_exam_result_page_breadcrumb_title ?? \'Board Exam Result\' }}') }}</h2>
            <ul class="wexnix_breadcrumb-menu">
                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="active">{{ $settings->{{ __('board_exam_result_page_breadcrumb_title ?? \'Board Exam Result\' }}') }}</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- board exam result search -->
    <div class="pt-80 pb-80">
        <div class="container">
            <div class="wexnix_site-heading text-center mb-4">
                <h2 class="wexnix_site-title">{{ __('Board Exam') }} <span>{{ __('Result') }}</span></h2>
            </div>
            <div class="wexnix_search-filter-box bg-light p-4">
                <form action="#">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-6 col-lg-4">
                            <label class="wexnix_filter-label">{{ __('Board Exam') }} <span class="text-danger">*</span></label>
                            <select class="form-select">
                                <option>{{ __('Select One') }}</option>
                                <option>{{ __('SSC') }}</option>
                                <option>{{ __('JSC') }}</option>
                                <option>{{ __('HSC') }}</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="wexnix_filter-label">{{ __('Year') }} <span class="text-danger">*</span></label>
                            <select class="form-select">
                                <option>{{ __('Select One') }}</option>
                                <option>2026</option>
                                <option>2025</option>
                                <option>2024</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <button type="reset" class="btn btn-danger text-white w-100"><i class="fas fa-rotate"></i> {{ __('Reset') }}</button>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <button type="submit" class="btn btn-success text-white w-100"><i class="fas fa-search"></i> {{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- board exam result search end -->

@endsection
