<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\ParkingLots;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    public function viewSlots()
    {
        $all_slots = DB::table('all_slots')
            ->select('all_slots.id', 'all_slots.name', 'all_slots.status')
            ->join('parking_lots', 'all_slots.parking_lot_id', '=', 'parking_lots.id')
            ->where('all_slots.user_id', auth()->user()->id)
            ->get();

        $all_parking_lots = DB::table('parking_lots')
            ->select('parking_lots.name', 'parking_lots.id', 'locations.location_name')
            ->join('locations', 'locations.id', '=', 'parking_lots.location_id')
            ->where('parking_lots.user_id', auth()->user()->id)
            ->get();
        return view('vendor.slots', compact('all_slots', 'all_parking_lots'));
    }

    public function viewLots()
    {
        $all_lots = DB::table('parking_lots')
            ->select('parking_lots.*','locations.id as location_id','locations.location_name')
            ->join('users', 'users.id', '=', 'parking_lots.user_id')
            ->join('locations', 'locations.id', '=', 'parking_lots.location_id')
            ->where('users.usertype', 'vendor')
            ->where('users.id', '=', auth()->user()->id)
            ->get();
        return view('vendor.branches', compact('all_lots'));
    }

    public function viewBookings()
    {
        return view('vendor.bookings');
    }

    // LOTS

    public function addLot(Request $request)
    {
        try {
            // dd($request->lot_id,$request->location_id);

            $validator = Validator::make($request->all(), [
                'lot_name' => ['required', 'string', 'max:255', Rule::unique('parking_lots', 'name')->ignore($request->lot_id)],
                'lot_address' => 'required|string|max:255',
                'location_name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('locations')->where(function ($query) use ($request) {
                        return $query->where(DB::raw('LOWER(location_name)'), strtolower($request->location_name));
                    })->ignore($request->location_id),
                ],
                'hourly_rate' => 'required|numeric|min:0',
                'lot_id'   => 'nullable|exists:parking_lots,id',
                'location_id' => 'nullable|exists:locations,id'

            ], [
                'lot_name.required' => "Parking Lot name is required",
                'lot_address.required' => "Parking Lot address is required",
                'location_name.required' => "Location name is required",
                'hourly_rate.required' => "Hourly rate is required",
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($request->filled('location_id')) {
            $location = Location::find($request->location_id);
            $location->location_name = Str::title($request->location_name);
            $location->save();
        } else {
            $location = Location::create([
                'location_name' => Str::title($request->location_name),
            ]);
        }

            if ($request->filled('lot_id')) {
                $lot = ParkingLots::find($request->lot_id);
            } else {
                $lot = new ParkingLots();
            }
            $lot->location_id = $location->id;
            $lot->user_id = Auth::id();
            $lot->name = Str::title($request->lot_name);
            $lot->address = Str::title($request->lot_address);
            $lot->hourly_rate = $request->hourly_rate;
            $lot->save();
            return redirect()->back()->with('success', $request->filled('lot_id') ? 'Vendor updated successfully!' : 'Vendor added successfully!');
        } catch (\Exception $e) {
            \Log::info("message - " . $e->getMessage());
        }
    }

    // SLOTS

    public function slotSaveOrUpdate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'slot_name'   => ['required', 'string', 'max:255', $request->filled('slot_id') ? 'unique:slots,name,' . $request->slot_id : 'unique:slots,name'],
                'section_id'  => 'required|exists:sections,id',
                'slot_id'     => 'nullable|exists:slots,id',
            ], [
                'section_id.required' => "Section is required",
                'slot_name.required' => "Name is required"
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($request->filled('slot_id')) {
                $slot = Slot::find($request->slot_id);
                $message = 'Slot updated successfully!';
            } else {
                $slot = new Slot();
                $slot->status = 'open';
                $message = 'Slot created successfully!';
            }

            $slot->name = $request->slot_name;
            $slot->section_id = $request->section_id;
            $slot->save();

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            \Log::info("Error ====> " . $e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function slotDelete($id): RedirectResponse
    {
        $slot = Slot::findOrFail($id);
        $slot->delete();

        return redirect()->back()->with('success', 'Slot deleted successfully!');
    }
}
