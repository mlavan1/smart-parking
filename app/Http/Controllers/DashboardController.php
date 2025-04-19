<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
     {
        if (Auth::id())
        {
            $usertype=Auth()->user()->usertype;

            if($usertype== 'user')
            {
                return view ('dashboard');
            }
            if ($usertype == 'admin')
            {
                return view ('admin.dashboard');
            }
            else if ($usertype == 'vendor')
            {
                return view ('vendor.dashboard');
            }
            else
            {
                return redirect()->intended();
            }
        }
    }
}
