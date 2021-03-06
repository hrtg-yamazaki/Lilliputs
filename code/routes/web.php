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
Route::get("/logout_confirm", "ExtraAuthController@logout_confirm")->name("logout_confirm");


Route::resource('recipes', 'RecipeController');
Route::get("/recipes/{recipe}/destroy", "RecipeController@destroy_confirm")->name("recipes.destroy_confirm");

Route::group(['prefix' => 'recipes/search', 'as' => 'recipes.search.'], function () {
    Route::get('/top','RecipeSearchController@top')->name('top');
    Route::get('/title', 'RecipeSearchController@title')->name('title');
    Route::get('/category', 'RecipeSearchController@category')->name('category');
});

Route::group(['prefix' => 'recipes/roulette', 'as' => 'roulette.'], function () {
    Route::get('/ready', 'RouletteController@ready')->name('ready');
    Route::get('/result', 'RouletteController@result')->name('result');
});


Route::get('/api/recipes/search/category', 'ApiController@categorySearch')->name("api.category_search");
