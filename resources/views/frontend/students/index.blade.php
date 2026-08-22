@extends('frontend.layouts.app')

@section('title', $settings->student_list_page_seo_title ?? 'Student List')
@section('meta_description', $settings->student_list_page_seo_description)
@section('meta_keywords', $settings->student_list_page_seo_keywords)

@section('content')

    <!-- breadcrumb -->
    <div class="wexnix_site-breadcrumb" @if($settings->student_list_page_breadcrumb_image_url) style="background: url('{{ $settings->student_list_page_breadcrumb_image_url }}')" @endif>
        <div class="container">
            <h2 class="wexnix_breadcrumb-title">{{ $settings->student_list_page_breadcrumb_title ?? 'Student List' }}</h2>
            <ul class="wexnix_breadcrumb-menu">
                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="active">{{ $settings->student_list_page_breadcrumb_title ?? 'Student List' }}</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- student list search -->
    <div class="pt-80 pb-80">
        <div class="container">
            <div class="wexnix_search-filter-box bg-light p-4 mb-5">
                <form action="{{ route('students.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-6 col-lg-3">
                            <label class="wexnix_filter-label">{{ __('Class') }}</label>
                            <select name="class_id" class="form-select">
                                <option value="">{{ __('Select One') }}</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" @selected(request('class_id') == $class->id)>{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="wexnix_filter-label">{{ __('Section') }}</label>
                            <select name="section_id" class="form-select">
                                <option value="">{{ __('Select One') }}</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}" @selected(request('section_id') == $section->id)>{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="wexnix_filter-label">{{ __('Group') }}</label>
                            <select name="group" class="form-select">
                                <option value="">{{ __('Select One') }}</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group }}" @selected(request('group') == $group)>{{ $group }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="wexnix_filter-label">{{ __('Roll No.') }}</label>
                            <input type="text" name="roll_no" class="form-control" placeholder="{{ __('Enter Roll no. here') }}" value="{{ request('roll_no') }}">
                        </div>
                        
                        <div class="col-12 d-flex justify-content-end gap-3 mt-4">
                            <a href="{{ route('students.index') }}" class="btn btn-light border"><i class="fas fa-rotate"></i> {{ __('Reset') }}</a>
                            <button type="submit" class="wexnix_theme-btn justify-content-center"><span class="fas fa-search"></span> {{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Photo') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Roll No') }}</th>
                            <th>{{ __('Class') }}</th>
                            <th>{{ __('Section') }}</th>
                            <th>{{ __('Group') }}</th>
                            <th>{{ __('Gender') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td>
                                    <img src="{{ $student->picture ? '/storage/' . ltrim($student->picture, '/') : asset('frontend/assets/img/default-user.jpg') }}" alt="{{ $student->first_name }}" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                <td>{{ $student->roll_no }}</td>
                                <td>{{ $student->academicClass?->name ?? '-' }}</td>
                                <td>{{ $student->section?->name ?? '-' }}</td>
                                <td>{{ $student->group ?? '-' }}</td>
                                <td>{{ $student->gender ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">{{ __('No students found matching your criteria.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $students->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    <!-- student list search end -->

@endsection
