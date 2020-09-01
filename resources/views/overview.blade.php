@extends('layouts.app')
@section('content')
<div class="overview_inner">
    <div class="user_info">
        <img src="{{ asset('storage/img/'.Auth::user()->icon) }}">
        <div class="texts">
            <h4>{{ Auth::user()->name }}</h4>
            <p>Lv.{{ floor(Auth::user()->level) }}</p>
            <progress max="1" value="{{ Auth::user()->level - floor(Auth::user()->level) }}">{{ Auth::user()->level - floor(Auth::user()->level) }}%</progress>
        </div>
    </div>
    <div class="overview_title">
        <i class="fas fa-list-alt"></i>
        <h1>コース一覧</h1>
    </div>

    <ul>
    @foreach($course_blocks as $course_block)
        @for ($i = 0; $i < count($course_block); $i++)

        <a href="{{ url('course/'.$course_block[$i][0]->english ) }}">
        <div class="course_card">
            <div class="left">
                <img src="{{asset('img/logo_small.png')}}">
            </div>
            <div class="right">
                <h3>{{ $course_block[$i][0]->name }}</h3>
                <p>説明文（このコースではこういうことを勉強します。）</p>
                <p>このコースの達成率  {{ $course_block[$i][1] }}%</p>
            </div>
        </div>
        </a>
        @endfor
    @endforeach
    </ul>

</div>
@endsection