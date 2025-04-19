<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class VendorParkingSlotController extends Controller
{
    public function viewVendorSlots()
    {
        $all_sections = DB::table('vendors')->get();
        $all_slots = DB::table('slots')
            ->join('sections', 'slots.section_id', '=', 'sections.id')
            ->select('slots.id', 'slots.name', 'sections.section_name', 'sections.id as section_id', 'slots.status')
            ->get();
        return view('admin.vendor-slots', compact('all_slots', 'all_sections'));
    }
}
