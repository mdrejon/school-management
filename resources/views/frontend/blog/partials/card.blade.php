{{-- Shared blog card — used by the blog list page and the homepage "Blog" teaser section. --}}
{{-- Expects: $post (App\Models\BlogPost). --}}
<div class="col-md-6 col-lg-4">
    <div class="wexnix_blog-item wow fadeInUp" data-wow-delay=".25s">
        @if ($post->published_at)
            <div class="wexnix_blog-date"><i class="fas fa-calendar-alt"></i> {{ $post->published_at->format('F d, Y') }}</div>
        @endif
        <div class="wexnix_blog-item-img">
            <img src="{{ $post->image_url ?? '/frontend/assets/img/blog/01.jpg' }}" alt="Thumb">
        </div>
        <div class="wexnix_blog-item-info">
            @if ($post->author_name)
                <div class="wexnix_blog-item-meta">
                    <ul>
                        <li><a href="{{ route('blog.show', $post) }}"><i class="fas fa-user-circle"></i> By {{ $post->author_name }}</a></li>
                    </ul>
                </div>
            @endif
            <h4 class="wexnix_blog-title">
                <a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a>
            </h4>
            <a class="wexnix_theme-btn" href="{{ route('blog.show', $post) }}">Read More<i class="fas fa-arrow-right-long"></i></a>
        </div>
    </div>
</div>
