<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtraAuthController extends Controller
{
    /**
     * logout confirm
     */
    public function logout_confirm()
    {
        return view("auth.logout_confirm");
    }

}
