<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use App\Models\Slot;
use App\Models\Section;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Booking;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\select;

class AdminController extends Controller
{

    // SLOTS

    public function viewSlots()
    {
        $all_sections = DB::table('sections')->get();
        $all_slots = DB::table('slots')
            ->join('sections', 'slots.section_id', '=', 'sections.id')
            ->select('slots.id', 'slots.name', 'sections.section_name', 'sections.id as section_id', 'slots.status')
            ->get();
        return view('admin.add-slots', compact('all_slots', 'all_sections'));
    }

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

    // SECTIONS

    public function viewSections()
    {
        $all_sections = DB::table('sections')->get();

        return view('admin.add-sections', compact('all_sections'));
    }

    public function sectionSaveOrUpdate(Request $request)
    {
        $request->validate([
            'section_name'   => 'required|string|max:255',
            'section_id'  => 'nullable|exists:sections,id',
        ]);
        if ($request->filled('section_id')) {
            // Update
            $section = Section::find($request->section_id);
            $message = 'Section updated successfully!';
        } else {
            // Add New
            $section = new Section();
            $message = 'Section created successfully!';
        }

        $section->section_name = $request->section_name;
        $section->save();

        return redirect()->back()->with('success', $message);
    }

    public function sectionDelete($id): RedirectResponse
    {
        $section = Section::findOrFail($id);
        $section->delete();

        return redirect()->back()->with('success', 'Section deleted successfully!');
    }

    // BOOKING - CURRENT

    public function viewCurrentBooking()
    {
        $all_bookings = DB::table('bookings')
            ->leftJoin('users', 'users.id', '=', 'bookings.user_id')
            ->leftJoin('vehicles', 'vehicles.id', '=', 'bookings.vehicle_id')
            ->leftJoin('booked_slots', 'booked_slots.booking_id', '=', 'bookings.id')
            ->leftJoin('slots', 'slots.id', '=', 'booked_slots.slot_id')
            ->leftJoin('users as slot_owners', 'slot_owners.id', '=', 'slots.user_id')
            ->select(
                'users.name as booking_user_name',
                'slots.user_id as user_type',
                'users.contact_number',
                'bookings.id',
                'bookings.user_id',
                'bookings.status',
                'bookings.date_time',
                DB::raw("CONCAT(vehicles.v_color, ' ', vehicles.v_make, ' ', vehicles.v_model) as vehicle_details"),
                'vehicles.license_plate',
                DB::raw("GROUP_CONCAT(slots.name ORDER BY slots.name ASC SEPARATOR ', ') as slot_names"),
                'slot_owners.usertype as slot_owner_type'
            )
            ->where('bookings.date_time', '>', Carbon::now())
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
                'vehicles.license_plate',
                'slot_owners.usertype'
            )
            ->get();

            // $user_types = DB::table('bookings')
            // ->leftJoin('booked_slots', 'booked_slots.id','bookings.id')
            // ->leftJoin('slots', 'slots.id', '=', 'booked_slots.slot_id')
            // ->leftJoin('users','users.id','slots.user_id')
            // ->select('users.usertype')
            // ->get();

            // dd($all_bookings);


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

    // BOOKING - PAST

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
                DB::raw("CONCAT(vehicles.v_color, ' ', vehicles.v_make, ' ', vehicles.v_model) as vehicle_details"),
                'vehicles.license_plate',
                DB::raw("GROUP_CONCAT(slots.name ORDER BY slots.name ASC SEPARATOR ', ') as slot_names")
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



    // VENDORS

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

    // VENDOR SLOTS

    public function viewVendorSlots()
    {
        $all_sections = DB::table('vendors')->get();
        $all_slots = DB::table('slots')
            ->join('sections', 'slots.section_id', '=', 'sections.id')
            ->select('slots.id', 'slots.name', 'sections.section_name', 'sections.id as section_id', 'slots.status')
            ->get();
        return view('admin.vendor-slots', compact('all_slots', 'all_sections'));
    }

    // USERS

    public function viewUsers()
    {
        $all_sections = DB::table('vendors')->get();
        $all_slots = DB::table('slots')
            ->join('sections', 'slots.section_id', '=', 'sections.id')
            ->select('slots.id', 'slots.name', 'sections.section_name', 'sections.id as section_id', 'slots.status')
            ->get();
        return view('admin.users', compact('all_slots', 'all_sections'));
    }
}
