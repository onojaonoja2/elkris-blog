@props([
    'name',
    'title' => 'Confirm Action',
    'message' => 'Are you sure you want to do this?',
    'action' => '',
    'method' => 'DELETE',
    'buttonText' => 'Delete',
])

<x-modal :name="$name" :show="false" maxWidth="sm">
    <div class="p-6">
        <div class="flex items-center gap-3 mb-4">
            <span class="material-symbols-outlined text-error text-3xl">warning</span>
            <h3 class="font-headline-sm text-[24px] font-semibold text-primary">{{ $title }}</h3>
        </div>

        <p class="text-ui-label text-on-surface-variant mb-6">{{ $message }}</p>

        <div class="flex items-center justify-end gap-3">
            <button type="button" x-on:click="$dispatch('close-modal', '{{ $name }}')"
                class="px-5 py-2 rounded-lg border border-outline-variant text-on-surface-variant font-bold text-ui-label hover:bg-surface-container-high transition-all">
                Cancel
            </button>

            <form action="{{ $action }}" method="POST" class="inline">
                @csrf
                @method($method)
                <button type="submit"
                    class="px-5 py-2 rounded-lg bg-error text-white font-bold text-ui-label hover:bg-red-700 transition-all">
                    {{ $buttonText }}
                </button>
            </form>
        </div>
    </div>
</x-modal>
