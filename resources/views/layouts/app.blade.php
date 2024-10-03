<!doctype html>
@php
   $cachebust = "1.0.2";
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}?v={{$cachebust}}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    @include('parts.header')
    <main>
        @yield('content')
    </main>
    @include('parts.footer')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}?v={{$cachebust}}"></script>
    @stack('scripts')
</body>
</html>
