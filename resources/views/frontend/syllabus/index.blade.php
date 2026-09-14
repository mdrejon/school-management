@extends('frontend.layouts.app')

@section('title', 'Syllabus - ' . config('app.name'))

@section('content')
<main class="wexnix_main">
    <!-- breadcrumb -->
    <div class="wexnix_site-breadcrumb" style="background: url(/frontend/assets/img/breadcrumb/01.jpg)">
        <div class="container">
            <h2 class="wexnix_breadcrumb-title">{{ __('Syllabus') }}</h2>
            <ul class="wexnix_breadcrumb-menu">
                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="active">{{ __('Syllabus') }}</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <div class="py-120">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <form action="{{ route('syllabus.index') }}" method="GET" class="row g-3 align-items-center">
                                <div class="col-md-auto">
                                    <label for="class_id" class="col-form-label fw-bold">{{ __('Filter by Class') }}:</label>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <select name="class_id" id="class_id" class="form-select">
                                        <option value="">{{ __('All Classes') }}</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-auto">
                                    <button type="submit" class="btn btn-primary px-4"><i class="fas fa-search me-2"></i>{{ __('Filter') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-0 table-responsive">
                            <table class="table table-hover mb-0 align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Class') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($syllabi as $syllabus)
                                        <tr>
                                            <td class="fw-bold">{{ $syllabus->title }}</td>
                                            <td>
                                                <span class="badge bg-info text-dark">{{ $syllabus->academicClass?->name ?? 'N/A' }}</span>
                                            </td>
                                            <td class="text-muted text-start" style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                {{ $syllabus->description ?: '--' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('syllabus.download', $syllabus->id) }}" class="btn btn-sm btn-success">
                                                    <i class="fas fa-download me-1"></i> {{ __('Download') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="py-5 text-center text-muted">
                                                <i class="fas fa-folder-open mb-3 d-block" style="font-size: 3rem; opacity: 0.2;"></i>
                                                {{ __('No syllabus found for the selected class.') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            @if($syllabi->hasPages())
                <div class="row mt-5">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $syllabi->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
