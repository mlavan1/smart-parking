<?php

namespace App\Http\Controllers;

use App\Model\searchslot;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class SlotsController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());

        $location = $request->query('location');
        $date = $request->query('date');
        $time = $request->query('time');
        Session::put('date', $date);
        Session::put('time', $time);
        $slots = \DB::table('slots')->get();


        return view('search', compact('slots'));
    }

    public function book(Request $request)
    {

        $selectedSlots = $request->input('slots');
        $slots = explode(',', $request->input('slots'));

        Session::put('selected_slots', $slots);

        if (auth()->check()) {
            return redirect()->route('details');
        }
        Redirect::setIntendedUrl(route('slots.view'));

        return redirect("/login");
    }
}
