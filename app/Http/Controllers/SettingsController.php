<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class SettingsController extends Controller
{


    public function index()
    {
        $users = User::latest()->get();
        return view('backend.siteSetting.settings', compact(['users']));
    }

}
