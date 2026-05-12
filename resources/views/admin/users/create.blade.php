@extends('admin.layouts.admin')

@section('title', 'Create User - Elkris Bio Health')
@section('header', 'New User')

@section('content')
<div class="max-w-2xl">
    <form method="POST" action="{{ route('admin.users.store') }}" class="bg-white rounded-xl border border-surface-variant shadow-sm p-6 space-y-6">
        @csrf

        <div>
            <label class="font-ui-label font-bold text-primary mb-2 block">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest" required>
            @error('name') <p class="text-error text-caption mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="font-ui-label font-bold text-primary mb-2 block">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest" required>
            @error('email') <p class="text-error text-caption mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="font-ui-label font-bold text-primary mb-2 block">Password</label>
            <input type="password" name="password" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest" required>
            @error('password') <p class="text-error text-caption mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="font-ui-label font-bold text-primary mb-2 block">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest" required>
        </div>

        <div class="flex items-center gap-3">
            <input type="checkbox" name="is_admin" id="is_admin" value="1" class="w-5 h-5 rounded border-outline-variant text-secondary focus:ring-secondary" @checked(old('is_admin'))>
            <label for="is_admin" class="font-ui-label text-on-surface">Grant admin privileges</label>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="bg-secondary text-white font-bold px-6 py-3 rounded-lg hover:bg-on-secondary-container transition-all text-ui-label">Create User</button>
            <a href="{{ route('admin.users.index') }}" class="text-outline hover:text-on-surface transition-colors text-ui-label">Cancel</a>
        </div>
    </form>
</div>
@endsection