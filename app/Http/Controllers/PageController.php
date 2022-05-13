<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{    
    public function profile()
    {
        return Inertia::render('Profile');
    }

    public function editProfile()
    {
        return Inertia::render('EditProfile');
    }

    public function updateProfile(Request $request)
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);     
        $request->validate([
            'name' => 'nullable|min:3',
            'email' => 'nullable|unique:users,email,'.$user->id,
            'password' => 'nullable|min:6',
            'image' => 'nullable|mimes:png,jpg,jpeg'
        ]);

        $user->update([
            'name' => $request->name ,
            'email' => $request->email, 
        ]);

        if($request->filled('password')){
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        if($request->file('image')){
            $image = $user->image;
            $profile_path = '/public/profile/';
            Storage::delete($profile_path.$image);
            $image_name = uniqid()."_profile.".$request->file('image')->getClientOriginalExtension() ;

            $request->file('image')->storeAs($profile_path, $image_name);


            $user->update([
                'image' => $image_name,
            ]);
        }

        return redirect()->route('profile.edit')->with('success', 'User Update Successfully');

    }
}
