@extends('layouts.app')
@section('content')

<div class="recipe_inner">

    <div class="account_info">
        @if (isset($user->icon))
            <img src="{{ asset('storage/img/'.$user->icon) }}">
        @else
            <img src="{{ asset('/img/default.jpg') }}">
        @endif
        <h4>{{ $user->name }}</h4>
        <p>Lv.{{ floor($user->level) }}</p>
        <progress max="1" value="{{ $user->level - floor($user->level) }}">{{ $user->level - floor($user->level) }}%</progress>
        @if ($user->id==Auth::user()->id)
        <a href="{{ url('useredit/'.$user->id ) }}" class="edit_btn">アカウント編集</a>
        @endif
    </div>

    <ul class="user_progress">
        <li class="on" id="userpage_cook">作成したレシピ</li>
        <li class="off" id="userpage_recipe">投稿したレシピ</li>
    </ul>

    <div class="progress_title" id="cook_num"><span>{{ count($cooked_recipes) }} works</span></div>
    <div class="progress_title hidden" id="recipe_num"><span>{{ count($recipes) }} Contributions</span></div>

    <div class="userpage_contents">
        <div id="recipe_block" class="hidden">
            @foreach ($recipes as $recipe)
                <div class="recipe_card">
                    <a href="{{ url('recipe/'.$recipe->id) }}"><img src="{{ asset('storage/img/'.$recipe->hd_img), true }}" alt onerror="this.onerror"></a>
                    <div class="recipe_titles">
                        <a href="{{ url('recipe/'.$recipe->id) }}"><h4>{{ $recipe->title }}</h4></a>
                        <p class="thanks_for_posts">投稿ありがとうございます☺️</p><br>
                        @if ($user->id==Auth::user()->id)
                        <a href="{{ url('recipeedit/'.$recipe->id) }}" class="edit_btn">レシピを編集</a>
                        @endif
                    </div>
                </div>
            @endforeach

        </div>
        <div id="cook_block">
        @foreach ($cooked_recipes as $cooked_recipe)
            <div class="recipe_card">
                <a href="{{ url('recipe/'.$cooked_recipe->id) }}"><img src="{{ asset('storage/img/'.$cooked_recipe->hd_img), true }}" alt onerror="this.onerror"></a>
                <div class="recipe_titles">
                    <a href="{{ url('recipe/'.$cooked_recipe->id) }}"><h4>{{ $cooked_recipe->title }}</h4></a>
                    <p class="thanks_for_posts">よくがんばりました！</p><br>
                    <a href="{{ url('recipe/'.$cooked_recipe->recipe_id) }}" class="edit_btn">レシピ詳細をみる</a>
                    @if ($user->id==Auth::user()->id)
                    @endif
                </div>
            </div>
        @endforeach
        
        </div>
    </div>
</div>
@endsection