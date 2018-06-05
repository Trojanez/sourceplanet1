<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Task;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/*Route::middleware('api')->group(function () {
    Route::apiResource('posts', 'PostController');
});*/

/*Route::get('/', 'TaskController@index');*/
Route::get('main', 'TaskController@index');
Route::get('train/{id}', 'TaskController@train');

Route::get('create',function (){
    $task=Task::find(1);
    return view('create_view', compact('task'));
});

Route::post('createtask','TaskController@create');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('test/{id}', 'TaskController@test');
