<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Thana;

class LocationController extends Controller
{
    public function createDistrict()
    {
        $districts = District::orderBy('created_at', 'desc')->get();
        return view('backend.location.createDistrict', compact('districts'));
    }

    public function storeDistrict(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        District::create($validated);

        return redirect()->route('backend.location.createDistrict')->with('success', 'District added successfully!');
    }

    public function createThana()
    {
        //get 1st thana from index [0]
        $districts = District::orderBy('created_at', 'desc')->with('thanas')->get();
        return view('backend.location.createThana', compact('districts'));
    }

    public function storeThana(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'district_id' => 'required|exists:districts,id',
        ]);
    
        Thana::create([
            'name' => $validated['name'],
            'district_id' => $validated['district_id'],
        ]);

        return redirect()->route('backend.location.createThana')->with('success', 'Thana added successfully!');
    }

    public function getDistrictData($id)
    {
        $district = District::findOrFail($id);

        return response()->json($district);
    }

    public function updateDistrict(Request $request, $id)
    {
        $district = District::findOrFail($id);
        $district->name = $request->input('name');
        $district->save();

        return response()->json(['success' => true]);
    }

    public function deleteDistrict($id)
    {
        $district = District::findOrFail($id); 
        $district->delete(); 

        return response()->json(['message' => 'District deleted successfully']);
    }

    public function getThanaData($id)
    {
        $thana = Thana::with('district')->findOrFail($id);
        return response()->json($thana);
    }

    public function updateThana(Request $request, $id)
    {
        $thana = Thana::findOrFail($id);
        $thana->name = $request->input('name');
        $thana->district_id = $request->input('district_id');
        $thana->save();

        return response()->json(['success' => true]);
    }

    public function deleteThana($id)
    {
        $thana = Thana::findOrFail($id); 
        $thana->delete(); 

        return response()->json(['message' => 'Thana deleted successfully']);
    }
}
