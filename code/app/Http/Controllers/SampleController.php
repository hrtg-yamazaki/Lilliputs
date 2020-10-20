<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $message = "Hello, ".env("APP_NAME", "Laravel")."!";

        return view("sample", [
            "message" => $message
        ]);
    }
}
