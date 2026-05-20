<?php $__env->startSection('title', 'Elkris Bio Health - Home of Blood Sugar Friendly Alternative Foods'); ?>

<?php $__env->startSection('meta_description', 'Discover blood sugar friendly alternative foods, evidence-based nutrition science, bio-clinical research, and wellness insights from Elkris Bio Health Nigeria Limited.'); ?>

<?php $__env->startPush('seo'); ?>
<meta property="og:title" content="Elkris Bio Health - Home of Blood Sugar Friendly Alternative Foods">
<meta property="og:description" content="Discover blood sugar friendly alternative foods, evidence-based nutrition science, and bio-clinical wellness insights.">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo e(url()->current()); ?>">
<meta name="twitter:card" content="summary_large_image">
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Blog",
  "name": "Elkris Bio Health Blog",
  "alternateName": "Home of Blood Sugar Friendly Alternative Foods",
  "description": "Discover blood sugar friendly alternative foods, evidence-based nutrition science, and bio-clinical wellness insights."
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="w-full">
    
    <section class="max-w-[1280px] mx-auto px-5 pt-4 md:pt-6">
        <div class="relative w-full rounded-xl overflow-hidden shadow-sm bg-surface-container-low flex flex-col md:flex-row min-h-[350px]">
            <div class="w-full md:w-3/5 h-64 md:h-auto relative">
                <img alt="Elkris Bio Health" class="w-full h-full object-cover" src="<?php echo e(asset('sugar_alternative.jpeg')); ?>"/>
                <div class="absolute top-4 left-4">
                    <span class="bg-primary-container text-on-primary text-caption font-bold px-4 py-1 rounded-full uppercase tracking-wider">Editor's Choice</span>
                </div>
            </div>
            <div class="w-full md:w-2/5 p-6 md:p-8 flex flex-col justify-center gap-4 relative <?php if(!is_null($featuredPost) && !empty($featuredPost->featured_image)): ?> bg-cover bg-center before:absolute before:inset-0 before:bg-gradient-to-r before:from-primary-container/95 before:to-primary-container/80 <?php endif; ?>" <?php if(!is_null($featuredPost) && !empty($featuredPost->featured_image)): ?> style="background-image: url('<?php echo e(Storage::url($featuredPost->featured_image)); ?>')" <?php endif; ?>>
                <?php if(!is_null($featuredPost)): ?>
                <div class="relative z-10 flex items-center gap-2 <?php echo e(!empty($featuredPost->featured_image) ? 'text-secondary-container' : 'text-secondary'); ?>">
                    <span class="material-symbols-outlined text-[18px]">clinical_notes</span>
                    <span class="text-ui-label font-bold"><?php echo e($featuredPost->category?->name ?? 'Research Insight'); ?></span>
                </div>
                <h2 class="relative z-10 font-display-lg-mobile md:font-display-lg text-[32px] md:text-[48px] leading-tight font-bold <?php echo e(!empty($featuredPost->featured_image) ? 'text-primary-fixed' : 'text-primary-container'); ?>"><?php echo e($featuredPost->title); ?></h2>
                <p class="relative z-10 text-article-body-mobile md:text-article-body font-article <?php echo e(!empty($featuredPost->featured_image) ? 'text-primary-fixed-dim' : 'text-on-surface-variant'); ?>"><?php echo e($featuredPost->excerpt); ?></p>
                <div class="relative z-10 flex items-center gap-4 mt-2">
                    <a href="<?php echo e(route('blog.show', $featuredPost)); ?>" class="bg-secondary text-on-secondary px-8 py-3 rounded-lg font-ui-label text-ui-label font-bold hover:bg-secondary-container transition-all shadow-md active:scale-95 inline-block">Read Article</a>
                    <span class="text-caption <?php echo e(!empty($featuredPost->featured_image) ? 'text-primary-fixed-dim' : 'text-outline'); ?> font-medium"><?php echo e($featuredPost->reading_time); ?></span>
                </div>
                <?php else: ?>
                <div class="flex items-center gap-2 text-secondary">
                    <span class="material-symbols-outlined text-[18px]">clinical_notes</span>
                    <span class="text-ui-label font-bold">Welcome</span>
                </div>
                <h2 class="font-display-lg-mobile md:font-display-lg text-[32px] md:text-[48px] leading-tight font-bold text-primary-container">Scientific Vitality for a Healthier Nigeria</h2>
                <p class="text-article-body-mobile md:text-article-body text-on-surface-variant font-article">Elkris Bio Health Nigeria Limited brings you evidence-based wellness, nutrition science, and bio-clinical research tailored to the African context.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    
    <section class="mt-section-gap overflow-hidden">
        <div class="max-w-[1280px] mx-auto px-5 mb-6 flex justify-between items-end">
            <div>
                <h3 class="font-headline-md text-[32px] font-semibold text-primary-container">Trending in Health</h3>
                <p class="text-on-surface-variant font-ui-label">Expert-vetted health science for your daily life.</p>
            </div>
        </div>
        <div class="flex overflow-x-auto gap-6 px-5 no-scrollbar pb-8 max-w-[1280px] mx-auto">
            <?php if(count($trendingPosts) > 0): ?>
            <?php $__currentLoopData = $trendingPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('blog.show', $post)); ?>" class="min-w-[280px] md:min-w-[320px] bg-white rounded-xl shadow-sm border border-surface-variant p-4 flex flex-col gap-4 group cursor-pointer hover:shadow-md transition-shadow no-underline">
                <div class="aspect-video rounded-lg overflow-hidden relative bg-surface-container-high">
                    <?php if(!empty($post->featured_image)): ?>
                    <img alt="<?php echo e($post->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="<?php echo e(Storage::url($post->featured_image)); ?>"/>
                    <?php else: ?>
                    <div class="w-full h-full flex items-center justify-center text-primary-container/20">
                        <span class="material-symbols-outlined text-6xl">image</span>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="flex flex-col gap-2">
                    <span class="text-secondary font-bold text-caption tracking-widest uppercase"><?php echo e($post->category?->name ?? 'General'); ?></span>
                    <h4 class="font-headline-sm text-[24px] font-semibold text-primary group-hover:text-secondary transition-colors"><?php echo e($post->title); ?></h4>
                    <div class="flex items-center justify-between text-caption text-outline mt-2">
                        <span><?php echo e($post->author?->name); ?></span>
                        <span><?php echo e($post->reading_time); ?></span>
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <div class="min-w-[280px] bg-white rounded-xl shadow-sm border border-surface-variant p-8 text-center">
                <p class="text-on-surface-variant">No trending articles yet. Check back soon.</p>
            </div>
            <?php endif; ?>
        </div>
    </section>

    
    <section class="mt-section-gap max-w-[1280px] mx-auto px-5">
        <h3 class="font-headline-md text-[32px] font-semibold text-primary-container mb-8">Recent Scientific Insights</h3>
        <?php if($recentPosts->count() > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <div class="md:col-span-8 group">
                <a href="<?php echo e(route('blog.show', $recentPosts->first())); ?>" class="no-underline">
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-surface-variant h-full flex flex-col md:flex-row">
                        <div class="md:w-1/2 h-64 md:h-auto bg-surface-container-high">
                            <?php if(!empty($recentPosts->first()->featured_image)): ?>
                            <img alt="<?php echo e($recentPosts->first()->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="<?php echo e(Storage::url($recentPosts->first()->featured_image)); ?>"/>
                            <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center text-primary-container/20">
                                <span class="material-symbols-outlined text-7xl">image</span>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="md:w-1/2 p-8 flex flex-col justify-between">
                            <div class="flex flex-col gap-4">
                                <div class="flex gap-2">
                                    <?php if(!is_null($recentPosts->first()->category)): ?>
                                    <span class="bg-surface-container-high text-primary-container text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-tighter"><?php echo e($recentPosts->first()->category->name); ?></span>
                                    <?php endif; ?>
                                </div>
                                <h4 class="font-headline-md text-[32px] font-semibold text-primary group-hover:text-secondary transition-colors"><?php echo e($recentPosts->first()->title); ?></h4>
                                <p class="text-on-surface-variant text-article-body-mobile font-article"><?php echo e($recentPosts->first()->excerpt); ?></p>
                            </div>
                            <div class="flex items-center gap-4 pt-6 border-t border-outline-variant mt-6">
                                <span class="material-symbols-outlined text-secondary text-[18px]">schedule</span>
                                <span class="text-ui-label text-on-surface-variant font-medium"><?php echo e($recentPosts->first()->published_at?->diffForHumans()); ?> &bull; <?php echo e($recentPosts->first()->reading_time); ?></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="md:col-span-4 flex flex-col gap-6">
                <?php $__currentLoopData = $recentPosts->skip(1)->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('blog.show', $post)); ?>" class="bg-white rounded-xl p-6 border border-surface-variant shadow-sm group cursor-pointer hover:border-secondary transition-colors no-underline">
                    <span class="bg-surface-container-high text-primary-container text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-tighter mb-4 inline-block"><?php echo e($post->category?->name ?? 'General'); ?></span>
                    <h4 class="font-headline-sm text-[24px] font-semibold text-primary group-hover:text-secondary transition-colors mb-2"><?php echo e($post->title); ?></h4>
                    <p class="text-on-surface-variant text-ui-label line-clamp-2"><?php echo e($post->excerpt); ?></p>
                    <div class="flex items-center gap-2 mt-4 text-caption text-outline">
                        <span class="material-symbols-outlined text-[16px]">schedule</span>
                        <span><?php echo e($post->published_at?->diffForHumans()); ?> &bull; <?php echo e($post->reading_time); ?></span>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php else: ?>
        <div class="text-center py-16">
            <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">menu_book</span>
            <h4 class="font-headline-sm text-[24px] font-semibold text-primary-container mb-2">No Articles Yet</h4>
            <p class="text-on-surface-variant">Our team is working on publishing new insights. Stay tuned!</p>
        </div>
        <?php endif; ?>
    </section>

    
    <section class="mt-section-gap max-w-[1280px] mx-auto px-5">
        <div class="bg-primary-container rounded-xl p-6 md:p-16 relative overflow-hidden flex flex-col md:flex-row items-center gap-8 md:gap-12">
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
                <?php if(session('success')): ?>
                <div class="bg-primary-fixed/20 text-primary-fixed text-caption px-4 py-3 rounded-lg mb-4 border border-primary-fixed/30">✓ <?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <?php if($errors->has('email')): ?>
                <div class="bg-error/10 text-error text-caption px-4 py-3 rounded-lg mb-4 border border-error/30"><?php echo e($errors->first('email')); ?></div>
                <?php endif; ?>
                <form class="flex flex-col gap-4" method="POST" action="<?php echo e(route('newsletter.store')); ?>">
                    <?php echo csrf_field(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Onoja\Documents\Elkris\Projects\elkris-blog\resources\views/blog/index.blade.php ENDPATH**/ ?>