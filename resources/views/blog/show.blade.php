@extends('layouts.public')

@section('title', ($post->seo_title ?? $post->title) . ' - Elkris Bio Health')
@section('meta_description', $post->seo_description ?? $post->excerpt ?? '')

@push('seo')
<meta property="og:title" content="{{ $post->seo_title ?? $post->title }}">
<meta property="og:description" content="{{ $post->seo_description ?? $post->excerpt ?? '' }}">
<meta property="og:type" content="article">
<meta property="og:url" content="{{ route('blog.show', $post) }}">
@if($post->featured_image)
<meta property="og:image" content="{{ Storage::url($post->featured_image) }}">
@endif
<meta name="twitter:card" content="summary_large_image">
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BlogPosting",
  "headline": "{{ $post->title }}",
  "description": "{{ $post->excerpt ?? '' }}",
  "author": {
    "@@type": "Person",
    "name": "{{ $post->author?->name ?? 'Elkris Bio Health' }}"
  },
  "datePublished": "{{ $post->published_at?->toIso8601String() }}",
  "dateModified": "{{ $post->updated_at->toIso8601String() }}",
  "publisher": {
    "@@type": "Organization",
    "name": "Elkris Bio Health Nigeria Limited"
  }
  @if($post->featured_image)
  ,"image": "{{ Storage::url($post->featured_image) }}"
  @endif
}
</script>
@endpush

@section('content')
{{-- Reading Progress Bar --}}
<div class="fixed top-0 left-0 w-full z-[60] bg-surface-variant/30 h-1">
<div class="h-full bg-secondary transition-all duration-150 ease-out" id="reading-progress" style="width:0%"></div>
</div>

{{-- Article Hero --}}
<div class="w-full bg-surface-container-low py-12 md:py-20">
<div class="max-w-[900px] mx-auto px-5">
<div class="flex flex-col gap-6">
    @if($post->category)
    <div class="inline-flex items-center px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container font-ui-label text-ui-label self-start">
        {{ $post->category->name }}
    </div>
    @endif
    <h1 class="font-display-lg-mobile md:font-display-lg text-[32px] md:text-[48px] leading-tight font-bold text-primary">{{ $post->title }}</h1>
    <div class="flex items-center gap-4 text-ui-label text-on-surface-variant">
            <div class="flex items-center gap-3">
                @if($post->author?->avatar)
                <img src="{{ $post->author->avatar_url }}" alt="{{ $post->author->name }}" class="w-10 h-10 rounded-full object-cover">
                @else
                <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container font-bold">
                    {{ strtoupper(substr($post->author?->name ?? 'E', 0, 1)) }}
                </div>
                @endif
            <div class="flex flex-col">
                <span class="font-semibold text-primary">{{ $post->author?->name ?? 'Elkris Bio Health' }}</span>
                <span class="text-caption text-outline">{{ $post->published_at?->format('F j, Y') }} &bull; {{ $post->reading_time }}</span>
            </div>
        </div>
    </div>
</div>
</div>
</div>

{{-- Featured Image --}}
@if($post->featured_image && $post->image_position === 'top')
<div class="max-w-[1280px] mx-auto px-5 -mt-8 md:-mt-12">
<div class="aspect-[21/9] rounded-xl overflow-hidden shadow-xl">
    <img alt="{{ $post->featured_image_caption ?? $post->title }}" class="w-full h-full object-cover" src="{{ Storage::url($post->featured_image) }}"/>
</div>
@if($post->featured_image_caption)
<p class="text-caption text-outline mt-2 text-center">{{ $post->featured_image_caption }}</p>
@endif
</div>
@endif

@if(($post->featured_image && $post->image_position === 'top') || ($post->video && $post->video_position === 'top'))
@if($post->video && $post->video_position === 'top')
<div class="max-w-[1000px] mx-auto px-5 mt-8">
<div class="rounded-xl overflow-hidden shadow-lg bg-black">
    <video class="w-full" controls playsinline>
        <source src="{{ Storage::url($post->video) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>
</div>
@endif
@endif

{{-- Article Content --}}
<article class="max-w-[800px] mx-auto px-5 mt-12 md:mt-16">
<div class="font-article text-article-body-mobile md:text-article-body leading-relaxed text-on-surface dropcap [&_h2]:font-headline-md [&_h2]:text-[24px] md:[&_h2]:text-[32px] [&_h2]:font-semibold [&_h2]:text-primary [&_h2]:mt-8 md:[&_h2]:mt-12 [&_h2]:mb-4 [&_h2]:font-sans [&_h3]:font-headline-sm [&_h3]:text-[20px] md:[&_h3]:text-[24px] [&_h3]:font-semibold [&_h3]:text-primary [&_h3]:mt-6 md:[&_h3]:mt-8 [&_h3]:mb-3 [&_h3]:font-sans [&_p]:mb-6 [&_ul]:mb-6 [&_ul]:list-disc [&_ul]:pl-6 [&_ol]:mb-6 [&_ol]:list-decimal [&_ol]:pl-6 [&_blockquote]:border-l-4 [&_blockquote]:border-secondary [&_blockquote]:pl-6 [&_blockquote]:italic [&_blockquote]:text-on-surface-variant [&_blockquote]:my-8 [&_a]:text-secondary [&_a]:underline [&_a]:hover:text-secondary-fixed-dim [&_img]:rounded-xl [&_img]:my-8 [&_img]:w-full [&_pre]:bg-surface-container-high [&_pre]:rounded-xl [&_pre]:p-4 md:[&_pre]:p-6 [&_pre]:overflow-x-auto [&_pre]:mb-6 [&_code]:text-sm [&_code]:font-mono">
@php
    $bodyContent = $post->body;
    $insertions = [];

    if ($post->video && $post->video_position === 'middle') {
        $insertions[] = '<div class="my-8 rounded-xl overflow-hidden shadow-lg bg-black"><video class="w-full" controls playsinline><source src="'.Storage::url($post->video).'" type="video/mp4">Your browser does not support the video tag.</video></div>';
    }
    if ($post->featured_image && $post->image_position === 'middle') {
        $insertions[] = '<div class="my-8 rounded-xl overflow-hidden shadow-xl"><img src="'.Storage::url($post->featured_image).'" alt="'.$post->featured_image_caption.'" class="w-full" /></div>';
    }

    if (count($insertions) > 0) {
        $halfPoint = strlen(strip_tags($bodyContent)) / 2;
        $paragraphs = preg_split('/<\/p>/i', $bodyContent);
        $cumulativeLength = 0;
        $insertIndex = count($paragraphs) - 1;
        foreach ($paragraphs as $i => $para) {
            $cumulativeLength += strlen(strip_tags($para));
            if ($cumulativeLength >= $halfPoint) {
                $insertIndex = $i;
                break;
            }
        }
        $beforeParts = array_slice($paragraphs, 0, $insertIndex);
        $afterParts = array_slice($paragraphs, $insertIndex);
        $bodyContent = implode('</p>', $beforeParts) . ($insertIndex > 0 ? '</p>' : '') . implode('', $insertions) . implode('</p>', $afterParts);
    }
@endphp
{!! $bodyContent !!}
</div>
</article>

@if(($post->featured_image && $post->image_position === 'end') || ($post->video && $post->video_position === 'end'))
<div class="max-w-[1000px] mx-auto px-5 mt-12">
@if($post->video && $post->video_position === 'end')
<div class="rounded-xl overflow-hidden shadow-lg bg-black">
    <video class="w-full" controls playsinline>
        <source src="{{ Storage::url($post->video) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>
@endif
@if($post->featured_image && $post->image_position === 'end')
<div class="mt-8 rounded-xl overflow-hidden shadow-xl">
    <img alt="{{ $post->featured_image_caption ?? $post->title }}" class="w-full" src="{{ Storage::url($post->featured_image) }}"/>
@if($post->featured_image_caption)
<p class="text-caption text-outline mt-2 text-center">{{ $post->featured_image_caption }}</p>
@endif
</div>
@endif
</div>
@endif

{{-- Article Footer --}}
<div class="max-w-[800px] mx-auto px-5 mt-12 pt-8 border-t border-outline-variant">
<div class="flex items-center gap-4 mb-6">
    <span class="text-caption text-outline font-ui-label">Share:</span>
    <button type="button" onclick="copyPostUrl()" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-surface-container-high hover:bg-secondary hover:text-white text-on-surface-variant text-ui-label transition-colors" id="copy-url-btn">
        <span class="material-symbols-outlined text-lg" id="copy-icon">link</span>
        <span id="copy-text">Copy Link</span>
    </button>
</div>

<div class="flex flex-wrap gap-2 mb-8">
    @foreach($post->tags as $tag)
    <a href="{{ route('blog.tag', $tag) }}" class="inline-flex items-center px-3 py-1 rounded-full border border-outline-variant text-on-surface-variant text-caption hover:bg-surface-container-high hover:border-secondary transition-all no-underline">#{{ $tag->name }}</a>
    @endforeach
</div>

<div class="flex items-center gap-4 p-6 bg-surface-container-low rounded-xl">
    @if($post->author?->avatar)
    <img src="{{ $post->author->avatar_url }}" alt="{{ $post->author->name }}" class="w-14 h-14 rounded-full object-cover">
    @else
    <div class="w-14 h-14 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container font-bold text-xl">
        {{ strtoupper(substr($post->author?->name ?? 'E', 0, 1)) }}
    </div>
    @endif
    <div>
        <span class="font-ui-label font-bold text-primary">Written by {{ $post->author?->name ?? 'Elkris Bio Health' }}</span>
        <p class="text-caption text-outline mt-1">Published {{ $post->published_at?->diffForHumans() }}</p>
    </div>
</div>
</div>

{{-- Related Articles --}}
@if($relatedPosts->count() > 0)
<section class="max-w-[1280px] mx-auto px-5 mt-section-gap">
<h3 class="font-headline-md text-[32px] font-semibold text-primary-container mb-8">Related Articles</h3>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($relatedPosts as $related)
    <a href="{{ route('blog.show', $related) }}" class="bg-white rounded-xl overflow-hidden shadow-sm border border-surface-variant group cursor-pointer hover:shadow-md transition-shadow no-underline">
        <div class="aspect-video bg-surface-container-high relative overflow-hidden">
            @if($related->featured_image)
            <img alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ Storage::url($related->featured_image) }}"/>
            @else
            <div class="w-full h-full flex items-center justify-center text-primary-container/20">
                <span class="material-symbols-outlined text-5xl">image</span>
            </div>
            @endif
        </div>
        <div class="p-6">
            <span class="text-secondary font-bold text-caption tracking-widest uppercase">{{ $related->category?->name ?? 'General' }}</span>
            <h4 class="font-headline-sm text-[24px] font-semibold text-primary group-hover:text-secondary transition-colors mt-2">{{ $related->title }}</h4>
            <p class="text-ui-label text-on-surface-variant line-clamp-2 mt-2">{{ $related->excerpt }}</p>
            <div class="flex items-center gap-2 mt-4 text-caption text-outline">
                <span>{{ $related->published_at?->diffForHumans() }}</span>
                <span>&bull;</span>
                <span>{{ $related->reading_time }}</span>
            </div>
        </div>
    </a>
    @endforeach
</div>
</section>
@endif

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
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const progressBar = document.getElementById('reading-progress');
    if (!progressBar) return;

    const updateProgress = () => {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const progress = docHeight > 0 ? Math.min((scrollTop / docHeight) * 100, 100) : 0;
        progressBar.style.width = progress + '%';
    };

    window.addEventListener('scroll', updateProgress);
    updateProgress();
});

function copyPostUrl() {
    const copyBtn = document.getElementById('copy-url-btn');
    const copyIcon = document.getElementById('copy-icon');
    const copyText = document.getElementById('copy-text');

    navigator.clipboard.writeText(window.location.href).then(() => {
        copyIcon.textContent = 'check';
        copyText.textContent = 'Copied!';
        copyBtn.classList.add('bg-secondary', 'text-white');
        copyBtn.classList.remove('bg-surface-container-high', 'text-on-surface-variant');

        setTimeout(() => {
            copyIcon.textContent = 'link';
            copyText.textContent = 'Copy Link';
            copyBtn.classList.remove('bg-secondary', 'text-white');
            copyBtn.classList.add('bg-surface-container-high', 'text-on-surface-variant');
        }, 2000);
    }).catch(() => {
        copyText.textContent = 'Failed';
        setTimeout(() => {
            copyText.textContent = 'Copy Link';
        }, 2000);
    });
}
</script>
@endpush
