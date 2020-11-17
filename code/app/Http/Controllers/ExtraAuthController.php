<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtraAuthController extends Controller
{

    public function __construct(){
        $this->middleware("auth")->only(["logout_confirm"]);
    }

    /**
     * logout confirm
     */
    public function logout_confirm()
    {
        return view("auth.logout_confirm");
    }

}
