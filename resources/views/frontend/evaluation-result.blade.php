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
                <h2 class="wexnix_site-title">Evaluation <span>Result</span></h2>
            </div>
            <div class="wexnix_search-filter-box bg-light p-4">
                <form action="#">
                    <div class="row g-3">
                        <div class="col-md-6 col-lg-3">
                            <label class="wexnix_filter-label">Session <span class="text-danger">*</span></label>
                            <select class="form-select">
                                <option>Select One</option>
                                <option>2026</option>
                                <option>2025</option>
                                <option>2024</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="wexnix_filter-label">Class <span class="text-danger">*</span></label>
                            <select class="form-select">
                                <option>Select Class</option>
                                <option>Class 6</option>
                                <option>Class 7</option>
                                <option>Class 8</option>
                                <option>Class 9</option>
                                <option>Class 10</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="wexnix_filter-label">Exam <span class="text-danger">*</span></label>
                            <select class="form-select">
                                <option>Select Exam</option>
                                <option>Half Yearly Exam</option>
                                <option>Annual Exam</option>
                                <option>Test Exam</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="wexnix_filter-label">Subject</label>
                            <select class="form-select">
                                <option>Select Subject</option>
                                <option>Bangla</option>
                                <option>English</option>
                                <option>Mathematics</option>
                                <option>Science</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="wexnix_filter-label">Indicator <span class="text-danger">*</span></label>
                            <select class="form-select">
                                <option>Select Indicator</option>
                                <option>Class Test</option>
                                <option>Assignment</option>
                                <option>Attendance</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="wexnix_filter-label">Section</label>
                            <select class="form-select">
                                <option>Select One</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <label class="wexnix_filter-label">Group</label>
                            <select class="form-select">
                                <option>Select One</option>
                                <option>Science</option>
                                <option>Business Studies</option>
                                <option>Humanities</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <label class="wexnix_filter-label">Student ID</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <label class="wexnix_filter-label">Roll No <span class="text-danger">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-6 col-lg-3 d-flex align-items-end">
                            <button type="reset" class="btn btn-danger text-white w-50 me-2"><i class="fas fa-rotate"></i> Reset</button>
                            <button type="submit" class="btn btn-success text-white w-50"><i class="fas fa-search"></i> Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- evaluation result search end -->

@endsection
