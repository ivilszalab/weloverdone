<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StatusController;

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

Route::get('/', function () {
    return redirect('/project');
});

// ProjectController
Route::get('/project',['as' => 'project.index', 'uses' => 'App\Http\Controllers\ProjectController@index']);
Route::get('/project/{id}', ['as' => 'project.show', 'uses' => 'App\Http\Controllers\ProjectController@show']);
Route::post('/project',['as' => 'project.create', 'uses' => 'App\Http\Controllers\ProjectController@create']);
Route::post('/project/{id}',['as' => 'project.edit', 'uses' => 'App\Http\Controllers\ProjectController@edit']);
Route::delete('/project/{id}',['as' => 'project.delete', 'uses' => 'App\Http\Controllers\ProjectController@delete']);

// StatusController
Route::get('/status',['as' => 'status.index', 'uses' => 'App\Http\Controllers\StatusController@index']);
