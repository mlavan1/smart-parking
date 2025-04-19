<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Vendor;

use App\Models\User;

class VendorController extends Controller
{
    public function viewVendors()
    {
        $all_vendors = DB::table('vendors')->get();
        $all_slots = DB::table('slots')
            ->join('sections', 'slots.section_id', '=', 'sections.id')
            ->select('slots.id', 'slots.name', 'sections.section_name', 'sections.id as section_id', 'slots.status')
            ->get();
        return view('admin.add-vendors', compact('all_slots', 'all_vendors'));
    }

    public function vendorStore(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:6',
                'organization_name' => 'required|string|max:255',
                'address' => 'required|string',
                'contact_no' => 'required|string|max:20',
            ]);

            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'contact_number' => $request->contact_no,
                'password' => Hash::make($request->password),
                'usertype' => 'vendor',
            ]);

            // Create vendor details
            Vendor::create([
                'user_id' => $user->id,
                'organization_name' => $request->organization_name,
                'address' => $request->address,
                'contact_no' => $request->contact_no,
            ]);

            return redirect()->back()->with('success', 'Vendor added successfully!');
        } catch (\Exception $e) {
            \Log::info("message" . $e->getMessage());
        }
    }
}
