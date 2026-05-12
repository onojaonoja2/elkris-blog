<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title', 'Admin - Elkris Bio Health')</title>
<link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-on-surface font-sans antialiased">
<div class="min-h-screen" x-data="{
    confirmModal: {
        show: false,
        title: 'Confirm',
        message: 'Are you sure?',
        action: '',
        method: 'DELETE',
        buttonText: 'Delete',
    },
    publishModal: {
        show: false,
    },
}">
    @include('layouts.navigation')

    <div class="max-w-[1400px] mx-auto px-5 py-8">
        @if(session('success'))
        <div class="mb-6 bg-primary-fixed text-on-primary-fixed px-6 py-4 rounded-lg flex items-center gap-3 shadow-sm border border-primary-fixed-dim">
            <span class="material-symbols-outlined">check_circle</span>
            <span class="text-ui-label font-medium">{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 bg-error-container text-on-error-container px-6 py-4 rounded-lg flex items-center gap-3 shadow-sm">
            <span class="material-symbols-outlined">error</span>
            <span class="text-ui-label font-medium">{{ session('error') }}</span>
        </div>
        @endif

        @isset($header)
        <div class="mb-8">
            <h1 class="font-headline-md text-[32px] font-semibold text-primary-container">{{ $header }}</h1>
        </div>
        @endisset

        <main>
            @yield('content')
        </main>
    </div>

    @stack('scripts')

    {{-- Global Confirm Modal --}}
    <div x-show="confirmModal.show" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="fixed inset-0 bg-black/50" x-on:click="confirmModal.show = false"></div>
        <div class="bg-white rounded-xl p-6 max-w-sm w-full mx-4 relative z-10 shadow-xl" x-on:keydown.escape.window="confirmModal.show = false">
            <div class="flex items-center gap-3 mb-4">
                <span class="material-symbols-outlined text-error text-3xl">warning</span>
                <h3 class="font-headline-sm text-[24px] font-semibold text-primary" x-text="confirmModal.title"></h3>
            </div>
            <p class="text-ui-label text-on-surface-variant mb-6" x-text="confirmModal.message"></p>
            <div class="flex items-center justify-end gap-3">
                <button type="button" x-on:click="confirmModal.show = false"
                    class="px-5 py-2 rounded-lg border border-outline-variant text-on-surface-variant font-bold text-ui-label hover:bg-surface-container-high transition-all">
                    Cancel
                </button>
                <form method="POST" x-bind:action="confirmModal.action" class="inline">
                    @csrf
                    <input type="hidden" name="_method" x-bind:value="confirmModal.method">
                    <button type="submit"
                        class="px-5 py-2 rounded-lg bg-error text-white font-bold text-ui-label hover:bg-red-700 transition-all"
                        x-text="confirmModal.buttonText"></button>
                </form>
            </div>
        </div>
    </div>

    {{-- Global Publish Modal --}}
    <div x-show="publishModal.show" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="fixed inset-0 bg-black/50" x-on:click="publishModal.show = false"></div>
        <div class="bg-white rounded-xl p-6 max-w-sm w-full mx-4 relative z-10 shadow-xl">
            <div class="flex items-center gap-3 mb-4">
                <span class="material-symbols-outlined text-secondary text-3xl">public</span>
                <h3 class="font-headline-sm text-[24px] font-semibold text-primary">Publish Post?</h3>
            </div>
            <p class="text-ui-label text-on-surface-variant mb-6">This post will be visible to everyone. Are you sure?</p>
            <div class="flex items-center justify-end gap-3">
                <button type="button" x-on:click="publishModal.show = false"
                    class="px-5 py-2 rounded-lg border border-outline-variant text-on-surface-variant font-bold text-ui-label hover:bg-surface-container-high transition-all">
                    Cancel
                </button>
                <button type="button" x-on:click="document.getElementById('publish-submit-btn').click(); publishModal.show = false"
                    class="px-5 py-2 rounded-lg bg-secondary text-white font-bold text-ui-label hover:bg-on-secondary-container transition-all">
                    Yes, Publish
                </button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
