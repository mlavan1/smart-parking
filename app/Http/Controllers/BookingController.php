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

class BookingController extends Controller
{
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
            $booking->date_time = Carbon::parse( Session::get('date') . ' ' .  Session::get('time'));
            $booking->status = 'active';
            $booking->save();

            $selectedSlots = Session::get('selected_slots');

            if (!empty($selectedSlots)) {
                $slots = Slot::whereIn('name', $selectedSlots)->get();

                foreach ($slots as $slot) {
                    \DB::table('booked_slots')->insert([
                        'booking_id' => $booking->id,
                        'slot_id' => $slot->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
            Session::flush();
        } catch (\Exception $e) {
            Log::info("Error==>".$e);
        }
    }
}
