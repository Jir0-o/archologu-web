<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArcheologicalSite;
use App\Models\SiteDescription;
use App\Models\Message;

class BackendController extends Controller
{
    public function index()
    {
        $count = ArcheologicalSite::count();
        $wellCount = SiteDescription::where('current_condition', 1)->count();
        $criticalCount = SiteDescription::where('current_condition', 3)->count();
        $vulnerableCount = SiteDescription::where('current_condition', 2)->count();
        $unknownCount = SiteDescription::where('current_condition', null)->count();
        return view('backend.home.index', compact('count', 'wellCount', 'criticalCount', 'vulnerableCount', 'unknownCount'));
    }

    public function userMessages()
    {
        $messages = Message::all();
        return view('backend.message.index', compact('messages'));
    }
}
