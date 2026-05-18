<header class="bg-surface border-b border-surface-variant shadow-sm sticky top-0 z-50" x-data="{ mobileOpen: false }">
<div class="flex items-center justify-between px-5 h-16 w-full max-w-[1280px] mx-auto">
<div class="flex items-center gap-2 min-w-0">
    <a href="{{ route('home') }}" class="flex items-center gap-2 no-underline min-w-0">
        <img src="{{ asset('dashboard-login.jpeg') }}" alt="Elkris Bio Health" class="w-8 h-8 md:w-10 md:h-10 object-contain rounded shrink-0" />
    </a>
</div>
<nav class="hidden md:flex items-center gap-8">
<a href="{{ route('home') }}" class="font-ui-label text-ui-label font-medium text-on-surface-variant hover:text-secondary transition-colors duration-200 @if(request()->routeIs('home')) text-secondary font-bold @endif">Blog Home</a>
<a href="{{ route('blog.all') }}" class="font-ui-label text-ui-label font-medium text-on-surface-variant hover:text-secondary transition-colors duration-200 @if(request()->routeIs('blog.category') || request()->routeIs('blog.all')) text-secondary font-bold @endif">Categories</a>
<a href="{{ route('blog.resources') }}" class="font-ui-label text-ui-label font-medium text-on-surface-variant hover:text-secondary transition-colors duration-200 @if(request()->routeIs('blog.resources')) text-secondary font-bold @endif">Resources</a>
<a href="{{ route('contact') }}" class="font-ui-label text-ui-label font-medium text-on-surface-variant hover:text-secondary transition-colors duration-200 @if(request()->routeIs('contact')) text-secondary font-bold @endif">Contact</a>
</nav>
<div class="flex items-center gap-2 md:gap-3">
    <button class="md:hidden flex items-center p-2 text-primary-container" @click="mobileOpen = !mobileOpen" aria-label="Toggle navigation">
        <span class="material-symbols-outlined text-2xl" x-text="mobileOpen ? 'close' : 'menu'">menu</span>
    </button>
    <div class="hidden md:flex items-center gap-2 md:gap-3">
    @auth
    <a href="{{ route('admin.dashboard') }}" class="bg-primary-container text-white px-4 md:px-6 py-2 rounded-lg font-ui-label text-ui-label hover:bg-secondary transition-all active:scale-95 shadow-sm text-sm md:text-base">Dashboard</a>
    @else
    <a href="{{ route('login') }}" class="text-ui-label text-sm md:text-base text-outline hover:text-secondary transition-colors duration-200 font-medium whitespace-nowrap">Sign In</a>
    <a href="{{ route('login') }}" class="bg-primary-container text-white px-4 md:px-6 py-2 rounded-lg font-ui-label text-ui-label hover:bg-secondary transition-all active:scale-95 shadow-sm text-sm md:text-base whitespace-nowrap">Get Started</a>
    @endauth
    </div>
</div>
</div>

{{-- Mobile Navigation --}}
<div x-show="mobileOpen" x-cloak class="md:hidden fixed inset-0 z-40 bg-surface pt-16"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 -translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-2">
    <nav class="flex flex-col px-5 py-6 gap-2">
        <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-ui-label text-ui-label font-medium text-on-surface-variant hover:bg-surface-container-high hover:text-secondary transition-colors @if(request()->routeIs('home')) bg-surface-container-high text-secondary font-bold @endif" @click="mobileOpen = false">
            <span class="material-symbols-outlined text-[18px]">home</span>
            Blog Home
        </a>
        <a href="{{ route('blog.all') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-ui-label text-ui-label font-medium text-on-surface-variant hover:bg-surface-container-high hover:text-secondary transition-colors @if(request()->routeIs('blog.category') || request()->routeIs('blog.all')) bg-surface-container-high text-secondary font-bold @endif" @click="mobileOpen = false">
            <span class="material-symbols-outlined text-[18px]">category</span>
            Categories
        </a>
        <a href="{{ route('blog.resources') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-ui-label text-ui-label font-medium text-on-surface-variant hover:bg-surface-container-high hover:text-secondary transition-colors @if(request()->routeIs('blog.resources')) bg-surface-container-high text-secondary font-bold @endif" @click="mobileOpen = false">
            <span class="material-symbols-outlined text-[18px]">menu_book</span>
            Resources
        </a>
        <a href="{{ route('contact') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-ui-label text-ui-label font-medium text-on-surface-variant hover:bg-surface-container-high hover:text-secondary transition-colors @if(request()->routeIs('contact')) bg-surface-container-high text-secondary font-bold @endif" @click="mobileOpen = false">
            <span class="material-symbols-outlined text-[18px]">mail</span>
            Contact
        </a>
        <div class="border-t border-surface-variant mt-4 pt-4 flex flex-col gap-3">
            @auth
            <a href="{{ route('admin.dashboard') }}" class="bg-primary-container text-white px-4 py-3 rounded-lg font-ui-label text-ui-label hover:bg-secondary transition-all active:scale-95 shadow-sm text-center">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="text-ui-label text-base text-outline hover:text-secondary transition-colors duration-200 font-medium text-center">Sign In</a>
            <a href="{{ route('login') }}" class="bg-primary-container text-white px-4 py-3 rounded-lg font-ui-label text-ui-label hover:bg-secondary transition-all active:scale-95 shadow-sm text-center">Get Started</a>
            @endauth
        </div>
    </nav>
</div>
</header>
