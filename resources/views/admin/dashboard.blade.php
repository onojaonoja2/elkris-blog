@extends('admin.layouts.admin')

@section('title', 'Dashboard - Elkris Bio Health')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl border border-surface-variant p-6 shadow-sm">
        <div class="flex items-center justify-between mb-2">
            <span class="material-symbols-outlined text-secondary text-3xl">article</span>
            <span class="text-caption text-outline">Total</span>
        </div>
        <p class="font-headline-sm text-[24px] font-semibold text-primary">{{ $totalPosts }}</p>
        <p class="text-caption text-outline">Total Posts</p>
    </div>
    <div class="bg-white rounded-xl border border-surface-variant p-6 shadow-sm">
        <div class="flex items-center justify-between mb-2">
            <span class="material-symbols-outlined text-secondary text-3xl">publish</span>
            <span class="text-caption text-outline">Published</span>
        </div>
        <p class="font-headline-sm text-[24px] font-semibold text-primary">{{ $publishedPosts }}</p>
        <p class="text-caption text-outline">Published Posts</p>
    </div>
    <div class="bg-white rounded-xl border border-surface-variant p-6 shadow-sm">
        <div class="flex items-center justify-between mb-2">
            <span class="material-symbols-outlined text-secondary text-3xl">draft</span>
            <span class="text-caption text-outline">Drafts</span>
        </div>
        <p class="font-headline-sm text-[24px] font-semibold text-primary">{{ $draftPosts }}</p>
        <p class="text-caption text-outline">Draft Posts</p>
    </div>
    <div class="bg-white rounded-xl border border-surface-variant p-6 shadow-sm">
        <div class="flex items-center justify-between mb-2">
            <span class="material-symbols-outlined text-secondary text-3xl">category</span>
            <span class="text-caption text-outline">{{ $totalTags }} tags</span>
        </div>
        <p class="font-headline-sm text-[24px] font-semibold text-primary">{{ $totalCategories }}</p>
        <p class="text-caption text-outline">Categories</p>
    </div>
</div>

<div class="bg-white rounded-xl border border-surface-variant shadow-sm">
    <div class="px-6 py-4 border-b border-surface-variant">
        <h3 class="font-headline-sm text-[24px] font-semibold text-primary">Recent Posts</h3>
    </div>
    <div class="divide-y divide-surface-variant">
        @forelse($recentPosts as $post)
        <div class="px-6 py-4 flex items-center justify-between">
            <div class="flex-1">
                <a href="{{ route('admin.posts.edit', $post) }}" class="font-ui-label font-medium text-primary hover:text-secondary transition-colors">{{ $post->title }}</a>
                <div class="flex items-center gap-3 mt-1">
                    <span class="text-caption text-outline">{{ $post->author?->name }}</span>
                    <span class="text-caption text-outline">&bull;</span>
                    <span class="text-caption text-outline">{{ $post->category?->name ?? 'Uncategorized' }}</span>
                    <span class="text-caption text-outline">&bull;</span>
                    @if($post->is_published)
                    <span class="text-caption text-primary-fixed-dim font-medium">Published</span>
                    @else
                    <span class="text-caption text-outline font-medium">Draft</span>
                    @endif
                </div>
            </div>
            <div class="text-caption text-outline">
                {{ $post->created_at->diffForHumans() }}
            </div>
        </div>
        @empty
        <div class="px-6 py-8 text-center">
            <p class="text-on-surface-variant text-ui-label">No posts yet. <a href="{{ route('admin.posts.create') }}" class="text-secondary hover:underline">Create your first post</a></p>
        </div>
        @endforelse
    </div>
</div>
@endsection
