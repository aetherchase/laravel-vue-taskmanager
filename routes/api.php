<?php

use App\Task;
use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/task', 'TasksController@index');

Route::post('/task', 'TasksController@store');

Route::put('/task/{task}', 'TasksController@update');

Route::delete('/task/{task}', 'TasksController@destroy');

