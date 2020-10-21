<?php

namespace App\Http\Controllers;

use App\User;
use App\Recipe;
use App\Ingredient;
use App\CookedRecipe;
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

    public function courses(){
      $courses = array();
      $overview = Course::get();
      foreach($overview as $data){
        $lessons = Lesson::where('course_id', $data->id)
        ->select('lesson_id', 'name', 'hd_img', 'desc', 'recipe_id')
        ->get();
        foreach($lessons as $lesson){
          $lesson->hd_img = 'https://okomemode.com/img/'.$lesson->hd_img;
        }
        $course = [
          "course_id" => $data->id,
          "name" => $data->name,
          "english" => $data->english,
          "color" => $data->color,
          "image" => 'https://okomemode.com/img/'.$data->image,
          "desc" => $data->desc,
          "lessons" => $lessons,
        ];
        array_push($courses, $course);
      }
      return $courses;
    }

    public function course(Course $course){
      $lessons = Lesson::where('course_id', $course->id)
      ->select('lesson_id', 'name', 'hd_img', 'desc', 'recipe_id')
      ->get();
      foreach($lessons as $lesson){
        $lesson->hd_img = 'https://okomemode.com/img/'.$lesson->hd_img;
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
      dd($course_item);
    }
}