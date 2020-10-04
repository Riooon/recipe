<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use \InterventionImage;

use App\Recipe;
use App\Process;
use App\Ingredient;
use App\User;
use App\Stocked_Recipe;
use App\CookedRecipe;
use App\Lesson;
use App\CompletedLesson;
use Illuminate\Pagination\LengthAwarePaginator;

use Validator;

class ShareController extends Controller
{   
    public function store(Request $request){
        //バリデーション
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'hd_img' => 'required',
            'ingredient_0' => 'required',
            'text_0' => 'required',
            'hd_img' => 'max:2560',
            'image_0' => 'max:1240',
            'image_1' => 'max:1240',
            'image_2' => 'max:1240',
            'image_3' => 'max:1240',
            'image_4' => 'max:1240',
        ],[
            'title.required' => 'レシピタイトルが未入力です',
            'hd_img.required' => 'タイトル写真が選択されていません',
            'ingredient_0.required' => '材料を最低一つ登録しましょう',
            'text_0.required' => '作り方を最低一つ登録しましょう',
            'hd_img.max' => '画像サイズが大きすぎます（アップロードできるタイトル画像は最大2.5MBです）',
            'image_0.max' => '画像サイズが大きすぎます（アップロードできるレシピ画像は最大1MBです）',
            'image_1.max' => '画像サイズが大きすぎます（アップロードできるレシピ画像は最大1MBです）',
            'image_2.max' => '画像サイズが大きすぎます（アップロードできるレシピ画像は最大1MBです）',
            'image_3.max' => '画像サイズが大きすぎます（アップロードできるレシピ画像は最大1MBです）',
            'image_4.max' => '画像サイズが大きすぎます（アップロードできるレシピ画像は最大1MBです）',
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
            $file = $request->file('hd_img');
            // 画像のリサイズ
            InterventionImage::make($file)->resize(1080, null, function ($constraint) {$constraint->aspectRatio();})->save();
            $path = $file->store('public/img');
            $recipes->hd_img = basename($path);
        }

        $recipes->save();

        $recipe_id = $recipes->id;

        for ($i = 0; $i < 5; $i++){
            if(!$request->{"text_".$i}==NULL){
                ${"processes".$i} = new Process();
                ${"processes".$i}->text = $request->{"text_".$i};
                ${"processes".$i}->recipe_id = $recipe_id;
                ${"processes".$i}->sort = $request->{"sort_".$i};
                if(!$request->file("image_".$i)==NULL){
                    Storage::delete('public/img/'.$request->{"image_".$i});
                    $file = $request->file("image_".$i);
                    // 画像のリサイズ
                    InterventionImage::make($file)->resize(1080, null, function ($constraint) {$constraint->aspectRatio();})->save();
                    $path = $file->store('public/img');
                    ${"processes".$i}->image = basename($path);
                }
                ${"processes".$i}->save();
            }
        }

        for ($i = 0; $i < 7; $i++){
            if(!$request->{"ingredient_".$i}==NULL){
                ${"ingredients".$i} = new Ingredient();
                ${"ingredients".$i}->recipe_id = $recipe_id;
                ${"ingredients".$i}->ingredient = $request->{"ingredient_".$i};
                ${"ingredients".$i}->amount = $request->{"amount_".$i};
                ${"ingredients".$i}->unit = $request->{"unit_".$i};
                ${"ingredients".$i}->save();
            }
        }

        $user = User::find($request->user_id);
        $user->level += $request->level_up;
        $user->save();

        return back();
    }
    

    public function play(Recipe $recipe){
        $processes = Process::where('recipe_id', $recipe->id)->orderBy('processes.sort', 'asc')->get();
        return view('play', compact('recipe', 'processes'));
    }

    
    public function stock(){
        $records = Stocked_Recipe::where('stocked_recipes.user_id',Auth::user()->id)
        ->join('recipes', 'recipes.id', '=', 'stocked_recipes.recipe_id')
        ->get();

        $stocked_recipes = Stocked_Recipe::where('stocked_recipes.user_id',Auth::user()->id)->get();
        $recipe_ids = [];
        foreach($stocked_recipes as $stocked_recipe){
            array_push($recipe_ids, $stocked_recipe->recipe_id);
        }        
        $ingredients = Ingredient::whereIn('recipe_id', $recipe_ids)->get(['ingredient','amount','unit'])->groupBy('ingredient');
        $ingredient_items = [];
        foreach($ingredients as $ingredient){
            $ingredient_item = [];
            $item_amount_box = [];
            foreach($ingredient as $item){
            array_push($item_amount_box, $item->amount);
            }
            $item_amount = array_sum($item_amount_box);
            array_push($ingredient_item, $ingredient[0]->ingredient, $item_amount, $ingredient[0]->unit);
            array_push($ingredient_items, $ingredient_item);
        }
        return view('stock', compact('records', 'ingredient_items'));
    }

    public function add(Request $request){
        $record = Stocked_Recipe::where('recipe_id',$request->recipe_id)->where('user_id',$request->user_id)->first();
        // dd($record);
        if($record==NULL){
            $stocked_recipe = new Stocked_Recipe();
            $stocked_recipe->user_id=$request->user_id;
            $stocked_recipe->recipe_id=$request->recipe_id;
            $stocked_recipe->save();
        }
        return redirect('stock');
    }

    public function remove(Request $request){
        $remove = Stocked_Recipe::where('recipe_id',$request->recipe_id)->where('user_id',$request->user_id)->delete();
        return redirect('stock');
    }

    public function stockdestroy(Request $request){
        $destroy = Stocked_Recipe::where('user_id',$request->user_id)->delete();

        foreach($request->recipe_ids as $recipe_id){
            $cooked_recipe = new CookedRecipe();
            $cooked_recipe->user_id = $request->user_id;
            $cooked_recipe->recipe_id = $recipe_id;
            $cooked_recipe->save();
        }

        // Lessonに該当するレシピがある場合、completed_lesson にデータを挿入
        foreach($request->recipe_ids as $recipe_id){
            $lesson = Lesson::where('recipe_id', $recipe_id)->first();
            if(isset($lesson)){
                $completed_lesson_data = CompletedLesson::where('course_id', $lesson->course_id)->where('lesson_id', $lesson->lesson_id)->where('user_id', $request->user_id)->first();
                if(empty($completed_lesson_data)){
                $completed_lesson = new CompletedLesson();
                $completed_lesson->course_id = $lesson->course_id;
                $completed_lesson->lesson_id = $lesson->lesson_id;
                $completed_lesson->user_id = $request->user_id;
                $completed_lesson->save();                
                }   
            }
        }

        $user = User::find($request->user_id);
        $user->level += $request->level_up;
        $user->save();

        return redirect('stock');
    }


    public function find(){
        $recipes = Recipe::join('users', 'recipes.user_id', '=', 'users.id')
        ->orderBy('recipes.created_at', 'desc')
        ->select('recipes.id', 'recipes.title', 'recipes.hd_img', 'users.name')
        ->paginate(5);
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
            $file = $request->file('hd_img');
            // 画像のリサイズ
            InterventionImage::make($file)->resize(1080, null, function ($constraint) {$constraint->aspectRatio();})->save();
            $path = $file->store('public/img');
            $recipes->hd_img = basename($path);
        }
        $recipes->save();

        $recipe_id = $recipes->id;

        $processes = Process::where('recipe_id',$recipe_id)->get();

        for ($i = 0; $i < 5; $i++){
            $processes[$i]->text = $request->{"text_".$i};
            $processes[$i]->sort = $request->{"sort_".$i};
            if(!$request->file("image_".$i)==NULL){
                Storage::delete('public/img/'.$request->{"image_".$i});
                $file = $request->file("image_".$i);
                // 画像のリサイズ
                InterventionImage::make($file)->resize(1080, null, function ($constraint) {$constraint->aspectRatio();})->save();
                $path = $file->store('public/img');
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
        Storage::delete('public/img/'.$recipe->hd_img);
        $ingredient = Ingredient::where('recipe_id',$recipe->id)->delete();
        $processes = Process::where('recipe_id',$recipe->id)->get();
        foreach ($processes as $process){
            $process->delete();
            Storage::delete('public/img/'.$process->image);
        }
        $stocked_recipe = Stocked_Recipe::where('recipe_id', $recipe->id)->delete();
        $cooked_recipe = CookedRecipe::where('recipe_id', $recipe->id)->delete();
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
    $recipes = $query->join('users', 'recipes.user_id', '=', 'users.id')
    ->orderBy('recipes.created_at','desc')
    ->select('recipes.id', 'recipes.title', 'recipes.hd_img', 'recipes.user_id', 'users.name')
    ->paginate(5);
    return view('result', compact('recipes', 'keyword'));
    }

    // このページは現在しようしていない（ファイルは残したまま）
    public function list(){
        $recipes = Recipe::join('users', 'recipes.user_id', '=', 'users.id')
        ->orderBy('recipes.created_at', 'desc')
        ->select('recipes.id', 'recipes.title', 'recipes.hd_img', 'recipes.user_id', 'users.name')
        ->paginate(5);
        return view('list',compact('recipes'));
    }
}