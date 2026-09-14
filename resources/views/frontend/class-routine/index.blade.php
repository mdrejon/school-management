@extends('frontend.layouts.app')

@section('title', 'Class Routine - ' . config('app.name'))

@section('content')
<main class="wexnix_main">
    <!-- breadcrumb -->
    <div class="wexnix_site-breadcrumb" style="background: url(/frontend/assets/img/breadcrumb/01.jpg)">
        <div class="container">
            <h2 class="wexnix_breadcrumb-title">{{ __('Class Routine') }}</h2>
            <ul class="wexnix_breadcrumb-menu">
                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="active">{{ __('Class Routine') }}</li>
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
                            <form action="{{ route('class-routine.index') }}" method="GET" class="row g-3 align-items-center">
                                <div class="col-md-auto">
                                    <label for="class" class="col-form-label fw-bold">{{ __('Select Class') }}:</label>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <select name="class" id="class" class="form-select">
                                        <option value="">{{ __('Select Class & Section') }}</option>
                                        @foreach($classes as $class)
                                            @if($class->sections->isEmpty())
                                                <option value="{{ $class->id }}-null" {{ request('class') == ($class->id.'-null') ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
                                            @else
                                                <optgroup label="{{ $class->name }}">
                                                    @foreach($class->sections as $sec)
                                                        <option value="{{ $class->id }}-{{ $sec->id }}" {{ request('class') == ($class->id.'-'.$sec->id) ? 'selected' : '' }}>
                                                            {{ $class->name }} - {{ $sec->name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endif
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

            @if(request()->filled('class'))
                <div class="row">
                    <div class="col-12">
                        @foreach($days as $day)
                            @if(isset($routines[$day]) && $routines[$day]->count() > 0)
                                <h4 class="mb-3 mt-4 text-primary">{{ __($day) }}</h4>
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-body p-0 table-responsive">
                                        <table class="table table-hover mb-0 align-middle text-center">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>{{ __('Time') }}</th>
                                                    <th>{{ __('Subject') }}</th>
                                                    <th>{{ __('Teacher') }}</th>
                                                    <th>{{ __('Room') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($routines[$day] as $routine)
                                                    <tr>
                                                        <td class="fw-bold">
                                                            {{ \Carbon\Carbon::parse($routine->start_time)->format('h:i A') }} - 
                                                            {{ \Carbon\Carbon::parse($routine->end_time)->format('h:i A') }}
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-info text-dark">{{ $routine->subject?->name ?? 'N/A' }}</span>
                                                        </td>
                                                        <td>{{ $routine->teacher?->name ?? 'N/A' }}</td>
                                                        <td class="text-muted">{{ $routine->room ?: '--' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        @if($routines->isEmpty())
                            <div class="card shadow-sm border-0">
                                <div class="card-body py-5 text-center text-muted">
                                    <i class="fas fa-calendar-times mb-3 d-block" style="font-size: 3rem; opacity: 0.2;"></i>
                                    {{ __('No routine found for the selected class.') }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="card shadow-sm border-0">
                    <div class="card-body py-5 text-center text-muted">
                        <i class="fas fa-hand-pointer mb-3 d-block" style="font-size: 3rem; opacity: 0.2;"></i>
                        {{ __('Please select a class to view the routine.') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
