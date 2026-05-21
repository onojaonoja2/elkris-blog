<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $query = Post::with(['author', 'category', 'tags']);

        if (! request()->user()->isAdmin()) {
            $query->where('user_id', request()->user()->id);
        }

        $posts = $query->latest()->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $this->authorize('create', Post::class);

        $categories = Category::active()->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $request->merge(['is_published' => $request->boolean('is_published')]);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:posts,slug',
            'excerpt' => 'nullable',
            'body' => 'nullable',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:'.min(5120, UploadedFile::getMaxFilesize() / 1024),
            'featured_image_caption' => 'nullable|max:255',
            'image_position' => 'nullable|in:top,middle,end',
            'video' => 'nullable|mimes:mp4,mov,avi,webm|max:'.min(102400, UploadedFile::getMaxFilesize() / 1024),
            'video_position' => 'nullable|in:top,middle,end',
            'is_published' => 'boolean',
            'remove_featured_image' => 'boolean',
            'remove_video' => 'boolean',
            'seo_title' => 'nullable|max:255',
            'seo_description' => 'nullable|max:320',
        ]);

        $validated['user_id'] = auth()->id();

        if ($request->boolean('remove_featured_image') && ! $request->hasFile('featured_image')) {
            $validated['featured_image'] = null;
        }

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('posts', 'public');
            $validated['featured_image'] = $path;
        }

        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('posts/videos', 's3');
            $validated['video'] = $path;
        }

        if ($request->boolean('remove_video') && ! $request->hasFile('video')) {
            $validated['video'] = null;
        }

        if ($request->boolean('is_published')) {
            $validated['published_at'] = now();
        }

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $post = Post::create($validated);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $categories = Category::active()->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->merge(['is_published' => $request->boolean('is_published')]);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:posts,slug,'.$post->id,
            'excerpt' => 'nullable',
            'body' => 'nullable',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:'.min(5120, UploadedFile::getMaxFilesize() / 1024),
            'featured_image_caption' => 'nullable|max:255',
            'image_position' => 'nullable|in:top,middle,end',
            'video' => 'nullable|mimes:mp4,mov,avi,webm|max:'.min(102400, UploadedFile::getMaxFilesize() / 1024),
            'video_position' => 'nullable|in:top,middle,end',
            'is_published' => 'boolean',
            'remove_featured_image' => 'boolean',
            'remove_video' => 'boolean',
            'seo_title' => 'nullable|max:255',
            'seo_description' => 'nullable|max:320',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $path = $request->file('featured_image')->store('posts', 'public');
            $validated['featured_image'] = $path;
        }

        if ($request->boolean('remove_featured_image') && $post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
            $validated['featured_image'] = null;
        }

        if ($request->hasFile('video')) {
            if ($post->video) {
                Storage::disk('s3')->delete($post->video);
            }
            $path = $request->file('video')->store('posts/videos', 's3');
            $validated['video'] = $path;
        }

        if ($request->boolean('remove_video') && $post->video) {
            Storage::disk('s3')->delete($post->video);
            $validated['video'] = null;
        }

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->boolean('is_published') && ! $post->is_published) {
            $validated['published_at'] = now();
        } elseif (! $request->boolean('is_published')) {
            $post->published_at = null;
        }

        $post->update($validated);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        if ($post->video) {
            Storage::disk('s3')->delete($post->video);
        }

        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
