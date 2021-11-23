<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')

<div class="recipe_inner">
    
    <!-- バリデーションエラーの表示に使用-->
    @include('common.errors')
    <!-- バリデーションエラーの表示に使用-->
    <div class="form_layout">
        <form name="recipe_form" action="{{ url('recipe/update') }}" method="POST" class="recipe_form"  enctype="multipart/form-data">
            {{ csrf_field() }}
            <h4 class="cooking_procedure">レシピタイトル</h4>
            <div class="form_inner">
                <h3 class="title"><input type="text" name="title" value="{{ $recipe->title }}"></h3>
            </div>
            
            <h4 class="cooking_procedure">タイトル写真</h4>
                <img id="preview">
                <h3 class="form_img_label"><label id="form_img_label" for="hd_img">写真を選択<input id="hd_img" type="file" name="hd_img" style="display:none;"></label></h3>

            <h4 class="cooking_procedure">お買い物リスト</h4>
            <div class="form_inner">

                @for ($i = 0; $i < count($ingredients); $i++)
                    <div class="form_each">
                        <input type="text" name="ingredient_{{$i}}" class="ingredients" value='{{$ingredients[$i]->ingredient}}'>
                        <input type="number" name="amount_{{$i}}" value='{{$ingredients[$i]->amount}}'  class="amount">
                        @if ($ingredients[$i]->unit == 0)
                            <select name="unit_{{$i}}" class="units">
                                <option value="0" selected>個</option>
                                <option value="1">g</option>
                                <option value="2">ml</option>
                            </select>
                        @elseif ($ingredients[$i]->unit == 1)
                            <select name="unit_{{$i}}" class="units">
                                <option value="0">個</option>
                                <option value="1" selected>g</option>
                                <option value="2">ml</option>
                            </select>
                        @else
                            <select name="unit_{{$i}}" class="units">
                                <option value="0">個</option>
                                <option value="1">g</option>
                                <option value="2" selected>ml</option>
                            </select>
                        @endif
                    </div>
                @endfor
            </div>

            
            <h4 class="cooking_procedure">作り方</h4>
            <div class="form_inner">
                <div class="recipe_blocks">

                @for ($i = 0; $i < count($processes); $i++)

                    <div class="recipe_block" id="block_{{ $i }}">
                        <div class="desc">
                            <img id="preview_{{ $i }}" class="previews">
                            <h3 class="form_img_label"><label id="form_img_label" for="image_{{ $i }}">写真を選択<input style="display:none;" type="file" name="image_{{ $i }}" id="image_{{ $i }}"></label></h3>
                            <h3 class="text"><textarea name="text_{{ $i }}" id="" placeholder="手順{{$i+1}}">{{ $processes[$i]->text }}</textarea></h3>                        
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
            <button class="btn btn-danger" id="delete" type="submit">レシピを削除する</button>
        </form>
        </div>
    </div>
</div>
@endsection
