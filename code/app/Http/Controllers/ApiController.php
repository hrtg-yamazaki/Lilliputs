<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;

class ApiController extends Controller
{

    /**
     * カテゴリ検索非同期通信用API
     */
    public function categorySearch(Request $request)
    {
        $recipes = [];

        $maingred_id = $request->maingred;
        $method_id = $request->method;

        if ($maingred_id){
            $query = Recipe::where("maingred_id", $maingred_id);
        };
        if ($method_id){
            if ($maingred_id){
                $query = $query->where("method_id", $method_id);
            } else {
                $query = Recipe::where("method_id", $method_id);
            }
        };

        if (isset($query)){
            $recipes = $query->get();
        };

        $data = ["recipes"=>$recipes];
        return response()->json($data);
    }

}
