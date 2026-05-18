@extends('admin.layouts.admin')

@section('title', 'Edit User - Elkris Bio Health')
@section('header', 'Edit User')

@section('content')
<div class="max-w-2xl">
    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="bg-white rounded-xl border border-surface-variant shadow-sm p-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Avatar --}}
        <div>
            <label class="font-ui-label font-bold text-primary mb-2 block">Profile Picture</label>
            <div class="flex items-center gap-6">
                <div class="shrink-0">
                    @if($user->avatar)
                    <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-20 h-20 rounded-full object-cover" id="avatar-preview">
                    @else
                    <div class="w-20 h-20 rounded-full bg-secondary/20 text-secondary flex items-center justify-center text-2xl font-bold" id="avatar-preview-container">
                        <span class="material-symbols-outlined text-3xl">person</span>
                    </div>
                    <img id="avatar-preview" class="hidden w-20 h-20 rounded-full object-cover" src="" alt="Preview">
                    @endif
                </div>
                <div class="flex flex-col gap-2">
                    <input type="file" name="avatar" id="avatar" accept="image/jpeg,image/png,image/gif,image/webp" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-secondary/10 file:text-secondary hover:file:bg-secondary/20">
                    <p class="text-xs text-outline">JPEG, PNG, GIF, WebP. Max 5MB.</p>
                    @error('avatar') <p class="text-error text-caption mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div>
            <label class="font-ui-label font-bold text-primary mb-2 block">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest" required>
            @error('name') <p class="text-error text-caption mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="font-ui-label font-bold text-primary mb-2 block">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest" required>
            @error('email') <p class="text-error text-caption mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="border-t border-outline-variant pt-4">
            <label class="font-ui-label font-bold text-primary mb-2 block">New Password <span class="text-outline font-normal">(leave blank to keep current)</span></label>
            <input type="password" name="password" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest">
            @error('password') <p class="text-error text-caption mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="font-ui-label font-bold text-primary mb-2 block">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest">
        </div>

        <div class="border-t border-outline-variant pt-4 space-y-4">
            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_admin" id="is_admin" value="1" class="w-5 h-5 rounded border-outline-variant text-secondary focus:ring-secondary" @checked(old('is_admin', $user->is_admin))>
                <label for="is_admin" class="font-ui-label text-on-surface">Admin privileges</label>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_restricted" id="is_restricted" value="1" class="w-5 h-5 rounded border-outline-variant text-error focus:ring-error" @checked(old('is_restricted', $user->is_restricted))>
                <label for="is_restricted" class="font-ui-label text-on-surface">Restricted <span class="text-outline font-normal">(user cannot create posts)</span></label>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="can_view_newsletter" id="can_view_newsletter" value="1" class="w-5 h-5 rounded border-outline-variant text-secondary focus:ring-secondary" @checked(old('can_view_newsletter', $user->can_view_newsletter))>
                <label for="can_view_newsletter" class="font-ui-label text-on-surface">Can view newsletter subscribers</label>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="can_view_contacts" id="can_view_contacts" value="1" class="w-5 h-5 rounded border-outline-variant text-secondary focus:ring-secondary" @checked(old('can_view_contacts', $user->can_view_contacts))>
                <label for="can_view_contacts" class="font-ui-label text-on-surface">Can view contact messages</label>
            </div>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="bg-secondary text-white font-bold px-6 py-3 rounded-lg hover:bg-on-secondary-container transition-all text-ui-label">Update User</button>
            <a href="{{ route('admin.users.index') }}" class="text-outline hover:text-on-surface transition-colors text-ui-label">Cancel</a>
        </div>
    </form>

    @if($user->id !== auth()->id())
    <button type="button" class="w-full border border-error text-error font-bold px-6 py-3 rounded-lg hover:bg-error-container transition-all text-ui-label mt-6"
        @click="confirmModal = {
            show: true,
            title: 'Delete User',
            message: 'Delete this user and all their posts? This action cannot be undone.',
            action: '{{ route('admin.users.destroy', $user) }}',
            method: 'DELETE',
            buttonText: 'Delete'
        }">
        Delete User
    </button>
    @endif
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
@endsection