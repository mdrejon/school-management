@extends('frontend.layouts.app')

@section('title', $post->title . ' - ' . config('app.name'))
@section('meta_description', $post->short_description ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $pageSettings->breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $post->title }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('blog.index') }}">{{ $pageSettings->breadcrumb_title ?: 'Our Blog' }}</a></li>
                    <li class="active">{{ $post->title }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- blog single area -->
        <div class="wexnix_blog-single-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="wexnix_blog-single-wrapper">
                            <div class="wexnix_blog-single-content">
                                @if ($post->image_url)
                                    <div class="wexnix_blog-thumb-img">
                                        <img src="{{ $post->image_url }}" alt="thumb">
                                    </div>
                                @endif
                                <div class="wexnix_blog-info">
                                    <div class="wexnix_blog-meta">
                                        <div class="wexnix_blog-meta-left">
                                            <ul>
                                                @if ($post->author_name)
                                                    <li><i class="fas fa-user"></i><a href="#">{{ $post->author_name }}</a></li>
                                                @endif
                                                @if ($post->published_at)
                                                    <li><i class="fas fa-calendar-alt"></i>{{ $post->published_at->format('F d, Y') }}</li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="wexnix_blog-details">
                                        <h3 class="wexnix_blog-details-title mb-20">{{ $post->title }}</h3>
                                        @if ($post->description)
                                            <div class="mb-10">{!! $post->description !!}</div>
                                        @endif

                                        @if ($post->gallery_image_1_url || $post->gallery_image_2_url)
                                            <div class="row">
                                                @if ($post->gallery_image_1_url)
                                                    <div class="col-md-6 mb-20">
                                                        <img src="{{ $post->gallery_image_1_url }}" alt="">
                                                    </div>
                                                @endif
                                                @if ($post->gallery_image_2_url)
                                                    <div class="col-md-6 mb-20">
                                                        <img src="{{ $post->gallery_image_2_url }}" alt="">
                                                    </div>
                                                @endif
                                            </div>
                                        @endif

                                        @php $tags = $post->tagItems(); @endphp
                                        @if (count($tags))
                                            <hr>
                                            <div class="wexnix_blog-details-tags pb-20">
                                                <h5>Tags : </h5>
                                                <ul>
                                                    @foreach ($tags as $tag)
                                                        <li><a href="#">{{ $tag }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>

                                    @if ($post->author_name)
                                        <div class="wexnix_blog-author">
                                            @if ($post->author_photo_url)
                                                <div class="wexnix_blog-author-img">
                                                    <img src="{{ $post->author_photo_url }}" alt="">
                                                </div>
                                            @endif
                                            <div class="wexnix_author-info">
                                                <h6>Author</h6>
                                                <h3 class="wexnix_author-name">{{ $post->author_name }}</h3>
                                                @if ($post->author_bio)
                                                    <p>{{ $post->author_bio }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <aside class="wexnix_sidebar">
                            @if ($recentPosts->count())
                                <div class="wexnix_widget wexnix_recent-post">
                                    <h5 class="wexnix_widget-title">Recent Post</h5>
                                    @foreach ($recentPosts as $recentPost)
                                        <div class="wexnix_recent-post-single">
                                            <div class="wexnix_recent-post-img">
                                                <img src="{{ $recentPost->image_url ?? '/frontend/assets/img/blog/01.jpg' }}" alt="thumb">
                                            </div>
                                            <div class="wexnix_recent-post-bio">
                                                <h6><a href="{{ route('blog.show', $recentPost) }}">{{ $recentPost->title }}</a></h6>
                                                @if ($recentPost->published_at)
                                                    <span><i class="fas fa-clock"></i>{{ $recentPost->published_at->format('F d, Y') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog single area end -->

    </main>
@endsection
