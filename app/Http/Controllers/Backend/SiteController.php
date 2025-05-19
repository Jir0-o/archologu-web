<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArcheologicalSite;
use App\Models\District;
use App\Models\Thana;

class SiteController extends Controller
{
    public function index()
    {
        $sites = ArcheologicalSite::with(['district', 'thana'])->get();
        return view('backend.site.index', compact('sites'));
    }

    public function create()
    {
        $districts = District::all();
        return view('backend.site.create', compact('districts'));
    }

    public function getThanas($districtId)
    {
        $thanas = Thana::where('district_id', $districtId)->get();
        return response()->json($thanas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'site_name_bn' => 'required|string|max:255',
            'site_name_en' => 'required|string|max:255',
            'district_id' => 'required|exists:districts,id',
            'thana_id' => 'required|exists:thanas,id',
            'active' => 'boolean',
        ]);
    
        // Store the site
        ArcheologicalSite::create([
            'site_name_bn' => $request->site_name_bn,
            'site_name_en' => $request->site_name_en,
            'district_id' => $request->district_id,
            'thana_id' => $request->thana_id,
            'active' => $request->active,
        ]);
    
        // Redirect with success message
        return redirect()->back()->with('success', 'Site added successfully!');
    }
}
