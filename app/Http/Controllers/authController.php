<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class authController extends Controller
{
    //direct loginPage
    public function loginPage()
    {
        return view('auth.login');
    }

    //direct loginPage
    public function registerPage()
    {
        return view('auth.register');
    }

    //redirect admin and user pages
    public function dashboard()
    {
        if(auth()->user()->role == 'admin')
        {
            return redirect()->route('admin#dashboard');
        }elseif(auth()->user()->role == 'user')
        {
            return redirect()->route('user#home');
        }
    }
}
