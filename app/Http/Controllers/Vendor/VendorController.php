<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
       public function viewSlots()
    {
        $all_sections = DB::table('sections')->get();
        $all_slots = DB::table('all_slots')
            ->join('sections', 'all_slots.section_id', '=', 'sections.id')
            ->select('all_slots.id', 'all_slots.name', 'sections.section_name', 'sections.id as section_id', 'all_slots.status')
            ->get();
        return view('vendor.slots', compact('all_slots', 'all_sections'));
    }
           public function viewLots()
    {
        $all_sections = DB::table('sections')->get();
        $all_slots = DB::table('all_slots')
            ->join('sections', 'all_slots.section_id', '=', 'sections.id')
            ->select('all_slots.id', 'all_slots.name', 'sections.section_name', 'sections.id as section_id', 'all_slots.status')
            ->get();
        return view('vendor.branches', compact('all_slots', 'all_sections'));
    }
}
