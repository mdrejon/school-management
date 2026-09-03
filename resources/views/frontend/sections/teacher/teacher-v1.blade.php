{{-- Homepage "Teachers" teaser, design v1 — reuses the same card partial as the teachers list page. --}}
{{-- Expects: $teachers (Collection<App\Models\Teacher>), $pageSettings (App\Models\TeacherPageSetting). --}}
@php
    $titleHtml = e($pageSettings->section_title);
    if (! empty($pageSettings->section_highlight)) {
        $titleHtml = str_ireplace(e($pageSettings->section_highlight), '<span>' . e($pageSettings->section_highlight) . '</span>', $titleHtml);
    }
@endphp
@if ($pageSettings->section_title && $teachers->count())
    <div class="wexnix_team-area py-120">
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
                @foreach ($teachers as $teacher)
                    @include('frontend.teachers.partials.card', ['teacher' => $teacher])
                @endforeach
            </div>
        </div>
    </div>
@endif
