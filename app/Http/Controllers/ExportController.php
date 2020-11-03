<?php

namespace App\Http\Controllers;

use App\User;
use App\Recipe;
use App\Ingredient;
use App\CookedRecipe;
use App\Stocked_Recipe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Course;
use App\Lesson;
use App\CompletedLesson;

class ExportController extends Controller
{
    public function recipe(){
      $recipe_origins = Recipe::all();
      $recipes = array();
      foreach ($recipe_origins as $recipe_origin){
        $user = User::join('recipes', 'recipes.user_id', '=', 'users.id')
        ->where('user_id', $recipe_origin->user_id)
        ->select('users.name', 'users.icon', 'users.level')
        ->first();

        $processes = Recipe::join('processes', 'recipes.id', '=', 'processes.recipe_id')
        ->where('processes.recipe_id', $recipe_origin->id)
        ->select('processes.text', 'processes.image', 'processes.sort')
        ->orderBy('processes.sort', 'asc')
        ->get();

        $ingredients = Recipe::join('ingredients', 'recipes.id', '=', 'ingredients.recipe_id')
        ->where('ingredients.recipe_id', $recipe_origin->id)
        ->select('ingredients.ingredient', 'ingredients.amount', 'ingredients.unit')
        ->get();

        $recipe = [
          "recipe_id" => $recipe_origin->id,
          "title" => $recipe_origin->title,
          "hd_img" => 'https://okomemode.com/storage/img/'.$recipe_origin->hd_img,
          "user_name" => $user->name,
          "user_icon" => 'https://okomemode.com/storage/img/'.$user->icon,
          "user_level" => $user->level,
          "user_id" => $recipe_origin->user_id,
          "created_at" => Carbon::createFromFormat('Y-m-d H:i:s', $recipe_origin->created_at)->format('Y/m/d h:i:s'),
          "updated_at" => Carbon::createFromFormat('Y-m-d H:i:s', $recipe_origin->updated_at)->format('Y/m/d h:i:s'),
          "processes" => $processes,
          "ingredients" => $ingredients,
          ];
        array_push($recipes, $recipe);
      }
      return $recipes;
    }

    public function recipe_item(Recipe $recipe){
      $user = User::join('recipes', 'recipes.user_id', '=', 'users.id')
        ->where('user_id', $recipe->user_id)
        ->select('users.name', 'users.icon', 'users.level')
        ->first();

      $processes = Recipe::join('processes', 'recipes.id', '=', 'processes.recipe_id')
      ->where('processes.recipe_id', $recipe->id)
      ->select('processes.text', 'processes.image', 'processes.sort')
      ->orderBy('processes.sort', 'asc')
      ->get();

      $ingredients = Recipe::join('ingredients', 'recipes.id', '=', 'ingredients.recipe_id')
      ->where('ingredients.recipe_id', $recipe->id)
      ->select('ingredients.ingredient', 'ingredients.amount', 'ingredients.unit')
      ->get();

      $recipe_return = [
        "recipe_id" => $recipe->id,
        "title" => $recipe->title,
        "hd_img" => 'https://okomemode.com/storage/img/'.$recipe->hd_img,
        "user_name" => $user->name,
        "user_icon" => 'https://okomemode.com/storage/img/'.$user->icon,
        "user_level" => $user->level,
        "user_id" => $recipe->user_id,
        "created_at" => Carbon::createFromFormat('Y-m-d H:i:s', $recipe->created_at)->format('Y/m/d h:i:s'),
        "updated_at" => Carbon::createFromFormat('Y-m-d H:i:s', $recipe->updated_at)->format('Y/m/d h:i:s'),
        "processes" => $processes,
        "ingredients" => $ingredients,
      ];
      return $recipe_return;
    }

    public function courses($user_id){
      $courses = array();
      $overview = Course::get();
      foreach($overview as $data){
        $lessons = Lesson::where('course_id', $data->id)
        ->select('lesson_id', 'name', 'hd_img', 'desc', 'recipe_id')
        ->get();
        foreach($lessons as $lesson){
          $lesson->hd_img = 'https://okomemode.com/img/'.$lesson->hd_img;
        }
        $completed_lessons = CompletedLesson::where('user_id', $user_id)
        ->where('course_id', $data->id)
        ->get();
        $course = [
          "course_id" => $data->id,
          "name" => $data->name,
          "english" => $data->english,
          "color" => $data->color,
          "image" => 'https://okomemode.com/img/'.$data->image,
          "desc" => $data->desc,
          "lessons" => $lessons,
          "lesson_num" => count($lessons),
          "completed_lesson_num" => count($completed_lessons),
        ];
        array_push($courses, $course);
      }
      return $courses;
    }

    public function course($course_id, $user_id){
      $course = Course::where('id', $course_id)->first();
      $lessons = Lesson::where('course_id', $course->id)
      ->select('lesson_id', 'name', 'hd_img', 'desc', 'recipe_id')
      ->get();
      
      foreach($lessons as $lesson){
        // dd($lesson);
        $lesson->hd_img = 'https://okomemode.com/img/'.$lesson->hd_img;
        $completed_lesson = CompletedLesson::where('course_id', $course_id)
        ->where('user_id', $user_id)->where('lesson_id',$lesson->lesson_id)
        ->first();
        if($completed_lesson==NULL){
          $completed = 0;
        } else {
          $completed = 1;
        }
        $lesson->completed = $completed;
      }
      $course_item = [
        "course_id" => $course->id,
        "name" => $course->name,
        "english" => $course->english,
        "color" => $course->color,
        "image" => 'https://okomemode.com/img/'.$course->image,
        "desc" => $course->desc,
        "lessons" => $lessons,
      ];
      return $course_item;
    }

    public function stock($user){
      // dd($user);
        $records = Stocked_Recipe::where('stocked_recipes.user_id',$user)
        ->join('recipes', 'recipes.id', '=', 'stocked_recipes.recipe_id')
        ->get();

        $stocked_recipes = Stocked_Recipe::where('stocked_recipes.user_id',$user)->get();
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
        return [
          'recipes' => $records,
          'ingredients' => $ingredient_items,
        ];
    }

    public function add_stock(Request $request){
      $record = Stocked_Recipe::where('recipe_id',$request->recipe_id)->where('user_id',$request->user_id)->first();
      if($record==NULL){
          $stocked_recipe = new Stocked_Recipe();
          $stocked_recipe->user_id=$request->user_id;
          $stocked_recipe->recipe_id=$request->recipe_id;
          $stocked_recipe->save();
      }
    }

    public function remove_stock(Request $request){
      $remove = Stocked_Recipe::where('recipe_id',$request->recipe_id)
      ->where('user_id',$request->user_id)->delete();
    }

    public function destroy_stock(Request $request){
      $destroy = Stocked_Recipe::where('user_id',$request->user_id)->delete();
    }

    public function completed_course($user_id, $recipe_id){
      $courses = Course::orderBy('id', 'asc')->get();
      foreach($courses as $course){

      }
    }
}