@extends('layouts.app')
@section('content')

<div class="recipe_inner">
    <div class="recipe_back">
        <a href="javascript:history.back();"><i class="fas fa-arrow-left"></i></a>
    </div>
    <div class="course_title" style="background-image: url('{{ asset('img/'.$course_items->image ) }}'); ">
        <h1>{{ $course_items->name }} コース</h1>
        <p>達成率 {{ $achieved_rate }} %</p>
        <progress max="100" value="{{ $achieved_rate }}">{{ $achieved_rate }}%</progress>
    </div>

    <ul>

    @foreach($lesson_blocks as $lesson_block)
        @for ($i = 0; $i < count($lesson_block); $i++)

            <div class="lesson_card">
                <div class="lesson_card_bg" style="background-image: url('{{ asset('img/'.$lesson_block[$i][0]->hd_img) }}');">
                    @if(!$lesson_block[$i][1]==NULL)
                        <h4 class="completed display_none">レッスン終了！</h4>
                    @else
                        <h4 class="uncompleted display_none">レッスン未完了</h4>
                    @endif
                </div>
                <h2 class="title">{{ $lesson_block[$i][0]->name }}</h2>
                <p>{{ $lesson_block[$i][0]->desc }}</p>
                <a href="{{ url('recipe/'.$lesson_block[$i][0]->recipe_id) }}" class="btn" style="background: {{$course_items->color}}">レッスン開始！</a>
            </div>
            
        @endfor
    @endforeach

    </ul>
</div>
@endsection