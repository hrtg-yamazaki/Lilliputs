<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;

class LotteryController extends Controller
{

    /**
     * 「くじ引き」の開始ページ
     */
    public function draw(){
        return view("lottery.draw");
    }

}
