<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\Slot;

class AdminController extends Controller
{
    public function viewAllSlots()
    {
        $all_slots = DB::table('slots')->get();
        return view('admin.parking-slots', compact('all_slots'));
    }

    public function addViewSlots()
    {
        $all_sections = DB::table('sections')->get();
        $all_slots = DB::table('slots')
            ->join('sections', 'slots.section_id', '=', 'sections.id')
            ->select('slots.id', 'slots.name', 'sections.section_name', 'sections.id as section_id', 'slots.status')
            ->get();
        return view('admin.add-slots', compact('all_slots', 'all_sections'));
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
}
