<?php $__env->startSection('title', 'Create User - Elkris Bio Health'); ?>
<?php $__env->startSection('header', 'New User'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl">
    <form method="POST" action="<?php echo e(route('admin.users.store')); ?>" class="bg-white rounded-xl border border-surface-variant shadow-sm p-6 space-y-6" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        
        <div>
            <label class="font-ui-label font-bold text-primary mb-2 block">Profile Picture</label>
            <div class="flex items-center gap-6">
                <div class="shrink-0">
                    <div class="w-20 h-20 rounded-full bg-secondary/20 text-secondary flex items-center justify-center text-2xl font-bold" id="avatar-preview-container">
                        <span class="material-symbols-outlined text-3xl">person</span>
                    </div>
                    <img id="avatar-preview" class="hidden w-20 h-20 rounded-full object-cover" src="" alt="Preview">
                </div>
                <div class="flex flex-col gap-2">
                    <input type="file" name="avatar" id="avatar" accept="image/jpeg,image/png,image/gif,image/webp" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-secondary/10 file:text-secondary hover:file:bg-secondary/20">
                    <p class="text-xs text-outline">JPEG, PNG, GIF, WebP. Max 5MB.</p>
                    <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-error text-caption mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        <div>
            <label class="font-ui-label font-bold text-primary mb-2 block">Name</label>
            <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest" required>
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
            <label class="font-ui-label font-bold text-primary mb-2 block">Email</label>
            <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest" required>
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
            <label class="font-ui-label font-bold text-primary mb-2 block">Password</label>
            <input type="password" name="password" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest" required>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-error text-caption mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
            <label class="font-ui-label font-bold text-primary mb-2 block">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest" required>
        </div>

        <div class="flex items-center gap-3">
            <input type="checkbox" name="is_admin" id="is_admin" value="1" class="w-5 h-5 rounded border-outline-variant text-secondary focus:ring-secondary" <?php if(old('is_admin')): echo 'checked'; endif; ?>>
            <label for="is_admin" class="font-ui-label text-on-surface">Grant admin privileges</label>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="bg-secondary text-white font-bold px-6 py-3 rounded-lg hover:bg-on-secondary-container transition-all text-ui-label">Create User</button>
            <a href="<?php echo e(route('admin.users.index')); ?>" class="text-outline hover:text-on-surface transition-colors text-ui-label">Cancel</a>
        </div>
    </form>
</div>

<script>
document.getElementById('avatar')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            const container = document.getElementById('avatar-preview-container');
            const img = document.getElementById('avatar-preview');
            if (container) container.classList.add('hidden');
            if (img) {
                img.src = ev.target.result;
                img.classList.remove('hidden');
            }
        };
        reader.readAsDataURL(file);
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Onoja\Documents\Elkris\Projects\elkris-blog\resources\views/admin/users/create.blade.php ENDPATH**/ ?>