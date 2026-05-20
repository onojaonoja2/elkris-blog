<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class SitemapController extends Controller
{
    public function __invoke()
    {
        $posts = Post::published()->orderBy('published_at', 'desc')->get();
        $categories = Category::where('is_active', true)->get();
        $tags = Tag::all();

        $content = view('sitemap', compact('posts', 'categories', 'tags'))->render();

        return response($content, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
