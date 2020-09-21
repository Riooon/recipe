@extends('layouts.app')
@section('content')

<!-- バリデーションエラーの表示に使用-->
@include('common.errors')
<!-- バリデーションエラーの表示に使用-->

<div class="recipe_inner">
    @if (count($recipes) > 0)

        @foreach ($recipes as $recipe)

        <div class="recipe_card">
            <a href="{{ url('recipe/'.$recipe->id) }}"><img src="{{ asset('storage/img/'.$recipe->hd_img), true }}" alt onerror="this.onerror"></a>
            <div class="recipe_titles">
                <a href="{{ url('recipe/'.$recipe->id) }}"><h4>{{ $recipe->title }}</h4></a>
                <p>posted by</p><br>
                <a href="{{ url('userpage/'.$recipe->user_id) }}"><p>{{ $recipe->name }}</p></a>
            </div>
        </div>

        @endforeach
        <div class="pagenation">
        {{ $recipes->links()}}
    </div>
    
    @endif

</div>
@endsection
