<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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
Route::get('/', function ()
{
    return redirect()->route('categories.list');
});
Route::get('/categories/{id?}',[CategoryController::class,'index'])->name('categories.list');
Route::get('categories/create',[CategoryController::class,'create'])->name('categories.create');
Route::post('categories/store',[CategoryController::class,'store'])->name('categories.store');
Route::get('categories/edit/{id}',[CategoryController::class,'edit'])->name('categories.edit');
Route::post('categories/update/{id}',[CategoryController::class,'update'])->name('categories.update');
Route::get('categories/delete/{id}',[CategoryController::class,'delete'])->name('categories.delete');
