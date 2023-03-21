<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->is_admin) {
                // Redirect admin to admin dashboard

                return redirect()->route('adminblog');
            } else {
                // Redirect user to user dashboard
                return redirect()->route('user.dashboard');
            }
        } else {
            // Invalid login credentials
            return redirect()->back()->withErrors(['email' => 'Invalid email or password']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/adminLogin');
    }
}
