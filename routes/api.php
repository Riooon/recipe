<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('recipe','ExportController@recipe');
Route::get('recipe/{recipe}','ExportController@recipe_item');

Route::get('courses','ExportController@courses');
Route::get('course/{course}','ExportController@course');