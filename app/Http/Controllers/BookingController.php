<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GatekeeperController extends Controller
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
}
