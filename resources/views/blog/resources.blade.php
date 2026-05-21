@extends('layouts.public')

@section('title', 'Health Resource Center - Blood Sugar Friendly Foods - Elkris Bio Health')
@section('meta_description', 'Download scientific guides, research papers, and health resources on blood sugar friendly foods from Elkris Bio Health.')

@push('seo')
<meta property="og:title" content="Health Resource Center - Blood Sugar Friendly Foods - Elkris Bio Health">
<meta property="og:description" content="Download scientific guides, research papers, and health resources on blood sugar friendly foods.">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
@endpush

@section('content')
{{-- Hero --}}
<section class="bg-primary-container relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-primary-container via-primary-container/95 to-secondary/80"></div>
    <div class="relative z-10 max-w-[1280px] mx-auto px-5 py-16 md:py-24 flex flex-col md:flex-row items-center gap-8">
        <div class="md:w-1/2 text-center md:text-left">
            <span class="bg-secondary-container text-on-secondary-container text-caption font-bold px-4 py-1 rounded-full uppercase tracking-wider inline-block mb-4">Resource Library</span>
            <h1 class="font-display-lg-mobile md:font-display-lg text-[32px] md:text-[48px] leading-tight font-bold text-primary-fixed mb-4">Scientific Resource Center</h1>
            <p class="font-article text-primary-fixed-dim opacity-90 max-w-lg">Access our curated library of evidence-based guides, clinical research summaries, and wellness manuals.</p>
            <a href="#downloads" class="inline-block bg-secondary text-white font-bold px-8 py-4 rounded-lg hover:bg-on-secondary-container transition-all shadow-lg mt-6 text-ui-label">Download Guides</a>
        </div>
        <div class="md:w-1/2 flex justify-center">
            <span class="material-symbols-outlined text-primary-fixed text-[180px] opacity-30">menu_book</span>
        </div>
    </div>
</section>

    {{-- Downloads Section --}}
    <section id="downloads" class="max-w-[1280px] mx-auto px-5 py-section-gap">
        <h2 class="font-headline-md text-[32px] font-semibold text-primary-container mb-8">Scientific Downloads</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($posts->take(6) as $post)
            <div class="@if($loop->first) md:col-span-2 @endif bg-white rounded-xl border border-surface-variant shadow-sm overflow-hidden flex flex-col @if($loop->first) md:flex-row @endif">
                @if($loop->first)
                <div class="md:w-2/5 bg-surface-container-high p-8 flex items-center justify-center">
                    @if($post->featured_image)
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover rounded-lg" style="max-height: 200px;">
                    @else
                    <span class="material-symbols-outlined text-primary-container text-8xl">picture_as_pdf</span>
                    @endif
                </div>
                <div class="md:w-3/5 p-8 flex flex-col justify-between">
                @else
                <div class="p-8 flex flex-col h-full">
                @endif
                    <div>
                        @if($loop->first)
                        <span class="bg-secondary-container text-on-secondary-container text-caption font-bold px-3 py-1 rounded-full uppercase tracking-tighter">Featured</span>
                        @else
                        <span class="material-symbols-outlined text-secondary text-4xl mb-4">description</span>
                        @endif
                        <h3 class="font-headline-sm text-[24px] font-semibold text-primary mt-3 mb-2">{{ $post->title }}</h3>
                        <p class="text-on-surface-variant text-ui-label @if(!$loop->first) flex-1 @endif">{{ $post->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($post->body), 150) }}</p>
                    </div>
                    <div class="flex items-center gap-4 mt-6 pt-6 border-t border-outline-variant @if(!$loop->first) mt-auto @endif">
                        <span class="text-caption text-outline">{{ $post->reading_time }} &bull; {{ $post->category?->name ?? 'General' }}</span>
                        <a href="{{ route('blog.resources.download', $post->slug) }}" class="ml-auto @if($loop->first) bg-primary-container text-on-primary px-6 py-2 rounded-lg font-ui-label text-ui-label hover:bg-secondary transition-all text-sm @else text-secondary font-bold text-ui-label hover:underline @endif">Download</a>
                    </div>
                @if($loop->first)
                </div>
                @else
                </div>
                @endif
            </div>
            @empty
            <div class="md:col-span-3 text-center py-16">
                <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">picture_as_pdf</span>
                <p class="text-on-surface-variant text-ui-label">No downloadable resources available yet. Check back soon!</p>
            </div>
            @endforelse
        </div>
    </section>

{{-- Categories --}}
<section class="max-w-[1280px] mx-auto px-5 pb-section-gap">
    <h2 class="font-headline-md text-[32px] font-semibold text-primary-container mb-8">Browse by Category</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($categories as $cat)
        <a href="{{ route('blog.category', $cat) }}" class="bg-white rounded-xl border border-surface-variant shadow-sm p-6 group hover:border-secondary transition-all no-underline">
            <span class="material-symbols-outlined text-secondary text-3xl mb-3">category</span>
            <h3 class="font-headline-sm text-[24px] font-semibold text-primary group-hover:text-secondary transition-colors">{{ $cat->name }}</h3>
            <p class="text-caption text-outline mt-1">{{ $cat->posts_count ?? 0 }} articles</p>
        </a>
        @endforeach
    </div>
</section>

{{-- FAQ Section --}}
<section class="bg-surface-container-low py-section-gap">
    <div class="max-w-[1280px] mx-auto px-5">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h2 class="font-headline-md text-[32px] font-semibold text-primary-container mb-4">Frequently Asked Questions</h2>
                <p class="text-on-surface-variant text-ui-label mb-6">Have more questions? Reach out to our team.</p>
                <div class="bg-secondary-container rounded-xl p-6">
                    <span class="material-symbols-outlined text-secondary text-3xl mb-3">support_agent</span>
                    <h4 class="font-ui-label font-bold text-on-secondary-container">Need Expert Help?</h4>
                    <p class="text-caption text-on-secondary-container/80 mb-4">Our health advisors are ready to assist you.</p>
                    <a href="{{ route('contact') }}" class="inline-block bg-secondary text-white font-bold px-6 py-3 rounded-lg hover:bg-on-secondary-container transition-all text-ui-label text-sm">Contact an Expert</a>
                </div>
            </div>
            <div class="md:col-span-2 space-y-4">
                <details class="bg-white rounded-xl border border-surface-variant p-6 group">
                    <summary class="flex items-center justify-between cursor-pointer font-ui-label font-bold text-primary list-none">
                        What is the scientific approach behind Elkris Bio Health's recommendations?
                        <span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <div class="mt-4 pt-4 border-t border-outline-variant text-ui-label text-on-surface-variant">
                        Our recommendations are based on peer-reviewed clinical research, systematic reviews, and meta-analyses. We prioritize evidence from reputable journals and translate complex findings into actionable health guidance.
                    </div>
                </details>
                <details class="bg-white rounded-xl border border-surface-variant p-6 group">
                    <summary class="flex items-center justify-between cursor-pointer font-ui-label font-bold text-primary list-none">
                        Are the resources free to download?
                        <span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <div class="mt-4 pt-4 border-t border-outline-variant text-ui-label text-on-surface-variant">
                        Yes, all our scientific guides and resources are available for free download. We believe evidence-based health information should be accessible to everyone.
                    </div>
                </details>
                <details class="bg-white rounded-xl border border-surface-variant p-6 group">
                    <summary class="flex items-center justify-between cursor-pointer font-ui-label font-bold text-primary list-none">
                        How often is new content published?
                        <span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <div class="mt-4 pt-4 border-t border-outline-variant text-ui-label text-on-surface-variant">
                        We publish new articles weekly and update our resource library monthly. Subscribe to our newsletter to stay informed about the latest publications.
                    </div>
                </details>
            </div>
        </div>
    </div>
</section>
@endsection
