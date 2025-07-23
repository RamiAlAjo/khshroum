<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Khshroum') }}</title>
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/favicon.png') }}">

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
