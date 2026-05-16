@extends('layouts.public')

@section('title', '#' . $tag->name . ' - Elkris Bio Health')
@section('meta_description', 'Articles tagged with ' . $tag->name)

@push('seo')
<meta property="og:title" content="#{{ $tag->name }} - Elkris Bio Health">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
@endpush

@section('content')
<main class="max-w-[1280px] mx-auto px-5 md:px-16 py-8">
    <section class="mb-section-gap max-w-2xl mx-auto text-center">
        <div class="inline-flex items-center px-4 py-2 rounded-full bg-secondary-container text-on-secondary-container font-ui-label text-ui-label mb-4">
            #{{ $tag->name }}
        </div>
        <h1 class="font-display-lg text-[32px] md:text-[48px] leading-tight font-bold text-primary-container mb-6">Articles tagged with "{{ $tag->name }}"</h1>
    </section>

    <div class="flex flex-col lg:flex-row gap-8">
        <div class="flex-1">
            @forelse($posts as $post)
            <a href="{{ route('blog.show', $post) }}" class="flex flex-col sm:flex-row gap-6 p-6 bg-white rounded-xl border border-surface-variant shadow-sm mb-4 group hover:border-secondary transition-all no-underline">
                <div class="sm:w-48 h-32 rounded-lg overflow-hidden bg-surface-container-high shrink-0">
                    @if($post->featured_image)
                    <img alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ Storage::url($post->featured_image) }}"/>
                    @else
                    <div class="w-full h-full flex items-center justify-center text-primary-container/20">
                        <span class="material-symbols-outlined text-4xl">image</span>
                    </div>
                    @endif
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-secondary font-bold text-caption tracking-widest uppercase">{{ $post->category?->name ?? 'General' }}</span>
                        <span class="text-outline text-caption">&bull;</span>
                        <span class="text-outline text-caption">{{ $post->published_at?->format('M j, Y') }}</span>
                    </div>
                    <h4 class="font-headline-sm text-[24px] font-semibold text-primary group-hover:text-secondary transition-colors">{{ $post->title }}</h4>
                    <p class="text-on-surface-variant text-ui-label line-clamp-2 mt-2">{{ $post->excerpt }}</p>
                    <div class="flex items-center gap-2 mt-4 text-ui-label text-secondary font-medium">
                        <span>Read Full Article</span>
                        <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </div>
                </div>
            </a>
            @empty
            <div class="text-center py-16">
                <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">sell</span>
                <h4 class="font-headline-sm text-[24px] font-semibold text-primary-container mb-2">No Articles Found</h4>
                <p class="text-on-surface-variant">No articles with this tag yet.</p>
            </div>
            @endforelse

            @if($posts->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $posts->links() }}
            </div>
            @endif
        </div>

        <aside class="lg:w-80 shrink-0">
            <div class="bg-white rounded-xl border border-surface-variant p-6 shadow-sm mb-6">
                <h4 class="font-ui-label font-bold text-primary mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary text-[18px]">local_fire_department</span>
                    Trending Topics
                </h4>
                <div class="flex flex-wrap gap-2">
                    @forelse($trendingTopics as $topic)
                    <a href="{{ route('blog.category', $topic) }}" class="inline-flex items-center px-3 py-1 rounded-full border border-outline-variant text-on-surface-variant text-caption hover:bg-surface-container-high hover:border-secondary transition-all no-underline">{{ $topic->name }}</a>
                    @empty
                    <p class="text-caption text-outline">No trending topics yet.</p>
                    @endforelse
                </div>
            </div>

            <div class="border-l-4 border-secondary pl-4 py-2">
                <p class="font-article text-article-body-mobile italic text-on-surface-variant">"Your health is an investment, not an expense."</p>
                <span class="text-caption text-outline font-bold mt-2 block">- Elkris Bio Health</span>
            </div>
        </aside>
    </div>
</main>
@endsection
