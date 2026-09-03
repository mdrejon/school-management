{{-- Homepage "Department" teaser, design v1 — an owl-carousel, matching the original theme's homepage design --}}
{{-- (the standalone departments list page uses a plain grid instead). Reuses the same bare item partial. --}}
{{-- Expects: $departments (Collection<App\Models\Department>), $pageSettings (App\Models\DepartmentPageSetting). --}}
@php
    $titleHtml = e($pageSettings->section_title);
    if (! empty($pageSettings->section_highlight)) {
        $titleHtml = str_ireplace(e($pageSettings->section_highlight), '<span>' . e($pageSettings->section_highlight) . '</span>', $titleHtml);
    }
@endphp
@if ($pageSettings->section_title && $departments->count())
    <div class="wexnix_department-area wexnix_bg py-120">
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
            <div class="wexnix_department-slider owl-carousel wexnix_owl-theme">
                @foreach ($departments as $department)
                    @include('frontend.departments.partials.item', ['department' => $department])
                @endforeach
            </div>
        </div>
    </div>
@endif
