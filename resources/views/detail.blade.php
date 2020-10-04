<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>OKOME MODE｜初心者向けレシピアプリ</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/common.js') }}" defer></script>
    <script src="https://use.fontawesome.com/71ade6c4b0.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">

    <meta property="og:locale" content="ja_JP">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{$recipe->title}}">
    <meta property="og:description" content="OKOME MODEでシェアされた料理のご紹介です。楽しみながら、ステップバイステップで料理を学びましょう！">
    <meta property="og:url" content="https://okomemode.com/recipe/{{$recipe->id}}">
    <meta property="og:image" content="http://okomemode.com/storage/img/{{$recipe->hd_img}}">
    <meta property="og:site_title" content="OKOME MODE">

    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@okome_mode"/>
    
</head>

<body>
    <div id="app">
    <header>
            <a href="{{ url('/') }}"><img src="{{asset('img/logo_big.png')}}" alt=""></a>
            <button class="btn_menu"><i class="fas fa-bars"></i></button>
            <nav class="header_right">
                <ul class="menu_list">
                    @guest
                    <li><a href="{{ url('/find') }}">レシピを探す</a></li>
                    <li><a href="{{ url('/login') }}">ログイン</a></li>
                    <li><a href="{{ url('/register') }}">会員登録</a></li>
                    @else
                    <li><a href="{{ url('/find') }}">レシピを探す</a></li>
                    <li><a href="{{ url('/userpage/'.Auth::user()->id) }}">マイページ</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('ログアウト') }}</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    @endauth
                </ul>
            </nav>
        </header>

        <main>
            <div class="recipe_inner">
                <div class="recipe_back">
                    <a href="javascript:history.back();"><i class="fas fa-arrow-left"></i></a>
                </div>
                <div class="recipe_heaader" style="background-image: url('{{ asset('storage/img/'.$recipe->hd_img), true }}');">
                    <h1>{{ $recipe->title }}</h1>
                    <a href="{{ url('/recipe/'.$recipe->id.'/play') }}"><i class="far fa-play-circle"></i><span> 手順を再生</span></a>
                </div>

                <p class="category_bar">お買い物リスト</p>
                
                @if (count($ingredients) > 0)
                <div class="shopping_list">
                    @foreach ($ingredients as $ingredient)
                        @if(!$ingredient->ingredient==NULL)
                            <ul>
                                <li class="take_up">{{$ingredient->ingredient}}</li>
                                <li>{{$ingredient->amount}}</li>
                                @if($ingredient->unit==0)
                                <li class="space">個</li>
                                @elseif($ingredient->unit==1)
                                <li class="space">g</li>
                                @elseif($ingredient->unit==2)
                                <li class="space">ml</li>
                                @endif
                            </ul>
                        @endif
                    @endforeach
                </div>
                @endif

                <p class="category_bar">レシピ詳細</p>

                @if (count($processes) > 0)
                    @foreach ($processes as $process)
                    
                    @if(!$process->text==NULL)
                        <div class="recipe_prosess">
                            @if(!$process->text==NULL)
                            <p>{{$process->text}}</p>
                            @endif
                        </div>
                    @endif

                    @endforeach
                @endif

                @auth
                <form action="{{ url('stock/add') }}" method="POST" class="stock_form">
                    {{ csrf_field() }}
                    <input type="submit" value="献立に追加" class="stock_btn">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                </form>
                @endauth
            </div>
        </main>

    <ul class="menu_fixed">
        <a href="{{ url('/overview') }}"><li><i class="fas fa-pencil-alt"></i><span>コース一覧</span></li></a>
        <a href="{{ url('/find') }}"><li><i class="fas fa-search"></i><span>検索する</span></li></a>
        <a href="{{ url('/stock') }}"><li><i class="fas fa-book-open"></i><span>今週の献立</span></li></a>
        <a href="{{ url('/create') }}"><li><i class="far fa-plus-square"></i><span>投稿する</span></li></a>
    </ul>
    </div>

</body>
</html>
