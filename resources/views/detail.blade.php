<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')

    <div class="recipe_heaader">
    <img src="{{ asset('storage/img/'.$recipe->hd_img), true }}" alt onerror="this.onerror">
        <h1>{{ $recipe->title }}</h1>
    </div>
    <p class="category_bar">お買い物リスト</p>
    <ul class="shopping_list">
    @if (count($ingredients) > 0)
        @for ($i = 0; $i < 7; $i++)
            @if(!$ingredients->first()->{"ingredient_".$i}==NULL)
            <li>{{ $ingredients->first()->{"ingredient_".$i} }}</li>
            @endif
        @endfor
    @endif

    </ul>

    <p class="category_bar">レシピ詳細</p>

    @if (count($processes) > 0)
        @foreach ($processes as $process)
        
<<<<<<< HEAD
        @if(!$process->image==NULL || !$process->text==NULL)
=======
>>>>>>> origin/master
            <div class="recipe_prosess">
                @if(!$process->image==NULL)
                <img src="{{ asset('storage/img/'.$process->image), true }}" alt onerror="this.onerror">
                @endif
                @if(!$process->text==NULL)
                <p>{{$process->text}}</p>
                @endif
            </div>
<<<<<<< HEAD
        @endif
=======
>>>>>>> origin/master

        @endforeach
    @endif

@endsection