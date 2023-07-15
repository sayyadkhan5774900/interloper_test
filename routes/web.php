<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/viewPosts',[PostController::class,'index'])->name('view-posts');
Route::post('/addPosts',[PostController::class,'AddPost'])->name('add-posts');

Route::post('/PostComments',[CommentController::class,'addComments'])->name('add-comments');

Route::get('/admin',[Admin::class,'index'])->name('show_posts');

Route::post('/admin/update-post',[PostController::class,'update_post'])->name('update-post');

Route::post('/admin/delete-post',[PostController::class,'delete_post'])->name('delete-post');

Route::get('/admin/comments',[CommentController::class,'index'])->name('get_comment');

Route::post('admin/deleteComments',[CommentController::class,'delete_comment'])->name('delete-comment');
