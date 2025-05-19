<?php

namespace App\Http\Controllers\frontend;

use App\Models\ArcheologicalSite;
use App\Models\District;
use App\Models\SiteMedia;
use App\Models\SiteDescription;
use App\Models\SiteSetting;
use App\Models\AboutUs;
use App\Models\Contact;
use App\Models\Message;

use App\Http\Controllers\Controller;
use App\Models\Thana;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() 
    {
        $sites = ArcheologicalSite::with(['siteDescription'])->paginate(6);
        $count = ArcheologicalSite::count();
        $wellCount = SiteDescription::where('current_condition', 1)->count();
        $criticalCount = SiteDescription::where('current_condition', 3)->count();
        $vulnerableCount = SiteDescription::where('current_condition', 2)->count();  
        $unknownCount = SiteDescription::where('current_condition', null)->count();
        
        $siteSetting = SiteSetting::first();
        $aboutUs = AboutUs::first();

        $districts = District::all();
        
        return view('frontend.home.index', compact('sites', 'count', 'wellCount', 'criticalCount', 'vulnerableCount', 'siteSetting', 'aboutUs', 'districts', 'unknownCount'));
    }

    public function about() 
    {
        $siteSetting = SiteSetting::first();
        $aboutUs = AboutUs::first();

        return view('frontend.about.index', compact('siteSetting', 'aboutUs'));
    }

    public function ancient_place() 
    { 
        
        $sites = ArcheologicalSite::with(['siteDescription'])
            ->paginate(6, ['*'], 'site_page');
        $well_preserved_sites = ArcheologicalSite::whereHas('siteDescription', function ($query) {
                    $query->where('current_condition', 1);
                })->with('siteDescription')->paginate(6, ['*'], 'well_page');
        $vulnerable_sites = ArcheologicalSite::whereHas('siteDescription', function ($query) {
                    $query->where('current_condition', 2);
                })->with('siteDescription')->paginate(6, ['*'], 'vulnerable_page');
        $critical_sites = ArcheologicalSite::whereHas('siteDescription', function ($query) {
                    $query->where('current_condition', 3);
                })->with('siteDescription')->paginate(6, ['*'], 'critical_page');

        $siteSetting = SiteSetting::first();

        return view('frontend.ancient_place.index', compact('sites', 'well_preserved_sites', 'vulnerable_sites', 'critical_sites', 'siteSetting'));
    }

    public function well_preserved() 
    { 
        
        $sites = ArcheologicalSite::with(['siteDescription'])
            ->get();
        $well_preserved_sites = ArcheologicalSite::whereHas('siteDescription', function ($query) {
                    $query->where('current_condition', 1);
                })->with('siteDescription')->paginate(6);

        $siteSetting = SiteSetting::first();

        return view('frontend.ancient_place.wellPreserved', compact('sites', 'well_preserved_sites', 'siteSetting'));
    }

    public function vulnerable() 
    { 
        
        $sites = ArcheologicalSite::with(['siteDescription'])
            ->get();
        $vulnerable_sites = ArcheologicalSite::whereHas('siteDescription', function ($query) {
                    $query->where('current_condition', 2);
                })->with('siteDescription')->paginate(6);

        $siteSetting = SiteSetting::first();

        return view('frontend.ancient_place.vulnerable', compact('sites', 'vulnerable_sites', 'siteSetting'));
    }

    public function critical() 
    { 
        
        $sites = ArcheologicalSite::with(['siteDescription'])
            ->get();
        $critical_sites = ArcheologicalSite::whereHas('siteDescription', function ($query) {
                    $query->where('current_condition', 3);
                })->with('siteDescription')->paginate(6);

        $siteSetting = SiteSetting::first();

        return view('frontend.ancient_place.critical', compact('sites', 'critical_sites', 'siteSetting'));
    }

    public function show_place($id) 
    {
        $site = ArcheologicalSite::with(['siteDescription', 'siteMaintenance'])
            ->where('id', $id)
            ->first();
        // dd($site);
        $media = SiteMedia::where('site_id', $id)->where('status', 1)->get();

        $siteSetting = SiteSetting::first();

        $categories = District::withCount('sites')->get();

        $mustVisitPlaces = ArcheologicalSite::with(['siteDescription'])->where('id', '!=', $id) 
        ->orderBy('created_at', 'desc') 
        ->take(4) 
        ->get();

        return view('frontend.ancient_place.show', compact('site', 'media', 'siteSetting','categories', 'mustVisitPlaces'));
    }

    public function contact() 
    {
        $siteSetting = SiteSetting::first();

        $contact = Contact::first();

        return view('frontend.contact.index', compact('siteSetting', 'contact'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subject' => 'nullable',
            'message' => 'nullable',
            'name' => 'required',
            'email' => 'required',
        ]);

        Message::create($validatedData);

        return redirect()->back()->with('success', 'Message Sent successfully!');


    }

    
    public function searchResults(Request $request)
    {
        $query = $request->input('query');
        $zillaId = $request->input('zilla_id');
        $thanaId = $request->input('thana_id');
    
        $districts = District::all();
        $thanas = Thana::all();
    
        $sites = ArcheologicalSite::query();
    
        if ($query) {
            $sites->where(function($q) use ($query) {
                $q->where('site_name_en', 'LIKE', "%{$query}%")
                  ->orWhere('site_name_bn', 'LIKE', "%{$query}%");
            });
        }
        if ($zillaId) {
            $sites->where('district_id', $zillaId);
        }
    
        if ($thanaId) {
            $sites->where('thana_id', $thanaId);
        }
    

        $sites = $sites->paginate(6);
    
        return view('frontend.ancient_place.searchData', compact('sites', 'districts', 'thanas'));
    }

    public function getThanasByZilla(Request $request)
    {
        $thanas = Thana::where('district_id', $request->zilla_id)->get();
        return response()->json($thanas);
    }

    public function searchCatagory(Request $request)
    {
        $zillaId = $request->input('zilla_id');
        

        $districts = District::all();
    
        $sites = ArcheologicalSite::query();
    
        if ($zillaId) {
            $sites->where('district_id', $zillaId);
        }
    
        $sites = $sites->paginate(6);
    
        return view('frontend.ancient_place.categoryData', compact('sites', 'districts'));
    }
    

}
