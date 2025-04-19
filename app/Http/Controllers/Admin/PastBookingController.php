<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PastBookingController extends Controller
{
    public function viewPastBooking()
    {
        $all_bookings = DB::table('bookings')
            ->join('users', 'users.id', '=', 'bookings.user_id')
            ->join('vehicles', 'vehicles.id', '=', 'bookings.vehicle_id')
            ->join('booked_slots', 'booked_slots.booking_id', '=', 'bookings.id')
            ->join('slots', 'slots.id', '=', 'booked_slots.slot_id')
            ->select(
                'users.name',
                'slots.user_id as user_type',
                'users.contact_number',
                'bookings.id',
                'bookings.user_id',
                'bookings.status',
                'bookings.date_time',
                DB::raw("CONCAT(tbl_vehicles.v_color, ' ', tbl_vehicles.v_make, ' ', tbl_vehicles.v_model) as vehicle_details"),
                'vehicles.license_plate',
                DB::raw("GROUP_CONCAT(tbl_slots.name ORDER BY tbl_slots.name ASC SEPARATOR ', ') as slot_names")
            )
            ->where('bookings.date_time', '<', Carbon::now())
            ->groupBy(
                'bookings.id',
                'slots.user_id',
                'users.name',
                'users.contact_number',
                'bookings.user_id',
                'bookings.status',
                'bookings.date_time',
                'vehicles.v_color',
                'vehicles.v_make',
                'vehicles.v_model',
                'vehicles.license_plate'
            )
            ->get();

        return view('admin.past-booking', compact('all_bookings'));
    }
}
