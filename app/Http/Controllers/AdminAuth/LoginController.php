<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    public function login(Request $request)
    {
        
        $credential = $request->only(['email','password']);
        // dd($credential);
        if (Auth::guard('admin')->attempt($credential))
        {
            return redirect(route('admin.mainpage'));

        }

        return redirect()->back()->with('error','Invalid user credential');
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect(route('user.login'));

    }
    //
}
