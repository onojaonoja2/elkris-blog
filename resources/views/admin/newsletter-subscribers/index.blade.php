@extends('admin.layouts.admin')

@section('title', 'Newsletter Subscribers - Elkris Bio Health')
@section('header', 'Newsletter Subscribers')

@section('content')
<div class="mb-6 flex justify-end">
    <a href="{{ route('admin.newsletter-subscribers.export') }}" class="bg-secondary text-white font-bold px-5 py-2 rounded-lg hover:bg-on-secondary-container transition-all text-ui-label inline-flex items-center gap-2">
        <span class="material-symbols-outlined text-[18px]">download</span>
        Export CSV
    </a>
</div>

<div class="bg-white rounded-xl border border-surface-variant shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-surface-container-low text-left">
                    <th class="px-6 py-4 font-ui-label font-bold text-primary">Email</th>
                    <th class="px-6 py-4 font-ui-label font-bold text-primary">Subscribed</th>
                    <th class="px-6 py-4 font-ui-label font-bold text-primary">Date Added</th>
                    <th class="px-6 py-4 font-ui-label font-bold text-primary">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant">
                @forelse($subscribers as $subscriber)
                <tr class="hover:bg-surface-container-lowest transition-colors">
                    <td class="px-6 py-4 text-ui-label text-on-surface">{{ $subscriber->email }}</td>
                    <td class="px-6 py-4">
                        @if($subscriber->subscribed_at)
                        <span class="text-caption text-on-surface-variant">{{ $subscriber->subscribed_at->diffForHumans() }}</span>
                        @else
                        <span class="text-caption text-outline">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-caption text-on-surface-variant">{{ $subscriber->created_at->format('M j, Y g:i A') }}</td>
                    <td class="px-6 py-4">
                        <button type="button" class="text-error text-ui-label hover:underline"
                            @click="confirmModal = {
                                show: true,
                                title: 'Remove Subscriber',
                                message: 'Remove this subscriber? They will no longer receive newsletters.',
                                action: '{{ route('admin.newsletter-subscribers.destroy', $subscriber) }}',
                                method: 'DELETE',
                                buttonText: 'Remove'
                            }">Remove</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-16 text-center">
                        <span class="material-symbols-outlined text-4xl text-outline-variant mb-2">mail</span>
                        <p class="text-on-surface-variant text-ui-label">No newsletter subscribers yet.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($subscribers->hasPages())
    <div class="px-6 py-4 border-t border-outline-variant">
        {{ $subscribers->links() }}
    </div>
    @endif
</div>
@endsection
