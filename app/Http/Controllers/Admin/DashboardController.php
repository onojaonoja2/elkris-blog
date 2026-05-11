<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPosts = Post::count();
        $publishedPosts = Post::published()->count();
        $draftPosts = Post::where('is_published', false)->count();
        $totalCategories = Category::count();
        $totalTags = Tag::count();
        $recentPosts = Post::with(['author', 'category'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPosts',
            'publishedPosts',
            'draftPosts',
            'totalCategories',
            'totalTags',
            'recentPosts'
        ));
    }
}
