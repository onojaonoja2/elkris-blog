<?php $__env->startSection('title', 'Users - Elkris Bio Health'); ?>
<?php $__env->startSection('header', 'Users'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-xl border border-surface-variant shadow-sm overflow-hidden">
    <div class="p-6 border-b border-surface-variant flex items-center justify-between">
        <p class="text-ui-label text-outline"><?php echo e($users->total()); ?> users</p>
        <a href="<?php echo e(route('admin.users.create')); ?>" class="bg-secondary text-white font-bold px-4 py-2 rounded-lg hover:bg-on-secondary-container transition-all text-ui-label inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">add</span>
            New User
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-surface-container-low text-left text-ui-label font-bold text-outline">
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4 hidden md:table-cell">Email</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Posts</th>
                    <th class="px-6 py-4 hidden lg:table-cell">Joined</th>
                    <th class="px-6 py-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/50">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-surface-container-lowest transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <?php if($user->avatar): ?>
                            <img src="<?php echo e($user->avatar_url); ?>" alt="<?php echo e($user->name); ?>" class="w-8 h-8 rounded-full object-cover">
                            <?php else: ?>
                            <div class="w-8 h-8 rounded-full bg-secondary/20 text-secondary flex items-center justify-center text-sm font-bold">
                                <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                            </div>
                            <?php endif; ?>
                            <span class="font-ui-label font-semibold"><?php echo e($user->name); ?></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-ui-label text-outline hidden md:table-cell"><?php echo e($user->email); ?></td>
                    <td class="px-6 py-4">
                        <?php if($user->is_admin): ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-primary-container text-primary-fixed text-caption font-semibold">
                                <span class="material-symbols-outlined text-[14px]">admin_panel_settings</span>
                                Admin
                            </span>
                        <?php elseif($user->is_restricted): ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-error-container text-error text-caption font-semibold">
                                <span class="material-symbols-outlined text-[14px]">block</span>
                                Restricted
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-surface-container-high text-on-surface-variant text-caption font-semibold">
                                <span class="material-symbols-outlined text-[14px]">person</span>
                                Author
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-ui-label text-outline"><?php echo e($user->posts_count); ?></td>
                    <td class="px-6 py-4 text-caption text-outline hidden lg:table-cell"><?php echo e($user->created_at->format('M d, Y')); ?></td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <a href="<?php echo e(route('admin.users.edit', $user)); ?>" class="p-2 rounded-lg text-outline hover:bg-surface-container-high transition-colors" title="Edit">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </a>
                            <?php if($user->id !== auth()->id()): ?>
                            <button type="button" class="p-2 rounded-lg text-error hover:bg-error-container transition-colors" title="Delete"
                                @click="confirmModal = {
                                    show: true,
                                    title: 'Delete User',
                                    message: 'Delete this user and all their posts? This action cannot be undone.',
                                    action: '<?php echo e(route('admin.users.destroy', $user)); ?>',
                                    method: 'DELETE',
                                    buttonText: 'Delete'
                                }">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <?php if($users->isEmpty()): ?>
    <div class="text-center py-16">
        <span class="material-symbols-outlined text-5xl text-outline-variant mb-4">group</span>
        <p class="text-ui-label text-outline">No users found.</p>
    </div>
    <?php endif; ?>

    <div class="p-6 border-t border-surface-variant">
        <?php echo e($users->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Onoja\Documents\Elkris\Projects\elkris-blog\resources\views/admin/users/index.blade.php ENDPATH**/ ?>