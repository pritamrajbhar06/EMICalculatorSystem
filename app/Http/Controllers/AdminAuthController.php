<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
     public function showLoginForm() {

        if (auth()->check() && auth()->user()->user_type === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (auth()->user()->user_type === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'Unauthorized access.');
        }

        // If authentication fails, redirect back with an error message

        return redirect()->back()->withErrors('Invalid credentials');
    }

    public function dashboard()
    {
       return view('admin.dashboard')->with([
            'tenuresCount' => \App\Models\Tenure::count(),
            'emiRulesCount' => \App\Models\EmiRule::count(),
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('message', 'Logged out successfully.');
    }
}
