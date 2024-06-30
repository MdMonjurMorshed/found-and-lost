<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;


class UserLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $credential = $request->only(['email','password']);

        $user = User::where('email',$request->email)->first();
        
        if (!$user)
        {
         return redirect()->back()->with('error','User not exist');
        }

        if (Auth::guard('web')->attempt($credential))
        {
           
            return redirect(route('user.mainpage'));
        }
        return redirect()->back()->with('error','user cradential is invalid');
    } 

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        return redirect(route('user.login'));
    }
   


    //
}
