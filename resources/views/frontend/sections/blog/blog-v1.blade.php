{{-- Homepage "Blog" teaser, design v1 — reuses the same card partial as the blog list page. --}}
{{-- Expects: $posts (Collection<App\Models\BlogPost>), $pageSettings (App\Models\BlogPageSetting). --}}
@php
    $titleHtml = e($pageSettings->section_title);
    if (! empty($pageSettings->section_highlight)) {
        $titleHtml = str_ireplace(e($pageSettings->{{ __('section_highlight), \'') }}<span>' . e($pageSettings->{{ __('section_highlight) . \'') }}</span>', $titleHtml);
    }
@endphp
@if ($pageSettings->section_title && $posts->{{ __('count())') }}
    <div class="wexnix_blog-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="wexnix_site-heading text-center">
                        @if ($pageSettings->{{ __('section_tagline)') }}
                            <span class="wexnix_site-title-tagline"><i class="fas fa-book-open-reader"></i> {{ $pageSettings->{{ __('section_tagline }}') }}</span>
                        @endif
                        <h2 class="wexnix_site-title">{!! $titleHtml !!}</h2>
                        @if ($pageSettings->{{ __('section_description)') }}
                            <p>{{ $pageSettings->{{ __('section_description }}') }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($posts as $post)
                    @include('frontend.blog.partials.card', ['post' => $post])
                @endforeach
            </div>
        </div>
    </div>
@endif
