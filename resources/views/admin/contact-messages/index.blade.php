@extends('admin.layouts.admin')

@section('title', 'Contact Messages - Elkris Bio Health')
@section('header', 'Contact Messages')

@section('content')
<div class="mb-6 flex justify-end">
    <a href="{{ route('admin.contact-messages.export') }}" class="bg-secondary text-white font-bold px-5 py-2 rounded-lg hover:bg-on-secondary-container transition-all text-ui-label inline-flex items-center gap-2">
        <span class="material-symbols-outlined text-[18px]">download</span>
        Export CSV
    </a>
</div>

<div class="bg-white rounded-xl border border-surface-variant shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-surface-container-low text-left">
                    <th class="px-6 py-4 font-ui-label font-bold text-primary">Name</th>
                    <th class="px-6 py-4 font-ui-label font-bold text-primary">Email</th>
                    <th class="px-6 py-4 font-ui-label font-bold text-primary">Message</th>
                    <th class="px-6 py-4 font-ui-label font-bold text-primary">Received</th>
                    <th class="px-6 py-4 font-ui-label font-bold text-primary">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant">
                @forelse($messages as $message)
                <tr class="hover:bg-surface-container-lowest transition-colors">
                    <td class="px-6 py-4 text-ui-label text-on-surface font-medium">{{ $message->name }}</td>
                    <td class="px-6 py-4 text-ui-label text-on-surface">{{ $message->email }}</td>
                    <td class="px-6 py-4 text-ui-label text-on-surface-variant max-w-xs truncate">{{ $message->message }}</td>
                    <td class="px-6 py-4 text-caption text-on-surface-variant">{{ $message->created_at->format('M j, Y g:i A') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.contact-messages.show', $message) }}" class="text-secondary text-ui-label hover:underline">View</a>
                            <button type="button" class="text-error text-ui-label hover:underline"
                                @click="confirmModal = {
                                    show: true,
                                    title: 'Delete Message',
                                    message: 'Delete this contact message?',
                                    action: '{{ route('admin.contact-messages.destroy', $message) }}',
                                    method: 'DELETE',
                                    buttonText: 'Delete'
                                }">Delete</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center">
                        <span class="material-symbols-outlined text-4xl text-outline-variant mb-2">forum</span>
                        <p class="text-on-surface-variant text-ui-label">No contact messages yet.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($messages->hasPages())
    <div class="px-6 py-4 border-t border-outline-variant">
        {{ $messages->links() }}
    </div>
    @endif
</div>
@endsection
