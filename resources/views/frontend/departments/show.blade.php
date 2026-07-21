@extends('frontend.layouts.app')

@section('title', $department->title . ' - ' . config('app.name'))
@section('meta_description', $department->short_description ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $pageSettings->breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $department->title }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('departments.index') }}">{{ $pageSettings->breadcrumb_title ?: 'Academics Department' }}</a></li>
                    <li class="active">{{ $department->title }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- department-single -->
        <div class="wexnix_department-single-area py-120">
            <div class="container">
                <div class="wexnix_department-single-wrapper">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4">
                            <div class="wexnix_department-sidebar">
                                @if ($otherDepartments->count())
                                    <div class="wexnix_widget wexnix_category">
                                        <h4 class="wexnix_widget-title">Our Departments</h4>
                                        <div class="wexnix_category-list">
                                            @foreach ($otherDepartments as $other)
                                                <a href="{{ route('departments.show', $other) }}"><i class="fas fa-long-arrow-right"></i>{{ $other->title }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @php $downloads = $department->downloadItems(); @endphp
                                @if (count($downloads))
                                    <div class="wexnix_widget wexnix_department-download">
                                        <h4 class="wexnix_widget-title">Download</h4>
                                        @foreach ($downloads as $download)
                                            <a href="{{ $download['file_url'] }}" target="_blank" rel="noopener"><i class="fas fa-file-pdf"></i> {{ $download['label'] }}</a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8">
                            <div class="wexnix_department-details">
                                @if ($department->image_url)
                                    <div class="wexnix_department-details-img mb-30">
                                        <img src="{{ $department->image_url }}" alt="thumb">
                                    </div>
                                @endif
                                <div class="wexnix_department-details">
                                    <h3 class="mb-20">{{ $department->title }}</h3>
                                    @if ($department->description)
                                        <div class="mb-20">{!! $department->description !!}</div>
                                    @endif

                                    @if ($department->gallery_image_1_url || $department->gallery_image_2_url)
                                        <div class="row">
                                            @if ($department->gallery_image_1_url)
                                                <div class="col-md-6 mb-20">
                                                    <img src="{{ $department->gallery_image_1_url }}" alt="">
                                                </div>
                                            @endif
                                            @if ($department->gallery_image_2_url)
                                                <div class="col-md-6 mb-20">
                                                    <img src="{{ $department->gallery_image_2_url }}" alt="">
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    @php $requirementItems = $department->requirementItems(); @endphp
                                    @if ($department->requirement_title || count($requirementItems))
                                        <div class="my-4">
                                            @if ($department->requirement_title)
                                                <div class="mb-3">
                                                    <h3 class="mb-3">{{ $department->requirement_title }}</h3>
                                                </div>
                                            @endif
                                            @if (count($requirementItems))
                                                <ul class="wexnix_department-single-list">
                                                    @foreach ($requirementItems as $item)
                                                        <li><i class="fas fa-check"></i>{{ $item }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- department-single end-->

    </main>
@endsection
