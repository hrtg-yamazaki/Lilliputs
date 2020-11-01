<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;

class RecipeSearchController extends Controller
{

    /** 
     * 検索ページTOP
    */
    public function top()
    {
        $message = "検索ページTOP";
        return view("recipes.search.top", [
            "message"=> $message
        ]);
    }

    /**
     * タイトル検索
     */
    public function title(Request $request)
    {
        $keyword = "";
        $recipes = [];

        if (isset($request->title)){
            $keyword = $request->title;
            $recipes = Recipe::where("title", "LIKE", "%{$keyword}%")->get();
        }

        return view("recipes.search.title", [
            "recipes"=>$recipes, "keyword"=>$keyword
        ]);
    }

    /**
     * カテゴリ検索( メイン食材 × 調理方法 )
     */
    public function category(Request $request)
    {
        $recipes = [];

        return view("recipes.search.category", [
            "recipes"=>$recipes
        ]);
    }

}
