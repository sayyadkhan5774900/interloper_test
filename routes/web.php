<?php

use App\Http\Controllers\TaskController;
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

Route::get('add-task', [TaskController::class, 'addTask']);
Route::post('store-task', [TaskController::class, 'storeTask'])->name('store-task');
Route::post('task-edit', [TaskController::class, 'TaskEdit'])->name('task-update');

Route::get('all-task', [TaskController::class, 'allTask']);

Route::delete('/delete-task/{id}', [TaskController::class, 'deleteTask'])->name('task.delete');
Route::get('/complete-task/{id}', [TaskController::class, 'completeTask']);

