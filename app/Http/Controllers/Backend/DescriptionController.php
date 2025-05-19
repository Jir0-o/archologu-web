<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArcheologicalSite;
use App\Models\SiteDescription;

class DescriptionController extends Controller
{
    public function index()
    {
        $sites = ArcheologicalSite::all();
        return view('backend.description.index', compact('sites'));
    }

    public function getBySite(Request $request)
    {
        $descriptions = SiteDescription::where('site_id', $request->site_id)->get();
        return response()->json($descriptions);
    }

    public function create()
    {
        $sites = ArcheologicalSite::all();
        return view('backend.description.create', compact('sites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'site_id' => 'required|exists:archeological_sites,id',
            'site_description' => 'required',
            'current_condition' => 'required',
            'immediate_problem' => 'required',
            'urgent_problem' => 'required',
            'threats' => 'required',
            'integrity' => 'required',
            'value' => 'required',
            'priorities' => 'required',
            'ownership' => 'required',
            'map_url' => 'nullable|url',
            'history' => 'required',
            'physical_integrity' => 'required',
            'structural_integrity' => 'required',
            'physical_features' => 'required',
            'historic_fabric' => 'required',
            'authentic_design' => 'required',
            'authentic_setting' => 'required',
            'authentic_material' => 'required',
        ]);
    
        SiteDescription::create($request->all());
    
        return redirect()->back()->with('success', 'Description added successfully.');
    }
}
