<?php

namespace App\Http\Controllers;

class WelcomePageController extends Controller
{
    public function index()
    {
        
        return view('frontend.welcome');
    }

   
}
