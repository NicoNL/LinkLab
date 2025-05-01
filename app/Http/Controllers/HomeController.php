<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    
    public function contact()
    {
        return view('contact');
    }
    public function home()
    {
        return view('welcome');
    }
}
