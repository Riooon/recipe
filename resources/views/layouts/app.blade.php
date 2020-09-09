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

    <meta property="og:locale" content="ja_JP">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Okome Modeでは実際に料理を作りながら、ステップバイステップで料理を学んでいくことができます。楽しみながら料理を学びましょう！">
    <meta property="og:title" content="Okome Mode - 料理はみんなのために">
    <meta property="og:url" content="https://okomemode.com">
    <meta property="og:image" content="http://okomemode.com/img/main_image.jpg">
    <meta property="og:site_title" content="Okome Mode">
    
</head>

<body>
    <div id="app">

        <header>
            <a href="{{ url('/overview') }}"><img src="{{asset('img/logo_big.png')}}" alt=""></a>
            <button class="btn_menu"><i class="fas fa-bars"></i></button>
            <nav>
                <ul class="menu_list">
                @guest
                <li><a href="{{ url('/overview') }}">コース一覧</a></li>
                <li><a href="{{ url('/register') }}">会員登録</a></li>
                <li><a href="{{ url('/login') }}">ログイン</a></li>
                @else
                <li><a href="{{ url('/overview') }}">コース一覧</a></li>
                <li><a href="{{ url('/find') }}">つくレポ</a></li>
                <li><a href="{{ url('/userpage/'.Auth::user()->id) }}">マイページ</a></li>
                @endauth
                </ul>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>

    </div>
</body>

</html>
