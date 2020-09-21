<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')

<div class="recipe_inner">

<p class="category_bar">ストックしたレシピ</p>
    
    @isset($ingredient_items)
        @foreach($records as $record)
        <div class="recipe_horizontal_card">
            <div class="left">
                <a href="{{ url('recipe/'.$record->id) }}"><img src="{{ asset('storage/img/'.$record->hd_img) }}"></a>
            </div>
            <div class="right">
                <a href="{{ url('recipe/'.$record->id) }}"><h3>{{$record->title}}</h3></a>
                <form action="{{ url('stock/remove') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="submit" value="削除" class="stock_remove_btn">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="recipe_id" value="{{ $record->recipe_id }}">
                </form>
            </div>
        </div>
        @endforeach
    @endisset
    @empty($ingredient_items)
        <p class="stock_else">献立に登録したレシピが表示されます</p>
    @endempty

    <p class="category_bar">必要な食材</p>

    @isset($ingredient_items)
    <div class="shopping_list">
        @foreach ($ingredient_items as $ingredient_item)
            @if(!$ingredient_item==NULL)
                <ul>
                    <li class="take_up">{{$ingredient_item[0]}}</li>
                    <li>{{$ingredient_item[1]}}</li>
                    @if($ingredient_item[2]==0)
                    <li class="space">個</li>
                    @elseif($ingredient_item[2]==1)
                    <li class="space">g</li>
                    @elseif($ingredient_item[2]==2)
                    <li class="space">ml</li>
                    @endif
                </ul>
            @endif
        @endforeach
    </div>
    @endisset
    @empty($ingredient_items)
    <p class="stock_else">一週間の食材リストが表示されます</p>
    @endempty

    <form action="{{ url('/stock/destroy') }}" method="post" class="stock_destroy_form">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <input type="hidden" name="level_up" value="0.7">
        @for($i=0; $i<count($records); $i++)
         <input type="hidden" name="recipe_ids[]" value={{$records[$i]->recipe_id}}>
        @endfor
        <input type="submit" value="今週の献立をクリア" class="stock_destroy"  id="stock_destroy">
    </form>

    
</div>

@endsection
