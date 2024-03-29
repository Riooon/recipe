@extends('layouts.app')
@section('content')

<div class="recipe_inner">

    <div class="overview_top">
        <h1>コース一覧</h1>
    </div>
    <div class="overview_inner">
        @auth
        <div class="user_info">
            @if (isset(Auth::user()->icon))
                <img src="{{ asset('storage/img/'.Auth::user()->icon) }}">
            @else
                <img src="{{ asset('/img/default.jpg') }}">
            @endif
            <div class="texts">
                <h4>{{ Auth::user()->name }}</h4>
                <p>Lv.{{ floor(Auth::user()->level) }}</p>
                <progress id="user_level" max="1" value="{{ Auth::user()->level - floor(Auth::user()->level) }}">{{ Auth::user()->level - floor(Auth::user()->level) }}%</progress>
            </div>
        </div>
        @endauth

        <ul>
        @foreach($course_blocks as $course_block)
            @for ($i = 0; $i < count($course_block); $i++)

            <a href="{{ url('course/'.$course_block[$i][0]->english ) }}">
            <div class="course_card">
                <div class="left">
                    <img src="{{asset('img/'.$course_block[$i][0]->image)}}">
                </div>
                <div class="right">
                    <h3>{{ $course_block[$i][0]->name }}</h3>
                    <p>{{ $course_block[$i][0]->desc }}</p>
                    <progress max="100" value="{{ $course_block[$i][1] }}">{{ $course_block[$i][1] }}%</progress>
                </div>
            </div>
            </a>
            @endfor
        @endforeach
        </ul>

    </div>

</div>
@endsection