@extends('admin.layouts.admin')

@section('title', 'Posts - Elkris Bio Health')
@section('header', 'Posts')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <p class="text-on-surface-variant text-ui-label">{{ $posts->total() }} total posts</p>
    @can('create', App\Models\Post::class)
    <a href="{{ route('admin.posts.create') }}" class="bg-primary-container text-on-primary px-6 py-2 rounded-lg font-ui-label text-ui-label font-bold hover:bg-secondary transition-all flex items-center gap-2">
        <span class="material-symbols-outlined text-[18px]">add</span>
        New Post
    </a>
    @endcan
</div>

<div class="bg-white rounded-xl border border-surface-variant shadow-sm overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="border-b border-surface-variant bg-surface-container-low">
                <th class="text-left px-6 py-4 text-ui-label font-bold text-primary">Title</th>
                <th class="text-left px-6 py-4 text-ui-label font-bold text-primary hidden md:table-cell">Category</th>
                @if(Auth::user()->isAdmin())
                <th class="text-left px-6 py-4 text-ui-label font-bold text-primary hidden md:table-cell">Author</th>
                @endif
                <th class="text-left px-6 py-4 text-ui-label font-bold text-primary">Status</th>
                <th class="text-left px-6 py-4 text-ui-label font-bold text-primary hidden lg:table-cell">Date</th>
                <th class="text-right px-6 py-4 text-ui-label font-bold text-primary">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-surface-variant">
            @forelse($posts as $post)
            <tr class="hover:bg-surface-container-low transition-colors">
                <td class="px-6 py-4">
                    <a href="{{ route('admin.posts.edit', $post) }}" class="font-ui-label font-medium text-primary hover:text-secondary transition-colors">{{ $post->title }}</a>
                </td>
                <td class="px-6 py-4 text-ui-label text-on-surface-variant hidden md:table-cell">{{ $post->category?->name ?? '-' }}</td>
                @if(Auth::user()->isAdmin())
                <td class="px-6 py-4 text-ui-label text-on-surface-variant hidden md:table-cell">{{ $post->author?->name }}</td>
                @endif
                <td class="px-6 py-4">
                    @if($post->is_published)
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed text-caption font-medium">Published</span>
                    @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-surface-container-high text-on-surface-variant text-caption font-medium">Draft</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-caption text-outline hidden lg:table-cell">{{ $post->created_at->format('M j, Y') }}</td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('blog.show', $post) }}" class="p-2 text-outline hover:text-secondary transition-colors" title="Preview" target="_blank">
                            <span class="material-symbols-outlined">visibility</span>
                        </a>
                        <a href="{{ route('admin.posts.edit', $post) }}" class="p-2 text-outline hover:text-secondary transition-colors" title="Edit">
                            <span class="material-symbols-outlined">edit</span>
                        </a>
                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Delete this post?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="p-2 text-outline hover:text-error transition-colors" title="Delete">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="{{ Auth::user()->isAdmin() ? 6 : 5 }}" class="px-6 py-12 text-center">
                    <span class="material-symbols-outlined text-5xl text-outline-variant mb-2 block">article</span>
                    <p class="text-on-surface-variant text-ui-label">No posts yet.</p>
                    <a href="{{ route('admin.posts.create') }}" class="text-secondary hover:underline text-ui-label mt-2 inline-block">Create your first post</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($posts->hasPages())
<div class="mt-6">
    {{ $posts->links() }}
</div>
@endif
@endsection
