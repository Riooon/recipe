@extends('layouts.app')
@section('content')

<div class="account_info">
    <img src="{{ asset('storage/img/'.$user->icon) }}">
    <h4>{{ $user->name }}</h4>
    <p>{{ count($recipes) }} Contributions</p>
    @if ($user->id==Auth::user()->id)
    <a href="{{ url('useredit/'.$user->id ) }}" class="edit_btn">アカウント編集</a>
    @endif
</div>

<p class="category_bar">投稿したレシピ</p>
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

@endsection
