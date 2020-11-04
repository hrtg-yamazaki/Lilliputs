<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $maingred_id = $request->maingred_id;
        $method_id = $request->method_id;

        return view("roulette.result", [
            "maingred_id" => $maingred_id,
            "method_id"   => $method_id
        ]);
    }

}
