<footer class="bg-surface-container-lowest w-full border-t border-outline-variant mt-section-gap">
<div class="w-full px-5 py-8 flex flex-col items-center gap-4 max-w-[1280px] mx-auto">
<div class="flex flex-col sm:flex-row items-center sm:items-start gap-3">
<img src="{{ asset('dashboard-login.jpeg') }}" alt="Elkris Bio Health" class="h-9 w-auto" />
<div class="text-center sm:text-left">
<div class="font-headline-sm text-[24px] font-bold text-primary-container">Elkris Bio Health</div>
<div class="text-caption text-on-surface-variant opacity-80">&copy; {{ date('Y') }} Elkris Bio Health Nigeria Limited. Scientific Vitality.</div>
</div>
</div>
<nav class="flex flex-wrap justify-center gap-6 mb-4">
<a href="{{ route('home') }}" class="text-ui-label text-on-surface-variant hover:text-secondary underline decoration-secondary/30 transition-all">Home</a>
<a href="{{ route('blog.category', 'nutrition') }}" class="text-ui-label text-on-surface-variant hover:text-secondary underline decoration-secondary/30 transition-all">Categories</a>
<a href="{{ route('blog.resources') }}" class="text-ui-label text-on-surface-variant hover:text-secondary underline decoration-secondary/30 transition-all">Resources</a>
<a href="{{ route('contact') }}" class="text-ui-label text-on-surface-variant hover:text-secondary underline decoration-secondary/30 transition-all">Contact Us</a>
</nav>
<div class="flex gap-4 text-primary-container justify-center">
<span class="material-symbols-outlined cursor-pointer hover:text-secondary transition-colors">science</span>
<span class="material-symbols-outlined cursor-pointer hover:text-secondary transition-colors">health_and_safety</span>
<span class="material-symbols-outlined cursor-pointer hover:text-secondary transition-colors">biotech</span>
</div>
</div>
</footer>
