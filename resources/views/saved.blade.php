<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')

<div class="coming_soon">
    <img src="{{asset('img/logo_small.png')}}" alt="">
    <h1>まだ田植え中デス。</h1>
</div>


<ul class="menu_fixed">
    <a href="{{ url('/find') }}"><li><i class="fas fa-search"></i><span>検索する</span></li></a>
    <a href="{{ url('/create') }}"><li><i class="far fa-plus-square"></i><span>投稿する</span></li></a>
    <a href="{{ url('/saved') }}"><li><i class="far fa-bookmark"></i><span>お気に入り</span></li></a>
</ul>
@endsection