<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\AboutUs;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function editSiteSetting()
    {
        $siteSetting = SiteSetting::first();
        return view('backend.siteSetting.editSiteSetting', compact('siteSetting'));
    }
    public function updateSiteSetting(Request $request)
    {
        $request->validate([
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'site_hero1' => 'nullable',
            'site_hero2' => 'nullable',
            'site_hero3' => 'nullable',
            'youtube_text1' => 'nullable',
            'youtube_text2' => 'nullable',
            'youtube_text3' => 'nullable',
            'youtube_url' => 'nullable|url',
            'footer_text' => 'nullable',
            'twitter_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'fb_url' => 'nullable|url',
            'hero' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'hero2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $siteSetting = SiteSetting::first(); // Get the first site setting entry
        if (!$siteSetting) { 
            $siteSetting = new SiteSetting(); // Create a new entry if not exists
        }

        // Update text fields
        $siteSetting->email = $request->email;
        $siteSetting->phone = $request->phone;
        $siteSetting->address = $request->address;
        $siteSetting->hero_text1 = $request->site_hero1;
        $siteSetting->hero_text2 = $request->site_hero2;
        $siteSetting->hero_text3 = $request->site_hero3;
        $siteSetting->youtube_text1 = $request->youtube_text1;
        $siteSetting->youtube_text2 = $request->youtube_text2;
        $siteSetting->youtube_text3 = $request->youtube_text3;
        $siteSetting->youtube_video_link = $request->youtube_url;
        $siteSetting->footer_text = $request->footer_text;
        $siteSetting->twitter_link = $request->twitter_url;
        $siteSetting->linkedin_link = $request->linkedin_url;
        $siteSetting->facebook_link = $request->fb_url;
        $siteSetting->website_url = $request->website_url;


        // Handle file uploads
        if ($request->hasFile('hero')) {
            $file = $request->file('hero');
            $originalName = $file->getClientOriginalName();
            $timestamp = now()->timestamp; // Or use time()
            $fileName = $timestamp . '_' . $originalName;
            
            $heroPath = $file->storeAs('site_images', $fileName, 'public');
            $siteSetting->hero_image = $heroPath;
        }

        if ($request->hasFile('hero2')) {
            $file = $request->file('hero2');
            $originalName = $file->getClientOriginalName();
            $timestamp = now()->timestamp; // Or use time()
            $fileName = $timestamp . '_' . $originalName;
            
            $heroPath = $file->storeAs('site_images', $fileName, 'public');
            $siteSetting->hero_image2 = $heroPath;
        }
        
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $originalName = $file->getClientOriginalName();
            $timestamp = now()->timestamp; // Or use time()
            $fileName = $timestamp . '_' . $originalName;
            
            $logoPath = $file->storeAs('site_images', $fileName, 'public');
            $siteSetting->logo_image = $logoPath;
        }

        if ($request->hasFile('logo2')) {
            $file = $request->file('logo2');
            $originalName = $file->getClientOriginalName();
            $timestamp = now()->timestamp; // Or use time()
            $fileName = $timestamp . '_' . $originalName;
            
            $logoPath = $file->storeAs('site_images', $fileName, 'public');
            $siteSetting->preloader_img = $logoPath;
        }

        $siteSetting->save();

        return redirect()->back()->with('success', 'Site settings updated successfully!');
    }

    public function editAboutUs()
    {
        $aboutUs = AboutUs::first();
        return view('backend.siteSetting.editAboutUs', compact('aboutUs'));
    }

    public function updateAboutUs(Request $request)
    {
        $request->validate([
            'hero_title' => 'nullable',
            'hero_text' => 'nullable',
            'our_history' => 'nullable',
            'mission_vision' => 'nullable',
            'dg_name' => 'nullable',
            'hero_image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'hero_image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'dg_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $aboutUs = AboutUs::first(); // Get the first site setting entry
        if (!$aboutUs) {
            $aboutUs = new AboutUs(); // Create a new entry if not exists
        }

        // Update text fields
        $aboutUs->hero_title = $request->hero_title;
        $aboutUs->hero_text = $request->hero_text;
        $aboutUs->our_history = $request->our_history;
        $aboutUs->mission_vision = $request->mission_vision;
        $aboutUs->dg_name = $request->dg_name;

        // Handle file uploads
        if ($request->hasFile('hero_image1')) {
            $file = $request->file('hero_image1');
            $originalName = $file->getClientOriginalName();
            $timestamp = now()->timestamp; // Or use time()
            $fileName = $timestamp . '_' . $originalName;
            
            $heroPath = $file->storeAs('about_images', $fileName, 'public');
            $aboutUs->hero_image1 = $heroPath;
        }

        if ($request->hasFile('hero_image2')) {
            $file = $request->file('hero_image2');
            $originalName = $file->getClientOriginalName();
            $timestamp = now()->timestamp; // Or use time()
            $fileName = $timestamp . '_' . $originalName;
            
            $heroPath = $file->storeAs('about_images', $fileName, 'public');
            $aboutUs->hero_image2 = $heroPath;
        }
        
        if ($request->hasFile('dg_image')) {
            $file = $request->file('dg_image');
            $originalName = $file->getClientOriginalName();
            $timestamp = now()->timestamp; // Or use time()
            $fileName = $timestamp . '_' . $originalName;
            
            $dgPath = $file->storeAs('about_images', $fileName, 'public');
            $aboutUs->dg_image = $dgPath;
        }

        $aboutUs->save();

        return redirect()->back()->with('success', 'AboutUs Page updated successfully!');
    }

    public function editContact()
    { 
        $contact = Contact::first();
        return view('backend.siteSetting.editContact', compact('contact'));
    }

    public function updateContact(Request $request)
    {
        $request->validate([
            'office_time' => 'nullable',
            'office_location_url' => 'nullable|url',
            'contact_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $contact = Contact::first(); // Get the first site setting entry
        if (!$contact) {
            $contact = new Contact(); // Create a new entry if not exists
        }

        // Update text fields 
        $contact->office_time = $request->office_time;
        $contact->office_location_url = $request->office_location_url;

        // Handle file uploads
        if ($request->hasFile('contact_image')) {
            // Delete old image if exists
            if ($contact->contact_image && Storage::disk('public')->exists($contact->contact_image)) {
                Storage::disk('public')->delete($contact->contact_image);
            }
            $file = $request->file('contact_image');
            $originalName = $file->getClientOriginalName();
            $timestamp = now()->timestamp; // Or use time()
            $fileName = $timestamp . '_' . $originalName;
            
            $heroPath = $file->storeAs('contact_images', $fileName, 'public');
            $contact->contact_image = $heroPath;
        }


        $contact->save();

        return redirect()->back()->with('success', 'Contact Page updated successfully!');
    }
}
