<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Booking;
use Carbon\Carbon;

class ActiveBookingsController extends Controller
{
    public function viewCurrentBooking()
    {
        $all_bookings = DB::table('bookings')
            ->leftJoin('users', 'users.id', '=', 'bookings.user_id')
            ->leftJoin('vehicles', 'vehicles.id', '=', 'bookings.vehicle_id')
            ->leftJoin('booked_slots', 'booked_slots.booking_id', '=', 'bookings.id')
            ->leftJoin('all_slots', 'all_slots.id', '=', 'booked_slots.slot_id')
            ->leftJoin('users as slot_owners', 'slot_owners.id', '=', 'all_slots.user_id')
            ->select(
                'bookings.id',
                'bookings.user_id',
                'bookings.status',
                'bookings.date_time',
                'users.name as booking_user_name',
                DB::raw("CONCAT(tbl_vehicles.v_color, ' ', tbl_vehicles.v_make, ' ', tbl_vehicles.v_model) as vehicle_details"),
                DB::raw("GROUP_CONCAT(tbl_all_slots.name ORDER BY tbl_all_slots.name ASC SEPARATOR ', ') as slot_names"),
                'all_slots.user_id as user_type',
                'users.contact_number',
                'vehicles.license_plate',
                'slot_owners.usertype as slot_owner_type'
            )
            ->where('bookings.date_time', '>', Carbon::now())
            ->groupBy(
                'bookings.id',
                'all_slots.user_id',
                'users.name',
                'users.contact_number',
                'bookings.user_id',
                'bookings.status',
                'bookings.date_time',
                'vehicles.v_color',
                'vehicles.v_make',
                'vehicles.v_model',
                'vehicles.license_plate',
                'slot_owners.usertype'
            )
            ->get();

        return view('admin.current-booking', compact('all_bookings'));
    }

    public function editDate($id)
    {
        $all_bookings = DB::table('bookings')
            ->join('users', 'users.id', '=', 'bookings.user_id')
            ->join('booked_slots', 'booked_slots.booking_id', '=', 'bookings.id')
            ->join('slots', 'slots.id', '=', 'booked_slots.slot_id')
            ->select(
                'users.name',
                'bookings.status',
                'bookings.date_time',
            )
            ->groupBy(
                'users.name',
                'bookings.status',
                'bookings.date_time',
            )
            ->where('bookings.id', $id)
            ->get();
        $booking = Booking::findOrFail($id);
        return view('admin.change-date', compact('all_bookings', 'booking'));
    }

    public function updateDate(Request $request, $id)
    {
        $request->validate([
            'date_time' => 'required|date',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->date_time = $request->date_time;
        $booking->save();

        return redirect()->route('admin.bookings.current')
            ->with('success', 'Booking date updated successfully.');
    }


    public function cancelBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'cancelled';
        $booking->save();

        return redirect()->back()->with('success', 'Booking cancelled successfully.');
    }

    public function acceptBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'active';
        $booking->save();

        return redirect()->back()->with('success', 'Booking reactivated successfully.');
    }
}
