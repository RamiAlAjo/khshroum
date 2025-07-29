<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ config('app.description', 'Khshroum') }}">
    <meta name="author" content="{{ config('app.author', 'Khshroum Team') }}">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta Tags for Social Media -->
    <meta property="og:title" content="{{ config('app.name', 'Khshroum') }}">
    <meta property="og:description" content="{{ config('app.description', 'Khshroum') }}">
    <meta property="og:image" content="{{ asset('images/og-image.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ config('app.name', 'Khshroum') }}">
    <meta name="twitter:description" content="{{ config('app.description', 'Khshroum') }}">
    <meta name="twitter:image" content="{{ asset('images/og-image.png') }}">

    <title>{{ config('app.name', 'Khshroum') }}</title>
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/favicon.png') }}">

    {{-- Preload key resources for performance --}}
    <link rel="preload" href="{{ asset('fonts/your-font.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous">

    {{-- Styles --}}
    @include('front.layouts.styles')

</head>

<body class="d-flex flex-column min-vh-100 bg-light text-dark">

    {{-- Navigation bar --}}
    @include('front.layouts.navbar')

    <div class="mb-5">
        @yield('content')
    </div>

    {{-- Footer --}}
    @include('front.layouts.footer')

    {{-- Scripts --}}
    @include('front.layouts.scripts')

    @yield('scripts')

    <!-- Home-specific body class management -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.location.pathname === "/") {
            document.body.classList.add("home");
        } else {
            document.body.classList.remove("home");
        }
    });
    </script>

</body>
</html>
