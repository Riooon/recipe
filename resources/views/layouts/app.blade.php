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
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
    <header>
    <a href="{{ url('/') }}"><img src="{{asset('img/logo_big.png')}}" alt=""></a>
        @auth
        <a href="{{ url('/userpage/'.Auth::user()->id) }}"><i class="fas fa-user-cog"></i></a>
        @endauth
        @guest
        <a href="{{ url('/login') }}"><i class="fas fa-user-cog"></i></a>
        @endguest
    </header>

        <main>
            @yield('content')
        </main>

        <ul class="menu_fixed">
                <a href="{{ url('/') }}"><li><i class="fas fa-search"></i><span>探す</span></li></a>
                <a href="{{ url('/list') }}"><li><i class="fas fa-stream"></i><span>新着</span></li></a>
                <a href="{{ url('/create') }}"><li><i class="far fa-plus-square"></i><span>投稿</span></li></a>
                <a href="{{ url('/saved') }}"><li><i class="far fa-bookmark"></i><span>保存</span></li></a>
        </ul>
    </div>


</body>
</html>
