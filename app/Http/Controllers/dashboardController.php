<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    //redirect dashboard page
    public function dashboard()
    {
        return view('admin.dashboard.dashboard');
    }
}
