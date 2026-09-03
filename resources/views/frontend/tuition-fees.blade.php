@extends('frontend.layouts.app')

@section('title', $settings->tuition_fee_page_seo_title ?? 'Tuition Fees')
@section('meta_description', $settings->tuition_fee_page_seo_description)
@section('meta_keywords', $settings->tuition_fee_page_seo_keywords)

@section('content')

    <!-- breadcrumb -->
    <div class="wexnix_site-breadcrumb" @if($settings->tuition_fee_page_breadcrumb_image_url) style="background: url('{{ $settings->tuition_fee_page_breadcrumb_image_url }}')" @endif>
        <div class="container">
            <h2 class="wexnix_breadcrumb-title">{{ $settings->{{ __('tuition_fee_page_breadcrumb_title ?? \'Tuition Fees\' }}') }}</h2>
            <ul class="wexnix_breadcrumb-menu">
                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="active">{{ $settings->{{ __('tuition_fee_page_breadcrumb_title ?? \'Tuition Fees\' }}') }}</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- tuition fee -->
    <div class="wexnix_tuition-fee py-120">
        <div class="container">
            <div class="wexnix_tuition-wrap">
                {!! $settings->{{ __('tuition_fee_page_content !!}') }}
            </div>
        </div>
    </div>
    <!-- tuition fee end -->

@endsection
