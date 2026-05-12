<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $featuredPost = Post::published()->with(['author', 'category', 'tags'])->recent()->first();
        $trendingPosts = Post::published()->with(['author', 'category', 'tags'])->recent()->take(3)->get();
        $recentPosts = Post::published()->with(['author', 'category', 'tags'])->recent()->take(5)->get();
        $categories = Category::active()->get();

        return view('blog.index', compact(
            'featuredPost',
            'trendingPosts',
            'recentPosts',
            'categories'
        ));
    }

    public function show(Post $post)
    {
        if (! $post->is_published || ! $post->published_at || $post->published_at->isFuture()) {
            abort(404);
        }

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->where(function ($q) use ($post) {
                $q->where('category_id', $post->category_id)
                    ->orWhereHas('tags', function ($q) use ($post) {
                        $q->whereIn('tags.id', $post->tags->pluck('id'));
                    });
            })
            ->recent()
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }

    public function category(Category $category)
    {
        $posts = Post::published()
            ->where('category_id', $category->id)
            ->with(['author', 'category', 'tags'])
            ->recent()
            ->paginate(10);

        $categories = Category::active()->get();
        $trendingTags = Tag::has('posts')->get();
        $featuredQuote = Post::published()->inRandomOrder()->first();

        return view('blog.category', compact('posts', 'category', 'categories', 'trendingTags', 'featuredQuote'));
    }

    public function tag(Tag $tag)
    {
        $posts = $tag->posts()
            ->published()
            ->with(['author', 'category', 'tags'])
            ->recent()
            ->paginate(10);

        $categories = Category::active()->get();
        $trendingTags = Tag::has('posts')->get();

        return view('blog.tag', compact('posts', 'tag', 'categories', 'trendingTags'));
    }

    public function resources()
    {
        $categories = Category::active()->get();

        $resources = [
            [
                'key' => 'nutrition-manual',
                'title' => 'The Nutrition & Healthy Living Manual',
                'description' => 'A comprehensive guide covering evidence-based nutrition, meal planning, and lifestyle modifications for optimal health.',
                'page_count' => 24,
                'file_size' => '2.4 MB',
                'featured' => true,
            ],
            [
                'key' => 'glycemic-index-chart',
                'title' => 'Glycemic Index Reference Chart',
                'description' => 'Quick-reference chart of common Nigerian foods and their glycemic impact.',
                'page_count' => 2,
                'file_size' => null,
                'featured' => false,
            ],
        ];

        return view('blog.resources', compact('categories', 'resources'));
    }

    public function downloadResource(string $resource)
    {
        $path = "resources/{$resource}.pdf";

        if (! Storage::disk('public')->exists($path)) {
            abort(404);
        }

        $displayName = match ($resource) {
            'nutrition-manual' => 'Nutrition_and_Healthy_Living_Manual.pdf',
            'glycemic-index-chart' => 'Glycemic_Index_Reference_Chart.pdf',
            default => "{$resource}.pdf",
        };

        return Storage::disk('public')->download($path, $displayName);
    }
}
