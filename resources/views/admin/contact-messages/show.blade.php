@extends('admin.layouts.admin')

@section('title', 'Message from ' . $contactMessage->name . ' - Elkris Bio Health')
@section('header', 'Message from ' . $contactMessage->name)

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl border border-surface-variant shadow-sm p-8">
        <div class="grid grid-cols-2 gap-6 mb-8 pb-8 border-b border-outline-variant">
            <div>
                <label class="font-ui-label font-bold text-caption text-outline uppercase tracking-wider">Name</label>
                <p class="text-ui-label text-on-surface mt-1">{{ $contactMessage->name }}</p>
            </div>
            <div>
                <label class="font-ui-label font-bold text-caption text-outline uppercase tracking-wider">Email</label>
                <p class="text-ui-label text-on-surface mt-1">
                    <a href="mailto:{{ $contactMessage->email }}" class="text-secondary hover:underline">{{ $contactMessage->email }}</a>
                </p>
            </div>
            <div>
                <label class="font-ui-label font-bold text-caption text-outline uppercase tracking-wider">Received</label>
                <p class="text-ui-label text-on-surface mt-1">{{ $contactMessage->created_at->format('F j, Y g:i A') }}</p>
            </div>
        </div>

        <div>
            <label class="font-ui-label font-bold text-caption text-outline uppercase tracking-wider">Message</label>
            <div class="mt-3 text-ui-label text-on-surface bg-surface-container-low rounded-lg p-6 whitespace-pre-wrap leading-relaxed">
                {{ $contactMessage->message }}
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center gap-3">
        <a href="{{ route('admin.contact-messages.index') }}" class="text-outline hover:text-on-surface transition-colors text-ui-label">&larr; Back to Messages</a>
        <form method="POST" action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" onsubmit="return confirm('Delete this message?')" class="ml-auto">
            @csrf
            @method('DELETE')
            <button type="submit" class="border border-error text-error font-bold px-5 py-2 rounded-lg hover:bg-error-container transition-all text-ui-label">Delete</button>
        </form>
    </div>
</div>
@endsection
