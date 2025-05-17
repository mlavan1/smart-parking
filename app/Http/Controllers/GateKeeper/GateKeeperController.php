<?php

namespace App\Http\Controllers\GateKeeper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Vehicle;
use App\Models\BookedSlot;
use App\Models\Slot;

class GateKeeperController extends Controller
{
    public function acceptVehicle(Request $request)
    {
        // dd($request->all());

        $bookedSlots  = BookedSlot::where('booking_id', $request->booking_id)
            ->join('all_slots', 'booked_slots.slot_id', '=', 'all_slots.id')
            ->get();

            // dd($bookedSlots);
        foreach ($bookedSlots as $slot) {
            DB::table('all_slots')
                ->where('id', $slot->slot_id)
                ->update(['status' => 'parked']);
        }

        return redirect('/home')->with('success', 'Vehicle reactivated successfully.');
        Log::info('Gate Keeper Accepted');
        return view('gate_keeper.accept');
    }

    public function rejectVehicle(Request $request)
    {
        $bookedSlots  = BookedSlot::where('booking_id', $request->booking_id)
            ->join('all_slots', 'booked_slots.slot_id', '=', 'all_slots.id')
            ->get();

        foreach ($bookedSlots as $slot) {
            DB::table('all_slots')
                ->where('id', $slot->slot_id)
                ->update(['status' => 'open']);
        }

        return redirect('/home')->with('success', 'Vehicle reactivated successfully.');
        Log::info('Gate Keeper Accepted');
        return view('gate_keeper.accept');
    }
}
