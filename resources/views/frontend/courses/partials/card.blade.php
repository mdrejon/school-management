{{-- Shared course card — used by the courses list page and the homepage "Courses" teaser section. --}}
{{-- Expects: $course (App\Models\Course). --}}
<div class="col-md-6 col-lg-4">
    <div class="wexnix_course-item wow fadeInUp" data-wow-delay=".25s">
        <div class="wexnix_course-img">
            @if ($course->category)
                <span class="wexnix_course-tag"><i class="fas fa-bookmark"></i> {{ $course->category }}</span>
            @endif
            <img src="{{ $course->thumbnail_url ?? '/frontend/assets/img/course/01.jpg' }}" alt="">
            <a href="{{ route('courses.show', $course) }}" class="btn"><i class="fas fa-link"></i></a>
        </div>
        <div class="wexnix_course-content">
            <div class="wexnix_course-meta">
                @if ($course->lessons_count)
                    <span class="wexnix_course-meta-left"><i class="fas fa-book"></i> {{ $course->lessons_count }} Lessons</span>
                @endif
                @if ($course->rating)
                    <div class="wexnix_course-rating">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star" style="{{ $i > round($course->rating) ? 'opacity:.35' : '' }}"></i>
                        @endfor
                        <span>({{ number_format($course->rating, 1) }})</span>
                    </div>
                @endif
            </div>
            <h4 class="wexnix_course-title">
                <a href="{{ route('courses.show', $course) }}">{{ $course->title }}</a>
            </h4>
            @if ($course->short_description)
                <p class="wexnix_course-text">{{ $course->short_description }}</p>
            @endif
            <div class="wexnix_course-bottom">
                <div class="wexnix_course-bottom-left">
                    @if ($course->seats)
                        <span><i class="fas fa-users"></i>{{ $course->seats }} Seats</span>
                    @endif
                    @if ($course->duration)
                        <span><i class="fas fa-clock"></i>{{ $course->duration }}</span>
                    @endif
                </div>
                @if ($course->price)
                    <span class="wexnix_course-price">{{ $course->price }}</span>
                @endif
            </div>
        </div>
    </div>
</div>
