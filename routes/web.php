<?php

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

Route::get('/', [App\Http\Controllers\MovieController::class, 'index'])->name('movie.index');
//Route::get('/show/{id}', [App\Http\Controllers\MovieController::class, 'show'])->name('movie.show');
Route::get('/search/{letter}', [App\Http\Controllers\MovieController::class, 'search'])->name('movie.search');

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');


Route::get('admin/create', [App\Http\Controllers\MovieController::class, 'create'])->name('admin.create');
Route::post('admin/store', [App\Http\Controllers\MovieController::class, 'store'])->name('admin.store');
Route::delete('admin/delete/{movie}', [App\Http\Controllers\MovieController::class, 'destroy'])->name('admin.destroy');
