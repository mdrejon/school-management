@extends('frontend.layouts.app')

@section('title', $settings->exam_result_page_seo_title ?? 'Exam Result')
@section('meta_description', $settings->exam_result_page_seo_description)
@section('meta_keywords', $settings->exam_result_page_seo_keywords)

@section('content')

    <!-- breadcrumb -->
    <div class="wexnix_site-breadcrumb" @if($settings->exam_result_page_breadcrumb_image_url) style="background: url('{{ $settings->exam_result_page_breadcrumb_image_url }}')" @else style="background: url('{{ asset('frontend/assets/img/breadcrumb/01.jpg') }}')" @endif>
        <div class="container">
            <h2 class="wexnix_breadcrumb-title">{{ $settings->{{ __('exam_result_page_breadcrumb_title ?? \'Exam Result\' }}') }}</h2>
            <ul class="wexnix_breadcrumb-menu">
                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="active">{{ $settings->{{ __('exam_result_page_breadcrumb_title ?? \'Exam Result\' }}') }}</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- exam result search -->
    <div class="pt-80 pb-80">
        <div class="container">
            <div class="wexnix_search-filter-box bg-light p-4">
                <form action="#">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-6 col-lg-3">
                            <label class="wexnix_filter-label">{{ __('Exam') }} <span class="text-danger">*</span></label>
                            <select class="form-select">
                                <option>{{ __('Select One') }}</option>
                                <option>{{ __('Half Yearly Exam') }}</option>
                                <option>{{ __('Annual Exam') }}</option>
                                <option>{{ __('Test Exam') }}</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="wexnix_filter-label">{{ __('Class') }} <span class="text-danger">*</span></label>
                            <select class="form-select">
                                <option>{{ __('Select One') }}</option>
                                <option>{{ __('Class 6') }}</option>
                                <option>{{ __('Class 7') }}</option>
                                <option>{{ __('Class 8') }}</option>
                                <option>{{ __('Class 9') }}</option>
                                <option>{{ __('Class 10') }}</option>
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
                            <label class="wexnix_filter-label">{{ __('Roll No') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="{{ __('Enter Roll No') }}">
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="wexnix_theme-btn w-100 justify-content-center"><span class="fas fa-search"></span>{{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- exam result search end -->

@endsection
