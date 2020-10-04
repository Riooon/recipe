@extends('layouts.app')
@section('content')

<!-- バリデーションエラーの表示に使用-->
@include('common.errors')
<!-- バリデーションエラーの表示に使用-->

<div class="recipe_inner">
    @if (count($recipes) > 0)
    <p class="category_bar">検索結果</p>
    @foreach ($recipes as $recipe)
        <div class="recipe_card">
            <a href="{{ url('recipe/'.$recipe->id) }}"><img src="{{ asset('storage/img/'.$recipe->hd_img), true }}" alt onerror="this.onerror"></a>
            <div class="recipe_titles">
                <a href="{{ url('recipe/'.$recipe->id) }}"><h4>{{ $recipe->title }}</h4></a>
                <p class="gray">posted by</p><br>
                <p>{{ $recipe->name }}</p>
            </div>
        </div>
    @endforeach

    <div class="pagination">
        {{ $recipes->links() }}
    </div>
    
    @endif

</div>
@endsection
