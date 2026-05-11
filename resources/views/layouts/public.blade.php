<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title', 'Elkris Bio Health - Scientific Vitality')</title>
<meta name="description" content="@yield('meta_description', 'Evidence-based wellness and bio-clinical insights for health-conscious professionals.')">

@stack('seo')

@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-on-surface font-sans antialiased selection:bg-primary-fixed selection:text-on-primary-fixed">

@include('layouts.partials.public-header')

<main>
@yield('content')
</main>

@include('layouts.partials.public-footer')

@stack('scripts')
</body>
</html>
