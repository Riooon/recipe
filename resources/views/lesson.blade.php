@extends('layouts.app')
@section('content')

    <div class="recipe_heaader">
        <img src="{{ asset('img/pasta.jpg') }}" alt="">
        <h1>{{ $lesson_items->name }}</h1>
    </div>
    <p class="category_bar">用意するもの</p>
    <ul class="shopping_list">
    </ul>
    <p class="category_bar">作業手順</p>


    @if(!$check_if_finish==NULL)
        <div class="completed_lesson_btn">
            <h4>クリア済みレッスン</h4>
        </div>
    @else
        <form method="POST" action="{{ url('lesson/complete') }}">
            @csrf
            
            <input type="hidden" name="course_id" value="{{ $lesson_items->course_id }}">
            <input type="hidden" name="lesson_id" value="{{ $lesson_items->lesson_id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="level_up" value="0.5">
            <div class="lesson_complete_btn">
                <input type="submit" value="このレッスンを完了する">
            </div>
        </form>
    @endif

@endsection