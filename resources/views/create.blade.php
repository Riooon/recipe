@extends('layouts.app')
@section('content')
    <div class="form_layout">
        
        <!-- バリデーションエラーの表示に使用-->
    	@include('common.errors')
        <!-- バリデーションエラーの表示に使用-->

        <!-- 本登録フォーム -->
        <form name="recipe_form" action="{{ url('store') }}" method="POST" class="recipe_form"  enctype="multipart/form-data">
            {{ csrf_field() }}
            <h4 class="cooking_procedure">レシピタイトル</h4>
            <div class="form_inner">
                <h3 class="title"><input type="text" name="title"></h3>
            </div>

            <h4 class="cooking_procedure">ヘッダー画像</h4>
            <div class="form_inner">
                <h3 class="title"><input id="hd_img" type="file" name="hd_img"></h3>
            </div>

            <h4 class="cooking_procedure">お買い物リスト</h4>
            <div class="form_inner">
                @for ($i = 0; $i < 7; $i++)
                <p><input type="text" name="ingredient_{{$i}}" class="ingredients"></p>
                @endfor
            </div>
            

            <h4 class="cooking_procedure">作り方</h4>
            <div class="form_inner">
                <div class="recipe_blocks">

                @for ($i = 0; $i < 3; $i++)

                    <div class="recipe_block" id="block_{{ $i }}">
                        <div class="desc">
                            <input type="file" name="image_{{ $i }}" id="image_{{ $i }}">
                            <h3 class="text"><textarea name="text_{{ $i }}" id="">block_{{ $i }}</textarea></h3>
                        </div>
                        <div class="updown">
                            <i class="fas fa-arrow-circle-up" id="block{{ $i }}_up"></i>
                            <i class="fas fa-arrow-circle-down" id="block{{ $i }}_down"></i>
                        </div>
                        <input type="hidden" name="sort_{{ $i }}" id="sort_{{ $i }}" value="">
                    </div>
                    
                @endfor

                </div>
                
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="button" id="recipe_submit">送信</button>
            </div>
        </form>

    </div>
@endsection
