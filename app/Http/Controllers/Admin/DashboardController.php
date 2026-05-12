<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $totalPosts = Post::count();
            $publishedPosts = Post::published()->count();
            $draftPosts = Post::where('is_published', false)->count();
            $recentPosts = Post::with(['author', 'category'])->latest()->take(5)->get();
            $totalUsers = User::count();
        } else {
            $totalPosts = Post::where('user_id', $user->id)->count();
            $publishedPosts = Post::where('user_id', $user->id)->published()->count();
            $draftPosts = Post::where('user_id', $user->id)->where('is_published', false)->count();
            $recentPosts = Post::with(['author', 'category'])->where('user_id', $user->id)->latest()->take(5)->get();
            $totalUsers = null;
        }

        $totalCategories = Category::count();
        $totalTags = Tag::count();

        return view('admin.dashboard', compact(
            'totalPosts',
            'publishedPosts',
            'draftPosts',
            'totalCategories',
            'totalTags',
            'recentPosts',
            'totalUsers',
        ));
    }
}
