<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title', 'Admin - Elkris Bio Health')</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-on-surface font-sans antialiased">
<div class="min-h-screen">
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
</div>

@stack('scripts')
</body>
</html>
