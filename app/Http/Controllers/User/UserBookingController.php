<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserBookingController extends Controller
{
    

    public function viewUserBookings()
    {
        $all_bookings = DB::table('bookings')
            ->leftJoin('users', 'users.id', '=', 'bookings.user_id')
            ->leftJoin('vehicles', 'vehicles.id', '=', 'bookings.vehicle_id')
            ->leftJoin('booked_slots', 'booked_slots.booking_id', '=', 'bookings.id')
            ->leftJoin('all_slots', 'all_slots.id', '=', 'booked_slots.slot_id')
            ->leftJoin('parking_lots', 'parking_lots.id', '=', 'bookings.parking_lot_id')
            ->leftJoin('locations', 'locations.id', '=', 'parking_lots.location_id')
            ->select(
                'bookings.id',
                'bookings.status',
                'bookings.date_time',
                'parking_lots.name as parking_lot_name',
                'locations.location_name as location_name',
                DB::raw("CONCAT(tbl_vehicles.v_color, ' ', tbl_vehicles.v_make, ' ', tbl_vehicles.v_model) as vehicle_details"),
                'vehicles.license_plate',
                DB::raw("GROUP_CONCAT(tbl_all_slots.name ORDER BY tbl_all_slots.name ASC SEPARATOR ', ') as slot_names"),
            )
            ->where('bookings.user_id', auth()->user()->id)
            ->groupBy(
                'bookings.id',
            )
            ->get();

            // dd($all_bookings);

        return view ('user.bookings', compact('all_bookings'));
    }

    public function viewUserVehicles(){
        $all_vehicles = DB::table('vehicles')
        ->select('vehicles.*',
        DB::raw("CONCAT(tbl_vehicles.v_color, ' ', tbl_vehicles.v_make, ' ', tbl_vehicles.v_model) as vehicle_details"),
        'vehicles.license_plate',
        )
        ->join('bookings', 'vehicles.id', '=', 'bookings.vehicle_id')
        ->where('bookings.user_id', auth()->user()->id)
        ->groupBy(
            'vehicles.id',
        )
        ->get();
        return view ('user.vehicles', compact('all_vehicles'));
    }
}
