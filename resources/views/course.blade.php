@extends('layouts.app')
@section('content')
<div class="course_title" style="background-image: url('{{ asset('img/pasta.jpg') }}'); ">
    <h1>{{ $course_items->name }} のコース</h1>
    <p>達成率 {{ $achieved_rate }} %</p>
    <progress max="100" value="{{ $achieved_rate }}">{{ $achieved_rate }}%</progress>
</div>

<ul>

@foreach($lesson_blocks as $lesson_block)
    @for ($i = 0; $i < count($lesson_block); $i++)
        <div class="lesson_card">
            @if(!$lesson_block[$i][1]==NULL)
                <h4 class="completed">コース終了！</h4>
            @else
                <h4 class="uncompleted">コース未完了</h4>
            @endif
            <img src="{{ asset('img/pasta.jpg') }}" alt="">
            <h2 class="title">{{ $lesson_block[$i][0]->name }}</h2>
            <p>ここに説明を加えます。ここに説明を加えます。ここに説明を加えます。</p>
            <a href="{{ url('course/'.$course_items->english.'/lesson/'.$lesson_block[$i][0]->lesson_id) }}" class="btn" style="background: #c8bd00">これがボタン</a>
        </div>
    @endfor
@endforeach

</ul>

@endsection