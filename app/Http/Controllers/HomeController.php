<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
       if(Auth::guest())
           return view("auth.login");
        return view("dashboard");
    }
}
