<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArcheologicalSite;
use App\Models\SiteMedia;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $sites = ArcheologicalSite::all();
        return view('backend.gallery.index', compact('sites'));
    }

    public function getBySite(Request $request)
    {
        $galleries = SiteMedia::where('site_id', $request->site_id)->get();
        return response()->json($galleries);
    } 

    public function create()
    {
        $sites = ArcheologicalSite::all();
        return view('backend.gallery.create', compact('sites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'site_id' => 'required|exists:archeological_sites,id',
            'media.*' => 'required|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480', // Allow images & videos (max 20MB per file)
        ]);

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('gallery', $filename, 'public'); // Save to 'storage/app/public/gallery'

                SiteMedia::create([
                    'site_id' => $request->site_id,
                    'file_path' => 'storage/gallery/' . $filename, // Save public path
                    'file_type' => $file->getMimeType() === 'video/mp4' || str_contains($file->getMimeType(), 'video') ? 'video' : 'image',
                    'status' => 1,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Media uploaded successfully.');
    }

    public function uploadImages(Request $request)
    {
        // Validate hCaptcha response
        $hcaptchaSecret = env('HCAPTCHA_SECRET_KEY'); 
        $hcaptchaResponse = $request->input('h-captcha-response');
    
        $response = file_get_contents("https://hcaptcha.com/siteverify?secret={$hcaptchaSecret}&response={$hcaptchaResponse}");
        $responseKeys = json_decode($response, true);
    
        if (!$responseKeys['success']) {
            return response()->json(['message' => 'hCaptcha validation failed.'], 400);
        }
    
        // Validate form data and uploaded images
        $request->validate([
            'images.*' => 'required|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480',
            'user_name' => 'required|string|max:255',
            'user_phone' => 'required|numeric|digits:11',
        ]);
    
        $uploadedImages = [];
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filePath = $image->store('gallery', 'public');
    
                // Save to database (add user info)
                SiteMedia::create([
                    'file_path' => $filePath,
                    'file_type' => 'image',
                    'status' => 0,
                    'is_active' => 1,
                    'site_id' => $request->input('gallery_id'),
                    'user_name' => $request->input('user_name'),
                    'phone_no' => $request->input('user_phone'),
                ]);
    
                $uploadedImages[] = asset('storage/' . $filePath);
            }
        }
    
        return response()->json(['message' => 'Images uploaded successfully.', 'images' => $uploadedImages]);
    }

    public function getImages()
    {
        $images = SiteMedia::with('site')->orderBy('created_at', 'desc')->where('is_active', 1)->get(); 
        return view('backend.gallery.userGallery', compact('images'));
    }

    public function approveImage(Request $request)
    {
        try {
            $image = SiteMedia::find($request->image_id);
            if (!$image) {
                return response()->json(['success' => false, 'message' => 'Image not found']);
            }
            $image->status = 1; 
            $image->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function rejectImage(Request $request)
    {
        try {
            $image = SiteMedia::find($request->image_id);
            if (!$image) {
                return response()->json(['success' => false, 'message' => 'Image not found']);
            }
            $image->status = 2; 
            $image->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function deleteImage(Request $request)
    {
        try {
            $image = SiteMedia::find($request->image_id);
            if (!$image) {
                return response()->json(['success' => false, 'message' => 'Image not found']);
            }
            //find image in storage and delete
            Storage::disk('public')->delete($image->file_path);
            $image->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function searchContact(Request $request)
    {
        $phone = $request->input('phone');
    
        $contacts = SiteMedia::where('phone_no', $phone)->get();
    
        return view('frontend.gallery.userUpload', compact('contacts'));
    }
}
