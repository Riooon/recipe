@extends('layouts.app')
@section('content')

<div class="account_info">
    <img src="{{ asset('storage/img/'.$user->icon) }}">
    <h4>{{ $user->name }}</h4>
    @if ($user->id==Auth::user()->id)
    <a href="{{ url('useredit/'.$user->id ) }}" class="edit_btn">アカウント編集</a>
    @endif
</div>

<ul class="user_progress">
    <li class="on" id="userpage_recipe">投稿したレシピ</li>
    <li class="off" id="userpage_lesson">コースの状況</li>
</ul>

<div class="progress_title" id="recipe_num"><span>{{ count($recipes) }} Contributions</span></div>
<div class="progress_title hidden" id="lesson_num"><span>　Lv.{{ floor($user->level) }}　</span></div>

<div class="userpage_contents">
    <div id="recipe_block">
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
    <div id="lesson_block" class="hidden">
        @foreach($course_blocks as $course_block)
            @for ($i = 0; $i < count($course_block); $i++)

            <div class="course_card">
                <div class="left">
                    <img src="{{asset('img/'.$course_block[$i][0]->image)}}">
                </div>
                <div class="right">
                    <h3>{{ $course_block[$i][0]->name }}</h3>
                    <p>{{ $course_block[$i][0]->desc }}</p>
                    <p>このコースの達成率  {{ $course_block[$i][1] }}%</p>
                </div>
            </div>
            @endfor
        @endforeach
    </div>
</div>

@endsection