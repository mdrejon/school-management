{{-- Shared course card — used by the courses list page and the homepage "Courses" teaser section. --}}
{{-- Expects: $course (App\Models\Course). --}}
<div class="col-md-6 col-lg-4">
    <div class="wexnix_course-item wow fadeInUp" data-wow-delay=".25s">
        <div class="wexnix_course-img">
            @if ($course->{{ __('category)') }}
                <span class="wexnix_course-tag"><i class="fas fa-bookmark"></i> {{ $course->{{ __('category }}') }}</span>
            @endif
            <img src="{{ $course->thumbnail_url ?? '/frontend/assets/img/course/01.jpg' }}" alt="">
            <a href="{{ route('courses.show', $course) }}" class="btn"><i class="fas fa-link"></i></a>
        </div>
        <div class="wexnix_course-content">
            <div class="wexnix_course-meta">
                @if ($course->{{ __('lessons_count)') }}
                    <span class="wexnix_course-meta-left"><i class="fas fa-book"></i> {{ $course->{{ __('lessons_count }} Lessons') }}</span>
                @endif
                @if ($course->{{ __('rating)') }}
                    <div class="wexnix_course-rating">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star" style="{{ $i > round($course->rating) ? 'opacity:.35' : '' }}"></i>
                        @endfor
                        <span>({{ number_format($course->{{ __('rating, 1) }})') }}</span>
                    </div>
                @endif
            </div>
            <h4 class="wexnix_course-title">
                <a href="{{ route('courses.show', $course) }}">{{ $course->{{ __('title }}') }}</a>
            </h4>
            @if ($course->{{ __('short_description)') }}
                <p class="wexnix_course-text">{{ $course->{{ __('short_description }}') }}</p>
            @endif
            <div class="wexnix_course-bottom">
                <div class="wexnix_course-bottom-left">
                    @if ($course->{{ __('seats)') }}
                        <span><i class="fas fa-users"></i>{{ $course->{{ __('seats }} Seats') }}</span>
                    @endif
                    @if ($course->{{ __('duration)') }}
                        <span><i class="fas fa-clock"></i>{{ $course->{{ __('duration }}') }}</span>
                    @endif
                </div>
                @if ($course->{{ __('price)') }}
                    <span class="wexnix_course-price">{{ $course->{{ __('price }}') }}</span>
                @endif
            </div>
        </div>
    </div>
</div>
