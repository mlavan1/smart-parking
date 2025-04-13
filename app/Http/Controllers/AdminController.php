<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function viewAllSlots(){
        $all_slots = \DB::table('slots')->get();
        return view('admin.parking-slots',compact('all_slots'));
    }
}
