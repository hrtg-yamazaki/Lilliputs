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

// root
Route::get('/', "RecipeController@index")->name("root");

// auth
Auth::routes();
Route::get("/logout_confirm", "ExtraAuthController@logout_confirm")->name("logout_confirm");

// recipe
Route::resource('recipes', 'RecipeController');
Route::get("/recipes/{recipe}/destroy", "RecipeController@destroy_confirm")->name("recipes.destroy_confirm");

// search recipes
Route::group(['prefix' => 'recipes/search', 'as' => 'recipes.search.'], function () {
    Route::get('/top','RecipeSearchController@top')->name('top');
    Route::get('/title', 'RecipeSearchController@title')->name('title');
    Route::get('/category', 'RecipeSearchController@category')->name('category');
});

// recipe-roulette
Route::group(['prefix' => 'recipes/roulette', 'as' => 'roulette.'], function () {
    Route::get('/ready', 'RouletteController@ready')->name('ready');
    Route::get('/result', 'RouletteController@result')->name('result');
});

// users & mypage
// Route::group(["prefix" => "users", "as" => "users."], function() {});
Route::get("/mypage", "UserController@mypage")->name("mypage");


// webAPI

Route::get('/api/recipes/search/category', 'ApiController@categorySearch')->name("api.category_search");
