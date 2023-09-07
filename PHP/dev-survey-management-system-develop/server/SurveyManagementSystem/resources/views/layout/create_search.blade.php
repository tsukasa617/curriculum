<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- 各ページごとにtitleタグを入れるために@yieldで空けておきます。 --}}
        <title>@yield('title')</title>

        <!-- Scripts -->
        <script src="{{ asset('/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('/js/app.js') }}" defer></script>
        <script src="{{ asset('js/search.js') }}"></script>
        <script src="{{ asset('js/client_search.js') }}"></script>

        <!-- Styles -->
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/layout.css') }}" rel="stylesheet">
    </head>
    <body>

        @yield('content')
    </body>
</html>