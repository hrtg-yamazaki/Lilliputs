<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;
use App\Http\Requests\RecipeSaveRequest;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::all();
        $user = \Auth::user();

        return view("recipes.index", [
            "recipes" => $recipes, "user" => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recipe = new Recipe();

        return view("recipes.create", [
            "recipe" => $recipe
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecipeSaveRequest $request)
    {
        $recipe = new Recipe();

        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->user_id = \Auth::user()->id;

        $recipe->save();

        return redirect()->route(
            "recipes.show", ["recipe"=> $recipe]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        return view("recipes.show", [
            "recipe" => $recipe
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        $head = "レシピ 【 ".$recipe->title." 】 の 編集";

        return view("recipes.edit", [
            "recipe" => $recipe
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        $recipe->title = $request->title;
        $recipe->description = $request->description;

        $recipe->save();

        return redirect()->route(
            "recipes.show", ["recipe"=> $recipe]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy_confirm(Recipe $recipe)
    {
        return view("recipes.destroy_confirm", [
            "recipe" => $recipe
        ]);
    }
    public function destroy(Request $request, Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->route("root");
    }

}
