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

Auth::routes();

Route::post('follow/{user}', [App\Http\Controllers\FollowsController::class, 'store']);

Route::get('/', [App\Http\Controllers\RecipesController::class, 'index']); 
Route::get('/p/create', [App\Http\Controllers\RecipesController::class, 'create']);
Route::post('/p', [App\Http\Controllers\RecipesController::class, 'store']);
Route::delete('/p/{recipe}', [App\Http\Controllers\RecipesController::class, 'destroy']);
Route::get('/p/{recipe}/edit', [App\Http\Controllers\RecipesController::class, 'edit']);
Route::patch('/p/{recipe}', [App\Http\Controllers\RecipesController::class, 'update']);
Route::get('/p/{recipe}', [App\Http\Controllers\RecipesController::class, 'show']);


Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');

Route::get('/search', [App\Http\Controllers\UsersController::class, 'search'])->name('search');

Route::get('/ajax-form', 'Recipes@ajax_form');
Route::post('/ajax',  [App\Http\Controllers\RecipesController::class, 'ajax']);