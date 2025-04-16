<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\Slot;
use App\Models\Section;
use App\Models\User;
use App\Models\Vendor;

use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{


    public function viewSlots()
    {
        $all_sections = DB::table('sections')->get();
        $all_slots = DB::table('slots')
            ->join('sections', 'slots.section_id', '=', 'sections.id')
            ->select('slots.id', 'slots.name', 'sections.section_name', 'sections.id as section_id', 'slots.status')
            ->get();
        return view('admin.add-slots', compact('all_slots', 'all_sections'));
    }

    public function viewSections()
    {
        $all_sections = DB::table('sections')->get();
        $all_slots = DB::table('slots')
            ->join('sections', 'slots.section_id', '=', 'sections.id')
            ->select('slots.id', 'slots.name', 'sections.section_name', 'sections.id as section_id', 'slots.status')
            ->get();
        return view('admin.add-sections', compact('all_slots', 'all_sections'));
    }

    public function viewVendors()
    {
        $all_sections = DB::table('sections')->get();
        $all_slots = DB::table('slots')
            ->join('sections', 'slots.section_id', '=', 'sections.id')
            ->select('slots.id', 'slots.name', 'sections.section_name', 'sections.id as section_id', 'slots.status')
            ->get();
        return view('admin.add-vendors', compact('all_slots', 'all_sections'));
    }

    public function saveOrUpdate(Request $request)
    {
        $request->validate([
            'slot_name'   => 'required|string|max:255',
            'section_id'  => 'required|exists:sections,id',
            'slot_id'     => 'nullable|exists:slots,id',
        ]);
        if ($request->filled('slot_id')) {
            // Update
            $slot = Slot::find($request->slot_id);
            $message = 'Slot updated successfully!';
        } else {
            // Add New
            $slot = new Slot();
            $slot->status = 'open';
            $message = 'Slot created successfully!';
        }

        $slot->name = $request->slot_name;
        $slot->section_id = $request->section_id;
        $slot->save();

        return redirect()->back()->with('success', $message);
    }

    public function destroy($id): RedirectResponse
    {
        $slot = Slot::findOrFail($id);
        $slot->delete();

        return redirect()->back()->with('success', 'Slot deleted successfully!');
    }

    // SECTIONS

    public function sectionSaveOrUpdate(Request $request)
    {
        $request->validate([
            'section_name'   => 'required|string|max:255',
            'section_id'  => 'nullable|exists:sections,id',
        ]);
        if ($request->filled('section_id')) {
            // Update
            $slot = Slot::find($request->slot_id);
            $message = 'Section updated successfully!';
        } else {
            // Add New
            $slot = new Section();
            $message = 'Section created successfully!';
        }

        $slot->section_name = $request->section_name;
        $slot->save();

        return redirect()->back()->with('success', $message);
    }


    // VENDORS

    public function vendorStore(Request $request)
    {
        try{
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
                'contact_number' =>$request->contact_no,
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
        } catch(\Exception $e){
            \Log::info("message".$e->getMessage());

        }
    }
}
