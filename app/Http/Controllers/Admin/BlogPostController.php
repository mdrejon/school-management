<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogPostRequest;
use App\Http\Requests\Admin\UpdateBlogPostRequest;
use App\Models\BlogPageSetting;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class BlogPostController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Cms/BlogPosts', [
            'posts' => BlogPost::orderBy('sort_order')->get(),
            'pageSettings' => BlogPageSetting::current(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Cms/BlogPostForm', [
            'post' => null,
        ]);
    }

    public function edit(BlogPost $blogPost): Response
    {
        return Inertia::render('Admin/Cms/BlogPostForm', [
            'post' => $blogPost,
        ]);
    }

    public function store(StoreBlogPostRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        $data['image'] = $request->file('image')->store('blog', 'public');

        foreach (['author_photo', 'gallery_image_1', 'gallery_image_2'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('blog', 'public');
            } else {
                unset($data[$field]);
            }
        }

        $data['sort_order'] = (int) BlogPost::max('sort_order') + 1;
        $data['is_active'] = $request->boolean('is_active', true);

        BlogPost::create($data);

        return redirect()->route('admin.cms.blog.index')->with('success', 'Post added.');
    }

    public function update(UpdateBlogPostRequest $request, BlogPost $blogPost): RedirectResponse
    {
        $data = $request->validated();

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        if ($request->hasFile('image')) {
            if ($blogPost->image) {
                Storage::disk('public')->delete($blogPost->image);
            }
            $data['image'] = $request->file('image')->store('blog', 'public');
        } else {
            unset($data['image']);
        }

        foreach (['author_photo', 'gallery_image_1', 'gallery_image_2'] as $field) {
            if ($request->hasFile($field)) {
                if ($blogPost->{$field}) {
                    Storage::disk('public')->delete($blogPost->{$field});
                }
                $data[$field] = $request->file($field)->store('blog', 'public');
            } else {
                unset($data[$field]);
            }
        }

        $data['is_active'] = $request->boolean('is_active', $blogPost->is_active);

        $blogPost->update($data);

        return redirect()->route('admin.cms.blog.index')->with('success', 'Post updated.');
    }

    public function toggleActive(BlogPost $blogPost): RedirectResponse
    {
        $blogPost->update(['is_active' => ! $blogPost->is_active]);

        return back()->with('success', $blogPost->is_active ? 'Post activated.' : 'Post deactivated.');
    }

    public function destroy(BlogPost $blogPost): RedirectResponse
    {
        foreach ([$blogPost->image, $blogPost->author_photo, $blogPost->gallery_image_1, $blogPost->gallery_image_2] as $path) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
        }

        $blogPost->delete();

        return back()->with('success', 'Post removed.');
    }

    public function moveUp(BlogPost $blogPost): RedirectResponse
    {
        $this->swapWithNeighbor($blogPost, 'up');

        return back();
    }

    public function moveDown(BlogPost $blogPost): RedirectResponse
    {
        $this->swapWithNeighbor($blogPost, 'down');

        return back();
    }

    protected function swapWithNeighbor(BlogPost $blogPost, string $direction): void
    {
        $neighbor = $direction === 'up'
            ? BlogPost::where('sort_order', '<', $blogPost->sort_order)->orderByDesc('sort_order')->first()
            : BlogPost::where('sort_order', '>', $blogPost->sort_order)->orderBy('sort_order')->first();

        if (! $neighbor) {
            return;
        }

        DB::transaction(function () use ($blogPost, $neighbor) {
            [$a, $b] = [$blogPost->sort_order, $neighbor->sort_order];
            $blogPost->update(['sort_order' => $b]);
            $neighbor->update(['sort_order' => $a]);
        });
    }
}
