<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function home()
    {
        return view('home.index', [

        ]);
    }
}
