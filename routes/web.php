<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlogController::class, 'index'])->name('home');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/{post:slug}/download', [BlogController::class, 'downloadPost'])->name('blog.download');
Route::get('/category/{category:slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/tag/{tag:slug}', [BlogController::class, 'tag'])->name('blog.tag');
Route::get('/resources', [BlogController::class, 'resources'])->name('blog.resources');
Route::get('/resources/{slug}/download', [BlogController::class, 'downloadResource'])->name('blog.resources.download');
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
        Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('register', [RegisteredUserController::class, 'store']);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
