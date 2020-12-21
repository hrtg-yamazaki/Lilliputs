<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
    * mypage
    */
    public function mypage()
    {
        return view("users/mypage");
    }

}
