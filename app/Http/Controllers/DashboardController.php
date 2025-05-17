<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\Vehicle;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;

            if ($usertype == 'user') {
                $activeBookingsCount = Booking::where('user_id', Auth::id())
                    ->where('status', 'active')
                    ->where('date_time', '>', now())
                    ->count();
                $allBookingsCount = Booking::where('user_id', Auth::id())
                    ->where('status', 'active')
                    ->count();

                $allVehiclesCount = Vehicle::where('user_id', Auth::id())
                    ->leftJoin('users', 'users.id', '=', 'vehicles.user_id')
                    ->where('users.usertype', '=', 'user')
                    ->count();
                return view('user.dashboard', compact('activeBookingsCount', 'allBookingsCount', 'allVehiclesCount'));
            }
            if ($usertype == 'admin') {
                return view('admin.dashboard');
            }
            else if ($usertype == 'vendor') {
                return view('vendor.dashboard');
            }
            else if ($usertype == 'gate_keeper') {
                $todayStart = Carbon::today();
                $todayEnd = Carbon::today()->endOfDay();

                $allTodayVehicles = DB::table('vehicles')
                    ->select(
                        'vehicles.id as vehicle_id',
                        'bookings.id as booking_id',
                        DB::raw("CONCAT(tbl_vehicles.v_color, ' ', tbl_vehicles.v_make, ' ', tbl_vehicles.v_model) as vehicle_details"),
                        'vehicles.license_plate',
                        'all_slots.status as status',
                        )
                    ->join('bookings', 'vehicles.id', '=', 'bookings.vehicle_id')
                    ->join('booked_slots', 'bookings.id', '=', 'booked_slots.booking_id')
                    ->join('all_slots', 'all_slots.id', '=', 'booked_slots.slot_id')
                    ->whereBetween('bookings.date_time', [$todayStart, $todayEnd])
                    ->where('bookings.status', 'active')
                    ->whereIn('all_slots.status', ['booked', 'parked'])
                    ->distinct('vehicles.id')
                    ->get();

                    // dd($allTodayVehicles);

                return view('gate_keeper.dashboard', compact('allTodayVehicles'));
            }
            return view('gate_keeper.dashboard');
        } else {
            return redirect()->intended();
        }
    }
}
