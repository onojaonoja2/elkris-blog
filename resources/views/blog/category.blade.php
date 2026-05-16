@extends('layouts.public')

@section('title', $category->name . ' - Elkris Bio Health')
@section('meta_description', $category->description ?? 'Explore articles in ' . $category->name)

@push('seo')
<meta property="og:title" content="{{ $category->name }} - Elkris Bio Health">
<meta property="og:description" content="{{ $category->description ?? '' }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
@endpush

@section('content')
<main class="max-w-[1280px] mx-auto px-5 md:px-16 py-8">
    {{-- Search Section --}}
    <section class="mb-section-gap max-w-2xl mx-auto text-center">
        <h1 class="font-display-lg text-[32px] md:text-[48px] leading-tight font-bold text-primary-container mb-6">{{ $category->name }}</h1>
        @if($category->description)
        <p class="text-on-surface-variant text-ui-label mb-6">{{ $category->description }}</p>
        @endif
        <div class="relative group">
            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                <span class="material-symbols-outlined text-outline">search</span>
            </div>
            <input class="w-full h-14 pl-12 pr-4 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary/20 transition-all outline-none text-on-surface font-ui-label text-ui-label shadow-sm" placeholder="Search articles..." type="text" id="search-articles"/>
        </div>
    </section>

    {{-- Category Filters --}}
    <div class="flex overflow-x-auto gap-3 no-scrollbar mb-8 pb-2">
        <a href="{{ route('blog.all') }}" class="inline-flex items-center px-5 py-2 rounded-full border text-ui-label font-medium transition-all whitespace-nowrap @if(!request()->routeIs('blog.category')) bg-primary-container text-on-primary border-primary-container @else border-outline-variant text-on-surface-variant hover:bg-surface-container-high @endif">
            All Topics
        </a>
        @foreach($categories as $cat)
        <a href="{{ route('blog.category', $cat) }}" class="inline-flex items-center px-5 py-2 rounded-full border text-ui-label font-medium transition-all whitespace-nowrap @if($cat->id === $category->id) bg-primary-container text-on-primary border-primary-container @else border-outline-variant text-on-surface-variant hover:bg-surface-container-high @endif">
            {{ $cat->name }}
        </a>
        @endforeach
    </div>

    {{-- Main Content --}}
    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Left: Article List --}}
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
                <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">article</span>
                <h4 class="font-headline-sm text-[24px] font-semibold text-primary-container mb-2">No Articles Yet</h4>
                <p class="text-on-surface-variant">Articles in this category are coming soon.</p>
            </div>
            @endforelse

            {{-- Pagination --}}
            @if($posts->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $posts->links() }}
            </div>
            @endif
        </div>

        {{-- Right: Sidebar --}}
        <aside class="lg:w-80 shrink-0">
            {{-- Trending Tags --}}
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

            {{-- Newsletter --}}
            <div class="bg-primary-container rounded-xl p-6 shadow-sm mb-6">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-primary-fixed">mail</span>
                    <h4 class="font-ui-label font-bold text-primary-fixed">Newsletter</h4>
                </div>
                <p class="text-caption text-primary-fixed-dim mb-4">Get the latest insights delivered to your inbox.</p>
                @if(session('success'))
                <div class="bg-primary-fixed/20 text-primary-fixed text-caption px-4 py-3 rounded-lg mb-4 border border-primary-fixed/30">✓ {{ session('success') }}</div>
                @endif
                @if($errors->has('email'))
                <div class="bg-error/10 text-error text-caption px-4 py-3 rounded-lg mb-4 border border-error/30">{{ $errors->first('email') }}</div>
                @endif
                <form class="flex flex-col gap-3" method="POST" action="{{ route('newsletter.store') }}">
                    @csrf
                    <input class="px-4 py-3 rounded-lg border border-outline-variant bg-white text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary" placeholder="Your email" type="email" name="email" required/>
                    <button class="bg-secondary text-white font-bold px-5 py-3 rounded-lg hover:bg-on-secondary-container transition-all text-ui-label" type="submit">Subscribe</button>
                </form>
            </div>

            {{-- Quote --}}
            @if($featuredQuote)
            <div class="border-l-4 border-secondary pl-4 py-2">
                <p class="font-article text-article-body-mobile italic text-on-surface-variant">"{{ $featuredQuote->excerpt ?? 'Knowledge is the foundation of health.' }}"</p>
                <span class="text-caption text-outline font-bold mt-2 block">- Elkris Bio Health</span>
            </div>
            @endif
        </aside>
    </div>
</main>
@endsection
