@extends('admin.layouts.admin')

@section('title', 'Edit Post - Elkris Bio Health')
@section('header', 'Edit Post')

@section('content')
<form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8" id="post-form">
    @csrf
    @method('PUT')

    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl border border-surface-variant shadow-sm p-6">
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" placeholder="Post title..." class="w-full text-[32px] font-headline-md font-semibold text-primary border-none outline-none focus:outline-none placeholder:text-outline-variant bg-transparent" required/>
            @error('title') <p class="text-error text-caption mt-1">{{ $message }}</p> @enderror
            <input type="hidden" name="slug" id="slug" value="{{ old('slug', $post->slug) }}">
            @error('slug') <p class="text-error text-caption mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="bg-white rounded-xl border border-surface-variant shadow-sm">
            <div class="flex flex-wrap items-center gap-1 px-4 py-3 border-b border-surface-variant bg-surface-container-low sticky top-16 z-40">
                <button type="button" id="editor-bold" class="p-2 rounded-lg text-outline hover:bg-surface-container-high transition-colors" title="Bold"><span class="material-symbols-outlined text-[18px]">format_bold</span></button>
                <button type="button" id="editor-italic" class="p-2 rounded-lg text-outline hover:bg-surface-container-high transition-colors" title="Italic"><span class="material-symbols-outlined text-[18px]">format_italic</span></button>
                <span class="w-px h-6 bg-outline-variant mx-1"></span>
                <button type="button" id="editor-heading-2" class="p-2 rounded-lg text-outline hover:bg-surface-container-high transition-colors" title="Heading 2"><span class="material-symbols-outlined text-[18px]">title</span></button>
                <button type="button" id="editor-heading-3" class="p-2 rounded-lg text-outline hover:bg-surface-container-high transition-colors" title="Heading 3"><span class="material-symbols-outlined text-[18px]">text_fields</span></button>
                <span class="w-px h-6 bg-outline-variant mx-1"></span>
                <button type="button" id="editor-bullet-list" class="p-2 rounded-lg text-outline hover:bg-surface-container-high transition-colors" title="Bullet List"><span class="material-symbols-outlined text-[18px]">format_list_bulleted</span></button>
                <button type="button" id="editor-ordered-list" class="p-2 rounded-lg text-outline hover:bg-surface-container-high transition-colors" title="Ordered List"><span class="material-symbols-outlined text-[18px]">format_list_numbered</span></button>
                <button type="button" id="editor-blockquote" class="p-2 rounded-lg text-outline hover:bg-surface-container-high transition-colors" title="Blockquote"><span class="material-symbols-outlined text-[18px]">format_quote</span></button>
                <button type="button" id="editor-code-block" class="p-2 rounded-lg text-outline hover:bg-surface-container-high transition-colors" title="Code Block"><span class="material-symbols-outlined text-[18px]">code</span></button>
                <span class="w-px h-6 bg-outline-variant mx-1"></span>
                <button type="button" id="editor-horizontal-rule" class="p-2 rounded-lg text-outline hover:bg-surface-container-high transition-colors" title="Divider"><span class="material-symbols-outlined text-[18px]">horizontal_rule</span></button>
                <span class="w-px h-6 bg-outline-variant mx-1"></span>
                <button type="button" id="editor-undo" class="p-2 rounded-lg text-outline hover:bg-surface-container-high transition-colors" title="Undo"><span class="material-symbols-outlined text-[18px]">undo</span></button>
                <button type="button" id="editor-redo" class="p-2 rounded-lg text-outline hover:bg-surface-container-high transition-colors" title="Redo"><span class="material-symbols-outlined text-[18px]">redo</span></button>
            </div>

            <div class="p-6">
                <div id="tiptap-editor" data-initial-body="{{ old('body', $post->body) }}"></div>
                <input type="hidden" name="body" id="body-content" value="">
                @error('body') <p class="text-error text-caption mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="bg-white rounded-xl border border-surface-variant shadow-sm p-6">
            <label class="font-ui-label font-bold text-primary mb-2 block">Excerpt</label>
            <textarea name="excerpt" rows="3" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest">{{ old('excerpt', $post->excerpt) }}</textarea>
            @error('excerpt') <p class="text-error text-caption mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-xl border border-surface-variant shadow-sm p-6 space-y-4 sticky top-24">
            <div class="flex gap-3">
                <button type="button"
                    class="flex-1 bg-secondary text-white font-bold px-6 py-3 rounded-lg hover:bg-on-secondary-container transition-all text-ui-label"
                    @click="publishModal = { show: true }">Update & Publish</button>
                <button type="submit" name="is_published" value="0" class="flex-1 border border-outline-variant text-on-surface-variant font-bold px-6 py-3 rounded-lg hover:bg-surface-container-high transition-all text-ui-label">Save Draft</button>
                <button type="submit" name="is_published" value="1" id="publish-submit-btn" class="hidden"></button>
            </div>

            @if($post->featured_image)
            <div class="relative">
                <img src="{{ Storage::url($post->featured_image) }}" alt="Current featured image" class="rounded-lg w-full h-40 object-cover">
                <label class="inline-flex items-center gap-2 mt-2 text-caption text-outline cursor-pointer hover:text-error transition-colors">
                    <input type="checkbox" name="remove_image" value="1">
                    Remove image
                </label>
            </div>
            @endif

            <div>
                <label class="font-ui-label font-bold text-primary mb-2 block">Category</label>
                <select name="category_id" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest">
                    <option value="">Select category...</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(old('category_id', $post->category_id) == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="font-ui-label font-bold text-primary mb-2 block">Tags</label>
                <div class="flex flex-wrap gap-2">
                    @foreach($tags as $tag)
                    <label class="inline-flex items-center gap-2 px-3 py-2 rounded-lg border border-outline-variant cursor-pointer hover:bg-surface-container-high transition-colors has-checked:bg-secondary-container has-checked:border-secondary has-checked:text-on-secondary-container">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="hidden" @checked(in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())))>
                        <span class="text-ui-label text-sm">{{ $tag->name }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div>
                <label class="font-ui-label font-bold text-primary mb-2 block">Featured Image</label>
                <div class="border-2 border-dashed border-outline-variant rounded-xl p-6 text-center cursor-pointer hover:border-secondary transition-colors" id="upload-featured-image">
                    <span class="material-symbols-outlined text-3xl text-outline mb-2">add_photo_alternate</span>
                    <p class="text-caption text-outline">Click to change image</p>
                </div>
                <input type="file" name="featured_image" id="featured-image-input" class="hidden" accept="image/jpeg,image/png,image/webp,image/gif">
                @error('featured_image') <p class="text-error text-caption mt-1">{{ $message }}</p> @enderror
                <img id="featured-image-preview" class="hidden mt-3 rounded-lg w-full h-40 object-cover" src="" alt="Preview">
                <input type="text" name="featured_image_caption" value="{{ old('featured_image_caption', $post->featured_image_caption) }}" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest mt-3" placeholder="Optional caption...">
            </div>

            @if($post->is_published)
            <div class="bg-surface-container-low rounded-lg p-4 space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-caption text-outline">Views</span>
                    <span class="text-ui-label font-bold text-primary">{{ number_format($post->views_count) }}</span>
                </div>
                <p class="text-caption text-outline">Published {{ $post->published_at?->diffForHumans() }}</p>
                <a href="{{ route('blog.show', $post) }}" target="_blank" class="text-secondary text-ui-label hover:underline mt-1 inline-block">View post &rarr;</a>
            </div>
            @else
            <div class="bg-surface-container-low rounded-lg p-4">
                <p class="text-caption text-outline">Not published yet</p>
            </div>
            @endif

            <div class="border-t border-outline-variant pt-4">
                <label class="font-ui-label font-bold text-primary mb-2 block">SEO Settings</label>
                <div class="space-y-3">
                    <input type="text" name="seo_title" value="{{ old('seo_title', $post->seo_title) }}" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest" placeholder="SEO Title">
                    <textarea name="seo_description" rows="2" class="w-full border border-outline-variant rounded-lg px-4 py-3 text-ui-label text-on-surface focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary bg-surface-container-lowest" placeholder="SEO Description (max 320 chars)">{{ old('seo_description', $post->seo_description) }}</textarea>
                </div>
            </div>
        </div>
    </div>
</form>

<button type="button" class="w-full border border-error text-error font-bold px-6 py-3 rounded-lg hover:bg-error-container transition-all text-ui-label"
    @click="confirmModal = {
        show: true,
        title: 'Delete Post',
        message: 'Are you sure you want to delete this post? This action cannot be undone.',
        action: '{{ route('admin.posts.destroy', $post) }}',
        method: 'DELETE',
        buttonText: 'Delete'
    }">Delete Post</button>
@endsection
