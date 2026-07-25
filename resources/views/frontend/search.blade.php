@extends('frontend.layouts.app')

@section('title', 'Search' . ($query !== '' ? ' - ' . $query : '') . ' - ' . config('app.name'))

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url(/frontend/assets/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">Search</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">Search</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- search results -->
        <div class="py-120">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-lg-6 mx-auto">
                        <form action="{{ route('search') }}" method="GET" class="d-flex">
                            <input type="search" name="q" value="{{ $query }}" class="form-control" placeholder="Search...">
                            <button type="submit" class="wexnix_theme-btn ms-2"><span class="fas fa-search"></span>Search</button>
                        </form>
                    </div>
                </div>

                @if ($query === '')
                    <p class="text-center">Type something in the box above to search the site.</p>
                @elseif ($totalCount === 0)
                    <p class="text-center">No results found for &ldquo;{{ $query }}&rdquo;.</p>
                @else
                    <p class="mb-4">{{ $totalCount }} result{{ $totalCount === 1 ? '' : 's' }} for &ldquo;{{ $query }}&rdquo;</p>

                    @if ($results['notices']->count())
                        <div class="mb-5">
                            <h4 class="mb-3">Notices</h4>
                            <ul class="list-unstyled">
                                @foreach ($results['notices'] as $notice)
                                    <li class="mb-2"><a href="{{ route('notices.show', $notice) }}"><i class="fas fa-arrow-right-long me-2"></i>{{ $notice->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($results['courses']->count())
                        <div class="mb-5">
                            <h4 class="mb-3">Courses</h4>
                            <ul class="list-unstyled">
                                @foreach ($results['courses'] as $course)
                                    <li class="mb-2"><a href="{{ route('courses.show', $course) }}"><i class="fas fa-arrow-right-long me-2"></i>{{ $course->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($results['teachers']->count())
                        <div class="mb-5">
                            <h4 class="mb-3">Teachers</h4>
                            <ul class="list-unstyled">
                                @foreach ($results['teachers'] as $teacher)
                                    <li class="mb-2"><a href="{{ route('teachers.show', $teacher) }}"><i class="fas fa-arrow-right-long me-2"></i>{{ $teacher->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($results['events']->count())
                        <div class="mb-5">
                            <h4 class="mb-3">Events</h4>
                            <ul class="list-unstyled">
                                @foreach ($results['events'] as $event)
                                    <li class="mb-2"><a href="{{ route('events.show', $event) }}"><i class="fas fa-arrow-right-long me-2"></i>{{ $event->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($results['departments']->count())
                        <div class="mb-5">
                            <h4 class="mb-3">Departments</h4>
                            <ul class="list-unstyled">
                                @foreach ($results['departments'] as $department)
                                    <li class="mb-2"><a href="{{ route('departments.show', $department) }}"><i class="fas fa-arrow-right-long me-2"></i>{{ $department->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <!-- search results end -->

    </main>
@endsection
