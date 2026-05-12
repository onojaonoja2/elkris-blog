<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title', 'Elkris Bio Health - Scientific Vitality')</title>
<meta name="description" content="@yield('meta_description', 'Evidence-based wellness and bio-clinical insights for health-conscious professionals.')">
<link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

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

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('form[action="{{ route('newsletter.store') }}"]').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            var btn = this.querySelector('button[type="submit"]');
            var originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Subscribing...';

            var msgContainer = this.querySelector('.newsletter-msg');
            if (msgContainer) msgContainer.remove();

            fetch('{{ route('newsletter.store') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
            })
            .then(function (response) {
                return response.json().then(function (data) {
                    return { status: response.status, data: data };
                });
            })
            .then(function (result) {
                var msg = document.createElement('div');
                msg.className = 'newsletter-msg text-caption px-4 py-3 rounded-lg mb-4 border';

                if (result.status === 422) {
                    var errorMsg = result.data.errors ? (result.data.errors.email ? result.data.errors.email[0] : 'Validation error.') : 'Something went wrong.';
                    msg.className += ' bg-error/10 text-error border-error/30';
                    msg.textContent = errorMsg;
                } else {
                    msg.className += ' bg-primary-fixed/20 text-primary-fixed border-primary-fixed/30';
                    msg.textContent = result.data.message;
                    form.querySelector('input[type="email"]').value = '';
                }

                form.insertBefore(msg, form.firstChild);
            })
            .catch(function () {
                var msg = document.createElement('div');
                msg.className = 'newsletter-msg text-caption px-4 py-3 rounded-lg mb-4 border bg-error/10 text-error border-error/30';
                msg.textContent = 'Something went wrong. Please try again.';
                form.insertBefore(msg, form.firstChild);
            })
            .finally(function () {
                btn.disabled = false;
                btn.textContent = originalText;
            });
        });
    });
});
</script>
</body>
</html>
