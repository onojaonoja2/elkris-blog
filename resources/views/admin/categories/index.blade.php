@extends('admin.layouts.admin')

@section('title', 'Categories - Elkris Bio Health')
@section('header', 'Categories')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    {{-- Create/Edit Form --}}
    <div class="bg-white rounded-xl border border-surface-variant shadow-sm p-6">
        <h3 class="font-headline-sm text-[24px] font-semibold text-primary mb-4">Add New Category</h3>
        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="font-ui-label font-bold text-primary mb-2 block">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest" placeholder="e.g. Nutrition" required/>
                @error('name') <p class="text-error text-caption mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="font-ui-label font-bold text-primary mb-2 block">Description</label>
                <textarea name="description" rows="2" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest" placeholder="Brief description...">{{ old('description') }}</textarea>
            </div>
            <div class="flex items-center gap-3">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                    <div class="w-9 h-5 bg-outline-variant peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-secondary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-secondary"></div>
                </label>
                <span class="text-ui-label text-on-surface-variant">Active</span>
            </div>
            <button type="submit" class="bg-primary-container text-on-primary px-6 py-3 rounded-lg font-ui-label text-ui-label font-bold hover:bg-secondary transition-all">Create Category</button>
        </form>
    </div>

    {{-- Category List --}}
    <div class="bg-white rounded-xl border border-surface-variant shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-surface-variant">
            <h3 class="font-headline-sm text-[24px] font-semibold text-primary">All Categories</h3>
        </div>
        <div class="divide-y divide-surface-variant">
            @forelse($categories as $cat)
            <div class="px-6 py-4 flex items-center justify-between">
                <div>
                    <span class="font-ui-label font-medium text-primary">{{ $cat->name }}</span>
                    <div class="flex items-center gap-3 mt-1">
                        <span class="text-caption text-outline">{{ $cat->posts_count }} posts</span>
                        @if(!$cat->is_active)
                        <span class="text-caption text-outline">Inactive</span>
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="editCategory({{ $cat->id }}, '{{ $cat->name }}', '{{ $cat->description }}', {{ $cat->is_active ? 'true' : 'false' }})" class="p-2 text-outline hover:text-secondary transition-colors">
                        <span class="material-symbols-outlined">edit</span>
                    </button>
                    <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" onsubmit="return confirm('Delete this category?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="p-2 text-outline hover:text-error transition-colors">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center">
                <p class="text-on-surface-variant text-ui-label">No categories yet.</p>
            </div>
            @endforelse
        </div>
        @if($categories->hasPages())
        <div class="px-6 py-4 border-t border-surface-variant">
            {{ $categories->links() }}
        </div>
        @endif
    </div>
</div>

{{-- Edit Modal --}}
<dialog id="edit-modal" class="rounded-xl shadow-2xl border border-surface-variant p-0 backdrop:bg-black/30 max-w-lg w-full">
    <div class="p-6">
        <h3 class="font-headline-sm text-[24px] font-semibold text-primary mb-4">Edit Category</h3>
        <form method="POST" id="edit-form" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="font-ui-label font-bold text-primary mb-2 block">Name</label>
                <input type="text" name="name" id="edit-name" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest" required/>
            </div>
            <div>
                <label class="font-ui-label font-bold text-primary mb-2 block">Description</label>
                <textarea name="description" id="edit-description" rows="2" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest"></textarea>
            </div>
            <div class="flex items-center gap-3">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" id="edit-is-active" value="1" class="sr-only peer" checked>
                    <div class="w-9 h-5 bg-outline-variant peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-secondary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-secondary"></div>
                </label>
                <span class="text-ui-label text-on-surface-variant">Active</span>
            </div>
            <div class="flex gap-3 justify-end pt-2">
                <button type="button" onclick="document.getElementById('edit-modal').close()" class="px-6 py-3 rounded-lg border border-outline-variant text-on-surface-variant font-bold text-ui-label hover:bg-surface-container-high transition-all">Cancel</button>
                <button type="submit" class="bg-primary-container text-on-primary px-6 py-3 rounded-lg font-ui-label text-ui-label font-bold hover:bg-secondary transition-all">Update</button>
            </div>
        </form>
    </div>
</dialog>

<script>
function editCategory(id, name, description, isActive) {
    document.getElementById('edit-form').action = '/admin/categories/' + id;
    document.getElementById('edit-name').value = name;
    document.getElementById('edit-description').value = description;
    document.getElementById('edit-is-active').checked = isActive;
    document.getElementById('edit-modal').showModal();
}
</script>
@endsection
