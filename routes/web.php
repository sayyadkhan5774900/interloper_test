<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::controller(\App\Http\Controllers\ProductController::class)->group(function(){
    Route::get('/product_list','index')->name('product_list');
    Route::get('/add_product','add_product')->name('add_product');
    Route::post('/save_product','save_product')->name('save_product');
    Route::get('/edit_product/{id}','edit_product')->name('edit_product');
    Route::post('/update_product','update_product')->name('update_product');
    Route::get('/delete_product/{id}','delete_product')->name('delete_product');
});
