<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return Inertia::render('Auth/Login');
    }

    public function register()
    {
        return Inertia::render('Auth/Register');
    }

    public function postRegister(Request $request)
    {        
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);

        $profile_path = '/public/profile/';
        $image_name = uniqid()."_profile.".$request->file('image')->getClientOriginalExtension() ;
        $request->file('image')->storeAs($profile_path, $image_name);
        // $request->file('image')->move(public_path($profile_path),$image_name);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $image_name,
        ]);

        Auth::login($user);     
        return redirect()->route('home');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required|',
        ]);

        $credential = $request->only('email', 'password');
        if(!Auth::attempt($credential)){
            return redirect()->route('login')->with('error', "Someything was wrong !");
        };
        $user = Auth::user()->name;
        
        return redirect()->route('home')->with('success', "Welcome $user");

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
