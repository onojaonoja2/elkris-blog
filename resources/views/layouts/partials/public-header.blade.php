<header class="bg-surface border-b border-surface-variant shadow-sm sticky top-0 z-50">
<div class="flex items-center justify-between px-5 h-16 w-full max-w-[1280px] mx-auto">
<div class="flex items-center gap-2">
    <a href="{{ route('home') }}" class="flex items-center gap-2 no-underline">
        <img src="{{ asset('dashboard-login.jpeg') }}" alt="Elkris Bio Health" class="w-8 h-8 md:w-10 md:h-10 object-contain rounded" />
        <span class="font-headline-sm text-[24px] font-bold tracking-tight text-primary-container">Elkris Bio Health</span>
    </a>
</div>
<nav class="hidden md:flex items-center gap-8">
<a href="{{ route('home') }}" class="font-ui-label text-ui-label font-medium text-on-surface-variant hover:text-secondary transition-colors duration-200 @if(request()->routeIs('home')) text-secondary font-bold @endif">Blog Home</a>
<a href="{{ route('blog.category', 'nutrition') }}" class="font-ui-label text-ui-label font-medium text-on-surface-variant hover:text-secondary transition-colors duration-200">Categories</a>
<a href="{{ route('blog.resources') }}" class="font-ui-label text-ui-label font-medium text-on-surface-variant hover:text-secondary transition-colors duration-200">Resources</a>
<a href="{{ route('contact') }}" class="font-ui-label text-ui-label font-medium text-on-surface-variant hover:text-secondary transition-colors duration-200 @if(request()->routeIs('contact')) text-secondary font-bold @endif">Contact</a>
</nav>
<div class="flex items-center gap-3">
@auth
<a href="{{ route('admin.dashboard') }}" class="bg-primary-container text-white px-6 py-2 rounded-lg font-ui-label text-ui-label hover:bg-secondary transition-all active:scale-95 shadow-sm">Dashboard</a>
@else
<a href="{{ route('login') }}" class="text-ui-label text-outline hover:text-secondary transition-colors duration-200 font-medium">Sign In</a>
<a href="{{ route('login') }}" class="bg-primary-container text-white px-6 py-2 rounded-lg font-ui-label text-ui-label hover:bg-secondary transition-all active:scale-95 shadow-sm">Get Started</a>
@endauth
</div>
</div>
</header>
