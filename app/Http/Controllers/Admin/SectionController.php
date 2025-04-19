<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

use App\Models\Section;

class SectionController extends Controller
{
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
}
