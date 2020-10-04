<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Ingredient;
use App\CookedRecipe;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    //
    public function recipe(){
      $recipes_origins = Recipe::all();
      // dd($recipes_origins);
      $recipes = array();
      $recipe = array();
      foreach($recipes_origins as $recipes_origin){
        $hd_img = $hd_img = 'https://okomemode.com/storage/img/'.$recipes_origin->hd_img;
        $recipe += array('id'=>$recipes_origin->id);
        $recipe += array('hd_img'=>$hd_img);
        $recipe += array('title'=>$recipes_origin->title);
        $recipe += array('user_id'=>$recipes_origin->user_id);
        $recipe += array('created_at'=>Carbon::createFromFormat('Y-m-d H:i:s', $recipes_origin->created_at)->format('Y/m/d h:i:s'));
        array_push($recipes, $recipe);
      }
      return $recipes;
    }

    // APIで画像を受け取りたい ↑に統合できたはず！まだテストできてない
    public function image(){
      $recipes = Recipe::all();
      foreach($recipes as $recipe){
        $hd_img = 'https://okomemode.com/storage/img/'.$recipe->hd_img;
      }
      return $hd_img;
    }


    public function recipe_item(Recipe $recipe){
      return $recipe;
    }

    public function history($user){
      $histories = array();
      $cooked_recipes = CookedRecipe::where('user_id', $user)->get();
      foreach ($cooked_recipes as $cooked_recipe){
        $history = array();
        $created_at = Carbon::createFromFormat('Y-m-d H:i:s', $cooked_recipe->created_at)->format('Y/m/d h:i:s');
        $recipe = Recipe::where('id', $cooked_recipe->recipe_id)->value('title');
        array_push($history, $created_at, $recipe);
        $ingredients = Ingredient::where('recipe_id', $cooked_recipe->recipe_id)->get()->pluck('ingredient');
        
        foreach($ingredients as $ingredient){
          array_push($history, $ingredient);
        }
        array_push($histories, $history);
      }
      return $histories;
    }
}
