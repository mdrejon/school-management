{{-- Homepage "Courses" teaser, design v1 — reuses the same card partial as the courses list page. --}}
{{-- Expects: $courses (Collection<App\Models\Course>), $pageSettings (App\Models\CoursePageSetting). --}}
@php
    $titleHtml = e($pageSettings->section_title);
    if (! empty($pageSettings->section_highlight)) {
        $titleHtml = str_ireplace(e($pageSettings->section_highlight), '<span>' . e($pageSettings->section_highlight) . '</span>', $titleHtml);
    }
@endphp
@if ($pageSettings->section_title && $courses->count())
    <div class="wexnix_course-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="wexnix_site-heading text-center">
                        @if ($pageSettings->section_tagline)
                            <span class="wexnix_site-title-tagline"><i class="fas fa-book-open-reader"></i> {{ $pageSettings->section_tagline }}</span>
                        @endif
                        <h2 class="wexnix_site-title">{!! $titleHtml !!}</h2>
                        @if ($pageSettings->section_description)
                            <p>{{ $pageSettings->section_description }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($courses as $course)
                    @include('frontend.courses.partials.card', ['course' => $course])
                @endforeach
            </div>
        </div>
    </div>
@endif
