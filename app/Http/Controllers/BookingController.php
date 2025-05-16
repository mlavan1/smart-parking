<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Booking;
use App\Models\Slot;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class BookingController extends Controller
{

    // LANDING PAGE - VIEW

    public function viewLandingPage()
    {

        $places = DB::table('locations')->get();
        return view('home', compact('places'));
    }

    // LOCATION SELECTION PAGE - VIEW

    public function viewLocationSelectionPage(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'location_id' => 'required',
                'date'   => 'required|date|after_or_equal:today',
                'time'  => 'required',
            ],
            [
                'location_id.required' => "Location is required",
                'date.required' => "Date is required",
                'date.after_or_equal' => "Invalid date",
                'time.required' => "Time is required"
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $location_id  = $request->location_id;
        $location_name = DB::table('locations')
            ->where('locations.id', $location_id)
            ->pluck('locations.location_name');

        $parking_lots = DB::table('parking_lots')
            ->where('parking_lots.location_id', $location_id)
            ->get();
        return view('parking-lot-selection', compact('parking_lots', 'location_name'));
    }

    // SLOTS SELECTION PAGE - VIEW

    public function viewSlotsSelectionPage(Request $request)
    {
        $validated = $request->validate([
            'location_id' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'lot_id' => 'required|integer'
        ]);

        Session::put('booking_details', $validated);

        $slots = DB::table('all_slots')
            ->where('parking_lot_id', $validated['lot_id'])
            ->get();


        return view('slots-selection', compact('slots'));
    }

    // BOOK SLOTS - SESSION STORE

    public function checkingAuthentication(Request $request)
    {
        $slots = explode(',', $request->input('slots'));
        Session::put('selected_slots', $slots);

        if (auth()->check()) {
            return redirect()->route('booking.details');
        }
        Redirect::setIntendedUrl(route('booking.details'));
        return redirect("/login");
    }

    public function viewBookingDetailsPage()
    {

        $booking_details = Session::get('booking_details');
        $count_slots = count(Session::get('selected_slots'));
        $time = $booking_details['time'];
        $date = $booking_details['date'];
        $location_id = $booking_details['location_id'];
        $lot_id = $booking_details['lot_id'];

        $location_name = DB::table('locations')
            ->where('locations.id', $location_id)
            ->pluck('locations.location_name');

        return view('details', compact('count_slots', 'time', 'date', 'location_name'));
    }


    public function updateStatus(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'status' => 'required|in:confirmed,completed',
        ]);

        $booking = Booking::find($request->booking_id);
        $booking->update(['status' => $request->status]);

        return redirect()->route('gatekeeper.dashboard')->with('success', 'Status updated successfully.');
    }

    public function proceedToPay(Request $request)
    {
        Session::put('personal_details', $request->all());
        return view('payment');
    }

    public function successPayment(Request $request)
    {
        try {
            if ($request->payment_status == 1) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'full_name'  => 'required|string|max:255',
                        'email'      => 'required|string|email|max:255',
                        'contact_number'    => 'required|string|max:255',
                        'v_make'        => 'required|string|max:255',
                        'v_model'       => 'nullable|string|max:255',
                        'v_color'       => 'nullable|string|max:255',
                        'license_plate' => 'required|string|max:255',
                    ],
                    [
                        'full_name.required' => "Full name is required",
                        'email.required' => "Email is required",
                        'email.email' => "Invalid email",
                        'contact_number.required' => "Contact number is required",
                        'v_make.required' => "Vehicle make is required",
                        'license_plate.required' => "License plate is required",
                    ]
                );

                if ($validator->fails()) {
                    Log::error('Validation failed', [
                        'errors' => $validator->errors()->toArray(),
                        'input' => request()->all()
                    ]);
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }

                $vehicle = Vehicle::where('user_id', Auth::id())
                    ->where('license_plate', $request->license_plate)
                    ->first();

                if ($vehicle) {
                    $vehicle->v_make = $request->v_make;
                    $vehicle->v_model = $request->v_model;
                    $vehicle->v_color = $request->v_color;
                    $vehicle->save();
                } else {
                    $vehicle = new Vehicle();
                    $vehicle->user_id = Auth::id();
                    $vehicle->v_make = $request->v_make;
                    $vehicle->v_model = $request->v_model;
                    $vehicle->v_color = $request->v_color;
                    $vehicle->license_plate = $request->license_plate;
                    $vehicle->save();
                }

                $booking = new Booking();
                $booking->user_id = Auth::id();
                $booking->vehicle_id = $vehicle->id;
                $booking->name = $request->booking_name;
                $booking->date_time = Carbon::parse(Session::get('date') . ' ' .  Session::get('time'));
                $booking->status = 'active';
                $booking->save();

                $selectedSlots = Session::get('selected_slots');

                if (!empty($selectedSlots)) {
                    $slots = Slot::whereIn('name', $selectedSlots)->get();

                    foreach ($slots as $slot) {
                        DB::table('booked_slots')->insert([
                            'booking_id' => $booking->id,
                            'slot_id' => $slot->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        DB::table('all_slots')->where('name', $slot->name)->update(['status' => 'booked']);
                    }
                }


                Session::flush();
            }
            else{
                return redirect()->route('home.view')->withErrors('Invalid booking details');
            }
        } catch (\Exception $e) {
            Log::info("Error==>" . $e);
        }
    }
}
