<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/tasks', 'TaskController@tasks');
Route::get('/get_tasks', 'TaskController@getTasks');
Route::post('store_tasks', 'TaskController@storeTasks');
Route::get('edit_tasks', 'TaskController@editTasks');
Route::post('update_tasks', 'TaskController@updateTasks');
