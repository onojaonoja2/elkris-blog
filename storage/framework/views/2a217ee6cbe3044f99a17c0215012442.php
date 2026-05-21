<?php $__env->startSection('title', 'Dashboard - Elkris Bio Health'); ?>
<?php $__env->startSection('header', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl border border-surface-variant p-6 shadow-sm">
        <div class="flex items-center justify-between mb-2">
            <span class="material-symbols-outlined text-secondary text-3xl">article</span>
            <span class="text-caption text-outline">Total</span>
        </div>
        <p class="font-headline-sm text-[24px] font-semibold text-primary"><?php echo e($totalPosts); ?></p>
        <p class="text-caption text-outline">Total Posts</p>
    </div>
    <div class="bg-white rounded-xl border border-surface-variant p-6 shadow-sm">
        <div class="flex items-center justify-between mb-2">
            <span class="material-symbols-outlined text-secondary text-3xl">publish</span>
            <span class="text-caption text-outline">Published</span>
        </div>
        <p class="font-headline-sm text-[24px] font-semibold text-primary"><?php echo e($publishedPosts); ?></p>
        <p class="text-caption text-outline">Published Posts</p>
    </div>
    <div class="bg-white rounded-xl border border-surface-variant p-6 shadow-sm">
        <div class="flex items-center justify-between mb-2">
            <span class="material-symbols-outlined text-secondary text-3xl">draft</span>
            <span class="text-caption text-outline">Drafts</span>
        </div>
        <p class="font-headline-sm text-[24px] font-semibold text-primary"><?php echo e($draftPosts); ?></p>
        <p class="text-caption text-outline">Draft Posts</p>
    </div>
    <div class="bg-white rounded-xl border border-surface-variant p-6 shadow-sm">
        <div class="flex items-center justify-between mb-2">
            <span class="material-symbols-outlined text-secondary text-3xl">category</span>
            <span class="text-caption text-outline"><?php echo e($totalTags); ?> tags</span>
        </div>
        <p class="font-headline-sm text-[24px] font-semibold text-primary"><?php echo e($totalCategories); ?></p>
        <p class="text-caption text-outline">Categories</p>
    </div>
    <?php if(!is_null($totalUsers)): ?>
    <a href="<?php echo e(route('admin.users.index')); ?>" class="bg-white rounded-xl border border-surface-variant p-6 shadow-sm hover:border-secondary transition-colors no-underline">
        <div class="flex items-center justify-between mb-2">
            <span class="material-symbols-outlined text-secondary text-3xl">group</span>
            <span class="text-caption text-outline">Users</span>
        </div>
        <p class="font-headline-sm text-[24px] font-semibold text-primary"><?php echo e($totalUsers); ?></p>
        <p class="text-caption text-outline">Manage Users</p>
    </a>
    <?php endif; ?>
    <?php if(auth()->user()->canViewNewsletter()): ?>
    <a href="<?php echo e(route('admin.newsletter-subscribers.index')); ?>" class="bg-white rounded-xl border border-surface-variant p-6 shadow-sm hover:border-secondary transition-colors no-underline">
        <div class="flex items-center justify-between mb-2">
            <span class="material-symbols-outlined text-secondary text-3xl">mail</span>
            <span class="text-caption text-outline">Subscribers</span>
        </div>
        <p class="font-headline-sm text-[24px] font-semibold text-primary"><?php echo e($totalSubscribers); ?></p>
        <p class="text-caption text-outline">Newsletter Subscribers</p>
    </a>
    <?php endif; ?>
    <?php if(auth()->user()->canViewContacts()): ?>
    <a href="<?php echo e(route('admin.contact-messages.index')); ?>" class="bg-white rounded-xl border border-surface-variant p-6 shadow-sm hover:border-secondary transition-colors no-underline">
        <div class="flex items-center justify-between mb-2">
            <span class="material-symbols-outlined text-secondary text-3xl">forum</span>
            <span class="text-caption text-outline">Messages</span>
        </div>
        <p class="font-headline-sm text-[24px] font-semibold text-primary"><?php echo e($totalContactMessages); ?></p>
        <p class="text-caption text-outline">Contact Messages</p>
    </a>
    <?php endif; ?>
</div>

<div class="bg-white rounded-xl border border-surface-variant shadow-sm">
    <div class="px-6 py-4 border-b border-surface-variant">
        <h3 class="font-headline-sm text-[24px] font-semibold text-primary">Recent Posts</h3>
    </div>
    <div class="divide-y divide-surface-variant">
        <?php $__empty_1 = true; $__currentLoopData = $recentPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div class="flex-1 min-w-0">
                <a href="<?php echo e(route('admin.posts.edit', $post)); ?>" class="font-ui-label font-medium text-primary hover:text-secondary transition-colors truncate block"><?php echo e($post->title); ?></a>
                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mt-1">
                    <span class="text-caption text-outline"><?php echo e($post->author?->name); ?></span>
                    <span class="text-caption text-outline hidden sm:inline">&bull;</span>
                    <span class="text-caption text-outline"><?php echo e($post->category?->name ?? 'Uncategorized'); ?></span>
                    <span class="text-caption text-outline hidden sm:inline">&bull;</span>
                    <?php if($post->is_published): ?>
                    <span class="text-caption text-primary-fixed-dim font-medium">Published</span>
                    <?php else: ?>
                    <span class="text-caption text-outline font-medium">Draft</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="text-caption text-outline shrink-0">
                <?php echo e($post->created_at->diffForHumans()); ?>

            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="px-6 py-8 text-center">
            <p class="text-on-surface-variant text-ui-label">No posts yet. <a href="<?php echo e(route('admin.posts.create')); ?>" class="text-secondary hover:underline">Create your first post</a></p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Onoja\Documents\Elkris\Projects\elkris-blog\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>