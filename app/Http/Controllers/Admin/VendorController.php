<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Vendor;

use App\Models\User;

class VendorController extends Controller
{
    public function viewVendors()
    {

        // $all_bookings = DB::table('bookings')
        // ->join('users', 'users.id', '=', 'bookings.user_id')
        // ->join('vehicles', 'vehicles.id', '=', 'bookings.vehicle_id')
        // ->join('booked_slots', 'booked_slots.booking_id', '=', 'bookings.id')
        // ->join('slots', 'slots.id', '=', 'booked_slots.slot_id')
        // ->select(
        //     'users.name',
        //     'slots.user_id as user_type',
        //     'users.contact_number',
        //     'bookings.id',
        //     'bookings.user_id',
        //     'bookings.status',
        //     'bookings.date_time',
        //     DB::raw("CONCAT(tbl_vehicles.v_color, ' ', tbl_vehicles.v_make, ' ', tbl_vehicles.v_model) as vehicle_details"),
        //     'vehicles.license_plate',
        //     DB::raw("GROUP_CONCAT(tbl_slots.name ORDER BY tbl_slots.name ASC SEPARATOR ', ') as slot_names")
        // )
        // ->where('bookings.date_time', '<', Carbon::now())
        // ->groupBy(
        //     'bookings.id',
        //     'slots.user_id',
        //     'users.name',
        //     'users.contact_number',
        //     'bookings.user_id',
        //     'bookings.status',
        //     'bookings.date_time',
        //     'vehicles.v_color',
        //     'vehicles.v_make',
        //     'vehicles.v_model',
        //     'vehicles.license_plate'
        // )
        // ->get();
        $all_vendors = DB::table('users')
        ->select('users.id','users.name','users.email','users.contact_number')
        ->where('users.usertype','vendor')
        ->get();

        return view('admin.add-vendors', compact('all_vendors'));
    }

    public function vendorStore(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:6',
                'organization_name' => 'required|string|max:255',
                'address' => 'required|string',
                'personal_contact_no' => 'required|string|max:20',
                'company_contact_no' => 'required|string|max:20',
            ], [
                'name.required' => "Section is required",
                'email.required' => "Email is required",
                'password.required' => "Password is required",
                'organization_name.required' => "Organization is required",
                'address.required' => "Address is required",
                'personal_contact_no.required' => "Contact no is required",
                'company_contact_no.required' => "Contact no is required"
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'contact_number' => $request->personal_contact_no,
                'password' => Hash::make($request->password),
                'usertype' => 'vendor',
            ]);

            // Create vendor details
            Vendor::create([
                'user_id' => $user->id,
                'organization_name' => $request->organization_name,
                'address' => $request->address,
                'contact_no' => $request->company_contact_no,
            ]);

            return redirect()->back()->with('success', 'Vendor added successfully!');
        } catch (\Exception $e) {
            \Log::info("message" . $e->getMessage());
        }
    }
}
