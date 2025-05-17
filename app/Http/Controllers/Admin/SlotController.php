<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

use App\Models\Slot;


class SlotController extends Controller
{

    public function viewSlots()
    {
        $all_sections = DB::table('sections')->get();
        $all_slots = DB::table('all_slots')
            ->join('sections', 'all_slots.section_id', '=', 'sections.id')
            ->select('all_slots.id', 'all_slots.name', 'sections.section_name', 'sections.id as section_id', 'all_slots.status')
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

}
