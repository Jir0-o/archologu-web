<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArcheologicalSite;
use App\Models\SiteMaintenance;

class MaintenanceController extends Controller
{
    public function index()
    {
        $sites = ArcheologicalSite::all();
        return view('backend.maintenance.index', compact('sites'));
    }

    public function getBySite(Request $request)
    {
        $maintenances = SiteMaintenance::where('site_id', $request->site_id)->get();
        return response()->json($maintenances);
    }

    public function create()
    {
        $sites = ArcheologicalSite::all();
        return view('backend.maintenance.create', compact('sites'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'site_id' => 'required|exists:archeological_sites,id',
        //     'keep_watch' => 'required',
        //     'budget' => 'required',
        //     'financial_plan' => 'required',
        //     'management_plan' => 'required',
        //     'maintenance_strategy' => 'required',
        //     'special_care' => 'required',
        //     'intervension' => 'required',
        //     'interpretation' => 'required',
        //     'preventive_action' => 'required',
        //     'lack_maintenance' => 'required',
        //     'disaster_plan' => 'required',
        //     'edu_research' => 'required',
        //     'tourism' => 'required',
        //     'typology' => 'required',
        //     'condition' => 'required',
        //     'conservation_plan' => 'required',
        //     'master_plan' => 'required',
        //     'degree_intervension' => 'required',
        //     'social_impact' => 'required',
        //     'over_utilization' => 'required',
        //     'monitoring_reoprting.*' => 'nullable|file|mimes:pdf',
        //     'planning_action' => 'nullable|file|mimes:pdf',
        //     'technical_assistance' => 'nullable|file|mimes:pdf',
        //     'relevant_doc' => 'nullable|file|mimes:pdf',
        //     'initial_servey' => 'nullable|file|mimes:pdf',
        //     'execution_work' => 'nullable|file|mimes:pdf',
        //     'annual_plan' => 'nullable|file|mimes:pdf',
        // ]);

        $maintenance = new SiteMaintenance();
        $maintenance->site_id = $request->site_id;
        $maintenance->keep_watch = $request->keep_watch;
        $maintenance->budget = $request->budget;
        $maintenance->financial_plan = $request->financial_plan;
        $maintenance->management_plan = $request->management_plan;
        $maintenance->maintenance_strategy = $request->maintenance_strategy;
        $maintenance->special_care = $request->special_care;
        $maintenance->intervension = $request->intervension;
        $maintenance->interpretation = $request->interpretation;
        $maintenance->preventive_action = $request->preventive_action;
        $maintenance->lack_maintenance = $request->lack_maintenance;
        $maintenance->disaster_plan = $request->disaster_plan;
        $maintenance->edu_research = $request->edu_research;
        $maintenance->tourism = $request->tourism;
        $maintenance->typology = $request->typology;
        $maintenance->condition = $request->condition;
        $maintenance->conservation_plan = $request->conservation_plan;
        $maintenance->master_plan = $request->master_plan;
        $maintenance->degree_intervension = $request->degree_intervension;
        $maintenance->social_impact = $request->social_impact;
        $maintenance->over_utilization = $request->over_utilization;

        // Handle file uploads
        if ($request->hasFile('monitoring_reoprting')) {
            $files = [];
            foreach ($request->file('monitoring_reoprting') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName(); // Keep original filename with timestamp
                $file->storeAs('maintenance_docs', $filename, 'public'); // Store file in storage
                $files[] = $filename;
            }
            $maintenance->monitoring_reoprting = json_encode($files); // Store filenames in database
        }
        
        foreach (['planning_action', 'technical_assistance', 'relevant_doc', 'initial_servey', 'execution_work', 'annual_plan'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField);
                $filename = time() . '_' . $file->getClientOriginalName(); // Append timestamp to keep unique
                $file->storeAs('maintenance_docs', $filename, 'public'); // Store file
                $maintenance->$fileField = $filename; // Save filename in database
            }
        }

        $maintenance->save();

        return redirect()->back()->with('success', 'Site Maintenance Information Added Successfully.');
    }

}
