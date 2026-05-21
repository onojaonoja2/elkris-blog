<?php $__env->startSection('title', 'Posts - Elkris Bio Health'); ?>
<?php $__env->startSection('header', 'Posts'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6 flex justify-between items-center">
    <p class="text-on-surface-variant text-ui-label"><?php echo e($posts->total()); ?> total posts</p>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Post::class)): ?>
    <a href="<?php echo e(route('admin.posts.create')); ?>" class="bg-primary-container text-on-primary px-6 py-2 rounded-lg font-ui-label text-ui-label font-bold hover:bg-secondary transition-all flex items-center gap-2">
        <span class="material-symbols-outlined text-[18px]">add</span>
        New Post
    </a>
    <?php endif; ?>
</div>

<div class="bg-white rounded-xl border border-surface-variant shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
    <table class="w-full">
        <thead>
            <tr class="border-b border-surface-variant bg-surface-container-low">
                <th class="text-left px-6 py-4 text-ui-label font-bold text-primary">Title</th>
                <th class="text-left px-6 py-4 text-ui-label font-bold text-primary hidden md:table-cell">Category</th>
                <?php if(Auth::user()->isAdmin()): ?>
                <th class="text-left px-6 py-4 text-ui-label font-bold text-primary hidden md:table-cell">Author</th>
                <?php endif; ?>
                <th class="text-left px-6 py-4 text-ui-label font-bold text-primary">Views</th>
                <th class="text-left px-6 py-4 text-ui-label font-bold text-primary">Status</th>
                <th class="text-left px-6 py-4 text-ui-label font-bold text-primary hidden lg:table-cell">Date</th>
                <th class="text-right px-6 py-4 text-ui-label font-bold text-primary">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-surface-variant">
            <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-surface-container-low transition-colors">
                <td class="px-6 py-4">
                    <a href="<?php echo e(route('admin.posts.edit', $post)); ?>" class="font-ui-label font-medium text-primary hover:text-secondary transition-colors"><?php echo e($post->title); ?></a>
                </td>
                <td class="px-6 py-4 text-ui-label text-on-surface-variant hidden md:table-cell"><?php echo e($post->category?->name ?? '-'); ?></td>
                <?php if(Auth::user()->isAdmin()): ?>
                <td class="px-6 py-4 text-ui-label text-on-surface-variant hidden md:table-cell"><?php echo e($post->author?->name); ?></td>
                <?php endif; ?>
                <td class="px-6 py-4 text-ui-label text-outline"><?php echo e(number_format($post->views_count)); ?></td>
                <td class="px-6 py-4">
                    <?php if($post->is_published): ?>
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed text-caption font-medium">Published</span>
                    <?php else: ?>
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-surface-container-high text-on-surface-variant text-caption font-medium">Draft</span>
                    <?php endif; ?>
                </td>
                <td class="px-6 py-4 text-caption text-outline hidden lg:table-cell"><?php echo e($post->created_at->format('M j, Y')); ?></td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <?php if($post->is_published): ?>
                        <button onclick="copyPostUrl('<?php echo e(route('blog.show', $post)); ?>', this)" class="p-2 text-outline hover:text-secondary transition-colors" title="Copy link">
                            <span class="material-symbols-outlined">link</span>
                        </button>
                        <?php endif; ?>
                        <a href="<?php echo e(route('blog.show', $post)); ?>" class="p-2 text-outline hover:text-secondary transition-colors" title="Preview" target="_blank">
                            <span class="material-symbols-outlined">visibility</span>
                        </a>
                        <a href="<?php echo e(route('admin.posts.edit', $post)); ?>" class="p-2 text-outline hover:text-secondary transition-colors" title="Edit">
                            <span class="material-symbols-outlined">edit</span>
                        </a>
                        <button class="p-2 text-outline hover:text-error transition-colors" title="Delete"
                            @click="confirmModal = {
                                show: true,
                                title: 'Delete Post',
                                message: 'Delete this post? This action cannot be undone.',
                                action: '<?php echo e(route('admin.posts.destroy', $post)); ?>',
                                method: 'DELETE',
                                buttonText: 'Delete'
                            }">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="<?php echo e(Auth::user()->isAdmin() ? 7 : 6); ?>" class="px-6 py-12 text-center">
                    <span class="material-symbols-outlined text-5xl text-outline-variant mb-2 block">article</span>
                    <p class="text-on-surface-variant text-ui-label">No posts yet.</p>
                    <a href="<?php echo e(route('admin.posts.create')); ?>" class="text-secondary hover:underline text-ui-label mt-2 inline-block">Create your first post</a>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
</div>

<?php if($posts->hasPages()): ?>
<div class="mt-6">
    <?php echo e($posts->links()); ?>

</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function copyPostUrl(url, btn) {
    navigator.clipboard.writeText(url).then(() => {
        const icon = btn.querySelector('span');
        icon.textContent = 'check';
        setTimeout(() => {
            icon.textContent = 'link';
        }, 1500);
    });
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Onoja\Documents\Elkris\Projects\elkris-blog\resources\views/admin/posts/index.blade.php ENDPATH**/ ?>