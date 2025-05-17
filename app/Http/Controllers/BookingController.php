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
        $vehicle = DB::table('vehicles')
            ->join('users', 'users.id', '=', 'vehicles.user_id')
            ->where('vehicles.user_id', Auth::id())
            ->first();
        // dd($vehicle);

        return view('details', compact('count_slots', 'time', 'date', 'location_name','vehicle'));
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

            Session::put('personal_details', $request->all());
            return view('payment');

        } catch (\Exception $e) {
            Log::info("Error==>" . $e);
        }

    }

    public function rejectPayment(Request $request)
    {
        Session::forget(['booking_details', 'personal_details', 'selected_slots', ]);
        return view('payment_reject');
    }

    public function successPayment()
    {
        try {
            // dd(Session::all());
            DB::beginTransaction();
            $booking_details = Session::get('booking_details');
            $person_details = Session::get('personal_details');
            $selectedSlots = Session::get('selected_slots');

            $vehicle = Vehicle::where('user_id', Auth::id())
                ->where('license_plate', $person_details['license_plate'])
                ->first();

            if ($vehicle) {
                $vehicle->v_make = $person_details['v_make'];
                $vehicle->v_model = $person_details['v_model'];
                $vehicle->v_color = $person_details['v_color'];
                $vehicle->save();
            } else {
                $vehicle = new Vehicle();
                $vehicle->user_id = Auth::id();
                $vehicle->v_make = $person_details['v_make'];
                $vehicle->v_model = $person_details['v_model'];
                $vehicle->v_color = $person_details['v_color'];
                $vehicle->license_plate = $person_details['license_plate'];
                $vehicle->save();
            }

            $booking = new Booking();
            $booking->user_id = Auth::id();
            $booking->vehicle_id = $vehicle->id;
            $booking->parking_lot_id = $booking_details['lot_id'];
            $booking->name = $person_details['full_name'];
            $booking->date_time = Carbon::parse($booking_details['date'] . ' ' .  $booking_details['time']);
            $booking->status = 'active';
            $booking->created_at = now();
            $booking->updated_at = now();
            $booking->save();

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


            Session::forget(['booking_details', 'personal_details', 'selected_slots', ]);
            DB::commit();
            return view('payment_success');


        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Booking failed: " . $e->getMessage());
            return view('payment_reject');
        }
    }
}
