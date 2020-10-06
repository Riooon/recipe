<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Ingredient;
use App\CookedRecipe;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function recipe(){
      $recipe_origins = Recipe::all();
      $recipes = array();
      foreach ($recipe_origins as $recipe_origin){
        $recipe = [
          "id" => $recipe_origin->id,
          "title" => $recipe_origin->title,
          "hd_img" => 'https://okomemode.com/storage/img/'.$recipe_origin->hd_img,
          "user_id" => $recipe_origin->user_id,
          "created_at" => Carbon::createFromFormat('Y-m-d H:i:s', $recipe_origin->created_at)->format('Y/m/d h:i:s'),
          "updated_at" => Carbon::createFromFormat('Y-m-d H:i:s', $recipe_origin->updated_at)->format('Y/m/d h:i:s'),
          ];
        array_push($recipes, $recipe);
      }
      return $recipes;
    }

    public function recipe_item(Recipe $recipe){
      $recipe_return = [
        "id" => $recipe->id,
        "title" => $recipe->title,
        "hd_img" => 'https://okomemode.com/storage/img/'.$recipe->hd_img,
        "user_id" => $recipe->user_id,
        "created_at" => Carbon::createFromFormat('Y-m-d H:i:s', $recipe->created_at)->format('Y/m/d h:i:s'),
        "updated_at" => Carbon::createFromFormat('Y-m-d H:i:s', $recipe->updated_at)->format('Y/m/d h:i:s'),
      ];
      return $recipe_return;
    }
}