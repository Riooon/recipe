<?php

use App\Recipe;
use App\Process;
use App\Ingredient;
use Illuminate\Http\Request;

// ページ一覧

Route::group(['middleware' => 'auth'], function() {
    Route::get('/saved', 'ShareController@saved');
    Route::get('/create', 'ShareController@create');
    
    Route::get('/userpage/{user}', 'UsersController@userpage');
    Route::get('/useredit/{user}', 'UsersController@useredit');
    Route::post('/user/update', 'UsersController@update');

    Route::get('/recipeedit/{recipe}', 'ShareController@recipeedit');
    Route::post('/recipe/update', 'ShareController@update');
 });

Route::get('/find', 'ShareController@find');
Route::get('/result', 'ShareController@result');
Route::get('/recipe/{recipe}', 'ShareController@detail');

// レシピの検索
Route::resource('/index', 'ShareController');

// レシピの追加
Route::post('/store', 'ShareController@store');

// ユーザーの削除
Route::delete('/user/{user}', 'UsersController@destroy');
// レシピの削除
Route::delete('/recipe/{recipe}', 'ShareController@destroy');

Auth::routes();

Route::get('/', 'CookingController@home');
Route::get('/overview', 'CookingController@overview');
Route::get('/course/{course}', 'CookingController@course');
Route::get('/course/{course}/lesson/{lesson}', 'CookingController@lesson');
Route::post('/lesson/complete', 'CookingController@complete');
Route::get('/course/{course}/lesson/{lesson}/play', 'CookingController@play');

// このページは現在しようしていない（ファイルは残したまま）
// Route::get('/list', 'ShareController@list');
