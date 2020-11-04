<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Maingred;
use App\Method;

class RouletteController extends Controller
{
    
    /**
     * ルーレット開始ページ
     */
    public function ready()
    {
        return view("roulette.ready");
    }

    /**
     * ルーレット結果表示ページ
     */
    public function result(Request $request)
    {
        $recipes = [];
        $maingred = new Maingred;
        $method = new Method;

        if (isset($request->maingred_id)){
            $maingred = Maingred::find($request->maingred_id);
            $query = Recipe::where("maingred_id", $maingred->id);
        };
        if (isset($request->method_id)){
            $method = Method::find($request->method_id);
            if (isset($maingred->id)){
                $query = $query->where("method_id", $method->id);
            } else {
                $query = Recipe::where("method_id", $method->id);
            }
        };

        if (isset($query)){
            $recipes = $query->get();
        };

        return view("roulette.result", [
            "maingred" => $maingred,
            "method"   => $method,
            "recipes"  => $recipes
        ]);
    }

}
