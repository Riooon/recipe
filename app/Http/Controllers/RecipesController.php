<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Recipe;
use App\Process;
use App\Ingredient;
use App\User;
use Validator;

class RecipesController extends Controller
{
    public function list(){
        $recipes = Recipe::join('users', 'recipes.user_id', '=', 'users.id')
        ->orderBy('recipes.created_at', 'desc')
        ->select('recipes.id', 'recipes.title', 'recipes.hd_img', 'recipes.user_id', 'users.name')
        ->paginate(10);
        return view('list',compact('recipes'));
    }

    public function store(Request $request){
        //バリデーション
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'hd_img' => 'required',
            'ingredient_0' => 'required',
        ]);
        //バリデーション:エラー 
        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }
        $recipes = new Recipe();
        $recipes->title = $request->title;
        $recipes->user_id = $request->user_id;
        if(!$request->file('hd_img')==NULL){
            Storage::delete('public/img/'.$request->hd_img);
            $path = $request->file('hd_img')->store('public/img');
            $recipes->hd_img = basename($path);
        }
        $recipes->save();

        $recipe_id = $recipes->id;

        for ($i = 0; $i < 3; $i++){
            ${"processes".$i} = new Process();
            ${"processes".$i}->text = $request->{"text_".$i};
            ${"processes".$i}->recipe_id = $recipe_id;
            ${"processes".$i}->sort = $request->{"sort_".$i};
            if(!$request->file("image_".$i)==NULL){
                Storage::delete('public/img/'.$request->{"image_".$i});
                $path = $request->file("image_".$i)->store('public/img');
                ${"processes".$i}->image = basename($path);
            }
            ${"processes".$i}->save();
        }

        $ingredients = new Ingredient();
        $ingredients->recipe_id = $recipe_id;
        for ($i = 0; $i < 7; $i++){
        $ingredients->{"ingredient_".$i} = $request->{"ingredient_".$i};
        }
        $ingredients->save();
        return back();
    }
    

    public function saved(){
        return view('saved');
    }

    public function find(){
        $recipes = Recipe::join('users', 'recipes.user_id', '=', 'users.id')
        ->orderBy('recipes.created_at', 'desc')
        ->select('recipes.id', 'recipes.title', 'recipes.hd_img', 'users.name')
        ->take(4)->get();
        return view('find', compact('recipes'));
    }

    public function create(){
        return view('create');
    }
    
    public function result(){
        return view('result');
    }

    public function detail(Recipe $recipe){
        $processes = Recipe::join('processes', 'recipes.id', '=', 'processes.recipe_id')
        ->where('processes.recipe_id', $recipe->id)
        ->orderBy('processes.sort', 'asc')
        ->get();
        $ingredients = Ingredient::where('recipe_id', $recipe->id)->get();
        return view('detail', compact('recipe' , 'processes', 'ingredients'));
    }

    public function recipeedit(Recipe $recipe){
        $processes = Recipe::join('processes', 'recipes.id', '=', 'processes.recipe_id')
        ->where('processes.recipe_id', $recipe->id)
        ->get();
        $ingredients = Ingredient::where('recipe_id', $recipe->id)->get();
        return view('recipeedit', compact('recipe', 'processes', 'ingredients'));
    }

    public function update(Request $request){
        $recipes = Recipe::find($request->recipe_id);
        if(!$recipes->title==NULL){
            $recipes->title = $request->title;
        }
        if(!$request->file('hd_img')==NULL){
            Storage::delete('public/img/'.$request->hd_img);
            $path = $request->file('hd_img')->store('public/img');
            $recipes->hd_img = basename($path);
        }
        $recipes->save();

        $recipe_id = $recipes->id;

        $processes = Process::where('recipe_id',$recipe_id)->get();

        for ($i = 0; $i < 3; $i++){
            $processes[$i]->text = $request->{"text_".$i};
            $processes[$i]->sort = $request->{"sort_".$i};
            if(!$request->file("image_".$i)==NULL){
                Storage::delete('public/img/'.$request->{"image_".$i});
                $path = $request->file("image_".$i)->store('public/img');
                $processes[$i]->image = basename($path);
            }
            $processes[$i]->save();
        }

        $ingredients = Ingredient::where('recipe_id',$recipe_id)->first();
        for ($i = 0; $i < 7; $i++){
            $ingredients->{"ingredient_".$i} = $request->{"ingredient_".$i};
        }
        $ingredients->save();

        return redirect('recipe/'.$request->recipe_id);        
    }

    public function destroy(Recipe $recipe){
        $recipe->delete();
        return redirect('userpage/'.$recipe->user_id);
    }

    public function index(Request $request){
    #キーワード受け取り
    $keyword = $request->input('keyword');
    #クエリ生成
    $query = Recipe::query();
    #もしキーワードがあったら
    if(!empty($keyword))
    {
        $query->where('title','like','%'.$keyword.'%');
    }
    #ページネーション
    $recipes = $query->orderBy('created_at','desc')->paginate(10);
    return view('result', compact('recipes', 'keyword'));
    }
}