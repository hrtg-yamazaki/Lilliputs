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

}
