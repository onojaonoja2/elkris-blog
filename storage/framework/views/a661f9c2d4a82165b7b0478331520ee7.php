<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="keywords" content="blood sugar friendly foods, diabetes nutrition, healthy alternatives, low glycemic foods, Elkris Bio Health, wellness, nutrition science">
<meta name="author" content="Elkris Bio Health Nigeria Limited">
<meta name="application-name" content="Elkris Bio Health">

<title><?php echo $__env->yieldContent('title', 'Elkris Bio Health - Home of Blood Sugar Friendly Alternative Foods'); ?></title>
<meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Discover blood sugar friendly alternative foods, evidence-based nutrition science, and bio-clinical wellness insights from Elkris Bio Health Nigeria Limited.'); ?>">

<!-- Canonical URL -->
<link rel="canonical" href="<?php echo e(URL::current()); ?>">

<!-- Open Graph -->
<meta property="og:type" content="<?php echo $__env->yieldContent('og_type', 'website'); ?>">
<meta property="og:site_name" content="Elkris Bio Health">
<meta property="og:title" content="<?php echo $__env->yieldContent('og_title', 'Elkris Bio Health - Home of Blood Sugar Friendly Alternative Foods'); ?>">
<meta property="og:description" content="<?php echo $__env->yieldContent('og_description', 'Discover blood sugar friendly alternative foods, evidence-based nutrition science, and bio-clinical wellness insights.'); ?>">
<meta property="og:url" content="<?php echo e(URL::current()); ?>">
<meta property="og:locale" content="en_US">
<meta property="og:image" content="<?php echo $__env->yieldContent('og_image', asset('dashboard-login.jpeg')); ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@elkrisbiohealth">
<meta name="twitter:title" content="<?php echo $__env->yieldContent('twitter_title', 'Elkris Bio Health - Home of Blood Sugar Friendly Alternative Foods'); ?>">
<meta name="twitter:description" content="<?php echo $__env->yieldContent('twitter_description', 'Discover blood sugar friendly alternative foods and wellness insights.'); ?>">
<meta name="twitter:image" content="<?php echo $__env->yieldContent('og_image', asset('dashboard-login.jpeg')); ?>">

<!-- Structured Data - Organization -->
<script type="application/ld+json">

{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Elkris Bio Health Nigeria Limited",
    "alternateName": "Elkris Bio Health",
    "url": "https://elkrisbiohealth.com",
    "logo": "/dashboard-login.jpeg",
    "description": "Home of Blood Sugar Friendly Alternative Foods - Evidence-based nutrition science and bio-clinical wellness insights.",
    "slogan": "Scientific Vitality",
    "areaServed": "Nigeria",
    "sameAs": [
        "https://www.facebook.com/elkrisbiohealth",
        "https://www.instagram.com/elkrisbiohealth",
        "https://www.linkedin.com/company/elkrisbiohealth"
    ]
}

</script>

<link rel="icon" type="image/svg+xml" href="<?php echo e(asset('favicon.svg')); ?>">
<link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">

<?php echo $__env->yieldPushContent('seo'); ?>

<?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-background text-on-surface font-sans antialiased selection:bg-primary-fixed selection:text-on-primary-fixed">

<?php echo $__env->make('layouts.partials.public-header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<main>
<?php echo $__env->yieldContent('content'); ?>
</main>

<?php echo $__env->make('layouts.partials.public-footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->yieldPushContent('scripts'); ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('form[action="<?php echo e(route('newsletter.store')); ?>"]').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            var btn = this.querySelector('button[type="submit"]');
            var originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Subscribing...';

            var msgContainer = this.querySelector('.newsletter-msg');
            if (msgContainer) msgContainer.remove();

            fetch('<?php echo e(route('newsletter.store')); ?>', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
            })
            .then(function (response) {
                return response.json().then(function (data) {
                    return { status: response.status, data: data };
                });
            })
            .then(function (result) {
                var msg = document.createElement('div');
                msg.className = 'newsletter-msg text-caption px-4 py-3 rounded-lg mb-4 border';

                if (result.status === 422) {
                    var errorMsg = result.data.errors ? (result.data.errors.email ? result.data.errors.email[0] : 'Validation error.') : 'Something went wrong.';
                    msg.className += ' bg-error/10 text-error border-error/30';
                    msg.textContent = errorMsg;
                } else {
                    msg.className += ' bg-primary-fixed/20 text-primary-fixed border-primary-fixed/30';
                    msg.textContent = result.data.message;
                    form.querySelector('input[type="email"]').value = '';
                }

                form.insertBefore(msg, form.firstChild);
            })
            .catch(function () {
                var msg = document.createElement('div');
                msg.className = 'newsletter-msg text-caption px-4 py-3 rounded-lg mb-4 border bg-error/10 text-error border-error/30';
                msg.textContent = 'Something went wrong. Please try again.';
                form.insertBefore(msg, form.firstChild);
            })
            .finally(function () {
                btn.disabled = false;
                btn.textContent = originalText;
            });
        });
    });
});
</script>
</body>
</html>
<?php /**PATH C:\Users\Onoja\Documents\Elkris\Projects\elkris-blog\resources\views/layouts/public.blade.php ENDPATH**/ ?>