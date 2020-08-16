<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')

<div>
    
    <!-- バリデーションエラーの表示に使用-->
    @include('common.errors')
    <!-- バリデーションエラーの表示に使用-->

    <form name="recipe_form" action="{{ url('recipe/update') }}" method="POST" class="recipe_form"  enctype="multipart/form-data">
        {{ csrf_field() }}
        <h4 class="cooking_procedure">レシピタイトル</h4>
        <div class="form_inner">
            <h3 class="title"><input type="text" name="title" value="{{ $recipe->title }}"></h3>
        </div>
        
        <h4 class="cooking_procedure">タイトル写真</h4>
        <div class="form_inner">
<<<<<<< HEAD
            <img id="preview">
            <h3><input type="file" name="hd_img" id="hd_img"></h3>
=======
            <h3><input type="file" name="hd_img"></h3>
>>>>>>> origin/master
        </div>

        <h4 class="cooking_procedure">お買い物リスト</h4>
        <div class="form_inner">
            @for ($i = 0; $i < 7; $i++)
                <input type="text" name="ingredient_{{$i}}" value='{{ $ingredients->first()->{"ingredient_".$i} }}' class="ingredients">
            @endfor
        </div>
        
        <h4 class="cooking_procedure">作り方</h4>
        <div class="form_inner">
            <div class="recipe_blocks">

<<<<<<< HEAD
            @for ($i = 0; $i < 5; $i++)

                <div class="recipe_block" id="block_{{ $i }}">
                    <div class="desc">
                        <img id="preview_{{ $i }}" class="previews">
                        <input type="file" name="image_{{ $i }}" id="image_{{ $i }}">
                        <h3 class="text"><textarea name="text_{{ $i }}" id="" placeholder="手順{{$i+1}}">{{ $processes[$i]->text }}</textarea></h3>                        
=======
            @for ($i = 0; $i < 3; $i++)

                <div class="recipe_block" id="block_{{ $i }}">
                    <div class="desc">
                        <input type="file" name="image_{{ $i }}">
                        <h3 class="text"><textarea name="text_{{ $i }}" id="">{{ $processes[$i]->text }}</textarea></h3>                        
>>>>>>> origin/master
                    </div>
                    <div class="updown">
                        <i class="fas fa-arrow-circle-up" id="block{{ $i }}_up"></i>
                        <i class="fas fa-arrow-circle-down" id="block{{ $i }}_down"></i>
                    </div>
                    <input type="hidden" name="sort_{{ $i }}" id="sort_{{ $i }}" value="">
                </div>
                
            @endfor

            </div>

            <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
            <button type="button" id="recipe_submit">更新</button>
        </div>
    </form>

    <div class="wdithdraws">
    <form action="{{ url('recipe/'.$recipe->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
<<<<<<< HEAD
        <button class="btn btn-danger" id="delete" type="submit">レシピを削除する</button>
=======
        <button type="submit" class="btn btn-danger">レシピを削除する</button>
>>>>>>> origin/master
    </form>
    </div>
    

</div>
@endsection
