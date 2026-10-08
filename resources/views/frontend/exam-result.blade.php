@extends('frontend.layouts.app')

@section('title', $settings->exam_result_page_seo_title ?? 'Exam Result')
@section('meta_description', $settings->exam_result_page_seo_description)
@section('meta_keywords', $settings->exam_result_page_seo_keywords)

@section('content')

    <!-- breadcrumb -->
    <div class="wexnix_site-breadcrumb" @if($settings->exam_result_page_breadcrumb_image_url) style="background: url('{{ $settings->exam_result_page_breadcrumb_image_url }}')" @else style="background: url('{{ asset('frontend/assets/img/breadcrumb/01.jpg') }}')" @endif>
        <div class="container">
            <h2 class="wexnix_breadcrumb-title">{{ $settings->exam_result_page_breadcrumb_title ?? __('Exam Result') }}</h2>
            <ul class="wexnix_breadcrumb-menu">
                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="active">{{ $settings->exam_result_page_breadcrumb_title ?? __('Exam Result') }}</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- exam result search & view area -->
    <div class="pt-80 pb-80">
        <div class="container">
            <!-- Search Form Box -->
            <div class="wexnix_search-filter-box bg-light p-4 rounded shadow-sm mb-5">
                <form action="{{ route('results') }}" method="GET">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-6 col-lg-3">
                            <label class="wexnix_filter-label fw-bold">{{ __('Examination') }} <span class="text-danger">*</span></label>
                            <select name="exam_id" class="form-select" required>
                                <option value="">{{ __('Select Examination') }}</option>
                                @foreach ($exams as $exam)
                                    <option value="{{ $exam->id }}" {{ (string)request('exam_id') === (string)$exam->id || request('exam_id') === $exam->name ? 'selected' : '' }}>
                                        {{ $exam->name }} {{ $exam->academic_year ? "({$exam->academic_year})" : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="wexnix_filter-label fw-bold">{{ __('Class') }} <span class="text-danger">*</span></label>
                            <select name="class_id" class="form-select" required>
                                <option value="">{{ __('Select Class') }}</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" {{ (string)request('class_id') === (string)$class->id || request('class_id') === $class->name ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <label class="wexnix_filter-label fw-bold">{{ __('Section') }}</label>
                            <select name="section" class="form-select">
                                <option value="">{{ __('All Sections') }}</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->name }}" {{ request('section') === $section->name ? 'selected' : '' }}>
                                        {{ $section->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <label class="wexnix_filter-label fw-bold">{{ __('Roll No') }} <span class="text-danger">*</span></label>
                            <input type="text" name="roll_no" value="{{ request('roll_no') }}" class="form-control" placeholder="{{ __('Enter Roll No') }}" required>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="wexnix_theme-btn w-100 justify-content-center py-2">
                                <span class="fas fa-search me-1"></span> {{ __('Search') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- If Not Found Alert -->
            @if ($hasSearched && !$searchResult)
                <div class="alert alert-warning text-center p-4 rounded shadow-sm">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning mb-2 d-block"></i>
                    <h5 class="fw-bold mb-1">{{ __('No Result Found') }}</h5>
                    <p class="mb-0 text-muted">{{ __('No published result matches the provided Roll Number, Exam, or Class. Please verify your information and try again.') }}</p>
                </div>
            @endif

            <!-- Marksheet Display Card -->
            @if ($searchResult)
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden print-area">
                    <!-- Marksheet Header -->
                    <div class="card-header bg-primary text-white p-4 text-center">
                        <h3 class="fw-bold text-white mb-1">{{ config('app.name', 'School Management') }}</h3>
                        <h5 class="text-white-50 mb-0">{{ $searchResult->exam_name }} {{ $searchResult->academic_year ? "- {$searchResult->academic_year}" : '' }}</h5>
                        <span class="badge bg-light text-primary mt-2 px-3 py-1 fs-6">{{ __('Academic Transcript / Marksheet') }}</span>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <!-- Student Profile Summary -->
                        <div class="row g-3 mb-4 p-3 bg-light rounded-3">
                            <div class="col-sm-6 col-md-4">
                                <span class="text-muted small d-block">{{ __('Student Name') }}</span>
                                <strong class="fs-6 text-dark">{{ $searchResult->student_name }}</strong>
                            </div>
                            <div class="col-sm-6 col-md-2">
                                <span class="text-muted small d-block">{{ __('Roll No') }}</span>
                                <strong class="fs-6 text-dark">{{ $searchResult->roll_no }}</strong>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <span class="text-muted small d-block">{{ __('Registration No') }}</span>
                                <strong class="fs-6 text-dark">{{ $searchResult->registration_no ?: '-' }}</strong>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <span class="text-muted small d-block">{{ __('Class & Section') }}</span>
                                <strong class="fs-6 text-dark">{{ $searchResult->class_name }} {{ $searchResult->section_name ? "({$searchResult->section_name})" : '' }}</strong>
                            </div>
                            @if ($searchResult->group_name)
                                <div class="col-sm-6 col-md-4">
                                    <span class="text-muted small d-block">{{ __('Group') }}</span>
                                    <strong class="fs-6 text-dark">{{ $searchResult->group_name }}</strong>
                                </div>
                            @endif
                            @if ($searchResult->merit_position)
                                <div class="col-sm-6 col-md-4">
                                    <span class="text-muted small d-block">{{ __('Merit Position') }}</span>
                                    <strong class="fs-6 text-primary">{{ $searchResult->merit_position }}</strong>
                                </div>
                            @endif
                        </div>

                        <!-- Subjects Breakdown Table -->
                        @if (!empty($searchResult->subjects_data) && is_array($searchResult->subjects_data))
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered table-hover align-middle mb-0 text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Code') }}</th>
                                            <th class="text-start">{{ __('Subject Name') }}</th>
                                            <th>{{ __('Written') }}</th>
                                            <th>{{ __('MCQ') }}</th>
                                            <th>{{ __('Total Marks') }}</th>
                                            <th>{{ __('Grade') }}</th>
                                            <th>{{ __('Grade Point') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($searchResult->subjects_data as $index => $subject)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $subject['code'] ?? '-' }}</td>
                                                <td class="text-start fw-semibold">{{ $subject['name'] ?? 'Subject' }}</td>
                                                <td>{{ isset($subject['written']) ? $subject['written'] : '-' }}</td>
                                                <td>{{ isset($subject['mcq']) ? $subject['mcq'] : '-' }}</td>
                                                <td class="fw-bold">{{ $subject['total'] ?? ($subject['marks'] ?? '-') }}</td>
                                                <td>
                                                    <span class="badge {{ in_array($subject['grade'] ?? '', ['A+', 'A', 'A-']) ? 'bg-success' : (($subject['grade'] ?? '') === 'F' ? 'bg-danger' : 'bg-primary') }} px-2 py-1">
                                                        {{ $subject['grade'] ?? '-' }}
                                                    </span>
                                                </td>
                                                <td>{{ isset($subject['point']) ? number_format((float)$subject['point'], 2) : '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                        <!-- Overall Summary Result Box -->
                        <div class="row g-3 align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
                            <div class="col-md-8">
                                <div class="d-flex flex-wrap gap-4 align-items-center">
                                    @if ($searchResult->obtained_marks)
                                        <div>
                                            <span class="text-muted small d-block">{{ __('Total Marks') }}</span>
                                            <strong class="fs-5">{{ $searchResult->obtained_marks }}</strong>
                                        </div>
                                    @endif
                                    @if ($searchResult->gpa)
                                        <div>
                                            <span class="text-muted small d-block">{{ __('GPA') }}</span>
                                            <strong class="fs-4 text-success">{{ number_format((float)$searchResult->gpa, 2) }}</strong>
                                        </div>
                                    @endif
                                    @if ($searchResult->grade)
                                        <div>
                                            <span class="text-muted small d-block">{{ __('Overall Grade') }}</span>
                                            <span class="badge bg-success fs-6 px-3 py-1">{{ $searchResult->grade }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <span class="text-muted small d-block">{{ __('Status') }}</span>
                                        <span class="badge {{ $searchResult->status === 'PASSED' ? 'bg-success' : 'bg-danger' }} fs-6 px-3 py-1">
                                            {{ $searchResult->status }}
                                        </span>
                                    </div>
                                </div>
                                @if ($searchResult->remarks)
                                    <p class="text-muted small mt-2 mb-0"><strong>{{ __('Remarks') }}:</strong> {{ $searchResult->remarks }}</p>
                                @endif
                            </div>
                            <div class="col-md-4 text-md-end d-flex flex-wrap gap-2 justify-content-md-end no-print">
                                <button type="button" onclick="window.print()" class="btn btn-outline-secondary">
                                    <i class="fas fa-print me-1"></i> {{ __('Print') }}
                                </button>
                                @if ($searchResult->download_url)
                                    <a href="{{ $searchResult->download_url }}" target="_blank" class="wexnix_theme-btn py-2">
                                        <i class="fas fa-file-pdf me-1"></i> {{ __('Download Marksheet') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            @endif

        </div>
    </div>
    <!-- exam result search & view area end -->

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .print-area, .print-area * {
                visibility: visible;
            }
            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .no-print, .wexnix_site-breadcrumb, header, footer {
                display: none !important;
            }
        }
    </style>

@endsection
