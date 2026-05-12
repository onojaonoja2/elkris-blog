@extends('layouts.public')

@section('title', 'Elkris Bio Health - Scientific Vitality Blog')

@section('meta_description', 'Evidence-based nutrition science, bio-clinical research, and wellness insights from Elkris Bio Health Nigeria Limited.')

@push('seo')
<meta property="og:title" content="Elkris Bio Health - Scientific Vitality Blog">
<meta property="og:description" content="Evidence-based nutrition science, bio-clinical research, and wellness insights.">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta name="twitter:card" content="summary_large_image">
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Blog",
  "name": "Elkris Bio Health Blog",
  "description": "Evidence-based nutrition science, bio-clinical research, and wellness insights."
}
</script>
@endpush

@section('content')
<div class="w-full">
    {{-- Hero Section --}}
    <section class="max-w-[1280px] mx-auto px-5 pt-8 md:pt-12">
        <div class="relative w-full rounded-xl overflow-hidden shadow-sm bg-surface-container-low flex flex-col md:flex-row min-h-[500px]">
            <div class="w-full md:w-3/5 h-64 md:h-auto relative">
                <img alt="Elkris Bio Health" class="w-full h-full object-cover" src="{{ asset('elkris_foods_Image.jpeg') }}"/>
                <div class="absolute top-4 left-4">
                    <span class="bg-primary-container text-on-primary text-caption font-bold px-4 py-1 rounded-full uppercase tracking-wider">Editor's Choice</span>
                </div>
            </div>
            <div class="w-full md:w-2/5 p-8 md:p-12 flex flex-col justify-center gap-6">
                @if (!is_null($featuredPost))
                <div class="flex items-center gap-2 text-secondary">
                    <span class="material-symbols-outlined text-[18px]">clinical_notes</span>
                    <span class="text-ui-label font-bold">{{ $featuredPost->category?->name ?? 'Research Insight' }}</span>
                </div>
                <h2 class="font-display-lg-mobile md:font-display-lg text-[32px] md:text-[48px] leading-tight font-bold text-primary-container">{{ $featuredPost->title }}</h2>
                <p class="text-article-body-mobile md:text-article-body text-on-surface-variant font-article">{{ $featuredPost->excerpt }}</p>
                <div class="flex items-center gap-4 mt-2">
                    <a href="{{ route('blog.show', $featuredPost) }}" class="bg-primary-container text-on-primary px-8 py-3 rounded-lg font-ui-label text-ui-label font-bold hover:bg-secondary transition-all shadow-md active:scale-95 inline-block">Read Article</a>
                    <span class="text-caption text-outline font-medium">{{ $featuredPost->reading_time }}</span>
                </div>
                @else
                <div class="flex items-center gap-2 text-secondary">
                    <span class="material-symbols-outlined text-[18px]">clinical_notes</span>
                    <span class="text-ui-label font-bold">Welcome</span>
                </div>
                <h2 class="font-display-lg-mobile md:font-display-lg text-[32px] md:text-[48px] leading-tight font-bold text-primary-container">Scientific Vitality for a Healthier Nigeria</h2>
                <p class="text-article-body-mobile md:text-article-body text-on-surface-variant font-article">Elkris Bio Health Nigeria Limited brings you evidence-based wellness, nutrition science, and bio-clinical research tailored to the African context.</p>
                @endif
            </div>
        </div>
    </section>

    {{-- Trending Section --}}
    <section class="mt-section-gap overflow-hidden">
        <div class="max-w-[1280px] mx-auto px-5 mb-6 flex justify-between items-end">
            <div>
                <h3 class="font-headline-md text-[32px] font-semibold text-primary-container">Trending in Health</h3>
                <p class="text-on-surface-variant font-ui-label">Expert-vetted health science for your daily life.</p>
            </div>
        </div>
        <div class="flex overflow-x-auto gap-6 px-5 no-scrollbar pb-8 max-w-[1280px] mx-auto">
            @if (count($trendingPosts) > 0)
            @foreach ($trendingPosts as $post)
            <a href="{{ route('blog.show', $post) }}" class="min-w-[280px] md:min-w-[320px] bg-white rounded-xl shadow-sm border border-surface-variant p-4 flex flex-col gap-4 group cursor-pointer hover:shadow-md transition-shadow no-underline">
                <div class="aspect-video rounded-lg overflow-hidden relative bg-surface-container-high">
                    @if (!empty($post->featured_image))
                    <img alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ Storage::url($post->featured_image) }}"/>
                    @else
                    <div class="w-full h-full flex items-center justify-center text-primary-container/20">
                        <span class="material-symbols-outlined text-6xl">image</span>
                    </div>
                    @endif
                </div>
                <div class="flex flex-col gap-2">
                    <span class="text-secondary font-bold text-caption tracking-widest uppercase">{{ $post->category?->name ?? 'General' }}</span>
                    <h4 class="font-headline-sm text-[24px] font-semibold text-primary group-hover:text-secondary transition-colors">{{ $post->title }}</h4>
                    <div class="flex items-center justify-between text-caption text-outline mt-2">
                        <span>{{ $post->author?->name }}</span>
                        <span>{{ $post->reading_time }}</span>
                    </div>
                </div>
            </a>
            @endforeach
            @else
            <div class="min-w-[280px] bg-white rounded-xl shadow-sm border border-surface-variant p-8 text-center">
                <p class="text-on-surface-variant">No trending articles yet. Check back soon.</p>
            </div>
            @endif
        </div>
    </section>

    {{-- Recent Articles --}}
    <section class="mt-section-gap max-w-[1280px] mx-auto px-5">
        <h3 class="font-headline-md text-[32px] font-semibold text-primary-container mb-8">Recent Scientific Insights</h3>
        @if ($recentPosts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <div class="md:col-span-8 group">
                <a href="{{ route('blog.show', $recentPosts->first()) }}" class="no-underline">
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-surface-variant h-full flex flex-col md:flex-row">
                        <div class="md:w-1/2 h-64 md:h-auto bg-surface-container-high">
                            @if (!empty($recentPosts->first()->featured_image))
                            <img alt="{{ $recentPosts->first()->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="{{ Storage::url($recentPosts->first()->featured_image) }}"/>
                            @else
                            <div class="w-full h-full flex items-center justify-center text-primary-container/20">
                                <span class="material-symbols-outlined text-7xl">image</span>
                            </div>
                            @endif
                        </div>
                        <div class="md:w-1/2 p-8 flex flex-col justify-between">
                            <div class="flex flex-col gap-4">
                                <div class="flex gap-2">
                                    @if (!is_null($recentPosts->first()->category))
                                    <span class="bg-surface-container-high text-primary-container text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-tighter">{{ $recentPosts->first()->category->name }}</span>
                                    @endif
                                </div>
                                <h4 class="font-headline-md text-[32px] font-semibold text-primary group-hover:text-secondary transition-colors">{{ $recentPosts->first()->title }}</h4>
                                <p class="text-on-surface-variant text-article-body-mobile font-article">{{ $recentPosts->first()->excerpt }}</p>
                            </div>
                            <div class="flex items-center gap-4 pt-6 border-t border-outline-variant mt-6">
                                <span class="material-symbols-outlined text-secondary text-[18px]">schedule</span>
                                <span class="text-ui-label text-on-surface-variant font-medium">{{ $recentPosts->first()->published_at?->diffForHumans() }} &bull; {{ $recentPosts->first()->reading_time }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="md:col-span-4 flex flex-col gap-6">
                @foreach ($recentPosts->skip(1)->take(2) as $post)
                <a href="{{ route('blog.show', $post) }}" class="bg-white rounded-xl p-6 border border-surface-variant shadow-sm group cursor-pointer hover:border-secondary transition-colors no-underline">
                    <span class="bg-surface-container-high text-primary-container text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-tighter mb-4 inline-block">{{ $post->category?->name ?? 'General' }}</span>
                    <h4 class="font-headline-sm text-[24px] font-semibold text-primary group-hover:text-secondary transition-colors mb-2">{{ $post->title }}</h4>
                    <p class="text-on-surface-variant text-ui-label line-clamp-2">{{ $post->excerpt }}</p>
                    <div class="flex items-center gap-2 mt-4 text-caption text-outline">
                        <span class="material-symbols-outlined text-[16px]">schedule</span>
                        <span>{{ $post->published_at?->diffForHumans() }} &bull; {{ $post->reading_time }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @else
        <div class="text-center py-16">
            <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">menu_book</span>
            <h4 class="font-headline-sm text-[24px] font-semibold text-primary-container mb-2">No Articles Yet</h4>
            <p class="text-on-surface-variant">Our team is working on publishing new insights. Stay tuned!</p>
        </div>
        @endif
    </section>

    {{-- Newsletter Section --}}
    <section class="mt-section-gap max-w-[1280px] mx-auto px-5">
        <div class="bg-primary-container rounded-xl p-8 md:p-16 relative overflow-hidden flex flex-col md:flex-row items-center gap-12">
            <div class="absolute top-0 right-0 w-1/2 h-full opacity-10 pointer-events-none">
                <svg class="w-full h-full translate-x-1/4 scale-150" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path d="M44.7,-76.4C58.1,-69.2,69.5,-57.4,78.2,-43.8C86.9,-30.2,93,-15.1,91.8,-0.7C90.5,13.7,82.1,27.3,72.4,39.6C62.8,51.8,52,62.6,39.1,70.9C26.1,79.2,13.1,85,0.1,84.9C-12.9,84.8,-25.8,78.8,-38,71.2C-50.2,63.6,-61.7,54.4,-70.7,42.6C-79.6,30.8,-86,15.4,-86.7,-0.4C-87.3,-16.2,-82.2,-32.4,-73.2,-46.1C-64.2,-59.8,-51.3,-71,-37.2,-77.7C-23.1,-84.4,-7.8,-86.6,7.8,-90.1C23.4,-93.6,44.7,-83.5,44.7,-76.4Z" fill="#ffffff" transform="translate(100 100)"></path>
                </svg>
            </div>
            <div class="relative z-10 md:w-1/2 text-center md:text-left">
                <h2 class="font-display-lg-mobile md:font-display-lg text-[32px] md:text-[48px] leading-tight font-bold text-primary-fixed mb-4">Vitality Newsletter</h2>
                <p class="font-article text-primary-fixed-dim opacity-90 max-w-md">Join health professionals receiving weekly evidence-based wellness briefings delivered directly to your inbox.</p>
            </div>
            <div class="relative z-10 md:w-1/2 w-full">
                @if(session('success'))
                <div class="bg-primary-fixed/20 text-primary-fixed text-caption px-4 py-3 rounded-lg mb-4 border border-primary-fixed/30">✓ {{ session('success') }}</div>
                @endif
                @if($errors->has('email'))
                <div class="bg-error/10 text-error text-caption px-4 py-3 rounded-lg mb-4 border border-error/30">{{ $errors->first('email') }}</div>
                @endif
                <form class="flex flex-col gap-4" method="POST" action="{{ route('newsletter.store') }}">
                    @csrf
                    <div class="flex flex-col gap-1">
                        <label class="text-white text-ui-label mb-1" for="email-sub">Professional Email Address</label>
                        <div class="flex flex-col md:flex-row gap-4">
                            <input class="flex-grow bg-white border border-outline-variant px-6 py-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary text-primary-container text-ui-label" id="email-sub" placeholder="email@example.com" type="email" name="email" required/>
                            <button class="bg-secondary text-white font-bold px-8 py-4 rounded-lg hover:bg-on-secondary-container transition-all shadow-lg text-ui-label" type="submit">Subscribe</button>
                        </div>
                    </div>
                    <p class="text-on-primary-container text-caption">By subscribing, you agree to our <a class="underline" href="#">Privacy Policy</a>. No spam, only science.</p>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
