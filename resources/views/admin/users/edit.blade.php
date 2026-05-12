@extends('admin.layouts.admin')

@section('title', 'Edit User - Elkris Bio Health')
@section('header', 'Edit User')

@section('content')
<div class="max-w-2xl">
    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="bg-white rounded-xl border border-surface-variant shadow-sm p-6 space-y-6">
        @csrf
        @method('PUT')

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
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="bg-secondary text-white font-bold px-6 py-3 rounded-lg hover:bg-on-secondary-container transition-all text-ui-label">Update User</button>
            <a href="{{ route('admin.users.index') }}" class="text-outline hover:text-on-surface transition-colors text-ui-label">Cancel</a>
        </div>
    </form>

    @if($user->id !== auth()->id())
    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Delete this user and all their posts? This action cannot be undone.')" class="mt-6">
        @csrf
        @method('DELETE')
        <button type="submit" class="w-full border border-error text-error font-bold px-6 py-3 rounded-lg hover:bg-error-container transition-all text-ui-label">Delete User</button>
    </form>
    @endif
</div>
@endsection