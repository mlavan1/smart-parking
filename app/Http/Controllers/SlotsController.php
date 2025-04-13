<?php

namespace App\Http\Controllers;

use App\Model\searchslot;

use Illuminate\Http\Request;

class SlotsController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());

        $location = $request->query('location');
        $date = $request->query('date');
        $time = $request->query('time');
        $slots = \DB::table('slots')->get();

        return view('search',compact('slots'));
    }
    public function book(Request $request)
{

    $selectedSlots = $request->input('slots');
    $slots = explode(',', $request->input('slots'));
    dd( $slots);


    return response()->json(['message' => 'Booking successful test!']);
}
}
