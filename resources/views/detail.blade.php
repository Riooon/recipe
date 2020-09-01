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
    <meta property="og:title" content="{{$recipe->title}}">
    <meta property="og:description" content="{{$recipe->title}}の作り方。「お金なし・スキルなし・食材なし」の海外留学生でも簡単に作れるレシピが盛りだくさん。">
    <meta property="og:url" content="https://okomemode.com/recipe/{{$recipe->id}}">
    <meta property="og:image" content="http://okomemode.com/storage/img/{{$recipe->hd_img}}">
    <meta property="og:site_title" content="Okome Mode">

    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@okome_mode"/>
    
</head>

<body>
    <div id="app">
    <header>
            <a href="{{ url('/') }}"><img src="{{asset('img/logo_big.png')}}" alt=""></a>
            <button class="btn_menu"><i class="fas fa-bars"></i></button>
            <nav>
                <ul class="menu_list">
                <li><a href="{{ url('/overview') }}">コース一覧</a></li>
                <li><a href="{{ url('/find') }}">つくレポ</a></li>
                <li><a href="{{ url('/userpage/'.Auth::user()->id) }}">マイページ</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <div class="recipe_heaader">
                <img src="{{ asset('storage/img/'.$recipe->hd_img), true }}" alt onerror="this.onerror">
                <h1>{{ $recipe->title }}</h1>
            </div>
            <p class="category_bar">お買い物リスト</p>
            <ul class="shopping_list">
            @if (count($ingredients) > 0)
                @for ($i = 0; $i < 7; $i++)
                    @if(!$ingredients->first()->{"ingredient_".$i}==NULL)
                    <li>{{ $ingredients->first()->{"ingredient_".$i} }}</li>
                    @endif
                @endfor
            @endif

            </ul>

            <p class="category_bar">レシピ詳細</p>

            @if (count($processes) > 0)
                @foreach ($processes as $process)
                
                @if(!$process->image==NULL || !$process->text==NULL)
                    <div class="recipe_prosess">
                        @if(!$process->image==NULL)
                        <img src="{{ asset('storage/img/'.$process->image), true }}" alt onerror="this.onerror">
                        @endif
                        @if(!$process->text==NULL)
                        <p>{{$process->text}}</p>
                        @endif
                    </div>
                @endif

                @endforeach
            @endif
        </main>

        <ul class="menu_fixed">
                <a href="{{ url('/find') }}"><li><i class="fas fa-search"></i><span>検索する</span></li></a>
                <a href="{{ url('/list') }}"><li><i class="fas fa-stream"></i><span>新着レシピ</span></li></a>
                <a href="{{ url('/create') }}"><li><i class="far fa-plus-square"></i><span>投稿する</span></li></a>
                <a href="{{ url('/saved') }}"><li><i class="far fa-bookmark"></i><span>お気に入り</span></li></a>
        </ul>
    </div>

</body>
</html>
