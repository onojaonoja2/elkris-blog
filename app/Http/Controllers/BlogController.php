<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

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

        $post->increment('views_count');

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
        $posts = Post::published()->with(['author', 'category', 'tags'])->recent()->get();

        return view('blog.resources', compact('categories', 'posts'));
    }

    public function downloadResource(string $slug)
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();

        $filename = Str::slug($post->title).'.pdf';

        $pdf = Pdf::loadView('pdf.post', [
            'post' => $post,
        ]);

        return $pdf->download($filename);
    }

    public function downloadPost(Post $post)
    {
        if (! $post->is_published || ! $post->published_at || $post->published_at->isFuture()) {
            abort(404);
        }

        $filename = Str::slug($post->title).'.pdf';

        $pdf = Pdf::loadView('pdf.post', [
            'post' => $post,
        ]);

        return $pdf->download($filename);
    }
}
