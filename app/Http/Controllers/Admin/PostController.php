<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['author', 'category', 'tags'])
            ->latest()
            ->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::active()->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:posts,slug',
            'excerpt' => 'nullable',
            'body' => 'nullable',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'featured_image_caption' => 'nullable|max:255',
            'is_published' => 'boolean',
            'seo_title' => 'nullable|max:255',
            'seo_description' => 'nullable|max:320',
        ]);

        $validated['user_id'] = auth()->id();

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('posts', 'public');
            $validated['featured_image'] = $path;
        }

        if ($request->boolean('is_published')) {
            $validated['published_at'] = now();
        }

        $post = Post::create($validated);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.posts.edit', $post)
            ->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        $categories = Category::active()->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:posts,slug,' . $post->id,
            'excerpt' => 'nullable',
            'body' => 'nullable',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'featured_image_caption' => 'nullable|max:255',
            'is_published' => 'boolean',
            'remove_image' => 'boolean',
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

        if ($request->boolean('remove_image') && $post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
            $validated['featured_image'] = null;
        }

        if ($request->boolean('is_published') && !$post->is_published) {
            $validated['published_at'] = now();
        } elseif (!$request->boolean('is_published')) {
            $post->published_at = null;
        }

        $post->update($validated);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.posts.edit', $post)
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
