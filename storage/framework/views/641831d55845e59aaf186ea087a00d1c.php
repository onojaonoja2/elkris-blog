<?php $__env->startSection('title', 'Contact Us - Blood Sugar Friendly Foods - Elkris Bio Health'); ?>
<?php $__env->startSection('meta_description', 'Get in touch with Elkris Bio Health Nigeria Limited. Contact us for blood sugar friendly foods inquiries, corporate office details, or send us a message.'); ?>

<?php $__env->startPush('seo'); ?>
<meta property="og:title" content="Contact Us - Blood Sugar Friendly Foods - Elkris Bio Health">
<meta property="og:description" content="Get in touch with Elkris Bio Health Nigeria Limited for blood sugar friendly foods inquiries.">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo e(url()->current()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<section class="bg-primary-container relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-primary-container via-primary-container/95 to-secondary/80"></div>
    <div class="relative z-10 max-w-[1280px] mx-auto px-5 py-16 md:py-24 flex flex-col md:flex-row items-center gap-8">
        <div class="md:w-1/2 text-center md:text-left">
            <span class="bg-secondary-container text-on-secondary-container text-caption font-bold px-4 py-1 rounded-full uppercase tracking-wider inline-block mb-4">Get in Touch</span>
            <h1 class="font-display-lg-mobile md:font-display-lg text-[32px] md:text-[48px] leading-tight font-bold text-primary-fixed mb-4">Contact Elkris Bio Health</h1>
            <p class="font-article text-primary-fixed-dim opacity-90 max-w-lg">We are here to answer your questions and provide the scientific health information you need.</p>
        </div>
        <div class="md:w-1/2 flex justify-center">
            <span class="material-symbols-outlined text-primary-fixed text-[180px] opacity-30">support_agent</span>
        </div>
    </div>
</section>


<section class="max-w-[1280px] mx-auto px-5 py-section-gap">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        
        <div>
            <h2 class="font-headline-md text-[32px] font-semibold text-primary-container mb-8">Our Office</h2>

            <div class="space-y-8">
                <div class="flex gap-4">
                    <span class="material-symbols-outlined text-secondary text-3xl shrink-0">location_on</span>
                    <div>
                        <h3 class="font-ui-label font-bold text-primary mb-1">Address</h3>
                        <p class="text-on-surface-variant text-ui-label">Elkris Foods Corporate Office<br>
                        No 14, Philomena Street,<br>
                        Egbeda Lagos State, Nigeria.</p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <span class="material-symbols-outlined text-secondary text-3xl shrink-0">mail</span>
                    <div>
                        <h3 class="font-ui-label font-bold text-primary mb-1">Email</h3>
                        <a href="mailto:info@elkrisfoods.com" class="text-secondary text-ui-label hover:underline">info@elkrisfoods.com</a>
                    </div>
                </div>

                <div class="flex gap-4">
                    <span class="material-symbols-outlined text-secondary text-3xl shrink-0">call</span>
                    <div>
                        <h3 class="font-ui-label font-bold text-primary mb-1">Phone</h3>
                        <a href="tel:+2348173296383" class="text-secondary text-ui-label hover:underline">+2348173296383</a>
                        <p class="text-caption text-outline">Elkris Foods Corporate Office</p>
                    </div>
                </div>
            </div>

            <div class="mt-10 bg-surface-container-low rounded-xl p-6 border border-outline-variant">
                <h3 class="font-ui-label font-bold text-primary mb-2">Office Hours</h3>
                <p class="text-on-surface-variant text-ui-label">Monday - Friday: 8:00 AM - 5:00 PM<br>
                Saturday: 9:00 AM - 2:00 PM<br>
                Sunday: Closed</p>
            </div>
        </div>

        
        <div>
            <h2 class="font-headline-md text-[32px] font-semibold text-primary-container mb-8">Send Us a Message</h2>

            <div class="bg-white rounded-xl border border-surface-variant shadow-sm p-8">
                <?php if(session('success')): ?>
                <div class="bg-primary-fixed/20 text-primary-fixed text-caption px-4 py-3 rounded-lg mb-6 border border-primary-fixed/30">✓ <?php echo e(session('success')); ?></div>
                <?php endif; ?>

                <div class="newsletter-msg hidden"></div>

                <form method="POST" action="<?php echo e(route('contact.store')); ?>" id="contact-form">
                    <?php echo csrf_field(); ?>
                    <div class="space-y-5">
                        <div>
                            <label for="name" class="text-ui-label font-medium text-primary mb-1 block">Full Name</label>
                            <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>" required
                                class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-container-lowest text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-error text-caption mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="email" class="text-ui-label font-medium text-primary mb-1 block">Email Address</label>
                            <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" required
                                class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-container-lowest text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all">
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-error text-caption mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="message" class="text-ui-label font-medium text-primary mb-1 block">Message</label>
                            <textarea name="message" id="message" rows="6" required
                                class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-container-lowest text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all resize-y"><?php echo e(old('message')); ?></textarea>
                            <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-error text-caption mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <button type="submit"
                            class="w-full bg-primary-container text-white font-bold px-8 py-4 rounded-lg hover:bg-secondary transition-all shadow-lg text-ui-label">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('contact-form');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        var btn = this.querySelector('button[type="submit"]');
        var originalText = btn.textContent;
        btn.disabled = true;
        btn.textContent = 'Sending...';

        var msgContainer = this.querySelector('.newsletter-msg');
        if (msgContainer) msgContainer.classList.add('hidden');

        var existingMsg = this.querySelector('.contact-msg');
        if (existingMsg) existingMsg.remove();

        fetch('<?php echo e(route('contact.store')); ?>', {
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
            msg.className = 'contact-msg text-caption px-4 py-3 rounded-lg mb-6 border';

            if (result.status === 422) {
                var firstError = '';
                var errors = result.data.errors;
                if (errors) {
                    for (var key in errors) {
                        firstError = errors[key][0];
                        break;
                    }
                }
                msg.className += ' bg-error/10 text-error border-error/30';
                msg.textContent = firstError || 'Please fix the errors above.';
            } else {
                msg.className += ' bg-primary-fixed/20 text-primary-fixed border-primary-fixed/30';
                msg.textContent = result.data.message;
                form.querySelector('input[name="name"]').value = '';
                form.querySelector('input[name="email"]').value = '';
                form.querySelector('textarea[name="message"]').value = '';
            }

            form.insertBefore(msg, form.firstChild);
        })
        .catch(function () {
            var msg = document.createElement('div');
            msg.className = 'contact-msg text-caption px-4 py-3 rounded-lg mb-6 border bg-error/10 text-error border-error/30';
            msg.textContent = 'Something went wrong. Please try again.';
            form.insertBefore(msg, form.firstChild);
        })
        .finally(function () {
            btn.disabled = false;
            btn.textContent = originalText;
        });
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Onoja\Documents\Elkris\Projects\elkris-blog\resources\views/blog/contact.blade.php ENDPATH**/ ?>