<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;

class RecipeSearchController extends Controller
{

    /** 
     * 検索ページTOP
    */
    public function top(){
        $message = "検索ページTOP";
        return view("recipes.search.top", [
            "message"=> $message
        ]);
    }

    /**
     * タイトル検索
     */
    public function title(){
        $recipes = Recipe::all();
        return view("recipes.search.title", [
            "recipes"=>$recipes
        ]);
    }

}
