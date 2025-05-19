<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);
    
            $profilePicturePath = null;
    
            if ($request->hasFile('profile_picture')) {
                $user = User::where('email', $request->email)->first();
                
                if ($user && $user->profile_photo_path) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                }
    
                $profilePicturePath = $request->file('profile_picture')->store('profile-photos', 'public');
            }
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_photo_path' => $profilePicturePath,
            ]);
    
            return response()->json(['message' => 'User created successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create user.', 'error' => $e->getMessage()], 500);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $user = User::findOrFail($id); 
    
            return response()->json([
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'profile_picture_url' => $user->profile_photo_path ? Storage::url($user->profile_photo_path) : 'https://via.placeholder.com/50',
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch user data.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|confirmed',
                'profile_picture' => 'nullable|image|max:2048',
            ]);
    
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
    
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
    
            if ($request->hasFile('profile_picture')) {
                // Generate a unique filename
                $filename = time() . '.' . $request->file('profile_picture')->getClientOriginalExtension();
    
                // Save the file in the public/profile-photos directory
                $filePath = 'profile-photos/' . $filename;
                $request->file('profile_picture')->move(public_path('/storage/profile-photos'), $filename);
    
                $user->profile_photo_path = $filePath;
            }
    
            $user->save();
    
            return response()->json(['success' => 'User updated successfully.']);
        } catch (\Exception $e) {
            \Log::error('User Update Failed:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to update user.'], 500);
        }
    }
    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
 
        return back()->with('success', 'User deleted successfully.');
    }
}
