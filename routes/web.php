<?php

use App\Recipe;
use App\Process;
use App\Ingredient;
use Illuminate\Http\Request;

// ページ一覧

Route::group(['middleware' => 'auth'], function() {
    Route::get('/saved', 'RecipesController@saved');
    Route::get('/create', 'RecipesController@create');
    
    Route::get('/userpage/{user}', 'UsersController@userpage');
    Route::get('/useredit/{user}', 'UsersController@useredit');
    Route::post('/user/update', 'UsersController@update');

    Route::get('/recipeedit/{recipe}', 'RecipesController@recipeedit');
    Route::post('/recipe/update', 'RecipesController@update');
 });

Route::get('/', 'RecipesController@find');
Route::get('/list', 'RecipesController@list');
Route::get('/result', 'RecipesController@result');
Route::get('/recipe/{recipe}', 'RecipesController@detail');

// レシピの検索
Route::resource('/index', 'RecipesController');

// レシピの追加
Route::post('/store', 'RecipesController@store');

// ユーザーの削除
Route::delete('/user/{user}', 'UsersController@destroy');
// レシピの削除
Route::delete('/recipe/{recipe}', 'RecipesController@destroy');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');