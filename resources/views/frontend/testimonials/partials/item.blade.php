{{-- Bare testimonial item — shared by the homepage teaser carousel and the testimonials page's own carousel. --}}
{{-- Expects: $testimonial (App\Models\Testimonial). --}}
<div class="wexnix_testimonial-item">
    <div class="wexnix_testimonial-rate">
        @for ($i = 1; $i <= 5; $i++)
            <i class="fas fa-star" style="{{ $i > $testimonial->rating ? 'opacity:.35' : '' }}"></i>
        @endfor
    </div>
    <div class="wexnix_testimonial-quote">
        <p>{{ $testimonial->quote }}</p>
    </div>
    <div class="wexnix_testimonial-content">
        <div class="wexnix_testimonial-author-img">
            <img src="{{ $testimonial->author_photo_url ?? '/frontend/assets/img/testimonial/01.jpg' }}" alt="">
        </div>
        <div class="wexnix_testimonial-author-info">
            <h4>{{ $testimonial->author_name }}</h4>
            @if ($testimonial->author_role)
                <p>{{ $testimonial->author_role }}</p>
            @endif
        </div>
    </div>
    <span class="wexnix_testimonial-quote-icon"><i class="fas fa-quote-right"></i></span>
</div>
