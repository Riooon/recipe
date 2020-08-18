<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Okome Mode</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/common.js') }}" defer></script>
    <script src="https://use.fontawesome.com/71ade6c4b0.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/reset.css'), true }}" rel="stylesheet">
    <link href="{{ asset('css/common.css'),true }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
        <div class="auth_area">
            <div class="auth_logo">
                <img src="{{asset('img/logo_small.png')}}" alt="">
            </div>
            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
