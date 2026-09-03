@extends('frontend.layouts.app')

@section('title', $settings->academic_result_page_seo_title ?? 'Academic Result')
@section('meta_description', $settings->academic_result_page_seo_description)
@section('meta_keywords', $settings->academic_result_page_seo_keywords)

@section('content')

    <!-- breadcrumb -->
    <div class="wexnix_site-breadcrumb" @if($settings->academic_result_page_breadcrumb_image_url) style="background: url('{{ $settings->academic_result_page_breadcrumb_image_url }}')" @else style="background: url('{{ asset('frontend/assets/img/breadcrumb/01.jpg') }}')" @endif>
        <div class="container">
            <h2 class="wexnix_breadcrumb-title">{{ $settings->{{ __('academic_result_page_breadcrumb_title ?? \'Academic Result\' }}') }}</h2>
            <ul class="wexnix_breadcrumb-menu">
                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="active">{{ $settings->{{ __('academic_result_page_breadcrumb_title ?? \'Academic Result\' }}') }}</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- academic result search -->
    <div class="pt-80 pb-80">
        <div class="container">
            <div class="wexnix_search-filter-box bg-light p-4">
                <form action="#">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-6 col-lg-4">
                            <label class="wexnix_filter-label">{{ __('Exam &amp; Session') }} <span class="text-danger">*</span></label>
                            <select class="form-select">
                                <option>{{ __('Select A Class, Exam &amp; Session') }}</option>
                                <option>{{ __('Class 6 - Annual Exam - 2026') }}</option>
                                <option>{{ __('Class 7 - Annual Exam - 2026') }}</option>
                                <option>{{ __('Class 8 - Annual Exam - 2026') }}</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <label class="wexnix_filter-label">{{ __('Section') }}</label>
                            <select class="form-select">
                                <option>{{ __('Select One') }}</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <label class="wexnix_filter-label">{{ __('Group') }}</label>
                            <select class="form-select">
                                <option>{{ __('Select One') }}</option>
                                <option>{{ __('Science') }}</option>
                                <option>{{ __('Business Studies') }}</option>
                                <option>{{ __('Humanities') }}</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <label class="wexnix_filter-label">{{ __('Roll No') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="wexnix_theme-btn w-100 justify-content-center"><span class="fas fa-search"></span>{{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- academic result search end -->

@endsection
