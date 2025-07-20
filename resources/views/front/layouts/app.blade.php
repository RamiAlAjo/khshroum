<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Khshroum') }}</title>

    {{-- Styles --}}
    @include('front.layouts.styles')

</head>

<body class="d-flex flex-column min-vh-100 bg-light text-dark">

    {{-- Navigation bar --}}
    @include('front.layouts.navbar')
        @yield('content')

    {{-- Footer --}}
    @include('front.layouts.footer')

    {{-- Scripts --}}
    @include('front.layouts.scripts')
    @yield('scripts')

</body>
</html>
