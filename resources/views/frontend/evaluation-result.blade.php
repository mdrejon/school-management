@extends('frontend.layouts.app')

@section('title', $settings->evaluation_result_page_seo_title ?? 'Evaluation Result')
@section('meta_description', $settings->evaluation_result_page_seo_description)
@section('meta_keywords', $settings->evaluation_result_page_seo_keywords)

@section('content')

    <!-- breadcrumb -->
    <div class="wexnix_site-breadcrumb" @if($settings->evaluation_result_page_breadcrumb_image_url) style="background: url('{{ $settings->evaluation_result_page_breadcrumb_image_url }}')" @else style="background: url('{{ asset('frontend/assets/img/breadcrumb/01.jpg') }}')" @endif>
        <div class="container">
            <h2 class="wexnix_breadcrumb-title">{{ $settings->evaluation_result_page_breadcrumb_title ?? 'Evaluation Result' }}</h2>
            <ul class="wexnix_breadcrumb-menu">
                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="active">{{ $settings->evaluation_result_page_breadcrumb_title ?? 'Evaluation Result' }}</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- evaluation result search -->
    <div class="pt-80 pb-80">
        <div class="container">
            <div class="wexnix_site-heading text-center mb-4">
                <h2 class="wexnix_site-title">{{ __('Evaluation') }} <span>{{ __('Result') }}</span></h2>
            </div>
            <div class="wexnix_search-filter-box bg-light p-4">
                <form action="#">
                    <div class="row g-3">
                        <div class="col-md-6 col-lg-3">
                            <label class="wexnix_filter-label">{{ __('Session') }} <span class="text-danger">*</span></label>
                            <select class="form-select">
                                <option>{{ __('Select One') }}</option>
                                <option>2026</option>
                                <option>2025</option>
                                <option>2024</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="wexnix_filter-label">{{ __('Class') }} <span class="text-danger">*</span></label>
                            <select class="form-select">
                                <option>{{ __('Select Class') }}</option>
                                <option>{{ __('Class 6') }}</option>
                                <option>{{ __('Class 7') }}</option>
                                <option>{{ __('Class 8') }}</option>
                                <option>{{ __('Class 9') }}</option>
                                <option>{{ __('Class 10') }}</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="wexnix_filter-label">{{ __('Exam') }} <span class="text-danger">*</span></label>
                            <select class="form-select">
                                <option>{{ __('Select Exam') }}</option>
                                <option>{{ __('Half Yearly Exam') }}</option>
                                <option>{{ __('Annual Exam') }}</option>
                                <option>{{ __('Test Exam') }}</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="wexnix_filter-label">{{ __('Subject') }}</label>
                            <select class="form-select">
                                <option>{{ __('Select Subject') }}</option>
                                <option>{{ __('Bangla') }}</option>
                                <option>{{ __('English') }}</option>
                                <option>{{ __('Mathematics') }}</option>
                                <option>{{ __('Science') }}</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="wexnix_filter-label">{{ __('Indicator') }} <span class="text-danger">*</span></label>
                            <select class="form-select">
                                <option>{{ __('Select Indicator') }}</option>
                                <option>{{ __('Class Test') }}</option>
                                <option>{{ __('Assignment') }}</option>
                                <option>{{ __('Attendance') }}</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3">
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
                            <label class="wexnix_filter-label">{{ __('Student ID') }}</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <label class="wexnix_filter-label">{{ __('Roll No') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-6 col-lg-3 d-flex align-items-end">
                            <button type="reset" class="btn btn-danger text-white w-50 me-2"><i class="fas fa-rotate"></i> {{ __('Reset') }}</button>
                            <button type="submit" class="btn btn-success text-white w-50"><i class="fas fa-search"></i> {{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- evaluation result search end -->

@endsection
