<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
            else if ($usertype == 'admin')
            {
                return view ('admin.layout');
            }
            else if ($usertype == 'vendor')
            {
                return view ('vendor.vendor');
            }
            else
            {
                return redirect()->back();
            }
        }
    }
}
