<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArcheologicalSite;
use App\Models\SiteDescription;
use App\Models\SiteMaintenance;
use App\Models\SiteMedia;
use App\Models\District;
use App\Models\Thana;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SiteAdditionController extends Controller
{
    public function index()
    {
        $sites = ArcheologicalSite::with(['district', 'thana'])
                    ->join('site_descriptions', 'site_descriptions.site_id', '=', 'archeological_sites.id')
                    ->select([
                        'archeological_sites.id',
                        'archeological_sites.site_name_en as name',
                        'archeological_sites.active',
                        'site_descriptions.map_url',
                        'archeological_sites.district_id',   
                        'archeological_sites.thana_id'
                    ])
                    ->get();
                    
        return view('backend.siteAddition.index', compact('sites'));
    }

    public function create()
    {
        $districts = District::all();
        return view('backend.siteAddition.create', compact('districts'));
    }

    public function store(Request $request)
    {
        // $validation = $request->validate([
        //     'site_name_en' => 'required|string|unique:archeological_sites',
        //     'site_name_bn' => 'required|string|unique:archeological_sites',
        //     'map_url' => 'nullable|url',
        //     'district_id' => 'required|exists:districts,id',
        //     'thana_id' => 'required|exists:thanas,id', // Assuming you have a thanas table
        //     'priority' => 'nullable|string',
        //     'description' => 'nullable|string',
        //     'historic_febric' => 'nullable|string',
        //     'monitoring_reporting' => 'nullable|file|mimes:pdf',
        //     'plan_action' => 'nullable|file|mimes:pdf',
        //     'annual_plan' => 'nullable|file|mimes:pdf',
        //     'master_plan' => 'nullable|file|mimes:pdf',
        //     'execution_work' => 'nullable|file|mimes:pdf',
        //     'fund' => 'nullable|file|mimes:pdf',
        //     'inventory' => 'nullable|file|mimes:pdf',
        //     'media.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,avi,mov',
        // ]);

        $site = new ArcheologicalSite();
        $site->site_name_en = $request->site_name_en;
        $site->site_name_bn = $request->site_name_bn;
        $site->district_id = $request->district_id;
        $site->thana_id = $request->thana_id;
        $site->thumbnail_title = $request->thumbnail_title;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $originalName = $file->getClientOriginalName();
            $timestamp = now()->timestamp; // Or use time()
            $fileName = $timestamp . '_' . $originalName;
        
            $path = $file->storeAs('thumbnail', $fileName, 'public');
            $site->thumbnail = $path;
        }
        
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $originalName = $file->getClientOriginalName();
            $timestamp = now()->timestamp; // Or use time()
            $fileName = $timestamp . '_' . $originalName;
        
            $path = $file->storeAs('banner', $fileName, 'public');
            $site->banner = $path;
        }       

        $site->save();

        $siteId = ArcheologicalSite::where('site_name_en', $request->site_name_en)->value('id');
        $description = new SiteDescription();
        $description->site_id = $siteId;
        $description->map_url = $request->map_url;
        $description->value = $request->value;
        $description->priorities = $request->priority;
        $description->ownership = $request->ownership;
        $description->site_description = $request->description;
        $description->history = $request->history;
        $description->historic_fabric = $request->historic_febric;
        $description->current_condition = $request->cur_condition;
        $description->demographic_growth = $request->demo_growth;
        $description->authentic_design = $request->authentic_design;
        $description->authentic_setting = $request->authentic_setting;
        $description->authentic_material = $request->authentic_material;
        $description->immediate_problem = $request->immediate_problem;
        $description->urgent_problem = $request->urgent_problem;
        $description->threats = $request->threat;
        $description->integrity = $request->integrity;
        $description->physical_integrity = $request->physical_integrity;
        $description->structural_integrity = $request->structural_integrity;
        $description->physical_features = $request->physical_feature;

        $description->save();

       // Maintenance data insert from here
        $maintenance = new SiteMaintenance(); 
        $maintenance->site_id = $siteId;
        $maintenance->intervension = $request->intervension;
        $maintenance->degree_intervension = $request->degree_intervension;
        $maintenance->keep_watch = $request->keep_watch;
        // $maintenance->initial_survey = $request->initial_survey;
        $maintenance->long_plan = $request->long_plan;
        $maintenance->medium_plan = $request->medium_plan;
        $maintenance->short_plan = $request->short_plan;
        $maintenance->management_plan = $request->management_plan;
        $maintenance->financial_plan = $request->financial_plan;
        $maintenance->disaster_plan = $request->disaster_plan;
        $maintenance->conservation_plan = $request->conservation_plan;
        $maintenance->preventive_action = $request->preventive_action;
        $maintenance->special_care = $request->special_care;
        $maintenance->budget = $request->budget;
        $maintenance->maintenance_strategy = $request->strategy;
        $maintenance->interpretation = $request->interpretation;
        $maintenance->lack_maintenance = $request->lack_maintenance;
        $maintenance->edu_research = $request->education;
        $maintenance->tourism = $request->tourism;
        $maintenance->typology = $request->typology;
        $maintenance->condition = $request->condition;
        $maintenance->social_impact = $request->social_impact;
        $maintenance->over_utilization = $request->over_utilization;
        $maintenance->publication_text = $request->publication_text;
        $maintenance->archive_text = $request->archive_text;
        $maintenance->documentory_text = $request->documentory_text;

        // Handle file uploads
        if ($request->hasFile('initial_survey')) {
            $file = $request->file('initial_survey');
            $fileName = 'initial_survey_' . now()->timestamp . '.' . $file->getClientOriginalExtension(); // Create a unique filename
        
            $path = $file->storeAs('initial_survey', $fileName, 'public');
            $maintenance->initial_survey = $path;
        }

        if ($request->hasFile('monitoring_reporting')) {
            $file = $request->file('monitoring_reporting');
            $fileName = 'monitoring_report_' . now()->timestamp . '.' . $file->getClientOriginalExtension(); // Create a unique filename
        
            $path = $file->storeAs('monitoring_reports', $fileName, 'public');
            $maintenance->monitoring_reporting = $path;
        }

        if ($request->hasFile('plan_action')) {
            $file = $request->file('plan_action');
            $fileName = 'plan_action_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('plan_actions', $fileName, 'public');
            $maintenance->planning_action = $path;
        }
        
        if ($request->hasFile('annual_plan')) {
            $file = $request->file('annual_plan');
            $fileName = 'annual_plan_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('annual_plans', $fileName, 'public');
            $maintenance->annual_plan = $path;
        }
        
        if ($request->hasFile('master_plan')) {
            $file = $request->file('master_plan');
            $fileName = 'master_plan_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('master_plans', $fileName, 'public');
            $maintenance->master_plan = $path;
        }
        
        if ($request->hasFile('execution_work')) {
            $file = $request->file('execution_work');
            $fileName = 'execution_work_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('execution_works', $fileName, 'public');
            $maintenance->execution_work = $path;
        }
        
        if ($request->hasFile('fund')) {
            $file = $request->file('fund');
            $fileName = 'fund_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('funds', $fileName, 'public');
            $maintenance->technical_assistance = $path;
        }
        
        if ($request->hasFile('inventory')) {
            $file = $request->file('inventory');
            $fileName = 'inventory_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('inventories', $fileName, 'public');
            $maintenance->relevant_doc = $path;
        }

        if ($request->hasFile('publications')) {
            $publicationPaths = [];
            foreach ($request->file('publications') as $file) {
                $fileName = $file->getClientOriginalName() . now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('publications', $fileName, 'public');
                $publicationPaths[] = $path;
            }
            $maintenance->publication = implode(',', $publicationPaths);
        }

        if ($request->hasFile('archives')) {
            $archivePaths = [];
            foreach ($request->file('archives') as $file) {
                $fileName = $file->getClientOriginalName() . now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('archives', $fileName, 'public');
                $archivePaths[] = $path;
            }
            $maintenance->archives = implode(',', $archivePaths);
        }

        if ($request->hasFile('documentory')) {
            $documentoryPaths = [];
            foreach ($request->file('documentory') as $file) {
                $fileName = $file->getClientOriginalName() . now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('documentories', $fileName, 'public');
                $documentoryPaths[] = $path;
            }
            $maintenance->documentory = implode(',', $documentoryPaths);
        }

        $maintenance->save();

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $index => $file) {
        
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('gallery', $filename, 'public');
                $title = $request->input('titles.' . $index) ?? '';
        
                SiteMedia::create([
                    'site_id' => $siteId,
                    'file_path' => 'gallery/' . $filename,
                    'file_type' => str_contains($file->getMimeType(), 'video') ? 'video' : 'image',
                    'status' => 1,
                    'title' => $title, 
                ]);
            }
        }
        return redirect()->route('backend.siteAddition.siteAddition')->with('success', 'Site added successfully!');
    }

    public function validateFields(Request $request)
    {
        $rules = [];
    
        if ($request->has('site_name_en')) {
            $rules['site_name_en'] = 'required|string|unique:archeological_sites,site_name_en';
        }
    
        if ($request->has('site_name_bn')) {
            $rules['site_name_bn'] = 'required|string|unique:archeological_sites,site_name_bn';
        }
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $site = ArcheologicalSite::with(['district', 'thana'])
                    ->join('site_descriptions', 'site_descriptions.site_id', '=', 'archeological_sites.id')
                    ->join('site_maintenances', 'site_maintenances.site_id', '=', 'archeological_sites.id')
                    ->where('archeological_sites.id', $id)
                    ->first();
        // dd($site);
        $media = SiteMedia::where('site_id', $id)->where('status', 1)->get();

        return view('backend.siteAddition.show', compact('site', 'media'));
    }

    public function edit($id)
    {
        $site = ArcheologicalSite::with(['district', 'thana'])
                    ->join('site_descriptions', 'site_descriptions.site_id', '=', 'archeological_sites.id')
                    ->join('site_maintenances', 'site_maintenances.site_id', '=', 'archeological_sites.id')
                    ->where('archeological_sites.id', $id)
                    ->first();
        // dd($site);
        $medias = SiteMedia::where('site_id', $id)->where('status', 1)->get();

        $districts = District::all();

        return view('backend.siteAddition.edit', compact('site', 'medias', 'districts'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $site = ArcheologicalSite::findOrFail($id);

        $site->site_name_en = $request->site_name_en;
        $site->site_name_bn = $request->site_name_bn;
        $site->district_id = $request->district_id;
        $site->thana_id = $request->thana_id;
        $site->thumbnail_title = $request->thumbnail_title;

        if ($request->hasFile('thumbnail')) {
            if ($site->thumbnail && Storage::disk('public')->exists($site->thumbnail)) {
                Storage::disk('public')->delete($site->thumbnail);
            }
            $file = $request->file('thumbnail');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('thumbnail', $fileName, 'public');
            $site->thumbnail = $path;
        }

        if ($request->hasFile('banner')) {
            if ($site->banner && Storage::disk('public')->exists($site->banner)) {
                Storage::disk('public')->delete($site->banner);
            }
            $file = $request->file('banner');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('banner', $fileName, 'public');
            $site->banner = $path;
        }       

        $site->save();

        $description = SiteDescription::where('site_id', $id)->firstOrFail();

        $description->map_url = $request->map_url;
        $description->value = $request->value;
        $description->priorities = $request->priority;
        $description->ownership = $request->ownership;
        $description->site_description = $request->description;
        $description->history = $request->history;
        $description->historic_fabric = $request->historic_febric;
        $description->current_condition = $request->cur_condition;
        $description->demographic_growth = $request->demo_growth;
        $description->authentic_design = $request->authentic_design;
        $description->authentic_setting = $request->authentic_setting;
        $description->authentic_material = $request->authentic_material;
        $description->immediate_problem = $request->immediate_problem;
        $description->urgent_problem = $request->urgent_problem;
        $description->threats = $request->threat;
        $description->integrity = $request->integrity;
        $description->physical_integrity = $request->physical_integrity;
        $description->structural_integrity = $request->structural_integrity;
        $description->physical_features = $request->physical_feature;

        $description->save();

        $maintenance = SiteMaintenance::where('site_id', $id)->firstOrFail();
        $maintenance->intervension = $request->intervension;
        $maintenance->degree_intervension = $request->degree_intervension;
        $maintenance->keep_watch = $request->keep_watch;
        $maintenance->long_plan = $request->long_plan;
        $maintenance->medium_plan = $request->medium_plan;
        $maintenance->short_plan = $request->short_plan;
        $maintenance->management_plan = $request->management_plan;
        $maintenance->financial_plan = $request->financial_plan;
        $maintenance->disaster_plan = $request->disaster_plan;
        $maintenance->conservation_plan = $request->conservation_plan;
        $maintenance->preventive_action = $request->preventive_action;
        $maintenance->special_care = $request->special_care;
        $maintenance->budget = $request->budget;
        $maintenance->maintenance_strategy = $request->strategy;
        $maintenance->interpretation = $request->interpretation;
        $maintenance->lack_maintenance = $request->lack_maintenance;
        $maintenance->edu_research = $request->education;
        $maintenance->tourism = $request->tourism;
        $maintenance->typology = $request->typology;
        $maintenance->condition = $request->condition;
        $maintenance->social_impact = $request->social_impact;
        $maintenance->over_utilization = $request->over_utilization;
        $maintenance->publication_text = $request->publication_text;
        $maintenance->archive_text = $request->archive_text;
        $maintenance->documentory_text = $request->documentory_text;

        if ($request->hasFile('publications')) {
            $publicationPaths = [];
            
            if ($maintenance->publication) {
                $publicationPaths = explode(',', $maintenance->publication);
            }
        
            foreach ($request->file('publications') as $file) {
                $fileName = $file->getClientOriginalName() . now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('publication', $fileName, 'public');
                $publicationPaths[] = $path;  
            }
        
            $maintenance->publication = implode(',', $publicationPaths);
        }
        
        if ($request->hasFile('archives')) {
            $archivePaths = [];
            
            if ($maintenance->archives) {
                $archivePaths = explode(',', $maintenance->archives);
            }
        
            foreach ($request->file('archives') as $file) {
                $fileName = $file->getClientOriginalName() . now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('archives', $fileName, 'public');
                $archivePaths[] = $path; 
            }
        
            $maintenance->archives = implode(',', $archivePaths);
        }
        
        if ($request->hasFile('documentory')) {
            $documentoryPaths = [];
            
            if ($maintenance->documentory) {
                $documentoryPaths = explode(',', $maintenance->documentory);
            }
        
            foreach ($request->file('documentory') as $file) {
                $fileName = $file->getClientOriginalName() . now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('documentory', $fileName, 'public');
                $documentoryPaths[] = $path; 
            }
        
            $maintenance->documentory = implode(',', $documentoryPaths);
        }        

        $this->updateMaintenanceFiles($request, $maintenance);

        $maintenance->save();

        // Update existing image titles
        if ($request->has('existing-image-title')) {
            $titles = $request->input('existing-image-title');
            
            foreach ($titles as $index => $newTitle) {
                $media = SiteMedia::find($site->media[$index]->id); 
                if ($media) {
                    $media->title = $newTitle;
                    $media->save();
                }
            }
        }

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $index => $file) {
                $title = $request->titles[$index] ?? null; 
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('gallery', $filename, 'public');
        
                SiteMedia::create([
                    'site_id' => $id,
                    'file_path' => 'gallery/' . $filename,
                    'file_type' => str_contains($file->getMimeType(), 'video') ? 'video' : 'image',
                    'title' => $title, 
                    'status' => 1,
                ]);
            }
        }
        return redirect()->route('backend.siteAddition.siteAddition')->with('success', 'Site updated successfully!');    
    }

    private function updateMaintenanceFiles(Request $request, SiteMaintenance $maintenance)
    {
        $files = [
            'initial_survey' => 'initial_survey',
            'monitoring_reporting' => 'monitoring_reports',
            'plan_action' => 'plan_actions',
            'annual_plan' => 'annual_plans',
            'master_plan' => 'master_plans',
            'execution_work' => 'execution_works',
            'fund' => 'funds',
            'inventory' => 'inventories',
        ];

        foreach ($files as $inputName => $storagePath) {
            if ($request->hasFile($inputName)) {
                $file = $request->file($inputName);
                $fileName = $inputName . '_' . time() . '.' . $file->getClientOriginalExtension();

                // Delete old file if exists
                if ($maintenance->$inputName && Storage::disk('public')->exists($maintenance->$inputName)) {
                    Storage::disk('public')->delete($maintenance->$inputName);
                }

                $path = $file->storeAs($storagePath, $fileName, 'public');
                $maintenance->$inputName = $path;
            }
        }
    }

    public function destroy($id)
    {
        // Find the ArcheologicalSite
        $site = ArcheologicalSite::findOrFail($id);

        // Delete related records
        SiteDescription::where('site_id', $id)->delete();

        // Delete media files and records
        $media = SiteMedia::where('site_id', $id)->get();
        foreach ($media as $medium) {
            if (Storage::disk('public')->exists($medium->file_path)) {
                Storage::disk('public')->delete($medium->file_path);
            }
            $medium->delete();
        }

        // Delete thumbnail and banner if they exist
        if ($site->thumbnail && Storage::disk('public')->exists($site->thumbnail)) {
            Storage::disk('public')->delete($site->thumbnail);
        }
        if ($site->banner && Storage::disk('public')->exists($site->banner)) {
            Storage::disk('public')->delete($site->banner);
        }


        // Fetch the maintenance record
        $maintenance = SiteMaintenance::where('site_id', $id)->first();

        if ($maintenance) {
            $files = [
                'initial_survey',
                'monitoring_reporting',
                'planning_action',
                'annual_plan',
                'master_plan',
                'execution_work',
                'technical_assistance',
                'relevant_doc',
                'fund',
                'inventory',
                'plan_action',
                'publication',
                'documentory',
                'archives',

            ];

            foreach ($files as $file) {
                if ($maintenance->$file && Storage::disk('public')->exists($maintenance->$file)) {
                    Storage::disk('public')->delete($maintenance->$file);
                }
            }

            $filePaths = array_merge(
                explode(',', $maintenance->documentory ?? ''),
                explode(',', $maintenance->archives ?? ''),
                explode(',', $maintenance->publication ?? '')
            );

            $filePaths = array_map('trim', $filePaths);

            foreach ($filePaths as $filePath) {
                if (!empty($filePath) && Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            }
        }

        SiteMaintenance::where('site_id', $id)->delete();

        $site->delete();


        return redirect()->route('backend.siteAddition.siteAddition')->with('success', 'Site deleted successfully!');
    }

    public function deleteFile(Request $request)
    {
        $filePath = $request->file_path;
        $id = $request->id; 
        $maintenance = SiteMaintenance::find($id); 
    
        if ($maintenance) {
            $fileFields = ['documentory', 'archives', 'publication'];
            foreach ($fileFields as $field) {
                $filePathsArray = explode(',', $maintenance->$field);
                foreach ($filePathsArray as $index => $path) {
                    if (trim($path) == $filePath && Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                        unset($filePathsArray[$index]);
                        $maintenance->$field = implode(',', $filePathsArray);
                        $maintenance->save();
    
                        return response()->json(['success' => true]);
                    }
                }
            }
        }
    
        return response()->json(['success' => false]);
    }

}
