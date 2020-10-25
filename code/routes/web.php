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

Route::get('/', "RecipeController@index")->name("root");

Auth::routes();

Route::resource('recipes', 'RecipeController', [
    'only' => ['show', "create", "store", "destroy"]
]);
Route::get("/recipes/{recipe}/destroy", "RecipeController@destroy_confirm")->name("recipes.destroy_confirm");
