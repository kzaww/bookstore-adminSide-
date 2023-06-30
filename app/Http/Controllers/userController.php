<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    //direct user home page
    public function home()
    {
        return view('user.home');
    }
}
