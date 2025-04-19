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

    public function viewLocationSelection(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location_id' => 'required',
            'date'   => 'required|date|after_or_equal:today',
            'time'  => 'required',
        ],
        [
            'location_id.required' => "Location is required",
            'date.required' => "Date is required",
            'date.after_or_equal' => "Invalid date",
            'time.required' => "Time is required"
        ]);

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

    public function viewSlotsSelection(Request $request)
    {


        $location = $request->query('location_id');
        $date = $request->query('date');
        $time = $request->query('time');
        Session::put('date', $date);
        Session::put('time', $time);
        Session::put('location', $location);
        $slots = DB::table('slots')->get();


        return view('slots-selection', compact('slots'));
    }

    // BOOK SLOTS - SESSION STORE


    public function checkingAuthentication(Request $request)
    {
        //dd($request->all());
        $selectedSlots = $request->input('slots');
        $slots = explode(',', $request->input('slots'));

        Session::put('selected_slots', $slots);

        if (auth()->check()) {
            return redirect()->route('booking.details');
        }
        Redirect::setIntendedUrl(route('booking.details'));
        return redirect("/login");
    }

    public function viewBookingDetailsPage(){
        //dd(session()->all());

        $slots_count = count(Session::get('selected_slots'));
        $date = Session::get('date');
        $time = Session::get('time');
        $location = Session::get('location');
        
        $location_name = DB::table('locations')
            ->where('locations.id', $location)
            ->pluck('locations.location_name');

        return view('details',compact('slots_count','time','date','location_name'));
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
        try {
            $validator = Validator::make($request->all(), [
                'v_make'        => 'required|string|max:255',
                'v_model'       => 'nullable|string|max:255',
                'v_color'       => 'nullable|string|max:255',
                'license_plate' => 'required|string|max:255',
                'full_name'  => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $vehicle = new Vehicle();
            $vehicle->user_id = Auth::id();
            $vehicle->v_make = $request->v_make;
            $vehicle->v_model = $request->v_model;
            $vehicle->v_color = $request->v_color;
            $vehicle->license_plate = $request->license_plate;
            $vehicle->save();

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
                }
            }
            Session::flush();
        } catch (\Exception $e) {
            Log::info("Error==>" . $e);
        }
    }
}
