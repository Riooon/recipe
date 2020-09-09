@extends('layouts.app')
@section('content')

    <div class="recipe_heaader" style="background-image: url('{{asset('img/'.$lesson_items->hd_img)}}');">
        <h1>{{ $lesson_items->name }}</h1>
        <a href="{{ url('course/'.$course_items->english.'/lesson/'.$lesson_items->lesson_id.'/play') }}" style="background:{{$course_items->color}};">手順を再生する</a>
    </div>
    <p class="category_bar" style="background:{{$course_items->color}};">用意するもの（一人前）</p>
    <ul class="shopping_list">
        @for ($i = 0; $i < 10; $i++)
            @if(!$lesson_items->{"ingredient_".$i}==NULL)
            <li>{{ $lesson_items->{"ingredient_".$i} }}</li>
            @endif
        @endfor
    </ul>

    @auth
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
                    <input style="color:{{$course_items->color}}; border: 1px solid {{$course_items->color}}" type="submit" value="このレッスンを完了する">
                </div>
            </form>
        @endif
    @endauth

@endsection