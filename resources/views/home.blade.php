@extends('layouts.app')
@section('content')

<div class="home_inner">
    <video src="{{asset('img/cutting.mp4')}}" muted autoplay loop></video>
    <div class="text_block">
        <h1>楽しみながら料理を学ぼう！</h1>
        <h4>Okome Modeでは実際に料理を作りながら、ステップバイステップで料理を学んでいくことができます。</h4>
        <a href="{{ url('/overview') }}">今すぐ始める</a>
    </div>
</div>
@endsection