<?php

namespace App\Http\Controllers;

use App\Models\BlogPageSetting;
use App\Models\BlogPost;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function index(): View
    {
        return view('frontend.blog.index', [
            'posts' => BlogPost::where('is_active', true)->orderBy('sort_order')->paginate(12),
            'pageSettings' => BlogPageSetting::current(),
        ]);
    }

    public function show(BlogPost $post): View
    {
        abort_unless($post->is_active, 404);

        return view('frontend.blog.show', [
            'post' => $post,
            'recentPosts' => BlogPost::where('is_active', true)->where('id', '!=', $post->id)->latest('published_at')->limit(3)->get(),
            'pageSettings' => BlogPageSetting::current(),
        ]);
    }
}
