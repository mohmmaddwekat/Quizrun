<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function home(){
        $this->publicTemplate('home',__('Home'));
    }
    public function register(){
        $this->publicAuthTemplate('register',__('Register'));
    }
}
