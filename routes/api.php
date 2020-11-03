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

Route::get('courses/{user}','ExportController@courses');
Route::get('course/{course}/{user}','ExportController@course');

Route::get('/stock/{user}', 'ExportController@stock');
Route::post('/add_stock', 'ExportController@add_stock');
Route::post('/remove_stock', 'ExportController@remove_stock');
Route::post('/destroy_stock', 'ExportController@destroy_stock');



Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
});

Route::group([
    'prefix' => 'auth',
    'middleware' => 'auth:api'
], function () {
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});